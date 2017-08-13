<div class="grid_main_wrap mb10">
<img wclass="img_ad" alt="" src="/images/7051715966212002534.jpg">
</div>     
<h5 class="c02 f113"> New Arrivals : <span class="c99">Released within the last 15 days.</span></h5>
<div id="category_content" class="released" style="position: relative; z-index: 60;">
<h1 class="f14 c00">Categories Released in Recent 15 Days</h1>
<div class="sortoneList">
<?php $categories_query1 = "select c.categories_id,cd.categories_name
										 from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
										 where c.categories_id = cd.categories_id and c.parent_id = 0 
										 and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
										 order by sort_order";
  $categories1 = $db->Execute($categories_query1);
  if($categories1->RecordCount()>0){
	  $ic=1;
	  while (!$categories1->EOF) {
	  ?>
<div class="fleft current_sortoneList" style="position: relative">
                                <a class="current_categories" _categoryId="00<?php echo $ic; ?>" href="javascript:void(0);" onclick="focal.navigator( this,'L25ldy1hcnJpdmFscy9jYXRlZ29yeT9jYXRlZ29yeUlkPTAwMSZwYWdlc2l6ZT0zNiZwYWdlPTE=' );return false;">
                                    <abbr><?php echo $categories1->fields['categories_name']; ?></abbr><em>(<?php echo zen_count_products_in_category($categories1->fields['categories_id']); ?>)</em><span></span></a>
 <?php $categories_query2 = "select c.categories_id,cd.categories_name
							from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
							where c.categories_id = cd.categories_id and c.parent_id = '" . (int)$categories1->fields['categories_id']. "' and cd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by sort_order";
  $categories2 = $db->Execute($categories_query2);
     if($categories2->RecordCount()>0){
	  $ic3=1;
	  ?>                        
         <div class="sortList">
       <?php     while (!$categories2->EOF) {         
				 $url = zen_href_link(FILENAME_DEFAULT, "cPath=".$categories2->fields['categories_id']);
				   ?>
        <a _categoryId="00<?php echo $ic; ?>00<?php echo $ic3; ?>" href="<?php echo $url; ?>">
      <abbr><?php echo $categories2->fields['categories_name']; ?></abbr><em>(<?php echo zen_count_products_in_category($categories2->fields['categories_id']); ?>)</em></a>
  <?php $ic3++;
        $categories2->MoveNext(); } ?>
                                </div>
           <?php }?>    
                            </div>
      <?php 
	  $ic++;
   $categories1->MoveNext();
	  }
  }
	  ?>                      
</div>
<div class="clear"></div>
<div class="clear"></div>
</div>
<script type="text/javascript">
        jQuery(function () {
            jQuery(".current_categories").each(function () {
                var time;
                jQuery(this).add(jQuery(this).next(".sortList")).hover(function () {
                    clearTimeout(time);
                    if (jQuery(this).is(".sortList")) {
                        jQuery(this).show();
                    } else {
                        jQuery(this).addClass("active");
                        jQuery(this).next(".sortList").show();
                    }

                }, function () {
                    //alert(jQuery(this).html());
                    time = setTimeout(function () {
                        jQuery(".current_categories").removeClass("active");
                        jQuery(".sortList").hide();
                    }, 5)
                });
            });
            var len = jQuery(".current_sortoneList").length - 1;
            jQuery("category_content .sortoneList").each(function () {
                var index = 1;
                for (i = len; i >= 0; i--) {
                    //alert(i);
                    //alert(jQuery('.catelist:eq('+i+')').html());
                    jQuery('.current_sortoneList:eq(' + i + ')').css("z-index", index);
                    index++;
                }
            });
        })
    </script>