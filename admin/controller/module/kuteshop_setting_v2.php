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

class ControllerModuleKuteshopSettingV2 extends Controller
{
    private $error = array();
    private $prefix_config = 'kutetheme_setting_';
    private $skin = '1';
    private $group_setting = 'kutetheme_setting';

    #EVENT_ON_TOP_VARIBLES

    protected function _beforeAction(){
        #EVENT_BEFORE_ADD_STYLE
        //$this->document->addStyle('view/stylesheet/kutetheme/fonts/css/font-awesome.min.css');
        $this->document->addStyle('view/stylesheet/kutetheme/css/animate.min.css');
        $this->document->addStyle('view/stylesheet/kutetheme/css/colorpicker/bootstrap-colorpicker.min.css');
        $this->document->addStyle('view/stylesheet/kutetheme/css/custom.css');
        $this->document->addStyle('view/stylesheet/kutetheme/css/icheck/flat/green.css');
        $this->document->addStyle('view/stylesheet/kutetheme/css/floatexamples.css');
        $this->document->addStyle('view/stylesheet/kutetheme/css/switchery/switchery.min.css');
        $this->document->addStyle('view/stylesheet/kutetheme/css/select/select2.min.css');
        $this->document->addStyle('view/stylesheet/kutetheme/css/jquery.domenu-0.48.53.css');
        $this->document->addStyle('../catalog/view/theme/kute/stylesheet/metro-icons.css');
        $this->document->addStyle('view/javascript/kutetheme/js/jstree/jqueryFileTree.css');
        #EVENT_BEFORE_ADD_SCRIPT

        # Add jquery for only opencart 1.5
        $this->document->addScript('view/javascript/kutetheme/js/nicescroll/jquery.nicescroll.min.js');
        $this->document->addScript('view/javascript/kutetheme/js/colorpicker/bootstrap-colorpicker.js');
        $this->document->addScript('view/javascript/kutetheme/js/icheck/icheck.min.js');
        $this->document->addScript('view/javascript/kutetheme/js/moment.min.js');
        $this->document->addScript('view/javascript/kutetheme/js/datepicker/daterangepicker.js');
        $this->document->addScript('view/javascript/kutetheme/js/switchery/switchery.min.js');
        $this->document->addScript('view/javascript/kutetheme/js/jquery.domenu-0.48.53.js');
        $this->document->addScript('view/javascript/kutetheme/js/select/select2.full.js');
        $this->document->addScript('view/javascript/kutetheme/js/jstree/jquery.easing.js');
        $this->document->addScript('view/javascript/kutetheme/js/jstree/jqueryFileTree.js');
        $this->document->addScript('view/javascript/kutetheme/js/jquery.tmpl.min.js');
        $this->document->addScript('view/javascript/kutetheme/js/jquery.twbsPagination.min.js');
        $this->document->addScript('view/javascript/kutetheme/js/jquery.md5.js');
        $this->document->addScript('view/javascript/kutetheme/js/custom.js');
        $this->document->addScript('view/javascript/kutetheme/js/sortable.js');
        #EVENT_AFTER_ADD_SCRIPT
    }

