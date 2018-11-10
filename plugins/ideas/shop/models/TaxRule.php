<?php namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use \October\Rain\Database\Traits\Validation;

class TaxRule extends Model
{
    public $table = 'ideas_tax_rule';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

}
