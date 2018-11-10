<?php namespace Ideas\Shop\Components;

use Cms\Classes\ComponentBase;
use Ideas\Shop\Facades\Price;
use Ideas\Shop\Models\IdeasShop;
use Ideas\Shop\Models\Products;
use Ideas\Shop\Models\ProductToCategory;
use Illuminate\Support\Facades\DB;

class Category extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Ideas Shop Category',
            'description' => 'Display list of products of category in themes'
        ];
    }

    public function defineProperties()
    {
        return [
            'id' => [
                'title'       => 'ideas.shop::lang.component.id',
                'description' => 'ideas.shop::lang.component.id_category_description',
                'type'        => 'string',
                'default'     => 1,
            ],
            'maxItems' => [
                'title'       => 'ideas.shop::lang.component.max_items',
                'description' => 'ideas.shop::lang.component.max_items_description',
                'type'        => 'string',
                'default'     => 4
            ]
        ];
    }

    public function onRun()
    {
        $id = $this->property('id');
        $maxItems = $this->property('maxItems');
        $this->page['categoryName'] = $this->getCategoryName($id);
        $this->page['category'] = $this->loadCategory($id, $maxItems);
    }

    /**
     * Get category name
     */
    public function getCategoryName($id)
    {
        $data = \Ideas\Shop\Models\Category::select('name')->where('id', $id)
           ->first();
        $name = '';
        if (!empty($data)) {
            $name = $data->name;
        }
        return $name;
    }

    /**
     * Load featured product
     */
    protected function loadCategory($id, $maxItems)
    {
        $productTable = with(new Products())->getTable();
        $productToCategoryTable = with(new ProductToCategory())->getTable();
        $data = DB::table($productTable.' AS p')
            ->leftJoin($productToCategoryTable.' AS pc', 'pc.product_id', '=', 'p.id')
            ->where('pc.category_id', $id)
            ->limit($maxItems)
            ->get();
        $data = IdeasShop::checkProductCanBuy($data);
        $data = Price::addFinalPriceForProductObject($data);
        return $data;
    }
}