<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 Gold                          |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |                             |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: new_arrivals.php 4533 2010-04-15 $
//

define('HEADING_TITLE', 'New Arrivals');

define('TABLE_HEADING_PRODUCTS', 'Products');
define('TABLE_HEADING_PRODUCTS_MODEL','Model');
define('TABLE_HEADING_PRODUCTS_PRICE', 'Products Price/Special/Sale');
define('TABLE_HEADING_PRODUCTS_PERCENTAGE','Percentage');
define('TABLE_HEADING_AVAILABLE_DATE', 'Available');
define('TABLE_HEADING_EXPIRES_DATE','Expires');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Action');

//NEW_ARRIVALS: These 2 defines added for new arrivals table in admin section
define('TABLE_HEADING_SORT_ORDER','Sort');
define('TEXT_NEW_ARRIVALS_SORT_ORDER', 'Sort Order:');


define('TEXT_NEW_ARRIVALS_PRODUCT', 'Product:');
define('TEXT_NEW_ARRIVALS_EXPIRES_DATE', 'Expiry Date:');
define('TEXT_NEW_ARRIVALS_AVAILABLE_DATE', 'Available Date:');

define('TEXT_INFO_DATE_ADDED', 'Date Added:');
define('TEXT_INFO_LAST_MODIFIED', 'Last Modified:');
define('TEXT_INFO_NEW_PRICE', 'New Price:');
define('TEXT_INFO_ORIGINAL_PRICE', 'Original Price:');
define('TEXT_INFO_PERCENTAGE', 'Percentage:');
define('TEXT_INFO_AVAILABLE_DATE', 'Available On:');
define('TEXT_INFO_EXPIRES_DATE', 'Expires At:');
define('TEXT_INFO_STATUS_CHANGE', 'Status Change:');
define('TEXT_IMAGE_NONEXISTENT', 'No Image Exists');

define('TEXT_INFO_HEADING_DELETE_NEW_ARRIVALS', 'Delete New Arrival');
define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete the new arrival?');

define('SUCCESS_NEW_ARRIVALS_PRE_ADD', 'Successful: Pre-Add of New Arrivals ... please update the dates ...');
define('WARNING_NEW_ARRIVALS_PRE_ADD_EMPTY', 'Warning: No Product ID specified ... nothing was added ...');
define('WARNING_NEW_ARRIVALS_PRE_ADD_DUPLICATE', 'Warning: Product ID already on Special ... nothing was added ...');
define('WARNING_NEW_ARRIVALS_PRE_ADD_BAD_PRODUCTS_ID', 'Warning: Product ID is invalid ... nothing was added ...');
define('TEXT_INFO_HEADING_PRE_ADD_NEW_ARRIVALS', 'Manually add new New Arrival by Product ID');
define('TEXT_INFO_PRE_ADD_INTRO', 'On large databases, you may Manually Add a New Arrival by the Product ID<br /><br />This is best used when the page takes too long to render and trying to select a Product from the dropdown becomes difficult due to too many Products from which to choose.');
define('TEXT_PRE_ADD_PRODUCTS_ID', 'Please enter the Product ID to be Pre-Added: ');
define('TEXT_INFO_MANUAL', 'Product ID to be Manually Added as a New Arrival');
?>