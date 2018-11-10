<?php

/* /home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/site/footer.htm */
class __TwigTemplate_9fee2d43ed2491ad95e0c9d1e6d505841c9aae8f53b69674eec6850eb9ca9a15 extends Twig_Template
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
        echo "<footer class=\"container bg-negro gris pb-5\">
\t\t<div class=\"row\" style=\"margin-left: 25px;\">
\t\t\t<div class=\"col-md-4 offset-md-1 col-xs-12\">
\t\t\t\t<img src=\"";
        // line 4
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/logo-vitacode-250.png");
        echo "\" class=\"img-fluid\">
\t\t\t\t<p class=\"small blanco mt-4\">Con el apoyo de:</p>
\t\t\t\t<a href=\"https://www.asech.cl/\" target=\"_BLANK\"><img src=\"";
        // line 6
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/asech.png");
        echo "\" class=\"img-fluid mb-4\" style=\"max-width: 180px;\"></a>
\t\t\t\t<br>
\t\t\t\t<a href=\"quienes.html\">¿Quiénes somos?</a><br>
\t\t\t\t<a href=\"";
        // line 9
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("content/TERMINOS_Y_CONDICIONES_VITACODE.pdf");
        echo "\" target=\"_BLANK\">Términos y condiciones</a><br>
\t\t\t\t<a href=\"faq.html\">Preguntas frecuentes</a><br>\t
\t\t\t</div>
\t\t\t<div class=\"col-md-3 col-xs-12 pt-5\" >
\t\t\t\t<div class=\"row mb-3\" style=\"display: flex;\">
\t\t\t\t\t<div class=\"col-1\" style=\"flex: 0 0 8.333333%;    max-width: 8.333333%;\">
\t\t\t\t\t\t<i class=\"fa fa-map-marker rojo\"></i>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-10\">
\t\t\t\t\t\t<a href=\"https://www.google.co.ve/maps/place/Brown+Nte+100,+%C3%91u%C3%B1oa,+Regi%C3%B3n+Metropolitana,+Chile/@-33.4540772,-70.5941005,17z/data=!3m1!4b1!4m5!3m4!1s0x9662cfb934f4e3a9:0xc27857d432d880e4!8m2!3d-33.4540772!4d-70.5919118\" target=\"_BLANK\">
\t\t\t\t\t\t\tBrown Norte número 100,<br>
\t\t\t\t\t\tComuna de Ñuñoa, Santiago, Chile.</a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"row mb-3\" style=\"display: flex;\">
\t\t\t\t\t<div class=\"col-1\" style=\"flex: 0 0 8.333333%;    max-width: 8.333333%;\">
\t\t\t\t\t\t<i class=\"fa fa-phone rojo\"></i>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-10\">
\t\t\t\t\t\t<a href=\"tel:+56225129465\">(56 2) 2512 9465</a><br>
\t\t\t\t\t\t<a href=\"tel:+56956712201\">(56 9) 5671 2201</a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"row mb-3\" style=\"display: flex;\">
\t\t\t\t\t<div class=\"col-1\" style=\"flex: 0 0 8.333333%;    max-width: 8.333333%;\">
\t\t\t\t\t\t<i class=\"fa fa-envelope rojo\"></i>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-10\">
\t\t\t\t\t\t<a href=\"mailto:contacto@vitacode.cl\">contacto@vitacode.cl</a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col-md-3 col-xs-12 align-self-end text-right social-icons\" style=\"text-align: center;\">

\t\t\t\t<a href=\"#\"><i class=\"fa fa-facebook\"></i></a>
\t\t\t\t<a href=\"#\"><i class=\"fa fa-twitter\"></i></a>
\t\t\t\t<a href=\"#\"><i class=\"fa fa-instagram\"></i></a>
\t\t\t\t<a href=\"#\"><i class=\"fa fa-pinterest\"></i></a>

