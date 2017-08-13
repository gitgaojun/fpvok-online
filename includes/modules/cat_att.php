<?php 
if(isset($_GET['other'])){
$str_id = join(",",$o_d);
$str_vaulid = join(",",$o_di);
}

if(strlen($str_id)>0){
	$op_shuxing = "and op.products_options_id not in (".$str_id.")";
}else{
	$op_shuxing = "";
}
$str_neirong="";

$sql2="select op.products_options_id,op.products_options_name from products_options op,products_attributes at where op.products_options_catog = 1 ".$op_shuxing." and op.products_options_id = at.options_id group by op.products_options_id order by op.products_options_sort_order asc ";

$options_type = $db->Execute($sql2); 
if($options_type->RecordCount()>0){
$right_list =array();

$str_neirong .='<div class=" p-stripe w-ns3c" id="w-ns3c"><div class="clearfix p-stripeInner">';

$ik=1;
while (!$options_type->EOF) {
if(is_array($get_all_array[$options_type->fields['products_options_id']])){ 
	 $one_str=str_replace(join("l1",$get_all_array[$options_type->fields['products_options_id']]['t_all']).'/',"",$_SERVER["REQUEST_URI"]);	 	 
 }
 $sql="select count(op.products_options_values_id) as count ,op.products_options_values_id,op.products_options_values_name from products_options_values op,products_attributes at, " .
       TABLE_PRODUCTS_TO_CATEGORIES . " p2c where at.products_id = p2c.products_id and op.products_options_values_id = at.options_values_id and at.options_id='".$options_type->fields['products_options_id']."' ".$optin_str." group by op.products_options_values_id order by op.products_options_values_sort_order asc ";
$options_values = $db->Execute($sql);  
if($options_values->RecordCount()>0){
	
	$str_neirong .='<dl><dt>'.$options_type->fields['products_options_name'].':</dt><dl id="type_1">';
 ?>  

<?php 
while (!$options_values->EOF) {
	
	$o_i = $o_str.'id'.'_i'. $options_type->fields['products_options_id'].'v'.$options_values->fields['products_options_values_id'];
    
if($freeshipping==true){
$o_i.='/free-shipping_fs';
}
if($special==true){
$o_i.='/special-offers_sps';
}

	
	if(sizeof($get_all_array[$options_type->fields['products_options_id']]['t_all'])>0){
		$in_this2 = $get_all_array;
		$ss = ereg_replace('\/', ' ','id'.'_i'. $options_type->fields['products_options_id'].'v'.$options_values->fields['products_options_values_id']);

		$in_this2[$options_type->fields['products_options_id']]['t_all'][$options_values->fields['products_options_values_id']]=ereg_replace($pattern, '-', $ss);
		$re_str= $get_all_array[$options_type->fields['products_options_id']]['str'];
		$url =str_replace($re_str,join("l1",$in_this2[$options_type->fields['products_options_id']]['t_all']),$_SERVER["REQUEST_URI"]);
	}else{
		$strs=explode("/",$_SERVER["REQUEST_URI"]);
		$ss = ereg_replace('\/', ' ','id'.'_i'. $options_type->fields['products_options_id'].'v'.$options_values->fields['products_options_values_id']);
		$strs[0]= ereg_replace($pattern, '-',$ss);
		$url =join("/",$strs);
	}
$str_neirong .='<dd><a rel = "nofollow" href="'.$url.'">'.$options_values->fields['products_options_values_name'].'</a></dd>';	
		
	?>

<?php
$options_values->MoveNext();
}
 }
 $str_neirong .='</dl></dl>';
 
$ik++;
$options_type->MoveNext();
}
$str_neirong .='</div></div>';
 }?>              

<div class="infor_speak" style="margin-bottom:10px;">
<h1 class="FFT1">Attribute Screening</h1>
<?php if(isset($_GET['other'])){?>
<div style="border-bottom:1px solid #D8D8D8;">
  <div class="your-choice">
    <div class="category-head-list">
      <h2>Selected Conditions:</h2>
    </div>
    <div class="filter_state_item">
      <ul class="narrowed-category">
     <?php 
if(strlen($str_id)>0){
	$strs=explode("/",$_SERVER["REQUEST_URI"]);
$sql2="select products_options_id,products_options_name from products_options where products_options_catog = 1 and products_options_id in (".$str_id.") order by products_options_sort_order asc ";
$options_type = $db->Execute($sql2);
while (!$options_type->EOF) {
	$sql="select count(op.products_options_values_id) as count ,op.products_options_values_id,op.products_options_values_name from products_options_values op,products_attributes at, " .
       TABLE_PRODUCTS_TO_CATEGORIES . " p2c where at.products_id = p2c.products_id and op.products_options_values_id = at.options_values_id and at.options_id='".$options_type->fields['products_options_id']."' and op.products_options_values_id in (".$str_vaulid.") group by op.products_options_values_id order by op.products_options_values_sort_order asc ";
	   $options_value = $db->Execute($sql);
	
	$ivd = '_i'.$options_type->fields['products_options_id'].'v'.$options_value->fields['products_options_values_id'];

	$url="";
	for($i=1;$i<count($strs);$i++){
	   if(strlen(strstr($strs[$i],$ivd))>0){
	   }else{
		   $url .= '/'.$strs[$i]; 
	   }
	}
	
?>
<li><a href="<?php echo $url; ?>" class="widget-btn" title="Remove"><span class="value"><?php echo $options_type->fields['products_options_name'].':'.$options_value->fields['products_options_values_name']; ?></span><img src="images/remove-btn-filter.gif"></a></li>
<?php 
$options_type->MoveNext();
}}?>      </ul>
    </div>
  </div>
</div>
<?php }?> 
<div class="speakposition" style="height:auto;">
<ul class="att_id">
<?php echo $str_neirong; ?>                             
</ul></div>
</div>