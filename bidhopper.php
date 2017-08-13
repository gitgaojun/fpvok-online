<?
## BidHopper v2.03 -> 03/27/2008 for ZenCart Software (www.zencart.com)
## (c) Copyright 2007-2008 Numinix Technology http://www.numinix.com

require('includes/application_top.php');
?>
<HTML>
<HEAD>
<TITLE>BidHopper Dynalist Generator v2.03 for ZenCart Site</TITLE>
</HEAD>
<BODY>
BidHopper Dynalist v2.03 for ZenCart<BR>
<? 
	####################################################################################
	###### ONLY CHANGE THE FOLLOWING VARIABLES TO SET YOUR SITES PATHS IF NEEDED: ######
	####################################################################################

	$mysiteurl  = HTTP_SERVER . DIR_WS_CATALOG;    // This is the FULL URL to your Sites Cart Location
	$mysiteimgs = $mysiteurl . DIR_WS_IMAGES;    // This is FULL URL to your sites Cart IMAGES Location
	$magic_seo_urls = false; 		// Set to true to activate Magic SEO URLs add-on
	
	####################################################################################
	######## DO NOT CHANGE ANY THING ELSE BELOW THIS LINE FOR PROPER OPERATION! ########
	####################################################################################

$products_query = "SELECT distinct(p.products_id), p.products_image, p.products_price, p.products_status, pd.products_name 
									 FROM " . TABLE_PRODUCTS . " p
									 	LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON (p.products_id = pd.products_id) 
									 WHERE products_status=1
                   GROUP BY p.products_id 
									 ORDER BY products_id ASC";
									 
$products = $db->Execute($products_query);

if($products == true) {
	$bidhopper_url = HTTP_SERVER;
	while (!$products->EOF) { 
		$bidhopper_id = $products->fields['products_id'];
		$bidhopper_price = $products->fields['products_price'];
		$bidhopper_image = $products->fields['products_image'];
		
		if ($magic_seo_urls == true) {
			require_once(DIR_WS_CLASSES . 'msu_ao.php');
		  include(DIR_WS_INCLUDES . 'modules/msu_ao_1.php');
		}
		
		$item_type="classified"; echo "<type>$item_type"; 
		if ($magic_seo_urls == true) {
			include(DIR_WS_INCLUDES . 'modules/msu_ao_2.php');
			echo "<url>$link";
		} else {
			$bidhopper_url="$mysiteurl"; echo "<url>$bidhopper_url"; echo "index.php?main_page=product_info&products_id=$bidhopper_id";
		}
	
		$text = $products->fields['products_name'];
		$text = html_entity_decode(strip_tags($text));
		$replacethis = "&#039;";
		$withthis    = "'";
		$text = str_replace($replacethis, $withthis, $text);
		$pattern="[^a-zA-Z0-9\.'$&-]";
		$replace=" ";
		$text=ereg_replace($pattern,$replace,$text);
		$text=preg_replace('/\s\s+/', ' ', $text);
		$productname=trim($text);
		
		echo "<ttl>$productname";
		$rest = substr("$bidhopper_price", 0, -2);  // This removes the last two 0's from the price field in the DB
		echo "<price>$rest";
		echo "<close>Never";
		echo "<seller>Self";
	
		if($bidhopper_image != ''){
		echo "<image>$mysiteimgs"; echo "$bidhopper_image";
		} else {
		echo "<image>http://www.bidhopper.com/images/noimage.jpg";
		}
		echo "<BR>";
		
		$products->MoveNext();
	}
} 
?>

</BODY>
</HTML>