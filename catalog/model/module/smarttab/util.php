<?php
/**
 * Created by ANH To <anh.to87@gmail.com>.
 * User: baoan
 * Date: 10/6/15
 * Time: 15:33
 */

class ModelModuleSmarttabUtil extends Model
{
    public function genArrayProducts($products, $setting = array())
    {
        $this->load->model('tool/image');
        $this->load->model('catalog/newproduct');
        $dataProducts = array();

        if(!is_array($products)) return array();
        if(!count($products)) return array();
        foreach ($products as $product) {
            $newproduct_info = $this->model_catalog_newproduct->getProduct($product['product_id']);

            $result = array_merge($newproduct_info, $product);
            # Check if product just added in today
            $is_new = false;
            $data_added = date('Y-m-d', strtotime($result['date_added']));
            # Get now
            $now = date('Y-m-d');

            if ($data_added == $now)
            {
                $is_new = true;
            }

            if ($result['image']) {
                $image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
            } else {
                $image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
            }
            $result['special'] = floatval(preg_replace('/[^\d\.]/', '', $result['special']));
            $result['price'] = floatval(preg_replace('/[^\d\.]/', '', $result['price']));

            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $price = false;
            }

            $special_percent = false;
            if ($result['special']) {
                $result['special'] = floatval(preg_replace('/[^\d\.]/', '', $result['special']));

                $special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
                if($price){
                    $special_percent = 100 - round($result['special'] * 100 / $result['price']);
                    //$special_percent =  round(($result['price'] / 100) * (100 - $result['special'] * 100 / $result['price']));
                }
            } else {
                $special = false;
            }

            if ($this->config->get('config_tax')) {
                $tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
            } else {
                $tax = false;
            }

            if ($this->config->get('config_review_status')) {
                $rating = $result['rating'];
            } else {
                $rating = false;
            }

            $dataProducts[] = array(
                'product_id'      => $result['product_id'],
                'thumb'           => $image,
                'name'            => $result['name'],
                'description'     => utf8_substr(
                        strip_tags(
                            html_entity_decode(
                                $result['description'], ENT_QUOTES, 'UTF-8'
                            )
                        ), 0,
                        $this->config->get('config_product_description_length')
                    ) . '..',
                'price'           => $price,
                'special'         => $special,
                'special_percent' => $special_percent,
                'tax'             => $tax,
                'rating'          => $rating,
                'is_new'          => $is_new,
                'date_end'        => (isset($result['date_end']))
                    ? $result['date_end'] : '',
                'date_end_array'        => (isset($result['date_end']))
                    ? explode("/", $result['date_end']) : '',
                'href'            => $this->url->link(
                    'product/product', 'product_id=' . $result['product_id']
                )
            );
        }

        return $dataProducts;
    }

    public function genHashTabid($data, $custom, $length = 8)
    {
        $encrypt = md5(base64_encode(json_encode($data)).microtime().$custom);
        $encrypt = substr($encrypt, 0, $length);

        return $encrypt;
    }

    public function genKeyCache($string)
    {
        return md5(base64_encode($string));
    }
}