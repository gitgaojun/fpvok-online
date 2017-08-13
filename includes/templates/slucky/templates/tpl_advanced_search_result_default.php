<?php

/**

 * Page Template

 *

 * Loaded automatically by index.php?main_page=advanced_search_result.<br />

 * Displays results of advanced search

 *

 * @package templateSystem

 * @copyright Copyright 2003-2005 Zen Cart Development Team

 * @copyright Portions Copyright 2003 osCommerce

 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0

 * @version $Id: tpl_advanced_search_result_default.php 4182 2006-08-21 02:11:37Z ajeh $

 */

   $column_box_default ='tpl_box_default_left.php';

   

  if($linkMark = strpos($_SERVER['REQUEST_URI'],'?')){

    $cleanUrl = substr($_SERVER['REQUEST_URI'],0,$linkMark);

  }else{

    $cleanUrl = $_SERVER['REQUEST_URI'];

  }

  function cleanSameArg($clean){

    global $_GET,$cleanUrl;

    $newArg = array();

    reset($_GET);

    while (list($key, $value) = each($_GET)) {

      if($key != 'cPath' and $key != 'display' and $key != $clean){

        $newArg[] = $key.'='.$value;        

      }

    }

    if(sizeof($newArg)>0){

      return $cleanUrl.'?'.implode('&',$newArg);

    }else{

      return $cleanUrl;

    }

  }

  function cleanSameArg2($clean,$clean2){

    global $_GET,$cleanUrl;

    $newArg = array();

    reset($_GET);

    while (list($key, $value) = each($_GET)) {

      if($key != 'cPath' and $key != 'display' and $key != $clean and $key != $clean2){

        $newArg[] = $key.'='.$value;        

      }

    }

    if(sizeof($newArg)>0){

      return $cleanUrl.'?'.implode('&',$newArg);

    }else{

      return $cleanUrl;

    }

  }

  function cleanSameArgNoHtml($clean){

    global $_GET,$cleanUrl;

    $newArg = array();

    reset($_GET);

    while (list($key, $value) = each($_GET)) {

      if($key != 'cPath' and $key != 'display' and $key != 'main_page' and $key != 'categories_id' and $key != $clean){

        $newArg[] = $key.'='.$value;        

      }

    }

    if(sizeof($newArg)>0){

      return '&'.implode('&',$newArg);

    }else{

      return FALSE;

    }

  }

  

  function postfixUrl(){

    global $_SERVER;

    $posbool = strpos($_SERVER['REQUEST_URI'],'?');

    return (is_int($posbool) ? substr($_SERVER['REQUEST_URI'],$posbool) : '');

  }

?>

<div class="minframe fl">

<?php

 //require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/box_contact_us.php'));

  //require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/popular_searches.php'));

  require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/vip_link.php'));

 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/search_categories.php'));



 //require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/customers_say.php'));

 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/history_viewed.php'));



?>

</div>

<div class="right_big_con">

<h2 class="border_b line_30px pad_l_100px"><?php echo HEADING_TITLE; ?></h2>

