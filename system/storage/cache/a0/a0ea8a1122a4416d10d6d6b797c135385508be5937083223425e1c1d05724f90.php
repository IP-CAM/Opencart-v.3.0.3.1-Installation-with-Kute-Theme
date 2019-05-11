<?php

/* extension/payment/pumbolt.twig */
class __TwigTemplate_4ac0bd8af05557d56ce0ceefa1c1aa138232f55117855c9e4810c01088096526 extends Twig_Template
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
        echo (isset($context["header"]) ? $context["header"] : null);
        echo (isset($context["column_left"]) ? $context["column_left"] : null);
        echo "
<div id=\"content\">
  <div class=\"page-header\">
  <div class=\"container-fluid\">
  <div class=\"pull-right\">
         <button type=\"submit\" form=\"form-payment\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo (isset($context["button_save"]) ? $context["button_save"] : null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
        <a href=\"";
        // line 7
        echo (isset($context["cancel"]) ? $context["cancel"] : null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_cancel"]) ? $context["button_cancel"] : null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a></div>
      <h1>";
        // line 8
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "</h1>
 
  <ul class=\"breadcrumb\">
    ";
        // line 11
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["breadcrumbs"]) ? $context["breadcrumbs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 12
            echo "        <li><a href=\"";
            echo $this->getAttribute($context["breadcrumb"], "href", array());
            echo "\">";
            echo $this->getAttribute($context["breadcrumb"], "text", array());
            echo "</a></li>
        ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 14
        echo "  </ul>
  </div>
  </div>
  <div class=\"container-fluid\">
    ";
        // line 18
        if ((isset($context["error_warning"]) ? $context["error_warning"] : null)) {
            // line 19
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo (isset($context["error_warning"]) ? $context["error_warning"] : null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 23
        echo "  <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i>";
        // line 25
        echo (isset($context["text_edit"]) ? $context["text_edit"] : null);
        echo "</h3>
  </div>
  <form action=\"";
        // line 27
        echo (isset($context["action"]) ? $context["action"] : null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" name=\"form-pumbolt\" id=\"form-pumbolt\" class=\"form-horizontal\">
 <div class=\"box\">
  <!--// PayU //-->
  <div class=\"heading\">
       <h1><img src=\"view/image/payment/payulogo.png\" alt=\"PayU Money\" height=\"40\" /></h1>
   </div>
 <div class=\"content\">
  <div class=\"panel-body\">
        <div class=\"col-sm-10\"> 
          <div class=\"form-group required\">
            <label class=\"col-sm-2 control-label\" for=\"input-merchant\"><span data-toggle=\"tooltip\" title=\"";
        // line 37
        echo (isset($context["help_merchant"]) ? $context["help_merchant"] : null);
        echo "\">";
        echo (isset($context["entry_merchant"]) ? $context["entry_merchant"] : null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_pumbolt_payu_key\" value=\"";
        // line 39
        echo (isset($context["payment_pumbolt_payu_key"]) ? $context["payment_pumbolt_payu_key"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_merchant"]) ? $context["entry_merchant"] : null);
        echo "\" id=\"payment_pumbolt_payu_key\" class=\"form-control\" />
              ";
        // line 40
        if ((isset($context["error_merchant"]) ? $context["error_merchant"] : null)) {
            echo " 
              <div class=\"text-danger\">";
            // line 41
            echo (isset($context["error_merchant"]) ? $context["error_merchant"] : null);
            echo "</div>
              ";
        }
        // line 43
        echo "            </div>
          </div>
          <div class=\"form-group required\">
            <label class=\"col-sm-2 control-label\" for=\"input-salt\"><span data-toggle=\"tooltip\" title=\"";
        // line 46
        echo (isset($context["help_salt"]) ? $context["help_salt"] : null);
        echo "\">";
        echo (isset($context["entry_salt"]) ? $context["entry_salt"] : null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_pumbolt_payu_salt\" value=\"";
        // line 48
        echo (isset($context["payment_pumbolt_payu_salt"]) ? $context["payment_pumbolt_payu_salt"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_salt"]) ? $context["entry_salt"] : null);
        echo "\" id=\"payment_pumbolt_payu_salt\" class=\"form-control\" />
              ";
        // line 49
        if ( !twig_test_empty((isset($context["error_salt"]) ? $context["error_salt"] : null))) {
            // line 50
            echo "              <div class=\"text-danger\">";
            echo (isset($context["error_salt"]) ? $context["error_salt"] : null);
            echo "</div>
              ";
        }
        // line 52
        echo "            </div>
          </div>


      </div>
     </div>
     </div>
    <!--// PayU End //-->

 <!--// Common Settings //-->
 <div class=\"box\">
 <div>&nbsp;</div>
 <div class=\"content\">
  <div class=\"panel-body\">
        <div class=\"col-sm-10\"> 
        \t<div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-total\">";
        // line 68
        echo (isset($context["entry_module"]) ? $context["entry_module"] : null);
        echo "</label>
              <div class=\"col-sm-10\">
                  <select name=\"payment_pumbolt_module\" id=\"payment_pumbolt_module\" class=\"form-control\">
\t\t\t\t  \t";
        // line 71
        $context["ms"] = twig_split_filter($this->env, (isset($context["entry_module_id"]) ? $context["entry_module_id"] : null), "|");
        // line 72
        echo "                    ";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["ms"]) ? $context["ms"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["m"]) {
            // line 73
            echo "                    \t";
            if (((isset($context["payment_pumbolt_module"]) ? $context["payment_pumbolt_module"] : null) == $context["m"])) {
                // line 74
                echo "                    \t\t<option value=\"";
                echo $context["m"];
                echo "\" selected>";
                echo $context["m"];
                echo "</option>
                    \t";
            } else {
                // line 76
                echo "                       \t\t<option value=\"";
                echo $context["m"];
                echo "\">";
                echo $context["m"];
                echo "</option>
                    \t";
            }
            // line 78
            echo "\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['m'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 79
        echo "                  </select>
              </div>
              ";
        // line 81
        if ((isset($context["error_module"]) ? $context["error_module"] : null)) {
            // line 82
            echo "                  <span class=\"error\">";
            echo (isset($context["error_module"]) ? $context["error_module"] : null);
            echo "</span>
              ";
        }
        // line 84
        echo "            </div> 
         
         <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-geo-zone\">";
        // line 87
        echo (isset($context["entry_geo_zone"]) ? $context["entry_geo_zone"] : null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"payment_pumbolt_geo_zone_id\" id=\"payment_pumbolt_geo_zone_id\" class=\"form-control\">
                <option value=\"0\">";
        // line 90
        echo (isset($context["text_all_zones"]) ? $context["text_all_zones"] : null);
        echo "</option>
                ";
        // line 91
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["geo_zones"]) ? $context["geo_zones"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["geo_zone"]) {
            // line 92
            echo "                ";
            if (($this->getAttribute($context["geo_zone"], "geo_zone_id", array()) == (isset($context["payment_pumbolt_geo_zone_id"]) ? $context["payment_pumbolt_geo_zone_id"] : null))) {
                // line 93
                echo "                <option value=\"";
                echo $this->getAttribute($context["geo_zone"], "geo_zone_id", array(), "array");
                echo "\" selected=\"selected\">";
                echo $this->getAttribute($context["geo_zone"], "name", array(), "array");
                echo "</option>
                ";
            } else {
                // line 95
                echo "                <option value=\"";
                echo $this->getAttribute($context["geo_zone"], "geo_zone_id", array(), "array");
                echo "\">";
                echo $this->getAttribute($context["geo_zone"], "name", array(), "array");
                echo "</option>
                ";
            }
            // line 97
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['geo_zone'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 98
        echo "              </select>
            </div>
          </div>
          
           <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-total\"><span data-toggle=\"tooltip\" title=\"";
        // line 103
        echo (isset($context["help_currency"]) ? $context["help_currency"] : null);
        echo "\">";
        echo (isset($context["entry_currency"]) ? $context["entry_currency"] : null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_pumbolt_currency\" value=\"";
        // line 105
        echo (isset($context["payment_pumbolt_currency"]) ? $context["payment_pumbolt_currency"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_currency"]) ? $context["entry_currency"] : null);
        echo "\" id=\"payment_pumbolt_currency\" size=\"8\" maxlength=\"3\" class=\"form-control\" />
              ";
        // line 106
        if ((isset($context["error_currency"]) ? $context["error_currency"] : null)) {
            // line 107
            echo "                  <div class=\"text-danger\">";
            echo (isset($context["error_currency"]) ? $context["error_currency"] : null);
            echo "</div>
              ";
        }
        // line 109
        echo "            </div>
          </div>
          
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-total\"><span data-toggle=\"tooltip\" title=\"";
        // line 113
        echo (isset($context["help_total"]) ? $context["help_total"] : null);
        echo "\">";
        echo (isset($context["entry_total"]) ? $context["entry_total"] : null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_pumbolt_total\" value=\"";
        // line 115
        echo (isset($context["payment_pumbolt_total"]) ? $context["payment_pumbolt_total"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_total"]) ? $context["entry_total"] : null);
        echo "\" id=\"payment_pumbolt_total\" class=\"form-control\" />
            </div>
          </div>
          
          <!--order_status-->
          
          <div class=\"form-group\">
             <label class=\"col-sm-2 control-label\" for=\"input-total\">";
        // line 122
        echo (isset($context["entry_order_status"]) ? $context["entry_order_status"] : null);
        echo "</label>
               <div class=\"col-sm-10\">
                 <select name=\"payment_pumbolt_order_status_id\" id=\"payment_pumbolt_order_status_id\" class=\"form-control\">
                    ";
        // line 125
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["order_statuses"]) ? $context["order_statuses"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 126
            echo "                    ";
            if (($this->getAttribute($context["order_status"], "order_status_id", array()) == (isset($context["payment_pumbolt_order_status_id"]) ? $context["payment_pumbolt_order_status_id"] : null))) {
                // line 127
                echo "                      <option value=\"";
                echo $this->getAttribute($context["order_status"], "order_status_id", array(), "array");
                echo "\" selected=\"selected\">";
                echo $this->getAttribute($context["order_status"], "name", array(), "array");
                echo "</option>
\t\t\t\t\t";
            } else {
                // line 129
                echo "                      <option value=\"";
                echo $this->getAttribute($context["order_status"], "order_status_id", array(), "array");
                echo "\">";
                echo $this->getAttribute($context["order_status"], "name", array(), "array");
                echo "</option>
                    ";
            }
            // line 131
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 132
        echo "                 </select>
               </div> 
          </div>
          
          <!--order_status-->          
          
          <!--order_fail_status-->
          
          <div class=\"form-group\">
             <label class=\"col-sm-2 control-label\" for=\"input-total\">";
        // line 141
        echo (isset($context["entry_order_fail_status"]) ? $context["entry_order_fail_status"] : null);
        echo "</label>
               <div class=\"col-sm-10\">
                 <select name=\"payment_pumbolt_order_fail_status_id\" id=\"input-status\" class=\"form-control\">
                    ";
        // line 144
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["order_statuses"]) ? $context["order_statuses"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 145
            echo "                    ";
            if (($this->getAttribute($context["order_status"], "order_status_id", array()) == (isset($context["payment_pumbolt_order_fail_status_id"]) ? $context["payment_pumbolt_order_fail_status_id"] : null))) {
                // line 146
                echo "                      <option value=\"";
                echo $this->getAttribute($context["order_status"], "order_status_id", array(), "array");
                echo "\" selected=\"selected\">";
                echo $this->getAttribute($context["order_status"], "name", array(), "array");
                echo "</option>
                    ";
            } else {
                // line 148
                echo "                      <option value=\"";
                echo $this->getAttribute($context["order_status"], "order_status_id", array(), "array");
                echo "\">";
                echo $this->getAttribute($context["order_status"], "name", array(), "array");
                echo "</option>
                    ";
            }
            // line 150
            echo "                    ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 151
        echo "                 </select>
               </div> 
          </div>
          
          <!--order_fail_status-->    
          
          <div class=\"form-group\">
              <label class=\"col-sm-2 control-label\" for=\"input-total\">";
        // line 158
        echo (isset($context["entry_status"]) ? $context["entry_status"] : null);
        echo "</label>
                 <div class=\"col-sm-10\">
                   <select name=\"payment_pumbolt_status\" id=\"input-status\" class=\"form-control\">
                      ";
        // line 161
        if (((isset($context["payment_pumbolt_status"]) ? $context["payment_pumbolt_status"] : null) == true)) {
            // line 162
            echo "                         <option value=\"1\" selected=\"selected\">";
            echo (isset($context["text_enabled"]) ? $context["text_enabled"] : null);
            echo "</option>
                         <option value=\"0\">";
            // line 163
            echo (isset($context["text_disabled"]) ? $context["text_disabled"] : null);
            echo "</option>
                      ";
        } else {
            // line 165
            echo "                         <option value=\"1\">";
            echo (isset($context["text_enabled"]) ? $context["text_enabled"] : null);
            echo "</option>
                         <option value=\"0\" selected=\"selected\">";
            // line 166
            echo (isset($context["text_disabled"]) ? $context["text_disabled"] : null);
            echo "</option>
                      ";
        }
        // line 168
        echo "                   </select>
                   ";
        // line 169
        if ((isset($context["error_status"]) ? $context["error_status"] : null)) {
            // line 170
            echo "                \t<div class=\"text-danger\">";
            echo (isset($context["error_status"]) ? $context["error_status"] : null);
            echo "</div>
            \t \t";
        }
        // line 172
        echo "                 </div>                  
          </div>
          
          <div class=\"form-group\">
               <label class=\"col-sm-2 control-label\" for=\"input-total\">";
        // line 176
        echo (isset($context["entry_sort_order"]) ? $context["entry_sort_order"] : null);
        echo "</label>
               \t <div class=\"col-sm-10\">
                      <input type=\"text\" name=\"payment_pumbolt_sort_order\" value=\"";
        // line 178
        echo (isset($context["payment_pumbolt_sort_order"]) ? $context["payment_pumbolt_sort_order"] : null);
        echo "\"  id=\"input-sort-order\"class=\"form-control\"size=\"1\" />
                 </div>
          </div>  
         
 \t\t</div>
  </div>
 </div>
 </div> 
   <!--// Common Settings End //-->
<hr />
</form>
";
        // line 189
        echo (isset($context["footer"]) ? $context["footer"] : null);
    }

    public function getTemplateName()
    {
        return "extension/payment/pumbolt.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  464 => 189,  450 => 178,  445 => 176,  439 => 172,  433 => 170,  431 => 169,  428 => 168,  423 => 166,  418 => 165,  413 => 163,  408 => 162,  406 => 161,  400 => 158,  391 => 151,  385 => 150,  377 => 148,  369 => 146,  366 => 145,  362 => 144,  356 => 141,  345 => 132,  339 => 131,  331 => 129,  323 => 127,  320 => 126,  316 => 125,  310 => 122,  298 => 115,  291 => 113,  285 => 109,  279 => 107,  277 => 106,  271 => 105,  264 => 103,  257 => 98,  251 => 97,  243 => 95,  235 => 93,  232 => 92,  228 => 91,  224 => 90,  218 => 87,  213 => 84,  207 => 82,  205 => 81,  201 => 79,  195 => 78,  187 => 76,  179 => 74,  176 => 73,  171 => 72,  169 => 71,  163 => 68,  145 => 52,  139 => 50,  137 => 49,  131 => 48,  124 => 46,  119 => 43,  114 => 41,  110 => 40,  104 => 39,  97 => 37,  84 => 27,  79 => 25,  75 => 23,  67 => 19,  65 => 18,  59 => 14,  48 => 12,  44 => 11,  38 => 8,  32 => 7,  28 => 6,  19 => 1,);
    }
}
/* {{ header }}{{ column_left }}*/
/* <div id="content">*/
/*   <div class="page-header">*/
/*   <div class="container-fluid">*/
/*   <div class="pull-right">*/
/*          <button type="submit" form="form-payment" data-toggle="tooltip" title="{{ button_save }}" class="btn btn-primary"><i class="fa fa-save"></i></button>*/
/*         <a href="{{ cancel }}" data-toggle="tooltip" title="{{ button_cancel }}" class="btn btn-default"><i class="fa fa-reply"></i></a></div>*/
/*       <h1>{{ heading_title }}</h1>*/
/*  */
/*   <ul class="breadcrumb">*/
/*     {% for breadcrumb in breadcrumbs %}*/
/*         <li><a href="{{ breadcrumb.href }}">{{ breadcrumb.text }}</a></li>*/
/*         {% endfor %}*/
/*   </ul>*/
/*   </div>*/
/*   </div>*/
/*   <div class="container-fluid">*/
/*     {% if error_warning %}*/
/*     <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> {{ error_warning }}*/
/*       <button type="button" class="close" data-dismiss="alert">&times;</button>*/
/*     </div>*/
/*     {% endif %}*/
/*   <div class="panel panel-default">*/
/*       <div class="panel-heading">*/
/*         <h3 class="panel-title"><i class="fa fa-pencil"></i>{{ text_edit }}</h3>*/
/*   </div>*/
/*   <form action="{{ action }}" method="post" enctype="multipart/form-data" name="form-pumbolt" id="form-pumbolt" class="form-horizontal">*/
/*  <div class="box">*/
/*   <!--// PayU //-->*/
/*   <div class="heading">*/
/*        <h1><img src="view/image/payment/payulogo.png" alt="PayU Money" height="40" /></h1>*/
/*    </div>*/
/*  <div class="content">*/
/*   <div class="panel-body">*/
/*         <div class="col-sm-10"> */
/*           <div class="form-group required">*/
/*             <label class="col-sm-2 control-label" for="input-merchant"><span data-toggle="tooltip" title="{{ help_merchant }}">{{ entry_merchant }}</span></label>*/
/*             <div class="col-sm-10">*/
/*               <input type="text" name="payment_pumbolt_payu_key" value="{{ payment_pumbolt_payu_key }}" placeholder="{{ entry_merchant }}" id="payment_pumbolt_payu_key" class="form-control" />*/
/*               {% if error_merchant %} */
/*               <div class="text-danger">{{ error_merchant }}</div>*/
/*               {% endif %}*/
/*             </div>*/
/*           </div>*/
/*           <div class="form-group required">*/
/*             <label class="col-sm-2 control-label" for="input-salt"><span data-toggle="tooltip" title="{{ help_salt }}">{{ entry_salt }}</span></label>*/
/*             <div class="col-sm-10">*/
/*               <input type="text" name="payment_pumbolt_payu_salt" value="{{ payment_pumbolt_payu_salt }}" placeholder="{{ entry_salt }}" id="payment_pumbolt_payu_salt" class="form-control" />*/
/*               {% if error_salt is not empty %}*/
/*               <div class="text-danger">{{ error_salt }}</div>*/
/*               {% endif %}*/
/*             </div>*/
/*           </div>*/
/* */
/* */
/*       </div>*/
/*      </div>*/
/*      </div>*/
/*     <!--// PayU End //-->*/
/* */
/*  <!--// Common Settings //-->*/
/*  <div class="box">*/
/*  <div>&nbsp;</div>*/
/*  <div class="content">*/
/*   <div class="panel-body">*/
/*         <div class="col-sm-10"> */
/*         	<div class="form-group">*/
/*             <label class="col-sm-2 control-label" for="input-total">{{ entry_module }}</label>*/
/*               <div class="col-sm-10">*/
/*                   <select name="payment_pumbolt_module" id="payment_pumbolt_module" class="form-control">*/
/* 				  	{% set ms = entry_module_id|split('|') %}*/
/*                     {% for m in ms %}*/
/*                     	{% if payment_pumbolt_module == m %}*/
/*                     		<option value="{{ m }}" selected>{{ m }}</option>*/
/*                     	{% else %}*/
/*                        		<option value="{{ m }}">{{ m }}</option>*/
/*                     	{% endif %}*/
/* 					{% endfor %}*/
/*                   </select>*/
/*               </div>*/
/*               {% if error_module %}*/
/*                   <span class="error">{{ error_module }}</span>*/
/*               {% endif %}*/
/*             </div> */
/*          */
/*          <div class="form-group">*/
/*             <label class="col-sm-2 control-label" for="input-geo-zone">{{ entry_geo_zone }}</label>*/
/*             <div class="col-sm-10">*/
/*               <select name="payment_pumbolt_geo_zone_id" id="payment_pumbolt_geo_zone_id" class="form-control">*/
/*                 <option value="0">{{ text_all_zones }}</option>*/
/*                 {% for geo_zone in geo_zones %}*/
/*                 {% if geo_zone.geo_zone_id == payment_pumbolt_geo_zone_id %}*/
/*                 <option value="{{ geo_zone['geo_zone_id'] }}" selected="selected">{{ geo_zone['name'] }}</option>*/
/*                 {% else %}*/
/*                 <option value="{{ geo_zone['geo_zone_id'] }}">{{ geo_zone['name'] }}</option>*/
/*                 {% endif %}*/
/*                 {% endfor %}*/
/*               </select>*/
/*             </div>*/
/*           </div>*/
/*           */
/*            <div class="form-group">*/
/*             <label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="{{ help_currency }}">{{ entry_currency }}</span></label>*/
/*             <div class="col-sm-10">*/
/*               <input type="text" name="payment_pumbolt_currency" value="{{ payment_pumbolt_currency }}" placeholder="{{ entry_currency }}" id="payment_pumbolt_currency" size="8" maxlength="3" class="form-control" />*/
/*               {% if error_currency %}*/
/*                   <div class="text-danger">{{ error_currency }}</div>*/
/*               {% endif %}*/
/*             </div>*/
/*           </div>*/
/*           */
/*           <div class="form-group">*/
/*             <label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="{{ help_total }}">{{ entry_total }}</span></label>*/
/*             <div class="col-sm-10">*/
/*               <input type="text" name="payment_pumbolt_total" value="{{ payment_pumbolt_total }}" placeholder="{{ entry_total }}" id="payment_pumbolt_total" class="form-control" />*/
/*             </div>*/
/*           </div>*/
/*           */
/*           <!--order_status-->*/
/*           */
/*           <div class="form-group">*/
/*              <label class="col-sm-2 control-label" for="input-total">{{ entry_order_status }}</label>*/
/*                <div class="col-sm-10">*/
/*                  <select name="payment_pumbolt_order_status_id" id="payment_pumbolt_order_status_id" class="form-control">*/
/*                     {% for order_status in order_statuses %}*/
/*                     {% if order_status.order_status_id == payment_pumbolt_order_status_id %}*/
/*                       <option value="{{ order_status['order_status_id'] }}" selected="selected">{{ order_status['name'] }}</option>*/
/* 					{% else %}*/
/*                       <option value="{{ order_status['order_status_id'] }}">{{ order_status['name'] }}</option>*/
/*                     {% endif %}*/
/*                     {% endfor %}*/
/*                  </select>*/
/*                </div> */
/*           </div>*/
/*           */
/*           <!--order_status-->          */
/*           */
/*           <!--order_fail_status-->*/
/*           */
/*           <div class="form-group">*/
/*              <label class="col-sm-2 control-label" for="input-total">{{ entry_order_fail_status }}</label>*/
/*                <div class="col-sm-10">*/
/*                  <select name="payment_pumbolt_order_fail_status_id" id="input-status" class="form-control">*/
/*                     {% for order_status in order_statuses %}*/
/*                     {% if order_status.order_status_id == payment_pumbolt_order_fail_status_id %}*/
/*                       <option value="{{ order_status['order_status_id'] }}" selected="selected">{{ order_status['name'] }}</option>*/
/*                     {% else %}*/
/*                       <option value="{{ order_status['order_status_id'] }}">{{ order_status['name'] }}</option>*/
/*                     {% endif %}*/
/*                     {% endfor %}*/
/*                  </select>*/
/*                </div> */
/*           </div>*/
/*           */
/*           <!--order_fail_status-->    */
/*           */
/*           <div class="form-group">*/
/*               <label class="col-sm-2 control-label" for="input-total">{{ entry_status }}</label>*/
/*                  <div class="col-sm-10">*/
/*                    <select name="payment_pumbolt_status" id="input-status" class="form-control">*/
/*                       {% if payment_pumbolt_status == true %}*/
/*                          <option value="1" selected="selected">{{ text_enabled }}</option>*/
/*                          <option value="0">{{ text_disabled }}</option>*/
/*                       {% else %}*/
/*                          <option value="1">{{ text_enabled }}</option>*/
/*                          <option value="0" selected="selected">{{ text_disabled }}</option>*/
/*                       {% endif %}*/
/*                    </select>*/
/*                    {% if error_status %}*/
/*                 	<div class="text-danger">{{ error_status }}</div>*/
/*             	 	{% endif %}*/
/*                  </div>                  */
/*           </div>*/
/*           */
/*           <div class="form-group">*/
/*                <label class="col-sm-2 control-label" for="input-total">{{ entry_sort_order }}</label>*/
/*                	 <div class="col-sm-10">*/
/*                       <input type="text" name="payment_pumbolt_sort_order" value="{{ payment_pumbolt_sort_order }}"  id="input-sort-order"class="form-control"size="1" />*/
/*                  </div>*/
/*           </div>  */
/*          */
/*  		</div>*/
/*   </div>*/
/*  </div>*/
/*  </div> */
/*    <!--// Common Settings End //-->*/
/* <hr />*/
/* </form>*/
/* {{ footer }}*/
