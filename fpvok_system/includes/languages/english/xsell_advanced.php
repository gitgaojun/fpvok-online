<?php
/**
 * Cross Sell products
 *
 * Derived from:
 * Original Idea From Isaac Mualem im@imwebdesigning.com <mailto:im@imwebdesigning.com>
 * Portions Copyright (c) 2002 osCommerce
 * Complete Recoding From Stephen Walker admin@snjcomputers.com
 * Released under the GNU General Public License
 *
 * Adapted to Zen Cart by Merlin - Spring 2005
 * Reworked for Zen Cart v1.3.0  03-30-2006
 *
 * Reworked again to change/add more features by yellow1912
 * Pay me a visit at RubikIntegration.com
 *
 */
define('HEADING_TITLE', '高级Cross-Sell (X-Sell)管理');
define('TEXT_PRODUCT_ID', '产品'.XSELL_FORM_INPUT_TYPE);


define('TEXT_CROSS_SELL', 'Cross-Sell');

define('CROSS_SELL_SORT_ORDER_UPDATED', '更新以下产品的排序： %s');
define('CROSS_SELL_SORT_ORDER_NOT_UPDATED', '没有更新排序！');
define('CROSS_SELL_NO_INPUT_FOUND', '请输入至少 %d个产品的ids/models到cross-sell');
define('CROSS_SELL_NO_MAIN_FOUND', '请输入主要产品的'.XSELL_FORM_INPUT_TYPE);
define('CROSS_SELL_ALREADY_ADDED', '该立品 %s已经被添加到产品%s');
define('CROSS_SELL_ADDED', '产品%s已经作为Cross-Sell添加到产品%s');
define('CROSS_SELL_PRODUCT_DELETED', '%s Cross-Sell(s)成功删除。');
define('CROSS_SELL_PRODUCT_NOT_DELETED', '没有Cross-Sell被删除。');
define('CROSS_SELL_PRODUCT_NOT_FOUND', '没发现带有'.XSELL_FORM_INPUT_TYPE.'的产品: %s');
define('CROSS_SELL_CLEANED_UP', '%s cross-sell(s)清理');
define('CROSS_SELL_PRODUCT_DUPLICATE','%s 和 %s 有相同的产品id');
define('CROSS_SELL_CLEAN_UP_DELETED_PRODUCTS','删除的产品的cross-sell(s)清理');
define('CROSS_SELL_CLEAN_UP_DELETED_PRODUCTS_TEXT','如果想清理cross-sell表记得运行这里！');
?>