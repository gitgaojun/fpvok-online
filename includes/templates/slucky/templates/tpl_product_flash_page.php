<div class="fl relative" id="product_flash_page">
<ul class="max_flash_width" id="recent_flash_small">
<?php
	$flash_page_query = "select p.products_id,p.products_image,pd.products_name from " . TABLE_PRODUCTS ." p, ". TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status=1 and p.`products_id`=pd.`products_id` AND master_categories_id = " . zen_get_products_category_id($products_id)." order by p.products_recommend DESC,p.products_sort_order,p.products_id desc limit 5";
	$flash_page = $db->Execute($flash_page_query);
	while(!$flash_page->EOF){
?>
<li id="li<?php echo $i;?>">
<a target="_blank" id="cell_link<?php echo $i;?>" href="<?php echo zen_href_link(zen_get_info_page($flash_page->fields['products_id']), 'products_id=' .$flash_page->fields['products_id']);?>"><?php echo str_replace("/s/","/l/",zen_image_OLD(DIR_WS_IMAGES.$flash_page->fields['products_image'],SEO_COMMON_KEYWORDS.' '.$flash_page->fields['products_name'],150,150,'id="cell_img'.$i.'" '));?></a><br /><a target="_blank" id="cell_link<?php echo $i;?>" href="<?php echo zen_href_link(zen_get_info_page($flash_page->fields['products_id']), 'products_id=' . $flash_page->fields['products_id']);?>"><?php echo substr($flash_page->fields['products_name'],0,40).'...';?></a><br /><br />
<strong id="cell_price<?php echo $i?>" class="red" style="font-weight: bold; font-size: 18px;"><?php echo $currencies->display_price((zen_get_products_base_price($flash_page->fields['products_id']) == 0 ? zen_get_products_sample_price($flash_page->fields['products_id']): zen_get_products_base_price($flash_page->fields['products_id'])),zen_get_tax_rate($product_check->fields['products_tax_class_id'])); ?></strong>
</li>
<?php
$flash_page->MoveNext();
}

?>

</ul>

</div>

