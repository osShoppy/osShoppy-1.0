<?php //$Id: /catalog/includes/classes/shopping_cart.php (osC)

  class shoppingCart {
    var $contents, $total, $weight, $cartID, $content_type;
    // FS - TNT MODULE 'tntpostf.php' - START
    var $tnt, $tnt_f_tr_0, $tnt_f_tr_1, $tnt_f_tr_2, $tnt_f_tr_3, $tnt_f_tr_4, 
        $tnt_f_sb, $tnt_f_cs, $tnt_f_total_ex_tax;
    // FS - TNT MODULE 'tntpostf.php' - STOP   

    function shoppingCart() {
      $this->reset();
    }

    function restore_contents() {
// bof - credit class gift voucher 1
//    global $customer_id;
//    global $customer_id, $languages_id; // languages_id needed for PriceFormatter - QPBPP
      global $customer_id, $languages_id, $gv_id, $REMOTE_ADDR;
// eof - credit class gift voucher

      if (!tep_session_is_registered('customer_id')) return false;

// insert current cart contents in database
      if (is_array($this->contents)) {
        reset($this->contents);
// BOF Separate Pricing Per Customer
// attribute hide/invalid check: loop through the shopping cart and check the attributes if they
// are hidden for the now logged-in customer
      $this->cg_id = $this->get_customer_group_id();
        while (list($products_id, ) = each($this->contents)) {
					// only check attributes if they are set for the product in the cart
				   if (isset($this->contents[$products_id]['attributes'])) {
				$check_attributes_query = tep_db_query("select options_id, options_values_id, IF(find_in_set('" . $this->cg_id . "', attributes_hide_from_groups) = 0, '0', '1') as hide_attr_status from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . tep_get_prid($products_id) . "'");
				while ($_check_attributes = tep_db_fetch_array($check_attributes_query)) {
					$check_attributes[] = $_check_attributes;
				} // end while ($_check_attributes = tep_db_fetch_array($check_attributes_query))
				$no_of_check_attributes = count($check_attributes);
				$change_products_id = '0';

				foreach($this->contents[$products_id]['attributes'] as $attr_option => $attr_option_value) {
					$valid_option = '0';
					for ($x = 0; $x < $no_of_check_attributes ; $x++) {
						if ($attr_option == $check_attributes[$x]['options_id'] && $attr_option_value == $check_attributes[$x]['options_values_id']) {
							$valid_option = '1';
							if ($check_attributes[$x]['hide_attr_status'] == '1') {
							// delete hidden attributes from array attributes, change products_id accordingly later
							$change_products_id = '1';
							unset($this->contents[$products_id]['attributes'][$attr_option]);
							}
						} // end if ($attr_option == $check_attributes[$x]['options_id']....
					} // end for ($x = 0; $x < $no_of_check_attributes ; $x++)
					if ($valid_option == '0') {
						// after having gone through the options for this product and not having found a matching one
						// we can conclude that apparently this is not a valid option for this product so remove it
						unset($this->contents[$products_id]['attributes'][$attr_option]);
						// change products_id accordingly later
						$change_products_id = '1';
					}
				} // end foreach($this->contents[$products_id]['attributes'] as $attr_option => $attr_option_value)

          if ($change_products_id == '1') {
	           $original_products_id = $products_id;
	           $products_id = tep_get_prid($original_products_id);
	           $products_id = tep_get_uprid($products_id, $this->contents[$original_products_id]['attributes']);
						 // add the product without the hidden attributes to the cart
	           $this->contents[$products_id] = $this->contents[$original_products_id];
				     // delete the originally added product with the hidden attributes
	           unset($this->contents[$original_products_id]);
            }
				  } // end if (isset($this->contents[$products_id]['attributes']))
				} // end while (list($products_id, ) = each($this->contents))
       reset($this->contents); // reset the array otherwise the cart will be emptied
// EOF Separate Pricing Per Customer
        while (list($products_id, ) = each($this->contents)) {
          $qty = $this->contents[$products_id]['qty'];
// BOF QPBPP for SPPC adjust quantity blocks and min_order_qty for this customer group
// warnings about this are raised in PriceFormatter
      $pf = new PriceFormatter;
      $pf->loadProduct(tep_get_prid($products_id), $languages_id);
      $qty = $pf->adjustQty($qty);
// EOF QPBPP for SPPC
          $product_query = tep_db_query("select products_id from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");
          if (!tep_db_num_rows($product_query)) {
            tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET . " (customers_id, products_id, customers_basket_quantity, customers_basket_date_added) values ('" . (int)$customer_id . "', '" . tep_db_input($products_id) . "', '" . tep_db_input($qty) . "', '" . date('Ymd') . "')");
            if (isset($this->contents[$products_id]['attributes'])) {
              reset($this->contents[$products_id]['attributes']);
              while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
                tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " (customers_id, products_id, products_options_id, products_options_value_id) values ('" . (int)$customer_id . "', '" . tep_db_input($products_id) . "', '" . (int)$option . "', '" . (int)$value . "')");
              }
            }
          } else {
            tep_db_query("update " . TABLE_CUSTOMERS_BASKET . " set customers_basket_quantity = '" . tep_db_input($qty) . "' where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");
          }
        }
// bof - credit class gift voucher 2
        if (tep_session_is_registered('gv_id')) {
          $gv_query = tep_db_query("insert into  " . TABLE_COUPON_REDEEM_TRACK . " (coupon_id, customer_id, redeem_date, redeem_ip) values ('" . $gv_id . "', '" . (int)$customer_id . "', now(),'" . $REMOTE_ADDR . "')");
          $gv_update = tep_db_query("update " . TABLE_COUPONS . " set coupon_active = 'N' where coupon_id = '" . $gv_id . "'");
          tep_gv_account_update($customer_id, $gv_id);
          tep_session_unregister('gv_id');
        }
// eof - credit class gift voucher
      }

