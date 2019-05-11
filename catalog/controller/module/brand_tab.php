<?php
class ControllerModuleBrandTab extends Controller {
	public function index() {

		$this->load->model('catalog/newmanufacturer');
		$this->load->model('module/smarttab/util');
		$this->load->model('catalog/newproduct');

		$this->load->language('module/brand_tab');

		$data['heading_title'] = $this->language->get('heading_title');

        $brand_list = $this->config->get('brand_tab_active');
        # Get all brands (title, icon, products)
        if(!empty($brand_list) && count($brand_list) > 0)
        {
            $results = $this->config->get('brand_tab_active');
        }

        if (count($results) == 0) {
            return false;
        }

		foreach ($results as $result) {
			$products = array();
            $brand_id = $result;

            $brand_info = $this->model_catalog_newmanufacturer->getManufacturer($brand_id);

			$filter_data = array(
				'filter_manufacturer_id' => $brand_info['manufacturer_id'],
				'sort'                   => 'p.sort_order',
				'order'                  => 'DESC',
				'start'                  => 0,
				'limit'                  => 4
			);

			//@TODO: Get config width/height to products in the module Brand Tab
			$setting = array(
				'width'       => 142,
				'height'      => 173
			);

			$product_total = $this->model_catalog_newproduct->getTotalProducts($filter_data);

			$products = $this->model_catalog_newproduct->getProducts($filter_data);
			$products
				= $this->model_module_smarttab_util->genArrayProducts(
				$products, $setting
			);
		
			if ($brand_info['image']) {
				//@TODO: Get config width/height of the logo Brand
				$image = $this->model_tool_image->resize($brand_info['image'], 150, 71);
			} else {
				$image = $this->model_tool_image->resize('placeholder.png', 150, 71);
			}

			$data['manufacturers'][] = array(
				'id'    => $brand_info['manufacturer_id'],
				'name'  => $brand_info['name'],
				'image' => $image,
				'href'  => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $brand_info['manufacturer_id']),
				'products'	=> $products
			);
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/brand_tab.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/brand_tab.tpl', $data);
		} else {
			return $this->load->view('default/template/module/brand_tab.tpl', $data);
		}
	}
}