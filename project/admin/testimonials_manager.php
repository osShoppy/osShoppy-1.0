<?php // catalog/admin/testimonials_manager.php (5477)

  require('includes/application_top.php');

  if ($HTTP_GET_VARS['action']) {
    switch ($HTTP_GET_VARS['action']) {
      case 'setflag':
        if ( ($HTTP_GET_VARS['flag'] == '0') || ($HTTP_GET_VARS['flag'] == '1') ) {
          tep_set_TESTIMONIALS_status($HTTP_GET_VARS['tID'], $HTTP_GET_VARS['flag']);
          $messageStack->add_session(SUCCESS_TESTIMONIALS_STATUS_UPDATED, 'success');
        } else {
          $messageStack->add_session(ERROR_UNKNOWN_STATUS_FLAG, 'error');
        }

        tep_redirect(tep_href_link(FILENAME_TESTIMONIALS_MANAGER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $HTTP_GET_VARS['tID']));
        break;
      case 'insert':
      case 'update':
	    $testimonials_id = tep_db_prepare_input($HTTP_POST_VARS['testimonials_id']);
        $testimonials_title = tep_db_prepare_input($HTTP_POST_VARS['testimonials_title']);
        $testimonials_name = tep_db_prepare_input($HTTP_POST_VARS['testimonials_name']);
        $testimonials_email = tep_db_prepare_input($HTTP_POST_VARS['testimonials_email']);
        $testimonials_location = tep_db_prepare_input($HTTP_POST_VARS['testimonials_location']);
        $html_text = tep_db_prepare_input($HTTP_POST_VARS['html_text']);
		
		
		// make sure testimonials directory is existing
		if(!is_dir(DIR_FS_CATALOG_IMAGES . 'uploads_testimonial_manager'))mkdir(DIR_FS_CATALOG_IMAGES . 'uploads_testimonial_manager', '777');
		
		$testimonial_image = new upload('testimonial_image');
        $testimonial_image->set_destination(DIR_FS_CATALOG_IMAGES . 'uploads_testimonial_manager/');
        if ($testimonial_image->parse() && $testimonial_image->save()) {
          $testimonial_image_name = $testimonial_image->filename;
        }
		
		if($testimonial_image_name == ''){
		// get image
		$testi_img_sql = tep_db_query("select testimonial_image from customer_testimonials where testimonials_id = '" . $testimonials_id . "'");
		$testi_img = tep_db_fetch_array($testi_img_sql);		
		$testimonial_image_name = $testi_img['testimonial_image'];
		}
		
		

        $testimonials_error = false;
        
        if (empty($testimonials_title)) {
          $messageStack->add(ERROR_TESTIMONIALS_TITLE_REQUIRED, 'error');
          $testimonials_error = true;
        }
        if (empty($testimonials_name)) {
          $messageStack->add(ERROR_TESTIMONIALS_NAME_REQUIRED, 'error');
          $testimonials_error = true;
        }
		if (empty($testimonials_email)) {
          $messageStack->add(ERROR_TESTIMONIALS_EMAIL_REQUIRED, 'error');
          $testimonials_error = true;
        }
	    if (!tep_validate_email($testimonials_email)) {
          $messageStack->add(ENTRY_EMAIL_ADDRESS_CHECK_ERROR, 'error');
          $testimonials_error = true;
	    }
        if (empty($html_text)) {
          $messageStack->add(ERROR_TESTIMONIALS_DESCRIPTION_REQUIRED, 'error');
          $testimonials_error = true;
        }

        if (!$testimonials_error) {
          $sql_data_array = array('testimonials_title' => $testimonials_title,
                                  'testimonials_name' => $testimonials_name,
								  'testimonials_email' => $testimonials_email,
								  'testimonials_location' => $testimonials_location,
                                  'testimonials_html_text' => $html_text,
								  'testimonial_image' => $testimonial_image_name);

          if ($HTTP_GET_VARS['action'] == 'insert') {
            $insert_sql_data = array('date_added' => 'now()',
                                     'status' => '1');
            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);
            tep_db_perform(TABLE_TESTIMONIALS, $sql_data_array);
            $testimonials_id = tep_db_insert_id();
            $messageStack->add_session(SUCCESS_TESTIMONIALS_INSERTED, 'success');
          } elseif ($HTTP_GET_VARS['action'] == 'update') {
            tep_db_perform(TABLE_TESTIMONIALS, $sql_data_array, 'update', "testimonials_id = '" . (int)$testimonials_id . "'");
            $messageStack->add_session(SUCCESS_TESTIMONIALS_UPDATED, 'success');
          }
          tep_redirect(tep_href_link(FILENAME_TESTIMONIALS_MANAGER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $testimonials_id));
        }

		if ($testimonials_error) {
		  if ($HTTP_GET_VARS['action'] == 'insert') {
			$HTTP_GET_VARS['action'] = 'new_insert';
		  } elseif ($HTTP_GET_VARS['action'] == 'update') {
			$HTTP_GET_VARS['action'] = 'new_update';
		  }
        }
        break;
      case 'deleteconfirm':
        $testimonials_id = tep_db_prepare_input($HTTP_GET_VARS['tID']);

        tep_db_query("delete from " . TABLE_TESTIMONIALS . " where testimonials_id = '" . tep_db_input($testimonials_id) . "'");

        $messageStack->add_session(SUCCESS_TESTIMONIALS_REMOVED, 'success');

        tep_redirect(tep_href_link(FILENAME_TESTIMONIALS_MANAGER, 'page=' . $HTTP_GET_VARS['page']));
        break;
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  if ($HTTP_GET_VARS['action'] == 'new_insert') {
	  $form_action = 'insert';
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr><?php echo tep_draw_form('new_banner', FILENAME_TESTIMONIALS_MANAGER, 'page=' . $HTTP_GET_VARS['page'] . '&action=' . $form_action, 'post', 'enctype="multipart/form-data"');?>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td width="30%" class="main"><?php echo TEXT_TESTIMONIALS_TITLE; ?></td>
            <td class="main"><?php echo tep_draw_input_field('testimonials_title', $tInfo->testimonials_title, '', true); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td width="30%" class="main"><?php echo TEXT_TESTIMONIALS_NAME; ?></td>
            <td class="main"><?php echo tep_draw_input_field('testimonials_name', $tInfo->testimonials_name, '', true); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
		  <tr>
            <td width="30%" class="main"><?php echo TEXT_TESTIMONIALS_EMAIL; ?></td>
            <td class="main"><?php echo tep_draw_input_field('testimonials_email', $tInfo->testimonials_email, '', true);?></td>
          <tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
		  <tr>
            <td width="30%" class="main"><?php echo TEXT_TESTIMONIALS_LOCATION; ?></td>
            <td class="main"><?php echo tep_draw_input_field('testimonials_location', $tInfo->testimonials_location); ?></td>
          <tr>		  
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td width="30%" valign="top" class="main"><?php echo TEXT_BANNERS_HTML_TEXT; ?></td>
            <td class="main"><?php echo tep_draw_textarea_field('html_text', 'soft', '60', '5', $tInfo->testimonials_html_text); ?></td>
          </tr>		  
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
		  <tr>
            <td width="30%" class="main">Image uploaded</td>
            <td class="main"><?php echo tep_draw_file_field('testimonial_image'); ?></td>
          <tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main" valign="top" align="left"><?php echo tep_image_submit('button_insert.png', IMAGE_INSERT) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_TESTIMONIALS_MANAGER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $HTTP_GET_VARS['tID']) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>'; ?></td>
      </tr>
      </form></tr>
<?php
  } elseif ($HTTP_GET_VARS['action'] == 'new_update') {
      if ($HTTP_GET_VARS['tID']) {
	    $tID = tep_db_prepare_input($HTTP_GET_VARS['tID']);
        $form_action = 'update';

        $testimonials_query = tep_db_query("select * from " . TABLE_TESTIMONIALS . " where testimonials_id = '" . tep_db_input($tID) . "'");
        $testimonials = tep_db_fetch_array($testimonials_query);

        $tInfo = new objectInfo($testimonials);
	  }elseif ($HTTP_POST_VARS) {
        $bInfo = new objectInfo($HTTP_POST_VARS);
      } else {
        $bInfo = new objectInfo(array());
      }
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr><?php echo tep_draw_form('new_banner', FILENAME_TESTIMONIALS_MANAGER, 'page=' . $HTTP_GET_VARS['page'] . '&action=' . $form_action, 'post', 'enctype="multipart/form-data"');
			    echo tep_draw_hidden_field('testimonials_id', $tID); 
	      ?>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td width="30%" class="main"><?php echo TEXT_TESTIMONIALS_TITLE; ?></td>
            <td class="main"><?php echo tep_draw_input_field('testimonials_title', $tInfo->testimonials_title, '', true); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td width="30%" class="main"><?php echo TEXT_TESTIMONIALS_NAME; ?></td>
            <td class="main"><?php echo tep_draw_input_field('testimonials_name', $tInfo->testimonials_name, '', true); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
		  <tr>
            <td width="30%" class="main"><?php echo TEXT_TESTIMONIALS_EMAIL; ?></td>
            <td class="main"><?php echo tep_draw_input_field('testimonials_email', $tInfo->testimonials_email, '', true);?></td>
          <tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
		  <tr>
            <td width="30%" class="main"><?php echo TEXT_TESTIMONIALS_LOCATION; ?></td>
            <td class="main"><?php echo tep_draw_input_field('testimonials_location', $tInfo->testimonials_location); ?></td>
          <tr>		  
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td width="30%" valign="top" class="main"><?php echo TEXT_BANNERS_HTML_TEXT; ?></td>
            <td class="main"><?php echo tep_draw_textarea_field('html_text', 'soft', '60', '5', $tInfo->testimonials_html_text); ?></td>
          </tr>	  
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
		  <tr>
            <td width="30%" class="main" valign="top">Image uploaded:</td>
            <td class="main">
			<?php if($tInfo->testimonial_image){
				echo '<img src="../images/uploads_testimonial_manager/' . $tInfo->testimonial_image . '"><br><br>Upload another image to replace<br>';
			}
			echo tep_draw_file_field('testimonial_image');
			 ?></td>
          <tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main" valign="top" align="left"><?php echo tep_image_submit('button_update.png', IMAGE_UPDATE) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_TESTIMONIALS_MANAGER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $HTTP_GET_VARS['tID']) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>'; ?></td>
      </tr>
      </form></tr>
<?php
  } else {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TESTIMONIALS_ID; ?>  </td>
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_TESTIMONIALS_NAME; ?></td>
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_TESTIMONIALS_EMAIL; ?></td>
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_TESTIMONIALS_LOCATION; ?></td>
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_TESTIMONIALS_TITLE; ?></td>
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_TESTIMONIALS_DESCRIPTION; ?></td>
                <td class="dataTableHeadingContent" align="left"><?php echo 'Image'; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
    $testimonials_query_raw = "select * from " . TABLE_TESTIMONIALS . " order by testimonials_id";
    $testimonials_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $testimonials_query_raw, $testimonials_query_numrows);
    $testimonials_query = tep_db_query($testimonials_query_raw);
    while ($testimonials = tep_db_fetch_array($testimonials_query)) {
      if (((!$HTTP_GET_VARS['tID']) || ($HTTP_GET_VARS['tID'] == $testimonials['testimonials_id'])) && (!$tInfo) && (substr($HTTP_GET_VARS['action'], 0, 3) != 'new')) {
        $tInfo = new objectInfo($testimonials);
      }

      if ( (is_object($tInfo)) && ($testimonials['testimonials_id'] == $tInfo->testimonials_id) ) {
        echo '              <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_TESTIMONIALS_MANAGER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $tInfo->testimonials_id) . '\'">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_TESTIMONIALS_MANAGER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $testimonials['testimonials_id']) . '\'">' . "\n";
      }
?>
                <td nowrap class="dataTableContent"><?php echo $testimonials['testimonials_id']; ?></td>
                <td class="dataTableContent" align="left"><?php echo $testimonials['testimonials_name']; ?></td>
                <td class="dataTableContent" align="left"><?php echo $testimonials['testimonials_email']; ?></td>
				<td class="dataTableContent" align="left"><?php echo $testimonials['testimonials_location']; ?></td>
                <td class="dataTableContent" align="left"><?php echo $testimonials['testimonials_title']; ?></td>
                <td class="dataTableContent" align="right"><?php echo substr($testimonials['testimonials_html_text'], 0, 30); ?> [more]</b></td>
                <td class="dataTableContent" align="left"><?php echo $testimonials['testimonial_image']; ?></td>
                <td class="dataTableContent" align="right">
                <?php
                if ($testimonials['status'] == '1') {
                    echo tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_green.gif', 'Active', 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_TESTIMONIALS_MANAGER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $testimonials['testimonials_id'] . '&action=setflag&flag=0') . '">' . tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_red_light.gif', 'Set Inactive', 10, 10) . '</a>';
                }
                else {
                    echo '<a href="' . tep_href_link(FILENAME_TESTIMONIALS_MANAGER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $testimonials['testimonials_id'] . '&action=setflag&flag=1') . '">' . tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_green_light.gif', 'Set Active', 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_red.gif', 'Inactive', 10, 10);
                }
                ?></td>
                <td class="dataTableContent" align="right"><?php if ( (is_object($tInfo)) && ($testimonials['testimonials_id'] == $tInfo->testimonials_id) ) { echo tep_image(DIR_WS_IMAGES . 'icons/info_icons/icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_TESTIMONIALS_MANAGER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $testimonials['testimonials_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icons/info_icons/icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
?>
              <tr>
                <td colspan="8"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $testimonials_split->display_count($testimonials_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_TESTIMONIALS); ?></td>
                    <td class="smallText" align="right"><?php echo $testimonials_split->display_links($testimonials_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page']); ?></td>
                  </tr>
                  <tr>
                    <td align="right" colspan="2"><?php echo '<a href="' . tep_href_link(FILENAME_TESTIMONIALS_MANAGER, 'action=new_insert') . '">' . tep_image_button('button_new_testimonial.png', IMAGE_NEW_TESTIMONIAL) . '</a>'; ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();
  switch ($HTTP_GET_VARS['action']) {
    case 'delete':
      $heading[] = array('text' => '<b>' . $tInfo->testimonials_title . '</b>');

      $contents = array('form' => tep_draw_form('testimonials', FILENAME_TESTIMONIALS_MANAGER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $tInfo->testimonials_id . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $tInfo->testimonials_title . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.png', IMAGE_DELETE) . '&nbsp;<a href="' . tep_href_link(FILENAME_TESTIMONIALS_MANAGER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $HTTP_GET_VARS['tID']) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (is_object($tInfo)) {
        $heading[] = array('text' => '<b>' . $tInfo->testimonials_title . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_TESTIMONIALS_MANAGER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $tInfo->testimonials_id . '&action=new_update') . '">' . tep_image_button('button_edit.png', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_TESTIMONIALS_MANAGER, 'page=' . $HTTP_GET_VARS['page'] . '&tID=' . $tInfo->testimonials_id . '&action=delete') . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_TESTIMONIALS_DATE_ADDED . ' ' . tep_date_short($tInfo->date_added));
        $contents[] = array('text' => '<br><b>Full Testimonial Text</b>:<br>' . $tInfo->testimonials_html_text . '<br>');
      }
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
        </table></td>
      </tr>
<?php
  }
?>
    </table></td>
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