// reset per-session cart contents, but not the database contents
      $this->reset(false);
// BOF QPBPP for SPPC
/* original
      $products_query = tep_db_query("select products_id, customers_basket_quantity from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "'");
      while ($products = tep_db_fetch_array($products_query)) {
        $this->contents[$products['products_id']] = array('qty' => $products['customers_basket_quantity']);
*/
      $products_query = tep_db_query("select cb.products_id, ptdc.discount_categories_id, customers_basket_quantity from " . TABLE_CUSTOMERS_BASKET . " cb left join (select products_id, discount_categories_id from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " where customers_group_id = '" . $this->cg_id . "') as ptdc on cb.products_id = ptdc.products_id where customers_id = '" . (int)$customer_id . "'");
      while ($products = tep_db_fetch_array($products_query)) {
        $this->contents[$products['products_id']] = array('qty' => $products['customers_basket_quantity'], 'discount_categories_id' => $products['discount_categories_id']);
// EOF QPBPP for SPPC

// attributes
        $attributes_query = tep_db_query("select products_options_id, products_options_value_id from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products['products_id']) . "'");
        while ($attributes = tep_db_fetch_array($attributes_query)) {
          $this->contents[$products['products_id']]['attributes'][$attributes['products_options_id']] = $attributes['products_options_value_id'];
        }
      }

      $this->cleanup();
    }

    function reset($reset_database = false) {
      global $customer_id;

      $this->contents = array();
      $this->total = 0;
      $this->weight = 0;
      // FS - TNT MODULE 'tntpostf.php' - START
      $this->tnt_f_tr_0 = 0;
      $this->tnt_f_tr_1 = 0;
      $this->tnt_f_tr_2 = 0;
      $this->tnt_f_tr_3 = 0;
      $this->tnt_f_tr_4 = 0;                        
      $this->tnt_f_sb = 0;  
      $this->tnt_f_cs = 0; 
      $this->tnt_f_total_ex_tax = 0.0;               
      // FS - TNT MODULE 'tntpostf.php' - STOP
      $this->content_type = false;

      if (tep_session_is_registered('customer_id') && ($reset_database == true)) {
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "'");
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "'");
      }

      unset($this->cartID);
      if (tep_session_is_registered('cartID')) tep_session_unregister('cartID');
    }

    function add_cart($products_id, $qty = '1', $attributes = '', $notify = true) {
      global $new_products_id_in_cart, $customer_id;
// BOF Separate Pricing Per Customer 
      $this->cg_id = $this->get_customer_group_id();
// EOF Separate Pricing Per Customer

      $products_id_string = tep_get_uprid($products_id, $attributes);
      $products_id = tep_get_prid($products_id_string);

      if (defined('MAX_QTY_IN_CART') && (MAX_QTY_IN_CART > 0) && ((int)$qty > MAX_QTY_IN_CART)) {
        $qty = MAX_QTY_IN_CART;
      }

// BOF QPBPP for SPPC
      $pf = new PriceFormatter;
      $pf->loadProduct($products_id);
      $qty = $pf->adjustQty($qty);
      $discount_category = $pf->get_discount_category();
// EOF QPBPP for SPPC

	  $attributes_pass_check = true;

      if (is_array($attributes)) {
        reset($attributes);
        while (list($option, $value) = each($attributes)) {
          if (!is_numeric($option) || !is_numeric($value)) {
            $attributes_pass_check = false;
            break;
          }
        }
      }

      if (is_numeric($products_id) && is_numeric($qty) && ($attributes_pass_check == true)) {
// BOF Separate Pricing Per Customer 
// attribute hide check, original query expanded to include attributes
/*      $check_product_query = tep_db_query("select products_status from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
        $check_product = tep_db_fetch_array($check_product_query);

        if (($check_product !== false) && ($check_product['products_status'] == '1')) {
*/
				$check_product_query = tep_db_query("select p.products_status, options_id, options_values_id, IF(find_in_set('" . $this->cg_id . "', attributes_hide_from_groups) = 0, '0', '1') as hide_attr_status from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_ATTRIBUTES . " using(products_id) where p.products_id = '" . (int)$products_id . "'");
				while ($_check_product = tep_db_fetch_array($check_product_query)) {
					$check_product[] = $_check_product;
				} // end while ($_check_product = tep_db_fetch_array($check_product_query))
				$no_of_check_product = count($check_product);

  if (is_array($attributes)) {
				foreach($attributes as $attr_option => $attr_option_value) {
					$valid_option = '0';
					for ($x = 0; $x < $no_of_check_product ; $x++) {
						if ($attr_option == $check_product[$x]['options_id'] && $attr_option_value == $check_product[$x]['options_values_id']) {
							$valid_option = '1';
							if ($check_product[$x]['hide_attr_status'] == '1') {
							// delete hidden attributes from array attributes
							unset($attributes[$attr_option]);
							}
						} // end if ($attr_option == $check_product[$x]['options_id']....
					} // end for ($x = 0; $x < $no_of_check_product ; $x++)
					if ($valid_option == '0') {
						// after having gone through the options for this product and not having found a matching one
						// we can conclude that apparently this is not a valid option for this product so remove it
						unset($attributes[$attr_option]);
					}
				} // end foreach($attributes as $attr_option => $attr_option_value)
	} // end if (is_array($attributes))
// now attributes have been checked and hidden and invalid ones deleted make the $products_id_string again
				$products_id_string = tep_get_uprid($products_id, $attributes);

        if ((isset($check_product) && tep_not_null($check_product)) && ($check_product[0]['products_status'] == '1')) {
// EOF Separate Pricing Per Customer 
		if ($notify == true) {
            $new_products_id_in_cart = $products_id;
            tep_session_register('new_products_id_in_cart');
          }
// BOF QPBPP for SPPC
/* original
          if ($this->in_cart($products_id_string)) {
            $this->update_quantity($products_id_string, $qty, $attributes);
          } else {
            $this->contents[$products_id_string] = array('qty' => (int)$qty);
			*/
          if ($this->in_cart($products_id_string)) {
            $this->update_quantity($products_id_string, $qty, $attributes, $discount_category);
          } else {
            $this->contents[$products_id_string] = array('qty' => (int)$qty, 'discount_categories_id' => $discount_category);
// EOF QPBPP for SPPC
// insert into database
            if (tep_session_is_registered('customer_id')) tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET . " (customers_id, products_id, customers_basket_quantity, customers_basket_date_added) values ('" . (int)$customer_id . "', '" . tep_db_input($products_id_string) . "', '" . (int)$qty . "', '" . date('Ymd') . "')");

            if (is_array($attributes)) {
              reset($attributes);
              while (list($option, $value) = each($attributes)) {
                $this->contents[$products_id_string]['attributes'][$option] = $value;
// insert into database
                if (tep_session_is_registered('customer_id')) tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " (customers_id, products_id, products_options_id, products_options_value_id) values ('" . (int)$customer_id . "', '" . tep_db_input($products_id_string) . "', '" . (int)$option . "', '" . (int)$value . "')");
              }
            }
          }

          $this->cleanup();

// assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
          $this->cartID = $this->generate_cart_id();
        }
      }
    }

