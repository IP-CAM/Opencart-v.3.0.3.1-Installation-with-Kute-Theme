<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/17/15
 * Time: 09:56
 */

class BlockCommonCart extends Block {
    public function toHtml() {
        $this->data['total_item'] = $this->cart->countProducts();
        $this->data['cart_url']   = $this->url->link('checkout/cart');
        $this->data['cart']   = $this->url->link('checkout/checkout');
        $this->data['wishlist_url'] = $this->url->link('account/wishlist');
        $this->data['compare_url']  = $this->url->link('product/compare');
        $layout_id = $this->ocart->getLayoutId('ocivity3', 'kuteshop_theme', $this->config->get('config_store_id'));
        $this->setTemplate('cart_option'.$layout_id.'.phtml');

        return parent::toHtml();
    }
}