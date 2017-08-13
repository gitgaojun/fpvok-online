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

  $content = '<ul class="ul_recently alignL">' . "\n";
  $it =1;
  foreach ($recent_viewed as $recent_product) {
  
   if($it <4){
	$link = zen_href_link(zen_get_info_page($recent_product), 'products_id=' . $recent_product);
	$content .= '<li class="recently_li">' . "\n" . 
				  '<span class="rview_spic"><a class="ih fl" href="' .  $link . '">' . zen_get_products_image($recent_product, '45', '45') . '</a></span>' . "\n" . 
				  '<span class="rview_name"><a href="' . $link . '">' . zen_get_products_name($recent_product, $_SESSION['languages_id']) . '</a></span>' . "\n" . 
				 '</li>';
				 }
	$it++;			
  }
     
  $content .= '</ul>';
?>