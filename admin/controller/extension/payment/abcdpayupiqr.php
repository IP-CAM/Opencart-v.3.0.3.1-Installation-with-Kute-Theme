<!--
[UPI-Payment] is a Payment Module to Integrate
UPI - [ Unified Payments Interface ] A Service From NPCI - [ National Payments Corporation Of India ]
as a Payment Gateway Method in OPENCART - 3.0.2.0 - 3.0.3.0 - 3.0.3.1

Developed By:
Mr. TARAKESHWAR GAJAM
ABCD PAYMENT SERVICES, #4-1-71/416, Sai Durga Gardens, Nacharam Main Road, Medchal-Malkajgiri District, Telangana State - 500076, India.
URL: https://www.abcd-pay.com , E-Mail : admin@abcd-pay.com, Mobile : 0091-0-8106877688.
-->

<!--
File Path = "admin/controller/extension/payment/abcdpayupiqr.php"
Developer Logo Image Path = "admin/view/image/payment/abcdpayupiqr.png"
NPCI-UPI Logo Image Path = "admin/view/image/payment/upi-logo.png"
-->

<?php
class ControllerExtensionPaymentAbcdPayUpiQr extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('extension/payment/abcdpayupiqr');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('setting/setting');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_setting_setting->editSetting('payment_abcdpayupiqr', $this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$this->response->redirect($this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true));
		}

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['upi_id'])) {
			$data['error_upi_id'] = $this->error['upi_id'];
		} else {
			$data['error_upi_id'] = '';
		}
                
                if (isset($this->error['upi_reg_name'])) {
			$data['error_upi_reg_name'] = $this->error['upi_reg_name'];
		} else {
			$data['error_upi_reg_name'] = '';
		}

                if (isset($this->error['addl_alert_email'])) {
			$data['error_addl_alert_email'] = $this->error['addl_alert_email'];
		} else {
			$data['error_addl_alert_email'] = '';
		}

		if (isset($this->error['upi_total'])) {
			$data['error_upi_total'] = $this->error['upi_total'];
		} else {
			$data['error_upi_total'] = '';
		}

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('extension/payment/abcdpayupiqr', 'user_token=' . $this->session->data['user_token'], true)
		);

		$data['action'] = $this->url->link('extension/payment/abcdpayupiqr', 'user_token=' . $this->session->data['user_token'], true);

		$data['cancel'] = $this->url->link('marketplace/extension', 'user_token=' . $this->session->data['user_token'] . '&type=payment', true);

		if (isset($this->request->post['payment_abcdpayupiqr_upi_id'])) {
			$data['payment_abcdpayupiqr_upi_id'] = $this->request->post['payment_abcdpayupiqr_upi_id'];
		} else {
			$data['payment_abcdpayupiqr_upi_id'] = $this->config->get('payment_abcdpayupiqr_upi_id');
		}

                if (isset($this->request->post['payment_abcdpayupiqr_upi_reg_name'])) {
			$data['payment_abcdpayupiqr_upi_reg_name'] = $this->request->post['payment_abcdpayupiqr_upi_reg_name'];
		} else {
			$data['payment_abcdpayupiqr_upi_reg_name'] = $this->config->get('payment_abcdpayupiqr_upi_reg_name');
		}

                if (isset($this->request->post['payment_abcdpayupiqr_addl_alert_email'])) {
			$data['payment_abcdpayupiqr_addl_alert_email'] = $this->request->post['payment_abcdpayupiqr_addl_alert_email'];
		} else {
			$data['payment_abcdpayupiqr_addl_alert_email'] = $this->config->get('payment_abcdpayupiqr_addl_alert_email');
		}
                
		if (isset($this->request->post['payment_abcdpayupiqr_total'])) {
			$data['payment_abcdpayupiqr_total'] = $this->request->post['payment_abcdpayupiqr_total'];
		} else {
			$data['payment_abcdpayupiqr_total'] = $this->config->get('payment_abcdpayupiqr_total');
		}

		if (isset($this->request->post['payment_abcdpayupiqr_order_status_id'])) {
			$data['payment_abcdpayupiqr_order_status_id'] = $this->request->post['payment_abcdpayupiqr_order_status_id'];
		} else {
			$data['payment_abcdpayupiqr_order_status_id'] = $this->config->get('payment_abcdpayupiqr_order_status_id');
		}

		$this->load->model('localisation/order_status');

		$data['order_statuses'] = $this->model_localisation_order_status->getOrderStatuses();

		if (isset($this->request->post['payment_abcdpayupiqr_geo_zone_id'])) {
			$data['payment_abcdpayupiqr_geo_zone_id'] = $this->request->post['payment_abcdpayupiqr_geo_zone_id'];
		} else {
			$data['payment_abcdpayupiqr_geo_zone_id'] = $this->config->get('payment_abcdpayupiqr_geo_zone_id');
		}

		$this->load->model('localisation/geo_zone');

		$data['geo_zones'] = $this->model_localisation_geo_zone->getGeoZones();

		if (isset($this->request->post['payment_abcdpayupiqr_status'])) {
			$data['payment_abcdpayupiqr_status'] = $this->request->post['payment_abcdpayupiqr_status'];
		} else {
			$data['payment_abcdpayupiqr_status'] = $this->config->get('payment_abcdpayupiqr_status');
		}

		if (isset($this->request->post['payment_abcdpayupiqr_sort_order'])) {
			$data['payment_abcdpayupiqr_sort_order'] = $this->request->post['payment_abcdpayupiqr_sort_order'];
		} else {
			$data['payment_abcdpayupiqr_sort_order'] = $this->config->get('payment_abcdpayupiqr_sort_order');
		}
                
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/payment/abcdpayupiqr', $data));
	}

	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/payment/abcdpayupiqr')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		if (!$this->request->post['payment_abcdpayupiqr_upi_id']) {
			$this->error['upi_id'] = $this->language->get('error_upi_id');
		}
                
		if (!$this->request->post['payment_abcdpayupiqr_upi_reg_name']) {
			$this->error['upi_reg_name'] = $this->language->get('error_upi_reg_name');
		}

                if (!$this->request->post['payment_abcdpayupiqr_addl_alert_email']) {
			$this->error['addl_alert_email'] = $this->language->get('error_addl_alert_email');
		}

		if (!$this->request->post['payment_abcdpayupiqr_total']) {
			$this->error['upi_total'] = $this->language->get('error_upi_total');
		}
                
		return !$this->error;
	}
}