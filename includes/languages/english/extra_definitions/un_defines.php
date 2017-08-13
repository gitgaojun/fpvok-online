<?php 

// control multiple wishlist functionality
define('UN_ALLOW_MULTIPLE_WISHLISTS', true);
define('UN_DISPLAY_CATEGORY_FILTER', false);

// template header
define('UN_HEADER_TITLE_WISHLIST', 'Wish List');

// wishlist sidebox
define('UN_BOX_HEADING_WISHLIST', 'Wish List');
define('UN_BUTTON_IMAGE_WISHLIST_ADD', 'wishlist_add.gif');
define('UN_BUTTON_WISHLIST_ADD_ALT', 'Add to Wish List');
define('UN_BOX_WISHLIST_ADD_TEXT', 'Click to add this product to your Wish List.');
define('UN_BOX_WISHLIST_LOGIN_TEXT', '<p><a href="' . zen_href_link(FILENAME_LOGIN, '', 'NONSSL') . '">Log In</a> to be able to add this product to your Wish List.</p>');

// control form
define('UN_TEXT_SORT', 'Sort');
define('UN_TEXT_SHOW', 'Show');
define('UN_TEXT_VIEW', 'View');
define('UN_TEXT_ALL_CATEGORIES', 'All Categories');

// more
define('UN_TEXT_ADD_WISHLIST', 'Add to Wishlist');
define('UN_TEXT_REMOVE_WISHLIST', 'Remove from Wishlist');
define('UN_BUTTON_IMAGE_SAVE', BUTTON_IMAGE_UPDATE);
define('UN_BUTTON_SAVE_ALT', BUTTON_UPDATE_ALT);
define('UN_TEXT_EMAIL_WISHLIST', 'Tell a Friend');
define('UN_TEXT_FIND_WISHLIST', 'Find a Friend\'s Wish List');
define('UN_TEXT_NEW_WISHLIST', 'Create a new Wish List');
define('UN_TEXT_MANAGE_WISHLISTS', 'Manage my Wish Lists');
define('UN_TEXT_WISHLIST_MOVE', 'Move items between Wish Lists');

define('UN_TEXT_PRIORITY', 'Priority');
define('UN_TEXT_DATE_ADDED', 'Date Added');
define('UN_TEXT_QUANTITY', 'Quantity');
define('UN_TEXT_COMMENT', 'Comment');

define('UN_TEXT_PRIORITY_0', '0 - Don\'t buy this for me');
define('UN_TEXT_PRIORITY_1', '1 - I\'m thinking about it');
define('UN_TEXT_PRIORITY_2', '2 - Like to have');
define('UN_TEXT_PRIORITY_3', '3 - Love to have');
define('UN_TEXT_PRIORITY_4', '4 - Must have');

// product lists
define('UN_TEXT_NO_PRODUCTS', 'No products currently in list.');
define('UN_MAX_DISPLAY_EXTENDED', 10);
define('UN_MAX_DISPLAY_COMPACT', 20);
define('UN_TEXT_COMPACT', 'Compact');
define('UN_TEXT_EXTENDED', 'Extended');

// general
define('UN_LABEL_DELIMITER', ': ');
define('UN_TEXT_REMOVE', 'Remove');
define('UN_EMAIL_SEPARATOR', "-------------------------------------------------------------------------------\n");
define('UN_TEXT_DATE_AVAILABLE', 'Date Available: %s');
define('UN_TEXT_FORM_FIELD_REQUIRED', '*');

// tables
define('UN_TABLE_HEADING_PRODUCTS', 'Products Name');
define('UN_TABLE_HEADING_PRICE', 'Price');
define('UN_TABLE_HEADING_BUY_NOW', 'Cart');
define('UN_TABLE_HEADING_QUANTITY', 'Qty');
define('UN_TABLE_HEADING_WISHLIST', 'Wishlist');
define('UN_TABLE_HEADING_SELECT', 'Select');


?>