<?php

namespace Ideas\Shop\Controllers;

use Ideas\Shop\Models\Config;
use BackendMenu;

class Category extends IdeasShopController
{
    public $requiredPermissions = ['ideas.shop.access_category'];
    public $controllerName = 'category';

    public $implement = [
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ReorderController'
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Ideas.Shop', 'shop', 'category');
    }

    /**
     * Assign for form field '$fields' when create
     */
    public function formExtendFields($formWidget, $fields)
    {
        if ($this->action == 'create') {
            $fields['num_display']->value = Config::getConfigByKey('num_product_per_category');
            return $fields;
        }
    }

}