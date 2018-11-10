<?php

/* /home/ubuntu/workspace/plugins/ideas/shop/components/theme/gallery.htm */
class __TwigTemplate_0ab0ca1695884895391c2cd267ca2f5a1bf58434ed1144dd664d2cab288e00a5 extends Twig_Template
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
        echo "<div class=\"owl-carousel owl-theme\" id=\"owl-carousel\">
    ";
        // line 2
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["galleries"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["gallery"]) {
            // line 3
            echo "    ";
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, $context["gallery"], "image", array()));
            foreach ($context['_seq'] as $context["_key"] => $context["image"]) {
                // line 4
                echo "    <div class=\"item\"><img src=\"";
                echo call_user_func_array($this->env->getFilter('noImage')->getCallable(), array($this->extensions['System\Twig\Extension']->mediaFilter(twig_get_attribute($this->env, $this->source, $context["image"], "url", array()))));
                echo "\" /></div>
    ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['image'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 6
            echo "    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['gallery'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 7
        echo "</div>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/plugins/ideas/shop/components/theme/gallery.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  50 => 7,  44 => 6,  35 => 4,  30 => 3,  26 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"owl-carousel owl-theme\" id=\"owl-carousel\">
    {% for gallery in galleries %}
    {% for image in gallery.image %}
    <div class=\"item\"><img src=\"{{image.url | media | noImage }}\" /></div>
    {% endfor %}
    {% endfor %}
</div>", "/home/ubuntu/workspace/plugins/ideas/shop/components/theme/gallery.htm", "");
    }
}
