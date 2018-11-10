<?php

/* /home/ubuntu/workspace/plugins/ideas/shop/components/cart/cart.htm */
class __TwigTemplate_a9a64f8469e2b6cc18208797efbee530f47f608726ce4388eb742343bcf42b06 extends Twig_Template
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
        echo "<div class=\"category-top\">
    <img class=\"img-responsive\" src=\"";
        // line 2
        echo $this->extensions['System\Twig\Extension']->mediaFilter(($context["image_header_bottom"] ?? null));
        echo "\" />
</div>
<div class=\"container\" id=\"breadcrumb-div\">
    <div class=\"row\">
        <ul class=\"breadcrumb\">
            <li><a href=\"#\">";
        // line 7
        echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.component.home"));
        echo "</a></li>
            <li><a href=\"#\">";
        // line 8
        echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.component.cart"));
        echo "</a></li>
        </ul>
    </div>
</div>
<div class=\"container\" id=\"cart-div\">

</div>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/plugins/ideas/shop/components/cart/cart.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 8,  34 => 7,  26 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"category-top\">
    <img class=\"img-responsive\" src=\"{{image_header_bottom | media}}\" />
</div>
<div class=\"container\" id=\"breadcrumb-div\">
    <div class=\"row\">
        <ul class=\"breadcrumb\">
            <li><a href=\"#\">{{ 'ideas.shop::lang.component.home' | trans }}</a></li>
            <li><a href=\"#\">{{ 'ideas.shop::lang.component.cart' | trans }}</a></li>
        </ul>
    </div>
</div>
<div class=\"container\" id=\"cart-div\">

</div>", "/home/ubuntu/workspace/plugins/ideas/shop/components/cart/cart.htm", "");
    }
}
