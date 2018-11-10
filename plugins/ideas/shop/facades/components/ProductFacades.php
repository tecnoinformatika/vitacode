<?php

namespace Ideas\Shop\Facades\Components;
use Ideas\Shop\Facades\Price;
use Ideas\Shop\Models\Category;
use Ideas\Shop\Models\Filter;
use Ideas\Shop\Models\FilterOption;
use Ideas\Shop\Models\IdeasShop;
use Ideas\Shop\Models\ProductReview;
use Ideas\Shop\Models\Products;
use Illuminate\Support\Facades\DB;
use \October\Rain\Database\Model;
use Illuminate\Support\Facades\Session;
use Ideas\Shop\Models\ProductToCategory;

class ProductFacades extends Model
{

    /**
     * Get related product
     */
    public static function getRelatedProduct($id)
    {
        $category = ProductToCategory::where('product_id', $id)
            ->first();
        $rs = [];
        if (!empty($category)) {
            $categoryId = $category->category_id;
            $query = Products::where('id', '!=', $id);
            $query->whereHas('productToCategory', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            });
            $query->with(['attribute']);
            $rs = $query->limit(4)->get();
            $rs = IdeasShop::checkProductCanBuy($rs);
            $rs = Price::addFinalPriceForProductObject($rs);
            $rs = $rs->toArray();
        }
        return $rs;
    }


    /**
     * Get filter for product detail
     */
    public static function getFilterForProductDetail($filterOptionArray, $filterOptionRelate)
    {
        $filterTable = with(new Filter())->getTable();
        $filterOptionTable = with(new FilterOption())->getTable();
        $data = DB::table($filterTable.' AS f')->select('f.name AS filter_name', 'fo.*')
            ->leftJoin($filterOptionTable.' AS fo', 'fo.filter_id', '=', 'f.id')
            ->whereIn('fo.id', $filterOptionArray)
            ->get()
            ->toArray();

        $rs = [];
        foreach ($data as $row) {
            $row->filter_related = array_key_exists($row->id, $filterOptionRelate) ? $filterOptionRelate[$row->id] : '';
            $rs[$row->filter_id]['name'] = $row->filter_name;
            $rs[$row->filter_id]['options'][] = $row;
        }
        return $rs;
    }

    /**
     * Convert filter option of product child
     */
    public static function convertOptionOfProductChild($data)
    {
        $filterOption = [];
        foreach ($data as $row) {
            $strFilterOptionId = $row['configurable']['str_filter_option_id'];
            $filterOption[] = explode(',', $strFilterOptionId);
        }
        $numOption = count($filterOption[0]);
        $convert = [];
        for ($i=0; $i<$numOption; $i++) {
            foreach ($filterOption as $row) {
                $convert[$i][] = $row[$i];
            }
        }
        //for example: 4 options -> for 3 times
        $rs = [];
        for ($i=0; $i<$numOption - 1; $i++) {
            $optionIndex = 0;
            foreach ($convert[$i] as $row) {
                $rs[$row][] = $convert[$i+1][$optionIndex];
                $optionIndex++;
            }
        }
        $rsConvert = [];
        foreach ($rs as $key => $value) {
            $rsConvert[$key] = implode(',', $value);
        }
        return $rsConvert;
    }

    /**
     * Get configurable product data
     */
    public static function getConfigurableData($id)
    {
        $query = Products::with('configurable:*');
        $query->whereHas('configurable', function ($query) use ($id) {
            $query->where('product_id', $id);
        });
        $childProduct = $query->get()->toArray();
        $filterOptionRelate = self::convertOptionOfProductChild($childProduct);
        $filterOptionIdArray = [];
        foreach ($childProduct as $row) {
            $filterOption = explode(',', $row['configurable']['str_filter_option_id']);
            foreach ($filterOption as $o) {
                $filterOptionIdArray[] = $o;
            }
        }
        $filterOptionIdArrayUnique = array_unique($filterOptionIdArray);
        $filter = self::getFilterForProductDetail(array_values($filterOptionIdArrayUnique), $filterOptionRelate);
        $childConvert = [];
        foreach ($childProduct as $row) {
            $childConvert[$row['configurable']['str_filter_option_id']] = $row;
        }
        $childConvert = Price::addFinalPriceForChildConfig($childConvert);
        $rs = [
            'child' => $childProduct,
            'filter' => $filter,
            'childConvert' => $childConvert
        ];
        return $rs;
    }

    /**
     * Get review product
     */
    public static function getProductReview($id)
    {
        $data = ProductReview::where('product_id', $id)
            ->where('status', IdeasShop::ENABLE)
            ->get()->toArray();
        return $data;
    }

    /**
     * Get product detail
     */
    public static function getProductDetailCache($id)
    {
        $data = Products::with(['attribute:*'])
            ->where('id', $id)
            ->first();
        $galleryArray = [];
        $configurable = [];
        if (!empty($data)) {
            $data = $data->toArray();
            $gallery = $data['gallery'];
            $galleryArray = [];
            if ($gallery != '') {
                $galleryArray = explode(';', $gallery);
            }
            $productType = $data['product_type'];
            $configurable = [];
            if ($productType == Products::PRODUCT_TYPE_CONFIGURABLE) {
                $configurable = self::getConfigurableData($id);
            }
            $data = Price::addFinalPriceForDetailProductArray($data);
        }
        //set to zero to set current category again  : product detail, homepage, search
        Session::put('current_category', 0);
        $rs = [
            'data' => $data,
            'gallery' => $galleryArray,
            'configurable' => $configurable,
            'related' => self::getRelatedProduct($id),
            'review' => self::getProductReview($id)
        ];
        return $rs;
    }

    /**
     * Get product detail cache
     */
    public static function getProductDetail($id)
    {
        $cacheKey = 'product_'.$id;
        $rs = IdeasShop::returnCacheData($cacheKey, function () use ($id) {
            return self::getProductDetailCache($id);
        });
        //get breadcrumb beside cache because depends on category id
        $currentCategory = Session::get('current_category');
        if ($currentCategory != 0) {
            $categoryId = $currentCategory;
        } else {
            $category = ProductToCategory::getCategoryForProduct($id);
            $categoryId = !empty($category) ? $category->category_id : 1;
        }
        $rs['breadCrumb'] = Category::getBreadCrumb($categoryId);
        $rs['data'] = IdeasShop::checkSingleProductCanBuyArray($rs['data']);
        return $rs;
    }
}