<?php //catalog/install/includes/functions/compatibility.php

  if (PHP_VERSION >= 4.1) {
    $HTTP_GET_VARS =& $_GET;
    $HTTP_POST_VARS =& $_POST;
    $HTTP_COOKIE_VARS =& $_COOKIE;
    $HTTP_SESSION_VARS =& $_SESSION;
    $HTTP_SERVER_VARS =& $_SERVER;
  } else {
    if (!is_array($HTTP_GET_VARS)) $HTTP_GET_VARS = array();
    if (!is_array($HTTP_POST_VARS)) $HTTP_POST_VARS = array();
    if (!is_array($HTTP_COOKIE_VARS)) $HTTP_COOKIE_VARS = array();
  }

  if (!function_exists('is_numeric')) {
    function is_numeric($param) {
      return ereg('^[0-9]{1,50}.?[0-9]{0,50}$', $param);
    }
  }
?>
