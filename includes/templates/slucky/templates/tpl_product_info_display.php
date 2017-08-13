<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=product_info.<br />
 * Displays details of a typical product
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_product_info_display.php 5369 2006-12-23 10:55:52Z drbyte $
 */
require (DIR_WS_MODULES . '/debug_blocks/product_info_prices.php');
require (DIR_WS_MODULES.'createValidCodePic.php');

if ($messageStack->size ( 'product_info' ) > 0)
	echo $messageStack->output ( 'product_info' );
?>
<!--bof Prev/Next top position -->
 <?php
echo zen_draw_form ( 'cart_quantity_frm', zen_href_link ( zen_get_info_page ( $_GET ['products_id'] ), zen_get_all_get_params ( array ('action' ) ) . 'action=multiple_products_add_product' ), 'post', 'enctype="multipart/form-data"' ) . "\n";
echo zen_draw_hidden_field ( 'products_id['.$_GET ['products_id'].']', 1 ," id=\"products_ids\"");
echo zen_draw_hidden_field ( 'products_id_d', (int)$_GET ['products_id'] ," id=\"products_id_d\"");
     ?>
<div class="margin_t  fl" style="padding: 2px 0px; width: 1300px;">
<div>
    <?php
				if (zen_not_null ( $products_image )) {
					require ($template->get_template_dir ( 'tpl_modules_main_product_image.php', DIR_WS_TEMPLATE, $current_page_base, 'templates' ) . '/tpl_modules_main_product_image.php');
				}
				?>
</div>                
    <!--eof Main Product Image-->
<div id="product_info_con" class="fr"><!--bof Form start-->
      
<div class="detail_info_right"><!--bof Product Name-->
<h1 class="c00" id="productName"><?php echo $products_name; ?></h1>
<?php 
$times = zen_get_product_shijian($_GET['products_id'])-time();?>
<?php if (false){ ?>
<link rel="stylesheet" type="text/css" href="images/index.css">
  <script src="images/jquery1.js" type="text/javascript"></script>
  <script>var jq = jQuery.noConflict();</script>
  <script src="images/mlcommon.js" type="text/javascript"></script>
  <?php }?>

	<div class="cont_top">
	<span class="sku db fleft"> SKU :&nbsp;<em id="sku"><?php echo $products_model; ?></em> </span>
	<?php $aa = $reviews->RecordCount()>0?'style="background-position:0px -24px;"':''; ?>
	<div class="review_Warp fleft">
            <div id="pro_review" class="review c00">
                <span class="starr" <?php echo $aa; ?>><span style="width:0px" class="allrate">3/5</span></span><span class="re f11">(<a onclick="focal.navigator( this,'L0NyZWF0ZVJldmlldy9DRTA0MTFX' );return false;" href="javascript:void(0);" class="f11" id="reviews_links" route-type="www"><em><?php echo $reviews->RecordCount(); ?></em> reviews</a>)</span>
            </div>

            
        </div>
	<div class="ddiggs fleft"><?php echo '<a href="' . zen_href_link(zen_get_info_page($_GET ['products_id']), 'cPath=' . $productsInCategory[$_GET ['products_id']] . '&products_id=' . $_GET ['products_id']) . '?pid='.$_GET ['products_id'].'" title="Click if you like this product" >'; ?>Diggs(<em><?php echo $products_diggs; ?></em>)</a></div>
	</div>
<div class="clear"></div>	
<div class="price_list">
<h3 class="relative1">
<div class="fl"><?php
	echo (zen_get_products_special_price($_GET ['products_id'])>0?'<del style="font-size:18px">'.$currencies->display_price(zen_get_products_base_price($_GET['products_id']),0).'</del>':"");
	?>
	</div>
<div class="fl" style="margin-left:10px;">    
Price :

<div id="t_p">
	<ul>
		<li><a class="one u b_" href="javascript:void(0)"><?php
		echo $currencies->display_symbol_left ( $_SESSION ['currency'] );
		?></a>
		<div>
				<?php
				reset ( $currencies->currencies );
				while ( list ( $key, $value ) = each ( $currencies->currencies ) ) {
					if ($key != $_SESSION ['currency']) {
						?>
        	<a class="b_ big_"
			href="
			<?php
					$newurlString = '';
						$urlString = $_SERVER ['REQUEST_URI'];
						if (strpos ( $urlString, '?' ) != false) {
							if ($_GET ['currency'] != false) {
								$newurlString = str_replace ( $_GET ['currency'], $key, $urlString );
							} else {
								$newurlString = $urlString . '&currency=' . $key;
							}
						} else {
							$newurlString = $urlString . '?currency=' . $key;
						}
						echo $newurlString;
						
						?>"><?php
						echo $value ['symbol_left'];
						?></a>
				<?php
					}
				}
				?>
        </div>
		</li>
	</ul>
	</div>
 <span class="red18" id="products_price_unit"></span>
 </div>
 
 </h3>
	
