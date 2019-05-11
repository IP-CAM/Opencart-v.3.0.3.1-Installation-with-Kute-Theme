<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/17/15
 * Time: 09:56
 */

class BlockCommonSearch extends Block {
    public function toHtml() {
        $this->data['translator'] = $this->translator;
        $this->load->model('catalog/category');

        $this->data['category_id'] = -1;
        if ((isset($this->request->get['route']) && $this->request->get['route']) == 'product/search' && isset($this->request->get['category']))
        {
            $this->data['category_id'] = (int)$this->request->get['category'];
        }

        $this->data['categories'] = $this->model_catalog_category->getCategories();

        $layout_id = $this->ocart->getLayoutId('ocivity3', 'kuteshop_theme', $this->config->get('config_store_id'));;

        $this->setTemplate('search_option'.$layout_id.'.phtml');

        return parent::toHtml();
    }
}