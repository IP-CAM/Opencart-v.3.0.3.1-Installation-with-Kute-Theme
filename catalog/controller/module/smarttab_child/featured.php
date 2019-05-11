<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/7/15
 * Time: 10:55
 */

class ControllerModuleSmarttabChildFeatured extends Controller
{
    public function index($setting)
    {
        $this->load->language('module/featured');
        $this->load->model('extension/module');
        $this->load->model('module/smarttab/util');
        $this->load->model('module/smarttab/template');
        $this->load->model('catalog/newproduct');
        $this->load->language('module/smarttab');

        $data['button_cart'] = $this->language->get('button_cart');
        $data['button_wishlist'] = $this->language->get('button_wishlist');
        $data['button_compare'] = $this->language->get('button_compare');

        $this->load->model('module/smarttab');

        $this->load->model('tool/image');

        $layout_id = (isset($setting['layout_id'])) ? $setting['layout_id'] : 0;

        if(is_object($this->ocart))
        {
            $layout_id = $this->ocart->getLayoutId('ocivity3', 'kuteshop_theme', $this->config->get('config_store_id'));;
        }

        $data['products'] = array();

        $setting_info = $this->model_module_smarttab->getModuleByCode('featured');
        if(empty($setting_info['product']))
        {
            return false;
        }
        $products = array_slice($setting_info['product'], 0, (int)$setting['limit']);
        $results = array();

        foreach ($products as $product_id)
        {
            $product_info = $this->model_catalog_newproduct->getProduct($product_id);

            if ($product_info)
            {
                $results[] = $product_info;
            }
        }

        $data['setting'] = $setting;
        if ($results) {
            $data['products']
                = $this->model_module_smarttab_util->genArrayProducts(
                $results, $setting
            );

            $data['products_list_html']
                = $this->model_module_smarttab_template->renderProductList(
                $data, '/template/module/smarttab/item/layout'.$layout_id.'.tpl'
            );

            if (file_exists(
                DIR_TEMPLATE . $this->config->get('config_template')
                . '/template/module/smarttab/list/layout'.$layout_id.'.tpl'
            )) {
                return $this->load->view(
                    $this->config->get('config_template')
                    . '/template/module/smarttab/list/layout'.$layout_id.'.tpl', $data
                );
            } else {
                return $this->load->view(
                    'default/template/module/smarttab/list/layout'.$layout_id.'.tpl', $data
                );
            }
        }
    }
}