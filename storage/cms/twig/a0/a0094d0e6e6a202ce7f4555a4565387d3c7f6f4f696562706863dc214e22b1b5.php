<?php

/* /home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/site/header.htm */
class __TwigTemplate_628a28a5a5649fe6b91df771022313f4b2522581970755c0b72883c6cc3b65e7 extends Twig_Template
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
        echo "<div id=\"top-header\" >
    <div class=\"container\" >
        <div class=\"row top-header-div\">
            <div class=\"col-md-3\">Bienvenidos a ";
        // line 4
        echo twig_escape_filter($this->env, ($context["seo_title"] ?? null), "html", null, true);
        echo "</div>
            <div class=\"col-md-6\"></div>
            <div class=\"col-md-3\">
                ";
        // line 7
        if (($context["user"] ?? null)) {
            // line 8
            echo "                <li class=\"dropdown\" >
                    <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\" style=\"font-size: 25px; color: #fafafa; \">Hello ";
            // line 9
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["user"] ?? null), "name", array()), "html", null, true);
            echo "
                        <span class=\"caret\"></span></a>
                    <ul class=\"dropdown-menu\">
                        <li>
                            <a href=\"/user/order\" style=\"font-size: 25px; color: #e21515; \">";
            // line 13
            echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.component.order_manager"));
            echo " </a>
                        </li>
                        <li>
                            <a href=\"/user/address\" style=\"font-size: 25px; color: #e21515; \">";
            // line 16
            echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.component.address_manager"));
            echo "</a>
                        </li>
                        <li>
                            <a href=\"/pin/public/\" style=\"font-size: 25px; color: #e21515; \">Diligencia tu ficha</a>
                        </li>
                        <li>
                            <a data-request=\"onLogout\" data-request-data=\"redirect: '/'\" style=\"font-size: 25px; color: #e21515; \">LOG OUT</a>
                        </li>
                        <li></li>
                        <li></li>
                    </ul>
                </li>
                ";
        } else {
            // line 29
            echo "                <a href=\"/login\" class=\"top-header-a\">SIGN IN</a>
                OR
                <a href=\"/register\" class=\"top-header-a\">REGISTER</a>
                ";
        }
        // line 33
        echo "                
            </div>
        </div>
    </div>
</div>
<div class=\"container\">
    <div class=\"row top-header-div\">
        <div id=\"logo\" class=\"col-md-3\"><img src=\"\" /></div>
        <div id=\"form-search\" class=\"col-md-6\">
            <form action=\"/search-result\" method=\"get\" id=\"form-search-form\">
                <div class=\"form-group\" id=\"search-form-top\">
                    <input type=\"text\" id=\"search-input-top\" name=\"key\"
                           class=\"form-control\" placeholder=\"search\"/>
                    <i class=\"fa fa-search\" aria-hidden=\"true\" id=\"search-top-icon\"></i>
                </div>
            </form>
        </div>
        <div class=\"col-md-3\" id=\"support-phone-div\">
            <i class=\"fa fa-phone\" aria-hidden=\"true\"></i>
            <span class=\"support-phone\">123456789</span>
        </div>
    </div>
