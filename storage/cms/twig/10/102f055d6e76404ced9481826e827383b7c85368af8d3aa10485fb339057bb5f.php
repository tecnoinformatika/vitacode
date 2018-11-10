<?php

/* /home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/layouts/default.htm */
class __TwigTemplate_bc39e3db3d3467be8af05eec0d90fe1d292ca6f338562e9eed98b5a87d885031 extends Twig_Template
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
<html>
<head>
    <meta charset=\"utf-8\">
    <title>";
        // line 5
        echo twig_escape_filter($this->env, ($context["seo_title"] ?? null), "html", null, true);
        echo "</title>
    <meta name=\"description\" content=\"";
        // line 6
        echo twig_escape_filter($this->env, ($context["seo_keyword"] ?? null), "html", null, true);
        echo "\">
    <meta name=\"keywords\" content=\"";
        // line 7
        echo twig_escape_filter($this->env, ($context["seo_description"] ?? null), "html", null, true);
        echo "\">
    <meta name=\"author\" content=\"ideasPro\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"generator\" content=\"ideaspro\">
    <link rel=\"icon\" type=\"image/png\" href=\"";
        // line 11
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/ideas_shop.png");
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 12
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/bootstrap/css/bootstrap.min.css");
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 13
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/font-awesome/css/font-awesome.min.css");
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 14
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/owl/assets/owl.carousel.min.css");
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 15
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/owl/assets/owl.theme.default.min.css");
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 16
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/xzoom/xzoom.css");
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 17
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/bxslider/jquery.bxslider.min.css");
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 18
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/select2/css/select2.min.css");
        echo "\">
    <link rel=\"stylesheet\" href=\"";
        // line 19
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/star_rating/rating.css");
        echo "\">    
    <link href=\"";
        // line 20
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/css/theme.css");
        echo "\" rel=\"stylesheet\">
   
    ";
        // line 22
        echo $this->env->getExtension('Cms\Twig\Extension')->assetsFunction('css');
        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('styles');
        // line 23
        echo "     <link rel=\"stylesheet\" href=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/css/style.css");
        echo "\">
</head>
<body>

";
        // line 27
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/header"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 28
        echo "<!-- Content -->
";
        // line 29
        echo $this->env->getExtension('Cms\Twig\Extension')->pageFunction();
        // line 30
        echo "<!-- end content -->
";
        // line 31
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/footer"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 32
        echo "
