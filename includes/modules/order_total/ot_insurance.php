<?php
/**
 * Order Total Module
 *
 *
 * @package - Optional Insurance
 * @copyright Copyright 2007-2008 Numinix Technology http://www.numinix.com
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: ot_insurance.php 2 2008-05-13 01:39:19Z numinix $
 */


	class ot_insurance {
    var $title, $output, $num_zones, $enabled, $dest_zone;
    function ot_insurance()
    {
	  	global $order, $currencies, $db;
	  	
      $this->code = 'ot_insurance';
      $this->title = MODULE_ORDER_TOTAL_INSURANCE_TITLE;
      $this->description = MODULE_ORDER_TOTAL_INSURANCE_DESCRIPTION;
      $this->enabled = ((MODULE_ORDER_TOTAL_INSURANCE_STATUS == 'true') ? true : false);
      $this->sort_order = MODULE_ORDER_TOTAL_INSURANCE_SORT_ORDER;
      $this->credit_class = true;
      $this->output = array();
	  if(isset($_SESSION['insurance']) && $_SESSION['insurance']>0){
	  
  	  $this->enabled == true;
	  }else{
	  $this->enabled == false;
	  }
    }
    
    
    function process() {
      global $order, $currencies, $db;
      
      if ($_SESSION['insurance_s'] ==1) {
				
			$insurance_price = 	$order->info['total'] *0.03;				
          $order->info['total'] = $order->info['total'] + $order->info['total'] *0.03;
		  
          $this->output[] = array('title' => $this->title . ':',
          'text' => $currencies->format($insurance_price, true, $order->info['currency'], $order->info['currency_value']),
          'value' => $insurance_price);
      }// end charge_it
	}

	  function get_order_total() {
      global $order;
	    $order_total_tax = $order->info['tax'];
	    $order_total = $order->info['total'];
	    $orderTotalFull = $order_total;
	    $order_total = array('totalFull'=>$orderTotalFull, 'total'=>$order_total, 'tax'=>$order_total_tax);
	
	    return $order_total;
  	}
	
	  function pre_confirmation_check($order_total) {
    }
    
    function credit_selection() {

    }
    

	
    function update_credit_account($i)
    {
    }
	
    function apply_credit()
    {
    }
    
    function clear_posts()
    {
        unset($_SESSION['insurance']);
    }
    
    function collect_posts()
    {
        global $db, $currencies;
        if (isset($_POST['insurance_checked'])|| $_SESSION['insurance']>0) {
            $_SESSION['insurance'] = MODULE_ORDER_TOTAL_INSURANCE_PER;
        } else {
            unset($_SESSION['insurance']);
        }
    }
    
    function check()
    {
        global $db;
        if (!isset($this->check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_INSURANCE_STATUS'");
        $this->check = $check_query->RecordCount();
        }
        
        return $this->check;
    }
    
    function keys()
    {
      $keys = array('MODULE_ORDER_TOTAL_INSURANCE_STATUS', 'MODULE_ORDER_TOTAL_INSURANCE_SORT_ORDER', 'MODULE_ORDER_TOTAL_INSURANCE_PER');
      
			return $keys;
    }
    
    function install()
    {
      global $db;
			$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Insurance Module', 'MODULE_ORDER_TOTAL_INSURANCE_STATUS', 'true', 'Do you want to enable this module? To fully turn this off, both this option and the one below should be set to false.', '6', '1','zen_cfg_select_option(array(\'true\', \'false\'), ', now())");
			$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values('Sort Order', 'MODULE_ORDER_TOTAL_INSURANCE_SORT_ORDER', '500', 'Sort order of display.', '6', '3', now())");
			$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, date_added) values('Insurance Percentage', 'MODULE_ORDER_TOTAL_INSURANCE_PER', '1.99', 'If using percent, what percentage of subtotal to charge for insurance.', '6', '6', '', now())");
		
    }
    
		function remove() {
			global $db;
			$db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
		}
	}
?>
