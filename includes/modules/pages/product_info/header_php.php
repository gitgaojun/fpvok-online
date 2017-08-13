<?php
/**
 * product_info header_php.php 
 *
 * @package page
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 6963 2007-09-08 02:36:34Z drbyte $
 */

  // This should be first line of the script:
  $zco_notifier->notify('NOTIFY_HEADER_START_PRODUCT_INFO');

  require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
  
  
  if (isset($_POST['action']) && $_POST['action'] =='ask_question'){
	  
	  function get_is_right($str,$id){
		global $messageStack;
			$err=true;
			if($id==1){
				if($_FILES[$str]['size']>204800){
				$messageStack->add_session('product_info', 'Images can not exceed the maximum size of 200K!', 'error');
				zen_redirect(zen_href_link(zen_get_info_page ( $_GET ['products_id'] ), 'products_id=' . $_GET ['products_id'] ) . '#review');
				$err=false;
				}
				if(strlen($_FILES[$str]['name'])>0){
					if(!strstr($_FILES[$str]['type'],"image")){
					$messageStack->add_session('product_info', 'Photo Please upload  jpeg, gif format!', 'error');
					
					$err=false;
					}
				}
			}
			if($_FILES[$str]['name']==''){
			$err=false;
			}
			return $err;
		}
		
	if($_SESSION['customer_id']>0){
 		require(DIR_WS_CLASSES . 'upload.php');
//==========================================================
		if(get_is_right('picture_1',1)){
		   if ($picture_1 = new upload('picture_1')) {
			  $picture_1->set_destination(DIR_WS_IMAGES . 'review/');
			  if ($picture_1->parse() && $picture_1->save()) {
				$picture_1_name = 'review/' .$picture_1->filename;
			  }
			}
		}
//22222222222222
		if(get_is_right('picture_2',1)){
		   if ($picture_2 = new upload('picture_2')) {
			  $picture_2->set_destination(DIR_WS_IMAGES . 'review/');
			  if ($picture_2->parse() && $picture_2->save()) {
				$picture_2_name = 'review/' .$picture_2->filename;
			  }
			}
		}
////////////////////				
		}
	  
  $reviews_text = $_POST['ask_content'];
  $customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id']:'';
  $customers_name = $_POST['customer_name'];
  $times = date("Y-m-d H:i:s",time());
  $customer_email = isset($_SESSION['customer_id']) ? zen_get_customer_email($_SESSION['customer_id']):$_POST['customer_email'];
  
  $sql = "INSERT INTO " . TABLE_ASK . " (products_id, customers_id, customers_name, customers_email,  date_added, status)
            VALUES (:productsID, :customersID, :customersName, :customersEmail, '" . $times . "', 0)";
		
		$sql = $db->bindVars($sql, ':productsID', $_GET['products_id'], 'integer');
		$sql = $db->bindVars($sql, ':customersID', $customer_id, 'integer');
		$sql = $db->bindVars($sql, ':customersName', $customers_name, 'string');
		$sql = $db->bindVars($sql, ':customersEmail', $customer_email, 'string');
		
		$db->Execute($sql);
		$insert_id = $db->insert_ID();
		$sql = "INSERT INTO " . TABLE_ASK_DESCRIPTION . " (reviews_id, languages_id, reviews_text)
            VALUES (:insertID, :languagesID, :reviewText)";
		
		$sql = $db->bindVars($sql, ':insertID', $insert_id, 'integer');
		$sql = $db->bindVars($sql, ':languagesID', $_SESSION['languages_id'], 'integer');
		$sql = $db->bindVars($sql, ':reviewText', $reviews_text, 'string');
		
		$str_name_aa =$picture_2->filename != ''?$picture_1_name.','.$picture_2_name:$picture_1_name;
		
		if ($picture_1->filename != '') {
		  
			$db->Execute("update " . TABLE_ASK . "
						  set reviews_pic = '" . $str_name_aa . "'
						  where reviews_id = '" . (int)$insert_id . "'");
		  }
		
		$db->Execute($sql);
			$messageStack->add('asked', TEXT_WRITE_REVIEW_SUCCESS, 'success');
  }
  
  
  
  if ($_POST['action']=='review'){
	  
	  function get_is_right($str,$id){
		global $messageStack;
			$err=true;
			if($id==1){
				if($_FILES[$str]['size']>204800){
				$messageStack->add_session('product_info', 'Images can not exceed the maximum size of 200K!', 'error');
				zen_redirect(zen_href_link(zen_get_info_page ( $_GET ['products_id'] ), 'products_id=' . $_GET ['products_id'] ) . '#review');
				$err=false;
				}
				if(strlen($_FILES[$str]['name'])>0){
					if(!strstr($_FILES[$str]['type'],"image")){
					$messageStack->add_session('product_info', 'Photo Please upload  jpeg, gif format!', 'error');
					
					$err=false;
					}
				}
			}
			if($_FILES[$str]['name']==''){
			$err=false;
			}
			return $err;
		}
	  
	if($_SESSION['customer_id']>0){
 		require(DIR_WS_CLASSES . 'upload.php');
//==========================================================
		if(get_is_right('picture_1',1)){
		   if ($picture_1 = new upload('picture_1')) {
			  $picture_1->set_destination(DIR_WS_IMAGES . 'review/');
			  if ($picture_1->parse() && $picture_1->save()) {
				$picture_1_name = 'review/' .$picture_1->filename;
			  }
			}
		}
//22222222222222
		if(get_is_right('picture_2',1)){
		   if ($picture_2 = new upload('picture_2')) {
			  $picture_2->set_destination(DIR_WS_IMAGES . 'review/');
			  if ($picture_2->parse() && $picture_2->save()) {
				$picture_2_name = 'review/' .$picture_2->filename;
			  }
			}
		}
////////////////////				
		}
	    
	  
    if (REVIEWS_APPROVAL == '1') {
      $review_status = '0';
    } else {
      $review_status = '1';
    }

  	$sql_data_array =array();
    $sql_data_array2 =array(); 	
  	$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id']:'';
  	$reviews_rating = $_POST['product_score'];
  	$customer_name = isset($_SESSION['customer_id']) ? zen_get_customer_name($_SESSION['customer_id']):$_POST['customer_name'];
  	$customer_email = isset($_SESSION['customer_id']) ? zen_get_customer_email($_SESSION['customer_id']):$_POST['customer_email'];
    $review_title = $_POST['review_title'];
    $review_content = $_POST['review_content'];
    $indentifying_code = $_POST['indentifying_code']; 
    $error = false;   
    if (strtolower($indentifying_code)!==strtolower($_SESSION['randCode']))
    {
       $error = true;
       $messageStack->add('reviews', 'The indentifying code is not correct.');
    }
	$review_admin = $_POST['review_admin'];
	$time1 = $_POST['time1'];$time2 = $_POST['time2'];$time3 = $_POST['time3'];
	$review_status = $_SESSION['admin_id2']>1?1:$review_status;
	if ($time1>0 && $time2>0 && $time3>0){
	$times=mktime(0,0,0,$time2,$time3,$time1);
	$times=date("Y-m-d H:i:s",$times);
	}else{
	$times=date("Y-m-d H:i:s",time());
	}
	if (!$error)
	{
		$sql = "INSERT INTO " . TABLE_REVIEWS . " (products_id, customers_id, customers_name, customers_email, reviews_rating, date_added, status)
            VALUES (:productsID, :customersID, :customersName, :customersEmail, :rating, '" . $times . "', " . $review_status . ")";
		
		$sql = $db->bindVars($sql, ':productsID', $_GET['products_id'], 'integer');
		$sql = $db->bindVars($sql, ':customersID', $customer_id, 'integer');
		$sql = $db->bindVars($sql, ':customersName', $customer_name, 'string');
		$sql = $db->bindVars($sql, ':customersEmail', $customer_email, 'string');
		$sql = $db->bindVars($sql, ':rating', $reviews_rating, 'string');
		
		$db->Execute($sql);
		$insert_id = $db->insert_ID();
		$sql = "INSERT INTO " . TABLE_REVIEWS_DESCRIPTION . " (reviews_id, languages_id, reviews_text, reviews_title,reviews_admin)
            VALUES (:insertID, :languagesID, :reviewText, :reviews_title,:reviews_admin)";
		
		$sql = $db->bindVars($sql, ':insertID', $insert_id, 'integer');
		$sql = $db->bindVars($sql, ':languagesID', $_SESSION['languages_id'], 'integer');
		$sql = $db->bindVars($sql, ':reviewText', $review_content, 'string');
		$sql = $db->bindVars($sql, ':reviews_title', $review_title, 'string');
		$sql = $db->bindVars($sql, ':reviews_admin', $review_admin, 'string');
		
		$db->Execute($sql);
		
		$str_name_aa =$picture_2->filename != ''?$picture_1_name.','.$picture_2_name:$picture_1_name;
		
		if ($picture_1->filename != '') {
		  
			$db->Execute("update " . TABLE_REVIEWS . "
						  set reviews_pic = '" . $str_name_aa . "'
						  where reviews_id = '" . (int)$insert_id . "'");
		  }
		
	// send review-notification email to admin
    if (SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO_STATUS == '1' and defined('SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO') and SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO !='') {
      $products_name=zen_get_products_name($_GET['products_id'],$_SESSION['languages_id']);
      $email_text  = sprintf(EMAIL_PRODUCT_REVIEW_CONTENT_INTRO, $products_name) . "\n\n" ;
      $email_text .= sprintf(EMAIL_PRODUCT_REVIEW_CONTENT_DETAILS, $review_content)."\n\n";
      $email_subject = sprintf(EMAIL_REVIEW_PENDING_SUBJECT,$products_name);
      $html_msg['EMAIL_SUBJECT'] = sprintf(EMAIL_REVIEW_PENDING_SUBJECT,$products_name);
      $html_msg['EMAIL_MESSAGE_HTML'] = str_replace('\n','',sprintf(EMAIL_PRODUCT_REVIEW_CONTENT_INTRO, $products_name));
      $html_msg['EMAIL_MESSAGE_HTML'] .= '<br />';
      $html_msg['EMAIL_MESSAGE_HTML'] .= 'Customer Name:&nbsp;&nbsp;'.$customer_name;
      $html_msg['EMAIL_MESSAGE_HTML'] .= '<br />';
      $html_msg['EMAIL_MESSAGE_HTML'] .= 'E-mail:&nbsp;&nbsp;'.$customer_email;
      $html_msg['EMAIL_MESSAGE_HTML'] .= '<br />';
      $html_msg['EMAIL_MESSAGE_HTML'] .= str_replace('\n','',sprintf(EMAIL_PRODUCT_REVIEW_CONTENT_DETAILS, $review_content));
      $extra_info=email_collect_extra_info($customer_name,$customer_email, '' , '' );
      $html_msg['EXTRA_INFO'] = $extra_info['HTML'];
      zen_mail('', SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO, $email_subject ,
      $email_text . $extra_info['TEXT'], STORE_NAME, EMAIL_FROM, $html_msg, 'reviews_extra');
    }
		$messageStack->add('reviews', TEXT_WRITE_REVIEW_SUCCESS, 'success');
	}    
  	$_POST['action']='aaaa';
  }
  if ($error == true) {
  $zco_notifier->notify('NOTIFY_REVIEW_FAILURE');
}
  // if specified product_id is disabled or doesn't exist, ensure that metatags and breadcrumbs don't share inappropriate information
  $sql = "select count(*) as total
          from " . TABLE_PRODUCTS . " p, " .
                   TABLE_PRODUCTS_DESCRIPTION . " pd
          where    p.products_status = '1'
          and      p.products_id = '" . (int)$_GET['products_id'] . "'
          and      pd.products_id = p.products_id
          and      pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
  $res = $db->Execute($sql);
  if ( $res->fields['total'] < 1 ) {
    unset($_GET['products_id']);
    unset($breadcrumb->_trail[sizeof($breadcrumb->_trail)-1]['title']);
    header('HTTP/1.1 404 Not Found');
  }

  // ensure navigation snapshot in case must-be-logged-in-for-price is enabled
  if (!$_SESSION['customer_id']) {
    $_SESSION['navigation']->set_snapshot();
  }

  /*
   * This is Payment Info Popup
   */
  $paymentInfoString = '<dl class="dl_dot pad_10px">';
  $file_extension = '.php';
  $key_value = $db->Execute("select configuration_value
                               from " . TABLE_CONFIGURATION . "
                               where configuration_key = 'MODULE_PAYMENT_INSTALLED'");
  $paymentArray = explode(';',$key_value->fields['configuration_value']);
  $module_directory = DIR_WS_MODULES . 'payment/';
	$directory_array = array();
	if ($dir = @dir($module_directory)) {
	  while ($file = $dir->read()) {
	    if (!is_dir($module_directory . $file)) {
	      if (substr($file, strrpos($file, '.')) == $file_extension) {
	        $directory_array[] = $file;
	      }
	    }
	  }
	    sort($directory_array);
	    $dir->close();
	  }
	  $paymentNum = count($directory_array);
	  for($i=0 ; $i<$paymentNum; $i++) {
	  	if(in_array($directory_array[$i],$paymentArray)){
		  	$file = $directory_array[$i];
	      include(DIR_WS_LANGUAGES . $_SESSION['language'] . '/modules/payment/' . $file);
	      include($module_directory . $file);
	      $class = substr($file, 0, strrpos($file, '.'));
	      if (zen_class_exists($class)) {
	        $module = new $class;
	        $paymentInfoString .= '<dt>'.$module->title.'</dt>';
	      }
	  	}
	  }
    $paymentInfoString .= '</dl>';
/*
 * This is Shipping Cost Program
 */
  $num_zones = 3;
  $countriesIds = array();
  $countriesStr1 = array();
  $countriesStr2 = array();
  $countriesId = $db->Execute("SELECT countries_id,countries_iso_code_2 FROM ". TABLE_COUNTRIES);
  if ($countriesId->RecordCount()>0){
    while (!$countriesId->EOF){
      $countriesIds[$countriesId->fields['countries_iso_code_2']] = $countriesId->fields['countries_id'];
      $countriesId->MoveNext();
    }
  }
  function codeToId(&$code, $key){
    global $countriesIds;
    $code = $countriesIds[$code];
  }
  for ($i = 1; $i <= $num_zones; $i++) {
	 if (defined('MODULE_SHIPPING_STANDARD_COUNTRIES_' . $i)) {

		 $countries_table = constant('MODULE_SHIPPING_STANDARD_COUNTRIES_' . $i);

		 if (defined('MODULE_SHIPPING_STANDARD_COST_' . $i)) {

			 $cost_table = constant('MODULE_SHIPPING_STANDARD_COST_' . $i);
			 $countries_table = strtoupper(str_replace(' ', '', $countries_table));
			 $country_zones = split("[,]", $countries_table);
			 if ($country_zones[0] != '00'){
				array_walk($country_zones,'codeToId');
			 }
			 if ($countries_table !=''){
				$countriesStr1[$i]= implode(',',$country_zones).'|'.$cost_table;
			 }
		 } else {

		 }
	 } else {

	 }
  }
  
  for ($i = 1; $i <= $num_zones; $i++) {
	 if (defined('MODULE_SHIPPING_EXPEDITED_COUNTRIES_' . $i)) {
			
			 $countries_table = constant('MODULE_SHIPPING_EXPEDITED_COUNTRIES_' . $i);
	 
		if (defined('MODULE_SHIPPING_EXPEDITED_COST_' . $i)) {
			
			 $cost_table = constant('MODULE_SHIPPING_EXPEDITED_COST_' . $i);
	 
			 $countries_table = strtoupper(str_replace(' ', '', $countries_table));
			 $country_zones = split("[,]", $countries_table);
			 if ($country_zones[0] != '00'){
				array_walk($country_zones,'codeToId');
			 }
			 if ($countries_table !=''){
				$countriesStr2[$i]= implode(',',$country_zones).'|'.$cost_table;
			 }
		} else {
			define('MODULE_SHIPPING_EXPEDITED_COST_NOT_SET_' . $i, true);
		}
	 } else {
		define('MODULE_SHIPPING_EXPEDITED_COUNTRIES_NOT_SET' . $i, true);
	 }
  }
  $standard = (implode('-',$countriesStr1));

  if (defined('MODULE_SHIPPING_STANDARD_SKIPPED')) {
	$standardSkip = constant('MODULE_SHIPPING_STANDARD_SKIPPED');
	$standardSkipArray = explode(',',$standardSkip);
	array_walk($standardSkipArray,'codeToId');
	$standardSkipStr = implode(',',$standardSkipArray);
  } else {

  }

  $expedited = (implode('-',$countriesStr2));

  if (defined('MODULE_SHIPPING_EXPEDITED_SKIPPED')) {
	$expeditedSkip =constant('MODULE_SHIPPING_EXPEDITED_SKIPPED');
		$expeditedSkipArray = explode(',',$expeditedSkip);
		array_walk($expeditedSkipArray,'codeToId');
		$expeditedSkipStr = implode(',',$expeditedSkipArray);
  } else {
	  define('MODULE_SHIPPING_EXPEDITED_SKIPPED_NOT_SET', true);
  }
/*
 * End Shipping Cost 
 */
  require(DIR_WS_CLASSES . 'order.php');
	$order = new order;
	$selected_country = $order->delivery['country']['id'];
    
	  // This should be last line of the script:
  $zco_notifier->notify('NOTIFY_HEADER_END_PRODUCT_INFO');
?>