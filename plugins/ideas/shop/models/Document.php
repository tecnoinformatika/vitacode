<?php namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;

class Document extends Model
{
    public $table = 'ideas_document';
    public $timestamps = false;//disable 'created_at' and 'updated_at'
    use Validation;

    public $rules = [
        'name' => 'required',
    ];

    /**
     * get document
     */
    public static function getDocument($id)
    {
        return self::where('id', $id)->first();
    }

}