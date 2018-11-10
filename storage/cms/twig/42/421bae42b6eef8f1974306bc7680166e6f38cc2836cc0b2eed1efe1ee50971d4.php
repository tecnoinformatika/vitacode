<?php

/* /home/ubuntu/workspace/themes/martin-new-event/partials/template/detail.htm */
class __TwigTemplate_2ff14542f5fefdd54a340dc83fe16b7ebd392726635408461d15d1f7c22ee626 extends Twig_Template
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
        echo "<section id=\"detail\" class=\"parallax-section\">
    <div class=\"container\">
        <div class=\"row\">

            <div class=\"wow fadeInLeft col-md-4 col-sm-4\" data-wow-delay=\"0.3s\">
                <i class=\"fa ";
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "detail_box1_icon", array()), "html", null, true);
        echo "\"></i>
                <h3>";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "detail_box1_title", array()), "html", null, true);
        echo "</h3>
                <p>";
        // line 8
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "detail_box1_content", array()), "html", null, true);
        echo "</p>
            </div>

            <div class=\"wow fadeInUp col-md-4 col-sm-4\" data-wow-delay=\"0.6s\">
                <i class=\"fa ";
        // line 12
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "detail_box2_icon", array()), "html", null, true);
        echo "\"></i>
                <h3>";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "detail_box2_title", array()), "html", null, true);
        echo "</h3>
                <p>";
        // line 14
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "detail_box2_content", array()), "html", null, true);
        echo "</p>
            </div>

            <div class=\"wow fadeInRight col-md-4 col-sm-4\" data-wow-delay=\"0.9s\">
                <i class=\"fa ";
        // line 18
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "detail_box3_icon", array()), "html", null, true);
        echo "\"></i>
                <h3>";
        // line 19
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "detail_box3_title", array()), "html", null, true);
        echo "</h3>
                <p>";
        // line 20
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "detail_box3_content", array()), "html", null, true);
        echo "</p>
            </div>

        </div>
    </div>
</section>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/martin-new-event/partials/template/detail.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  68 => 20,  64 => 19,  60 => 18,  53 => 14,  49 => 13,  45 => 12,  38 => 8,  34 => 7,  30 => 6,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<section id=\"detail\" class=\"parallax-section\">
    <div class=\"container\">
        <div class=\"row\">

            <div class=\"wow fadeInLeft col-md-4 col-sm-4\" data-wow-delay=\"0.3s\">
                <i class=\"fa {{ this.theme.detail_box1_icon }}\"></i>
                <h3>{{ this.theme.detail_box1_title }}</h3>
                <p>{{ this.theme.detail_box1_content }}</p>
            </div>

            <div class=\"wow fadeInUp col-md-4 col-sm-4\" data-wow-delay=\"0.6s\">
                <i class=\"fa {{ this.theme.detail_box2_icon }}\"></i>
                <h3>{{ this.theme.detail_box2_title }}</h3>
                <p>{{ this.theme.detail_box2_content }}</p>
            </div>

            <div class=\"wow fadeInRight col-md-4 col-sm-4\" data-wow-delay=\"0.9s\">
                <i class=\"fa {{ this.theme.detail_box3_icon }}\"></i>
                <h3>{{ this.theme.detail_box3_title }}</h3>
                <p>{{ this.theme.detail_box3_content }}</p>
            </div>

        </div>
    </div>
</section>", "/home/ubuntu/workspace/themes/martin-new-event/partials/template/detail.htm", "");
    }
}
