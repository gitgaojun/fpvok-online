<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_shipping.<br />
 * Displays allowed shipping modules for selection by customer.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_shipping_default.php 6964 2007-09-09 14:22:44Z ajeh $
 */
  
?>
<script type="text/javascript">
	function showtrail(){};
	function hidetrail(){};
		function get_coupon(){
		$('dc_redeem_code_top').value = $('dc_redeem_code2').value;
		var shipping = document.getElementsByName("shipping");
  		var payment = document.getElementsByName("payment");
		
		  for(i=0;i<shipping.length;i++){
			
			if(shipping[i].checked){
				
				$('ship_id').value = shipping[i].value;
			}
		  }
		  for(i=0;i<payment.length;i++){
			
			if(payment[i].checked){
				
				$('pay_id').value = payment[i].value;
			}
		  }
 
		document.shipping_coupon.submit(); 
	}
</script>

<?php echo $payment_modules->javascript_validation(); ?>
<?php if($current_page != 'checkout_shipping') {?>
<div style="background:url(includes/templates/slucky/images/stepImgs.gif);overflow: hidden; width: 1000px;">
<ul id="projects">
  <li class="li1"><a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART,'','SSL') ?>"><span>Your Shopping Cart</span></a></li>
  <li class="li2"><span>Account Login</span></li>
  <li class="li3"><a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS,'','SSL') ?>"><span>Address Book</span></a></li>
  <li class="current4"><span>Billing, Shipping & Review</span></li> 
  <li class="li5"><span>Order Complete</span></li>
