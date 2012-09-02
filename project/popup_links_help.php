<?php //$Id: /catalog/popup_links_help.php (5272)

  require('includes/application_top.php');

  $navigation->remove_current_page();

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LINKS_SUBMIT);
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<title><?php echo TITLE; ?></title>
<META NAME="ROBOTS" CONTENT="NOINDEX,NOFOLLOW">
<META NAME="GOOGLEBOT" CONTENT="NOARCHIVE">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => HEADING_LINKS_HELP);

  new infoBoxHeading($info_box_contents, true, true);

  $info_box_contents = array();
  $info_box_contents[] = array('text' => TEXT_LINKS_HELP);

  new infoBox($info_box_contents);
?>

<p class="smallText" align="right"><?php echo '<a href="javascript:window.close()">' . TEXT_CLOSE_WINDOW . '</a>'; ?></p>

</body>
</html>
<?php require('includes/application_bottom.php'); ?>
