<?php
class validcode
{

	private $picHeight;//The height of the picture
	private $picWidth;//The width of the picture
	private $border;//If the picture have the border
	private $digit;//How many valid code
	private $fontSize;
	private $alpha;//One content of the valid code
	private $number;//Other content of the valid code
	public function __construct()
	{
		$this->digit=4;
		$this->picHeight=22;
		$this->picWidth=$this->digit*15;
		$this->border=1;//1 have border 0 no boder
		$this->fontSize=30;
		$this->alpha='';//"abcdefghijkmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWSYZ";
		$this->number="0123456789";
		srand((double)microtime()*1000000);//Initialize random number
		//header("Content-type:image/png");
	}
	function CreateValidPic()
	{
		$im=imagecreate($this->picWidth,$this->picHeight);//Create picture
		$bgColor=imagecolorallocate($im,255,255,255);//Set background color
		imagefill($im,0,0,$bgColor);//Fill background color
		if ($this->border)
		{
			$black=imagecolorallocate($im,0,0,0);//Set the color of the border
			imagerectangle($im,0,0,$this->picWidth-1,$this->picHeight-1,$black);//Draw border
		}
		//Create random number
		$randCode="";
		for ($i=0;$i<$this->digit;$i++)
		{
			//$charOrNum=mt_rand(0,1);
			//$str=$charOrNum?$this->alpha:$this->number;
			$str=$this->number;
			$which=mt_rand(0,strlen($str)-1);
			$getCode=substr($str,$which,1);
			$charColor=imagecolorallocate($im,mt_rand(0,100),mt_rand(0,100),mt_rand(0,100));
			$position=!$i?4:$i*15+4;
			imagechar($im,$this->fontSize,$position,3,$getCode,$charColor);
			$randCode.=$getCode;
		}
		session_start();
		$_SESSION['randCode']=$randCode;//Save the random code in session
		//Create disturbance factor
		/*for ($j=0;$j<5;$j++)//Add the disturbance line
		{
			$distColor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
			imagearc($im,mt_rand(-5,$this->picWidth),mt_rand(-5,$this->picHeight),mt_rand(20,300),mt_rand(20,200),55,44,$distColor);
		}*/
		for ($b=0;$b<$this->digit*10;$b++)//Add the disturbance background point
		{
			$distBgColor=imagecolorallocate($im,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
			imagesetpixel($im,mt_rand(0,$this->picWidth),mt_rand(0,$this->picHeight),$distBgColor);
		}
		imagepng($im,DIR_WS_IMAGES.'validcode.png');
		imagedestroy($im);
	}
}
?>