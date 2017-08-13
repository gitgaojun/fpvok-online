<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2010 fpvok Gold                          |
// |                                                                      |   
// | http://www.zen-cart.com/index.php                                    |   
// |                                                                      |   
// | parameters														  |
// | $groundImage the image need to add watermark;						  |
// | $waterPos Position of watermark,this has 10 status，0 is randomize;  |
// | 1:top left,2:top center,3:top right;								  |
// | 4:middle left,5:middle center,6:middle right;						  |
// | 7:bottom left,8:bottom center,9:bottom right;						  |
// | $waterImage This must be jpg,png,gif								  |
// | $waterText font watermark,support ASCII code but not chinese,		  |
// | $textFont font size,												  |
// | $textColor font color，default color #FF0000(red)；					  |
// | Note：Support GD 2.0,Support FreeType,GIF Read,GIF Create,JPG,PNG  	  |
// | Don't use $waterImage and $waterText at the same time,				  |
// | priority $waterImage,when $waterImage is used,					  	  |
// | $waterString,$stringFont,$stringColor are unavailable,			  	  |  
// +----------------------------------------------------------------------+
//  $Id: watermark.php $
//


class watermark
{
	private $filesArray;
	private $waterPos;
	private $waterImage;
	private $waterText;
	private $fontSize;
	private $textColor;
	private $wateralpha;
	private $error_message;
	private $font;
	private $shadow;
	public $message;
	private $images_array;
	
	// class constructor
	function __construct($waterPos = 0, $waterImage = "", $wateralpha = 65, $waterText = "", $fontSize = 5, $textColor = "#FF0000", $font = null, $shadow = 1)
	{
		$this->waterPos = $waterPos;
		$this->waterPos = $waterPos;
		$this->waterText = $waterText;
		$this->fontSize = $fontSize;
		$this->textColor = $textColor;
		$this->wateralpha = $wateralpha;
		$this->waterImage = $waterImage;
		$this->error_message = '';
		$this->font = $font;
		$this->shadow = $shadow;
		$this->message = array();
	}
	
	function readImagesDir($originalDir)
	{
		try
		{
			$originalDir = substr($originalDir, -1) == '/' ? $originalDir : $originalDir . '/';
			$originalDir = substr($originalDir, -1) == '\\' ? str_replace('\\', '/', $originalDir) : $originalDir;
			$dir = @dir($originalDir);
			while ($file = $dir->read())
			{
				if ($file != '.' && $file != '..')
				{
					if (!is_dir($originalDir . $file))
					{
						$this->filesArray['filePath'][] = $dir->path;
						$this->filesArray['fileName'][] = $file;
					}
					else
					{
						$this->readImagesDir($originalDir . $file);
					}
				}
			}
			return $this->filesArray;
		} catch (Exception $e)
		{
			echo $e->getMessage();
		}
	}
	
	function startCreateImage($originalDir, $finalDir, $imageIndex)
	{
		$finalDir = substr($finalDir, -1) == '/' ? $finalDir : $finalDir . '/';
		$finalDir = substr($finalDir, -1) == '\\' ? str_replace('\\', '/', $finalDir) : $finalDir;
		$this->images_array = count($this->images_array) > 0 ? $this->images_array : $this->readImagesDir($originalDir);
		$imagesArr = $this->images_array;
		//echo"<pre>";print_r($imagesArr);echo "</pre>";
		//exit;
		if (isset($imagesArr['fileName']))
		{
			foreach ($imagesArr['fileName'] as $fi => $fName)
			{				
				if ($fi == $imageIndex)
				{
					
					$groundImage = $imagesArr['filePath'][$fi] . $fName;
					$destination_name = $finalDir !== '' ? $finalDir . substr($imagesArr['filePath'][$fi], strlen($originalDir)) . $fName : $originalDir . 'noDirectory/' . $fName;
					$this->io_makeFileDir($destination_name);
					
					$createFlag = @$this->makeImage($groundImage, $destination_name);
					$_SESSION['fileIndex']=$imageIndex;
					if (!$createFlag)
					{
						$this->message['error'][] = $this->error_message;
						//echo $this->error_message . '<br>';
					}
				}
			}
		}
		else
		{
			$this->message['warning'][] = 'No images dir :' . $originalDir;
			//echo 'No images dir :' . $originalDir . '<br>';
		}
	}
	
