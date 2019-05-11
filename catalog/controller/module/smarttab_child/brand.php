<?php

class ControllerModuleSmarttabChildBrand extends Controller
{
	public function index($setting)
	{
		$this->load->model('catalog/newmanufacturer');
		$this->load->model('module/smarttab/util');
		$this->load->model('module/smarttab/template');
		$this->load->language('module/smarttab');

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

		$results = $this->model_catalog_newmanufacturer->getManufacturersByCategory($filter_data['category_id']);

		$data['brand'] = array();

		foreach ($results as $result)
		{
			$brand_info = $this->model_catalog_newmanufacturer->getManufacturer($result['manufacturer_id']);

			if (!empty($brand_info['image']) && file_exists(DIR_IMAGE.$brand_info['image']))
			{
				$thumb = $this->model_tool_image->resize($brand_info['image'], 143, 61);
			}
			else
			{
				$thumb = $this->model_tool_image->resize('no_image.png', 143, 61);
			}

			$data['brands'][] = array(
				'id'		=>	$result['manufacturer_id'],
				'thumb'		=> 	$thumb,
				'name'  	=>  $brand_info['name'],
				'href'  	=>  $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $result['manufacturer_id']),
			);
		}

		$data['setting'] = $setting;
		if (count($data['brands'])) {
			if (file_exists(
				DIR_TEMPLATE . $this->config->get('config_template')
				. '/template/module/smarttab/list/brand_layout'.$layout_id.'.tpl'
			)) {
				return $this->load->view(
					$this->config->get('config_template')
					. '/template/module/smarttab/list/brand_layout'.$layout_id.'.tpl', $data
				);
			} else {
				return $this->load->view(
					'default/template/module/smarttab/list/brand_layout'.$layout_id.'.tpl', $data
				);
			}
		}
	}
}