</ul></div>
<?php }?>
<div class="ck_w center ">
<?php if ($messageStack->size('checkout_shipping') > 0) echo $messageStack->output('checkout_shipping'); ?>
<?php if ($messageStack->size('redemptions') > 0) echo $messageStack->output('redemptions'); ?>
<?php if ($messageStack->size('checkout') > 0) echo $messageStack->output('checkout'); ?>
<?php if ($messageStack->size('checkout_payment') > 0) echo $messageStack->output('checkout_payment'); ?>
<div class="margin_t allborder">
<div class="check_box_tit black pad_1em ">Billing, Shipping & Review</div>
<?php 
echo zen_draw_form('shipping_coupon', zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'),'post','" id="shipping_coupon"');
echo '<input type="hidden" id="dc_redeem_code_top" name="dc_redeem_code">';
echo '<input type="hidden" id="ship_id" name="ship_id">';
echo '<input type="hidden" id="pay_id" name="pay_id">';
echo '</form>'
?>
<?php
echo zen_draw_form('shipping_method', zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'),'post','onsubmit="return check(this)" id="shipping_method"');
echo zen_draw_hidden_field('payment','');
?>

<div class="show pad_10px">
<h4 class="dark_bg margin_t bg_in red"><div class="fl halfwidth"><?php echo TITLE_SHIPPING_ADDRESS; ?></div></h4>
<ul class="pad_l_28px clear margin_t black" style="width:900px">
	<li class="fl halfwidth">
		<div style="width:300px;">
		<ul>
		<?php
		  $sendToArray = zen_get_address_fields($_SESSION['customer_id'],$_SESSION['sendto']);
		  echo '<b>'.$sendToArray['firstname'].' '.$sendToArray['lastname'].'</b>';
		  $sendToArrayFiltered = filterName($sendToArray);
		  $format_id = zen_get_address_format_id($sendToArrayFiltered['country_id']);
		  echo zen_address_format($format_id, $sendToArrayFiltered, true, ' ', '<br />');
		  echo '<br/>Phone: '.$sendToArray['phone'];
		  ?></ul>
		<?php if ($displayAddressEdit) { ?>
	    <ul class=" margin_t"><?php echo '<a href="' . $editShippingButtonLink . '">' . zen_image($template->get_template_dir('btn_change.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/btn_change.gif','','','',' border="0"') . '</a>'; ?></ul>
    <?php } ?>
		<div class="margin_t big_ gray" style="width: 700px;"><?php echo TEXT_CHOOSE_SHIPPING_DESTINATION; ?></div>
		</div>
	</li>
	<?php
	 // ** BEGIN PAYPAL EXPRESS CHECKOUT **
	if (!$payment_modules->in_special_checkout()) {
	 // ** END PAYPAL EXPRESS CHECKOUT ** ?>
	<li style="display:none;">
		<div id="checkoutBillto" class="margin_t big_">
		<ul>
    <?php
      $billToArray = zen_get_address_fields($_SESSION['customer_id'],$_SESSION['billto']);
      echo '<b>'.$billToArray['firstname'].' '.$billToArray['lastname'].'</b>';
      $billToArrayFiltered = filterName($billToArray);
      $format_id_bill = zen_get_address_format_id($billToArrayFiltered['country_id']);
      echo zen_address_format($format_id_bill, $billToArrayFiltered, true, ' ', '<br />');
      echo '<br/>Phone: '.$billToArray['phone'];
      ?>
		</ul>
		<?php if (MAX_ADDRESS_BOOK_ENTRIES >= 2) { ?>
	    <ul class="pad_l_90px margin_t"><?php echo '<a href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'url=checkout_shipping&edit='.$_SESSION['billto'], 'SSL') . '">' . zen_image($template->get_template_dir('btn_edit.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/btn_edit.gif','','','',' border="0"').'</a>'; ?></ul>
    <?php } ?>
		</div>
		<br class="clearBoth" />
	</li>
	<?php
	 // ** BEGIN PAYPAL EXPRESS CHECKOUT **
	  }
	// ** END PAYPAL EXPRESS CHECKOUT ** ?>
<br class="clear" />
</ul>

<?php
  if (zen_count_shipping_modules() > 0) {
?>


<h4 class="dark_bg margin_t bg_car red"><?php echo TABLE_HEADING_SHIPPING_METHOD; ?></h4>
<div class="big_ pad_l_28px margin_t">
<?php
    if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1) {
?>
<ul class="clear"><?php echo TEXT_CHOOSE_SHIPPING_METHOD; ?></ul>
<?php
    } elseif ($free_shipping == false) {
?>
<ul class="clear"><?php echo TEXT_ENTER_SHIPPING_INFORMATION; ?></ul>
<?php
    }
?>
<?php
    if ($free_shipping == true) {
?>
<div id="freeShip" class="margin_t" ><?php echo FREE_SHIPPING_TITLE; ?>&nbsp;<?php echo $quotes[$i]['icon']; ?></div>
<div id="defaultSelected"><?php echo sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) . zen_draw_hidden_field('shipping', 'free_free'); ?></div>
<?php
    } else {
      $radio_buttons = 0;
      for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {

      if ($quotes[$i]['module'] != '') { // Standard
?>

<ul>
<?php
  if (isset($quotes[$i]['error'])) {
?>
    <div><?php echo $quotes[$i]['error']; ?></div>
<?php
  } else {
     for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
// set the radio button to be checked if it is the method chosen
     $checked = (($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $_SESSION['shipping']['id']) ? true : false);
	 if(strlen($_SESSION['ship_id'])>0){
	 $checked =($_SESSION['ship_id']==$quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'])?true : false;
	 }
?>
<?php echo zen_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked, 'id="ship-'.$quotes[$i]['id'] . '-' . $quotes[$i]['methods'][$j]['id'].'" onclick="priceCalculate();" rule="shipping" price="'.$quotes[$i]['methods'][$j]['cost'].'"'); ?>
<label for="ship-<?php echo $quotes[$i]['id'] . '-' . $quotes[$i]['methods'][$j]['id']; ?>" class="checkboxLabel" >
<?php if($quotes[$i]['id']=='mzmt'){
?>
<strong class="black"><?php echo $quotes[$i]['methods'][$j]['title']; ?></strong>&nbsp;
<?php }else{  ?>
<strong class="black"><?php echo $quotes[$i]['module']; ?></strong>&nbsp;
<?php }?>
<span class="black">......................................................................................................</span>
<span class="black">
<?php
  if ( ($n > 1) || ($n2 > 1) ) {
    echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))); 
  } else {
    echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])) . zen_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']); 
  } 
  ?>
