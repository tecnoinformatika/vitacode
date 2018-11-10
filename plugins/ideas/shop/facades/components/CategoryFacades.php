<?php

namespace Ideas\Shop\Facades\Components;
use Ideas\Shop\Facades\Price;
use Ideas\Shop\Models\Category;
use Ideas\Shop\Models\Filter;
use Ideas\Shop\Models\FilterOption;
use Ideas\Shop\Models\IdeasShop;
use Ideas\Shop\Models\Products;
use Ideas\Shop\Models\ProductToCategory;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use \October\Rain\Database\Model;
use Ideas\Shop\Models\ProductToAttribute;

class CategoryFacades extends Model
{
    /**
     * Get weight and weight_id for product
     * input object
     * output object
     */
    public static function getWeightForProduct($data)
    {
        $productIdArray = [];
        if (!empty($data)) {
            foreach ($data as $row) {
                $productIdArray[] = $row->id;
            }
            $attribute = ProductToAttribute::select('weight', 'weight_id', 'product_id')
                ->whereIn('product_id', $productIdArray)
                ->get();
            $attributeConvert = [];
            if (!empty($attribute)) {
                foreach ($attribute as $row) {
                    $attributeConvert[$row->product_id] = [
                        'weight' => $row->weight,
                        'weight_id' => $row->weight_id
                    ];
                }
            }
            foreach ($data as $row) {
                $row->weight = !empty($attributeConvert[$row->id]['weight']) ?
                    $attributeConvert[$row->id]['weight'] : 0;
                $row->weight_id = !empty($attributeConvert[$row->id]['weight_id']) ?
                    $attributeConvert[$row->id]['weight_id'] : 1;
            }
        }
        return $data;
    }

    /**
     * Count page
     */
    public static function countPage($totalPages, $currentPage, $limitPage)
    {
        $remainPage = $limitPage - floor($limitPage/2);
        $plusPage = $limitPage - $remainPage;
        if ($totalPages <= $limitPage) {
            // less than $limitPage total pages so show all
            $startPage = 1;
            $endPage = $totalPages;
        } else {
            // more than $limitPage total pages so calculate start and end pages
            if ($currentPage <= $remainPage) {
                $startPage = 1;
                $endPage = $limitPage;
            } elseif ($currentPage + $plusPage >= $totalPages) {
                $startPage = $totalPages - ($limitPage - 1);
                $endPage = $totalPages;
            } else {
                $startPage = $currentPage - floor($limitPage / 2);
                $endPage = $currentPage + $plusPage;
            }
        }
        $pages = [];
        for ($i = $startPage; $i<$endPage + 1; $i++) {
            array_push($pages, $i);
        }
        return ['pages'=>$pages, 'currentPage' => $currentPage, 'totalPages' => $totalPages];
    }

    /**
     * pagination array
     */
    public static function arrayPagination($data, $limit)
    {
        // Get current page form url e.x. &page=1
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        // Create a new Laravel collection from the array data
        $itemCollection = collect($data);
        // Define how many items we want to be visible in each page
        $perPage = $limit;
        // Slice the collection to get the items to display in current page
        $currentPageItems = $itemCollection->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        return $currentPageItems;
    }

    /**
     * Get list product cache
     */
    public static function getListProductCache($get, $id)
    {
        isset($get['limit']) ? $limit = $get['limit'] : $limit = 9;
        isset($get['filter']) ? $filterArray = explode('_', $get['filter']) : $filterArray = [];
        isset($get['sort-by']) ? $sortBy = explode('-', $get['sort-by']) : $sortBy = ['price', 'asc'];
        isset($get['key']) ? $key = $get['key'] : $key = '';
        isset($get['page']) ? $page = $get['page'] : $page = 1;
        $productTable = with(new Products())->getTable();
        $productToCategoryTable = with(new ProductToCategory())->getTable();
        $query = DB::table($productTable.' AS p')
            ->leftJoin($productToCategoryTable.' AS pc', 'p.id', '=', 'pc.product_id')
            ->where('p.product_type', '!=', Products::PRODUCT_TYPE_CONFIGURABLE_CHILD)//exclude config child
            ->where('pc.category_id', $id);//filter by category

        if (!empty($sortBy)) {
            $query->orderBy('p.'.$sortBy[0], $sortBy[1]);
        } else {
            $query->orderBy('p.price', 'asc');//default sort is 'asc'
        }
        //get all product id for filter and price range
        //not use select(*) => Syntax error or access violation: 1055 when group by
        $arrayField = [
            'p.id', 'p.price', 'p.name', 'p.qty', 'p.qty_order', 'p.product_type', 'p.featured_image', 'p.slug',
            'p.tax_class_id', 'p.review_point'
        ];
        $data = $query->select($arrayField)
            ->distinct()->get()->toArray();
        $data = self::getWeightForProduct($data);
        $allRecord = count($data);
        $totalPage = ceil($allRecord/$limit);
        $pages = self::countPage($totalPage, $page, 5);
        $data = self::arrayPagination($data, $limit);
        $data = Price::addFinalPriceForProductObject($data);
        $countProductCurrentPage = count($data);
        $breadCrumb = Category::getBreadCrumb($id);
        $rs = [
            'data' => $data,
            'pages' => $pages,
            'sortByString' => implode('-', $sortBy),
            'filterChecked' => $filterArray,
            'count' => $countProductCurrentPage,
            'key' => $key,
            'breadCrumb' => $breadCrumb
        ];
        return $rs;
    }

    /**
     * Get list product - category
     */
    public static function getListProduct($id)
    {
        $get = get();
        $cacheKey = 'category_'.$id.'_';
        if (!empty($get)) {
            foreach ($get as $key => $value) {
                $cacheKey .= $key.'_'.$value.'_';
            }
        }
        $rs = IdeasShop::returnCacheData($cacheKey, function () use ($get, $id) {
            return self::getListProductCache($get, $id);
        });
        $rs['data'] = IdeasShop::checkProductCanBuy($rs['data']);
        return $rs;
    }
}