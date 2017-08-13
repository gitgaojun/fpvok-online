<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=about_us.<br />
 * Displays conditions page.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_about_us_default.php  v1.3 $
 */
 $column_box_default ='tpl_box_default_left.php';
?>
<div class="minframe fl" style="width:180px;">
<?php
require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/faq_categories_css.php'));
?>
</div>
<div class="right_big_con margin_t" style="border-left:1px solid #EEEEEE; width:800px; padding-left:15px; float:left;">
<div class="fl midframe_wide flow ">

    <div class="margin_t">
    <span class="mediumtext"><?php echo stripslashes($faq_metatags->fields['faq_categories_description']); ?>
    </span>   
    </div>

</div>
</div>