<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/10/15
 * Time: 17:18
 */

class BlockCatalogCategory extends Block {
    public function toHtml() {
        $this->data['translator'] = $this->translator;
        $this->load->model('common/util');
        $this->load->model('catalog/product');


        if (isset($this->registry->get('request')->request['ajax']))
        {
            $this->setTemplate('category_ajax.phtml');
        }

        foreach($this->data['products'] as $key => $product)
        {
            $product_info = $this->model_catalog_product->getProduct($product['product_id']);
            $this->data['products'][$key] = array_merge($product_info, $product);
            $this->data['products'][$key]['description'] = utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, 330) . '..';
        }

        $this->data['products_list_html'] = $this->model_common_util->renderProductItem($this->data);
        return parent::toHtml();
    }
}