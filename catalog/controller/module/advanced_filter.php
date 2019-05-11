<?php

class ControllerModuleAdvancedFilter extends Controller
{
	public function index()
	{
        $setting = array(
            'display_as_color'  => 13,
            'display_as_size'   => 11
        );

		$this->load->model('catalog/newcategory');
		$this->load->model('catalog/newproduct');
		$this->load->model('catalog/newmanufacturer');
		$this->load->model('module/advancedfilter');

        $filter_data = $this->model_module_advancedfilter->getFilteringData($this->request->get);

        $product_total = $this->model_catalog_newproduct->getTotalProducts($filter_data);
        $results = $this->model_catalog_newproduct->getProducts($filter_data);
        $final_options = $final_categories= $final_manufacturers = $final_range_price = $final_options_color = $final_options_size = array();

        if ($product_total)
        {
            $options = array();
            $product_ids = array();
            $manufacturer_ids = array();
            $product_price = array();
            foreach ($results as $product)
            {
                $product_ids[] = $product['product_id'];
                if (!in_array($product['manufacturer_id'], $manufacturer_ids) && $product['manufacturer_id'])
                {
                    $manufacturer_ids[] = $product['manufacturer_id'];
                }

                if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price'))
                {
                    $price = $product['price'];
                }

                if ((float)$product['special'])
                {
                    $price = $product['special'];
                }

                $product_price[] = $price;

                $product_options = $this->model_catalog_newproduct->getProductOptions($product['product_id']);

                foreach ($product_options as $key => $_opt)
                {
                    $options[$_opt['option_id']][$_opt['option_id']] = array(
                        'option_id'  =>  $_opt['option_id'],
                        'type'  =>  $_opt['type'],
                        'name'  =>  $_opt['name'],
                        'option_value'    => array()
                    );

                    foreach ($_opt['product_option_value'] as $optv)
                    {
                        $options[$_opt['option_id']]['option_value'][$optv['option_value_id']] = $optv;
                    }
                }
            }

            if (count($options))
            {
                foreach ($options as $option_id => $option)
                {
                    if ($option_id == $setting['display_as_color'])
                    {
                        $final_options_color[$option_id] = $option[$option_id];
                        $final_options_color[$option_id]['option_value'] = $option['option_value'];
                    }
                    else
                    {
                        $final_options[$option_id] = $option[$option_id];
                        $final_options[$option_id]['option_value'] = $option['option_value'];
                    }
                }
            }

            $final_range_price = array(
                'min'   =>  (int)min($product_price),
                'max'   =>  (int)max($product_price)
            );


            // Get all categories from products
            $categories = $this->model_catalog_newcategory->getCategoriesByProducts($product_ids);

            foreach ($categories as $category)
            {
                $final_categories[] = $this->model_catalog_newcategory->getCategory($category['category_id']);
            }

            // Get all brand from products
            $final_manufacturers = $this->model_catalog_newmanufacturer->getMultiManufacturers($manufacturer_ids);
        }

        $data['params'] = "";
        $data['selected_manufacturer_ids'] = $data['selected_category_ids'] = $data['selected_option_ids'] = $data['selected_prices_range'] = array();
        foreach ($this->request->get as $key => $get)
        {
            if (!in_array($key, array('manufacturer_ids', 'category_ids', 'option_ids', 'prices_range')))
            {
                $data['params'] .= $key."=".$get."&";
            }
            else if(in_array($key, array('manufacturer_ids', 'category_ids', 'option_ids', 'prices_range')))
            {
                $data['selected_'.$key] = explode(",", $get);
            }
        }

        $data['params'] = substr($data['params'], 0, -1);

        $data['setting'] = $setting;
        $data['categories'] = (count($final_categories)) ? $final_categories : false;
        $data['manufacturers'] = (count($final_manufacturers)) ? $final_manufacturers : false;
        $data['range_price'] = (count($final_range_price)) ? $final_range_price : false;
        $data['final_options'] = (count($final_options)) ? $final_options : false;
        $data['final_options_color'] = (count($final_options_color)) ? $final_options_color : false;

		$symbolLeft  = $this->currency->getSymbolLeft($this->currency->getCode());
		$symbolRight = $this->currency->getSymbolRight($this->currency->getCode());

		$data['currency_code'] = ($symbolLeft) ? $symbolLeft : $symbolRight;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/advanced_filter.tpl'))
		{
			return $this->load->view($this->config->get('config_template') . '/template/module/advanced_filter.tpl', $data);
		}
		else
		{
			return $this->load->view('default/template/module/advanced_filter.tpl', $data);
		}
	}
}