// BOF QPBPP for SPPC
// original    function update_quantity($products_id, $quantity = '', $attributes = '') {
    function update_quantity($products_id, $quantity = '', $attributes = '', $discount_categories_id = NULL) {
// EOF QPBPP for SPPC
      global $customer_id;

      $products_id_string = tep_get_uprid($products_id, $attributes);
      $products_id = tep_get_prid($products_id_string);

      if (defined('MAX_QTY_IN_CART') && (MAX_QTY_IN_CART > 0) && ((int)$quantity > MAX_QTY_IN_CART)) {
        $quantity = MAX_QTY_IN_CART;
      }

      $attributes_pass_check = true;

      if (is_array($attributes)) {
        reset($attributes);
        while (list($option, $value) = each($attributes)) {
          if (!is_numeric($option) || !is_numeric($value)) {
            $attributes_pass_check = false;
            break;
          }
        }
      }

      if (is_numeric($products_id) && isset($this->contents[$products_id_string]) && is_numeric($quantity) && ($attributes_pass_check == true)) {
// BOF QPBPP for SPPC
// original        $this->contents[$products_id_string] = array('qty' => (int)$quantity);
        $this->contents[$products_id_string] = array('qty' => (int)$quantity, 'discount_categories_id' => $discount_categories_id);
// EOF QPBPP for SPPC
// update database
        if (tep_session_is_registered('customer_id')) tep_db_query("update " . TABLE_CUSTOMERS_BASKET . " set customers_basket_quantity = '" . (int)$quantity . "' where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id_string) . "'");

        if (is_array($attributes)) {
          reset($attributes);
          while (list($option, $value) = each($attributes)) {
            $this->contents[$products_id_string]['attributes'][$option] = $value;
// update database
            if (tep_session_is_registered('customer_id')) tep_db_query("update " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " set products_options_value_id = '" . (int)$value . "' where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id_string) . "' and products_options_id = '" . (int)$option . "'");
          }
        }
      }
    }

    function cleanup() {
      global $customer_id;

      reset($this->contents);
      while (list($key,) = each($this->contents)) {
        if ($this->contents[$key]['qty'] < 1) {
          unset($this->contents[$key]);
// remove from database
          if (tep_session_is_registered('customer_id')) {
            tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($key) . "'");
            tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($key) . "'");
          }
        }
      }
    }

    function count_contents() {  // get total number of items in cart 
      $total_items = 0;
      if (is_array($this->contents)) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          $total_items += $this->get_quantity($products_id);
// start Get 1 free
          // If this product qualifies for free product(s) add in the number of free products
          if (is_array ($free_product = $this->get1free ($products_id))) {
            $total_items += $free_product['quantity'];
          }
// end Get 1 free
        }
      }

      return $total_items;
    }

    function get_quantity($products_id) {
      if (isset($this->contents[$products_id])) {
        return $this->contents[$products_id]['qty'];
      } else {
        return 0;
      }
    }

    function in_cart($products_id) {
      if (isset($this->contents[$products_id])) {
        return true;
      } else {
        return false;
      }
    }

    function remove($products_id) {
      global $customer_id;

      unset($this->contents[$products_id]);
// remove from database
      if (tep_session_is_registered('customer_id')) {
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");
      }

// start Get 1 Free
          // If this product qualifies for free product(s) remove the free products
          if (is_array ($free_product = $this->get1free ($products_id))) {
            $pid = (int)$free_product['id'];
            print '<br>Found Product: ' . $pid;
            unset($this->contents[$pid]);
            // remove from database
            if (tep_session_is_registered('customer_id')) {
              tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($pid) . "'");
              tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($pid) . "'");
            }
          }
