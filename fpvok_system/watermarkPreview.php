<?php 
require ('includes/application_top.php');
if (isset($_GET['action']) && $_GET['action'] == 'ajax')
{
	$groundImage = DIR_FS_CATALOG_IMAGES.'watermarkPreview/original/watermarkPreview.jpg';
	$destination_name = DIR_FS_CATALOG_IMAGES.'watermarkPreview/watermark/watermarkPreview.jpg';
	$watermarkImage = zen_db_prepare_input($_POST['watermarkImage']);
	$watermarkText = zen_db_prepare_input($_POST['watermarkText']);
	$fontColor = '#'.zen_db_prepare_input($_POST['fontColor']);
	$fontFamily = zen_db_prepare_input($_POST['fontFamily']);
	$fontSize = zen_db_prepare_input($_POST['fontSize']);
	$alpha = zen_db_prepare_input($_POST['alpha']);
	$shadow = zen_db_prepare_input($_POST['shadow']);
	$watermarkPosition = zen_db_prepare_input($_POST['watermarkPosition']);
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
		$checkFont=false;
		switch ($fontFamily)
		{
			
			case $fontFamily==$fontFamilyName :
				{
					$font = DIR_FS_CATALOG . 'fonts/'.$fontFamilyFile;
					$checkFont=true;
					break;
				}			
			default :
				{
					$font = DIR_FS_CATALOG . 'fonts/ariblk.ttf';
					break;
				}
		}
		if($checkFont)
		{
			break;
		}
	}
	$watermark = new watermark($watermarkPosition, $watermarkImage, $alpha, $watermarkText, $fontSize, $fontColor, $font);
	$watermark->makeImage($groundImage, $destination_name);
	header   ( "Expires:   Mon,   26   Jul   1997   05:00:00   GMT "); 
	header   ( "Last-Modified:   "   .   gmdate( "D,   d   M   Y   H:i:s ")   .   "   GMT "); 
	header   ( "Cache-Control:   no-cache,   must-revalidate "); 
	header("Pragma: no-cache");
}
$randNumber = rand(0,999999999).date('YmdHis');
?>
<html>
<head>
<META HTTP-EQUIV="pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache, must-revalidate">
<META HTTP-EQUIV="expires" CONTENT="Wed, 26 Feb 1997 08:21:57 GMT">
</head>
<body>
<img src="<?php echo DIR_WS_CATALOG_IMAGES.'watermarkPreview/watermark/watermarkPreview.jpg?preview='.$randNumber;?>">
</body>
</html>
