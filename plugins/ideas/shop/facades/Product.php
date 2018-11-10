<?php

namespace Ideas\Shop\Facades;

use Ideas\Shop\Models\FilterOption;
use Ideas\Shop\Models\ProductConfigurable;
use Ideas\Shop\Models\ProductDownloadable;
use Ideas\Shop\Models\Products;
use Ideas\Shop\Models\ProductToAttribute;
use Ideas\Shop\Models\ProductToCategory;
use Ideas\Shop\Models\ProductToFilterOption;
use Ideas\Shop\Models\Route;
use \October\Rain\Database\Model;
use Ideas\Shop\Models\Category;
use Validator;
use ValidationException;

class Product extends Model
{

    /**
     * Get category when create product
     */
    public static function getCategory()
    {
        $category = new Category();
        $data = $category->getRootList('name', 'id', '&nbsp&nbsp');
        return $data;
    }

    /**
     * Convert filter to display in tab 'filter' when create product
     */
    public static function convertFilter($array)
    {
        $rs = [];
        if (!empty($array)) {
            foreach ($array as $row) {
                $rs[$row['filter_id']]['info'] = [
                    'id' => $row['filter_id'],
                    'name' => $row['filter']['name']
                ];
                $rs[$row['filter_id']]['options'][] = $row;
            }
        }
        return $rs;
    }

    /**
     * Get filter and filter option when create product
     * arrayNotIn use when create configurable product
     */
    public static function getAllFilterAndOption($params)
    {
        $query = FilterOption::with('filter:id,name');
        if (isset($params['not_in'])) {
            $query->whereNotIn('filter_id', $params['not_in']);
        }
        if (isset($params['in'])) {
            $query->whereIn('filter_id', $params['in']);
        }
        $data = $query->get()->toArray();
        $data = self::convertFilter($data);
        return $data;
    }

    /**
     * Get Category or filter id
     * $field = 'category_id' or 'filter_option_id'
     */
    public static function getCatOrFilterByProductId($id, $field, $model)
    {
        $data = $model::where('product_id', $id)
            ->get();
        $rs = [];
        if (!empty($data)) {
            foreach ($data as $row) {
                $rs[] = $row[$field];
            }
        }
        return $rs;
    }

    /**
     * Get filter by product id
     */
    public static function getFilterByProductId($id)
    {
        return self::getCatOrFilterByProductId($id, 'filter_option_id', new ProductToFilterOption());
    }

    /**
     * Get category by product id
     */
    public static function getCategoryByProductId($id)
    {
        return self::getCatOrFilterByProductId($id, 'category_id', new ProductToCategory());
    }

    /**
     * Get filter id of config product
     */
    public static function getFilterIdOfConfigProduct($id)
    {
        $data = ProductConfigurable::select('str_filter_id')->where('product_id', $id)->first();
        $arrayFilterId = [];
        if (!empty($data)) {
            $strFilterId = $data->str_filter_id;
            $arrayFilterId = explode(',', $strFilterId);
        }
        return $arrayFilterId;
    }

    /**
     * Get filter option by product type and filter get in url
     * if create: get from get('filter'), if update: get filter from #_product_configurable
     */
    public static function getFilterOptionByProductTypeAndGet($id, $get)
    {
        $productType = $get['type'];
        $condition = [];//when product type is simple
        if ($id == 0) {//create
            if ($productType == Products::PRODUCT_TYPE_CONFIGURABLE) {
                $filterGet = $get['filter'];
                $condition = ['not_in' => $filterGet];
            }
        } else {//update
            if ($productType == Products::PRODUCT_TYPE_CONFIGURABLE) {
                $arrayFilterId = self::getFilterIdOfConfigProduct($id);
                $condition = ['not_in' => $arrayFilterId];
            }
        }
        $filterOption = self::getAllFilterAndOption($condition);
        return $filterOption;
    }

