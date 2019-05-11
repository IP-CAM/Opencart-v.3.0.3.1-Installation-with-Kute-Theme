<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/17/15
 * Time: 15:53
 */

class BlockModuleSlideshow extends Block {
    public function toHtml() {
        $this->load->model('tool/newimage');
        $this->data['translator'] = $this->translator;
        $setting = (isset($this->data['setting']) ? $this->data['setting'] : array());
        $layout_id = $this->ocart->getLayoutId('ocivity3', 'kuteshop_theme', $this->config->get('config_store_id'));;
        $this->data['layout_id'] = $layout_id;

        if (!isset($this->request->get['route']) || $this->request->get['route'] == 'common/home')
        {
            // get left/right image of slideshow
            if(Ocart::getConfig('slider_addition_display_left')){
                $this->data['image_left']  = $this->model_tool_newimage->crop((!Ocart::getConfig('slider_addition_image_left')  ? 'no_image.png' : Ocart::getConfig('slider_addition_image_left')));
                $this->data['link_image_left'] = Ocart::getConfig('slider_addition_link_left');
            }
            if(Ocart::getConfig('slider_addition_display_right')){
                $this->data['image_right'] = $this->model_tool_newimage->crop((!Ocart::getConfig('slider_addition_image_right') ? 'no_image.png' : Ocart::getConfig('slider_addition_image_right')));
                $this->data['link_image_right'] = Ocart::getConfig('slider_addition_link_right');
            }

            $this->data['displayed_vertical_menu'] = Ocart::getConfig('enabled_vertical_menu');

            $this->setTemplate('slideshow/home_option'.$layout_id.'.phtml');
        }
        else if (isset($this->request->get['route']) && $this->request->get['route'] == 'product/category')
        {
            $this->setTemplate('slideshow/category_option'.$layout_id.'.phtml');
        }
        else if (isset($this->request->get['route']) && $this->request->get['route'] == 'product/product')
        {
            $this->data['banners'] = array();

            $results = $this->model_design_banner->getBanner($setting['banner_id']);

            foreach ($results as $result) {
                if (is_file(DIR_IMAGE . $result['image'])) {
                    $this->data['banners'][] = array(
                        'title' => $result['title'],
                        'link'  => $result['link'],
                        'image' => $this->model_tool_image->resize($result['image'], 270, 345)
                    );
                }
            }

            $this->setTemplate('slideshow/product_option'.$layout_id.'.phtml');
        }
        else
        {
            $this->setTemplate('slideshow/product_option'.$layout_id.'.phtml');
        }

        return parent::toHtml();
    }
}