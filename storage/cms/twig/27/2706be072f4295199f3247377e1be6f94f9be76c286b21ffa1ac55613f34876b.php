<?php

/* /home/ubuntu/workspace/themes/martin-new-event/partials/template/navbar.htm */
class __TwigTemplate_eb6b47324d59f24cbed2329e9c84a9085180d048876522243dfff436276a7754 extends Twig_Template
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
        echo "<div class=\"navbar navbar-fixed-top custom-navbar\" role=\"navigation\">
    <div class=\"container\">

        <div class=\"navbar-header\">
            <button class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
                <span class=\"icon icon-bar\"></span>
                <span class=\"icon icon-bar\"></span>
                <span class=\"icon icon-bar\"></span>
            </button>
            <a href=\"#\" class=\"navbar-brand\">";
        // line 10
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "settings_brand", array()), "html", null, true);
        echo "</a>
        </div>

        <div class=\"collapse navbar-collapse\">
            <ul class=\"nav navbar-nav navbar-right\">
                <li><a href=\"#intro\"    class=\"smoothScroll\">Intro</a></li>
                ";
        // line 16
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "settings_overview", array())) {
            echo "<li><a href=\"#overview\" class=\"smoothScroll\">Overview</a></li>";
        }
        // line 17
        echo "                ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "settings_speakers", array())) {
            echo "<li><a href=\"#speakers\" class=\"smoothScroll\">Speakers</a></li>";
        }
        // line 18
        echo "                ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "settings_program", array())) {
            echo "<li><a href=\"#program\"  class=\"smoothScroll\">Programs</a></li>";
        }
        // line 19
        echo "                ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "settings_register", array())) {
            echo "<li><a href=\"#register\" class=\"smoothScroll\">Register</a></li>";
        }
        // line 20
        echo "                ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "settings_venue", array())) {
            echo "<li><a href=\"#venue\"    class=\"smoothScroll\">Venue</a></li>";
        }
        // line 21
        echo "                ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "settings_sponsors", array())) {
            echo "<li><a href=\"#sponsors\" class=\"smoothScroll\">Sponsors</a></li>";
        }
        // line 22
        echo "                ";
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "settings_contact", array())) {
            echo "<li><a href=\"#contact\"  class=\"smoothScroll\">Contact</a></li>";
        }
        // line 23
        echo "            </ul>
        </div>

    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/martin-new-event/partials/template/navbar.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  77 => 23,  72 => 22,  67 => 21,  62 => 20,  57 => 19,  52 => 18,  47 => 17,  43 => 16,  34 => 10,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"navbar navbar-fixed-top custom-navbar\" role=\"navigation\">
    <div class=\"container\">

        <div class=\"navbar-header\">
            <button class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\">
                <span class=\"icon icon-bar\"></span>
                <span class=\"icon icon-bar\"></span>
                <span class=\"icon icon-bar\"></span>
            </button>
            <a href=\"#\" class=\"navbar-brand\">{{ this.theme.settings_brand }}</a>
        </div>

        <div class=\"collapse navbar-collapse\">
            <ul class=\"nav navbar-nav navbar-right\">
                <li><a href=\"#intro\"    class=\"smoothScroll\">Intro</a></li>
                {% if this.theme.settings_overview  %}<li><a href=\"#overview\" class=\"smoothScroll\">Overview</a></li>{% endif %}
                {% if this.theme.settings_speakers  %}<li><a href=\"#speakers\" class=\"smoothScroll\">Speakers</a></li>{% endif %}
                {% if this.theme.settings_program   %}<li><a href=\"#program\"  class=\"smoothScroll\">Programs</a></li>{% endif %}
                {% if this.theme.settings_register  %}<li><a href=\"#register\" class=\"smoothScroll\">Register</a></li>{% endif %}
                {% if this.theme.settings_venue     %}<li><a href=\"#venue\"    class=\"smoothScroll\">Venue</a></li>{% endif %}
                {% if this.theme.settings_sponsors  %}<li><a href=\"#sponsors\" class=\"smoothScroll\">Sponsors</a></li>{% endif %}
                {% if this.theme.settings_contact   %}<li><a href=\"#contact\"  class=\"smoothScroll\">Contact</a></li>{% endif %}
            </ul>
        </div>

    </div>
</div>", "/home/ubuntu/workspace/themes/martin-new-event/partials/template/navbar.htm", "");
    }
}
