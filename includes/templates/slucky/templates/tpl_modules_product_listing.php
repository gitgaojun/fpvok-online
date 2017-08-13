<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_product_listing.php 3241 2006-03-22 04:27:27Z ajeh $
 */
 include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_PRODUCT_LISTING));
?>
<?php
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
			if($key != 'main_page' and $key != 'cPath' and $key != $clean){
				$newArg[] = $key.'='.$value;				
			}
    }
    if(sizeof($newArg)>0){
    	return $cleanUrl.'?'.implode('&',$newArg);
    }else{
    	return $cleanUrl;
    }
	}
	function postfixUrl(){
		global $_SERVER;
		$posbool = strpos($_SERVER['REQUEST_URI'],'?');
		return (is_int($posbool) ? substr($_SERVER['REQUEST_URI'],$posbool) : '');
	}
	$pattern = "([[:space:]]|[[:blank:]])+";  
	?>
  <?php require('includes/modules/cat_att.php');?>
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
                            <li class="fleft <?php if ($_GET['dicount']!=1) echo "active"; ?>">
                                <a href="<?php echo zen_href_link($current_page, zen_get_all_get_params(array('display','cPath')).'cPath=' . $current_category_id.'');?>">All Items(<em id="all_item_count"><?php echo $listing_split->number_of_rows; ?></em>)</a></li>
                            <li class="fleft <?php if ($_GET['dicount']==1) echo "active"; ?>">
                                <a href="<?php echo zen_href_link($current_page, zen_get_all_get_params(array('display','cPath')).'cPath=' . $current_category_id.'&dicount=1');?>">Discount(<em id="discount_item_count"><?php echo $listing_split->number_of_rows; ?></em>)</a></li>
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
<div class="allborder1">
<?php if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {
?>



<?php if($current_page == 'index') {?>
	
	
	<?php
	switch($listTypes){
	    case '2':
	      require($template->get_template_dir('tpl_grid_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_grid_display.php');
	    break;
	    case '3':
	      require($template->get_template_dir('tpl_gallery_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_gallery_display.php');
	    break;
	    default:
	      require($template->get_template_dir('tpl_tabular_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_tabular_display.php');
	    break;
	  }
	}else{
	      require($template->get_template_dir('tpl_tabular_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_tabular_display.php');
	}
}else{
	echo '<div class="error_box maxwidth" style="width:500px;">In categories no products</div>';
}
?>

<?php if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
<div class="pagebar margin_t g_t_c white_bg"><div class="split_pages"><span>Pages: </span><p class="listspan"><?php echo  ' ' . $listing_split->display_links_version2(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></p></div></div>
<?php
  }
?>

<?php
// only show when there is something to submit and enabled
    if ($show_bottom_submit_button == true) {
?>
<div class="pad_10px fr"><?php echo zen_image_submit(BUTTON_IMAGE_ADD_PRODUCTS_TO_CART, BUTTON_ADD_PRODUCTS_TO_CART_ALT, 'id="submit2" name="submit1"'); ?></div>
<br class="clear" />
<?php
    } // show_bottom_submit_button
?>
</div>

<?php
// if ($show_top_submit_button == true or $show_bottom_submit_button == true or (PRODUCT_LISTING_MULTIPLE_ADD_TO_CART != 0 and $show_submit == true and $listing_split->number_of_rows > 0)) {
  if ($show_top_submit_button == true or $show_bottom_submit_button == true) {
?>
</form>
<?php } ?>
