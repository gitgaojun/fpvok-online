<script>
var arrActiveBlockContent = new Array();
function hpdeal_swapcontent(blockRef, contentRef)
{
	if( !arrActiveBlockContent[blockRef] )
	{
		for( i=1; i<=4; i++ )
		{
			jQuery('#hpdeal_b'+blockRef+'_l'+i).removeClass('active');
			if(i==contentRef){
			    jQuery('#hpdeal_b'+blockRef+'_c'+i).show();
			}else{
				jQuery('#hpdeal_b'+blockRef+'_c'+i).hide();
			}
		}
	}
	
	jQuery('#hpdeal_b'+blockRef+'_l'+contentRef).addClass('active');
	
}
</script>
<?php $symbolLeft = $currencies->display_symbol_left($_SESSION['currency']);?>
<link rel="stylesheet" type="text/css" href="js/product.css">
<script type="text/javascript" src="includes/templates/slucky/jscript/jscript_jquery-1.js"></script>
<script type="text/javascript" src="js/artDialog.js"></script>

<div id="deals_content" class="daily_deal mauto">
        <div class="dailyabs1">
            <img height="72" src="/images/dailydeal_abs_01.jpg"></div>
        <div class="daily_title">
            Deal Expires in:<em id="dailyTime"></em></div>
        <!--left begin-->
        <div id="deals_main">
<?php 
	  $i_add = 1;
	  $str_add = "";
	  $specials_add = "select p.products_id, p.products_image,pd.products_name,p.products_model
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = s.products_id and expires_date !='0001-01-01'
                           and p.products_id = pd.products_id
                           and p.products_status = '1' and s.status = 1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "' limit 4";
		$specials_add = $db->Execute($specials_add);	   
			if ($specials_add->RecordCount() > 0) {	
				while (!$specials_add->EOF) {
					$add_sty = $i_add==1?'block':'none';
					$activ = $i_add==1?'active':'';
					$add_url = zen_href_link(zen_get_info_page($specials_add->fields['products_id']), 'cPath=' . $productsInCategory[$specials_add->fields['products_id']] . '&products_id=' . (int)$specials_add->fields['products_id']);
					$speice_price = zen_get_products_special_price($specials_add->fields['products_id']);
					$base_price = zen_get_products_base_price($specials_add->fields['products_id']);
					$baifenbi = number_format(($base_price-$speice_price)/$base_price,2)*100;
					
					$str_add .='<li class="'.$activ.'"><p class="off"><em>'.$baifenbi.'</em>%<br>OFF</p>';
					$str_add .='<span class="proikdimg"><a href="'.$add_url.'">'.zen_image(DIR_WS_IMAGES . $specials_add->fields['products_image'], $specials_add->fields['products_name'], 45, 35,'').'</a></span>';
					$str_add .='<span class="proName"><p class="h32"><a href="'.$add_url.'">'.$specials_add->fields['products_name'].'</a></p><p class="f123 c64 l150">MSRP:<em>'.$symbolLeft.'&nbsp;'.$currencies->noSymbolDisplayPrice($base_price,0).'</em></p><p><span class="f123 c0">Today:</span><span class="f14 cc60">'.$symbolLeft.'&nbsp;'.$currencies->noSymbolDisplayPrice($speice_price,0).'</span></p></span></li>';
					$aa_img = explode(",",$specials_add->fields['products_image']);
						?> 
<div class="deal deal8 dailydeal_info" style="<?php echo $add_sty; ?>">
                <div class="deal_info_left product_images">
                    <div class="preview">
                        <div class="jqzoom" id="spec_n<?php echo $i_add; ?>">
                            <img width="348" height="270" src="<?php echo HTTP_SERVER.str_replace("/s/","/l/",'/images/'.$aa_img[0]); ?>" jqimg="<?php echo HTTP_SERVER.str_replace("/s/","/v/",'/images/'.$aa_img[0]); ?>" /></div>
                        <div class="spec_n5">
                            <div class="spec_left">
                            </div>
                            <div class="spec_list" id="spec_list<?php echo $i_add; ?>">
                                <ul>
                         <?php  foreach($aa_img as $imgq){ ?>       
                            <li>
                             <img src="<?php echo HTTP_SERVER.'/images/'.$imgq; ?>" jqimg="<?php echo HTTP_SERVER.str_replace("/s/","/l/",'/images/'.$imgq); ?>" jqimg2="<?php echo HTTP_SERVER.str_replace("/s/","/v/",'/images/'.$imgq); ?>" /></li> <?php }?>
                                </ul>
                                <div class="clear">
                                </div>
                            </div>
                            <div class="spec_right">
                            </div>
                        </div>
                        <!-- 小图预览 end -->
                    </div>
                    <!-- pic end -->
                </div>
                <!--左边产品图片 end-->
                <!--右边产品介绍 begin-->
                <div class="deal_info_right">
                    <h1 class="f14 c2e pl8 pr8 pt5 fb">
                        <a href="<?php echo $add_url; ?>" title="<?php echo $specials_add->fields['products_name']; ?>"><?php echo $specials_add->fields['products_name']; ?></a></h1>
                    <p class="l50 c2e mt15 pl8 mb18 deal_info_sku">
                        SKU: <em class="c2e"><?php echo $specials_add->fields['products_model']; ?></em></p>
                    <!-- 产品价格 begin -->
                    <div class="deal_price fleft">
                        <div class="deal_price_l fleft">
                        </div>
                        <div class="deal_price_m fleft">
                            <div class="fleft">
                                <span class="db f16 c66 mb10 pt25">MSRP:<em class="deal_price_MSRP"><?php echo $symbolLeft.'&nbsp;'.$currencies->noSymbolDisplayPrice(  $base_price,0); ?></em></span>
                                <span class="f20 c00 mt15">Today: <em class="cc20 deal_price_unitprice"><?php echo $symbolLeft.'&nbsp;'.$currencies->noSymbolDisplayPrice($speice_price,0); ?></em></span></div>
                            <div class="fright pt43">
                                <a class="deal_addTocard" title="Newtop Colorful Diamond Patterned Screen Protector for iPad Mini (Transparent)" href="<?php echo zen_href_link(zen_get_info_page($specials_add->fields['products_id']), 'cPath=' . $productsInCategory[$specials_add->fields['products_id']] . '&products_id=' . $specials_add->fields['products_id']) . '?action=buy_now'; ?>" ></a>
								
                            </div>
                        </div>
                        <div class="deal_price_r fleft">
                        </div>
                        <div class="clear">
                        </div>
                        <div class="saveoff_blue f24 cff">
                            <em><?php echo $baifenbi; ?></em>%<br />
                            OFF</div>
                    </div>
                    <div class="clear">
                    </div>
                    <!-- 产品价格 end -->
                    <!-- 说明 end -->
                    <p class="db c00 f14 l150 pl8 hide in_stock">
                        In Stock<em>-Shipping within 24 hours</em></p>
                    
                    <p class="db c2c6 f14 l150 pl8 mb10">
                        Worldwide Free Shipping</p>
                    <div>
                        <span class="review fleft c4747 mt10 pl8">
                            <span class="starr">
                                <?php echo $aa; ?>
                            </span>
                            <span class="f112 c4747">(0 reviews )</span>
                        </span>
                        <span class="diggs fleft c4747 mt10">
                            <a class="digClick" title="Click if you like this product" href="<?php echo zen_href_link(zen_get_info_page($specials_add->fields['products_id']), 'cPath=' . $productsInCategory[$specials_add->fields['products_id']] . '&products_id=' . $specials_add->fields['products_id']) . '?pid='.$_GET ['products_id']; ?>" >
                                <em style="color: #363535; font-weight: bold;">Diggs</em></a>
                            (<em class="dignum" style="color: #c60000;">0</em> customers like this)
                        </span>
                    </div>
                    <!-- 说明 end -->
                </div>
                <!--右边产品介绍 begin-->
                <div class="clear">
                </div>
            </div>
     <?php 
	     $i_add++;
			$specials_add->MoveNext(); }
			 }?>       
