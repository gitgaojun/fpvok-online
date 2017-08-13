<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_categories.php 4162 2006-08-17 03:55:02Z ajeh $
 */
  //print_r($box_categories_array);
  //print_r($cPath_array);
  //print_r($current_category_id);
  $content = "";
  $content .= '<div>' . "\n";
	$category_depth == 'products' ? array_pop($cPath_array) : '';
  function showBoxCategory($cPath_array,$ii) {
  	global $db,$current_category_id,$category_depth;
  	$content .= '<div class="gray_box"><a style="color:#FF6600;font-weight:bold;" href="'.zen_href_link(FILENAME_DEFAULT, 'cPath='.$cPath_array[$ii]).'"';
  	if($current_category_id == $cPath_array[$ii]){
  		$content .= ' class="category_title" ';
  	}
  	$content .= '> '.zen_get_category_name($cPath_array[$ii],$_SESSION['languages_id']).'</a><span class="category_title_img">&nbsp;</span></div>';
   	$ii++;
		if ($ii < sizeof($cPath_array) ) {
	  	$content .= '<div class="pad_1em">';
	    $content .= showBoxCategory($cPath_array, $ii);
			$content .= '</div>';
		}else {
			if(zen_has_category_subcategories($cPath_array[$ii])){
				$content .=$cPath_array[$ii];
				$content .= '<div class="ddsmoothmenu-v"><ul>';
				$subcategories_query = "select c.categories_id
	                            from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
	                            where c.parent_id = '" . (int)$cPath_array[$ii-1]. "'and c.categories_id = cd.categories_id and c.categories_status= '1' order by c.sort_order,cd.categories_name";
				$subcategoriesArray = $db->Execute($subcategories_query);
				while (!$subcategoriesArray->EOF) {
					$cate_current_img = '';
					$current_a_style = '';	
					$current_li_style = '';
					$clear_div = '';
					if ($category_depth == 'products' && $subcategoriesArray->fields['categories_id'] == $current_category_id) {
						$current_a_style = ' class="cate_current fl" style="color:#FF6600;" ';
						$cate_current_img = '<div class="cate_current_img fl">&nbsp;</div>';
						$current_li_style = 'class="current_li_class fl"';
						$clear_div = '<div class="clear"></div>';
					}
					$content .= $clear_li.'<li '.$current_li_style.'><a href="'.zen_href_link(FILENAME_DEFAULT, 'cPath='.$subcategoriesArray->fields['categories_id']).'"'.$current_a_style;									
					$content .= '>'.zen_get_category_name($subcategoriesArray->fields['categories_id'],$_SESSION['languages_id']).'</a>'.$cate_current_img.'</li>'.$clear_div;
					$subcategoriesArray->MoveNext();
				}
				$content .= '</ul></div>';				
			}else{
				print_r('ERROR');
			}

		}

    return $content;
	}
	if (sizeof($cPath_array) > 0){
	  $content .= showBoxCategory($cPath_array,0);
	}else{
		$content .= '<a href="'.zen_href_link(FILENAME_DEFAULT, 'cPath='.$current_category_id).'" class="red b"> &lt;' . zen_get_category_name($current_category_id,$_SESSION['languages_id']).'</a>';
	}
  $content .= '</div>';
?>