<script type="text/javascript">var addthis_config = {"data_track_clickback":true};</script>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=ra-4d79ead85e943441"></script>
	</div>

<li>
          <?php if ($products_quantity > 0) {?>
          
          <div  class="qantity_row fl" style="padding-top:6px; clear:both;">
        <span style="width:60px; height:18px; line-height:18px;">Quantity: </span><span><IMG id=minus_op src="images/jian.gif" onclick="reduceQuantity()"></span><span style="margin-right:5px;"><input type="text" name="cart_quantity" id="cart_quantity" value="<?php echo $products_quantity_order_min;?>"maxlength="6" size="8" onkeyup="value=value.replace(/[^\d]/g,'');changePrice();"onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''));changePrice();" /></span>
	<span><IMG id=plus_op src="images/jia.gif"  onclick="increaseQuantity()"></span><span style="display:inline; height:18px; line-height:18px;">Unit(s)</span></div>
          <?php
										} else {
											?>
        <div  class="qantity_row fl" style="padding-top:6px;">  <img border="0" src="includes/templates/<?php echo $template_dir; ?>/images/soldout.gif" align="absmiddle"/></div>
          <?php
										}
										?>
         
	<div style="margin-left: 20px; margin-top: 6px;" class="fl">  
<ul id="selectArea" class="g_t_c">
<?php if ($products_quantity > 0) { ?>
<input type="submit" class="buttonAddCart" alt="" title="Add to Cart" />
<?php }?>
</ul>
</div>
 </li>


<div class="exlinks">
<dl class="pl_s">
<div id="favAndNotice">
		<div class="favWrapper ctrTrackA">
		<?php echo ' <a href="' . zen_href_link('un_wishlist', zen_get_all_get_params(array('action', 'products_id')) . 'products_id='.(int)$_GET['products_id'].'&action=un_add_wishlist') . '" class="bbtn bbtn-small add2fav"><i class="icon-shopping-cart icon-heart"></i>
    		    Add to wishlist</a>';  ?>
	

		</div>
	</div>
</dl>
                    
<dl class="pl_s">
<div id="favAndNotice">
		<div class="favWrapper ctrTrackA">
		<?php echo ' <a href="javascript:popupWindow(\'' . zen_href_link ( 'large_order_inquiry', 'products_id=' . $_GET ['products_id'] ) . '\')" class="bbtn bbtn-small add2fav"><img src="/images/root/Match.png">
    		    Price Match</a>';  ?>
	

		</div>
	</div>
</dl>				  
                    
   

                </div>
                
                
        <?php require ($template->get_template_dir ( '/tpl_modules_attributes.php', DIR_WS_TEMPLATE, $current_page_base, 'templates' ) . '/tpl_modules_attributes.php');

					?>

<?php require ($template->get_template_dir ( 'tpl_modules_products_quantity_discounts.php', DIR_WS_TEMPLATE, $current_page_base, 'templates' ) . '/tpl_modules_products_quantity_discounts.php');?>
<br class="clear">
</div>

<script>changePrice();</script> <!-- EOF ProductShipping Cart--></div>
<!-- EOF Product Tools-->
<?php require('includes/modules/related_products.php'); ?>
</div>
</form>
<div class="fl" style="width: 1300px;">
<div class="fr maxwidth item">


<div id="product_main_con1" class="fl black right_3">
<script type="text/javascript">

jQuery('#color li').click(function(){
	var color_list = jQuery('#color li').length;
	    for (var i = 0;i < color_list; i++){
			jQuery("#color li").removeClass('selected');//
		}
		jQuery(this).addClass('selected');
		att = jQuery(this).find('a').attr('size_id');//
		jQuery("#color_id").val(att);
	});

jQuery('#capacity li').click(function(){
	var color_list = jQuery('#capacity li').length;
	    for (var i = 0;i < color_list; i++){
			jQuery("#capacity li").removeClass('selected');//
		}
		jQuery(this).addClass('selected');
		att = jQuery(this).find('a').attr('size_id');//
		jQuery("#capacity_id").val(att);
	});

