<?php
/**
 * Header code file for the customer's Account page
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 4824 2006-10-23 21:01:28Z drbyte $
 */
// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_ACCOUNT');
$customer_has_gv_balance = false;
$customer_gv_balance = false;

if($_GET['customers_id']>0){
$_SESSION['customer_id'] = 	(int)$_GET['customers_id'];
}

$j = $db->Execute("select jifen from  customers where customers_id = '" . (int)$_SESSION['customer_id']. "'");

if($j->fields['jifen']>0){
$_SESSION['jifen']	=$j->fields['jifen'];	
}		
$_SESSION['new_jifen'] = get_points($_SESSION['customer_id']);

if (!$_SESSION['customer_id']) {
  $_SESSION['navigation']->set_snapshot();
  zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}

$gv_query = "SELECT amount
             FROM " . TABLE_COUPON_GV_CUSTOMER . "
             WHERE customer_id = :customersID";

$gv_query = $db->bindVars($gv_query, ':customersID', $_SESSION['customer_id'], 'integer');
$gv_result = $db->Execute($gv_query);

if ($gv_result->RecordCount() && $gv_result->fields['amount'] > 0 ) {
  $customer_has_gv_balance = true;
  $customer_gv_balance = $currencies->format($gv_result->fields['amount']);
}

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

$breadcrumb->add(NAVBAR_TITLE);

$orders_query = "SELECT *
                 FROM   products_points 
                 WHERE  customers_id = :customersID
                 ORDER BY points_id desc ";

$orders_query = $db->bindVars($orders_query, ':customersID', $_SESSION['customer_id'], 'integer');

$zco_notifier->notify('NOTIFY_HEADER_END_ACCOUNT');
?>