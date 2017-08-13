<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_success.<br />
 * Displays confirmation details after order has been successfully processed.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_success_default.php 5407 2006-12-27 01:35:37Z drbyte $
 */
?>
<?php $order_total=$_SESSION['paypal_money']>0?$_SESSION['paypal_money']:$order_total;?>
<!-- Google Code for order success Conversion Page -->
<script type="text/javascript">
/* <![CDATA[ */
var google_conversion_id = 999999064;
var google_conversion_language = "en";
var google_conversion_format = "3";
var google_conversion_color = "ffffff";
var google_conversion_label = "QdxnCLij8AEQ2Izr3AM";
var google_conversion_value = 0;
if (<? echo $order_total; ?>) {
  google_conversion_value = <? echo $order_total; ?>;
}
/* ]]> */
</script>
<script type="text/javascript" src="http://www.googleadservices.com/pagead/conversion.js">
</script><noscript>
<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/999999064/?value=<? echo $order_total; ?>&amp;label=QdxnCLij8AEQ2Izr3AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<div style="display:inline;">
<img height="1" width="1" style="border-style:none;" alt="" src="http://www.googleadservices.com/pagead/conversion/999999064/?value=<?php echo $currencies->display_price($order_total,$order->Fields['order_tax'],1);?>&amp;label=QdxnCLij8AEQ2Izr3AM&amp;guid=ON&amp;script=0"/>
</div>
</noscript>

<div class="minframe fl">

<div class="bg_box_gray margin_t clear">
<div class="BoxBar">My Account</div>
	<div class="pad_14px pad_t allborder no_border_t">
	<ul class="red_arrow_list">
	<li><a class="red b" href="<?php echo zen_href_link(FILENAME_ACCOUNT,'','SSL'); ?>">My Orders</a></li>
	<li><a href="/reviews.html">My Reviews</a></li>
	<li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT_EDIT,'','SSL');?>">My Profile</a></li>
	<li><a href="<?php echo zen_href_link(FILENAME_MANAGER_ADDRESS,'','SSL');?>">My Address</a></li>
    <li><a href="/index.php?main_page=un_wishlist">My Wishlist</a></li>
	</ul>
	</div>
</div>

<div class="bg_box_gray margin_t clear">
	<div class="BoxBar">Need help</div>
		<span class="pad_10px pad_t block allborder no_border_t">If you have questions or need help with your account, you may <a class="u" href="/faq_info.html?faqs_id=150&fcPath=21">contact us</a> to assist you.	</span>
</div>
</div>

<div class="right_big_con">
  <ul id="projects">
    <li class="li1"><span>Your Shopping Cart</span></li>
    <li class="li2"><span>Account Login</span></li>
    <li class="li3"><span>Address Book</span></li>
    <li class="li4"><span>Billing, Shipping & Review</span></li> 
    <li class="current5"><span>Order Complete</span></li>
  </ul>
</div>

<div class="right_big_con">
<div class="success_box">
<div><?php echo TEXT_YOUR_ORDER_NUMBER . '<strong><a class="red" href="'. zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $zv_orders_id, 'SSL') . '" target="_blank"> '.zen_get_order_no($zv_orders_id).'</a></strong>'; ?>,Total: <b class="red"><?php echo $currencies->display_price($order_total,$order->Fields['order_tax'],1);?></b></div>
<div><?php echo TEXT_SEE_ORDERS;?></div>
<div><?php echo TEXT_CONTACT_STORE_OWNER;?></div>
</div>

<?php if (DEFINE_CHECKOUT_SUCCESS_STATUS >= 1 and DEFINE_CHECKOUT_SUCCESS_STATUS <= 2) { ?>

<?php } ?>

<!--bof -gift certificate- send or spend box-->
<?php
// only show when there is a GV balance
  if ($customer_has_gv_balance ) {
?>
<div id="sendSpendWrapper">
<?php require($template->get_template_dir('tpl_modules_send_or_spend.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_send_or_spend.php'); ?>
</div>
<?php
  }
?>
<!--eof -gift certificate- send or spend box-->



<!--bof -product notifications box-->
<?php
/**
 * The following creates a list of checkboxes for the customer to select if they wish to be included in product-notification
 * announcements related to products they've just purchased.
 **/
    if ($flag_show_products_notification == true) {
?>

<?php
    }
?>
<!--eof -product notifications box-->


<!--bof -product downloads module-->
<?php
  if (DOWNLOAD_ENABLED == 'true') require($template->get_template_dir('tpl_modules_downloads.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_downloads.php');
?>
<!--eof -product downloads module-->
<!--bof logoff-->

<!--eof logoff-->
<br class="clear" />
</div>
<?php  require(DIR_WS_MODULES.zen_get_module_directory('sideboxes/recently_viewed.php'));?>