<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;

class ThemeConfigImageDetail extends Model
{
    protected $table = 'ideas_theme_config_image_detail';
    public $timestamps = false;//disable 'created_at' and 'updated_at'
}