<?php

/* /home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/ship_slide.htm */
class __TwigTemplate_689cfba8f256f31b3190cadbda558290692ea773a4dba706255b0371bb5bb4c5 extends Twig_Template
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
        echo "<div class=\"row\" id=\"ship-return\" >
    ";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["ship_slide"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
            // line 3
            echo "    <div class=\"col-md-4 text-center\">
        <div class=\"ship-return-image\"><img src=\"/storage/app/media/";
            // line 4
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["image"], "image", array()), "html", null, true);
            echo "\" /> </div>
        <div class=\"ship-return-title\">";
            // line 5
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["image"], "title", array()), "html", null, true);
            echo "</div>
        <div class=\"ship-return-content\">
            ";
            // line 7
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["image"], "description", array()), "html", null, true);
            echo "
        </div>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 11
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/ship_slide.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 11,  42 => 7,  37 => 5,  33 => 4,  30 => 3,  26 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"row\" id=\"ship-return\" >
    {% for image in ship_slide %}
    <div class=\"col-md-4 text-center\">
        <div class=\"ship-return-image\"><img src=\"/storage/app/media/{{image.image}}\" /> </div>
        <div class=\"ship-return-title\">{{image.title}}</div>
        <div class=\"ship-return-content\">
            {{image.description}}
        </div>
    </div>
    {% endfor %}
</div>", "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/ship_slide.htm", "");
    }
}
