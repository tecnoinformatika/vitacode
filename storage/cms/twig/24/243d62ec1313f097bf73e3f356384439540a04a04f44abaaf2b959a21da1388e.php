<?php

/* /home/ubuntu/workspace/plugins/ideas/shop/components/product/category.htm */
class __TwigTemplate_0b9d6fa9a91f9692fc301d443626c56112932b5eaafb35eba449f563cbcd8c26 extends Twig_Template
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
        if ((($context["found_result"] ?? null) == ($context["page_not_found"] ?? null))) {
            // line 2
            echo "    ";
            $context['__cms_partial_params'] = [];
            echo $this->env->getExtension('Cms\Twig\Extension')->partialFunction((($context["__SELF__"] ?? null) . "::404")            , $context['__cms_partial_params']            , true            );
            unset($context['__cms_partial_params']);
        } else {
            // line 4
            echo "<div class=\"category-top\">
    <img class=\"img-responsive\" src=\"";
            // line 5
            echo $this->extensions['System\Twig\Extension']->mediaFilter(($context["image_header_bottom"] ?? null));
            echo "\" />
</div>
<div class=\"container\" id=\"breadcrumb-div\">
    <div class=\"row\">
        <ul class=\"breadcrumb\">
            <li><a href=\"/\">Home</a></li>
            ";
            // line 11
            echo call_user_func_array($this->env->getFilter('breadCrumbDisplay')->getCallable(), array(($context["breadCrumb"] ?? null)));
            echo "
        </ul>
    </div>
</div>
<div class=\"container\" id=\"category-div\">
    <div class=\"row\" id=\"sort-grid\">
        <div class=\"col-md-3 sort-grid\" id=\"sort-grid-count\">Showing ";
            // line 17
            echo twig_escape_filter($this->env, ($context["count"] ?? null), "html", null, true);
            echo " result</div>
        <div class=\"col-md-6\"></div>
        <div class=\"col-md-1 sort-grid\" id=\"sort-grid-sort-by\">Sort By</div>
        <div class=\"col-md-2 sort-grid\" id=\"sort-grid-select\">
            <div class=\"form-group\">
                <select name=\"sort-by\" id=\"product-sort-by\" class=\"form-control\">
                    <option value=\"\">-- sort by --</option>
                    <option value=\"price-asc\" ";
            // line 24
            echo (((($context["sortByString"] ?? null) == "price-asc")) ? ("selected") : (""));
            echo ">Price low to high</option>
                    <option value=\"price-desc\" ";
            // line 25
            echo (((($context["sortByString"] ?? null) == "price-desc")) ? ("selected") : (""));
            echo ">Price high to low</option>
                </select>
            </div>
        </div>
    </div>
    <div class=\"row\">
            <div class=\"col-md-3\" id=\"filter-div\">
            <!-- now shopping by -->
            <div class=\"filter-header accordion\">
                Now Shopping by
            </div>
            <div class=\"filter-body panel\" id=\"now-shopping-by\">
    
            </div>
            <!-- end now shopping by -->
    
            <!-- SEARCH -->
            <div class=\"filter-header accordion\">
                Search
            </div>
            <div class=\"filter-body panel\" id=\"filter-search\">
                <ul>
                    <li class=\"filter-search form-group\">
                        <input type=\"text\" name=\"search_product\" id=\"search_product\" class=\"form-control\" value=\"\" />
                        <i class=\"fa fa-search\" id=\"category-fa-search\" aria-hidden=\"true\"></i>
                    </li>
                </ul>
            </div>
            <!-- END SEARCH -->
    
            <!-- PRICE RANGE -->
            <div class=\"filter-header accordion\">
                Price
            </div>
            <div class=\"filter-body panel\" id=\"filter-price-range\">
                <div class=\"filter-price\">
                    <div id=\"price-range\">
                        <b class=\"pull-left\">\$ 15.00</b>
                        <b class=\"pull-right\">\$ 800.00</b>
                    </div>
                    <input id=\"ex2\" type=\"text\" class=\"span2\" value=\"\"
                           data-slider-min=\"15.00\" data-slider-max=\"800.00\"
                           data-slider-step=\"5\"
                           data-slider-value=\"[15.00,800.00]\"/>
                </div>
                <ul>
                    <li id=\"price-range-div\">
                        <input type=\"text\" value=\"15.00\" class=\"price-range\"/>
                        <span class=\"price-range\" id=\"price-range-between\"></span>
                        <input type=\"text\" value=\"800.00\" class=\"price-range\"/>
                    </li>
                </ul>
            </div>
            <!-- END PRICE RANGE -->
    
            <!-- FILTER -->
                    <div class=\"filter-header accordion\">
                color
            </div>
            <div class=\"filter-body panel\">
                <ul>
                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"2\"
                        />
                                            <div class=\"filter_option_color_category\"
                             style=\"background-color: #0f0f0f\"></div>
                                            <span class=\"filter-counter\">2</span>
                    </li>
                                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"1\"
                        />
                                            <div class=\"filter_option_color_category\"
                             style=\"background-color: #ffffff\"></div>
                                            <span class=\"filter-counter\">3</span>
                    </li>
                                                </ul>
            </div>
                    <div class=\"filter-header accordion\">
                size
            </div>
            <div class=\"filter-body panel\">
                <ul>
                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"5\"
                        />
                                            <a href=\"javascript:void(0);\">L</a>
                                            <span class=\"filter-counter\">3</span>
                    </li>
                                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"3\"
                        />
                                            <a href=\"javascript:void(0);\">S</a>
                                            <span class=\"filter-counter\">3</span>
                    </li>
                                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"4\"
                        />
                                            <a href=\"javascript:void(0);\">M</a>
                                            <span class=\"filter-counter\">2</span>
                    </li>
                                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"6\"
                        />
                                            <a href=\"javascript:void(0);\">XL</a>
                                            <span class=\"filter-counter\">2</span>
                    </li>
                                                </ul>
            </div>
                    <div class=\"filter-header accordion\">
                brand
            </div>
            <div class=\"filter-body panel\">
                <ul>
                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"7\"
                        />
                                            <a href=\"javascript:void(0);\">Sony</a>
                                            <span class=\"filter-counter\">3</span>
                    </li>
                                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"8\"
                        />
                                            <a href=\"javascript:void(0);\">LG</a>
                                            <span class=\"filter-counter\">1</span>
                    </li>
                                                </ul>
            </div>
                    <div class=\"filter-header accordion\">
                test
            </div>
            <div class=\"filter-body panel\">
                <ul>
                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"9\"
                        />
                                            <a href=\"javascript:void(0);\">111</a>
                                            <span class=\"filter-counter\">2</span>
                    </li>
                                                </ul>
            </div>
                    <!-- END FILTER -->
    
            <!-- RATING -->
            <div class=\"filter-header accordion\">
                Rating
            </div>
            <div class=\"filter-body panel\">
                <ul>
                                    <li class=\"review-point\" attr-point=\"0\"> (11)</li>
                                    <li class=\"review-point\" attr-point=\"4\"><span class=\"fa fa-star checked\"></span><span class=\"fa fa-star checked\"></span><span class=\"fa fa-star checked\"></span><span class=\"fa fa-star checked\"></span><span class=\"fa fa-star\"></span> (2)</li>
                                </ul>
            </div>
            <!-- END RATING -->
    
        </div>
        <div class=\"col-md-9\" id=\"list-product\">
            <div class=\"row\">
                ";
            // line 182
            if ( !twig_test_empty(($context["data"] ?? null))) {
                // line 183
                echo "                ";
                $context["i"] = 1;
                // line 184
                echo "                ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(($context["data"] ?? null));
                foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
                    // line 185
                    echo "                <div class=\"col-md-4 product-div ";
                    echo ((twig_in_filter(($context["i"] ?? null), ($context["firstArray"] ?? null))) ? ("first") : (""));
                    echo "\">
                    <div class=\"product-image\">
                        <a href=\"";
                    // line 187
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product"], "slug", array()), "html", null, true);
                    echo "\">
                            <img class=\"img-responsive\" src=\"";
                    // line 188
                    echo call_user_func_array($this->env->getFilter('noImage')->getCallable(), array($this->extensions['System\Twig\Extension']->mediaFilter(twig_get_attribute($this->env, $this->source, $context["product"], "featured_image", array()))));
                    echo "\">
                        </a>
                    </div>
                    <div class=\"product-name text-center\">
                        <a href=\"";
                    // line 192
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product"], "slug", array()), "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product"], "name", array()), "html", null, true);
                    echo "</a>
                    </div>
                    <div class=\"product-price text-center\">
                        ";
                    // line 195
                    echo call_user_func_array($this->env->getFilter('displayPriceAndCurrency')->getCallable(), array(twig_get_attribute($this->env, $this->source, $context["product"], "price", array())));
                    echo "
                    </div>
                    <div class=\"text-center\">
                        ";
                    // line 198
                    echo call_user_func_array($this->env->getFilter('displayReview')->getCallable(), array(twig_get_attribute($this->env, $this->source, $context["product"], "review_point", array())));
                    echo "
                    </div>
                    <div class=\"text-center\">
                        <button class=\"btn btn-primary ";
                    // line 201
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product"], "action_class", array()), "html", null, true);
                    echo "\"
                                attr-qty=\"";
                    // line 202
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product"], "qty", array()), "html", null, true);
                    echo "\"
                                attr-qty-order=\"";
                    // line 203
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product"], "qty_order", array()), "html", null, true);
                    echo "\"
                                attr-name=\"";
                    // line 204
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product"], "name", array()), "html", null, true);
                    echo "\"
                                attr-image=\"";
                    // line 205
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product"], "featured_image", array()), "html", null, true);
                    echo "\"
                                attr-price=\"";
                    // line 206
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product"], "final_price", array()), "html", null, true);
                    echo "\"
                                attr-product-id=\"";
                    // line 207
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product"], "id", array()), "html", null, true);
                    echo "\"
                                attr-slug=\"";
                    // line 208
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product"], "slug", array()), "html", null, true);
                    echo "\"
                                attr-weight=\"";
                    // line 209
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product"], "weight", array()), "html", null, true);
                    echo "\"
                                attr-weight-id=\"";
                    // line 210
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product"], "weight_id", array()), "html", null, true);
                    echo "\"
                                >
                            ";
                    // line 212
                    echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["product"], "action_text", array()), "html", null, true);
                    echo "
                        </button>
                    </div>
                </div>
                ";
                    // line 216
                    $context["i"] = (($context["i"] ?? null) + 1);
                    // line 217
                    echo "                ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 218
                echo "                ";
            } else {
                // line 219
                echo "                No data
                ";
            }
            // line 221
            echo "            </div>

            <div class=\"row text-center\">
                <div class=\"pagination\">
                    <ul>
                        ";
            // line 226
            if ((twig_get_attribute($this->env, $this->source, ($context["pages"] ?? null), "currentPage", array()) != 1)) {
                // line 227
                echo "                        <li><a href=\"javascript:void(0)\" class=\"cat-pag\" attr-page=\"1\"> << </a></li>
                        <li><a href=\"javascript:void(0)\" class=\"cat-pag\" attr-page=\"";
                // line 228
                echo twig_escape_filter($this->env, (twig_get_attribute($this->env, $this->source, ($context["page"] ?? null), "currentPage", array()) - 1), "html", null, true);
                echo "\"> < </a></li>
                        ";
            }
            // line 230
            echo "                        ";
            if ((twig_get_attribute($this->env, $this->source, ($context["pages"] ?? null), "totalPages", array()) != 1)) {
                // line 231
                echo "                        ";
                $context['_parent'] = $context;
                $context['_seq'] = twig_ensure_traversable(twig_get_attribute($this->env, $this->source, ($context["pages"] ?? null), "pages", array()));
                foreach ($context['_seq'] as $context["_key"] => $context["page"]) {
                    // line 232
                    echo "                        <li class=\"\">
                            <a href=\"javascript:void(0)\"
                               class=\"";
                    // line 234
                    echo (((twig_get_attribute($this->env, $this->source, ($context["pages"] ?? null), "currentPage", array()) == $context["page"])) ? ("active") : (""));
                    echo " cat-pag\"
                               attr-page=\"";
                    // line 235
                    echo twig_escape_filter($this->env, $context["page"], "html", null, true);
                    echo "\">";
                    echo twig_escape_filter($this->env, $context["page"], "html", null, true);
                    echo "
                            </a>
                        </li>
                        ";
                }
                $_parent = $context['_parent'];
                unset($context['_seq'], $context['_iterated'], $context['_key'], $context['page'], $context['_parent'], $context['loop']);
                $context = array_intersect_key($context, $_parent) + $_parent;
                // line 239
                echo "                        ";
            }
            // line 240
            echo "                        ";
            if ((twig_get_attribute($this->env, $this->source, ($context["pages"] ?? null), "currentPage", array()) != twig_get_attribute($this->env, $this->source, ($context["pages"] ?? null), "totalPages", array()))) {
                // line 241
                echo "                        <li><a href=\"javascript:void(0)\" class=\"cat-pag\" attr-page=\"";
                echo twig_escape_filter($this->env, (twig_get_attribute($this->env, $this->source, ($context["pages"] ?? null), "currentPage", array()) + 1), "html", null, true);
                echo "\"> > </a></li>
                        <li><a href=\"javascript:void(0)\" class=\"cat-pag\" attr-page=\"";
                // line 242
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["pages"] ?? null), "totalPages", array()), "html", null, true);
                echo "\"> >> </a></li>
                        ";
            }
            // line 244
            echo "                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
