<?php
/**
 * history_viewed sidebox - displays view history products
 *
 * @package templateSystem
 * @copyright Copyright 2010-2013 Gold
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: history_viewed.php 2718 2010-4-22 06:42:39Z drbyte $
 */

// test if box should display
  if (isset($_COOKIE['recent_viewed']) and $_COOKIE['recent_viewed'] != '') {
    $recent_viewed = explode('_',$_COOKIE['recent_viewed']);
  }else{
  	$recent_viewed = '';
  }
  $show_recently_viewed = (is_array($recent_viewed) && count($recent_viewed) > 0);   
  if ($show_recently_viewed == true) {
		$title_link = false;
		require($template->get_template_dir('tpl_history_viewed.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_history_viewed.php');
		$title =  BOX_HEADING_HISTORY_VIEWED;
		require($template->get_template_dir('tpl_history_viewed.php', DIR_WS_TEMPLATE, $current_page_base,'common') . '/tpl_history_viewed.php');
  }
?>
