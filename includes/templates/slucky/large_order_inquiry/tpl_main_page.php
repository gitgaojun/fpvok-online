<?php
/**
 * Override Template for common/tpl_main_page.php
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php 2870 2006-01-21 21:36:02Z birdbrain $
 */
?>
<body id="popupSearchHelp" onLoad="resize();">
<div id="popup_ask_a_question" class="pad_10px">
<?php echo zen_draw_form('large_order_inquiry', zen_href_link(FILENAME_LARGE_ORDER_INQUIRY, 'action=send&products_id=' . $_GET['products_id']),'post','onsubmit="return(fmChk(this))"'); ?>



<?php
  if (isset($_GET['action']) && ($_GET['action'] == 'success')) {
?>
<div class="success_box"><?php echo TEXT_SUCCESS; ?></div>

<div class="g_t_c pad_10px"><a href=javascript:window.opener=null;window.close()>Close</a></div>

<?php
  } else {
?>
<div class="lower_price_top">
<?php echo '<a href="' . zen_href_link(zen_get_info_page($_GET['products_id']), 'products_id=' . $_GET['products_id']) . '" class="fl margin_t lower_price">' . str_replace("/s/","/l/",zen_image_OLD(DIR_WS_IMAGES . $product_info->fields['products_image'], SEO_COMMON_KEYWORDS . ' ' .$product_info->fields['products_name'], 100, 77)) . '</a>'; ?>
<h2 class="border_bb line_30px"><a class="fr font_normal" target="_blank" href="/faqs_all.html"><?php echo zen_image($template->get_template_dir('help.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/help.gif') ?></a><?php echo HEADING_TITLE .' - '. $product_info->fields['products_name']; ?></h2>
<span class="db f18 pt10 c00">Our Price: 
<em id="productPrice">
<?php 
 $speice_price = zen_get_products_special_price($_GET ['products_id']);
 $base_price = zen_get_products_base_price($_GET ['products_id']);
 $fin_price = $currencies->display_price($speice_price>0?$speice_price:$base_price,0);
?><?php echo $fin_price; ?>
</em>
</span></div>
<div id="contactUsNoticeContent" class="content">
<?php
/**
 * require html_define for the contact_us page.  
 */
  require($define_page);
?>
</div>

<?php if ($messageStack->size('contact') > 0) echo $messageStack->output('contact'); ?>

<fieldset class="pad_10px margin_t dark_border" style="width:400px;">
<div class="alert"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
<div class="clear" /></div>
<?php
// show dropdown if set
if (CONTACT_US_LIST !=''){
?>
<div class="hide">
<label class="inputLabel" for="send-to"><?php echo SEND_TO_TEXT; ?></label>
<?php echo '<br/>'.zen_draw_pull_down_menu('send_to',  $send_to_array, 'id=\"send-to\"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?>
</div>
<?php
    }
?>

<label class="inputLabel fl pad_3" style="width:95px;"for="Target Price"><?php echo TARGET_PRICE . '<span class="red">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
<?php echo '<span class="fl pad_3">'.zen_draw_input_field('target_price', '', ' size="40" id="target_price" class="input_box" chkname="Your Target Price" chkrule="nnull"'). '</span>'; ?>
<br class="clear" />


<label class="inputLabel fl pad_3" style="width:95px;" for="Phone"><?php echo ENTRY_PHONE_NUMBER. '<span class="red">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
<?php echo '<span class="fl pad_3">'.zen_draw_input_field('phone', $customer_telephone, ' size="40" id="phone" class="input_box" chkname="Your Phone Number" chkrule="nnull"')."</span>"; ?>
<br class="clear" />

<label class="inputLabel fl pad_3" style="width:95px;" for="contactname"><?php echo ENTRY_NAME . '<span class="red">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
<?php echo '<span class="fl pad_3">'.zen_draw_input_field('contactname', $name, ' size="40" id="contactname" class="input_box" chkname="Your Name" chkrule="nnull"'). '</span>'; ?>
<br class="clear" />

<label class="inputLabel fl pad_3" style="width:95px;" for="email-address"><?php echo ENTRY_EMAIL. '<span class="red">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
<?php echo '<span class="fl pad_3">'.zen_draw_input_field('email', ($error ? $_POST['email'] : $email), ' size="40" id="email-address" class="input_box" chkname="Email" chkrule="nnull/eml"'). '</span>' ; ?>
<br class="clear" />

<label for="enquiry"><?php echo ENTRY_ENQUIRY . '<span class="red">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
<?php echo '<br/>'.zen_draw_textarea_field('enquiry', '10', '7', '', 'id="enquiry" class="textarea1_inquiry" chkname="review" chkrule="nnull/max1000"'); ?>

</fieldset>

<div class="pad_10px fl g_t_r" style="width:400px;"><?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_SEND_ALT); ?></div>
<?php
  }
?>
</form>
</div>
</body>