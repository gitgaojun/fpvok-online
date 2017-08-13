<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2006 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: home_flash_image_manager.php 4675 2006-10-03 03:31:35Z ajeh $
//

  require('includes/application_top.php');

  $xml_image_location = 'images/' . $db_image_location;
  $xmlPath = DIR_FS_CATALOG . 'flash/promotion2.xml';
  $xml = new DOMDocument();
  $xml->load($xmlPath);
  $items = $xml->getElementsByTagName("item");
  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  $banner_extension = zen_banner_image_extension();

  if (zen_not_null($action)) {
    switch ($action) {
      case 'insert':
      case 'update':      	
        if (isset($_POST['image_id'])) $image_id = zen_db_prepare_input($_POST['image_id']);
        $image_title = zen_db_prepare_input($_POST['image_title']);
        $image_url = zen_db_prepare_input($_POST['image_url']);
        $image_local = zen_db_prepare_input($_POST['image_local']);
        $image_location = '';

        $image_error = false;
        if (empty($image_title)) {
          $messageStack->add(ERROR_IMAGE_TITLE_REQUIRED, 'error');
          $image_error = true;
        }
        
          if (empty($image_local)) {
            $image = new upload('image');
            $image->set_destination(DIR_FS_CATALOG_IMAGES . 'promotions/');
            if ( ($image->parse() == false) || ($image->save() == false) ) {
              $messageStack->add(ERROR_IMAGE_REQUIRED, 'error');
              $$image_error = true;
            }
          }

        if ($image_error == false) {         
          $xml_image_location = (zen_not_null($image_local)) ? $image_local : 'images/promotions/' . $image->filename;

			/*Bof home page switch xml*/
					if ($action=='update')
					{
					  foreach ($items as $item)
						{
							//$item->setAttribute('url','why');
							$getId = $item->getAttribute('id');
							$getImg = $item->getAttribute('img');
							$getTitle = $item->getAttribute('title');
							$getUrl = $item->getAttribute('url');
						
							if ($getId == $image_id)
							{								
								$item->setAttribute('img', $xml_image_location);
								$item->setAttribute('title', $image_title);
								$item->setAttribute('url', $image_url);
								$messageStack->add_session(SUCCESS_IMAGE_UPDATED, 'success');
								break;
							}
						}
					}					
					
					if ($action=='insert')
					{
						$newImageId = ((int)$items->item($items->length-1)->getAttribute('id'))+1;
						$mysee = $xml->getElementsByTagName("mysee")->item(0);
						$newItem = $xml->createElement('item');
						$mysee->appendChild($newItem);
						$newItemId = $xml->createAttribute('id');
						$newItem->appendChild($newItemId);
						$newItemNumber = $xml->createTextNode($newImageId);
						$newItemId->appendChild($newItemNumber);
						$newItemImage = $xml->createAttribute('img');
						$newItem->appendChild($newItemImage);
						$newItemImageSrc = $xml->createTextNode($xml_image_location);
						$newItemImage->appendChild($newItemImageSrc);
						$newItemUrl = $xml->createAttribute('url');
						$newItem->appendChild($newItemUrl);
						$newItemUrlVal = $xml->createTextNode($image_url);
						$newItemUrl->appendChild($newItemUrlVal);
						$newItemTitle = $xml->createAttribute('title');
						$newItem->appendChild($newItemTitle);
						$newItemTitleText = $xml->createTextNode($image_title);
						$newItemTitle->appendChild($newItemTitleText);
						$messageStack->add_session(SUCCESS_IMAGE_INSERTED, 'success');
					}
					
					$xml->save($xmlPath);
        /*Eof home page switch xml*/
					$image_id = isset($image_id)?$image_id:$newImageId;
          zen_redirect(zen_href_link(FILENAME_HOME_FLASH_IMAGE_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'fID=' . $image_id));
        } else {
          $action = 'new';
        }
        break;
      case 'deleteconfirm':
        $image_id = zen_db_prepare_input($_GET['fID']);

        if (isset($_POST['delete_image']) && ($_POST['delete_image'] == 'on')) {
          $imagePath = DIR_FS_CATALOG.zen_db_prepare_input($_POST['image']);

          if (is_file($imagePath)) {
            if (is_writeable($imagePath)) {
              unlink($imagePath);
            } else {
              $messageStack->add_session(ERROR_IMAGE_IS_NOT_WRITEABLE, 'error');
            }
          } else {
            $messageStack->add_session(ERROR_IMAGE_DOES_NOT_EXIST, 'error');
          }
        }
				$mysee = $xml->getElementsByTagName("mysee")->item(0);			
				foreach ($items as $item)
				{
					//$item->setAttribute('url','why');
					$getId = $item->getAttribute('id');
					
					if ($getId == $image_id)
					{
						$mysee->removeChild($item);						
						break;
					}
				}
				$xml->save($xmlPath);
        $messageStack->add_session(SUCCESS_IMAGE_REMOVED, 'success');

        zen_redirect(zen_href_link(FILENAME_HOME_FLASH_IMAGE_MANAGER));
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
<script language="javascript"><!--
function popupImageWindow(url) {
  window.open(url,'popupImageWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=100,height=100,screenX=150,screenY=150,top=150,left=150')
}
//--></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
</head>
<body onLoad="init()">
<div id="spiffycalendar" class="text"></div>
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
					<tr>
						<td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
						<td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
					</tr>
				</table>
				</td>
			</tr>
<?php
  if ($action == 'new') {
    $form_action = 'insert';

    $parameters = array('id' => '',
                        'img' => '',
                        'title' => '',
                        'url' => '');

    $fInfo = new objectInfo($parameters);

    if (isset($_GET['fID'])) {
      $form_action = 'update';
		
		$fID = zen_db_prepare_input($_GET['fID']);
		
		$imageInfo = array();
		foreach ($items as $item)
		{
			$getId = $item->getAttribute('id');
			if ($getId==$fID)
			{
			 $imageInfo['id'] = $item->getAttribute('id');
			 $imageInfo['img'] = $item->getAttribute('img');
			 $imageInfo['title'] = $item->getAttribute('title');
			 $imageInfo['url'] = $item->getAttribute('url');
			}			
		}
      $fInfo->objectInfo($imageInfo);
    } elseif (zen_not_null($_POST)) {
      $fInfo->objectInfo($_POST);
    }
?>
<link rel="stylesheet" type="text/css"
				href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
			<script language="JavaScript"
				src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
			<script language="javascript">
  var dateExpires = new ctlSpiffyCalendarBox("dateExpires", "new_banner", "expires_date","btnDate1","<?php echo $bInfo->expires_date; ?>",scBTNMODE_CUSTOMBLUE);
  var dateScheduled = new ctlSpiffyCalendarBox("dateScheduled", "new_banner", "date_scheduled","btnDate2","<?php echo $bInfo->date_scheduled; ?>",scBTNMODE_CUSTOMBLUE);
</script>
			<tr>
				<td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
			</tr>
			<tr><?php echo zen_draw_form('new_images', FILENAME_HOME_FLASH_IMAGE_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'action=' . $form_action, 'post', 'enctype="multipart/form-data"'); if ($form_action == 'update') echo zen_draw_hidden_field('image_id', $fID); ?>
        <td>
				<table border="0" cellspacing="0" cellpadding="2">
					
					<tr>
						<td class="main"><?php echo TEXT_IMAGE_TITLE; ?></td>
						<td class="main"><?php echo zen_draw_input_field('image_title', $fInfo->title,'style="width:500px;"'); ?></td>
					</tr>
					<tr>
						<td class="main"><?php echo TEXT_IMAGE_URL; ?></td>
						<td class="main"><?php echo zen_draw_input_field('image_url', $fInfo->url,'style="width:500px;"'); ?></td>
					</tr>
					<tr>
						<td class="main" valign="top"><?php echo TEXT_IMAGE; ?></td>
						<td class="main"><?php echo zen_draw_file_field('image') . ' ' . TEXT_IMAGE_LOCAL . '<br>' . DIR_FS_CATALOG . zen_draw_input_field('image_local', (isset($fInfo->img) ? $fInfo->img : ''),'style="width:347px;"'); ?></td>
					</tr>
					<tr>
						<td colspan="2"><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
					</tr>					
				</table>
				</td>
			</tr>
			<tr>
				<td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
			</tr>
			<tr>
				<td>
				<table border="0" width="100%" cellspacing="0" cellpadding="2">
					<tr>						
						<td class="main" align="right" valign="top" nowrap><?php echo (($form_action == 'insert') ? zen_image_submit('button_insert.gif', IMAGE_INSERT) : zen_image_submit('button_update.gif', IMAGE_UPDATE)). '&nbsp;&nbsp;<a href="' . zen_href_link(FILENAME_HOME_FLASH_IMAGE_MANAGER, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . (isset($_GET['bID']) ? 'bID=' . $_GET['bID'] : '')) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
					</tr>
				</table>
				</td>
				</form>
			</tr>
<?php
  } else {
?>
      <tr>
				<td>
				<table border="0" width="100%" cellspacing="0" cellpadding="0">
					<tr>
						<td valign="top">
						<table border="0" width="100%" cellspacing="0" cellpadding="2">
							<tr class="dataTableHeadingRow">
								<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_IMAGES_ID; ?></td>
								<td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_IMAGES; ?></td>
								<td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_IMAGES_TITLE; ?></td>
								<td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_IMAGES_URL; ?></td>
								<td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
							</tr>
<?php
    foreach ($items as $item)
    {
    	$getImg = $item->getAttribute('img');
		$getTitle = $item->getAttribute('title');
		$getUrl = $item->getAttribute('url');
		$getId = $item->getAttribute('id');
		$currentId = isset($_GET['fID'])? $_GET['fID']:$items->item(0)->getAttribute('id');
		if ($getId==$currentId)
		{
			$currImg = $item->getAttribute('img');
			$currTitle = $item->getAttribute('title');
			$currUrl = $item->getAttribute('url');
			echo '<tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_HOME_FLASH_IMAGE_MANAGER, 'fID=' . $getId . '&action=new') . '\'">' . "\n";
		}
		else 
		{
			echo '<tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_HOME_FLASH_IMAGE_MANAGER, 'fID=' . $getId) . '\'">' . "\n";
		}
	?>
		<td class="dataTableContent"><?php echo $getId; ?></td>
							<td class="dataTableContent"><?php echo $getImg; ?></td>
							<td class="dataTableContent"><?php echo $getTitle; ?></td>
							<td class="dataTableContent"><?php echo $getUrl; ?></td>
							<td class="dataTableContent" align="center"><?php if ($getId==$currentId) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . zen_href_link(FILENAME_HOME_FLASH_IMAGE_MANAGER, 'fID=' . $getId) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
   <?php
    }
   ?>
              <tr>
								<td colspan="5">
								<table border="0" width="100%" cellspacing="0" cellpadding="2">
									<tr>
										<td align="right" colspan="2"><?php echo '<a href="' . zen_href_link(FILENAME_HOME_FLASH_IMAGE_MANAGER, 'action=new') . '">' . zen_image_button('button_new_banner.gif', IMAGE_NEW_BANNER) . '</a>'; ?></td>
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
      $heading[] = array('text' => '<b>' . $currImg . '</b>');

      $contents = array('form' => zen_draw_form('images', FILENAME_HOME_FLASH_IMAGE_MANAGER, 'fID=' . $currentId . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $currImg . '</b>');
      if ($currImg) $contents[] = array('text' => '<br>' . zen_draw_checkbox_field('delete_image', 'on', true) . ' ' . TEXT_INFO_DELETE_IMAGE.zen_draw_hidden_field('image',$currImg));
      $contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . '&nbsp;<a href="' . zen_href_link(FILENAME_HOME_FLASH_IMAGE_MANAGER, 'fID=' . $_GET['fID']) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
        $heading[] = array('text' => '<b>' . $currImg . '</b>');
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_HOME_FLASH_IMAGE_MANAGER, 'fID=' . $currentId . '&action=new') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . zen_href_link(FILENAME_HOME_FLASH_IMAGE_MANAGER, 'fID=' . $currentId . '&action=delete') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');               
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