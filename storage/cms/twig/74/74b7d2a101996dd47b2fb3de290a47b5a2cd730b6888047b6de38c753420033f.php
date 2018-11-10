<?php

/* /home/ubuntu/workspace/themes/vitacode/partials/mobile-header.htm */
class __TwigTemplate_0083cabf24b0a901d1846a65b592d0987f31215e054781782bd9950f85347423 extends Twig_Template
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
        echo "<div id=\"mobile-header\">
    <div class=\"row\">
      <ul id=\"mobile-menu\" class=\"mobile-3\">
        
        
        <li>
          <a href=\"account/login.html\"><i class=\"fa fa-user\"></i></a>
        </li>
        
                
        <li>
          <a href=\"cart.html\"><i class=\"fa fa-shopping-cart\"></i> <span class=\"cart-count\">0</span></a>
        </li>
        <li>
          <span class=\"shifter-handle\">Menu</span>
        </li>
      </ul>     
    </div>
  </div>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/vitacode/partials/mobile-header.htm";
    }

    public function getDebugInfo()
    {
        return array (  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div id=\"mobile-header\">
    <div class=\"row\">
      <ul id=\"mobile-menu\" class=\"mobile-3\">
        
        
        <li>
          <a href=\"account/login.html\"><i class=\"fa fa-user\"></i></a>
        </li>
        
                
        <li>
          <a href=\"cart.html\"><i class=\"fa fa-shopping-cart\"></i> <span class=\"cart-count\">0</span></a>
        </li>
        <li>
          <span class=\"shifter-handle\">Menu</span>
        </li>
      </ul>     
    </div>
  </div>", "/home/ubuntu/workspace/themes/vitacode/partials/mobile-header.htm", "");
    }
}
