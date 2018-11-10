<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;

class Length extends Model
{
    use Validation;

    protected $table = 'ideas_length';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    public $rules = [
        'name' => 'required'
    ];
}