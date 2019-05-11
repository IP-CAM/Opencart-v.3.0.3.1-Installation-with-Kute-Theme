<?php
class BlockCommonHeader extends Block {
    public function toHtml() {
        $this->data['translator'] = $this->translator;
        $this->load->model('catalog/category');
        $this->load->model('catalog/newcategory');
        $this->load->model('tool/image');
        $this->load->model('design/layout');

        $data = array();

        if (isset($this->request->get['path']))
        {
            $parts = explode('_', (string)$this->request->get['path']);
        }
        else
        {
            $parts = array();
        }

        if (isset($parts[0]))
        {
            $data['category_id'] = $parts[0];
        }
        else
        {
            $data['category_id'] = 0;
        }

        if (isset($parts[1])) {
            $data['child_id'] = $parts[1];
        } else {
            $data['child_id'] = 0;
        }
        $this->data['current_category_id'] = $data['category_id'];

        $categories = $this->model_catalog_category->getCategories();
        $this->data['categories'] = $this->model_catalog_newcategory->getCategories($categories);

        $this->data['url'] = $this->url;
        $this->data['model_tool_image'] = $this->model_tool_image;

        $this->data['logo'] = (!Ocart::getConfig('logo') ? 'image/catalog/logo.png' : 'image/'.Ocart::getConfig('logo'));;
        $this->data['displayed_vertical_menu'] = Ocart::getConfig('enabled_vertical_menu');

        $layout_id = $this->ocart->getLayoutId('ocivity3', 'kuteshop_theme', $this->config->get('config_store_id'));
        $this->data['current_theme'] = 'option'.$layout_id;

        return parent::toHtml();
    }
}