    private function _processRequest()
    {
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate())
        {
            $this->load->model('setting/setting');
            // get key ocivity3_kute_theme to another data
            $data_ocivity3['ocivity3_kuteshop_theme'] = $this->request->post['ocivity3_kuteshop_theme'];
            unset($this->request->post['ocivity3_kuteshop_theme']);
            $this->model_setting_setting->editSetting('ocivity3', $data_ocivity3, $this->request->post['store_id']);

            $this->session->data['language_code'] = $this->request->post['language_id'];
            $this->session->data['store_id'] = $this->request->post['store_id'];

            $this->model_setting_newsetting->editSetting('kutetheme_setting', $this->request->post);
            $this->session->data['success'] = $this->translator->_('Update setting successful.');

            // save layout module
            $this->load->model('design/newlayout');
            $this->model_design_newlayout->editLayout($this->request->post['layout_id'], $this->request->post);

            $this->response->redirect($this->url->link('module/kuteshop_setting_v2', 'token=' . $this->session->data['token'], 'SSL'));
        }
    }
    public function index()
    {
        $data = array();
        $this->load->model('extension/module');
        $this->load->model('setting/store');
        $this->load->model('setting/setting');
        $this->load->model('setting/newsetting');
        $this->load->model('setting/newstore');
        $this->load->model('module/smarttab');
        $this->load->model('catalog/category');
        $this->load->model('tool/image');

        if(isset($this->request->get['ajax']) && $this->request->get['ajax'] == 'true'){
            if(isset($this->request->get['language'])){
                $this->session->data['language_code'] = $this->request->get['language'];
            }else if(isset($this->request->get['store_id'])){
                $this->session->data['store_id'] = $this->request->get['store_id'];
            }
            $data['ajax'] = true;
        }

        $this->_beforeAction();

        $this->_processRequest();

        $this->language->load('module/kuteshop_setting');

        $data['main_class'] = 'container-kuteshop_setting';

        $template_file = 'form';
        $title = 'Kutetheme Setting';

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
        if(is_array($data['stores']) && count($data['stores'])){
            $data['stores'][] = array(
                'store_id'  => 0,
                'name'      => 'Default',
                'url'       => HTTP_CATALOG,
                'ssl'       => 0,
            );
        }

        $data['is_duplicated'] = (isset($this->request->get['is_duplicated']) ? true : false);

        $data['current_store'] = $this->_getCurrentStore();

        $data['tabs']    = $this->_registerTabs();

        $this->load->model('localisation/language');

        $data['languages'] = $this->model_localisation_language->getLanguages();

        $data['current_language'] = $this->_getLang();

        $this->response->setOutput(Tpl::buildTemplate($this->load, 'module/kuteshop_setting/layout/container_form_v2.tpl', 'module/kuteshop_setting/configuration/'.$template_file.'_v2.tpl', $data));
    }

    public function content_setting()
    {
        $data = array();
        $this->_genObjectEditImage($data, 'slider_addition_image_left', 'slider_addition_image_left', 30, 30);
        $this->_genObjectEditImage($data, 'slider_addition_image_right', 'slider_addition_image_right', 30, 30);

        $this->_genConfigField($data, 'footer_address');
        $this->_genConfigField($data, 'footer_payment_method');
        $this->_genConfigField($data, 'footer_keywords');
        $this->_genConfigField($data, 'footer_links');


        $this->_genConfigField($data, 'slider_addition_display_left');
        $this->_genConfigField($data, 'slider_addition_display_right');

        $this->_genConfigField($data, 'social_link', true);

        return $this->load->view('module/kuteshop_setting/child/content_setting.phtml', $data);
    }

    public function display_setting()
    {
        $this->load->model('tool/image');
        $data = array();
        $this->_genObjectEditImage($data, 'logo', 'logo');

        $this->_genConfigField($data, 'general_color');
        $this->_genConfigField($data, 'category_product_per_row');

        return $this->load->view('module/kuteshop_setting/child/display_setting.phtml', $data);
    }

    public function general_setting()
    {
        $this->load->model('setting/setting');
        $data = array();
        $data['setting_info']   = $this->model_setting_setting->getSetting('ocivity3', $this->_getCurrentStore());
        $data['layouts'] = $this->model_module_smarttab->getLayouts();
        $data['current_layout_id'] = (isset($data['setting_info']['ocivity3_kuteshop_theme'])) ? $data['setting_info']['ocivity3_kuteshop_theme']['layout_id'] : 1;
        $data['enable_cached'] = (isset($data['setting_info']['ocivity3_kuteshop_theme']['cached'])) ? $data['setting_info']['ocivity3_kuteshop_theme']['cached'] : 0;
        return $this->load->view('module/kuteshop_setting/child/general_setting.phtml', $data);
    }

    public function visual_composer()
    {
        $this->load->model('design/layout');
        $this->load->model('design/newlayout');
        $this->load->model('extension/extension');
        $this->load->model('extension/module');

        $data = array();
        $data['extensions'] = array();

        $data['layout_id'] = 1;
        if(isset($this->request->post['ajax']) && $this->request->post['ajax'] == 'true'){
            $data['ajax'] = true;
            $data['layout_id'] = $this->request->post['layout_id'];
        }

        // Get a list of installed modules
        $extensions = $this->model_extension_extension->getInstalled('module');
        $extensions = array_unique($extensions);
        // Add all the modules which have multiple settings for each module
        foreach ($extensions as $code) {
            $this->load->language('module/' . $code);

            $module_data = array();

            $modules = $this->model_extension_module->getModulesByCode($code);

            foreach ($modules as $module) {
                $module_data[] = array(
                    'name' => $this->language->get('heading_title') . ' &gt; ' . $module['name'],
                    'code' => $code . '.' .  $module['module_id']
                );
            }

            if ($this->config->has($code . '_status') || $module_data) {
                $data['extensions'][] = array(
                    'name'   => $this->language->get('heading_title'),
                    'code'   => $code,
                    'module' => $module_data
                );
            }
        }
        $filter_data = array(
            'start' => 0,
            'limit' => 100
        );
        $data['layouts'] = $this->model_design_layout->getLayouts($filter_data);

        $data['layout_modules'] = $this->model_design_newlayout->getLayoutModules($data['layout_id']);
        $data['token'] = $this->request->get['token'];

        if(isset($this->request->post['ajax']) && $this->request->post['ajax'] == 'true'){
            $data['position'] = $this->request->post['position'];
            $data['token'] = $this->request->post['token'];
            echo $this->load->view('module/kuteshop_setting/child/visual_composer_module.phtml', $data);
        }else{
            return $this->load->view('module/kuteshop_setting/child/visual_composer.phtml', $data);
        }
    }

    public function translation()
    {
        $this->load->model('localisation/newlanguage');
        $data = array();
        $data['token'] = $this->session->data['token'];
        $language_info = $this->model_localisation_newlanguage->getLanguageByCode($this->_getLang());
        $data['locale_language'] = DIR_CATALOG.'language'.DIRECTORY_SEPARATOR.$language_info['directory'].DIRECTORY_SEPARATOR;
        $path_i18n = DIR_OCIVITY3.'app'.DIRECTORY_SEPARATOR.'i18n'.DIRECTORY_SEPARATOR;
        $global_csv_file  = $path_i18n.$language_info['directory'].DIRECTORY_SEPARATOR.'global.csv';
        $english_csv_file = $path_i18n."english".DIRECTORY_SEPARATOR.'global.csv';

        if(!file_exists($global_csv_file)){
            // check permission folder i18n
            if(!is_writeable($path_i18n)){
                $data['permission_message'] = 'The folder <b>'.$path_i18n.'</b> is not writeable. Please <b>CHMOD</b> that folder to <b>777</b>ll.';
            }else{
                // check folder exist
                if(!file_exists($path_i18n.$language_info['directory'])){
                    // create folder for this language
                    mkdir($path_i18n.$language_info['directory'], 0777, true);
                }
                // create new file global.csv
                copy($english_csv_file, $global_csv_file);
            }
        }
        if(file_exists($global_csv_file)){
            $data['global_file']     = $global_csv_file;
            $data['global_language'] = $this->_csv_to_array($global_csv_file);
        }

        return $this->load->view('module/kuteshop_setting/child/translation.phtml', $data);
    }

    public function save_module()
    {
        $this->load->model('design/newlayout');
        $this->model_design_newlayout->editLayout($this->request->post['layout_id'], $this->request->post);
    }

    public function _read_translate_file()
    {
        $file = urldecode($this->request->post['file']);

        if (file_exists($file)) {
            $permission = is_writeable($file);
            require_once $file;
            header('Content-Type: application/json');
            echo json_encode(
                array(
                    '_' => $_,
                    'is_writeable' => $permission
                )
            );
        }
    }

    public function _save_translate_global_file()
    {
        header('Content-Type: application/json');
        $file = urldecode($this->request->post['file']);

        if (file_exists($file)) {
            if (!is_writable($file)) {
                echo json_encode(array(
                    'error'     =>  '1',
                    'msg'       =>  'The file '.$file.' can not writeable. Please CHMOD 777 this file to continue translate.'
                ));
                exit;
            }

            $text = "";

            foreach ($this->request->post['global_translation'] as $trans) {
                if(trim($trans['value']) == "") continue;
                $text .= trim($trans['key']).",".trim($trans['value'])."\n";
            }

            $fhandle = fopen($file, "r+");
            ftruncate($fhandle, 0);

            $fhandle = fopen($file, "w");
            fwrite($fhandle, $text);
            fclose($fhandle);

            echo json_encode(array(
                'error'     =>  ''
            ));
        }
    }

    public function _save_translate_file()
    {
        $file = urldecode($this->request->post['file']);

        if (file_exists($file)) {
            $text = "<?php\n\n";

            $keys = array_keys($this->request->post['translation']);
            $max = $keys[0];

            for ($i = 0; $i < count($keys) - 1; $i++) {
                if (strlen($keys[$i]) > strlen($max)) {
                    $max = $keys[$i];
                }
            }

            $maxlen = strlen($max) + 10;

            foreach ($this->request->post['translation'] as $key => $trans) {
                $misslen = $maxlen - strlen($key);
                $space = "";
                for ($i = 0; $i < $misslen - 1; $i++) {
                    $space .= " ";
                }
                $text .= "\$_['$key']$space= '".addslashes($trans['value'])."';\n";
            }

            $fname = $file;
            // create backup file
            //copy($file, $file."~backup");

            $fhandle = fopen($fname, "r+");
            ftruncate($fhandle, 0);

            $fhandle = fopen($fname, "w");
            fwrite($fhandle, $text);
            fclose($fhandle);
            header('Content-Type: application/json');

            echo json_encode(array(
                'error'     =>  ''
            ));
        }
    }

    public function _list_folder()
    {
        $this->request->post['dir'] = urldecode($this->request->post['dir']);
        $allowExt = array('php', 'csv');
        if( file_exists( $this->request->post['dir']) ) {
            $files = scandir($this->request->post['dir']);
            natcasesort($files);
            if( count($files) > 2 ) { /* The 2 accounts for . and .. */
                echo "<ul class=\"jqueryFileTree\" style=\"display: none;\">";
                // All dirs
                foreach( $files as $file ) {
                    if( file_exists( $this->request->post['dir'] . $file) && $file != '.' && $file != '..' && is_dir($this->request->post['dir'] . $file) ) {
                        echo "<li class=\"directory collapsed\"><a href=\"#\" rel=\"" . htmlentities($this->request->post['dir'] . $file) . "/\">" . htmlentities($file) . "</a></li>";
                    }
                }
                // All files
                foreach( $files as $file ) {
                    if( file_exists($this->request->post['dir'] . $file) && $file != '.' && $file != '..' && !is_dir($this->request->post['dir'] . $file) ) {
                        $ext = preg_replace('/^.*\./', '', $file);
                        if(!in_array($ext, $allowExt)) continue;

                        echo "<li class=\"file ext_$ext\"><a href=\"#\" rel=\"" . htmlentities($this->request->post['dir'] . $file) . "\">" . htmlentities($file) . "</a></li>";
                    }
                }
                echo "</ul>";
            }
        }
    }

    public function _csv_to_array($file)
    {
        $handle = fopen($file, "r");
        $results = array();

        if ($handle) {
            while (($line = fgets($handle)) !== false) {
                // process the line read.
                list($key, $word) = explode(",", $line);
                $results[trim($key)] = trim($word);
            }

            fclose($handle);
        } else {
            // error opening the file.
        }

        return $results;
    }

    public function custom_menu_module()
    {
        $data = array();
        $data['icons'] = Ocart::getMetroIcons();
        $this->_genConfigField($data, 'vertical_menu');
        $this->_genConfigField($data, 'enabled_vertical_menu');
        return $this->load->view('module/kuteshop_setting/child/custom_menu_module.phtml', $data);
    }

    protected function _registerTabs()
    {
        $data = array(
            array(
                'tab_id'        =>  'general_setting',
                'title'         =>  'General Setting',
                'icon'          =>  'fa fa-cog',
                'html'          =>  $this->load->controller('module/kuteshop_setting_v2/general_setting'),
            ),
            array(
                'tab_id'        =>  'display_setting',
                'title'         =>  'Display Setting',
                'active'        =>  true,
                'icon'          =>  'fa fa-desktop',
                'html'          =>  $this->load->controller('module/kuteshop_setting_v2/display_setting'),
            ),
            array(
                'tab_id'        =>  'content_setting',
                'title'         =>  'Content Setting',
                'icon'          =>  'fa fa-edit',
                'html'          =>  $this->load->controller('module/kuteshop_setting_v2/content_setting'),
            ),
            array(
                'tab_id'        =>  'translation',
                'title'         =>  'Translation',
                'icon'          =>  'fa fa-globe',
                'html'          =>  $this->load->controller('module/kuteshop_setting_v2/translation'),
            ),
            array(
                'tab_id'        =>  'custom_menu_module',
                'title'         =>  'Vertical Menu',
                'icon'          =>  'fa fa-bars',
                'html'          =>  $this->load->controller('module/kuteshop_setting_v2/custom_menu_module'),
            ),
            array(
                'tab_id'        =>  'visual_composer',
                'title'         =>  'Layout Composer',
                'icon'          =>  'fa fa-th',
                'html'          =>  $this->load->controller('module/kuteshop_setting_v2/visual_composer'),
            ),
        );

        return $data;
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

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'module/kuteshop_setting')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }

    public function _genConfigField(&$data, $field, $serialized = false)
    {
        $field = $this->prefix_config.$field;

        if (isset($this->request->post[$field])) {
            $data[$field] = $this->request->post[$field];
        } else {
            if ($serialized) {
                $data[$field] = mig_unserialize($this->__cg($field));
            } else {
                $data[$field] = $this->__cg($field);
            }

        }
    }

    protected function _genObjectEditImage(&$data, $field, $varible, $w = 30, $h = 30){
        $this->load->model('tool/image');

        if (isset($this->request->post[$this->prefix_config.$field])) {
            $data[$this->prefix_config.$field] = $this->request->post[$this->prefix_config.$field];
        } else {
            $data[$this->prefix_config.$field] = $this->config->get($this->prefix_config.$field, $this->_getLang(), $this->_getCurrentStore());
        }

        if (isset($this->request->post[$this->prefix_config.$field]) && is_file(DIR_IMAGE . $this->request->post[$this->prefix_config.$field])) {
            $data[$varible] = $this->model_tool_image->resize($this->request->post[$this->prefix_config.$field], $w, $h);
        } elseif ($this->config->get($this->prefix_config.$field, $this->_getLang(), $this->_getCurrentStore()) && is_file(DIR_IMAGE . $this->config->get($this->prefix_config.$field, $this->_getLang(), $this->_getCurrentStore()))) {
            $data[$varible] = $this->model_tool_image->resize($this->config->get($this->prefix_config.$field, $this->_getLang(), $this->_getCurrentStore()), $w, $h);
        } else {
            $data[$varible] = $this->model_tool_image->resize('no_image.png', $w, $h);
        }
    }

    protected function _getLang() {
        if (!isset($this->session->data['language_code']) || empty($this->session->data['language_code'])) {
            $this->session->data['language_code'] = $this->config->get('config_language');
        }

        return $this->session->data['language_code'];
    }

    protected function _getCurrentStore() {
        if (!isset($this->session->data['store_id'])) {
            $this->session->data['store_id'] = 0;
        }

        return $this->session->data['store_id'];
    }

    // Quick get config setting
    protected function __cg($key) {
        return $this->config->get($key, $this->_getLang(), $this->_getCurrentStore());
    }
}