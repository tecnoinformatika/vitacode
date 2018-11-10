<?php

/* /home/ubuntu/workspace/themes/martin-new-event/partials/template/intro.htm */
class __TwigTemplate_fad109ba94c5c10add11e96390a7efe43de36dc1ba6b97e2aa31535602b1e976 extends Twig_Template
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
        echo "<section id=\"intro\" class=\"parallax-section\">
    <div class=\"container\">
        <div class=\"row\">

            <div class=\"col-md-12 col-sm-12\">
                <h3 class=\"wow bounceIn\" data-wow-delay=\"0.9s\">";
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "intro_line1", array()), "html", null, true);
        echo "</h3>
                <h1 class=\"wow fadeInUp\" data-wow-delay=\"1.6s\">";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "intro_line2", array()), "html", null, true);
        echo "</h1>
                <a href=\"#overview\" class=\"btn btn-lg btn-default smoothScroll wow fadeInUp hidden-xs\" data-wow-delay=\"2.3s\">LEARN MORE</a>
                <a href=\"#register\" class=\"btn btn-lg btn-danger smoothScroll wow fadeInUp\" data-wow-delay=\"2.3s\">REGISTER NOW</a>
            </div>

        </div>
    </div>
</section>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/martin-new-event/partials/template/intro.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  34 => 7,  30 => 6,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<section id=\"intro\" class=\"parallax-section\">
    <div class=\"container\">
        <div class=\"row\">

            <div class=\"col-md-12 col-sm-12\">
                <h3 class=\"wow bounceIn\" data-wow-delay=\"0.9s\">{{ this.theme.intro_line1 }}</h3>
                <h1 class=\"wow fadeInUp\" data-wow-delay=\"1.6s\">{{ this.theme.intro_line2 }}</h1>
                <a href=\"#overview\" class=\"btn btn-lg btn-default smoothScroll wow fadeInUp hidden-xs\" data-wow-delay=\"2.3s\">LEARN MORE</a>
                <a href=\"#register\" class=\"btn btn-lg btn-danger smoothScroll wow fadeInUp\" data-wow-delay=\"2.3s\">REGISTER NOW</a>
            </div>

        </div>
    </div>
</section>", "/home/ubuntu/workspace/themes/martin-new-event/partials/template/intro.htm", "");
    }
}
