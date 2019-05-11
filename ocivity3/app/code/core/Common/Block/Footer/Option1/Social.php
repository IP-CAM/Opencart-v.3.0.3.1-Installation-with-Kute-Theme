<?php
class BlockCommonFooterOption1Social extends Block {
    /**
     * @return string
     */
    public function toHtml() {
        $this->data['social_links'] = mig_unserialize(Ocart::getConfig('social_link'));
        return parent::toHtml();
    }
}