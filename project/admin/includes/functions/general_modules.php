<?php //$Id: /catalog/admin/includes/functions/general_modules.php (osS)

////
// store configuration monitor-start
function tep_configuration_update($cID, $configuration_value) {
        $configuration_values_query = tep_db_query("select configuration_value, configuration_title, configuration_description from configuration where configuration_id = '" . (int)$cID . "'");
        $configuration_values = tep_db_fetch_array($configuration_values_query);
        tep_db_query("insert into " . TABLE_CONFIGURATION_CHANGES . " (change_date,previous_setting,new_setting,change_title,change_description) values (now(),'".$configuration_values['configuration_value']."','".$configuration_value."','".$configuration_values['configuration_title']."','".$configuration_values['configuration_description']."')");

        // Check to see if the configuration value changed is the Store Owner's Email address - if it is send a configuration change notification to the existing Email address on file.
        if($cID == 3) {
          tep_mail(STORE_OWNER, $configuration_values['configuration_value'], EMAIL_CONFIGURATION_CHANGE_TEXT_SUBJECT, EMAIL_CONFIGURATION_CHANGE_TEXT_BODY, STORE_OWNER, $configuration_values['configuration_value']);
        }
		if(SEND_STORE_CONFIGURATION_MAIL == 'true') {
        tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_CONFIGURATION_CHANGE_TEXT_SUBJECT, EMAIL_CONFIGURATION_CHANGE_TEXT_BODY, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
		}
}
function tep_module_change($action, $class) {
        tep_db_query("insert into " . TABLE_CONFIGURATION_CHANGES . " (change_date,previous_setting,new_setting,change_title,change_description) values (now(),'','".$action."','".$class."','')");
        tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_CONFIGURATION_CHANGE_TEXT_SUBJECT, EMAIL_CONFIGURATION_CHANGE_TEXT_BODY, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
}

////
// 2gether-start
  function tep_set_together_status($tid, $status) {
    if ($status == '1') {
      return tep_db_query("update " . TABLE_2GETHER . " set status = '1' where tid = '" . (int)$tid . "'");
    } elseif ($status == '0') {
      return tep_db_query("update " . TABLE_2GETHER . " set status = '0' where tid = '" . (int)$tid . "'");
    } else {
      return -1;
    }
  }

  function tep_get_products_price($product_id) {
    $product_query = tep_db_query("select products_price from " . TABLE_PRODUCTS . " where products_id = '" . (int)$product_id . "'");
    $product = tep_db_fetch_array($product_query);
    return $product['products_price'];
  }

  function tep_get_products_image($product_id) {
    $product_query = tep_db_query("select products_image from " . TABLE_PRODUCTS . " where products_id = '" . (int)$product_id . "'");
    $product = tep_db_fetch_array($product_query);
    return $product['products_image'];
  }

