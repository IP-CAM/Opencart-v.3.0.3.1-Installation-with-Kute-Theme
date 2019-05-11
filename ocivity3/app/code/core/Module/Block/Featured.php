<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 11/28/15
 * Time: 19:47
 */

class BlockModuleFeatured extends Block
{
    public function toHtml()
    {
        $this->load->model('catalog/newcategory');
        $this->load->model('catalog/newproduct');
        $this->load->model('design/banner');
        $this->load->model('tool/newimage');
        $this->load->model('module/smarttab');
        $this->load->model('module/smarttab/util');
        $this->load->model('module/smarttab/template');
        // get products by categories
        $category_ids = $this->data['setting']['category_ids'];

        $data['setting'] = $this->data['setting'];

        if(is_object($this->ocart))
        {
            $layout_id = $this->ocart->getLayoutId('ocivity3', 'kuteshop_theme', $this->config->get('config_store_id'));;
        }

        $data['products']
            = $this->model_module_smarttab_util->genArrayProducts(
            $this->data['products'], $data['setting']
        );

        $data['products_list_html']
            = $this->model_module_smarttab_template->renderProductList(
            $data, '/template/module/smarttab/item/layout'.$layout_id.'.tpl'
        );

        $parse_data['all']['content'] = $this->load->view(
            $this->config->get('config_template')
            . '/template/module/smarttab/list/layout'.$layout_id.'.tpl', $data
        );

        $parse_data['banners'] = array();
        if (isset($data['setting']['banner_id']) && !empty($data['setting']['banner_id']) && (int)$data['setting']['banner_id'] > 0) {
            $results = $this->model_design_banner->getBanner($data['setting']['banner_id']);

            foreach ($results as $result) {
                if (is_file(DIR_IMAGE . $result['image'])) {
                    $parse_data['banners'][] = array(
                        'title' => $result['title'],
                        'link'  => $result['link'],
                        'image' => $this->model_tool_newimage->crop($result['image'], 226, 346)
                    );
                }
            }
        }
        $parse_data['tabs'] = array();
        // get all categories from products for only theme option 4
        if ($layout_id == 4) {
            if (count($data['setting']['product']) > 0) {
                $category_ids = $this->model_catalog_newcategory->getCategoriesByProducts($data['setting']['product']);
                foreach ($category_ids as $category) {
                    $category_id = $category['category_id'];
                    $results = $this->model_catalog_newcategory->getProductsByCategory($category['category_id'], $data['setting']['product']);
                    $category_info = $this->model_catalog_newcategory->getCategory($category_id);
                    if ($category_info['parent_id'] == 0) continue;
                    $key_id = md5($category_info['name']);
                    $parse_data['tabs'][$key_id]['tab_id'] = substr(md5($category_id.json_encode($data['setting'])), 0, 5);
                    $parse_data['tabs'][$key_id]['title']  = $category_info['name'];
                    $data['products']
                        = $this->model_module_smarttab_util->genArrayProducts(
                        $results, $data['setting']
                    );

                    $data['products_list_html']
                        = $this->model_module_smarttab_template->renderProductList(
                        $data, '/template/module/smarttab/item/layout'.$layout_id.'.tpl'
                    );

                    if (file_exists(
                        DIR_TEMPLATE . $this->config->get('config_template')
                        . '/template/module/smarttab/list/layout'.$layout_id.'.tpl'
                    )) {
                        $parse_data['tabs'][$key_id]['content'] = $this->load->view(
                            $this->config->get('config_template')
                            . '/template/module/smarttab/list/layout'.$layout_id.'.tpl', $data
                        );
                    } else {
                        $parse_data['tabs'][$key_id]['content'] = $this->load->view(
                            'default/template/module/smarttab/list/layout'.$layout_id.'.tpl', $data
                        );
                    }
                }
            }
            $parse_data['parent_class'] = 'recommendation';
        }

        $parse_data['title'] = $data['setting']['name'];

        $this->data['html'] = $this->load->view(
            $this->config->get('config_template').'/template/module/smarttab/layout/layout'.$layout_id.'.tpl', $parse_data
        );

        return parent::toHtml();
    }

}