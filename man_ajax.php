<?php
include_once 'includes/application_top.php';

$m_id = $_POST['m_id'];
$type = $_POST['type'];
$t_id = $_POST['t_id'];

if($m_id>0 && $type==1){

	$categories_tab_query = "select cd.categories_name,cd.categories_id from " . TABLE_CATEGORIES_DESCRIPTION . " cd, manufacturers m,products p
	
							  where cd.categories_id = p.master_categories_id and p.manufacturers_id ='".(int)$m_id."' group by cd.categories_id order by  cd.categories_name";
							  
	$categories_tab = $db->Execute($categories_tab_query);
	$str='<option value="">Select Categories Type</option>';
	while (!$categories_tab->EOF) {
		
		$str.='<option  value="'.$categories_tab->fields['categories_id'].'">'.$categories_tab->fields['categories_name'].'</option>';
			
	  $categories_tab->MoveNext();
	}
	
	echo "{type:'1',value:'".$str."'}";
	
}

//==========

if($m_id>0 && $t_id>0 && $type==2){

	$categories_tab_query = "select p.products_id, p.products_model from " . TABLE_PRODUCTS . " p," . TABLE_PRODUCTS_DESCRIPTION . " pd, " .
      TABLE_PRODUCTS_TO_CATEGORIES . " p2c
							  where p2c.categories_id = '".$t_id."' and p2c.products_id = p.products_id and p.products_id = pd.products_id and p.manufacturers_id ='".(int)$m_id."' order by p.products_model";
							  
	$categories_tab = $db->Execute($categories_tab_query);
	$str='<option value="">Select Product Model</option>';
	while (!$categories_tab->EOF) {
		
		$str.='<option  value="'.$categories_tab->fields['products_id'].'">'.$categories_tab->fields['products_model'].'</option>';
			
	  $categories_tab->MoveNext();
	}
	
	echo "{type:'2',value:'".$str."'}";
	
}  
 
?>

