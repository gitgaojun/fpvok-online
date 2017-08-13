 <?php if ($_GET['main_page'] != 'shipping_estimator'&& $_GET['main_page'] != 'faqs_submit') { ?>
 <div id="topmenuWrapp">
        <div class="topmenuIner">
            <div class="mauto" id="topmenu">
                <ul class="topmenu_l fleft">
                    
                    <?php if (isset($_SESSION['customer_id'])){ ?>
	                    <li class="fleft pr10" id="after_sign">
						
                        <em class="db fleft mr5"></em><a class="username db fleft mr10" id="nickName" href="/account.html"><?php echo zen_get_customer_name($_SESSION['customer_id']); ?></a>
                      
					    <a class="cf50 db fleft" href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL');?>">Sign out</a></li>
                   <?php }else{?>
                        <li class="fleft siginin" id="sign_area">
						
						<div class="Sign"><div class="username fr mr20 ml10"><a href="/login.html">Sign in</a></div></div>
					
                        <div class="Register"><div class="username fr mr20 ml10"><a  href="login.html">Register</a></div></div>
                    </li>
                     <?php }?>            

                    
                </ul>
				
                <ul class="topmenu_r fright">
				
				
				
                    <li class="fright f11 help">
                        <a href="/faqs_all.html">Help</a></li>
						<li class="fright f11">|</li>
						<li id="currency" class="fright currency">
                        <a title="US$" href="javascript:void(0);" class="selMenu" id="currentCurrency">Currency <em><?php echo $currencies->display_symbol_left($_SESSION['currency']);?></em></a>
                        <span></span>
                        <div class="currency_menu down_men" style="display: none">
						
           <?php
					reset($currencies->currencies);
					while (list($key, $value) = each($currencies->currencies)) { 
					
					?>        
                 <a target="_top" title="<?php echo $value['symbol_left'] ?>" rel="nofollow" href="
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
			 ?>"><?php echo zen_image($template->get_template_dir($key.'.gif', DIR_WS_TEMPLATE, $current_page_base,'images/icons/flag'). '/'.$key.'.gif',$key,'','',' border="0" style="margin-right:10px;"');?><?php echo $value['title'] ?></a>
           <?php   } ?>
                        </div>
                    </li>
                    <li class="fright f11">|</li>
                    <li class="fright f11"> <a href="/index.php?main_page=un_wishlist"class="ennu">Wish List</a></li>

                    

                </ul>
			
            </div>
        </div>
    </div>
  <?php }?>

<!-- eof: featured products  -->