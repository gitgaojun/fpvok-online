<?php
//
//  left Buyer Guide addBy shOwQ
//
    $customersSay = $db->Execute("SELECT r1.`customers_name`, r.`reviews_title`, r.`reviews_id`,p.products_image,p.products_id FROM reviews_description r, reviews r1, products p
WHERE r1.reviews_id=r.reviews_id AND r1.`status` =1 AND p.products_id=r1.products_id ORDER BY date_added DESC limit 14;");
    require($template->get_template_dir('tpl_customers_say.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_customers_say.php');
    $title = BOX_HEADING_CUSTOMERS_SAY;
    $left_corner = false;
    $right_corner = false;
    $right_arrow = false;
    $title_link = false;
    require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/tpl_box_customers_say_left.php');
?>