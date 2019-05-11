<?php

/* extension/module/amazon_login.twig */
class __TwigTemplate_fed6bc7ade1749268db753dc0c05eda682547ed5f2c4331f4bbcbd5bcbbb3127 extends Twig_Template
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
        <button type=\"submit\" form=\"form-module\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo (isset($context["button_save"]) ? $context["button_save"] : null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-check-circle\"></i></button>
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
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["breadcrumbs"]) ? $context["breadcrumbs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 11
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
        // line 13
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\"> ";
        // line 16
        if ((isset($context["error_warning"]) ? $context["error_warning"] : null)) {
            // line 17
            echo "    <div class=\"alert alert-danger alert-dismissible\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button><i class=\"fa fa-exclamation-circle\"></i> ";
            echo (isset($context["error_warning"]) ? $context["error_warning"] : null);
            echo "
    </div>
    ";
        }
        // line 20
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 22
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 25
        echo (isset($context["action"]) ? $context["action"] : null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-module\" class=\"form-horizontal\">
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-button-type\">";
        // line 27
        echo (isset($context["entry_button_type"]) ? $context["entry_button_type"] : null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"module_amazon_login_button_type\" id=\"input-button-type\" class=\"form-control\">

\t\t\t\t";
        // line 31
        if (((isset($context["module_amazon_login_button_type"]) ? $context["module_amazon_login_button_type"] : null) == "Login")) {
            // line 32
            echo "
                <option value=\"LwA\" >";
            // line 33
            echo (isset($context["text_lwa_button"]) ? $context["text_lwa_button"] : null);
            echo "</option>
                <option value=\"Login\" selected=\"selected\">";
            // line 34
            echo (isset($context["text_login_button"]) ? $context["text_login_button"] : null);
            echo "</option>
                <option value=\"A\">";
            // line 35
            echo (isset($context["text_a_button"]) ? $context["text_a_button"] : null);
            echo "</option>

\t\t\t\t";
        } elseif ((        // line 37
(isset($context["module_amazon_login_button_type"]) ? $context["module_amazon_login_button_type"] : null) == "A")) {
            // line 38
            echo "
                <option value=\"LwA\" >";
            // line 39
            echo (isset($context["text_lwa_button"]) ? $context["text_lwa_button"] : null);
            echo "</option>
                <option value=\"Login\" >";
            // line 40
            echo (isset($context["text_login_button"]) ? $context["text_login_button"] : null);
            echo "</option>
                <option value=\"A\" selected=\"selected\">";
            // line 41
            echo (isset($context["text_a_button"]) ? $context["text_a_button"] : null);
            echo "</option>

\t\t\t\t";
        } else {
            // line 44
            echo "
                <option value=\"LwA\" selected=\"selected\">";
            // line 45
            echo (isset($context["text_lwa_button"]) ? $context["text_lwa_button"] : null);
            echo "</option>
                <option value=\"Login\" >";
            // line 46
            echo (isset($context["text_login_button"]) ? $context["text_login_button"] : null);
            echo "</option>
                <option value=\"A\">";
            // line 47
            echo (isset($context["text_a_button"]) ? $context["text_a_button"] : null);
            echo "</option>

\t\t\t\t";
        }
        // line 50
        echo "
              </select>
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-button-colour\">";
        // line 55
        echo (isset($context["entry_button_colour"]) ? $context["entry_button_colour"] : null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"module_amazon_login_button_colour\" id=\"input-button-colour\" class=\"form-control\">

\t\t\t\t";
        // line 59
        if (((isset($context["module_amazon_login_button_colour"]) ? $context["module_amazon_login_button_colour"] : null) == "DarkGray")) {
            // line 60
            echo "
                <option value=\"Gold\" >";
            // line 61
            echo (isset($context["text_gold_button"]) ? $context["text_gold_button"] : null);
            echo "</option>
                <option value=\"DarkGray\" selected=\"selected\">";
            // line 62
            echo (isset($context["text_darkgray_button"]) ? $context["text_darkgray_button"] : null);
            echo "</option>
                <option value=\"LightGray\">";
            // line 63
            echo (isset($context["text_lightgray_button"]) ? $context["text_lightgray_button"] : null);
            echo "</option>

\t\t\t\t";
        } elseif ((        // line 65
(isset($context["module_amazon_login_button_colour"]) ? $context["module_amazon_login_button_colour"] : null) == "LightGray")) {
            // line 66
            echo "
                <option value=\"Gold\" >";
            // line 67
            echo (isset($context["text_gold_button"]) ? $context["text_gold_button"] : null);
            echo "</option>
                <option value=\"DarkGray\">";
            // line 68
            echo (isset($context["text_darkgray_button"]) ? $context["text_darkgray_button"] : null);
            echo "</option>
                <option value=\"LightGray\" selected=\"selected\">";
            // line 69
            echo (isset($context["text_lightgray_button"]) ? $context["text_lightgray_button"] : null);
            echo "</option>

\t\t\t\t";
        } else {
            // line 72
            echo "
                <option value=\"Gold\" selected=\"selected\">";
            // line 73
            echo (isset($context["text_gold_button"]) ? $context["text_gold_button"] : null);
            echo "</option>
                <option value=\"DarkGray\">";
            // line 74
            echo (isset($context["text_darkgray_button"]) ? $context["text_darkgray_button"] : null);
            echo "</option>
                <option value=\"LightGray\">";
            // line 75
            echo (isset($context["text_lightgray_button"]) ? $context["text_lightgray_button"] : null);
            echo "</option>

\t\t\t\t";
        }
        // line 78
        echo "
              </select>
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-button-size\">";
        // line 83
        echo (isset($context["entry_button_size"]) ? $context["entry_button_size"] : null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"module_amazon_login_button_size\" id=\"input-button-size\" class=\"form-control\">

\t\t\t\t";
        // line 87
        if (((isset($context["module_amazon_login_button_size"]) ? $context["module_amazon_login_button_size"] : null) == "small")) {
            // line 88
            echo "\t\t\t\t\t
                <option value=\"small\" selected=\"selected\">";
            // line 89
            echo (isset($context["text_small_button"]) ? $context["text_small_button"] : null);
            echo "</option>
                <option value=\"medium\">";
            // line 90
            echo (isset($context["text_medium_button"]) ? $context["text_medium_button"] : null);
            echo "</option>
                <option value=\"large\" selected=\"selected\">";
            // line 91
            echo (isset($context["text_large_button"]) ? $context["text_large_button"] : null);
            echo "</option>
                <option value=\"x-large\">";
            // line 92
            echo (isset($context["text_x_large_button"]) ? $context["text_x_large_button"] : null);
            echo "</option>

\t\t\t\t";
        } elseif ((        // line 94
(isset($context["module_amazon_login_button_size"]) ? $context["module_amazon_login_button_size"] : null) == "large")) {
            // line 95
            echo "
                <option value=\"small\" >";
            // line 96
            echo (isset($context["text_small_button"]) ? $context["text_small_button"] : null);
            echo "</option>
                <option value=\"medium\">";
            // line 97
            echo (isset($context["text_medium_button"]) ? $context["text_medium_button"] : null);
            echo "</option>
                <option value=\"large\" selected=\"selected\">";
            // line 98
            echo (isset($context["text_large_button"]) ? $context["text_large_button"] : null);
            echo "</option>
                <option value=\"x-large\">";
            // line 99
            echo (isset($context["text_x_large_button"]) ? $context["text_x_large_button"] : null);
            echo "</option>

\t\t\t\t";
        } elseif ((        // line 101
(isset($context["module_amazon_login_button_size"]) ? $context["module_amazon_login_button_size"] : null) == "x-large")) {
            // line 102
            echo "
                <option value=\"small\">";
            // line 103
            echo (isset($context["text_small_button"]) ? $context["text_small_button"] : null);
            echo "</option>
                <option value=\"medium\">";
            // line 104
            echo (isset($context["text_medium_button"]) ? $context["text_medium_button"] : null);
            echo "</option>
                <option value=\"large\">";
            // line 105
            echo (isset($context["text_large_button"]) ? $context["text_large_button"] : null);
            echo "</option>
                <option value=\"x-large\" selected=\"selected\">";
            // line 106
            echo (isset($context["text_x_large_button"]) ? $context["text_x_large_button"] : null);
            echo "</option>

\t\t\t\t";
        } else {
            // line 109
            echo "
                <option value=\"small\">";
            // line 110
            echo (isset($context["text_small_button"]) ? $context["text_small_button"] : null);
            echo "</option>
                <option value=\"medium\" selected=\"selected\">";
            // line 111
            echo (isset($context["text_medium_button"]) ? $context["text_medium_button"] : null);
            echo "</option>
                <option value=\"large\">";
            // line 112
            echo (isset($context["text_large_button"]) ? $context["text_large_button"] : null);
            echo "</option>
                <option value=\"x-large\">";
            // line 113
            echo (isset($context["text_x_large_button"]) ? $context["text_x_large_button"] : null);
            echo "</option>

\t\t\t\t";
        }
        // line 116
        echo "
              </select>
            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-status\">";
        // line 121
        echo (isset($context["entry_status"]) ? $context["entry_status"] : null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"module_amazon_login_status\" id=\"input-status\" class=\"form-control\">

\t\t\t\t";
        // line 125
        if ((isset($context["module_amazon_login_status"]) ? $context["module_amazon_login_status"] : null)) {
            // line 126
            echo "
                <option value=\"1\" selected=\"selected\">";
            // line 127
            echo (isset($context["text_enabled"]) ? $context["text_enabled"] : null);
            echo "</option>
                <option value=\"0\">";
            // line 128
            echo (isset($context["text_disabled"]) ? $context["text_disabled"] : null);
            echo "</option>

\t\t\t\t";
        } else {
            // line 131
            echo "
                <option value=\"1\">";
            // line 132
            echo (isset($context["text_enabled"]) ? $context["text_enabled"] : null);
            echo "</option>
                <option value=\"0\" selected=\"selected\">";
            // line 133
            echo (isset($context["text_disabled"]) ? $context["text_disabled"] : null);
            echo "</option>

\t\t\t\t";
        }
        // line 136
        echo "
              </select>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
";
        // line 145
        echo (isset($context["footer"]) ? $context["footer"] : null);
        echo "
";
    }

    public function getTemplateName()
    {
        return "extension/module/amazon_login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  371 => 145,  360 => 136,  354 => 133,  350 => 132,  347 => 131,  341 => 128,  337 => 127,  334 => 126,  332 => 125,  325 => 121,  318 => 116,  312 => 113,  308 => 112,  304 => 111,  300 => 110,  297 => 109,  291 => 106,  287 => 105,  283 => 104,  279 => 103,  276 => 102,  274 => 101,  269 => 99,  265 => 98,  261 => 97,  257 => 96,  254 => 95,  252 => 94,  247 => 92,  243 => 91,  239 => 90,  235 => 89,  232 => 88,  230 => 87,  223 => 83,  216 => 78,  210 => 75,  206 => 74,  202 => 73,  199 => 72,  193 => 69,  189 => 68,  185 => 67,  182 => 66,  180 => 65,  175 => 63,  171 => 62,  167 => 61,  164 => 60,  162 => 59,  155 => 55,  148 => 50,  142 => 47,  138 => 46,  134 => 45,  131 => 44,  125 => 41,  121 => 40,  117 => 39,  114 => 38,  112 => 37,  107 => 35,  103 => 34,  99 => 33,  96 => 32,  94 => 31,  87 => 27,  82 => 25,  76 => 22,  72 => 20,  65 => 17,  63 => 16,  58 => 13,  47 => 11,  43 => 10,  38 => 8,  32 => 7,  28 => 6,  19 => 1,);
    }
}
/* {{ header }}{{ column_left }}*/
/* <div id="content">*/
/*   <div class="page-header">*/
/*     <div class="container-fluid">*/
/*       <div class="pull-right">*/
/*         <button type="submit" form="form-module" data-toggle="tooltip" title="{{ button_save }}" class="btn btn-primary"><i class="fa fa-check-circle"></i></button>*/
/*         <a href="{{ cancel }}" data-toggle="tooltip" title="{{ button_cancel }}" class="btn btn-default"><i class="fa fa-reply"></i></a></div>*/
/*       <h1>{{ heading_title }}</h1>*/
/*       <ul class="breadcrumb">*/
/*         {% for breadcrumb in breadcrumbs %}*/
/*         <li><a href="{{ breadcrumb.href }}">{{ breadcrumb.text }}</a></li>*/
/*         {% endfor %}*/
/*       </ul>*/
/*     </div>*/
/*   </div>*/
/*   <div class="container-fluid"> {% if error_warning %}*/
/*     <div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><i class="fa fa-exclamation-circle"></i> {{ error_warning }}*/
/*     </div>*/
/*     {% endif %}*/
/*     <div class="panel panel-default">*/
/*       <div class="panel-heading">*/
/*         <h3 class="panel-title"><i class="fa fa-pencil"></i> {{ heading_title }}</h3>*/
/*       </div>*/
/*       <div class="panel-body">*/
/*         <form action="{{ action }}" method="post" enctype="multipart/form-data" id="form-module" class="form-horizontal">*/
/*           <div class="form-group">*/
/*             <label class="col-sm-2 control-label" for="input-button-type">{{ entry_button_type }}</label>*/
/*             <div class="col-sm-10">*/
/*               <select name="module_amazon_login_button_type" id="input-button-type" class="form-control">*/
/* */
/* 				{% if module_amazon_login_button_type == 'Login' %}*/
/* */
/*                 <option value="LwA" >{{ text_lwa_button }}</option>*/
/*                 <option value="Login" selected="selected">{{ text_login_button }}</option>*/
/*                 <option value="A">{{ text_a_button }}</option>*/
/* */
/* 				{% elseif module_amazon_login_button_type == 'A' %}*/
/* */
/*                 <option value="LwA" >{{ text_lwa_button }}</option>*/
/*                 <option value="Login" >{{ text_login_button }}</option>*/
/*                 <option value="A" selected="selected">{{ text_a_button }}</option>*/
/* */
/* 				{% else %}*/
/* */
/*                 <option value="LwA" selected="selected">{{ text_lwa_button }}</option>*/
/*                 <option value="Login" >{{ text_login_button }}</option>*/
/*                 <option value="A">{{ text_a_button }}</option>*/
/* */
/* 				{% endif %}*/
/* */
/*               </select>*/
/*             </div>*/
/*           </div>*/
/*           <div class="form-group">*/
/*             <label class="col-sm-2 control-label" for="input-button-colour">{{ entry_button_colour }}</label>*/
/*             <div class="col-sm-10">*/
/*               <select name="module_amazon_login_button_colour" id="input-button-colour" class="form-control">*/
/* */
/* 				{% if module_amazon_login_button_colour == 'DarkGray' %}*/
/* */
/*                 <option value="Gold" >{{ text_gold_button }}</option>*/
/*                 <option value="DarkGray" selected="selected">{{ text_darkgray_button }}</option>*/
/*                 <option value="LightGray">{{ text_lightgray_button }}</option>*/
/* */
/* 				{% elseif module_amazon_login_button_colour == 'LightGray' %}*/
/* */
/*                 <option value="Gold" >{{ text_gold_button }}</option>*/
/*                 <option value="DarkGray">{{ text_darkgray_button }}</option>*/
/*                 <option value="LightGray" selected="selected">{{ text_lightgray_button }}</option>*/
/* */
/* 				{% else %}*/
/* */
/*                 <option value="Gold" selected="selected">{{ text_gold_button }}</option>*/
/*                 <option value="DarkGray">{{ text_darkgray_button }}</option>*/
/*                 <option value="LightGray">{{ text_lightgray_button }}</option>*/
/* */
/* 				{% endif %}*/
/* */
/*               </select>*/
/*             </div>*/
/*           </div>*/
/*           <div class="form-group">*/
/*             <label class="col-sm-2 control-label" for="input-button-size">{{ entry_button_size }}</label>*/
/*             <div class="col-sm-10">*/
/*               <select name="module_amazon_login_button_size" id="input-button-size" class="form-control">*/
/* */
/* 				{% if module_amazon_login_button_size == 'small' %}*/
/* 					*/
/*                 <option value="small" selected="selected">{{ text_small_button }}</option>*/
/*                 <option value="medium">{{ text_medium_button }}</option>*/
/*                 <option value="large" selected="selected">{{ text_large_button }}</option>*/
/*                 <option value="x-large">{{ text_x_large_button }}</option>*/
/* */
/* 				{% elseif module_amazon_login_button_size == 'large' %}*/
/* */
/*                 <option value="small" >{{ text_small_button }}</option>*/
/*                 <option value="medium">{{ text_medium_button }}</option>*/
/*                 <option value="large" selected="selected">{{ text_large_button }}</option>*/
/*                 <option value="x-large">{{ text_x_large_button }}</option>*/
/* */
/* 				{% elseif module_amazon_login_button_size == 'x-large' %}*/
/* */
/*                 <option value="small">{{ text_small_button }}</option>*/
/*                 <option value="medium">{{ text_medium_button }}</option>*/
/*                 <option value="large">{{ text_large_button }}</option>*/
/*                 <option value="x-large" selected="selected">{{ text_x_large_button }}</option>*/
/* */
/* 				{% else %}*/
/* */
/*                 <option value="small">{{ text_small_button }}</option>*/
/*                 <option value="medium" selected="selected">{{ text_medium_button }}</option>*/
/*                 <option value="large">{{ text_large_button }}</option>*/
/*                 <option value="x-large">{{ text_x_large_button }}</option>*/
/* */
/* 				{% endif %}*/
/* */
/*               </select>*/
/*             </div>*/
/*           </div>*/
/*           <div class="form-group">*/
/*             <label class="col-sm-2 control-label" for="input-status">{{ entry_status }}</label>*/
/*             <div class="col-sm-10">*/
/*               <select name="module_amazon_login_status" id="input-status" class="form-control">*/
/* */
/* 				{% if module_amazon_login_status %}*/
/* */
/*                 <option value="1" selected="selected">{{ text_enabled }}</option>*/
/*                 <option value="0">{{ text_disabled }}</option>*/
/* */
/* 				{% else %}*/
/* */
/*                 <option value="1">{{ text_enabled }}</option>*/
/*                 <option value="0" selected="selected">{{ text_disabled }}</option>*/
/* */
/* 				{% endif %}*/
/* */
/*               </select>*/
/*             </div>*/
/*           </div>*/
/*         </form>*/
/*       </div>*/
/*     </div>*/
/*   </div>*/
/* </div>*/
/* {{ footer }}*/
/* */
