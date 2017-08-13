<div class="grid_main_wrap mt10">
<h5 class="c02 f113">
                        Browse Top Selling By Category <span class="c99">Our most popular items ranked by number of sales. updated daily</span></h5>
						
						<div style="position: relative; z-index: 60;" class="released" id="category_content">
                        <h3 class="f11 mt10 pl10">
                             <a href="/best_deal.html" class="cf50">&lt;Any Category</a></h3>
                        <div class="sortoneList">
           <?php  $shopping_categories_query4 = "select c.categories_id,c.categories_image, cd.categories_name,cd.categories_description
										 from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
										 where c.categories_id = cd.categories_id and c.categories_type = 3 
										 and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
										 order by sort_order";
  $shopping_categories = $db->Execute($shopping_categories_query4);
  
  if($shopping_categories->RecordCount()>0){
  $whats_new_box_counter = 0;
  while (!$shopping_categories->EOF) {?>             
                            <div style="position: relative" class="fleft current_sortoneList padd">
                                <a id="category_001" href="<?php echo zen_href_link(FILENAME_DEFAULT, "cPath=".$shopping_categories->fields['categories_id']); ?>">
                                    <abbr><?php echo $shopping_categories->fields['categories_name'] ?></a>
                            </div>
    <?php $shopping_categories->MoveNext();
  }
  }?>                        
                        </div>
                        <div class="clear">
                        </div>
                    </div>
					          </div>