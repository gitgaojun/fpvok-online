<div id="" class="margin_t">
<h4 class="leftBoxBar">Price</h4>
<ul class="price_box history_view allborder no_border_t fl">
<?php 
/*
 * priceList  four part
 */
	    if(zen_has_category_subcategories($current_category_id)){
		    $priceListQuery_sql = '';
			  $priceListQueryArray = array();
			  zen_get_subcategories(&$product_in_categoriesArray,$current_category_id);
			  $priceListQuery_sql = implode(' or p2c.categories_id =',$product_in_categoriesArray);
			  $priceListQuery_sql = '( p2c.categories_id = '.$priceListQuery_sql.')';
	    }else{
			if($current_category_id>0){
				
	    		$priceListQuery_sql = 'p2c.categories_id = ' . (int)$current_category_id;
			
			}else{
				$priceListQuery_sql = '1=1';
			}
	    }
	    $priceListQuery = "SELECT p.`products_price`,p2c.`categories_id` FROM products p,products_to_categories p2c WHERE p2c.products_id=p.products_id AND ". $priceListQuery_sql ." order by products_price";    
		$priceListArray = $db->Execute($priceListQuery);
	    
	    while (!$priceListArray->EOF){
	    	$priceList[] = $priceListArray->fields['products_price'];
	    	$priceListArray->MoveNext();
	    }
	    $priceListOutString = '';
	    $totalNum = sizeof($priceList);
	    if ($totalNum <= 5){
	      $priceListRowNum = 1;
	    }elseif ( 5 < $totalNum and $totalNum <= 15){
	      $priceListRowNum = 2;   
	    }elseif (15 < $totalNum and $totalNum <= 25){
	      $priceListRowNum = 3;
	    }elseif (25 < $totalNum and $totalNum <= 35){
	      $priceListRowNum = 4;
	    }elseif ($totalNum >= 35){
	      $priceListRowNum = 5;
	    }
	    for ($i=0; $i<$priceListRowNum; $i++){
	     $priceListOutString .= '<li>';
	     $priceListOutString .= '<a rel="nofollow" href="'.zen_href_link(FILENAME_DEFAULT, 'cPath='.$current_category_id.'&min_price='.floor($priceList[sizeof($priceList)*$i/$priceListRowNum])).'&max_price='.floor($priceList[sizeof($priceList)*($i+1)/$priceListRowNum-1]).'">';
	     $priceListOutString .= $currencies->display_price($priceList[sizeof($priceList)*$i/$priceListRowNum],zen_get_tax_rate($_GET['products_tax_class_id'])).' - '.$currencies->display_price($priceList[sizeof($priceList)*($i+1)/$priceListRowNum-1],zen_get_tax_rate($_GET['products_tax_class_id']));   	
	     $priceListOutString .= '</a>';
	     $priceListOutString .= '</li>';
	    }
			unset($priceListQuery,$priceListQuery_sql);
			
			echo $priceListOutString;
			?>
<li class="manual"><form onsubmit="return(fmChk(this))" method="get" action="" name="priceSearch"><div class="leftPrice"><input type="text" chkrule="nnull" chkname="Min Price" id="min_price" size="5" name="min_price"> - </div><div class="rightPrice"><input type="text" chkrule="nnull" chkname="Max Price" id="max_price" size="5" name="max_price"></div><div class="priceSearchButton"><input type="submit" value="Go" onmouseout="this.className='cssButton button_send'" onmouseover="this.className='cssButtonHover button_send button_sendHover'" class="cssButton button_send"></div><div class="clear"></div></form></li>            
</ul></div>
<br class="clear" />