<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/6/15
 * Time: 11:08
 */

class ControllerModulePopularCategory extends Controller
{
    private $_layout_id = 0;
    public function index($setting)
    {
        $this->load->model('catalog/newcategory');
        $this->load->model('tool/newimage');

        $data = array();

        if(!empty($setting['category_1st_id']))
        {
            $data['category']['1st_info']   = $this->model_catalog_newcategory->getCategory($setting['category_1st_id']);
            $data['category']['1st_info']['sub']  = $this->model_catalog_newcategory->getAllCategories($setting['category_1st_id']);

            if(!empty($data['category']['1st_info']['image']))
            {
                $data['category']['1st_info']['image'] = $this->model_tool_newimage->resize($data['category']['1st_info']['image'], 200, 186);
            }else{
                $data['category']['image'] = $this->model_tool_newimage->resize('default-no-image.png', 200, 186);
            }
        }

        if(!empty($setting['category_2nd_id']))
        {
            $data['category']['2nd_info']   = $this->model_catalog_newcategory->getCategory($setting['category_2nd_id']);
            $data['category']['2nd_info']['sub']  = $this->model_catalog_newcategory->getAllCategories($setting['category_2nd_id']);

            if(!empty($data['category']['2nd_info']['image']))
            {
                $data['category']['2nd_info']['image'] = $this->model_tool_newimage->resize($data['category']['2nd_info']['image'], 200, 186);
            }else{
                $data['category']['2nd_info']['image'] = $this->model_tool_newimage->resize('default-no-image.png', 200, 186);
            }
        }

        if(!empty($setting['category_3rd_id']))
        {
            $data['category']['3rd_info']   = $this->model_catalog_newcategory->getCategory($setting['category_3rd_id']);
            $data['category']['3rd_info']['sub']  = $this->model_catalog_newcategory->getAllCategories($setting['category_3rd_id']);

            if(!empty($data['category']['3rd_info']['image']))
            {
                $data['category']['3rd_info']['image'] = $this->model_tool_newimage->resize($data['category']['3rd_info']['image'], 200, 186);
            }else{
                $data['category']['3rd_info']['image'] = $this->model_tool_newimage->resize('default-no-image.png', 200, 186);
            }
        }

        $data['url'] = $this->url;

        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/popular_category.tpl'))
        {
            return $this->load->view($this->config->get('config_template') . '/template/module/popular_category.tpl', $data);
        }
        else
        {
            return $this->load->view('default/template/module/popular_category.tpl', $data);
        }
    }
}