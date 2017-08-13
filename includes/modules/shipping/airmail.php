<?php
// +----------------------------------------------------------------------+
// | Simplified Chinese version   http://www.zen-cart.cn                  |
// +----------------------------------------------------------------------+
//  $Id: airmail.php 001 2008-03-27 Jack $

 class airmail {
	var $code, $title, $description, $icon, $enabled, $countries, $check_query;

// class constructor
    function airmail() {
	global $order, $db;

	$this->code = 'airmail';
	$this->title = MODULE_SHIPPING_AIRMAIL_TEXT_TITLE;
	$this->description = MODULE_SHIPPING_AIRMAIL_TEXT_DESCRIPTION;
	$this->sort_order = MODULE_SHIPPING_AIRMAIL_SORT_ORDER;
	$this->icon = '';
	$this->tax_class = MODULE_SHIPPING_AIRMAIL_TAX_CLASS;
	$this->enabled = ((MODULE_SHIPPING_AIRMAIL_STATUS == 'True') ? true : false);
	$this->countries = $order->delivery['country']['iso_code_2'];

    }

// class methods
    function quote($method = '') 
	{
		global $order, $total_weight, $shipping_cost_value, $shipping_rows, $db;
	if($total_weight>0){
		$shipping_cost = 21*$total_weight+2;						
	
		$this->quotes = array('id' => $this->code,
				 'module' => MODULE_SHIPPING_AIRMAIL_TEXT_TITLE.'('.number_format($total_weight,2) . TEXT_SHIPPING_WEIGHT . ')',
							 'methods' => array(array('id' => $this->code,
													  'title' => "Weight: " . $total_weight. " KG",
													  'cost' => $shipping_cost)));
	
		return $this->quotes;
		}
    }

    function check() {
	global $db;

  	if(!isset($this->_check)){
		$check_query = $db->Execute( "select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_AIRMAIL_STATUS'");
		$this->_check = $check_query->RecordCount();
	}
	return $this->_check;
    }

    function install() {      	
	global $db;

      	$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Open air mail distribution module', 'MODULE_SHIPPING_AIRMAIL_STATUS', 'True', 'To use air mail distribution module you?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
	    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('The type of tax', 'MODULE_SHIPPING_AIRMAIL_TAX_CLASS', '0', 'Calculated using the freight rate type.', '6', '0', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now())");
      	$db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order', 'MODULE_SHIPPING_AIRMAIL_SORT_ORDER', '0', 'Show the order.', '6', '0', now())");

    }

    function remove() {
	global $db;

      	$db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
	$keys = array('MODULE_SHIPPING_AIRMAIL_STATUS', 'MODULE_SHIPPING_AIRMAIL_TAX_CLASS', 'MODULE_SHIPPING_AIRMAIL_SORT_ORDER');
	return $keys;
  }
}
?>
