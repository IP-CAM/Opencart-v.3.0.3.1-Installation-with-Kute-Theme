<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/10/15
 * Time: 17:18
 */

class BlockCatalogCategoryItem extends Block {
    public function toHtml() {
        $this->data['category_product_per_row'] = (!Ocart::getConfig('category_product_per_row') ? 3 : 12/Ocart::getConfig('category_product_per_row'));

        return parent::toHtml();
    }
}