<?php
  if (in_array($current_page_base,explode(",",'list_pages_to_skip_all_right_sideboxes_on_here,separated_by_commas,and_no_spaces')) ) {
    $flag_disable_right = true;
  }
  $header_template = 'tpl_header.php';
  $footer_template = 'tpl_footer.php';
  $left_column_file = 'column_left.php';
  $right_column_file = 'column_right.php';
  $body_id = ($this_is_home_page) ? 'indexHome' : str_replace('_', '', $_GET['main_page']);
?>
<body id="<?php echo $body_id . 'Body'; ?>"  <?php if($zv_onload !='') echo ' onload="'.$zv_onload.'"'; ?>  >
<?php if($this_is_home_page) {?>
<div class="" id="transforDomainClose" style="display:block;">
<?php 
include('includes/languages/english/html_includes/define_notice.php'); ?>
<a onClick="document.getElementById('transforDomainClose').style.display='none';" href="javascript:void(0);" class="close"></a>
</div>
<?php }?>
<?php if ($_GET['main_page'] !='shipping_estimator'){?>
<div id="topmenuWrap">
<?php require($template->get_template_dir('tpl_modules_header_right.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_header_right.php'); ?>
</div>
<?php }?>
<div id="wrapper"><!-- wrapper S-->
<div id="pop_window" style="display:none"></div>
<?php
if (isset($_GET['c']) and $_GET['c'] == 'only'){
  echo '<div class="comm1">';
}else{
  switch ($current_page){
    case 'faqs_submit':
      echo '<div class="new1">';
      break;
    case 'shipping_estimator':
      echo '<div>';
      break;
    case 'print_page':
      echo '<div class="slucky" style="width: 760px;">';
      break;
    case 'checkout_payment':
    case 'checkout_login':
    case 'checkout_shipping_address':
    case 'address_book_process':
    	echo '<div class="slucky">';
    	break;
    default:
    	echo '<div class="slucky">';
  }	
}

?>
<!-- content S-->
<?php

 /**
  * prepares and displays header output
  *
  */
  if (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_HEADER_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == '')) {
    $flag_disable_header = true;
  }
  require($template->get_template_dir('tpl_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_header.php');?>
  

<?php if($_GET['main_page'] != 'shipping_estimator' ){?>
	<div id="bodyblock">
	<?php }?>
		<?php
    //addPage
    if($this_is_home_page  || $current_page == 'advanced_search' || $current_page == 'checkout_payment_address' || $current_page == 'checkout_confirmation'){
        if (COLUMN_LEFT_STATUS == 0 || (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '') || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_LEFT_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == ''))) {
          // global disable of column_left
          $flag_disable_left = true;
        }
        if (!isset($flag_disable_left) || !$flag_disable_left) {
    ?>
    <div class="minframe fl">

      <?php
     /**
      * prepares and displays left column sideboxes
      *
      */
      switch($current_page){
        case 'login':
		case 'shopping_cart':
          //require(DIR_WS_MODULES . 'sideboxes/' . $template_dir . '/categories_css.php');
          break;
        //case 'shopping_cart':
        case 'checkout_payment_address':
        case 'checkout_confirmation':
        case 'time_out':
        case 'faqs_all':
        case 'advanced_search':
          require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/vip_link.php'));
 //require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/search_categories.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/history_viewed.php'));
          break;
        default:
          require(DIR_WS_MODULES . zen_get_module_directory('column_left.php'));
      }
    ?>
    </div>
    <?php
    }
    }
    ?>
		<?php
//addPage
if($this_is_home_page || $current_page == 'advanced_search' || $current_page == 'time_out'  || $current_page == 'checkout_payment_address' || $current_page == 'checkout_confirmation'){ ?>
<div class="maxframe">
  <?php }elseif ($current_page =='faqs_all' || $current_page =='faqs_submit' ){ ?>
  <div class="fl">
    <?php }else { ?>
    <div>
      <? }?>

    
      <!-- bof upload alerts -->
      <?php if ($messageStack->size('upload') > 0) echo $messageStack->output('upload'); ?>
      <!-- eof upload alerts -->
      <?php
			 /**
				* prepares and displays center column
				*
				*/
				require($body_code);
				?>
 
    </div>
		<?php
   /**
    * prepares and displays footer output
    *
    */
    if (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_FOOTER_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == '')) {
      $flag_disable_footer = true;
    }
    require($template->get_template_dir('tpl_footer.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_footer.php');
    ?>

<br class="clear"/>

</div><!-- content E-->


</body>

