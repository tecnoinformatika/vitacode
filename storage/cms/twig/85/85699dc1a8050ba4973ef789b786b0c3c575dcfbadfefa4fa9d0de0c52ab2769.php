<?php

/* /home/ubuntu/workspace/plugins/ideas/shop/components/cart/dropdown.htm */
class __TwigTemplate_20d634c621ef153397de8ba3b98ed0dfd708346c33254361ac8c2dd7272d1b4e extends Twig_Template
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
        echo "<div id=\"msg_js\" style=\"display: none\">";
        echo twig_escape_filter($this->env, ($context["msg_js"] ?? null), "html", null, true);
        echo "</div>
";
        // line 2
        if ( !twig_test_empty(($context["cart"] ?? null))) {
            // line 3
            echo "    <table>
        <tbody>
        ";
            // line 5
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable(($context["cart"] ?? null));
            foreach ($context['_seq'] as $context["_key"] => $context["item"]) {
                // line 6
                echo "        <tr>
            <td>
                <a href=\"";
                // line 8
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "slug", array()), "html", null, true);
                echo "\">
                    <img src=\"";
                // line 9
                echo $this->extensions['System\Twig\Extension']->mediaFilter(twig_get_attribute($this->env, $this->source, $context["item"], "image", array()));
                echo "\" width=\"70\" height=\"70\"/>
                </a>
            </td>
            <td>
                <div class=\"product-cart-name\"><a href=\"";
                // line 13
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "slug", array()), "html", null, true);
                echo "\">";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "name", array()), "html", null, true);
                echo "</a></div>
                <div class=\"product-money-qty\">";
                // line 14
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "qty", array()), "html", null, true);
                echo " x \$";
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "price", array()), "html", null, true);
                echo " </div>
            </td>
            <td><i class=\"fa fa-trash-o cart-remove-item\" attr-product-id=\"";
                // line 16
                echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, $context["item"], "id", array()), "html", null, true);
                echo "\" aria-hidden=\"true\"></i></td>
        </tr>
        ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 19
            echo "        </tbody>
    </table>
    <div class=\"hr-class-30\"></div>
    <div class=\"cart-sub-total\">
        <div class=\"cart-sub-total-text pull-left\">";
            // line 23
            echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.component.sub_total"));
            echo "</div>
        <div class=\"cart-sub-total-money pull-right\"> ";
            // line 24
            echo call_user_func_array($this->env->getFilter('displayPriceAndCurrency')->getCallable(), array(($context["totalPrice"] ?? null)));
            echo "</div>
    </div>
    <div id=\"view-cart\">
        <a href=\"/cart\" class=\"view-cart text-center\">";
            // line 27
            echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.component.view_cart"));
            echo "</a>
    </div>
";
        } else {
            // line 30
            echo "    No item
";
        }
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/plugins/ideas/shop/components/cart/dropdown.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  97 => 30,  91 => 27,  85 => 24,  81 => 23,  75 => 19,  66 => 16,  59 => 14,  53 => 13,  46 => 9,  42 => 8,  38 => 6,  34 => 5,  30 => 3,  28 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div id=\"msg_js\" style=\"display: none\">{{msg_js}}</div>
{% if cart is not empty %}
    <table>
        <tbody>
        {% for item in cart %}
        <tr>
            <td>
                <a href=\"{{item.slug}}\">
                    <img src=\"{{item.image | media}}\" width=\"70\" height=\"70\"/>
                </a>
            </td>
            <td>
                <div class=\"product-cart-name\"><a href=\"{{item.slug}}\">{{item.name}}</a></div>
                <div class=\"product-money-qty\">{{item.qty}} x \${{item.price}} </div>
            </td>
            <td><i class=\"fa fa-trash-o cart-remove-item\" attr-product-id=\"{{item.id}}\" aria-hidden=\"true\"></i></td>
        </tr>
        {% endfor %}
        </tbody>
    </table>
    <div class=\"hr-class-30\"></div>
    <div class=\"cart-sub-total\">
        <div class=\"cart-sub-total-text pull-left\">{{ 'ideas.shop::lang.component.sub_total' | trans }}</div>
        <div class=\"cart-sub-total-money pull-right\"> {{totalPrice | displayPriceAndCurrency}}</div>
    </div>
    <div id=\"view-cart\">
        <a href=\"/cart\" class=\"view-cart text-center\">{{ 'ideas.shop::lang.component.view_cart' | trans }}</a>
    </div>
{% else %}
    No item
{% endif %}", "/home/ubuntu/workspace/plugins/ideas/shop/components/cart/dropdown.htm", "");
    }
}
