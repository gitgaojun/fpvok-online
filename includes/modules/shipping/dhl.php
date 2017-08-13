<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004 Josh Dechant                                      |
// |                                                                      |
// | Portions Copyright (c) 2004 The zen-cart developers                  |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: dhl.php,v 1.101 2004-10-31 Josh Dechant Exp $
//

  class dhl {
    var $code, $title, $description, $icon, $enabled, $num_zones, $num_tables, $delivery_geozone, $order_total;
  
    function dhl() {
      global $order;

      $this->code = 'dhl';
      $this->title = MODULE_SHIPPING_DHL_TEXT_TITLE;
      $this->description = MODULE_SHIPPING_DHL_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_SHIPPING_DHL_SORT_ORDER;
      $this->tax_class = MODULE_SHIPPING_DHL_TAX_CLASS;
      $this->tax_basis = MODULE_SHIPPING_DHL_TAX_BASIS;

      $this->num_geozones = 31;
      $this->num_tables = 1;

      // disable only when entire cart is free shipping
      if (zen_get_shipping_enabled($this->code)) {
        $this->enabled = ((MODULE_SHIPPING_DHL_STATUS == 'True') ? true : false);
      }

      if ($this->enabled == true) {
        $this->enabled = false;
        for ($n=1; $n<=$this->num_geozones; $n++) {
          if ( ((int)constant('MODULE_SHIPPING_DHL_GEOZONE_' . $n . '_ID') > 0) && ((int)constant('MODULE_SHIPPING_DHL_GEOZONE_' . $n . '_ID') == $this->getGeoZoneID($order->delivery['country']['id'], $order->delivery['zone_id'])) ) {
            $this->enabled = true;
            $this->delivery_geozone = $n;
            break;
          } elseif ( ((int)constant('MODULE_SHIPPING_DHL_GEOZONE_' . $n . '_ID') == 0) && ($n == (int)$this->num_geozones) ) {
            $this->enabled = true;
            $this->delivery_geozone = $n;
            break;
          }
        }
      }
    }

// class methods
    function quote($method = '') {
      global $order, $shipping_weight, $shipping_num_boxes, $template;
      $this->quotes = array('id' => $this->code,
                            'module' => constant('MODULE_SHIPPING_DHL_GEOZONE_' . $this->delivery_geozone . '_TEXT_TITLE'),
							'description' => MODULE_SHIPPING_DHL_TEXT_DESCRIPTION,
                            'methods' => array());
      $geozone_mode = $this->determineTableMethod(constant('MODULE_SHIPPING_DHL_GEOZONE_' . $this->delivery_geozone . '_MODE'));  
      
      if ($method) {
        $j = substr($method, 5);

        $shipping = $this->determineShipping(split(":" , constant('MODULE_SHIPPING_DHL_GEOZONE_' . $this->delivery_geozone . '_TABLE_' . $j)));
        if ($geozone_mode == 'weight') {
          //$shipping = $shipping * $shipping_num_boxes;
          // show boxes if weight
          switch (SHIPPING_BOX_WEIGHT_DISPLAY) {
            case (0):
              $show_box_weight = '';
              break;
            case (1):
              $show_box_weight = ' (' . $shipping_num_boxes . ' ' . TEXT_SHIPPING_BOXES . ')';
              break;
            case (2):
              $show_box_weight = ' (' . number_format($shipping_weight,2) . TEXT_SHIPPING_WEIGHT . ')';
              break;
            default:
              $show_box_weight = ' (' . $shipping_num_boxes . ' x ' . number_format($shipping_weight,2) . TEXT_SHIPPING_WEIGHT . ')';
              break;
          }
        }
        
        $this->quotes['methods'][] = array('id' => 'table' . $j,
                                           'title' => constant('MODULE_SHIPPING_DHL_GEOZONE_' . $this->delivery_geozone . '_TABLE_' . $j . '_TEXT_WAY') . $show_box_weight,
										   'description' => MODULE_SHIPPING_DHL_TEXT_DESCRIPTION,
                                           'cost' => $shipping + constant('MODULE_SHIPPING_DHL_GEOZONE_' . $this->delivery_geozone . '_HANDLING'));
      } else {
        for ($j=1; $j<=$this->num_tables; $j++) {
          if (!zen_not_null(constant('MODULE_SHIPPING_DHL_GEOZONE_' . $this->delivery_geozone . '_TABLE_' . $j))) continue;

          $shipping = $this->determineShipping(split(":" , constant('MODULE_SHIPPING_DHL_GEOZONE_' . $this->delivery_geozone . '_TABLE_' . $j)));
          if ($geozone_mode == 'weight') {
           // $shipping = $shipping * $shipping_num_boxes;
            // show boxes if weight
            switch (SHIPPING_BOX_WEIGHT_DISPLAY) {
              case (0):
                $show_box_weight = '';
                break;
              case (1):
                $show_box_weight = ' (' . $shipping_num_boxes . ' ' . TEXT_SHIPPING_BOXES . ')';
                break;
              case (2):
                $show_box_weight = ' (' . number_format($shipping_weight,2) . TEXT_SHIPPING_WEIGHT . ')';
                break;
              default:
                $show_box_weight = ' (' . $shipping_num_boxes . ' x ' . number_format($shipping_weight,2) . TEXT_SHIPPING_WEIGHT . ')';
                break;
            }
          }

          $this->quotes['methods'][] = array('id' => 'table' . $j,
                                             'title' => constant('MODULE_SHIPPING_DHL_GEOZONE_' . $this->delivery_geozone . '_TABLE_' . $j . '_TEXT_WAY') . $show_box_weight,
                                             'cost' => $shipping + constant('MODULE_SHIPPING_DHL_GEOZONE_' . $this->delivery_geozone . '_HANDLING'));
        }
      }

      if ($this->tax_class > 0) {
        $this->quotes['tax'] = zen_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
      }

      if (zen_not_null(constant('MODULE_SHIPPING_DHL_GEOZONE_' . $this->delivery_geozone . '_ICON'))) $this->quotes['icon'] = zen_image($template->get_template_dir(constant('MODULE_SHIPPING_DHL_GEOZONE_' . $this->delivery_geozone . '_ICON'), DIR_WS_TEMPLATE, $current_page_base,'images/icons'). '/' . constant('MODULE_SHIPPING_DHL_GEOZONE_' . $this->delivery_geozone . '_ICON'), $this->title);

      return $this->quotes;
    }  

    function check() {
      global $db;

      if (!isset($this->_check)) {
        $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_DHL_STATUS'");
        $this->_check = $check_query->RecordCount();
      }
      return $this->_check;
    }

    function install() {
      global $db;

      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('打开多地区多费率模块', 'MODULE_SHIPPING_DHL_STATUS', 'True', '您要采用多地区多费率方式吗?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('税率种类', 'MODULE_SHIPPING_DHL_TAX_CLASS', '0', '计算运费使用的税率种类。', '6', '0', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('税率基准', 'MODULE_SHIPPING_DHL_TAX_BASIS', 'Shipping', '计算运费税的基准。选项为<br />Shipping - 基于客户的交货人地址<br />Billing - 基于客户的帐单地址<br />Store - 如果帐单地址/送货地区和商店地区相同，则基于商店地址', '6', '0', 'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ', now())");
      $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('排序顺序', 'MODULE_SHIPPING_DHL_SORT_ORDER', '0', '显示的顺序。', '6', '0', now())");

      for ($n=1; $n<=$this->num_geozones; $n++) {
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('<hr />地区 $n', 'MODULE_SHIPPING_DHL_GEOZONE_{$n}_ID', '', '适用于以下地区。', '6', '0', 'zen_get_zone_class_title', '_cfg_pull_down_geozones_dh(', now())");
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('地区 $n 基准', 'MODULE_SHIPPING_DHL_GEOZONE_{$n}_MODE', 'weight', '运费是基于总重量、总价格、还是定购数量 ', '6', '0', 'zen_cfg_select_option(array(\'weight\', \'price\', \'count\'), ', now())");
        
        for ($j=1; $j<=$this->num_tables; $j++) {
          $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('地区 $n 费率 $j', 'MODULE_SHIPPING_DHL_GEOZONE_{$n}_TABLE_{$j}', '', '本地区的运费标准 $j ', '6', '0', now())");
        }

        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('地区 $n 手续费', 'MODULE_SHIPPING_DHL_GEOZONE_{$n}_HANDLING', '0', '本配送地区的手续费', '6', '0', now())");
      }
    }

    function remove() {
      global $db;

      $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      $keys = array('MODULE_SHIPPING_DHL_STATUS', 'MODULE_SHIPPING_DHL_TAX_CLASS', 'MODULE_SHIPPING_DHL_TAX_BASIS', 'MODULE_SHIPPING_DHL_SORT_ORDER');
      for ($n=1; $n<=$this->num_geozones; $n++) {
        $keys[] = 'MODULE_SHIPPING_DHL_GEOZONE_' . $n . '_ID';
        $keys[] = 'MODULE_SHIPPING_DHL_GEOZONE_' . $n . '_MODE';
        $keys[] = 'MODULE_SHIPPING_DHL_GEOZONE_' . $n . '_HANDLING';

        for ($j=1; $j<=$this->num_tables; $j++) {
          $keys[] = 'MODULE_SHIPPING_DHL_GEOZONE_' . $n . '_TABLE_' . $j;
        }
      }

      return $keys;
    }

    function determineTableMethod($geozone_mode) {
      global $total_count, $shipping_weight;

      switch ($geozone_mode) {
        case 'price':
          if (method_exists($_SESSION['cart'], 'free_shipping_prices')) {
            $this->order_total = $_SESSION['cart']->show_total() - $_SESSION['cart']->free_shipping_prices();
          } else {
            $this->order_total = $_SESSION['cart']->show_total();
          }
          break;

        case 'count':
          if (method_exists($_SESSION['cart'], 'free_shipping_items')) {
            $this->order_total = $total_count - $_SESSION['cart']->free_shipping_items();
          } else {
            $this->order_total = $total_count;
          }
          break;

        case 'weight':
          $this->order_total = $shipping_weight;
          break;
      }

      return $geozone_mode;    
    }

    function determineShipping($table_cost) {
		global $shipping_weight;
		if($this->order_total>0 && $this->order_total<=0.5)
		{
			$shipping_factor=$table_cost[0];
		}elseif($this->order_total>0.5){
			for ($i=0.5;$i<$this->order_total; $i+=0.5) {
			$shipping_factor +=$table_cost[1] ;
			}
			$shipping_factor+=$table_cost[0];
		}else{
			$shipping_factor=0;
		}

      if (substr_count($shipping_factor, '%') > 0) {
        $shipping = ((($this->order_total*10)/10)*((str_replace('%', '', $shipping_factor))/100));
      } else {
        $shipping = str_replace('$', '', $shipping_factor);
      }
      
      return $shipping;
      
    }

    function getGeoZoneID($country_id, $zone_id) {
      global $db;

      // First, check for a Geo Zone that explicity includes the country & specific zone (useful for splitting countries with zones up)
      $zone = $db->Execute("select gz.geo_zone_id from " . TABLE_GEO_ZONES . " gz left join " . TABLE_ZONES_TO_GEO_ZONES . " ztgz on (gz.geo_zone_id = ztgz.geo_zone_id) where ztgz.zone_country_id = '" . (int)$country_id . "' and ztgz.zone_id = '" . (int)$zone_id . "' and LOWER(gz.geo_zone_name) like 'dhl%'");

      if ($zone->RecordCount() > 0) {
        return $zone->fields['geo_zone_id'];
      } else {
        // No luck…  Now check for a Geo Zone for the country and "All Zones" of the country.
        $zone = $db->Execute("select gz.geo_zone_id from " . TABLE_GEO_ZONES . " gz left join " . TABLE_ZONES_TO_GEO_ZONES . " ztgz on (gz.geo_zone_id = ztgz.geo_zone_id) where ztgz.zone_country_id = '" . (int)$country_id . "' and (ztgz.zone_id = '0' or ztgz.zone_id is NULL) and LOWER(gz.geo_zone_name) like 'dhl%'");

        if ($zone->RecordCount() > 0) {
          return $zone->fields['geo_zone_id'];
        } else {
          return false;
        }
      }
    }

  }

  function _cfg_pull_down_geozones_dh($zone_class_id, $key = '') {
    global $db;

    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');

    $zone_class_array = array(array('id' => '0', 'text' => 'Rest of the World'));
    $zone_class = $db->Execute("select geo_zone_id, geo_zone_name from " . TABLE_GEO_ZONES . " where LOWER(geo_zone_name) like 'dhl%' order by geo_zone_name");

    while (!$zone_class->EOF) {
      $zone_class_array[] = array('id' => $zone_class->fields['geo_zone_id'],
                                  'text' => $zone_class->fields['geo_zone_name']);
      $zone_class->MoveNext();
    }

    return zen_draw_pull_down_menu($name, $zone_class_array, $zone_class_id);
  }
?>
