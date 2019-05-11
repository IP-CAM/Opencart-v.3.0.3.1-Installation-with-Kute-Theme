<?php

class ControllerModuleSmarttabChildViewed extends Controller
{
	public function index($setting)
	{
		$this->load->model('module/smarttab/util');
		$this->load->model('module/smarttab/template');
		$this->load->language('module/smarttab');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');

		$this->load->model('module/smarttab');

		$this->load->model('tool/image');

		$layout_id = (isset($setting['layout_id'])) ? $setting['layout_id'] : 0;

		if(is_object($this->ocart))
		{
			$layout_id = $this->ocart->getLayoutId('ocivity3', 'kuteshop_theme', $this->config->get('config_store_id'));;
		}

		$data['products'] = array();

		$filter_data = array(
			'category_id' => (isset($setting['category_id']) ? $setting['category_id'] : 0),
			'sort'        => 'pd.name',
			'order'       => 'ASC',
			'start'       => 0,
			'limit'       => (isset($setting['limit']) ? $setting['limit'] : 5)
		);

		$results = $this->model_module_smarttab->getPopularProducts(
			$filter_data
		);

		$data['setting'] = $setting;
		if ($results) {
			$data['products']
				= $this->model_module_smarttab_util->genArrayProducts(
				$results, $setting
			);

			$data['products_list_html']
				= $this->model_module_smarttab_template->renderProductList(
				$data, '/template/module/smarttab/item/layout'.$layout_id.'.tpl'
			);

			if (file_exists(
				DIR_TEMPLATE . $this->config->get('config_template')
				. '/template/module/smarttab/list/layout'.$layout_id.'.tpl'
			)) {
				return $this->load->view(
					$this->config->get('config_template')
					. '/template/module/smarttab/list/layout'.$layout_id.'.tpl', $data
				);
			} else {
				return $this->load->view(
					'default/template/module/smarttab/list/layout'.$layout_id.'.tpl', $data
				);
			}
		}
	}
}
