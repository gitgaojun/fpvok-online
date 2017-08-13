<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_reviews_default.php 2905 2006-01-28 01:25:36Z birdbrain $
 */
?>
<div class="minframe fl">

 <div class="bg_box_gray margin_t clear">
<div class="BoxBar">My Account</div>
	<div class="pad_14px pad_t allborder no_border_t">
	<ul class="red_arrow_list">
	<li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT,'','SSL'); ?>">My Orders</a></li>
	<li><a class="red b"href="/reviews.html">My Reviews</a></li>
	<li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT_EDIT,'','SSL');?>">My Profile</a></li>
	<li><a href="<?php echo zen_href_link(FILENAME_MANAGER_ADDRESS,'','SSL');?>">My Address</a></li>
    <li><a href="/index.php?main_page=un_wishlist">My Wishlist</a></li>
	</ul>
	</div>
</div>

<div class="bg_box_gray margin_t clear">
	<div class="BoxBar">Need help</div>
		<span class="pad_10px pad_t block allborder no_border_t">If you have questions or need help with your account, you may <a class="u" href="/faq_info.html?faqs_id=150&fcPath=21">contact us</a> to assist you.	</span>
</div>
</div>
<div class="right_big_con">

<h2 class="border_b line_30px pad_l_10px"><?php echo $breadcrumb->last();  ?></h2>
<?php
  if ($reviews_split->number_of_rows > 0) {
    if ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3')) {
?>
<div class="gray_bg pad_10px"><div class="fr"><?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></div><?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'main_page'))); ?></div>

<?php
    }

    $reviews = $db->Execute($reviews_split->sql_query);
    while (!$reviews->EOF) {
?>
<ul class="border_b pad_10px">

<li class="fl" style="width:100px;"><?php echo '<a  class="ih4" href="' . zen_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $reviews->fields['products_id'] ) . '#review">' . str_replace("/s/","/l/",zen_image(DIR_WS_IMAGES . $reviews->fields['products_image'], SEO_COMMON_KEYWORDS . ' ' .$reviews->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT)) . '</a>'; ?></li>
<li class="" style="width:600px;"><h2><?php echo '<a href="' . zen_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $reviews->fields['products_id'] ) . '#review">'.$reviews->fields['products_name']. '</a>'; ?></h2>
		<div class="rating">
        <?php for( $i = 0;$i < $reviews->fields['reviews_rating'];$i++){?>
              <span class="star"></span>
        <?php } ?>
        <?php if ( $reviews->fields['reviews_rating']<5){
                for( $i = 0;$i < 5-$reviews->fields['reviews_rating'];$i++){
                  echo '<span class="star_gray"></span>';
                }   
              }?>
			</div><br/>

<div class="pad_10px">
<b><?php echo TEXT_REVIEW_DESCRIPTION; ?></b><?php echo zen_break_string(nl2br(zen_output_string_protected(stripslashes($reviews->fields['reviews_text']))), 60, '-<br />') . ((strlen($reviews->fields['reviews_text']) >= 100) ? '...' : ''); ?><br/>
<b><?php echo TEXT_REVIEW_DATE_ADDEDS; ?></b><?php echo zen_date_short($reviews->fields['date_added']); ?><br/><br/>
<b><?php echo TEXT_REVIEW_BYS; ?></b><?php echo sprintf(TEXT_REVIEW_BY, zen_output_string_protected(($reviews->fields['customers_name'] != ''?$reviews->fields['customers_name']:'Guest'))); ?></div></li>

<br class="clear"/>
<?php if (strlen($reviews->fields['reviews_admin'])>5){?>
				<DIV class=review_reply><EM></EM>
  <UL class=blue><STRONG>Reply</STRONG>by fpvok.com </UL>
  <UL class=blue><?php echo $reviews->fields['reviews_admin'] ?></UL><B></B></DIV>
  <?php }?>
</ul>
<?php
      $reviews->MoveNext();
    }
?>
<?php
  } else {
?>
<div id="reviewsDefaultNoReviews" class="content"><?php echo TEXT_NO_REVIEWS; ?></div>
<?php
  }
?>
<?php
  if (($reviews_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<div class="gray_bg pad_10px"><div class="fr"><?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></div><?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'main_page'))); ?></div>
<br class="clear" />
<?php
  }
?>

</div>
