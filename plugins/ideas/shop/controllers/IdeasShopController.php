<?php

/**
 * Base controller for shop
 */

namespace Ideas\Shop\Controllers;

use Auth;
use Lang;
use Flash;
use Response;
use BackendMenu;
use BackendAuth;
use Backend;
use Backend\Classes\Controller;

class IdeasShopController extends Controller
{
    public $implement = [
        \Backend\Behaviors\FormController::class,
        \Backend\Behaviors\ListController::class
    ];

    public $formConfig = 'config_form.yaml';
    public $listConfig = 'config_list.yaml';

    public $controllerName = 'geo';

    public function __construct()
    {
        parent::__construct();
        $this->addCss("/plugins/ideas/shop/assets/css/styles.css", "1.0.0");
        $this->addCss("/plugins/ideas/shop/assets/vendor/spectrum/spectrum.css", "1.0.0");
        $this->addCss("/plugins/ideas/shop/assets/vendor/waitme/waitMe.css", "1.0.0");
        $this->addCss("/plugins/ideas/shop/assets/vendor/alertable/jquery.alertable.css", "1.0.0");
        $this->addJs("/plugins/ideas/shop/assets/vendor/spectrum/spectrum.js", "1.0.0");
        $this->addJs("/plugins/ideas/shop/assets/vendor/string_to_slug/speakingurl.js", "1.0.0");
        $this->addJs("/plugins/ideas/shop/assets/vendor/string_to_slug/jquery.stringtoslug.js", "1.0.0");
        $this->addJs("/plugins/ideas/shop/assets/vendor/waitme/waitMe.js", "1.0.0");
        $this->addJs("/plugins/ideas/shop/assets/vendor/alertable/jquery.alertable.js", "1.0.0");
        $this->addJs("/plugins/ideas/shop/assets/js/helpers.js", "1.0.0");//LOAD HELPERS
        $this->addJs("/plugins/ideas/shop/assets/js/shop.js", "1.0.0");
        $this->addJs("/plugins/ideas/shop/assets/js/configurable.js", "1.0.0");
        BackendMenu::setContext('Ideas.Shop', 'shop', 'settings');
    }

    public function index()
    {
        $this->pageTitle = 'ideas.shop::lang.controller.'.$this->controllerName;
        $this->vars['controller'] = $this->controllerName;
        $this->asExtension('ListController')->index();
    }

    public function create()
    {
        $this->pageTitle = 'ideas.shop::lang.action.create';
        $this->vars['controller'] = $this->controllerName;
        return $this->asExtension('FormController')->create();
    }

    public function update($recordId = null)
    {
        $this->pageTitle = 'ideas.shop::lang.action.update';
        $this->vars['controller'] = $this->controllerName;
        return $this->asExtension('FormController')->update($recordId);
    }


}
