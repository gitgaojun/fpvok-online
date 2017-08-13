<?php
/**
 * Common Template - tpl_tabular_display.php
 *
 * This file is used for generating tabular output where needed, based on the supplied array of table-cell contents.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_tabular_display.php 3957 2006-07-13 07:27:06Z drbyte $
 */

//print_r($list_box_contents);

?>
<?php
if (!function_exists("stripos")) {
  function stripos($str,$needle) {
   return strpos(strtolower($str),strtolower($needle));
  }
}
?>

<?php
	$list_box_contents_num = count($list_box_contents);
  for($row=0; $row<$list_box_contents_num; $row++) {
  if(isset($_GET['keyword'])){
  	$list_box_contents_keywordPos[$row] = stripos($list_box_contents[$row]['products_name'],$_GET['keyword']);
  	if (is_int($list_box_contents_keywordPos[$row])) {
	    $list_box_contents_name[$row] = str_ireplace($_GET['keyword'],'<span class="red">'.$_GET['keyword'].'</span>',$list_box_contents[$row]['products_name']);
  	}else{
	    $list_box_contents_name[$row] = $list_box_contents[$row]['products_name'];
  	}
  	
  	$list_box_contents_description_Pos[$row] = stripos($list_box_contents[$row]['products_description'],$_GET['keyword']);
  	if (is_int($list_box_contents_description_Pos[$row])){ 		
	    $list_box_contents_description[$row] = str_ireplace($_GET['keyword'],'<span class="red">'.$_GET['keyword'].'</span>',$list_box_contents[$row]['products_name']);
  	}else{
	    $list_box_contents_description[$row] = $list_box_contents[$row]['products_description'];
  	}
  }else {
  	$list_box_contents_name[$row] = $list_box_contents[$row]['products_name'];
  	$list_box_contents_description[$row] = $list_box_contents[$row]['products_description'];
  }
	echo '<ul class="list_product  clear">';
	if($list_box_contents[$row]['featured_id']>=1){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td class="list_product2">
	<?php }?>
<li class="relative">
<?php if($list_box_contents[$row]['products_quantity'] == 0) { ?>
			<span class="sold_out"></span>
<?php }else{ ?>
			<?php	if($list_box_contents[$row]['product_is_wholesale']){ ?>
				<span class="sale_item"></span>
			<?php } ?>
<?php } ?>
<?php 
if (strstr($list_box_contents[$row]['products_image'],'/')){
$imgs=substr_replace($list_box_contents[$row]['products_image'],'l/',0,2);
}else{
$imgs='l/'.$list_box_contents[$row]['products_image'];
}

echo '<a href="' . zen_href_link(zen_get_info_page($list_box_contents[$row]['products_id']), 'cPath=' .zen_get_generated_category_path_rev($_GET['cPath']). '&products_id=' . $list_box_contents[$row]['products_id']) . '" class="ih" >' . zen_image_OLD(DIR_WS_IMAGES .$imgs, SEO_COMMON_KEYWORDS . ' ' .$list_box_contents[$row]['products_name'], 128, 128, 'class=""') . '</a>'?>
</li>
<li class="li_con">
<dl>
<dt><?php echo '<a class="css100" href="' . zen_href_link(zen_get_info_page($list_box_contents[$row]['products_id']), 'cPath=' .zen_get_generated_category_path_rev($_GET['cPath']). '&products_id=' . $list_box_contents[$row]['products_id']) .'"><strong class="big">'.$list_box_contents_name[$row]. '</strong></a>';?></dt>
<dd class="product_detail">
<strong>Description: </strong><?php echo $list_box_contents_description[$row].' <a class="css100" href="' . zen_href_link(zen_get_info_page($list_box_contents[$row]['products_id']), 'cPath=' .zen_get_generated_category_path_rev($_GET['cPath']). '&products_id=' . $list_box_contents[$row]['products_id']) . '">Product Detail &gt;&gt;</a>';?>

<?php echo $list_box_contents[$row]['product_is_always_free_shipping'];?></dd>
<dd>
	            <strong>Start From: </strong><?php echo $list_box_contents[$row]['products_quantity_order_min'].' Unit(s)';?>
	        </dd>
	          <dd>
	            <strong><span class="fl">Review:&nbsp;&nbsp;</span></strong>
	            <?php echo zen_get_reviews($list_box_contents[$row]['products_id']); ?>			              

	        </dd>
	        
	    </dl>
	</li>	
	<li>
	   <dl>	   	    
	    <dd class="product_detail">
      <strong>Our Price: </strong><strong class="red big">
	   <?php  if($list_box_contents[$row]['products_maxprice']>0){
	  echo ($currencies->display_price($list_box_contents[$row]['products_maxprice'],zen_get_tax_rate($products_tax_class_id))."~US$".number_format($list_box_contents[$row]['products_price'],2));
	  }else{
	  echo $currencies->display_price($list_box_contents[$row]['products_price'],zen_get_tax_rate($products_tax_class_id));
	  } ?></strong><br/>
         
      </dd>
	   </dl>
		 <?php if ($list_box_contents[$row]['products_quantity'] > 0) { ?>
		   <a href="<?php echo zen_href_link(zen_get_info_page($list_box_contents[$row]['products_id']),'cPath='.zen_get_generated_category_path_rev($_GET['cPath']).'&products_id='.$list_box_contents[$row]['products_id'].'&action=buy_now'); ?>" class="buttonAddCart">in Cart</a>	
		 <?php } ?>
	    	     
	    
<?php
		echo '</li>';
if($list_box_contents[$row]['featured_id']>=1){
echo'</td>
  </tr>
</table>';
}
echo'</ul>';
  }
?> 
