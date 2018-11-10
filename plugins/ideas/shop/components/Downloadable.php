<?php namespace Ideas\Shop\Components;

use Cms\Classes\ComponentBase;
use Ideas\Shop\Models\Config;
use Ideas\Shop\Models\IdeasShop;
use Ideas\Shop\Models\ProductDownloadableLink;

class Downloadable extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Ideas Shop Page for downloadable product',
            'description' => 'download downloadable product'
        ];
    }

    public function onRun()
    {
        $get = get();
        $code = $get['code'];
        $link = ProductDownloadableLink::checkLinkIsNotExpire($code);
        if ($link != '') {
            $isDownloadOnce = Config::getConfigByKey('download_once');
            if ($isDownloadOnce == IdeasShop::ENABLE) {
                ProductDownloadableLink::where('code', $code)->delete();
            }
            return response()->download(storage_path('app/media'.$link));
        }
    }

}