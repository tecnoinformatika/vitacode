<?php namespace Ideas\Shop\Updates;

use Ideas\Shop\Models\Config;
use Ideas\Shop\Models\IdeasShop;
use Seeder;

class AddConfigDefaultProductType extends Seeder
{
    public function run()
    {
        $dataConfig = [
            [
                'name' => 'Is Create default is product simple',
                'slug' => 'is_create_product_type_simple',
                'value' => IdeasShop::ENABLE,//default
                'is_default' => Config::IS_DEFAULT
            ]
        ];
        Config::insert($dataConfig);
    }

}
