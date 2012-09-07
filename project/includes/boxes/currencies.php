<?php // currencies infobox 

  if (isset($currencies) && is_object($currencies)) {

  $boxHeading = BOX_HEADING_CURRENCIES;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'currencies';

  $box_id = $box_base_name . 'Box';
  $boxContent_attributes = ' align="center"';

    reset($currencies->currencies);
    $currencies_array = array();
    while (list($key, $value) = each($currencies->currencies)) {
      $currencies_array[] = array('id' => $key, 'text' => $value['title']);
    }

    $hidden_get_variables = '';
    reset($HTTP_GET_VARS);
    while (list($key, $value) = each($HTTP_GET_VARS)) {
      if ( ($key != 'currency') && ($key != tep_session_name()) && ($key != 'x') && ($key != 'y') ) {
        $hidden_get_variables .= tep_draw_hidden_field($key, $value);
      }
    }
    $boxContent = tep_draw_form('currencies', tep_href_link(basename($PHP_SELF), '', $request_type, false), 'get');
    //$boxContent .= tep_draw_pull_down_menu('currency', $currencies_array, $currency, 'onChange="this.form.submit();" style="width: 100%"');
    $boxContent .= tep_draw_pull_down_menu('currency', $currencies_array, $currency, 'onChange="this.form.submit();"');
    $boxContent .= $hidden_get_variables;
    $boxContent .= tep_hide_session_id();
    $boxContent .= '</form>';
  include (bts_select('boxes', $box_base_name)); // BTS 1.5
  $boxContent_attributes = '';
  }
?>