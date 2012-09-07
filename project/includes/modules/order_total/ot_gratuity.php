<?php // catalog/includes/modules/order_total/ot_gratuity.php (6635)

  class ot_gratuity {
    var $title, $output;

    function ot_gratuity() {
      $this->code = 'ot_gratuity';
      $this->title = MODULE_GRATUITY_TITLE;
      $this->description = MODULE_GRATUITY_DESCRIPTION;
      $this->enabled = MODULE_GRATUITY_STATUS;
      $this->sort_order = MODULE_GRATUITY_SORT_ORDER;
      $this->include_tax = MODULE_GRATUITY_INC_TAX;
      $this->calculate_tax = MODULE_GRATUITY_CALC_TAX;
      $this->output = array();
    }

    function process() {
     global $order, $currencies;

      $od_amount = $this->calculate_fee($this->get_order_total());
      if ($od_amount>0) {
        $this->addition = $od_amount;
        $this->output[] = array('title' => $this->title . ':',
                                'text' => '+ ' . $currencies->format($od_amount) . '',
                                'value' => $od_amount);
        $order->info['total'] = $order->info['total'] + $od_amount;  
      }
    }
    
    function calculate_fee($amount) {
      global $order, $customer_id, $payment, $gratuity;
      $od_amount=0;
      $od_pc = $gratuity;
  
      if($this->calculate_tax == 'false') {
        return $gratuity;
      } else {  // Calculate tax reduction if necessary
        if ($order->info['tax'] == 0) //but only if it applies for this customer
          return $gratuity;
          
        $tod_amount = round($order->info['tax']*10)/10*$od_pc/100; // Calculate main tax reduction
        $order->info['tax'] = $order->info['tax'] + $tod_amount;
        reset($order->info['tax_groups']); // Calculate tax group deductions
        while (list($key, $value) = each($order->info['tax_groups'])) {
          $god_amount = round($value*10)/10*$od_pc/100;
          $order->info['tax_groups'][$key] = $order->info['tax_groups'][$key] + $god_amount;
        }  
      }
      $od_amount = round($amount*10)/10*$od_pc/100;
      $od_amount = $od_amount + $tod_amount;
  
      return $od_amount;
    }
     
    function get_order_total() {
      global  $order, $cart;
      $order_total = $order->info['total'];
  // Check if gift voucher is in cart and adjust total
      $products = $cart->get_products();
      for ($i=0; $i<sizeof($products); $i++) {
        $t_prid = tep_get_prid($products[$i]['id']);
        $gv_query = tep_db_query("select products_price, products_tax_class_id, products_model from " . TABLE_PRODUCTS . " where products_id = '" . $t_prid . "'");
        $gv_result = tep_db_fetch_array($gv_query);
        if (ereg('^GIFT', addslashes($gv_result['products_model']))) { 
          $qty = $cart->get_quantity($t_prid);
          $products_tax = tep_get_tax_rate($gv_result['products_tax_class_id']);
          if ($this->include_tax =='false') {
             $gv_amount = $gv_result['products_price'] * $qty;
          } else {
            $gv_amount = ($gv_result['products_price'] + tep_calculate_tax($gv_result['products_price'],$products_tax)) * $qty;
          }
          $order_total=$order_total - $gv_amount;
        }
      }
      if ($this->include_tax == 'false') $order_total=$order_total-$order->info['tax'];
      return $order_total;
    }  
      
    function check() {
      if (!isset($this->check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_GRATUITY_STATUS'");
        $this->check = tep_db_num_rows($check_query);
      }
  
      return $this->check;
    }
  
    function keys() {
      return array('MODULE_GRATUITY_STATUS', 'MODULE_GRATUITY_SORT_ORDER','MODULE_GRATUITY_INC_TAX', 'MODULE_GRATUITY_CALC_TAX');
    }
  
    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display Total', 'MODULE_GRATUITY_STATUS', 'true', 'Do you want to enable the Order Payment Fee?', '6', '1','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_GRATUITY_SORT_ORDER', '5', 'Sort order of display.', '6', '2', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Include Tax', 'MODULE_GRATUITY_INC_TAX', 'true', 'Include Tax in calculation.', '6', '6','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Calculate Tax', 'MODULE_GRATUITY_CALC_TAX', 'false', 'Re-calculate Tax on gratuity amount.', '6', '5','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
    }
  
    function remove() {
      $keys = '';
      $keys_array = $this->keys();
      for ($i=0; $i<sizeof($keys_array); $i++) {
        $keys .= "'" . $keys_array[$i] . "',";
      }
      $keys = substr($keys, 0, -1);
  
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in (" . $keys . ")");
    }
  }
?>