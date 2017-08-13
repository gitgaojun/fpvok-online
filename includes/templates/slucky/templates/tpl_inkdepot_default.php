<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=about_us.<br />
 * Displays conditions page.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_about_us_default.php  v1.3 $
 */
 $column_box_default ='tpl_box_default_left.php';
?>
<script type="text/javascript" src="includes/templates/slucky/jscript/jscript_jquery-min.js"></script>
<link rel="stylesheet" type="text/css" href="css/master.css" />
<div class="right_big_con_indouk">
<div id="aboutUsMainContent" style="margin-top:30px;margin-bottom:20px;">
<div id="inkHeader">
<img width="948" height="169" border="0" alt="Ink &amp; Toner: Inkjet Printer and Toner Cartridges" src="http://static.www.odcdn.com/images/us/od/tiles/100211_ink_toner_finder_headbanner.jpg">
</div> 
<div class="InkFinder">
	   	<div class="inkBg">
			<table>
				<tbody><tr>

					<td width="6" class="inkColumnStart inkCell">
						<!-- <div class="inkStartText">Start</div> -->
					</td>
									
					<td width="243" class="inkColumnSelect inkCell">						
						<select name="seriesNavId" id="manufSelect" class="inkSelectBox" tabindex="11">
                        
							<option>Select Brand</option>

<?php 

$tab_query = "select * from manufacturers order by manufacturers_name asc";
$s_tab = $db->Execute($tab_query);

while (!$s_tab->EOF) {
		
echo '<option value="'.$s_tab->fields['manufacturers_id'].'">'.$s_tab->fields['manufacturers_name'].'</option>';
  $s_tab->MoveNext();
}

	?>									
</select>
						
<select name="printerTypeId" id="typeSelect" class="inkSelectBox inkDisabled" tabindex="12">
<option value="">Select Categories Type</option>
</select>

<select name="inkNavId" id="modelSelect" class="inkSelectBox inkDisabled" tabindex="13">
<option value="">Select Products Model</option>
</select>
<script>
jQuery(document).ready(function(){
	
	jQuery("#manufSelect").change(function(){
		
		var printerTypeId = jQuery("#manufSelect").val();
		
		var option = {m_id:printerTypeId,type:"1"};
		
		jQuery.ajax({
		  type: "post",
		  url: "man_ajax.php",
		  data:option,
		  dataType: "json",
		  beforeSend:function(XMLHttpRequest){
			jQuery(".inkAjax").css("display","block");
		  },
		  success: function(msg){
			  jQuery(".inkAjax").css("display","none");
			  if(msg.type==1){
				jQuery("#typeSelect").removeClass("inkDisabled");
				jQuery("#typeSelect").html(msg.value);  
				
			  }else{
				alert("err!");
			  }
			  
		  }
		  
		});
		
		
		
	})
	
//=====================================TWO========================================

	jQuery("#typeSelect").change(function(){
		
		var printerTypeId = jQuery("#manufSelect").val();
		var typeSelect = jQuery("#typeSelect").val();
		
		var option = {m_id:printerTypeId,t_id:typeSelect,type:"2"};
		
		jQuery.ajax({
		  type: "post",
		  url: "man_ajax.php",
		  data:option,
		  dataType: "json",
		  beforeSend:function(XMLHttpRequest){
			jQuery(".inkAjax").css("display","block");
		  },
		  success: function(msg){
			  jQuery(".inkAjax").css("display","none");
			  if(msg.type==2){
				 jQuery("#modelSelect").removeClass("inkDisabled");
				jQuery("#modelSelect").html(msg.value);  
			  }else{
				alert("err!");
			  }
			  
		  }
		  
		});
		
		
		
	})

//======================	

jQuery("#modelSelect").change(function(){
	
	//var modelSelect = jQuery("#modelSelect").val();
	var modelSelect = jQuery("select[name=inkNavId] option[selected]").text();
	var modelSelect2 = jQuery("#modelSelect").val();
	
	if(modelSelect2>0){
		
		location.href ="index.php?main_page=advanced_search_result&inc_subcat=1&search_in_description=1&keyword="+modelSelect;
		//location.href ="index.php?main_page=product_info&products_id="+modelSelect;
		
	}
	
	
})

jQuery("#inkClearButton").click(function(){
	
	jQuery("#typeSelect").html('<option value="">Select Categories Type</option>');
	jQuery("#typeSelect").addClass('inkDisabled');
	
	jQuery("#modelSelect").html('<option value="">Select Products Model</option>');
	jQuery("#modelSelect").addClass('inkDisabled');
	return false;
	
	
})


	
})
</script>
						
						<div class="inkButtonSet cart">
							<div class="b1">
							<input type="submit" class="button" id="inkSearchBtn" value="Go" style="display:none" tabindex="14">
							</div>
							<a id="inkClearButton" class="inkClearButton ink2ndButton" href="javascript:;">Clear</a>
							
							
							
						</div>
						
						<div class="section">
						<div id="savePrinter" class="overlayContainer">							
							<div class="overlayObj" style="display: none;">
								<div id="savePrinterContent">
									<div class="closeLink">
										Close <span>X</span>
									</div>							
									<p class="inBannerHeading">Name your printer</p>
									<p class="inBannerSubHeading note">Maximum 30 Characters</p>
									<p id="invalidCharsMsg">Invalid character.  Please use letters or numbers.</p>
									<p class="hidden printerNameError" id="duplicateNameMsg">Duplicate printer name.</p>
									<div id="overPrinterLimitMsg">
										<div class="section">You can only save a maximum of 10 printers. Please remove one before saving another printer.</div>
										<ul class="buttonwrapper managePrintersTrigger">
											<li class="b1">
												<a id="managePrintersButton" class="button">
													Manage Printers
												</a>	
											</li>
										</ul>
									</div>									
									<ul class="formwrapper">
										<li class="fw_input"><input type="text" maxlength="30" id="newPrinterName" name="newPrinterName" tabindex="15"></li>
										<li class="fw_submit cart">
											<div class="b1">
												<a href="#" id="addPrinterSubmit" class="button">Save this printer</a>		
											</div>
										</li>
									</ul>
									<div class="clear"></div>
								</div>
								<div class="footer"></div>
							</div>
						</div>
						</div>
					</td>
                    <td class="inkOr" rowspan="2">
						<span class="inkOrDivider"></span>
						<span class="inkOrIntl">or</span>
						<span class="inkOrDivider"></span>
					</td>
                    
					<td width="323" ><form onsubmit="advance_search_submit();return false;" id="quick_find_header2" name="quick_find_header2" method="get" action="http://test.didisland.com/index.php?main_page=advanced_search_result"><input type="hidden" value="advanced_search_result" name="main_page"><input type="hidden" style="display: none" value="1" name="inc_subcat"><input type="hidden" value="1" name="search_in_description">
  <input type="text" autocomplete="off" name="keyword" class="inkSearchField input focus" id="keyword" tabindex="18" onfocus="if (this.value == 'Enter search keywords here') this.value = '';" onblur="if (this.value == '') this.value = 'Enter search keywords here';">                  
                    <div class="b1">
							<input type="submit" title="Go" class="button" id="cartrOrKywdSubmit" value="Go" tabindex="19">							
							</div></form></td>
                     <td width="400" align="center"><img src="images/right_l.gif"></td>
					</tr>
			</tbody></table>
			 
		  <div class="inkAjax"><div class="inkAjaxInfo">Loading...</div></div>
	</div>