</span>
</label>
<ul class="pad_l_28px">

<?php print_r($quotes[$i]['description']); ?>

</ul>
<?php
        $radio_buttons++;
      }
    }
?>
</ul>
<?php
    }
// eof: field set
  }
  }
?>
<div id="add_insurance" style="display:none;">
  <ul class="black">
    <div id="insurance_lab">
      <input type="checkbox" onclick="priceCalculate();" price="<?php echo $showTotal * 0.03; ?>" id="insurance_checked" value="1" name="insurance_checked"/>
      <label for="insurance_checked"><strong>Add Shipping Insurance to your order</strong>  .............................................. <strong><?php echo $currencies->display_price($showTotal*0.03,0); ?></strong></label>
      <ul class="pad_l_28px">(We offer Shipping Insurance <?php echo $currencies->display_price($showTotal*0.03,0); ?> to protect your package against any lost or damaged shipments. Any missing issues reported, we will reship your order immediately.)</ul>
    </div>
  </ul>
</div>


</div>
<div id="Shipping_Methods_content" style="display: none;" class="pad_l_28px big_ margin_t"> 
    <ul class="clear">    
      <li style="width: 106px;" class="fl"><span class="b black">Processing Time = </span></li><li class="fl">From the time we received your order to the time we start to processing your order. One days to get your payment <br/>confirmed, and to make sure the shipping address is correct. <span class="b black">Minimum time: 1-2 business days.</span><br/>
      We do not process your order on Sunday or holidays. Allow an additional 1 to 2 business days for weekend orders.
      </li>
  </ul>
     <ul class="clear">
        <li style="width: 106px;" class="fl g_t_r"><span class="b black">Packaging Time = </span></li>
        <li class="fl">After your order is processed, we send it to the warehouse for packing your order.<br />
        <span class="b black">Minimum time: 1-2 business days</span>
      </li>
     </ul>
       <ul class="clear">
        <li style="width: 106px;" class="fl g_t_r"><span class="b black">Shipping Time = </span></li>
        <li class="fl">Shipping Delivery lead Time - The time it takes for the shipping company to drive or fly your package to you.<br/>
        <span class="b black">Standard Shipping:</span> Most shipped packages are delivered within 6-9 business days from the day they are shipped.<br/>
        <span class="b black">Expedited Shipping:</span> Most shipped package are delivered within 3-6 business days from the day they are shipped.
      </li>
     </ul>
       <ul class="border_b pad_bottom">
    www.fpvok.com may ship each Order at different times via different shipping companies such as DHL,UPS,TNT,EMS and HongKong Airmail. We usually select the fastest shipping delivery company among your selected shipping methods.
    </ul>
</div>
<?php
  } else {
?>
<h2><?php echo TITLE_NO_SHIPPING_AVAILABLE; ?></h2>
<div class="important"><?php echo TEXT_NO_SHIPPING_AVAILABLE; ?></div>
<?php
  }
?> 

<?php 
/* 
 * Up shipping
 * merger shipping & payment
 * Down payment
 */ ?>

<?php
  if (DISPLAY_CONDITIONS_ON_CHECKOUT == 'true') {
?>
<fieldset>
<legend><b><?php echo TABLE_HEADING_CONDITIONS; ?></b></legend>
<div><?php echo TEXT_CONDITIONS_DESCRIPTION;?></div>
<?php echo  zen_draw_checkbox_field('conditions', '1', false, 'id="conditions"');?>
<label class="checkboxLabel" for="conditions"><?php echo TEXT_CONDITIONS_CONFIRM; ?></label>
</fieldset>
<?php
  }
