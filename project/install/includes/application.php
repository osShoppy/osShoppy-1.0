<?php //$Id: catalog/install/includes/application.php

// define the project version
  define('PROJECT_VERSION', 'osShoppy v1.0');
// set the level of error reporting
  error_reporting(E_ALL & ~E_NOTICE);
  require('includes/functions/compatibility.php');
  require('includes/functions/general.php');
  require('includes/functions/database.php');
  require('includes/functions/html_output.php');
  ?>
