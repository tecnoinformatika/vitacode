<?php namespace Ideas\Shop\Updates;

use Ideas\Shop\Models\Config;
use Ideas\Shop\Models\IdeasShop;
use Seeder;

class AddConfigIsResize extends Seeder
{
    public function run()
    {
        $dataConfig = [
            [
                'name' => 'Is resize feature image in product list in backend',
                'slug' => 'is_resize_image_product_list',
                'value' => IdeasShop::DISABLE,//default
                'is_default' => Config::IS_DEFAULT
            ]
        ];
        Config::insert($dataConfig);
    }

}
