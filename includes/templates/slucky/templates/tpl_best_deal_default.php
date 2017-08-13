<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_products_new_default.php 2677 2005-12-24 22:30:12Z birdbrain $
 */
 if($linkMark = strpos($_SERVER['REQUEST_URI'],'?')){
    $cleanUrl = substr($_SERVER['REQUEST_URI'],0,$linkMark);
  }else{
    $cleanUrl = $_SERVER['REQUEST_URI'];
  }
  function cleanSameArg($clean){
    global $_GET,$cleanUrl;
    $newArg = array();
    reset($_GET);
    while (list($key, $value) = each($_GET)) {
      if($key != 'main_page' and $key != 'cPath' and $key != 'display' and $key != $clean){
        $newArg[] = $key.'='.$value;        
      }
    }
    if(sizeof($newArg)>0){
      return $cleanUrl.'?'.implode('&',$newArg);
    }else{
      return $cleanUrl;
    }
  }
  
  function cleanSameArgNoHtml($clean){
    global $_GET,$cleanUrl;
    $newArg = array();
    reset($_GET);
    while (list($key, $value) = each($_GET)) {
      if($key != 'main_page' and $key != 'cPath' and $key != 'display' and $key != $clean){
        $newArg[] = $key.'='.$value;        
      }
    }
    if(sizeof($newArg)>0){
      return '&'.implode('&',$newArg);
    }else{
      return FALSE;
    }
  }
  
  function postfixUrl(){
    global $_SERVER;
    $posbool = strpos($_SERVER['REQUEST_URI'],'?');
    return (is_int($posbool) ? substr($_SERVER['REQUEST_URI'],$posbool) : '');
  }
function cleanSameArg2($clean,$clean2){
    global $_GET,$cleanUrl;
    $newArg = array();
    reset($_GET);
    while (list($key, $value) = each($_GET)) {
      if($key != 'cPath' and $key != 'display' and $key != $clean and $key != $clean2){
        $newArg[] = $key.'='.$value;        
      }
    }
    if(sizeof($newArg)>0){
      return $cleanUrl.'?'.implode('&',$newArg);
    }else{
      return $cleanUrl;
    }
  }
  echo '<div class="minframe fl">';
     require('includes/modules/sideboxes/slucky/customers_say.php');
  echo '</div>';
?>


<div class="right_big_con">
<?php require('includes/modules/sideboxes/slucky/top_sellers_product.php'); ?>

<?php
  if ($best_deal_split->number_of_rows > 0) {
?>

<?php
  }
