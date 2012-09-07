<?php // catalog/includes/modules/order_total/ot_together.php (3929)

  class ot_together {
    var $title, $output;

    function ot_together() {
      $this->code = 'ot_together';
      $this->title = MODULE_2GETHER_DISCOUNT_TITLE;
      $this->description = MODULE_2GETHER_DISCOUNT_DESCRIPTION;
      $this->enabled = ((MODULE_2GETHER_DISCOUNT_STATUS == 'true') ? true : false);
      $this->sort_order = MODULE_2GETHER_DISCOUNT_SORT_ORDER;
      $this->output = array();
    }
 /*   
    function process() {
      global $order, $currencies, $ot_subtotal, $cart, $together_product_names;

      $od_amount = $this->calculate_2gether_discount();
      
      if ($od_amount > 0) {
        $this->deduction = $od_amount;
        $this->output[] = array('title' => sprintf(MODULE_2GETHER_DISCOUNT_FORMATED_TITLE, $together_product_names),
                                'text' => sprintf(MODULE_2GETHER_DISCOUNT_FORMATED_TEXT, $currencies->format($od_amount)),
                                'value' => $od_amount);
                
        // /*****START_TAX_CALCULATIONS
        $discount_percentage = ($od_amount/$order->info['subtotal']);

        if ($order->info['tax'] > 0) {
        
            $tod_amount = ($order->info['tax'] * $discount_percentage);  
            reset($order->info['tax_groups']);
            
            while (list($key, $value) = each($order->info['tax_groups'])) {
                
                $god_amount = $value * $discount_percentage;
                $order->info['tax_groups'][$key] = $order->info['tax_groups'][$key] - $god_amount;
            }
        }
        
            $order->info['total']     -= $order->info['tax'];
            $order->info['tax']     -= $tod_amount;
            $order->info['total']      = ($order->info['total'] - $od_amount) + $order->info['tax'];
       / /*****END_TAX_CALCULATIONS*****

        if ($this->sort_order < $ot_subtotal->sort_order) $order->info['subtotal'] -= $this->deduction;
      }
    }
*/

function process() {
      global $order, $currencies, $ot_subtotal, $cart, $together_product_names;

      $od_amount = $this->calculate_2gether_discount();
      
      if ($od_amount > 0) {
        $this->deduction = $od_amount;
        $this->output[] = array('title' => sprintf(MODULE_2GETHER_DISCOUNT_FORMATED_TITLE, $together_product_names),
                                'text' => '- ' . sprintf(MODULE_2GETHER_DISCOUNT_FORMATED_TEXT, $currencies->format($od_amount)),
                                'value' => $od_amount);
                
         /*****START_TAX_CALCULATIONS*****/
        $discount_percentage = ($od_amount/$order->info['subtotal']);

        if ($order->info['tax'] > 0) {
        
            $tod_amount = ($order->info['tax'] * $discount_percentage);  
            reset($order->info['tax_groups']);
            
            while (list($key, $value) = each($order->info['tax_groups'])) {
                
                $god_amount = $value * $discount_percentage;
                $order->info['tax_groups'][$key] = $order->info['tax_groups'][$key] - $god_amount;
            }
        }
        
//            $order->info['total']     -= $order->info['tax'];
        $order->info['total'] -= $this->deduction;
            $order->info['tax']     -= $tod_amount;
//            $order->info['total']      = ($order->info['total'] - $od_amount) + $order->info['tax'];
        /*****END_TAX_CALCULATIONS*****/

        if ($this->sort_order < $ot_subtotal->sort_order) $order->info['subtotal'] -= $this->deduction;
      }
    }
	
    function in_cart($products_id) {
     global $cart; 
      
	  $return = false;
	  foreach ($cart->contents as $key => $value) {
	    $temp = explode('{',$key);
	    if ($temp[0] == $products_id) {
          $return = true;
		}
	  }
	  return $return;
	}
	
    function get_quantity($products_id) {
     global $cart; 
      
	  $return = 0;
	  foreach ($cart->contents as $key => $value) {
	    $temp = explode('{',$key);
	    if ($temp[0] == $products_id) {
          if (isset($cart->contents[$key])) {
            $return = $cart->contents[$key]['qty'];
          }
        }
	  }
	  return $return;
	}
	
    function calculate_2gether_discount() {
     global $cart, $together_product_names, $languages_id; 

     $used_up = array();
     $together_product_names = '';
     $od_amount = 0; 
     $cart_products = $cart->get_products();
     $cart_size = sizeof($cart_products);
     $together_products_query = tep_db_query("select product_1_id, product_2_id, discount, type from " . TABLE_2GETHER . "  where status = 1");
     while 	($together_products = tep_db_fetch_array($together_products_query)) {
        if (($this->in_cart($together_products['product_1_id'])) and ($this->in_cart($together_products['product_2_id']))) {
          $q1 = $this->get_quantity($together_products['product_1_id']);
          $q2 = $this->get_quantity($together_products['product_2_id']);
          $q1 = (isset($used_up[$together_products['product_1_id']])?$q1-$used_up[$together_products['product_1_id']]:$q1);
          $q2 = (isset($used_up[$together_products['product_2_id']])?$q2-$used_up[$together_products['product_2_id']]:$q2);
          if ($q1 > 0 && $q2 > 0) {
            if ($q1 < $q2) {
             $together_qty = $q1;
            } else {
             $together_qty = $q2;
            }
          } else {
             $together_qty = 0;
          }

          if ($together_qty > 0) {
			  $used_up[$together_products['product_1_id']] = (isset($used_up[$together_products['product_1_id']])?$used_up[$together_products['product_1_id']]:0) + $together_qty;
			  $used_up[$together_products['product_2_id']] = (isset($used_up[$together_products['product_2_id']])?$used_up[$together_products['product_2_id']]:0) + $together_qty;
		  
			  $together_price_query = tep_db_query("select p.products_price, p.products_tax_class_id, pd.products_name from " . TABLE_PRODUCTS . " p,  " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = " . $together_products['product_1_id']);
			  $together_price = tep_db_fetch_array($together_price_query);
			  $price1 = $together_price['products_price'];
			  if (DISPLAY_PRICE_WITH_TAX) {
				$price1 = tep_add_tax($price1,tep_get_tax_rate($together_price['products_tax_class_id']));
			  }
			  $together_product_names .= '<br>' . $together_qty . ' x (' . $together_price['products_name'] . ' + ';
	
			  $together_price_query = tep_db_query("select p.products_price, p.products_tax_class_id, pd.products_name from " . TABLE_PRODUCTS . " p,  " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = " . $together_products['product_2_id']);
			  $together_price = tep_db_fetch_array($together_price_query);
			  $price2 = $together_price['products_price'];
			  if (DISPLAY_PRICE_WITH_TAX) {
				$price2 = tep_add_tax($price2,tep_get_tax_rate($together_price['products_tax_class_id']));
			  }
			  $together_product_names .= $together_price['products_name'] . ') ';
			  if ($together_products['type'] == 'p') {
				$od_amount = $od_amount +
				($price1 + $price2) * $together_qty * $together_products['discount'] / 100;
			  } else {
				$od_amount = $od_amount + $together_products['discount'] * $together_qty ;
			  }
		   }
        }
      }
      return $od_amount;
    }
  
    function check() {
      if (!isset($this->check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_2GETHER_DISCOUNT_STATUS'");
        $this->check = mysql_num_rows($check_query);
      }

      return $this->check;
    }

    function keys() {
      return array('MODULE_2GETHER_DISCOUNT_STATUS', 'MODULE_2GETHER_DISCOUNT_SORT_ORDER');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values 
    ('Activate 2gether Discount', 'MODULE_2GETHER_DISCOUNT_STATUS', 'true', 'Do you want to enable the 2gether discount module?', '6', '1','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values 
    ('Sort Order', 'MODULE_2GETHER_DISCOUNT_SORT_ORDER', '6', 'Sort order of display.', '6', '2', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
  }
?>