// end Get 1 Free

// assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
      $this->cartID = $this->generate_cart_id();
    }

    function remove_all() {
      $this->reset();
    }

    function get_product_id_list() {
      $product_id_list = '';
      if (is_array($this->contents)) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          $product_id_list .= ', ' . $products_id;
        }
      }

      return substr($product_id_list, 2);
    }

    function calculate() {
      global $currencies, $languages_id, $pfs; // for QPBPP added: $languages_id, $pfs
// bof - credit class gift voucher 3
      $this->total_virtual = 0;
// eof - credit class gift voucher
      $this->total = 0;
      $this->weight = 0;
// FS - TNT MODULE 'tntpostf.php' - START
      $this->tnt_f_tr_0 = 0;
      $this->tnt_f_tr_1 = 0;
      $this->tnt_f_tr_2 = 0;
      $this->tnt_f_tr_3 = 0;
      $this->tnt_f_tr_4 = 0;                        
      $this->tnt_f_sb = 0;  
      $this->tnt_f_cs = 0; 
      $this->tnt_f_total_ex_tax = 0.0;               
// FS - TNT MODULE 'tntpostf.php' - STOP   
      if (!is_array($this->contents)) return 0;
// BOF Separate Pricing Per Customer
// global variable (session) $sppc_customer_group_id -> class variable cg_id
      $this->cg_id = $this->get_customer_group_id();
// EOF Separate Pricing Per Customer

// BOF QPBPP for SPPC
        $discount_category_quantity = array(); // calculates no of items per discount category in shopping basket
      foreach ($this->contents as $products_id => $contents_array) {
          if(tep_not_null($contents_array['discount_categories_id'])) {
            if (!isset($discount_category_quantity[$contents_array['discount_categories_id']])) {
                $discount_category_quantity[$contents_array['discount_categories_id']] = $contents_array['qty'];
            } else {
                $discount_category_quantity[$contents_array['discount_categories_id']] += $contents_array['qty'];
            }
          }
      } // end foreach

   $pf = new PriceFormatter;
// EOF QPBPP for SPPC

	 reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
        $qty = $this->contents[$products_id]['qty'];

// BOF QPBPP for SPPC       
      if (tep_not_null($this->contents[$products_id]['discount_categories_id'])) {
        $nof_items_in_cart_same_cat = $discount_category_quantity[$this->contents[$products_id]['discount_categories_id']];
        $nof_other_items_in_cart_same_cat = $nof_items_in_cart_same_cat - $qty;
      } else {
          $nof_other_items_in_cart_same_cat = 0;
      }
// EOF QPBPP for SPPC

// start Get 1 Free
          // If this product qualifies for free product(s) add in the total weight of free products
          if (is_array ($free_product = $this->get1free ($products_id))) {
            $this->weight += $free_product['quantity'] * $free_product['weight'];
          }
// end Get 1 Free

// products price
/* original
        // FS - TNT MODULE 'tntpostf.php' - START
        $product_query = tep_db_query("select products_id, products_price, products_tax_class_id, products_weight, tnt_f_tr, tnt_f_sb, tnt_f_cs from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
        if ($product = tep_db_fetch_array($product_query)) {
          $prid = $product['products_id'];
          $products_tax = tep_get_tax_rate($product['products_tax_class_id']);
          $products_price = $product['products_price'];
          $products_weight = $product['products_weight'];
          // FS - TNT MODULE 'tntpostf.php' - START
          $products_tnt_f_tr = (int)$product['tnt_f_tr'];
          $products_tnt_f_sb = (int)$product['tnt_f_sb'];
          $products_tnt_f_cs = (int)$product['tnt_f_cs'];                  
     	  // FS - TNT MODULE 'tntpostf.php' - STOP  
		  */
// BOF QPBPP for SPPC
       $pf->loadProduct($products_id, $languages_id);
        if ($product = $pfs->getPriceFormatterData($products_id)) {
// bof - credit class gift voucher 4
          $no_count = 1;
          $gv_query = tep_db_query("select products_model from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
          $gv_result = tep_db_fetch_array($gv_query);
          if (ereg('^GIFT', $gv_result['products_model'])) {
            $no_count = 0;
          }
// eof - credit class gift voucher
          $prid = $product['products_id'];
          $products_tax = tep_get_tax_rate($product['products_tax_class_id']);
          $products_price = $pf->computePrice($qty, $nof_other_items_in_cart_same_cat);
          $products_weight = $product['products_weight'];
          $products_tnt_f_tr = (int)$product['tnt_f_tr'];
          $products_tnt_f_sb = (int)$product['tnt_f_sb'];
          $products_tnt_f_cs = (int)$product['tnt_f_cs'];                  
// EOF QPBPP for SPPC

// BOF Separate Pricing Per Customer
//commented out for qpbbp for sppc
/*        $specials_query = tep_db_query("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . (int)$prid . "' and status = '1'");
          if (tep_db_num_rows ($specials_query)) {
            $specials = tep_db_fetch_array($specials_query);
            $products_price = $specials['specials_new_products_price'];
          }
   $specials_price = tep_get_products_special_price((int)$prid);
      if (tep_not_null($specials_price)) {
	 $products_price = $specials_price;
      } elseif ($this->cg_id != 0){
        $customer_group_price_query = tep_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . (int)$prid . "' and customers_group_id =  '" . $this->cg_id . "'");
        if ($customer_group_price = tep_db_fetch_array($customer_group_price_query)) {
        $products_price = $customer_group_price['customers_group_price'];
        }
      }
*/
// EOF Separate Pricing Per Customer

// bof - credit class gift voucher 5
          $this->total_virtual += $currencies->calculate_price($products_price, $products_tax, $qty * $no_count);
          $this->weight_virtual += ($qty * $products_weight) * $no_count;
// eof - credit class gift voucher 
          $this->total += $currencies->calculate_price($products_price, $products_tax, $qty);
          $this->weight += ($qty * $products_weight);
		  // FS - TNT MODULE 'tntpostf.php' - START
          $this->tnt_f_total_ex_tax += (float)($qty * $products_price);
          if ($products_tnt_f_tr == 0) {
             $this->tnt_f_tr_0 += 1;
          }	                     
          if ($products_tnt_f_tr == 1) {
             $this->tnt_f_tr_1 += 1;
          }	           
          if ($products_tnt_f_tr == 2) {
             $this->tnt_f_tr_2 += 1;
          }	           
          if ($products_tnt_f_tr == 3) {
             $this->tnt_f_tr_3 += 1;
          }	           
          if ($products_tnt_f_tr == 4) {
             $this->tnt_f_tr_4 += 1;
          }	                                         
          if ($products_tnt_f_sb > $this->tnt_f_sb) {
             $this->tnt_f_sb = $products_tnt_f_sb;
          }	           
          if ($products_tnt_f_cs > $this->tnt_f_cs) {
             $this->tnt_f_cs = $products_tnt_f_cs;
          }	                     
          // FS - TNT MODULE 'tntpostf.php' - STOP          
        }

// attributes price
// BOF Separate Pricing Per Customer
/*        if (isset($this->contents[$products_id]['attributes'])) {
          reset($this->contents[$products_id]['attributes']);
          while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
            $attribute_price_query = tep_db_query("select options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$prid . "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value . "'");
            $attribute_price = tep_db_fetch_array($attribute_price_query);
            if ($attribute_price['price_prefix'] == '+') {
              $this->total += $currencies->calculate_price($attribute_price['options_values_price'], $products_tax, $qty);
            } else {
              $this->total -= $currencies->calculate_price($attribute_price['options_values_price'], $products_tax, $qty);
            }
          }
        }
      }
    }
*/
// attributes price
        if (isset($this->contents[$products_id]['attributes'])) {
          reset($this->contents[$products_id]['attributes']);
       $where = " AND ((";
        while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
         $where .= "options_id = '" . (int)$option . "' AND options_values_id = '" . (int)$value . "') OR (";
       }
       $where=substr($where, 0, -5) . ')';
    
       $attribute_price_query = tep_db_query("SELECT products_attributes_id, options_values_price, price_prefix FROM " . TABLE_PRODUCTS_ATTRIBUTES . " WHERE products_id = '" . (int)$products_id . "'" . $where ."");

       if (tep_db_num_rows($attribute_price_query)) { 
	       $list_of_prdcts_attributes_id = '';
				 // empty array $attribute_price
				 $attribute_price = array();
	       while ($attributes_price_array = tep_db_fetch_array($attribute_price_query)) { 
		   $attribute_price[] =  $attributes_price_array;
		   $list_of_prdcts_attributes_id .= $attributes_price_array['products_attributes_id'].",";
            }
	       if (tep_not_null($list_of_prdcts_attributes_id) && $this->cg_id != '0') { 
         $select_list_of_prdcts_attributes_ids = "(" . substr($list_of_prdcts_attributes_id, 0 , -1) . ")";
	 $pag_query = tep_db_query("select products_attributes_id, options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES_GROUPS . " where products_attributes_id IN " . $select_list_of_prdcts_attributes_ids . " AND customers_group_id = '" . $this->cg_id . "'");
	 while ($pag_array = tep_db_fetch_array($pag_query)) {
		 $cg_attr_prices[] = $pag_array;
	 }

	 // substitute options_values_price and prefix for those for the customer group (if available)
	 if ($customer_group_id != '0' && tep_not_null($cg_attr_prices)) {
	    for ($n = 0 ; $n < count($attribute_price); $n++) {
		 for ($i = 0; $i < count($cg_attr_prices) ; $i++) {
			 if ($cg_attr_prices[$i]['products_attributes_id'] == $attribute_price[$n]['products_attributes_id']) {
				$attribute_price[$n]['price_prefix'] = $cg_attr_prices[$i]['price_prefix'];
				$attribute_price[$n]['options_values_price'] = $cg_attr_prices[$i]['options_values_price'];
			 }
		 } // end for ($i = 0; $i < count($cg_att_prices) ; $i++)
          }
        } // end if ($customer_group_id != '0' && (tep_not_null($cg_attr_prices))
      } // end if (tep_not_null($list_of_prdcts_attributes_id) && $customer_group_id != '0')
// now loop through array $attribute_price to add up/substract attribute prices

   for ($n = 0 ; $n < count($attribute_price); $n++) {
            if ($attribute_price[$n]['price_prefix'] == '+') {
              $this->total += $currencies->calculate_price($attribute_price[$n]['options_values_price'], $products_tax, $qty);
            } else {
              $this->total -= $currencies->calculate_price($attribute_price[$n]['options_values_price'], $products_tax, $qty);
        }
   } // end for ($n = 0 ; $n < count($attribute_price); $n++)
          } // end if (tep_db_num_rows($attribute_price_query))
        } // end if (isset($this->contents[$products_id]['attributes'])) 
      }
    }
