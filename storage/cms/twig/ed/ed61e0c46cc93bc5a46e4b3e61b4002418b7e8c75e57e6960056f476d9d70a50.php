<?php

/* /home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/site/testimonials.htm */
class __TwigTemplate_a04c6a334896b406f9eb6e5963f5c14af8d2252e25afab5de3510fe7361ed624 extends Twig_Template
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
        echo "<div class=\"owl-carousel owl-theme\">
    ";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["testimonials"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
            // line 3
            echo "    <div class=\"item\">
         
        <div class=\"user-pic text-center\">
            <img src=\"/storage/app/media/";
            // line 6
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["image"], "image", array()), "html", null, true);
            echo "\" />
        </div>
        <p class=\"user-comment text-center\">
            ";
            // line 9
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["image"], "description", array()), "html", null, true);
            echo "
        </p>
        <div class=\"user-name text-center\">
            ";
            // line 12
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["image"], "title", array()), "html", null, true);
            echo "
        </div>
    </div>
    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 16
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/site/testimonials.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  57 => 16,  47 => 12,  41 => 9,  35 => 6,  30 => 3,  26 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"owl-carousel owl-theme\">
    {% for image in testimonials %}
    <div class=\"item\">
         
        <div class=\"user-pic text-center\">
            <img src=\"/storage/app/media/{{image.image}}\" />
        </div>
        <p class=\"user-comment text-center\">
            {{image.description}}
        </p>
        <div class=\"user-name text-center\">
            {{image.title}}
        </div>
    </div>
    {% endfor %}
</div>", "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/site/testimonials.htm", "");
    }
}
