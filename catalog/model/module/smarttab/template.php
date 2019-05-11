<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/6/15
 * Time: 15:31
 */

class ModelModuleSmarttabTemplate extends Model
{
    public function renderProductList($products, $template = '/template/module/smarttab/item.tpl')
    {
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . $template)) {
            return $this->load->view($this->config->get('config_template') . $template, $products);
        } else {
            return $this->load->view('default'.$template, $products);
        }
    }
}