// EOF Separate Pricing Per Customer

// BOF Separate Pricing Per Customer
/*	function attributes_price($products_id) {
      $attributes_price = 0;

      if (isset($this->contents[$products_id]['attributes'])) {
        reset($this->contents[$products_id]['attributes']);
        while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
          $attribute_price_query = tep_db_query("select options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$products_id . "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value . "'");
          $attribute_price = tep_db_fetch_array($attribute_price_query);
          if ($attribute_price['price_prefix'] == '+') {
            $attributes_price += $attribute_price['options_values_price'];
          } else {
            $attributes_price -= $attribute_price['options_values_price'];
          }
        }
      }

      return $attributes_price;
    }
*/
 // function attributes_price changed partially according to FalseDawn's post
// http://forums.oscommerce.com/index.php?showtopic=139587
// changed completely for Separate Pricing Per Customer, attributes mod
    function attributes_price($products_id) {
// global variable (session) $sppc_customer_group_id -> class variable cg_id
    $this->cg_id = $this->get_customer_group_id();
		
      if (isset($this->contents[$products_id]['attributes'])) {
        reset($this->contents[$products_id]['attributes']);
       $where = " AND ((";
        while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
         $where .= "options_id = '" . (int)$option . "' AND options_values_id = '" . (int)$value . "') OR (";
       }
       $where=substr($where, 0, -5) . ')';
    
       $attribute_price_query = tep_db_query("SELECT products_attributes_id, options_values_price, price_prefix FROM " . TABLE_PRODUCTS_ATTRIBUTES . " WHERE products_id = '" . (int)$products_id . "'" . $where ."");
 			 
      if (tep_db_num_rows($attribute_price_query)) {
	       $list_of_prdcts_attributes_id = '';
	       while ($attributes_price_array = tep_db_fetch_array($attribute_price_query)) { 
		   $attribute_price[] =  $attributes_price_array;
		   $list_of_prdcts_attributes_id .= $attributes_price_array['products_attributes_id'].",";
          }

	       if (tep_not_null($list_of_prdcts_attributes_id) && $this->cg_id != '0') { 
         $select_list_of_prdcts_attributes_ids = "(" . substr($list_of_prdcts_attributes_id, 0 , -1) . ")";
	 $pag_query = tep_db_query("select products_attributes_id, options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES_GROUPS . " where products_attributes_id IN " . $select_list_of_prdcts_attributes_ids . " AND customers_group_id = '" . $this->cg_id . "'");
	 while ($pag_array = tep_db_fetch_array($pag_query)) {
		 $cg_attr_prices[] = $pag_array;
	 }

	 // substitute options_values_price and prefix for those for the customer group (if available)
	 if ($customer_group_id != '0' && tep_not_null($cg_attr_prices)) {
	    for ($n = 0 ; $n < count($attribute_price); $n++) {
		 for ($i = 0; $i < count($cg_attr_prices) ; $i++) {
			 if ($cg_attr_prices[$i]['products_attributes_id'] == $attribute_price[$n]['products_attributes_id']) {
				$attribute_price[$n]['price_prefix'] = $cg_attr_prices[$i]['price_prefix'];
				$attribute_price[$n]['options_values_price'] = $cg_attr_prices[$i]['options_values_price'];
        }
		 } // end for ($i = 0; $i < count($cg_att_prices) ; $i++)
      }
        } // end if ($customer_group_id != '0' && (tep_not_null($cg_attr_prices))
      } // end if (tep_not_null($list_of_prdcts_attributes_id) && $customer_group_id != '0')
// now loop through array $attribute_price to add up/substract attribute prices

   for ($n = 0 ; $n < count($attribute_price); $n++) {
            if ($attribute_price[$n]['price_prefix'] == '+') {
              $attributes_price += $attribute_price[$n]['options_values_price'];
            } else {
              $attributes_price -= $attribute_price[$n]['options_values_price'];
            }
   } // end for ($n = 0 ; $n < count($attribute_price); $n++)
      return $attributes_price;
       } else { // end if (tep_db_num_rows($attribute_price_query))
         return 0;
       } 
     }  else { // end if (isset($this->contents[$products_id]['attributes']))
       return 0;
    }
   }
   // end of function attributes_price, modified for SPPC with attributes