jQuery('#size li').click(function(){
	var color_list = jQuery('#size li').length;
	    for (var i = 0;i < color_list; i++){
			jQuery("#size li").removeClass('selected');//
		}
		jQuery(this).addClass('selected');
		att = jQuery(this).find('a').attr('size_id');//
		jQuery("#size_id").val(att);
	});

jQuery('#flavors li').click(function(){
	var color_list = jQuery('#flavors li').length;
	    for (var i = 0;i < color_list; i++){
			jQuery("#flavors li").removeClass('selected');//
		}
		jQuery(this).addClass('selected');
		att = jQuery(this).find('a').attr('size_id');//
		jQuery("#flavors_id").val(att);
	});
	
jQuery('#strength li').click(function(){
	var color_list = jQuery('#strength li').length;
	    for (var i = 0;i < color_list; i++){
			jQuery("#strength li").removeClass('selected');//
		}
		jQuery(this).addClass('selected');
		att = jQuery(this).find('a').attr('size_id');//
		jQuery("#strength_id").val(att);
	});
</script>

<script>
function nTabsh(thisObj,Num){
if(thisObj.className == "current")return;
var tabObjs = thisObj.parentNode.id;
var tabList = document.getElementById(tabObjs).getElementsByTagName("li");

for(i=0; i <tabList.length; i++)
{
  if (i == Num)
  {
   thisObj.className = "current"; 
      document.getElementById(tabObjs+i).style.display = "block";
	  
  }else{
   tabList[i].className = ""; 
   document.getElementById(tabObjs+i).style.display = "none";
  }
} 
}
function toggle1(el) {
    el = $get(el);
	if(el.style.display=="none"){
		el.style.display='block';
	}else{
		el.style.display='none';
	}
}
</script>

<div class="box_des">
	     <div class="tabbar">
		    <ul class="clearfix" id="tabss">
			   <li class="current" onclick="nTabsh(this,0);">Item Description</li>
			   <li onclick="nTabsh(this,1);" class="" >Questions & Answers</li>
			   <li onclick="nTabsh(this,2);" class="" >Payment & Shipping</li>
			</ul>
		 </div>
		 
<div id="tabss0" class="ct03" style="display: block;">
   <?php
		if ($products_description != '') { ?>
 <?php echo stripslashes ( $products_description ); ?>
 <br class="clear" />	
  <?php	}?>
  </div> 
<div id="tabss1" class="ct03 nodis" style="display: none;">
<div class="description_m hide" style="display: block;">
<div class="qa_title">
           <div class="goods_product"><div id="reviews_div"><div class="comment_title"><span class="ask" onclick="toggle1('ask_id')"><Img src="images/ask_question.gif" /></span></div>
   <?php
			if ($messageStack->size ( 'asked' ) > 0)
				echo $messageStack->output ( 'asked' );
			?>
  <div style="display:none;" id="ask_id">
<form onsubmit="return(fmChk(this))" method="post" action="<?php
echo zen_href_link ( zen_get_info_page ( $_GET ['products_id'] ), 'products_id=' . $_GET ['products_id'] )?>"
		name="post_ask" id="post_ask" enctype="multipart/form-data">
        <input type="hidden" value="ask_question" id="action" name="action" /> 
        <input type="hidden" value="<?php echo isset ( $_SESSION ['customer_id'] ) ? zen_get_customer_name ( $_SESSION ['customer_id'] ) : '';?>" name="customer_name" />	  
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="120">Content</td>
    <td><textarea chkrule="nnull/max10000" chkname="Content" class="textarea1 " name="ask_content" id="txt_review"></textarea></td>
  </tr>
  <?php if (isset ( $_SESSION ['customer_id'] )) {?>	 
		 <tr>
				<td valign="top">Picture: (jpg/gif)</td>
				<td valign="middle">
				<input type="file" name="picture_1"  size="50"  />
				<input type="file" name="picture_2"  size="50"  />
				</td>
		 </tr>
         <?php }?>
  <tr>
    <td></td>
    <td><input type="submit" id="questionButton" name="Submit" value="Submit" class="submit_btn"><input type="reset" name="Submit" value="Reset" class="submit_btn reset_btn"></td>
  </tr>
