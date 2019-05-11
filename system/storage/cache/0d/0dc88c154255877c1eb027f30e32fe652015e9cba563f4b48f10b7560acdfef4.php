<?php

/* extension/payment/abcdpayupiqr.twig */
class __TwigTemplate_a8bf002f0c45b7b9f8f6d92f35aad94d0b18b6323b9807077329c0b066710b09 extends Twig_Template
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
        // line 11
        echo "
";
        // line 17
        echo "
";
        // line 18
        echo (isset($context["header"]) ? $context["header"] : null);
        echo (isset($context["column_left"]) ? $context["column_left"] : null);
        echo "
<div id=\"content\">
  <div class=\"page-header\">
    <div class=\"container-fluid\">
      <div class=\"pull-right\">
        <button type=\"submit\" form=\"form-payment\" data-toggle=\"tooltip\" title=\"";
        // line 23
        echo (isset($context["button_save"]) ? $context["button_save"] : null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
        <a href=\"";
        // line 24
        echo (isset($context["cancel"]) ? $context["cancel"] : null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_cancel"]) ? $context["button_cancel"] : null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a></div>
      <h1>";
        // line 25
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "</h1>
      <ul class=\"breadcrumb\">
        ";
        // line 27
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["breadcrumbs"]) ? $context["breadcrumbs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 28
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
        // line 30
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\"> ";
        // line 33
        if ((isset($context["error_warning"]) ? $context["error_warning"] : null)) {
            // line 34
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i> ";
            echo (isset($context["error_warning"]) ? $context["error_warning"] : null);
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>
    ";
        }
        // line 38
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i> ";
        // line 40
        echo (isset($context["text_edit"]) ? $context["text_edit"] : null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 43
        echo (isset($context["action"]) ? $context["action"] : null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-payment\" class=\"form-horizontal\">
          <div class=\"form-group required\">
            <label class=\"col-sm-2 control-label\" for=\"input-upi-id\"><span data-toggle=\"tooltip\" title=\"";
        // line 45
        echo (isset($context["entry_upi_id"]) ? $context["entry_upi_id"] : null);
        echo "\">";
        echo (isset($context["entry_upi_id"]) ? $context["entry_upi_id"] : null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_abcdpayupiqr_upi_id\" value=\"";
        // line 47
        echo (isset($context["payment_abcdpayupiqr_upi_id"]) ? $context["payment_abcdpayupiqr_upi_id"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_upi_id"]) ? $context["entry_upi_id"] : null);
        echo "\" id=\"input-upi-id\" class=\"form-control\" />
              ";
        // line 48
        if ((isset($context["error_upi_id"]) ? $context["error_upi_id"] : null)) {
            // line 49
            echo "              <div class=\"text-danger\">";
            echo (isset($context["error_upi_id"]) ? $context["error_upi_id"] : null);
            echo "</div>
              ";
        }
        // line 51
        echo "            </div>
          </div>

          <div class=\"form-group required\">
            <label class=\"col-sm-2 control-label\" for=\"input-upi-reg-name\"><span data-toggle=\"tooltip\" title=\"";
        // line 55
        echo (isset($context["entry_upi_reg_name"]) ? $context["entry_upi_reg_name"] : null);
        echo "\">";
        echo (isset($context["entry_upi_reg_name"]) ? $context["entry_upi_reg_name"] : null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_abcdpayupiqr_upi_reg_name\" value=\"";
        // line 57
        echo (isset($context["payment_abcdpayupiqr_upi_reg_name"]) ? $context["payment_abcdpayupiqr_upi_reg_name"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_upi_reg_name"]) ? $context["entry_upi_reg_name"] : null);
        echo "\" id=\"input-upi-reg-name\" class=\"form-control\" />
              ";
        // line 58
        if ((isset($context["error_upi_reg_name"]) ? $context["error_upi_reg_name"] : null)) {
            // line 59
            echo "              <div class=\"text-danger\">";
            echo (isset($context["error_upi_reg_name"]) ? $context["error_upi_reg_name"] : null);
            echo "</div>
              ";
        }
        // line 61
        echo "            </div>
          </div>

          <div class=\"form-group required\">
              <label class=\"col-sm-2 control-label\" for=\"input-addl-alert-email\"><span data-toggle=\"tooltip\" title=\"";
        // line 65
        echo (isset($context["help_addl_alert_email"]) ? $context["help_addl_alert_email"] : null);
        echo "\">";
        echo (isset($context["entry_addl_alert_email"]) ? $context["entry_addl_alert_email"] : null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_abcdpayupiqr_addl_alert_email\" value=\"";
        // line 67
        echo (isset($context["payment_abcdpayupiqr_addl_alert_email"]) ? $context["payment_abcdpayupiqr_addl_alert_email"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_addl_alert_email"]) ? $context["entry_addl_alert_email"] : null);
        echo "\" id=\"input-addl-alert-email\" class=\"form-control\" />
                ";
        // line 68
        if ((isset($context["error_addl_alert_email"]) ? $context["error_addl_alert_email"] : null)) {
            // line 69
            echo "                <div class=\"text-danger\">";
            echo (isset($context["error_addl_alert_email"]) ? $context["error_addl_alert_email"] : null);
            echo "</div>
                ";
        }
        // line 71
        echo "            </div>
          </div>
            
          <div class=\"form-group required\">
            <label class=\"col-sm-2 control-label\" for=\"input-total\"><span data-toggle=\"tooltip\" title=\"";
        // line 75
        echo (isset($context["help_total"]) ? $context["help_total"] : null);
        echo "\">";
        echo (isset($context["entry_total"]) ? $context["entry_total"] : null);
        echo "</span></label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_abcdpayupiqr_total\" value=\"";
        // line 77
        echo (isset($context["payment_abcdpayupiqr_total"]) ? $context["payment_abcdpayupiqr_total"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_total"]) ? $context["entry_total"] : null);
        echo "\" id=\"input-total\" class=\"form-control\" />
              ";
        // line 78
        if ((isset($context["error_upi_total"]) ? $context["error_upi_total"] : null)) {
            // line 79
            echo "              <div class=\"text-danger\">";
            echo (isset($context["error_upi_total"]) ? $context["error_upi_total"] : null);
            echo "</div>
              ";
        }
        // line 81
        echo "            </div>
          </div>
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-order-status\">";
        // line 84
        echo (isset($context["entry_order_status"]) ? $context["entry_order_status"] : null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"payment_abcdpayupiqr_order_status_id\" id=\"input-order-status\" class=\"form-control\">
                
                ";
        // line 88
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["order_statuses"]) ? $context["order_statuses"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 89
            echo "                ";
            if (($this->getAttribute($context["order_status"], "order_status_id", array()) == (isset($context["payment_abcdpayupiqr_order_status_id"]) ? $context["payment_abcdpayupiqr_order_status_id"] : null))) {
                // line 90
                echo "                
                <option value=\"";
                // line 91
                echo $this->getAttribute($context["order_status"], "order_status_id", array());
                echo "\" selected=\"selected\">";
                echo $this->getAttribute($context["order_status"], "name", array());
                echo "</option>
                
                ";
            } else {
                // line 94
                echo "                
                <option value=\"";
                // line 95
                echo $this->getAttribute($context["order_status"], "order_status_id", array());
                echo "\">";
                echo $this->getAttribute($context["order_status"], "name", array());
                echo "</option>
                
                ";
            }
            // line 98
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 99
        echo "              
              </select>
            </div>
          </div>
                
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"cancel-order-status\">";
        // line 105
        echo (isset($context["cancel_order_status"]) ? $context["cancel_order_status"] : null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"payment_abcdpayupiqr_cancel_order_status_id\" id=\"cancel-order-status\" class=\"form-control\">
                
                ";
        // line 109
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["order_statuses"]) ? $context["order_statuses"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["order_status"]) {
            // line 110
            echo "                ";
            if (($this->getAttribute($context["order_status"], "order_status_id", array()) == (isset($context["payment_abcdpayupiqr_cancel_order_status_id"]) ? $context["payment_abcdpayupiqr_cancel_order_status_id"] : null))) {
                // line 111
                echo "                
                <option value=\"";
                // line 112
                echo $this->getAttribute($context["order_status"], "order_status_id", array());
                echo "\" selected=\"selected\">";
                echo $this->getAttribute($context["order_status"], "name", array());
                echo "</option>
                
                ";
            } else {
                // line 115
                echo "                
                <option value=\"";
                // line 116
                echo $this->getAttribute($context["order_status"], "order_status_id", array());
                echo "\">";
                echo $this->getAttribute($context["order_status"], "name", array());
                echo "</option>
                
                ";
            }
            // line 119
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['order_status'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 120
        echo "              
              </select>
            </div>
          </div>
                
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-geo-zone\">";
        // line 126
        echo (isset($context["entry_geo_zone"]) ? $context["entry_geo_zone"] : null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"payment_abcdpayupiqr_geo_zone_id\" id=\"input-geo-zone\" class=\"form-control\">
                <option value=\"0\">";
        // line 129
        echo (isset($context["text_all_zones"]) ? $context["text_all_zones"] : null);
        echo "</option>
                
                ";
        // line 131
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["geo_zones"]) ? $context["geo_zones"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["geo_zone"]) {
            // line 132
            echo "                ";
            if (($this->getAttribute($context["geo_zone"], "geo_zone_id", array()) == (isset($context["payment_abcdpayupiqr_geo_zone_id"]) ? $context["payment_abcdpayupiqr_geo_zone_id"] : null))) {
                // line 133
                echo "                
                <option value=\"";
                // line 134
                echo $this->getAttribute($context["geo_zone"], "geo_zone_id", array());
                echo "\" selected=\"selected\">";
                echo $this->getAttribute($context["geo_zone"], "name", array());
                echo "</option>
                
                ";
            } else {
                // line 137
                echo "                
                <option value=\"";
                // line 138
                echo $this->getAttribute($context["geo_zone"], "geo_zone_id", array());
                echo "\">";
                echo $this->getAttribute($context["geo_zone"], "name", array());
                echo "</option>
                
                ";
            }
            // line 141
            echo "                ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['geo_zone'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 142
        echo "              
              </select>
            </div>
          </div>
                
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-status\">";
        // line 148
        echo (isset($context["entry_status"]) ? $context["entry_status"] : null);
        echo "</label>
            <div class=\"col-sm-10\">
              <select name=\"payment_abcdpayupiqr_status\" id=\"input-status\" class=\"form-control\">
                
                ";
        // line 152
        if ((isset($context["payment_abcdpayupiqr_status"]) ? $context["payment_abcdpayupiqr_status"] : null)) {
            // line 153
            echo "                
                <option value=\"1\" selected=\"selected\">";
            // line 154
            echo (isset($context["text_enabled"]) ? $context["text_enabled"] : null);
            echo "</option>
                <option value=\"0\">";
            // line 155
            echo (isset($context["text_disabled"]) ? $context["text_disabled"] : null);
            echo "</option>
                
                ";
        } else {
            // line 158
            echo "                
                <option value=\"1\">";
            // line 159
            echo (isset($context["text_enabled"]) ? $context["text_enabled"] : null);
            echo "</option>
                <option value=\"0\" selected=\"selected\">";
            // line 160
            echo (isset($context["text_disabled"]) ? $context["text_disabled"] : null);
            echo "</option>
                
                ";
        }
        // line 163
        echo "              
              </select>
            </div>
          </div>
                
          <div class=\"form-group\">
            <label class=\"col-sm-2 control-label\" for=\"input-sort-order\">";
        // line 169
        echo (isset($context["entry_sort_order"]) ? $context["entry_sort_order"] : null);
        echo "</label>
            <div class=\"col-sm-10\">
              <input type=\"text\" name=\"payment_abcdpayupiqr_sort_order\" value=\"";
        // line 171
        echo (isset($context["payment_abcdpayupiqr_sort_order"]) ? $context["payment_abcdpayupiqr_sort_order"] : null);
        echo "\" placeholder=\"";
        echo (isset($context["entry_sort_order"]) ? $context["entry_sort_order"] : null);
        echo "\" id=\"input-sort-order\" class=\"form-control\" />
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
";
        // line 180
        echo (isset($context["footer"]) ? $context["footer"] : null);
    }

    public function getTemplateName()
    {
        return "extension/payment/abcdpayupiqr.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  417 => 180,  403 => 171,  398 => 169,  390 => 163,  384 => 160,  380 => 159,  377 => 158,  371 => 155,  367 => 154,  364 => 153,  362 => 152,  355 => 148,  347 => 142,  341 => 141,  333 => 138,  330 => 137,  322 => 134,  319 => 133,  316 => 132,  312 => 131,  307 => 129,  301 => 126,  293 => 120,  287 => 119,  279 => 116,  276 => 115,  268 => 112,  265 => 111,  262 => 110,  258 => 109,  251 => 105,  243 => 99,  237 => 98,  229 => 95,  226 => 94,  218 => 91,  215 => 90,  212 => 89,  208 => 88,  201 => 84,  196 => 81,  190 => 79,  188 => 78,  182 => 77,  175 => 75,  169 => 71,  163 => 69,  161 => 68,  155 => 67,  148 => 65,  142 => 61,  136 => 59,  134 => 58,  128 => 57,  121 => 55,  115 => 51,  109 => 49,  107 => 48,  101 => 47,  94 => 45,  89 => 43,  83 => 40,  79 => 38,  71 => 34,  69 => 33,  64 => 30,  53 => 28,  49 => 27,  44 => 25,  38 => 24,  34 => 23,  25 => 18,  22 => 17,  19 => 11,);
    }
}
/* {#*/
/* [UPI-Payment] is a Payment Module to Integrate*/
/* UPI - [ Unified Payments Interface ] A Service From NPCI - [ National Payments Corporation Of India ]*/
/* as a Payment Gateway Method in OPENCART - 3.0.2.0 - 3.0.3.0 - 3.0.3.1*/
/* */
/* Developed By:*/
/* Mr. TARAKESHWAR GAJAM*/
/* ABCD PAYMENT SERVICES, #4-1-71/416, Sai Durga Gardens, Nacharam Main Road, Medchal-Malkajgiri District, Telangana State - 500076, India.*/
/* URL: https://www.abcd-pay.com , E-Mail : admin@abcd-pay.com, Mobile : 0091-0-8106877688.*/
/* #}*/
/* */
/* {#*/
/* File Path = "admin/view/template/extension/payment/abcdpayupiqr.twig"*/
/* Developer Logo Image Path = "admin/view/image/payment/abcdpayupiqr.png"*/
/* NPCI-UPI Logo Image Path = "admin/view/image/payment/upi-logo.png"*/
/* #}*/
/* */
/* {{ header }}{{ column_left }}*/
/* <div id="content">*/
/*   <div class="page-header">*/
/*     <div class="container-fluid">*/
/*       <div class="pull-right">*/
/*         <button type="submit" form="form-payment" data-toggle="tooltip" title="{{ button_save }}" class="btn btn-primary"><i class="fa fa-save"></i></button>*/
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
/*     <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> {{ error_warning }}*/
/*       <button type="button" class="close" data-dismiss="alert">&times;</button>*/
/*     </div>*/
/*     {% endif %}*/
/*     <div class="panel panel-default">*/
/*       <div class="panel-heading">*/
/*         <h3 class="panel-title"><i class="fa fa-pencil"></i> {{ text_edit }}</h3>*/
/*       </div>*/
/*       <div class="panel-body">*/
/*         <form action="{{ action }}" method="post" enctype="multipart/form-data" id="form-payment" class="form-horizontal">*/
/*           <div class="form-group required">*/
/*             <label class="col-sm-2 control-label" for="input-upi-id"><span data-toggle="tooltip" title="{{ entry_upi_id }}">{{ entry_upi_id }}</span></label>*/
/*             <div class="col-sm-10">*/
/*               <input type="text" name="payment_abcdpayupiqr_upi_id" value="{{ payment_abcdpayupiqr_upi_id }}" placeholder="{{ entry_upi_id }}" id="input-upi-id" class="form-control" />*/
/*               {% if error_upi_id %}*/
/*               <div class="text-danger">{{ error_upi_id }}</div>*/
/*               {% endif %}*/
/*             </div>*/
/*           </div>*/
/* */
/*           <div class="form-group required">*/
/*             <label class="col-sm-2 control-label" for="input-upi-reg-name"><span data-toggle="tooltip" title="{{ entry_upi_reg_name }}">{{ entry_upi_reg_name }}</span></label>*/
/*             <div class="col-sm-10">*/
/*               <input type="text" name="payment_abcdpayupiqr_upi_reg_name" value="{{ payment_abcdpayupiqr_upi_reg_name }}" placeholder="{{ entry_upi_reg_name }}" id="input-upi-reg-name" class="form-control" />*/
/*               {% if error_upi_reg_name %}*/
/*               <div class="text-danger">{{ error_upi_reg_name }}</div>*/
/*               {% endif %}*/
/*             </div>*/
/*           </div>*/
/* */
/*           <div class="form-group required">*/
/*               <label class="col-sm-2 control-label" for="input-addl-alert-email"><span data-toggle="tooltip" title="{{ help_addl_alert_email }}">{{ entry_addl_alert_email }}</span></label>*/
/*             <div class="col-sm-10">*/
/*               <input type="text" name="payment_abcdpayupiqr_addl_alert_email" value="{{ payment_abcdpayupiqr_addl_alert_email }}" placeholder="{{ entry_addl_alert_email }}" id="input-addl-alert-email" class="form-control" />*/
/*                 {% if error_addl_alert_email %}*/
/*                 <div class="text-danger">{{ error_addl_alert_email }}</div>*/
/*                 {% endif %}*/
/*             </div>*/
/*           </div>*/
/*             */
/*           <div class="form-group required">*/
/*             <label class="col-sm-2 control-label" for="input-total"><span data-toggle="tooltip" title="{{ help_total }}">{{ entry_total }}</span></label>*/
/*             <div class="col-sm-10">*/
/*               <input type="text" name="payment_abcdpayupiqr_total" value="{{ payment_abcdpayupiqr_total }}" placeholder="{{ entry_total }}" id="input-total" class="form-control" />*/
/*               {% if error_upi_total %}*/
/*               <div class="text-danger">{{ error_upi_total }}</div>*/
/*               {% endif %}*/
/*             </div>*/
/*           </div>*/
/*           <div class="form-group">*/
/*             <label class="col-sm-2 control-label" for="input-order-status">{{ entry_order_status }}</label>*/
/*             <div class="col-sm-10">*/
/*               <select name="payment_abcdpayupiqr_order_status_id" id="input-order-status" class="form-control">*/
/*                 */
/*                 {% for order_status in order_statuses %}*/
/*                 {% if order_status.order_status_id == payment_abcdpayupiqr_order_status_id %}*/
/*                 */
/*                 <option value="{{ order_status.order_status_id }}" selected="selected">{{ order_status.name }}</option>*/
/*                 */
/*                 {% else %}*/
/*                 */
/*                 <option value="{{ order_status.order_status_id }}">{{ order_status.name }}</option>*/
/*                 */
/*                 {% endif %}*/
/*                 {% endfor %}*/
/*               */
/*               </select>*/
/*             </div>*/
/*           </div>*/
/*                 */
/*           <div class="form-group">*/
/*             <label class="col-sm-2 control-label" for="cancel-order-status">{{ cancel_order_status }}</label>*/
/*             <div class="col-sm-10">*/
/*               <select name="payment_abcdpayupiqr_cancel_order_status_id" id="cancel-order-status" class="form-control">*/
/*                 */
/*                 {% for order_status in order_statuses %}*/
/*                 {% if order_status.order_status_id == payment_abcdpayupiqr_cancel_order_status_id %}*/
/*                 */
/*                 <option value="{{ order_status.order_status_id }}" selected="selected">{{ order_status.name }}</option>*/
/*                 */
/*                 {% else %}*/
/*                 */
/*                 <option value="{{ order_status.order_status_id }}">{{ order_status.name }}</option>*/
/*                 */
/*                 {% endif %}*/
/*                 {% endfor %}*/
/*               */
/*               </select>*/
/*             </div>*/
/*           </div>*/
/*                 */
/*           <div class="form-group">*/
/*             <label class="col-sm-2 control-label" for="input-geo-zone">{{ entry_geo_zone }}</label>*/
/*             <div class="col-sm-10">*/
/*               <select name="payment_abcdpayupiqr_geo_zone_id" id="input-geo-zone" class="form-control">*/
/*                 <option value="0">{{ text_all_zones }}</option>*/
/*                 */
/*                 {% for geo_zone in geo_zones %}*/
/*                 {% if geo_zone.geo_zone_id == payment_abcdpayupiqr_geo_zone_id %}*/
/*                 */
/*                 <option value="{{ geo_zone.geo_zone_id }}" selected="selected">{{ geo_zone.name }}</option>*/
/*                 */
/*                 {% else %}*/
/*                 */
/*                 <option value="{{ geo_zone.geo_zone_id }}">{{ geo_zone.name }}</option>*/
/*                 */
/*                 {% endif %}*/
/*                 {% endfor %}*/
/*               */
/*               </select>*/
/*             </div>*/
/*           </div>*/
/*                 */
/*           <div class="form-group">*/
/*             <label class="col-sm-2 control-label" for="input-status">{{ entry_status }}</label>*/
/*             <div class="col-sm-10">*/
/*               <select name="payment_abcdpayupiqr_status" id="input-status" class="form-control">*/
/*                 */
/*                 {% if payment_abcdpayupiqr_status %}*/
/*                 */
/*                 <option value="1" selected="selected">{{ text_enabled }}</option>*/
/*                 <option value="0">{{ text_disabled }}</option>*/
/*                 */
/*                 {% else %}*/
/*                 */
/*                 <option value="1">{{ text_enabled }}</option>*/
/*                 <option value="0" selected="selected">{{ text_disabled }}</option>*/
/*                 */
/*                 {% endif %}*/
/*               */
/*               </select>*/
/*             </div>*/
/*           </div>*/
/*                 */
/*           <div class="form-group">*/
/*             <label class="col-sm-2 control-label" for="input-sort-order">{{ entry_sort_order }}</label>*/
/*             <div class="col-sm-10">*/
/*               <input type="text" name="payment_abcdpayupiqr_sort_order" value="{{ payment_abcdpayupiqr_sort_order }}" placeholder="{{ entry_sort_order }}" id="input-sort-order" class="form-control" />*/
/*             </div>*/
/*           </div>*/
/* */
/*         </form>*/
/*       </div>*/
/*     </div>*/
/*   </div>*/
/* </div>*/
/* {{ footer }}*/
