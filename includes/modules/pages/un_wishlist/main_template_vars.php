<?php 

// Sort columns as defined
$wishlist = $oWishlist->getWishlist();
$products_query = $oWishlist->getProductsQuery();
$aSortOptions = $oWishlist->getSortOptions(isset($_GET['sort'])? $_GET['sort']: '');
$dispatch = $oWishlist->getDispatch();

if ( isset($_REQUEST['layout']) && $_REQUEST['layout'] == 's' ) {
	$listing_split = new splitPageResults($products_query, UN_MAX_DISPLAY_COMPACT);
	$tpl_page_body = 'tpl_un_wishlist_s.php';
	
} else {
	$listing_split = new splitPageResults($products_query, UN_MAX_DISPLAY_EXTENDED);
	$tpl_page_body = 'tpl_un_wishlist_default.php';
	
}

require($template->get_template_dir($tpl_page_body, DIR_WS_TEMPLATE, $current_page_base, 'templates') . '/' . $tpl_page_body);

?>