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

class ControllerModuleKuteshopSetting extends Controller
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
            if(!isset($this->request->post['store_id']))
            {
                $this->model_setting_setting->editSetting('ocivity3', $this->request->post, $this->request->post['selected_store_id']);
                $this->session->data['success'] = $this->translator->_('Update setting successful.');

                $this->response->redirect($this->url->link('module/kuteshop_setting', 'token=' . $this->session->data['token'], 'SSL'));
            }
        }
    }
    public function index()
    {
        $this->load->model('extension/module');
        $this->load->model('setting/store');
        $this->load->model('setting/setting');
        $this->load->model('setting/newstore');
        $this->load->model('module/smarttab');
        $this->load->model('catalog/category');
        $this->load->model('tool/image');

        $this->_beforeAction();

        $this->_processRequest();

        $this->language->load('module/kuteshop_setting');

        $data = array();

        $data['main_class'] = 'container-kuteshop_setting';

        $template_file = 'form';

        $url_cancel = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        $title =  $this->translator->_('Kuteshop Setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') || isset($this->request->get['store_id']))
        {
            $store_id = (isset($this->request->get['store_id'])) ? $this->request->get['store_id'] :$this->request->post['store_id'];
            $store_name = $this->model_setting_newstore->getStore($store_id, 'name');

            $data['setting_info']   = $this->model_setting_setting->getSetting('ocivity3', $store_id);
            $template_file          = 'edit';
            $url_cancel             = $this->url->link('module/kuteshop_setting', 'token=' . $this->session->data['token'], 'SSL');

            Tpl::addButton(array(
                'class'     =>  'positive',
                'onclick'   =>  'j$original(\'#form\').submit();',
                'text'      =>  'Save',
                'after'     =>  '<div class="or"></div>'
            ));

            Tpl::addButton(array(
                'onclick'   =>  'location.href = \''.$url_cancel.'\'',
                'text'      =>  'Cancel',
                'after'     =>  ''
            ));
            $data['text_sub_header'] = ' on store '.$store_name;
            $data['store_id'] = $store_id;

            $data['current_layout_id'] = (isset($data['setting_info']['ocivity3_kuteshop_theme'])) ? $data['setting_info']['ocivity3_kuteshop_theme']['layout_id'] : 1;
            $data['enable_cached'] = (isset($data['setting_info']['ocivity3_kuteshop_theme']['cached'])) ? $data['setting_info']['ocivity3_kuteshop_theme']['cached'] : 0;
        }

        $this->document->setTitle($title);

        $data['heading_title'] = $title;

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

        $data['url_load_pages'] = $this->url->link('module/kuteshop_setting/loadPages', 'token=' . $this->session->data['token'], 'SSL');

        $data['token'] = $this->session->data['token'];
        $data['no_image'] = $data['placeholder_image']= $this->model_tool_image->resize("no_image.png", 30, 30);

        $data['model_store'] = $this->model_setting_newstore;
        $data['stores'] = $this->model_setting_store->getStores();
        $data['stores'][] = array(
            'store_id'  => 0,
            'name'      => 'Default',
            'url'       => HTTP_CATALOG,
            'ssl'       => 0,
        );
        $data['layouts'] = $this->model_module_smarttab->getLayouts();

        $this->response->setOutput(Tpl::buildTemplate($this->load, 'module/kuteshop_setting/layout/container_form.tpl', 'module/kuteshop_setting/configuration/'.$template_file.'.tpl', $data));
    }

    public function cleanCached()
    {
        $files = array();

        // Make path into an array
        $path = array(DIR_CACHE . '*');

        // While the path array is still populated keep looping through
        while (count($path) != 0) {
            $next = array_shift($path);

            foreach (glob($next) as $file) {
                // If directory add to path array
                if (is_dir($file)) {
                    $path[] = $file . '/*';
                }

                // Add the file to the files to be deleted array
                $files[] = $file;
            }
        }

        // Reverse sort the file array
        rsort($files);

        // Clear all modification files
        foreach ($files as $file) {
            if ($file != DIR_CACHE . 'index.html') {
                // If file just delete
                if (is_file($file)) {
                    unlink($file);

                    // If directory use the remove directory function
                } elseif (is_dir($file)) {
                    rmdir($file);
                }
            }
        }

        $this->session->data['success'] = 'Clean Cached successful!';

        $this->response->redirect($this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL'));
    }
    public function loadPages()
    {
        header('Content-Type: application/json');

        # Check the template is exist, if that layout id is new, download it from server and move to folder layout
        echo json_encode(
            array(
                'html'  =>  $this->load->block('module/kutesetting')->setTemplate('kutesetting/page/option'.$this->request->post['layout_id'].'/layout.phtml')->setData(array())->toHtml()
            )
        );
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'module/kuteshop_setting')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}