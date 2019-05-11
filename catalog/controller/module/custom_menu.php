<?php
class ControllerModuleCustomMenu extends Controller {
	public function index() {
		$data = array();

		$this->load->language('module/custom_menu');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/custom_menu.tpl'))
		{
			return $this->load->view($this->config->get('config_template') . '/template/module/custom_menu.tpl', $data);
		}
		else
		{
			return $this->load->view('default/template/module/custom_menu.tpl', $data);
		}
	}
}