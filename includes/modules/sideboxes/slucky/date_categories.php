<?php
/**
 * categories sidebox - prepares content for the main categories sidebox
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: categories.php 2718 2005-12-28 06:42:39Z drbyte $
 */
		
    $row = 0;
    $priceListArray = array();
    $priceList = array();
	$data_str="";
	$sql="SELECT count(products_id) as counts ,DATE_FORMAT(`products_date_added`,'%Y-%m-%d') as products_date_added,DATE_FORMAT(`products_date_added`,'%m/%d/%Y') as names FROM `products` group by DATE_FORMAT(`products_date_added`,'%Y-%m-%d')  order by  products_date_added desc LIMIT 15";
	$data_new = $db->Execute($sql);
	
	while (!$data_new->EOF) {
	    
		$data_str.= '<li><a class="b" style="font-weight: normal;" href="' . zen_href_link(FILENAME_PRODUCTS_NEW, 'date=' .$data_new->fields['products_date_added']) .'">'.$data_new->fields['names'].'('.$data_new->fields['counts']. ')</strong></a></li> ';
		
	
	 $data_new->MoveNext();
	}
	
// don't build a tree when no categories
    $date_year = date('Y');
	$date_month = date('m');
	$date_day = date('d');
	$date_1 = ($date_day-7)>0?$date_month.'-'.($date_day-7):($date_month-1).'-'.($date_day+23);
	$date_2 = ($date_day-14)>0?$date_month.'-'.($date_day-14):($date_month-1).'-'.($date_day+16);
	$date_3 = ($date_day-21)>0?$date_month.'-'.($date_day-21):($date_month-1).'-'.($date_day+9);
	$date_4 = ($date_month-1).'-'.($date_day);
	
    echo '<div class="revieweditems mt10">';
    echo ' <div class="revieweditems_h"><h1 class="fleft"> Browse By Release Date</h1></div>';
	echo '<div class="release_dates" id="date_content">';
    echo '<ul class="dates">';
	echo $data_str;
	echo '<div class="clear"> </div>';
	echo '<li> <a href="/products_new.html" class=""> &lt;&lt;Back</a></li>';
    echo '</ul>';
	echo '<br class="clear" />';
	echo '<ul class="weeks">';
	echo '<li><a href="'.zen_href_link(FILENAME_PRODUCTS_NEW, 'date='.$date_year.'-'.$date_1).'&udate=1"  class="">Last 1 Week</a></li>';
	echo '<li><a href="'.zen_href_link(FILENAME_PRODUCTS_NEW, 'date='.$date_year.'-'.$date_2).'&udate=1"  class="">Last 2 Weeks</a></li>';
	echo '<li><a href="'.zen_href_link(FILENAME_PRODUCTS_NEW, 'date='.$date_year.'-'.$date_3).'&udate=1"  class="">Last 3 Weeks</a></li>';
	echo '<li><a href="'.zen_href_link(FILENAME_PRODUCTS_NEW, 'date='.$date_year.'-'.$date_4).'&udate=1"  class="">Last 1 Month</a></li>';
	echo '</div>';
	
    echo '</div>';

	echo '<br class="clear" />';
	echo '<div class="margin_t"></div>';
?>
