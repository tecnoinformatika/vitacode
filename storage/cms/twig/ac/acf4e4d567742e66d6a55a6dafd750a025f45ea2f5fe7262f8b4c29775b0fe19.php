<?php

/* /home/ubuntu/workspace/plugins/ideas/shop/components/cart/ajaxCart.htm */
class __TwigTemplate_65a30831bb4d53f790fa0396efc211095b9e7bdfc273d01a01f62eda046c2d65 extends Twig_Template
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
        echo "<div class=\"row table-responsive\">
    <table class=\"table\" id=\"table-cart\">
        <thead>
        <tr>
            <th>";
        // line 5
        echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.component.image"));
        echo "</th>
            <th>";
        // line 6
        echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.component.product_name"));
        echo "</th>
            <th>";
        // line 7
        echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.component.price"));
        echo "</th>
            <th>";
        // line 8
        echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.component.qty"));
        echo "</th>
            <th>";
        // line 9
        echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.component.total"));
        echo "</th>
            <th>";
        // line 10
        echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.component.delete"));
        echo "</th>
        </tr>
        </thead>
        <tbody>
        ";
        // line 14
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable(($context["cartDetail"] ?? null));
        foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
            // line 15
            echo "        <tr class=\"cart-tr\">
            <td>
                <a href=\"";
            // line 17
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "slug", array()), "html", null, true);
            echo "\">
                    <img class=\"cart-product-image\" src=\"";
            // line 18
            echo $this->extensions['System\Twig\Extension']->mediaFilter(twig_get_attribute($this->env, $this->source, $context["item"], "image", array()));
            echo "\" />
                </a>
            </td>
            <td class=\"cart-product-name\"><a href=\"";
            // line 21
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "slug", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", array()), "html", null, true);
            echo "</a></td>
            <td>";
            // line 22
            echo call_user_func_array($this->env->getFilter('displayPriceAndCurrency')->getCallable(), array(twig_get_attribute($this->env, $this->source, $context["item"], "price", array())));
            echo "</td>
            <td>
                <input type=\"number\" name=\"qty\" class=\"cart-qty\"
                       attr-qty=\"";
            // line 25
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "qty_origin", array()), "html", null, true);
            echo "\"
                       attr-qty-order=\"";
            // line 26
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "qty_order", array()), "html", null, true);
            echo "\"
                       attr-name=\"";
            // line 27
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", array()), "html", null, true);
            echo "\"
                       attr-image=\"";
            // line 28
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "featured_image", array()), "html", null, true);
            echo "\"
                       attr-price=\"";
            // line 29
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "price", array()), "html", null, true);
            echo "\"
                       attr-product-id=\"";
            // line 30
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", array()), "html", null, true);
            echo "\" value=\"";
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "qty", array()), "html", null, true);
            echo "\"/>
            </td>
            <td>\$ ";
            // line 32
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "total_price_per_item", array()), "html", null, true);
            echo "</td>
            <td>
                <i class=\"fa fa-trash-o cart-remove-item-detail\" attr-product-id=\"";
            // line 34
            echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", array()), "html", null, true);
            echo "\" aria-hidden=\"true\"></i>
            </td>
        </tr>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 38
        echo "        </tbody>
    </table>
</div>
<div class=\"row\">
    <div class=\"col-md-12\">
        <div class=\"btn btn-default pull-left\">";
        // line 43
        echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.component.continue_shopping"));
        echo "</div>

    </div>
</div>
<!-- COUPON -->
<br/>
<div class=\"row\">
    <div class=\"col-md-8\">

    </div>
    <div class=\"col-md-4\" id=\"cart-total-div\">
        <div id=\"cart-total-title\">
            ";
        // line 55
        echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.component.cart_total"));
        echo "
        </div>
        <div id=\"cart-total-sum\">
            <table>
                <tbody>
                <tr>
                    <td>";
        // line 61
        echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.component.sub_total"));
        echo "</td>
                    <td>";
        // line 62
        echo call_user_func_array($this->env->getFilter('displayPriceAndCurrency')->getCallable(), array(($context["totalPrice"] ?? null)));
        echo "</td>
                </tr>
                <tr>
                    <td>";
        // line 65
        echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.component.total"));
        echo "</td>
                    <td>";
        // line 66
        echo call_user_func_array($this->env->getFilter('displayPriceAndCurrency')->getCallable(), array(($context["totalPrice"] ?? null)));
        echo "</td>
                </tr>
                </tbody>
            </table>
        </div>
        <a href=\"/checkout\" class=\"btn btn-primary\">
            ";
        // line 72
        echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.component.process_to_checkout"));
        echo "
        </a>
    </div>
