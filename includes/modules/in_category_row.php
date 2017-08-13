<?php
/**
 * index category_row.php
 *
 * Prepares the content for displaying a category's sub-category listing in grid format.  
 * Once the data is prepared, it calls the standard tpl_list_box_content template for display.
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: category_row.php 4084 2006-08-06 23:59:36Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

$in_categories_query = "select c.categories_id,c.categories_image, cd.categories_name
										 from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
										 where c.categories_id = cd.categories_id 
										 and cd.language_id = '" . (int)$_SESSION['languages_id'] . "' and c.parent_id = '".$current_category_id."' and c.categories_status= '1' 
										 order by sort_order";
$in_categories = $db->Execute($in_categories_query);
$num_categories = $in_categories->RecordCount();
$row = 0;
$col = 0;
$list_box_contents = '';
if ($num_categories > 0) {
  if ($num_categories < MAX_DISPLAY_CATEGORIES_PER_ROW || MAX_DISPLAY_CATEGORIES_PER_ROW == 0) {
    $col_width = floor(100/$num_categories);
  } else {
    $col_width = floor(100/MAX_DISPLAY_CATEGORIES_PER_ROW);
  }
  while (!$in_categories->EOF ) {
  	
		
    $list_box_contents[$row][$col] = array('params' => 'class="categoryListBoxContents"',
                                           'text' => '<div><a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath='.$in_categories->fields['categories_id']) . '" title="'.SEO_COMMON_KEYWORDS.' '.$in_categories->fields['categories_name'].'">' . zen_image(DIR_WS_IMAGES . str_replace("s/","l/",$in_categories->fields['categories_image']), SEO_COMMON_KEYWORDS . ' ' .$in_categories->fields['categories_name'], 190, 190) . '</a></div><h3 class="margin_t line_120 pad_b2"><a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath='.$in_categories->fields['categories_id']) . '" title="'.SEO_COMMON_KEYWORDS.' '.$in_categories->fields['categories_name'].'">'. $in_categories->fields['categories_name'] .'</a></h3>'.$subCatoryString);

    $col ++;
    if ($col > (MAX_DISPLAY_CATEGORIES_PER_ROW -1)) {
      $col = 0;
      $row ++;
    }
    $in_categories->MoveNext();
  }
}
?>
