<?php namespace Ideas\Shop\Updates;

use Ideas\Shop\Models\Config;
use Seeder;

class AddSeoHomepage extends Seeder
{
    public function run()
    {
        $dataConfig = [
            [
                'name' => 'Homepage seo title',
                'slug' => 'seo_title',
                'value' => 'homepage',
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Homepage seo keyword',
                'slug' => 'seo_keyword',
                'value' => 'homepage',
                'is_default' => Config::IS_DEFAULT
            ],
            [
                'name' => 'Homepage seo description',
                'slug' => 'seo_description',
                'value' => 'homepage',
                'is_default' => Config::IS_DEFAULT
            ]
        ];
        Config::insert($dataConfig);
    }
}