</div>
<div class=\"nav-wrapper\" id=\"navbar\">
    <div class=\"navbar navbar-custom\" role=\"navigation\">
        <div class=\"container\">
            <!-- Logo -->
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\"><i class=\"fa fa-bars\"></i></button>
                <a href=\"";
        // line 62
        echo $this->extensions['Cms\Twig\Extension']->pageFilter("samples/eshop");
        echo "\" ><img src=\"";
        echo $this->extensions['Cms\Twig\Extension']->themeFilter("assets/images/logo-vitacode-400.png");
        echo "\" ></a>
            </div>
            <!-- /Logo -->
        
            <!-- Navigation -->
            <div class=\"navbar-collapse collapse\">
                <ul id=\"menu-header\" class=\"nav navbar-nav navbar-left menu-header\" style=\"padding-top: 30px;\">
                    <li class=\"menu-item menu-item-type-post_type menu-item-object-page\">
                        <a title=\"Shop\" href=\"/\" style=\"color: #c13233;   font-size: 20px;\">Home</a>
                    </li>
                    <li class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown\">
                        <a title=\"Categorías\" href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\" style=\"color: #c13233;   font-size: 20px;\">Categorías <b class=\"fa fa-angle-down\"></b></a>
                        
                        <ul role=\"menu\" class=\" dropdown-menu\">
                             
                            ";
        // line 77
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["categorias"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["categoria"]) {
            // line 78
            echo "                      
                            <li class=\"menu-item menu-item-type-custom menu-item-object-custom\">
                                <a title=\"Categoria ";
            // line 80
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["categoria"], "name", array()), "html", null, true);
            echo " \" href=\"/";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["categoria"], "slug", array()), "html", null, true);
            echo "\" style=\"color: #c13233;   font-size: 20px;\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["categoria"], "name", array()), "html", null, true);
            echo "</a>
                            </li>
                            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['categoria'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 83
        echo "                        </ul>
                    </li>                    
                    <li class=\"menu-item menu-item-type-post_type menu-item-object-page\">
                        <a title=\"Blog\" href=\"/blog-list\" style=\"color: #c13233;   font-size: 25px;\">Blog</a>
                    </li>
                     <ul class=\"nav navbar-nav navbar-right\" >
                            <li class=\"dropdown\" id=\"cart-dropdown-li\">
                                <i class=\"fa fa-shopping-bag\" aria-hidden=\"true\" id=\"cart-top\" style=\"color: black;   font-size: 25px;\"></i>
                                <span class=\"cart-count\" id=\"cart-count\">0</span>
                                <div class=\"dropdown-menu\" id=\"cart-dropdown\">
                                      ";
        // line 93
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('Cms\Twig\Extension')->componentFunction("Cart::dropdown"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 94
        echo "                                </div>
                            </li>
                        </ul>
                    
                </ul>
            </div>
        </div>
        <div class=\"clearfix\"></div>
    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/site/header.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  162 => 94,  158 => 93,  146 => 83,  133 => 80,  129 => 78,  125 => 77,  105 => 62,  74 => 33,  68 => 29,  52 => 16,  46 => 13,  39 => 9,  36 => 8,  34 => 7,  28 => 4,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div id=\"top-header\" >
    <div class=\"container\" >
        <div class=\"row top-header-div\">
            <div class=\"col-md-3\">Bienvenidos a {{ seo_title }}</div>
            <div class=\"col-md-6\"></div>
            <div class=\"col-md-3\">
                {% if user %}
                <li class=\"dropdown\" >
                    <a class=\"dropdown-toggle\" data-toggle=\"dropdown\" href=\"#\" style=\"font-size: 25px; color: #fafafa; \">Hello {{ user.name }}
                        <span class=\"caret\"></span></a>
                    <ul class=\"dropdown-menu\">
                        <li>
                            <a href=\"/user/order\" style=\"font-size: 25px; color: #e21515; \">{{ 'ideas.shop::lang.component.order_manager' | trans }} </a>
                        </li>
                        <li>
                            <a href=\"/user/address\" style=\"font-size: 25px; color: #e21515; \">{{ 'ideas.shop::lang.component.address_manager' | trans }}</a>
                        </li>
                        <li>
                            <a href=\"/pin/public/\" style=\"font-size: 25px; color: #e21515; \">Diligencia tu ficha</a>
                        </li>
                        <li>
                            <a data-request=\"onLogout\" data-request-data=\"redirect: '/'\" style=\"font-size: 25px; color: #e21515; \">LOG OUT</a>
                        </li>
                        <li></li>
                        <li></li>
                    </ul>
                </li>
                {% else %}
                <a href=\"/login\" class=\"top-header-a\">SIGN IN</a>
                OR
                <a href=\"/register\" class=\"top-header-a\">REGISTER</a>
                {% endif %}
                
            </div>
        </div>
    </div>
</div>
<div class=\"container\">
    <div class=\"row top-header-div\">
        <div id=\"logo\" class=\"col-md-3\"><img src=\"\" /></div>
        <div id=\"form-search\" class=\"col-md-6\">
            <form action=\"/search-result\" method=\"get\" id=\"form-search-form\">
                <div class=\"form-group\" id=\"search-form-top\">
                    <input type=\"text\" id=\"search-input-top\" name=\"key\"
                           class=\"form-control\" placeholder=\"search\"/>
                    <i class=\"fa fa-search\" aria-hidden=\"true\" id=\"search-top-icon\"></i>
                </div>
            </form>
        </div>
        <div class=\"col-md-3\" id=\"support-phone-div\">
            <i class=\"fa fa-phone\" aria-hidden=\"true\"></i>
            <span class=\"support-phone\">123456789</span>
        </div>
    </div>
</div>
<div class=\"nav-wrapper\" id=\"navbar\">
    <div class=\"navbar navbar-custom\" role=\"navigation\">
        <div class=\"container\">
            <!-- Logo -->
            <div class=\"navbar-header\">
                <button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-collapse\"><i class=\"fa fa-bars\"></i></button>
                <a href=\"{{ 'samples/eshop' | page }}\" ><img src=\"{{'assets/images/logo-vitacode-400.png' | theme}}\" ></a>
            </div>
            <!-- /Logo -->
        
            <!-- Navigation -->
            <div class=\"navbar-collapse collapse\">
                <ul id=\"menu-header\" class=\"nav navbar-nav navbar-left menu-header\" style=\"padding-top: 30px;\">
                    <li class=\"menu-item menu-item-type-post_type menu-item-object-page\">
                        <a title=\"Shop\" href=\"/\" style=\"color: #c13233;   font-size: 20px;\">Home</a>
                    </li>
                    <li class=\"menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown\">
                        <a title=\"Categorías\" href=\"#\" data-toggle=\"dropdown\" class=\"dropdown-toggle\" style=\"color: #c13233;   font-size: 20px;\">Categorías <b class=\"fa fa-angle-down\"></b></a>
                        
                        <ul role=\"menu\" class=\" dropdown-menu\">
                             
                            {% for categoria in categorias %}
                      
                            <li class=\"menu-item menu-item-type-custom menu-item-object-custom\">
                                <a title=\"Categoria {{ categoria.name }} \" href=\"/{{ categoria.slug }}\" style=\"color: #c13233;   font-size: 20px;\">{{ categoria.name }}</a>
                            </li>
                            {% endfor %}
                        </ul>
                    </li>                    
                    <li class=\"menu-item menu-item-type-post_type menu-item-object-page\">
                        <a title=\"Blog\" href=\"/blog-list\" style=\"color: #c13233;   font-size: 25px;\">Blog</a>
                    </li>
                     <ul class=\"nav navbar-nav navbar-right\" >
                            <li class=\"dropdown\" id=\"cart-dropdown-li\">
                                <i class=\"fa fa-shopping-bag\" aria-hidden=\"true\" id=\"cart-top\" style=\"color: black;   font-size: 25px;\"></i>
                                <span class=\"cart-count\" id=\"cart-count\">0</span>
                                <div class=\"dropdown-menu\" id=\"cart-dropdown\">
                                      {% component 'Cart::dropdown' %}
                                </div>
                            </li>
                        </ul>
                    
                </ul>
            </div>
        </div>
        <div class=\"clearfix\"></div>
    </div>
</div>", "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/site/header.htm", "");
    }
}
