<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: categories_ul_generator.php 2004-07-11  DrByteZen $
//      based on site_map.php v1.0.1 by networkdad 2004-06-04
// Fix for line 48 provided by Paulm, uploaded by Kelvyn

 class zen_categories_ul_generator {
   var $root_category_id = 0,
	 		 $max_display = 20,
			 $i_display = 0,
			 $b_display = 0,
       $max_level = 4,
			 $b_top = 0,
       $data = array(),
       $brand_data = array(),
       $root_start_string = '',
       $root_end_string = '',
       $parent_start_string = '',
       $parent_end_string = '',

       
       $parent_group_start_string_noif = '<ul>',
       $parent_group_end_string_noif = "</ul>\n",
       
       $parent_group_start_string = "<!--[if lte IE 6]><table><tr><td><![endif]-->\n<ul%s>\n",
       $parent_group_end_string = "</ul><!--[if lte IE 6]></td></tr></table></a><![endif]-->\n",

       $child_start_string = '<li%s>',
       $child_end_string = "</li>\n",

       $spacer_string = '',
       $spacer_multiplier = 1;

   var $document_types_list = '(3) ';  // acceptable format example: ' (3, 4, 9, 22, 18) '

   function zen_categories_ul_generator($load_from_database = true) {
     global $languages_id, $db;
		$this->data = array();
		$categories_query = "select c.categories_id, cd.categories_name, c.parent_id
												from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
												 where c.categories_id = cd.categories_id
												 and c.categories_status=1 " .
	//                             "and c.categories_id = ptc.category_id " .
	//                             "and ptc.category_id = cd.categories_id " .
	//                             "and ptc.product_type_id not in  " . $this->document_types_list . "
												 " and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
													 order by c.parent_id, c.sort_order, cd.categories_name";
         $categories = $db->Execute($categories_query);
         while (!$categories->EOF) {
           $this->data[$categories->fields['parent_id']][$categories->fields['categories_id']] = array('name' => $categories->fields['categories_name'], 'count' => 0);
           
					 $categories->MoveNext();
         }
         $this->brand_data = array();
		 
         /*$brand_query = "select m.manufacturers_id, mi.manufacturers_name, m.manufacturers_image, m.date_added, m.last_modified from " . TABLE_MANUFACTURERS . " m, ".TABLE_MANUFACTURERS_INFO." mi where m.manufacturers_id = mi.manufacturers_id and mi.languages_id=".(int)$_SESSION['languages_id'];
         $brand = $db->Execute($brand_query);
         while (!$brand->EOF) {           
           $brand_categories_query = "select c.categories_id, cd.categories_name, c.parent_id
												from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
												 where c.categories_id = cd.categories_id
												 and c.categories_status=1
												 and cd.categories_name like '%".$brand->fields['manufacturers_name']."%'
												 and c.parent_id<>0
												 and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
												 order by c.parent_id, c.sort_order, cd.categories_name";
           $brand_categories = $db->Execute($brand_categories_query);
           while (!$brand_categories->EOF) {
           	if (!isset($this->brand_data[0][$brand->fields['manufacturers_id']]))
           	{
           		$this->brand_data[0]['b_'.$brand->fields['manufacturers_id']] = array('name' => $brand->fields['manufacturers_name'], 'count' => 0);
           	}
           	if(stripos(zen_get_categories_parent_name($brand_categories->fields['categories_id']),$brand->fields['manufacturers_name'])===FALSE)
           	{
           		unset($parent_categories);
           		zen_get_parent_categories($parent_categories,$brand_categories->fields['categories_id']);
           		$hasParent = false;
           		foreach ($parent_categories as $parent_categories_id)
           		{
           			$parent_categories_name = zen_get_categories_parent_name($parent_categories_id);
           			if (stripos($parent_categories_name,$brand->fields['manufacturers_name'])!==FALSE)
           			{   
           				$this->brand_data[$parent_categories_id][$brand_categories->fields['categories_id']] = array('name' => $brand_categories->fields['categories_name'], 'count' => 0);
           				$hasParent = true;
           				break;
           			}
           		}
           		
           		if (!$hasParent)
           		{
           			$this->brand_data['b_'.$brand->fields['manufacturers_id']][$brand_categories->fields['categories_id']] = array('name' => $brand_categories->fields['categories_name'], 'count' => 0);
           		}
           		//echo "<pre>";print_r($parent_categories);echo $brand_categories->fields['parent_id']."</pre>";
           	}
           	else 
           	{           		
           		$this->brand_data[$brand_categories->fields['parent_id']][$brand_categories->fields['categories_id']] = array('name' => $brand_categories->fields['categories_name'], 'count' => 0);
           	}                      
			$brand_categories->MoveNext();
           }
		   $brand->MoveNext();
         }*/
         //echo "<pre>";print_r($this->brand_data);echo "</pre>";
//DEBUG: These lines will dump out the array for display and troubleshooting:
//foreach ($this->data as $pkey=>$pvalue) { 
//   foreach ($this->data[$pkey] as $key=>$value) { echo '['.$pkey.']'.$key . '=>' . $value['name'] . '<br>'; }
//}
   }
	 
   function buildBranch($parent_id, $level = 0, $submenu=false) {
   	 if($level == 0){
      $result = $this->parent_group_start_string_noif;
   	 }else{
      $result = sprintf($this->parent_group_start_string,'');
   	 }
   	 if (isset($this->data[$parent_id])) {
		 		if($this->i_display > 0){
						 $i = 0;
						 while ((list($category_id, $category) = each($this->data[$parent_id])) and ($i <= $this->max_display) ) {
							 $category_link = $category_id;
							 if (isset($this->data[$category_id])) {
							 		   $firsHasSubClass = 'firstHasSub';
									   $hasSubClass = 'hasSub';									 
									if($b_top < 1 ){
									$hasSubClass = '';			
									 $result .= sprintf($this->child_start_string, ($submenu==true) ? ' class="b_top '.$firsHasSubClass.'"' : '');
									 $b_top++;
									}else{
									 $result .= sprintf($this->child_start_string,' class="'.$hasSubClass.'"');
									}
							 } else {
									if($b_top < 1){
									 $result .= sprintf($this->child_start_string, ' class="b_top"');
									 $b_top++;
									}else{
									 $result .= sprintf($this->child_start_string,'');
									}
							 }
							 if (isset($this->data[$category_id])) {
								 $result .= $this->parent_start_string;
							 }
			
							 if ($level == 0) {
								 $result .= $this->root_start_string;
							 }
							 if($i == $this->max_display){
							 $result .= str_repeat($this->spacer_string, $this->spacer_multiplier * $level) . '<a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath=' . zen_get_categories_parent_id($category_link)) . '">';
							 $result .= 'All '.zen_get_categories_parent_name($category_id);
							 $result .= '</a>';
							 }else{
							 $result .= str_repeat($this->spacer_string, $this->spacer_multiplier * $level) . '<a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath=' . $category_link) . '" title="'.SEO_COMMON_KEYWORDS.' '.$category['name'].'">';
							 $result .= $category['name'];
							 if(zen_count_products_in_category($category_id)){
							 $result .= '';
							 }
							  if (isset($this->data[$category_id])){ 	   
                  $result .= '<!--[if IE 7]><!--></a><!--<![endif]-->'."\n";
							 	 }else{
                  $result .= '</a>'."\n";
							 	 }
							 }
							 if ($level == 0) {
								 $result .= $this->root_end_string;
							 }
			
							 if (isset($this->data[$category_id])) {
								 $result .= $this->parent_end_string;
							 }
			
							 if (isset($this->data[$category_id]) && (($this->max_level == '0') || ($this->max_level > $level+1))) {
								 $this->i_display++;
								 $result .= $this->buildBranch($category_id, $level+1, $submenu);
							 }
								 $result .= $this->child_end_string;
							 $i++;
						 }
				}else{
						 while ((list($category_id, $category) = each($this->data[$parent_id])) ) {
							 $category_link = $category_id;
							 if (isset($this->data[$category_id])) {
									if($b_top < 1 && $level == 1){
									 $result .= sprintf($this->child_start_string, ($submenu==true) ? ' class="b_top"' : '');
									 $b_top++;
									}else{
									 $result .= sprintf($this->child_start_string,'');
									}
							 } else {
									if($b_top < 1 && $level == 1){
									 $result .= sprintf($this->child_start_string, ' class="b_top"');
									 $b_top++;
									}else{
									 $result .= sprintf($this->child_start_string,'');
									}
							 }
							 if (isset($this->data[$category_id])) {
								 $result .= $this->parent_start_string;
							 }
			
							 if ($level == 0) {
								 $result .= $this->root_start_string;
							 }
							 $result .= str_repeat($this->spacer_string, $this->spacer_multiplier * $level) . '<a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath=' . $category_link) . '" title="'.SEO_COMMON_KEYWORDS.' '.$category['name'].'">';
							 $result .= $category['name'];			
							 if ($level == 0) {							 	
							 	 if (zen_has_category_subcategories($category_id)){ 	   
                  $result .= '<!--[if IE 7]><!--></a><!--<![endif]-->'."\n";
							 	 }else{
                  $result .= '</a>'."\n";
							 	 }
								 $result .= $this->root_end_string;
							 }else{
                 $result .= '</a>';
							 }
							 if (isset($this->data[$category_id])) {
								 $result .= $this->parent_end_string;
							 }
			
							 if (isset($this->data[$category_id]) && (($this->max_level == '0') || ($this->max_level > $level+1))) {
								 $this->i_display++;							 
								 $result .= $this->buildBranch($category_id, $level+1, $submenu);
							 }
								 $result .= $this->child_end_string;
			
						 }
				}
     }
				 	if($level == 1){
					 $b_top = 0;
					 }
		 if ($level==0){			 
      $result .= $this->parent_group_end_string_noif;
		 }else{
      $result .= $this->parent_group_end_string;
		 }
     return $result;
   }
