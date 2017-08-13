<?php
/**
 * Common Template - tpl_box_default_single.php
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_box_default_single.php 2975 2006-02-05 19:33:51Z birdbrain $
 */

// choose box images based on box position
//
if($this_is_home_page){
?>
<style>
#jslider{width:300px;height:280px;}
#jslider ul{list-style:none;}
#jslider .JQ-content-box{ overflow: hidden; width:300px; height:280px;position:relative}
#jslider .JQ-slide-content{left:0;top:0;position:absolute}
#jslider .JQ-slide-content li{zoom:1; overflow:hidden;height: 280px; vertical-align:text-top}
#jslider img { display:block;border:0;}
#jslider .JQ-slide-nav {
    bottom: 10px;
    height: 18px;
    left: 200px;
    padding-top: 2px;
    position: absolute;
}
#jslider .JQ-slide-nav li {background-color:#FAFAFA;border:1px solid #CCCCCC;color:#999999;cursor:pointer;float:left;font-size:12px;height:16px;line-height:16px;margin-left:3px;text-align:center;width:16px;}
#jslider .JQ-slide-nav li.on { background-color:#EFEFEF;border-color:#666666;color:#666666;font-weight:bold;height:18px;line-height:18px;margin-top:-2px;width:18px;}
#jslider .JQ-slide-nav li img {display:block}

#dsmjb{ overflow:auto}
#dsmjb .JQ-content-box{width:191px;height:310px;overflow:hidden}
#dsmjb .JQ-slide-content{}
#dsmjb .JQ-slide-content li{height:76px;padding-left:2px;}
</style>
<script type="text/javascript" src="js/jq.slide.js"></script>
<script type="text/javascript">

jQuery(document).ready(function(){

jQuery("#jslider").Slide({effect : "scroolY",speed : "normal",timer : 3000});
})
</script>
<!--// bof: <?php echo $box_id; ?> //-->
<div class="fl relative margin_t">
<div id="jslider">
<div class="JQ-content-box">
<ul class="JQ-slide-content">
<?php  
$xml = simplexml_load_file('flash/promotion2.xml'); 
$sql=''; $i=1;
foreach($xml->mysee->item as $a){
$classs= $i==1 ?'on':'';
$sql.='<li class="'.$classs.'">'.$i.'</li>';
$i++;
?>
<li><a target="_blank" title="<?php echo $a['title'] ?>" href="<?php echo $a['url'] ?>"><img border="0" alt="<?php echo $a['title'] ?>" src="<?php echo $a['img'] ?>"></a></li>
<?php }?>
</ul>
<ul class="JQ-slide-nav">
<?php echo $sql ?>
</ul>
</div></div>
</div>

<br class="clear">
<!--// eof: <?php echo $box_id; ?> //-->
<?php } ?>
