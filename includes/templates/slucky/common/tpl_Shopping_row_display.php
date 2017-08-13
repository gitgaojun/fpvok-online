<?php
/**
 * Common Template - tpl_columnar_display.php
 *
 * This file is used for generating tabular output where needed, based on the supplied array of table-cell contents.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_columnar_display.php 3157 2006-03-10 23:24:22Z drbyte $
 */

?>

<?php 
$orders_history_query = "select cd.categories_name,cd.categories_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_type = 3 and c.categories_id = cd.categories_id and cd.language_id ='" . (int)$_SESSION['languages_id'] . "' and c.categories_status = 1 limit 13";
    $orders_history = $db->Execute($orders_history_query);

    if ($orders_history->RecordCount() > 0) {
      while (!$orders_history->EOF) {
	  $cPath_new2 = zen_get_path($orders_history->fields['categories_id']);
	  $cPath_new2 = str_replace('=0_', '=', $cPath_new2);
?>
<div class="hotitem bt_border mt10 Recommended_item fr">
<div class="hotitem_h"><?php echo '<span class="fb fleft">Recommended '.$orders_history->fields['categories_name'].'</span>'; ?>
<?php echo '<a  class="fright mr10 f11" href="' . zen_href_link(FILENAME_DEFAULT, $cPath_new2) . '">More</a>'; ?></div>
<div class="hotitem_m alignL">
<ul>
<?php
$current_category_id = $orders_history->fields['categories_id'];
if(zen_has_category_subcategories($current_category_id)){
$product_in_categories_sql = '';
$product_in_categoriesArray = array();
zen_get_subcategories(&$product_in_categoriesArray,$current_category_id);
$product_in_categories_sql = implode(' or p.master_categories_id =',$product_in_categoriesArray);
$product_in_categories_sql = '( p.master_categories_id ='.$product_in_categories_sql.')';			
}else{
	$product_in_categories_sql = 'p.master_categories_id = ' . (int)$current_category_id;
}

$orders_history_query_t = "select p.products_id,p.master_categories_id,p.products_image,p.product_is_always_free_shipping,p.products_price,pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and ".$product_in_categories_sql." and pd.language_id ='" . (int)$_SESSION['languages_id'] . "' order by p.products_id asc limit 4";
    $orders_history_t = $db->Execute($orders_history_query_t);

    if ($orders_history_t->RecordCount() > 0) {
	    while (!$orders_history_t->EOF) { 
		$cPath_new = zen_get_path($orders_history_t->fields['master_categories_id']);
?>
<li class="border_b1">
<?php $products_price = zen_get_products_display_final_price($orders_history_t->fields['products_id']);
$strcatalog = '<a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath=' . (int)$orders_history_t->fields['master_categories_id']) . '">>>' .substr( zen_get_category_name($orders_history_t->fields['master_categories_id'],1),0,30) . '</a>';
?>
<?php echo '<span class="imgss"><a class="ih4" href="'. zen_href_link(zen_get_info_page($orders_history_t->fields['products_id']), 'cPath=' . $productsInCategory[$orders_history_t->fields['products_id']] . '&products_id=' . (int)$orders_history_t->fields['products_id']).'">' . str_replace("/s/","/l/",zen_image(DIR_WS_IMAGES . $orders_history_t->fields['products_image'], SEO_COMMON_KEYWORDS . ' ' .$orders_history_t->fields['products_name'], 165, 128,' class="fl"')) . '</a>' ?><br />
<?php echo '<a href="' . zen_href_link(zen_get_info_page($orders_history_t->fields['products_id']), 'cPath=' . $productsInCategory[$orders_history_t->fields['products_id']] . '&products_id=' . (int)$orders_history_t->fields['products_id']). '">' . substr($orders_history_t->fields['products_name'],0,50) .'...' . '</a><br><img border="0" src="/images/freepic.gif"><br>'.$strcatalog.'<br>'.'<strong class="b red g_t_c" style="color:#FF5A00; font-weight: normal;" >' . $products_price .'</strong></span>';?>
</li>
<?php 
$orders_history_t->MoveNext();
}
}	
?>
</ul>
</div>
</div>
<?php
$orders_history->MoveNext();
}
}	
?>
