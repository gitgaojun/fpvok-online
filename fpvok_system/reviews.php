<?php
/**
 * @package admin
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: reviews.php 4737 2006-10-13 07:13:11Z drbyte $
 */

  require('includes/application_top.php');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  $status_filter = (isset($_GET['status']) ? $_GET['status'] : '');
  $status_list[] = array('id' => 1, 'text' => TEXT_PENDING_APPROVAL);
  $status_list[] = array('id' => 2, 'text' => TEXT_APPROVED);

  if (zen_not_null($action)) {
    switch ($action) {
      case 'setflag':
        zen_set_reviews_status($_GET['id'], $_GET['flag']);

        zen_redirect(zen_href_link(FILENAME_REVIEWS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'rID=' . $_GET['id'], 'NONSSL'));
        break;
      case 'featured':
        zen_set_reviews_featured($_GET['id'], $_GET['flag']);
        zen_redirect(zen_href_link(FILENAME_REVIEWS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'rID=' . $_GET['id'], 'NONSSL'));
      	break;
      case 'update':
        $reviews_id = zen_db_prepare_input($_GET['rID']);
		$reviews_date_added = zen_db_prepare_input($_POST['reviews_date_added']);
        $reviews_rating = zen_db_prepare_input($_POST['reviews_rating']);
        $reviews_text = zen_db_prepare_input($_POST['reviews_text']);
		$reviews_admin = zen_db_prepare_input($_POST['reviews_admin']);

        $db->Execute("update " . TABLE_REVIEWS . "
                      set reviews_rating = '" . zen_db_input($reviews_rating) . "',date_added = '" . zen_db_input($reviews_date_added) . "',
                      last_modified = now() where reviews_id = '" . (int)$reviews_id . "'");

        $db->Execute("update " . TABLE_REVIEWS_DESCRIPTION . "
                      set reviews_text = '" . zen_db_input($reviews_text) . "',reviews_admin = '" . zen_db_input($reviews_admin) . "' 
                      where reviews_id = '" . (int)$reviews_id . "'");

        zen_redirect(zen_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $reviews_id));
        break;
      case 'deleteconfirm':
        // demo active test
        if (zen_admin_demo()) {
          $_GET['action']= '';
          $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
          zen_redirect(zen_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page']));
        }
        if (isset($_POST['rID']) && is_array($_POST['rID']) && count($_POST['rID']) > 0)
			{
				foreach ($_POST['rID'] as $getRid)
				{
					$db->Execute("delete from " . TABLE_REVIEWS . "
                      where reviews_id = '" . (int) $getRid . "'");
					
					$db->Execute("delete from " . TABLE_REVIEWS_DESCRIPTION . "
                      where reviews_id = '" . (int) $getRid . "'");
				}
			}
			else
			{
				$reviews_id = zen_db_prepare_input($_GET['rID']);
				
				$db->Execute("delete from " . TABLE_REVIEWS . "
                      where reviews_id = '" . (int) $reviews_id . "'");
				
				$db->Execute("delete from " . TABLE_REVIEWS_DESCRIPTION . "
                      where reviews_id = '" . (int) $reviews_id . "'");
			}
        zen_redirect(zen_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page']));
        break;
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type"
	content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css"
	href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }

  function checkedall(reviewList)
  {
    var checkAll = document.getElementById('checkAll');
    for(i=0;i<reviewList.length;i++)
    {
       if(checkAll.checked==true)
       {
    	   reviewList[i].checked = true ;           
       }
       else
       {
    	   reviewList[i].checked = false ; 
       }
    }
  }
  function deleteReveiws(reviewList,url)
  {
	  var action;
	  action='';
	  for(i=0;i<reviewList.length;i++)
	    {
	       if(reviewList[i].checked == true)
	       {
	    	   action = 'submit';
		       break;        
	       }
	    }
	 if(action=='submit')
	 {
		 reviewList.submit();
	 }
	 else
	 {
        window.location.href=url;
	 }
  }
</script>
</head>
<body onLoad="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
	<tr>
		<!-- body_text //-->
		<td width="100%" valign="top">
		<table border="0" width="100%" cellspacing="0" cellpadding="2">
			<tr>
				<td>
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr><?php echo zen_draw_form('search', FILENAME_REVIEWS, '', 'get'); ?>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
						<td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
						<td class="smallText" align="right">
<?php
// show reset search
  if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
    echo '<a href="' . zen_href_link(FILENAME_REVIEWS) . '">' . zen_image_button('button_reset.gif', IMAGE_RESET) . '</a>&nbsp;&nbsp;';
  }
  echo HEADING_TITLE_SEARCH_DETAIL . ' ' . zen_draw_input_field('search') . zen_hide_session_id();
  if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
    $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
    echo '<br/ >' . TEXT_INFO_SEARCH_DETAIL_FILTER . $keywords;
  }
?>
            </td>
						</form>
					</tr>
					<tr><?php echo zen_draw_form('status', FILENAME_REVIEWS, '', 'get', '', true); ?>
                <td class="smallText" colspan="3" align="right">
                  <?php
                    echo HEADING_TITLE_STATUS . ' ' . zen_draw_pull_down_menu('status', array_merge(array(array('id' => '', 'text' => TEXT_ALL_STATUS)), $status_list), $status_filter, 'onChange="this.form.submit();"');
                    echo zen_hide_session_id();
                 ?>
                </td>
						</form>
					</tr>
				</table>
				</td>
			</tr>
<?php
  if ($action == 'edit') {
    $rID = zen_db_prepare_input($_GET['rID']);

    $reviews = $db->Execute("select r.reviews_id, r.products_id, r.customers_name, r.date_added,
                                    r.last_modified, r.reviews_read, rd.reviews_text,rd.reviews_admin, r.reviews_rating,r.customers_email,r.reviews_pic
                             from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd
                             where r.reviews_id = '" . (int)$rID . "' and r.reviews_id = rd.reviews_id");

    $products = $db->Execute("select products_image
                              from " . TABLE_PRODUCTS . "
                              where products_id = '" . (int)$reviews->fields['products_id'] . "'");

    $products_name = $db->Execute("select products_name
                                   from " . TABLE_PRODUCTS_DESCRIPTION . "
                                   where products_id = '" . (int)$reviews->fields['products_id'] . "'
                                   and language_id = '" . (int)$_SESSION['languages_id'] . "'");

    $rInfo_array = array_merge($reviews->fields, $products->fields, $products_name->fields);
    $rInfo = new objectInfo($rInfo_array);
?>
      <tr><?php echo zen_draw_form('review', FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $_GET['rID'] . '&action=preview'); ?>
        <td>
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td class="main" valign="top"><b><?php echo ENTRY_PRODUCT; ?></b> <?php echo '<a href="' . zen_catalog_href_link(zen_get_info_page($rInfo->products_id), 'products_id=' . (int)$rInfo->products_id) . '"target="_blank">'. $rInfo->products_name. '</a>'; ?><br>
						<b><?php echo ENTRY_FROM; ?></b> <?php echo $rInfo->customers_name; ?><br>
						<br>
						<b>客户邮件:</b> <?php echo $rInfo->customers_email; ?><br>
						<br>
						<b>图片:</b>
                        <?php $img =explode(",",$rInfo->reviews_pic);
						  foreach($img as $pic){
							  if(strlen($pic)>2) echo '<img src="../images/'.$pic.'">';
						  }?>
                        <br>
						<br>
						<b><?php echo ENTRY_DATE; ?></b><input name="reviews_date_added"
							type="text" id="reviews_date_added"
							value="<?php echo $rInfo->date_added ?>" size="20" /></td>
						<td class="main" align="right" valign="top"><?php echo '<a href="' . zen_catalog_href_link(zen_get_info_page($rInfo->products_id), 'products_id=' . (int)$rInfo->products_id) . '"target="_blank">'.zen_image(DIR_WS_CATALOG_IMAGES . $rInfo->products_image, $rInfo->products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'hspace="5" vspace="5"').'</a>'; ?></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td>

				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td class="main" valign="top"><b><?php echo ENTRY_REVIEW; ?></b><br>
						<br><?php echo zen_draw_textarea_field('reviews_text', 'soft', '70', '15', stripslashes($rInfo->reviews_text)); ?></td>
					</tr>
					<tr>
						<td class="main" valign="top"><b>admin Review:</b><br>
						<br><?php echo zen_draw_textarea_field('reviews_admin', 'soft', '70', '15', stripslashes($rInfo->reviews_admin)); ?></td>
					</tr>
					<tr>
						<td class="smallText" align="right"><?php echo ENTRY_REVIEW_TEXT; ?></td>
					</tr>
				</table>

				</td>
			</tr>
			<tr>
				<td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
			</tr>
			<tr>
				<td class="main"><b><?php echo ENTRY_RATING; ?></b>&nbsp;<?php echo TEXT_BAD; ?>&nbsp;<?php for ($i=1; $i<=5; $i++) echo zen_draw_radio_field('reviews_rating', $i, '', $rInfo->reviews_rating) . '&nbsp;'; echo TEXT_GOOD; ?></td>
			</tr>
			<tr>
				<td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
			</tr>
			<tr>
				<td align="right" class="main"><?php echo zen_draw_hidden_field('reviews_id', $rInfo->reviews_id) . zen_draw_hidden_field('products_id', $rInfo->products_id) . zen_draw_hidden_field('customers_name', $rInfo->customers_name) . zen_draw_hidden_field('products_name', $rInfo->products_name) . zen_draw_hidden_field('products_image', $rInfo->products_image) . zen_draw_hidden_field('date_added', $rInfo->date_added) . zen_image_submit('button_preview.gif', IMAGE_PREVIEW) . ' <a href="'.zen_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $rInfo->reviews_id . '&action=delete').'">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a> <a href="' . zen_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $_GET['rID']) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
				</form>
			</tr>
<?php
  } elseif ($action == 'preview') {
    if (zen_not_null($_POST)) {
      $rInfo = new objectInfo($_POST);
    } else {
      $rID = zen_db_prepare_input($_GET['rID']);

      $reviews = $db->Execute("select r.reviews_id, r.products_id, r.customers_name, r.date_added,
                                      r.last_modified, r.reviews_read, rd.reviews_text,rd.reviews_admin,
                                      r.reviews_rating
                               from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd
                               where r.reviews_id = '" . (int)$rID . "'
                               and r.reviews_id = rd.reviews_id");

      $products = $db->Execute("select products_image
                                from " . TABLE_PRODUCTS . "
                                where products_id = '" . (int)$reviews->fields['products_id'] . "'");

      $products_name = $db->Execute("select products_name
                                     from " . TABLE_PRODUCTS_DESCRIPTION . "
                                     where products_id = '" . (int)$reviews->fields['products_id'] . "'
                                     and language_id = '" . (int)$_SESSION['languages_id'] . "'");

      $rInfo_array = array_merge($reviews->fields, $products->fields, $products_name->fields);
      $rInfo = new objectInfo($rInfo_array);
    }
?>
      <tr><?php echo zen_draw_form('update', FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $_GET['rID'] . '&action=update', 'post', 'enctype="multipart/form-data"'); ?>
        <td>
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td class="main" valign="top"><b><?php echo ENTRY_PRODUCT; ?></b> <?php echo $rInfo->products_name; ?><br>
						<b><?php echo ENTRY_FROM; ?></b> <?php echo $rInfo->customers_name; ?><br>
						<br>
						<b><?php echo ENTRY_DATE; ?></b> <?php echo zen_date_short($rInfo->date_added); ?></td>
						<td class="main" align="right" valign="top"><?php echo zen_image(DIR_WS_CATALOG_IMAGES . substr($rInfo->products_image,0,strpos($rInfo->products_image,',')), $rInfo->products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'hspace="5" vspace="5"'); ?></td>
					</tr>
				</table>
			
			</tr>
			<tr>
				<td>
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>
						<td valign="top" class="main"><b><?php echo ENTRY_REVIEW; ?></b><br>
						<br><?php echo nl2br(zen_db_output(zen_break_string($rInfo->reviews_text, 15))); ?></td>
					</tr>
					<tr>
						<td valign="top" class="main"><b>admin review:</b><br>
						<br><?php echo nl2br(zen_db_output(zen_break_string($rInfo->reviews_admin, 15))); ?></td>
					</tr>
				</table>
				</td>
			</tr>
			<tr>
				<td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
			</tr>
			<tr>
				<td class="main"><b><?php echo ENTRY_RATING; ?></b>&nbsp;<?php echo zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $rInfo->reviews_rating . '.gif', sprintf(TEXT_OF_5_STARS, $rInfo->reviews_rating)); ?>&nbsp;<small>[<?php echo sprintf(TEXT_OF_5_STARS, $rInfo->reviews_rating); ?>]</small></td>
			</tr>
			<tr>
				<td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
			</tr>
<?php
    if (zen_not_null($_POST)) {
/* Re-Post all POST'ed variables */
      reset($_POST);
      while(list($key, $value) = each($_POST)) echo zen_draw_hidden_field($key, $value);
?>
      <tr>
				<td align="right" class="smallText"><?php echo '<a href="' . zen_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $rInfo->reviews_id . '&action=edit') . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a> ' . zen_image_submit('button_update.gif', IMAGE_UPDATE) . ' <a href="' . zen_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $rInfo->reviews_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
				</form>
			</tr>
<?php
    } else {
      if (isset($_GET['origin'])) {
        $back_url = $_GET['origin'];
        $back_url_params = '';
      } else {
        $back_url = FILENAME_REVIEWS;
        $back_url_params = 'page=' . $_GET['page'] . '&rID=' . $rInfo->reviews_id;
      }
?>
      <tr>
				<td align="right"><?php echo '<a href="' . zen_href_link($back_url, $back_url_params, 'NONSSL') . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
			</tr>
<?php
    }
  } else {
?>
      <tr>
				<td>
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td valign="top">
						<form name="reviewCheck"
							action="<?php echo zen_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&action=delete');?>"
							method="POST">
						<table border="0" width="100%" cellspacing="0" cellpadding="2">
							<tr class="dataTableHeadingRow" id="dataTableHeadingRow" >
							    <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_CHECKBOX; ?></td>
								<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
								<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CUSTOMER_NAME; ?></td>
								<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CUSTOMER_EMAIL; ?></td>
								<td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_RATING; ?></td>
								<td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_DATE_ADDED; ?></td>
								<td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_STATUS; ?></td>
								<td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_FEATURED; ?></td>								
								<td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
							</tr>              
<?php

// create search filter
    $search = '';
    if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
      $keywords = zen_db_input(zen_db_prepare_input($_GET['search']));
      $search = " and r.customers_name like '%" . $keywords . "%' or rd.reviews_text like '%" . $keywords . "%' or pd.products_name like '%" . $keywords . "%' or pd.products_description like '%" . $keywords . "%' or p.products_model like '%" . $keywords . "%'";
    }

    if ($status_filter !='' && $status_filter >0) $search .= " and r.status=" . ((int)$status_filter-1) . " ";

    $order_by = " order by r.date_added desc";

    $reviews_query_raw = ("select r.*, rd.*, pd.*, p.* from (" . TABLE_REVIEWS . " r left join " . TABLE_REVIEWS_DESCRIPTION . " rd on r.reviews_id = rd.reviews_id left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on r.products_id = pd.products_id and pd.language_id ='" . (int)$_SESSION['languages_id'] . "' left join " . TABLE_PRODUCTS . " p on p.products_id= r.products_id) " . " where r.products_id = p.products_id " . $search . $order_by);

//    $reviews_query_raw = "select reviews_id, products_id, date_added, last_modified, reviews_rating, status from " . TABLE_REVIEWS . " order by date_added DESC";
    $reviews_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $reviews_query_raw, $reviews_query_numrows);
    $reviews = $db->Execute($reviews_query_raw);
    $checkbox_top = 200;
    $checkbox_left = 20;
    while (!$reviews->EOF) {
      if ((!isset($_GET['rID']) || (isset($_GET['rID']) && ($_GET['rID'] == $reviews->fields['reviews_id']))) && !isset($rInfo)) {
        $reviews_text = $db->Execute("select r.reviews_read, r.customers_name,r.customers_email,r.reviews_pic,
                                             length(rd.reviews_text) as reviews_text_size,rd.reviews_text,rd.reviews_admin
                                      from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd
                                      where r.reviews_id = '" . (int)$reviews->fields['reviews_id'] . "'
                                      and r.reviews_id = rd.reviews_id");

        $products_image = $db->Execute("select products_image
                                        from " . TABLE_PRODUCTS . "
                                        where products_id = '" . (int)$reviews->fields['products_id'] . "'");


        $products_name = $db->Execute("select products_name
                                       from " . TABLE_PRODUCTS_DESCRIPTION . "
                                       where products_id = '" . (int)$reviews->fields['products_id'] . "'
                                       and language_id = '" . (int)$_SESSION['languages_id'] . "'");

        $reviews_average = $db->Execute("select (avg(reviews_rating) / 5 * 100) as average_rating
                                         from " . TABLE_REVIEWS . "
                                         where products_id = '" . (int)$reviews->fields['products_id'] . "'");

        $review_info = array_merge($reviews_text->fields, $reviews_average->fields, $products_name->fields);
        $rInfo_array = array_merge($reviews->fields, $review_info, $products_image->fields);
        $rInfo = new objectInfo($rInfo_array);
      }
      $checkDisable=isset($_GET['action'])&&$_GET['action']=='delete'?'disabled="disabled"':'';
      if(isset($_POST['reviewCheckBox']))
      {
      	foreach ($_POST['reviewCheckBox'] as $rid)
      	{
      		$isCheckedArr[$rid] = $rid==$reviews->fields['reviews_id']?'checked="checked"':'';
      	}
      }
      $isChecked=isset($isCheckedArr[$reviews->fields['reviews_id']])?$isCheckedArr[$reviews->fields['reviews_id']]:'';
      echo '<div id="selectObj'.$reviews->fields['reviews_id'].'" style="position:absolute;top:'.$checkbox_top.'px;left:'.$checkbox_left.'px;"><input type="checkbox" '.$isChecked .' name="reviewCheckBox[]" value="'.$reviews->fields['reviews_id'].'" '.$checkDisable.'></div>';
      $checkbox_top+=24;
      if (isset($rInfo) && is_object($rInfo) && ($reviews->fields['reviews_id'] == $rInfo->reviews_id) ) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $rInfo->reviews_id . '&action=edit') . '\'">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $reviews->fields['reviews_id']) . '\'">' . "\n";
      }
      $products_name_string = zen_get_products_name($reviews->fields['products_id']);
      $products_name_string = strlen($products_name_string)>30?substr($products_name_string,0,30).'...':$products_name_string; 
?>
                <td align="center" id="tdObj<?php echo $reviews->fields['reviews_id'];?>"></td>               
                <td class="dataTableContent"><?php echo '<a href="' . zen_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $reviews->fields['reviews_id'] . '&action=preview') . '">' . zen_image(DIR_WS_ICONS . 'preview.gif', ICON_PREVIEW) . '</a>&nbsp;' .$products_name_string; ?></td>
							<td class="dataTableContent"><?php echo $reviews->fields['customers_name']; ?></td>
							<td class="dataTableContent"><?php echo $reviews->fields['customers_email']; ?></td>
							<td class="dataTableContent" align="right"><?php echo zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $reviews->fields['reviews_rating'] . '.gif'); ?></td>
							<td class="dataTableContent" align="right"><?php echo zen_date_short($reviews->fields['date_added']); ?></td>
							<td class="dataTableContent" align="center">
<?php
      if ($reviews->fields['status'] == '1') {
        echo '<a href="' . zen_href_link(FILENAME_REVIEWS, 'action=setflag&flag=0&id=' . $reviews->fields['reviews_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON) . '</a>';
      } else {
        echo '<a href="' . zen_href_link(FILENAME_REVIEWS, 'action=setflag&flag=1&id=' . $reviews->fields['reviews_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF) . '</a>';
      }
?>
                </td>
							<td class="dataTableContent" align="center">
<?php
      if ($reviews->fields['reviews_is_featured'] == '1') {
        echo '<a href="' . zen_href_link(FILENAME_REVIEWS, 'action=featured&flag=0&id=' . $reviews->fields['reviews_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON) . '</a>';
      } else {
        echo '<a href="' . zen_href_link(FILENAME_REVIEWS, 'action=featured&flag=1&id=' . $reviews->fields['reviews_id'], 'NONSSL') . '">' . zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF) . '</a>';
      }
?>                
                </td>							
							<td class="dataTableContent" align="right"><?php if ( (is_object($rInfo)) && ($reviews->fields['reviews_id'] == $rInfo->reviews_id) ) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif'); } else { echo '<a href="' . zen_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $reviews->fields['reviews_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
							</tr>
<?php
      $reviews->MoveNext();
    }
?>
              <tr>
								<td colspan="9">
								<table border="0" width="100%" cellspacing="0" cellpadding="2">
									<tr>
									   <td class="smallText" align="left">Select All<input
											type="checkbox" name="checkAll" id="checkAll"
											<?php echo $checkDisable;?> value="1"
											onclick="checkedall(document.reviewCheck);"></form></td>
										<td class="smallText" valign="top"><?php echo $reviews_split->display_count($reviews_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></td>
										<td class="smallText" align="right"><?php echo $reviews_split->display_links($reviews_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>										
									</tr>
								</table>
								</td>
							</tr>
						</table>						
						</td>
<?php
    $heading = array();
    $contents = array();

    switch ($action) {
      case 'delete':
      	//print_r($_POST['reviewCheckBox']);
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_REVIEW . '</b>');
        $hiddenRid='';
        $products_name_texts = '';
        if(isset($_POST['reviewCheckBox']))
        {        	
          foreach ($_POST['reviewCheckBox'] as $setRId)
          {
          	$hiddenRid.=zen_draw_hidden_field('rID[]',$setRId);
          	$pName = $db->Execute("SELECT products_name FROM ".TABLE_REVIEWS." r, ".TABLE_PRODUCTS_DESCRIPTION." pd WHERE r.products_id=pd.products_id AND r.reviews_id=".$setRId);
          	$products_name_texts.='<br>'.$pName->fields['products_name'];
          }
        }
        $contents = array('form' => zen_draw_form('reviews', FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $rInfo->reviews_id . '&action=deleteconfirm').$hiddenRid);
        $contents[] = array('text' => $hiddenRid==''?TEXT_INFO_DELETE_REVIEW_INTRO:TEXT_INFO_DELETE_REVIEWS_INTRO);
        $contents[] = array('text' => '<b>' . ($hiddenRid==''?'<br>'.$rInfo->products_name :$products_name_texts). '</b>');
        $contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . zen_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $rInfo->reviews_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
        break;
      default:
      if (isset($rInfo) && is_object($rInfo)) {
        $heading[] = array('text' => '<b><a href="' . zen_catalog_href_link(zen_get_info_page($rInfo->products_id), 'products_id=' . (int)$rInfo->products_id) . '" style="color:#fff;font-weight:bold;"target="_blank">'. $rInfo->products_name. '</a></b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $rInfo->reviews_id . '&action=edit') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a onclick="deleteReveiws(document.reviewCheck,\''.zen_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . '&rID=' . $rInfo->reviews_id . '&action=delete').'\')"href="#">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a> ' . ' <a href="' . zen_href_link(FILENAME_CATEGORIES, 'cPath=' . zen_get_products_category_id($rInfo->products_id) . '&pID=' . $rInfo->products_id) . '">' . zen_image_button('button_details.gif', IMAGE_DETAILS) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_INFO_DATE_ADDED . ' ' . zen_date_short($rInfo->date_added));
        if (zen_not_null($rInfo->last_modified)) $contents[] = array('text' => TEXT_INFO_LAST_MODIFIED . ' ' . zen_date_short($rInfo->last_modified));
        $contents[] = array('text' => '<br>' . zen_info_image(substr($rInfo->products_image,0,strpos($rInfo->products_image,',')), $rInfo->products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT));
        $contents[] = array('text' => '<br>' . TEXT_INFO_REVIEW_AUTHOR . ' ' . $rInfo->customers_name);
        $contents[] = array('text' => TEXT_INFO_REVIEW_RATING . ' ' . zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $rInfo->reviews_rating . '.gif'));
        $contents[] = array('text' => TEXT_INFO_REVIEW_READ . ' ' . $rInfo->reviews_read);
        $contents[] = array('text' => '<br>' . TEXT_INFO_REVIEW_SIZE . ' ' . $rInfo->reviews_text_size . ' bytes');
        $contents[] = array('text' => '<br>' . TEXT_INFO_PRODUCTS_AVERAGE_RATING . ' ' . number_format($rInfo->average_rating, 2) . '%');
        $contents[] = array('text' => '<br>' . ENTRY_REVIEW . ' ' . $rInfo->reviews_text);
        $contents[] = array('text' => '<br>' . ENTRY_ADMIN_REVIEW . ' ' . $rInfo->reviews_admin);
      }
        break;
    }

    if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
      echo '            <td width="25%" valign="top">' . "\n";

      $box = new box;
      echo $box->infoBox($heading, $contents);

      echo '            </td>' . "\n";
    }
?>
          </tr>
				</table>
				</td>
			</tr>
<?php
  }
?>
    </table>
		</td>
		<!-- body_text_eof //-->
	</tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
