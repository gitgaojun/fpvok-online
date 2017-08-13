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
  
  $sql = "select faq_categories_name,faq_categories_description from faq_categories_description where faq_categories_id = '" . (int)$_GET['fcPath'] . "' and language_id = '" . (int)$_SESSION['languages_id'] . "'";
  $faq_metatags = $db->Execute($sql);
  
  define('META_TAG_TITLE', $faq_metatags->fields['faq_categories_name'] . ' ' . TITLE);
  $breadcrumb->add($faq_metatags->fields['faq_categories_name']);
  
  
  $faq_categories_name = $faq_metatags->fields['faq_categories_name'];
  $faq_categories_description = $faq_metatags->fields['faq_categories_description'];

?>