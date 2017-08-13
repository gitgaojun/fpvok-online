<?php
/**
 * @package admin
 * @copyright Copyright 2010 fpvok Gold
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: watermark.php$
 */
require ('includes/application_top.php');
require_once (DIR_FS_CATALOG . DIR_WS_FUNCTIONS . 'extra_functions/functions_bmz_io.php');
if (!defined('IS_ADMIN_FLAG'))
{
	die('Illegal Access');
}

if (isset($_GET['action']) && $_GET['action'] == 'create')
{	
	set_time_limit(0); 
	$original_image_folder = zen_db_prepare_input($_POST['original_image_folder']);
	$destination_image_folder = zen_db_prepare_input($_POST['destination_image_folder']);
	$watermarkImage = zen_db_prepare_input($_POST['watermarkImage']);
	$watermarkText = zen_db_prepare_input($_POST['watermarkText']);
	$fontColor = '#' . zen_db_prepare_input($_POST['fontColor']);
	$fontFamily = zen_db_prepare_input($_POST['fontFamily']);
	$fontSize = zen_db_prepare_input($_POST['fontSize']);
	$alpha = zen_db_prepare_input($_POST['alpha']);
	$shadow = zen_db_prepare_input($_POST['shadow']);
	$watermarkPosition = zen_db_prepare_input($_POST['watermarkPosition']);
	$fileIndex = zen_db_prepare_input($_POST['fileIndex']);	
	require (DIR_WS_CLASSES . 'watermark.php');
	$fontFamilyArr = array(
		'宋体' => 'simsun.ttc', 
		'楷体' => 'simkai.ttf', 
		'黑体' => 'simhei.ttf', 
		'Courier New' => 'cour.ttf', 
		'Arial' => 'arial.ttf', 
		'Arial Black' => 'ariblk.ttf', 
		'Arial Narrow' => 'ARIALN.TTF', 
		'Sylfaen' => 'sylfaen.ttf', 
		'Tahoma' => 'tahoma.ttf', 
		'Times New Roman' => 'times.ttf'
	);
	foreach ($fontFamilyArr as $fontFamilyName => $fontFamilyFile)
	{
		$checkFont = false;
		switch ($fontFamily)
		{
			
			case $fontFamily == $fontFamilyName :
				{
					$font = DIR_FS_CATALOG . 'fonts/' . $fontFamilyFile;
					$checkFont = true;
					break;
				}
			default :
				{
					$font = DIR_FS_CATALOG . 'fonts/ariblk.ttf';
					break;
				}
		}
		if ($checkFont)
		{
			break;
		}
	}
	
	  if(isset($_SESSION['fileIndex'])&&$_SESSION['fileIndex']>$fileIndex)
	  {
	  	$fileIndex = $_SESSION['fileIndex'];
	  	unset($_SESSION['fileIndex']);
	  }
	if (isset($_SESSION['watermark'])&&$_SESSION['watermark']!='')
	{
		$watermark=unserialize($_SESSION['watermark']);
	}
	else 
	{
		$watermark= new watermark($watermarkPosition, $watermarkImage, $alpha, $watermarkText, $fontSize, $fontColor, $font);
		$_SESSION['watermark'] = serialize($watermark);
	}	
	//$watermark = new watermark($watermarkPosition, $watermarkImage, $alpha, $watermarkText, $fontSize, $fontColor, $font);

	@$watermark->startCreateImage($original_image_folder, $destination_image_folder,$fileIndex);
	//echo "creating...";
	if (count($watermark->message['error']) > 0)
	{
		foreach ($watermark->message['error'] as $err)
		{
			$messageStack->add($err, "error");
		}
	}
	if (count($watermark->message['warning']) > 0)
	{
		foreach ($watermark->message['warning'] as $warning)
		{
			$messageStack->add($warning, "warning");
		}
	}
	/*zen_redirect(FILENAME_WATERMARK, zen_get_all_get_params(array(
		'action'
	)));*/	
	$file_total = $watermark->getImagesNumber();
	if ($file_total!=0)
	  {
	  	$precent = intval(($fileIndex+1)/$file_total*100);
	  	$progress = (($fileIndex+1)/$file_total)*500;
	  }
	  else 
	  {
	  	$progress = 0;
	  }

	//echo '_progress:<div style="width:'.$progress.';height:20px;background:blue;text-align:center;line-height:20px;color:#ffffff">'.$precent.'%</div>:progress_';
	echo '_progress:'.$progress.':progress_';
	echo '_precent:'.$precent.':precent_';
	if ($fileIndex==$file_total-1)
	{
		unset($_SESSION['watermark']);
		unset($_SESSION['fileIndex']);
	}
	else 
	{	  
	   $fileIndex++;
	   echo '_total:'.$file_total.':total_';	
	   echo '_fileIndex:'.$fileIndex.':fileIndex_';	
	}
}
else 
{
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php
echo HTML_PARAMS;
?>>
<head>
<meta http-equiv="Content-Type"
	content="text/html; charset=<?php
	echo CHARSET;
	?>">
<title><?php
echo TITLE;
?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css"
	href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script type="text/javascript" src="includes/jquery.js"></script>
<script type="text/javascript">
var fileIndex;
fileIndex=0;
var Interval_control;
function watermarkPreview(url,div)
{
	var getData = getWatermarkData();
	 $.ajax({
		  type: "POST",
		  url:url,
		  data:getData,
		  async: false,
		  beforSend:waitGif("#"+div),		  
		  success:function(msg){
			     if(div!="")
				 {
					$("#"+div).html(msg); 
				 }			 
			}
		});	
}

function watermarkCache(url,div)
{
	var getData = getWatermarkData();
	getData+='&fileIndex='+fileIndex;
	 $.ajax({
		  type: "POST",
		  url:url,
		  data:getData,
		  async: false,	  
		  beforSend:$("#loading").html('Loading...'),
		  success:function(msg){
			     if(div!="")
				 {
			    	 //alert(msg);
			    	 var getIndex=0;
			    	 var getTotal=0;
			    	 var progress=0;
			    	 var precent=0;
					 if(msg.indexOf('_fileIndex:')!=-1)
					 {
						 getIndex=msg.substring(msg.indexOf('_fileIndex:')+11,msg.indexOf(':fileIndex_'));
					 }
					 if(msg.indexOf('_total:')!=-1)
					 {
						 getTotal=msg.substring(msg.indexOf('_total:')+7,msg.indexOf(':total_'));
					 }
					 if(msg.indexOf('_progress:')!=-1)
					 {
						 progress = msg.substring(msg.indexOf('_progress:')+10,msg.indexOf(':progress_'));
					 }
					 if(msg.indexOf('_precent:')!=-1)
					 {
						 precent = msg.substring(msg.indexOf('_precent:')+9,msg.indexOf(':precent_'));
					 }			 					 				 
					 if(Number(getIndex)<Number(getTotal))
					 {
				    	 fileIndex=getIndex;						 
					 }
					 else
					 {
						 fileIndex=0;
						 clearInterval(Interval_control);
					 }	
					 $("#loading").css({'display':'none'});
					 $("#"+div).css({'display':'block'});
					 $('#progress_percent').html(precent+'%');
					 $('#progress_background').css({'width':progress});
					 //$("#"+div).html(progress); 				 
				 }			 
			}
		});	
}

function submitWaterMark(url,div)
{
	Interval_control=setInterval('watermarkCache("'+url+'","'+div+'")',1000);
	// watermarkCache(url,div);
}

function waitGif(div)
{
	 $(div).html('<div style="width:100;height:100;margin:200 auto;">Loading...</div>');
}
function getWatermarkData()
{
	var original_image_folder = $('#original_image_folder').val();
	var destination_image_folder = $('#destination_image_folder').val();
	var watermarkImage = $('#watermarkImage').val();
	var watermarkText = $('#watermarkText').val();
	var fontColor = $('#fontColor').val();
	var fontFamily = $('#fontFamily').val();
	var fontSize = $('#fontSize').val();
	var alpha = $('#alpha').val();
	var shadows=document.getElementsByName("shadow");
	var shadow;
	 for(var i = 0; i < shadows.length; i++)
	{
	     if(shadows[i].checked)
	     {
		     shadow=shadows[i].value;
	     }
	 }
	var watermarkPosition = $('#watermarkPosition').val();
	var getData = 'original_image_folder='+original_image_folder+'&destination_image_folder='+destination_image_folder+'&watermarkImage='+watermarkImage+'&watermarkText='+watermarkText+'&fontColor='+fontColor+'&fontFamily='+fontFamily+'&fontSize='+fontSize+'&alpha='+alpha+'&shadow='+shadow+'&watermarkPosition='+watermarkPosition;
	return getData;
}
</script>
<style type="text/css">
.watermark_parameters {
	width: 600px;
	float: left;
}

.progress {
	width: 500px;
	height: 20px;
	float: left;
	border: solid 1px #7F9DB9;
    display:none;
	margin-top: 50px;
}
.loading
{
	height:20px;
	top:161px;
	position:absolute;
	color:#000;
	line-height:20px;
	width:500px;
	text-align:center;
	z-index:5;
}
.progress_background
{
	background:blue;
	height:20px;
	top:161px;
	position:absolute;
	z-index:10;
}
.progress_percent
{
	height:20px;
	top:0px;
	position:relative;
	color:red;
	line-height:20px;
	width:500px;
	text-align:center;
	z-index:20;
}
.previewDiv {
	width: 500px;
	height: 500px;
	float: left;
	border: solid 1px #7F9DB9;
	margin-top: 10px;
}
</style>
</head>
<body>
<!-- header //-->
<?php
require (DIR_WS_INCLUDES . 'header.php');
?>
<!-- header_eof //-->

<!-- body //-->
<div class="watermark_parameters">
<table width="100%" cellspacing="0" cellpadding="4" border="0"
	class="TdBoder">
	<form id="form1" name="form1" method="post"
		action="<?php
		echo zen_href_link(FILENAME_WATERMARK, 'action=create')?>">
	<tr>
		<td>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td class="pageHeading"><?php
				echo HEADING_TITLE;
				?></td>
				<td class="pageHeading" align="right"><?php
				echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT);
				?></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td align="left" colspan="2"><?php
		echo WATERMARK_NOTE;
		?></td>
	</tr>
	<tr bgcolor="#ffffff" width="89">
		<td width="168">&nbsp;</td>
		<td width="297">&nbsp;</td>
		<td width="381">&nbsp;</td>
	</tr>
	<tr bgcolor="#ffffff" width="89">
		<td align="right" colspan="2"><input type="hidden" value="0" id="act"
			name="act"></td>
		<td valign="top">&nbsp;</td>
	</tr>
	<tr bgcolor="#ffffff" width="89">
		<td align="right"><?php
		echo ORIGINAL_IMAGE_FOLDER;
		?></td>
		<td><label><input type="text" id="original_image_folder"
			name="original_image_folder"
			value="<?php
			echo DIR_FS_CATALOG_IMAGES . 'test/';
			?>"
			name="Text" style="width: 400px;"></label></td>
	</tr>
	<tr bgcolor="#ffffff" width="89">
		<td align="right"><?php
		echo DESTINATION_IMAGE_FOLDER;
		?></td>
		<td><label><input type="text" id="destination_image_folder"
			name="destination_image_folder"
			value="<?php
			echo DIR_FS_CATALOG_IMAGES . 'test2/';
			?>"
			name="Text" style="width: 400px;"></label></td>
	</tr>
	<tr bgcolor="#ffffff" width="89">
		<td align="right"><?php
		echo WATERMARK_IMAGE;
		?></td>
		<td><label><input type="text" id="watermarkImage"
			name="watermarkImage"
			value="<?php
			echo DIR_FS_CATALOG_IMAGES . 'watermark.png';
			?>"
			name="Text" style="width: 400px;"></label></td>
	</tr>
	<tr bgcolor="#ffffff" width="89">
		<td align="right"><?php
		echo WATERMARK_TEXT;
		?></td>
		<td><label><input type="text" id="watermarkText" value=""
			name="watermarkText" style="width: 400px;"></label></td>
		<td valign="top" rowspan="10"></td>
	</tr>
	<tr bgcolor="#ffffff" width="89">
		<td align="right"><?php
		echo WATERMARK_TEXT_COLOR;
		?></td>
		<td><label>#<input type="text" value="FFFFFF" id="fontColor"
			name="fontColor" style="width: 250px;"> e.g.：FFFFFF or 000000 </label></td>
	</tr>
	<tr bgcolor="#ffffff">
		<td align="right"><?php
		echo WATERMARK_TEXT_FONT_FAMILY;
		?></td>
		<td><label><select id="fontFamily" name="fontFamily"
			style="width: 400px;">
			<option>宋体</option>
			<option>黑体</option>
			<option>楷体</option>
			<option>Courier New</option>
			<option>Arial</option>
			<option selected="">Arial Black</option>
			<option>Arial Narrow</option>
			<option>Sylfaen</option>
			<option>Tahoma</option>
			<option>Terminal</option>
			<option>Times New Roman</option>
		</select></label></td>
	</tr>
	<tr bgcolor="#ffffff" width="89">
		<td align="right"><?php
		echo WATERMARK_TEXT_FONTSIZE;
		?></td>
		<td><label><select id="fontSize" name="fontSize" style="width: 400px;">
			  <?php
					for ($i = 8; $i < 71; $i++)
					{
						$selected = $i == 30 ? 'selected="selected"' : '';
						echo '<option ' . $selected . '>' . $i . '</option>';
					}
					?>				
			</select></label></td>
	</tr>
	<tr bgcolor="#ffffff" width="89" style="display: none;">
		<td align="right">是否加粗：</td>
		<td><label> <input type="radio" value="true" id="radio" name="Bold">
		是&nbsp;&nbsp; <input type="radio" value="false" id="radio2" checked=""
			name="Bold"> 否 </label></td>
	</tr>
	<tr bgcolor="#ffffff" width="89">
		<td align="right"><?php
		echo WATERMARK_TEXT_ALPHA;
		?></td>
		<td><label><input type="text" maxlength="3" value="50"
			style="width: 380px;" id="alpha" name="alpha"> %</label></td>
	</tr>
	<tr bgcolor="#ffffff" width="89">
		<td align="right"><?php
		echo WATERMARK_TEXT_SHADOW;
		?></td>
		<td><input type="radio" name="shadow" value="1" checked> Yes<input
			type="radio" name="shadow" value="0"> No</td>
	</tr>
	<tr bgcolor="#ffffff" width="89">
		<td align="right"><?php
		echo WATERMARK_POSITION;
		?></td>
		<td><label> <select id="watermarkPosition" name="watermarkPosition"
			style="width: 400px;">
			<option value="0">Randomize</option>
			<option value="1">Top Left</option>
			<option value="2">Top Center</option>
			<option value="3">Top Right</option>
			<option value="4">Middle left</option>
			<option value="5" selected="selected">Middle Center</option>
			<option value="6">Middle Right</option>
			<option value="7">Bottom Left</option>
			<option value="8">Bottom Center</option>
			<option value="9">Bottom Right</option>
		</select> </label></td>
	</tr>
	<tr bgcolor="#ffffff" width="89" style="display: none;">
		<td height="51" align="right">相对调整相素：</td>
		<td>左：<label><input type="text" value="20" style="width: 40px;"
			id="Left" name="Left"> px 顶：<input type="text" value="70"
			style="width: 40px;" id="Top" name="Top"> px (负为反向)</label></td>
	</tr>
	<tr bgcolor="#ffffff" width="89">
		<td>&nbsp;</td>
		<td colspan="2"><input type="button" value="Preview"
			id="button" name="button"
			onclick="watermarkPreview('watermarkPreview.php?action=ajax','previewDiv')">
		<input type="button" value="Create Watermark images" id="button2"
			name="button2" onclick="submitWaterMark('watermark.php?action=create','progress')"></td>
	</tr>
	<tr bgcolor="#ffffff" width="89">
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	</form>
</table>
</div>
<div id="progress" class="progress"><div id="loading"class="loading"></div><div id="progress_background" class="progress_background"></div><div id="progress_percent" class="progress_percent"></div></div>
<div class="previewDiv" id="previewDiv"><img
	src="<?php
	echo DIR_WS_CATALOG_IMAGES . 'watermarkPreview/original/watermarkPreview.jpg';
	?>"></div>
<!-- body_eof //-->

<!-- footer //-->
<?php
require (DIR_WS_INCLUDES . 'footer.php');
?>
<!-- footer_eof //-->
<br>
</body>

</html>
<?php
}
require (DIR_WS_INCLUDES . 'application_bottom.php');
?>
