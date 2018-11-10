<?php

/* /home/ubuntu/workspace/themes/vitacode/partials/slide.htm */
class __TwigTemplate_2dcf678da86d9649bc1bdbaf5999f6d85c5f5964ac58f3e366ed8af54b8eda7c extends Twig_Template
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
        echo "<div class=\"row\">
\t\t\t\t\t  \t<div class=\"desktop-12\">    
\t\t\t\t\t\t\t  <div class=\"flexslider\">
\t\t\t\t\t\t\t    <ul class=\"slides\">
\t\t\t\t\t\t\t      <li>
\t\t\t\t\t\t\t        <a href=\"pages/accesoapersonalizador.html\">
\t\t\t\t\t\t\t          <img src=\"";
        // line 7
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/IMG_2789%20(1).jpg");
        echo "\" alt=\"Slide 1 Alt Text\" />
\t\t\t\t\t\t\t        </a>
\t\t\t\t\t\t\t        <div class=\"flex-caption slide1\">
\t\t\t\t\t\t\t        </div>
\t\t\t\t\t\t\t      </li>
\t\t\t\t\t\t\t    </ul>
\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t  </div>
\t\t\t\t\t</div>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/vitacode/partials/slide.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  31 => 7,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"row\">
\t\t\t\t\t  \t<div class=\"desktop-12\">    
\t\t\t\t\t\t\t  <div class=\"flexslider\">
\t\t\t\t\t\t\t    <ul class=\"slides\">
\t\t\t\t\t\t\t      <li>
\t\t\t\t\t\t\t        <a href=\"pages/accesoapersonalizador.html\">
\t\t\t\t\t\t\t          <img src=\"{{ 'assets/img/IMG_2789%20(1).jpg' | theme }}\" alt=\"Slide 1 Alt Text\" />
\t\t\t\t\t\t\t        </a>
\t\t\t\t\t\t\t        <div class=\"flex-caption slide1\">
\t\t\t\t\t\t\t        </div>
\t\t\t\t\t\t\t      </li>
\t\t\t\t\t\t\t    </ul>
\t\t\t\t\t\t\t  </div>
\t\t\t\t\t\t  </div>
\t\t\t\t\t</div>", "/home/ubuntu/workspace/themes/vitacode/partials/slide.htm", "");
    }
}
