<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_shippinginfo_default.php 3464 2006-04-19 00:07:26Z ajeh $
 */
?>
<div class="right_big_con2 margin_t" id="shippinginfo">
<?php echo TEXT_INFORMATION; ?>
<?php staticCategoriesList(DROPSHIP_CATEGORIES_LIST,'Dropship'); ?>
<br class="clear"/>
<?php if (DEFINE_SHIPPINGINFO_STATUS >= 1 and DEFINE_SHIPPINGINFO_STATUS <= 2) { ?>
<div id="shippingInfoMainContent" class="content">
<?php
  require($define_page);
?>
</div>
<?php } ?>

</div>
