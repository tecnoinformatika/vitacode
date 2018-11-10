<?php

namespace Ideas\Shop\Controllers;

class Review extends IdeasShopController
{
    public $requiredPermissions = ['ideas.shop.access_review'];
    public $controllerName = 'review';
}
