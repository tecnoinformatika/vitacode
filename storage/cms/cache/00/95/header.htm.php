<?php 
class Cms5bbebc0fdfd75477469132_c685be3743523a84a073bf65e0be80f7Class extends Cms\Classes\PartialCode
{
public function onStart()
{

   $this['categorias'] = \Ideas\Shop\Models\Category::orderBy('created_at', 'desc')->get();
}
}
