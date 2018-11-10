<?php

namespace Ideas\Shop\Controllers;

class TaxRate extends IdeasShopController
{
    public $requiredPermissions = ['ideas.shop.access_tax_rate'];
    public $controllerName = 'taxrate';
}
