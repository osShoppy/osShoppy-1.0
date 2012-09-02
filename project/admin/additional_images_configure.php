<?php //$Id: /catalog/admin/additional_images_configure.php (1032)

  require('includes/application_top.php');
  require(DIR_WS_INCLUDES . basename(__FILE__));

  // change this var to the page the cancel button will go to. for no cancel button, set to empty string ""
  $cancel_url = FILENAME_ADDITIONAL_IMAGES;

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');
  
// check if the catalog image directory exists
  if (is_dir(DIR_FS_CATALOG_IMAGES)) {
    if (!is_writeable(DIR_FS_CATALOG_IMAGES)) $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE, 'error');
  } else {
    $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST, 'error');
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<script language="javascript"><!--
function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=yes,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=660,height=600,screenX=150,screenY=150,top=150,left=150')
}
//--></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="SetFocus();">

<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
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
    
<?php
  
  
  if ($action == 'normal' || $action == 'force') {


        ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
		    <td class="smalltext" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td class="smalltext"><?php echo TEXT_UPDATING_CONFIGURATION; ?><br><?php 

			foreach ($configuration_array as $tkey => $configuration) {
			  $configuration_group_query = tep_db_query('select configuration_group_id from ' . TABLE_CONFIGURATION_GROUP . " where configuration_group_title = '" . $configuration['group']['configuration_group_title'] . "' limit 1");
			  if (tep_db_num_rows($configuration_group_query) > 0) {
			    echo '<br><font color=green>'.sprintf(TEXT_UPDATING_CONFIGURATION_GROUP, $configuration['group']['configuration_group_title']).'</font><br>&nbsp;&nbsp;<font color=gray>Checking for items...</font><br>'."\n";
				$configuration_group = tep_db_fetch_array($configuration_group_query);
				$configuration_group_id = $configuration_group['configuration_group_id'];
				tep_db_query('update ' . TABLE_CONFIGURATION_GROUP . " set configuration_group_description = '" . $configuration['group']['configuration_group_description'] . "' where configuration_group_id = '" . $configuration_group_id . "' limit 1");
				$sort_order_query = tep_db_query('select max(sort_order) from ' . TABLE_CONFIGURATION . " where configuration_group_id = '" . $configuration_group_id . "'");
				$sort_order_array = mysql_fetch_array($sort_order_query);
				$use_sort_order = $sort_order_array[0]+1;
			  } else {
			    echo '<br><font color=green>'.sprintf(TEXT_ADDING_CONFIGURATION_GROUP, $configuration['group']['configuration_group_title']).'</font><br>'."\n";
				$group_sort_order_query = tep_db_query('select max(sort_order) from ' . TABLE_CONFIGURATION_GROUP);
				$group_sort_order_array = mysql_fetch_array($group_sort_order_query);
				$group_sort_order = $group_sort_order_array[0]+1;
				tep_db_query('insert into ' . TABLE_CONFIGURATION_GROUP . " (configuration_group_title, configuration_group_description, sort_order, visible) VALUES ('".$configuration['group']['configuration_group_title']."', '".$configuration['group']['configuration_group_description']."', '".$group_sort_order."', '".$configuration['group']['visible']."')");
				$configuration_group_id = tep_db_insert_id();
				$use_sort_order = 1;
			  }

              foreach ($configuration['data'] as $configuration_key => $configuration_data) {
                $configuration_query = tep_db_query('select configuration_id, configuration_title, configuration_value, configuration_description, sort_order, use_function, set_function from ' . TABLE_CONFIGURATION . " where configuration_key = '" . $configuration_key . "' limit 1");
				if (tep_db_num_rows($configuration_query) > 0) {
                  echo '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_UPDATING_CONFIGURATION_KEY, $configuration_key).'</font><br>'."\n";
                  $configuration = tep_db_fetch_array($configuration_query);
				  tep_db_query('update ' . TABLE_CONFIGURATION . " set configuration_title = '" . $configuration_data['configuration_title'] . "', configuration_value = '" . ($action == 'force' ? $configuration_data['configuration_value'] : $configuration['configuration_value']) . "', configuration_description = '" . $configuration_data['configuration_description'] . "', configuration_group_id = " . $configuration_group_id . ", sort_order = " . ($action == 'force' ? $use_sort_order++ : $configuration['sort_order']) . ", last_modified = now(), use_function = " . (!empty($configuration_data['use_function']) ? "'".$configuration_data['use_function']."'" : "NULL" ) . ", set_function = " . (!empty($configuration_data['set_function']) ? "'".$configuration_data['set_function']."'" : "NULL" ) . " where configuration_id = '" . $configuration['configuration_id'] . "' limit 1");
                  $found_one = true;
				} else {
                  echo '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_ADDING_CONFIGURATION_KEY, $configuration_key).'</font><br>'."\n";
				  tep_db_query('insert into ' . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) values ('" . $configuration_data['configuration_title'] . "', '" . $configuration_key . "', '" . $configuration_data['configuration_value'] . "', '" . $configuration_data['configuration_description'] . "', " . $configuration_group_id . ", " . $use_sort_order++ . ", now(), " . (!empty($configuration_data['use_function']) ? "'".$configuration_data['use_function']."'" : "NULL" ) . ", " . (!empty($configuration_data['set_function']) ? "'".$configuration_data['set_function']."'" : "NULL" ) . ")");
                }
                tep_db_free_result($configuration_query);
              }
			  tep_db_free_result($configuration_group_query);
			}

			echo '<br><font color=gray>'.TEXT_CHECKING_FOR_TABLES.'</font><br>'."\n";
			if (sizeof($tables_array) > 0) {
			  foreach ($tables_array as $tkey => $tables) {
			    $table_query = tep_db_query("SHOW TABLES");
			    if (tep_db_num_rows($table_query) > 0) {
			      $found = false;
				  while ($row = mysql_fetch_array($table_query)) {
				    if ($row[0] == $tables['tablename']) {
					  $found = true;
					  break;
				    }
				  }
				  if ($found) {
				    echo '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_TABLE_FOUND_DOING_NOTHING, $tables['tablename']).'</font><br>'."\n";
					$found_one = true;
                  } else {
				    echo '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_TABLE_NOT_FOUND_CREATING, $tables['tablename']).'</font><br>'."\n";
                    if (tep_db_query($tables['create'])) {
					  echo '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_SUCCESS_CREATING_TABLE, $tables['tablename']).'</font><br>'."\n";
					} else {
					  echo '&nbsp;&nbsp;<font color=red>'.sprintf(TEXT_ERROR_CREATING_TABLE, $tables['tablename']).'</font><br>'."\n";
					}
				  }
			    }
			    tep_db_free_result($table_query);
			  } 
			} else {
			  echo '&nbsp;&nbsp;<font color=gray>'.TEXT_NO_TABLES.'</font><br>'."\n";
			}

			echo '<br><font color=gray>'.TEXT_CHECKING_FOR_COLUMNS.'</font><br>'."\n";
			if (sizeof($table_mods_array) > 0) {
			  foreach ($table_mods_array as $tkey => $table_mods) {
			    $columns_query = tep_db_query("SHOW COLUMNS FROM " . $table_mods['tablename']);
			    if (tep_db_num_rows($columns_query) > 0) {
			      $found = false;
				  while ($row = mysql_fetch_array($columns_query)) {
				    if ($row[0] == $table_mods['columnname']) {
					  $found = true;
					  break;
				    }
				  }
				  if ($found) {
				    echo '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_COLUMN_FOUND_DOING_NOTHING, $table_mods['columnname'], $table_mods['tablename']).'</font><br>'."\n";
					$found_one = true;
                  } else {
				    echo '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_COLUMN_NOT_FOUND_CREATING, $table_mods['columnname'], $table_mods['tablename']).'</font><br>'."\n";
                    if (tep_db_query($table_mods['create'])) {
					  echo '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_SUCCESS_CREATING_COLUMN, $table_mods['columnname'], $table_mods['tablename']).'</font><br>'."\n";
					} else {
					  echo '&nbsp;&nbsp;<font color=red>'.sprintf(TEXT_ERROR_CREATING_COLUMN, $table_mods['columnname'], $table_mods['tablename']).'</font><br>'."\n";
					}
				  }
			    }
			    tep_db_free_result($columns_query);
			  }
			} else {
			  echo '&nbsp;&nbsp;<font color=gray>'.TEXT_NO_COLUMNS.'</font><br>'."\n";
			}
			
			
            ?></td>
          </tr>
        </table>
        <?php


  } elseif ($action == 'uninstall') {
	
        ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
		    <td class="smalltext" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td class="smalltext"><?php echo TEXT_REMOVING_CONFIGURATION; ?><br><?php 
	
			echo '<br><font color=gray>'.TEXT_CHECKING_FOR_COLUMNS_REMOVE.'</font><br>'."\n";
			if (sizeof($table_mods_array) > 0) {
			  foreach ($table_mods_array as $tkey => $table_mods) {
			    $table_query = tep_db_query("SHOW TABLES");
			    if (tep_db_num_rows($table_query) > 0) {
			      $found = false;
				  while ($row = mysql_fetch_array($table_query)) {
				    if ($row[0] == $table_mods['tablename']) {
					  $found = true;
					  break;
				    }
				  }
				  if ($found) {

					$columns_query = tep_db_query("SHOW COLUMNS FROM " . $table_mods['tablename']);
					if (tep_db_num_rows($columns_query) > 0) {
					  $found = false;
					  while ($row = mysql_fetch_array($columns_query)) {
						if ($row[0] == $table_mods['columnname']) {
						  $found = true;
						  break;
						}
					  }
					  if ($found) {
						echo '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_COLUMN_FOUND_REMOVING, $table_mods['columnname'], $table_mods['tablename']).'</font><br>'."\n";
						if (tep_db_query($table_mods['remove'])) {
						  echo '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_SUCCESS_REMOVING_COLUMN, $table_mods['columnname'], $table_mods['tablename']).'</font><br>'."\n";
						} else {
						  echo '&nbsp;&nbsp;<font color=red>'.sprintf(TEXT_ERROR_REMOVING_COLUMN, $table_mods['columnname'], $table_mods['tablename']).'</font><br>'."\n";
						}
					  } else {
						echo '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_COLUMN_NOT_FOUND_DOING_NOTHING, $table_mods['columnname'], $table_mods['tablename']).'</font><br>'."\n";
					  }
					}
					tep_db_free_result($columns_query);

                  } else {
				    echo '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_TABLE_FOUND_NOT_PROCESSING, $table_mods['tablename']).'</font><br>'."\n";
				  }
			    }
			    tep_db_free_result($table_query);
			  }
			} else {
			  echo '&nbsp;&nbsp;<font color=gray>'.TEXT_NO_COLUMNS.'</font><br>'."\n";
			}

			echo '<br><font color=gray>'.TEXT_CHECKING_TABLES.'</font><br>'."\n";
			if (sizeof($tables_array) > 0) {
			  foreach ($tables_array as $tkey => $tables) {
			    $table_query = tep_db_query("SHOW TABLES");
			    if (tep_db_num_rows($table_query) > 0) {
			      $found = false;
				  while ($row = mysql_fetch_array($table_query)) {
				    if ($row[0] == $tables['tablename']) {
					  $found = true;
					  break;
				    }
				  }
				  if ($found) {
				    echo '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_TABLE_FOUND_REMOVING, $tables['tablename']).'</font><br>'."\n";
                    if (tep_db_query($tables['remove'])) {
					  echo '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_SUCCESS_REMOVE_TABLE, $tables['tablename']).'</font><br>'."\n";
					} else {
					  echo '&nbsp;&nbsp;<font color=red>'.sprintf(TEXT_ERROR_REMOVING_TABLE, $tables['tablename']).'</font><br>'."\n";
					}
                  } else {
				    echo '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_TABLE_NOT_FOUND_DOING_NOTHING, $tables['tablename']).'</font><br>'."\n";
				  }
			    }
			    tep_db_free_result($table_query);
			  } 
			} else {
			  echo '&nbsp;&nbsp;<font color=gray>'.TEXT_NO_TABLES.'</font><br>'."\n";
			}

			echo '<br><font color=gray>'.TEXT_CHECKING_CONFIGURATION.'</font><br>'."\n";
			// remove configuration table entries
			foreach ($configuration_array as $tkey => $configuration) {

			  echo '&nbsp;<font color=green>'.sprintf(TEXT_REMOVING_CONFIGURATION_GROUP, $configuration['group']['configuration_group_title']).'</font><br>'."\n";
			  // remove keys
			  foreach ($configuration['data'] as $configuration_key => $configuration_data) {
                $configuration_query = tep_db_query('select configuration_id from ' . TABLE_CONFIGURATION . " where configuration_key = '" . $configuration_key . "' limit 1");
				if (tep_db_num_rows($configuration_query) > 0) {
                  echo '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_REMOVING_CONFIGURATION_KEY, $configuration_key).'</font><br>'."\n";
				  tep_db_query('delete from ' . TABLE_CONFIGURATION . " where configuration_key = '" . $configuration_key . "' limit 1");
                } else {
                  echo '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_ERROR_CONFIGURATION_KEY_NOT_EXIST, $configuration_key).'</font><br>'."\n";
                }
                tep_db_free_result($configuration_query);
              }

			  // remove groups if empty
			  $configuration_group_query = tep_db_query('select configuration_group_id from ' . TABLE_CONFIGURATION_GROUP . " where configuration_group_title = '" . $configuration['group']['configuration_group_title'] . "' limit 1");
			  $configuration_group = tep_db_fetch_array($configuration_group_query);
			  $configuration_group_id = $configuration_group['configuration_group_id'];

			  $count_query = tep_db_query('select count(*) as total from ' . TABLE_CONFIGURATION . " where configuration_group_id = '" . $configuration_group['configuration_group_id'] . "'");
			  $count = tep_db_fetch_array($count_query);
			  $total_configurations = $count['total'];

			  if ($count['total'] < 1) {
                if (tep_db_query('delete from ' . TABLE_CONFIGURATION_GROUP . " where configuration_group_id = '" . $configuration_group['configuration_group_id'] . "' limit 1")) {
				  echo '&nbsp;<font color=green>'.sprintf(TEXT_SUCCESS_REMOVE_GROUP, $configuration['group']['configuration_group_title']).'</font><br><br>'."\n";
				} else {
				  echo '&nbsp;<font color=red>'.sprintf(TEXT_ERROR_REMOVING_GROUP, $configuration['group']['configuration_group_title']).'</font><br><br>'."\n";
				}
			  } else {
			    echo '&nbsp;<font color=red>'.sprintf(TEXT_GROUP_NOT_EMPTY, $configuration['group']['configuration_group_title']).'</font><br><br>'."\n";
			  }
			  tep_db_free_result($configuration_group_query);
			  tep_db_free_result($count_query);

			}

            ?></td>
          </tr>
        </table>
        <?php



  } else {

        

        ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
		    <td class="smalltext" nowrap="nowrap">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            <td class="smalltext"><?php echo TEXT_CHECKING_CONFIGURATION_STATUS; ?><br><br><?php 



            list ($needs_update, $found_one, $status_messages) = db_update_status($configuration_array, $tables_array, $table_mods_array);
			if ($needs_update) {
			  echo '<font color=red size="4"><b>' . TEXT_DATABASE_REQUIRES_UPDATE . '</b></font><br><br>';
			} else {
			  echo '<font color=green size="4"><b>' . TEXT_DATABASE_IS_UP_TO_DATE . '</b></font><br><br>';
			}
			echo $status_messages . '<br>';
			
			
            ?></td>
          </tr>
        </table>
        <?php

  } // end if ($action) {

