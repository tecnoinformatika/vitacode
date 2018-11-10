<?php

/* /home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/pages/home.htm */
class __TwigTemplate_53a6894974ba254df81950be2d9f2a0a1ab1253a27e691b7681fa80da1d97e54 extends Twig_Template
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
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("Theme::gallery"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 2
        echo "<div class=\"container\" style=\"margin-top:50px\" id=\"content\">
    ";
        // line 3
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("banner"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 4
        echo "    ";
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("Theme::featured"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 5
        echo "
    ";
        // line 6
        if ( !twig_test_empty(($context["category"] ?? null))) {
            // line 7
            echo "        ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["category"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["c"]) {
                // line 8
                echo "            ";
                $context['__cms_partial_params'] = [];
                $context['__cms_partial_params']['id'] = twig_get_attribute($this->env, $this->source, $context["c"], "id", array())                ;
                $context['__cms_partial_params']['maxItems'] = twig_get_attribute($this->env, $this->source, $context["c"], "num_display", array())                ;
                echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/category"                , $context['__cms_partial_params']                , true                );
                unset($context['__cms_partial_params']);
                // line 9
                echo "        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['c'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 10
            echo "    ";
        }
        // line 11
        echo "</div>
";
        // line 12
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/testimonials"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 13
        echo "
<div class=\"container\" style=\"background-color: #ececec;\">
    
        <div class=\"hr-class\"></div>
    ";
        // line 17
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("ship_slide"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        echo "  
    
 

    
</div>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/pages/home.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  78 => 17,  72 => 13,  68 => 12,  65 => 11,  62 => 10,  56 => 9,  49 => 8,  44 => 7,  42 => 6,  39 => 5,  34 => 4,  30 => 3,  27 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% component 'Theme::gallery' %}
<div class=\"container\" style=\"margin-top:50px\" id=\"content\">
    {% partial 'banner' %}
    {% component 'Theme::featured' %}

    {% if  category is not empty %}
        {% for c in category %}
            {% partial 'site/category' id=c.id maxItems=c.num_display  %}
        {% endfor %}
    {% endif %}
</div>
{% partial 'site/testimonials' %}

<div class=\"container\" style=\"background-color: #ececec;\">
    
        <div class=\"hr-class\"></div>
    {% partial 'ship_slide' %}  
    
 

    
</div>", "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/pages/home.htm", "");
    }
}
