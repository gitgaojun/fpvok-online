<div class="topseller mt10 w220">
        <div class="topseller_h w220">Top Sellers</div>
        <div style="height: auto" class="topseller_m w218">
        <?php 
		if(zen_has_category_subcategories($current_category_id)){
		$product_in_categories_sql = '';
		$product_in_categoriesArray = array();
		zen_get_subcategories(&$product_in_categoriesArray,$current_category_id);
		$product_in_categories_sql = implode(' or p.master_categories_id =',$product_in_categoriesArray);
		$product_in_categories_sql = '( p.master_categories_id ='.$product_in_categories_sql.')';			
		}else{
			$product_in_categories_sql = 'p.master_categories_id = ' . (int)$current_category_id;
		}
		
		    $featured_products_query = "select p.products_id, p.products_image, pd.products_name
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = pd.products_id
                           and p.products_status = 1 and ".$product_in_categories_sql."
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' ORDER by p.products_id desc limit 6";
			$specials_index = $db->Execute($featured_products_query);
			if ($specials_index->RecordCount() > 0) {
				while (!$specials_index->EOF) {
					$url = zen_href_link(zen_get_info_page($specials_index->fields['products_id']), 'cPath=' . $productsInCategory[$specials_index->fields['products_id']] . '&products_id=' . (int)$specials_index->fields['products_id']);
					$products_price = zen_get_products_display_final_price($specials_index->fields['products_id']);			   
						   ?>
            <li class="w202"><span class="topseller_pic fleft"><a href="<?php echo $url ?>">
               <?php echo zen_image(DIR_WS_IMAGES . $specials_index->fields['products_image'], SEO_COMMON_KEYWORDS . ' ' .zen_get_products_name($specials_index->fields['products_id']), 45, ' ',' class="fl"'); ?></a></span> <span class="topseller_pro_name w136 fleft">
                    <a href="<?php echo $url; ?>" class="f11"><?php echo $specials_index->fields['products_name']; ?></a></span>
                <span currencycode="USD" class="topseller_price fleft cf50 f11"><?php echo $products_price; ?></span>
                <div class="clear">
                </div>
            </li>
            <?php $specials_index->MoveNext();
                    }
  }?>
            <a href="/best_deal.html" class="db mt10 pl10 fleft mb10 seemore">See More &gt;&gt;</a>
        </div>
    </div>