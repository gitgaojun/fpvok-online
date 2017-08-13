<?php

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

switch ($_GET['action']) {

// (un): start mod for Wishlist v0.4

// Add item to wishlist
		case 'un_add_wishlist':
		    
			if ($_SESSION['customer_id'] && isset($_GET['products_id'])) {

				// use wishlist class
				require_once(DIR_WS_CLASSES . 'un_wishlist.class.php');
				$oWishlist = new un_wishlist($_SESSION['customer_id']);
				$oWishlist->addProduct($_GET['products_id']);
				
			}
			zen_redirect(zen_href_link(UN_FILENAME_WISHLIST));
			break;

// Remove item from wishlist
		case 'un_remove_wishlist':
			if ($_SESSION['customer_id'] && isset($_GET['products_id'])) {

				// use wishlist class
				require_once(DIR_WS_CLASSES . 'un_wishlist.class.php');
				$oWishlist = new un_wishlist($_SESSION['customer_id']);
				$oWishlist->removeProduct($_GET['products_id']);
				
			}
			zen_redirect(zen_href_link(UN_FILENAME_WISHLIST));
			break;

// Update wishlist							
		case 'un_update_wishlist':
			$cart_updated = false;
			for ($i=0; $i<sizeof($_POST['products_id']); $i++) {

				// use wishlist class
				require_once(DIR_WS_CLASSES . 'un_wishlist.class.php');
				$oWishlist = new un_wishlist($_SESSION['customer_id']);
				$oWishlist->updateProduct((int)$_POST['products_id'][$i], (int)$_POST['wishlist_quantity'][$i], (int)$_POST['priority'][$i], $_POST['comment'][$i]);
				
				if ( in_array($_POST['products_id'][$i], (is_array($_POST['add_to_cart']) ? $_POST['add_to_cart'] : array())) && $_POST['wishlist_quantity'][$i] != 0 ) {
					$cart_updated = true;
					$_SESSION['cart']->add_cart($_POST['products_id'][$i], $_SESSION['cart']->get_quantity(zen_get_uprid($_POST['products_id'][$i], ''))+$_POST['wishlist_quantity'][$i], '');
				}
				if ( in_array($_POST['products_id'][$i], (is_array($_POST['wishlist_delete']) ? $_POST['wishlist_delete'] : array())) or $_POST['wishlist_quantity'][$i] == 0 ) {
					$oWishlist->removeProduct((int)$_POST['products_id'][$i]);
				}
				
			}
			if ( $cart_updated == true ) {
				zen_redirect(zen_href_link($goto, zen_get_all_get_params($parameters)));
			} else {
				zen_redirect(zen_href_link(UN_FILENAME_WISHLIST, zen_get_all_get_params($parameters)));
			}
			break;
  
// (un): end mod for Wishlist v0.4
}

?>