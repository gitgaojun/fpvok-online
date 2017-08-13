<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: banner_manager.php 3131 2006-03-07 22:53:04Z ajeh $
//

define('HEADING_TITLE', 'Banner Manager');

define('TABLE_HEADING_IMAGES_ID', 'ID');
define('TABLE_HEADING_IMAGES', 'Images');
define('TABLE_HEADING_IMAGES_TITLE', 'Title');
define('TABLE_HEADING_IMAGES_URL', 'Url');
define('TABLE_HEADING_BANNER_OPEN_NEW_WINDOWS','New Window');
define('TABLE_HEADING_BANNER_ON_SSL', 'Show SSL');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_BANNER_SORT_ORDER', 'Sort<br />Order');

define('TEXT_IMAGE_TITLE', 'Image Title:');
define('TEXT_IMAGE_URL', 'Image URL:');
define('TEXT_IMAGE', 'Image:');
define('TEXT_IMAGE_LOCAL', ', or enter local file below');
define('TEXT_BANNERS_BANNER_NOTE', '<b>Banner Notes:</b><ul><li>Use an image or HTML text for the banner - not both.</li><li>HTML Text has priority over an image</li><li>HTML Text will not register the click thru, but will register displays</li><li>Banners with absolute image URLs should not be displayed on secure pages</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>Image Notes:</b><ul><li>Uploading directories must have proper user (write) permissions setup!</li><li>Do not fill out the \'Save To\' field if you are not uploading an image to the webserver (ie, you are using a local (serverside) image).</li><li>The \'Save To\' field must be an existing directory with an ending slash (eg, banners/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>Expiry Notes:</b><ul><li>Only one of the two fields should be submitted</li><li>If the banner is not to expire automatically, then leave these fields blank</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Schedule Notes:</b><ul><li>If a schedule is set, the banner will be activated on that date.</li><li>All scheduled banners are marked as inactive until their date has arrived, to which they will then be marked active.</li></ul>');
define('TEXT_BANNERS_STATUS', 'Banner Status:');
define('TEXT_BANNERS_ACTIVE', 'Active');
define('TEXT_BANNERS_NOT_ACTIVE', 'Not Active');
define('TEXT_INFO_BANNER_STATUS', '<strong>NOTE:</strong> Banner status will be updated based on Scheduled Date and Impressions');
define('TEXT_BANNERS_OPEN_NEW_WINDOWS', 'Banner New Window');
define('TEXT_INFO_BANNER_OPEN_NEW_WINDOWS', '<strong>NOTE:</strong> Banner will open in a new window');
define('TEXT_BANNERS_ON_SSL', 'Banner on SSL');
define('TEXT_INFO_BANNER_ON_SSL', '<strong>NOTE:</strong> Banner can be displayed on Secure Pages without errors');

define('TEXT_BANNERS_DATE_ADDED', 'Date Added:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Scheduled At: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Expires At: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Expires At: <b>%s</b> impressions');
define('TEXT_BANNERS_STATUS_CHANGE', 'Status Change: %s');

define('TEXT_BANNERS_DATA', 'D<br>A<br>T<br>A');
define('TEXT_BANNERS_LAST_3_DAYS', 'Last 3 Days');
define('TEXT_BANNERS_BANNER_VIEWS', 'Banner Views');
define('TEXT_BANNERS_BANNER_CLICKS', 'Banner Clicks');

define('TEXT_INFO_DELETE_INTRO', 'Are you sure you want to delete this image?');
define('TEXT_INFO_DELETE_IMAGE', 'Delete image');

define('SUCCESS_IMAGE_INSERTED', 'Success: The Image has been inserted.');
define('SUCCESS_IMAGE_UPDATED', 'Success: The Image has been updated.');
define('SUCCESS_IMAGE_REMOVED', 'Success: The Image has been removed.');

define('ERROR_IMAGE_TITLE_REQUIRED', 'Error: Image title required.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: Target directory does not exist: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: Target directory is not writeable: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Error: Image does not exist.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Error: Image can not be removed.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Error: Unknown status flag.');
define('ERROR_IMAGE_REQUIRED', 'Error: Image required.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Error: Graphs directory does not exist. Please create a graphs directory example: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Error: Graphs directory is not writeable. This is located at: <strong>' . DIR_WS_ADMIN . 'images/graphs</strong>');

?>