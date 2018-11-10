<?php namespace Ideas\Shop;

/**
 * The plugin.php file (called the plugin initialization script) defines the plugin information class.
 */

use Backend;
use Ideas\Shop\Models\Config;
use Ideas\Shop\Models\Currency;
use Ideas\Shop\Models\UserExtend;
use Illuminate\Support\Facades\Event;
use System\Classes\PluginBase;
use App;

class Plugin extends PluginBase
{

    public $require = ['RainLab.User'];

    public function boot()
    {
        Event::listen('rainlab.user.register', function ($user, $data) {
            $userSaved = $user->attributes;
            $userId = $userSaved['id'];
            UserExtend::saveUserRegister($userId, $data);
        });

        App::register('\Intervention\Image\ImageServiceProvider');
    }

    public function pluginDetails()
    {
        return [
            'name'        => 'Ideas Shop',
            'description' => 'Simple shopping cart',
            'author'      => 'Ideas pro',
            'icon'        => 'icon-leaf'
        ];
    }

    public function registerComponents()
    {
        return [
            'Ideas\Shop\Components\Theme' => 'themeConfig',
            'Ideas\Shop\Components\Product' => 'Product',
            'Ideas\Shop\Components\Cart' => 'Cart',
            'Ideas\Shop\Components\UserExtend' => 'UserExtend',
            'Ideas\Shop\Components\Checkout' => 'Checkout',
            'Ideas\Shop\Components\AnotherPayment' => 'AnotherPayment',
            'Ideas\Shop\Components\UserOrder' => 'UserOrder',
            'Ideas\Shop\Components\Downloadable' => 'Downloadable',
            'Ideas\Shop\Components\Search' => 'Search',
            'Ideas\Shop\Components\Category' => 'Category',
            'Ideas\Shop\Components\UserOrderDetail' => 'UserOrderDetail',
            'Ideas\Shop\Components\UserOrderInvoice' => 'UserOrderInvoice',
        ];
    }

    public function registerPermissions()
    {
        $controller = [
            'products', 'category', 'settings', 'config', 'coupon', 'filter', 'filter_option',
            'geo', 'length', 'weight', 'ship', 'tax_class', 'tax_rate', 'theme', 'document', 'order',
            'review', 'reason', 'order_return'
        ];
        $arrayAccess = [];
        foreach ($controller as $row) {
            $arrayAccess['ideas.shop.access_'.$row] = [
                    'tab' => trans('ideas.shop::lang.plugin.shop'),
                    'label' => trans('ideas.shop::lang.access.'.$row)
                ];

        }
        foreach ($controller as $row) {
            $arrayAccess['ideas.shop.delete_'.$row] = [
                'tab' => trans('ideas.shop::lang.plugin.shop'),
                'label' => trans('ideas.shop::lang.delete.'.$row)
            ];
        }
        return $arrayAccess;
    }

    public function registerNavigation()
    {
        return [
            'shop' => [
                'label'       => 'ideas.shop::lang.plugin.shop',
                'url'         => Backend::url('ideas/shop/products/index'),
                'icon'        => 'icon-shopping-basket',
                'iconSvg'     => '',
                'permissions' => ['ideas.shop.*'],
                'order'       => 500,
                'sideMenu' => [
                    'products' => [
                        'label'       => 'ideas.shop::lang.shop.product',
                        'icon'        => 'icon-cube',
                        'url'         => Backend::url('ideas/shop/products/index'),
                        'permissions' => ['ideas.shop.access_products']
                    ],
                    'category' => [
                        'label'       => 'ideas.shop::lang.shop.category',
                        'icon'        => 'icon-sitemap',
                        'url'         => Backend::url('ideas/shop/category/index'),
                        'permissions' => ['ideas.shop.access_category']
                    ],
                    'order' => [
                        'label'       => 'ideas.shop::lang.shop.order',
                        'icon'        => 'icon-shopping-basket',
                        'url'         => Backend::url('ideas/shop/order/index'),
                        'permissions' => ['ideas.shop.access_order']
                    ],
                    'settings' => [
                        'label'       => 'ideas.shop::lang.shop.settings',
                        'icon'        => 'icon-cog',
                        'url'         => Backend::url('ideas/shop/settings/index'),
                        'permissions' => ['ideas.shop.access_settings']
                    ]
                ]
            ]
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'ideas.shop::mail.orderSuccess',
            'ideas.shop::mail.forgotPassword',
            'ideas.shop::mail.downloadableProductLink'
        ];
    }

    /**
     * extend twig to display price and currency of product
     */
    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'displayPriceAndCurrency' => [$this, 'displayPriceAndCurrency'],
                'strPad' => [$this, 'strPad'],
                'captcha' => [$this, 'displayCaptcha'],
                'noImage' => [$this, 'noImage'],
                'breadCrumbDisplay' => [$this, 'breadCrumbDisplay'],
                'displayReview' => [$this, 'displayReview']
            ]
        ];
    }

    /**
     * Display price and currency
     */
    public function displayPriceAndCurrency($text)
    {
        $currency = Config::getCurrencySymbol();
        if ($currency['symbol_position'] == Currency::POSITION_BEFORE) {//before
            return $currency['symbol']. ' ' .$text;
        } else {//after
            return $text. ' '. $currency['symbol'];
        }
    }

    /**
     * Display order id
     */
    public function strPad($text)
    {
        return str_pad($text, 10, '0', STR_PAD_LEFT);
    }

    /**
     * Display captcha
     */
    public function displayCaptcha($text)
    {
        return '/storage/app/media/captcha/'.$text;
    }

    /**
     * Display no image if empty
     */
    public function noImage($text)
    {
        $storagePage = '/storage/app/media/';
        $image = str_replace($storagePage, '', $text);
        if ($image == '') {
            return '/storage/app/media/theme/no_image.png';
        }
        return $text;
    }

    /**
     * Display breadcrumb
     */
    public function breadCrumbDisplay($breadCrumb)
    {
        $html = '';
        $numCat = count($breadCrumb['data']);
        for ($i=0; $i<count($breadCrumb['data']); $i++) {
            $row = $breadCrumb['data'][$i];
            if ($i == $numCat - 1 && $breadCrumb['type'] == 'category') {//last category
                $html .= '<li>'.$row['name'].'</li>';
            } else {
                $html .= '<li><a href="'.$row['slug'].'">'.$row['name'].'</a></li>';
            }
        }
        return $html;
    }

    /**
     * Display review point
     */
    public function displayReview($point)
    {
        $html = '';
        if ($point > 0) {
            $maxPoint = 5;
            $not = $maxPoint - $point;
            for ($i=0; $i<$point; $i++) {
                $html .= '<span class="fa fa-star checked"></span>';
            }
            for ($y=0; $y<$not; $y++) {
                $html .= '<span class="fa fa-star"></span>';
            }
        }
        return $html;
    }

}