?>



<div>
<?php // ** BEGIN PAYPAL EXPRESS CHECKOUT **
      if (!$payment_modules->in_special_checkout()) {
      // ** END PAYPAL EXPRESS CHECKOUT ** ?>
<h4 class="dark_bg margin_t bg_cart red"><div class="check_order_w"><?php echo TABLE_HEADING_PAYMENT_METHOD; ?></div></h4>
<div class="pad_l_28px big_ margin_t">
<?php
  if (SHOW_ACCEPTED_CREDIT_CARDS != '0') {
?>

<?php
    if (SHOW_ACCEPTED_CREDIT_CARDS == '1') {
      echo TEXT_ACCEPTED_CREDIT_CARDS . zen_get_cc_enabled();
    }
    if (SHOW_ACCEPTED_CREDIT_CARDS == '2') {
      echo TEXT_ACCEPTED_CREDIT_CARDS . zen_get_cc_enabled('IMAGE_');
    }
?>

<?php } ?>

<?php
  foreach($payment_modules->modules as $pm_code => $pm) {
    if(substr($pm, 0, strrpos($pm, '.')) == 'googlecheckout') {
      unset($payment_modules->modules[$pm_code]);
    }
  }
  $selection = $payment_modules->selection();
  if (sizeof($selection) > 1) {
  ?>
	<p class="important"><?php echo TEXT_SELECT_PAYMENT_METHOD; ?></p>
	<?php
  } elseif (sizeof($selection) == 0) {
  ?>
	<p class="important"><?php echo TEXT_NO_PAYMENT_OPTIONS_AVAILABLE; ?></p>

<?php
  }
?>

<?php
  $radio_buttons = 0;
  $n=sizeof($selection);
  for ($i=0; $i<$n; $i++) {
  	echo '<li class="margin_t">';

	if($selection[$i]['id']!='paypalwpp'){
    if (sizeof($selection) > 1) {
      if (empty($selection[$i]['noradio'])) {
		  
     $checked = ($selection[$i]['id'] == $_SESSION['payment'] ? true :(strlen($_SESSION['payment'])<=0 &&$selection[$i]['id']=='paypal')?true: false);
	 $dispaly = ($selection[$i]['id'] == $_SESSION['payment'] ? 'block' :(strlen($_SESSION['payment'])<=0 &&$selection[$i]['id']=='paypal')?'block': 'none');
	 if(strlen($_SESSION['pay_id'])>0){
	 $checked =($_SESSION['pay_id']==$selection[$i]['id'])?true : false;
	 $dispaly =($_SESSION['pay_id']==$selection[$i]['id'])?'block' : 'none';
	 }		  
        echo zen_draw_radio_field('payment', $selection[$i]['id'], $checked, 'id="'.$selection[$i]['id'].'"  onclick="showExplain(this)"');
		
			}
    } else {
      echo zen_draw_hidden_field('payment', $selection[$i]['id']);
    }
?>
		<label for="<?php echo $selection[$i]['id']; ?>" ><?php echo $selection[$i]['module']; ?></label>
		<div class="pad_l_38px">
      <span style="display: <?php echo $dispaly; ?>;" name="spBox" id="spBox" class="allborder pad_10px">
        <ul>
          <?php echo $selection[$i]['info']; ?>
        </ul>
      </span>
    </div>
            
<?php
    if (defined('MODULE_ORDER_TOTAL_COD_STATUS') && MODULE_ORDER_TOTAL_COD_STATUS == 'true' and $selection[$i]['id'] == 'cod') {
?>
      <div class="alert"><?php echo TEXT_INFO_COD_FEES; ?></div>
<?php
    } else {
      // echo 'WRONG ' . $selection[$i]['id'];
?>
<?php
    }
?>

<?php
    if (isset($selection[$i]['error'])) {
?>
    <div><?php echo $selection[$i]['error']; ?></div>

<?php
    } elseif (isset($selection[$i]['fields']) && is_array($selection[$i]['fields'])) {
?>

<div class="ccinfo">
<?php
      for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++) {
?>
<ul class="margin_t">
<label <?php echo (isset($selection[$i]['fields'][$j]['tag']) ? 'for="'.$selection[$i]['fields'][$j]['tag'] . '" ' : ''); ?>><?php echo $selection[$i]['fields'][$j]['title']; ?></label><br/><?php echo $selection[$i]['fields'][$j]['field']; ?><br/>
</ul>
<?php
      }
?>
</div>
<?php
    }
    $radio_buttons++;
    echo '</li>';
  }}
  unset($n);
