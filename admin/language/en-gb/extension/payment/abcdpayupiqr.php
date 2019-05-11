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
File Path = "admin/language/en-gb/extension/payment/abcdpayupiqr.php"
Developer Logo Image Path = "admin/view/image/payment/abcdpayupiqr.png"
NPCI-UPI Logo Image Path = "admin/view/image/payment/upi-logo.png"
-->

<?php
// Heading
$_['heading_title']      = 'UPI-Payment';

// Text Logo // Uncomment Required Logo Line and Comment Other Logo Line
//$_['text_abcdpayupiqr'] = '<a href="https://www.npci.org.in/" target="_blank"><img src="view/image/payment/upi-logo.png" alt="UPI" title="UPI" style="border: 1px solid #EEEEEE;" /></a>';
$_['text_abcdpayupiqr'] = '<a href="https://www.abcd-pay.com" target="_blank"><img src="view/image/payment/abcdpayupiqr.png" alt="abcd-pay.com" title="abcd-pay.com" style="border: 1px solid #EEEEEE;" /></a>';

// Text
$_['text_extension']     = 'Extensions';
$_['text_success']       = 'Success: You have modified UPI-Payment account details!';
$_['text_edit']          = 'Edit UPI-Payment';

// Entry
$_['entry_upi_id']      = 'Merchant-UPI-ID';
$_['entry_upi_reg_name'] = 'UPI-Registered-Name';
$_['entry_total']        = 'Total';
$_['entry_order_status'] = 'Confirm Order Status';
$_['cancel_order_status'] = 'Cancel Order Status';
$_['entry_geo_zone']     = 'Geo Zone';
$_['entry_status']       = 'Status';
$_['entry_sort_order']   = 'Sort Order';
$_['entry_addl_alert_email']   = 'E-Mail / S';

// Help
$_['help_total']         = 'The checkout total the order must reach before this payment method becomes active.';
$_['help_addl_alert_email'] = 'E-Mail OR E-Mails Seperated By Comma [,]';

// Error
$_['error_permission']   = 'Warning: You do not have permission to modify payment UPI-Payment!';
$_['error_upi_id']      = 'Merchant-UPI-ID Required!';
$_['error_upi_reg_name'] = 'UPI-Registered-Name Required!';
$_['error_upi_total'] = 'Minimum Checkout Total Required!';
$_['error_addl_alert_email'] = 'E-Mail OR E-Mails Seperated By Comma [,] Required!';