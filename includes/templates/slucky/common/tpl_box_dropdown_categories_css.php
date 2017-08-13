<?php
/**
 * Common Template - tpl_box_default_left.php
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_box_default_left.php 2975 2006-02-05 19:33:51Z birdbrain $
 */

// choose box images based on box position
  if ($title_link) {
    $title = '<a href="' . zen_href_link($title_link) . '"><span>' . $title  . '</span></a>';
  }
//
?>
<div id="sidenav" style="position:relative;">
<div class="sidenav_h">
<a id="sitemap" href="/site_map.html">All Categories</a></div>
<div id="home_sitemap_menu" style="display:none;" class="menu_post">
<ul>
<?php 
$order_by = " order by c.sort_order, cd.categories_name ";

$categories_tab_query = "select c.categories_id, cd.categories_name,c.categories_banner_2_img from " .
TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
                          where c.categories_id=cd.categories_id and c.parent_id= '0' and cd.language_id='" . (int)$_SESSION['languages_id'] . "' and c.categories_status='1'" .
$order_by;
$categories_tab = $db->Execute($categories_tab_query);

while (!$categories_tab->EOF) {
$categories_tab_current = $categories_tab->fields['categories_name'];
$subcategories_array =array();
zen_get_subcategories(&$subcategories_array, $categories_tab->fields['categories_id']);

?>
 <li><a class="home_hav" href="<?php echo zen_href_link(FILENAME_DEFAULT, 'cPath=' . (int)$categories_tab->fields['categories_id']); ?>">
 <div class="home_main"><div class="home_left">
 <?php if (strlen($categories_tab->fields['categories_banner_2_img'])>2) { ?>
<img src="images/<?php echo $categories_tab->fields['categories_banner_2_img']; ?>" align="absmiddle"/>&nbsp;
<?php }?></div><div class="home_right">
<?php echo $categories_tab_current; ?></div></div></a>
					<!--third-->
 <?php if(count($subcategories_array)>0){?> 
                    
						<div style="display: none;" class="subitem w680">
								<div class="subitem_list ">
  <?php 
$order_by_1 = " order by c.sort_order, cd.categories_name ";
$categories_tab_query_1 = "select c.categories_id, cd.categories_name from " .
TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
                          where c.categories_id=cd.categories_id and c.parent_id= ". $categories_tab->fields['categories_id'] ." and cd.language_id='" . (int)$_SESSION['languages_id'] . "' and c.categories_status='1'" .
$order_by_1;
$categories_tab_1 = $db->Execute($categories_tab_query_1);
if ($categories_tab_1->RecordCount() > 0) {
	$i = 0;$ii=0;
	while (!$categories_tab_1->EOF) {
		$categories_tab_current_1 = $categories_tab_1->fields['categories_name'];

		
?><dl><dt><a href="<?php echo zen_href_link(FILENAME_DEFAULT, 'cPath=' . (int)$categories_tab_1->fields['categories_id']); ?>"><?php echo $categories_tab_current_1; ?></a></dt><dd><?php 
$order_by_2 = " order by c.sort_order, cd.categories_name LIMIT 50 ";
$categories_tab_query_2 = "select c.categories_id, cd.categories_name from " .
TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
                          where c.categories_id=cd.categories_id and c.parent_id= ". $categories_tab_1->fields['categories_id'] ." and cd.language_id='" . (int)$_SESSION['languages_id'] . "' and c.categories_status='1'" .
$order_by_2;
$categories_tab_2 = $db->Execute($categories_tab_query_2);

if ($categories_tab_2->RecordCount() > 0) {
	
while (!$categories_tab_2->EOF) {	
$categories_tab_current_2 =$categories_tab_2->fields['categories_name'];

	?>                                
	<a href="<?php echo zen_href_link(FILENAME_DEFAULT, 'cPath=' . (int)$categories_tab_2->fields['categories_id']); ?>"><?php echo $categories_tab_current_2; ?></a>							
                                    
  <?php   
  $i++;$ii++;
$categories_tab_2->MoveNext();
}
}

?> </dd></dl>

<?php 
$categories_tab_1->MoveNext();
}
}
?>                              
                     

						  </div>
						<!--third end--></div>
 <?php }?>                       
                        
				</li>
					
  <?php   
$categories_tab->MoveNext();
}
?>                  
    </ul>
                        
                        <div class="sitemap_menu_bottompic"></div>
  </div>
</div>

<script type="text/javascript">
jQuery(function($){$("#home_sitemap_menu").find("li").each(function(){$(this).hover(function(){$(this).find(".subitem").show()},function(){$(this).find(".subitem").hide()})})});
</script>
<script type="text/javascript">
 var closeMenu = true;
 function controlMenu(){
 if(closeMenu){
 jQuery("#home_sitemap_menu").hide();
 }else{
 jQuery("#home_sitemap_menu").show();
 }
 }
 menuToggle('sidenav','mouseover',function(){closeMenu=false;controlMenu();});
 menuToggle('home_sitemap_menu','mousemove',function(){closeMenu=false;setTimeout(controlMenu, 500)});
 menuToggle('home_sitemap_menu','mouseout',function(){closeMenu=true;setTimeout(controlMenu, 500);});
</script>