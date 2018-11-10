<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;

class ProductDownloadable extends Model
{
    protected $table = 'ideas_product_downloadable';
    public $timestamps = false;//disable 'created_at' and 'updated_at'
}