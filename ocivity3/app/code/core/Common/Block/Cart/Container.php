<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/18/15
 * Time: 11:40
 */

class BlockCommonCartContainer extends Block {
    public function toHtml() {

        $layout_id = $this->ocart->getLayoutId('ocivity3', 'kuteshop_theme', $this->config->get('config_store_id'));;

        $this->setTemplate('cart/container_option'.$layout_id.'.phtml');

        return parent::toHtml();
    }
}