<?php //$Id: /catalog/account_activate.php (5241)

  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_ACTIVATE);
  
  if (ACTIVATION_CODE == 'false') tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));

// needs to be included earlier to set the success message in the messageStack
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);

	$activation_code = '';
	if( isset($HTTP_GET_VARS['activation_id']) or (isset($HTTP_POST_VARS['activation_id'])) ) {
	    if(isset($HTTP_GET_VARS['activation_id'])) $activation_id = tep_db_prepare_input($HTTP_GET_VARS['activation_id']);
	    if(isset($HTTP_POST_VARS['activation_id'])) $activation_id = tep_db_prepare_input($HTTP_POST_VARS['activation_id']);
	    $activation_code = tep_db_prepare_input($HTTP_GET_VARS['activation_code']);
	} else {
    $activation_id = '';
	$error = true;
	$messageStack->add('account_activate', ACTIVATION_ID_ERROR);
  }

  $process = false;

  if ((isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'activate')) or (isset($HTTP_GET_VARS['submit']) && ($HTTP_GET_VARS['submit'] == 'true'))) {

    $process = true;

    if(isset($HTTP_GET_VARS['activation_code'])) $activation_code = tep_db_prepare_input($HTTP_GET_VARS['activation_code']);
    if(isset($HTTP_POST_VARS['activation_code'])) $activation_code = tep_db_prepare_input($HTTP_POST_VARS['activation_code']);
	
    $error = false;

    $check_code_query = tep_db_query("select customers_id,customers_activation_code,customers_firstname,customers_active_status,customers_default_address_id,count(*) as total from " . TABLE_CUSTOMERS . " where md5(customers_email_address) = '" . tep_db_input($activation_id) . "' group by customers_id,customers_activation_code,customers_firstname,customers_default_address_id");
	$check_code = tep_db_fetch_array($check_code_query);
	
    if ($check_code['total'] > 1) {
      $error = true;

      $messageStack->add('account_activate', ACTIVATION_ID_ERROR);
    } else {
	  if($check_code['customers_active_status'] == '1') {
		$error = true;
		
		$messageStack->add('account_activate', ACTIVATION_STATUS_ERROR);
	  } else {
		if($check_code['customers_activation_code'] <> $activation_code) {
			$error = true;
			
			$messageStack->add('account_activate', ACTIVATION_CODE_ERROR);
		} else {
			$customer_id = $check_code['customers_id'];
			$customer_first_name = $check_code['customers_firstname'];
			$customer_default_address_id = $check_code['customers_default_address_id'];
		}
	  }
	}
	
    if ($error == false) {

      tep_db_query("update " . TABLE_CUSTOMERS . " set customers_active_status = '1' where customers_id = '" . (int)$customer_id . "'");
	  
	  $customers_query = tep_db_query("select * from " . TABLE_ADDRESS_BOOK . " where customers_id = '". (int)$customer_id. "' and address_book_id = '" . (int)$customer_default_address_id . "'");
	  $customers_data = tep_db_fetch_array($customers_query);

      if (SESSION_RECREATE == 'True') {
        tep_session_recreate();
      }
	  
	  $customer_country_id = $customers_data['customers_country_id'];
	  $customer_zone_id = $customers_data['zone_id'];
	  tep_session_register('customer_id');
	  tep_session_register('customer_first_name');
	  tep_session_register('customer_default_address_id');
	  tep_session_register('customer_country_id');
	  tep_session_register('customer_zone_id');
	  
      tep_redirect(tep_href_link(FILENAME_ACCOUNT_ACTIVATE_SUCCESS, '', 'SSL'));
	  
    }
  }

  $breadcrumb->add(NAVBAR_TITLE_1_ACTIVATION, tep_href_link(FILENAME_ACCOUNT_ACTIVATE, '', 'SSL'));
  ?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_ACCOUNT_ACTIVATE;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
<script language="javascript"><!--
var submitted = false;
var error = false;
var error_message = "";

function check_input(field_name, field_size, message) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (field_value == '' || field_value.length < field_size) {
      error_message = error_message + "* " + message + "\n";
      error = true;
    }
  }
}

function check_account_activate() {

  if (submitted == true) {
    alert("<?php echo JS_ERROR_SUBMITTED; ?>");
    return false;
  }
 
  check_input("activation_code", 1, "<?php echo ENTRY_ACTIVATION_CODE_ERROR; ?>");
 
  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}
  
--></script>
