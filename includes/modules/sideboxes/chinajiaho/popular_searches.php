<?php if (1>2){?>
<div id="popular_searches" class="blue_con margin_t line_180">
  <h3 class="g_t_c"><?php echo TEXT_BOX_POPULAR_SEARCHES;?></h3>
  <p >
<?php
	$popularSearches = $db->Execute("select pages_html_text from ezpages where pages_title='Popular Searches' limit 1");
	$keyword=str_replace("<p>","",$popularSearches->fields['pages_html_text']);
	$keyword=str_replace("</p>","",$keyword);
	$Asearches=explode(",",$keyword);
	for($i=0;$i<count($Asearches);$i++){
		 $popularContent ='';
    	 $popularContent .= '<a href="Wholesale/'.trim($Asearches[$i]).'">';
		 $popularContent .= '<strong>';
		 $popularContent .= $Asearches[$i];
		 if ($i==(count($Asearches)-1)){
		 $popularContent .= '</strong></a>';
		 }else{
		 $popularContent .= '</strong></a>,';
		 }
		 echo $popularContent;
	
	}
?>
</p>
</div>
<?php }?>