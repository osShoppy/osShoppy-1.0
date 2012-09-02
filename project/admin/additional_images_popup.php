<?php //$Id: /catalog/admin/additional_images_popup.php (1032)

  require('includes/application_top.php');

  define('TITLE','Additional Images');
  define('HEADING_TITLE','Additional Images - Image Set');
  define('TEXT_CLOSE_WINDOW','[ Close Window ]');
  define('TEXT_THUMB_SINGLE','Thumb or Single Image:');
  define('TEXT_MEDIUM_IMAGE','Medium Image:');
  define('TEXT_POP_IMAGE','Popup Image:');
  

  $images_array = array();
  
  if (!empty($_GET['products_id'])) {
    $listing_sql = "select products_image, products_image_med, products_image_pop from " . TABLE_PRODUCTS . " where products_id = '".tep_db_input(tep_db_prepare_input($_GET['products_id']))."' limit 1";
  } elseif (!empty($_GET['additional_images_id'])) {
    $listing_sql = "select thumb_images as products_image, medium_images as products_image_med, popup_images as products_image_pop from " . TABLE_ADDITIONAL_IMAGES . " where additional_images_id = '".tep_db_input(tep_db_prepare_input($_GET['additional_images_id']))."' limit 1";
  }
  $query = tep_db_query($listing_sql);
  if ($query) {
     $images_array = tep_db_fetch_array($query);
  }
  
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="SetFocus();">

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="100%" valign="top">



    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
       <td>
    
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo TEXT_THUMB_SINGLE . '<br /><a href="javascript:window.close();">' . tep_image(DIR_WS_CATALOG_IMAGES . $images_array['products_image'], '', '', '', 'hspace="15" vspace="15"') . '</a>'; ?><br />
			<br />
			</td>
          </tr>
        </table>
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo TEXT_MEDIUM_IMAGE . '<br /><a href="javascript:window.close();">' . tep_image(DIR_WS_CATALOG_IMAGES . $images_array['products_image_med'], '', '', '', 'hspace="15" vspace="15"') . '</a>'; ?><br />
			<br />
			</td>
          </tr>
        </table>
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo TEXT_POP_IMAGE . '<br /><a href="javascript:window.close();">' . tep_image(DIR_WS_CATALOG_IMAGES . $images_array['products_image_pop'], '', '', '', 'hspace="15" vspace="15"') . '</a>'; ?><br />
			<br />
			</td>
          </tr>
        </table>

&nbsp;<br>
<center><a href="javascript:window.close();"><?php echo TEXT_CLOSE_WINDOW; ?></a></center>

       </td>
      </tr>
    </table>


    </td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
