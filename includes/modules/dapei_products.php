<?php 
$retail_price = $currencies->display_price(zen_get_products_retail_price ((int)$_GET ['products_id']),0);

$jsPricet = zen_get_products_special_price($_GET['products_id']) > 0 ? zen_get_products_special_price($_GET['products_id']) : zen_get_products_base_price($_GET['products_id']);?>
<script type="text/javascript">
function ChangCheckbox(){	
	var price =<?php echo $currencies->noSymbolDisplayPrice($jsPricet,0); ?>;
	var inttoal =0;
	var save_price =0
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
<?php $pro_img = explode(",",$products_image);
$strmd = explode("#",$accessories_product);?>
<div style="margin-top:10px; float:left;">
    <div class="pj_wxpj_t2">
        Frequently Bought Together:
    </div>
    <div class="pj_wxpj_t4">
        <div class="pj_wxpj_t4_lft">
            <div class="pj_wxpj_t4_lftdiv">
                <a href="javascript: void(0)">
                   <?php echo zen_image_OLD( str_replace("/s/","/l/",HTTP_SERVER . DIR_WS_CATALOG.DIR_WS_IMAGES.$pro_img[0]), SEO_COMMON_KEYWORDS . ' ' .addslashes($products_name), '135', '185',''); ?>
                </a>
            </div>
        </div>
        <div class="plus_product"></div>
        <div class="pj_wxpj_t4_rht">
<ul style="width: <?php echo (count($strmd)*120); ?>px;" id="ul-peijian">
<?php 

$sa_price =0;
for($im=0;$im<count($strmd);$im++) {
$flash_page_query_8 = "select p.products_id,p.products_image,pd.products_name from " . TABLE_PRODUCTS ." p, ". TABLE_PRODUCTS_DESCRIPTION . " pd where p.`products_id`=pd.`products_id` AND p.products_id = '" . (int)$strmd[$im] ."'";

$flash_page8 = $db->Execute($flash_page_query_8);
if($flash_page8->RecordCount()>0){
$jsPrice=zen_get_products_price_accessories($flash_page8->fields['products_id']);
$baseprice = zen_get_products_base_price($flash_page8->fields['products_id']);
$bspecialprice = zen_get_products_special_price($flash_page8->fields['products_id']);
$totla_count = $bspecialprice >0?$bspecialprice:$baseprice;
$save_price = $bspecialprice >0?($bspecialprice-$jsPrice):($baseprice-$jsPrice);
?>
                                <li>
                     <a href="<?php echo zen_href_link(zen_get_info_page($flash_page8->fields['products_id']), 'products_id=' . $flash_page8->fields['products_id']);?>">
                       <?php echo 
str_replace("/s/","/l/",zen_image_OLD(DIR_WS_IMAGES.$flash_page8->fields['products_image'],SEO_COMMON_KEYWORDS.' '.$flash_page8->fields['products_name'] ,90,123, ''));?>
                    </a>
                    <h3><a href="<?php echo zen_href_link(zen_get_info_page($flash_page8->fields['products_id']), 'products_id=' . $flash_page8->fields['products_id']);?>"><?php echo substr($flash_page8->fields['products_name'] ,0,40). '...';?></a></h3>
                                        <p>
                        <del>
                            <?php echo $currencies->display_price($totla_count,0); ?>
                        </del></br><span class="zhekou_c">-<?php echo number_format($save_price/$jsPrice,2)*100; ?>%</span>
                    </p>
                                        <p class="bdjia">
                         <input type="checkbox" value="1" price="<?php echo $currencies->noSymbolDisplayPrice($jsPrice,0) ?>" saveprice="<?php echo $currencies->noSymbolDisplayPrice($save_price,0) ?>" onClick="ChangCheckbox();" name="products_id[<?php echo $flash_page8->fields['products_id']; ?>]">
                        <span><?php echo $currencies->display_price($jsPrice,0); ?></span>
                    </p>
                </li>
<?php 
}
}
?> 
                            </ul>
        </div>
        <div class="bdjiar">
            <p>
                Total price:
                <span id="typriceall" style="font-size: 14px; font-weight: bold; color:#EC6941;"><?php echo $currencies->display_price($jsPricet,0); ?></span>
            </p>
            <p>
                You Save:
                <strong id="marktying" style="font-size: 14px; font-weight: bold; color:#EC6941;"><?php echo $currencies->display_price($sa_price,0); ?></strong>
            </p>
			<p style="padding:10px 0px 0px 2px;cursor: pointer;"><input name="" type="image" src="images/buyto.jpg"/></p>
        </div>
            <div style="clear: both;"></div>
    </div>
</div>
<?php }?>