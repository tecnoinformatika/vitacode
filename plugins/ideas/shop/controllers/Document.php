<?php

namespace Ideas\Shop\Controllers;

use Backend;

class Document extends IdeasShopController
{
    public $requiredPermissions = ['ideas.shop.access_document'];
    public $controllerName = 'document';

    public function onUpdateDocument()
    {
        $post = post('checked');
        $idUpdate = $post[0];
        $url = Backend::url('ideas/shop/document/update/'.$idUpdate);
        return redirect($url);
    }

    public function view($id)
    {
        $this->vars['controller'] = $this->controllerName;
        $this->vars['document'] = \Ideas\Shop\Models\Document::getDocument($id);
    }
}
