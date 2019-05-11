<?php
class ControllerModulePopularProductsTab extends Controller {
	private $disableModuleOnlayout = array(1);
	public function index() {
		$this->load->model('module/smarttab/util');
		$this->load->model('catalog/newproduct');

		# Constructor to gen tab id
		$setting = array(
			'hash'	=>	'ControllerModulePopularProductsTab'
		);

		$layout_id = (isset($setting['layout_id'])) ? $setting['layout_id'] : 0;

		if(is_object($this->ocart))
		{
			$layout_id = $this->ocart->getLayoutId('ocivity3', 'kuteshop_theme', $this->config->get('config_store_id'));;
		}

		$this->load->language('module/popular_products_tab');

		# Get 'last deal' products
		//@TODO: Get config width/height of the module popular products from admin
		$setting_module = array(
			'limit'       	=> 6,
			'width'       	=> 214,
			'height'      	=> 261,
			'active_deal' 	=> true,
			'template_item'	=> '/template/module/smarttab/item_deal.tpl',
			'template_list'	=> '/template/module/smarttab/list_deal.tpl',
			'owl'	=> array(
				'data-dots'	=> 'false',
				'data-loop'	=> 'true',
				'data-nav'	=> 'true',
				'data-margin'	=> 30,
				'data-autoplayTimeout'	=> 1000,
				'data-autoplayHoverPause'	=> 'true',
				'data-responsive'	=> '{"0":{"items":1},"600":{"items":3},"1000":{"items":1}}',
			)
		);

		$data['last_deal'] = array(
			'tab_id'    =>  $this->model_module_smarttab_util->genHashTabid($setting, 'last_deal'),
			'title'     =>  $this->translator->_('Last Deal'),
			'content'   =>  $this->load->controller('module/smarttab_child/special', $setting_module),
		);

		if(!in_array($layout_id, $this->disableModuleOnlayout))
		{
			return true;
		}

		//@TODO: Get config width/height of the module popular products from admin
		$setting_module = array(
			'limit'       => 6,
			'width'       => 248,
			'height'      => 303,
			'owl'	=> array(
				'data-dots'	=> 'false',
				'data-loop'	=> 'true',
				'data-nav'	=> 'true',
				'data-margin'	=> 30,
				'data-autoplayTimeout'	=> 1000,
				'data-autoplayHoverPause'	=> 'true',
				'data-responsive'	=> '{"0":{"items":1},"600":{"items":3},"1000":{"items":3}}',
			)
		);

		# Get best seller products
		$html = $this->load->controller('module/smarttab_child/best_seller', $setting_module);

		if(!empty($html))
		{
			$data['tabs']['best_seller'] = array(
				'tab_id'    =>  $this->model_module_smarttab_util->genHashTabid($setting, 'best_seller'),
				'title'     =>  $this->translator->_('Best Seller'),
				'content'   =>  $this->load->controller('module/smarttab_child/best_seller', $setting_module),
			);
		}

		# Get 'on sale' products
		$data['tabs']['on_sale'] = array(
			'tab_id'    =>  $this->model_module_smarttab_util->genHashTabid($setting, 'on_sale'),
			'title'     =>  $this->translator->_('On Sale'),
			'content'   =>  $this->load->controller('module/smarttab_child/special', $setting_module),
		);

		# Get new products
		$data['tabs']['arrivals'] = array(
			'tab_id'    =>  $this->model_module_smarttab_util->genHashTabid($setting, 'arrivals'),
			'title'     =>  $this->translator->_('New Arrivals'),
			'content'   =>  $this->load->controller('module/smarttab_child/new_arrivals', $setting_module),
		);

		# Get featured products
        $html = $this->load->controller('module/smarttab_child/featured', $setting_module);
        if (!empty($html))
        {
            $data['tabs']['featured'] = array(
                'tab_id'    =>  $this->model_module_smarttab_util->genHashTabid($setting, 'featured'),
                'title'     =>  $this->translator->_('Featured'),
                'content'   =>  $this->load->controller('module/smarttab_child/featured', $setting_module),
            );
        }
        unset($html);

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/popular_products_tab.tpl'))
		{
			return $this->load->view($this->config->get('config_template') . '/template/module/popular_products_tab.tpl', $data);
		}
		else
		{
			return $this->load->view('default/template/module/popular_products_tab.tpl', $data);
		}
	}
}