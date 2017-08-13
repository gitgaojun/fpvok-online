<?php
/**
 * Sitemap XML
 *
 * @package Sitemap XML
 * @copyright Copyright 2005-2009, Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2008 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: sitemapxml_products.php, v 2.1.0 30.04.2009 10:35 AndrewBerezin $
 */

$zen_SiteMapXML->message ( '<h3>' . TEXT_HEAD_PRODUCTTAGS . '</h3>' );

// BOF hideCategories
if (defined ( 'TABLE_HIDE_CATEGORIES' )) {
	$from = " LEFT JOIN " . TABLE_HIDE_CATEGORIES . " h ON (p.master_categories_id = h.categories_id)";
	$where = " AND (h.visibility_status < 2 OR h.visibility_status IS NULL)";
} else {
	$from = '';
	$where = '';
}
// EOF hideCategories


/*if ($_GET['letter']=='0-9'){
	$producttags_split_sql = "select p.`products_id`,pd.`products_name` from ".TABLE_PRODUCTS." p,".TABLE_PRODUCTS_DESCRIPTION." pd where p.`products_id` = pd.`products_id` AND LEFT(pd.`products_name`,1) REGEXP '^[0-9]'";
}else{
	$producttags_split_sql = "select p.`products_id`,pd.`products_name` from ".TABLE_PRODUCTS." p,".TABLE_PRODUCTS_DESCRIPTION." pd where p.`products_id` = pd.`products_id` AND LEFT(pd.`products_name`,1) LIKE '".strtolower($_GET['letter'])."'";
}*/
$procucttagArr = range ( 't', 't' );
$procucttagArr [] = 'a';
$spTagCond = '';
foreach ( $procucttagArr as $tagword ) {
	if($tagword == '0-9')
	{
		$spTagCond = " REGEXP '^[0-9]' ";
		$addXMLFileName = "number";
	}
	else
	{
		$spTagCond = " LIKE '".$tagword."' ";
		$addXMLFileName = $tagword;
	}
	$last_date = $db->Execute ( "SELECT MAX(GREATEST(p.products_date_added, IFNULL(p.products_last_modified, 0))) AS last_date
                           FROM " . TABLE_PRODUCTS . " p
                           WHERE p.products_status = '1'" );
	if ($zen_SiteMapXML->SitemapOpen ( 'producttags_'.$addXMLFileName, $last_date->fields ['last_date'] )) {
		$producttags_sql = "select p.`products_id`,pd.`products_name`,GREATEST(p.products_date_added, IFNULL(p.products_last_modified, '0001-01-01 00:00:00')) AS last_date, p.products_sort_order AS priority, pd.language_id from " . TABLE_PRODUCTS . " p," . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.`products_id` = pd.`products_id` AND LEFT(pd.`products_name`,1) " . $spTagCond . $where . (SITEMAPXML_PRODUCTS_ORDERBY != '' ? "ORDER BY " . SITEMAPXML_PRODUCTS_ORDERBY : '');
		$products_names_handle = $db->Execute ( $producttags_sql );
		$products_name_text = '';
		$products_tags_arr = array ();
		$products_nottags_arr = array ();
		$products_words_arr = array ();
		$producttags_final_arr = array ();
		if ($products_names_handle->RecordCount () > 0) {
			while ( ! $products_names_handle->EOF ) {
				$products_name_text = $products_name_text . $products_names_handle->fields ['products_name'] . ' ';
				$products_names_handle->MoveNext ();
			}
			$products_words_arr = array_unique ( explode ( ' ', $products_name_text ) );
			foreach ( $products_words_arr as $pn ) {
				//var_dump(ereg('[0-9]',substr($pn,0,1)));
				if ($pn != '' && $pn != '(' && $pn != ')' && strtolower ( $pn ) != 'and' && strtolower ( $pn ) != 'or' && strtolower ( $pn ) != 'where') {
					$pn = str_replace ( '(', '', $pn );
					$pn = str_replace ( ')', '', $pn );
					$pn = str_replace ( '&', '', $pn );
					$pn = str_replace ( '>', '', $pn );
					$pn = str_replace ( '<', '', $pn );
					if ($tagword != '0-9') {
						if (strtolower ( substr ( $pn, 0, 1 ) ) == strtolower ( $tagword )) {
							$products_tags_arr [] = $pn;
						} else {
							$products_nottags_arr [] = $pn;
						}
					} else {
						if (ereg ( '[0-9]', substr ( $pn, 0, 1 ) )) {
							$products_tags_arr [] = $pn;
						} else {
							$products_nottags_arr [] = $pn;
						}
					}
				}
			}
			asort ( $products_tags_arr );
			if (count ( $products_tags_arr )) {
				foreach ( $products_tags_arr as $ptaIndex => $ptaVal ) {
					for($i = 0; $i < count ( $products_nottags_arr ); $i ++) {
						$producttags_final_arr [] = $ptaVal . ' ' . $products_nottags_arr [$i];
						$producttags_final_arr [] = $ptaVal . ' ' . $products_nottags_arr [$i] . ' ' . $products_nottags_arr [$ptaIndex + 1];
						$producttags_final_arr [] = $ptaVal . ' ' . $products_nottags_arr [$i] . ' ' . $products_nottags_arr [$ptaIndex + 1] . ' ' . $products_nottags_arr [$ptaIndex + 2];
						$producttags_final_arr [] = $ptaVal . ' ' . $products_nottags_arr [$i] . ' ' . $products_nottags_arr [$ptaIndex + 1] . ' ' . $products_nottags_arr [$ptaIndex + 2] . ' ' . $products_nottags_arr [$ptaIndex + 3];
						if ($i > 300) {
							break;
						}
					}
				}
				$zen_SiteMapXML->SitemapSetMaxItems ( count ( $producttags_final_arr ) );
				if (count ( $producttags_final_arr ) > 0) {
					foreach ( $producttags_final_arr as $ptIndex => $ptValue ) {
						$langParm = $zen_SiteMapXML->getLanguageParameter ( $products_names_handle->fields ['language_id'] );
						$link = 'http://'.$_SERVER['SERVER_NAME'].'/Wholesale/'.$producttags_final_arr [$ptIndex];
						$zen_SiteMapXML->SitemapWriteItem ( $link, '', 'weekly' );
					}
					$zen_SiteMapXML->SitemapClose ();
				}
			}
		}
	}
}