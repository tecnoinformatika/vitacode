<?php namespace Ideas\Shop\Models;

use October\Rain\Database\Model;
use \October\Rain\Database\Traits\Validation;
use Event;

class TaxClass extends Model
{
    public $table = 'ideas_tax_class';
    public $timestamps = false;//disable 'created_at' and 'updated_at'
    use Validation;

    public $rules = [
        'name' => 'required'
    ];

    public $hasMany = [
        'taxrule' => 'Ideas\Shop\Models\TaxRule', 'key'=>'id', 'otherKey' => 'tax_class_id'
    ];

    /**
     * Save tax class
     */
    public static function saveTaxClass($data)
    {
        $id = $data['id'];
        $model = new TaxClass();
        if ($id != 0) {//edit
            $model = self::find($id);
            TaxRule::where('tax_class_id', $id)->delete();
        }
        $model->name = $data['TaxClass']['name'];
        $model->description = $data['TaxClass']['description'];
        $model->save();
        if (!empty($data['tax_rate'])) {
            $taxClassId = $model->id;
            $taxRule = [];
            foreach ($data['tax_rate'] as $row) {
                $taxRule[] = [
                    'tax_class_id' => $taxClassId,
                    'tax_rate_id' => $row
                ];
            }
            TaxRule::insert($taxRule);
        }
        //event
        Event::fire('ideas.shop.save_tax_class', [$model, $data]);
        return $model;
    }



}