////
// product listing enhancement-start
// Return the manufacturers description in the needed language
// TABLES: manufacturers_info
  function tep_get_manufacturer_description($manufacturer_id, $language_id) {
    $manufacturer_query = tep_db_query("select manufacturers_description from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturer_id . "' and languages_id = '" . (int)$language_id . "'");
    $manufacturer = tep_db_fetch_array($manufacturer_query);

    return $manufacturer['manufacturers_description'];
  }

////
// qt pro-start
// Function to build menu of available class files given a file prefix
// Used for configuring plug-ins for product information attributes
  function tep_cfg_pull_down_class_files($prefix, $current_file) {
    $d=DIR_FS_CATALOG . DIR_WS_CLASSES;
    $function_directory = dir ($d);

    while (false !== ($function = $function_directory->read())) {
      if (preg_match('/^'.$prefix.'(.+)\.php$/',$function,$function_name)) {
          $file_list[]=array('id'=>$function_name[1], 'text'=>$function_name[1]);
      }
    }
    $function_directory->close();

    return tep_draw_pull_down_menu('configuration_value', $file_list, $current_file);
  }

  require(DIR_WS_FUNCTIONS . 'qtpro_functions.php');

////
// attribute sort with clone tool
  function tep_attributes_sort($attributes_id) {
    global $languages_id;

    $attributes_sort = tep_db_query("select attribute_sort from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_attributes_id = '" . (int)$attributes_id . "'");
    $attributes_sort_values = tep_db_fetch_array($attributes_sort);

    return $attributes_sort_values['attribute_sort'];
  }

////
// all customers 
// Sort Function 
  function tep_sort_order ($orderby, $sorted, $title, $order_criteria){
  global $csv_accum;
  if (!isset($orderby) or ($orderby == $order_criteria and $sorted == "ASC"))  $to_sort = "DESC"; else $to_sort = "ASC"; 
 
 $field = strip_tags($title);
 $field = ereg_replace ("\"","\"\"",$field);
 if ($csv_accum=='') $csv_accum= "\"" . $field . "\""; 
 else 
 {if (strrpos($csv_accum,chr(10)) == (strlen($csv_accum)-1)) $csv_accum .= "\"" . $field . "\"";
	else $csv_accum .= "," . "\"" . $field . "\""; };
 $link = '<a href="' . tep_href_link(FILENAME_ALL_CUSTOMERS, 'orderby=' . $order_criteria .'&sorted='. $to_sort) . '" class="headerLink">' . $title . '</a>';
   return $link;
  }
  
  // Produce CSV string for output
  function mirror_out ($field) {
	global $csv_accum;
	echo $field;
	$field = strip_tags($field);
	$field = ereg_replace ("\"","\"\"",$field);
	if ($csv_accum=='') $csv_accum= "\"" . $field . "\""; 
	else 
	{if (strrpos($csv_accum,chr(10)) == (strlen($csv_accum)-1)) $csv_accum .= "\"" . $field . "\"";
		else $csv_accum .= "," . "\"" . $field . "\""; };
	return;
};

////
// rma return 
include('includes/functions/refund_functions.php');

////
// ULTIMATE Seo Urls 5 PRO
  function tep_reset_cache_data_usu5( $action = false ) {
    if ( $action == 'reset' ) {
      $usu5_path = realpath( dirname( __FILE__ ) . '/../../../' ) . '/' . DIR_WS_MODULES . 'ultimate_seo_urls5/';
      switch( USU5_CACHE_SYSTEM ) {
        case 'file': 
          $path_to_cache = $usu5_path . 'cache_system/cache/';
          $it = new DirectoryIterator( $path_to_cache );
          while( $it->valid() ) {
            if ( !$it->isDot() && is_readable( $path_to_cache . $it->getFilename() ) && ( substr( $it->getFilename(), -6 ) == '.cache' ) ) {
              @unlink( $path_to_cache . $it->getFilename() );
            }
            $it->next();
          }
          break;
        case 'mysql':
          tep_db_query( 'TRUNCATE TABLE `usu_cache`' );
          break;
        case 'memcache':
          if ( class_exists('Memcache') ){
            include $usu5_path . 'interfaces/cache_interface.php';
            include $usu5_path . 'cache_system/memcache.php';
            Memcache_Cache_Module::iAdmin()->initiate()
                                           ->flushOut();
          }
          break;
        case 'sqlite':
          include $usu5_path . 'interfaces/cache_interface.php';
          include $usu5_path . 'cache_system/sqlite.php';
          Sqlite_Cache_Module::admini()->gc(); 
          break;
      }
      tep_db_query( "UPDATE " . TABLE_CONFIGURATION . " SET configuration_value='false' WHERE configuration_key='USU5_RESET_CACHE'" );
    }       
  }

////
// multi product updates
  function tep_array_merge($array1, $array2, $array3 = '') {
    if ($array3 == '') $array3 = array();
    if (function_exists('array_merge')) {
      $array_merged = array_merge($array1, $array2, $array3);
    } else {
      while (list($key, $val) = each($array1)) $array_merged[$key] = $val;
      while (list($key, $val) = each($array2)) $array_merged[$key] = $val;
      if (sizeof($array3) > 0) while (list($key, $val) = each($array3)) $array_merged[$key] = $val;
    }

    return (array) $array_merged;
  }

////
// complete reviews system
  function tep_noslash_string($string) {
	  $search = array(chr(92),chr(47));
    return str_replace($search,'',$string);
  }

////
// documents manager
// Build an array of downloadable document types
//   Table: document_types
  function document_types () {
    $type_array = array ();
    $documents_query_raw = "
      select 
        document_types_id,
        type_description
      from 
        " . TABLE_DOCUMENT_TYPES . "
      where
        type_visible = 'True'
      order by 
        sort_order
    ";
    
    $documents_query = tep_db_query ($documents_query_raw);
    while ($documents = tep_db_fetch_array ($documents_query) ) {
      $type_array[] = array ('id' => $documents['document_types_id'],
                             'text' => $documents['type_description']
                            );
    } // while ($documents
    
    return $type_array;
  } // function document_types

////
// Get a list of documents in a directory
//   Table: none
  function get_directory_list ($directory, $file=true) {
    $d = dir ($directory);
    $list = array();
    while ($entry = $d->read() ) {
      if ($file == true) { // We want a list of files, not directories
        $parts_array = explode ('.', $entry);
        $extension = $parts_array[1];
        // Don't add files or directories that we don't want
        if ($entry != '.' && $entry != '..' && $entry != '.htaccess' && $extension != 'php') {
          if (!is_dir ($directory . "/" . $entry) ) {
            $list[] = $entry;
          }
        }
      } else { // We want the directories and not the files
        if (is_dir ($directory . "/" . $entry) && $entry != '.' && $entry != '..') {
          $list[] = array ('id' => $entry,
                           'text' => $entry
                          );
        }
      }
    }
    $d->close();
    return $list;
  }

////
// sets the status of a testimonial
function tep_set_testimonials_status($testimonials_id, $status) {
if ($status == '1') {
return tep_db_query("update " . TABLE_TESTIMONIALS . " set status = '1' where testimonials_id = '"
. $testimonials_id . "'");
} elseif ($status == '0') {
return tep_db_query("update " . TABLE_TESTIMONIALS . " set status = '0' where testimonials_id = '"
. $testimonials_id . "'");
} else {
return -1;
}
}

////
// sets the status of a references
function tep_set_references_status($references_id, $status) {
if ($status == '1') {
return tep_db_query("update " . TABLE_SHOP_REFERENCES . " set status = '1' where references_id = '"
. $references_id . "'");
} elseif ($status == '0') {
return tep_db_query("update " . TABLE_SHOP_REFERENCES . " set status = '0' where references_id = '"
. $references_id . "'");
} else {
return -1;
}
}

////
// optional related products
  function tep_version_readonly($value){
    $version_text = '<br>Version ' . $value;
    return $version_text;
  }

////
// rmh referral
  function tep_get_sources_name($source_id, $customers_id) {

    if ($source_id == '9999') {
      $sources_query = tep_db_query("select sources_other_name as sources_name from " . TABLE_SOURCES_OTHER . " where customers_id = '" . (int)$customers_id . "'");
    } else {
      $sources_query = tep_db_query("select sources_name from " . TABLE_SOURCES . " where sources_id = '" . (int)$source_id . "'");
    }

    if (!tep_db_num_rows($sources_query)) {
      if ($source_id == '9999') {
        return TEXT_OTHER;
      } else {
        return TEXT_NONE;
      }
    } else {
      $sources = tep_db_fetch_array($sources_query);
      return $sources['sources_name'];
    }
  }

////
// order editor
  //////create a pull down for all payment installed payment methods for Order Editor configuration
   
  // Get list of all payment modules available
  function tep_cfg_pull_down_payment_methods() {
  global $language;
  $enabled_payment = array();
  $module_directory = DIR_FS_CATALOG_MODULES . 'payment/';
  $file_extension = '.php';

  if ($dir = @dir($module_directory)) {
    while ($file = $dir->read()) {
      if (!is_dir( $module_directory . $file)) {
        if (substr($file, strrpos($file, '.')) == $file_extension) {
          $directory_array[] = $file;
        }
      }
    }
    sort($directory_array);
    $dir->close();
  }

  // For each available payment module, check if enabled
  for ($i=0, $n=sizeof($directory_array); $i<$n; $i++) {
    $file = $directory_array[$i];

    include(DIR_FS_CATALOG_LANGUAGES . $language . '/modules/payment/' . $file);
    include($module_directory . $file);

    $class = substr($file, 0, strrpos($file, '.'));
    if (tep_class_exists($class)) {
      $module = new $class;
      if ($module->check() > 0) {
        // If module enabled create array of titles
        $enabled_payment[] = array('id' => $module->title, 'text' => $module->title);
                
      }
   }
 }
                                
    $enabled_payment[] = array('id' => 'Other', 'text' => 'Other');     
                
                //draw the dropdown menu for payment methods and default to the order value
          return tep_draw_pull_down_menu('configuration_value', $enabled_payment, '', ''); 
                }
//// miniumum amount shipping module
// Return a product's special price (returns nothing if there is no offer)
// TABLES: products
if (!function_exists('tep_get_products_special_price')) {
  function tep_get_products_special_price($product_id) {
    $product_query = tep_db_query("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . (int)$product_id . "' and status");
    $product = tep_db_fetch_array($product_query);

    return $product['specials_new_products_price'];
  }
}

////
// control login
// Customers Status 
  function tep_set_customers_status($customers_id, $customers_status) { 
    if ($customers_status == '1') { 
      return tep_db_query("update " . TABLE_CUSTOMERS . " set customers_status = '1' WHERE customers_id = '" . $customers_id . "'"); 
    } elseif ($customers_status == '0') { 
      return tep_db_query("update " . TABLE_CUSTOMERS . " set customers_status = '0' WHERE customers_id = '" . $customers_id . "'"); 
    } else { 
      return -1; 
    } 
  } 

////
// html emails 
//This function will look in the catalog/includes/modules/HtmlEmail directory and check which different Layouts exists
//This is done by looking for all different maps. Each map is a layout.
//Finally it will create a pulldown menu that is used in the admin panel

function tep_cfg_pull_down_uhtml_email_layout_list($default_id) {
$handle = @opendir(DIR_FS_CATALOG_MODULES.'html_mail/');
$LayoutArray = array();
$i=0;
	
	while($file = @readdir($handle)) {
		if($file!='.' & $file!='..' ){
			$LayoutArray[$i]['id']   = $file;
			$LayoutArray[$i]['text'] = $file;
			$i++;
		}	
	}
	
	@closedir($handle);
	sort($LayoutArray);
return tep_draw_pull_down_menu('configuration_value', $LayoutArray, $default_id);
}

////
// header tags seo
  function tep_get_category_htc_title($category_id, $language_id) {
    $category_query = tep_db_query("select categories_htc_title_tag from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "' and language_id = '" . (int)$language_id . "'");
    $category = tep_db_fetch_array($category_query);

    return $category['categories_htc_title_tag'];
  }
    
  function tep_get_category_htc_desc($category_id, $language_id) {
    $category_query = tep_db_query("select categories_htc_desc_tag from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "' and language_id = '" . (int)$language_id . "'");
    $category = tep_db_fetch_array($category_query);

    return $category['categories_htc_desc_tag'];
  }
   
  function tep_get_category_htc_keywords($category_id, $language_id) {
    $category_query = tep_db_query("select categories_htc_keywords_tag from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "' and language_id = '" . (int)$language_id . "'");
    $category = tep_db_fetch_array($category_query);

    return $category['categories_htc_keywords_tag'];
  }
  
  function tep_get_category_htc_description($category_id, $language_id) {
    $category_query = tep_db_query("select categories_htc_description from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "' and language_id = '" . (int)$language_id . "'");
    $category = tep_db_fetch_array($category_query);

    return $category['categories_htc_description'];
  }

  function tep_get_products_head_title_tag($product_id, $language_id) {
    $product_query = tep_db_query("select products_head_title_tag from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_head_title_tag'];
  }

  function tep_get_products_head_desc_tag($product_id, $language_id) {
    $product_query = tep_db_query("select products_head_desc_tag from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_head_desc_tag'];
  }

  function tep_get_products_head_keywords_tag($product_id, $language_id) {
    $product_query = tep_db_query("select products_head_keywords_tag from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_head_keywords_tag'];
  }
  function tep_get_manufacturer_htc_title($manufacturer_id, $language_id) {
    $manufacturer_query = tep_db_query("select manufacturers_htc_title_tag from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturer_id . "' and languages_id = '" . (int)$language_id . "'");
    $manufacturer = tep_db_fetch_array($manufacturer_query);

    return $manufacturer['manufacturers_htc_title_tag'];
  }
    
  function tep_get_manufacturer_htc_desc($manufacturer_id, $language_id) {
    $manufacturer_query = tep_db_query("select manufacturers_htc_desc_tag from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturer_id . "' and languages_id = '" . (int)$language_id . "'");
    $manufacturer = tep_db_fetch_array($manufacturer_query);

    return $manufacturer['manufacturers_htc_desc_tag'];
  }
   
  function tep_get_manufacturer_htc_keywords($manufacturer_id, $language_id) {
    $manufacturer_query = tep_db_query("select manufacturers_htc_keywords_tag from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturer_id . "' and languages_id = '" . (int)$language_id . "'");
    $manufacturer = tep_db_fetch_array($manufacturer_query);

    return $manufacturer['manufacturers_htc_keywords_tag'];
  } 
   
  function tep_get_manufacturer_htc_description($manufacturer_id, $language_id) {
    $manufacturer_query = tep_db_query("select manufacturers_htc_description from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturer_id . "' and languages_id = '" . (int)$language_id . "'");
    $manufacturer = tep_db_fetch_array($manufacturer_query);

    return $manufacturer['manufacturers_htc_description'];
  }   
  
  function header_tags_reset_cache($action)
  {
    switch ($action) {
    case 'clear':
     tep_db_query("truncate TABLE " . TABLE_HEADERTAGS_CACHE);
     break;
    default: return 'false';
    }
    return 'false';
  }

////added for os6tm banner manager
// return all categories
  function tep_get_categories($banner_id, $categories_array = '', $parent_id = '0', $indent = '') {
    global $languages_id;

    if (!is_array($categories_array)) $categories_array = array();

    $categories_query = tep_db_query("select c.categories_id, cd.categories_name from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where parent_id = '" . (int)$parent_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by sort_order, cd.categories_name");
    while ($categories = tep_db_fetch_array($categories_query)) {
    	$banners_query = tep_db_query("select banners_id from " . TABLE_BANNERS_TO_CATEGORIES . " where categories_id = '" . $categories['categories_id'] . "' and banners_id = '" . $banner_id . "'");
    	$is_selected = false;
    	if (tep_db_num_rows($banners_query) > 0) $is_selected = true;

      $categories_array[] = array('id' => $categories['categories_id'],
                                  'text' => $indent . $categories['categories_name'],
                                  'parent_id' => $parent_id,
                                  'is_selected' => $is_selected);

      if ($categories['categories_id'] != $parent_id) {
        $categories_array = tep_get_categories($banner_id, $categories_array, $categories['categories_id'], $indent . '&nbsp;&nbsp;');
      }
    }

    return $categories_array;
  }

////
// Return all subcategory IDs
// TABLES: categories
  function tep_get_subcategories(&$subcategories_array, $parent_id = 0) {
    $subcategories_query = tep_db_query("select categories_id from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$parent_id . "'");
    while ($subcategories = tep_db_fetch_array($subcategories_query)) {
      $subcategories_array[sizeof($subcategories_array)] = $subcategories['categories_id'];
      if ($subcategories['categories_id'] != $parent_id) {
        tep_get_subcategories($subcategories_array, $subcategories['categories_id']);
      }
    }
  }
  
////
// Return true if the category has subcategories
// TABLES: categories
  function tep_has_category_subcategories($category_id) {
    $child_category_query = tep_db_query("select count(*) as count from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$category_id . "'");
    $child_category = tep_db_fetch_array($child_category_query);

    if ($child_category['count'] > 0) {
      return true;
    } else {
      return false;
    }
  }

////
//BOF QPBPP for SPPC
function qpbpp_insert_update_discount_cats($products_id, $current_discount_categories_id, $new_discount_categories_id, $customers_group_id) {
  if (!tep_not_null($products_id)) {
    return false; // if $products_id is not set stop here
  }
  if ($current_discount_categories_id == $new_discount_categories_id) {
    return true; // if they are the same no update is necessary
  }
  if ($current_discount_categories_id == 0 && $new_discount_categories_id > 0) {
    // insert needed
    tep_db_query("insert into " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " (products_id, discount_categories_id, customers_group_id) values ('" . (int)$products_id . "', '" . (int)$new_discount_categories_id . "', '" . (int)$customers_group_id . "')");
    return true;
  }
  if ($current_discount_categories_id > 0 && $new_discount_categories_id == 0) {
    // delete needed
    tep_db_query("delete from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " where products_id = '" . (int)$products_id . "' and customers_group_id = '" . (int)$customers_group_id . "'");
    return true;
  }
  if ($current_discount_categories_id > 0 && ($current_discount_categories_id !== $new_discount_categories_id)) {
    // update needed
    tep_db_query("update " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " set discount_categories_id = '" . (int)$new_discount_categories_id . "' where products_id = '" . (int)$products_id . "' and discount_categories_id = '" . (int)$current_discount_categories_id . "' and customers_group_id = '" . (int)$customers_group_id . "'");
    return true;
  }
  return false; // for good measure
}

  function sortByQty($a, $b) {
    if ($a['products_qty'] == $b['products_qty']) {
      return 0;
    }
     if ($a['products_qty'] < $b['products_qty']) {
      return -1;
    }
      return 1;
  }

////
// credit class gift voucher
////
// Create a Coupon Code. length may be between 1 and 16 Characters
// $salt needs some thought.

  function create_coupon_code($salt="secret", $length=SECURITY_CODE_LENGTH_ADMIN) {
    $ccid = md5(uniqid("","salt"));
    $ccid .= md5(uniqid("","salt"));
    $ccid .= md5(uniqid("","salt"));
    $ccid .= md5(uniqid("","salt"));
    srand((double)microtime()*1000000); // seed the random number generator
    $random_start = @rand(0, (128-$length));
    $good_result = 0;
    while ($good_result == 0) {
      $id1=substr($ccid, $random_start,$length);        
      $query = tep_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_code = '" . $id1 . "'");    
      if (tep_db_num_rows($query) == 0) $good_result = 1;
    }
    return $id1;
  }

////
// Update the Customers GV account
  function tep_gv_account_update($customer_id, $gv_id) {
    $customer_gv_query = tep_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id = '" . $customer_id . "'");
    $coupon_gv_query = tep_db_query("select coupon_amount from " . TABLE_COUPONS . " where coupon_id = '" . $gv_id . "'");
    $coupon_gv = tep_db_fetch_array($coupon_gv_query);
    if (tep_db_num_rows($customer_gv_query) > 0) {
      $customer_gv = tep_db_fetch_array($customer_gv_query);
      $new_gv_amount = $customer_gv['amount'] + $coupon_gv['coupon_amount'];
      $gv_query = tep_db_query("update " . TABLE_COUPON_GV_CUSTOMER . " set amount = '" . $new_gv_amount . "' where customer_id = '" . $customer_id . "'");
    } else {
      $gv_query = tep_db_query("insert into " . TABLE_COUPON_GV_CUSTOMER . " (customer_id, amount) values ('" . $customer_id . "', '" . $coupon_gv['coupon_amount'] . "')");
    }
  }

////
// Output a day/month/year dropdown selector
  function tep_draw_date_selector($prefix, $date='') {
    $month_array = array();
    $month_array[1] =_JANUARY;
    $month_array[2] =_FEBRUARY;
    $month_array[3] =_MARCH;
    $month_array[4] =_APRIL;
    $month_array[5] =_MAY;
    $month_array[6] =_JUNE;
    $month_array[7] =_JULY;
    $month_array[8] =_AUGUST;
    $month_array[9] =_SEPTEMBER;
    $month_array[10] =_OCTOBER;
    $month_array[11] =_NOVEMBER;
    $month_array[12] =_DECEMBER;
    $usedate = getdate($date);
    $day = $usedate['mday'];
    $month = $usedate['mon'];
    $year = $usedate['year'];		
    $date_selector = '<select name="'. $prefix .'_day">';
    for ($i=1;$i<32;$i++){
      $date_selector .= '<option value="' . $i . '"';
      if ($i==$day) $date_selector .= 'selected';
      $date_selector .= '>' . $i . '</option>';
    }
    $date_selector .= '</select>';
    $date_selector .= '<select name="'. $prefix .'_month">';
    for ($i=1;$i<13;$i++){
      $date_selector .= '<option value="' . $i . '"';
      if ($i==$month) $date_selector .= 'selected';      
      $date_selector .= '>' . $month_array[$i] . '</option>';
    }
    $date_selector .= '</select>';
    $date_selector .= '<select name="'. $prefix .'_year">';
    for ($i=2001;$i<2019;$i++){
      $date_selector .= '<option value="' . $i . '"';
      if ($i==$year) $date_selector .= 'selected';
      $date_selector .= '>' . $i . '</option>';
    }
    $date_selector .= '</select>';
    return $date_selector;
  }

////
// Sets the status of a coupon
  function tep_set_coupon_status($coupon_id, $status) {
    if ($status == 'Y') {
      return tep_db_query("update " . TABLE_COUPONS . " set coupon_active = 'Y', date_modified = now() where coupon_id = '" . (int)$coupon_id . "'");
    } elseif ($status == 'N') {
      return tep_db_query("update " . TABLE_COUPONS . " set coupon_active = 'N', date_modified = now() where coupon_id = '" . (int)$coupon_id . "'");
    } else {
      return -1;
    }
  }

////
// support tickets
  function tep_get_ticket_status_name($ticket_status_id, $language_id = '') {
    global $languages_id;

    if ($ticket_status_id < 1) return TEXT_DEFAULT;

    if (!is_numeric($language_id)) $language_id = $languages_id;

    $status_query = tep_db_query("select ticket_status_name from " . TABLE_TICKET_STATUS . " where ticket_status_id = '" . $ticket_status_id . "' and ticket_language_id = '" . $language_id . "'");
    $status = tep_db_fetch_array($status_query);

    return $status['ticket_status_name'];
  }

  function tep_get_ticket_admin_name($ticket_admin_id, $language_id = '') {
    global $languages_id;

    if ($ticket_admin_id < 1) return TEXT_DEFAULT;

    if (!is_numeric($language_id)) $language_id = $languages_id;

    $status_query = tep_db_query("select ticket_admin_name from " . TABLE_TICKET_ADMIN . " where ticket_admin_id = '" . $ticket_admin_id . "' and ticket_language_id = '" . $language_id . "'");
    $admin = tep_db_fetch_array($status_query);

    return $admin['ticket_admin_name'];
  }

  function tep_get_ticket_department_name($ticket_department_id, $language_id = '') {
    global $languages_id;

    if ($ticket_department_id < 1) return TEXT_DEFAULT;

    if (!is_numeric($language_id)) $language_id = $languages_id;

    $status_query = tep_db_query("select ticket_department_name from " . TABLE_TICKET_DEPARTMENT . " where ticket_department_id = '" . $ticket_department_id . "' and ticket_language_id = '" . $language_id . "'");
    $department = tep_db_fetch_array($status_query);

    return $department['ticket_department_name'];
  }

function tep_get_ticket_priority_name($ticket_priority_id, $language_id = '') {
    global $languages_id;

    if ($ticket_priority_id < 1) return TEXT_DEFAULT;

    if (!is_numeric($language_id)) $language_id = $languages_id;

    $status_query = tep_db_query("select ticket_priority_name from " . TABLE_TICKET_PRIORITY . " where ticket_priority_id = '" . $ticket_priority_id . "' and ticket_language_id = '" . $language_id . "'");
    $priority = tep_db_fetch_array($status_query);

    return $priority['ticket_priority_name'];
  }
  function tep_get_ticket_reply_name($ticket_reply_id, $language_id = '') {
    global $languages_id;

    if ($ticket_reply_id < 1) return TEXT_DEFAULT;

    if (!is_numeric($language_id)) $language_id = $languages_id;

    $status_query = tep_db_query("select ticket_reply_name from " . TABLE_TICKET_REPLY . " where ticket_reply_id = '" . $ticket_reply_id . "' and ticket_language_id = '" . $language_id . "'");
    $reply = tep_db_fetch_array($status_query);

    return $reply['ticket_reply_name'];
  }
  function tep_get_ticket_reply_text($ticket_reply_id, $language_id = '') {
    global $languages_id;

    if ($ticket_reply_id < 1) return TEXT_DEFAULT;

    if (!is_numeric($language_id)) $language_id = $languages_id;

    $status_query = tep_db_query("select ticket_reply_text from " . TABLE_TICKET_REPLY . " where ticket_reply_id = '" . $ticket_reply_id . "' and ticket_language_id = '" . $language_id . "'");
    $reply = tep_db_fetch_array($status_query);

    return $reply['ticket_reply_text'];
  }
?>
