<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;

class Route extends Model
{
    use Validation;

    protected $table = 'ideas_routes';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    public $rules = [
        'slug' => 'required|unique:ideas_routes',
        'entity_id' => 'required',
        'type' => 'required'
    ];

    const ROUTE_PRODUCT = 1;
    const ROUTE_CATEGORY = 2;

    /**
     * Save routes
     * $idEdit : to know if create or edit
     * $entityId : id of category (product) just saved
     */
    public static function saveRoutes($idEdit, $slug, $entityId, $type)
    {
        $model = new Route();
        if ($idEdit != 0) {//edit
            $model = self::where('entity_id', $entityId)
                ->where('type', $type)
                ->first();
        }
        $model->slug = $slug;
        $model->entity_id = $entityId;
        $model->type = $type;
        $model->save();
    }

    /**
     * Delete router
     */
    public static function deleteRoutes($arrayId, $type)
    {
        foreach ($arrayId as $row) {
            self::where('entity_id', $row)
                ->where('type', $type)
                ->delete();
        }
    }
}