?>

       </td>

<?php

    $heading = array();
    $contents = array();
    switch ($action) {
      case 'process':
            $heading[] = array('text' => '<b>' . TEXT_SELECT_TASK . '</b>');
            $contents[] = array('text' => '<br><br><br>&nbsp;<a href="' . tep_href_link(basename(__FILE__)) . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a><br><br>'."\n");
        break;

      default:
            $heading[] = array('text' => '<b>' . TEXT_SELECT_TASK . '</b>');
            $contents[] = array('text' => tep_draw_form('process', basename(__FILE__), '', 'get', 'onsubmit="if(this.action[2].checked==true){if(confirm(\''.TEXT_UNINSTALL_CONFIRMATION.'\')){return confirm(\''.TEXT_UNINSTALL_CONFIRMATION2.'\');}else{return false;}}"') . 
                                          '<p>' . TEXT_CONFIG_PROCESS_DESCRIPTION . '</p>' . '<br>'."\n" . 
										  '<font color=red><b>' . TEXT_DATABASE_REQUIRES_UPDATE_WARNING . '</b></font><br><br><br>' . 
										  '&nbsp;' . tep_draw_input_field( /* $name */ 'action', /* $value */ 'normal', /* $parameters */ 'checked id="normal"', /* $required */ false, /* $type */ 'radio', /* $reinsert */ false) . '<label for="normal" style="cursor:hand;cursor:pointer;">' . TEXT_NORMAL_SETUP . '</label><br>'."\n" .
										  ($found_one ? '&nbsp;' . tep_draw_input_field( /* $name */ 'action', /* $value */ 'force', /* $parameters */ 'id="force"', /* $required */ false, /* $type */ 'radio', /* $reinsert */ false) . '<label for="force" style="cursor:hand;cursor:pointer;">' . TEXT_FORCE_REFRESH . '</label><br><br>'."\n" : '' ) . 
										  ($found_one ? '&nbsp;' . tep_draw_input_field( /* $name */ 'action', /* $value */ 'uninstall', /* $parameters */ 'id="uninstall"', /* $required */ false, /* $type */ 'radio', /* $reinsert */ false) . '<label for="uninstall" style="cursor:hand;cursor:pointer;color:#FF0000;">' . TEXT_UNINSTALL . '</label><br><br>'."\n" : '' ) . 
                                          '<br>&nbsp;' . tep_hide_session_id() .  tep_draw_input_field( /* $name */ 'submit', /* $value */ TEXT_CONFIG_PROCESS, /* $parameters */ '', /* $required */ false, /* $type */ 'submit', /* $reinsert */ false) . '<br><br><br>'."\n" . 
                                          (!empty($action) ? '&nbsp;<a href="' . tep_href_link(basename(__FILE__)) . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a> &nbsp; '."\n" : '') . 
                                          (!empty($cancel_url) ? '&nbsp;<a href="' . tep_href_link($cancel_url) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a><br>'."\n" : '') . 
                                          '<br>'."\n" . 
                                          '</form>');
        break;

    }

    if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
      echo '            <td width="25%" valign="top">' . "\n";

      $box = new box;
      echo $box->infoBox($heading, $contents);

      echo '            </td>' . "\n";
    }
?>

      </tr>
    </table>


    </td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
