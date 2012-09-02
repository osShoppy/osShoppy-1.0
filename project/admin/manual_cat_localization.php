<?php //$Id: /catalog/admin/manual_cat_localization.php (osS manual)

  require('includes/application_top.php');
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/manual.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="SetFocus();">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'manual_header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2"><td align="center">
<!-- body_text //-->
<body class="thrColLiqHdr">

<div id="container">
 <div id="header">
    <h1><?php echo TEXT_HEADER ?></h1>
  <!-- end #header --></div>
 <div id="headerlinks">
    <h1><?php echo TEXT_HEADER_LINKS ?></h1>
  <!-- end #header --></div>
  <div id="sidebar1">
    <h1><?php echo TEXT_LEFT_HEADER ?> </h1>
    <h4><?php echo TEXT_LEFT_CONTENT ?></h4>
    <h2><?php echo TEXT_NOTICE_HEADER ?></h2>
    <h3><?php echo TEXT_NOTICE_CONTENT ?></h3>
  <!-- end #sidebar1 --></div>
  <div id="sidebar2">
    <h1><?php echo TEXT_RIGHT_HEADER ?></h1>
    <h4><?php echo TEXT_RIGHT_CONTENT ?></h4>
    <h2><?php echo TEXT_RELATED_HEADER ?></h2>
    <h3><?php echo TEXT_RELATED_CONTENT ?></h3>
  <!-- end #sidebar2 --></div>
  <div id="mainContent">
    <h6><?php echo TEXT_TITLE ?></h6>
    <h2><?php echo TEXT_MAIN_HEADER ?></h2>
    <p><?php echo TEXT_MAIN_CONTENT ?></p>
    <h2><?php echo TEXT_INFO_HEADER ?></h2>
    <p><?php echo TEXT_INFO_CONTENT ?></p>
	<!-- end #mainContent --></div>
	<!-- Dit wiselement dient onmiddellijk te volgen op het element div voor #mainContent om het element div voor #container te dwingen om alle zwevende elementen van een lager niveau te bevatten --><br class="clearfloat" />
  <div id="footerlinks">
    <h1><?php echo TEXT_FOOTER_LINKS ?></h1>
  <!-- end #footer --></div>
  <div id="footer">
    <h4><?php echo TEXT_FOOTER ?></h4>
  <!-- end #footer --></div>
<!-- end #container --></div>
<!-- body_text_eof //-->
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
