<div id="container">
    	<div class="Channel_box">
        	<img src="/images/channel_pic13.jpg" class="ad_channel"> 
        </div>
        <div class="Channel_box">
            <div class="fleft DropShipping_Clients">
            	<p class="f20 c175 mb20">Monthly Deals for Drop-Shipping Clients:</p>
                <ul class="Channel_Monthly_Deals">
                <?php $random_featured = "select p.products_id, p.products_image, pd.products_name
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_SPECIALS . " f on p.products_id = f.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = f.products_id
                           and p.products_id = pd.products_id
                           and p.products_status = 1
                           and f.status = 1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' limit 3";
				$new_products = $db->Execute($random_featured);
				while (!$new_products->EOF) {
					$url = zen_href_link(zen_get_info_page($new_products->fields['products_id']), 'cPath=' . $productsInCategory[$new_products->fields['products_id']] . '&products_id=' . (int)$new_products->fields['products_id']);
					$pro_name = $new_products->fields['products_name'];
					$speic_price = zen_get_products_special_price($new_products->fields['products_id']);
					$base_price = zen_get_products_base_price($new_products->fields['products_id']);
					$baifenbi = number_format(($base_price-$speic_price)/$base_price,2)*100;
						   ?>
                	<li>
                    	<p class="photo"><a href="<?php echo $url; ?>" title="<?php echo $pro_name; ?>" field="ProductName"><?php echo zen_image(DIR_WS_IMAGES .str_replace("s/","l/", $new_products->fields['products_image']), $pro_name, 155, 120,''); ?></a></p>
                        <p class="f11"><a href="<?php echo $url; ?>" title="<?php echo $pro_name; ?>"><?php echo $pro_name; ?></a></p>
                        <p class="c99 textline f14 originalprice"><?php echo $currencies->display_price($base_price,0); ?></p>
                        <p class="c200 fb f14 unitprice"><?php echo $currencies->display_price($speic_price,0); ?></p>
                        <p class="f11 c00">You Save <em class="cff5 dropshipping_save"><?php echo $baifenbi; ?>%</em></p>
                        <p class="f11 c00">Only for Drop-shipping</p>
                        <p class="off dropshipping_save"><?php echo $baifenbi; ?>%</p>
                    </li>
                <?php  $new_products->MoveNext();
  }?>	  <div class="clear"></div>
					
                </ul>
				<a href="/best_deal.html" style="margin-right:50px;" class="cblue fright">More</a>
                
            </div>
        	<div style="width:387px;" class="fright">
                <p class="f18 cff5 mb20 alignL">fpvok.com Drop-Shipping</p>
                <p class="btn_submit07"><a field="join" ></a></p>
                <p class="btn_submit08"><a field="place" ></a></p>
                <p style="margin-top:25px;"><img src="/images/imgBox/channel_pic01.jpg" class="jion-img-gad"> <img src="/images/imgBox/channel_pic02.jpg" class="jion-img-gad"> </p>
       		</div>
            <div class="clear"></div>
        </div>
    	<div class="Channel_box">
        	<p id="whatdoes" class="f20 c175 pb10 pl20">What does fpvok.com add to dropshipping?</p>
            <p class="f13 pl40">fpvok.com was established in 2008, is one of the top 3 China B2C e-Commerce companies, with over 70,000 items across almost 100 categories, we have below advantages:</p>
            <ul class="Channel_what pl40 pt20">
            	<li>
                	<p style="line-height:37px;" class="cf06 f14 fb"><span class="ico01"></span>Best Price</p>
                    <p class="fleft pl38">
                    	10% off discount for your first dropshipping order<br>
                        1.5% off or more discounts for further dropshipping orders<br>
                        10% off for popular items in Monthly Deals
                    </p>
                </li>
            	<li>
                	<p style="line-height:37px;" class="cf06 f14 fb"><span class="ico02"></span>Fast Shipping</p>
                    <p class="fleft pl38">
                    	Free shipping worldwide<br>
                        65% orders be shipped out within 24h and 98% within 48h<br>
                        Priority shipping of Dropshipping orders
                    </p>
                </li>
            	<li>
                	<p style="line-height:37px;" class="cf06 f14 fb"><span class="ico03"></span>Assured Quality</p>
                    <p class="fleft pl38">
                    	Three standard QC processes in factory<br>
                        QC processes in our warehouse<br>
                        Three month guarantee on most of the items
                    </p>
                </li>
            	<li style="padding-bottom:5px;">
                	<p style="line-height:31px;" class="cf06 f14 fb"><span class="ico04"></span>Valued Service</p>
                    <p class="fleft pl38">
                    	Free to get product's large images without our watermark<br>
                        Exclusive offers &amp; newsletters<br>
                        World-Class customer service<br>
                        Business expansion training and other valued added services
                    </p>
                </li>
                <div class="clear"></div>
            </ul>
        </div>
        <div class="Channel_box">
        	<p id="howdropshipping" class="f20 c175 pb10 pl20">How dropshipping works?</p>
            <p class="f13 pl40 l15">Dropshipping is a business mode in which you do not keep goods in stock; instead you transfer your customer's order and shipment details to us. We will ship the goods directly to your customer, and the parcel will not have any information of us. You make profit on the price difference during the transaction.</p>
        	<p style="width:638px; height:233px;" class="mauto"><img width="638" height="233" src="/images/imgBox/channel_pic05.jpg"></p>
        </div>
        <div style="padding-bottom:40px;" class="Channel_box">
            <p id="howcan" class="f20 c175 mb20 pl20">How can dropshipping benefit you?</p>
            <div class="fleft Channel_box_items">
                <img src="/images/imgBox/channel_pic03.jpg" class="mr10 fleft Channel_pic">
                <ul class="c5a5">
                    <p class="f18 c00 pb8">That's all you need </p>
                    <li class="mt5 mb5"><span class="Channel_icon01"></span><span style="float: right; width:240px;"><strong>Working from home</strong> + your own hours </span></li><br>
                    <li class="mt5 mb5"><span class="Channel_icon01"></span><span style="float: right; width:240px;">Very <strong>low startup costs</strong> and operating costs</span></li><br>
					 
                    <li class="mt5 mb5"><span class="Channel_icon01"></span><span style="float: right; width:240px;"><strong>No need</strong> warehouse, inventory, employee &amp;  shipping</span></li><br><br>
                    <li class="mt5 mb5"><span class="Channel_icon01"></span><span style="float: right; width:240px;">Focus on <strong>selling only</strong></span></li>
                </ul>
            </div>
            <div class="fright Channel_box_items">
                <img src="/images/imgBox/channel_pic04.jpg" class="mr10 fleft Channel_pic">
                <ul class="c5a5">
                    <p class="f18 c00 pb8">Unlimited earning potential</p>
                    <li class="mt5 mb5"><span class="Channel_icon01"></span><span style="float: right; width:240px;"><strong>No need to pay</strong> the order until it has sold</span></li><br>
                    <li class="mt5 mb5"><span class="Channel_icon01"></span><span style="float: right; width:240px;"><strong>No minimum order</strong> requirements</span></li><br>
                    <li class="mt5 mb5"><span class="Channel_icon01"></span><span style="float: right; width:240px;">Buy at <strong>wholesale price,</strong>sell at your own retail price</span></li><br><br>
                    <li class="mt5 mb5"><span class="Channel_icon01"></span><span style="float: right; width:240px;"><strong>Unlimited profit margin</strong></span></li>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
        <div class="Channel_box">
            <span class="f14 fleft howtojoin">
            	<p id="howto" class="f20 c175 pb10 pl20 mb20">How to join as a Dropshipping client?</p>
                <ul style="margin-left:90px;">
                    <p class="c00 pb8">Just 3 easy steps:</p>
                    <li class="mt5 mb5 ml20"><span class="Channel_icon09"></span>Register an account and sign in your account</li>
                    <li class="mt5 mb5 ml20"><span class="Channel_icon09"></span>Fill in the request form online and submit</li>
                    <li class="mt5 mb5 ml20"><span class="Channel_icon09"></span>Become a Drop-shipping client after our approval</li>
                    <li class="mt20 ml20"><a field="join" ><img width="220" height="40" src="/images/imgBox/channel_icon06.jpg"></a></li>
                </ul>
            </span>
            <img width="420" height="223" src="/images/imgBox/channel_pic06.jpg" style="margin:10px 0 10px 130px;">
            <div class="clear"></div>
        </div>
        <div class="Channel_box">
                <p class="f20 c175 mb20 pl20">What our customers say?</p>
                <img width="162" height="173" src="/images/imgBox/channel_pic07.jpg" class="ml20 fleft">
                <span class="fright Channel_box_con">
                    <p class="f14 c00 l18 mb5">
                    	As A Grandmother I've Built A Successful EBay Business 
                    	Dropshipping…Find Out How &amp; With Whom….&gt;&gt;&gt;
                    </p>
                    <p style="height:160px;overflow:auto;overflow:scroll-y;overflow-x:hidden;" class="l22">
                        My career was actually in teaching, for 29 years; a career I was, and still 
                        am, extremely passionate about.  My last position was as a Relieving 
                        Assistant Principal in a Primary School. <br><br>
                         
                        During one of my school excursions, accompanying my students, &amp; whilst 
                        in charge of the Senior School visiting an end of year Arts Display at the 
                        local University, I was to have a freak, &amp; serious, accident that would 
                        ultimately change the direction of my life, &amp; health etc, forever…&gt;&gt;&gt; <br><br>
                         
                        After a number of years, mostly in hospital extremely ill, &amp; with many 
                        operations occurring,&amp;  having lost my career, health, income &amp;, 
                        ultimately the family home, (and now also being disabled), I have NEVER 
                        been a person to ever give up.  In the good times, I looked at many ways 
                        I could again begin to assist my family &amp; the family income, &amp; also feel 
                        like I was actually part of the world again. <br><br>
                         
                        I, ultimately, after a few times of having been taken for an expensive row 
                        with supposed successful business opportunities, having gone religiously 
                        through their training &amp; costs to find this was definitely NOT true, I found 
                        I was able to be very successful at selling items from around my home on 
                        eBay, which also helped me to make extra money &amp; assist the family to 
                        get through some of the subsequent hard times that had occurred for all 
                        members of my family as a result of this accident.  <br><br> 
                         
                        I started selling a wide variety of different items that covered many 
                        varied eBay categories and found I was earning a fairly good amount of 
                        money each week, but the packaging &amp; posting of the items were taking a 
                        very heavy toll on my condition.<br><br> 
                         
                        I also realised I was going to eventually end up running out of items to 
                        sell from around the home, (unless the family were all going to end up 
                        without any furniture/clothing etc left at all), &amp; my husband was, &amp; had 
                        always been, working full time, so for me to continue to package items, 
                        and take them to the Post Office for shipment was really affecting my 
                        disability/ pain/ walking/ health quite considerably. 
                         I knew I needed to find another way of working my eBay business (if it 
                        existed?), that would enable me to continue working eBay that I had 
                        definitely found I really loved doing, and also had found I was very good 
                        at this; but I knew it would have to be something that did not entail me 
                        having to continue to package/ travel etc. <br><br>
                         
                        Around this time, as if a gift from a higher source showed itself at the 
                        right time, I was to fortunate to meet a wonderful person who availed me 
                        of the opportunity to learn, &amp; implement, Dropshipping as a method for 
                        continuing to build my eBay business.   <br><br>
                         
                        I found it was exactly what I was looking for.<br><br> 
                         
                        It was during this initial learning &amp; implementing time I was introduced to 
                        fpvok as a Dropshipping provider availing itself to me with an 
                        outstanding record to date.   <br><br>
                         
                        I have worked with them extremely successfully now for just on 3 years. <br><br>
                         
                        With fpvok's incredible assistance &amp; support,I have them Dropship a 
                        wide variety of products for me that cover a wide spectrum of different 
                        categories across eBay, &amp; they deliver these products to my valued eBay 
                        customers for me all around the world. <br><br>
                         
                        I have 4 IDs on eBay &amp; they are all Top Seller/ PowerSeller &amp; 100% 
                        feedback score in all 4 IDs, awarded to me by eBay, &amp; of which I am very 
                        proud indeed.  I have worked very successfully with around 5000 valued 
                        customers during the last 3 years (3 of these IDs having commenced only 
                        1 year ago), resulting in the proud receipt of over 2700 positive feedbacks 
                        to date across all 4 IDs. <br><br>
                         
                        To DropShip successfully, one needs to find truly excellent suppliers, and 
                        I know I have found the best out there. <br><br>
                         
                        My experience, and knowledge, have continued to grow, &amp; I have the 
                        greatest faith in fpvok as an excellent company that extends 
                        Dropshipping as one of its options for people to build a very successful 
                        business. <br><br>
                         
                        Their support is truly outstanding, as are their products, shipping times 
                        and packaging etc. <br><br>
                         
                        I feel extremely fortunate indeed to have found Dropshipping &amp; Focal 
                        Price &amp; continue to list new products from them all the time. <br><br>
                         
                        Having had experience in listing in a wide variety of categories on eBay, 
                        this all has given me the excellent opportunity to continue to list many, many different items on eBay that cover a wide spectrum, and hence 
                        enables me to continue to gain more and more extensive knowledge of 
                        these items to impart to my valued customers.  If I have concerns at all 
                        about questions customers are asking I am able to get the answer to 
                        those questions almost immediately to give back to my customers 
                        because of their brilliant online service to me. <br><br>
                         
                        If one category is not selling due to seasonal issues/stock/ not popular at 
                        a particular time, I do not have to concern myself about this as I always 
                        have a wide variety of other products listed that do successfully fill these 
                        situations. <br><br>
                         
                        I don't need to have space at home for storage of products at all.  <br><br> 
                         
                        I don't need to take my own photos.<br><br> 
                         
                        I don't need to iron items. <br><br>
                         
                        I don't need to package items, nor purchase special products for the 
                        packaging of items such as stamps/ postal envelopes/ bubble wrap etc. <br><br>
                         
                        I don't need to go to the Post Office with loads of items for shipment. <br><br>
                         
                        I offer free shipment which is extremely sought after as postal costs to 
                        deliver to customers all around the world can be extremely expensive. <br><br>
                         
                        My items are also excellently priced as fpvok items are fairly priced 
                        indeed for such brilliant products.<br><br> 
                         
                        My aim is to have 300 items selling in each of my IDs &amp; I is also listing on 
                        my new BVD site - 
                        http://www.bigvaluedepot.com/WorldWide_Warehouse_GroupStore <br><br>
                         
                        and I know fpvok will continue to assist me professionally and 
                        caringly to do so. <br><br>
                         
                        I really and truly consider myself to be in an extremely fortunate place.  <br><br>
                         
                        Thanks heaps &amp; heaps fpvok! 
 
    				</p>
    				<div class="clear"></div>
                </span>
            <div class="clear"></div>
        </div>
        <div class="Channel_box">
        	<p class="f20 c175 mb20 pl20">Frequently Asked Questions:</p>
            <ul class="mr60 fleft asked">
                <li class="mt5 mb5 ml20"><span class="Channel_icon09"></span>How dropshipping works?</li>
                <li class="mt5 mb5 ml20"><span class="Channel_icon09"></span>How to join as a Dropshipping client?</li>
                <li class="mt5 mb5 ml20"><span class="Channel_icon09"></span>How can drop shipping benefit?</li>
                <li class="mt5 mb5 ml20"><span class="Channel_icon09"></span>What does fpvok.com add to dropshipping?</li>
            </ul>
            <ul class="fleft">
                <li class="mt10 mb5">More information please <a class="c004">check here </a></li>
                <li class="mt10 mb5">or contact us directly:</li>
                <li class="mt10 mb5"><span class="mr20">E-mail: Dropshipping@fpvok.com</span><span class="mr20">MSN: Dropshipping@fpvok.com</span><span>Telephone: 86 755 23907119</span></li>
            </ul>
            <div class="clear"></div>
            <p class="mb10 ml40 mt20"><a field="join"><img width="170" height="31" src="/images/imgBox/channel_icon07.jpg"></a></p>
        </div>
        <div style="padding-bottom:30px; border-bottom:none;" class="Channel_box">
        	<p class="f20 c175 mb20 pl20">The place where we work:</p>
            <div class="fleft workpic">
            <img width="148" height="103" src="/images/imgBox/channel_pic08.jpg" class="ml20 mr7">
            <img width="148" height="103" src="/images/imgBox/channel_pic09.jpg" class="mr7">
            <img width="148" height="103" src="/images/imgBox/channel_pic10.jpg" class="mr7">
            <img width="148" height="103" src="/images/imgBox/channel_pic11.jpg" class="mr7">

            </div>
            <span class="c00 mt40 fleft">
            	Chiang Network Technology Co., Ltd<br>
                Flat 01B1, 10/F Carnival Commercial Building,<br>
				18 Java Road, North Point, HK
            </span>
            <div class="clear"></div>
        </div>
</div>