// EOF Separate Pricing Per Customer

    function get_products() {
      global $languages_id, $pfs; // PriceFormatterStore added

// BOF Separate Pricing Per Customer
  $this->cg_id = $this->get_customer_group_id();
// EOF Separate Pricing Per Customer

	if (!is_array($this->contents)) return false;

// BOF QPBPP for SPPC
      $discount_category_quantity = array();
      foreach ($this->contents as $products_id => $contents_array) {
          if(tep_not_null($contents_array['discount_categories_id'])) {
            if (!isset($discount_category_quantity[$contents_array['discount_categories_id']])) {
                $discount_category_quantity[$contents_array['discount_categories_id']] = $contents_array['qty'];
            } else {
                $discount_category_quantity[$contents_array['discount_categories_id']] += $contents_array['qty'];
            }
          }
      } // end foreach
      
      $pf = new PriceFormatter;
// EOF QPBPP for SPPC

	  $products_array = array();
      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
// BOF QPBPP for SPPC
      $pf->loadProduct($products_id, $languages_id); // does query if necessary and adds to 
      // PriceFormatterStore or gets info from it next
      if ($products = $pfs->getPriceFormatterData($products_id)) {
       if (tep_not_null($this->contents[$products_id]['discount_categories_id'])) {
          $nof_items_in_cart_same_cat =  $discount_category_quantity[$this->contents[$products_id]['discount_categories_id']];
          $nof_other_items_in_cart_same_cat = $nof_items_in_cart_same_cat - $this->contents[$products_id]['qty'];
        } else {
          $nof_other_items_in_cart_same_cat = 0;
        }
          $products_price = $pf->computePrice($this->contents[$products_id]['qty'], $nof_other_items_in_cart_same_cat);
// EOF QPBPP for SPPC

		  $products_array[] = array('id' => $products_id,
                                    'name' => $products['products_name'],
                                    'model' => $products['products_model'],
                                    'image' => $products['products_image'],
                                    'discount_categories_id' => $this->contents[$products_id]['discount_categories_id'],
                                    'price' => $products_price,
                                    'quantity' => $this->contents[$products_id]['qty'],
                                    'weight' => $products['products_weight'],
                                    'carrot' => $products['products_carrot'],
                                    'final_price' => ($products_price + $this->attributes_price($products_id)),
                                    'tax_class_id' => $products['products_tax_class_id'],
                                    'attributes' => (isset($this->contents[$products_id]['attributes']) ? $this->contents[$products_id]['attributes'] : ''));
// start Get 1 free
          if (is_array ($free_product = $this->get1free ($products_id))) {
            // Add the free product to the shopping cart (Customer cannot alter this)
            $products_array[] = array('id' => $free_product['id'],
                                      'name' => $free_product['name'],
                                      'model' => $free_product['model'],
                                      'image' => $free_product['image'],
                                      'price' => 0,
                                      'quantity' => $free_product['quantity'],
                                      'weight' => $free_product['weight'],
                                      'final_price' => 0,
                                      'tax_class_id' => $products['products_tax_class_id'],
                                      'attributes' => '',
                                      'free' => 1
                                     );
          } //if (is_array
// end Get 1 free
        }
      }

      return $products_array;
    }

    function show_total() {
      $this->calculate();

      return $this->total;
    }

    function show_weight() {
      $this->calculate();

      return $this->weight;
    }

