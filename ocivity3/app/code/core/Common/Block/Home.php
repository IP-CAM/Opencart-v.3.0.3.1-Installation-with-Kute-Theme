<?php
class BlockCommonHome extends Block {
    public function toHtml() {
    	$layout_id = $this->ocart->getLayoutId('ocivity3', 'kuteshop_theme', $this->config->get('config_store_id'));
        $this->data['current_theme'] = 'option'.$layout_id;
        return parent::toHtml();
    }
}