<?php if ($linkMark = strpos ( $_SERVER ['REQUEST_URI'], '?' )) {
	$cleanUrl = substr ( $_SERVER ['REQUEST_URI'], 0, $linkMark );
} else {
	$cleanUrl = $_SERVER ['REQUEST_URI'];
}
function cleanSameArg($clean) {
	global $_GET, $cleanUrl;
	$newArg = array ();
	reset ( $_GET );
	while ( list ( $key, $value ) = each ( $_GET ) ) {
		if ($key != 'main_page' and $key != 'cPath' and $key != 'display' and $key != $clean) {
			$newArg [] = $key . '=' . $value;
		}
	}
	if (sizeof ( $newArg ) > 0) {
		return $cleanUrl . '?' . implode ( '&', $newArg );
	} else {
		return $cleanUrl;
	}
}

function cleanSameArgNoHtml($clean) {
	global $_GET, $cleanUrl;
	$newArg = array ();
	reset ( $_GET );
	while ( list ( $key, $value ) = each ( $_GET ) ) {
		if ($key != 'main_page' and $key != 'cPath' and $key != 'display' and $key != $clean) {
			$newArg [] = $key . '=' . $value;
		}
	}
	if (sizeof ( $newArg ) > 0) {
		return '&' . implode ( '&', $newArg );
	} else {
		return FALSE;
	}
}
function cleanSameArg2($clean, $clean2) {
	global $_GET, $cleanUrl;
	$newArg = array ();
	reset ( $_GET );
	while ( list ( $key, $value ) = each ( $_GET ) ) {
		if ($key != 'cPath' and $key != 'display' and $key != $clean and $key != $clean2) {
			$newArg [] = $key . '=' . $value;
		}
	}
	if (sizeof ( $newArg ) > 0) {
		return $cleanUrl . '?' . implode ( '&', $newArg );
	} else {
		return $cleanUrl;
	}
}
function postfixUrl() {
	global $_SERVER;
	$posbool = strpos ( $_SERVER ['REQUEST_URI'], '?' );
	return (is_int ( $posbool ) ? substr ( $_SERVER ['REQUEST_URI'], $posbool ) : '');
}?>
<?php $symbolLeft = $currencies->display_symbol_left($_SESSION['currency']);?>
<div id="content">
        <div class="deal_left fleft">
            <div class="clearance_center margin_t">
                <p class="clearance_text">
                    We have a 24/7 online sale going on in our Clearance Center! You'll find sale prices
                    on everything that you prefer! Everything is on sale and inventory is limited, so
                    find your deal in the Clearance Center today!</p>
            </div>
            <div class="notice mt10">
                <h3>
                    Notice: Use the below advanced search options to find the clearance items that are
                    right for you.</h3>
                <form action="/life_style.html" method="get" id="condition_form">
                    <ul>
                        <li>
                            <span class="type">Category:</span>
            <select name="categoryid" id="deals_categoryid" style="width: 260px;">
                  <option value="all" style="color: rgb(0, 0, 0);">All Categories</option>
             <?php 
			 $categories_query1 = "select c.categories_id,cd.categories_name from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd  where c.categories_status='1' and parent_id = '0' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by sort_order, cd.categories_name"; 
             $categories1 = $db->Execute($categories_query1); 
			 while (!$categories1->EOF) {
				 $select1 = $categories1->fields['categories_id'] == $_GET['categoryid']?'selected="selected"':'';
			 ?>             
                  <option <?php echo $select1 ?> value="<?php echo $categories1->fields['categories_id']; ?>" style="color: rgb(0, 0, 0);"><?php echo $categories1->fields['categories_name'] ?>(<?php echo zen_count_products_in_category($categories1->fields['categories_id']); ?>)</option>
                <?php 
			 $categories_query2 = "select c.categories_id,cd.categories_name from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd  where c.categories_status='1' and parent_id = ".(int)$categories1->fields['categories_id']." and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by sort_order, cd.categories_name"; 
             $categories2 = $db->Execute($categories_query2);
			 if($categories2->RecordCount()>0){ 
			 while (!$categories2->EOF) {
				 $select2 = $categories2->fields['categories_id'] == $_GET['categoryid']?'selected="selected"':'';
			 ?> <option <?php echo $select2 ?> value="<?php echo $categories2->fields['categories_id']; ?>">--<?php echo $categories2->fields['categories_name'] ?>(<?php echo zen_count_products_in_category($categories2->fields['categories_id']); ?>)</option>  
             <?php $categories2->MoveNext();
			 } }?>           
             <?php $categories1->MoveNext();
			 }?>                 
             </select>
                        </li>
                        <li>
                            <span class="type">List Price: From</span>
                            <em class="current_currency">US$</em>
                            <input type="text" style="width: 186px" name="min_price" id="minprice" class="focal_txt" value="<?php echo $_GET['min_price']; ?>">
                            To <em class="current_currency">US$</em>
                            <input type="text" style="width: 186px" name="max_price" id="maxprice" class="focal_txt" value="<?php echo $_GET['max_price']; ?>">
                        </li>
                        <li>
                            <span class="type fleft">Discount (%):</span>
                            <select class="fleft" name="discount" style="width: 100px; margin: 5px 10px 0 0;">
                                <option value="more" <?php if ($_GET['discount']=='more') echo 'selected="selected"'; ?>>&gt;</option>
                                <option value="equals" <?php if ($_GET['discount']=='equals') echo 'selected="selected"'; ?>>=</option>
                                <option value="less" <?php if ($_GET['discount']=='less') echo 'selected="selected"'; ?>>&lt;</option>
                            </select>
                            <input type="text" style="width: 138px;
                                margin: 5px 5px 0 0;" name="offnum" id="offnum" class="focal_txt fleft" value="<?php echo $_GET['offnum']; ?>">
                            off
                        </li>
                        <li style="margin-top: 6px;">
                            <input type="submit" value="" class="btn_refine_search"></li>
                    </ul>
                </form>
            </div>
            <div id="head_below" class="below_chargers mt10">
                <h3>
                    Below Clearance Items Are in <font id="current_topcategory">All Categories</font>
                    <strong>:</strong></h3>
                <p class="below_items">
                    (Orders with Clearance Center items will be deleted from your order if you do not
                    pay within 12 hours)</p>
                <div class="sort_box">
                    <div class="fleft list_sort">
                            <span class="fleft fb">Sort by: </span>
                            <div class="fleft" id="list_sort">
                            <?php  switch($_GET['productsort']){
								      case 2:
									  $staa_name = 'New Arrivals';
									  break;
									  case 3:
									  $staa_name = 'Price from low to high';
									  break;
									  case 4:
									  $staa_name = 'Price from high to low';
									  break;
									  case 5:
									  $staa_name = 'Top Sellers';
									  break;
									  case 6:
									  $staa_name = 'Discount rate from high to low';
									  break;
									  case 7:
									  $staa_name = 'Discount rate from low to high';
									  break;
									  default:
									  $staa_name = 'Best Matches';
							} ?>
                                <a href="javascript:void(0);" class="cf50"><em><?php echo $staa_name; ?></em><span></span></a>
                                <div style="right: 0px; left: 0px; display: none; width:200px;" class="sortByMenu">
                                    <a href="<?php echo zen_href_link($current_page, '&productsort=1');?>" class="cf50">Best Matches</a>
                                    <a href="<?php echo zen_href_link($current_page, '&productsort=5');?>" class="cf50">Top Sellers</a>
                                    <a href="<?php echo zen_href_link($current_page, '&productsort=2');?>" class="cf50">New Arrivals</a>
                                    <a href="<?php echo zen_href_link($current_page, '&productsort=3');?>" class="cf50">Price from high to low</a>
                                    <a href="<?php echo zen_href_link($current_page, '&productsort=4');?>" class="cf50">Price from low to high</a>
									<a href="<?php echo zen_href_link($current_page, '&productsort=6');?>" class="cf50">Discount rate from high to low</a>
									<a href="<?php echo zen_href_link($current_page, '&productsort=7');?>" class="cf50">Discount rate from low to high</a>
                                </div>
                            </div>
                        </div>
                   
                    <div class="clearance_pages fright">
                       <?php
