<?php

/* /home/ubuntu/workspace/themes/vitacode/pages/inicio.htm */
class __TwigTemplate_909ba16927c996dc63f2bbd492a126230519d5fbec16c6978670aa2b1d48390e extends Twig_Template
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
        echo "<section class=\"homepage-section\">
\t\t\t\t  ";
        // line 2
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("slide"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 3
        echo "\t\t\t\t</section>
\t\t\t\t<div class=\"clear\"></div>
\t\t\t     
\t\t\t\t<section class=\"homepage-section\">
\t\t\t\t ";
        // line 7
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("promo"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 8
        echo "\t\t\t\t</section>

\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t<section class=\"homepage-section\">
\t\t\t        ";
        // line 12
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("Theme::featured"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 13
        echo "\t\t\t\t</section>
\t\t\t\t<div class=\"clear\"></div>



\t\t\t  


\t\t\t 
\t\t\t   
\t\t\t      
\t\t\t\t<section class=\"homepage-section\">
\t\t\t\t ";
        // line 25
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("promo2"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 26
        echo "\t\t\t\t</section>

\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t<div class=\"clear\"></div>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/vitacode/pages/inicio.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 26,  64 => 25,  50 => 13,  46 => 12,  40 => 8,  36 => 7,  30 => 3,  26 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<section class=\"homepage-section\">
\t\t\t\t  {% partial 'slide' %}
\t\t\t\t</section>
\t\t\t\t<div class=\"clear\"></div>
\t\t\t     
\t\t\t\t<section class=\"homepage-section\">
\t\t\t\t {% partial 'promo' %}
\t\t\t\t</section>

\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t<section class=\"homepage-section\">
\t\t\t        {% component 'Theme::featured' %}
\t\t\t\t</section>
\t\t\t\t<div class=\"clear\"></div>



\t\t\t  


\t\t\t 
\t\t\t   
\t\t\t      
\t\t\t\t<section class=\"homepage-section\">
\t\t\t\t {% partial 'promo2' %}
\t\t\t\t</section>

\t\t\t\t<div class=\"clear\"></div>
\t\t\t\t<div class=\"clear\"></div>", "/home/ubuntu/workspace/themes/vitacode/pages/inicio.htm", "");
    }
}
