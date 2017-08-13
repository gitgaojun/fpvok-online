<?php

/**

 * Common Template - tpl_box_default_left.php

 *

 * @package templateSystem

 * @copyright Copyright 2003-2005 Zen Cart Development Team

 * @copyright Portions Copyright 2003 osCommerce

 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0

 * @version $Id: tpl_box_default_left.php 2975 2006-02-05 19:33:51Z birdbrain $

 */



// choose box images based on box position

  if ($title_link) {

    $title = '<a href="' . zen_href_link($title_link) . '">' . $title . BOX_HEADING_LINKS . '</a>';

  }

//

?>  <table width="100%" border="0" height="5">

  <tr><td></td>

  </tr>

</table>

	<link type="text/css" rel="stylesheet" href="images/global.css">



    <link type="text/css" rel="stylesheet" href="images/list.css">



 



       <div class="revieweditems mt10">

 



      <?php $st_catlog = zen_get_catalog_parent($current_category_id); ?>   

      <?php 

$catalog_id = "select categories_name,categories_id from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$st_catlog . "'and language_id = '" . (int)$_SESSION['languages_id'] . "'";

$parent_categories = $db->Execute($catalog_id);

if($parent_categories->RecordCount()>0){

?>        


        <div class="revieweditems_h">

            <h5 id="parent_categoryname" class="fleft"><?php echo $parent_categories->fields['categories_name']; ?></h5>

        </div>

        <div id="dsav">

            <ul id="dsmenu">

<?php 

$catalog_id2 = "select cd.categories_name,cd.categories_id from " . TABLE_CATEGORIES_DESCRIPTION . " cd," . TABLE_CATEGORIES . " c where c.categories_id = cd.categories_id and c.parent_id = '" . (int)$st_catlog . "'and language_id = '" . (int)$_SESSION['languages_id'] . "'";

$parent_categories2 = $db->Execute($catalog_id2);

if($parent_categories2->RecordCount()>0){

while (!$parent_categories2->EOF) {

   $catalog_id3 = "select cd.categories_name,cd.categories_id from " . TABLE_CATEGORIES_DESCRIPTION . " cd," . TABLE_CATEGORIES . " c where c.categories_id = cd.categories_id and cd.language_id = '" . (int)$_SESSION['languages_id'] . "' and c.parent_id = '" . (int)$parent_categories2->fields['categories_id'] . "'";

$parent_categories3 = $db->Execute($catalog_id3);

$str_num = $parent_categories3->RecordCount();

if($str_num >0){

	$str_cla = '';

}else{

	$str_cla = 'nochildren';

}



?>

                <li class="<?php echo $str_cla; ?>">

                    <span></span>

                    <?php echo '<a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath=' . (int)$parent_categories2->fields['categories_id']) . '">'.$parent_categories2->fields['categories_name'].'</a>'; ?>

                    <ul style="display: none;" class="hide">

                    <?php 

					if($parent_categories3->RecordCount()>0){

                    while (!$parent_categories3->EOF) {

					?>

                        <li>

                            <?php echo '<a  href="' . zen_href_link(FILENAME_DEFAULT, 'cPath=' . (int)$parent_categories3->fields['categories_id']) . '">'.$parent_categories3->fields['categories_name'].'</a>'; ?></li>

                      <?php 

                       $parent_categories3->MoveNext();

                           }

                          }?>

                    </ul>

                </li>

<?php 

 $parent_categories2->MoveNext();

  }

  }?>

            </ul>

        </div>

        <?php }?> 

 




    </div>

    <!--mian end-->

   

    <!--footer-->



    









    <script type="text/javascript">

        $(function () {

            $("#list_sort").hover(

		function () {

		    $("#list_sort > a").addClass("active");

		    $("#list_sort .sortByMenu").show();

		},

		function () {

		    $("#list_sort > a").removeClass("active");

		    $("#list_sort .sortByMenu").hide();

		});

            $("#dsmenu > li").each(function () {

                if ($(this).children("ul").length != 0) {

                    $(this).children("span").toggle(function () {

                        $(this).parent("li").addClass("expand");

                        $(this).parent().contents("ul").show();

                    }, function () {

                        $(this).parent("li").removeClass("expand");

                        $(this).parent().contents("ul").hide();

                    })

                }

            });

            $("#search_list_more").toggle(

			function () {

			    $(this).addClass("un");

			    $(".search_list_box:gt(1)").show();

			},

			function () {

			    $(this).removeClass("un");

			    $(".search_list_box:gt(1)").hide();

			}

		);

            $(".search_list_t_title_ico").toggle(function () {

                $(this).addClass("un");

                $(".search_list_box").hide();

            }

		, function () {

		    $(this).removeClass("un");

		    $(".search_list_box").show();

		});

            $(".search_list_box_r").each(function () {

                if ($(this).children(".classify").length > 6) {

                    $(this).children(".classify:gt(5)").hide();

                    $(this).children(".catelist_more").show();

                };

            });

            $(".catelist_more").click(function () {

                $(this).parent().children(".classify:gt(5)").toggle("fast");

            });

        })

    </script>



<!--// eof: box_categories //-->

