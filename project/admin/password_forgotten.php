<?php //$Id: /catalog/admin/password_forgotten.php (1359)

  define('ADMIN_TEMPLATE', 'osShoppy');
  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN_ADMIN);

  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'process')) {
    $email_address = tep_db_prepare_input($HTTP_POST_VARS['email_address']);
    $firstname = tep_db_prepare_input($HTTP_POST_VARS['firstname']);
    $log_times = $HTTP_POST_VARS['log_times']+1;
    if ($log_times >= 4) {
      tep_session_register('password_forgotten');
    }

// Check if email exists
    $check_admin_query = tep_db_query("select admin_id as check_id, admin_firstname as check_firstname, admin_lastname as check_lastname, admin_email_address as check_email_address from " . TABLE_ADMIN . " where admin_email_address = '" . tep_db_input($email_address) . "'");
    if (!tep_db_num_rows($check_admin_query)) {
      $HTTP_GET_VARS['login'] = 'fail';
    } else {
      $check_admin = tep_db_fetch_array($check_admin_query);
      if ($check_admin['check_firstname'] != $firstname) {
        $HTTP_GET_VARS['login'] = 'fail';
      } else {
        $HTTP_GET_VARS['login'] = 'success';

        function randomize() {
          $salt = "ABCDEFGHIJKLMNOPQRSTUVWXWZabchefghjkmnpqrstuvwxyz0123456789";
          srand((double)microtime()*1000000);
          $i = 0;

          while ($i <= 7) {
            $num = rand() % 33;
    	    $tmp = substr($salt, $num, 1);
    	    $pass = $pass . $tmp;
    	    $i++;
  	  }
  	  return $pass;
        }
        $makePassword = randomize();

        tep_mail($check_admin['check_firstname'] . ' ' . $check_admin['admin_lastname'], $check_admin['check_email_address'], sprintf(ADMIN_EMAIL_SUBJECT, STORE_NAME, $check_admin['check_firstname'], $check_admin['admin_lastname']), sprintf(ADMIN_EMAIL_TEXT, $check_admin['check_firstname'], HTTP_SERVER . DIR_WS_ADMIN, $check_admin['check_email_address'], $makePassword, STORE_OWNER), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
        tep_db_query("update " . TABLE_ADMIN . " set admin_password = '" . tep_encrypt_password($makePassword) . "' where admin_id = '" . $check_admin['check_id'] . "'");
		
		tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, sprintf(ADMIN_EMAIL_SUBJECT, STORE_NAME, $check_admin['check_firstname'], $check_admin['admin_lastname']), sprintf(ADMIN_EMAIL_TEXT, $check_admin['check_firstname'], HTTP_SERVER . DIR_WS_ADMIN, $check_admin['check_email_address'], $makePassword, STORE_OWNER), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
		
      }
    }
  }

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
<table border="0" width="600" height="60%" cellspacing="0" cellpadding="0" align="center" valign="middle">
  <tr>
    <td>
    	<table border="0" width="600" height="270" cellspacing="0" cellpadding="1" align="center" valign="middle">
      	<tr class="mainback">
        	<td height="234">
          	<table border="0" width="600" height="225" cellspacing="0" cellpadding="0">
          		<tr class="logo-head" height="50">
            		<td height="50"><img src="templates/<?php  echo ADMIN_TEMPLATE?>/images/store_logo.png" border="0" /></td>
            		<td align="center" class="nav-head" nowrap><?php echo '<a href="' . tep_catalog_href_link() . '" target="_blank" >' . tep_image(DIR_WS_IMAGES . 'icons/header_icons/header_icon_toshop.png', HEADER_TO_SHOP) . '</a>'; ?></td>
          		</tr>
          		<tr class="main">
            		<td height="175" colspan="2" align="center" valign="middle" class="main">
                <?php echo tep_draw_form('login', FILENAME_PASSWORD_FORGOTTEN, 'action=process'); ?>
                	<table width="280" border="0" cellspacing="0" cellpadding="2">
                  	<tr>
                    	<td class="main" valign="top">&nbsp;<b><?php echo HEADING_PASSWORD_FORGOTTEN; ?></b></td>
                    </tr>
                    <tr>
                    	<td height="100%" width="100%" valign="top" align="center">
                      	<table border="0" height="100%" width="100%" cellspacing="0" cellpadding="1" class="login_form_bg">
                        	<tr>
                          	<td>
                            	<table border="0" width="100%" height="100%" cellspacing="3" cellpadding="2" class="main">
<?php
  if ($HTTP_GET_VARS['login'] == 'success') {
    $success_message = TEXT_FORGOTTEN_SUCCESS;
  } elseif ($HTTP_GET_VARS['login'] == 'fail') {
    $info_message = TEXT_FORGOTTEN_ERROR;
  }
  if (tep_session_is_registered('password_forgotten')) {
?>
																<tr>
                                  <td class="smallText"><?php echo TEXT_FORGOTTEN_FAIL; ?></td>
                                </tr>
                                <tr>
                                	<td align="center" valign="top"><?php echo '<a href="' . tep_href_link(FILENAME_LOGIN_ADMIN, '' , 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a>'; ?></td>
                                </tr>
<?php
  } elseif (isset($success_message)) {
?>
                                <tr>
                                  <td class="smallText"><?php echo $success_message; ?></td>
                                </tr>
                                <tr>
                                  <td align="center" valign="top"><?php echo '<a href="' . tep_href_link(FILENAME_LOGIN_ADMIN, '' , 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a>'; ?></td>
                                </tr>
<?php
  } else {
    if (isset($info_message)) {
?>
                                <tr>
                                  <td colspan="2" class="smallText" align="center"><?php echo $info_message; ?><?php echo tep_draw_hidden_field('log_times', $log_times); ?></td>
                                </tr>
<?php
    } else {
?>
                                <tr>
                                	<td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?><?php echo tep_draw_hidden_field('log_times', '0'); ?></td>
                                </tr>
<?php
    }
?>
                                <tr>
                                	<td class="main"><?php echo ENTRY_FIRSTNAME; ?></td>
                                  <td class="login"><?php echo tep_draw_input_field('firstname'); ?></td>
                                </tr>
                                <tr>
                                  <td class="main"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
                                  <td class="login"><?php echo tep_draw_input_field('email_address'); ?></td>
                                </tr>
                                <tr>
                                  <td colspan="2" align="right" valign="top"><?php echo '<a href="' . tep_href_link(FILENAME_LOGIN_ADMIN, '' , 'SSL') . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a> ' . tep_image_submit('button_confirm.png', IMAGE_BUTTON_LOGIN); ?>&nbsp;</td>
                                </tr>
<?php
  }
?>
															</table>
														</td>
													</tr>
                        </table>
                      </td>
                    </tr>
                  </table>
                </form>
                </td>
       		  </tr>
   		  </table>
					</td>
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