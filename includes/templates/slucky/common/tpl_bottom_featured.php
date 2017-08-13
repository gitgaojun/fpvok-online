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

?><div class="hotitem_h">
            <span class="fb fleft">Featured Items </span>
			<a class="fright mr10 f11" href="/featured_items.html">More</a>
           
        </div>


<div class="hotitem_m alignL">
<ul>
<?php
if (is_array($list_box_contents) > 0 ) {
	$list_box_contentsNum = 12;
 for($row=0;$row<$list_box_contentsNum;$row++) {
    $params = "";
    //if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
    $tempNum = count($list_box_contents[$row]);
    for($col=0;$col< $tempNum;$col++) {
		if($col==($tempNum-1)){
		$str='class="fl margin_1em"';
		}elseif($col==0){
		$str='class="fl margin_1em"';
		}else{
		$str='class="fl margin_1em"';
		}
       echo '<li '.$str.'>' . $list_box_contents[$row][$col]['text'] .  '</li>' . "\n";
      }
    unset($tempNum);
   }
?>
<?php
  }
?>
</ul>
</div>
<div class="col_550b"></div>

