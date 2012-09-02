<?php // $Id: /catalog/admin/login_admin.php (1359)

  define('ADMIN_TEMPLATE', 'osShoppy');

  require('includes/application_top.php');
  //require('includes/functions/password_funcs.php');
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'process')) {
    $email_address = tep_db_prepare_input($HTTP_POST_VARS['email_address']);
    $password = tep_db_prepare_input($HTTP_POST_VARS['password']);

// Check if email exists
    $check_admin_query = tep_db_query("select admin_id as login_id, admin_groups_id as login_groups_id, admin_firstname as login_firstname, admin_email_address as login_email_address, admin_password as login_password, admin_modified as login_modified, admin_logdate as login_logdate, admin_lognum as login_lognum from " . TABLE_ADMIN . " where admin_email_address = '" . tep_db_input($email_address) . "'");
    if (!tep_db_num_rows($check_admin_query)) {
      $HTTP_GET_VARS['login'] = 'fail';
    } else {
      $check_admin = tep_db_fetch_array($check_admin_query);
      // Check that password is good
      if (!tep_validate_password($password, $check_admin['login_password'])) {
        $HTTP_GET_VARS['login'] = 'fail';
      } else {
        if (tep_session_is_registered('password_forgotten')) {
          tep_session_unregister('password_forgotten');
        }

        $login_id = $check_admin['login_id'];
        //$login_groups_id = $check_admin[login_groups_id];
        $login_groups_id = $check_admin['login_groups_id'];
        $login_firstname = $check_admin['login_firstname'];
        $login_email_address = $check_admin['login_email_address'];
        $login_logdate = $check_admin['login_logdate'];
        $login_lognum = $check_admin['login_lognum'];
        $login_modified = $check_admin['login_modified'];

        tep_session_register('login_id');
        tep_session_register('login_groups_id');
        tep_session_register('login_first_name');

        //$date_now = date('Ymd');
        tep_db_query("update " . TABLE_ADMIN . " set admin_logdate = now(), admin_lognum = admin_lognum+1 where admin_id = '" . $login_id . "'");

        if (($login_lognum == 0) || !($login_logdate) || ($login_email_address == 'admin@localhost') || ($login_modified == '0000-00-00 00:00:00')) {
          tep_redirect(tep_href_link(FILENAME_ADMIN_ACCOUNT));
        } else {
	   if (isset($HTTP_GET_VARS['url'])) {
          tep_redirect($HTTP_GET_VARS['url']);
	   } else {
          tep_redirect(tep_href_link(FILENAME_DEFAULT));
	   }
        }

      }
    }
  }

  @include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN_ADMIN);
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

<p>
  <?php	
  $languages = tep_get_languages();
  $languages_array = array();
  $languages_selected = DEFAULT_LANGUAGE;
  for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    $languages_array[] = array('id' => $languages[$i]['code'],
                               'text' => $languages[$i]['name']);
    if ($languages[$i]['directory'] == $language) {
      $languages_selected = $languages[$i]['code'];
    }
  }  
?>
</p>
<table border="0" width="600" height="70%" cellspacing="0" cellpadding="0" align="center" valign="top">
  <tr>
    <td>
    	<table border="0" width="600" height="340" cellspacing="0" cellpadding="1" align="center" valign="middle">
		
		<tr>
			<td>
				<table border="0" width="100%" cellspacing="0" cellpadding="2">
			  	<tr><?php echo tep_draw_form('languages', 'login_admin.php', '', 'get'); ?>
				<td height="24" class="main"><b><?php echo HEADING_TITLE; ?></b></td>
				<td align="right" class="main"><?php echo CHOOSE_LANGUAGE ?>&nbsp;<?php echo tep_draw_pull_down_menu('language', $languages_array, $languages_selected, 'onChange="this.form.submit();"'); ?></td>
			  	</form></tr>
				</table>
			</td>
        </tr>	
		
      	<tr class="mainback">
        	<td height="288">
          	<table border="0" width="600" height="275" cellspacing="0" cellpadding="0">
          		<tr class="logo-head" height="50">
              	<td height="50" align="left"><img src="templates/<?php  echo ADMIN_TEMPLATE?>/images/store_logo.png" border="0" /></td>
            		<td align="center" class="nav-head" nowrap><?php echo '<a href="' . tep_catalog_href_link() . '" target="_blank" >' . tep_image(DIR_WS_IMAGES . 'icons/header_icons/header_icon_toshop.png', HEADER_TO_SHOP) . '</a>'; ?></td>
          		</tr>
          		<tr class="main">
		            <td height="225" colspan="2" align="center" valign="middle">
<?php 
 if (isset($HTTP_GET_VARS['url'])) {
echo tep_draw_form('login', FILENAME_LOGIN_ADMIN, 'action=process&url=' . $HTTP_GET_VARS['url']); 
 } else {
echo tep_draw_form('login', FILENAME_LOGIN_ADMIN, 'action=process'); 
 }
?>
                	<table width="280" border="0" cellpadding="2" cellspacing="0" class="productReviews-even">
                  	<tr>
                    	<td class="main" valign="top">&nbsp;<b><?php echo HEADING_RETURNING_ADMIN; ?></b></td>
                    </tr>
                    <tr>
                      <td height="100%" valign="top" align="center">
                      	<table border="0" height="100%" cellspacing="0" cellpadding="1" class="login_form_bg">
                        	<tr>
                          	<td>
                            	<table width="100%" height="100%" cellspacing="3" cellpadding="2" class="login_form">
																<?php
																  if ($HTTP_GET_VARS['login'] == 'fail') {
																    $info_message = TEXT_LOGIN_ERROR;
																  }
                                  if (isset($info_message)) {
																?>
                              	<tr>
                                	<td colspan="2" class="errorBox" align="center"><?php echo $info_message; ?></td>
                                </tr>
<?php
  } else {
?>
                                <tr>
                                	<td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                                </tr>
<?php
  }
?>
                                <tr>
                                	<td class="main"><b><?php echo ENTRY_EMAIL_ADDRESS; ?></b></td>
                                  <td class="login"><?php echo tep_draw_input_field('email_address'); ?></td>
                                </tr>
                                <tr>
                                	<td class="main"><b><?php echo ENTRY_PASSWORD; ?></b></td>
                                  <td class="login"><?php echo tep_draw_password_field('password'); ?></td>
                                </tr>
                                <tr>
                                	<td colspan="2" align="right" valign="top"><?php echo tep_image_submit('button_confirm.png', IMAGE_BUTTON_LOGIN); ?></td>
                                </tr>
                              </table>
							  </td>
						  </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                    	<td valign="top" align="right" class="main"><?php echo '<a class="sub" href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '"><u>' . TEXT_PASSWORD_FORGOTTEN . '</u></a><span class="sub">&nbsp;</span>'; ?></td>
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