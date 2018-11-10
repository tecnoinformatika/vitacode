<?php

/* /home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/pages/cart.htm */
class __TwigTemplate_8011a3fe519767f2a412beff02bee217363c300f2881fff58d6ca32eb5db38e0 extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("Cart::cart"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/pages/cart.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% component 'Cart::cart' %}", "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/pages/cart.htm", "");
    }
}
