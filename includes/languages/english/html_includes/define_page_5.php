<div class="bot_con mauto">
        <!--recenthistory-->
        
    <div class="recenthistory fleft">
        <div class="recenthistory_h">
            <h5 class="fleft fb f12">
                <em class="f11">Your Recent History Recently Viewed Items</em>
            </h5>
			<a href="javascript:void(0);" class="fright f11" id="clear_recent_history">Clear your
                recent history</a>
        </div>
           <div class="recent_nodata fleft alignC hide" style="display: block;">
			<?php require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/history_viewed_hj.php'));?>  </div>
 
     <div class="r_searches c66 alignL f11">
            Recently Searches:
            <?php $check_valid = $db->Execute("select search from customers_searches order by freq desc limit 5");
				  while (!$check_valid->EOF) {
				  echo '<a href="wholesaletags/'.$check_valid->fields['search'].'.html">'.$check_valid->fields['search'].'</a>&nbsp;';
				  $check_valid->MoveNext();	
				  }		 
								 ?>
        
        </div>
    </div>
        <div class="continueshopping fleft">
        <div class="continueshopping_h">
            Continue Shopping:
            </div>
        <div class="continueshopping_m alignL">
            <div class="continue_pages mr10 hide">
                <div class="continue_prev hide">
                </div>
            </div>
            <div class="continue_warp">
                <div class="items pt8 continue">
                <?php $random_featured_products_query = "select p.products_id, p.products_image, pd.products_name,
                                       p.master_categories_id
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_FEATURED . " f on p.products_id = f.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = f.products_id
                           and p.products_id = pd.products_id
                           and p.products_status = 1
                           and f.status = 1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' limit 2";
					$random_featured_product = $db->Execute($random_featured_products_query);	
					while (!$random_featured_product->EOF) {   
					$featured_box_price = zen_get_products_display_final_price($random_featured_product->fields['products_id']);
					$aa_name = strlen($random_featured_product->fields['products_name'])>20?Substr ($random_featured_product->fields['products_name'],0,20).'...':$random_featured_product->fields['products_name'];
						   ?>
                    <div class="itembox ml12">
                        <ul class="infobox">
                            <li class="">
                                <?php echo '<a href="' . zen_href_link(zen_get_info_page($random_featured_product->fields["products_id"]), 'cPath=' . zen_get_generated_category_path_rev($random_featured_product->fields["master_categories_id"]) . '&products_id=' . $random_featured_product->fields["products_id"]) . '">' . str_replace("/s/","/l/",zen_image(DIR_WS_IMAGES . $random_featured_product->fields['products_image'], SEO_COMMON_KEYWORDS . ' ' .$random_featured_product->fields['products_name'], 160, 160)).'</a>'; ?></li>
                            <li class="proName h14 f11">
                                <?php echo '<a href="' . zen_href_link(zen_get_info_page($random_featured_product->fields["products_id"]), 'cPath=' . zen_get_generated_category_path_rev($random_featured_product->fields["master_categories_id"]) . '&products_id=' . $random_featured_product->fields["products_id"]) . '">' . $aa_name.'</a>'; ?></li>
                            <li class="proPri">
                                <span class="cf50 fb f123"><?php echo $featured_box_price; ?></span>
                            </li>
                            
                        </ul>
                    </div>
                    <?php 
					$random_featured_product->MoveNext();
					}
					?>
                </div>
            </div>
            <div class="continue_pages hide">
                <div class="continue_next hide">
                </div>
            </div>
        </div>
    </div>
    </div>
	 <script type="text/javascript">
            jQuery("#clear_recent_history").click(function () {
				jQuery(".recent_nodata").html('You have no recently viewed items or searches');
				jQuery.ajax({
					  url:"clear_history.php",
					  dataType:"json",
					  type:"POST",
					  data:jQuery("#order_remark").serialize(),
					  success:function(data){
						
					  }
				});
				return false;
            });
		</script>
		
	