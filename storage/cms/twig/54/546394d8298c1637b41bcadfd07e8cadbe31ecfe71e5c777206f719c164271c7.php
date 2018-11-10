<?php

/* /home/ubuntu/workspace/themes/vitacode/partials/promo.htm */
class __TwigTemplate_9cc44c4ede5e270b8915c00e49fa6e77505377f492ba9b918951f406f0899ec3 extends Twig_Template
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
\t\t\t\t\t    <div class=\"homepage-promo desktop-6 mobile-3\">
\t\t\t\t\t\t\t<a href=\"pages/accesoapersonalizador.html\">
\t\t\t\t\t\t\t  <img src=\"";
        // line 4
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/1403524954535757005_6b62a46de13c%20-%20copia%20-%20copia.jpg");
        echo "\" alt=\"vitacode\">
\t\t\t\t\t\t\t  <div class=\"caption\">
\t\t\t\t\t\t\t    <h3></h3>
\t\t\t\t\t\t\t    <p></p>
\t\t\t\t\t\t\t  </div>\t\t\t
\t\t\t\t\t\t\t</a>
\t\t\t\t\t    </div>
\t\t\t\t    \t<div class=\"homepage-promo desktop-6 mobile-3\">
\t\t\t\t\t\t\t<a href=\"collections/relojes.html\">
\t\t\t\t\t\t\t  <img src=\"";
        // line 13
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/IMG_2825.jpg");
        echo "\" alt=\"vitacode\">
\t\t\t\t\t\t\t  <div class=\"caption\">
\t\t\t\t\t\t\t    <h3></h3>
\t\t\t\t\t\t\t    <p></p>
\t\t\t\t\t\t\t  </div>\t\t\t
\t\t\t\t\t\t\t</a>
\t\t\t\t    \t</div>
\t\t\t\t            
\t\t\t\t  </article>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/vitacode/partials/promo.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  40 => 13,  28 => 4,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<article class=\"row\">
\t\t\t\t\t    <div class=\"homepage-promo desktop-6 mobile-3\">
\t\t\t\t\t\t\t<a href=\"pages/accesoapersonalizador.html\">
\t\t\t\t\t\t\t  <img src=\"{{ 'assets/img/1403524954535757005_6b62a46de13c%20-%20copia%20-%20copia.jpg' | theme }}\" alt=\"vitacode\">
\t\t\t\t\t\t\t  <div class=\"caption\">
\t\t\t\t\t\t\t    <h3></h3>
\t\t\t\t\t\t\t    <p></p>
\t\t\t\t\t\t\t  </div>\t\t\t
\t\t\t\t\t\t\t</a>
\t\t\t\t\t    </div>
\t\t\t\t    \t<div class=\"homepage-promo desktop-6 mobile-3\">
\t\t\t\t\t\t\t<a href=\"collections/relojes.html\">
\t\t\t\t\t\t\t  <img src=\"{{ 'assets/img/IMG_2825.jpg' |theme }}\" alt=\"vitacode\">
\t\t\t\t\t\t\t  <div class=\"caption\">
\t\t\t\t\t\t\t    <h3></h3>
\t\t\t\t\t\t\t    <p></p>
\t\t\t\t\t\t\t  </div>\t\t\t
\t\t\t\t\t\t\t</a>
\t\t\t\t    \t</div>
\t\t\t\t            
\t\t\t\t  </article>", "/home/ubuntu/workspace/themes/vitacode/partials/promo.htm", "");
    }
}
