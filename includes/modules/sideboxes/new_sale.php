<div id="" class="margin_t">
<h4 class="leftBoxBar">News Products</h4>
<ul style="width: 182px;" class="history_view allborder no_border_t fl">
<?php 

if(zen_has_category_subcategories($current_category_id)){
$product_in_categories_sql = '';
$product_in_categoriesArray = array();
zen_get_subcategories(&$product_in_categoriesArray,$current_category_id);
$product_in_categories_sql = implode(' or p.master_categories_id =',$product_in_categoriesArray);
$product_in_categories_sql = '( p.master_categories_id ='.$product_in_categories_sql.')';			
}else{
	$product_in_categories_sql = 'p.master_categories_id = ' . (int)$current_category_id;
}
      $new_sellers_query = "select p.products_id, p.products_image, pd.products_name, p.products_price, p.products_ordered
                             from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                             where p.products_status = '1'
                             and p.products_id = pd.products_id
                             and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                             and " . $product_in_categories_sql . "
                             order by p.products_id desc
                             limit 5";
  
   $new_sellers = $db->Execute($new_sellers_query);

 while (!$new_sellers->EOF) {
	 $products_price = zen_get_products_display_price($new_sellers->fields['products_id']);
?>
<li>
<?php echo '<a href="' . zen_href_link(zen_get_info_page($new_sellers->fields['products_id']), 'cPath=' . $productsInCategory[$new_sellers->fields['products_id']] . '&products_id=' . (int)$new_sellers->fields['products_id']) . '" class="ih" >' . zen_image(DIR_WS_IMAGES . $new_sellers->fields['products_image'], zen_get_products_name($new_sellers->fields['products_id']), 50, 50,' ') . '</a>'; ?>
<span><?php echo '<a href="' . zen_href_link(zen_get_info_page($new_sellers->fields['products_id']), 'cPath=' . $productsInCategory[$new_sellers->fields['products_id']] . '&products_id=' . $new_sellers->fields['products_id']) . '">' . substr($new_sellers->fields['products_name'],0,28)  . '...</a>'; ?><br /><strong class="red" style="padding-left:10px;"><?php echo $products_price ?></strong></span>
</li>
<?php 
$new_sellers->MoveNext();
}?>
</ul></div>
<br class="clear" />