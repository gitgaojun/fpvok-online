<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |   
// | http://www.zen-cart.com/index.php                                    |   
// |                                                                      |   
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: westernunion.php,v 1.1 2008-03-20 Jack $
//
  define('MODULE_PAYMENT_WESTERNUNION_TEXT_RECEIVER', 'Receiver ');
  define('MODULE_PAYMENT_WESTERNUNION_TEXT_SENDER', 'Sender ');
  define('MODULE_PAYMENT_WESTERNUNION_ENTRY_MCTN', 'MTCN : ');
  define('MODULE_PAYMENT_WESTERNUNION_ENTRY_AMOUNT', 'Amount : ');
  define('MODULE_PAYMENT_WESTERNUNION_ENTRY_CURRENCY', 'Currency : ');
  define('MODULE_PAYMENT_WESTERNUNION_ENTRY_FIRST_NAME', 'First Name : ');
  define('MODULE_PAYMENT_WESTERNUNION_ENTRY_LAST_NAME', 'Last Name : ');
  define('MODULE_PAYMENT_WESTERNUNION_ENTRY_ADDRESS', 'Address : ');
  define('MODULE_PAYMENT_WESTERNUNION_ENTRY_ZIP', 'Zip Code : ');
  define('MODULE_PAYMENT_WESTERNUNION_ENTRY_CITY', 'City : ');
  define('MODULE_PAYMENT_WESTERNUNION_ENTRY_COUNTRY', 'Country : ');
  define('MODULE_PAYMENT_WESTERNUNION_ENTRY_PHONE', 'Phone : ');
  define('MODULE_PAYMENT_WESTERNUNION_ENTRY_QUESTION', 'Question : ');
  define('MODULE_PAYMENT_WESTERNUNION_ENTRY_ANSWER', 'Answer : ');
  
  define('MODULE_PAYMENT_WESTERNUNION_RECEIVER_FIRST_NAME', 'First Name');
  define('MODULE_PAYMENT_WESTERNUNION_RECEIVER_LAST_NAME', 'Last Name');
  define('MODULE_PAYMENT_WESTERNUNION_RECEIVER_ADDRESS', 'Address');
  define('MODULE_PAYMENT_WESTERNUNION_RECEIVER_ZIP', 'Zip Code');
  define('MODULE_PAYMENT_WESTERNUNION_RECEIVER_CITY', 'City');
  define('MODULE_PAYMENT_WESTERNUNION_RECEIVER_COUNTRY', 'Country');
  define('MODULE_PAYMENT_WESTERNUNION_RECEIVER_PHONE', 'Phone');

  define('MODULE_PAYMENT_WESTERNUNION_RECEIVER_NOTICE', ' Please E-mail your <b>Order Number</b>, <b>Money Transfer Control Number (MTCN)</b>, <b>Amount</b>, Sender\'s <b>First</b> and <b>Last Name</b>, Sender\'s <b>Address</b> and <b>Country</b>, Sender\'s <b>Phone Number</b> to '.'<span class="red"> info@fpvok.com</span>'.' after you send payment by Western Union. Thanks!');
  
  define('MODULE_PAYMENT_WESTERNUNION_TEXT_CONFIG_1_1','Enable Western Union Order Module');
  define('MODULE_PAYMENT_WESTERNUNION_TEXT_CONFIG_1_2','Do you want to accept Western Union Order payments?');
  define('MODULE_PAYMENT_WESTERNUNION_TEXT_CONFIG_2_1','Sort order of display.');
  define('MODULE_PAYMENT_WESTERNUNION_TEXT_CONFIG_2_2','Sort order of display. Lowest is displayed first.'); 
  define('MODULE_PAYMENT_WESTERNUNION_TEXT_CONFIG_3_1','Set Order Status');
  define('MODULE_PAYMENT_WESTERNUNION_TEXT_CONFIG_3_2','Set the status of orders made with this payment module to this value');
  
  define('MODULE_PAYMENT_WESTERNUNION_TEXT_TITLE', 'Western Union Order');
  define('MODULE_PAYMENT_WESTERNUNION_TEXT_DESCRIPTION', 'Make Payable To:<br><br>' .  '<b>'. MODULE_PAYMENT_WESTERNUNION_ENTRY_FIRST_NAME .'</b>' . MODULE_PAYMENT_WESTERNUNION_RECEIVER_FIRST_NAME . '<br>' .  '<b>'.MODULE_PAYMENT_WESTERNUNION_ENTRY_LAST_NAME . '</b>' .   MODULE_PAYMENT_WESTERNUNION_RECEIVER_LAST_NAME . '<br>' .  '<b>'.MODULE_PAYMENT_WESTERNUNION_ENTRY_ADDRESS . '</b>' .MODULE_PAYMENT_WESTERNUNION_RECEIVER_ADDRESS . '<br>'  .   '<b>'. MODULE_PAYMENT_WESTERNUNION_ENTRY_ZIP . '</b>'.   MODULE_PAYMENT_WESTERNUNION_RECEIVER_ZIP . '<br>'  .   '<b>'. MODULE_PAYMENT_WESTERNUNION_ENTRY_CITY .   '</b>'.  MODULE_PAYMENT_WESTERNUNION_RECEIVER_CITY . '<br>'  .  '<b>'.  MODULE_PAYMENT_WESTERNUNION_ENTRY_COUNTRY . '</b>'.   MODULE_PAYMENT_WESTERNUNION_RECEIVER_COUNTRY . '<br>'  .   '<b>'.  MODULE_PAYMENT_WESTERNUNION_ENTRY_PHONE . '</b>'.   MODULE_PAYMENT_WESTERNUNION_RECEIVER_PHONE . '<br>' . '<font size=2 color="red"><b>After the payment, plese tell us your Firstname, Lastname, amount, currency and country.</b></font>');
  
  define('MODULE_PAYMENT_WESTERNUNION_TEXT_EMAIL_FOOTER', "Make Payable To:\n\n" . MODULE_PAYMENT_WESTERNUNION_ENTRY_FIRST_NAME . MODULE_PAYMENT_WESTERNUNION_RECEIVER_FIRST_NAME . " - " . MODULE_PAYMENT_WESTERNUNION_ENTRY_LAST_NAME . MODULE_PAYMENT_WESTERNUNION_RECEIVER_LAST_NAME . " - "  . MODULE_PAYMENT_WESTERNUNION_ENTRY_ADDRESS . MODULE_PAYMENT_WESTERNUNION_RECEIVER_ADDRESS . " - "  . MODULE_PAYMENT_WESTERNUNION_ENTRY_ZIP . MODULE_PAYMENT_WESTERNUNION_RECEIVER_ZIP . " - "  . MODULE_PAYMENT_WESTERNUNION_ENTRY_CITY . MODULE_PAYMENT_WESTERNUNION_RECEIVER_CITY . " - "  . MODULE_PAYMENT_WESTERNUNION_ENTRY_COUNTRY . MODULE_PAYMENT_WESTERNUNION_RECEIVER_COUNTRY . " - "  . MODULE_PAYMENT_WESTERNUNION_ENTRY_PHONE . MODULE_PAYMENT_WESTERNUNION_RECEIVER_PHONE . "\n\n" . '<b>Attention:</b>' . "\n\n" .  'After you make the payment, please send a notification email to this address: <b>sales@fpvok.com</b>. Contain the following information in email:' . "\n\n" .  '- First Name of Sender; - Last Name of Sender; - Money Transfer Control Number (MTCN);- The Exact Amount and Country' . "\n\n" .  'Your order will not be shipped until we receive the payment. When we confirmed the payment, we will notify you and start to process this order as soon as possible. ');

  define('MODULE_PAYMENT_WESTERNUNION_MARK_BUTTON_IMG', 'includes/templates/slucky/images/checkout/pic_3.jpg');
  define('MODULE_PAYMENT_WESTERNUNION_MARK_BUTTON_ALT', 'Checkout with Western Union');
  define('MODULE_PAYMENT_WESTERNUNION_ACCEPTANCE_MARK_TEXT', '(Pay By Western Union, What is <a href="http://www.westernunion.com" target="_blank" rel="nofollow">Western Union</a>?)');

  define('MODULE_PAYMENT_WESTERNUNION_TEXT_CATALOG_LOGO', '<img align="absmiddle" src="' . MODULE_PAYMENT_WESTERNUNION_MARK_BUTTON_IMG . '" alt="' . MODULE_PAYMENT_WESTERNUNION_MARK_BUTTON_ALT . '" title="' . MODULE_PAYMENT_WESTERNUNION_MARK_BUTTON_ALT . '" /> &nbsp;' .  MODULE_PAYMENT_WESTERNUNION_ACCEPTANCE_MARK_TEXT);

?>
