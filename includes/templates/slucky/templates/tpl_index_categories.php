<?php

/**

 * Page Template

 *

 * Loaded by main_page=index<br />

 * Displays category/sub-category listing<br />

 * Uses tpl_index_category_row.php to render individual items

 *

 * @package templateSystem

 * @copyright Copyright 2003-2006 Zen Cart Development Team

 * @copyright Portions Copyright 2003 osCommerce

 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0

 * @version $Id: tpl_index_categories.php 4678 2006-10-05 21:02:50Z ajeh $

 */



if(!$this_is_home_page){

	echo '<div class="minframe fl">';
	require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/categories.php'));
	require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/vip_link1.php'));
	require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/popular_searches.php'));
	echo '</div>';

}

?>
<?php if ($this_is_home_page){ ?>

<DIV class=menu_c><?php require($template->get_template_dir('tpl_ezpages_bar_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_ezpages_bar_header.php'); ?></DIV>

<?php }?>


<div class="right_big_con5">

<?php if ($this_is_home_page){ ?>

<?php require(DIR_WS_MODULES . 'sideboxes/'.$template_dir.'/flash_sidebox.php');?>

<?php }?>
<div>
<?php $index_categories_banner_query = "select c.categories_banner_1_img,c.categories_banner_2_img,c.categories_banner_1_link,c.categories_banner_2_link,cd.categories_name from ".TABLE_CATEGORIES." c LEFT JOIN categories_description cd ON c.categories_id = cd.categories_id  where c.categories_id = '".$current_category_id."'";
$index_categories_banner = $db->Execute($index_categories_banner_query);
if ($index_categories_banner->RecordCount()>0){
	$index_categories_banner_1_img = $index_categories_banner->fields['categories_banner_1_img'];
	$index_categories_banner_2_img = $index_categories_banner->fields['categories_banner_2_img'];
	$index_categories_banner_1_link = $index_categories_banner->fields['categories_banner_1_link'];
	$index_categories_banner_2_link = $index_categories_banner->fields['categories_banner_2_link'];
	$index_categories_banner_name = $index_categories_banner->fields['categories_name'];	
}?>

<?php

if(!$this_is_home_page && $categories_displayTypes == 1){
require($template->get_template_dir('tpl_modules_in_category_row.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_in_category_row.php');
}
if ($categories_displayTypes != 3){
	if(!$this_is_home_page && $categories_displayTypes == 2){
	// categories_description
	if ($current_categories_description != '') {
	?>
	<div class="cate_describe" id="cate_describe">
	<?php echo $current_categories_description;  ?></div>
	<div class="cate_list mauto mt20" id="conditionContent">
</div>
	<?php } // categories_description ?>
	<!-- BOF: Display grid of available sub-categories, if any -->
	<?php
	if(zen_has_category_subcategories($current_category_id)){
		$recommended_products_subcategories = array();
		zen_get_subcategories(&$recommended_products_subcategories,$current_category_id);
		$recommended_products_subcategories_str = implode(' or pt.categories_id = ',$recommended_products_subcategories);
		$suffix_sql = ' AND ( pt.categories_id ='.$recommended_products_subcategories_str.')';
	}else{
		$suffix_sql = ' AND pt.categories_id = \''.$current_category_id.'\'';
	}

	$recommended_products_sql = "SELECT p.`products_id`,p.`products_quantity`,p.`product_is_wholesale`,pd.`products_name`, p.`products_image`, p.`products_price`,p.`products_price_retail`,p.`products_price_sample` FROM featured f, products p, products_to_categories pt, products_description pd
	WHERE p.products_id=f.products_id AND p.`products_status` = 1 AND pt.products_id=p.products_id AND pd.products_id=f.products_id".$suffix_sql;

	$recommended_products = $db->Execute($recommended_products_sql);

	if($recommended_products->RecordCount()>0){
		while (!$recommended_products->EOF){
			$recommended_products_items[] = $recommended_products->fields;
			$recommended_products_id_con[]	= $recommended_products->fields['products_id'];
			$recommended_products_images_con[]	= '"'.(zen_not_null($recommended_products->fields['products_image']) ? $recommended_products->fields['products_image'] : PRODUCTS_IMAGE_NO_IMAGE ).'"';
			$recommended_products_source_price_con[]	= '"'.$currencies->display_price($recommended_products->fields['products_price_retail'],zen_get_tax_rate($product_check->fields['products_tax_class_id'])).'"';
			$recommended_products_price_con[]	= '"'.$currencies->display_price(($recommended_products->fields['products_price'] == 0 ? $recommended_products->fields['products_price_sample']: $recommended_products->fields['products_price']),zen_get_tax_rate($product_check->fields['products_tax_class_id'])).'"';
			$recommended_products_sub_name_con[]	= '"'.zen_clipped_string(addslashes(zen_output_string($recommended_products->fields['products_name'])),' ',18).'"';
			$recommended_products_name_con[]	= '"'.zen_output_string($recommended_products->fields['products_name']).'"';

			$sold_out_s = ($recommended_products->fields['products_quantity'] <= 0)? 1 : 0 ;
			$almost_sold_out_s = ( 0 < $recommended_products->fields['products_quantity'] and $recommended_products->fields['products_quantity'] <10)? 1 : 0;
			$product_count_s = 0;
			$sale_item_s = $recommended_products->fields['product_is_wholesale)'];
			$recommended_products_flg_con[] = '"'.$sold_out_s.'#'.$almost_sold_out_s.'#'.$product_count_s.'#'.$sale_item_s.'"';
			$recommended_products->MoveNext();
		}
		$recommended_products_id = implode(",", $recommended_products_id_con);
		$recommended_products_images = implode(",", $recommended_products_images_con);
		$recommended_products_source_price = implode(",", $recommended_products_source_price_con);
		$recommended_products_price = implode(",", $recommended_products_price_con);
		$recommended_products_sub_name = implode(",", $recommended_products_sub_name_con);
		$recommended_products_name = implode(",", $recommended_products_name_con);
		$recommended_products_flg = implode(",",$recommended_products_flg_con);
	}
	$recommended_display_num = ( count($recommended_products_items) > 4) ? count($recommended_products_items) : 4 ;
	}
}

?>
<!-- EOF: Display grid of available sub-categories -->
</div>

<?php
if (!$this_is_home_page && $categories_displayTypes != 1) {
	require($template->get_template_dir('tpl_modules_product_listing.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_product_listing.php');
}
if (COLUMN_RIGHT_STATUS == 0 || (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '') || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == '')) || !$this_is_home_page) {
$flag_disable_right = true;
}
?>
</div>

<?php if ($this_is_home_page){ ?>
<div class="therightframe fr"><?php require(DIR_WS_MODULES . zen_get_module_directory('column_right.php')); ?></div>
<?php }?>


<?php

if (!$this_is_home_page) {

	echo '<div class="right_big_con ">';

	?>

<!--bof-banner #5 display -->

<?php

	if (SHOW_BANNERS_GROUP_SET5 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET5)) {

    if ($banner->RecordCount() > 0) {

?>

<div class="right_big_con margin_t"><center><?php echo zen_display_banner('static', $banner); ?></center></div>

<?php

    }

  }

?>

<!--eof-banner #5 display -->



<?php	

	echo '</div>';

	echo '<div class="right_big_con">';

	//require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/related_categories.php'));

	//require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/search_feedback.php'));

	echo '</div><div class="right_big_con"></div>';

	if ($current_bottom_categories_description != ''){

    echo '<div class="right_big_con margin_t allborder"><div class="pad_10px">';

    echo '<h3 class="border_b line_30px">More Info About '.zen_get_category_name($current_category_id,$_SESSION['languages_id']).'</h3>';

		echo $current_bottom_categories_description;

		echo '</div></div>';

	}

	echo '</div>';

}

?>

