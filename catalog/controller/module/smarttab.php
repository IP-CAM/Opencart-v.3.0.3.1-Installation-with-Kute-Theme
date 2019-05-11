<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/6/15
 * Time: 11:08
 */

class ControllerModuleSmarttab extends Controller
{
    private $_layout_id = 0;
    public function index($setting)
    {
        if (!isset($this->session->data['elevator']))
        {
            $this->session->data['elevator'] = 1;
            $this->session->data['elevator_prev'] = 0;
            $this->session->data['elevator_next'] = 2;
        }
        else
        {
            $this->session->data['elevator']++;
            $this->session->data['elevator_prev']++;
            $this->session->data['elevator_next']++;
        }
        $this->load->language('module/smarttab');
        $this->load->model('module/smarttab/util');
        $this->load->model('module/smarttab/const');
        $this->load->model('module/smarttab/template');
        $this->load->model('catalog/newcategory');
        $this->load->model('tool/image');

        if(!empty($setting['category_id']) && is_numeric($setting['category_id']))
        {
            $category_info = $this->model_catalog_newcategory->getCategory($setting['category_id']);
            if(isset($category_info['name']))
            {
                $setting['name'] =  $category_info['name'];
            }
        }

        $layout_id = $this->_layout_id  = $this->ocart->getLayoutId('ocivity3', 'kuteshop_theme', $this->config->get('config_store_id'));

        if(is_object($this->ocart))
        {
            $layout_id = $this->ocart->getLayoutId('ocivity3', 'kuteshop_theme', $this->config->get('config_store_id'));;
        }

        $setting_module = array(
            'category_id' => $setting['category_id'],
            'limit'       => (isset($setting['limit_product']) && !empty($setting['limit_product']) ? $setting['limit_product'] : 6),
            'width'       => 213,
            'height'      => 260,
            // Default col is 10, without list brand or last deal on left products
            'box_col_sm'  =>  10,
            'li_col_sm'   =>  4,
            'owl'	=> array(
                'data-dots'	=> 'false',
                'data-loop'	=> 'true',
                'data-nav'	=> 'true',
                'data-margin'	=> '0',
                'data-autoplayTimeout'	=> 1000,
                'data-autoplayHoverPause'	=> 'true',
                'data-responsive'	=> '{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}',
            )
        );

        $data['setting'] = $setting;
        $data['modules']['tabs'] = array(

        );

        $data['banner'] = array(
            'top_left'  => '',
            'top_right' => '',
            'bottom'    => '',
            'left'      => '',
            'right'     => ''
        );

        # Get all subcategories of this category
        $data['sub_categories'] = array();
        $sub_categories = $this->model_catalog_newcategory->getAllCategories($setting['category_id']);
        foreach ($sub_categories as $subcategory) {
            $data['sub_categories'][] = array(
                'name'  => $subcategory['name'],
                'href'  => $this->url->link('product/category', 'path=' . $setting['category_id'] . '_' . $subcategory['category_id'])
            );
        }
        # Get box list deal of the category, in case theme using Option layout id: 2
        if(isset($setting['status_box_last_deal']) && in_array($layout_id, $this->model_module_smarttab_const->listLayoutActiveDeal))
        {
            $setting_module['active_deal']   = true;
            $setting_module['setting_id']    = 999;
            $setting_module['template_list'] = '/template/module/smarttab/box/deal_layout'.$layout_id.'.tpl';
            $setting_module['template_item'] = '/template/module/smarttab/box/deal_item'.$layout_id.'.tpl';
            $html = $this->load->controller('module/smarttab_child/special', $setting_module);

            if (!empty($html))
            {
                $data['modules']['box']['deal'] = array(
                    'tab_id'    =>  $this->model_module_smarttab_util->genHashTabid($setting, 'deal'),
                    'title'     =>  $this->translator->_('Special'),
                    'content'   =>  $this->load->controller('module/smarttab_child/special', $setting_module),
                );
                $setting_module['box_col_sm'] = 10;
                $setting_module['li_col_sm']  = 4;
            }
            unset($html);
        }

        # Get box list brand of the category, in case theme using Option layout id: 2
        if(isset($setting['status_box_list_brand']) && in_array($layout_id, $this->model_module_smarttab_const->listLayoutActiveBrand))
        {
            $data['modules']['box']['brand'] = array(
                'tab_id'    =>  $this->model_module_smarttab_util->genHashTabid($setting, 'brand'),
                'title'     =>  $this->translator->_('Special'),
                'content'   =>  $this->load->controller('module/smarttab_child/brand', $setting_module),
            );
            $setting_module['box_col_sm'] = 8;
            $setting_module['li_col_sm']  = 3;
        }

        # Merge all module (viewed, reviews, special.) with all sub categories to one tab
        if(isset($setting['status_best_seller']))
        {
            $html = $this->load->controller('module/smarttab_child/best_seller', $setting_module);
            if(!empty($html))
            {
                $data['modules']['tabs']['best_seller'] = array(
                    'tab_id'    =>  $this->model_module_smarttab_util->genHashTabid($setting, 'best_seller'),
                    'title'     =>  $this->translator->_('Best Seller'),
                    'content'   =>  $this->load->controller('module/smarttab_child/best_seller', $setting_module),
                );
            }

            unset($html);
        }

        if(isset($setting['status_new_arrivals']))
        {
            $html = $this->load->controller('module/smarttab_child/new_arrivals', $setting_module);

            if(!empty($html))
            {
                $data['modules']['tabs']['arrivals'] = array(
                    'tab_id'    =>  $this->model_module_smarttab_util->genHashTabid($setting, 'arrivals'),
                    'title'     =>  $this->translator->_('New Arrivals'),
                    'content'   =>  $this->load->controller('module/smarttab_child/new_arrivals', $setting_module),
                );
            }

            unset($html);
        }

        if(isset($setting['status_most_viewed']))
        {
            $html = $this->load->controller('module/smarttab_child/viewed', $setting_module);

            if(!empty($html))
            {
                $data['modules']['tabs']['viewed'] = array(
                    'tab_id'    =>  $this->model_module_smarttab_util->genHashTabid($setting, 'viewed'),
                    'title'     =>  $this->translator->_('Most Viewed'),
                    'content'   =>  $this->load->controller('module/smarttab_child/viewed', $setting_module),
                );
            }

            unset($html);
        }

        if(isset($setting['status_most_reviews']))
        {
            $html = $this->load->controller('module/smarttab_child/reviews', $setting_module);
            if(!empty($html))
            {
                $data['modules']['tabs']['reviews'] = array(
                    'tab_id'    =>  $this->model_module_smarttab_util->genHashTabid($setting, 'reviews'),
                    'title'     =>  $this->translator->_('Most Reviews'),
                    'content'   =>  $this->load->controller('module/smarttab_child/reviews', $setting_module),
                );
            }

            unset($html);
        }

        if(isset($setting['status_special']))
        {
            $html = $this->load->controller('module/smarttab_child/special', $setting_module);

            if(!empty($html))
            {
                $data['modules']['tabs']['special'] = array(
                    'tab_id'    =>  $this->model_module_smarttab_util->genHashTabid($setting, 'special'),
                    'title'     =>  $this->translator->_('Special'),
                    'content'   =>  $this->load->controller('module/smarttab_child/special', $setting_module),
                );
            }

            unset($html);
        }

        if(isset($setting['subcategory']) && count($setting['subcategory']) > 0)
            foreach($setting['subcategory'] as $subcategory)
            {
                if(!isset($subcategory['status'])) continue;

                $subdata = array();

                # Get all products from sub category
                $filter_data = array(
                    'filter_category_id'    =>  $subcategory['id'],
                    'limit'                 => (isset($setting['limit_product']) && !empty($setting['limit_product']) ? $setting['limit_product'] : 6),
                );
                $products = $this->model_module_smarttab->getProducts($filter_data);
                if(count($products) > 0)
                {
                    $products = $this->model_module_smarttab_util->genArrayProducts($products, $setting_module);

                    $subdata['products_list_html'] = $this->model_module_smarttab_template->renderProductList(array('products' => $products, 'setting' => $setting_module), '/template/module/smarttab/item/layout'.$layout_id.'.tpl');
                    $subdata['setting'] = $setting_module;

                    if (file_exists(
                        DIR_TEMPLATE . $this->config->get('config_template')
                        . '/template/module/smarttab/list/layout'.$layout_id.'.tpl'
                    )) {
                        $subcontent = $this->load->view(
                            $this->config->get('config_template')
                            . '/template/module/smarttab/list/layout'.$layout_id.'.tpl', $subdata
                        );
                    } else {
                        $subcontent = $this->load->view(
                            'default/template/module/smarttab/list/layout'.$layout_id.'.tpl', $subdata
                        );
                    }

                    $category_info = $this->model_catalog_newcategory->getCategory($subcategory['id']);

                    # Render the product html from array products
                    $data['modules']['tabs']['subcategory_'.$subcategory['id']] = array(
                        'tab_id'    =>  $this->model_module_smarttab_util->genHashTabid($setting, 'subcategory_'.$subcategory['id']),
                        'title'     =>  $category_info['name'],
                        'content'   =>  $subcontent,
                    );

                    unset($subdata);
                }
            }

        # Get banners (top, left, right, bottom)

        $this->genBanner($setting, $data);

        $data['icon_id']  = $setting['icon_id'];
        $data['color_id'] = $setting['color_id'];
        $data['elevator'] = (int)$this->session->data['elevator'];
        $data['elevator_prev']  = (int)$this->session->data['elevator_prev'];
        $data['elevator_next']  = (int)$this->session->data['elevator_next'];
        $data['setting_module'] = $setting_module;

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/smarttab/layout/layout'.$layout_id.'.tpl'))
        {
            return $this->load->view($this->config->get('config_template') . '/template/module/smarttab/layout/layout'.$layout_id.'.tpl', $data);
        }
        else
        {
            return $this->load->view('default/template/module/smarttab/layout/layout'.$setting['layout_id'].'.tpl', $data);
        }
    }

