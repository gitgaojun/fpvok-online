<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=PRODUCTTAGS.<br />
 * Displays conditions page.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_PRODUCTTAGS_default.php  v1.3 $
 */
$breadcrumb->trail ( $_GET ['letter'] );
?>
<?php

if (! isset ( $_GET ['letter'] )) {
	?>
<div class="minframe fl">
	<?php
	
	//require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/box_contact_us.php'));
	require (DIR_WS_MODULES . zen_get_module_directory ( 'sideboxes/ezpages.php' ));
	require (DIR_WS_MODULES . zen_get_module_directory ( 'sideboxes/' . $template_dir . '/subscribe.php' ));
	?>
	</div>
<div class="right_big_con margin_t">
<?php
} else {
	?>
	<div class="clear"></div>
<div class="margin_t">
<?php
}
?>


<ul class="letter_1px g_t_c big line_30px">
<?php
// display productTagList
echo "<strong class='red'>Search by: </strong>|";
foreach ( range ( 'a', 'z' ) as $letter ) {
	echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'producttags/' . strtoupper ( $letter ) . '/" >' . strtoupper ( $letter ) . '</a> | ';
}
echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'producttags/0-9/" >0-9</a> ';
?> 
</ul>
<?php
if ($_GET ['letter'] == '0-9') {
	$producttags_split_sql = "select p.`products_id`,pd.`products_name` from " . TABLE_PRODUCTS . " p," . TABLE_PRODUCTS_DESCRIPTION . " pd where p.`products_id` = pd.`products_id` AND LEFT(pd.`products_name`,1) REGEXP '^[0-9]'";
} else {
	$producttags_split_sql = "select p.`products_id`,pd.`products_name` from " . TABLE_PRODUCTS . " p," . TABLE_PRODUCTS_DESCRIPTION . " pd where p.`products_id` = pd.`products_id` AND LEFT(pd.`products_name`,1) LIKE '" . strtolower ( $_GET ['letter'] ) . "'";
}
$products_names_handle = $db->Execute ( $producttags_split_sql );
$products_name_text = '';
$products_tags_arr = array ();
$products_nottags_arr = array ();
$products_words_arr = array ();
$producttags_final_arr = array ();
if ($products_names_handle->RecordCount () > 0) {
	while ( ! $products_names_handle->EOF ) {
		$products_name_text = $products_name_text . $products_names_handle->fields ['products_name'] . ' ';
		$products_names_handle->MoveNext ();
	}
	$products_words_arr = array_unique ( explode ( ' ', $products_name_text ) );
	foreach ( $products_words_arr as $pn ) {
		//var_dump(ereg('[0-9]',substr($pn,0,1)));
		if ($pn != '' && $pn != '(' && $pn != ')' && strtolower ( $pn ) != 'and' && strtolower ( $pn ) != 'or' && strtolower ( $pn ) != 'where') {
			$pn = str_replace ( '(', '', $pn );
			$pn = str_replace ( ')', '', $pn );
			$pn = str_replace ( '&', '', $pn );
			$pn = str_replace ( '>', '', $pn );
			$pn = str_replace ( '<', '', $pn );
			if ($_GET ['letter'] != '0-9') {
				if (strtolower ( substr ( $pn, 0, 1 ) ) == strtolower ( $_GET ['letter'] )) {
					$products_tags_arr [] = $pn;
				} else {
					$products_nottags_arr [] = $pn;
				}
			} else {
				if (ereg ( '[0-9]', substr ( $pn, 0, 1 ) )) {
					$products_tags_arr [] = $pn;
				} else {
					$products_nottags_arr [] = $pn;
				}
			}
		}
	}
	asort ( $products_tags_arr );
	if (count ( $products_tags_arr )) {
		foreach ( $products_tags_arr as $ptaIndex => $ptaVal ) {
			for($i = 0; $i < count ( $products_nottags_arr ); $i ++) {
				$producttags_final_arr [] = $ptaVal . ' ' . $products_nottags_arr [$i];
				$producttags_final_arr [] = $ptaVal . ' ' . $products_nottags_arr [$i] . ' ' . $products_nottags_arr [$ptaIndex + 1];
				$producttags_final_arr [] = $ptaVal . ' ' . $products_nottags_arr [$i] . ' ' . $products_nottags_arr [$ptaIndex + 1] . ' ' . $products_nottags_arr [$ptaIndex + 2];
				$producttags_final_arr [] = $ptaVal . ' ' . $products_nottags_arr [$i] . ' ' . $products_nottags_arr [$ptaIndex + 1] . ' ' . $products_nottags_arr [$ptaIndex + 2] . ' ' . $products_nottags_arr [$ptaIndex + 3];
				if ($i > 200) {
					break;
				}
			}
		}
	}
}
$producttags_split = new splitPageResults_by_array ( $producttags_final_arr, 100, 'page' );
?>
<ul class="a_z_grid">
<?php
$productsNameString = '';
if (count ( $producttags_final_arr ) > 0) {
	for($p = $producttags_split->rows_left_offset; $p < $producttags_split->rows_right_offset; $p ++) {
		echo '<li><a href="wholesaletags/' . str_replace(' ','-',trim($producttags_final_arr [$p])) . '.html">' . $producttags_final_arr [$p] . '</a></li>';
		//		$productsNameString = $productsNameString.$producttags->fields['products_name'];
	}
} else {
	if (! in_array ( $_GET ['letter'], range ( 'a', 'z' ) ) && $_GET ['letter'] != '0-9') {
		zen_redirect ( zen_href_link ( FILENAME_DEFINE_PAGE_NOT_FOUND ) );
	}
	//zen_redirect(zen_href_link(FILENAME_DEFINE_PAGE_NOT_FOUND));
	echo '<div style="text-align:center"><div class="error_box" style="width:300px;text-align:center; margin:0 auto;">Sorry,This is Tags "' . $_GET ['letter'] . '" no Container Products</div></div>';
}
?>
</ul><?php //	print_r($productsNameString);	?>
<?php //print_r(zen_get_all_get_params(array('page', 'info', 'x', 'y'))); 
?>
<?php

if (($producttags_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
	?>
<div class="pages"><?php
	echo TEXT_RESULT_PAGE . ' ' . $producttags_split->no_current_display_links ( $producttags_split->number_of_pages, zen_get_all_get_params ( array ('page', 'info', 'x', 'y' ) ) );
	?></div>
<?php
}
?>
<div class="clear margine_t"></div>
<ul class="letter_1px g_t_c big line_30px">
<?php
// display productTagList
echo "<span class='red'>Search by: </span>|";
foreach ( range ( 'a', 'z' ) as $letter ) {
	echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'producttags/' . strtoupper ( $letter ) . '/" >' . strtoupper ( $letter ) . '</a> | ';
}
echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . 'producttags/0-9/" >0-9</a> ';
?> 
</ul>
</div>