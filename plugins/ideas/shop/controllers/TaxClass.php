<?php

namespace Ideas\Shop\Controllers;

use BackendMenu;
use Flash;
use Backend;
use Ideas\Shop\Models\TaxRule;
use Illuminate\Support\Facades\DB;

class TaxClass extends IdeasShopController
{
    public $requiredPermissions = ['ideas.shop.access_tax_class'];
    public $controllerName = 'taxclass';

    /**
     * Save tax class
     */
    public function create_onSave()
    {
        $data = post();
        DB::beginTransaction();
        try {
            $rs = \Ideas\Shop\Models\TaxClass::saveTaxClass($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json('Can not create data');
        }
        Flash::success("You've just created tax class");
        $url = Backend::url('ideas/shop/taxclass/index');
        return redirect($url);
    }

    /**
     * Update tax class
     */
    public function update_onSave()
    {
        $data = post();
        try {
            $rs = \Ideas\Shop\Models\TaxClass::saveTaxClass($data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json('Can not create data');
        }
        Flash::success("You've just updated tax class");
        $url = Backend::url('ideas/shop/taxclass/index');
        return redirect($url);
    }


}
