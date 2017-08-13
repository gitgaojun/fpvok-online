<div class="col_200t">
	<div class="fl"><a  class="link_red_dark" href="/faq_info.html?faqs_id=130">News &amp; Notice</a></div>
	<div class="col_txt_more"><a href="/faqs_all.html"><img border="0" src="/images/more_s.gif"></a></div>
	
</div>
<div class="col_200m">
<div id="a" style="height:120px;overflow: hidden;">
<ul id="a1">
<?php 
 $faqs_all_query_raw = "SELECT f.`faqs_id`, fd.`faqs_name` FROM faqs f, faqs_description fd
												WHERE fd.faqs_id=f.faqs_id AND f.`faqs_status` = 1
												ORDER BY f.`faqs_date_added` DESC LIMIT 20";
  $specials_index = $db->Execute($faqs_all_query_raw);	
  if($specials_index->RecordCount() >0)	{
  while (!$specials_index->EOF) {
  
echo '<li class="link_li_a"><a target="_blank" href="'.zen_href_link(zen_get_info_faq_page($specials_index->fields['faqs_id']),'fcPath='.$fcPath.'&faqs_id='.$specials_index->fields['faqs_id']).'">'.$specials_index->fields['faqs_name'].'<img border="0" align="absmiddle" src="/images/icon/is_new.gif"><img border="0" align="absmiddle" src="/images/icon/is_hot.gif"></a></li>';

$specials_index->MoveNext();
}
}
?>

</ul>
<div id="a2"></div> 
</div>
</div>
<div class="col_200b"></div>
<script type="text/javascript"> 
boxmove("a","a1","a2",1); 
</script> 