<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/17/15
 * Time: 15:53
 */

class BlockModuleVerticalmenu extends Block {
    public function toHtml() {
        $this->data['translator'] = $this->translator;

        $this->load->model('module/custom_menu');

        $this->data['custom_menu'] = array();
        $this->data['custom_menu'] = $this->model_module_custom_menu->getCategories();
        $layout_id = $this->ocart->getLayoutId('ocivity3', 'kuteshop_theme', $this->config->get('config_store_id'));;
        $this->data['layout_id'] = $layout_id;
        return parent::toHtml();
    }
}