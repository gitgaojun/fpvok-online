<div class="minframe fl">

 <div class="bg_box_gray margin_t clear">
<div class="BoxBar">My Account</div>
	<div class="pad_14px pad_t allborder no_border_t">
	<ul class="red_arrow_list">
	<li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT,'','SSL'); ?>">My Orders</a></li>
	<li><a href="/reviews.html">My Reviews</a></li>
	<li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT_EDIT,'','SSL');?>">My Profile</a></li>
	<li><a href="<?php echo zen_href_link(FILENAME_MANAGER_ADDRESS,'','SSL');?>">My Address</a></li>
    <li><a class="red b" href="/index.php?main_page=un_wishlist">My Wishlist</a></li>
	</ul>
	</div>
</div>

<div class="bg_box_gray margin_t clear">
	<div class="BoxBar">Need help</div>
		<span class="pad_10px pad_t block allborder no_border_t">If you have questions or need help with your account, you may <a class="u" href="/faq_info.html?faqs_id=150&fcPath=21">contact us</a> to assist you.	</span>
</div>
</div>


<div class="right_big_con margin_t line_30px">


<h2 ><b>Your Wish List</b></h2>
Here are all the great products you have added to your Wishlist

<?php 
if ( $messageStack->size('un_wishlist') > 0 ) { 
	echo $messageStack->output('un_wishlist'); 
}
?>


<table cellspacing="0" cellpadding="0" border="0" class="tabel wishlist_items">
	<tbody>
		<tr class="thead">
			<td class="col_1">&nbsp;</td>
			<td class="col_2">Description</td>
			<td class="col_3">Price</td>
			<td class="col_4">Action</td>
		</tr>
		
<?php 

if ($listing_split->number_of_rows > 0) {
	$rows = 0;
	$products = $db->Execute($listing_split->sql_query);
	while (!$products->EOF) {
	
if (strstr($products->fields['products_image'],'/')){
$imgs=substr_replace($products->fields['products_image'],'l/',0,2);
}else{
$imgs='l/'.$products->fields['products_image'];
}

$products_price = zen_get_products_display_price($products->fields['products_id']);	
	
	?>		
	<tr>
			<td align="center">&nbsp;</td>
			<td class="prod_desc">
			<div title="<?php echo $products->fields['products_name']; ?>" class="pic">
			<?php echo '<a href="' . zen_href_link(zen_get_info_page($products->fields['products_id']), 'products_id=' . $products->fields['products_id']) . '">'. zen_image(DIR_WS_IMAGES . $imgs, $products->fields['products_name'], '', '100', 'class="productlist"'); ?></a>
			</div>
			<h4><?php echo '<a href="' . zen_href_link(zen_get_info_page($products->fields['products_id']), 'products_id=' . $products->fields['products_id']) . '">'. $products->fields['products_name']; ?></a></h4>
			</td>
			<td  style="text-align: center;">
			<p class="price"><b>
	<?php 
			
      echo $currencies->display_price($products->fields['products_price'],zen_get_tax_rate($products_tax_class_id));

    ?></b></p>
			</td>
			<td>
			<!--bof Form start-->
<?php
						
	echo zen_draw_form ( 'cart_quantity_frm', zen_href_link ( 'un_wishlist', zen_get_all_get_params ( array ('action' ) ) . 'action=add_product' ), 'post', 'enctype="multipart/form-data"' ) . "\n";
	echo zen_draw_hidden_field ( 'products_id', $products->fields['products_id'] );
	echo zen_draw_hidden_field ( 'cart_quantity',1);
	
	echo '<input type="submit" title="Add to Cart" alt="Add to Cart" class="buttonAddCart">';
	
	echo '</form>' ?>
			
	<?php echo '<a class="links delete" rel="nofollow" href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action')) . 'action=un_remove_wishlist&products_id=' . $products->fields['products_id']) . '">' ?>Delete</a>		
			
</td>
		</tr>
		
<?php $products->MoveNext(); ?>	
<?php } // end if products ?>	

<?php } else { ?>
	<p><?php echo UN_TEXT_NO_PRODUCTS; ?></p>
	
<?php } // end if products ?>

		
				<tr class="tfoot">
			<td align="center">&nbsp;</td>
			<td colspan="3">
<?php if (($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) { ?>

<div class="g_t_c ">

<div class="split_pages">
<span class="fl"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></span>
<span class="f1">&nbsp;&nbsp;&nbsp;<?php echo 'Page' . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></span>

</div></div>


<?php } // end paging bottom ?>
			</td>
		</tr>
	</tbody>
</table>

</div> <!-- end (un) id for styling -->