<?php //$Id: /catalog/install/install.php

  require('includes/application.php');

  // drop sql_file
  $page_contents = 'install.php';

  if (isset($HTTP_GET_VARS['step']) && is_numeric($HTTP_GET_VARS['step'])) {
    switch ($HTTP_GET_VARS['step']) {
	  // store base url's
      case '2':
        $page_contents = 'install_2.php';
        break;
	  // sample data
      case '3':
        $page_contents = 'install_3.php';
        break;
	  // store settings
      case '4':
        $page_contents = 'install_4.php';
        break;
/*
	  // end installation
      case '5':
        $page_contents = 'install_5.php';
        break;
*/
}
  }

  require('templates/main_page.php');
?>
