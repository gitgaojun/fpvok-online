<?php
/*

>>> Rabatt ab xxx Bestellwert 1.0
Modifiziert von Maleborg f�r Zencart

Weitere Credits
<<<<<<< ot_lev_discount.php
  $Id: ot_lev_discount.php,v 1.0 2002/04/08 01:13:43 hpdl Exp $
=======
  $Id: ot_lev_discount.php,v 1.3 2002/09/04 22:49:11 wilt Exp $
  $Id: ot_lev_discount.php,v 2.4 2006/02/28 12:10:01 maniac101 Exp $
modified to calc discount correctly when tax is included in discount
>>>>>>> 2.4

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  class ot_jifen_discount {
    var $title, $output;

    function ot_jifen_discount() {
      $this->code = 'ot_jifen_discount';
      $this->title = MODULE_JIFEN_DISCOUNT_TITLE;
      $this->description = MODULE_JIFEN_DISCOUNT_DESCRIPTION;
      $this->enabled = MODULE_JIFEN_DISCOUNT_STATUS;
      $this->sort_order = MODULE_JIFEN_DISCOUNT_SORT_ORDER;
      $this->include_shipping = MODULE_JIFEN_DISCOUNT_INC_SHIPPING;
      $this->include_tax = MODULE_JIFEN_DISCOUNT_INC_TAX;
      $this->calculate_tax = MODULE_JIFEN_DISCOUNT_CALC_TAX;
      $this->table = MODULE_JIFEN_DISCOUNT_TABLE;
//      $this->credit_class = true;
      $this->output = array();
    }

    function process() {
      global $order, $ot_subtotal,$messageStack, $currencies, $db;

		$_SESSION['new_jifen'] = get_points($_SESSION['customer_id']);
		
		if(isset($_POST['jifen_code']) && $_POST['jifen_code'] != '' && $_SESSION['new_jifen']>0 ) {
				if(intval($_POST['jifen_code'])>$_SESSION['new_jifen']){
				
				  $messageStack->add_session('redemptions', 'Invalid Points!','caution');
				  zen_redirect(zen_href_link($_GET['main_page'], '', 'SSL',true, false));
				}else{
					
				  $_SESSION['jifen_code'] = $_POST['jifen_code'];
				  $messageStack->add_session('redemptions', 'Congratulations! Your Point discount is success!','success');
				  zen_redirect(zen_href_link($_GET['main_page'], '', 'SSL',true, false));
				}
		}
		
	  $od_amount = 0;	
	
	  if($_SESSION['jifen_code']>0){ 
	  	$od_amount = $_SESSION['jifen_code']*STORE_JIFEN;
	  }
      if ($od_amount>0) {
      	$this->deduction = $od_amount;
      	$this->output[] = array('title' => $this->title . ':',
                              'text' => '-' . $currencies->format($od_amount),
                              'value' => $od_amount);
    	$order->info['total'] = $order->info['total'] - $od_amount;
	  }
    }
     
   
  function calculate_credit($amount) {
    global $order;
    $od_amount=0;
    $table_cost = split("[:,]" , MODULE_JIFEN_DISCOUNT_TABLE);
    for ($i = 0; $i < count($table_cost); $i+=2) {
          if ($amount >= $table_cost[$i]) {
            $od_pc = $table_cost[$i+1];
          }
        }
// Calculate tax reduction if necessary
    if($this->calculate_tax == 'true') {
// Calculate main tax reduction
      $tod_amount = round($order->info['tax']*10)/10*$od_pc/100;
      $order->info['tax'] = $order->info['tax'] - $tod_amount;
// Calculate tax group deductions
      reset($order->info['tax_groups']);
      while (list($key, $value) = each($order->info['tax_groups'])) {
        $god_amount = round($value*10)/10*$od_pc/100;
        $order->info['tax_groups'][$key] = $order->info['tax_groups'][$key] - $god_amount;
      }  
    }

	
    //$od_amount = round($amount*10)/10*$od_pc/100;
//    $od_amount = $od_amount + $tod_amount;
// maniac101 above line was adding tax back into discount incorrectly for me


    //return $od_amount;
  }

  function get_order_total() {
    global  $order, $cart, $db;
    $order_total = $order->info['total'];
// Check if gift voucher is in cart and adjust total
//    $products = $cart -> get_products();
    for ($i=0; $i<sizeof($products); $i++) {
      $t_prid = zen_get_prid($products[$i]['id']);
      $gv_query = $db->Execute("select products_price, products_tax_class_id, products_model from " . TABLE_PRODUCTS . " where products_id = '" . $t_prid . "'");
      //$gv_result = zen_db_fetch_array($gv_query);
      if (ereg('^GIFT', addslashes($gv_result['products_model']))) { 
        $qty = $cart->get_quantity($t_prid);
        $products_tax = zen_get_tax_rate($gv_result['products_tax_class_id']);
        if ($this->include_tax =='false') {
           $gv_amount = $gv_result['products_price'] * $qty;
        } else {
          $gv_amount = ($gv_result['products_price'] + zen_calculate_tax($gv_result['products_price'],$products_tax)) * $qty;
        }
        $order_total=$order_total - $gv_amount;
      }
    }
    if ($this->include_tax == 'false') $order_total=$order_total-$order->info['tax'];
    if ($this->include_shipping == 'false') $order_total=$order_total-$order->info['shipping_cost'];
    return $order_total;
  }   
    
    
    
    function check() {
	  global $db;
      if (!isset($this->check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_JIFEN_DISCOUNT_STATUS'");
        $this->check = $check_query->RecordCount();
      }

      return $this->check;
    }

    function keys() {
      return array('MODULE_JIFEN_DISCOUNT_STATUS', 'MODULE_JIFEN_DISCOUNT_SORT_ORDER','MODULE_JIFEN_DISCOUNT_TABLE');
    }

    function install() {
      global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display Total', 'MODULE_JIFEN_DISCOUNT_STATUS', 'true', 'Do you want to enable the Order Discount?', '6', '1','zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_JIFEN_DISCOUNT_SORT_ORDER', '250', 'Sort order of display.', '6', '2', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Percentage', 'MODULE_JIFEN_DISCOUNT_TABLE', '0.05', 'Set the price breaks and discount percentages', '6', '6', now())");
    }

    function remove() {
      $keys = '';
      $keys_array = $this->keys();
      for ($i=0; $i<sizeof($keys_array); $i++) {
        $keys .= "'" . $keys_array[$i] . "',";
      }
      $keys = substr($keys, 0, -1);

      global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in (" . $keys . ")");
    }
  }
?>