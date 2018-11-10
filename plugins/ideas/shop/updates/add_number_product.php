<?php namespace Ideas\Shop\Updates;

use Ideas\Shop\Models\Config;
use Seeder;

class AddNumberProduct extends Seeder
{
    public function run()
    {
        $dataConfig = [
            [
                'name' => 'Number of featured product displayed',
                'slug' => 'number_featured_product',
                'value' => 4,
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Number of bestseller product displayed',
                'slug' => 'number_bestseller_product',
                'value' => 4,
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Number of lastest product displayed',
                'slug' => 'number_is_new_product',
                'value' => 2,
                'is_default' => Config::IS_DEFAULT
            ]
        ];
        Config::insert($dataConfig);
    }

}