    public function genBanner($setting, &$data)
    {
        $this->load->model('tool/newimage');
        $size = $this->model_module_smarttab_const->getSizeBanners($this->_layout_id);
        $data['banner']['top_left']['dim']  = $size['top_left'];
        $data['banner']['top_left']['link']  = $setting['url_banner_top_left'];
        $data['banner']['top_right']['dim'] = $size['top_right'];
        $data['banner']['top_right']['link']  = $setting['url_banner_top_right'];
        $data['banner']['right']['dim']     = $size['right'];
        $data['banner']['right']['link']  = $setting['url_banner_right'];
        $data['banner']['bottom']['dim']    = $size['bottom'];
        $data['banner']['bottom']['link']  = $setting['url_banner_bottom'];
        $data['banner']['left']['dim']      = $size['left'];
        $data['banner']['left']['link']  = $setting['url_banner_left'];
        if(isset($setting['banner_top_left']) && !empty($setting['banner_top_left']))
        {
            $data['banner']['top_left']['src'] = $this->model_tool_newimage->crop($setting['banner_top_left'], $size['top_left']['w'], $size['top_left']['h']);
        }
        else
        {
            $data['banner']['top_left']['src'] = '';//$this->model_tool_newimage->crop('default-no-image.png', $size['top_left']['w'], $size['top_left']['h']);
        }

        if(isset($setting['banner_top_right']) && !empty($setting['banner_top_right']))
        {
            $data['banner']['top_right']['src'] =  $this->model_tool_newimage->crop($setting['banner_top_right'], $size['top_right']['w'], $size['top_right']['h']);
        }
        else
        {
            $data['banner']['top_right']['src'] =  '';//$this->model_tool_newimage->crop('default-no-image.png', $size['top_right']['w'], $size['top_right']['h']);
        }

        if(isset($setting['banner_right']) && !empty($setting['banner_right']))
        {
            $data['banner']['right']['src'] =  $this->model_tool_newimage->crop($setting['banner_right'], $size['right']['w'], $size['right']['h']);
        }
        else
        {
            $data['banner']['right']['src'] =  '';//$this->model_tool_newimage->crop('default-no-image.png', $size['right']['w'], $size['right']['h']);
        }

        if(isset($setting['banner_bottom']) && !empty($setting['banner_bottom']))
        {
            $data['banner']['bottom']['src'] = $setting['banner_bottom'];
        }

        if(isset($setting['banner_left']) && !empty($setting['banner_left']))
        {
            $data['banner']['left']['src'] = $this->model_tool_newimage->crop($setting['banner_left'], $size['left']['w'], $size['left']['h']);
        }
        else
        {
            $data['banner']['left']['src'] = '';//$this->model_tool_newimage->crop('default-no-image.png', $size['left']['w'], $size['left']['h']);
        }
    }
}