<div class="col_200t">
	<div class="media"><a class="link_red_dark" href="/faq_info.html?faqs_id=130">FPVOK Media</a></div>
	
</div>
<div class="col_200m">
<div id="a" style="overflow: hidden; padding:10px;">
<ul id="a1">
<?php 
 $faqs_all_query_raw = "SELECT f.`faqs_id`, fd.`faqs_name` FROM faqs f, faqs_description fd
												WHERE fd.faqs_id=f.faqs_id AND f.`faqs_status` = 1 and f.master_faq_categories_id = 20
												ORDER BY f.`faqs_date_added` DESC LIMIT 5";
  $specials_index = $db->Execute($faqs_all_query_raw);	
  if($specials_index->RecordCount() >0)	{
  while (!$specials_index->EOF) {
  
echo '<li class="link_li_a fl"><a target="_blank" href="'.zen_href_link(zen_get_info_faq_page($specials_index->fields['faqs_id']),'fcPath='.$fcPath.'&faqs_id='.$specials_index->fields['faqs_id']).'">'.$specials_index->fields['faqs_name'].'</a></li><li class="in fr"><a target="_blank" href="'.zen_href_link(zen_get_info_faq_page($specials_index->fields['faqs_id']),'fcPath='.$fcPath.'&faqs_id='.$specials_index->fields['faqs_id']).'"><img border="0" src="/images/root/more_s.gif"></a></li>';

$specials_index->MoveNext();
}
}
?>

</ul>
</div>
</div>
