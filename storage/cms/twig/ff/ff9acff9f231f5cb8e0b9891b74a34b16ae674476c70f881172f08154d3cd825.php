<?php

/* /home/ubuntu/workspace/themes/martin-new-event/layouts/default.htm */
class __TwigTemplate_a2e99803be3c1caf3fed60b73ffd9eb2190eadfc4c6d962690d87f8057ec36f0 extends Twig_Template
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
        echo "<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>";
        // line 5
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "page", array()), "title", array()), "html", null, true);
        echo "</title>
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=Edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\">
<!--
New Event
http://www.templatemo.com/tm-486-new-event
-->
    <link href='https://fonts.googleapis.com/css?family=Poppins:400,500,600' rel='stylesheet' type='text/css'>
    <link href=\"";
        // line 15
        echo $this->extensions['Cms\Twig\Extension']->themeFilter(array(0 => "assets/css/bootstrap.min.css", 1 => "assets/css/animate.css", 2 => "assets/css/font-awesome.min.css", 3 => "assets/css/owl.theme.css", 4 => "assets/css/owl.carousel.css", 5 => "assets/css/style.css"));
        // line 22
        echo "\" rel=\"stylesheet\">
</head>
<body data-spy=\"scroll\" data-offset=\"50\" data-target=\".navbar-collapse\">

    <div class=\"preloader\">
        <div class=\"sk-rotating-plane\"></div>
    </div>

    ";
        // line 30
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("template/navbar"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 31
        echo "    ";
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("template/intro"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 32
        echo "
";
        // line 33
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "settings_overview", array())) {
            // line 34
            echo "    ";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("template/overview"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
            // line 35
            echo "    ";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("template/detail"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
            // line 36
            echo "    ";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("template/video"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
        }
        // line 38
        echo "
";
        // line 39
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "settings_speakers", array())) {
            // line 40
            echo "    ";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("template/speakers"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
        }
        // line 42
        echo "
";
        // line 43
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "settings_program", array())) {
            // line 44
            echo "    ";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("template/program"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
        }
        // line 46
        echo "
";
        // line 47
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "settings_register", array())) {
            // line 48
            echo "    ";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("template/register"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
            // line 49
            echo "    ";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("template/faq"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
        }
        // line 51
        echo "
";
        // line 52
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "settings_venue", array())) {
            // line 53
            echo "    ";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("template/venue"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
        }
        // line 55
        echo "
";
        // line 56
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "settings_sponsors", array())) {
            // line 57
            echo "    ";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("template/sponsors"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
        }
        // line 59
        echo "
";
        // line 60
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "settings_contact", array())) {
            // line 61
            echo "    ";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("template/contact"            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
        }
        // line 63
        echo "
    ";
        // line 64
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("template/footer"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 65
        echo "
";
        // line 66
        if (twig_get_attribute($this->env, $this->source, twig_get_attribute($this->env, $this->source, ($context["this"] ?? null), "theme", array()), "settings_gotop", array())) {
            // line 67
            echo "    <a href=\"#back-top\" class=\"go-top\"><i class=\"fa fa-angle-up\"></i></a>
";
        }
        // line 69
        echo "
    <script src=\"";
        // line 70
        echo $this->extensions['Cms\Twig\Extension']->themeFilter(array(0 => "assets/js/jquery.js", 1 => "assets/js/bootstrap.min.js", 2 => "assets/js/jquery.parallax.js", 3 => "assets/js/owl.carousel.min.js", 4 => "assets/js/smoothscroll.js", 5 => "assets/js/wow.min.js", 6 => "assets/js/custom.js", 7 => "@framework", 8 => "@framework.extras"));
        // line 79
        echo "\"></script>

</body>
</html>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/martin-new-event/layouts/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  176 => 79,  174 => 70,  171 => 69,  167 => 67,  165 => 66,  162 => 65,  158 => 64,  155 => 63,  149 => 61,  147 => 60,  144 => 59,  138 => 57,  136 => 56,  133 => 55,  127 => 53,  125 => 52,  122 => 51,  116 => 49,  111 => 48,  109 => 47,  106 => 46,  100 => 44,  98 => 43,  95 => 42,  89 => 40,  87 => 39,  84 => 38,  78 => 36,  73 => 35,  68 => 34,  66 => 33,  63 => 32,  58 => 31,  54 => 30,  44 => 22,  42 => 15,  29 => 5,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html lang=\"en\">
<head>
    <meta charset=\"UTF-8\">
    <title>{{ this.page.title }}</title>
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=Edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, maximum-scale=1\">
<!--
New Event
http://www.templatemo.com/tm-486-new-event
-->
    <link href='https://fonts.googleapis.com/css?family=Poppins:400,500,600' rel='stylesheet' type='text/css'>
    <link href=\"{{ [
        'assets/css/bootstrap.min.css',
        'assets/css/animate.css',
        'assets/css/font-awesome.min.css',
        'assets/css/owl.theme.css',
        'assets/css/owl.carousel.css',
        'assets/css/style.css',
    ]|theme }}\" rel=\"stylesheet\">
</head>
<body data-spy=\"scroll\" data-offset=\"50\" data-target=\".navbar-collapse\">

    <div class=\"preloader\">
        <div class=\"sk-rotating-plane\"></div>
    </div>

    {% partial 'template/navbar' %}
    {% partial 'template/intro'  %}

{% if this.theme.settings_overview %}
    {% partial 'template/overview' %}
    {% partial 'template/detail'   %}
    {% partial 'template/video'    %}
{% endif %}

{% if this.theme.settings_speakers %}
    {% partial 'template/speakers' %}
{% endif %}

{% if this.theme.settings_program %}
    {% partial 'template/program'  %}
{% endif %}

{% if this.theme.settings_register %}
    {% partial 'template/register' %}
    {% partial 'template/faq'      %}
{% endif %}

{% if this.theme.settings_venue %}
    {% partial 'template/venue'    %}
{% endif %}

{% if this.theme.settings_sponsors %}
    {% partial 'template/sponsors' %}
{% endif %}

{% if this.theme.settings_contact %}
    {% partial 'template/contact' %}
{% endif %}

    {% partial 'template/footer' %}

{% if this.theme.settings_gotop %}
    <a href=\"#back-top\" class=\"go-top\"><i class=\"fa fa-angle-up\"></i></a>
{% endif %}

    <script src=\"{{ [
        'assets/js/jquery.js',
        'assets/js/bootstrap.min.js',
        'assets/js/jquery.parallax.js',
        'assets/js/owl.carousel.min.js',
        'assets/js/smoothscroll.js',
        'assets/js/wow.min.js',
        'assets/js/custom.js',
        '@framework',
        '@framework.extras']|theme }}\"></script>

</body>
</html>", "/home/ubuntu/workspace/themes/martin-new-event/layouts/default.htm", "");
    }
}
