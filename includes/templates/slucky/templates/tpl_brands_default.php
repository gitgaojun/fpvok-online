
<?php $symbolLeft = $currencies->display_symbol_left($_SESSION['currency']);?>
<div id="container">
        <div class="lmain">
            
    <div class="revieweditems mt10">
        <div class="revieweditems_hh">
            <h1 class="fleft f11" id="top_classic">
                Most Popular Reviewers</h1>
            
            
        </div>
        <div class="release_dates1">
            <ul class="reviewer_rank">
            <?php $check_valid = $db->Execute("select count(customers_id),customers_name from reviews where status =1
                                 group by customers_id having count(customers_id) >0 limit 5");
				 if ($check_valid->RecordCount() > 0) {
					 $it=1;
				   while (!$check_valid->EOF) {
				 ?>
                <li class="c66">
                    <span class="cf50 f14 pr10"><?php echo $it; ?></span>
                    <?php echo $check_valid->fields['customers_name']; ?>&nbsp;(<em class="f11"><?php echo $check_valid->fields['count(customers_id)']; ?></em>)
                </li>
                <?php
				  $it++;
				   $check_valid->MoveNext();
				 } }?>
            </ul>
        </div>
    </div>

            
    <div class="revieweditems mt10">
        <div class="revieweditems_hh">
            
            <h1 class="fleft f11" id="top_weeks">
                Last Week Top Reviewers</h1>
            
        </div>
        <div class="release_dates1">
            <ul class="reviewer_rank">
            <?php 
			if(date("d")-7>0){
				$aa = date("d")-7<10?'0':'';
			  $date_now = date("Y").'-'.date("m").'-'.$aa.(date("d")-7);
			}else{
			  $date_now = date("Y").'-'.(date("m")-1).'-'.(date("d")+23);	
			}
			
			$check_valid = $db->Execute("select count(customers_id),customers_name from reviews where status =1 and DATE_FORMAT(`date_added`,'%Y-%m-%d') > '".$date_now."'
                                 group by customers_id having count(customers_id) >0 limit 5");
								 
				 if ($check_valid->RecordCount() > 0) {
					 $it=1;
				   while (!$check_valid->EOF) {
				 ?>
                <li class="c66">
                    <span class="cf50 f14 pr10"><?php echo $it; ?></span>
                    <?php echo $check_valid->fields['customers_name']; ?>&nbsp;(<em class="f11"><?php echo $check_valid->fields['count(customers_id)']; ?></em>)
                </li>
              <?php
				  $it++;
				   $check_valid->MoveNext();
				 } }?>      
            </ul>
        </div>
    </div>

            
    <div class="revieweditems mt10">
        <div class="revieweditems_hh">
            
            
            <h1 class="fleft f11" id="top_images">
                Top Ranked Images</h1>
        </div>
        <div class="release_dates1">
            <ul class="reviewer_rank">
            
                 <?php $check_valid = $db->Execute("select count(customers_id),customers_name from reviews where status =1 and picture_1 !='' group by customers_id having count(customers_id) >0 limit 5");
				 if ($check_valid->RecordCount() > 0) {
					 $it=1;
				   while (!$check_valid->EOF) {
				 ?>
                <li class="c66">
                    <span class="cf50 f14 pr10"><?php echo $it; ?></span>
                    <?php echo $check_valid->fields['customers_name']; ?>&nbsp;(<em class="f11"><?php echo $check_valid->fields['count(customers_id)']; ?></em>)
                </li>
                <?php
				  $it++;
				   $check_valid->MoveNext();
				 } }?>
            </ul>
        </div>
    </div>

        </div>
        <div class="rmain mt10">
            <!--Latest Customer Images-->
            
            <div id="latest_image" class="hotitem w968">
                <div class="hotitem_h">
                    <span class="fb fleft">Latest Customer Images</span>
                </div>
                <div class="hhotitem_m alignL">
                    <div class="items">
                    <?php $check_valid = $db->Execute("select r.products_id,r.picture_1,r.customers_name,rd.reviews_title from reviews r,reviews_description rd where r.status =1 and r.picture_1 !='' and r.reviews_id=rd.reviews_id order by r.reviews_id desc limit 20");
				 if ($check_valid->RecordCount() > 0) {
					 $it=1;
				     while (!$check_valid->EOF) {
						 $img = explode(",",$check_valid->fields['picture_1']);
						 $products_price = zen_get_products_base_price($check_valid->fields['products_id']);
						 $url = zen_href_link(zen_get_info_page($check_valid->fields['products_id']), 'cPath=' . $productsInCategory[$check_valid->fields['products_id']] . '&products_id=' . (int)$check_valid->fields['products_id']);
				 ?>
                        <div class="itembox2 ml15 mb20 h24">
                            <ul class="infobox2">
                                <li class="proImg2">
                                    <img alt="good size" src="images/<?php echo $img[0]; ?>"></li>
                                <li class="proName2 f11"><?php echo $check_valid->fields['reviews_title']; ?></li>
                                <li class="proPri2 cf50 f14"><?php echo $symbolLeft.'&nbsp;'.$currencies->noSymbolDisplayPrice($products_price,0); ?></li>
                                <li class="proSku">SKU:<?php echo zen_get_products_model($check_valid->fields['products_id']); ?></li>
                                <li class="prolist">by <span class="chargers f11 pl5"><?php echo $check_valid->fields['customers_name']; ?></span></li>
                                <li  class="proVerified"><a href="<?php echo $url; ?>"></a></li>
                            </ul>
                        </div>
                    <?php
				     $it++;
				    $check_valid->MoveNext();
				    } }?>   
                    </div>
                    <div class="clear">
                    </div>
                </div>
            </div>
			
            <div id="latest_reviews" class="hotitem w968 mt10">
                <div class="hotitem_h">
                    <span class="fb fleft">Community</span>
                    <div class="fright mr10 f11">
                        <a href="/brands.html?filter=default#display_full" class="cblueulin" id="display_default">Default Show Details</a> /<a href="/brands.html?filter=full#display_full" _filter="full" id="display_full">Show Full Reviews</a></div>
                </div>
                <div class="hhotitem_m alignL">
                    <div class="items">
                    <a name="display_full"></a>
                     <?php 
					 $limt = $_GET['filter']=='full'?30:20;
					 $check_valid = $db->Execute("select r.products_id,r.picture_1,r.customers_name,p.products_image,rd.reviews_title,rd.reviews_text from reviews r,reviews_description rd,products p where r.status =1 and r.reviews_id=rd.reviews_id and r.products_id=p.products_id order by r.reviews_id desc limit ".$limt);
				 if ($check_valid->RecordCount() > 0) {
					 $it=1;
				     while (!$check_valid->EOF) {
						 $img = explode(",",$check_valid->fields['products_image']);
						  $products_price = zen_get_products_base_price($check_valid->fields['products_id']);
						 $url = zen_href_link(zen_get_info_page($check_valid->fields['products_id']), 'cPath=' . $productsInCategory[$check_valid->fields['products_id']] . '&products_id=' . (int)$check_valid->fields['products_id']);              
						 
						 
						 if($_GET['filter']=='full'){
				 ?>
                        <div class="guid_id">
                            <ul class="guid_id1">
                                <li class="proImg2"><a href="<?php echo $url; ?>">
                                    <img width="155" height="120" src="<?php echo str_replace("/s/","/l/",'images/'.$img[0]); ?>"></a></li>
                                <li class="proName2 f11 h28 c00"><a href="javascript:void(0);" title=""><?php echo zen_get_products_name($check_valid->fields['products_id']); ?></a></li>
                                <li class="proPri2 cf50 f14"><?php echo $symbolLeft.'&nbsp;'.$currencies->noSymbolDisplayPrice($products_price,0); ?></li>
                                <li class="proRank"><a class="buttonAddCart" href="<?php echo $url ?>?action=buy_now">in Cart</a></li>
                              </ul><ul class="guid_di2">
                              
                              <li class="prolist c00"><?php echo $check_valid->fields['reviews_text']; ?></li>
                            </ul>
                            <ul class="guid_di3"><li><a href="<?php echo $url; ?>"><Img src="includes/templates/slucky/images/detaill.png" /></a> <?php echo $check_valid->fields['customers_name']; ?></li>
                            <li style="height:17px; line-height:17px;"> <a href="/" target="_blank" rel="nofollow">(<em><?php echo zen_get_reviews($check_valid->fields['products_id']); ?></em>)</a></li></ul>
                        </div>
                        <?php }else{?>
                        <div class="itembox2 ml15 mb20">
                            <ul class="infobox2">
                                <li class="proImg2"><a href="<?php echo $url; ?>">
                                    <img width="155" height="120" src="<?php echo str_replace("/s/","/l/",'images/'.$img[0]); ?>"></a></li>
                                <li class="proName2 f11 h28 c00"><a href="javascript:void(0);" title=""><?php echo $check_valid->fields['reviews_title']; ?></a></li>
                                <li class="proPri2 cf50 f14"><?php echo $symbolLeft.'&nbsp;'.$currencies->noSymbolDisplayPrice($products_price,0); ?></li>
                                <li class="proRank">
                                    <a href="/" target="_blank" rel="nofollow">(<em><?php echo zen_get_reviews($check_valid->fields['products_id']); ?></em>)</a></li>
                                <li class="prolist c00">Posted by <span class="chargers f11 pl5"><?php echo $check_valid->fields['customers_name']; ?></span></li>
                                <li class="proVerified"><a href="<?php echo $url; ?>" ></a></li>
                            </ul>
                        </div>
                        <?php }?>
                       <?php
				     $it++;
				    $check_valid->MoveNext();
				    } }?> 
                    </div>
                    <div class="clear">
                    </div>
                    
                </div>
            </div>
            <!--Latest Reviews-->
        </div>
    </div>