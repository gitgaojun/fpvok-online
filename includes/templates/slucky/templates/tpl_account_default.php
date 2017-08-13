<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account.<br />
 * Displays previous orders and options to change various Customer Account settings
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_default.php 4086 2006-08-07 02:06:18Z ajeh $
 */
?>
<div class="minframe fl">

<div class="bg_box_gray margin_t clear">
<div class="BoxBar">My Account</div>
	<div class="pad_14px pad_t allborder no_border_t">
	<ul class="red_arrow_list">
	<li><a class="red b" href="<?php echo zen_href_link(FILENAME_ACCOUNT,'','SSL');?>">My Orders</a></li>
	<li><a href="/reviews.html">My Reviews</a></li>
	<li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT_EDIT,'','SSL');?>">My Profile</a></li>
	<li><a href="<?php echo zen_href_link(FILENAME_MANAGER_ADDRESS,'','SSL');?>">My Address</a></li>
	<li><a href="/index.php?main_page=un_wishlist">My Wishlist</a></li>
	</ul>
	</div>
</div>

<div class="bg_box_gray margin_t clear">
	<div class="BoxBar">Need help</div>
		<span class="pad_14px pad_t block allborder no_border_t">If you have questions or need help with your account, you may <a class="u" href="/faq_info.html?faqs_id=150&fcPath=21">contact us</a> to assist you.	</span>
</div>
</div>
<div class="right_big_con margin_t line_30px">
<h2><?php echo HEADING_TITLE; ?></h2>
<?php if ($messageStack->size('account') > 0) echo $messageStack->output('account'); ?>
<h4 class="border_b in_1em"><?php echo OVERVIEW_PREVIOUS_ORDERS; ?></h4>
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="prevOrders" class="table_orders margin_t">
<tr >
    <th class="cartbar_bg" width="150"  style="border-left:1px solid #EEEEEE;"><?php echo TABLE_HEADING_ORDER_NUMBER; ?></th>
    <th class="cartbar_bg" width="150"><?php echo TABLE_HEADING_DATE; ?></th>
    <th class="cartbar_bg" width="205"><?php echo TABLE_HEADING_SHIPPED_TO; ?></th>
    <th class="cartbar_bg" width="150"><?php echo TABLE_HEADING_STATUS; ?></th>
    <th class="cartbar_bg" width="100"><?php echo TABLE_HEADING_TOTAL; ?></th>
    <th></th>
  </tr>
<?php
$orders_split = new splitPageResults($orders_query, MAX_DISPLAY_PRODUCTS_LISTING, 'o.order_no', 'page');
$zco_notifier->notify('NOTIFY_MODULE_PRODUCT_LISTING_RESULTCOUNT', $listing_split->number_of_rows);
$orders = $db->Execute($orders_split->sql_query);
if ($orders->RecordCount() > 0) {
	while(!$orders->EOF){
	  if (zen_not_null($orders->fields['delivery_name'])) {
    $order_name = $orders->fields['delivery_name'];
    $order_country = $orders->fields['delivery_country'];
	  } else {
	  $order_name = $orders->fields['billing_name'];
	  $order_country = $orders->fields['billing_country'];
	  }
?>
  <tr>
    <td style=" border-left:1px solid #EEEEEE;"><?php echo '<a style=" color:red;" href="' . zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $orders->fields['orders_id'], 'SSL') . '"> ' . TEXT_NUMBER_SYMBOL . zen_get_order_no($orders->fields['orders_id']). '</a>'; ?></td>
    <td><?php echo zen_date_short($orders->fields['date_purchased']); ?></td>
    <td style=" padding-left:34px;"><?php echo zen_output_string_protected($order_name) . '<br />' . $order_country; ?></td>
    <td style=" padding-left:34px;"><?php echo $orders->fields['orders_status_name']; ?></td>
    <td class="red" style="padding-left:34px;"><?php echo $orders->fields['order_total']; ?></td>
    <td style="padding:0px 5px;">
	<?php 
if($orders->fields['payment_module_code']=='paypal' && $orders->fields['orders_status_name']=='Pending'){ 
echo '<a class="blue b u" href="index.php?main_page=account&paypal_id='.$orders->fields['orders_id'].'">Paypal</a>';	
}
?>
    </td>
  </tr>
<?php
  $orders->MoveNext();
  }
} 
?>
</table>
<div class="clear"></div>
<?php if ( ($orders_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
<div class="margin_t g_t_c allborder"><?php echo TEXT_RESULT_PAGE . ' ' . $orders_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></div>
<?php
  }
?>

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
<div class="clear" ></div>
</div>
<?php require(DIR_WS_MODULES.zen_get_module_directory('sideboxes/recommendations.php')); ?>