<?php

/* /home/ubuntu/workspace/themes/martin-new-event/partials/template/register.htm */
class __TwigTemplate_64c55496d0f56f133e453724c9049cacf587f4337a5d681836e13f5b6bd304d1 extends Twig_Template
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
        echo "<section id=\"register\" class=\"parallax-section\">
    <div class=\"container\">
        <div class=\"row\">

            <div class=\"wow fadeInUp col-md-7 col-sm-7\" data-wow-delay=\"0.6s\">
                <h2>";
        // line 6
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "register_header", array()), "html", null, true);
        echo "</h2>
                <h3>";
        // line 7
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "register_subheader", array()), "html", null, true);
        echo "</h3>
                <p>";
        // line 8
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "register_content", array()), "html", null, true);
        echo "</p>
            </div>

            <div class=\"wow fadeInUp col-md-5 col-sm-5\" data-wow-delay=\"1s\">
                <form action=\"#\" method=\"post\">
                    <input name=\"firstname\" type=\"text\" class=\"form-control\" id=\"firstname\" placeholder=\"First Name\">
                    <input name=\"lastname\" type=\"text\" class=\"form-control\" id=\"lastname\" placeholder=\"Last Name\">
                    <input name=\"phone\" type=\"telephone\" class=\"form-control\" id=\"phone\" placeholder=\"Phone Number\">
                    <input name=\"email\" type=\"email\" class=\"form-control\" id=\"email\" placeholder=\"Email Address\">
                    <div class=\"col-md-offset-6 col-md-6 col-sm-offset-1 col-sm-10\">
                        <input name=\"submit\" type=\"submit\" class=\"form-control\" id=\"submit\" value=\"REGISTER\">
                    </div>
                </form>
            </div>

            <div class=\"col-md-1\"></div>

        </div>
    </div>
</section>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/martin-new-event/partials/template/register.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  38 => 8,  34 => 7,  30 => 6,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<section id=\"register\" class=\"parallax-section\">
    <div class=\"container\">
        <div class=\"row\">

            <div class=\"wow fadeInUp col-md-7 col-sm-7\" data-wow-delay=\"0.6s\">
                <h2>{{ this.theme.register_header }}</h2>
                <h3>{{ this.theme.register_subheader }}</h3>
                <p>{{ this.theme.register_content }}</p>
            </div>

            <div class=\"wow fadeInUp col-md-5 col-sm-5\" data-wow-delay=\"1s\">
                <form action=\"#\" method=\"post\">
                    <input name=\"firstname\" type=\"text\" class=\"form-control\" id=\"firstname\" placeholder=\"First Name\">
                    <input name=\"lastname\" type=\"text\" class=\"form-control\" id=\"lastname\" placeholder=\"Last Name\">
                    <input name=\"phone\" type=\"telephone\" class=\"form-control\" id=\"phone\" placeholder=\"Phone Number\">
                    <input name=\"email\" type=\"email\" class=\"form-control\" id=\"email\" placeholder=\"Email Address\">
                    <div class=\"col-md-offset-6 col-md-6 col-sm-offset-1 col-sm-10\">
                        <input name=\"submit\" type=\"submit\" class=\"form-control\" id=\"submit\" value=\"REGISTER\">
                    </div>
                </form>
            </div>

            <div class=\"col-md-1\"></div>

        </div>
    </div>
</section>", "/home/ubuntu/workspace/themes/martin-new-event/partials/template/register.htm", "");
    }
}
