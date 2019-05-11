<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/10/15
 * Time: 17:18
 */

class BlockCatalogProduct extends Block {
    public function toHtml() {
        $this->data['translator'] = $this->translator;
        $this->load->model('catalog/product');

        $product_info = $this->model_catalog_product->getProduct($this->data['product_id']);

        if ($product_info['image']) {
            list($width, $height) = getimagesize(DIR_IMAGE.$product_info['image']);
            $this->data['popup'] = $this->model_tool_image->resize($product_info['image'], $width, $height);
        } else {
            $this->data['popup'] = '';
        }

        $this->data['images'] = array();

        $this->data['meta_description'] = $product_info['meta_description'];

        $results = $this->model_catalog_product->getProductImages($this->data['product_id']);

        foreach ($results as $result) {
            list($width, $height) = getimagesize(DIR_IMAGE.$result['image']);
            $this->data['images'][] = array(
                'popup' => $this->model_tool_image->resize($result['image'], $width, $height),
                'thumb' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_additional_width'), $this->config->get('config_image_additional_height'))
            );
        }

        $this->data['option_id_color'] = $this->config->get('advanced_filter_option_id_color');

        if ($this->request->server['REQUEST_METHOD'] == 'POST' && isset($this->request->post['quickview'])) {
            $this->setTemplate('product_quickview.phtml');
        }

        return parent::toHtml();
    }
}