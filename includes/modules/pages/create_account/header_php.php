<?php
/**
 * create_account header_php.php
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 4035 2006-07-28 05:49:06Z drbyte $
 */
// Check if email exists
if (isset ( $_GET ['ajax'] ) && ($_GET ['ajax'] == 'true')) {
	$email_address = zen_db_prepare_input($_GET['email_address']);
	$check_customer_query = "SELECT customers_email_address
                           FROM " . TABLE_CUSTOMERS . "
                           WHERE customers_email_address = :emailAddress";
	
	$check_customer_query = $db->bindVars ( $check_customer_query, ':emailAddress', $email_address, 'string' );
	$check_customer = $db->Execute ( $check_customer_query );
	
	if ( $check_customer->RecordCount ()&&$email_address!='') {
		echo "Sorry,the email is exists!You can login with this email!";		
	}
	else
	{
		echo"__none__";
	}
	exit;
}
// This should be first line of the script:
$zco_notifier->notify ( 'NOTIFY_HEADER_START_CREATE_ACCOUNT' );

require (DIR_WS_MODULES . zen_get_module_directory ( 'require_languages.php' ));
require (DIR_WS_MODULES . zen_get_module_directory ( FILENAME_CREATE_ACCOUNT ));

$breadcrumb->add ( NAVBAR_TITLE );

// This should be last line of the script:
$zco_notifier->notify ( 'NOTIFY_HEADER_END_CREATE_ACCOUNT' );
?>