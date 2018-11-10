<?php namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;
use Event;

class Coupon extends Model
{

    use Validation;

    public $table = 'ideas_coupon';

    public $rules = [
        'name' => 'required',
        'code' => 'required|unique:ideas_coupon',
        'discount' => 'required',
        'total' => 'required',
        'start_date' => 'required',
        'end_date' => 'required'
    ];

    const IS_FOR_ALL = 1;
    const IS_NOT_FOR_ALL = 0;

    const NOT_NEED_LOGGED_IN = 0;
    const NEED_LOGGED_IN = 1;

    public static function getTypeOptions()
    {
        return TaxRate::typeArray();
    }

    public static function searchItem($post, $obj)
    {
        $keySearch = $post['q'];
        $data = $obj::select('id', 'name')
            ->where('name', 'like', '%'.$keySearch.'%')
            ->where('status', IdeasShop::ENABLE)
            ->get();
        $rs = [];
        if (!empty($data)) {
            foreach ($data as $row) {
                $rs[] = [
                    'id' => $row->id,
                    'text' => $row->name
                ];
            }
        }
        return $rs;
    }

    /**
     * Search category
     */
    public static function searchCategory($post)
    {
        $obj = new Category();
        return self::searchItem($post, $obj);
    }

    /**
     * Search product
     */
    public static function searchProduct($post)
    {
        $obj = new Products();
        return self::searchItem($post, $obj);
    }

    /**
     * Save product coupon or category coupon
     * $obj: instance of product or category
     * $field : field that assign data 'category_id' or 'product_id'
     * $id: to know create or update $post['id']
     * $itemArray : data of category or product
     * $idCouponSaved: id of coupon that saved
     */
    public static function saveProductOrCategoryCoupon($obj, $field, $id, $itemArray, $idCouponSaved)
    {
        $data = [];
        foreach ($itemArray as $row) {
            $data[] = [
                'coupon_id' => $idCouponSaved,
                $field => $row
            ];
        }
        if ($id != 0) {//update
            $obj::where('coupon_id', $idCouponSaved)->delete();
        }
        if (!empty($data)) {
            $obj::insert($data);
        }
    }

    /**
     * Save product coupon
     */
    public static function saveProductCoupon($post, $idCouponSaved)
    {
        $obj = new CouponToProduct();
        !empty($post['product']) ? $data = $post['product'] : $data = [];
        self::saveProductOrCategoryCoupon($obj, 'product_id', $post['id'], $data, $idCouponSaved);
    }

    /**
     * Save category coupon
     */
    public static function saveCategoryCoupon($post, $idCouponSaved)
    {
        $obj = new CouponToCategory();
        !empty($post['category']) ? $data = $post['category'] : $data = [];
        self::saveProductOrCategoryCoupon($obj, 'category_id', $post['id'], $data, $idCouponSaved);
    }

    /**
     * Apply for all category and all product
     */
    public static function applyForAll($id)
    {
        self::where('id', $id)->update(['is_for_all'=>self::IS_FOR_ALL]);
    }


    /**
     * After save: save product and category
     */
    public function afterSave()
    {
        $savedItem = $this->attributes;
        $idSaved = $savedItem['id'];
        $post = post();
        if (empty($post['category']) && empty($post['product'])) {
            self::applyForAll($idSaved);
        } else {
            self::saveCategoryCoupon($post, $idSaved);
            self::saveProductCoupon($post, $idSaved);
            self::where('id', $idSaved)->update(['is_for_all'=>self::IS_NOT_FOR_ALL]);
        }
        $post = post();
        Event::fire('ideas.shop.save_coupon', [$savedItem, $post]);
    }

    /**
     * Convert category or product id
     */
    public static function convertCatOrProductId($field, $data, $relation)
    {
        $convert = [];
        if (!empty($data)) {
            foreach ($data as $row) {
                $convert[] = [
                    'id' => $row[$field],
                    'name' => $row->$relation->name
                ];
            }
        }
        return $convert;
    }

    /**
     * Get category or product id
     */
    public static function getIdOfProductOrCategory($data)
    {
        $rs = [];
        $str = '';
        if (!empty($data)) {
            foreach ($data as $row) {
                $rs[] = $row['id'];
            }
            $str = implode(',', $rs);
        }
        return $str;
    }

    /**
     * Get category coupon for edit
     */
    public static function getCategoryCoupon($id)
    {
        $data = CouponToCategory::where('coupon_id', $id)->with('category:id,name')->get();
        $convert = self::convertCatOrProductId('category_id', $data, 'category');
        return $convert;
    }

    /**
     * Get product coupon for edit
     */
    public static function getProductCoupon($id)
    {
        $data = CouponToProduct::where('coupon_id', $id)->with('product:id,name')->get();
        $convert = self::convertCatOrProductId('product_id', $data, 'product');
        return $convert;
    }

}