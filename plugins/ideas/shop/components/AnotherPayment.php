<?php namespace Ideas\Shop\Components;

use Cms\Classes\ComponentBase;

class AnotherPayment extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'Another payment example',
            'description' => 'Another payment example for check out'
        ];
    }

    public function onRun()
    {
        $this->addJs('/plugins/ideas/shop/assets/components/js/another_payment.js');
    }
}