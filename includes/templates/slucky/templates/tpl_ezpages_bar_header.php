<?php
/**
 * Page Template
 *
 * Displays EZ-Pages Header-Bar content.<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_ezpages_bar_header.php 3377 2006-04-05 04:43:11Z ajeh $
 */

  /**
   * require code to show EZ-Pages list
   */
  include(DIR_WS_MODULES . zen_get_module_directory('ezpages_bar_header.php'));
?>
<?php if (sizeof($var_linksList) >= 1) { ?>
<?php 
$ii=1;
$is_home=true;
for ($i=1, $n=sizeof($var_linksList); $i<=$n; $i++) { 

  $current_link = substr($var_linksList[$i]['link'],strrpos($var_linksList[$i]['link'],'/')+1);
  
  $current_link = substr($current_link,0,strpos($current_link,'.'));

  if ($current_page == $current_link ) {
  $is_home=false;
  }

}


$ii=1;
for ($i=1, $n=sizeof($var_linksList); $i<=$n; $i++) { 

  $current_link = substr($var_linksList[$i]['link'],strrpos($var_linksList[$i]['link'],'/')+1);
  
  $current_link = substr($current_link,0,strpos($current_link,'.'));

  if ($current_page == $current_link ) {
  $class = '11 nav_hover'; 
  }else{ 
  $class = '';
  }
  
  if(($this_is_home_page || ($is_home)) && $ii==1 ){
  $class = 'nav_hover'; 
  }
$ii++; 
   
  ?> 
   
<li class="nav_<?php echo $ii; ?> <?php echo $class; ?>"><a href="<?php echo $var_linksList[$i]['link']; ?>"><?php echo $var_linksList[$i]['name']; ?></a><?php echo $strt; ?></li>


<?php  } // end FOR loop ?>
<?php } ?>

<div class="welcometopmenu">Welcome to FPVOK.com</div>
<div class="welcometopmenu"><?php echo zen_get_customer_name($_SESSION['customer_id']); ?></div>