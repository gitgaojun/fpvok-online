<?php
  // Display all header alerts via messageStack:
  if ($messageStack->size('header') > 0) {
    echo $messageStack->output('header');
  }
  if (isset($_GET['error_message']) && zen_not_null($_GET['error_message'])) {
  echo htmlspecialchars(urldecode($_GET['error_message']));
  }
  if (isset($_GET['info_message']) && zen_not_null($_GET['info_message'])) {
   echo htmlspecialchars($_GET['info_message']);
} else {

}
?>


<!--bof-header logo and navigation display-->
<?php
if (!isset($flag_disable_header) || !$flag_disable_header) {
	switch ($current_page){
		 case 'address_book_process':
		 	echo '<div id="headerblock2">';		
		  break;	
		default:
			echo '<div id="headerblock">';		
			
	}
?>

<div style="display:none;" id="chat_div">
	<div class="g_t_c">

		<!-- BOF Chat Live -->
<a target="_blank" href="http://messenger.providesupport.com/messenger/jiaho.html"><img width="185" height="45" class="margin_t" alt="" src="includes/templates/slucky/images/lp.gif"></a>
<!-- EOF Chat Live --> </div>
	<div id="chat_div_name" class="pad_l_28px margin_t g_t_l"><ul class="gray_trangle_list"/></div>
	<img width="13" height="13" border="0" onclick="close_chat_div()" src="<?php echo HTTP_SERVER.DIR_WS_CATALOG;?>images/root/close.gif" title="close" alt="close" id="chat_div_close_img"/>
	</div>
	

<?php if($current_page != 'checkout_shipping') {?>
<div id="logoWrapper">
    <?php switch ($current_page){
			    	case 'checkout_shipping':
			    	case 'checkout_payment':		    	
			    	case 'address_book_process':
    	      ?>
    	      <div class="ck_w center">
				    
				    <?php if($this_is_home_page){?>
					<ul id="intro">
					    <li class="index_logo"><?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '" title="Welcome to www.fpvok.com">' . zen_image($template->get_template_dir(HEADER_LOGO_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . HEADER_LOGO_IMAGE, HEADER_ALT_TEXT) . '</a>'; ?></li> </ul>
				    <?php }else{ ?>
					<ul id="intro2">
					    <li class="logo"><?php echo '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">' . zen_image($template->get_template_dir(HEADER_LOGO_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . HEADER_LOGO_IMAGE, HEADER_ALT_TEXT) . '</a>'; ?></li></ul>
				    <?php } ?>

            </div>
		<?php break;
		      default:
		      
		      ?>
			    
			    <?php if($this_is_home_page){?>
				<div>
				<ul id="intro">
				    <li class="index_logo big black"><?php echo '<span class="hand"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . '" title="Welcome to www.fpvok.com">' . zen_image($template->get_template_dir(HEADER_LOGO_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . HEADER_LOGO_IMAGE, 'Welcome to www.fpvok.com') . '</a></span>'; ?></li></ul>
			    <?php }else{ ?>
				<ul id="intro">
				    <li class="logo big black"><?php echo '<span class="hand"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">' . zen_image($template->get_template_dir(HEADER_LOGO_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . HEADER_LOGO_IMAGE, 'Welcome to www.fpvok.com') . '</a></span>'; ?></li></ul>
					
			    <?php } ?>
			    
		<?php } ?>
<!--eof-branding display-->

<!--eof-header logo and navigation display-->
<?php
//set Popular Searches title
$popular_searches_title = $this_is_home_page?'Popular Searches:':'Related Searches:';
//addPage
?>
<?php if ($_GET['main_page'] !='checkout_shipping') { ?>
      <!--bof-navigation display-->
      <?php //require(DIR_WS_MODULES . 'sideboxes/search_header.php'); ?>
      <!--eof-navigation display-->
      <?php } }?>
      <?php if ($_GET['main_page'] != 'shipping_estimator'&& $_GET['main_page'] != 'faqs_submit'&& $_GET['main_page'] != 'checkout_shipping') { ?>
      
		<div class="search-bar">
        
<?php 
 $categories_array[] = array('id' => '', 'text' =>'All Categories'); 


  $content = zen_draw_form('quick_find_header', zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get','id = "quick_find_header"');
  $content .= zen_draw_hidden_field('main_page',FILENAME_ADVANCED_SEARCH_RESULT);
  $content .= zen_draw_hidden_field('inc_subcat', '1', 'style="display: none"'); 
  $content .= zen_draw_hidden_field('search_in_description', '1') . zen_hide_session_id();
  echo $content;
  
$se_name = intval($_GET['cagegories_id'])>0 ? zen_get_category_name(intval($_GET['cagegories_id']),$_SESSION['languages_id']) : 'All Categories';
?>
                    <div class="search-bar-autocomplete">
            <input type="text" name="keyword" class="search-bar-keyword" id="keyword" value="Search" onfocus="if (this.value == 'Search') this.value = '';" onblur="if (this.value == '') this.value = 'Search';" autocomplete="off">
                    </div>
         <div class="search-select-box" id="catalogBox">
            <input type="text" readonly="true" value="<?php echo $se_name ?>" id="catalog">
            <input type="hidden" value="<?php echo intval($_GET['cagegories_id']) ?>" name="cagegories_id" id="catalogId">
            <div class="drop-down-default" id="arrow"></div>
            <div class="search-category" id="catalogListBox"></div>
             </div>
            <input type="submit" name="button" value="" class="search-bar-button" id="searchBarButton">
            </form>
		
				<div class="hotkeyword"><h6></h6></div>
            </div>  
            <div class="fr">
            
        <?php if ($_GET['main_page'] != 'shipping_estimator'&& $_GET['main_page'] != 'faqs_submit') { ?>
    <script type="text/javascript" src="images/library.js"></script>
    <script type="text/javascript" src="images/common-min.js"></script>
       
            <div class="mauto account ">
               
                    <li class="fright account f11">
                        <a href="/account.html" id="selMen" class="selMenu">My FPVOK Account<img width="12" height="5"src="includes/templates/slucky/images/bg_arrow.gif"></a>
                      
                        <div style="display: none" class="account_menu down_men">
                            <a href="<?php echo zen_href_link(FILENAME_ACCOUNT,'','SSL')?>">My Orders</a> 
							<a href="<?php echo zen_href_link(FILENAME_ACCOUNT_EDIT,'','SSL')?>">My Profile</a>
							<a href="<?php echo zen_href_link(FILENAME_MANAGER_ADDRESS,'','SSL')?>">My Address</a>
                  
                        </div>
                    </li>

            </div>
    
  <?php }?>
	   <div class="car">
                <a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL'); ?>" id="head_checkout" style="color:#ffffff;">
				<span id="headerCartItemCount"><?php echo $_SESSION['cart']->count_contents()>0?$_SESSION['cart']->count_contents():0; ?></span> item(s)</a>
            </div>
        </div>
       

      
          </div>
       <?php }?>
</div>

 <?php
}
if(!$this_is_home_page and ($current_page != 'print_page') and ($current_page != 'address_book_process') and ($current_page != 'checkout_payment_address') and ($current_page != 'checkout_payment') and ($current_page != 'checkout_confirmation') and $current_page != 'faqs_submit' and $current_page != 'shipping_estimator' and (!isset($_GET['c']) and $_GET['c'] == '')){
?>
<?php if($current_page != 'checkout_shipping') {?>
<div id="navblock">
		 <div style="float: left;clear:both;">
		
       <?php require(DIR_WS_MODULES . 'sideboxes/' . $template_dir . '/dropdown_categories_css.php'); ?>
	   </div>
  <div>

    <!--bof-header ezpage links-->
    <?php if (EZPAGES_STATUS_HEADER == '1' or (EZPAGES_STATUS_HEADER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
    <!--bof-navigation display-->
    <DIV class=menu_c><?php require($template->get_template_dir('tpl_ezpages_bar_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_ezpages_bar_header.php'); ?>
	
	</DIV>
    <!--eof-navigation display-->
	  <br class="clear">
  </div>
  <?php
		if (isset($current_category_id) and $current_category_id != ''){
			if (SHOW_BANNERS_GROUP_SET2 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET2)) {
				if ($banner->RecordCount() > 0) {
		?>
			<div id="bannerThree" class="banners"><?php echo zen_display_banner('static', $banner); ?></div>
			<?php
				}
			}
		}
	?>
</div>
<?php }?>
<div style="width: 100%;"> <?php $banner=zen_banner_exists('static', 17); if ($banner->RecordCount() > 0) {echo zen_display_banner('static',17);} ?></div>
  <!-- bof  breadcrumb -->
  <?php
  if ($current_page == 'super_savings'){
  	//Do anything
  }else{
		 if (DEFINE_BREADCRUMB_STATUS == '1' || (DEFINE_BREADCRUMB_STATUS == '2' && !$this_is_home_page) ) { ?>
      <div id="navblock">
      <div class="product_title margin_t"><?php echo $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); ?>
	  </div>
	  </div>
  		<?php }
  }
	?>
  <!-- eof breadcrumb -->
<?php		
  }
?>
<?php /*======================================================================================*/?>
<?php } ?>
<script type="text/javascript">
function showLocale(objD)
{
	var str,colorhead,colorfoot;
	var yy = objD.getYear();
	if(yy<1900) yy = yy+1900;
	var MM = objD.getMonth()+1;
	if(MM<10) MM = '0' + MM;
	var dd = objD.getDate();
	if(dd<10) dd = '0' + dd;
	var hh = objD.getHours();
	if(hh<10) hh = '0' + hh;
	var mm = objD.getMinutes();
	if(mm<10) mm = '0' + mm;
	var ss = objD.getSeconds();
	if(ss<10) ss = '0' + ss;
	var ww = objD.getDay();
	if  ( ww==0 )  colorhead="<font color=\"#FF0000\">";
	if  ( ww > 0 && ww < 6 )  colorhead="<font color=\"#373737\">";
	if  ( ww==6 )  colorhead="<font color=\"#008000\">";
	if  (ww==0)  ww="SUN";
	if  (ww==1)  ww="MON";
	if  (ww==2)  ww="TUE";
	if  (ww==3)  ww="WED";
	if  (ww==4)  ww="THU";
	if  (ww==5)  ww="FRI";
	if  (ww==6)  ww="SAT";
	colorfoot="</font>"
	str = colorhead + MM + "/" + dd + ' '+ww + ' '+hh + ":" + mm + colorfoot;
	return(str);
}
function tick()
{
	var today;
	today = new Date();
	document.getElementById("localtime").innerHTML = showLocale(today);
	window.setTimeout("tick()", 1000);
}
tick();
</script>