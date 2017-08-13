<?php 
$retail_price = $currencies->display_price(0,0);

$jsPricet = zen_get_products_special_price($_GET['products_id']) > 0 ? zen_get_products_special_price($_GET['products_id']) : zen_get_products_base_price($_GET['products_id']);


?>
<script type="text/javascript">
function ChangCheckbox(){	
	var price =<?php echo $currencies->noSymbolDisplayPrice($jsPricet,0); ?>;
	var inttoal =0;
	var save_price =0;
	var ddd = "<?php echo $currencies->display_symbol_left ( $_SESSION ['currency'] ); ?>";
	jQuery("input[type=checkbox]:checked").each(function() {
		
		price+=parseFloat(jQuery(this).attr("price"));
		save_price+=parseFloat(jQuery(this).attr("saveprice"));
		inttoal+=parseFloat(jQuery(this).attr("value"));
	});
	jQuery("#alltyingprice").html(ddd+" "+ price.toFixed(2));
	jQuery("#typriceall").html(ddd+" "+ price.toFixed(2));
	jQuery("#marktying").html(ddd+"" +save_price.toFixed(2));
	jQuery("#tcount").html(inttoal +" items selected together");
}

</script>
<?php if (strlen(trim($accessories_product)) >2) { ?>
<div>

    <div class="pj_wxpj_t2">
        Frequently Bought Together:
    </div>
	<div class="pj_wxpj_t4">
     
     
       <?php $pro_img = explode(",",$products_image);?>
        <div class="pj_wxpj_t4_lft"><div class="pj_wxpj_t4_lftdiv"><?php echo zen_image_OLD( str_replace("/s/","/l/",HTTP_SERVER . DIR_WS_CATALOG.DIR_WS_IMAGES.$pro_img[0]), SEO_COMMON_KEYWORDS . ' ' .addslashes($products_name), '120', '120',''); ?></div></div>
		<div class="plus_product">plus</div>
		<div class="pj_wxpj_t4_rht">
		<ul style="width: 826px;" id="ul-peijian">
      <?php 
$strmd = explode("#",$accessories_product);
for($im=0;$im<count($strmd);$im++) {
$flash_page_query_8 = "select p.products_id,p.products_image,pd.products_name from " . TABLE_PRODUCTS ." p, ". TABLE_PRODUCTS_DESCRIPTION . " pd where p.`products_id`=pd.`products_id` AND p.products_id = '" . (int)$strmd[$im] ."'";
$flash_page8 = $db->Execute($flash_page_query_8);
$jsPrice=zen_get_products_price_accessories($flash_page8->fields['products_id']);
$baseprice = zen_get_products_base_price($flash_page8->fields['products_id']);
$bspecialprice = zen_get_products_special_price($flash_page8->fields['products_id']);
$totla_count = $bspecialprice >0?($bspecialprice-$jsPrice):($baseprice-$jsPrice);
?>
            
			
             <li>
             <a href="<?php echo zen_href_link(zen_get_info_page($flash_page8->fields['products_id']), 'products_id=' . $flash_page8->fields['products_id']);?>"><?php echo 
str_replace("/s/","/l/",zen_image(DIR_WS_IMAGES.$flash_page8->fields['products_image'],SEO_COMMON_KEYWORDS.' '.$flash_page8->fields['products_name'] ,90,90, ''));?></a>
                    <h3><?php echo $flash_page8->fields['products_name'];?></h3>
                    
                
                <input type="checkbox" value="1" price="<?php echo $currencies->noSymbolDisplayPrice($jsPrice,0) ?>" saveprice="<?php echo $currencies->noSymbolDisplayPrice($totla_count,0) ?>" onClick="ChangCheckbox();" name="products_id[<?php echo $flash_page8->fields['products_id']; ?>]">
                <span><?php echo $currencies->display_price($jsPrice,0); ?></span>
             </li>
<?php 
}
?>       
</ul></div>     
     
     <div class="bdjiar">
      <div>
 
       <li>Total Price:<span id="alltyingprice"><?php echo $currencies->display_price($jsPricet,0); ?></span></li>
      </div>
      <ul>
       <li>Save Price:<span id="marktying"><?php echo $retail_price; ?></span></li>
      
       <li><input type="image" title="Add to Cart" alt="Add to Cart" class="add_c" src="includes/templates/slucky/images/buyto.jpg"></li>
      </ul>
     </div>
  <div class="clear"></div>
</div>
</div>
<?php }?>