<?php
/**
 * freeshipping-products functions
 *
 * @package functions
 * @copyright Copyright 2010-2012 Gold
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: freeshipping.php 6345 2010-04-15  $
 */

////
// Set the status of a freeshipping product
  function zen_set_freeshipping_status($freeshipping_id, $status) {
    global $db;
    $sql = "update " . TABLE_FREESHIPPING . "
            set status = '" . $status . "', date_status_change = now()
            where freeshipping_id = '" . (int)$freeshipping_id . "'";

    return $db->Execute($sql);
   }

////
// Auto expire products on freeshipping
  function zen_expire_freeshipping() {
    global $db;

    $date_range = time();
    $zc_freeshipping_date = date('Ymd', $date_range);

    $freeshipping_query = "select freeshipping_id
                       from " . TABLE_FREESHIPPING . "
                       where status = '1'
                       and ((" . $zc_freeshipping_date . " >= expires_date and expires_date != '0001-01-01')
                       or (" . $zc_freeshipping_date . " < freeshipping_date_available and freeshipping_date_available != '0001-01-01'))";

    $freeshipping = $db->Execute($freeshipping_query);

    if ($freeshipping->RecordCount() > 0) {
      while (!$freeshipping->EOF) {
        zen_set_freeshipping_status($freeshipping->fields['freeshipping_id'], '0');
        $freeshipping->MoveNext();
      }
    }
  }

////
// Auto start products on freeshipping
  function zen_start_freeshipping() {
    global $db;

    $date_range = time();
    $zc_freeshipping_date = date('Ymd', $date_range);

    $freeshipping_query = "select freeshipping_id
                       from " . TABLE_FREESHIPPING . "
                       where status = '0'
                       and (((freeshipping_date_available <= " . $zc_freeshipping_date . " and freeshipping_date_available != '0001-01-01') and (expires_date >= " . $zc_freeshipping_date . "))
                       or ((freeshipping_date_available <= " . $zc_freeshipping_date . " and freeshipping_date_available != '0001-01-01') and (expires_date = '0001-01-01'))
                       or (freeshipping_date_available = '0001-01-01' and expires_date >= " . $zc_freeshipping_date . "))
                       ";

    $freeshipping = $db->Execute($freeshipping_query);

    if ($freeshipping->RecordCount() > 0) {
      while (!$freeshipping->EOF) {
        zen_set_freeshipping_status($freeshipping->fields['freeshipping_id'], '1');
        $freeshipping->MoveNext();
      }
    }

// turn off freeshipping if not active yet
    $freeshipping_query = "select freeshipping_id
                       from " . TABLE_FREESHIPPING . "
                       where status = '1'
                       and (" . $zc_freeshipping_date . " < freeshipping_date_available and freeshipping_date_available != '0001-01-01')
                       ";

    $freeshipping = $db->Execute($freeshipping_query);

    if ($freeshipping->RecordCount() > 0) {
      while (!$freeshipping->EOF) {
        zen_set_freeshipping_status($freeshipping->fields['freeshipping_id'], '0');
        $freeshipping->MoveNext();
      }
    }

  }
?>