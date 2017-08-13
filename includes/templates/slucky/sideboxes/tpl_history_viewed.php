<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2010-2012 Gold
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_history_viewed.php 2982 2010-04-22 $
 */

  $content = '<ul class="history_view no_border_t fl">' . "\n";
  foreach ($recent_viewed as $recent_product) {
	$link = zen_href_link(zen_get_info_page($recent_product), 'products_id=' . $recent_product);
	$content .= '<li>' . "\n" . 
				  '<a class="ih4" href="' .  $link . '">' . zen_get_products_image($recent_product, '50', '50') . '</a>' . "\n" . 
				  '<span><a href="' . $link . '">'.substr(zen_get_products_name($recent_product, $_SESSION['languages_id']),0,25) . '...</a></span>' . "\n" . 
				 '</li>';
  }
  $content .= '</ul>';
?>