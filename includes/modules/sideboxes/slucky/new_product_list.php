<?php
/**
 * Links Box
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_links_box.php 3.4.0 3/27/2008 Clyde Jones $
 */
 ?>
<div id="whatsnew" class="leftBoxContainer">
<h3 id="whatsnewHeading" class="red line_30px qing leftBoxBar1">New Products</h3>
<div class="border_ts1 qinf" align="center">
<table width="100%" height="40" border="0" cellpadding="0" cellspacing="2">
<?php  
  $display_limit = zen_get_new_date_range();
  $random_whats_newt = "select p.products_id, p.products_image, p.products_tax_class_id, p.products_price, pd.products_name,
                           p.master_categories_id
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = pd.products_id
                           and p.products_status = 1 order by p.products_id desc limit 5";

//  $random_whats_new_product = zen_random_select($random_whats_newt);
  $random_whats_new_product = $db->Execute($random_whats_newt);
  
  if($random_whats_new_product->RecordCount()>0){
  $whats_new_box_counter = 0;
  while (!$random_whats_new_product->EOF) {
    $whats_new_box_counter++;
    $whats_new_price = zen_get_products_display_price($random_whats_new_product->fields['products_id']);
    $content8 .= '<tr><td align="center">';
    $content8 .= '<a href="' . zen_href_link(zen_get_info_page($random_whats_new_product->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($random_whats_new_product->fields['master_categories_id']) . '&products_id=' . $random_whats_new_product->fields['products_id']) . '">' . str_replace("/s/","/l/",zen_image(DIR_WS_IMAGES . $random_whats_new_product->fields['products_image'], SEO_COMMON_KEYWORDS . ' ' .$random_whats_new_product->fields['products_name'], 150, 150)) .'</a></td><tr>';
    $content8 .= '<tr><td style="padding-left:10px;"><a href="' . zen_href_link(zen_get_info_page($random_whats_new_product->fields['products_id']), 'cPath=' . zen_get_generated_category_path_rev($random_whats_new_product->fields['master_categories_id']) . '&products_id=' . $random_whats_new_product->fields['products_id']) . '">' . $random_whats_new_product->fields['products_name'] . '</a><br><img border="0" src="/images/freepic.gif"></td>';

    $content8 .= '</tr><tr><td style="padding-left:10px;color: #CC0000; font-weight:bold; font-size:13px">'.$currencies->display_price($random_whats_new_product->fields['products_price'],zen_get_tax_rate($random_whats_new_product->fields['products_tax_class_id'])).'<img src="images/xcart.gif" align="absmiddle"><br>'.zen_get_reviewst($_GET ['products_id']) .'</td></tr>';
    $random_whats_new_product->MoveNext();
  }
                }
	echo $content8;
				
?>
</table>
</div>
</div>