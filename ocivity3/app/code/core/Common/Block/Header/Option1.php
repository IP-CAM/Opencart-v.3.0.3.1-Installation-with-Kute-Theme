<?php
class BlockCommonHeaderOption1 extends Block {
    public function toHtml() {
    	$this->data['translator'] = $this->translator;
        return parent::toHtml();
    }
}