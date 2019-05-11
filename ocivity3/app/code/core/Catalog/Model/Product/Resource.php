<?php
namespace Resource;
class Product extends \Core_ORM {
    public function init() {
        $this->_init('product_id', 'product');
    }
}
