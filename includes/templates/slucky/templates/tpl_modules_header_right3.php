 <?php if ($_GET['main_page'] != 'shipping_estimator'&& $_GET['main_page'] != 'faqs_submit') { ?><div class="mswe">

<div class="DD_beta">

<div class="beta_header" id="all_beta_header">

<div class="bt_top grayLink">

        <div class="bt_top02">

            <table border="0" cellpadding="0" cellspacing="0">

                <tbody>

                <tr>

                <td width="60"><span class="bt_top01_now"><img src="includes/templates/slucky/images/1.png" border="0" align="absmiddle" /><a href="/" rel="nofollow" title="Online Shopping" alt="Online Shopping">Home</a> |</span></td>

             <td class="txtRight" style="font-weight: bold;">Currency :&nbsp;</td>  <td width="70">

                        <div class="bt_pop" id="curPopup" onmouseout="closecurdiv();" onmouseover="showthiscur();"  style="padding-right: 0pt;">

                            <table border="0" cellpadding="0" cellspacing="0">

                                <tbody>

                                    <tr>

                                        <td colspan="2" width="50"><img width="16" height="11" border="0" class="g_t_m" title=" USD " alt="USD" src="includes/templates/slucky/images/icons/flag/<?php echo $_SESSION['currency']; ?>.gif">

                                         <?php echo $currencies->display_symbol_left($_SESSION['currency']);?>    

                                        </td>

                                        <td><a href="javascript:void(0)" id="imgshow" onclick="showCurrencyNew(1);"><span class="sprite s_beata_20"> </span></a></td>

                                    </tr>

                                </tbody>

                            </table>

                        </div>

                        <div class="top_tc">

                            <div class="bt_popup_p3" onmouseover="showthiscur();" onmouseout="closecurdiv();" id="currencyshow" style="display:none;">

                                <ul>

                              <?php

					reset($currencies->currencies);

					while (list($key, $value) = each($currencies->currencies)) { 

					if($key != $_SESSION['currency']){	?>      

                                    

                                    	<li><div class="topdyy"><?php echo zen_image($template->get_template_dir($key.'.gif', DIR_WS_TEMPLATE, $current_page_base,'images/icons/flag'). '/'.$key.'.gif',$key,'','',' border="0" class="g_t_m"');?><a target="_top" title="<?php echo $value['title'] ?>" rel="nofollow" href="

			<?php

				$newurlString='';

				$urlString=$_SERVER['REQUEST_URI'];

				if (strpos($urlString,'?') != false ){

					if ($_GET['currency'] != false ) {

						$newurlString=str_replace($_GET['currency'],$key,$urlString);

					}

					else {

						$newurlString= $urlString . '&currency=' . $key;

					}

				}

				else {

					$newurlString= $urlString . '?currency=' . $key;

				}

				echo $newurlString;

				

			 

			 ?>">

			 

			 <?php echo $value['title'] ?></a></div>



                                        </li>

                                <?php }}?>                                                 

                                </ul>

                                <div class="autoHeight"> </div>

                            </div>

                        </div>

                    </td>

                    <td align="left" class="txtRight"><span class="bt_top_pd"></span></td>

                    <td width="250">

                          

                        <div class="bt_pop" id="lanPopup" onmouseover="showthiscur();">

                            <table border="0" cellpadding="0" cellspacing="0"  width="248">
   
                             <tbody>

                                    <tr>

                                    <td width="55"><div class="topdyy"><a href="/"></a></div></td>

                                    <td width="55"><div class="topdyy"><a href="http://translate.google.com.hk/translate?hl=zh-CN&sl=en&tl=de&u=http%3A%2F%2Fwww.fpvok.com%2F" target="_blank"></a></div></td>

									<td width="55"><div class="topdyy"><a href="http://translate.google.com.hk/translate?hl=zh-CN&sl=en&tl=fr&u=http%3A%2F%2Fwww.fpvok.com%2F" target="_blank"></a></div></td>

									<td width="78"><div class="topdyy"><a href="http://translate.google.com.hk/translate?hl=zh-CN&sl=en&tl=nl&u=http%3A%2F%2Fwww.fpvok.com%2F" target="_blank"></a></div></td>

								

                                    </tr>

                                </tbody>

                          </table>

                        </div>

                        

                    </td>

					<td width="15" style="font-size: 12px; text-align: center;"></td>

					

                    <td>

            <table border="0" cellpadding="0" cellspacing="0" width="410">

                <tbody>

                <tr>

                    <td class="txtRight" width="150" style="text-align: center;"> 

                        <span id="headWelcome"><span class="bt_top01_now">

                         <?php if (isset($_SESSION['customer_id'])){ ?><a  rel="nofollow" target="_top" href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL');?>" title="Sign in"><?php echo zen_get_customer_name($_SESSION['customer_id']); ?></a>&nbsp;or&nbsp; <a  rel="nofollow" target="_top" href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL');?>" title="Register"> Logout </a></span><?php }else{ ?><a  rel="nofollow" target="_top" href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL');?>" title="Sign in">Sign in</a>&nbsp;or&nbsp;<span class="bt_top01_now"><a  rel="nofollow" target="_top" href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL');?>" title="Sign in">Register</a><?php }?></span>&nbsp;</span>

                        <span id="logout"></span>

                  </td>

				  <td width="15" style="font-size: 12px; text-align: center;">|</td>

                    <td width="75">

                    	<div class="bt_pop bt_popup_long" id="accPopup" onclick="showthiscur();" style="width: 80px; padding: 6px 0 6px 5px;">

                            <table border="0" cellpadding="0" cellspacing="0">

                                <tbody>

                                <tr>

                                    <td style="font-size: 12px;"> <a target="_top" class="one outer" rel="nofollow" href="<?php echo zen_href_link(FILENAME_ACCOUNT,'','SSL')?>">My Account</a> </td>

                                    <td><a href="javascript:void(0)" id="A_MyAccount" onmouseover="OpenMyAccountNew('1');"><span class="sprite s_beata_20"></span></a></td>

                                </tr>

                                </tbody>

                            </table>

                        </div>

                        <div class="top_tc">

                            <div class="bt_popup_p3 ie6_tc" id="div_MyAccount" onmouseover="showthiscur();" onmouseout="closecurdiv();" style="display:none;">

                                <ul id="div_MyAccount6">

                                	<li><a target="_top" title="Account Settings" rel="nofollow" href="<?php echo zen_href_link(FILENAME_ACCOUNT_EDIT,'','SSL')?>"><div class="sprite s_func_9"></div><div class="topdyy">Account Settings</div></a>

                                    </li>

                                  	<li><a target="_top" title="Manage Address Book" rel="nofollow" href="<?php echo zen_href_link(FILENAME_MANAGER_ADDRESS,'','SSL')?>"><div class="sprite s_func_2"></div><div class="topdyy">Address Book</div></a>

                                    </li>

                                  	<li><a target="_top" title="Order List" rel="nofollow" href="<?php echo zen_href_link(FILENAME_ACCOUNT,'','SSL')?>"><div class="sprite s_func_1"></div><div class="topdyy">Order List</div></a>

                                    </li>

                                  	<li><a rel="nofollow" title="Wish List" href="/index.php?main_page=un_wishlist"><div class="sprite s_func_5"></div><div class="topdyy">My Wish List</div></a>

                                    </li>

                                </ul>

                                <div class="autoHeight"> </div>

                        	</div>

                        </div>

                  </td><td width="8" align="left" style="font-size: 12px; text-align: center;"><div align="left">|</div></td>

                    <td width="43">

                    	<div class="bt_pop bt_popup_long" id="accPopup2" onclick="showthiscur();" style="width: 43px;">

                      		<table border="0" cellpadding="0" cellspacing="0">

                                <tbody><tr>

                                  <td style="font-size: 12px;"><a rel="nofollow" title="Help" href="#" onclick="window.location.href='/faq.html'">Help</a></td>

                                  <td><a href="javascript:void(0)" id="A_Community" onmouseover="OpenCommunityNew('1');"><span class="sprite s_beata_20"></span></a></td>

                                </tr>

                      		</tbody></table>

                        </div>

                        <div class="top_tc">

                        	<div class="bt_popup_p3 ie6_tc" id="div_MyCommunity" onmouseover="showthiscur();" onmouseout="closecurdiv();" style="display:none; width:110px;">

                                <ul>

                                  <li>

                                  	<div class="topdyy"><img src="includes/templates/slucky/images/1.png" border="0" align="absmiddle" /><a href="/faq.html" target="_self" title="My Homepage" rel="nofollow">Help Centre</a></div>

                                  </li>

                                  <li>

                                  	<div class="topdyy"><img src="includes/templates/slucky/images/2.png" border="0" align="absmiddle" /><a target="_top" rel="nofollow" href="#">Video</a></div>

                                  </li>

                                  <li>

                                  	<div class="topdyy"><img src="includes/templates/slucky/images/3.png" border="0" align="absmiddle" /><a target="_top" rel="nofollow" href="/contact_us.html">Contact Us</a></div>

                                  </li>

                                  

                                </ul>

                                <div class="autoHeight"></div>

                            </div>

                        </div>

                  </td><td width="3" style="font-size: 12px; text-align: center;">|</td>

                    <td width="70" style="font-size: 12px; text-align: center; padding-left:5px"><img src="includes/templates/slucky/images/33.png" border="0" align="absmiddle" /><a title="Help" href="/contact_us.html" rel="nofollow" target="_self"> Message</a></td>

                </tr>

                </tbody>

          </table>

        </td>

					

                </tr>

                </tbody>

            </table>

        </div> 

         

<div class="autoHeight"></div>

</div>

</div>

</div>

</div> <?php }?>

<!-- eof: featured products  -->