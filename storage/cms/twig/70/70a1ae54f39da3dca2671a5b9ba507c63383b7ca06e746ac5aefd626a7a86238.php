<?php

/* /home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/pages/product.htm */
class __TwigTemplate_c96c55bd6ed04f333c2d7ea79432a3c69a140c04a499935b3a2ac4d52b0a9d6c extends Twig_Template
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
        if ((($context["type"] ?? null) == ($context["type_category"] ?? null))) {
            // line 2
            echo "    ";
            $context['__cms_component_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("Product::category"            , $context['__cms_component_params']            );
            unset($context['__cms_component_params']);
            // line 3
            echo "    ";
            echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'            );
            // line 4
            echo "    <script type=\"text/javascript\" src=\"/plugins/ideas/shop/assets/components/js/category.js\"></script>
    ";
            // line 3
            echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true            );
        } else {
            // line 7
            echo "    ";
            $context['__cms_component_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("Product::detail"            , $context['__cms_component_params']            );
            unset($context['__cms_component_params']);
            // line 8
            echo "    ";
            echo $this->env->getExtension('Cms\Twig\Extension')->startBlock('scripts'            );
            // line 9
            echo "    <script type=\"text/javascript\" src=\"/plugins/ideas/shop/assets/components/js/productDetail.js\"></script>
    ";
            // line 8
            echo $this->env->getExtension('Cms\Twig\Extension')->endBlock(true            );
        }
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/pages/product.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 8,  47 => 9,  44 => 8,  39 => 7,  36 => 3,  33 => 4,  30 => 3,  25 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% if (type == type_category) %}
    {% component 'Product::category' %}
    {% put scripts %}
    <script type=\"text/javascript\" src=\"/plugins/ideas/shop/assets/components/js/category.js\"></script>
    {% endput %}
{% else %}
    {% component 'Product::detail' %}
    {% put scripts %}
    <script type=\"text/javascript\" src=\"/plugins/ideas/shop/assets/components/js/productDetail.js\"></script>
    {% endput %}
{% endif %}", "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/pages/product.htm", "");
    }
}
