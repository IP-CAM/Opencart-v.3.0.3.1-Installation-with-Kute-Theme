<?php
class BlockCommonHeaderStylesheetOption extends Block {
    public function toHtml() {
    	$this->data['translator'] = $this->translator;
        $this->data['layout_id'] = $this->ocart->getLayoutId('ocivity3', 'kuteshop_theme', $this->config->get('config_store_id'));
        // get setting of theme from backend
        $this->data['general_color'] = (!Ocart::getConfig('general_color') ? '#ff3366' : Ocart::getConfig('general_color'));

        if(file_exists(DIR_OCIVITY3.'app/code/core/Common/View/kute/header/stylesheet/css.phtml')){
            return parent::toHtml();
        }

        return false;
    }
}