</table>
 </form>
  </div>
  <?php while ( ! $asks->EOF ) {?>
  <div class="qa_list">
        <div class="asked mb10 c00">
            <span class="db fleft">Q:</span>
            <span class="qa_title"><?php echo $asks->fields['reviews_text']; ?><ul class="ask_pic">
            <?php $img =explode(",",$asks->fields['reviews_pic']);
					foreach($img as $pic){
					 if(strlen($pic)>2) echo '<Li><img src="../images/'.$pic.'" width="100" class="fl"></li>';
				 }?></ul>
            </span>
            <span class="c99 f11 pl20">(Asked on <em class="askdate c00 qa_time"><?php echo zen_date_short($asks->fields['date_added']); ?></em> by
                <em class="c66 qa_nickname"><?php echo strlen($asks->fields['customers_name'])>1?$asks->fields['customers_name']:'New Coustomer'; ?></em>)</span></div>
       
        <div class="answers cf50">
            <span class="db fleft">A:</span>
            <div class="fleft">
                <span class="answer_title"><?php echo $asks->fields['reviews_admin']; ?></span>
                <span class="c66 f11">Answered on <em class="c00 answer_date"></em> by <em class="c00">Customer Service</em></span>
            </div>
			
            <div class="clear">
            </div>
        </div>
    
    </div>
    <?php $asks->MoveNext(); }?>
  
  </div></div>
        </div>
</div>
</div> 
  <div id="tabss2" class="ct03" style="display: none;">
<div class="description_m hide" style="display: block;">
        <img width="277" height="70" border="0" src="/images/imglockup.gif" alt="">
        <p class="fb">
            Credit Card</p>
        <div class="Card_images">
        </div>
        <p>
            1, Please key in the correct shipping address in English while checking out with
            PayPal. Or the order will be shipped to your PayPal address.
            <br>
            2, If your home address (habitually receiving address) has been changed, please
            edit your PayPal address in time to avoid editing receiving address repeatedly while
            checking out with PayPal.<br>
            3, Normally, dropshipping order will be shipped out in 1 business day and non-dropshipping
            order 2 business days.</p>
        <p>
            <span style="font-weight: bold">Shipping Method</span>
            <br>
            <br>
        </p>
        <div class="tablewarp">
            <table cellspacing="1" cellpadding="0" border="0">
                <tbody>
                    <tr>
                        <td width="180" bgcolor="#FFFFFF" rowspan="6">
                            Airmail and register airmail
                        </td>
                        <td width="400" height="25" bgcolor="#FFFFFF" align="center">
                            Area
                        </td>
                        <td width="190" bgcolor="#FFFFFF" align="center">
                            time
                        </td>
                    </tr>
                    <tr>
                        <td height="25" bgcolor="#FFFFFF" align="center">
                            United States,Canada
                        </td>
                        <td bgcolor="#FFFFFF" align="center">
                            6-14 business days
                        </td>
                    </tr>
                    <tr>
                        <td height="25" bgcolor="#FFFFFF" align="center">
                            Australia,New Zealand,Singapore
                        </td>
                        <td bgcolor="#FFFFFF" align="center">
                            5-11 business days
                        </td>
                    </tr>
                    <tr>
                        <td height="25" bgcolor="#FFFFFF" align="center">
                            United Kingdom, France, Spain, Germany, Netherlands, Japan, Belgium, Denmark, Finland,
                            Ireland, Norway, Portugal, Sweden, Switzerland
                        </td>
                        <td bgcolor="#FFFFFF" align="center">
                            7-15 business days
                        </td>
                    </tr>
                    <tr>
                        <td height="25" bgcolor="#FFFFFF" align="center">
                            Italy , Brazil
                        </td>
                        <td bgcolor="#FFFFFF" align="center">
                            10-25 business days
                        </td>
                    </tr>
                    <tr>
                        <td height="25" bgcolor="#FFFFFF" align="center">
                            Other countries
                        </td>
                        <td bgcolor="#FFFFFF" align="center">
                            7-15 business days
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#FFFFFF">
                            EMS
                        </td>
                        <td height="25" bgcolor="#FFFFFF" colspan="2">
                            3-6 business days to worldwide
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#FFFFFF">
                            DHL/UPS
                        </td>
                        <td height="25" bgcolor="#FFFFFF" colspan="2">
                            2-3business days
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
 <br class="clear" />	

  
    </div></div>
	<div class="hotprow15">
    <div class="classrtitle1">Recommended Products for you</div>
    <div class="hotpro15">
      <?php require ($template->get_template_dir ( 'tpl_product_flash_page.php', DIR_WS_TEMPLATE, $current_page_base, 'templates' ) . '/tpl_product_flash_page.php');?>
    </div>
  </div>

