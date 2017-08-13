<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_products_quantity_discounts.php 3291 2006-03-28 04:03:38Z ajeh $
 */

?>

<div class="buymore"> Bulk Order Discount: </div>
<ul id="productQuantityDiscounts" style="width:600px;">
<?php
echo "<script>";
  $disc_cnt=0;$isrree= zen_get_product_is_always_free_shipping((int)$_GET['products_id'])?1:0;
  foreach($quantityDiscounts as $key=>$quantityDiscount) {
  $disc_cnt++;
?>
discount[<?php echo $disc_cnt ?>] ="<?php echo $quantityDiscount['show_qty2'] ?>-<?php echo $currencies->noSymbolDisplayPrice($quantityDiscount['discounted_price'], zen_get_tax_rate($product_info->fields['products_tax_class_id'])); ?>-<?php echo $isrree;?>-0";
<?php }
echo "</script>";
?>

<?php
  if ($zc_hidden_discounts_on) {
?>
  <table border="0" cellspacing="0" cellpadding="0" id="table_info" >
    <tr>
      <td colspan="1" align="center">
      <?php echo TEXT_HEADER_DISCOUNTS_OFF; ?>      </td>
    </tr>
    <tr>
      <td colspan="1" align="center">
      <?php echo $zc_hidden_discounts_text; ?>      </td>
    </tr>
  </table>
<?php } else { ?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table_info22">
  <tr>
    <td scope="row"><table width="100%" height="53" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <th height="30" style="border-bottom:1px solid #DDDDDD; border-right:1px solid #DDDDDD; font-weight: bold;"  scope="row">Quantity</th>
      </tr>
      <tr>
        <th height="28" scope="row" style="border-right:1px solid #DDDDDD; font-weight: bold;">Price/Unit</th>
      </tr>
    </table></td>
		<?php
  foreach($quantityDiscounts as $key=>$quantityDiscount) {
?>
    <td><table width="100%" height="53" border="0" cellpadding="0" cellspacing="0">

      <tr>
        <th height="30" style="border-bottom:1px solid #DDDDDD; border-right:1px solid #DDDDDD;" scope="row"><?php echo $quantityDiscount['show_qty'] ?></th>
      </tr>
      <tr>
        <th height="28" scope="row" style="border-right:1px solid #DDDDDD; font-weight: normal; color:#EC6941;"><?php echo $currencies->display_price($quantityDiscount['discounted_price'], zen_get_tax_rate($products_tax_class_id)); ?></th>
      </tr>

	  
    </table></td><?php
    }
?>
<td scope="row"><table width="100%" height="53" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <th height="30" style="border-bottom:1px solid #DDDDDD;" scope="row">More</th>
      </tr>
      <tr>
        <th width="100%" height="28" align="center" style="font-weight: normal;" scope="row"><?php echo '<a href="javascript:popupWindow(\'' . zen_href_link ( 'large_order_inquiry', 'products_id=' . $_GET ['products_id'] ) . '\')"><img src="/images/root/whoi.gif"></a>'; ?></th>
      </tr>
    </table></td>
  </tr>
</table>

<?php } // hide discounts ?>
</ul>