</div>
        <!--left end-->
        <!--rightlist begin-->
        <div class="rightlist">
            <ul id="daily_deals">
                <?php echo $str_add; ?>
            </ul>
        </div>
        <br class="clear">
        </div>
        <!--rightlist end-->
        <!--DoneDeals begin-->
        <div id="done_deals">
            <div class="done_title">
                Done Deals</div>
            <!--产品列表 begin-->
            <div class="items111025">
            
            
           <?php $specials_expires = "select p.products_id, p.products_image,s.specials_new_products_price
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = s.products_id and expires_date !='0001-01-01'
                           and p.products_id = pd.products_id
                           and p.products_status = '1' and s.status = 0
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
					$specials_index = $db->Execute($specials_expires);	   
					if ($specials_index->RecordCount() > 0) {
						while (!$specials_index->EOF) {
							$speice_price = $specials_index->fields['specials_new_products_price'];
							$base_price = zen_get_products_base_price($specials_index->fields['products_id']);
							
						   ?> 
               <div class="itembox1 m34">
                    <ul class="infobox1">
                        <li class="doneoff">
                        </li>
                        <li class="roImg">
                            <a href="<?php echo zen_href_link(zen_get_info_page($specials_index->fields['products_id']), 'cPath=' . $productsInCategory[$specials_index->fields['products_id']] . '&products_id=' . (int)$specials_index->fields['products_id']); ?>" title="<?php echo zen_get_products_name($specials_index->fields['products_id']); ?>">
                                <span class="doneSale"></span>
                               <?php echo str_replace("/s/","/l/",zen_image(DIR_WS_IMAGES . $specials_index->fields['products_image'], zen_get_products_name($specials_index->fields['products_id']), 200, 155,'')); ?></a>
                        </li>
                        <li class="proPri f14 c78 fb">
                            Sale：<span class="proPri_Was"><?php echo $symbolLeft.'&nbsp;'.$currencies->noSymbolDisplayPrice($speice_price,0); ?></span></li>
                        <li class="proPri c165 fb f14">
                            Now：<span class="proPri_Now"><?php echo $symbolLeft.'&nbsp;'.$currencies->noSymbolDisplayPrice($base_price,0); ?></span></li>
                    </ul>
                </div>
                     <?php 
						$specials_index->MoveNext(); }
					 }?>
                <div class="clear">
                </div>
            </div>
            <!--DoneDeals end-->
        </div>
        <!--底部广告 begin-->
        <div class="dailyabs2">
            <div class="dailyabs2_l mr15">
              <img width="320" height="146" border="0" class="img_ad" alt="" src="http://static.googleadsserving.cn/pagead/imgad?id=CICAgICQ3srpmQEQhgMYkgEyCPOruhtqGRpY">

            </div>
            <div class="dailyabs2_l mr15">
                <img width="320" height="146" border="0" class="img_ad" alt="" src="http://static.googleadsserving.cn/pagead/imgad?id=CICAgICQ3srVSxCGAxiSATIIJXI4r3-1nl8">

            </div>
            <div class="dailyabs2_l">
                <img width="320" height="146" border="0" class="img_ad" alt="" src="http://static.googleadsserving.cn/pagead/imgad?id=CICAgICQ3srWchCGAxiSATIIwusOUBSlZ3o">

            </div>
            <div class="clear">
            </div>
        </div>
        <!--底部广告 end-->
    </div>
    <script type="text/javascript" src="js/deals_lib.js"></script>
    
    <script type="text/javascript">
        (function ($) {
            // 改变默认配置
            var d = $.dialog.defaults;
            // 预缓存皮肤，数组第一个为默认皮肤
            d.skin = ['default', 'chrome', 'facebook', 'aero'];
            d.plus = true;
        })(art);
        $(function () {
            $("#daily_deals li:first").addClass("active");
            $("#daily_deals li").hover(function () {
                $(this).addClass("active").siblings().removeClass("active");
                $("#deals_main > .deal").eq($("#daily_deals li").index(this)).show().siblings().hide();
            });
            $(".jqzoom").jqueryzoom({
                xzoom: 411, /*定义放大的窗口*/
                yzoom: 318,
                offset: 10,
                position: "right",
                preload: 1,
                lens: 1
            });
			
			var dailyProNum = $(".dailydeal_info").size();
			for(var i=1; i<=dailyProNum; i++){
				var ListDom = "spec_list"+i;
				$("#"+ListDom).jdMarquee({
					deriction: "left",
					width: 348,
					height: 39,
					step: 2,
					speed: 4,
					delay: 10,
					control: true,
					_front: ".spec_right",
					_back: ".spec_left"
				});
			
				$("#"+ListDom+" "+"img").bind("mouseover", function () {
						var idNum =  $(this).parents(".product_images").find(".jqzoom").attr("id");
						var src = $(this).attr("src");
						var jqimg = $(this).attr("jqimg");
						var jqimg2 = $(this).attr("jqimg2");
						$("#"+idNum+" "+"img").eq(0).attr({
							src: jqimg.replace("\/n5\/", "\/n1\/"),
							jqimg: jqimg2.replace("\/n5\/", "\/n0\/")
						});  
						$(this).css({
							"border": "1px solid #ff6600",
							"padding": "0px"
						});
				}).bind("mouseout", function () {
					$(this).css({
						"border": "1px solid #d5d6db",
						"padding": "0px"
					});
				});
				}
				
			$(".dailydeal_info").eq(0).show().siblings().hide();	
            $.getJSON('http://promotion.focalprice.com/promotionservices/QueryDateTimeJSonP?jsoncallback=?', function (data) {
                var nowTime = data.Date;
                nowTime = nowTime.replace("-", "/").replace("-", "/"),
							nowTime = new Date(nowTime);
                var year = nowTime.getFullYear(),
							month = nowTime.getMonth() + 1,
							day = nowTime.getDate(),
							endTime = year + "/" + month + "/" + day + " " + "23:59:59",

							endTime = new Date(endTime);
                var leftsecond = parseInt(endTime.getTime() - nowTime.getTime());
                new leftTime('', '', '', '', document.getElementById('dailyTime'), leftsecond, function () { });
            });
        });
        function digClick(sku,obj) {
            library.digg.add(sku,function(){
                var dignum = $(obj).next();
                $(dignum).text(parseInt($(dignum).text()) + 1);
                var succss="<div class=\"add_to_cardTips h100\">"
				    +"<p class=\"f18 c00 lh35\">" + focalPriceTip.dig[0].dig_sucess + "</p>"
                    +"<p class=\"pt20 f11 alignR\">" + focalPriceTip.common[0].CloseDivTips + "</p></div>";
                library.dialog.showDialog("",succss,obj);
            },function(){
                var failed="<div class=\"add_to_cardTips h100\">"
				    +"<p class=\"f18 c00 lh35\">" + focalPriceTip.dig[0].diged + "</p>"
                    +"<p class=\"pt20 f11 alignR\">" + focalPriceTip.common[0].CloseDivTips + "</p></div>";
                library.dialog.showDialog("",failed,obj);
            });
        }
    </script>