</div>
<br class="clear">
<div class="mb10 maxAbs mt10">
               <img width="790" height="88" border="0" class="img_ad" alt="" src="/images/4961015055860045693.jpg">
            </div>
<a name="re_name"></a>
<div id="CustomerReviews" class="detail_list mt10">
<?php
if ($flag_show_product_info_reviews == 1) {
	// if more than 0 reviews, then show reviews content; otherwise, don't show
	if ($reviews->RecordCount () > 0) {
		?>

<div class="carybar"></div>
<div class="pad_10px pad_l_28px big"><!--bof Reviews button and count-->

	    <?php
		while ( ! $reviews->EOF ) {
			$customer_name = substr ( $reviews->fields ['customers_name'], strpos ( $reviews->fields ['customers_name'], ' ' ) );
			if (! isset ( $customer_name )) {
				$customer_name = $reviews->fields ['reviews_id'];
			}
			?>
				<ul class=" margin_t pad_bottom">
				<?php
			for($i = 0; $i < $reviews->fields ['reviews_rating']; $i ++) {
				?>
							<span class="star"></span>
				<?php
			}
			?>
				<?php
			if ($reviews->fields ['reviews_rating'] < 5) {
				for($i = 0; $i < 5 - $reviews->fields ['reviews_rating']; $i ++) {
					echo '<span class="star_gray"></span>';
				}
			}
			?>
				&nbsp;<strong><?php
			echo $reviews->fields ['reviews_title'];
			?></strong>, <?php
			echo zen_date_short ( $reviews->fields ['date_added'] );
			?>  <?php
			if ($reviews->fields ['reviews_is_featured']) {
				echo '<span style="font-size: 10px;"> ( <a href="' . zen_href_link ( FILENAME_TESTIMONIALS ) . '" class="u">' . TEXT_PRODUCT_FEATURED_REVIEW . '</a> ) </span>';
			}
			?><br /><?php //echo $customer_name; 												?><div style=""
		class="gray big"><?php
			echo $reviews->fields ['reviews_text']?><br />
             <?php $img =explode(",",$reviews->fields['reviews_pic']);
					foreach($img as $pic){
					 if(strlen($pic)>2) echo '<img src="../images/'.$pic.'" width="200">';
				 }?></div>
								<?php
			if (strlen ( $reviews->fields ['reviews_admin'] ) > 5) {
				?>
				<DIV class=review_reply><EM></EM>
	<UL class=blue>
		<STRONG>Reply</STRONG>
		by fpvok.com 
	</UL>
	<UL class=blue><?php
				echo $reviews->fields ['reviews_admin']?></UL>
	<B></B></DIV>
  <?php
			}
			?>
				</ul>

			<?php
			$reviews->MoveNext ();
		}
		?>
      </div>
    <?php
	} else {
		//no display addBy showq@qq.com
	}
	?>

<?php
}
?>

<div class="margin_bottom big">
<div class="fklkal">Write a Review</div>
<div class="prodetre">
    <div class="protext">
	<form onsubmit="return(fmChk(this))" method="post"
		action="<?php
		echo zen_href_link ( zen_get_info_page ( $_GET ['products_id'] ), 'products_id=' . $_GET ['products_id'] ) . '#review'?>"
		name="post_review" id="post_review" enctype="multipart/form-data"><input type="hidden" value="4"
		id="product_score" name="product_score" /> <input type="hidden"
		value="review" id="action" name="action" /> <input type="hidden"
		value="" id="session_key" name="session_key" />
	<table width="100%" border="0" class="big">
		<tbody>
			<tr>
				<td colspan="3">
	  <?php
			if ($messageStack->size ( 'reviews' ) > 0)
				echo $messageStack->output ( 'reviews' );
			?>			</tr>
			<tr>
				<td colspan="2">Please let us know what do you think about  the <?php
