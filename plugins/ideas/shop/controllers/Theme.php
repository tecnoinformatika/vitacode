<?php

namespace Ideas\Shop\Controllers;

use View;

class Theme extends IdeasShopController
{
    public $requiredPermissions = ['ideas.shop.access_theme'];
    public $controllerName = 'theme';

    /**
     * ajax add image
     */
    public function addimage()
    {
        $post = post();
        $this->vars['index'] = $post['index'];
        $this->layout = false;//disable load layout
    }
}
