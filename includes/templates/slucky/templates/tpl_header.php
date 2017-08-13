<style type="text/css">
/*年龄select1*/
#age_sel_1 div.tag_select{display:block;color:#000;width:174px;height:29px;background:transparent url("images/select-60.gif") no-repeat 0 0;padding:0 10px;line-height:29px;}
#age_sel_1 div.tag_select_hover{display:block;color:#000;width:174px;height:29px;background:transparent url("images/select-60.gif") no-repeat 0 -29px;padding:0 10px;line-height:29px;}
#age_sel_1 div.tag_select_open{display:block;color:#000;width:174px;height:29px;background:transparent url("images/select-60.gif") no-repeat 0 -0px;padding:0 10px;line-height:29px;}
#age_sel_1 ul.tag_options{position:absolute;margin:0;list-style:none;padding:0 0 1px;margin:0;width:172px; border:1px solid #B4B4B4; border-top:none; background-color:#FFF;}
#age_sel_1 ul.tag_options li{display:block;width:152px;padding:0 10px;height:29px;text-decoration:none;line-height:29px;color:#000;border-bottom:1px dotted #B4B4B4;}
#age_sel_1 ul.tag_options li.open_hover{color:#000;}
#age_sel_1 ul.tag_options li.open_selected{color:#19555F;}
/*年龄select1--end*/
</style>

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
		 case 'checkout_login':
		 
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
    <?php switch ($current_page){
			    	case 'checkout_shipping':
			    	case 'checkout_payment':
			    	case 'checkout_login':
			    	
			    	case 'address_book_process':
    	      ?>
    <div class="big black" style="position: absolute; top: 44px; left: 320px; font-size:11px;">
		
	</div>
		<?php break;
		      default:
		      ?>
     <div style="position:absolute;">
  <!--  <div class="big black" style="position: absolute; top: 28px; width:140px; left: 208px; font-size: 12px; font-family:Georgia, Times New Roman,Times,serif; font-style: italic;">
		<?php //echo STORE_SLOGAN; ?>
	</div>-->
    </div>
<?php }?>

<div id="logoWrapper">
    <?php switch ($current_page){
			    	case 'checkout_shipping':
			    	case 'checkout_payment':
			    	case 'checkout_login':
			    	
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
				<div style="width:952px;">
				<ul id="intro">
				    <li class="index_logo big black"><?php echo '<span class="hand"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . '" title="Welcome to www.fpvok.com">' . zen_image($template->get_template_dir(HEADER_LOGO_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . HEADER_LOGO_IMAGE, 'Welcome to www.fpvok.com') . '</a></span>'; ?></li></ul>
			    <?php }else{ ?>
				<ul id="intro">
				    <li class="logo big black"><?php echo '<span class="hand"><a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">' . zen_image($template->get_template_dir(HEADER_LOGO_IMAGE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . HEADER_LOGO_IMAGE, 'Welcome to www.fpvok.com') . '</a></span>'; ?></li></ul>
					
			    <?php } ?>
			    
		<?php } ?>

      <div id="menuwrap">

		</DIV>
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
      <?php if ($_GET['main_page'] !='checkout_shipping' && $_GET['main_page'] != 'shipping_estimator'&& $_GET['main_page'] != 'faqs_submit') { ?>
		<div class="search-bar">
        
<?php 
 $categories_array[] = array('id' => '', 'text' =>'All Categories'); 
                                $categories_query = "select c.categories_id, cd.categories_name, c.categories_status from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd  where c.categories_status='1' and parent_id = '0' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$_SESSION['languages_id'] . "' order by sort_order, cd.categories_name"; 
                                $categories = $db->Execute($categories_query); 
                                while (!$categories->EOF) {
	                                $categories_array[] = array('id' => $categories->fields['categories_id'], 'text' =>$categories->fields['categories_name']); $categories->MoveNext();
	                              }
  $content = zen_draw_form('quick_find_header', zen_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get','id = "quick_find_header"');
  $content .= zen_draw_hidden_field('main_page',FILENAME_ADVANCED_SEARCH_RESULT);
  $content .= zen_draw_hidden_field('inc_subcat', '1', 'style="display: none"'); 
  $content .= zen_draw_hidden_field('search_in_description', '1') . zen_hide_session_id();
  echo $content;
?>
                    <div class="search-bar-autocomplete">
                        <input type="text" name="keyword" class="search-bar-keyword" id="keyword" value="Enter search keywords here" onfocus="if (this.value == 'Enter search keywords here') this.value = '';" onblur="if (this.value == '') this.value = 'Enter search keywords here';" autocomplete="off">
                    </div>
                    <div id="age_sel_1" class="search-select-box">
                        <?php echo zen_draw_pull_down_menu('categories_id', $categories_array,'','class="select" id="light_select"'); ?>
                    </div>
                    <input type="button" name="button" value="" class="search-bar-button" id="searchBarButton">
                     <a rel="nofollow" href="<?php echo zen_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL'); ?>" class="search-bar-cart" id="cartcnt" style="color: #0033BC;">Cart <span style="color:#FF8000;"><?php echo $_SESSION['cart']->count_contents()>0?$_SESSION['cart']->count_contents():0; ?></span> item(s)</a>
                </form>
            </div>  
       
        </div>
       <?php }?>
</div>

<?php /*===================================================================*/?>


 <?php
//addPage
if(!$this_is_home_page and ($current_page != 'print_page') and ($current_page != 'address_book_process') and ($current_page != 'checkout_payment_address') and ($current_page != 'checkout_shipping') and ($current_page != 'checkout_payment') and ($current_page != 'checkout_confirmation') and $current_page != 'faqs_submit' and $current_page != 'shipping_estimator' and (!isset($_GET['c']) and $_GET['c'] == '')){
?>

<div id="navblock">
		 <div style="float: left; width:184px;">
		
       <?php require(DIR_WS_MODULES . 'sideboxes/' . $template_dir . '/dropdown_categories_css.php'); ?>
	   </div>
  <div>

    <!--bof-header ezpage links-->
    <?php if (EZPAGES_STATUS_HEADER == '1' or (EZPAGES_STATUS_HEADER == '2' and (strstr(EXCLUDE_ADMIN_IP_FOR_MAINTENANCE, $_SERVER['REMOTE_ADDR'])))) { ?>
    <!--bof-navigation display-->
    <DIV class=menu_c><?php require($template->get_template_dir('tpl_ezpages_bar_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_ezpages_bar_header.php'); ?></DIV>
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
<div style="width: 100%;"> <?php $banner=zen_banner_exists('static', 17); if ($banner->RecordCount() > 0) {echo zen_display_banner('static',17);} ?></div>
  <!-- bof  breadcrumb -->
  <?php
  if ($current_page == 'super_savings'){
  	//Do anything
  }else{
		 if (DEFINE_BREADCRUMB_STATUS == '1' || (DEFINE_BREADCRUMB_STATUS == '2' && !$this_is_home_page) ) { ?>
      <div style="width: 100%;" id="navblock">