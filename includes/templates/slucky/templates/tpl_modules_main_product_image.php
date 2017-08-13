<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_main_product_image.php 3208 2006-03-19 16:48:57Z birdbrain $
 */
?>

<?php require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_MAIN_PRODUCT_IMAGE)); 
	if($product_baifen == 0){
	$strm3 = ' ';
	}else{
	$strm3 = '<em class="iconDiscount2">'.$product_baifen.'</em>';
	}

?>
<link rel="stylesheet" type="text/css" href="js/product.css">
    <script type="text/javascript" src="js/detail_lib.js"></script>
    <script type="text/javascript" src="js/product.js"></script>
    <?php $img_explod = explode(",",$products_image);?>
<div class="detail_info w980">
                <div class="detail_info_left fleft" id="hpdeal_b1_c1">
                    <div id="preview">
                        <div class="jqzoom" id="spec_n1"><img alt="Durable T11 LED Car Lamp (White)" jqimg="images/<?php echo str_replace("s/","v/",$img_explod[0]); ?>" src="images/<?php echo str_replace("s/","v/",$img_explod[0]); ?>" height="450" width="450"></div>
                        <div id="spec_n5">
                            <div id="spec_left">
                            </div>
                            <div id="spec_list">
                                <ul style="width: 330px; overflow: hidden;" class="list_h">
                                   <?php   
  for($i = 0 ;$i <count($img_explod);$i++){
  ?> <li><img jqimg2="images/<?php echo str_replace("s/","v/",$img_explod[$i]); ?>" jqimg="images/<?php echo str_replace("s/","v/",$img_explod[$i]); ?>" src="images/<?php echo $img_explod[$i]; ?>" style="border:1px solid #D5D6DB;"></li><?php }?></ul>
                            </div>
                            <div id="spec_right">
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
