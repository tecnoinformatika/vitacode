<?php

namespace Ideas\Shop\Models;

use Ideas\Shop\Facades\Product;
use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;
use Event;

class Products extends Model
{
    use Validation;

    protected $table = 'ideas_product';

    public $hasOne = [
        'attribute' => ['Ideas\Shop\Models\ProductToAttribute', 'id', 'product_id']
    ];

    public $rules = [
        'name' => 'required',
        'slug' => 'required',
        'price' => 'required|numeric',
        'price_promotion' => 'numeric',
        'qty' => 'numeric',
        '_attribute[weight]' => 'numeric'
    ];

    const PRODUCT_TYPE_SIMPLE = 1;
    const PRODUCT_TYPE_CONFIGURABLE = 2;
    const PRODUCT_TYPE_CONFIGURABLE_CHILD = 3;
    const PRODUCT_TYPE_DOWNLOADABLE = 4;

    /**
     * Has one configurable
     */
    public function configurable()
    {
        return $this->hasOne('Ideas\Shop\Models\ProductConfigurable', 'pc_product_id', 'id');
    }

    /**
     * has one attribute
     */
    public function attribute()
    {
        return $this->hasOne('Ideas\Shop\Models\ProductToAttribute', 'product_id', 'id');
    }

    /**
     * Has many category
     */
    public function productToCategory()
    {
        return $this->hasMany('Ideas\Shop\Models\ProductToCategory', 'product_id', 'id');
    }

    /**
     * has many filter
     */
    public function productToFilterOption()
    {
        return $this->hasMany('Ideas\Shop\Models\ProductToFilterOption', 'product_id', 'id');
    }

    /**
     * Delete routes after delete products
     */
    public function afterDelete()
    {
        $checked = post('checked');
        Route::deleteRoutes($checked, Route::ROUTE_PRODUCT);
    }

    /**
     * Get tax class id option
     */
    public static function getTaxClassIdOptions()
    {
        $model = new TaxClass();
        $rs = IdeasShop::getOptionOfField($model);
        return $rs;
    }

    /**
     * Get length id option
     */
    public static function getAttributeLengthIdOptions()
    {
        $model = new Length();
        $rs = IdeasShop::getOptionOfField($model);
        return $rs;
    }

    /**
     * Get weight id option
     */
    public static function getAttributeWeightIdOptions()
    {
        $model = new Weight();
        $rs = IdeasShop::getOptionOfField($model);
        return $rs;
    }

    /**
     * Save attribute, filter, category and routes
     */
    public function afterSave()
    {
        $post = post();
        $productSaved = $this->attributes;
        Product::saveProduct($post, $productSaved);
        Event::fire('ideas.shop.save_product', [$productSaved, $post]);
    }

    /**
     * condition to display field
     */
    public function filterFields($fields, $context = null)
    {
        $get = get();
        $type = $get['type'];
        if ($type == self::PRODUCT_TYPE_SIMPLE) {
            $fields->_configurable->hidden = true;
            $fields->_link->hidden = true;
        }
        if ($type == self::PRODUCT_TYPE_CONFIGURABLE) {
            $fields->_link->hidden = true;
        }
        if ($type == self::PRODUCT_TYPE_DOWNLOADABLE) {
            $fields->_configurable->hidden = true;
            $fields->qty->hidden = true;
        }
    }

    /**
     * Product type array
     */
    public static function productTypeArray()
    {
        return [
            self::PRODUCT_TYPE_SIMPLE => trans('ideas.shop::lang.product_type.simple'),
            self::PRODUCT_TYPE_CONFIGURABLE => trans('ideas.shop::lang.product_type.configurable'),
            self::PRODUCT_TYPE_CONFIGURABLE_CHILD => trans('ideas.shop::lang.product_type.configurable_child'),
            self::PRODUCT_TYPE_DOWNLOADABLE => trans('ideas.shop::lang.product_type.downloadable')
        ];
    }

    /**
     * Map product type text
     */
    public static function mapProductTypeText($type)
    {
        $productTypeArray = self::productTypeArray();
        $text = 'ideas.shop::lang.product_type.simple';
        if (array_key_exists($type, $productTypeArray)) {
            $text = $productTypeArray[$type];
        }
        return $text;
    }

    /**
     * Search products
     */
    public static function searchProduct($get)
    {
        isset($get['page']) ? $page = $get['page'] : $page = 1;
        isset($get['limit']) ? $limit = $get['limit'] : $limit = 10;
        $data = self::select('id', 'name', 'slug', 'featured_image')
            ->with(['attribute:product_id,short_intro'])
            ->where('name', 'like', '%'.$get['key'].'%')
            ->where('status', IdeasShop::ENABLE)
            ->paginate($limit);
        return $data;
    }

}