<?php
/**
 * jscript_addr_pulldowns
 *
 * handles pulldown menu dependencies for state/country selection
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: jscript_addr_pulldowns.php 4830 2006-10-24 21:58:27Z drbyte $
 */
?>
<script language="javascript" type="text/javascript"><!--

function update_zone(theForm) {
  // set initial values
  var SelectedCountry = theForm.zone_country_id.options[theForm.zone_country_id.selectedIndex].value;
  var SelectedZone = theForm.elements["zone_id"].value;

  // reset the array of pulldown options so it can be repopulated
  var NumState = theForm.zone_id.options.length;
  while(NumState > 0) {
    NumState = NumState - 1;
    theForm.zone_id.options[NumState] = null;
  }
  // build dynamic list of countries/zones for pulldown
<?php echo zen_js_zone_list('SelectedCountry', 'theForm', 'zone_id'); ?>

  // if we had a value before reset, set it again
  if (SelectedZone != "") theForm.elements["zone_id"].value = SelectedZone;

}

 <?php if ($_GET['has_phone']=='no_phone'){ ?>
  function update_billing_zone(theForm) {
	  // set initial values
	  var SelectedCountry = theForm.b_zone_country_id.options[theForm.b_zone_country_id.selectedIndex].value;
	  var SelectedZone = theForm.elements["b_zone_id"].value;
	  // reset the array of pulldown options so it can be repopulated
	  var NumState = theForm.b_zone_id.options.length;
	  while(NumState > 0) {
	    NumState = NumState - 1;
	    theForm.b_zone_id.options[NumState] = null;
	  }
  // build dynamic list of countries/zones for pulldown
<?php echo zen_js_zone_list('SelectedCountry', 'theForm', 'b_zone_id'); ?>

  // if we had a value before reset, set it again
  if (SelectedZone != "") theForm.elements["b_zone_id"].value = SelectedZone;

}
<?php }?>
//--></script>
 <?php if ($_GET['has_phone']=='no_phone'){ ?>
<SCRIPT language=javascript type=text/javascript>
<!--
var selected;

function showBilling(){
	if($get('isSame').checked){
		//hide('billingDiv');
	}
	else{
		$get("b_gender").value='-1';
		$get("b_firstname").value='';
		$get("b_lastname").value='';
		$get("b_street-address").value='';
		$get("b_suburb").value='';
		$get("b_city").value='';
		$get("b_country").value='-1';
		$get("b_stateZone").value='-1';
		$get("b_state").value='';
		$get("b_postcode").value='';
		$get("b_phone").value='';
	}
}

function setValue(id){
	if($get(id) != null && $get('b_'+id) !=null){
		$get('b_'+id).value = $get(id).value;
	}
}

function tosame(){
	if($get("isSame")!=null && $get("isSame").checked==true){
		setValue("gender");
		setValue("firstname");
		setValue("lastname");
		setValue("street-address");
		setValue("suburb");
		setValue("city");
		setValue("country");
		setValue("stateZone");
		setValue("zone_id");
		setValue("state");
		setValue("postcode");
		setValue("phone");
	}
}
//--></SCRIPT>
<?php }?>