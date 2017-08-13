<?php
if (!function_exists("stripos")) {
  function stripos($str,$needle) {
   return strpos(strtolower($str),strtolower($needle));
  }
}
?>

<div id="list_bg_img">
<ul>
<?php
  $list_box_contentsNum = count($list_box_contents);
  for($row=0; $row<$list_box_contentsNum; $row++) {
    if(isset($_GET['keyword'])){
      $list_box_contents_keywordPos[$row] = stripos($list_box_contents[$row]['products_name'],$_GET['keyword']);

      if (is_int($list_box_contents_keywordPos[$row])) {

        $list_box_contents_name[$row] = str_ireplace($_GET['keyword'],''.$_GET['keyword'].'',$list_box_contents[$row]['products_name']);

      }else{

        $list_box_contents_name[$row] = $list_box_contents[$row]['products_name'];

      } 

    }else {

      $list_box_contents_name[$row] = $list_box_contents[$row]['products_name'];

    }

  	$pro_recom_Grid = "";

	if($list_box_contents[$row]['products_recommend']==1)

	{

		$pro_recom_Grid = "pro_recom_Grid";

	}

?>

<li class="<?php echo $pro_recom_Grid; ?>">

<div><ul><li class="relative">

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

echo $list_box_contents[$row]['product_is_sale_item'].'<a href="' . zen_href_link(zen_get_info_page($list_box_contents[$row]['products_id']), 'cPath=' .zen_get_generated_category_path_rev($_GET['cPath']). '&products_id=' . $list_box_contents[$row]['products_id']) . '" class="ih4" >' . zen_image_OLD(DIR_WS_IMAGES .$imgs, SEO_COMMON_KEYWORDS . ' ' .$list_box_contents[$row]['products_name'], 150, 150, 'class=""') . '</a>'?>
<?php if ($list_box_contents[$row]['products_quantity']<1){ ?>
<span class="pro_instock"></span>
<?php }?>
</li>
<p style="overflow:hidden; float:left;">

<?php 
if(strlen($list_box_contents_name[$row])>30){
$aa_name1 = explode(" ",substr($list_box_contents_name[$row],0,30));

$aa_name = count($aa_name1)>7?substr($list_box_contents_name[$row],0,30):substr($list_box_contents_name[$row],0,30);
$aa_name .='...';
}else{
$aa_name = $list_box_contents_name[$row];
}
echo '<a href="' . zen_href_link(zen_get_info_page($list_box_contents[$row]['products_id']), 'cPath=' .zen_get_generated_category_path_rev($_GET['cPath']). '&products_id=' . $list_box_contents[$row]['products_id']) . '" >'.$aa_name. '</a>';
?>


</p>

<div>
<?php if ($list_box_contents[$row]['products_quantity'] > 0) {
      echo '<span><span class="car_price">';
      echo ($list_box_contents[$row]['products_price'] == 0 ? $currencies->display_price($list_box_contents[$row]['products_price_sample'],zen_get_tax_rate($products_tax_class_id)):zen_get_products_display_price($list_box_contents[$row]['products_id']));
      echo '</span></span>';
    }else{
      echo '<span">';
      echo ($list_box_contents[$row]['products_price'] == 0 ? $currencies->display_price($list_box_contents[$row]['products_price_sample'],zen_get_tax_rate($products_tax_class_id)): zen_get_products_display_price($list_box_contents[$row]['products_id']));
      echo '</span>';
    }
    ?>

</div>

<div><?php echo zen_get_reviews($list_box_contents[$row]['products_id']) ?>	</div>


</ul></div>

</li>

<?php

  }

?>

</ul>

</div>

<br class="clear"  />

