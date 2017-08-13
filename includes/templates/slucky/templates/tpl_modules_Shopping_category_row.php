<?php 
echo '<div>'.zen_get_banners_heard('Home_Top1').'</div>';

?>

<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_featured_products.php 2935 2006-02-01 11:12:40Z birdbrain $
 */

  require(DIR_WS_MODULES . zen_get_module_directory('Shopping_category_row.php'));
?>

<!-- bof: featured products  -->
<?php if ($zc_show_featured == true) { ?>

<?php
/**
 * require the list_box_content template to display the product
 */
  require($template->get_template_dir('tpl_Shopping_row_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_Shopping_row_display.php');
?>

<?php } ?>
<!-- eof: featured products  -->
