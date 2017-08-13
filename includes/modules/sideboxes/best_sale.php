<div id="" class="margin_t">
<h4 class="leftBoxBar">New Arrivals</h4>
<ul style="width: 182px;" class="history_view allborder no_border_t fl">
<?php 
    if (isset($current_category_id) && ($current_category_id > 0)) {
      $best_sellers_query = "select distinct p.products_id, p.products_image, pd.products_name, p.products_price, p.products_ordered
                             from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, "
                                    . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c
                             where p.products_status = '1'
                             and p.products_ordered > 0
                             and p.products_id = pd.products_id
                             and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                             and p.products_id = p2c.products_id
                             and p2c.categories_id = c.categories_id
                             and '" . (int)$current_category_id . "' in (c.categories_id, c.parent_id)
                             order by p.products_ordered desc, pd.products_name
                             limit " . MAX_DISPLAY_BESTSELLERS;

      $best_sellers = $db->Execute($best_sellers_query);

    } else {
      $best_sellers_query = "select distinct p.products_id, p.products_image, pd.products_name, p.products_price, p.products_ordered
                             from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                             where p.products_status = '1'
                             and p.products_ordered > 0
                             and p.products_id = pd.products_id
                             and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                             order by p.products_ordered desc, pd.products_name
                             limit " . MAX_DISPLAY_BESTSELLERS;

      $best_sellers = $db->Execute($best_sellers_query);
    }
 while (!$best_sellers->EOF) {
?>
<li>
<?php echo '<a href="' . zen_href_link(zen_get_info_page($best_sellers->fields['products_id']), 'cPath=' . $productsInCategory[$best_sellers->fields['products_id']] . '&products_id=' . (int)$best_sellers->fields['products_id']) . '" class="ih4" >' . zen_image(DIR_WS_IMAGES . $best_sellers->fields['products_image'], zen_get_products_name($best_sellers->fields['products_id']), 50, 50,' ') . '</a>'; ?>
<span><?php echo '<a href="' . zen_href_link(zen_get_info_page($best_sellers->fields['products_id']), 'cPath=' . $productsInCategory[$best_sellers->fields['products_id']] . '&products_id=' . $best_sellers->fields['products_id']) . '">' . substr($best_sellers->fields['products_name'],0,28)  . '...</a>'; ?></span>
<strong style="padding-left:10px; color:#CC0000"><?php echo $currencies->display_price($best_sellers->fields['products_price'],0) ?></strong>
</li>
<?php 
$best_sellers->MoveNext();
}?>
</ul></div>
<br class="clear" />