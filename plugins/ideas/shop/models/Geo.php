<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;
use Event;

class Geo extends Model
{
    use Validation;

    protected $table = 'ideas_geo_zone';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    public $rules = [
        'name' => 'required'
    ];

    /**
     * after save
     */
    public function afterSave()
    {
        $dataSaved = $this->attributes;
        $post = post();
        Event::fire('ideas.shop.save_geo', [$dataSaved, $post]);
    }
}