\t\t\t</div>
\t\t</div>
\t\t\t<br>
\t<br>
\t</footer>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/site/footer.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 9,  33 => 6,  28 => 4,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<footer class=\"container bg-negro gris pb-5\">
\t\t<div class=\"row\" style=\"margin-left: 25px;\">
\t\t\t<div class=\"col-md-4 offset-md-1 col-xs-12\">
\t\t\t\t<img src=\"{{ 'assets/images/logo-vitacode-250.png' | theme }}\" class=\"img-fluid\">
\t\t\t\t<p class=\"small blanco mt-4\">Con el apoyo de:</p>
\t\t\t\t<a href=\"https://www.asech.cl/\" target=\"_BLANK\"><img src=\"{{ 'assets/images/asech.png' | theme }}\" class=\"img-fluid mb-4\" style=\"max-width: 180px;\"></a>
\t\t\t\t<br>
\t\t\t\t<a href=\"quienes.html\">¿Quiénes somos?</a><br>
\t\t\t\t<a href=\"{{ 'content/TERMINOS_Y_CONDICIONES_VITACODE.pdf' | theme }}\" target=\"_BLANK\">Términos y condiciones</a><br>
\t\t\t\t<a href=\"faq.html\">Preguntas frecuentes</a><br>\t
\t\t\t</div>
\t\t\t<div class=\"col-md-3 col-xs-12 pt-5\" >
\t\t\t\t<div class=\"row mb-3\" style=\"display: flex;\">
\t\t\t\t\t<div class=\"col-1\" style=\"flex: 0 0 8.333333%;    max-width: 8.333333%;\">
\t\t\t\t\t\t<i class=\"fa fa-map-marker rojo\"></i>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-10\">
\t\t\t\t\t\t<a href=\"https://www.google.co.ve/maps/place/Brown+Nte+100,+%C3%91u%C3%B1oa,+Regi%C3%B3n+Metropolitana,+Chile/@-33.4540772,-70.5941005,17z/data=!3m1!4b1!4m5!3m4!1s0x9662cfb934f4e3a9:0xc27857d432d880e4!8m2!3d-33.4540772!4d-70.5919118\" target=\"_BLANK\">
\t\t\t\t\t\t\tBrown Norte número 100,<br>
\t\t\t\t\t\tComuna de Ñuñoa, Santiago, Chile.</a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"row mb-3\" style=\"display: flex;\">
\t\t\t\t\t<div class=\"col-1\" style=\"flex: 0 0 8.333333%;    max-width: 8.333333%;\">
\t\t\t\t\t\t<i class=\"fa fa-phone rojo\"></i>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-10\">
\t\t\t\t\t\t<a href=\"tel:+56225129465\">(56 2) 2512 9465</a><br>
\t\t\t\t\t\t<a href=\"tel:+56956712201\">(56 9) 5671 2201</a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t\t<div class=\"row mb-3\" style=\"display: flex;\">
\t\t\t\t\t<div class=\"col-1\" style=\"flex: 0 0 8.333333%;    max-width: 8.333333%;\">
\t\t\t\t\t\t<i class=\"fa fa-envelope rojo\"></i>
\t\t\t\t\t</div>
\t\t\t\t\t<div class=\"col-10\">
\t\t\t\t\t\t<a href=\"mailto:contacto@vitacode.cl\">contacto@vitacode.cl</a>
\t\t\t\t\t</div>
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"col-md-3 col-xs-12 align-self-end text-right social-icons\" style=\"text-align: center;\">

\t\t\t\t<a href=\"#\"><i class=\"fa fa-facebook\"></i></a>
\t\t\t\t<a href=\"#\"><i class=\"fa fa-twitter\"></i></a>
\t\t\t\t<a href=\"#\"><i class=\"fa fa-instagram\"></i></a>
\t\t\t\t<a href=\"#\"><i class=\"fa fa-pinterest\"></i></a>

\t\t\t</div>
\t\t</div>
\t\t\t<br>
\t<br>
\t</footer>", "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/site/footer.htm", "");
    }
}
