<?php
require('includes/application_top.php');
$categories_query = "select c.categories_id, cd.categories_name from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd  where parent_id = '0' and c.categories_status='1' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by sort_order, cd.categories_name"; 
$categories = $db->Execute($categories_query); 
?> 
{"cate":"<ul id='catalogList' class='search-category-list'><li catalogId=''>All Categories</li><li class='sub-line'></li><?php while (!$categories->EOF) {
	echo '<li catalogid=\''.$categories->fields['categories_id'].'\'>'.$categories->fields['categories_name'].'</li>';
	$categories->MoveNext();
 } ?></ul>"}