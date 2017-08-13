<?php if(zen_has_category_subcategories($current_category_id)){
$product_in_categories_sql = '';
$product_in_categoriesArray = array();
zen_get_subcategories(&$product_in_categoriesArray,$current_category_id);
$product_in_categories_sql = implode(' or p.master_categories_id =',$product_in_categoriesArray);
$product_in_categories_sql = '( p.master_categories_id ='.$product_in_categories_sql.')';			
}else{
	$product_in_categories_sql = 'p.master_categories_id = ' . (int)$current_category_id;
}

$products_new_query_raw = "SELECT p.products_id,  pd.products_name, p.products_image, p.products_price,
                                    p.products_tax_class_id
                             FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                             WHERE p.products_status = 1 and ".$product_in_categories_sql."
                             AND p.products_id = pd.products_id
                             AND pd.language_id = " . (int)$_SESSION['languages_id'] . " order by p.products_id desc limit 7"  ;
 $products_new = $db->Execute($products_new_query_raw);
 if($products_new->RecordCount()>0){
	?>
<div id="bfd_product_bought" class="bfd_box2">
<div class="bfd_product_in"><div class="BoxBar">To recommend you</div>
<div class="pAlsobought"><div class="items p015">
<?php while (!$products_new->EOF) {
	$products_price = zen_get_products_display_final_price($products_new->fields['products_id']);
	$new_url = zen_href_link(zen_get_info_page($products_new->fields['products_id']), 'cPath=' . $productsInCategory[$products_new->fields['products_id']] . '&products_id=' . (int)$products_new->fields['products_id']);
	$pro_name = strlen($products_new->fields['products_name'])>40?substr($products_new->fields['products_name'],0,40).'...':$products_new->fields['products_name'];
	?>
<div style="margin-right:12px;" class="itembox ml15 mb20 h236"><ul class="infobox"><li><?php echo '<a href="' . zen_href_link(zen_get_info_page($products_new->fields['products_id']), 'cPath=' .zen_get_generated_category_path_rev($_GET['cPath']). '&products_id=' . $products_new->fields['products_id']) . '" class="ih4" >'; ?><?php echo str_replace("/s/","/l/",zen_image_OLD(DIR_WS_IMAGES .$products_new->fields['products_image'], $products_new->fields['products_name'], 155, 155, 'class=""')); ?></a></li><li class="proName f11"><?php echo '<a href="' . zen_href_link(zen_get_info_page($products_new->fields['products_id']), 'cPath=' .zen_get_generated_category_path_rev($_GET['cPath']). '&products_id=' . $products_new->fields['products_id']) . '" class="ih4" >'; ?><?php echo $pro_name ?></a></li><li class="proPri"><span class="cf50 f123"><?php echo $products_price; ?></span></li></ul></div>
<?php $products_new->MoveNext();
}?>
</div><div class="clear"></div></div></div></div>
<?php }?>