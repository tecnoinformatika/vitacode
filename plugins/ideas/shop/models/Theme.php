<?php

namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use October\Rain\Database\Traits\Validation;
use Event;

class Theme extends Model
{
    use Validation;

    protected $table = 'ideas_theme_config';
    public $timestamps = false;//disable 'created_at' and 'updated_at'

    const TYPE_TEXT = 1;
    const TYPE_IMAGE = 2;

    public $rules = [
        'name' => 'required',
        'slug' => 'required|unique:ideas_theme_config'
    ];

    /**
     * Has many images
     */
    public function image()
    {
        return $this->hasMany('Ideas\Shop\Models\ThemeConfigImageDetail', 'theme_config_id', 'id');
    }

    /**
     * Has one text value
     */
    public function text()
    {
        return $this->hasOne('Ideas\Shop\Models\ThemeConfigTextValue', 'theme_config_id', 'id');
    }

    /**
     * return array type
     */
    public static function arrayThemeType()
    {
        return [
            self::TYPE_TEXT => trans('ideas.shop::lang.theme.text'),
            self::TYPE_IMAGE => trans('ideas.shop::lang.theme.image')
        ];
    }

    /**
     * Type option
     */
    public static function getTypeOptions()
    {
        return self::arrayThemeType();
    }

    /**
     * Save text value
     */
    public static function saveTextValue($id, $idSaved, $post)
    {
        $value = $post['value'];
        $data = ['value'=>$value, 'theme_config_id'=>$idSaved];
        if ($id == 0) {//create
            ThemeConfigTextValue::insert($data);
        } else {
            ThemeConfigTextValue::where('theme_config_id', $id)->update(['value'=>$value]);
        }
    }

    public static function imageDataAssign($post, $i, $idSaved)
    {
        return [
            'name' => $post['name'][$i],
            'url' => $post['url'][$i],
            'link' => $post['link'][$i],
            'title' => $post['title'][$i],
            'alt' => $post['alt'][$i],
            'image_order' => $post['image_order'][$i],
            'description' => $post['description'][$i],
            'theme_config_id' => $idSaved,
        ];
    }

    public static function updateImage($idSaved, $post)
    {

        $idOldUpdate = $post['id_old_update'];
        $idOldUpdateArray = explode(',', $idOldUpdate);
        $idUpdate = $post['id_update'];
        $arrayDiffToDelete = array_diff($idOldUpdateArray, $idUpdate);

        if (!empty($arrayDiffToDelete)) {
            foreach ($arrayDiffToDelete as $row) {
                ThemeConfigImageDetail::where('id', $row)->delete();
            }
        }
        for ($i=0; $i<count($post['name']); $i++) {
            $data = self::imageDataAssign($post, $i, $idSaved);
            if ($post['id_update'][$i] != 0) {//update
                //var_dump($data);die;
                ThemeConfigImageDetail::where('id', $post['id_update'][$i])->update($data);
            } else {
                ThemeConfigImageDetail::insert($data);
            }
        }
    }

    /**
     * Save image
     */
    public static function saveImages($id, $idSaved, $post)
    {
        $data = [];
        for ($i=0; $i<count($post['name']); $i++) {
            $data[] = self::imageDataAssign($post, $i, $idSaved);
        }
        if ($id == 0) {//create
            ThemeConfigImageDetail::insert($data);
        } else {
            self::updateImage($idSaved, $post);
        }
    }

    /**
     * Save value_json
     */
    public function afterSave()
    {
        $post = post();
        $id = $post['id'];//to know create or update
        $saved = $this->attributes;//row saved
        $type = $post['Theme']['type'];
        $idSaved = $saved['id'];
        if ($type == self::TYPE_TEXT) {
            self::saveTextValue($id, $idSaved, $post);
        } else {
            self::saveImages($id, $idSaved, $post);
        }
        Event::fire('ideas.shop.save_theme', [$saved, $post]);
    }

    /**
     * Get text value
     */
    public static function getThemeTextValue($id)
    {
        $data = ThemeConfigTextValue::where('theme_config_id', $id)->first();
        return $data;
    }

    /**
     * Get image
     */
    public static function getThemeImage($id)
    {
        $data = ThemeConfigImageDetail::where('theme_config_id', $id)->orderBy('image_order', 'asc')->get();
        return $data;
    }

    /**
     * Get theme image
     */
    public static function getThemeImagesBySlug($slug)
    {
        $data = self::where('slug', $slug)->with(['image:*'])->get();
        $image = [];
        foreach ($data as $row) {
            foreach ($row->image as $img) {
                $image[] = $img->url;
            }
        }
        return $image;
    }

}