if (($products_new_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
	?>
	
<div class="pagebar g_t_c white_bg">
<div class="split_pages">
<p class="listspan"><?php
	echo TEXT_RESULT_PAGE . ' ' . $products_new_split->display_links_version2 ( MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params ( array ('page', 'info', 'x', 'y' ) ) );
	?></p>
</div>
</div>	
<?php
}
?>
                    </div></div>
                     
                    <div class="clear">
                    </div>
                </div>
                <div class="shopcart">
                <div class="title">
                    <table width="100%" cellspacing="0" cellpadding="0" border="0">
                        <tbody><tr>
                            <td valign="middle" height="33" align="center" class="descriptionCenter" width="378">
                                Description
                            </td>
                            <td width="90" valign="middle" height="33" align="center">
                                Discount
                            </td>
                            <td width="100" valign="middle" height="33" align="center">
                                Status
                            </td>
                            <td valign="middle" height="33" align="center" width="150">
                                List Price
                            </td>
                        </tr>
                    </tbody></table>
                </div>
                <div id="clearance_products" class="shopcart_cont">
                    <ul>
                    <?php $list_box_contents_num = count($list_box_contents);
                          for($row=0; $row<$list_box_contents_num; $row++) {
							 $str_css = ($row+1)==$list_box_contents_num?'class="lastline"':'';
							 $str_url = zen_href_link(zen_get_info_page($list_box_contents[$row]['products_id']), 'cPath=' .zen_get_generated_category_path_rev($_GET['cPath']). '&products_id=' . $list_box_contents[$row]['products_id']);
							
							 if (strstr($list_box_contents[$row]['products_image'],'/')){
							  $imgs=substr_replace($list_box_contents[$row]['products_image'],'l/',0,2);
						  }else{
							  $imgs='l/'.$list_box_contents[$row]['products_image'];
						  }
							  ?>
                        <li <?php echo $str_css; ?>>
                            <table width="100%" cellspacing="0" cellpadding="0" border="0">
                                <tbody><tr>
                                    <td valign="top" align="left" class="descriptionMain" width="378">
                                        <div class="photo fleft">
                                            <a title="<?php echo $list_box_contents[$row]['products_name']; ?>" href="<?php echo $str_url; ?>"><?php echo zen_image_OLD(DIR_WS_IMAGES .$imgs, SEO_COMMON_KEYWORDS . ' ' .$list_box_contents[$row]['products_name'], 150, 116, 'class="margin_1em"'); ?></a></div>
                                        <div class="description fright">
                                            <p class="name">
                                                <a title="<?php echo $list_box_contents[$row]['products_name']; ?>" href="<?php echo $str_url; ?>"><?php echo $list_box_contents[$row]['products_name']; ?></a></p>
                                            <p class="sku">
                                                SKU: <em><?php echo $list_box_contents[$row]['products_model']; ?></em></p>
                                        </div>
                                        <div class="clear">
                                        </div>
                                    </td>
                                    <td width="120" valign="middle" align="center">
                                        <span class="discount"><em><?php echo $list_box_contents[$row]['discount']; ?></em>%</span>
                                    </td>
                                    <td width="85" valign="middle" align="center">
                                        <span class="onsale">On Sale</span>
                                        
                                    </td>
                                    <td valign="middle" align="center" width="150">
                                    <?php
						echo zen_draw_form ( 'cart_quantity_frm', $str_url.'?action=add_product' , 'post', 'enctype="multipart/form-data"' ) . "\n";
						?>
                                        <div class="pt10 below_quantity">
                                            <a class="reduce2 mt5 mr5 fleft" onclick="Changjian(<?php echo $list_box_contents[$row]['products_id']; ?>);"></a>
                                            <input type="hidden" value="<?php echo $list_box_contents[$row]['products_id']; ?>" name="products_id">
                                            <input type="text" class="num_txt2 f11 fleft" value="1" maxlength="3" id="products_<?php echo $list_box_contents[$row]['products_id']; ?>" name="cart_quantity">
                                            <a class="add2 fleft mt5 mr5" onclick="Changjia(<?php echo $list_box_contents[$row]['products_id']; ?>);" ></a>
                                        </div>
                                        <div class="clear">
                                        </div>
                                        <p class="below_price">
                                            <span class="was"><?php echo $symbolLeft.'&nbsp;'.$currencies->noSymbolDisplayPrice($list_box_contents[$row]['products_price'],zen_get_tax_rate($products_tax_class_id)); ?></span><span class="now"><?php echo $symbolLeft.'&nbsp;'.$currencies->noSymbolDisplayPrice($list_box_contents[$row]['specials_new_products_price'],zen_get_tax_rate($products_tax_class_id)); ?></span></p>
                                        <p class="pl18"><input type="submit" class="below_addtocard2" /></p> 
				     <?php echo '</form>';?>                 
                                    </td>
                                </tr>
                            </tbody></table>
                        </li>
                       
                        
                        <?php }?>
                    </ul>
                    
                    <div class="clearance_pages fright">
                        <?php
if (($products_new_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
	?>
	
<div class="pagebar margin_t g_t_c white_bg">
<div class="split_pages">
<p class="listspan"><?php
	echo TEXT_RESULT_PAGE . ' ' . $products_new_split->display_links_version2 ( MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params ( array ('page', 'info', 'x', 'y' ) ) );
	?></p>
</div>
</div>	
<?php
}
?>
                    </div></div>
                    
                    <div class="clear">
                    </div>
                </div>
            </div>
        <div class="deal_right fright">
            
            <div class="deal_ad mt10">
                <ul>
                    <li>
					<img width="230" height="93" border="0" class="img_ad" alt="" src="http://static.googleadsserving.cn/pagead/imgad?id=CICAgICQ3srWbhDmARhdMgjJfXmtMvY2WA">
 </li>
                    <li>

<img width="230" height="93" border="0" class="img_ad" alt="" src="http://static.googleadsserving.cn/pagead/imgad?id=CICAgICQ3sqjbxDmARhdMgh-dtyWEEt1Lg">
  </li>           
			        <li>
					<img width="230" height="93" border="0" class="img_ad" alt="" src="http://static.googleadsserving.cn/pagead/imgad?id=CICAgICQ3srBaxDmARhdMgi0KWfvDWDhTw">
</li>
                </ul>
            </div>

			<?php require('includes/languages/english/html_includes/define_page_8.php');

 ?>
			
        </div>
<div class="clear">
</div>
<script type="application/javascript">
function Changjian(p_id)
{
  var products_id = p_id;		
  var qty =jQuery("#products_"+p_id).attr("value");
  if(qty>1){
	qty--;
	jQuery("#products_"+p_id).val(qty);
	 }
}
function Changjia(p_id)
{
  var products_id = p_id;		
  var qty =jQuery("#products_"+p_id).attr("value");
  if(qty<9999){
	qty++;
	jQuery("#products_"+p_id).val(qty);																		 }
}	
</script> 