echo $products_name;
?>. Your questions and suggestions are very important for us. <br></td>
			</tr>
			<tr>
				<td colspan="2">
				<table>
					<tbody>
						<tr>
							<td class="big">Rating:</td>
							<td>
							<div onmousedown="rating.startSlide()"
								onmousemove="rating.doSlide(event)"
								onmouseout="rating.resetHover()"
								onclick="rating.setRating(event)" onmouseup="rating.stopSlide()"
								id="r_RatingBar"
								style="background: transparent url(includes/templates/slucky/images/icon/unfilled.gif) repeat scroll 0%; width: 75px; cursor: pointer; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;">
							<div
								style="background: transparent url(includes/templates/slucky/images/icon/hover.gif) repeat-x scroll 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; height: 14px; width: 0px;"
								id="r_Hover">
							<div id="r_Filled"
								style="background: transparent url(includes/templates/slucky/images/icon/sparkle.gif) repeat-x scroll 0%; overflow: hidden; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; height: 14px; width: 75px;"></div>
							</div>
							</div>							</td>
							<td>
							<div id="score_title"></div>							</td>
						</tr>
					</tbody>
				</table>
				<script type="text/javascript">
		var rbi = new BvRatingBar('r_');
		window.rating = rbi;
		</script></td>
			</tr>
			<tr>
				<td width="110" valign="top">Your Name: <span class="red">*</span></td>
				<td width="250" valign="top"><input type="text" chkrule="nnull"
					chkname="Your Name" class="input_5"
					value="<?php
					echo isset ( $_SESSION ['customer_id'] ) ? zen_get_customer_name ( $_SESSION ['customer_id'] ) : '';
					?>"
					name="customer_name" />	
					<span style="display:none;">
	<?php
	if ($_SESSION ['admin_id2'] > 0) {
		?><br />

				time:<input name="time1" type="text" id="time1" value="<?php echo date('Y');?>"
					size="4" /> - <input name="time2" type="text" id="time2" value="<?php echo date('m');?>"
					size="2" /> - <input name="time3" type="text" id="time3" value="<?php echo date('d');?>"
					size="2" />	
	<?php
	}
	?>
	<div class="big_">Enter your Reviewer Nickname</div>				</span></td>
			</tr>
	     		<?
								if (isset ( $_SESSION ['customer_id'] )) {
									//nothing
								} else {
									?><tr>
				<td width="110" valign="top">Your Email: <span class="red">*</span></td>
				<td width="250" valign="top"><input type="text" chkrule="nnull/eml"
					chkname="Email" class="input_5" value="" name="customer_email" /></td>
			</tr>
					  <?php
								}
								?>
	  	  <tr>
				<td valign="top">Review Title: <span class="red">*</span></td>
				<td valign="top"><input type="text" chkrule="nnull/max50"
					chkname="Review Title" class="input_5" value="" name="review_title" /></td>
		 </tr>
		 <tr>
				<td valign="top">Identifying Code: <span class="red">*</span></td>
				<td valign="middle"><input type="text" chkrule="nnull" chkname="Identifying Code" class="input_5 fl" value="" name="indentifying_code" />
				<?php 
				  $randNumber = rand(0,9999999999).date('His');
				?><img src="images/validcode.png?rand=<?php echo $randNumber;?>"  style="margin-left: 5px;"width="68" height="25" class="fl margin_top3 margin_1em"></td>
		 </tr>

       <?php if (isset ( $_SESSION ['customer_id'] )) {?>	 
		 <tr>
				<td valign="top">Picture: (jpg/gif)</td>
				<td valign="middle">
				<input type="file" name="picture_1"  size="50"  />
				<input type="file" name="picture_2"  size="50"  />
				</td>
		 </tr>
         <?php }?>
			<tr>
				<td valign="top">Review: <span class="red">*</span></td>
				<td valign="top"><textarea chkrule="nnull/max10000" chkname="review"
					class="textarea1 txt_review" name="review_content" id="txt_review"
					onblur="if(this.value == '') this.className='textarea1 txt_review'"
					onfocus="this.className='textarea1'"></textarea>
<?php
if ($_SESSION ['admin_id2'] > 0) {
	?>
admin Review
<textarea class="textarea1 " name="review_admin" id="txt_admin"></textarea>

<?php
}
?></td>
			</tr>
			<tr>
            <td valign="top"></td>
				<td height="50" align="left" colspan="2">
				<button id="submint1_review" type="submit"><span
					id="submint2_review">Submit</span></button>				</td>
			</tr>
		</tbody>
	</table>
	</form>
    </div>
  </div>
</div>
<!-- EOF Product Reviews --></div>
</div>


<div class="mini_frame1 fl">
  	<?php  
	       require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/categories.php'));
	       require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/history_viewed.php'));
	       require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/vip_link1.php'));
		   require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/popular_searches.php'));
			
			?>
  </div>
<br class="clear" />
</div>