<?php

  if (($advanced_search_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {

?>



<?php

  }

?>
  <div class="shop_by_price c00">

                        <form action="<?php echo zen_href_link(FILENAME_DEFAULT, 'cPath=' . (int)$current_category_id); ?>" id="priceForm" method="get">
                            <span class="f13">Shop by Price </span>
                            <em class="current_currency">US$</em>
                            <input type="text" class="price_input" size="13" id="min_price" name="min_price" value="<?php echo $_GET['min_price'] ?>" maxlength="6">
                            <span class="pl5 f13">to </span>
                            <em class="current_currency">US$</em>
                            <input type="text" class="price_input" size="13" id="max_price" name="max_price" value="<?php echo $_GET['max_price'] ?>" maxlength="6">
                            <input type="submit" value="" class="pricego">
                       </form>
                    </div>
<div id="filter_view" class="listhead mt10">
                        <ul class="tabs fleft">
                            <li class="active fleft">
                                <a>All Items(<em id="all_item_count"><?php echo $advanced_search_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></em>)</a></li>
                            <li class="fleft">
                                <a href="<?php echo zen_href_link($current_page, zen_get_all_get_params(array('display','cPath')).'cPath=' . $current_category_id.'&display=Wholesale-Only-'.$listTypes);?>">Discount(<em id="discount_item_count">2</em>)</a></li>
                        </ul>
                        <div class="fleft mr10">
                            <span class="viewType fleft c00">View as
                                <a href="<?php echo zen_href_link(FILENAME_DEFAULT, zen_get_all_get_params(array('pagesize','cPath')).'cPath=' . $current_category_id.'&pagesize=36');?>" title="36">36</a>
                                <a href="<?php echo zen_href_link(FILENAME_DEFAULT, zen_get_all_get_params(array('pagesize','cPath')).'cPath=' . $current_category_id.'&pagesize=72');?>" class="ulink" title="72">72</a>
                            </span>
                            <a href="<?php echo zen_href_link(FILENAME_DEFAULT, zen_get_all_get_params(array('display','cPath')).'cPath=' . $current_category_id.'&display='.$displayTypes.'-2');?>" title="Grid View" class="iconvlist"></a>
                            <a href="<?php echo zen_href_link(FILENAME_DEFAULT, zen_get_all_get_params(array('display','cPath')).'cPath=' . $current_category_id.'&display='.$displayTypes.'-1');?>" title="List View" class="iconvimg"></a>
                        </div>
                        <div class="fright list_sort">
                            <span class="fleft fb">Sort by: </span>
                            <div class="fleft" id="list_sort">
                            <?php  switch($_GET['productsort']){
								      case 2:
									  $staa_name = 'Most Reviews';
									  break;
									  case 3:
									  $staa_name = 'Lowest Price';
									  break;
									  case 4:
									  $staa_name = 'Highest Price';
									  break;
									  case 5:
									  $staa_name = 'New Arrivals';
									  break;
									  case 9:
									  $staa_name = 'Top Sellers';
									  break;
									  default:
									  $staa_name = 'Recommended';
							} ?>
                                <a href="javascript:void(0);" class="cf50"><em><?php echo $staa_name; ?></em><span></span></a>
                                <div style="right: 0px; left: 0px; display: none;" class="sortByMenu">
                                    <a href="<?php echo zen_href_link(FILENAME_DEFAULT, zen_get_all_get_params(array('productsort','cPath')).'cPath=' . $current_category_id.'&productsort=1');?>" class="cf50">Recommended</a>
									<a href="<?php echo zen_href_link(FILENAME_DEFAULT, zen_get_all_get_params(array('productsort','cPath')).'cPath=' . $current_category_id.'&productsort=9');?>" class="cf50">Top Sellers</a>
                                    <a href="<?php echo zen_href_link(FILENAME_DEFAULT, zen_get_all_get_params(array('productsort','cPath')).'cPath=' . $current_category_id.'&productsort=5');?>" class="cf50">New Arrivals</a>
                                    <a href="<?php echo zen_href_link(FILENAME_DEFAULT, zen_get_all_get_params(array('productsort','cPath')).'cPath=' . $current_category_id.'&productsort=2');?>" class="cf50">Most Reviews</a>
                                    <a href="<?php echo zen_href_link(FILENAME_DEFAULT, zen_get_all_get_params(array('productsort','cPath')).'cPath=' . $current_category_id.'&productsort=4');?>" class="cf50">Highest Price</a>
                                    <a href="<?php echo zen_href_link(FILENAME_DEFAULT, zen_get_all_get_params(array('productsort','cPath')).'cPath=' . $current_category_id.'&productsort=3');?>" class="cf50">Lowest Price</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>


  <div class=" allborder1">

  <?php

  switch($listTypes){

      case '1':

        require($template->get_template_dir('tpl_tabular_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_tabular_display.php');

      break;

      case '2':

        require($template->get_template_dir('tpl_grid_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_grid_display.php');

      break;

      case '3':

        require($template->get_template_dir('tpl_gallery_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_gallery_display.php');

      break;

    }

    ?>

<?php if ( ($advanced_search_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {

?>

<div class="pagebar margin_t g_t_c white_bg"><div class="split_pages"><p class="listspan"><?php echo TEXT_RESULT_PAGE . ' ' . $advanced_search_split->display_links_version2(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></p></div></div>

</div>

<?php

  }

?>

<?php

// only end form if form is created

    if ($show_top_submit_button == true or $show_bottom_submit_button == true) {

?>

<?php } // end if form is made ?>

</div>





