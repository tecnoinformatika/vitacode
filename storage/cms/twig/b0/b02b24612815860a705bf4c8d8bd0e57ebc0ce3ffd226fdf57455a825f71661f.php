<?php

/* /home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/site/modalConfirmCart.htm */
class __TwigTemplate_7664a5989a30a8b9cd3b6f46191508a134d6b19d1df85324bee8b21d6cbaff8a extends Twig_Template
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
        echo "<div id=\"modalConfirmCart\" class=\"modal fade\" role=\"dialog\">
    <div class=\"modal-dialog\">

        <!-- Modal content-->
        <div class=\"modal-content\">
            <div class=\"modal-body\">
                <p> ";
        // line 7
        echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.msg.add_item_success"));
        echo "</p>
            </div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">
                    ";
        // line 11
        echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.msg.continue_shopping"));
        echo "
                </button>
                <a href=\"/cart\" class=\"btn btn-primary\">
                    ";
        // line 14
        echo call_user_func_array($this->env->getFilter('trans')->getCallable(), array("ideas.shop::lang.msg.go_to_cart"));
        echo "
                </a>
            </div>
        </div>

    </div>
</div>";
    }

    public function getTemplateName()
    {
        return "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/site/modalConfirmCart.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 14,  38 => 11,  31 => 7,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("<div id=\"modalConfirmCart\" class=\"modal fade\" role=\"dialog\">
    <div class=\"modal-dialog\">

        <!-- Modal content-->
        <div class=\"modal-content\">
            <div class=\"modal-body\">
                <p> {{ 'ideas.shop::lang.msg.add_item_success' | trans }}</p>
            </div>
            <div class=\"modal-footer\">
                <button type=\"button\" class=\"btn btn-default\" data-dismiss=\"modal\">
                    {{ 'ideas.shop::lang.msg.continue_shopping' | trans }}
                </button>
                <a href=\"/cart\" class=\"btn btn-primary\">
                    {{ 'ideas.shop::lang.msg.go_to_cart' | trans }}
                </a>
            </div>
        </div>

    </div>
</div>", "/home/ubuntu/workspace/themes/ideas-ideasshoptemplatesimple/partials/site/modalConfirmCart.htm", "");
    }
}
