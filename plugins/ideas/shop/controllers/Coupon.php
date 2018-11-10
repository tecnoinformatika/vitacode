<?php

namespace Ideas\Shop\Controllers;

class Coupon extends IdeasShopController
{
    public $requiredPermissions = ['ideas.shop.access_coupon'];
    public $controllerName = 'coupon';

    /**
     * Search Category
     */
    public function searchcategory()
    {
        $post = post();
        $rs = \Ideas\Shop\Models\Coupon::searchCategory($post);
        return response()->json($rs);
    }

    /**
     * Search product
     */
    public function searchproduct()
    {
        $post = post();
        $rs = \Ideas\Shop\Models\Coupon::searchProduct($post);
        return response()->json($rs);
    }
}
