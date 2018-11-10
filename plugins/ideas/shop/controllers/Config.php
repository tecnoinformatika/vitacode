<?php

namespace Ideas\Shop\Controllers;

use Ideas\Shop\Models\Currency;
use Ideas\Shop\Models\IdeasShop;
use Ideas\Shop\Models\Weight;
use Artisan;
use Backend;


class Config extends IdeasShopController
{
    public $requiredPermissions = ['ideas.shop.access_config'];
    public $controllerName = 'config';

    const FRAMEWORK_CACHE_PATH = '/framework/cache';
    /**
     * to confirm if cache need to clear
     */
    public function getDirSize($directory)
    {
        if (!file_exists($directory) || count(scandir($directory)) <= 2) {
            return 0;
        }
        $size = 0;
        foreach (new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory)) as $file) {
            $size += $file->getSize();
        }
        return $size;
    }

    /**
     * Config default
     */
    public function configdefault()
    {
        $this->pageTitle = 'ideas.shop::lang.config.default';
        $data['configData'] = \Ideas\Shop\Models\Config::getConfigDefault();
        $data['weight'] = IdeasShop::getOptionOfFieldForTwigForm(new Weight());
        $data['currency'] = IdeasShop::getOptionOfFieldForTwigForm(new Currency());
        $data['enable'] = IdeasShop::ENABLE;
        $data['disable'] = IdeasShop::DISABLE;
        return view('ideas.shop::config.default', $data);
    }

    /**
     * On save config default
     */
    public function onSaveConfigDefault()
    {
        $post = post();
        unset($post['_session_key']);
        unset($post['_token']);
        foreach ($post as $key => $value) {
            \Ideas\Shop\Models\Config::where('slug', $key)->update(['value'=>$value]);
        }
        $url = Backend::url('ideas/shop/config/configdefault');
        return redirect($url);
    }

    /**
     * Clear cache
     */
    public function clearcache()
    {
        Artisan::call('cache:clear');
        $url = Backend::url('ideas/shop/config/configdefault');
        return redirect($url);
    }

    /**
     * exclude default config
     */
    public function listExtendQuery($query)
    {
        $query->where('is_default', '!=', \Ideas\Shop\Models\Config::IS_DEFAULT);
    }

    /**
     * update ignore is_default = 1
     */
    public function update($recordId = null)
    {
        $isConfigDefault = \Ideas\Shop\Models\Config::isConfigDefault($recordId);
        if ($isConfigDefault == true) {//not access directly
            $url = Backend::url('ideas/shop/config');
            return redirect($url);
        }
        $this->pageTitle = 'ideas.shop::lang.action.update';
        $this->vars['controller'] = $this->controllerName;
        return $this->asExtension('FormController')->update($recordId);
    }

}
