<?php

/**

 * Page Template

 *

 * Loaded automatically by index.php?main_page=shopping_cart.<br />

 * Displays shopping-cart contents

 *

 * @package templateSystem

 * @copyright Copyright 2003-2007 Zen Cart Development Team

 * @copyright Portions Copyright 2003 osCommerce

 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0

 * @version $Id: tpl_shopping_cart_default.php 5554 2007-01-07 02:45:29Z drbyte $

 */

?>



<div class="right_big_con3" style="background:url(includes/templates/slucky/images/stepImgs.gif)">

	<ul id="projects">

    <li class="current1"><span>Your Shopping Cart</span></li>

    <li class="li2"><span>Account Login</span></li>

    <li class="li3"><span>Address Book</span></li>

    <li class="li4"><span>Billing, Shipping & Review</span></li>

    <li class="li5"><span>Order Complete</span></li>

  </ul>

</div>

<?php

  if ($flagHasCartContents) {

?>

<div class="right_big_con3 allborder">



<div class="check_box_tit black pad_1em"><?php echo HEADING_TITLE; ?></div>

<div class="pad_10px check_box_con">

<?php if ($messageStack->size('shopping_cart') > 0) echo $messageStack->output('shopping_cart'); ?>



<?php echo zen_draw_form('cart_quantity', zen_href_link(FILENAME_SHOPPING_CART, 'action=update_product','SSL'),'post',' id="cart_quantity"'); ?>



<?php if (!empty($totalsDisplay)) { ?>

  <div class="cartTotalsDisplay important"><?php //echo $totalsDisplay; ?></div>

<?php } ?>



<?php  if ($flagAnyOutOfStock) { ?>



<?php    if (STOCK_ALLOW_CHECKOUT == 'true') {  ?>



<div class="messageStackError"><?php echo OUT_OF_STOCK_CAN_CHECKOUT; ?></div>



<?php    } else { ?>

<div class="messageStackError"><?php echo OUT_OF_STOCK_CANT_CHECKOUT; ?></div>



<?php    } //endif STOCK_ALLOW_CHECKOUT ?>

<?php  } //endif flagAnyOutOfStock ?>



<ul class="margin_t cartbar_bg fl">

     <li class="w1 in_1em"  style="background:#F5F5F5; height: 30px; line-height: 30px;"><strong><?php echo TABLE_HEADING_ITEM_NAME; ?></strong></li>

     <li class="w2" style="background:#F5F5F5; height: 30px; line-height: 30px;"><strong><?php echo TABLE_HEADING_PRODUCTS_NAME; ?></strong></li>

     <li class="w3" style="background:#F5F5F5; height: 30px; line-height: 30px;"><strong><?php echo TABLE_HEADING_QUANTITY; ?></strong></li>

     <li class="w5" style="background:#F5F5F5; height: 30px; line-height: 30px;"><strong><?php echo TABLE_HEADING_PRICE; ?></strong></li>

     <li class="w5" style="background:#F5F5F5; height: 30px; line-height: 30px;"><strong><?php echo TEXT_TOTAL_AMOUNT; ?></strong></li>

     <li class="w5" style="background:#F5F5F5; height: 30px; line-height: 30px;"><strong><?php echo TABLE_HEADING_DELETE; ?></strong></li>

</ul>

         <!-- Loop through all products /-->

<?php

  foreach ($productArray as $product) {

?>

     <ul class="fl">

     	 <?php echo zen_draw_hidden_field('products_id[]',$product['id']);?>

       <li class="w1" style="border-top: 0 none;padding-top: 5px; text-align: center;height: 95px;">

       <?php if($product['w_id']==2){?>
       <a href="<?php echo $product['linkProductsName']; ?>" class="ih4"><?php echo $product['productsImage']; ?></a>
       <?php }else{?>
       <a href="<?php echo $product['linkProductsName']; ?>" class="ih4"><?php echo $product['productsImage']; ?></a>
       <?php }?>

       </li>

       <li class="w2 padTop20" style="border-top: 0 none;height: 75px;padding-top: 25px;">

       <a href="<?php echo $product['linkProductsName']; ?>" class="u"><?php echo $product['productsName'] . '<span class="alert bold">' . $product['flagStockCheck'] . '</span>'; ?></a>

<?php if($product['w_id']==2){
echo '<br class="clear" />';	 
	 ?>      
<span class="fl" style="padding-top:5px"><img src="images/special_offer.gif" width="109" height="16" /></span>
<?php }?>

<?php

  echo '<br class="clear" />';

  echo $product['attributeHiddenField'];

  if ($product['showfreeicon']){

     echo '<div class="bulksale_free_shipping"></div>';

  }

  if (isset($product['attributes']) && is_array($product['attributes'])) {

  echo '<div class="cartAttribsList">';

  echo '<ul>';

    reset($product['attributes']);

    foreach ($product['attributes'] as $option => $value) {

      echo '<li class="blue clear">'.$value['products_options_name'] . TEXT_OPTION_DIVIDER . nl2br($value['products_options_values_name']).'</li>'; 

    }

  echo '</ul>';

  echo '</div>';

  }



?>

       </li>

       <li class="w3 padTop20" style="border-top: 0 none;height: 65px;padding-top: 35px;">

			<?php

          echo $product['quantityField'] ;

      ?>

      <div style="display: none;"><a onclick="$('cart_quantity').submit();return false;" href="javascript:void(0);">Update</a>|<a href="<?php echo $_SERVER['REQUEST_URI']?>">Cancel</a></div>

       </li>

       <li class="w5 padTop20" style="border-top: 0 none;height: 95px;line-height: 25px;padding-top: 5px;"><strong class="red font_normal"><?php if($product['w_id']==2){?>
       <span class="gray"><del style="font-weight:normal; font-size:12px;"><?php echo $product['productsOldPrice']; ?></del></span><br />
       <span class="f12 c99 mr10"><?php echo $product['productsPriceEach']; ?></span><br />
		<span style="color:#E55A31; font-weight:normal;">SAVE <?php echo $product['savePrice']; ?></span>
       <?php }else{?>
       <span class="f12 c99 mr10"><?php echo $product['productsPriceEach']; ?></span>
       <?php }?></strong></li>

       <li class="w5 padTop20" style="border-top: 0 none;height: 95px;line-height: 95px;padding-top: 5px;"><strong class="red"><?php echo $product['productsPrice']; ?></strong></li>

       <li class="w5 padTop20" style="border-top: 0 none;height: 95px;line-height: 95px;padding-top: 5px;">

       <?php if ($product['buttonDelete']) {?>

       <a style=" padding-top:20px;" href="<?php echo zen_href_link(FILENAME_SHOPPING_CART, 'action=remove_product&product_id=' . $product['id']); ?>"><?php echo zen_image($template->get_template_dir(ICON_IMAGE_TRASH, DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/' . ICON_IMAGE_TRASH, ICON_TRASH_ALT); ?></a>

			 <?php } ?>

			 </li>

      </ul>

<?php

  } // end foreach ($productArray as $product)

?>

       <!-- Finished loop through all products /-->

<div class="clear margin_t g_t_l black b" style="font-size:14px"><table width="990" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td width="716" style="border-bottom: 1px solid #E5E5E5; border-left: 1px solid #E5E5E5; border-right: 1px solid #E5E5E5; background:#FFF8EB; height:30px;  padding-right: 10px; text-align: right;  font-size: 14px; "><?php echo SUB_TITLE_SUB_TOTAL; ?></td>

    <td  style="border-bottom: 1px solid #E5E5E5;  border-right: 1px solid #E5E5E5; background:#F5FFEB; padding-left: 10px;font-size: 14px; color:#A72D2C;"><?php echo $cartShowTotal; ?></td>

    <td width="130"  style="border-bottom: 1px solid #E5E5E5;  border-right: 1px solid #E5E5E5; background:#FFF8EB;">&nbsp;</td>

  </tr>

</table>

</div>

<br class="clear" />



<!--bof shopping cart buttons-->

<ul class="margin_t" style=" border: 1px solid #FFB552; height: 55px; padding-left: 10px; margin-right: 4px; background:#FFF9F1;"><a href="/index.php"><img height="19" border="0" width="154" onclick="back(-1)" class="hand fl" style="padding-top: 20px;" alt="" src="includes/templates/slucky/images/button/continue_shop.gif"></a>



<li class="g_t_c" style="padding-left: 390px;">



<table width="355px" border="0" cellspacing="0" cellpadding="0">

  <tr>

    <td width="145px"><!-- ** BEGIN PAYPAL EXPRESS CHECKOUT ** -->

<?php  // the tpl_ec_button template only displays EC option if cart contents >0 and value >0

if (defined('MODULE_PAYMENT_PAYPALWPP_STATUS') && MODULE_PAYMENT_PAYPALWPP_STATUS == 'True') {

  include(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/paypal/tpl_ec_button.php');

}

?> 

<!-- ** END PAYPAL EXPRESS CHECKOUT ** --></td>

<td><!---OR---></td>

    <td style="padding-top: 7px;"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, 'checkout=1', 'SSL') . '" class="buttonCheakout"></a>'; ?></td>

  </tr>

</table>







<!-- * BEGIN GOOGLE CHECKOUT * -->

 <?php

  // ** GOOGLE CHECKOUT **

    include(DIR_WS_MODULES . 'show_google_components.php');  

  // ** END GOOGLE CHECKOUT **

 ?>

<!-- * END GOOGLE CHECKOUT * -->



</li>

</ul>

<!--eof shopping cart buttons-->

<?php echo '</form>'; ?>



<hr class="clear"/>

<!--<span class="line_120"><?php //echo TEXT_INFORMATION; ?></span>-->

<h4 class="dark_bg margin_t cartbar_bg"><a onclick="toggle('shipping_estimator_frm');" class="red u" href="javascript:void(0);"><?php echo CART_SHIPPING_OPTIONS; ?></a></h4>

<iframe width="720" scrolling="no" height="270" frameborder="0" src="<?php echo zen_href_link(FILENAME_SHIPPING_ESTIMATOR); ?>" style="display: block;" id="shipping_estimator_frm"></iframe>



</div>

</div>

<?php

  } else {

?>

<div class="right_big_con3 allborder">

	<div class="check_box_tit black pad_1em">Your Shopping Cart</div>

	<div class="pad_10px check_box_con">

     <h3 class="g_t_c margin_t"><?php echo TEXT_CART_EMPTY; ?></h3>

     <p class="g_t_c">To continue shopping,please <a class="u" href="./">click here</a>.</p>

  </div>

</div>

<?php

  }

?>



<?php

  require(DIR_WS_MODULES.zen_get_module_directory('sideboxes/recently_viewed.php'));

?>

