<?php namespace Ideas\Shop\Components;

use Cms\Classes\ComponentBase;
use Ideas\Shop\Models\Config;
use Ideas\Shop\Models\Currency;
use Ideas\Shop\Models\IdeasShop;
use Ideas\Shop\Models\Products;
use Ideas\Shop\Models\Theme;
use Ideas\Shop\Models\Weight;
use Illuminate\Support\Facades\Lang;

class Cart extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Ideas Shop Cart',
            'description' => 'add and update cart'
        ];
    }

    public function onRun()
    {
        $this->page['in_stock'] = IdeasShop::IN_STOCK;
        $this->page['is_out_of_stock'] = IdeasShop::OUT_OF_STOCK;
        $this->page['type_product_configurable'] = Products::PRODUCT_TYPE_CONFIGURABLE;
        $imageHeaderBottom = Theme::getThemeImagesBySlug('image_header_bottom');
        $this->page['image_header_bottom'] = $imageHeaderBottom[0];
        $this->page['msg_js'] = json_encode(Lang::get('ideas.shop::lang.msg_js'));
        $this->addCss('/plugins/ideas/shop/assets/components/css/styles.css');
        $this->addJs('/plugins/ideas/shop/assets/vendor/notify.js');
        $this->addJs('/plugins/ideas/shop/assets/components/js/cart.js');
        $this->addCss('/plugins/ideas/shop/assets/vendor/waitme/waitMe.css');
        $this->addJs('/plugins/ideas/shop/assets/vendor/waitme/waitMe.js');
    }

    /**
     * On reload cart dropdown
     */
    public function onReloadCartDropdown()
    {
        $post = post();
        $totalPrice = 0;
        foreach ($post as $row) {
            $totalPrice += $row['qty']*$row['price'];
        }
        $this->page['cart'] = $post;
        $this->page['totalPrice'] = $totalPrice;
    }

    /**
     * Convert cart
     */
    public static function convertCart($cart)
    {
        $rs = [];
        $totalPrice = 0;
        $qty = 0;
        $weightTotal = 0;
        $weightBaseDefault = Config::getConfigByKey('weight_based_default');
        $weightValueArray = Weight::getWeightForShip();
        !empty($weightValue[$weightBaseDefault]) ?
            $weightBaseDefaultValue = $weightValue[$weightBaseDefault] : $weightBaseDefaultValue = 1;
        foreach ($cart as $key => $value) {
            $totalPricePerItem = $value['qty'] * $value['price'];
            $value['total_price_per_item'] = $totalPricePerItem;
            $totalPrice += $totalPricePerItem;
            $rs[$key] = $value;
            $qty += $value['qty'];
            !empty($weightValueArray[$value['weight_id']]) ?
                $weightValue = $weightValueArray[$value['weight_id']] : $weightValue = 1;
            $weightTotal +=  ($value['weight'] * ($weightBaseDefaultValue / $weightValue)) ;
        }
        $rs['qtyTotal'] = $qty;
        $rs['totalPrice'] = $totalPrice;
        $rs['weightTotal'] = $weightTotal;
        return $rs;
    }

    /**
     * load ajax cart
     */
    public function onAjaxCart()
    {
        $post = post();
        $cart = self::convertCart($post);
        $this->page['qtyTotal'] = $cart['qtyTotal'];
        $this->page['totalPrice'] = $cart['totalPrice'];
        $this->page['weightTotal'] = $cart['weightTotal'];
        unset($cart['qtyTotal']);
        unset($cart['totalPrice']);
        unset($cart['weightTotal']);
        $this->page['cartDetail'] = $cart;
        $currency = Config::getCurrencySymbol();
        $this->page['currency_code'] = $currency['code'];
        $this->page['symbol'] = $currency['symbol'];
        $this->page['symbol_position'] = $currency['symbol_position'];
        $this->page['symbol_position_before'] = Currency::POSITION_BEFORE;
        $this->page['symbol_position_after'] = Currency::POSITION_AFTER;
    }

}