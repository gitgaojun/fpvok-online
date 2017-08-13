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

<?php 

$products_image = $specials_add->fields['products_image'];
?>
    <?php $img_explod = explode(",",$products_image);?>

                    <div id="preview" style="width: 382px;">
                        <div class="jqzoom" id="spec_n<?php echo $i_add; ?>" style="width: 380px; height:294px;"><img alt="Durable T11 LED Car Lamp (White)" jqimg="images/<?php echo str_replace("s/","v/",$img_explod[0]); ?>" src="images/<?php echo str_replace("s/","v/",$img_explod[0]); ?>" height="294" width="380"></div>
                        <div id="spec_n5" style="width: 380px;">
                            <div class="spec_left"></div>
                            <div id="spec_list<?php echo $i_add; ?>">
                                <ul style="width: 380px; overflow: hidden;" class="list_h">
                                   <?php   
  for($i = 0 ;$i <count($img_explod);$i++){
  ?> <li><img jqimg2="images/<?php echo str_replace("s/","v/",$img_explod[$i]); ?>" jqimg="images/<?php echo str_replace("s/","v/",$img_explod[$i]); ?>" src="images/<?php echo $img_explod[$i]; ?>" style="border:1px solid #D5D6DB;"></li><?php }?></ul>
                            </div>
                            <div class="spec_right"> </div>
                        </div>
                    </div>
             
