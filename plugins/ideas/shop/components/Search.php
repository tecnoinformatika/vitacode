<?php namespace Ideas\Shop\Components;

use Cms\Classes\ComponentBase;
use Ideas\Shop\Models\Products;
use Illuminate\Support\Facades\Session;

class Search extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Ideas Shop Search',
            'description' => 'Display search result'
        ];
    }

    public function onRun()
    {
        $get = get();
        Session::put('current_category', 0);
        $data = Products::searchProduct($get);
        isset($get['limit']) ? $limit = $get['limit'] : $limit = 10;
        $data->appends(['key'=>$get['key'], 'limit'=>$limit]);
        $this->page['data'] = $data;
    }
}