//start to build brand categories
 function buildBrandBranch($parent_id, $level = 0, $submenu=false) {
   	 if($level == 0){
      $brand_result = $this->parent_group_start_string_noif;
   	 }else{
      $brand_result = sprintf($this->parent_group_start_string,'');
   	 }
   	 if (isset($this->brand_data[$parent_id])) {
		 		if($this->b_display > 0){
		 		$i = 0;
						 while ((list($category_id, $category) = each($this->brand_data[$parent_id])) and ($i <= $this->max_display) ) {
						 	//if ($parent_id==17)echo $category_id.'<br>';
							 $category_link = $category_id;
							 if (isset($this->brand_data[$category_id])) {
							 		   $firsHasSubClass = 'firstHasSub';
									   $hasSubClass = 'hasSub';
									if($b_top < 1 && $level == 1){
									$hasSubClass = '';			
									 $brand_result .= sprintf($this->child_start_string, ($submenu==true) ? ' class="b_top '.$firsHasSubClass.'"' : '');
									 $b_top++;
									}else{
									 $brand_result .= sprintf($this->child_start_string,' class="'.$hasSubClass.'"');
									}
							 } else {
									if($b_top < 1 && ($level == 1||$level==2)){
									 $brand_result .= sprintf($this->child_start_string, ' class="b_top"');
									 $b_top++;
									}else{
									 $brand_result .= sprintf($this->child_start_string,'');
									}
							 }
							 if (isset($this->brand_data[$category_id])) {
								 $brand_result .= $this->parent_start_string;
							 }
			
							 if ($level == 0) {
								 $brand_result .= $this->root_start_string;
							 }
							 if($i == $this->max_display){
							 $brand_result .= str_repeat($this->spacer_string, $this->spacer_multiplier * $level) . '<a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath=' . zen_get_categories_parent_id($category_link)) . '">';
							 $brand_result .= 'All '.zen_get_categories_parent_name($category_id);
							 $brand_result .= '</a>';
							 }else{
							 $brand_result .= str_repeat($this->spacer_string, $this->spacer_multiplier * $level) . '<a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath=' . $category_link) . '" title="'.SEO_COMMON_KEYWORDS.' '.$category['name'].'">';
							 $brand_result .= $category['name'];
							 if(zen_count_products_in_category($category_id)){
							 $brand_result .= '';
							 }
							  if (isset($this->brand_data[$category_id])){ 	   
                  $brand_result .= '<!--[if IE 7]><!--></a><!--<![endif]-->'."\n";
							 	 }else{
                  $brand_result .= '</a>'."\n";
							 	 }
							 }
							 if ($level == 0) {
								 $brand_result .= $this->root_end_string;
							 }
			
							 if (isset($this->brand_data[$category_id])) {
								 $brand_result .= $this->parent_end_string;
							 }
			
							 if (isset($this->brand_data[$category_id]) && (($this->max_level == '0') || ($this->max_level > $level+1))) {
								 $this->b_display++;
								 $brand_result .= $this->buildBrandBranch($category_id, $level+1, $submenu);
							 }
								 $brand_result .= $this->child_end_string;
							 $i++;
						 }
				}else{
						 while ((list($category_id, $category) = each($this->brand_data[$parent_id])) ) {
							 $category_link = $category_id;
							 if (isset($this->brand_data[$category_id])) {
									if($b_top < 1 && $level == 1){
									 $brand_result .= sprintf($this->child_start_string, ($submenu==true) ? ' class="b_top"' : '');
									 $b_top++;
									}else{
									 $brand_result .= sprintf($this->child_start_string,'');
									}
							 } else {
									if($b_top < 1 && $level == 1){
									 $brand_result .= sprintf($this->child_start_string, ' class="b_top"');
									 $b_top++;
									}else{
									 $brand_result .= sprintf($this->child_start_string,'');
									}
							 }
							 if (isset($this->brand_data[$category_id])) {
								 $brand_result .= $this->parent_start_string;
							 }
			
							 if ($level == 0) {
								 $brand_result .= $this->root_start_string;
							 }
							 $brand_result .= str_repeat($this->spacer_string, $this->spacer_multiplier * $level) . '<a href="javascript:;" style="cursor:default;" title="'.SEO_COMMON_KEYWORDS.' '.$category['name'].'">';
							 $brand_result .= $category['name'];
			
							 if ($level == 0) {   
                  				$brand_result .= '<!--[if IE 7]><!--></a><!--<![endif]-->'."\n";
								 $brand_result .= $this->root_end_string;
							 }else{
                 $brand_result .= '</a>';
							 }
			
							 if (isset($this->brand_data[$category_id])) {
								 $brand_result .= $this->parent_end_string;
							 }
			
							 if ((isset($this->brand_data[$category_id])||$this->b_display==0) && (($this->max_level == '0') || ($this->max_level > $level+1))) {
								 $this->b_display++;
								 $brand_result .= $this->buildBrandBranch($category_id, $level+1, $submenu);
							 }
								 $brand_result .= $this->child_end_string;
			
						 }
				}
     }
				 	if($level == 1){
					 $b_top = 0;
					 }
		 if ($level==0){			 
      $brand_result .= $this->parent_group_end_string_noif;
		 }else{
      $brand_result .= $this->parent_group_end_string;
		 }
     return $brand_result;
   }

   function buildTree($submenu=false) {
     return $this->buildBranch($this->root_category_id, '', $submenu).$this->buildBrandBranch($this->root_category_id, '', $submenu);
   }
 }
?>
