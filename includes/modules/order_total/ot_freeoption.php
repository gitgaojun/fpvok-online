<?php
/**
 * ot_total order-total module
 *
 * @package orderTotal
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: ot_shbcfee.php 6101 2007-04-01 10:30:22Z wilt $
 */
  class ot_freeoption {
    var $title, $output;

    function ot_freeoption() {
      $this->code = 'ot_freeoption';
      $this->title = 'Tracking numver';
      $this->description = MODULE_ORDER_TOTAL_LOWORDEPAYPAL_DESCRIPTION;
      $this->sort_order = MODULE_ORDER_TOTAL_LOWORDEPAYPAL_SORT_ORDER2;

      $this->output = array();
    }

    function process() {
      global $order, $currencies;
	  

		if($_SESSION['freeoption_s'] ==1) {
			$free_price = $order->info['total'] > 40?0:2;
			 $_SESSION['freeoption_s'] = 1;
            $order->info['total'] =$order->info['total']+ $free_price;
            $this->output[] = array('title' => 'Tracking numver:',
                                    'text' => $currencies->format($free_price, true, $order->info['currency'], $order->info['currency_value']),
		'value' => $free_price);
      }
	}

    function check() {
	  global $db;
      if (!isset($this->_check)) {
        $check_query = "select configuration_value
                        from " . TABLE_CONFIGURATION . "
                        where configuration_key = 'MODULE_ORDER_TOTAL_LOWORDEPAYPAL_STATUS2'";

        $check_query = $db->Execute($check_query);
        $this->_check = $check_query->RecordCount();
      }

      return $this->_check;
    }
	
    function collect_posts()
    {
        global $db, $currencies;
        if ($_POST['freeoption_checked']==1) {
            $_SESSION['freeoption_s'] = 1;
        } else {
            $_SESSION['freeoption_s'] = '0';
        }
    }
    function keys() {
      return array('MODULE_ORDER_TOTAL_LOWORDEPAYPAL_STATUS2', 'MODULE_ORDER_TOTAL_LOWORDEPAYPAL_SORT_ORDER2', 'MODULE_ORDER_TOTAL_LOWORDEPAYPAL_VALUE2');
    }

    function install() {
      global $db;
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('This module is installed', 'MODULE_ORDER_TOTAL_LOWORDEPAYPAL_STATUS2', 'true', '', '6', '1','zen_cfg_select_option(array(\'true\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ORDER_TOTAL_LOWORDEPAYPAL_SORT_ORDER2', '600', 'Sort order of display.', '6', '2', now())");

      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ORDER_TOTAL_LOWORDEPAYPAL_VALUE2', '30', '	Tracking numver.', '6', '3', now())");
    }

    function remove() {
	  global $db;
      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }
?>