<?php
/**
 * Common Template - tpl_columnar_display.php
 *
 * This file is used for generating tabular output where needed, based on the supplied array of table-cell contents.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_columnar_display.php 3157 2006-03-10 23:24:22Z drbyte $
 */

?>
<div class="rtbanner toplogo" style="margin:5px 0; width:762px; height:80px"></div>
<div class="r02bg5" >
<span class="r02bg88">Hot items</span>
</div>
<div id="feautre_category1" class="fl maxwidth line_180" style=" border: 1px solid #DDDDDD; width:760px;">
<ul>
<?php
if (is_array($list_box_contents) > 0 ) {
	$list_box_contentsNum = count($list_box_contents);
 for($row=0;$row < $list_box_contentsNum;$row++) {
    $params = "";
    //if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
    $tempNum = count($list_box_contents[$row]);
    for($col=0;$col < $tempNum;$col++) {
			if($col < 3){
      	$r_params = ' class="border_r_dash"';
			}else{
      	$r_params = '';
			}
      if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
     	if (isset($list_box_contents[$row][$col]['text'])) {
					echo '<li' . $r_params . '>' . $list_box_contents[$row][$col]['text'] .  '</li>' . "\n"; 
				}
				$r_params="";
    }
    unset($tempNum);
  }
}
?>
</ul>
</div>