";
        }
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/plugins/ideas/shop/components/product/category.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  397 => 244,  392 => 242,  387 => 241,  384 => 240,  381 => 239,  369 => 235,  365 => 234,  361 => 232,  356 => 231,  353 => 230,  348 => 228,  345 => 227,  343 => 226,  336 => 221,  332 => 219,  329 => 218,  323 => 217,  321 => 216,  314 => 212,  309 => 210,  305 => 209,  301 => 208,  297 => 207,  293 => 206,  289 => 205,  285 => 204,  281 => 203,  277 => 202,  273 => 201,  267 => 198,  261 => 195,  253 => 192,  246 => 188,  242 => 187,  236 => 185,  231 => 184,  228 => 183,  226 => 182,  66 => 25,  62 => 24,  52 => 17,  43 => 11,  34 => 5,  31 => 4,  25 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("{% if found_result == page_not_found %}
    {% partial __SELF__ ~ \"::404\"%}
{% else %}
<div class=\"category-top\">
    <img class=\"img-responsive\" src=\"{{image_header_bottom | media}}\" />
</div>
<div class=\"container\" id=\"breadcrumb-div\">
    <div class=\"row\">
        <ul class=\"breadcrumb\">
            <li><a href=\"/\">Home</a></li>
            {{breadCrumb | breadCrumbDisplay}}
        </ul>
    </div>
</div>
<div class=\"container\" id=\"category-div\">
    <div class=\"row\" id=\"sort-grid\">
        <div class=\"col-md-3 sort-grid\" id=\"sort-grid-count\">Showing {{count}} result</div>
        <div class=\"col-md-6\"></div>
        <div class=\"col-md-1 sort-grid\" id=\"sort-grid-sort-by\">Sort By</div>
        <div class=\"col-md-2 sort-grid\" id=\"sort-grid-select\">
            <div class=\"form-group\">
                <select name=\"sort-by\" id=\"product-sort-by\" class=\"form-control\">
                    <option value=\"\">-- sort by --</option>
                    <option value=\"price-asc\" {{sortByString == 'price-asc' ? 'selected' : ''}}>Price low to high</option>
                    <option value=\"price-desc\" {{sortByString == 'price-desc' ? 'selected' : ''}}>Price high to low</option>
                </select>
            </div>
        </div>
    </div>
    <div class=\"row\">
            <div class=\"col-md-3\" id=\"filter-div\">
            <!-- now shopping by -->
            <div class=\"filter-header accordion\">
                Now Shopping by
            </div>
            <div class=\"filter-body panel\" id=\"now-shopping-by\">
    
            </div>
            <!-- end now shopping by -->
    
            <!-- SEARCH -->
            <div class=\"filter-header accordion\">
                Search
            </div>
            <div class=\"filter-body panel\" id=\"filter-search\">
                <ul>
                    <li class=\"filter-search form-group\">
                        <input type=\"text\" name=\"search_product\" id=\"search_product\" class=\"form-control\" value=\"\" />
                        <i class=\"fa fa-search\" id=\"category-fa-search\" aria-hidden=\"true\"></i>
                    </li>
                </ul>
            </div>
            <!-- END SEARCH -->
    
            <!-- PRICE RANGE -->
            <div class=\"filter-header accordion\">
                Price
            </div>
            <div class=\"filter-body panel\" id=\"filter-price-range\">
                <div class=\"filter-price\">
                    <div id=\"price-range\">
                        <b class=\"pull-left\">\$ 15.00</b>
                        <b class=\"pull-right\">\$ 800.00</b>
                    </div>
                    <input id=\"ex2\" type=\"text\" class=\"span2\" value=\"\"
                           data-slider-min=\"15.00\" data-slider-max=\"800.00\"
                           data-slider-step=\"5\"
                           data-slider-value=\"[15.00,800.00]\"/>
                </div>
                <ul>
                    <li id=\"price-range-div\">
                        <input type=\"text\" value=\"15.00\" class=\"price-range\"/>
                        <span class=\"price-range\" id=\"price-range-between\"></span>
                        <input type=\"text\" value=\"800.00\" class=\"price-range\"/>
                    </li>
                </ul>
            </div>
            <!-- END PRICE RANGE -->
    
            <!-- FILTER -->
                    <div class=\"filter-header accordion\">
                color
            </div>
            <div class=\"filter-body panel\">
                <ul>
                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"2\"
                        />
                                            <div class=\"filter_option_color_category\"
                             style=\"background-color: #0f0f0f\"></div>
                                            <span class=\"filter-counter\">2</span>
                    </li>
                                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"1\"
                        />
                                            <div class=\"filter_option_color_category\"
                             style=\"background-color: #ffffff\"></div>
                                            <span class=\"filter-counter\">3</span>
                    </li>
                                                </ul>
            </div>
                    <div class=\"filter-header accordion\">
                size
            </div>
            <div class=\"filter-body panel\">
                <ul>
                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"5\"
                        />
                                            <a href=\"javascript:void(0);\">L</a>
                                            <span class=\"filter-counter\">3</span>
                    </li>
                                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"3\"
                        />
                                            <a href=\"javascript:void(0);\">S</a>
                                            <span class=\"filter-counter\">3</span>
                    </li>
                                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"4\"
                        />
                                            <a href=\"javascript:void(0);\">M</a>
                                            <span class=\"filter-counter\">2</span>
                    </li>
                                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"6\"
                        />
                                            <a href=\"javascript:void(0);\">XL</a>
                                            <span class=\"filter-counter\">2</span>
                    </li>
                                                </ul>
            </div>
                    <div class=\"filter-header accordion\">
                brand
            </div>
            <div class=\"filter-body panel\">
                <ul>
                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"7\"
                        />
                                            <a href=\"javascript:void(0);\">Sony</a>
                                            <span class=\"filter-counter\">3</span>
                    </li>
                                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"8\"
                        />
                                            <a href=\"javascript:void(0);\">LG</a>
                                            <span class=\"filter-counter\">1</span>
                    </li>
                                                </ul>
            </div>
                    <div class=\"filter-header accordion\">
                test
            </div>
            <div class=\"filter-body panel\">
                <ul>
                                                    <li>
                        <input type=\"checkbox\" class=\"filter-option\" value=\"9\"
                        />
                                            <a href=\"javascript:void(0);\">111</a>
                                            <span class=\"filter-counter\">2</span>
                    </li>
                                                </ul>
            </div>
                    <!-- END FILTER -->
    
            <!-- RATING -->
            <div class=\"filter-header accordion\">
                Rating
            </div>
            <div class=\"filter-body panel\">
                <ul>
                                    <li class=\"review-point\" attr-point=\"0\"> (11)</li>
                                    <li class=\"review-point\" attr-point=\"4\"><span class=\"fa fa-star checked\"></span><span class=\"fa fa-star checked\"></span><span class=\"fa fa-star checked\"></span><span class=\"fa fa-star checked\"></span><span class=\"fa fa-star\"></span> (2)</li>
                                </ul>
            </div>
            <!-- END RATING -->
    
        </div>
        <div class=\"col-md-9\" id=\"list-product\">
            <div class=\"row\">
                {% if data is not empty %}
                {% set i = 1 %}
                {% for product in data%}
                <div class=\"col-md-4 product-div {{i in firstArray ? 'first' : ''}}\">
                    <div class=\"product-image\">
                        <a href=\"{{product.slug}}\">
                            <img class=\"img-responsive\" src=\"{{product.featured_image | media | noImage }}\">
                        </a>
                    </div>
                    <div class=\"product-name text-center\">
                        <a href=\"{{product.slug}}\">{{product.name}}</a>
                    </div>
                    <div class=\"product-price text-center\">
                        {{product.price | displayPriceAndCurrency}}
                    </div>
                    <div class=\"text-center\">
                        {{ product.review_point | displayReview}}
                    </div>
                    <div class=\"text-center\">
                        <button class=\"btn btn-primary {{product.action_class}}\"
                                attr-qty=\"{{product.qty}}\"
                                attr-qty-order=\"{{product.qty_order}}\"
                                attr-name=\"{{product.name}}\"
                                attr-image=\"{{product.featured_image}}\"
                                attr-price=\"{{product.final_price}}\"
                                attr-product-id=\"{{product.id}}\"
                                attr-slug=\"{{product.slug}}\"
                                attr-weight=\"{{product.weight}}\"
                                attr-weight-id=\"{{product.weight_id}}\"
                                >
                            {{product.action_text}}
                        </button>
                    </div>
                </div>
                {% set i = i + 1 %}
                {% endfor %}
                {% else %}
                No data
                {% endif %}
            </div>

            <div class=\"row text-center\">
                <div class=\"pagination\">
                    <ul>
                        {% if pages.currentPage != 1 %}
                        <li><a href=\"javascript:void(0)\" class=\"cat-pag\" attr-page=\"1\"> << </a></li>
                        <li><a href=\"javascript:void(0)\" class=\"cat-pag\" attr-page=\"{{page.currentPage - 1}}\"> < </a></li>
                        {% endif %}
                        {% if pages.totalPages != 1 %}
                        {% for page in pages.pages %}
                        <li class=\"\">
                            <a href=\"javascript:void(0)\"
                               class=\"{{pages.currentPage == page ? 'active' : ''}} cat-pag\"
                               attr-page=\"{{page}}\">{{page}}
                            </a>
                        </li>
                        {% endfor %}
                        {% endif %}
                        {% if pages.currentPage != pages.totalPages %}
                        <li><a href=\"javascript:void(0)\" class=\"cat-pag\" attr-page=\"{{pages.currentPage + 1}}\"> > </a></li>
                        <li><a href=\"javascript:void(0)\" class=\"cat-pag\" attr-page=\"{{pages.totalPages}}\"> >> </a></li>
                        {% endif %}
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
{% endif%}", "/home/ubuntu/workspace/plugins/ideas/shop/components/product/category.htm", "");
    }
}
