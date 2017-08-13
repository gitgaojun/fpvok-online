<?php
/**
 * products_new header_php.php
 *
 * @package page
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 6912 2007-09-02 02:23:45Z drbyte $
 */

  require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
  $breadcrumb->add(NAVBAR_TITLE);
// display order dropdown
	
  if(isset($_GET['productsort']) && (int)$_GET['productsort'] > 0){
    switch ($_GET['productsort']){
      case 2:
        $product_sort = " order by pd.products_name ";
        break;
      case 3:
        $product_sort = " order by p.products_price";
        break;
      case 4:
        $product_sort = " order by p.products_price DESC";
        break;
      case 5:
        $product_sort = " order by p.products_date_added DESC";
        break;
		case 6:
        $product_sort = " order by s.discount DESC";
        break;
		case 7:
        $product_sort = " order by s.discount asc";
        break;
      default:
        $product_sort = " order by p.products_model ASC";
    }
  }
  
  

  if (isset($_GET['min_price']) && isset($_GET['max_price'])){
	  
	   $current_category_id = $_GET['categoryid'];
	    if(zen_has_category_subcategories($current_category_id)){
		$product_in_categories_sql = '';
		$product_in_categoriesArray = array();
		zen_get_subcategories(&$product_in_categoriesArray,$current_category_id);
		$product_in_categories_sql = implode(' or p.master_categories_id =',$product_in_categoriesArray);
		$product_in_categories_sql = '( p.master_categories_id ='.$product_in_categories_sql.')';			
		}else{
			$product_in_categories_sql = 'p.master_categories_id = ' . (int)$current_category_id;
		}
	
	$pricefilter1 =" and ".$product_in_categories_sql;
	
	    switch ($_GET['discount']){
      case 'more':
        $pricefilter2 = " and s.discount >".$_GET['offnum'];
        break;
      case 'equals':
        $pricefilter2 = " and s.discount =".$_GET['offnum'];
        break;
      default:
        $pricefilter2 = " and s.discount <".$_GET['offnum'];
    }
	  
    $pricefilter3 = " and p.`products_price` >= ".$_GET['min_price'] ." and p.`products_price` <= " . $_GET['max_price'];
  }
  
  $products_new_array = array();
// display limits
//  $display_limit = zen_get_products_new_timelimit();
  $display_limit = zen_get_new_date_range();

  $products_new_query_raw = "SELECT p.products_id, p.products_type, pd.products_name, p.products_image, p.products_price,
                                    p.products_tax_class_id, p.products_date_added, p.products_model,
                                    p.products_quantity, p.products_weight, p.product_is_call,s.discount,
                                    p.product_is_always_free_shipping, p.products_qty_box_status,s.specials_new_products_price,
                                    p.master_categories_id,p.product_is_wholesale,p.product_wholesale_min,p.products_price_sample,
                                    p.products_price_retail,p.products_quantity,p.products_quantity_order_min,p.products_status
                             FROM " . TABLE_PRODUCTS . " p
                             LEFT JOIN " . TABLE_SPECIALS . " s
                             ON (p.products_id = s.products_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd
                             WHERE p.products_status = 1
                             AND p.products_id = pd.products_id  AND p.products_id = s.products_id and s.status = '1'
                             AND pd.language_id = :languageID " .$displayOrder . $product_sort .$pricefilter1.$pricefilter2.$pricefilter3 ;

  $products_new_query_raw = $db->bindVars($products_new_query_raw, ':languageID', $_SESSION['languages_id'], 'integer');
  $products_new_split = new splitPageResults($products_new_query_raw, (isset($_GET['pagesize']) ? $_GET['pagesize'] : 24));
  

//check to see if we are in normal mode ... not showcase, not maintenance, etc
  $show_submit = zen_run_normal();
  
  $products_new = $db->Execute($products_new_split->sql_query);
  if($products_new->RecordCount()>0){
	  $row = 0;
	  while (!$products_new->EOF) {
	    if ($products_new->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) {
	      $list_box_contents[$row]['products_image'] = '';
	    } else {
	      $list_box_contents[$row]['products_image'] = $products_new->fields['products_image'] ;
	    }
	    $list_box_contents[$row]['products_name'] = $products_new->fields['products_name'];
		$list_box_contents[$row]['specials_new_products_price'] = $products_new->fields['specials_new_products_price'];
		$list_box_contents[$row]['discount'] = $products_new->fields['discount'];
		$list_box_contents[$row]['products_model'] = $products_new->fields['products_model'];
	    $list_box_contents[$row]['products_description'] = zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($products_new->fields['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION);
	    $list_box_contents[$row]['products_price'] = zen_get_products_base_price($products_new->fields['products_id']);
	    $list_box_contents[$row]['actual_price'] = $currencies->display_price(zen_get_products_actual_price($products_new->fields['products_id']),zen_get_tax_rate($product_check->fields['products_tax_class_id']));
	    $list_box_contents[$row]['products_status']=$products_new->fields['products_status'];
	    if ($products_new->fields['product_is_always_free_shipping'] == 0) {
	      $list_box_contents[$row]['product_is_always_free_shipping'] = '';
	    } else {
	      $list_box_contents[$row]['product_is_always_free_shipping'] = '<span class="free_shipping"></span>';
	    }
	    
	    $list_box_contents[$row]['products_quantity_order_min'] = $products_new->fields['products_quantity_order_min'];
	    $list_box_contents[$row]['products_id'] = $products_new->fields['products_id'];
	    $list_box_contents[$row]['products_quantity'] = $products_new->fields['products_quantity'];
	    
	    $list_box_contents[$row]['products_price_retail'] = $currencies->display_price($products_new->fields['products_price_retail'],zen_get_tax_rate($product_check->fields['products_tax_class_id']));
	    $list_box_contents[$row]['products_price_sample'] = $currencies->display_price($products_new->fields['products_price_sample'],zen_get_tax_rate($product_check->fields['products_tax_class_id']));
	    $list_box_contents[$row]['product_is_wholesale'] = $products_new->fields['product_is_wholesale'];
	    $list_box_contents[$row]['product_wholesale_min'] = $products_new->fields['product_wholesale_min'];
	    $products_new->MoveNext();
	    $row++;
	  }
  }
  
    
?>