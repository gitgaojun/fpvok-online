<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_main_product_image.php 3208 2006-03-19 16:48:57Z birdbrain $
 */
?>
<?php require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_MAIN_PRODUCT_IMAGE)); ?>
<script type="text/javascript">
jQuery(function() {

    // big
    var options =
    {
        zoomWidth: 350,
        zoomHeight: 350,
        showEffect:'show',
        hideEffect:'fadeout',
        fadeoutSpeed: 'slow',
        title :false
    }
    jQuery(".jqzoom").jqzoom(options);

});
</script>


  <!-- BOF Product Flash-->
<div style="width:280px;" class="fl margin_t">

<?php
if(is_array($products_image_medium)){
  ?>
   <ul style="margin-left:10px; width:280px;">
   <li><?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . $products_image_large[0]. '" class="jqzoom" id="product_flash_show" target="_blank">' . zen_image_OLD($products_image_large[0], addslashes($products_name), '280', '280','id="product_flash_show_i" class="relative"') . '</a>'; ?>
   </li>
   </ul>
   
   <ul style="width:250px; text-align:center">
      <span class="p_f_en"> <a href="<?php echo zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id']); ?>" id="product_flash_show_a" onclick="return popupwin(this.href,'popup_image',500,580,'resizable=0,scrollbars=0,toolbar=0,status=0')">View Larger Image</a> </span>
    </ul>
	
    <ul id="product_flash_btn">
  <?php
  $products_image_mediumNum = count($products_image_medium);
  for($i = 0 ;$i <$products_image_mediumNum;$i++){
  	 if($i+1 == $products_image_mediumNum){
  ?>
      <li class=""><img src="<?php echo DIR_WS_CATALOG . $products_image_large[$i]; ?>" border="0"  title="<?php echo 'wholesale/' . $products_image_small[$i];?>" alt="<?php echo 'wholesale/' . $products_image_small[$i];?>" width="42" height="42" num="<?php echo $i;?>" imgSize="280" big="<?php echo DIR_WS_CATALOG . $products_image_large[$i]; ?>"/></li>
      
  <?php
     }else{?>
      <li><img src="<?php echo DIR_WS_CATALOG . $products_image_large[$i]; ?>" border="0"  title="<?php echo 'wholesale/' . $products_image_small[$i];?>" alt="<?php echo 'wholesale/' . $products_image_small[$i];?>" width="42" height="42" num="<?php echo $i;?>" imgSize="280" big="<?php echo DIR_WS_CATALOG . $products_image_large[$i]; ?>"/></li>
     <?php }} ?>
    </ul>
    <script>initBtn('product_flash_btn','product_flash_show');</script>
<?php
  }else{
  ?>

   <ul>
   <li ><?php echo '<a href="' . DIR_WS_CATALOG . $products_image_large. '" class="jqzoom" id="product_flash_show" target="_blank">' . zen_image_OLD($products_image_medium, addslashes($products_name), '280', '280','id="product_flash_show_i"') . '</a>'; ?>
   </li>
  </ul>
   <ul style="width:240px; text-align:center">
      <span class="p_f_en"> <a href="<?php echo zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['products_id']); ?>" id="product_flash_show_a" onclick="return popupwin(this.href,'popup_image',500,580,'resizable=0,scrollbars=0,toolbar=0,status=0')">View Larger Image</a> </span>
    </ul>
  <ul id="product_flash_btn">
    </ul>


<?php
  }
?>
  </div>
  <!-- EOF Product Flash-->
</div>
