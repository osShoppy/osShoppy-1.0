<?php // catalog/includes/functions/html_output.php (osC)

//// Ultimate SEO url's 5 PRO
/* original ->
////
// The HTML href link wrapper function
  function tep_href_link($page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true) {
    global $request_type, $session_started, $SID;

    if (!tep_not_null($page)) {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine the page link!<br><br>');
    }

    if ($connection == 'NONSSL') {
      $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
    } elseif ($connection == 'SSL') {
      if (ENABLE_SSL == true) {
        $link = HTTPS_SERVER . DIR_WS_HTTPS_CATALOG;
      } else {
        $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
      }
    } else {
      die('</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine connection method on a link!<br><br>Known methods: NONSSL SSL</b><br><br>');
    }

    if (tep_not_null($parameters)) {
      $link .= $page . '?' . tep_output_string($parameters);
      $separator = '&';
    } else {
      $link .= $page;
      $separator = '?';
    }

    while ( (substr($link, -1) == '&') || (substr($link, -1) == '?') ) $link = substr($link, 0, -1);

// Add the session ID when moving from different HTTP and HTTPS servers, or when SID is defined
    if ( ($add_session_id == true) && ($session_started == true) && (SESSION_FORCE_COOKIE_USE == 'False') ) {
      if (tep_not_null($SID)) {
        $_sid = $SID;
      } elseif ( ( ($request_type == 'NONSSL') && ($connection == 'SSL') && (ENABLE_SSL == true) ) || ( ($request_type == 'SSL') && ($connection == 'NONSSL') ) ) {
        if (HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN) {
          $_sid = tep_session_name() . '=' . tep_session_id();
        }
      }
    }

    if ( (SEARCH_ENGINE_FRIENDLY_URLS == 'true') && ($search_engine_safe == true) ) {
      while (strstr($link, '&&')) $link = str_replace('&&', '&', $link);

      $link = str_replace('?', '/', $link);
      $link = str_replace('&', '/', $link);
      $link = str_replace('=', '/', $link);

      $separator = '?';
    }

    if (isset($_sid)) {
      $link .= $separator . tep_output_string($_sid);
    }

    return $link;
  }
*/
  require_once DIR_WS_MODULES . 'ultimate_seo_urls5/main/usu5.php';
  
  function tep_href_link( $page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true ) {
    return Usu_Main::i()->hrefLink( $page, $parameters, $connection, $add_session_id, $search_engine_safe );
  }
  

