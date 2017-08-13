<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_products_new_default.php 2677 2005-12-24 22:30:12Z birdbrain $
 */

if ($linkMark = strpos ( $_SERVER ['REQUEST_URI'], '?' )) {
	$cleanUrl = substr ( $_SERVER ['REQUEST_URI'], 0, $linkMark );
} else {
	$cleanUrl = $_SERVER ['REQUEST_URI'];
}
function cleanSameArg($clean) {
	global $_GET, $cleanUrl;
	$newArg = array ();
	reset ( $_GET );
	while ( list ( $key, $value ) = each ( $_GET ) ) {
		if ($key != 'main_page' and $key != 'cPath' and $key != 'display' and $key != $clean) {
			$newArg [] = $key . '=' . $value;
		}
	}
	if (sizeof ( $newArg ) > 0) {
		return $cleanUrl . '?' . implode ( '&', $newArg );
	} else {
		return $cleanUrl;
	}
}

function cleanSameArgNoHtml($clean) {
	global $_GET, $cleanUrl;
	$newArg = array ();
	reset ( $_GET );
	while ( list ( $key, $value ) = each ( $_GET ) ) {
		if ($key != 'main_page' and $key != 'cPath' and $key != 'display' and $key != $clean) {
			$newArg [] = $key . '=' . $value;
		}
	}
	if (sizeof ( $newArg ) > 0) {
		return '&' . implode ( '&', $newArg );
	} else {
		return FALSE;
	}
}
function cleanSameArg2($clean, $clean2) {
	global $_GET, $cleanUrl;
	$newArg = array ();
	reset ( $_GET );
	while ( list ( $key, $value ) = each ( $_GET ) ) {
		if ($key != 'cPath' and $key != 'display' and $key != $clean and $key != $clean2) {
			$newArg [] = $key . '=' . $value;
		}
	}
	if (sizeof ( $newArg ) > 0) {
		return $cleanUrl . '?' . implode ( '&', $newArg );
	} else {
		return $cleanUrl;
	}
}
function postfixUrl() {
	global $_SERVER;
	$posbool = strpos ( $_SERVER ['REQUEST_URI'], '?' );
	return (is_int ( $posbool ) ? substr ( $_SERVER ['REQUEST_URI'], $posbool ) : '');
}
?>


<div class="right_big_con1 margin_t">
<div><img src="images/offer50.jpg" width="952"/></div>


  <?php
     $listTypes = 2;
		switch ($listTypes) {
			case '1' :
				require ($template->get_template_dir ( 'tpl_tabular_display.php', DIR_WS_TEMPLATE, $current_page_base, 'common' ) . '/tpl_tabular_display.php');
				break;
			case '2' :
				require ($template->get_template_dir ( 'tpl_grid_display.php', DIR_WS_TEMPLATE, $current_page_base, 'common' ) . '/tpl_grid_display.php');
				break;
			case '3' :
				require ($template->get_template_dir ( 'tpl_gallery_display.php', DIR_WS_TEMPLATE, $current_page_base, 'common' ) . '/tpl_gallery_display.php');
				break;
		}
		?>

<?php
if (($products_new_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
	?>
<div class="pagebar margin_t g_t_c white_bg">
<div class="split_pages">
<p class="listspan"><?php
	echo TEXT_RESULT_PAGE . ' ' . $products_new_split->display_links_version2 ( MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params ( array ('page', 'info', 'x', 'y' ) ) );
	?></p>
</div>
</div>
<?php
}
?>
<?php

// only end form if form is created
if ($show_top_submit_button == true or $show_bottom_submit_button == true) {
	?>
</form>
<?php
} // end if form is made ?>
</div>