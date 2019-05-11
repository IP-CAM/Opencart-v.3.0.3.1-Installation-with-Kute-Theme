<?php

/* default/template/extension/payment/free_checkout.twig */
class __TwigTemplate_db88223526857c5e5e75dcf1e91db31f3199129f33c29da13eaecf1e0af05910 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<div class=\"buttons\">
  <div class=\"pull-right\">
    <input type=\"button\" value=\"";
        // line 3
        echo (isset($context["button_confirm"]) ? $context["button_confirm"] : null);
        echo "\" id=\"button-confirm\" class=\"btn btn-primary\" data-loading-text=\"";
        echo (isset($context["text_loading"]) ? $context["text_loading"] : null);
        echo "\" />
  </div>
</div>
<script type=\"text/javascript\"><!--
\$('#button-confirm').on('click', function() {
\t\$.ajax({
\t\ttype: 'get',
\t\turl: 'index.php?route=extension/payment/free_checkout/confirm',
\t\tcache: false,
\t\tbeforeSend: function() {
\t\t\t\$('#button-confirm').button('loading');
\t\t},
\t\tcomplete: function() {
\t\t\t\$('#button-confirm').button('reset');
\t\t},
\t\tsuccess: function() {
\t\t\tlocation = '";
        // line 19
        echo (isset($context["continue"]) ? $context["continue"] : null);
        echo "';
\t\t}
\t});
});
//--></script>
";
    }

    public function getTemplateName()
    {
        return "default/template/extension/payment/free_checkout.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  44 => 19,  23 => 3,  19 => 1,);
    }
}
/* <div class="buttons">*/
/*   <div class="pull-right">*/
/*     <input type="button" value="{{ button_confirm }}" id="button-confirm" class="btn btn-primary" data-loading-text="{{ text_loading }}" />*/
/*   </div>*/
/* </div>*/
/* <script type="text/javascript"><!--*/
/* $('#button-confirm').on('click', function() {*/
/* 	$.ajax({*/
/* 		type: 'get',*/
/* 		url: 'index.php?route=extension/payment/free_checkout/confirm',*/
/* 		cache: false,*/
/* 		beforeSend: function() {*/
/* 			$('#button-confirm').button('loading');*/
/* 		},*/
/* 		complete: function() {*/
/* 			$('#button-confirm').button('reset');*/
/* 		},*/
/* 		success: function() {*/
/* 			location = '{{ continue }}';*/
/* 		}*/
/* 	});*/
/* });*/
/* //--></script>*/
/* */