";
        // line 33
        $context['__cms_partial_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction("site/modalConfirmCart"        , $context['__cms_partial_params']        , true        );
        unset($context['__cms_partial_params']);
        // line 34
        echo "

<!-- Scripts -->
<script src=\"";
        // line 37
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/jquery.js");
        echo "\"></script>
<script src=\"";
        // line 38
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/bootstrap/js/bootstrap.js");
        echo "\"></script>

<script src=\"";
        // line 40
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/owl/owl.carousel.min.js");
        echo "\"></script>
<script src=\"";
        // line 41
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/xzoom/xzoom.min.js");
        echo "\"></script>
<script src=\"";
        // line 42
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/bxslider/jquery.bxslider.min.js");
        echo "\"></script>
<script src=\"";
        // line 43
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/select2/js/select2.full.js");
        echo "\"></script>
<script src=\"";
        // line 44
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/vendor/star_rating/rating.js");
        echo "\"></script>
<script src=\"";
        // line 45
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/js/theme.js");
        echo "\"></script>

";
        // line 47
        $_minify = System\Classes\CombineAssets::instance()->useMinify;
        if ($_minify) {
            echo '<script src="'. Request::getBasePath()
                    .'/modules/system/assets/js/framework.combined-min.js"></script>'.PHP_EOL;
        }
        else {
            echo '<script src="'. Request::getBasePath()
                    .'/modules/system/assets/js/framework.js"></script>'.PHP_EOL;
            echo '<script src="'. Request::getBasePath()
                    .'/modules/system/assets/js/framework.extras.js"></script>'.PHP_EOL;
        }
        echo '<link rel="stylesheet" property="stylesheet" href="'. Request::getBasePath()
                    .'/modules/system/assets/css/framework.extras'.($_minify ? '-min' : '').'.css">'.PHP_EOL;
        unset($_minify);
        // line 48
        echo $this->env->getExtension('Cms\Twig\Extension')->assetsFunction('js');
        echo $this->env->getExtension('Cms\Twig\Extension')->displayBlock('scripts');
        // line 49
        echo "
</body>
</html>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/layouts/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  176 => 49,  173 => 48,  158 => 47,  153 => 45,  149 => 44,  145 => 43,  141 => 42,  137 => 41,  133 => 40,  128 => 38,  124 => 37,  119 => 34,  115 => 33,  112 => 32,  108 => 31,  105 => 30,  103 => 29,  100 => 28,  96 => 27,  88 => 23,  85 => 22,  80 => 20,  76 => 19,  72 => 18,  68 => 17,  64 => 16,  60 => 15,  56 => 14,  52 => 13,  48 => 12,  44 => 11,  37 => 7,  33 => 6,  29 => 5,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<!DOCTYPE html>
<html>
<head>
    <meta charset=\"utf-8\">
    <title>{{ seo_title }}</title>
    <meta name=\"description\" content=\"{{ seo_keyword }}\">
    <meta name=\"keywords\" content=\"{{ seo_description }}\">
    <meta name=\"author\" content=\"ideasPro\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"generator\" content=\"ideaspro\">
    <link rel=\"icon\" type=\"image/png\" href=\"{{ 'assets/images/ideas_shop.png'|theme }}\">
    <link rel=\"stylesheet\" href=\"{{ 'assets/vendor/bootstrap/css/bootstrap.min.css'|theme }}\">
    <link rel=\"stylesheet\" href=\"{{ 'assets/vendor/font-awesome/css/font-awesome.min.css'|theme }}\">
    <link rel=\"stylesheet\" href=\"{{ 'assets/vendor/owl/assets/owl.carousel.min.css'|theme }}\">
    <link rel=\"stylesheet\" href=\"{{ 'assets/vendor/owl/assets/owl.theme.default.min.css'|theme }}\">
    <link rel=\"stylesheet\" href=\"{{ 'assets/vendor/xzoom/xzoom.css'|theme }}\">
    <link rel=\"stylesheet\" href=\"{{ 'assets/vendor/bxslider/jquery.bxslider.min.css'|theme }}\">
    <link rel=\"stylesheet\" href=\"{{ 'assets/vendor/select2/css/select2.min.css'|theme }}\">
    <link rel=\"stylesheet\" href=\"{{ 'assets/vendor/star_rating/rating.css'|theme }}\">    
    <link href=\"{{ 'assets/css/theme.css'|theme }}\" rel=\"stylesheet\">
   
    {% styles %}
     <link rel=\"stylesheet\" href=\"{{ 'assets/css/style.css'|theme }}\">
</head>
<body>

{% partial 'site/header' %}
<!-- Content -->
{% page %}
<!-- end content -->
{% partial 'site/footer' %}

{% partial 'site/modalConfirmCart' %}


<!-- Scripts -->
<script src=\"{{ 'assets/vendor/jquery.js'|theme }}\"></script>
<script src=\"{{ 'assets/vendor/bootstrap/js/bootstrap.js'|theme }}\"></script>

<script src=\"{{ 'assets/vendor/owl/owl.carousel.min.js'|theme }}\"></script>
<script src=\"{{ 'assets/vendor/xzoom/xzoom.min.js'|theme }}\"></script>
<script src=\"{{ 'assets/vendor/bxslider/jquery.bxslider.min.js'|theme }}\"></script>
<script src=\"{{ 'assets/vendor/select2/js/select2.full.js'|theme }}\"></script>
<script src=\"{{ 'assets/vendor/star_rating/rating.js'|theme }}\"></script>
<script src=\"{{ 'assets/js/theme.js'|theme }}\"></script>

{% framework extras %}
{% scripts %}

</body>
</html>", "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/layouts/default.htm", "");
    }
}
