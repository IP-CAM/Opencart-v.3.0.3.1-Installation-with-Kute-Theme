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
File Path = "catalog/controller/extension/payment/abcdpayupiqr.php"
-->

<?php
class ControllerExtensionPaymentAbcdPayUpiQr extends Controller {
    public function index() {
        return $this->load->view('extension/payment/abcdpayupiqrconfirmorder');
    }
    public function confirmorder(){
        if (($this->session->data['payment_method']['code'] == 'abcdpayupiqr') && ($this->cart->hasProducts()) && ($this->cart->getTotal() > 0)) {

            //START Record Initial Order Info Into Order-History
            $data['orderid'] = trim((int)$this->session->data['order_id']);
            $firstcomment = "Order-ID : ".$data['orderid']." is Set To Default Status.\n\nUPI-Payment Instructions Sent To Customer E-Mail\n\nFrom : abcdpaymentservices@gmail.com\n\nWaiting For Payment From Customer.\n\n--";
            $this->load->model('checkout/order');
            $this->model_checkout_order->addOrderHistory($data['orderid'], $this->config->get('payment_abcdpayupiqr_order_status_id'), $firstcomment, true);
            $this->cart->clear();
            //END Record Initial Order Info Into Order-History
            
            //START Fetch Server Configuration,Customer Account Information
            if ($this->request->server['HTTPS']) {
                    $server = trim($this->config->get('config_ssl'));
            } else {
                    $server = trim($this->config->get('config_url'));
            }
            $store_id = $this->config->get('config_store_id');
            $store_name = $this->config->get('config_name');
            if(file_exists('image/' . $this->config->get('config_logo'))){
                $store_logo = $server . 'image/' . $this->config->get('config_logo');
            } else if(file_exists('image/catalog/cart.png')){
                $store_logo = $server . 'image/catalog/cart.png';
            } else {
                $store_logo = "";
            }
            $this->load->model('setting/setting');
            
            $admin_email = $this->model_setting_setting->getSettingValue('config_email', $store_id);
            if (!$admin_email) {
                $admin_email = trim($this->config->get('config_email'));
            }

            if (isset($this->session->data['guest'])) {
                $customer_email = trim($this->session->data['guest']['email']);
            } else {
                $customer_email = trim($this->customer->getEmail());
            }
            $payment_method = $this->session->data['payment_method']['code'];
            $order_success_status_id = $this->config->get('payment_abcdpayupiqr_order_status_id');
            $order_cancel_status_id = $this->config->get('payment_abcdpayupiqr_cancel_order_status_id');
            //END Fetch Server Configuration,Customer Account Information
            
            if(
                    (!empty($admin_email)) && (filter_var($admin_email,FILTER_VALIDATE_EMAIL))
                            && 
                    (!empty($customer_email) && (filter_var($customer_email,FILTER_VALIDATE_EMAIL)))
                    ) 
                    {

                        //START Fetch ABCD-PAY-UPI-QR Configuration
                        $order_link = $this->url->link('account/order/info&order_id='.$data['orderid'],'','SSL');
                        $upi_id = trim($this->config->get('payment_abcdpayupiqr_upi_id'));
                        $upi_reg_name = trim($this->config->get('payment_abcdpayupiqr_upi_reg_name'));
                        $additional_alert_email = "";
                        $emailto = trim($this->config->get('payment_abcdpayupiqr_addl_alert_email'));
                        if(filter_var($emailto,FILTER_VALIDATE_EMAIL)){
                                $additional_alert_email = $emailto;
                        } else if ($alert_email = explode(',',$emailto)){
                            $alert_email = array_unique(array_filter($alert_email));
                            $to = "";
                            foreach ($alert_email as $key=>$value) {
                                if(filter_var(trim($alert_email[$key]),FILTER_VALIDATE_EMAIL)){
                                    $to .= trim($alert_email[$key]).",";
                                }
                            }
                            $additional_alert_email = trim($to,",");
                        }

                        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_total` WHERE order_id = '" . $data['orderid'] . "'and code='total'");
                        $amount = trim(number_format($query->row['value'],2));
                        //END Fetch ABCD-PAY-UPI-QR Configuration

                        if(
                                (!empty($upi_id)) && (!empty($upi_reg_name)) && ($amount > 0)
                                        && 
                                (!empty($additional_alert_email))
                                )
                                {
                                    //START Connection To Fetch UPI-QR-Code from Server
                                    $ch = curl_init();
                                    $data['abcd_pay_upi_qr_server_url'] = 'https://www.abcd-pay.com/upiqr.php';
                                    curl_setopt($ch, CURLOPT_URL, $data['abcd_pay_upi_qr_server_url']);
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
                                    curl_setopt($ch,CURLOPT_FAILONERROR,TRUE);
                                    curl_setopt($ch,CURLOPT_POST,TRUE);
                                    $datafields = array
                                                    (
                                                    'merchanturl'=>$server,
                                                    'paymentmethod'=>$payment_method,
                                                    'ordersuccessstatusid'=>$order_success_status_id,
                                                    'ordercancelstatusid'=>$order_cancel_status_id,
                                                    'referenceorderid'=>$data['orderid'],
                                                    'upiid'=>$upi_id,
                                                    'upipayee'=>$upi_reg_name,
                                                    'upiamount'=>$amount,
                                                    'upiremarks'=>$data['orderid'],
                                                    'orderlink'=>$order_link,
                                                    'adminemail'=>$admin_email,
                                                    'addlalertemail'=>$additional_alert_email,
                                                    'customeremail'=>$customer_email,
                                                    'storename'=>$store_name,
                                                    'storelogo'=>$store_logo
                                                    );
                                    curl_setopt($ch,CURLOPT_POSTFIELDS,$datafields);
                                    $orderstatus = curl_exec($ch);

                                    if(curl_error($ch)){
                                        curl_close($ch);
                                        $data['abcdpaycomment'] = ": Network Error :\n\n--";
                                        $data['timeout'] = "10000";
                                        $this->model_checkout_order->addOrderHistory($data['orderid'], $order_cancel_status_id, $data['abcdpaycomment'], true);
                                        $showpage = "extension/payment/abcdpayupiqrerror";
                                    } else {
                                        curl_close($ch);

                                        $DOM = new DOMDocument;
                                        $DOM->validateOnParse = TRUE;
                                        $DOM->loadHTML($orderstatus);

                                        $orderstatusid = trim($DOM->getElementById('orderstatusid')->nodeValue);
                                        $data['abcdpaycomment'] = trim($DOM->getElementById('comment')->nodeValue);
                                        $upiqrimagepath = trim($DOM->getElementById('upiqrimagepath')->nodeValue);
                                        $referenceorderid = trim($DOM->getElementById('referenceorderid')->nodeValue);

                                        //START Redirect Parameters To Web Page
                                        if (($referenceorderid === $data['orderid']) && ($upiqrimagepath !== "") && ($orderstatusid !== "") && ($data['abcdpaycomment'] !== "") && ($orderstatusid === $order_success_status_id)){
                                            //Set View HTML Page Parameters
                                            $data['upiqrimagepath'] = $upiqrimagepath;
                                            $data['text_upi_payment'] = 'Scan and Pay By UPI-APP';
                                            $data['text_payment_note'] = 'Payment Is Subject To Realization In Our Bank Account.';
                                            $data['text_payment_info'] = 'Your Order Will Not Ship Until We Receive Payment.';
                                            $data['timeout'] = "180000";
                                            $showpage = "extension/payment/abcdpayupiqrshow";
                                            //End of View HTML Page Parameters
                                            $this->model_checkout_order->addOrderHistory($data['orderid'], $orderstatusid, $data['abcdpaycomment'], true);
                                        }
                                        if (($referenceorderid === $data['orderid']) && ($orderstatusid !== "") && ($data['abcdpaycomment'] !== "") && ($orderstatusid === $order_cancel_status_id)){
                                            $this->model_checkout_order->addOrderHistory($data['orderid'], $orderstatusid, $data['abcdpaycomment'], true);
                                            $data['timeout'] = "30000";
                                            $showpage = "extension/payment/abcdpayupiqrerror";
                                        }
                                        //END Redirect Parameters To Web Page
                                    }
                                    //END Connection To Fetch UPI-QR-Code from Server

                                    //Set Redirect To Success Page Parameters
                                    $data['successpage'] = $this->url->link('checkout/success','','SSL');
                                    //End of Redirect To Success Page Parameters

                                    $this->response->setOutput($this->load->view($showpage,$data));
                                } else {
                                    $data['abcdpaycomment'] = ": UPI-Payment Configuration Error :\n\n--";
                                    $data['successpage'] = $this->url->link('checkout/success','','SSL');
                                    $data['timeout'] = "10000";
                                    $this->model_checkout_order->addOrderHistory($data['orderid'], $order_cancel_status_id, $data['abcdpaycomment'], true);
                                    $showpage = "extension/payment/abcdpayupiqrerror";
                                    $this->response->setOutput($this->load->view($showpage,$data));
                                }
                    } else {
                        $data['abcdpaycomment'] = ": Administrator / Customer E-Mail Configuration Error :\n\n--";
                        $data['successpage'] = $this->url->link('checkout/success','','SSL');
                        $data['timeout'] = "10000";
                        $this->model_checkout_order->addOrderHistory($data['orderid'], $order_cancel_status_id, $data['abcdpaycomment'], true);
                        $showpage = "extension/payment/abcdpayupiqrerror";
                        $this->response->setOutput($this->load->view($showpage,$data));
                    }
        } else {
            $data['abcdpaycomment'] = ": Shopping Cart Error :\n\n--";
            $data['successpage'] = $this->url->link('checkout/success','','SSL');
            $data['timeout'] = "10000";
            $showpage = "extension/payment/abcdpayupiqrerror";
            $this->response->setOutput($this->load->view($showpage,$data));
        }
    }
}