// bof - credit class gift voucher 6
    function show_total_virtual() {
      $this->calculate();

      return $this->total_virtual;
    }

    function show_weight_virtual() {
      $this->calculate();

      return $this->weight_virtual;
    }
// eof - credit class gift voucher 

    function generate_cart_id($length = 5) {
      return tep_create_random_value($length, 'digits');
    }

    function get_content_type() {
      $this->content_type = false;

      if ( (DOWNLOAD_ENABLED == 'true') && ($this->count_contents() > 0) ) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          if (isset($this->contents[$products_id]['attributes'])) {
            reset($this->contents[$products_id]['attributes']);
            while (list(, $value) = each($this->contents[$products_id]['attributes'])) {
              $virtual_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad where pa.products_id = '" . (int)$products_id . "' and pa.options_values_id = '" . (int)$value . "' and pa.products_attributes_id = pad.products_attributes_id");
              $virtual_check = tep_db_fetch_array($virtual_check_query);

              if ($virtual_check['total'] > 0) {
                switch ($this->content_type) {
                  case 'physical':
                    $this->content_type = 'mixed';

                    return $this->content_type;
                    break;
                  default:
                    $this->content_type = 'virtual';
                    break;
                }
              } else {
                switch ($this->content_type) {
                  case 'virtual':
                    $this->content_type = 'mixed';

                    return $this->content_type;
                    break;
                  default:
                    $this->content_type = 'physical';
                    break;
                }
              }
            }

// bof - credit class gift voucher 7
          } elseif ($this->show_weight() == 0) {
            reset($this->contents);
            while (list($products_id, ) = each($this->contents)) {
              $virtual_check_query = tep_db_query("select products_weight from " . TABLE_PRODUCTS . " where products_id = '" . $products_id . "'");
              $virtual_check = tep_db_fetch_array($virtual_check_query);
              if ($virtual_check['products_weight'] == 0) {
                switch ($this->content_type) {
                  case 'physical':
                    $this->content_type = 'mixed';

                    return $this->content_type;
                    break;
                  default:
                    $this->content_type = 'virtual';
                    break;
                }
              } else {
                switch ($this->content_type) {
                  case 'virtual':
                    $this->content_type = 'mixed';

                    return $this->content_type;
                    break;
                  default:
                    $this->content_type = 'physical';
                    break;
                }
              }
            }
// eof - credit class gift voucher

          } else {
            switch ($this->content_type) {
              case 'virtual':
                $this->content_type = 'mixed';

                return $this->content_type;
                break;
              default:
                $this->content_type = 'physical';
                break;
            }
          }
        }
      } else {
        $this->content_type = 'physical';
      }

      return $this->content_type;
    }

    function unserialize($broken) {
      for(reset($broken);$kv=each($broken);) {
        $key=$kv['key'];
        if (gettype($this->$key)!="user function")
        $this->$key=$kv['value'];
      }
    }