?>
<?php
  //Discount Coupon -Start
  $selection =  $order_total_modules->credit_selection();
  //print_r($selection);
  $n=sizeof($selection);
  if ($n>0) {
    for ($i=0; $i<1; $i++) {
      if ($_GET['credit_class_error_code'] == $selection[$i]['id']) {
        ?>
        <div class="error_box"><?php echo zen_output_string_protected($_GET['credit_class_error']); ?></div> 
        <?php
      }
      $n2=sizeof($selection[$i]['fields']);
      for ($j=0; $j<$n2; $j++) {
			?>
			<?php /*?><h4 class=" margin_t  red">
			<input type="checkbox" onclick="toggle('coupon_div');" vaule="0" id="display_coupon"/>
			<label class="display_coupon" for="display_coupon"><strong class="red big">Use <?php echo $selection[$i]['module']; ?></strong></label>
		</h4><?php */?>	
      <?php /*?><div style="display: none;" class="pad_l_28px margin_t" id="coupon_div">
	      <input type="text" style="width: 120px;" class="input_4" id="dc_redeem_code2" name="dc_redeem_code2">&nbsp;<button type="button" onclick="get_coupon()"><span>Apply</span></button> Please enter the Coupon Code, then press "Apply" button.
      </div><?php */?>
			
			<?php
      }
      unset($n2);
    }
  }
  unset($n);
  //Discount Coupon -END

?>


</div>
<h4 class="dark_bg margin_t bg_cart red"><div class="check_order_w">Order Review:</div></h4>
<div class="pad_l_28px margin_t big_">
<table border="0" width="100%" cellspacing="0" cellpadding="0" class="check_tb black">
   <tr class="black">
	   <th scope="col" class="in_1em" width="80"><?php echo TABLE_HEADING_PRODUCTS; ?></th>
	   <th scope="col"></th>
	   <th scope="col" width="80" style="text-align:center;"><?php echo TABLE_HEADING_QUANTITY; ?></th>
			<?php
			  // If there are tax groups, display the tax columns for price breakdown
			  if (sizeof($order->info['tax_groups']) > 1) {
			?>
			   <th scope="col"><?php echo HEADING_TAX; ?></th>
			<?php	}?>
	   <th scope="col" width="80"  style="text-align:center;"><?php echo TABLE_HEADING_FINAL_PRICE; ?></th>
	   <th scope="col" width="80" style="text-align:center;"><?php echo TABLE_HEADING_TOTAL; ?></th>
   </tr>
<?php // now loop thru all products to display quantity and price ?>
<?php 
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) 
    {
//    	echo "<pre>"; print_r($order->products[$i]);echo "</pre>"; 
 		$isfree = zen_get_product_is_always_free_shipping($order->products[$i]['id']);
     	$product_href = zen_href_link(zen_get_info_page($order->products[$i]['id']),'products_id='.$order->products[$i]['id']);
?>
        <tr class="<?php echo $order->products[$i]['rowClass']; ?>">
          <td><?php echo '<a href="'.$product_href .'" target="_blank">'.zen_image(DIR_WS_IMAGES.$order->products[$i]['image'],SEO_COMMON_KEYWORDS . ' ' .$order->products[$i]['name'],85,66); ?></a></td>
          <td><?php echo '<a href="'.$product_href .'" target="_blank">'.$order->products[$i]['name']; ?></a>
          <?php  
             if ($isfree)
             {
             	echo '<br class="clear" />';
     		 	echo '<div class="bulksale_free_shipping"></div>';
  			 }
  			 echo $stock_check[$i]; 
  		  ?>

<?php // if there are attributes, loop thru them and display one per line
    if (isset($order->products[$i]['attributes']) && sizeof($order->products[$i]['attributes']) > 0 ) {
    echo '<ul class="cartAttribsList">';
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
?>
      <li class="blue clear"><?php echo $order->products[$i]['attributes'][$j]['option'] . ': ' . nl2br(zen_output_string_protected($order->products[$i]['attributes'][$j]['value'])); ?></li>
<?php
      } // end loop
      echo '</ul>';
    } // endif attribute-info