	function getImagesNumber()
	{
		if (count($this->images_array) > 0)
		{
			if (isset($this->images_array['fileName']))
			{
				return count($this->images_array['fileName']);
			}
			else
			{
				return 0;
			}
		}
		else
		{
			return 0;
		}
	}
	function makeImage($groundImage, $destination_name)
	{
		$isWaterImage = FALSE;
		$formatMsg = "<p>Sorry,please format the image to jpg,png,gif.Image name:" . $groundImage . '</p>';
		//read watermark image
		if (!empty($this->waterImage) && file_exists($this->waterImage))
		{
			$isWaterImage = TRUE;
			$water_info = getimagesize($this->waterImage);
			$water_w = $water_info[0]; //Width of watermark image
			$water_h = $water_info[1]; //Height of watermark image
			switch ($water_info[2]) //Format of watermark image
			{
				case 1 :
					$water_im = imagecreatefromgif($this->waterImage);
					break;
				case 2 :
					$water_im = imagecreatefromjpeg($this->waterImage);
					break;
				case 3 :
					$water_im = imagecreatefrompng($this->waterImage);
					break;
				default :
					$this->error_message = $formatMsg;
					return false;
			}
		}
		//read the ground image
		if (!empty($groundImage) && file_exists($groundImage))
		{
			$ground_info = getimagesize($groundImage);
			$ground_w = $ground_info[0]; //Width of ground image
			$ground_h = $ground_info[1]; //Height of ground image
			switch ($ground_info[2]) //Format of ground image
			{
				case 1 :
					$ground_im = imagecreatefromgif($groundImage);
					break;
				case 2 :
					$ground_im = imagecreatefromjpeg($groundImage);
					break;
				case 3 :
					$ground_im = imagecreatefrompng($groundImage);
					break;
				default :
					$this->error_message = $formatMsg;
					return false;
			}
		}
		else
		{
			return false;
		}
		//The position of watermark
		if ($isWaterImage) //image watermark
		{
			$w = $water_w;
			$h = $water_h;
			$label = "image";
		}
		else //font watermark
		{
			$temp = imagettfbbox(ceil($this->fontSize * 2.5), 0, $this->font, $this->waterText); //Rang of font text
			$w = $temp[2] - $temp[6];
			$h = $temp[3] - $temp[7];
			unset($temp);
			$label = "font area";
		}
		/*if (($ground_w < $w) || ($ground_h < $h))
		{
			$this->error_message .= "<p>The size of the image is small then " . $label . "!file name:".$groundImage.'</p>';
			return false;
		}*/
		switch ($this->waterPos)
		{
			case 0 : //randomize
				$posX = rand(0, ($ground_w - $w));
				$posY = rand(0, ($ground_h - $h));
				break;
			case 1 : //top left
				$posX = 0;
				$posY = 0;
				break;
			case 2 : //top center
				$posX = ($ground_w - $w) / 2;
				$posY = 0;
				break;
			case 3 : //top right
				$posX = $ground_w - $w;
				$posY = 0;
				break;
			case 4 : //middle left
				$posX = 0;
				$posY = ($ground_h - $h) / 2;
				break;
			case 5 : //middle center
				$posX = ($ground_w - $w) / 2;
				$posY = ($ground_h - $h) / 2;
				break;
			case 6 : //middle right
				$posX = $ground_w - $w;
				$posY = ($ground_h - $h) / 2;
				break;
			case 7 : //bottom left
				$posX = 0;
				$posY = $ground_h - $h;
				break;
			case 8 : //bottom center
				$posX = ($ground_w - $w) / 2;
				$posY = $ground_h - $h;
				break;
			case 9 : //bottom right
				$posX = $ground_w - $w;
				$posY = $ground_h - $h;
				break;
			default : //randomize
				$posX = rand(0, ($ground_w - $w));
				$posY = rand(0, ($ground_h - $h));
				break;
		}
		$im_s = @imagecreatetruecolor($ground_w, $ground_h); //Create model image
		$white = imagecolorallocate($im_s, 255, 255, 255);
		imagefill($im_s, 0, 0, $white); //Set the background color
		

		imagecopy($im_s, $ground_im, 0, 0, 0, 0, $ground_w, $ground_w); //Copy gound image to model image
		

		if (!$isWaterImage)
		{
			$font_img = @imagecreatetruecolor($w, $h); //Create font image
			$white = imagecolorallocatealpha($font_img, 255, 255, 255, 100);
			imagefill($font_img, 0, 0, $white); //Set the background color
			imagecolortransparent($font_img, $white);
		}
		
		//image color mode
		imagealphablending($ground_im, true);
		if ($isWaterImage) //image watermark
		{
			imagecopymerge($im_s, $water_im, $posX, $posY, 0, 0, $water_w, $water_h, $this->wateralpha); //copy to watermark image to model image
		}
		else //font watermark
		{
			if (!empty($this->textColor) && (strlen($this->textColor) == 7))
			{
				$R = hexdec(substr($this->textColor, 1, 2));
				$G = hexdec(substr($this->textColor, 3, 2));
				$B = hexdec(substr($this->textColor, 5));
			}
			else
			{
				$this->error_message = "Invalid font color format.";
				return false;
			}
			//imagestring($font_img, $this->fontSize, 0, 0, $this->waterText, imagecolorallocate($font_img, $R, $G, $B));
			if ($this->shadow)
			{
				imagettftext($font_img, $this->fontSize, 0, $this->fontSize * 1.5 + 1, $this->fontSize * 2 + 1, imagecolorallocate($font_img, $R, $G, $B), $this->font, $this->waterText);
			}
			imagettftext($font_img, $this->fontSize, 0, $this->fontSize * 1.5, $this->fontSize * 2, imagecolorallocate($font_img, $R, $G, $B), $this->font, $this->waterText);
			imagecopymerge($im_s, $font_img, $posX, $posY, 0, 0, $w, $h, $this->wateralpha); //copy to watermark image to model image
		}
		//Create watermark image		
		$destinationFinal = $destination_name == '' ? $groundImage : $destination_name;
		@unlink($destinationFinal);
		switch ($ground_info[2]) //Get the format of ground image
		{
			case 1 :
				imagegif($im_s, $destinationFinal);
				break;
			case 2 :
				imagejpeg($im_s, $destinationFinal);
				break;
			case 3 :
				imagepng($im_s, $destinationFinal);
				break;
			default :
				$this->error_message = $formatMsg;
				return false;
		}
		//destroy
		if (isset($water_info))
			unset($water_info);
		if (isset($water_im))
			imagedestroy($water_im);
		unset($ground_info);
		imagedestroy($ground_im);
		imagedestroy($im_s);
		return true;
	}
	
	/**
	 * Create the directory needed for the given file
	 *
	 * @author  Andreas Gohr <andi@splitbrain.org>
	 * @author  Tim Kroeger <tim@breakmyzencart.com>
	 */
	function io_makeFileDir($file)
	{
		global $messageStack;
		global $bmzConf;
		
		$dir = dirname($file);
		$dmask = $bmzConf['dmask'];
		umask($dmask);
		if (!is_dir($dir))
		{
			io_mkdir_p($dir) || $messageStack->add("Creating directory $dir failed", "error");
		}
		umask($bmzConf['umask']);
	}
}
?>
