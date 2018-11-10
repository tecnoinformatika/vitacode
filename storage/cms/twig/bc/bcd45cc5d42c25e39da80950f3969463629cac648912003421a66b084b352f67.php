<?php

/* /home/ubuntu/workspace/themes/vitacode/partials/header.htm */
class __TwigTemplate_12dc734e5569bf207e08327826aa0c2755469f3f8b514a6810a6a817a9e27d06 extends Twig_Template
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
        echo "<div id=\"header\" class=\"row\">\t
\t        <div id=\"search\" class=\"desktop-3 tablet-2 mobile-hide\">
\t          <form action=\"https://blendwatches.com/search\" method=\"get\">
\t            <i class=\"fa fa-search\"></i>
\t            <input type=\"text\" name=\"q\" id=\"q\" class=\"search-field\" placeholder=\"Buscar\" />
\t          </form>
\t        </div>

\t        <div id=\"logo\" class=\"desktop-6 tablet-2 mobile-3\">
\t          
\t          <a href=\"index.html\"><img src=\"";
        // line 11
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/img/logo-vitacode-400.png");
        echo "\" alt=\"Vitacode\" style=\"border: 0;\"/></a>
\t          
\t        </div> 

\t        <ul id=\"cart\" class=\"desktop-3 tablet-2 mobile-hide\">
\t          

\t          
\t          <li>
\t            <a href=\"account/login.html\">Mi cuenta</a>
\t          </li>
\t          
\t          
\t          
\t          <li>
\t            <a href=\"cart.html\">Mi cesta: (<span class=\"cart-count\">0</span>)</a>
\t          </li>
\t        </ul>   

      </div>  <!-- End Header -->";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/vitacode/partials/header.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  35 => 11,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div id=\"header\" class=\"row\">\t
\t        <div id=\"search\" class=\"desktop-3 tablet-2 mobile-hide\">
\t          <form action=\"https://blendwatches.com/search\" method=\"get\">
\t            <i class=\"fa fa-search\"></i>
\t            <input type=\"text\" name=\"q\" id=\"q\" class=\"search-field\" placeholder=\"Buscar\" />
\t          </form>
\t        </div>

\t        <div id=\"logo\" class=\"desktop-6 tablet-2 mobile-3\">
\t          
\t          <a href=\"index.html\"><img src=\"{{ 'assets/img/logo-vitacode-400.png' | theme }}\" alt=\"Vitacode\" style=\"border: 0;\"/></a>
\t          
\t        </div> 

\t        <ul id=\"cart\" class=\"desktop-3 tablet-2 mobile-hide\">
\t          

\t          
\t          <li>
\t            <a href=\"account/login.html\">Mi cuenta</a>
\t          </li>
\t          
\t          
\t          
\t          <li>
\t            <a href=\"cart.html\">Mi cesta: (<span class=\"cart-count\">0</span>)</a>
\t          </li>
\t        </ul>   

      </div>  <!-- End Header -->", "/home/ubuntu/workspace/themes/vitacode/partials/header.htm", "");
    }
}
