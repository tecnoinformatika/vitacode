<?php namespace Ideas\Shop\Components;

use Cms\Classes\ComponentBase;
use Ideas\Shop\Classes\Captcha;
use Ideas\Shop\Facades\Components\CategoryFacades;
use Ideas\Shop\Facades\Components\ProductFacades;
use Ideas\Shop\Models\Category;
use Ideas\Shop\Models\FilterOption;
use Ideas\Shop\Models\IdeasShop;
use Ideas\Shop\Models\ProductReview;
use Ideas\Shop\Models\Products;
use Ideas\Shop\Models\Route;
use Auth;
use Event;
use October\Rain\Support\Facades\Flash;
use Illuminate\Support\Facades\Session;

class Product extends ComponentBase
{

    const PAGE_NOT_FOUND = 0;
    const PAGE_FOUND = 1;

    public function componentDetails()
    {
        return [
            'name' => 'Ideas Shop Product',
            'description' => 'Get product list and product detail.'
        ];
    }

    /**
     * Pass params to component view
     */
    public function onRun()
    {
        $route = $this->getRouterBySlug();
        $this->page['found_result'] = self::PAGE_FOUND;
        $this->page['page_found'] = self::PAGE_FOUND;
        $this->page['page_not_found'] = self::PAGE_NOT_FOUND;
        if (empty($route)) {
            $this->page['found_result'] = self::PAGE_NOT_FOUND;
        } else {
            $seoInfo = self::getSeoInfo($route['entity_id'], $route['type']);
            $this->page['type'] = $route['type'];
            $this->page['type_product'] = Route::ROUTE_PRODUCT;
            $this->page['type_category'] = Route::ROUTE_CATEGORY;
            $this->page['seo_title'] = $seoInfo['seo_title'];
            $this->page['seo_keyword'] = $seoInfo['seo_keyword'];
            $this->page['seo_description'] = $seoInfo['seo_description'];
            $data = $this->getProduct($route['entity_id'], $route['type']);
            $this->page['data'] = $data['data'];
            if ($route['type'] == Route::ROUTE_CATEGORY) {//category
                $this->page['pages'] = $data['pages']; //custom pagination
                $this->page['sortByString'] = $data['sortByString'];
                $this->page['filterChecked'] = $data['filterChecked'];
                $this->page['count'] = $data['count'];
                $this->page['key'] = $data['key'];
                $this->page['firstArray'] = [1, 4, 7, 10, 13, 16, 19];//add class .first in first col in row
                $this->page['breadCrumb'] = ['type'=>'category', 'data'=>$data['breadCrumb']];
            } else {//product detail
                $this->page['gallery'] = $data['gallery'];
                $this->page['related'] = $data['related'];
                $this->page['configurable'] = $data['configurable'];
                $this->page['review'] = $data['review'];
                $this->page['filter_color'] = FilterOption::FILTER_TYPE_COLOR;
                $this->page['filter_label'] = FilterOption::FILTER_TYPE_LABEL;
                $this->page['filter_image'] = FilterOption::FILTER_TYPE_IMAGE;
                $this->page['breadCrumb'] = ['type'=>'product', 'data'=>$data['breadCrumb']];
            }
        }
    }

    /**
     * Generate captcha
     */
    public function onCaptcha()
    {
        $captcha = new Captcha();
        $captchaData = $captcha->getAndShowImage([]);
        return $captchaData;
    }

    /**
     * save review
     */
    public function onSubmitReview()
    {
        $post = post();
        $formData = [];
        foreach ($post as $row) {
            $formData[$row['name']] = $row['value'];
        }
        $loggedIn = Auth::getUser();
        $rs = ProductReview::addReview($formData, $loggedIn);
        if ($rs == IdeasShop::SUCCESS) {
            Flash::success(trans('ideas.shop::lang.component.review_success'));//save flash in next refresh
        }
    }

    /**
     * Get seo info
     */
    public static function getSeoInfo($id, $type)
    {
        if ($type == Route::ROUTE_PRODUCT) {
            $query = Products::select('id')->with(['attribute:id,product_id,seo_title,seo_keyword,seo_description']);
        } else {
            $query = Category::select('seo_title', 'seo_keyword', 'seo_description');
        }
        $data = $query->where('id', $id)
            ->first();
        if ($type == Route::ROUTE_PRODUCT) {
            $seoTitle = $data->attribute->seo_title;
            $seoKeyword = $data->attribute->seo_keyword;
            $seoDescription = $data->attribute->seo_description;
        } else {
            $seoTitle = $data->seo_title;
            $seoKeyword = $data->seo_keyword;
            $seoDescription = $data->seo_description;
        }
        $rs = [
            'seo_title' => $seoTitle,
            'seo_keyword' => $seoKeyword,
            'seo_description' => $seoDescription
        ];
        return $rs;
    }

    /**
     * Cache route
     * Create event : ideas.shop.handle_slug to override handling route for product and category
     */
    public static function routeCache($slug)
    {
        $data = IdeasShop::returnCacheData('slug-'.$slug, function() use ($slug){
            $route = Route::select('entity_id', 'type')
                ->where('slug', $slug)
                ->first();
            $routeEvent = Event::fire('ideas.shop.handle_slug', $slug);
            if (!empty($routeEvent)) {
                return $routeEvent[0];
            }
            $data = [];
            if (!empty($route)) {
                $data['entity_id'] = $route->entity_id;
                $data['type'] = $route->type;
            }
            return $data;
        });
        return $data;
    }

    /**
     * Get router by current url
     */
    public function getRouterBySlug()
    {
        $url = $this->currentPageUrl();
        $baseUrl = url('/');
        $slug = str_replace($baseUrl, '', $url);
        $slug = substr($slug, 1);//remove first '/'
        $data = self::routeCache($slug);
        return $data;
    }

    /**
     * Get data for category and product detail
     */
    public static function getProduct($id, $type)
    {
        if ($type == Route::ROUTE_PRODUCT) {
            return ProductFacades::getProductDetail($id);
        } else {
            //in case of one product belongs to many category
            Session::put('current_category', $id);
            $rs = CategoryFacades::getListProduct($id);
            return $rs;
        }
    }

    /**
     * Ajax Reload gallery of configurable product
     */
    public function onReloadGallery()
    {
        $product = post();
        $featuredImage = $product['featured_image'];
        $gallery = [];
        if (!empty($product['gallery'])) {
            $gallery = explode(';', $product['gallery']);
        }
        $this->page['featuredImage'] = $featuredImage;
        $this->page['gallery'] = $gallery;
    }

}