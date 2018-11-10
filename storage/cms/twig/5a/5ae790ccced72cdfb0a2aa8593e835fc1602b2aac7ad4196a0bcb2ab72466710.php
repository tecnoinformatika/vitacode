<?php

/* /home/ubuntu/workspace/themes/martin-new-event/partials/template/overview.htm */
class __TwigTemplate_f6aca89acf6402d61fc9fc6cd64380915b10ac0ff1e91bbb83b0ae17a37a8fe2 extends Twig_Template
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
        echo "<section id=\"overview\" class=\"parallax-section\">
    <div class=\"container\">
        <div class=\"row\">

            <div class=\"wow fadeInUp col-md-6 col-sm-6\" data-wow-delay=\"0.6s\">
                <h3>";
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "overview_title", array()), "html", null, true);
        echo "</h3>
                <p>";
        // line 7
        echo nl2br(twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "overview_content", array()), "html", null, true));
        echo "</p>
            </div>

            <div class=\"wow fadeInUp col-md-6 col-sm-6\" data-wow-delay=\"0.9s\">
                <img src=\"";
        // line 11
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/overview-img.jpg");
        echo "\" class=\"img-responsive\" alt=\"Overview\">
            </div>

        </div>
    </div>
</section>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/martin-new-event/partials/template/overview.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  41 => 11,  34 => 7,  30 => 6,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<section id=\"overview\" class=\"parallax-section\">
    <div class=\"container\">
        <div class=\"row\">

            <div class=\"wow fadeInUp col-md-6 col-sm-6\" data-wow-delay=\"0.6s\">
                <h3>{{ this.theme.overview_title }}</h3>
                <p>{{ this.theme.overview_content|nl2br }}</p>
            </div>

            <div class=\"wow fadeInUp col-md-6 col-sm-6\" data-wow-delay=\"0.9s\">
                <img src=\"{{ 'assets/images/overview-img.jpg'|theme }}\" class=\"img-responsive\" alt=\"Overview\">
            </div>

        </div>
    </div>
</section>", "/home/ubuntu/workspace/themes/martin-new-event/partials/template/overview.htm", "");
    }
}
