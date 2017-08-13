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
<div class="right_big_con_indouk" style="margin-top:10px;margin-bottom:20px;">
<h1 class="static_h1"><?php echo HEADING_TITLE; ?></h1>
<img width="948" height="180" border="0" alt="HP Ink and Toner Ships Free" src="http://static.www.odcdn.com/images/us/od/tiles/111911_948x180_hp_inktoner_freedelivery_v2.jpg">
<div class="inkTonerModelHeader">
		<h3>HP Ink &amp; Toner</h3>
		<p>
		For your HP printing needs, Office Depot offers a wide variety of HP ink and toner cartridges. Get the most out of your HP prints by choosing high-quality HP toners and HP inks at affordable prices.
		</p>
	</div>
<div id="m02">
<div class="section" id="selectManuf">
<div class="moduleStruct">
<h2 class="step modStyle1">Select the model name of your machine</h2>	
<a name="top">&nbsp;</a> 
</div>
</div>
<div id="alphaRefine">


<div class="section">   
<h3 class="brand"> Hewlett-Packard Models</h3> 
<table cellspacing="0" id="alphaPagination">
<tbody><tr>
<th class="text">Starting with:</th>
 
   <td class="td0">
  <a href="#A">
   A
  </a>
</td>
 
   <td class="td1">
  <a href="#B">
   B
  </a>
</td>
 
   <td class="td2">
  <a href="#C">
   C
  </a>
</td>
 
   <td class="td3">
  <a href="#D">
   D
  </a>
</td>
 
   <td class="td4">
  <a href="#E">
   E
  </a>
</td>
 
   <td class="td5">
  <a href="#F">
   F
  </a>
</td>
 <td class="td6">
  <a href="#G">
   G
  </a>
</td>
<td class="td6">
  <a href="#H">
   H
  </a>
</td>
<td class="td6">
  <a href="#I">
   I
  </a>
</td>
<td class="td6">
  <a href="#J">
   J
  </a>
</td>
<td class="td6">
  <a href="#K">
   K
  </a>
</td>
   <td class="td6">
  <a href="#L">
   L
  </a>
</td>
 
   <td class="td7">
  <a href="#M">
   M
  </a>
</td>
 <td class="td6">
  <a href="#N">
   N
  </a>
</td>
   <td class="td8">
  <a href="#O">
   O
  </a>
</td>
 
   <td class="td9">
  <a href="#P">
   P
  </a>
</td>
 
   <td class="td10">
  <a href="#Q">
   Q
  </a>
</td>
 <td class="td6">
  <a href="#R">
   R
  </a>
</td>
<td class="td6">
  <a href="#S">
   S
  </a>
</td>
   <td class="td11">
  <a href="#T">
   T
  </a>
</td>
 <td class="td6">
  <a href="#U">
   U
  </a>
</td>
<td class="td6">
  <a href="#V">
   V
  </a>
</td>
<td class="td6">
  <a href="#W">
   W
  </a>
</td>
<td class="td6">
  <a href="#X">
   X
  </a>
</td>
<td class="td6">
  <a href="#Y">
   Y
  </a>
</td>
<td class="td6">
  <a href="#Z">
   Z
  </a>
</td>
 </tr>
 </tbody></table>

  <a id="container" name="container">&nbsp;</a>
<!--88888888888888888888--> 
<?php 
$search_modle_sql = "select count(distinct p.products_model), p.products_id, p.products_image, pd.products_name, p.products_model
                             from (" . TABLE_PRODUCTS . " p
                             left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                             where p.products_id = pd.products_id
                             and p.products_status = '1'
                             and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                             and p.manufacturers_id  = '" . $_GET['n'] . "' group by p.products_model order by p.products_model";

 $model_index = $db->Execute($search_modle_sql);
 $bbb='';	
 if ($model_index->RecordCount()> 0) {
	 while (!$model_index->EOF) {
	   $bbb[]=$model_index->fields['products_model']; 
	   $model_index->MoveNext();
 	 }		 
		  
 $all_array =array('A','B','C','D','E','F','J','H','I','G','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
 foreach($all_array as $all_arrays){	 
	  ?>

 <?php 
	   	   
	   $sstr='';$ii=0;
	 foreach($bbb as $bbbS){	
			
	 $model_x = substr($bbbS,0,1);	
	   
	 if( $model_x==$all_arrays){
	 
	 $sstr.='
        
         <li>
         <a href="index.php?main_page=advanced_search_result&inc_subcat=1&search_in_description=1&keyword='.$model_index->fields['products_model'].'+">'.$model_index->fields['products_model'].'</a>
          <span>
            ('.zen_get_products_model($model_index->fields['products_model']).')
            
          </span>
         </li>';
$ii++;
	 }
  }
  
  
 if($ii>0){ 
  
	   ?>
<div class="index div<?php echo $imd; ?> ">
<h4>
<a name="<?php echo $all_arrays; ?>"></a><?php echo $all_arrays; ?></h4>
</div>
<div class="section">
    
     <div class="colx4 column1">
      <ul class="liststyle4">
      
      <?php echo $sstr; ?>

      </ul>
     </div>
    
     <div class="top_link">
    <a class="iconstyle2" href="#container">
     Top
    </a>
    </div>
   </div>
   
 <?php }?>  
   
   
   
   
   
<?php }?>   
   
   
   
   
<?php 

  }
?>
<!--999999999999999999999-->  
</div> 
</div>
</div>
<div id="aboutUsMainContent" >
<?php
 // require($define_page);
?>
</div>
</div>