</div>
<div class=\"hr-class\"></div>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/plugins/ideas/shop/components/cart/ajaxCart.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  182 => 72,  173 => 66,  169 => 65,  163 => 62,  159 => 61,  150 => 55,  135 => 43,  128 => 38,  118 => 34,  113 => 32,  106 => 30,  102 => 29,  98 => 28,  94 => 27,  90 => 26,  86 => 25,  80 => 22,  74 => 21,  68 => 18,  64 => 17,  60 => 15,  56 => 14,  49 => 10,  45 => 9,  41 => 8,  37 => 7,  33 => 6,  29 => 5,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div class=\"row table-responsive\">
    <table class=\"table\" id=\"table-cart\">
        <thead>
        <tr>
            <th>{{ 'ideas.shop::lang.component.image' | trans }}</th>
            <th>{{ 'ideas.shop::lang.component.product_name' | trans }}</th>
            <th>{{ 'ideas.shop::lang.component.price' | trans }}</th>
            <th>{{ 'ideas.shop::lang.component.qty' | trans }}</th>
            <th>{{ 'ideas.shop::lang.component.total' | trans }}</th>
            <th>{{ 'ideas.shop::lang.component.delete' | trans }}</th>
        </tr>
        </thead>
        <tbody>
        {% for item in cartDetail %}
        <tr class=\"cart-tr\">
            <td>
                <a href=\"{{item.slug}}\">
                    <img class=\"cart-product-image\" src=\"{{item.image | media}}\" />
                </a>
            </td>
            <td class=\"cart-product-name\"><a href=\"{{item.slug}}\">{{item.name}}</a></td>
            <td>{{item.price | displayPriceAndCurrency}}</td>
            <td>
                <input type=\"number\" name=\"qty\" class=\"cart-qty\"
                       attr-qty=\"{{item.qty_origin}}\"
                       attr-qty-order=\"{{item.qty_order}}\"
                       attr-name=\"{{item.name}}\"
                       attr-image=\"{{item.featured_image}}\"
                       attr-price=\"{{item.price}}\"
                       attr-product-id=\"{{item.id}}\" value=\"{{item.qty}}\"/>
            </td>
            <td>\$ {{item.total_price_per_item}}</td>
            <td>
                <i class=\"fa fa-trash-o cart-remove-item-detail\" attr-product-id=\"{{item.id}}\" aria-hidden=\"true\"></i>
            </td>
        </tr>
        {% endfor %}
        </tbody>
    </table>
</div>
<div class=\"row\">
    <div class=\"col-md-12\">
        <div class=\"btn btn-default pull-left\">{{ 'ideas.shop::lang.component.continue_shopping' | trans }}</div>

    </div>
</div>
<!-- COUPON -->
<br/>
<div class=\"row\">
    <div class=\"col-md-8\">

    </div>
    <div class=\"col-md-4\" id=\"cart-total-div\">
        <div id=\"cart-total-title\">
            {{ 'ideas.shop::lang.component.cart_total' | trans }}
        </div>
        <div id=\"cart-total-sum\">
            <table>
                <tbody>
                <tr>
                    <td>{{ 'ideas.shop::lang.component.sub_total' | trans }}</td>
                    <td>{{totalPrice | displayPriceAndCurrency}}</td>
                </tr>
                <tr>
                    <td>{{ 'ideas.shop::lang.component.total' | trans }}</td>
                    <td>{{totalPrice | displayPriceAndCurrency}}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <a href=\"/checkout\" class=\"btn btn-primary\">
            {{ 'ideas.shop::lang.component.process_to_checkout' | trans }}
        </a>
    </div>
</div>
<div class=\"hr-class\"></div>", "/home/ubuntu/workspace/plugins/ideas/shop/components/cart/ajaxCart.htm", "");
    }
}