    /**
     * Get filter option for variant
     * if create: get from get('filter'), if update: get filter from #_product_configurable
     */
    public static function getFilterOptionForVariant($id, $get)
    {
        $filterOption = [];
        $productType = $get['type'];
        if ($productType == Products::PRODUCT_TYPE_CONFIGURABLE) {
            if ($id == 0) {//create config
                $filterGet = $get['filter'];
                $condition = ['in' => $filterGet];
            } else {//update config
                $arrayFilterId = self::getFilterIdOfConfigProduct($id);
                $condition = ['in' => $arrayFilterId];
            }
            $filterOption = self::getAllFilterAndOption($condition);
        }
        return $filterOption;
    }

    /**
     * Save category
     */
    public static function saveCategory($id, $productId, $category)
    {
        $data = [];
        foreach ($category as $row) {
            $data[] = [
                'product_id' => $productId,
                'category_id' => $row
            ];
        }
        if ($id != 0) {
            ProductToCategory::where('product_id', $productId)->delete();
        }
        ProductToCategory::insert($data);
    }

    /**
     * Save filter
     */
    public static function saveFilter($id, $productId, $filter)
    {
        $data = [];
        foreach ($filter as $row) {
            $data[] = [
                'product_id' => $productId,
                'filter_option_id' => $row
            ];
        }
        if ($id != 0) {
            ProductToFilterOption::where('product_id', $productId)->delete();
        }
        ProductToFilterOption::insert($data);
    }

    /**
     * Validate attribute
     */
    public static function validateAttribute($attribute)
    {
        $validator = Validator::make(
            [
                'weight' => $attribute['weight'],
                'length' => $attribute['length'],
                'width' => $attribute['width'],
                'height' => $attribute['height']
            ],
            [
                'weight' => 'numeric',
                'length' => 'numeric',
                'width' => 'numeric',
                'height' => 'numeric'
            ]
        );
        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }

    /**
     * Save product downloadable
     */
    public static function saveProductDownloadable($post, $productId, $id)
    {
        $link = $post['Products']['_link'];
        if ($id == 0) {//create
            ProductDownloadable::insert(['product_id'=>$productId, 'link'=>$link]);
        } else {
            ProductDownloadable::where('product_id', $productId)->update(['link'=>$link]);
        }
    }

    /**
     * Save attribute, filter, category, configurable product and routes
     */
    public static function saveProduct($post, $productSaved)
    {
        $id = $post['id'];//to know if create or update
        $productId = $productSaved['id'];
        $attribute = $post['Products']['_attribute'];
        $attribute['product_id'] = $productId;
        self::validateAttribute($attribute);
        if ($id == 0) {
            ProductToAttribute::insert($attribute);
        } else {
            ProductToAttribute::where('product_id', $id)->update($attribute);
        }
        //save gallery
        if (!empty($post['gallery'])) {
            Products::where('id', $productId)->update(['gallery'=>implode(';', $post['gallery'])]);
        }
        //save category
        if (!empty($post['Products']['_category'])) {
            $category = $post['Products']['_category'];
            self::saveCategory($id, $productId, $category);
        } else {
            die('category');
        }
        //save configurable product
        if ($post['Products']['product_type'] == Products::PRODUCT_TYPE_CONFIGURABLE) {
            if (!empty($post['variant_json']) && $post['variant_json'] != '[]') {
                Configurable::saveConfigurableProduct($productId, $post);
            } else {
                die('variant');
            }
        }
        //save downloadable product
        if ($post['Products']['product_type'] == Products::PRODUCT_TYPE_DOWNLOADABLE) {
            self::saveProductDownloadable($post, $productId, $id);
        }
        //save filter
        if (!empty($post['Products']['_filter'])) {
            $filter = $post['Products']['_filter'];
            self::saveFilter($id, $productId, $filter);
        }
        //save routes
        $typeRoute = Route::ROUTE_PRODUCT;
        Route::saveRoutes($id, $post['Products']['slug'], $productId, $typeRoute, $typeRoute);
    }


}