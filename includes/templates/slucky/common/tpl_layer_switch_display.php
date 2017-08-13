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
<div id="boxswitch" class="">
<div title="Hot Sale" class="off"><span>Hot Sale</span><div class="add"></div></div>
<div title="Recommend Items" class="off"><span>Recommended for You</span><div class="add"></div></div>
<div title="NewArrivals" class="off"><span>New Arrivals</span><div class="add"></div></div>	
<div title="Top Rated" class="off"><span>Top Rated</span><div class="add"></div></div>		    
<div title="Special Products" class="on">Special Products</span><div class="add"></div></div>
</div>
<div id="Special Products" class="show">
<ul>
<?php
if (is_array($specials_list_box_contents) > 0 ) {
	$specialsNum = count($specials_list_box_contents);
  for($row=0;$row<$specialsNum;$row++) {
    $params = "";
    //if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
?>

<?php
    $tempNum = count($specials_list_box_contents[$row]);
    for($col=0;$col<$tempNum;$col++) {
      $r_params = "";
      if (isset($specials_list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$specials_list_box_contents[$row][$col]['params'];
     if (isset($specials_list_box_contents[$row][$col]['text'])) {
?>
    <?php echo '<li' . $r_params . '>' . $specials_list_box_contents[$row][$col]['text'] .  '</li>' . "\n"; ?>
<?php
      }
    }
    unset($tempNum);
?>
<br class="clear" />
<?php
  }
}
?> 

</ul>
</div>

<div id="NewArrivals" class="hide">
<ul>
<?php
if (is_array($list_box_contents) > 0 ) {
 for($row=0;$row<sizeof($list_box_contents);$row++) {
    $params = "";
    //if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];
?>

<?php
    for($col=0;$col<sizeof($list_box_contents[$row]);$col++) {
      $r_params = "";
      if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
     if (isset($list_box_contents[$row][$col]['text'])) {
?>
    <?php echo '<li' . $r_params . '>' . $list_box_contents[$row][$col]['text'] .  '</li>' . "\n"; ?>
<?php
      }
    }
?>
<br class="clear" />
<?php
  }
}
?> 

</ul>
</div>
<div id="Recommend Items" class="hide">

<ul>

<?php

if (is_array($featured_list_box_contents) > 0 ) {

 for($row=0;$row<sizeof($featured_list_box_contents);$row++) {

    $params = "";

    //if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];

?>

<?php

    for($col=0;$col<sizeof($featured_list_box_contents[$row]);$col++) {

      $r_params = "";

      if (isset($featured_list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$featured_list_box_contents[$row][$col]['params'];

     if (isset($featured_list_box_contents[$row][$col]['text'])) {

?>

   <?php echo '<li' . $r_params . '>' . $featured_list_box_contents[$row][$col]['text'] .  '</li>' . "\n"; ?>

<?php

      }

    }

?>

<br class="clear" />

<?php

  }

}

?> 

</ul>

</div>

<div id="Hot Sale" class="hide">

<ul>

<?php

if (is_array($featured_hot_list_box_contents) > 0 ) {

 for($row=0;$row<sizeof($featured_hot_list_box_contents);$row++) {

    $params = "";

    //if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];

?>

<?php

    for($col=0;$col<sizeof($featured_hot_list_box_contents[$row]);$col++) {

      $r_params = "";

      if (isset($featured_hot_list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$featured_hot_list_box_contents[$row][$col]['params'];

     if (isset($featured_hot_list_box_contents[$row][$col]['text'])) {

?>

   <?php echo '<li' . $r_params . '>' . $featured_hot_list_box_contents[$row][$col]['text'] .  '</li>' . "\n"; ?>

<?php

      }

    }

?>

<br class="clear" />

<?php

  }

}

?> 

</ul>

</div>
<div id="Top Rated" class="hide">

<ul>

<?php

if (is_array($freeshipping_list_box_contents) > 0 ) {

 for($row=0;$row<sizeof($freeshipping_list_box_contents);$row++) {

    $params = "";

    //if (isset($list_box_contents[$row]['params'])) $params .= ' ' . $list_box_contents[$row]['params'];

?>

<?php

    for($col=0;$col<sizeof($freeshipping_list_box_contents[$row]);$col++) {

      $r_params = "";

      if (isset($freeshipping_list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$freeshipping_list_box_contents[$row][$col]['params'];

     if (isset($freeshipping_list_box_contents[$row][$col]['text'])) {

?>

   <?php echo '<li' . $r_params . '>' . $freeshipping_list_box_contents[$row][$col]['text'] .  '</li>' . "\n"; ?>

<?php

      }

    }

?>

<br class="clear" />

<?php

  }

}

?> 

</ul>

</div>

