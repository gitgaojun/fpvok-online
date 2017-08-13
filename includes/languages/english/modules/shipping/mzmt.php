<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 Josh Dechant                                      |
// |                                                                      |
// | Portions Copyright (c) 2004 The zen-cart developers                  |
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
// $Id: mzmt.php,v 1.000 2004-09-26 dreamscape Exp $
//
/*
  Create text & icons for geo zones and their tables following template below where
    $n = geo zone number (in the shipping module) and
    $j = table number

  MODULE_SHIPPING_MZMT_GEOZONE_$n_TEXT_TITLE
  MODULE_SHIPPING_MZMT_GEOZONE_$n_ICON
  MODULE_SHIPPING_MZMT_GEOZONE_$n_TABLE_$j_TEXT_WAY
  Sample is setup for a 3x3 table (3 Geo Zones with 3 Tables each)
*/

define('MODULE_SHIPPING_MZMT_TEXT_TITLE', 'MultiGeoZone MultiTable');
define('MODULE_SHIPPING_MZMT_TEXT_DESCRIPTION', 'Multiple geo zone shipping with multiple tables to each geo zone.');

define('MODULE_SHIPPING_MZMT_GEOZONE_1_TEXT_TITLE', 'Zone 1');
define('MODULE_SHIPPING_MZMT_GEOZONE_1_ICON', 'shipping_ups.gif');
define('MODULE_SHIPPING_MZMT_GEOZONE_1_TABLE_1_TEXT_WAY', '<B>EMS</B> <span class="red">(2-15days)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_1_TABLE_2_TEXT_WAY', '<B>HK DHL</B> <span class="red">(3-7days,Not apply packages with planes)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_1_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_MZMT_GEOZONE_2_TEXT_TITLE', 'Zone 2');
define('MODULE_SHIPPING_MZMT_GEOZONE_2_ICON', 'shipping_ups.gif');
define('MODULE_SHIPPING_MZMT_GEOZONE_2_TABLE_1_TEXT_WAY', '<B>EMS</B> <span class="red">(2-15days)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_2_TABLE_2_TEXT_WAY', '<B>HK DHL</B> <span class="red">(3-7days,Not apply packages with planes)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_2_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_MZMT_GEOZONE_3_TEXT_TITLE', 'Zone 3');
define('MODULE_SHIPPING_MZMT_GEOZONE_3_ICON', 'shipping_ups.gif');
define('MODULE_SHIPPING_MZMT_GEOZONE_3_TABLE_1_TEXT_WAY', '<B>EMS</B> <span class="red">(2-15days)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_3_TABLE_2_TEXT_WAY', '<B>HK DHL</B> <span class="red">(3-7days,Not apply packages with planes)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_3_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_MZMT_GEOZONE_4_TEXT_TITLE', 'Zone 4');
define('MODULE_SHIPPING_MZMT_GEOZONE_4_ICON', 'shipping_ups.gif');
define('MODULE_SHIPPING_MZMT_GEOZONE_4_TABLE_1_TEXT_WAY', '<B>EMS</B> <span class="red">(2-15days)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_4_TABLE_2_TEXT_WAY', '<B>HK DHL</B> <span class="red">(3-7days,Not apply packages with planes)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_4_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_MZMT_GEOZONE_5_TEXT_TITLE', 'Zone 5');
define('MODULE_SHIPPING_MZMT_GEOZONE_5_ICON', 'shipping_ups.gif');
define('MODULE_SHIPPING_MZMT_GEOZONE_5_TABLE_1_TEXT_WAY', '<B>EMS</B> <span class="red">(2-15days)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_5_TABLE_2_TEXT_WAY', '<B>HK DHL</B> <span class="red">(3-7days,Not apply packages with planes)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_5_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_MZMT_GEOZONE_6_TEXT_TITLE', 'Zone 6');
define('MODULE_SHIPPING_MZMT_GEOZONE_6_ICON', 'shipping_ups.gif');
define('MODULE_SHIPPING_MZMT_GEOZONE_6_TABLE_1_TEXT_WAY', '<B>EMS</B> <span class="red">(2-15days)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_6_TABLE_2_TEXT_WAY', '<B>HK DHL</B> <span class="red">(3-7days,Not apply packages with planes)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_6_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_MZMT_GEOZONE_7_TEXT_TITLE', 'Zone 7');
define('MODULE_SHIPPING_MZMT_GEOZONE_7_ICON', 'shipping_ups.gif');
define('MODULE_SHIPPING_MZMT_GEOZONE_7_TABLE_1_TEXT_WAY', '<B>EMS</B> <span class="red">(2-15days)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_7_TABLE_2_TEXT_WAY', '<B>HK DHL</B> <span class="red">(3-7days,Not apply packages with planes)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_7_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_MZMT_GEOZONE_8_TEXT_TITLE', 'Zone 8');
define('MODULE_SHIPPING_MZMT_GEOZONE_8_ICON', 'shipping_ups.gif');
define('MODULE_SHIPPING_MZMT_GEOZONE_8_TABLE_1_TEXT_WAY', '<B>EMS</B> <span class="red">(2-15days)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_8_TABLE_2_TEXT_WAY', '<B>HK DHL</B> <span class="red">(3-7days,Not apply packages with planes)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_8_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_MZMT_GEOZONE_9_TEXT_TITLE', 'Zone 9');
define('MODULE_SHIPPING_MZMT_GEOZONE_9_ICON', 'shipping_ups.gif');
define('MODULE_SHIPPING_MZMT_GEOZONE_9_TABLE_1_TEXT_WAY', '<B>EMS</B> <span class="red">(2-15days)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_9_TABLE_2_TEXT_WAY', '<B>HK DHL</B> <span class="red">(3-7days,Not apply packages with planes)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_9_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_MZMT_GEOZONE_10_TEXT_TITLE', 'Zone 10');
define('MODULE_SHIPPING_MZMT_GEOZONE_10_ICON', 'shipping_ups.gif');
define('MODULE_SHIPPING_MZMT_GEOZONE_10_TABLE_1_TEXT_WAY', '<B>EMS</B> <span class="red">(2-15days)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_10_TABLE_2_TEXT_WAY', '<B>HK DHL</B> <span class="red">(3-7days,Not apply packages with planes)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_10_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_MZMT_GEOZONE_11_TEXT_TITLE', 'Zone 11');
define('MODULE_SHIPPING_MZMT_GEOZONE_11_ICON', 'shipping_ups.gif');
define('MODULE_SHIPPING_MZMT_GEOZONE_11_TABLE_1_TEXT_WAY', '<B>EMS</B> <span class="red">(2-15days)</span><font class="red">26%</font>');
define('MODULE_SHIPPING_MZMT_GEOZONE_11_TABLE_2_TEXT_WAY', '<B>HK DHL</B> <span class="red">(3-7days,Not apply packages with planes)</span>');
define('MODULE_SHIPPING_MZMT_GEOZONE_11_TABLE_3_TEXT_WAY', 'Express Plus');

?>