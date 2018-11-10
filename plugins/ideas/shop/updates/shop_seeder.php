<?php namespace Ideas\Shop\Updates;

use Ideas\Shop\Models\Config;
use Ideas\Shop\Models\Currency;
use Ideas\Shop\Models\Filter;
use Ideas\Shop\Models\FilterOption;
use Ideas\Shop\Models\Geo;
use Ideas\Shop\Models\IdeasShop;
use Ideas\Shop\Models\Length;
use Ideas\Shop\Models\Products;
use Ideas\Shop\Models\ProductToAttribute;
use Ideas\Shop\Models\ProductToCategory;
use Ideas\Shop\Models\ProductToFilterOption;
use Ideas\Shop\Models\Reason;
use Ideas\Shop\Models\Route;
use Ideas\Shop\Models\Ship;
use Ideas\Shop\Models\TaxClass;
use Ideas\Shop\Models\TaxRule;
use Ideas\Shop\Models\Theme;
use Ideas\Shop\Models\ThemeConfigImageDetail;
use Ideas\Shop\Models\Weight;
use Illuminate\Support\Facades\File;
use Seeder;
use Ideas\Shop\Models\OrderStatus;
use Illuminate\Support\Facades\DB;

class ShopSeeder extends Seeder
{
    public function run()
    {
        //ORDER STATUS
        $arrayOrderStatus = [
            'Pending', 'Shipped', 'Processing', 'Complete', 'Denied',
            'Failed', 'Refunded', 'Canceled', 'On hold'
        ];
        foreach ($arrayOrderStatus as $row) {
            $orderStatus = new OrderStatus();
            $orderStatus->name = $row;
            $orderStatus->save();
        }

        //DEFAULT CURRENCY
        $currency = new Currency();
        $currency->name = 'Us Dollar';
        $currency->code = 'USD';
        $currency->symbol = '$';
        $currency->symbol_position = 0;
        $currency->value = 1.00000000;
        $currency->date_modified = date('Y-m-d h:i:s');
        $currency->save();

        //Filter
        $filterArray = ['color', 'size', 'brand'];
        foreach ($filterArray as $row) {
            $filter = new Filter();
            $filter->name = $row;
            $filter->slug = $row;
            $filter->filter_order = 0;
            $filter->save();
        }

        //FILTER OPTION
        $filterOptionArray = [
            ['White', 'white', 1, '#ffffff', 1, 1],
            ['Black', 'black', 2, '#0f0f0f', 1, 1],
            ['S', 's', 1, 'S', 2, 2],
            ['M', 'm', 2, 'M', 2, 2],
            ['L', 'l', 3, 'L', 2, 2],
            ['XL', 'xl', 4, 'XL', 2, 2],
            ['Sony', 'sony', 1, 'Sony', 2, 3],
            ['LG', 'lg', 2, 'LG', 2, 3],
        ];
        foreach ($filterOptionArray as $row) {
            $filterOption = new FilterOption();
            $filterOption->name = $row[0];
            $filterOption->slug = $row[1];
            $filterOption->option_order = $row[2];
            $filterOption->option_value = $row[3];
            $filterOption->filter_type = $row[4];
            $filterOption->filter_id = $row[5];
            $filterOption->save();
        }

        //SHIP RULE
        $shipRule = new Ship();
        $shipRule->name = 'Pick up from store';
        $shipRule->above_price = 0.00;
        $shipRule->geo_zone_id = null;
        $shipRule->weight_type = null;
        $shipRule->weight_based = 0;
        $shipRule->cost = 0.00;
        $shipRule->type = Ship::TYPE_PRICE;
        $shipRule->status = IdeasShop::ENABLE;
        $shipRule->save();

        $shipRule = new Ship();
        $shipRule->name = 'Flat price';
        $shipRule->above_price = 50.00;
        $shipRule->geo_zone_id = null;
        $shipRule->weight_type = null;
        $shipRule->weight_based = 0;
        $shipRule->cost = 10.00;
        $shipRule->type = Ship::TYPE_PRICE;
        $shipRule->status = IdeasShop::ENABLE;
        $shipRule->save();

        $shipRule = new Ship();
        $shipRule->name = 'weight based 1';
        $shipRule->above_price = 0.00;
        $shipRule->geo_zone_id = null;
        $shipRule->weight_type = Ship::WEIGHT_TYPE_FIXED;
        $shipRule->weight_based = '1:5';
        $shipRule->cost = 0.00;
        $shipRule->type = Ship::TYPE_WEIGHT_BASED;
        $shipRule->status = IdeasShop::ENABLE;
        $shipRule->save();

        $shipRule = new Ship();
        $shipRule->name = 'weight based rate 1';
        $shipRule->above_price = 0.00;
        $shipRule->geo_zone_id = null;
        $shipRule->weight_type = Ship::WEIGHT_TYPE_RATE;
        $shipRule->weight_based = '6:13.50,9:14.00,12:14.50,17:15.00,22:15.50,24:16.00,27:16.50,32:17.00,35:17.50,38:18.00,42:18.50,47:19.00,51:19.50,60:20.00,63:20.50,66:21.00,70:21.50,72:22.00,73:24.50';
        $shipRule->cost = 0.00;
        $shipRule->type = Ship::TYPE_WEIGHT_BASED;
        $shipRule->status = IdeasShop::ENABLE;
        $shipRule->save();

        //WEIGHT
        $weightData = [
           ['Kilograms', 'Kg', 1.00],
           ['Gram', 'g', 1000.00],
           ['Pound', 'lb', 2.20]
        ];
        foreach ($weightData as $row) {
            $weight = new Weight();
            $weight->name = $row[0];
            $weight->unit = $row[1];
            $weight->value = $row[2];
            $weight->save();
        }

        //LENGTH
        $lengthData = [
            ['Centimeter', 'cm', 1.00],
            ['Inch', 'in', 0.39]
        ];
        foreach ($lengthData as $row) {
            $length = new Length();
            $length->name = $row[0];
            $length->unit = $row[1];
            $length->value = $row[2];
            $length->save();
        }

        //GEO ZONE
        $geo = new Geo();
        $geo->name = 'Area 1';
        $geo->description = '';
        $geo->save();

        //TAX RATE
        $taxRateData = [
            'name' => 'Nontaxable Rate',
            'type' => 0,
            'geo_zone_id' => 1,
            'rate' => 0
        ];
        DB::table('ideas_tax_rate')->insert($taxRateData);

        //TAX CLASS
        $taxClass = new TaxClass();
        $taxClass->name = 'Nontaxable';
        $taxClass->description = '';
        $taxClass->save();

        //TAX RULE
        $taxRule = new TaxRule();
        $taxRule->tax_class_id = 1;
        $taxRule->tax_rate_id = 1;
        $taxRule->save();

        //CATEGORY
        $cat1 = [
            'name' => 'Uncategory',
            'slug' => 'uncategory',
            'status' => IdeasShop::ENABLE,
            'parent_id' => null,
            'nest_left' => 1,
            'nest_right' => 2,
            'nest_depth' => 0
        ];
        DB::table('ideas_categories')->insert($cat1);
        Route::saveRoutes(0, 'uncategory', 1, Route::ROUTE_CATEGORY);

        $cat2 = [
            'name' => 'Laptop',
            'slug' => 'laptop',
            'status' => IdeasShop::ENABLE,
            'parent_id' => null,
            'nest_left' => 3,
            'nest_right' => 4,
            'nest_depth' => 0
        ];
        DB::table('ideas_categories')->insert($cat2);
        Route::saveRoutes(0, 'laptop', 2, Route::ROUTE_CATEGORY);

        //CONFIG
        $dataConfig = [
            [
                'name' => 'Coupon prefix',
                'slug' => 'coupon_prefix',
                'value' => 'shop',
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Coupon length random',
                'slug' => 'coupon_length_random',
                'value' => 10,
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Is cache enable',
                'slug' => 'is_cache',
                'value' => IdeasShop::CACHE_DISABLE,
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Currency default',
                'slug' => 'currency_default',
                'value' => 1,
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'weight base default',
                'slug' => 'weight_based_default',
                'value' => 1,
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Paypal id',
                'slug' => 'paypal_id',
                'value' => '',
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Paypal mode',
                'slug' => 'paypal_mode',
                'value' => 0,
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Stripe publish key',
                'slug' => 'stripe_publish',
                'value' => '',
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Stripe secret key',
                'slug' => 'stripe_secret',
                'value' => '',
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Does delete downloadable product link after one time download',
                'slug' => 'download_once',
                'value' => IdeasShop::ENABLE,
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Can customer download right after paying when checkout',
                'slug' => 'download_right_after_checkout',
                'value' => IdeasShop::ENABLE,
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Number minutes to cache',
                'slug' => 'cache_minute',
                'value' => 1,
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Send mail by function',
                'slug' => 'mail_method',
                'value' => IdeasShop::DISABLE,
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Paypal',
                'slug' => 'paypal',
                'value' => IdeasShop::DISABLE,
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Stripe',
                'slug' => 'stripe',
                'value' => IdeasShop::DISABLE,
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Convert Currency',
                'slug' => 'convert_currency',
                'value' => IdeasShop::DISABLE,
                'is_default' => Config::IS_DEFAULT
            ]
        ];
        Config::insert($dataConfig);

        //PRODUCT
        $productData = [];
        for ($i=1; $i<12; $i++) {
            $price = rand(10, 100);
            $gallery = '';
            for ($y=0; $y<4; $y++) {
                $gallery .= '/product/'.rand(1,10).'.jpg;';
            }
            $gallery = substr($gallery, 0, -1);
            $productData[] = [
                'name' => 'Product '.$i,
                'slug' => 'product-'.$i,
                'sku' => '',
                'price' => $price,
                'price_promotion' => $price,
                'qty' => rand(10, 1000),
                'qty_order' => 0,
                'featured_image' => '/product/'.rand(1, 10).'.jpg',
                'gallery' => $gallery,
                'status' => IdeasShop::ENABLE,
                'product_order' => 0,
                'product_type' => 1,
                'tax_class_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        Products::insert($productData);

        //PRODUCT ATTRIBUTE
        for ($i=1; $i<12; $i++) {
            $productAttribute = new ProductToAttribute();
            $productAttribute->product_id = $i;
            $productAttribute->short_intro = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
            $productAttribute->full_intro = 'Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident';
            $productAttribute->seo_title = 'product '.$i;
            $productAttribute->seo_keyword = 'product '.$i;
            $productAttribute->seo_description = 'product '.$i;
            $productAttribute->is_homepage = IdeasShop::ENABLE;
            $productAttribute->is_featured_product = IdeasShop::ENABLE;
            $productAttribute->is_new = IdeasShop::ENABLE;
            $productAttribute->is_bestseller = IdeasShop::ENABLE;
            $productAttribute->weight = rand(1, 10);
            $productAttribute->weight_id = 1;
            $productAttribute->length = 1;
            $productAttribute->width = 1;
            $productAttribute->height = 1;
            $productAttribute->length_id = 1;
            $productAttribute->save();
        }

        //PRODUCT CATEGORY
        for ($i=1; $i<12; $i++) {
            $productCategory = new ProductToCategory();
            $productCategory->product_id = $i;
            $productCategory->category_id = 1;
            $productCategory->save();
        }

        //ROUTER FOR PRODUCT
        for ($i=1; $i<12; $i++) {
            $router = new Route();
            $router->slug = 'product-'.$i;
            $router->entity_id = $i;
            $router->type = Route::ROUTE_PRODUCT;
            $router->save();
        }

        //Product To Filter Option
        for ($i=1; $i<12; $i++) {
            $ProductToFilterOption = new ProductToFilterOption();
            $ProductToFilterOption->product_id = $i;
            $ProductToFilterOption->filter_option_id = rand(1, 8);
            $ProductToFilterOption->save();
        }

        //slide for homepage
        $slide = [
            'name' => 'Homepage Gallery',
            'slug' => 'homepage_gallery',
            'type' => Theme::TYPE_IMAGE

        ];
        $slideId = Theme::insertGetId($slide);
        $imageArray = [];
        for ($i=1; $i<4; $i++) {
            $imageArray[] = [
                'name' => 'image '.$i,
                'url' => '/theme/slider1.jpg',
                'image_order' => $i,
                'theme_config_id' => $slideId
            ];
        }
        ThemeConfigImageDetail::insert($imageArray);

        //category image for homepage
        $welcome = [
            'name' => 'Welcome to our shop',
            'slug' => 'welcome_to_our_shop',
            'type' => Theme::TYPE_IMAGE
        ];
        $welcomeId = Theme::insertGetId($welcome);
        $imageArray = [];
        for ($i=1; $i<6; $i++) {
            $imageArray[] = [
                'name' => 'welcome '.$i,
                'url' => '/product/'.rand(1, 10).'.jpg',
                'image_order' => $i,
                'theme_config_id' => $welcomeId
            ];
        }
        ThemeConfigImageDetail::insert($imageArray);

        //slide user
        $testimonial = [
            'name' => 'Testimonials',
            'slug' => 'testimonials',
            'type' => Theme::TYPE_IMAGE
        ];
        $testimonialId = Theme::insertGetId($testimonial);
        $imageArray = [];
        for ($i=1; $i<5; $i++) {
            $imageArray[] = [
                'name' => 'testimonial '.$i,
                'url' => '/theme/user-'.$i.'.jpg',
                'title' => 'John Doe '.$i,
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et',
                'image_order' => $i,
                'theme_config_id' => $testimonialId
            ];
        }
        ThemeConfigImageDetail::insert($imageArray);

        //ship slide
        $shipSlide = [
            'name' => 'Ship slide',
            'slug' => 'ship_slide',
            'type' => Theme::TYPE_IMAGE
        ];
        $shipId = Theme::insertGetId($shipSlide);
        $imageArray = [];
        for ($i=1; $i<4; $i++) {
            $imageArray[] = [
                'name' => 'ship '.$i,
                'url' => '/theme/ship-'.$i.'.jpg',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et',
                'image_order' => $i,
                'theme_config_id' => $shipId
            ];
        }
        ThemeConfigImageDetail::insert($imageArray);

        //header bottom
        $imageHeaderBottom = [
            'name' => 'Image header bottom',
            'slug' => 'image_header_bottom',
            'type' => Theme::TYPE_IMAGE
        ];
        $imageId = Theme::insertGetId($imageHeaderBottom);
        $imageArray = [];
        $imageArray[] = [
            'name' => 'Image header bottom',
            'url' => '/theme/slider1.jpg',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et',
            'image_order' => 0,
            'theme_config_id' => $imageId
        ];
        ThemeConfigImageDetail::insert($imageArray);

        /*insert document*/
        DB::unprepared(File::get(plugins_path('/ideas/shop/updates/seeder.sql')));

        //create mail custom layout => insert into table system_mail_layouts
        $css = '
        body {
           background-color: #ffffff;
        }
        #mail-table {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 80%;
        }
        #mail-table td, #mail-table th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #mail-table tr:nth-child(even){background-color: #f2f2f2;}
        #mail-table tr:hover {background-color: #ddd;}
        #mail-table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }';

        $html = '<html>
            <head>
                <style type="text/css" media="screen">
                    {{ css|raw }}
                </style>
            </head>
            <body>
                {{ content|raw }}
            </body>
        </html>';

        $text = '{{ content|raw }}';

        $mail = \System\Models\MailLayout::where('code', 'ideas_shop_mail_layout')->first();
        if (empty($mail)) {
            \System\Models\MailLayout::create([
                'is_locked'    => true,
                'name'         => 'Ideas Shop Mail Layout',
                'code'         => 'ideas_shop_mail_layout',
                'content_html' => $html,
                'content_css'  => $css,
                'content_text' => $text,
            ]);
        }

        //Add order return reason
        $reason = new Reason();
        $reason->name = 'Order error';
        $reason->save();

    }

}
