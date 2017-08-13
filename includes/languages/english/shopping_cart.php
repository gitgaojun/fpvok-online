<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: shopping_cart.php 3183 2006-03-14 07:58:59Z birdbrain $
 */

define('NAVBAR_TITLE', 'The Shopping Cart');
define('HEADING_TITLE', 'Your Shopping Cart Contents');
define('HEADING_TITLE_EMPTY', 'Your Shopping Cart');
define('TEXT_INFORMATION', '<p><b><font color="#800000">Notice:</font></b></p><p>1. <img border="0" src="/images/btn_xpressCheckout-x.gif" width="72" height="19">This payment method is PayPal Express, you may purchase products without sign up here. And a cheapest shipping way rate will be automatically selected by Paypal Express.</p><p>2. <img border="0" src="/images/btn_cheakout-x.gif" width="91" height="19">This payment method is Standard Checkout, you may choose PayPal, Western Union and T/T as payment by click it and shipping methods such as Free Shipping, HK-Airmail(only suitable for order<2kg), Standard Way or Expedited Way Shipping Method are available.</p>');
define('TABLE_HEADING_REMOVE', 'Remove');
  define('TABLE_HEADING_ITEM_NAME', 'Image: ');
  define('TABLE_HEADING_PRODUCTS_NAME', 'Product Name:  ');
  
  define('TABLE_HEADING_PRICE', 'Unit Price: ');
  define('TABLE_HEADING_DELETE', '&nbsp;&nbsp;Operation: ');
//define('TABLE_HEADING_QUANTITY', 'Qty.');
define('TABLE_HEADING_MODEL', 'Model');
define('TABLE_HEADING_PRICE','Unit');
define('TEXT_CART_EMPTY', 'Your Shopping Cart is empty.');
define('SUB_TITLE_SUB_TOTAL', 'Sub-Total:');
define('SUB_TITLE_TOTAL', 'Total:');

define('OUT_OF_STOCK_CANT_CHECKOUT', 'Products marked with ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' are out of stock or there are not enough in stock to fill your order.<br />Please change the quantity of products marked with (' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '). Thank you');
define('OUT_OF_STOCK_CAN_CHECKOUT', 'Products marked with ' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ' are out of stock.<br />Items not in stock will be placed on backorder.');

define('TEXT_TOTAL_ITEMS', 'Total Items: ');
define('TEXT_TOTAL_WEIGHT', '&nbsp;&nbsp;Weight: ');
define('TEXT_TOTAL_AMOUNT', 'Total Price: ');

define('TEXT_VISITORS_CART', '<a href="javascript:session_win();">[help (?)]</a>');
define('TEXT_OPTION_DIVIDER', '&nbsp;-&nbsp;');

define('TEXT_ESTIMATOR_HEADING_ITEMS','Total Items: ');
define('TEXT_ESTIMATOR_HEADING_WEIGHT','Weight: ');
define('TEXT_ESTIMATOR_HEADING_COST','Item cost: ');
?>