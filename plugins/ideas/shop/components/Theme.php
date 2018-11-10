<?php namespace Ideas\Shop\Components;

use Cms\Classes\ComponentBase;
use Ideas\Shop\Facades\Price;
use Ideas\Shop\Models\Category;
use Ideas\Shop\Models\Config;
use Ideas\Shop\Models\IdeasShop;
use Ideas\Shop\Models\Products;
use Illuminate\Support\Facades\Session;

class Theme extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Theme config',
            'description' => 'Get theme config.'
        ];
    }

    public function defineProperties()
    {
        return [
            'slug' => [
                'title'             => 'Slug of theme config item',
                'type'              => 'string',
            ]
        ];
    }

    public function onRun()
    {
        $data = $this->loadThemeData();
        $this->page['galleries'] = $data['galleries'];
        $this->page['welcome'] = $data['welcome'];
        $this->page['featured'] = $data['featured'];
        $this->page['testimonials'] = $data['testimonials'];
        $this->page['ship_slide'] = $data['ship_slide'];
        $this->page['arrivals'] = $data['arrivals'];
        $this->page['category'] = $data['category'];
        $this->page['is_bestseller'] = $data['is_bestseller'];
        $this->page['seo_title'] = $data['seo_title'];
        $this->page['seo_keyword'] = $data['seo_keyword'];
        $this->page['seo_description'] = $data['seo_description'];
        Session::put('current_category', 0);//set to zero to set current category again
    }

    /**
     * Load theme data cache
     */
    protected function loadThemeData()
    {
        $data = IdeasShop::returnCacheData('theme_data', function() {
            $data['galleries'] = $this->loadGalleries();
            $data['welcome'] = $this->loadWelcome();
            $data['featured'] = $this->loadFeaturedProduct();
            $data['testimonials'] = $this->loadTestimonials();
            $data['ship_slide'] = $this->loadShipSlide();
            $data['arrivals'] = $this->loadLastedArrivals();
            $data['category'] = $this->loadCategory();
            $data['is_bestseller'] = $this->loadBestseller();
            $data['seo_title'] = Config::getConfigByKey('seo_title');
            $data['seo_keyword'] = Config::getConfigByKey('seo_keyword');
            $data['seo_description'] = Config::getConfigByKey('seo_description');
            return $data;
        });
        return $data;
    }

    protected function loadCategory()
    {
        $data = Category::select('id', 'is_homepage', 'num_display')
            ->where('status', IdeasShop::ENABLE)
            ->where('is_homepage', IdeasShop::ENABLE)
            ->get();
        if (!empty($data)) {
            return $data->toArray();
        }
        return $data;
    }

    /**
     * load gallery
     */
    protected function loadGalleries()
    {
        return \Ideas\Shop\Models\Theme::getThemeImagesBySlug('homepage_gallery');
    }

    /**
     * Load welcome image
     */
    protected function loadWelcome()
    {
        return \Ideas\Shop\Models\Theme::getThemeImagesBySlug('welcome_to_our_shop');
    }

    /**
     * Load testimonials
     */
    protected function loadTestimonials()
    {
        return \Ideas\Shop\Models\Theme::getThemeImagesBySlug('testimonials');
    }

    /**
     * Load ship slide
     */
    protected function loadShipSlide()
    {
        return \Ideas\Shop\Models\Theme::getThemeImagesBySlug('ship_slide');
    }

    /**
     * Load featured product
     */
    protected function loadFeaturedProduct()
    {
        $num = Config::getConfigByKey('number_featured_product');
        $query = Products::whereHas('attribute', function ($query) {
            $query->where('is_featured_product', IdeasShop::ENABLE);
        });
        $query->with(['attribute']);
        $data = $query->limit($num)->get();
        $data = IdeasShop::checkProductCanBuy($data);
        $data = Price::addFinalPriceForProductObject($data);
        if (!empty($data)) {
            return $data->toArray();
        }
        return $data;
    }

    /**
     * Load bestseller
     */
    protected function loadBestseller()
    {
        $num = Config::getConfigByKey('number_bestseller_product');
        $query = Products::whereHas('attribute', function ($query) {
            $query->where('is_bestseller', IdeasShop::ENABLE);
        });
        $query->with(['attribute']);
        $data = $query->limit($num)->get();
        $data = IdeasShop::checkProductCanBuy($data);
        $data = Price::addFinalPriceForProductObject($data);
        if (!empty($data)) {
            return $data->toArray();
        }
        return $data;
    }

    /**
     * Load lasted arrivals
     */
    protected function loadLastedArrivals()
    {
        $num = Config::getConfigByKey('number_is_new_product');
        $query = Products::whereHas('attribute', function ($query) {
            $query->where('is_new', IdeasShop::ENABLE);
        });
        $query->with(['attribute']);
        $data = $query->limit($num)->get();
        if (!empty($data)) {
            return $data->toArray();
        }
        return $data;
    }
}