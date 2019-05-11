<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 11/28/15
 * Time: 19:47
 */

class BlockModuleBestseller extends Block
{
    public function toHtml()
    {
        $this->load->model('catalog/newcategory');
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

        $parse_data['tabs'] = array();
        if (is_array($category_ids) && count($category_ids)) {
            foreach ($category_ids as $category_id) {
                $filter_data = array(
                    'category_id' => $category_id,
                    'sort'        => 'p.product_id',
                    'order'       => 'DESC',
                    'start'       => 0,
                    'limit'       => (!empty($this->data['setting']['limit']) ? $this->data['setting']['limit'] : 5)
                );

                $results = $this->model_module_smarttab->getBestSellerProducts(
                    $filter_data
                );

                if ($results) {
                    $category_info = $this->model_catalog_newcategory->getCategory($category_id);
                    $parse_data['tabs'][$category_id]['tab_id'] = substr(md5($category_id.json_encode($data['setting']).time()), 0, rand(3, 6));
                    $parse_data['tabs'][$category_id]['title']  = $category_info['name'];
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
                        $parse_data['tabs'][$category_id]['content'] = $this->load->view(
                            $this->config->get('config_template')
                            . '/template/module/smarttab/list/layout'.$layout_id.'.tpl', $data
                        );
                    } else {
                        $parse_data['tabs'][$category_id]['content'] = $this->load->view(
                            'default/template/module/smarttab/list/layout'.$layout_id.'.tpl', $data
                        );
                    }
                }
            }
        }

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
        if ($layout_id == 4) {
            $parse_data['parent_class'] = 'top-sellers';
        }

        $parse_data['title'] = $data['setting'];

        $this->data['html'] = $this->load->view(
            $this->config->get('config_template').'/template/module/smarttab/layout/layout'.$layout_id.'.tpl', $parse_data
        );

        return parent::toHtml();
    }

}