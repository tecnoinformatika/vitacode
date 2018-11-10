<?php

/* /home/ubuntu/workspace/themes/martin-new-event/partials/template/video.htm */
class __TwigTemplate_18a7301095e373e56ceed744c70857c027a69e0317c62f57e9471ea4869e326b extends Twig_Template
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
        echo "<section id=\"video\" class=\"parallax-section\">
    <div class=\"container\">
        <div class=\"row\">

            <div class=\"wow fadeInUp col-md-6 col-sm-10\" data-wow-delay=\"1.3s\">
                <h2>";
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "video_header", array()), "html", null, true);
        echo "</h2>
                <h3>";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "video_subheader", array()), "html", null, true);
        echo "</h3>
                <p>";
        // line 8
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "video_content", array()), "html", null, true);
        echo "</p>
            </div>

            <div class=\"wow fadeInUp col-md-6 col-sm-10\" data-wow-delay=\"1.6s\">
                <div class=\"embed-responsive embed-responsive-16by9\">
                    <iframe class=\"embed-responsive-item\" src=\"";
        // line 13
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "video_youtube", array()), "html", null, true);
        echo "\" allowfullscreen></iframe>
                </div>
            </div>

        </div>
    </div>
</section>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/martin-new-event/partials/template/video.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 13,  38 => 8,  34 => 7,  30 => 6,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<section id=\"video\" class=\"parallax-section\">
    <div class=\"container\">
        <div class=\"row\">

            <div class=\"wow fadeInUp col-md-6 col-sm-10\" data-wow-delay=\"1.3s\">
                <h2>{{ this.theme.video_header }}</h2>
                <h3>{{ this.theme.video_subheader }}</h3>
                <p>{{ this.theme.video_content }}</p>
            </div>

            <div class=\"wow fadeInUp col-md-6 col-sm-10\" data-wow-delay=\"1.6s\">
                <div class=\"embed-responsive embed-responsive-16by9\">
                    <iframe class=\"embed-responsive-item\" src=\"{{ this.theme.video_youtube }}\" allowfullscreen></iframe>
                </div>
            </div>

        </div>
    </div>
</section>", "/home/ubuntu/workspace/themes/martin-new-event/partials/template/video.htm", "");
    }
}
