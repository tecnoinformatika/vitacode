<?php

/* /home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/banner.htm */
class __TwigTemplate_d526312173649a9d2deb30bbc60e3ae8dc9cd4e0fbb66b0760877cb1047f202b extends Twig_Template
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
        echo "<script src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/js/jssor.slider-27.4.0.min.js");
        echo "\" type=\"text/javascript\"></script>
    <script type=\"text/javascript\">
        jssor_1_slider_init = function() {

            var jssor_1_SlideoTransitions = [
              [{b:-1,d:1,o:-0.7}],
              [{b:900,d:2000,x:-379,e:{x:7}}],
              [{b:900,d:2000,x:-379,e:{x:7}}],
              [{b:-1,d:1,o:-1,sX:2,sY:2},{b:0,d:900,x:-171,y:-341,o:1,sX:-2,sY:-2,e:{x:3,y:3,sX:3,sY:3}},{b:900,d:1600,x:-283,o:-1,e:{x:16}}]
            ];

            var jssor_1_options = {
              \$AutoPlay: 1,
              \$SlideDuration: 800,
              \$SlideEasing: \$Jease\$.\$OutQuint,
              \$CaptionSliderOptions: {
                \$Class: \$JssorCaptionSlideo\$,
                \$Transitions: jssor_1_SlideoTransitions
              },
              \$ArrowNavigatorOptions: {
                \$Class: \$JssorArrowNavigator\$
              },
              \$BulletNavigatorOptions: {
                \$Class: \$JssorBulletNavigator\$
              }
            };

            var jssor_1_slider = new \$JssorSlider\$(\"jssor_1\", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 3000;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.\$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.\$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            \$Jssor\$.\$AddEvent(window, \"load\", ScaleSlider);
            \$Jssor\$.\$AddEvent(window, \"resize\", ScaleSlider);
            \$Jssor\$.\$AddEvent(window, \"orientationchange\", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    <link href=\"//fonts.googleapis.com/css?family=Roboto+Condensed:300,300italic,regular,italic,700,700italic&subset=latin-ext,greek-ext,cyrillic-ext,greek,vietnamese,latin,cyrillic\" rel=\"stylesheet\" type=\"text/css\" />
    <style>
        /*jssor slider loading skin spin css*/
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /*jssor slider bullet skin 032 css*/
        .jssorb032 {position:absolute;}
        .jssorb032 .i {position:absolute;cursor:pointer;}
        .jssorb032 .i .b {fill:#fff;fill-opacity:0.7;stroke:#000;stroke-width:1200;stroke-miterlimit:10;stroke-opacity:0.25;}
        .jssorb032 .i:hover .b {fill:#000;fill-opacity:.6;stroke:#fff;stroke-opacity:.35;}
        .jssorb032 .iav .b {fill:#000;fill-opacity:1;stroke:#fff;stroke-opacity:.35;}
        .jssorb032 .i.idn {opacity:.3;}

        /*jssor slider arrow skin 051 css*/
        .jssora051 {display:block;position:absolute;cursor:pointer;}
        .jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
        .jssora051:hover {opacity:.8;}
        .jssora051.jssora051dn {opacity:.5;}
        .jssora051.jssora051ds {opacity:.3;pointer-events:none;}
    </style>
    <div id=\"jssor_1\" style=\"position:relative;margin:0 auto;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;visibility:hidden;\">
        <!-- Loading Screen -->
        <div data-u=\"loading\" class=\"jssorl-009-spin\" style=\"position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);\">
            <img style=\"margin-top:-19px;position:relative;top:50%;width:38px;height:38px;\" src=\"";
        // line 90
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/img/spin.svg");
        echo "\" />
        </div>
        <div data-u=\"slides\" style=\"cursor:default;position:relative;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;\">
            <div>
                <img data-u=\"image\" src=\"";
        // line 94
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/img/001.jpg");
        echo "\" />          
               
            </div>
            <div>
                <img data-u=\"image\" src=\"";
        // line 98
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/img/002.jpg");
        echo "\" />
            </div>
            <div>
                <img data-u=\"image\" src=\"";
        // line 101
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/img/003.jpg");
        echo "\" />
            </div>
        </div>
        <!-- Bullet Navigator -->
        <div data-u=\"navigator\" class=\"jssorb032\" style=\"position:absolute;bottom:12px;right:12px;\" data-autocenter=\"1\" data-scale=\"0.5\" data-scale-bottom=\"0.75\">
            <div data-u=\"prototype\" class=\"i\" style=\"width:16px;height:16px;\">
                <svg viewbox=\"0 0 16000 16000\" style=\"position:absolute;top:0;left:0;width:100%;height:100%;\">
                    <circle class=\"b\" cx=\"8000\" cy=\"8000\" r=\"5800\"></circle>
                </svg>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div data-u=\"arrowleft\" class=\"jssora051\" style=\"width:65px;height:65px;top:0px;left:25px;\" data-autocenter=\"2\" data-scale=\"0.75\" data-scale-left=\"0.75\">
            <svg viewbox=\"0 0 16000 16000\" style=\"position:absolute;top:0;left:0;width:100%;height:100%;\">
                <polyline class=\"a\" points=\"11040,1920 4960,8000 11040,14080 \"></polyline>
            </svg>
        </div>
        <div data-u=\"arrowright\" class=\"jssora051\" style=\"width:65px;height:65px;top:0px;right:25px;\" data-autocenter=\"2\" data-scale=\"0.75\" data-scale-right=\"0.75\">
            <svg viewbox=\"0 0 16000 16000\" style=\"position:absolute;top:0;left:0;width:100%;height:100%;\">
                <polyline class=\"a\" points=\"4960,1920 11040,8000 4960,14080 \"></polyline>
            </svg>
        </div>
    </div>
    <script type=\"text/javascript\">jssor_1_slider_init();</script>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/banner.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  136 => 101,  130 => 98,  123 => 94,  116 => 90,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<script src=\"{{ 'assets/js/jssor.slider-27.4.0.min.js'|theme }}\" type=\"text/javascript\"></script>
    <script type=\"text/javascript\">
        jssor_1_slider_init = function() {

            var jssor_1_SlideoTransitions = [
              [{b:-1,d:1,o:-0.7}],
              [{b:900,d:2000,x:-379,e:{x:7}}],
              [{b:900,d:2000,x:-379,e:{x:7}}],
              [{b:-1,d:1,o:-1,sX:2,sY:2},{b:0,d:900,x:-171,y:-341,o:1,sX:-2,sY:-2,e:{x:3,y:3,sX:3,sY:3}},{b:900,d:1600,x:-283,o:-1,e:{x:16}}]
            ];

            var jssor_1_options = {
              \$AutoPlay: 1,
              \$SlideDuration: 800,
              \$SlideEasing: \$Jease\$.\$OutQuint,
              \$CaptionSliderOptions: {
                \$Class: \$JssorCaptionSlideo\$,
                \$Transitions: jssor_1_SlideoTransitions
              },
              \$ArrowNavigatorOptions: {
                \$Class: \$JssorArrowNavigator\$
              },
              \$BulletNavigatorOptions: {
                \$Class: \$JssorBulletNavigator\$
              }
            };

            var jssor_1_slider = new \$JssorSlider\$(\"jssor_1\", jssor_1_options);

            /*#region responsive code begin*/

            var MAX_WIDTH = 3000;

            function ScaleSlider() {
                var containerElement = jssor_1_slider.\$Elmt.parentNode;
                var containerWidth = containerElement.clientWidth;

                if (containerWidth) {

                    var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

                    jssor_1_slider.\$ScaleWidth(expectedWidth);
                }
                else {
                    window.setTimeout(ScaleSlider, 30);
                }
            }

            ScaleSlider();

            \$Jssor\$.\$AddEvent(window, \"load\", ScaleSlider);
            \$Jssor\$.\$AddEvent(window, \"resize\", ScaleSlider);
            \$Jssor\$.\$AddEvent(window, \"orientationchange\", ScaleSlider);
            /*#endregion responsive code end*/
        };
    </script>
    <link href=\"//fonts.googleapis.com/css?family=Roboto+Condensed:300,300italic,regular,italic,700,700italic&subset=latin-ext,greek-ext,cyrillic-ext,greek,vietnamese,latin,cyrillic\" rel=\"stylesheet\" type=\"text/css\" />
    <style>
        /*jssor slider loading skin spin css*/
        .jssorl-009-spin img {
            animation-name: jssorl-009-spin;
            animation-duration: 1.6s;
            animation-iteration-count: infinite;
            animation-timing-function: linear;
        }

        @keyframes jssorl-009-spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        /*jssor slider bullet skin 032 css*/
        .jssorb032 {position:absolute;}
        .jssorb032 .i {position:absolute;cursor:pointer;}
        .jssorb032 .i .b {fill:#fff;fill-opacity:0.7;stroke:#000;stroke-width:1200;stroke-miterlimit:10;stroke-opacity:0.25;}
        .jssorb032 .i:hover .b {fill:#000;fill-opacity:.6;stroke:#fff;stroke-opacity:.35;}
        .jssorb032 .iav .b {fill:#000;fill-opacity:1;stroke:#fff;stroke-opacity:.35;}
        .jssorb032 .i.idn {opacity:.3;}

        /*jssor slider arrow skin 051 css*/
        .jssora051 {display:block;position:absolute;cursor:pointer;}
        .jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
        .jssora051:hover {opacity:.8;}
        .jssora051.jssora051dn {opacity:.5;}
        .jssora051.jssora051ds {opacity:.3;pointer-events:none;}
    </style>
    <div id=\"jssor_1\" style=\"position:relative;margin:0 auto;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;visibility:hidden;\">
        <!-- Loading Screen -->
        <div data-u=\"loading\" class=\"jssorl-009-spin\" style=\"position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);\">
            <img style=\"margin-top:-19px;position:relative;top:50%;width:38px;height:38px;\" src=\"{{ 'assets/images/img/spin.svg'|theme }}\" />
        </div>
        <div data-u=\"slides\" style=\"cursor:default;position:relative;top:0px;left:0px;width:1300px;height:500px;overflow:hidden;\">
            <div>
                <img data-u=\"image\" src=\"{{ 'assets/images/img/001.jpg'|theme }}\" />          
               
            </div>
            <div>
                <img data-u=\"image\" src=\"{{ 'assets/images/img/002.jpg'|theme }}\" />
            </div>
            <div>
                <img data-u=\"image\" src=\"{{ 'assets/images/img/003.jpg'|theme }}\" />
            </div>
        </div>
        <!-- Bullet Navigator -->
        <div data-u=\"navigator\" class=\"jssorb032\" style=\"position:absolute;bottom:12px;right:12px;\" data-autocenter=\"1\" data-scale=\"0.5\" data-scale-bottom=\"0.75\">
            <div data-u=\"prototype\" class=\"i\" style=\"width:16px;height:16px;\">
                <svg viewbox=\"0 0 16000 16000\" style=\"position:absolute;top:0;left:0;width:100%;height:100%;\">
                    <circle class=\"b\" cx=\"8000\" cy=\"8000\" r=\"5800\"></circle>
                </svg>
            </div>
        </div>
        <!-- Arrow Navigator -->
        <div data-u=\"arrowleft\" class=\"jssora051\" style=\"width:65px;height:65px;top:0px;left:25px;\" data-autocenter=\"2\" data-scale=\"0.75\" data-scale-left=\"0.75\">
            <svg viewbox=\"0 0 16000 16000\" style=\"position:absolute;top:0;left:0;width:100%;height:100%;\">
                <polyline class=\"a\" points=\"11040,1920 4960,8000 11040,14080 \"></polyline>
            </svg>
        </div>
        <div data-u=\"arrowright\" class=\"jssora051\" style=\"width:65px;height:65px;top:0px;right:25px;\" data-autocenter=\"2\" data-scale=\"0.75\" data-scale-right=\"0.75\">
            <svg viewbox=\"0 0 16000 16000\" style=\"position:absolute;top:0;left:0;width:100%;height:100%;\">
                <polyline class=\"a\" points=\"4960,1920 11040,8000 4960,14080 \"></polyline>
            </svg>
        </div>
    </div>
    <script type=\"text/javascript\">jssor_1_slider_init();</script>", "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/banner.htm", "");
    }
}