?>
<div id="filter_view" class="listhead mt10">
                        <ul class="tabs fleft">
                            <li class="fleft <?php if ($_GET['dicount']!=1) echo "active"; ?>">
                                <a href="<?php echo zen_href_link($current_page, '');?>">All Items(<em id="all_item_count"><?php echo $best_deal_split->number_of_rows; ?></em>)</a></li>
                            <li class="fleft <?php if ($_GET['dicount']==1) echo "active"; ?>">
                                <a href="<?php echo zen_href_link($current_page, '&dicount=1');?>">Discount(<em id="discount_item_count"><?php echo $best_deal_split->number_of_rows; ?></em>)</a></li>
                        </ul>
                        <div class="fleft mr10">
                            <span class="viewType fleft c00">View as
                                <a href="<?php echo zen_href_link($current_page,'&pagesize=36');?>" title="36">36</a>
                                <a href="<?php echo zen_href_link($current_page,'&pagesize=72');?>" class="ulink" title="72">72</a>
                            </span>
                            <a href="<?php echo zen_href_link($current_page,'&display='.$displayTypes.'-2');?>" title="Grid View" class="iconvlist"></a>
                            <a href="<?php echo zen_href_link($current_page,'&display='.$displayTypes.'-1');?>" title="List View" class="iconvimg"></a>
                        </div>
                        <div class="fright list_sort">
                            <span class="fleft">Sort by: </span>
                            <div class="fleft" id="list_sort">
                            <?php  switch($_GET['productsort']){
								      case 9:
									  $staa_name = 'Most Reviews';
									  break;
									  case 3:
									  $staa_name = 'Lowest Price';
									  break;
									  case 4:
									  $staa_name = 'Highest Price';
									  break;
									  case 5:
									  $staa_name = 'New Arrivals';
									  break;
									  default:
									  $staa_name = 'Top Sellers';
							} ?>
                                <a href="javascript:void(0);" class="cf50"><em><?php echo $staa_name; ?></em><span></span></a>
                                <div style="right: 0px; left: 0px; display: none;" class="sortByMenu">
                                    <a href="<?php echo zen_href_link($current_page,'&productsort=1');?>" class="cf50">Top Sellers</a>
                                    <a href="<?php echo zen_href_link($current_page,'&productsort=5');?>" class="cf50">New Arrivals</a>
                                    <a href="<?php echo zen_href_link($current_page,'&productsort=9');?>" class="cf50">Most Reviews</a>
                                    <a href="<?php echo zen_href_link($current_page,'&productsort=4');?>" class="cf50">Highest Price</a>
                                    <a href="<?php echo zen_href_link($current_page,'&productsort=3');?>" class="cf50">Lowest Price</a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
					
					<div class="allborder1">

  <?php
  $listTypes = isset($_GET['display'])?$listTypes:2;
  switch($listTypes){
      case '1':
        require($template->get_template_dir('tpl_tabular_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_tabular_display.php');
      break;
      case '2':
        require($template->get_template_dir('tpl_grid_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_grid_display.php');
      break;
      case '3':
        require($template->get_template_dir('tpl_gallery_display.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_gallery_display.php');
      break;
    }
    ?>


<?php if ($best_deal_split->number_of_rows > 0) {
?>

	</div>
	<div class="pagebar margin_t g_t_c white_bg"><div class="split_pages"><span>Pages: </span><p class="listspan"><?php echo TEXT_RESULT_PAGE . ' ' . $best_deal_split->display_links_version2(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></p></div></div>
<?php
  }
?>
<?php
// only end form if form is created
    if ($show_top_submit_button == true or $show_bottom_submit_button == true) {
?>
</form>
<?php } // end if form is made ?>
</div>
    <script type="text/javascript">

        jQuery(function () {

            jQuery("#list_sort").hover(

		function () {

		    jQuery("#list_sort > a").addClass("active");

		    jQuery("#list_sort .sortByMenu").show();

		},

		function () {

		    jQuery("#list_sort > a").removeClass("active");

		    jQuery("#list_sort .sortByMenu").hide();

		});

            jQuery("#dsmenu > li").each(function () {

                if (jQuery(this).children("ul").length != 0) {

                    jQuery(this).children("span").toggle(function () {

                        jQuery(this).parent("li").addClass("expand");

                        jQuery(this).parent().contents("ul").show();

                    }, function () {

                        jQuery(this).parent("li").removeClass("expand");

                        jQuery(this).parent().contents("ul").hide();

                    })

                }

            });

            jQuery("#search_list_more").toggle(

			function () {

			    jQuery(this).addClass("un");

			    jQuery(".search_list_box:gt(1)").show();

			},

			function () {

			    jQuery(this).removeClass("un");

			    jQuery(".search_list_box:gt(1)").hide();

			}

		);

            jQuery(".search_list_t_title_ico").toggle(function () {

                jQuery(this).addClass("un");

                jQuery(".search_list_box").hide();

            }

		, function () {

		    jQuery(this).removeClass("un");

		    jQuery(".search_list_box").show();

		});

            jQuery(".search_list_box_r").each(function () {

                if (jQuery(this).children(".classify").length > 6) {

                    jQuery(this).children(".classify:gt(5)").hide();

                    jQuery(this).children(".catelist_more").show();

                };

            });

            jQuery(".catelist_more").click(function () {

                jQuery(this).parent().children(".classify:gt(5)").toggle("fast");

            });

        })

    </script>
