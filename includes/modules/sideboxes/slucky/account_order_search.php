<?php

?>
<form onsubmit="return check_search_orders(this);" method="post" action="<?php echo zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO,'','SSL') ?>" name="search_order">
<?php echo zen_draw_hidden_field('action','search'); ?>
<div class="bg_box_gray margin_t" style="width:300px;">
	<div class="trackorders"><li>Track Orders</li></div>
		
		<input type="text" size="30" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''));" onkeyup="value=value.replace(/[^\d]/g,'');" value="" id="order_id" name="keyword" class="input_6"/>
		<input type="submit" class="footHelp_btn">
	
</div>
</form>

					