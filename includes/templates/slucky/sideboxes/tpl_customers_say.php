<?php
  $content = "";
  $content .= '<ul class="revieweditems_m">' . "\n";
	$i = 1;
	while(!$customersSay->EOF){
		$add_class = $i % 2==0?'odd':'';
		$add_url = zen_href_link(zen_get_info_page($customersSay->fields['products_id']), 'cPath=' . $productsInCategory[$customersSay->fields['products_id']] . '&products_id=' . (int)$customersSay->fields['products_id']);
		
		$customersSay_text = nl2br(zen_output_string_protected(stripslashes($customersSay->fields['reviews_title'])));
		

		$content .= '<li class="'.$add_class.'"><span class="revieweditems_pic fleft"><a href="'.$add_url.'" title="'.zen_get_products_name($customersSay->fields['products_id']).'">'.zen_image(DIR_WS_IMAGES . $customersSay->fields['products_image'], '', 59, 46,' ').'</a></span>';
		$content .= '<span class="revieweditems_pro_name fleft"><a class="f11 fb" href="'.$add_url.'">'.zen_get_products_name($customersSay->fields['products_id']).'</a></span>';
		$content .= '<span class="revieweditems_title fleft"><a class="f11" href="'.$add_url.'#re_name">'.$customersSay_text.'</a></span><span class="revieweditems_author fleft alignR f11">By <span style="color:#666666;">'.$customersSay->fields['customers_name'].'</span></span><div class="clear"></div></li>';
		
		$i++;
		$customersSay->MoveNext();
	}
	$content .= '</ul>' . "\n";
?>