<?php
/**
 * layer_switch at specials_index module
 *
 * @package modules
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: specials_index.php 6424 2007-05-31 05:59:21Z ajeh $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

// initialize vars


//free

$featured_hot_categories_products_id_list = '';
$featured_hot_list_of_products = '';
$featured_hot_index_query = '';
$featured_hot_display_limit = '';

if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
  $featured_hot_index_query = "select p.products_id, p.products_image, pd.products_name,p.master_categories_id,p.products_quantity
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_FEATURED_HOT . " f on p.products_id = f.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = f.products_id
                           and p.products_id = pd.products_id
                           and p.products_status = 1
                           and f.status = 1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by f.sort_order";
} else {
  // get all products and cPaths in this subcat tree
  $productsInCategory = zen_get_categories_products_list( (($manufacturers_id > 0 && $_GET['filter_id'] > 0) ? zen_get_generated_category_path_rev($_GET['filter_id']) : $cPath), false, true, 0, $display_limit);

  if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
    // build products-list string to insert into SQL query
    foreach($productsInCategory as $key => $value) {
      $featured_hot_list_of_products .= $key . ', ';
    }
    $featured_hot_list_of_products = substr($featured_hot_list_of_products, 0, -2); // remove trailing comma
    $featured_hot_index_query = "select p.products_id, p.products_image, pd.products_name,
                                       p.master_categories_id,p.products_quantity
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_FEATURED_HOT . " f on p.products_id = f.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = f.products_id
                           and p.products_id = pd.products_id
                           and p.products_status = 1
                           and f.status = 1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by f.sort_order";
  }
}
if ($featured_hot_index_query != '') $featured_hot_index = $db->Execute($featured_hot_index_query, 10);

$row = 0;
$col = 0;
$featured_hot_list_box_contents = array();
$featured_hot_title = '';

$num_products_count = ($featured_hot_index_query == '') ? 0 : $featured_hot_index->RecordCount();

// show only when 1 or more
if ($num_products_count > 0) {
  $featured_hot_list_box_contents = array();
  while (!$featured_hot_index->EOF) {
    $products_price = zen_get_products_display_final_price($featured_hot_index->fields['products_id']);
	if($featured_hot_index->fields['products_quantity']>10){
		$str_stroe = '<img src="images/available.png" align="absmiddle">&nbsp;Available';
	}elseif($featured_hot_index->fields['products_quantity']>0){
		$str_stroe = '<img src="images/fewstore.png" align="absmiddle">&nbsp;Few stocks';
	}else{
		$str_stroe = '<img src="images/needorder.png" align="absmiddle">&nbsp;Need Order';
	}
    if (!isset($productsInCategory[$featured_hot_index->fields['products_id']])) $productsInCategory[$featured_hot_index->fields['products_id']] = zen_get_generated_category_path_rev($featured_hot_index->fields['master_categories_id']);

    $featured_hot_index->fields['products_name'] = strlen(zen_get_products_name($featured_hot_index->fields['products_id']))>40 ? substr(zen_get_products_name($featured_hot_index->fields['products_id']),0,40).'' : zen_get_products_name($featured_hot_index->fields['products_id']);
    $featured_hot_list_box_contents[$row][$col] = array('params' => '',
    'text' => ''.(($featured_hot_index->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : '<span><a href="' . zen_href_link(zen_get_info_page($featured_hot_index->fields['products_id']), 'cPath=' . $productsInCategory[$featured_hot_index->fields['products_id']] . '&products_id=' . (int)$featured_hot_index->fields['products_id']) . '" class="ih4" >' . str_replace("/s/","/l/", zen_image(DIR_WS_IMAGES .$featured_hot_index->fields['products_image'], zen_get_products_name($featured_hot_index->fields['products_id']), 180, 180,' class="fl"')) . '</a>') . '</span><span class="CategoryDetails"><a href="' . zen_href_link(zen_get_info_page($featured_hot_index->fields['products_id']), 'cPath=' . $productsInCategory[$featured_hot_index->fields['products_id']] . '&products_id=' . $featured_hot_index->fields['products_id']) . '">' . $featured_hot_index->fields['products_name'] . '</a></span><span class="b red1">' . $products_price.'<em class="instorefr">'.$str_stroe.'</em></span>');

    $col ++;
    if ($col > 4) {
      $col = 0;
      $row ++;
    }
    $featured_hot_index->MoveNext();
  }
}
    $featured_hot_title = 'Hot Sale';
//free

$featured_categories_products_id_list = '';
$featured_list_of_products = '';
$featured_index_query = '';
$featured_display_limit = '';

if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
  $featured_index_query = "select p.products_id, p.products_image, pd.products_name,
                                       p.master_categories_id,p.products_quantity
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_FEATURED . " f on p.products_id = f.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = f.products_id
                           and p.products_id = pd.products_id
                           and p.products_status = 1
                           and f.status = 1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by f.sort_order";
} else {
  // get all products and cPaths in this subcat tree
  $productsInCategory = zen_get_categories_products_list( (($manufacturers_id > 0 && $_GET['filter_id'] > 0) ? zen_get_generated_category_path_rev($_GET['filter_id']) : $cPath), false, true, 0, $display_limit);

  if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
    // build products-list string to insert into SQL query
    foreach($productsInCategory as $key => $value) {
      $featured_list_of_products .= $key . ', ';
    }
    $featured_list_of_products = substr($featured_list_of_products, 0, -2); // remove trailing comma
    $featured_index_query = "select p.products_id, p.products_image, pd.products_name,
                                       p.master_categories_id,p.products_quantity
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_FEATURED . " f on p.products_id = f.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = f.products_id
                           and p.products_id = pd.products_id
                           and p.products_status = 1
                           and f.status = 1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by f.sort_order";
  }
}
if ($featured_index_query != '') $featured_index = $db->Execute($featured_index_query, 10);

$row = 0;
$col = 0;
$featured_list_box_contents = array();
$featured_title = '';

$num_products_count = ($featured_index_query == '') ? 0 : $featured_index->RecordCount();

// show only when 1 or more
if ($num_products_count > 0) {
  $featured_list_box_contents = array();
  while (!$featured_index->EOF) {
    $products_price = zen_get_products_display_final_price($featured_index->fields['products_id']);
	if($featured_index->fields['products_quantity']>10){
		$str_stroe = '<img src="images/available.png" align="absmiddle">&nbsp;Available';
	}elseif($featured_index->fields['products_quantity']>0){
		$str_stroe = '<img src="images/fewstore.png" align="absmiddle">&nbsp;Few stocks';
	}else{
		$str_stroe = '<img src="images/needorder.png" align="absmiddle">&nbsp;Need Order';
	}
	
    if (!isset($productsInCategory[$featured_index->fields['products_id']])) $productsInCategory[$featured_index->fields['products_id']] = zen_get_generated_category_path_rev($featured_index->fields['master_categories_id']);

    $featured_index->fields['products_name'] = strlen(zen_get_products_name($featured_index->fields['products_id']))>40 ? substr(zen_get_products_name($featured_index->fields['products_id']),0,40).'' : zen_get_products_name($featured_index->fields['products_id']);
    $featured_list_box_contents[$row][$col] = array('params' => '',
    'text' => ''.(($featured_index->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : '<span><a href="' . zen_href_link(zen_get_info_page($featured_index->fields['products_id']), 'cPath=' . $productsInCategory[$featured_index->fields['products_id']] . '&products_id=' . (int)$featured_index->fields['products_id']) . '" class="ih4" >' . str_replace("/s/","/l/", zen_image(DIR_WS_IMAGES .$featured_index->fields['products_image'], zen_get_products_name($featured_index->fields['products_id']), 180, 180,' class="fl"')) . '</a>') . '</span><span class="CategoryDetails"><a href="' . zen_href_link(zen_get_info_page($featured_index->fields['products_id']), 'cPath=' . $productsInCategory[$featured_index->fields['products_id']] . '&products_id=' . $featured_index->fields['products_id']) . '">' . $featured_index->fields['products_name'] . '</a></span><span class="b red1">' . $products_price.'<em class="instorefr">'.$str_stroe.'</em></span>');

    $col ++;
    if ($col > 4) {
      $col = 0;
      $row ++;
    }
    $featured_index->MoveNext();
  }
}
    $featured_title = 'Recommended for You';
// new_products
$categories_products_id_list = '';
$list_of_products = '';
$new_products_query = '';

$display_limit = zen_get_new_date_range();

if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
  $new_products_query = "select distinct p.products_id, p.products_image, p.products_tax_class_id, pd.products_name,
                                p.products_date_added, p.products_price, p.products_type, p.master_categories_id,p.products_quantity
                           from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_NEW_ARRIVALS . " na
                           where p.products_id = pd.products_id and p.products_id = na.products_id and na.status=1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                           and   p.products_status = 1 " . $display_limit." order by na.sort_order";
} else {
  // get all products and cPaths in this subcat tree
  $productsInCategory = zen_get_categories_products_list( (($manufacturers_id > 0 && $_GET['filter_id'] > 0) ? zen_get_generated_category_path_rev($_GET['filter_id']) : $cPath), false, true, 0, $display_limit);

  if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
    // build products-list string to insert into SQL query
    foreach($productsInCategory as $key => $value) {
      $list_of_products .= $key . ', ';
    }
    $list_of_products = substr($list_of_products, 0, -2); // remove trailing comma

    $new_products_query = "select distinct p.products_id, p.products_image, p.products_tax_class_id, pd.products_name,
                                  p.products_date_added, p.products_price, p.products_type, p.master_categories_id,p.products_quantity
                           from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_NEW_ARRIVALS . " na
                           where p.products_id = pd.products_id and p.products_id = na.products_id and na.status=1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                           and p.products_id in (" . $list_of_products . ") order by na.sort_order";
  }
}

if ($new_products_query != '') $new_products = $db->Execute($new_products_query, 10);

$row = 0;
$col = 0;
$list_box_contents = array();
$title = '';

$num_products_count = ($new_products_query == '') ? 0 : $new_products->RecordCount();

// show only when 1 or more
if ($num_products_count > 0) {
  while (!$new_products->EOF) {
	  if($new_products->fields['products_quantity']>10){
		$str_stroe = '<img src="images/available.png" align="absmiddle">&nbsp;Available';
	}elseif($new_products->fields['products_quantity']>0){
		$str_stroe = '<img src="images/fewstore.png" align="absmiddle">&nbsp;Few stocks';
	}else{
		$str_stroe = '<img src="images/needorder.png" align="absmiddle">&nbsp;Need Order';
	}
	
    $products_price = zen_get_products_display_final_price($new_products->fields['products_id']);
    if (!isset($productsInCategory[$new_products->fields['products_id']])) $productsInCategory[$new_products->fields['products_id']] = zen_get_generated_category_path_rev($new_products->fields['master_categories_id']);

    $list_box_contents[$row][$col] = array('params' => '',
  

    'text' => ''.(($new_products->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : '<span><a href="' . zen_href_link(zen_get_info_page($free_index->fields['products_id']), 'cPath=' . $productsInCategory[$free_index->fields['products_id']] . '&products_id=' . $new_products->fields['products_id']) . '" class="ih4" >' . str_replace("/s/","/l/", zen_image(DIR_WS_IMAGES .$new_products->fields['products_image'], zen_get_products_name($new_products->fields['products_id']), 180, 180,' class="fl"')) . '</a>') . '</span><span class="CategoryDetails"><a href="' . zen_href_link(zen_get_info_page($free_index->fields['products_id']), 'cPath=' . $productsInCategory[$free_index->fields['products_id']] . '&products_id=' . $new_products->fields['products_id']) . '">' . (strlen($new_products->fields['products_name'])>40 ? substr($new_products->fields['products_name'],0,40).'':$new_products->fields['products_name']) . '</a></span><span class="b red1">' . $products_price.'<em class="instorefr">'.$str_stroe.'</em></span>');
	
    $col ++;
    if ($col > 4) {
      $col = 0;

      $row ++;
    }
    $new_products->MoveNext();
  }
  $zc_show_new_products = true;
}
    $title = 'New Arrivals';
	
	

	
//specials
$freeshipping_categories_products_id_list = '';
$freeshipping_list_of_products = '';
$freeshipping_specials_index_query = '';
$freeshipping_display_limit = '';

if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
  $freeshipping_index_query = "select p.products_id, p.products_image, pd.products_name, p.master_categories_id,p.products_quantity
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_FREE_SHIPPINGS . " s on p.products_id = s.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = s.products_id
                           and p.products_id = pd.products_id
                           and p.products_status = '1' and s.status = 1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
} else {
  // get all products and cPaths in this subcat tree
  $productsInCategory = zen_get_categories_products_list( (($manufacturers_id > 0 && $_GET['filter_id'] > 0) ? zen_get_generated_category_path_rev($_GET['filter_id']) : $cPath), false, true, 0, $display_limit);

  if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
    // build products-list string to insert into SQL query
    foreach($productsInCategory as $key => $value) {
      $freeshipping_list_of_products .= $key . ', ';
    }
    $freeshipping_list_of_products = substr($freeshipping_list_of_products, 0, -2); // remove trailing comma
    $freeshipping_index_query = "select distinct p.products_id, p.products_image, pd.products_name, p.master_categories_id,p.products_quantity
                             from (" . TABLE_PRODUCTS . " p
                             left join " . TABLE_FREE_SHIPPINGS . " s on p.products_id = s.products_id
                             left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                             where p.products_id = s.products_id
                             and p.products_id = pd.products_id
                             and p.products_status = '1' and s.status = '1'
                             and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                             and p.products_id in (" . $freeshipping_list_of_products . ")";
  }
}
if ($freeshipping_index_query != '') $freeshipping_index = $db->ExecuteRandomMulti($freeshipping_index_query, '10');

$row = 0;
$col = 0;
$freeshipping_list_box_contents = array();
$freeshipping_title = '';

$num_products_count = ($freeshipping_index_query == '') ? 0 : $freeshipping_index->RecordCount();

// show only when 1 or more
if ($num_products_count > 0) {
  $freeshipping_list_box_contents = array();
  while (!$freeshipping_index->EOF) {
	  if($freeshipping_index->fields['products_quantity']>10){
		$str_stroe = '<img src="images/available.png" align="absmiddle">&nbsp;Available';
	}elseif($freeshipping_index->fields['products_quantity']>0){
		$str_stroe = '<img src="images/fewstore.png" align="absmiddle">&nbsp;Few stocks';
	}else{
		$str_stroe = '<img src="images/needorder.png" align="absmiddle">&nbsp;Need Order';
	}
   $products_price = zen_get_products_display_final_price($freeshipping_index->fields['products_id']);
    if (!isset($productsInCategory[$freeshipping_index->fields['products_id']])) $productsInCategory[$freeshipping_index->fields['products_id']] = zen_get_generated_category_path_rev($freeshipping_index->fields['master_categories_id']);

    $freeshipping_index->fields['products_name'] = strlen(zen_get_products_name($freeshipping_index->fields['products_id'])) > 40 ? substr(zen_get_products_name($freeshipping_index->fields['products_id']),0,40) .'' :zen_get_products_name($freeshipping_index->fields['products_id']);
    $freeshipping_list_box_contents[$row][$col] = array('params' => '' ,
	
   
	
	'text' => ''.(($freeshipping_index->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : '<span><a href="' . zen_href_link(zen_get_info_page($freeshipping_index->fields['products_id']), 'cPath=' . $productsInCategory[$freeshipping_index->fields['products_id']] . '&products_id=' . (int)$freeshipping_index->fields['products_id']) . '" class="ih4" >' . str_replace("/s/","/l/", zen_image(DIR_WS_IMAGES .$freeshipping_index->fields['products_image'], zen_get_products_name($freeshipping_index->fields['products_id']), 180, 180,' class="fl"')) . '</a>') . '</span><span class="CategoryDetails"><a href="' . zen_href_link(zen_get_info_page($freeshipping_index->fields['products_id']), 'cPath=' . $productsInCategory[$freeshipping_index->fields['products_id']] . '&products_id=' . $freeshipping_index->fields['products_id']) . '">' . (strlen($freeshipping_index->fields['products_name'])>40 ? substr($freeshipping_index->fields['products_name'],0,40).'':$freeshipping_index->fields['products_name']) . '</a></span><span class="b red1">' . $products_price.'<em class="instorefr">'.$str_stroe.'</em></span>');
	

    $col ++;
    if ($col > 4) {
      $col = 0;
      $row ++;
    }
    $freeshipping_index->MoveNext();
  }

  if ($freeshipping_index->RecordCount() > 0) {
    $freeshipping_title = 'Top Rated';
  }
}

//specials
$specials_categories_products_id_list = '';
$specials_list_of_products = '';
$specials_specials_index_query = '';
$specials_display_limit = '';

if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
  $specials_index_query = "select p.products_id, p.products_image, pd.products_name, p.master_categories_id,p.products_quantity
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = s.products_id
                           and p.products_id = pd.products_id
                           and p.products_status = '1' and s.status = 1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
} else {
  // get all products and cPaths in this subcat tree
  $productsInCategory = zen_get_categories_products_list( (($manufacturers_id > 0 && $_GET['filter_id'] > 0) ? zen_get_generated_category_path_rev($_GET['filter_id']) : $cPath), false, true, 0, $display_limit);

  if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
    // build products-list string to insert into SQL query
    foreach($productsInCategory as $key => $value) {
      $specials_list_of_products .= $key . ', ';
    }
    $specials_list_of_products = substr($specials_list_of_products, 0, -2); // remove trailing comma
    $specials_index_query = "select distinct p.products_id, p.products_image, pd.products_name, p.master_categories_id,p.products_quantity
                             from (" . TABLE_PRODUCTS . " p
                             left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id
                             left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                             where p.products_id = s.products_id
                             and p.products_id = pd.products_id
                             and p.products_status = '1' and s.status = '1'
                             and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                             and p.products_id in (" . $specials_list_of_products . ")";
  }
}
if ($specials_index_query != '') $specials_index = $db->ExecuteRandomMulti($specials_index_query, '10');

$row = 0;
$col = 0;
$specials_list_box_contents = array();
$specials_title = '';

$num_products_count = ($specials_index_query == '') ? 0 : $specials_index->RecordCount();

// show only when 1 or more
if ($num_products_count > 0) {
  $specials_list_box_contents = array();
  while (!$specials_index->EOF) {
   $products_price = zen_get_products_display_final_price($specials_index->fields['products_id']);
    if($specials_index->fields['products_quantity']>10){
		$str_stroe = '<img src="images/available.png" align="absmiddle">&nbsp;Available';
	}elseif($specials_index->fields['products_quantity']>0){
		$str_stroe = '<img src="images/fewstore.png" align="absmiddle">&nbsp;Few stocks';
	}else{
		$str_stroe = '<img src="images/needorder.png" align="absmiddle">&nbsp;Need Order';
	}
    if (!isset($productsInCategory[$specials_index->fields['products_id']])) $productsInCategory[$specials_index->fields['products_id']] = zen_get_generated_category_path_rev($specials_index->fields['master_categories_id']);

    $specials_index->fields['products_name'] = strlen(zen_get_products_name($specials_index->fields['products_id'])) > 40 ? substr(zen_get_products_name($specials_index->fields['products_id']),0,40) .'...' :zen_get_products_name($specials_index->fields['products_id']);
    $specials_list_box_contents[$row][$col] = array('params' => '' ,
   

	 'text' => ''.(($specials_index->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : '<span><a href="' . zen_href_link(zen_get_info_page($specials_index->fields['products_id']), 'cPath=' . $productsInCategory[$specials_index->fields['products_id']] . '&products_id=' . (int)$specials_index->fields['products_id']) . '" class="ih4" >' . str_replace("/s/","/l/", zen_image(DIR_WS_IMAGES .$specials_index->fields['products_image'], zen_get_products_name($specials_index->fields['products_id']), 180, 180,' class="fl"')) . '</a>') . '</span><span class="CategoryDetails"><a href="' . zen_href_link(zen_get_info_page($specials_index->fields['products_id']), 'cPath=' . $productsInCategory[$free_index->fields['products_id']] . '&products_id=' . $specials_index->fields['products_id']) . '">' . (strlen($specials_index->fields['products_name'])>40 ? substr($specials_index->fields['products_name'],0,40).'':$specials_index->fields['products_name']) . '</a></span><span class="b red1">' . $products_price.'<em class="instorefr">'.$str_stroe.'</em></span>');
	 

    $col ++;
    if ($col > 4) {
      $col = 0;
      $row ++;
    }
    $specials_index->MoveNextRandom();
  }

  if ($specials_index->RecordCount() > 0) {
    $specials_title = 'Special Products';
  }
}
?>