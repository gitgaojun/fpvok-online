<?php
/**
 * Common Template - tpl_footer.php
 *
 * this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * make a directory /templates/my_template/privacy<br />
 * copy /templates/templates_defaults/common/tpl_footer.php to /templates/my_template/privacy/tpl_footer.php<br />
 * to override the global settings and turn off the footer un-comment the following line:<br />
 * <br />
 * $flag_disable_footer = true;<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_footer.php 4821 2006-10-23 10:54:15Z drbyte $
 */
require(DIR_WS_MODULES . zen_get_module_directory('footer.php'));
?>

<?php 
if($this_is_home_page){
require($template->get_template_dir('tpl_modules_layer_switch.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_layer_switch.php'); 
}

 ?>


<?php
if (!isset($flag_disable_footer) || !$flag_disable_footer) {

?>

<?php if (!$this_is_home_page){ ?>

<?php 



  if(isset($_GET['main_page'])&&($_GET['main_page']=='product_info'||$_GET['main_page']=='products_new'||$_GET['main_page']=='best_deal'||$_GET['main_page']=='shippinginfo'||$_GET['main_page']=='life_style'||$_GET['main_page']=='brands'||$_GET['main_page']=='faq_info'||$_GET['main_page']=='low_price'||$_GET['main_page']=='affiliate'||$_GET['main_page']=='faq_cpach'))
  {
  
  }
  else 
  {
    require('includes/modules/top_recommend.php'); 
	
  }
?>
<?php
if(isset($_GET['main_page'])&&($_GET['main_page']=='low_price'||$_GET['main_page']=='life_style'||$_GET['main_page']=='brands'||$_GET['main_page']=='faq_info'||$_GET['main_page']=='shippinginfo'||$_GET['main_page']=='faq_cpach'||$_GET['main_page']=='affiliate'))

{
  
  }
  else 
  {
  
  
require('includes/languages/english/html_includes/define_page_5.php'); 
  }
?>
<?php }?>

<?php require('includes/languages/english/html_includes/define_foot_link.php'); ?>


<?php
} // flag_disable_footer
?>


