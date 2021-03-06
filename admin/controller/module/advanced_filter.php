<?php
class ControllerModuleAdvancedFilter extends Controller {
    private $error = array();

    public function index() {
        $this->load->language('module/advanced_filter');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('advanced_filter', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
        }

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

        $data['entry_status'] = $this->language->get('entry_status');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_module'),
            'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('module/advanced_filter', 'token=' . $this->session->data['token'], 'SSL')
        );

        $data['action'] = $this->url->link('module/advanced_filter', 'token=' . $this->session->data['token'], 'SSL');

        $data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');

        $this->load->model('catalog/option');

        $data['options'] = $this->model_catalog_option->getOptions();

        if (isset($this->request->post['advanced_filter_status'])) {
            $data['advanced_filter_status'] = $this->request->post['advanced_filter_status'];
        } else {
            $data['advanced_filter_status'] = $this->config->get('advanced_filter_status');
        }

        if (isset($this->request->post['advanced_filter_option_id_color'])) {
            $data['advanced_filter_option_id_color'] = $this->request->post['advanced_filter_option_id_color'];
        } else {
            $data['advanced_filter_option_id_color'] = $this->config->get('advanced_filter_option_id_color');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('module/advanced_filter/form.tpl', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'module/advanced_filter')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}