// start Get 1 Free
    function get1free ($products_id) {
      global $languages_id;
      $get_1_free_query = tep_db_query("select products_free_id,
                                               products_free_quantity,
                                               products_qualify_quantity,
                                               products_multiple,
                                               get_1_free_expires_date
                                        from " . TABLE_GET_1_FREE . "
                                        where products_id = '" . (int)$products_id . "'
                                          and status = '1'"
                                      );
      if (tep_db_num_rows($get_1_free_query) > 0) {
        $get_1_free = tep_db_fetch_array($get_1_free_query);
        //Check that the offer has not expired
         //MNK bugfix 13.08.2007
        if (($get_1_free['get_1_free_expires_date'] <= date('Y-m-d H:i:s')) && ($get_1_free['get_1_free_expires_date'] != '0000-00-00 00:00:00')) {
          //offer has expired, so update the database and return false
          tep_db_query("update " . TABLE_GET_1_FREE . "
                        set status = '0',
                            date_status_change = now()
                        where products_id = '" . (int)$products_id . "'"
                      );
          return false;
        } else {
          // Offer is valid, so check if the quantity qualifies
          $products_quantity = $this->contents[$products_id]['qty'];
          if ($products_quantity >= $get_1_free['products_qualify_quantity']) {
            // Qualifies, so get the quantity of free products
            $free_quantity = 1;
            if ($get_1_free['products_multiple'] > 1) {
              $free_quantity = floor ($products_quantity / $get_1_free['products_qualify_quantity']);
              if ($free_quantity > $get_1_free['products_multiple']) {
                $free_quantity = $get_1_free['products_multiple'];
              }
            }
            // Get the info on the free product
            $products_free_query = tep_db_query("select pd.products_name,
                                                        p.products_model,
                                                        p.products_image,
                                                        p.products_weight
                                                 from " . TABLE_PRODUCTS . " p,
                                                      " . TABLE_PRODUCTS_DESCRIPTION . " pd
                                                 where p.products_id = '" . (int)$get_1_free['products_free_id'] . "'
                                                   and pd.products_id = p.products_id
                                                   and pd.language_id = '" . (int)$languages_id . "'"
                                               );
            $products_free = tep_db_fetch_array($products_free_query);
            // Return an array of free product values
            $output = array ( 'id' => $get_1_free['products_free_id'],
                              'quantity' => $free_quantity,
                              'name' => $products_free['products_name'],
                              'model' => $products_free['products_model'],
                              'image' => $products_free['products_image'],
                              'weight' => $products_free['products_weight']
                            );
            return $output;
          } //if ($products_quantity
        } //else
      }//if (tep_db_num_rows
      // offer was not valid (disabled or expired)
      return false;
    }//function
// end Get 1 Free

 
// BOF Separate Pricing Per Customer
// added for Separate Pricing Per Customer, returns customer_group_id
    function get_customer_group_id() {
      if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
        $_cg_id = $_SESSION['sppc_customer_group_id'];
      } else {
         $_cg_id = 0;
      }
      return $_cg_id;
    }
// EOF Separate Pricing Per Customer

// bof - credit class gift voucher 8
// amend count_contents to show nil contents for shipping
// as we don't want to quote for 'virtual' item
// GLOBAL CONSTANTS if NO_COUNT_ZERO_WEIGHT is true then we don't count any product with a weight
// which is less than or equal to MINIMUM_WEIGHT
// otherwise we just don't count gift certificates
    function count_contents_virtual() {  // get total number of items in cart disregard gift vouchers
      $total_items = 0;
      if (is_array($this->contents)) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          $no_count = false;
          $gv_query = tep_db_query("select products_model from " . TABLE_PRODUCTS . " where products_id = '" . $products_id . "'");
          $gv_result = tep_db_fetch_array($gv_query);
          if (ereg('^GIFT', $gv_result['products_model'])) {
            $no_count=true;
          }
          if (NO_COUNT_ZERO_WEIGHT == 1) {
            $gv_query = tep_db_query("select products_weight from " . TABLE_PRODUCTS . " where products_id = '" . tep_get_prid($products_id) . "'");
            $gv_result=tep_db_fetch_array($gv_query);
            if ($gv_result['products_weight']<=MINIMUM_WEIGHT) {
              $no_count=true;
            }
          }
          if (!$no_count) $total_items += $this->get_quantity($products_id);
        }
      }
      return $total_items;
    }
// eof - credit class gift voucher

  }
?>
