<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/17/15
 * Time: 14:58
 */

class ModelCommonUtil extends Model
{
    public function renderProductItem($data, $template = '/template/product/product_item.tpl')
    {
        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . $template)) {
            return $this->load->view($this->config->get('config_template') . $template, $data);
        } else {
            return $this->load->view('default'.$template, $data);
        }
    }
}