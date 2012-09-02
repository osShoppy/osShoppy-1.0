<?php //$Id: /catalog/admin/index.php (osS)

  require('includes/application_top.php');

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<!-- index_body //-->
<?php
	  if(DISPLAY_INDEX_PAGE == 'categories') { 
		require(DIR_WS_INCLUDES . 'index/index_categories.php');	  }
	  if(DISPLAY_INDEX_PAGE == 'customers') { 
		require(DIR_WS_INCLUDES . 'index/index_customers.php');	  }
	  if(DISPLAY_INDEX_PAGE == 'default') { 
		require(DIR_WS_INCLUDES . 'index/index_default.php');	  }
	  if(DISPLAY_INDEX_PAGE == 'links') { 
		require(DIR_WS_INCLUDES . 'index/index_links.php');	  }
	  if(DISPLAY_INDEX_PAGE == 'orders') { 
		require(DIR_WS_INCLUDES . 'index/index_orders.php');	  }
	  if(DISPLAY_INDEX_PAGE == 'stats') { 
		require(DIR_WS_INCLUDES . 'index/index_stats.php');	  }
	  if(DISPLAY_INDEX_PAGE == 'ultimate') { 
		require(DIR_WS_INCLUDES . 'index/index_ultimate.php');	  }
?>

<!-- index_body_eof //-->
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