if (USE_OTF_THUMBNAIL == 'true') { 
// "On the Fly" Auto Thumbnailer using GD Library, servercaching and browsercaching
// Scales product images dynamically, resulting in smaller file sizes, and keeps
// proper image ratio. Used in conjunction with product_thumb.php t/n generator.
function tep_image($src, $alt = '', $width = '', $height = '', $params = '') {

  // if no file exists display the 'no image' file
  if (!is_file($src)) {
  $src = "images/no_image.jpg";
  }
    // Set default image variable and code
    $image = '<img src="' . $src . '"';

    // Don't calculate if the image is set to a "%" width
    if (strstr($width,'%') == false || strstr($height,'%') == false) {
        $dont_calculate = 0;
    } else {
        $dont_calculate = 1;
    }

    // Dont calculate if a pixel image is being passed (hope you dont have pixels for sale)
    if (!strstr($image, 'pixel')) {
        $dont_calculate = 0;
    } else {
        $dont_calculate = 1;
    }

    // Do we calculate the image size?
    if (CONFIG_CALCULATE_IMAGE_SIZE && !$dont_calculate) {

        // Get the image's information
        if ($image_size = @getimagesize($src)) {

            $ratio = $image_size[1] / $image_size[0];

            // Set the width and height to the proper ratio
            if (!$width && $height) {
                $ratio = $height / $image_size[1];
                $width = intval($image_size[0] * $ratio);
            } elseif ($width && !$height) {
                $ratio = $width / $image_size[0];
                $height = intval($image_size[1] * $ratio);
            } elseif (!$width && !$height) {
                $width = $image_size[0];
                $height = $image_size[1];
            }

            // Scale the image if not the original size
            if ($image_size[0] != $width || $image_size[1] != $height) {
                $rx = $image_size[0] / $width;
                $ry = $image_size[1] / $height;

                if ($rx < $ry) {
                    $width = intval($height / $ratio);
                } else {
                    $height = intval($width * $ratio);
                }

                $image = '<img src="product_thumb.php?img=' . $src . '&amp;w=' .
                tep_output_string($width) . '&amp;h=' . tep_output_string($height) . '"';
            }

        } elseif (IMAGE_REQUIRED == 'false') {
            return '';
        }
    }

    // Add remaining image parameters if they exist
    if ($width) {
        $image .= ' width="' . tep_output_string($width) . '"';
    }

    if ($height) {
        $image .= ' height="' . tep_output_string($height) . '"';
    }

    if (tep_not_null($params)) $image .= ' ' . $params;

    $image .= ' border="0" alt="' . tep_output_string($alt) . '"';

    if (tep_not_null($alt)) {
        $image .= ' title="' . tep_output_string($alt) . '"';
    }

    $image .= '>';

    return $image;
}

} else { // OTF_THUMBNAIL
	
// The HTML image wrapper function
	function tep_image($src, $alt = '', $width = '', $height = '', $parameters = '') {
    if ( (empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false') ) {
      return false;
    }

// alt is added to the img tag even if it is null to prevent browsers from outputting
// the image filename as default
    $image = '<img src="' . tep_output_string($src) . '" border="0" alt="' . tep_output_string($alt) . '"';

    if (tep_not_null($alt)) {
      $image .= ' title=" ' . tep_output_string($alt) . ' "';
    }

    if ( (CONFIG_CALCULATE_IMAGE_SIZE == 'true') && (empty($width) || empty($height)) ) {
      if ($image_size = @getimagesize($src)) {
        if (empty($width) && tep_not_null($height)) {
          $ratio = $height / $image_size[1];
          $width = intval($image_size[0] * $ratio);
        } elseif (tep_not_null($width) && empty($height)) {
          $ratio = $width / $image_size[0];
          $height = intval($image_size[1] * $ratio);
        } elseif (empty($width) && empty($height)) {
          $width = $image_size[0];
          $height = $image_size[1];
        }
      } elseif (IMAGE_REQUIRED == 'false') {
        return false;
      }
    }

    if (tep_not_null($width) && tep_not_null($height)) {
      $image .= ' width="' . tep_output_string($width) . '" height="' . tep_output_string($height) . '"';
    }

    if (tep_not_null($parameters)) $image .= ' ' . $parameters;

    $image .= '>';

    return $image;
  }
  
} // OTF_THUMBNAIL

////
// The HTML form submit button wrapper function
// Outputs a button in the selected language
  function tep_image_submit($image, $alt = '', $parameters = '') {
    global $language;
// image mouse over button
//-original    $image_submit = '<input type="image" src="' . tep_output_string(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image) . '" border="0" alt="' . tep_output_string($alt) . '"';
	$image_submit = '<input type="image" src="' . tep_output_string(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image) . '" onmouseover="(src=\'' . tep_output_string(DIR_WS_LANGUAGES . $language . '/images/buttons/over/' . $image) . '\')" onmouseout="(src=\'' . tep_output_string(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image) . '\')" border="0" alt="' . tep_output_string($alt) . '"';

    if (tep_not_null($alt)) $image_submit .= ' title=" ' . tep_output_string($alt) . ' "';

    if (tep_not_null($parameters)) $image_submit .= ' ' . $parameters;

    $image_submit .= '>';

    return $image_submit;
  }

////
// Output a function button in the selected language
  function tep_image_button($image, $alt = '', $parameters = '') {
    global $language;

// image mouse over button
//-original    //return tep_image(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image, $alt, '', '', $parameters);
	return tep_image(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image, $alt, '', '', '' . $parameters . ' onmouseover="(src=\'' . tep_output_string(DIR_WS_LANGUAGES . $language . '/images/buttons/over/' . $image) . '\')" onmouseout="(src=\'' . tep_output_string(DIR_WS_LANGUAGES . $language . '/images/buttons/' . $image) . '\')"');
  }

////
// Output a separator either through whitespace, or with an image
  function tep_draw_separator($image = 'pixel_black.gif', $width = '100%', $height = '1') {
    return tep_image(DIR_WS_IMAGES . $image, '', $width, $height);
  }

////
// Output a form
  function tep_draw_form($name, $action, $method = 'post', $parameters = '') {
    $form = '<form name="' . tep_output_string($name) . '" action="' . tep_output_string($action) . '" method="' . tep_output_string($method) . '"';

    if (tep_not_null($parameters)) $form .= ' ' . $parameters;

    $form .= '>';

    return $form;
  }

////
// Output a form input field
  function tep_draw_input_field($name, $value = '', $parameters = '', $type = 'text', $reinsert_value = true) {
    global $HTTP_GET_VARS, $HTTP_POST_VARS;

    $field = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

    if ( ($reinsert_value == true) && ( (isset($HTTP_GET_VARS[$name]) && is_string($HTTP_GET_VARS[$name])) || (isset($HTTP_POST_VARS[$name]) && is_string($HTTP_POST_VARS[$name])) ) ) {
      if (isset($HTTP_GET_VARS[$name]) && is_string($HTTP_GET_VARS[$name])) {
        $value = stripslashes($HTTP_GET_VARS[$name]);
      } elseif (isset($HTTP_POST_VARS[$name]) && is_string($HTTP_POST_VARS[$name])) {
        $value = stripslashes($HTTP_POST_VARS[$name]);
      }
    }

    if (tep_not_null($value)) {
      $field .= ' value="' . tep_output_string($value) . '"';
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    return $field;
  }

//// 
// Output a form filefield
  function tep_draw_file_field($name) {
	$field = tep_draw_input_field($name, '', '', 'file');
	  return $field;
  }

////
// Output a form password field
  function tep_draw_password_field($name, $value = '', $parameters = 'maxlength="40"') {
    return tep_draw_input_field($name, $value, $parameters, 'password', false);
  }

////
// Output a selection field - alias function for tep_draw_checkbox_field() and tep_draw_radio_field()
  function tep_draw_selection_field($name, $type, $value = '', $checked = false, $parameters = '') {
    global $HTTP_GET_VARS, $HTTP_POST_VARS;

    $selection = '<input type="' . tep_output_string($type) . '" name="' . tep_output_string($name) . '"';

    if (tep_not_null($value)) $selection .= ' value="' . tep_output_string($value) . '"';

    if ( ($checked == true) || (isset($HTTP_GET_VARS[$name]) && is_string($HTTP_GET_VARS[$name]) && (($HTTP_GET_VARS[$name] == 'on') || (stripslashes($HTTP_GET_VARS[$name]) == $value))) || (isset($HTTP_POST_VARS[$name]) && is_string($HTTP_POST_VARS[$name]) && (($HTTP_POST_VARS[$name] == 'on') || (stripslashes($HTTP_POST_VARS[$name]) == $value))) ) {
      $selection .= ' CHECKED';
    }

    if (tep_not_null($parameters)) $selection .= ' ' . $parameters;

    $selection .= '>';

    return $selection;
  }

////
// Output a form checkbox field
  function tep_draw_checkbox_field($name, $value = '', $checked = false, $parameters = '') {
    return tep_draw_selection_field($name, 'checkbox', $value, $checked, $parameters);
  }

////
// Output a form radio field
  function tep_draw_radio_field($name, $value = '', $checked = false, $parameters = '') {
    return tep_draw_selection_field($name, 'radio', $value, $checked, $parameters);
  }

////
// Output a form textarea field
  function tep_draw_textarea_field($name, $wrap, $width, $height, $text = '', $parameters = '', $reinsert_value = true) {
    global $HTTP_GET_VARS, $HTTP_POST_VARS;

    $field = '<textarea name="' . tep_output_string($name) . '" wrap="' . tep_output_string($wrap) . '" cols="' . tep_output_string($width) . '" rows="' . tep_output_string($height) . '"';

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if ( ($reinsert_value == true) && ( (isset($HTTP_GET_VARS[$name]) && is_string($HTTP_GET_VARS[$name])) || (isset($HTTP_POST_VARS[$name]) && is_string($HTTP_POST_VARS[$name])) ) ) {
      if (isset($HTTP_GET_VARS[$name]) && is_string($HTTP_GET_VARS[$name])) {
        $field .= tep_output_string_protected(stripslashes($HTTP_GET_VARS[$name]));
      } elseif (isset($HTTP_POST_VARS[$name]) && is_string($HTTP_POST_VARS[$name])) {
        $field .= tep_output_string_protected(stripslashes($HTTP_POST_VARS[$name]));
      }
    } elseif (tep_not_null($text)) {
      $field .= tep_output_string_protected($text);
    }

    $field .= '</textarea>';

    return $field;
  }

////
// Output a form hidden field
  function tep_draw_hidden_field($name, $value = '', $parameters = '') {
    global $HTTP_GET_VARS, $HTTP_POST_VARS;

    $field = '<input type="hidden" name="' . tep_output_string($name) . '"';

    if (tep_not_null($value)) {
      $field .= ' value="' . tep_output_string($value) . '"';
    } elseif ( (isset($HTTP_GET_VARS[$name]) && is_string($HTTP_GET_VARS[$name])) || (isset($HTTP_POST_VARS[$name]) && is_string($HTTP_POST_VARS[$name])) ) {
      if ( (isset($HTTP_GET_VARS[$name]) && is_string($HTTP_GET_VARS[$name])) ) {
        $field .= ' value="' . tep_output_string(stripslashes($HTTP_GET_VARS[$name])) . '"';
      } elseif ( (isset($HTTP_POST_VARS[$name]) && is_string($HTTP_POST_VARS[$name])) ) {
        $field .= ' value="' . tep_output_string(stripslashes($HTTP_POST_VARS[$name])) . '"';
      }
    }

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    return $field;
  }

////
// Hide form elements
  function tep_hide_session_id() {
    global $session_started, $SID;

    if (($session_started == true) && tep_not_null($SID)) {
      return tep_draw_hidden_field(tep_session_name(), tep_session_id());
    }
  }

////
// Output a form pull down menu
  function tep_draw_pull_down_menu($name, $values, $default = '', $parameters = '', $required = false) {
    global $HTTP_GET_VARS, $HTTP_POST_VARS;

    $field = '<select name="' . tep_output_string($name) . '"';

    if (tep_not_null($parameters)) $field .= ' ' . $parameters;

    $field .= '>';

    if (empty($default) && ( (isset($HTTP_GET_VARS[$name]) && is_string($HTTP_GET_VARS[$name])) || (isset($HTTP_POST_VARS[$name]) && is_string($HTTP_POST_VARS[$name])) ) ) {
      if (isset($HTTP_GET_VARS[$name]) && is_string($HTTP_GET_VARS[$name])) {
        $default = stripslashes($HTTP_GET_VARS[$name]);
      } elseif (isset($HTTP_POST_VARS[$name]) && is_string($HTTP_POST_VARS[$name])) {
        $default = stripslashes($HTTP_POST_VARS[$name]);
      }
    }

    for ($i=0, $n=sizeof($values); $i<$n; $i++) {
      $field .= '<option value="' . tep_output_string($values[$i]['id']) . '"';
      if ($default == $values[$i]['id']) {
        $field .= ' SELECTED';
      }

      $field .= '>' . tep_output_string($values[$i]['text'], array('"' => '&quot;', '\'' => '&#039;', '<' => '&lt;', '>' => '&gt;')) . '</option>';
    }
    $field .= '</select>';

    if ($required == true) $field .= TEXT_FIELD_REQUIRED;

    return $field;
  }

////
// Creates a pull-down list of countries
  function tep_get_country_list($name, $selected = '', $parameters = '') {
    $countries_array = array(array('id' => '', 'text' => PULL_DOWN_DEFAULT));
    $countries = tep_get_countries();

    for ($i=0, $n=sizeof($countries); $i<$n; $i++) {
      $countries_array[] = array('id' => $countries[$i]['countries_id'], 'text' => $countries[$i]['countries_name']);
    }

    return tep_draw_pull_down_menu($name, $countries_array, $selected, $parameters);
  }
////rmh referral
// Creates a pull-down list of sources
  function tep_get_source_list($name, $show_other = false, $selected = '', $parameters = '') {
    $sources_array = array(array('id' => '', 'text' => PULL_DOWN_DEFAULT));
    $sources = tep_get_sources();

    for ($i=0, $n=sizeof($sources); $i<$n; $i++) {
      $sources_array[] = array('id' => $sources[$i]['sources_id'], 'text' => $sources[$i]['sources_name']);
    }

    if ($show_other == 'true') {
      $sources_array[] = array('id' => '9999', 'text' => PULL_DOWN_OTHER);
    }

    return tep_draw_pull_down_menu($name, $sources_array, $selected, $parameters);
  }
?>
