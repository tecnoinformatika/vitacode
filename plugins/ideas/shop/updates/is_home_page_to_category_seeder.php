<?php namespace Ideas\Shop\Updates;

use Ideas\Shop\Models\Config;
use Seeder;

class IsHomePageToCategorySeeder extends Seeder
{
    public function run()
    {
        //CONFIG
        $dataConfig = [
            [
                'name' => 'Number product display in homepage each category',
                'slug' => 'num_product_per_category',
                'value' => 4,
                'is_default' => Config::IS_DEFAULT
            ],
        ];
        Config::insert($dataConfig);
    }
}