<?php

/* /home/ubuntu/workspace/themes/vitacode/partials/promo2.htm */
class __TwigTemplate_4aea36f4ec15e0dca8f23667d6cad51b0972ea8b14414a6e32239d209339dbaa extends Twig_Template
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
\t\t\t\t    <div class=\"homepage-promo desktop-12 mobile-3\">
\t\t\t\t\t\t<a href=\"#\">
\t\t\t\t\t\t  <img src=\"";
        // line 4
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/slider3.jpg");
        echo "\" alt=\"\">
\t\t\t\t\t\t  <div class=\"caption\">
\t\t\t\t\t\t    <h3></h3>
\t\t\t\t\t\t    <p></p>
\t\t\t\t\t\t  </div>\t\t\t
\t\t\t\t\t\t</a>
\t\t\t\t    </div>
\t\t\t\t  </article>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/vitacode/partials/promo2.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  28 => 4,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<article class=\"row\">
\t\t\t\t    <div class=\"homepage-promo desktop-12 mobile-3\">
\t\t\t\t\t\t<a href=\"#\">
\t\t\t\t\t\t  <img src=\"{{'assets/img/slider3.jpg' | theme}}\" alt=\"\">
\t\t\t\t\t\t  <div class=\"caption\">
\t\t\t\t\t\t    <h3></h3>
\t\t\t\t\t\t    <p></p>
\t\t\t\t\t\t  </div>\t\t\t
\t\t\t\t\t\t</a>
\t\t\t\t    </div>
\t\t\t\t  </article>", "/home/ubuntu/workspace/themes/vitacode/partials/promo2.htm", "");
    }
}
