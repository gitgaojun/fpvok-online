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
<div class="grid_main_wrap mt10">
<div class="connInner">
<div class="listhead mt10">
                        <ul class="tabs fleft">
                            <li class="active fleft">
                                <a _groupby="RelatedCategories">Categories</a></li>
                        </ul>
                    </div>
<div class="items addborder">
<ul>
<?php
if (is_array($list_box_contents) > 0 ) {
 $list_box_contentsNum = count($list_box_contents);
 for($row=0;$row< $list_box_contentsNum;$row++) {
    $params = "";
    //if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
    $tempNum = count($list_box_contents[$row]);
    for($col=0;$col< $tempNum;$col++) {
			if($col < 3){
      	$r_params = ' class="alignCC fleft"';
			}else{
      	$r_params = '';
			}
     	if (isset($list_box_contents[$row][$col]['text'])) {
					echo '<li' . $r_params . '>' . $list_box_contents[$row][$col]['text'] .  '</li>' . "\n"; 
				}
    }
    unset($tempNum);
  }
}
?>
</ul>
</div>
</div>
</div>