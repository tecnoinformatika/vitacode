<?php

namespace Ideas\Shop\Models;

use \October\Rain\Database\Traits\NestedTree;
use \October\Rain\Database\Model;
use \October\Rain\Database\Traits\Validation;
use Validator;
use ValidationException;
use Event;

class Category extends Model
{
    protected $table = 'ideas_categories';

    use NestedTree;
    use Validation;

    public $rules = [
        'name' => 'required'
    ];


    /**
     * Delete routes after delete category
     */
    public function afterDelete()
    {
        $checked = post('checked');
        Route::deleteRoutes($checked, Route::ROUTE_CATEGORY);
    }

    /**
     * Save routes for category to table #_routes
     */
    public function afterSave()
    {
        $categorySaved = $this->attributes;
        $post = post();
        $idEdit = $post['id'];
        $slug = $post['Category']['slug'];
        $entityId = $categorySaved['id'];
        $type = Route::ROUTE_CATEGORY;
        Route::saveRoutes($idEdit, $slug, $entityId, $type);
        Event::fire('ideas.shop.save_category', [$categorySaved, $post]);
    }

    /**
     * Get breadcrumb for category
     */
    public static function getBreadCrumb($id)
    {
        $model = self::find($id);
        $parents = $model->getParentsAndSelf();
        return $parents->toArray();
    }


}