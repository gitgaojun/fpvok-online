<div class="tags_hots mt10">
<div class="con">
  <div class="BoxBar">Popular Searches</div>
 <div class="tags_hots_list">
<?php
	$popularSearches = $db->Execute("select pages_html_text from ezpages where pages_title='Popular Searches' limit 1");
	$keyword=str_replace("<p>","",$popularSearches->fields['pages_html_text']);
	$keyword=str_replace("</p>","",$keyword);
	$Asearches=explode(",",$keyword);
	for($i=0;$i<count($Asearches);$i++){
		 $popularContent ='';
    	 $popularContent .= '<a href="wholesaletags/'.str_replace(' ','-',trim($Asearches[$i])).'.html">';
		 $popularContent .= '';
		 $popularContent .= $Asearches[$i] .'&nbsp;';
		 if ($i==(count($Asearches)-1)){
		 $popularContent .= '</a>';
		 }else{
		 $popularContent .= '</a>,';
		 }
		 echo $popularContent;
	
	}
?>
</div>
</div>
</div>