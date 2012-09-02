<?php //$Id: /catalog/admin/logoff_admin.php (1359)

  define('ADMIN_TEMPLATE', 'osShoppy');

  require('includes/application_top.php');

  @include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGOFF_ADMIN);

//tep_session_destroy();
  tep_session_unregister('login_id');
  tep_session_unregister('login_firstname');
  tep_session_unregister('login_groups_id');

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="style.css">
<link href="../stylesheet.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="templates/<?php  echo ADMIN_TEMPLATE?>/favicon.ico">
</head>
<body>
<table border="0" width="600" height="500" cellspacing="0" cellpadding="0" align="center" valign="middle">
  <tr>
    <td>
    	<table border="0" width="600" height="238" cellspacing="0" cellpadding="1" align="center" valign="middle">
      	<tr class="mainback">
        	<td height="218">
          	<table border="0" width="600" height="216" cellspacing="0" cellpadding="0">
          		<tr class="logo-head" height="50">
				<td height="24" class="main"><b><?php echo HEADING_TITLE_SUCCES; ?></b><br></td>
              	<td height="50"><img src="templates/<?php  echo ADMIN_TEMPLATE?>/images/store_logo.png" border="0"/></td>
                <td align="right" class="main" nowrap><?php echo '<a href="' . tep_catalog_href_link() . '" target="_blank" >' . tep_image(DIR_WS_IMAGES . 'icons/header_icons/header_icon_toshop.png', HEADER_TO_SHOP) . '</a>'; ?></td>
          		</tr>
          		<tr class="main">
              	<td height="100" colspan="2" align="center" valign="middle">
                 	<table width="280" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                     	<td class="main"><?php echo TEXT_MAIN; ?></td>
                    </tr>
                    <tr>
                     	<td class="login_heading" align="right"><?php echo '<a class="login_heading" href="' . tep_href_link(FILENAME_LOGIN_ADMIN, '', 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a>'; ?></td>
                    </tr>
                    <tr>
                     	<td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                    </tr>
                  </table></td>
           		</tr>
       	 	  </table></td>
     		</tr>
     		<tr>
       		<td height="16" class="LoginAdmin"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></td>
     		</tr>
   		</table>
    </td>
 	</tr>
</table>

</body>

</html>