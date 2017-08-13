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

  MODULE_SHIPPING_DHL_GEOZONE_$n_TEXT_TITLE
  MODULE_SHIPPING_DHL_GEOZONE_$n_ICON
  MODULE_SHIPPING_DHL_GEOZONE_$n_TABLE_$j_TEXT_WAY
  Sample is setup for a 3x3 table (3 Geo Zones with 3 Tables each)
*/

define('MODULE_SHIPPING_DHL_TEXT_TITLE', 'DHL');
define('MODULE_SHIPPING_DHL_TEXT_DESCRIPTION', 'Multiple geo zone shipping with multiple tables to each geo zone.');

define('MODULE_SHIPPING_DHL_GEOZONE_1_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_1_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_1_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_2_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_2_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_2_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_2_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_2_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_2_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_2_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_3_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_3_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_3_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_3_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_3_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_4_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_4_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_4_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_4_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_4_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_5_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_5_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_5_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_5_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_5_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_6_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_6_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_6_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_6_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_6_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_7_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_7_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_7_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_7_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_7_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_8_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_8_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_8_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_8_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_8_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_9_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_9_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_9_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_9_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_9_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_10_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_10_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_10_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_10_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_10_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_11_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_11_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_11_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_11_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_11_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_12_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_12_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_12_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_12_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_12_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_13_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_13_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_13_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_13_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_13_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_14_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_14_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_14_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_14_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_14_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_15_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_15_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_15_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_15_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_15_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_16_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_16_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_16_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_16_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_16_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_17_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_17_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_17_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_17_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_17_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_18_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_18_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_18_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_18_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_18_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_19_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_19_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_19_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_19_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_19_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_20_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_20_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_20_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_20_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_20_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_21_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_21_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_21_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_21_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_21_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_22_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_22_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_22_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_22_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_22_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_23_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_23_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_23_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_23_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_23_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_24_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_24_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_24_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_24_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_24_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_25_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_25_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_25_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_25_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_25_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_26_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_26_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_26_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_26_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_26_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_27_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_27_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_27_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_27_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_27_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_28_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_28_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_28_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_28_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_28_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_29_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_29_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_29_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_29_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_29_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_30_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_30_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_30_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_30_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_30_TABLE_3_TEXT_WAY', 'Express Plus');

define('MODULE_SHIPPING_DHL_GEOZONE_31_TEXT_TITLE', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_31_ICON', 'shipping_dhl.gif');
define('MODULE_SHIPPING_DHL_GEOZONE_31_TABLE_1_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_31_TABLE_2_TEXT_WAY', 'DHL(3-7 work days,Airlane cannot be shipped by DHL)');
define('MODULE_SHIPPING_DHL_GEOZONE_31_TABLE_3_TEXT_WAY', 'Express Plus');
?>