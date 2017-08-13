<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_featured.php 6128 2007-04-08 04:53:32Z birdbrain $
 */
  $content = "";
  $featured_box_counter = 0;
  $content .= '<table cellpadding="3">' . "\n";
  while (!$random_featured_product->EOF) {
    $featured_box_counter++;
	$content .= '<li>';
    $featured_box_price = zen_get_products_display_final_price($random_featured_product->fields['products_id']);
    $content .= '';
    $content .=  '<a  href="' . zen_href_link(zen_get_info_page($random_featured_product->fields["products_id"]), 'cPath=' . zen_get_generated_category_path_rev($random_featured_product->fields["master_categories_id"]) . '&products_id=' . $random_featured_product->fields["products_id"]) . '">' . str_replace("/s/","/l/",zen_image(DIR_WS_IMAGES . $random_featured_product->fields['products_image'], SEO_COMMON_KEYWORDS . ' ' .$random_featured_product->fields['products_name'], 180, 140)); 
    $content .= '</a></br><span class="line_120"><a href="' . zen_href_link(zen_get_info_page($random_featured_product->fields["products_id"]), 'cPath=' . zen_get_generated_category_path_rev($random_featured_product->fields["master_categories_id"]) . '&products_id=' . $random_featured_product->fields["products_id"]) . '">' . substr($random_featured_product->fields['products_name'],0,40) . '</a><br>'.$featured_box_price.'</span></li>'. "\n";
    //FEATURED: Change MoveNextRandom to MoveNext
    $random_featured_product->MoveNext();
  }
  $content .= '</table>';
?>