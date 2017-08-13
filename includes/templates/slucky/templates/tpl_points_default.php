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
<?php
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/box_contact_us.php'));
?>
<div class="bg_box_gray margin_t allborder clear">
<h3 class="in_1em line_30px">My Account</h3>
  <div class="pad_10px pad_t">
  <ul class="red_arrow_list">
  <li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT,'','SSL');?>">View Orders</a></li>
  <li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT_EDIT,'','SSL');?>">Account Settings</a></li>
  <li><a href="<?php echo zen_href_link(FILENAME_MANAGER_ADDRESS,'','SSL');?>">Manage Address Book</a></li>
  <li><a class="red b" href="<?php echo zen_href_link('points','','SSL');?>">Your Points</a></li>
  </ul>
  </div>
</div>
<?
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/account_order_search.php'));
?><div class="bg_box_gray margin_t clear">
	<h3 class="gray_box leftBoxBar">Need help</h3>
		<span class="pad_10px pad_t block allborder no_border_t">If you have questions or need help with your account, you may <a class="u" href="/faq_info.html?faqs_id=150&fcPath=21">contact us</a> to assist you.	</span>
</div>
</div>
<div class="right_big_con margin_t line_30px">
<h2>Your current points <?php echo $_SESSION['new_jifen'] ?> (100 points equals $<?php echo STORE_JIFEN*100 ?>usd). </h2>
<?php if ($messageStack->size('account') > 0) echo $messageStack->output('account'); ?>
<h4 class="border_b in_1em">Historical record</h4>

<table width="100%" border="0" cellpadding="0" cellspacing="0" id="prevOrders" class="table_orders margin_t">
<tr >
    <th class="cartbar_bg" width="50">ID</th>
    <th class="cartbar_bg" width="120"><?php echo TABLE_HEADING_DATE; ?></th>
    <th class="cartbar_bg" width="122">Income / expenditure</th>
    <th class="cartbar_bg" width="60">Amount</th>
    <th class="cartbar_bg" width="160">Remark</th>
  </tr>
<?php
$orders_split = new splitPageResults($orders_query, MAX_DISPLAY_PRODUCTS_LISTING, 'points_id', 'page');
$zco_notifier->notify('NOTIFY_MODULE_PRODUCT_LISTING_RESULTCOUNT', $listing_split->number_of_rows);
$orders = $db->Execute($orders_split->sql_query);
if ($orders->RecordCount() > 0) {
	while(!$orders->EOF){
		
if(time()-strtotime($orders->fields['points_date_added'])<	60*24*3600){
	
?>
  <tr>
    <td><?php echo $orders->fields['points_id'];  ?></td>
    <td><?php echo zen_date_short($orders->fields['points_date_added']); ?></td>
    <td><?php echo $orders->fields['points']  ?></td>
    <td><?php echo $orders->fields['amount']  ?></td>
    <td class="red"><?php 
			if(strstr($orders->fields['comments'],":")){
			$order_no = explode(":",$orders->fields['comments']);
			$sql="select orders_id from orders where order_no ='".trim($order_no[1])."'";
			$a = $db->Execute($sql);
			echo '<a class="blue u" href="index.php?main_page=account_history_info&order_id='.$a->fields['orders_id'].' ">'.$orders->fields['comments'].'</a>'; 
		}else{
			echo $orders->fields['comments'];
		}
		 ?></td>
  </tr>
 <?php }else{?> 
   <tr>
    <td><SPAN style="TEXT-DECORATION: line-through"><?php echo $orders->fields['points_id'];  ?></SPAN></td>
    <td><SPAN style="TEXT-DECORATION: line-through"><?php echo zen_date_short($orders->fields['points_date_added']); ?></SPAN></td>
    <td><SPAN style="TEXT-DECORATION: line-through"><?php echo $orders->fields['points']  ?></SPAN></td>
    <td><SPAN style="TEXT-DECORATION: line-through"><?php echo $orders->fields['amount']  ?></SPAN></td>
    <td class="red"><SPAN style="TEXT-DECORATION: line-through"><?php 
			if(strstr($orders->fields['comments'],":")){
			$order_no = explode(":",$orders->fields['comments']);
			$sql="select orders_id from orders where order_no ='".trim($order_no[1])."'";
			$a = $db->Execute($sql);
			echo '<a class="blue u" href="index.php?main_page=account_history_info&order_id='.$a->fields['orders_id'].' ">'.$orders->fields['comments'].'</a>'; 
		}else{
			echo $orders->fields['comments'];
		}
		 ?></SPAN></td>
  </tr> 
<?php
 }
  $orders->MoveNext();
  }
} 
?>
</table>
Please Notice: <br />
  a).The expired date of the point is 60 days.
  <br />
  b).You can use this point when you do the payment(100 point=1usd)
  <br />
  c).If you want to increase your point, you can do as below,
  <br />
  1.Purchase more products.if the total of your order is 1000usd,you can get 1000 point.<br />
  2.Write more review.You can get 3~5 points/review.<br />
  3.Uplode and share more related picture or Video.You can login and upload your favorite  picture and video when you write a review.
  If you have any other question,please contact our sales.<br />
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