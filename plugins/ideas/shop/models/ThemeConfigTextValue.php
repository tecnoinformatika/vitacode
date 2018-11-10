<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;

class ThemeConfigTextValue extends Model
{
    protected $table = 'ideas_theme_config_text_value';
    public $timestamps = false;//disable 'created_at' and 'updated_at'
}