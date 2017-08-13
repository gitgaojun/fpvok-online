<?php
/**
 * new_arrivals functions
 *
 * @package functions
 * @copyright Copyright 2010-2012 Gold
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: new_arrivals.php 6345 2010-04-15  $
 */

////
// Set the status of a new_arrivals
  function zen_set_new_arrivals_status($new_arrivals_id, $status) {
    global $db;
    $sql = "update " . TABLE_NEW_ARRIVALS . "
            set status = '" . $status . "', date_status_change = now()
            where new_arrivals_id = '" . (int)$new_arrivals_id . "'";

    return $db->Execute($sql);
   }

////
// Auto expire products on new_arrivals
  function zen_expire_new_arrivals() {
    global $db;

    $date_range = time();
    $zc_new_arrivals_date = date('Ymd', $date_range);

    $new_arrivals_query = "select new_arrivals_id
                       from " . TABLE_NEW_ARRIVALS . "
                       where status = '1'
                       and ((" . $zc_new_arrivals_date . " >= expires_date and expires_date != '0001-01-01')
                       or (" . $zc_new_arrivals_date . " < new_arrivals_date_available and new_arrivals_date_available != '0001-01-01'))";

    $new_arrivals = $db->Execute($new_arrivals_query);

    if ($new_arrivals->RecordCount() > 0) {
      while (!$new_arrivals->EOF) {
        zen_set_new_arrivals_status($new_arrivals->fields['new_arrivals_id'], '0');
        $new_arrivals->MoveNext();
      }
    }
  }

////
// Auto start products on new_arrivals
  function zen_start_new_arrivals() {
    global $db;

    $date_range = time();
    $zc_new_arrivals_date = date('Ymd', $date_range);

    $new_arrivals_query = "select new_arrivals_id
                       from " . TABLE_NEW_ARRIVALS . "
                       where status = '0'
                       and (((new_arrivals_date_available <= " . $zc_new_arrivals_date . " and new_arrivals_date_available != '0001-01-01') and (expires_date >= " . $zc_new_arrivals_date . "))
                       or ((new_arrivals_date_available <= " . $zc_new_arrivals_date . " and new_arrivals_date_available != '0001-01-01') and (expires_date = '0001-01-01'))
                       or (new_arrivals_date_available = '0001-01-01' and expires_date >= " . $zc_new_arrivals_date . "))
                       ";

    $new_arrivals = $db->Execute($new_arrivals_query);

    if ($new_arrivals->RecordCount() > 0) {
      while (!$new_arrivals->EOF) {
        zen_set_new_arrivals_status($new_arrivals->fields['new_arrivals_id'], '1');
        $new_arrivals->MoveNext();
      }
    }

// turn off new_arrivals if not active yet
    $new_arrivals_query = "select new_arrivals_id
                       from " . TABLE_NEW_ARRIVALS . "
                       where status = '1'
                       and (" . $zc_new_arrivals_date . " < new_arrivals_date_available and new_arrivals_date_available != '0001-01-01')
                       ";

    $new_arrivals = $db->Execute($new_arrivals_query);

    if ($new_arrivals->RecordCount() > 0) {
      while (!$new_arrivals->EOF) {
        zen_set_new_arrivals_status($new_arrivals->fields['new_arrivals_id'], '0');
        $new_arrivals->MoveNext();
      }
    }

  }
?>