</div>
<?php
 // require($define_page);
?>
<div id="banners6" class="fl clear margin_t">
	<a href="/adRedir.do?ciid=18198&amp;cm_sp=Tiles102311-_-Ink_Depot_generic_ad1-_-WK44LexmarkInk_20111023_20111106&amp;redirect=false" id="Ink_Depot_generic_ad1"><img width="180" height="132" border="0" alt="Save $10 on any Lexmark Ink Multipack" src="http://static.www.odcdn.com/images/us/od/tiles/041711_180x132_lexmark_inkjet.gif"></a>
	<a href="/adRedir.do?ciid=16597&amp;cm_sp=Tiles061211-_-Ink_Depot_generic_ad2-_-WK25InkRecycling_20110617_20120101&amp;redirect=false" id="Ink_Depot_generic_ad2"><img width="372" height="132" border="0" alt="Free Ink &amp; Toner Recycling!!" src="http://static.www.odcdn.com/images/us/od/tiles/061211_372x132_recycling.gif"></a>
	
	<a href="/adRedir.do?ciid=18301&amp;cm_sp=Tiles103011-_-Ink_Depot_generic_ad4-_-WK45HPPhotoValuePacks_20111030_20111106&amp;redirect=false" id="Ink_Depot_generic_ad4"><img width="180" height="132" border="0" alt="$10 Off HP Photo Value Packs" src="http://static.www.odcdn.com/images/us/od/tiles/040311_180x132_hp_photo_value.gif"></a>
	<a href="/adRedir.do?ciid=18280&amp;cm_sp=Tiles103011-_-Ink_Depot_generic_ad5-_-WK45InkToner30Off_20111030_20111106&amp;redirect=false" id="Ink_Depot_generic_ad5"><img width="180" height="132" border="0" alt="30% Off Office Depot Ink &amp; toner when you recycle" src="http://static.www.odcdn.com/images/us/od/tiles/103011_180x132_ink_toner_receive.gif"></a>
	<div id="genericPage"></div>
</div>
<div class="moduleStruct">
	<p class="featuredText">Find your printer in this list of the 10 most popular selling Ink &amp; Toner brands.&nbsp;<a class="ignore_rewrite inkBrowseButton" id="browseCatLink" href="/inkdepot.html">See All Brands</a></p>

<?php 
$manufacturers_sql = "select manufacturers_name, manufacturers_id, manufacturers_image
                           from " . TABLE_MANUFACTURERS . " order by manufacturers_id asc";
$manufacturers_1 = $db->Execute($manufacturers_sql);
if($manufacturers_1->RecordCount()>0){
	echo '<ul class="featured">';
while (!$manufacturers_1->EOF) {
?>

<?php echo '<li><a href="/inkdepots.html?/a/'.$manufacturers_1->fields['manufacturers_name'].'/&n='.$manufacturers_1->fields['manufacturers_id'].'"><img alt="'.$manufacturers_1->fields['manufacturers_name'].'" src="images/'.$manufacturers_1->fields['manufacturers_image'].'"></a></li>'; ?>
      <?php 
$manufacturers_1->MoveNext();
  }
  echo '</ul>';
}
?>
</div>
<div class="seoText">
<h1>Printer Ink &amp; Toner Cartridges</h1>

	Whether you know your printer brand name and model number, or your ink and toner cartridge number, you'll be able to find it faster with our Ink &amp; Toner Finder. We have a large selection of inkjet printer cartridges and laser printer toner. Since ink and toner cartridges come in many colors, yields and pack quantities, you'll find many options to fit your inkjet or laser printing needs. If you prefer greener printing solutions, we also offer Office Depot&reg; Brand remanufactured cartridges that help to prevent waste in landfills and save you money too!  <font color="blue">
*Limited time offer! Free Delivery on any Ink &amp; Toner for orders placed on 8/22/2011 through 11/19/2011. No minimum order required. Offer valid for officedepot.com customers only, your Delivery Fee will be deducted at checkout. </font>
</div>
</div>
</div>
