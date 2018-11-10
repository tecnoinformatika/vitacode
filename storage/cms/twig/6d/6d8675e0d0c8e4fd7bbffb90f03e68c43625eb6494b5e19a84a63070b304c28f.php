<?php

/* /home/ubuntu/workspace/themes/martin-new-event/partials/template/sponsors.htm */
class __TwigTemplate_a01f7ef1712c6d505f0806ca1136df31fc5e9db10513610da0d93027cac470b1 extends Twig_Template
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
        echo "<section id=\"sponsors\" class=\"parallax-section\">
    <div class=\"container\">
        <div class=\"row\">

            <div class=\"wow bounceIn col-md-12 col-sm-12\">
                <div class=\"section-title\">
                    <h2>Our Sponsors</h2>
                    <p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
                </div>
            </div>

            <div class=\"wow fadeInUp col-md-3 col-sm-6 col-xs-6\" data-wow-delay=\"0.3s\">
                <img src=\"";
        // line 13
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/sponsor-img1.jpg");
        echo "\" class=\"img-responsive\" alt=\"sponsors\">
            </div>

            <div class=\"wow fadeInUp col-md-3 col-sm-6 col-xs-6\" data-wow-delay=\"0.6s\">
                <img src=\"";
        // line 17
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/sponsor-img2.jpg");
        echo "\" class=\"img-responsive\" alt=\"sponsors\">
            </div>

            <div class=\"wow fadeInUp col-md-3 col-sm-6 col-xs-6\" data-wow-delay=\"0.9s\">
                <img src=\"";
        // line 21
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/sponsor-img3.jpg");
        echo "\" class=\"img-responsive\" alt=\"sponsors\">
            </div>

            <div class=\"wow fadeInUp col-md-3 col-sm-6 col-xs-6\" data-wow-delay=\"1s\">
                <img src=\"";
        // line 25
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/sponsor-img4.jpg");
        echo "\" class=\"img-responsive\" alt=\"sponsors\">
            </div>

        </div>
    </div>
</section>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/martin-new-event/partials/template/sponsors.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 25,  51 => 21,  44 => 17,  37 => 13,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<section id=\"sponsors\" class=\"parallax-section\">
    <div class=\"container\">
        <div class=\"row\">

            <div class=\"wow bounceIn col-md-12 col-sm-12\">
                <div class=\"section-title\">
                    <h2>Our Sponsors</h2>
                    <p>Lorem ipsum dolor sit amet, maecenas eget vestibulum justo imperdiet.</p>
                </div>
            </div>

            <div class=\"wow fadeInUp col-md-3 col-sm-6 col-xs-6\" data-wow-delay=\"0.3s\">
                <img src=\"{{ 'assets/images/sponsor-img1.jpg'|theme }}\" class=\"img-responsive\" alt=\"sponsors\">
            </div>

            <div class=\"wow fadeInUp col-md-3 col-sm-6 col-xs-6\" data-wow-delay=\"0.6s\">
                <img src=\"{{ 'assets/images/sponsor-img2.jpg'|theme }}\" class=\"img-responsive\" alt=\"sponsors\">
            </div>

            <div class=\"wow fadeInUp col-md-3 col-sm-6 col-xs-6\" data-wow-delay=\"0.9s\">
                <img src=\"{{ 'assets/images/sponsor-img3.jpg'|theme }}\" class=\"img-responsive\" alt=\"sponsors\">
            </div>

            <div class=\"wow fadeInUp col-md-3 col-sm-6 col-xs-6\" data-wow-delay=\"1s\">
                <img src=\"{{ 'assets/images/sponsor-img4.jpg'|theme }}\" class=\"img-responsive\" alt=\"sponsors\">
            </div>

        </div>
    </div>
</section>", "/home/ubuntu/workspace/themes/martin-new-event/partials/template/sponsors.htm", "");
    }
}
