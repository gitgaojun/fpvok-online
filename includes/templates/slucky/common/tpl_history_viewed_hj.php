<?php
/**
 * Common Template - tpl_history_viewed.php
 *
 * @package templateSystem
 * @copyright Copyright 2010-2012 Gold
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_history_viewed.php 2975 2010-04-22 $
 */

// choose box images based on box position
  if ($title_link) {
    $title = '<a href="' . zen_href_link($title_link) . '">' . $title . BOX_HEADING_LINKS . '</a>';
  }
//
?>
<!--// bof: history viewed //-->

<div class="margin_t" id="<?php echo str_replace('_', '-', $box_id ); ?>">
<?php echo $content; ?>
</div>
<!--// eof: history viewed //-->

