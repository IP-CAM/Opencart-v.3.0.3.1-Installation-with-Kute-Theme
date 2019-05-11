<?php
/**
 * Created by ANH To anh.to87@gmail.com.
 * This module have sharing for kuteshop theme only.
 * User: baoan
 * Date: 10/1/15
 * Time: 11:33
 */

require_once DIR_SYSTEM . "library/template.php";
use SOP\Unity\Template as Tpl;

class ControllerModuleSmartTab extends Controller
{
    private $error = array();
    #EVENT_ON_TOP_VARIBLES
    protected function _beforeAction(){
        #EVENT_BEFORE_ADD_STYLE
        $this->document->addStyle('../media/smarttab/lib/semantic/semantic.css');
        $this->document->addStyle('../media/smarttab/css/stylesheet_backend.css');
        $this->document->addStyle('../media/smarttab/lib/font-awesome/css/font-awesome.min.css');
        #EVENT_BEFORE_ADD_SCRIPT

        # Add jquery for only opencart 1.5
        #$this->document->addScript('../media/smarttab/lib/js/lib/jquery.js');
        $this->document->addScript('../media/smarttab/lib/js/noConflict.js');
        $this->document->addScript('../media/smarttab/lib/semantic/jquery.address.min.js');
        $this->document->addScript('../media/smarttab/lib/semantic/semantic-noconflict.js');
        $this->document->addScript('../media/smarttab/lib/jscolor/jscolor.js');

        $this->document->addScript('../media/smarttab/lib/js/lib/underscore.js');
        $this->document->addScript('../media/smarttab/lib/js/lib/backbone.js');
        $this->document->addScript('../media/smarttab/lib/js/backend/head.main.js');
        $this->document->addScript('../media/smarttab/lib/js/backend/view.js');
        #EVENT_AFTER_ADD_SCRIPT
    }
    private function _processRequest()
    {
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate())
        {
            if($this->request->post['category_id'] && isset($this->request->post['store_id']))
            {
                $category_info = $this->model_catalog_category->getCategory($this->request->post['category_id']);
                $store_name  = $this->model_setting_newstore->getStore($this->request->post['store_id'], 'name');
                if (!isset($this->request->get['module_id'])) {
                    $this->request->post['name'] = $category_info['name'] . ' on '.$store_name.' store';

                    $this->model_extension_module->addModule('smarttab', $this->request->post);
                } else {
                    $this->request->post['name'] = $category_info['name'] . ' on '.$store_name.' store';
                    $this->model_extension_module->editModule($this->request->get['module_id'], $this->request->post);
                }

                $this->session->data['success'] = $this->translator->_('Successfull');

                $this->response->redirect($this->url->link('module/smarttab', 'module_id='.$this->request->get['module_id'].'&token=' . $this->session->data['token'], 'SSL'));
            }
            else
            {
                $this->response->redirect($this->url->link('module/smarttab', 'token=' . $this->session->data['token'], 'SSL'));
            }
        }
    }
    public function index()
    {
        $this->load->model('extension/module');
        $this->load->model('setting/store');
        $this->load->model('setting/newstore');
        $this->load->model('module/smarttab');
        $this->load->model('catalog/category');
        $this->load->model('tool/image');

        $this->_beforeAction();

        $this->_processRequest();

        $this->language->load('module/smarttab');

        $data = array();

        $data['main_class'] = 'container-smarttab';

        Tpl::addButton(array(
            'class'     =>  'positive',
            'onclick'   =>  'j$original(\'#form\').submit();',
            'text'      =>  'Save',
            'after'     =>  '<div class="or"></div>'
        ));

        Tpl::addButton(array(
            'onclick'   =>  'location.href = \''.$this->url->link('module/smarttab', 'token=' . $this->session->data['token'], 'SSL').'\'',
            'text'      =>  'Cancel',
            'after'     =>  ''
        ));

        # Get current layout id of the theme
        #$data['current_layout_id'] = $this->ocart->getLayoutId('ocivity3', 'kuteshop_theme', $this->config->get('config_store_id'));

        $this->document->setTitle($this->language->get('heading_title'));

        $data['heading_title'] = $this->language->get('heading_title');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];
            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $data['token'] = $this->session->data['token'];
        $data['url_remove_module'] = $this->url->link('module/smarttab/remove', 'token=' . $this->session->data['token'], 'SSL');
        $data['url_load_subcategory'] = $this->url->link('module/smarttab/subcategory', 'token=' . $this->session->data['token'], 'SSL');
        $data['no_image'] = $data['placeholder_image']= $this->model_tool_image->resize("no_image.png", 30, 30);
        // Categories

        $data['categories'] = $this->model_catalog_category->getCategories();

        $modules    = $this->model_extension_module->getModulesByCode('smarttab');

        $data['modules'] = array();
        foreach ($modules as $key => $module)
        {
            $setting = mig_unserialize($module['setting']);
            $category_info = $this->model_catalog_category->getCategory($setting['category_id']);

            $data['modules'][$key] = array(
                'module_id'     =>  $module['module_id'],
                'category_id'   =>  $setting['category_id'],
                'category_name' =>  (!empty($category_info['path']) ? $category_info['path']." > " : "")."<b>".(isset($category_info['name']) ? $category_info['name'] : '')."</b>",
            );

            $data['modules'][$key] = array_merge($data['modules'][$key], $setting);
        }

        $data['icons'] = $this->model_module_smarttab->getIcons();
        $data['layouts'] = $this->model_module_smarttab->getLayouts();

        $data['model_store'] = $this->model_setting_newstore;
        $data['stores'] = $this->model_setting_store->getStores();
        $data['stores'][] = array(
            'store_id'  => 0,
            'name'      => 'Default',
            'url'       => HTTP_CATALOG,
            'ssl'       => 0,
        );

        if(isset($this->request->get['module_id']) && !empty($this->request->get['module_id']))
        {
            $data['module_id']      = $this->request->get['module_id'];
            $data['module']   = $this->model_extension_module->getModule($this->request->get['module_id']);
            $data['subcategories'] = array();
            if(isset($data['module']['category_id']))
            {
                $data['subcategories'] = $this->model_module_smarttab->getCategories($data['module']['category_id']);
            }

            $data['text_sub_header'] = "Edit: <b>".$data['module']['name']. "</b> tabs";
            $this->genThumbBanner($data);
            $this->response->setOutput(Tpl::buildTemplate($this->load, 'module/smarttab/layout/container_form.tpl', 'module/smarttab/configuration/edit.tpl', $data));
        }
        else
        {
            $data['text_sub_header'] = "Design your tabs";
            $this->response->setOutput(Tpl::buildTemplate($this->load, 'module/smarttab/layout/container_form.tpl', 'module/smarttab/configuration/form.tpl', $data));
        }

    }

    private function genThumbBanner(&$data)
    {
        if(isset($data['module']['banner_top']) && !empty($data['module']['banner_top']))
        {
            $data['module']['thumb_banner_top'] = $this->model_tool_image->resize($data['module']['banner_top'], 30, 30);
        }
        else
        {
            $data['module']['thumb_banner_top'] = $data['no_image'];
        }

        if(isset($data['module']['banner_top_left']) && !empty($data['module']['banner_top_left']))
        {
            $data['module']['thumb_banner_top_left'] = $this->model_tool_image->resize($data['module']['banner_top_left'], 30, 30);
        }
        else
        {
            $data['module']['thumb_banner_top_left'] = $data['no_image'];
        }

        if(isset($data['module']['banner_top_right']) && !empty($data['module']['banner_top_right']))
        {
            $data['module']['thumb_banner_top_right'] = $this->model_tool_image->resize($data['module']['banner_top_right'], 30, 30);
        }
        else
        {
            $data['module']['thumb_banner_top_right'] = $data['no_image'];
        }

        if(isset($data['module']['banner_bottom']) && !empty($data['module']['banner_bottom']))
        {
            $data['module']['thumb_banner_bottom'] = $this->model_tool_image->resize($data['module']['banner_bottom'], 30, 30);
        }
        else
        {
            $data['module']['thumb_banner_bottom'] = $data['no_image'];
        }

        if(isset($data['module']['banner_left']) && !empty($data['module']['banner_left']))
        {
            $data['module']['thumb_banner_left'] = $this->model_tool_image->resize($data['module']['banner_left'], 30, 30);
        }
        else
        {
            $data['module']['thumb_banner_left'] = $data['no_image'];
        }

        if(isset($data['module']['banner_right']) && !empty($data['module']['banner_right']))
        {
            $data['module']['thumb_banner_right'] = $this->model_tool_image->resize($data['module']['banner_right'], 30, 30);
        }
        else
        {
            $data['module']['thumb_banner_right'] = $data['no_image'];
        }
    }

    public function remove()
    {
        header('Content-Type: application/json');

        $this->load->model('extension/module');
        $ok = false;
        if (($this->request->server['REQUEST_METHOD'] == 'POST'))
        {
            if(isset($this->request->post['module_id']) && !empty($this->request->post['module_id']))
            {
                $this->model_extension_module->deleteModule($this->request->post['module_id']);
                $ok = true;
            }
        }

        echo json_encode(array('ok' => $ok));
    }

    public function subcategory()
    {
        header('Content-Type: application/json');

        $ok = false;
        $subcategories = array();
        if (($this->request->server['REQUEST_METHOD'] == 'POST'))
        {
            $this->load->model('module/smarttab');
            $this->load->model('catalog/category');

            if(isset($this->request->post['category_id']) && !empty($this->request->post['category_id']))
            {
                $subcategories = $this->model_module_smarttab->getCategories($this->request->post['category_id']);
                if(count($subcategories) > 0)
                    $ok = true;
            }
        }

        echo json_encode(array('ok' => $ok, 'subcategories' => $subcategories));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'module/smarttab')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}