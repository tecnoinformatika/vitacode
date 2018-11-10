<?php

/* /home/ubuntu/workspace/plugins/ideas/shop/components/theme/featured.htm */
class __TwigTemplate_ac3b7f1ed65fd76d517d21dbd3bbc2fe8570e59ed43f3ddcd40886bd605b766b extends Twig_Template
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
        echo "<article class=\"row\">  
\t<h2 class=\"section-title clearfix desktop-12\">Los más vendidos!</h2>
\t    <div id=\"product-loop\">
            ";
        // line 4
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["featured"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 5
            echo "             <div class=\"product-index desktop-4 tablet-half mobile-half\">     
                <div class=\"product-index-inner\">
        \t\t    <a href=\"";
            // line 7
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product"], "slug", array()), "html", null, true);
            echo "\" title=\"Mad Gorilla\">
        \t\t        ";
            // line 8
            if (twig_test_empty(twig_get_attribute($this->env, $this->source, $context["product"], "featured_image", array()))) {
                // line 9
                echo "        \t\t         <img class=\"img1\" src=\"";
                echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/no_image.jpeg");
                echo "\" alt=\"vitacode\"/>
        \t\t        ";
            } else {
                // line 11
                echo "        \t\t\t\t<img class=\"img1\" src=\"";
                echo call_user_func_array($this->env->getFilter('noImage')->getCallable(), array($this->extensions['System\Twig\Extension']->mediaFilter(twig_get_attribute($this->env, $this->source, $context["product"], "featured_image", array()))));
                echo "\" alt=\"vitacode\" />
        \t\t\t\t";
            }
            // line 13
            echo "        \t\t\t</a>       
        \t\t</div> 
        \t\t<div class=\"product-info\"> 
                    <div class=\"product-info-inner\">
        \t\t\t\t<a href=\"";
            // line 17
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product"], "slug", array()), "html", null, true);
            echo "\"> 
        \t\t\t        <h3>";
            // line 18
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product"], "name", array()), "html", null, true);
            echo "</h3>
        \t\t\t\t</a>        
                        <div class=\"price\">
        \t\t\t\t\t<div class=\"prod-price\"> ";
            // line 21
            echo call_user_func_array($this->env->getFilter('displayPriceAndCurrency')->getCallable(), array(twig_get_attribute($this->env, $this->source, $context["product"], "price", array())));
            echo "</div>
        \t\t\t\t</div>
        \t\t\t</div>
                   
                </div>
            </div>
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 28
        echo "        </div>
</article>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/plugins/ideas/shop/components/theme/featured.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  83 => 28,  70 => 21,  64 => 18,  60 => 17,  54 => 13,  48 => 11,  42 => 9,  40 => 8,  36 => 7,  32 => 5,  28 => 4,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<article class=\"row\">  
\t<h2 class=\"section-title clearfix desktop-12\">Los más vendidos!</h2>
\t    <div id=\"product-loop\">
            {% for product in featured %}
             <div class=\"product-index desktop-4 tablet-half mobile-half\">     
                <div class=\"product-index-inner\">
        \t\t    <a href=\"{{product.slug}}\" title=\"Mad Gorilla\">
        \t\t        {% if product.featured_image is empty %}
        \t\t         <img class=\"img1\" src=\"{{ 'assets/images/no_image.jpeg' | theme }}\" alt=\"vitacode\"/>
        \t\t        {% else %}
        \t\t\t\t<img class=\"img1\" src=\"{{ product.featured_image | media |noImage  }}\" alt=\"vitacode\" />
        \t\t\t\t{% endif %}
        \t\t\t</a>       
        \t\t</div> 
        \t\t<div class=\"product-info\"> 
                    <div class=\"product-info-inner\">
        \t\t\t\t<a href=\"{{product.slug}}\"> 
        \t\t\t        <h3>{{product.name}}</h3>
        \t\t\t\t</a>        
                        <div class=\"price\">
        \t\t\t\t\t<div class=\"prod-price\"> {{product.price | displayPriceAndCurrency}}</div>
        \t\t\t\t</div>
        \t\t\t</div>
                   
                </div>
            </div>
            {% endfor %}
        </div>
</article>", "/home/ubuntu/workspace/plugins/ideas/shop/components/theme/featured.htm", "");
    }
}