?>
        </td>
        <td class="b red" style="text-align:center;"><?php echo $order->products[$i]['qty']; ?></td>
        <td class="b red" style="text-align:center;"><?php echo $currencies->display_price($order->products[$i]['final_price'],$order->products[$i]['tax'], 1); ?></td>

<?php // display tax info if exists ?>
<?php if (sizeof($order->info['tax_groups']) > 1)  { ?>
        <td class="cartTotalDisplay">
          <?php echo zen_display_tax_value($order->products[$i]['tax']); ?>%</td>
<?php    }  // endif tax info display  ?>
        <td class="b red" style="text-align:center;">
          <?php echo $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']);
          if ($order->products[$i]['onetime_charges'] != 0 ) echo '<br /> ' . $currencies->display_price($order->products[$i]['onetime_charges'], $order->products[$i]['tax'], 1);
?>
        </td>
      </tr>
<?php  }  // end for loopthru all products ?>
</table>
<div class="editCart">To edit your cart, <a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART,'','SSL') ?>" class="u">click here.</a></div>
</div>
<?php // ** BEGIN PAYPAL EXPRESS CHECKOUT **
      } else {
        ?><input type="hidden" name="payment" value="<?php echo $_SESSION['payment']; ?>" /><?php
      }
      // ** END PAYPAL EXPRESS CHECKOUT ** ?>

      
<h4 class="dark_bg margin_t bg_pen red"><?php echo TABLE_HEADING_COMMENTS; ?></h4>
<div class="pad_l_28px margin_t big_">
<ul>
  If you have any special instructions for your this order, please let us know here. <br/>
  </ul>
  <ul class="shipping_textarea fl">
	  <?php echo zen_draw_textarea_field('comments', '45', '3','','class="txt_review_cont" onblur=\'if(this.value == "") this.className="txt_review_cont"\' onfocus=\'this.className=""\' style="OVERFLOW:auto;border:1px #ccc solid;height:80px;width:430px;"'); ?>
  </ul>
  <ul class="g_t_r fr" style="width:260px;">
  <?php
  if (MODULE_ORDER_TOTAL_INSTALLED) {
    $order_totals = $order_total_modules->process();
    echo '<table class="big black" width="500" align="right">';
    echo $order_total_modules->output(true);
    echo '<tr><td class="g_t_r" colspan="2"><div class="g_t_c" style="margin-left: 320px;">';
    echo zen_draw_hidden_field('place_order','place_order');
    echo '<input type="image" id="btn_place" class="place" title=" Place your Order" alt="Place your Order" src="'.$template->get_template_dir('btn_place.gif', DIR_WS_TEMPLATE, $current_page_base,'images'). '/btn_place.gif" />';
    echo '</div></td></tr>';
    echo '<tr><td class="g_t_r big_ gray" colspan="2">Every order you place with us is safe & secure.</td></tr>';
    echo '</table>';
  }
?>
  <br class="clear"/>
  </ul>
</div>
<script language="javascript" type="text/javascript"><!--
priceCalculate();
//--></script>
<div class="clear"></div>
</div>
<?php echo '</form>'; ?>
</div>
</div>





