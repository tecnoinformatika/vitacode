<?php namespace Ideas\Shop\Controllers;

use BackendMenu;
use Flash;
use View;
use Backend\Classes\Controller;


class Settings extends Controller
{
    public $requiredPermissions = ['ideas.shop.access_settings'];

    public $implement = [
        \Backend\Behaviors\ListController::class
    ];

    public $listConfig = 'config_list.yaml';

    public function __construct()
    {
        parent::__construct();
        //add style
        $this->addCss("/plugins/ideas/shop/assets/css/styles.css", "1.0.0");
        BackendMenu::setContext('Ideas.Shop', 'shop', 'settings');
    }

    public function index()
    {
        $this->pageTitle = 'ideas.shop::lang.controller.settings';
        $this->asExtension('ListController')->index();
    }


}
