<?php

namespace Ideas\Shop\Controllers;

use BackendMenu;
use Ideas\Shop\Models\ProductDownloadable;
use Ideas\Shop\Models\ProductToAttribute;

class Products extends IdeasShopController
{
    public $requiredPermissions = ['ideas.shop.access_products'];
    public $controllerName = 'products';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ideas.Shop', 'shop', 'products');
    }

    /**
     * Assign for form field '#_product_to_attribute' when update
     */
    public function formExtendFields($formWidget, $fields)
    {
        if ($this->action == 'update') {
            $product = $formWidget->model->attributes;
            $productId = $product['id'];
            $attribute = ProductToAttribute::getAttributeByProductId($productId);
            $fieldAssign = [
                'short_intro', 'full_intro', 'seo_title', 'seo_keyword', 'seo_description', 'is_homepage',
                'is_featured_product', 'weight', 'weight_id', 'length', 'width', 'height', 'length_id',
                'is_new', 'is_bestseller'
            ];
            if (!empty($attribute)) {
                foreach ($fieldAssign as $row) {
                    $fields['_attribute['.$row.']']->value = $attribute->{$row};
                }
            }
            if (get('type') == \Ideas\Shop\Models\Products::PRODUCT_TYPE_DOWNLOADABLE) {
                $productDownloadable = ProductDownloadable::select('link')->where('product_id', $productId)->first();
                $fields['_link']->value = '';
                if (!empty($productDownloadable)) {
                    $fields['_link']->value = $productDownloadable->link;
                }
            }
            return $fields;
        }
    }

    /**
     * extend query
     */
    public function listExtendQuery($query)
    {
        //exclude product child in list
        $query->where('product_type', '!=', \Ideas\Shop\Models\Products::PRODUCT_TYPE_CONFIGURABLE_CHILD);
    }

}