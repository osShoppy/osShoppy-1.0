<?php //$Id: /catalog/admin/links.php (5272)

  require('includes/application_top.php');

// define our link functions
  require(DIR_WS_FUNCTIONS . 'links.php');

  /********************** BEGIN VERSION CHECKER *********************/
  if (file_exists(DIR_WS_FUNCTIONS . 'version_checker.php'))
  {
     require(DIR_WS_LANGUAGES . $language . '/version_checker.php');
     require(DIR_WS_FUNCTIONS . 'version_checker.php');
     $contribPath = 'http://addons.oscommerce.com/info/5272';
     $currentVersion = 'Links Manager II V 1.29';
     $contribName = 'Links Manager II V';
     $versionStatus = '';
  }
  /********************** END VERSION CHECKER *********************/

  CheckSettings();

  //goto the categories page if at least one category doesn't exist
  $linkCat_query = tep_db_query("select count(*) as total from " . TABLE_LINK_CATEGORIES_DESCRIPTION . " where language_id = '" . (int)$languages_id . "'");
  $linkCat = tep_db_fetch_array($linkCat_query);
  if ($linkCat['total'] < 1)
    tep_redirect(tep_href_link(FILENAME_LINK_CATEGORIES, 'no_categories=true'));

  $showLinkStatus = TEXT_SELECT_ALL;
  $links_statuses = array();
  $linkShow = array();
  $links_status_array = array();
  $links_status_query = tep_db_query("select links_status_id, links_status_name from " . TABLE_LINKS_STATUS . " where language_id = '" . (int)$languages_id . "'");
  $linkShow[] = array('id' => TEXT_SELECT_ALL, 'text' => TEXT_SELECT_ALL);
  while ($links_status = tep_db_fetch_array($links_status_query)) {
    $linkShow[] = $links_statuses[] = array('id' => $links_status['links_status_id'],
                               'text' => $links_status['links_status_name']);
    $links_status_array[$links_status['links_status_id']] = $links_status['links_status_name'];
  }

  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  $action_checkAllLinks = $_POST['num_links_to_check'];

  if (isset($_GET['links_status_list']))
    $showLinkStatus = tep_db_input(tep_db_prepare_input($_GET['links_status_list']));

  $error = false;
  $processed = false;
  $LINKS_WAITING = 4;

  if (tep_not_null($action)) {
    switch ($action) {
      case 'getversion':
        $versionStatus = AnnounceVersion($contribPath, $currentVersion, $contribName);
      break;

      case 'insert':
      case 'update':
        $links_id = tep_db_prepare_input($_GET['lID']);
        $links_title = tep_db_prepare_input($_POST['links_title']);
        $links_url = tep_db_prepare_input($_POST['links_url']);

        //See if a new category is being created
        if (tep_not_null($_POST['links_category_new']))
        {
            $categories_query = tep_db_query("select link_categories_id from " . TABLE_LINK_CATEGORIES_DESCRIPTION . " where link_categories_name = '" . tep_db_input(tep_db_prepare_input($_POST['links_category_new_parent'])) . "'");
            $categories = tep_db_fetch_array($categories_query);

            $catID = $categories['link_categories_id'];
            if (tep_db_num_rows($categories_query) < 1)
             $catID = 0;

            $insert_sql_data = array('parent_id' => $catID,
                                     'link_categories_date_added' => 'now()',
                                     'link_categories_sort_order' => 0);

            tep_db_perform(TABLE_LINK_CATEGORIES, $insert_sql_data);

            $link_categories_id = tep_db_insert_id();

            $languages = tep_get_languages();
            for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
              $link_categories_name_array = $_POST['links_category_new'];

            $language_id = $languages[$i]['id'];

            $sql_data_array = array('link_categories_name' => $_POST['links_category_new']);

            $insert_sql_data = array('link_categories_id' => $link_categories_id,
                                     'language_id' => $language_id);

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);
            tep_db_perform(TABLE_LINK_CATEGORIES_DESCRIPTION, $sql_data_array);
          }
          $links_category = $link_categories_id;
        } else {
          $links_category = tep_db_prepare_input($_POST['links_category']);
        }

        $links_description = tep_db_prepare_input($_POST['links_description']);
        $links_contact_name = tep_db_prepare_input($_POST['links_contact_name']);
        $links_contact_email = tep_db_prepare_input($_POST['links_contact_email']);
        if (LINKS_RECIPROCAL_REQUIRED == 'true')  $links_reciprocal_url = (isset($_POST['links_reciprocal_url']) ? tep_db_prepare_input($_POST['links_reciprocal_url']) : '');
        $links_status = tep_db_prepare_input($_POST['links_status']);
        $links_reciprocal_check_count = 0;
        $links_reciprocal_disable = ($_POST['links_reciprocal_disable'] == 'on') ? 1 : 0;
        $links_language = tep_db_prepare_input($_POST['links_language']);


        $linksImg = '';
        $links_image = new upload('links_image_url');
        $links_image->set_destination(DIR_FS_CATALOG_IMAGES .'uploads_links_manager/');

        if ($links_image->parse() && $links_image->save()) {
            $linksImg = tep_db_input($links_image->filename);
        }

        if (strlen($links_title) < ENTRY_LINKS_TITLE_MIN_LENGTH) {
          $error = true;
          $entry_links_title_error = true;
        } else {
          $entry_links_title_error = false;
        }

        if (strlen($links_url) < ENTRY_LINKS_URL_MIN_LENGTH) {
          $error = true;
          $entry_links_url_error = true;
        } else {
          $entry_links_url_error = false;
        }

        if (! tep_not_null($links_category)) {
          $error = true;
          $entry_links_category_error = true;
        } else {
          $entry_links_category_error = false;
        }

        if (strlen($links_description) < ENTRY_LINKS_DESCRIPTION_MIN_LENGTH) {
          $error = true;
          $entry_links_description_error = true;
        } else {
          $entry_links_description_error = false;
        }

        if (strlen($links_contact_name) > ENTRY_LINKS_DESCRIPTION_MAX_LENGTH) {
          $error = true;
          $entry_links_contact_name_error = true;
        } else {
          $entry_links_contact_name_error = false;
        }

        if (strlen($links_contact_email) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
          $error = true;
          $entry_links_contact_email_error = true;
        } else {
          $entry_links_contact_email_error = false;
        }

        if (!tep_validate_email($links_contact_email)) {
          $error = true;
          $entry_links_contact_email_check_error = true;
        } else {
          $entry_links_contact_email_check_error = false;
        }

        if (LINKS_RECIPROCAL_REQUIRED == 'true' && ! $links_reciprocal_disable) {
          if (strlen($links_reciprocal_url) < ENTRY_LINKS_URL_MIN_LENGTH && $links_status != $LINKS_WAITING) {
            $error = true;
            $entry_links_reciprocal_url_error = true;
          } else {
            $entry_links_reciprocal_url_error = false;
          }
        } else {
          $links_reciprocal_url = '';
        }


        if ($error == false) {

          $sql_data_array = array('links_url' => $links_url,
                                  'links_image_url' => $linksImg,
                                  'links_contact_name' => $links_contact_name,
                                  'links_contact_email' => $links_contact_email,
                                  'links_reciprocal_url' => $links_reciprocal_url,
                                  'links_reciprocal_check_count' => $links_reciprocal_check_count,
                                  'links_status' => $links_status,
                                  'links_reciprocal_disable' => $links_reciprocal_disable);

          if ($action == 'update') {
            $sql_data_array['links_last_modified'] = 'now()';
            tep_db_perform(TABLE_LINKS, $sql_data_array, 'update', "links_id = '" . (int)$links_id . "'");
          } else if($action == 'insert') {
            $sql_data_array['links_date_added'] = 'now()';
            tep_db_perform(TABLE_LINKS, $sql_data_array);
            $links_id = tep_db_insert_id();
          }

          if ($action == 'update') {
            tep_db_query("update " . TABLE_LINKS_TO_LINK_CATEGORIES . " set link_categories_id = '" . (int)$links_category . "' where links_id = '" . (int)$links_id . "'");
          } else if($action == 'insert') {
            tep_db_query("insert into " . TABLE_LINKS_TO_LINK_CATEGORIES . " ( links_id, link_categories_id) values ('" . (int)$links_id . "', '" . (int)$links_category . "')");
          }

          $sql_data_array = array('links_title' => $links_title,
                                  'links_description' => $links_description,
                                  'language_id' => $links_language);

          if ($action == 'update') {
            tep_db_perform(TABLE_LINKS_DESCRIPTION, $sql_data_array, 'update', "links_id = '" . (int)$links_id . "'");
          } else if($action == 'insert') {
            $insert_sql_data = array('links_id' => $links_id);
                                   //  'language_id' => $links_language);

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);
            tep_db_perform(TABLE_LINKS_DESCRIPTION, $sql_data_array);
          }

          if (isset($_POST['links_notify']) && ($_POST['links_notify'] == 'on')) {
            if ($links_status_array[$links_status] == 'Disabled')
            {
              if ($_POST['links_notify_denied_reason'] == '0')
                $statusUpdate =  $links_status_array[$links_status] . "\n\n\t" . sprintf(EMAIL_TEXT_RECIPROCOL_LINK_NOT_FOUND, $links_reciprocal_url);
              else if ($_POST['links_notify_denied_reason'] == '1')
                $statusUpdate =  $links_status_array[$links_status] . "\n\n\t" . EMAIL_TEXT_STATUS_DENIAL_CONTENT ;
              else if ($_POST['links_notify_denied_reason'] == '2')
                $statusUpdate =  $links_status_array[$links_status] . "\n\n\t" . EMAIL_TEXT_DOMAIN_MISMACH ;
              else if ($_POST['links_notify_denied_reason'] == '3')
                $statusUpdate =  $links_status_array[$links_status] . "\n\n\t" . EMAIL_TEXT_PARENT_MISMACH ;
              else
                $statusUpdate = $links_status_array[$links_status];
            }
            else
            {
              if ($links_status_array[$links_status] == 'Approved')
              {
                 $categories_query = tep_db_query("select l.links_id, l2lc.link_categories_id, lc.link_categories_id, lc.link_categories_name from " . TABLE_LINKS . " l left join " . TABLE_LINKS_TO_LINK_CATEGORIES . " l2lc on l.links_id =  l2lc.links_id left join  " . TABLE_LINK_CATEGORIES_DESCRIPTION . " lc on l2lc.link_categories_id = lc.link_categories_id where l2lc.link_categories_id = '" . (int)$links_category. "' AND lc.language_id = '" . (int)$languages_id . "' LIMIT 1");
                 $category = tep_db_fetch_array($categories_query);
                 $catname = str_replace(" ", "-",  $category['link_categories_name']);
                 $siteURL = sprintf("%s%slinks.php?lPath=%d", HTTP_CATALOG_SERVER,DIR_WS_CATALOG, $category['link_categories_id']);
                 $siteURL = sprintf(EMAIL_TEXT_URL_LOCATION, $siteURL);
              }
              $statusUpdate = $links_status_array[$links_status];
            }

            if ($action == 'update') {
              $email = sprintf(EMAIL_TEXT_STATUS_UPDATE, $links_contact_name, $statusUpdate, $siteURL) . "\n\n" . STORE_OWNER . "\n" . STORE_NAME;
              tep_mail($links_contact_name, $links_contact_email, EMAIL_TEXT_SUBJECT, $email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
            } else  if ($links_status_array[$links_status] == 'Approved') {
              $email = sprintf(EMAIL_TEXT_LINK_EXCHANGE_REQUEST, $links_contact_name, $siteURL) . "\n\n" . STORE_OWNER . "\n" . STORE_NAME;
              tep_mail($links_contact_name, $links_contact_email, EMAIL_TEXT_SUBJECT, $email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
            }
          }

          tep_redirect(tep_href_link(FILENAME_LINKS, tep_get_all_get_params(array('lID', 'action')) . 'lID=' . $links_id));
        } else if ($error == true) {
          $lInfo = new objectInfo($_POST);
          $processed = true;
        }

        break;
      case 'deleteconfirm':
        $links_id = tep_db_prepare_input($_GET['lID']);

        tep_remove_link($links_id);

        tep_redirect(tep_href_link(FILENAME_LINKS, tep_get_all_get_params(array('lID', 'action'))));
        break;

      case 'disablelink': //change the stats to disabled
        tep_db_query("update " . TABLE_LINKS . " set links_status = 3 where links_id = " . (int)$_GET['lID']);
        tep_redirect(tep_href_link(FILENAME_LINKS, tep_get_all_get_params(array('lID', 'action'))));
        break;

      default:
        $links_query = tep_db_query("select l.links_id, ld.links_title, l.links_url, ld.language_id, ld.links_description, l.links_contact_email, l.links_status, l.links_image_url, l.links_contact_name, l.links_reciprocal_url, l.links_category_suggest, l.links_status, l.links_reciprocal_disable from " . TABLE_LINKS . " l left join " . TABLE_LINKS_DESCRIPTION . " ld  on  ld.links_id = l.links_id where l.links_id = '" . (int)$_GET['lID'] ."'");
        $links = tep_db_fetch_array($links_query);

        $categories_query = tep_db_query("select link_categories_id as links_category from " . TABLE_LINKS_TO_LINK_CATEGORIES . " where links_id = '" . (int)$_GET['lID'] . "'");
        $category = tep_db_fetch_array($categories_query);

        $lInfo_array = array_merge((array)$links, (array)$category);
        $lInfo = new objectInfo($lInfo_array);
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<?php
  if ($action == 'edit' || $action == 'update' || $action == 'new' || $action == 'insert') {
?>
<script language="javascript"><!--

function check_form() {
  var error = 0;
  var error_message = "<?php echo JS_ERROR; ?>";

  var links_title = document.links.links_title.value;
  var links_url = document.links.links_url.value;
  var links_category = document.links.links_category.value;
  var links_description = document.links.links_description.value;
  var links_image_url = document.links.links_image_url.value;
  var links_contact_name = document.links.links_contact_name.value;
  var links_contact_email = document.links.links_contact_email.value;
  <?php if (LINKS_RECIPROCAL_REQUIRED == 'true') ?> {
    var links_reciprocal_url = document.links.links_reciprocal_url.value;
  }

  if (links_title == "" || links_title.length < <?php echo ENTRY_LINKS_TITLE_MIN_LENGTH; ?>) {
    error_message = error_message + "* " + "<?php echo ENTRY_LINKS_TITLE_ERROR; ?>" + "\n";
    error = 1;
  }

  if (links_url == "" || links_url.length < <?php echo ENTRY_LINKS_URL_MIN_LENGTH; ?>) {
    error_message = error_message + "* " + "<?php echo ENTRY_LINKS_URL_ERROR; ?>" + "\n";
    error = 1;
  }

  if (links_category == "" || links_category.length < 1) {
    error_message = error_message + "* " + "<?php echo ENTRY_LINKS_CATEGORY_ERROR; ?>" + "\n";
    error = 1;
  }

  if (links_description == "" || links_description.length < <?php echo ENTRY_LINKS_DESCRIPTION_MIN_LENGTH; ?>) {
    error_message = error_message + "* " + "<?php echo ENTRY_LINKS_DESCRIPTION_ERROR; ?>" + "\n";
    error = 1;
  }

  if (links_description == "" || links_description.length > <?php echo ENTRY_LINKS_DESCRIPTION_MAX_LENGTH; ?>) {
    error_message = error_message + "* " + "<?php echo ENTRY_LINKS_MAX_DESCRIPTION_ERROR; ?>" + "\n";
    error = 1;
  }

  if (links_contact_name == "" || links_contact_name.length < <?php echo ENTRY_LINKS_CONTACT_NAME_MIN_LENGTH; ?>) {
    error_message = error_message + "* " + "<?php echo ENTRY_LINKS_CONTACT_NAME_ERROR; ?>" + "\n";
    error = 1;
  }

  if (links_contact_email == "" || links_contact_email.length < <?php echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_EMAIL_ADDRESS; ?>";
    error = 1;
  }

 <?php if (LINKS_RECIPROCAL_REQUIRED == 'true') ?>
  var local_disable =  document.links.links_reciprocal_disable.value;

  if (local_disable == 0 && ( links_reciprocal_url == "" || links_reciprocal_url.length < <?php echo ENTRY_LINKS_URL_MIN_LENGTH; ?>)) {
    error_message = error_message + "* " + "<?php echo ENTRY_LINKS_RECIPROCAL_URL_ERROR; ?>" + "\n";
    error = 1;
  }

  if (error == 1) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}
//--></script>

<script language="javascript"><!--
function EnableDisableControls()
{
  if (document.links.links_reciprocal_disable.checked == true)
  {
    document.links.links_reciprocal_url.disabled = 'disabled';
  }
  else
  {
    document.links.links_reciprocal_url.disabled = '';
  }
}
//--></script>
<?php
  }
?>
<link rel="stylesheet" type="text/css" href="includes/linksmanager_stylesheet.css">
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if ($action == 'edit' || $action == 'update' || $action == 'new' || $action == 'insert') {
    if ($action == 'edit' || $action == 'update') {
      $form_action = 'update';
      $contact_name_default = '';
      $contact_email_default = '';
    } else {
      $form_action = 'insert';
      $contact_name_default = STORE_OWNER;
      $contact_email_default = STORE_OWNER_EMAIL_ADDRESS;
    }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="linksHead"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr><?php echo tep_draw_form('links', FILENAME_LINKS, tep_get_all_get_params(array('action')) . 'action=' . $form_action, 'post', 'enctype="multipart/form-data" onSubmit="return check_form();"'); ?>
        <td class="formAreaTitle"><?php echo CATEGORY_WEBSITE; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo ENTRY_LINKS_TITLE; ?></td>
            <td class="smallText">
<?php
  if ($error == true) {
    if ($entry_links_title_error == true) {
      echo tep_draw_input_field('links_title', $lInfo->links_title, 'maxlength="64" size="44"') . '&nbsp;' . '<font color="red">' . ENTRY_LINKS_TITLE_ERROR . '</font>';
    } else {
      echo $lInfo->links_title . tep_draw_hidden_field('links_title');
    }
  } else {
    echo tep_draw_input_field('links_title', $lInfo->links_title, 'maxlength="64" size="44"', true);
  }
?></td>
          </tr>
          <tr>
            <td class="smallText"><?php echo ENTRY_LINKS_URL; ?></td>
            <td class="smallText">
<?php
  if ($error == true) {
    if ($entry_links_url_error == true) {
      echo tep_draw_input_field('links_url', $lInfo->links_url, 'maxlength="255" size="44"') . '&nbsp;' . '<font color="red">' . ENTRY_LINKS_URL_ERROR .'</font.>';
    } else {
      echo $lInfo->links_url . tep_draw_hidden_field('links_url');
    }
  } else {
    echo tep_draw_input_field('links_url', tep_not_null($lInfo->links_url) ? $lInfo->links_url : 'http://', 'maxlength="255" size="44"', true);
  }
?></td>
          </tr>
          <tr>
            <td class="smallText"><?php echo ENTRY_LINKS_CATEGORY; ?></td>
            <td class="smallText">

<?php
  $categories_array = tep_get_link_category_tree();
  $categories_array_new = $categories_array;

  if ($error == true) {
    echo $lInfo->links_category . tep_draw_hidden_field('links_category') . '&nbsp;' . '<font color="red">' . ENTRY_LINKS_CATEGORY_ERROR . '</font>';
  } else {
    echo tep_draw_pull_down_menu('links_category', $categories_array, $lInfo->links_category, '', true);
  }

  if (tep_not_null($lInfo->links_category_suggest))
  echo '&nbsp;&nbsp;&nbsp;&nbsp;<span class="smallText">' . sprintf(ENTRY_LINKS_CATEGORY_SUGGEST, $lInfo->links_category_suggest);
?>

         <tr>
          <td class="smallText"><?php echo ENTRY_LINKS_CATEGORY_NEW; ?>
          <td class="smallText"><?php echo tep_draw_input_field('links_category_new', '', 'maxlength="64"') . '&nbsp;&nbsp;&nbsp;&nbsp;' . tep_draw_pull_down_menu('links_category_new_parent', $categories_array_new, $lInfo->links_category) . '&nbsp;&nbsp;&nbsp;&nbsp;' . TEXT_CATEGORY_OVERRIDE; ?> </td>
         </tr>


          </tr>
          <tr>
            <td class="smallText"><?php echo ENTRY_LINKS_DESCRIPTION; ?></td>
            <td class="smallText">
<?php
  if ($error == true) {
    if ($entry_links_description_error == true) {
      echo tep_draw_textarea_field('links_description', 'hard', 40, 5, $lInfo->links_description) . '&nbsp;' . '<font color="red">' . ENTRY_LINKS_DESCRIPTION_ERROR . '</font>';
    } else {
      echo $lInfo->links_description . tep_draw_hidden_field('links_description');
    }
  } else {
    echo tep_draw_textarea_field('links_description', 'hard', 40, 5, $lInfo->links_description) . TEXT_FIELD_REQUIRED;
  }
?></td>
          </tr>
          <tr>
            <td class="smallText"><?php echo ENTRY_LINKS_IMAGE; ?></td>
            <td class="smallText">
           <?php
             if ($error == true) {
               echo $lInfo->links_image_url . tep_draw_hidden_field('links_image_url');
             } else {
               echo tep_draw_file_field('links_image_url') . (tep_not_null($lInfo->links_image_url) ? '&nbsp;&nbsp;' . $lInfo->links_image_url : '');
             }
           ?>
           </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="formAreaTitle"><?php echo CATEGORY_CONTACT; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo ENTRY_LINKS_CONTACT_NAME; ?></td>
            <td class="smallText">
<?php
    if ($error == true) {
      if ($entry_links_contact_name_error == true) {
        echo tep_draw_input_field('links_contact_name', $lInfo->links_contact_name, 'maxlength="64" size="44"', true) . '&nbsp;' . '<font color="red">' . ENTRY_LINKS_CONTACT_NAME_ERROR . '</font?';
      } else {
        echo $lInfo->links_contact_name . tep_draw_hidden_field('links_contact_name');
      }
    } else {
      echo tep_draw_input_field('links_contact_name', tep_not_null($lInfo->links_contact_name) ? $lInfo->links_contact_name : $contact_name_default, 'maxlength="64" size="44"', true);
    }
?></td>
          </tr>
          <tr>
            <td class="smallText"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
            <td class="smallText">
<?php
  if ($error == true) {
    if ($entry_links_contact_email_error == true) {
      echo tep_draw_input_field('links_contact_email', $lInfo->links_contact_email, 'maxlength="96"') . '&nbsp;' . '<font color="red">' . ENTRY_EMAIL_ADDRESS_ERROR .'</font>';
    } elseif ($entry_links_contact_email_check_error == true) {
      echo tep_draw_input_field('links_contact_email', $lInfo->links_contact_email, 'maxlength="96"') . '&nbsp;' . '<font color="red">' . ENTRY_EMAIL_ADDRESS_CHECK_ERROR . '</font>';
    } else {
      echo $lInfo->links_contact_email . tep_draw_hidden_field('links_contact_email');
    }
  } else {
    echo tep_draw_input_field('links_contact_email', tep_not_null($lInfo->links_contact_email) ? $lInfo->links_contact_email : $contact_email_default, 'maxlength="96" size="44"', true);
  }
?></td>
          </tr>
        </table></td>
      </tr>

<?php if (LINKS_RECIPROCAL_REQUIRED == 'true') { ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="formAreaTitle"><?php echo CATEGORY_RECIPROCAL; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo ENTRY_LINKS_RECIPROCAL_URL; ?></td>
            <td class="smallText">
            <?php
              if ($error == true) {
                if ($entry_links_reciprocal_url_error == true) {
                  echo tep_draw_input_field('links_reciprocal_url', $lInfo->links_reciprocal_url, 'maxlength="255" size="30"') . '&nbsp;' . '<font color="red">' . ENTRY_LINKS_RECIPROCAL_URL_ERROR . '</font>';
                } else {
                  echo $lInfo->links_reciprocal_url . tep_draw_hidden_field('links_reciprocal_url');
                }
              } else {
                if ($action == 'new')
                  echo tep_draw_input_field('links_reciprocal_url', tep_not_null($lInfo->links_reciprocal_url) ? $lInfo->links_reciprocal_url : 'http://', 'maxlength="255" size="30"', true);
                else
                  echo tep_draw_input_field('links_reciprocal_url', (tep_not_null($lInfo->links_reciprocal_url) && ! $lInfo->links_reciprocal_disable) ? $lInfo->links_reciprocal_url : '', 'maxlength="255" size="30"'. ($lInfo->links_reciprocal_disable ? 'disabled' : ''), ($lInfo->links_reciprocal_disable ? false : true));
              }
            ?>
            </td>

           <?php  if ($action == 'edit') {
           if (! $lInfo->links_reciprocal_disable) {
              $imgReciprocal = ((CheckURL($lInfo->links_reciprocal_url, $lInfo->links_id) == TEXT_INFO_LINK_CHECK_FOUND) ? 'images/mark_check.jpg' : 'images/mark_x.jpg');
              $imgDomain = (LINKS_RECIPROCAL_DOMAIN_CHECK == 'true' ? ((DomainMismatch($lInfo) == TEXT_DOMAIN_MATCH_NO ) ? 'images/mark_check.jpg' : 'images/mark_x.jpg') : 'images/mark_missing.jpg');
              $imgParent = (LINKS_RECIPROCAL_PARENT_CHECK == 'true' ? ((NoParentLink($lInfo) == TEXT_DOMAIN_MATCH_NO ) ? 'images/mark_check.jpg' : 'images/mark_x.jpg') : 'images/mark_missing.jpg');
           ?>
           <td width="50" align="right" class="smallText"><?php echo TEXT_INFO_LINK_CHECK_FOUND; ?></td>
           <td class="smallText"><img src="<?php echo $imgReciprocal; ?>" alt="" width="12" height="12"></td>

           <td width="110" align="right" class="smallText"><?php echo TEXT_DOMAIN_MATCH; ?></td>
           <td class="smallText"><img src="<?php echo $imgDomain; ?>" alt="" width="12" height="12"></td>
           <td width="110" align="right" class="smallText"><?php echo TEXT_PARENT_MATCH; ?></td>
           <td class="smallText"><img src="<?php echo $imgParent; ?>" alt="" width="12" height="12"></td>
           <td width="120" class="smallText" align="right"><a href="<?php echo $lInfo->links_reciprocal_url ?>" target="blank"><?php echo TEXT_INFO_LINK_VISIT_RECIPROCAL; ?></a></td>
           <?php }} ?>
          </tr>
          <tr>
            <td class="smallText"><?php echo ENTRY_LINKS_RECIPROCAL_DISABLE; ?></td>
            <td><input type="checkbox" name="links_reciprocal_disable" <?php echo ($lInfo->links_reciprocal_disable ? 'checked' : ''); ?> onClick="return EnableDisableControls()" ></td>
          </tr>
        </table></td>
      </tr>
<?php } ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="formAreaTitle"><?php echo CATEGORY_OPTIONS; ?></td>
      </tr>
      <tr>
        <td class="formArea"><table border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo ENTRY_LINKS_STATUS; ?></td>
            <td class="smallText">
<?php
  $link_statuses = array();
  $links_status_array = array();
  $links_status_query = tep_db_query("select links_status_id, links_status_name from " . TABLE_LINKS_STATUS . " where language_id = '" . (int)$languages_id . "'");
  while ($links_status = tep_db_fetch_array($links_status_query)) {
    $link_statuses[] = array('id' => $links_status['links_status_id'],
                               'text' => $links_status['links_status_name']);
    $links_status_array[$links_status['links_status_id']] = $links_status['links_status_name'];
  }

  echo tep_draw_pull_down_menu('links_status', $link_statuses, $lInfo->links_status);

  if ($action == 'edit' || $action == 'update' || $action == 'new') {
    echo '&nbsp;&nbsp;' . ENTRY_LINKS_NOTIFY_CONTACT;
    echo tep_draw_checkbox_field('links_notify', '',($action == 'new' ? '0' : '1'));
  }
  if ($action == 'edit' || $action == 'update') {
    echo '&nbsp;&nbsp;&nbsp;&nbsp;Reason:';
    echo '&nbsp;&nbsp;' . ENTRY_LINKS_NOTIFY_CONTACT_BAD_LINK;
    echo tep_draw_radio_field('links_notify_denied_reason', '0');
    echo '&nbsp;&nbsp;' . ENTRY_LINKS_NOTIFY_CONTACT_CONTENT;
    echo tep_draw_radio_field('links_notify_denied_reason', '1');
    echo '&nbsp;&nbsp;' . ENTRY_LINKS_NOTIFY_DOMAIN_MISMATCH;
    echo tep_draw_radio_field('links_notify_denied_reason', '2');
    echo '&nbsp;&nbsp;' . ENTRY_LINKS_NOTIFY_PARENT_MISMATCH;
    echo tep_draw_radio_field('links_notify_denied_reason', '3');
    echo '&nbsp;&nbsp;' . ENTRY_LINKS_NOTIFY_CONTACT_NONE;
    echo tep_draw_radio_field('links_notify_denied_reason', '4', 'checked');
  }
?></td>
          </tr>
          <tr>
          <td class="smallText"><?php echo 'Language'; ?></td>
            <td class="smallText"><?php echo tep_draw_pull_down_menu('links_language', GetLinksLanguagesArray(), $lInfo->language_id);?></tr>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td align="right" class="smallText"><?php echo (($action == 'edit') ? tep_image_submit('button_update.png', IMAGE_UPDATE) : tep_image_submit('button_insert.png', IMAGE_INSERT)) . ' <a href="' . tep_href_link(FILENAME_LINKS, tep_get_all_get_params(array('action'))) .'">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>'; ?></td>
      </tr></form>
<?php
  } else if (tep_not_null($action_checkAllLinks)) {
    set_time_limit(0);
?>
    <tr>
     <td class="pageHeading"><?php echo HEADING_CHECKED_LINKS; ?></td>
    </tr>
    <tr><td width="70%"><table border="0" width="70%" class="bordered" cellpadding="0">
     <tr>
      <td><table border="1" cellpadding="0">
       <tr class="smallText" bgcolor="#c9c9c9">
        <th><?php echo TEXT_INFO_LINK_CHECK_FOUND; ?></th><th><?php echo TABLE_HEADING_TITLE; ?></th><th><?php echo TABLE_HEADING_URL; ?></th>
       </tr>
    <?php
    $links_query = tep_db_query("select l.links_id, ld.links_title, l.links_reciprocal_url from " . TABLE_LINKS . " l left join " . TABLE_LINKS_DESCRIPTION . " ld on ld.links_id = l.links_id where l.links_reciprocal_disable = 0");

    $ctr = 1;
    $from = $_POST['links_start'];
    $max = (int)$_POST['num_links_to_check'] + $from;
    if ($max > tep_db_num_rows($links_query))
      $max = tep_db_num_rows($links_query);

    while ($links = tep_db_fetch_array($links_query))
    {
      if ($ctr < $from)
      {
        $ctr++;
        continue;
      }

      $link_check_status_text = CheckUrl($links['links_reciprocal_url'], $links['links_id']);
      $img = ($link_check_status_text == TEXT_INFO_LINK_CHECK_FOUND) ? 'images/mark_check.jpg' : 'images/mark_x.jpg';

      echo '<tr><td class="smallText" width="5%" align="center"><img src="'.$img.'" width="12" height="12" alt="'.$link_check_status_text.'"></td><td class="smallText">  ' .$links['links_title'] . '</td><td class="smallText"><a href="' .$links['links_reciprocal_url'] . '" target="_blank">' . $links['links_reciprocal_url'] . '</a></td></tr>';

      $ctr++;
      if ($ctr > $max)
       break;
    }
    echo '</table></td></tr>';
    ?>
    <tr>
     <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
    </tr>
    <tr>
     <td colspan="3" align="center" class="smallText"><?php echo ' <a href="' . tep_href_link(FILENAME_LINKS, tep_get_all_get_params(array('action'))) .'">' . tep_image_button('button_continue.png', 'Continue') . '</a>'; ?></td>
    </tr>
   </table></td></tr>
   <?php
 } else {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=66', 'NONSSL') . '">' . tep_image_button('button_configuration.png', IMAGE_CONFIGURATION) . '</a>'; ?>&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_MANUAL_CAT_MODULES_LINKS) . '">' . tep_image_button('button_help.png', IMAGE_HELP) . '</a>'; ?></td>
            <?php echo tep_draw_form('search', FILENAME_LINKS, '', 'get') . tep_hide_session_id(); ?>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td class="smallText" align="right"><?php echo tep_draw_pull_down_menu('links_status_list', $linkShow, '',  'onChange="this.form.submit();"');?><br>
            <?php echo HEADING_TITLE_SEARCH . ' ' . tep_draw_input_field('search'); ?></td>
            </form>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
          <?php
// BOC Sort Listing
          if (! tep_not_null($listing))
            $listing = 'title';
          $orderCat = "lcd.link_categories_name";
          $order = "ld.links_title";

          switch ($listing) {
              case "titlecat":
              $orderCat = "lcd.link_categories_name";
              $order = 'l.links_id';
              break;
              case "titlecat-desc":
              $orderCat = "lcd.link_categories_name DESC";
              $order = 'l.links_id DESC';
              break;
              case "title":
              $order = "ld.links_title";
              break;
              case "title-desc":
              $order = "ld.links_title DESC";
              break;
              case "url":
              $order = "l.links_url";
              break;
              case "url-desc":
              $order = "l.links_url DESC";
              break;
              case "clicks":
              $order = "l.links_clicked";
              break;
              case "clicks-desc":
              $order = "l.links_clicked DESC";
              break;
              case "dateadded":
              $order = "l.links_date_added";
              break;
              case "dateadded-desc":
              $order = "l.links_date_added DESC";
              break;
              case "status":
              $order = "l.links_status";
              break;
              case "status-desc":
              $order = "l.links_status DESC";
              break;
              default:
              $order = "l.links_id DESC";
          }

?>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_TITLE_CATEGORY; ?>&nbsp;<a href="<?php echo "$PHP_SELF?listing=titlecat"; ?>"><?php echo tep_image_button('button_icon_up.png', ' Sort ' . TABLE_HEADING_TITLE_CATEGORY . ' --> 1-2-3 From Top '); ?></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=titlecat-desc"; ?>"><?php echo tep_image_button('button_icon_down.png', ' Sort ' . TABLE_HEADING_TITLE_CATEGORY . ' --> 3-2-1 From Top '); ?></a></td>
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_TITLE; ?>&nbsp;<a href="<?php echo "$PHP_SELF?listing=title"; ?>"><?php echo tep_image_button('button_icon_up.png', ' Sort ' . TABLE_HEADING_TITLE . ' --> 1-2-3 From Top '); ?></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=title-desc"; ?>"><?php echo tep_image_button('button_icon_down.png', ' Sort ' . TABLE_HEADING_TITLE . ' --> 3-2-1 From Top '); ?></a></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_URL; ?>&nbsp;<a href="<?php echo "$PHP_SELF?listing=url"; ?>"><?php echo tep_image_button('button_icon_up.png', ' Sort ' . TABLE_HEADING_URL . ' --> 1-2-3 From Top '); ?></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=url-desc"; ?>"><?php echo tep_image_button('button_icon_down.png', ' Sort ' . TABLE_HEADING_URL . ' --> 3-2-1 From Top '); ?></a></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_CLICKS; ?>&nbsp;<a href="<?php echo "$PHP_SELF?listing=clicks"; ?>"><?php echo tep_image_button('button_icon_up.png', ' Sort ' . TABLE_HEADING_CLICKS . ' --> 1-2-3 From Top '); ?></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=clicks-desc"; ?>"><?php echo tep_image_button('button_icon_down.png', ' Sort ' . TABLE_HEADING_CLICKS . ' --> 3-2-1 From Top '); ?></a></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_DATE_ADDED; ?>&nbsp;<a href="<?php echo "$PHP_SELF?listing=dateadded"; ?>"><?php echo tep_image_button('button_icon_up.png', ' Sort ' . TABLE_HEADING_DATE_ADDED . ' --> 1-2-3 From Top '); ?></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=dateadded-desc"; ?>"><?php echo tep_image_button('button_icon_down.png', ' Sort ' . TABLE_HEADING_DATE_ADDED . ' --> 3-2-1 From Top '); ?></a></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_STATUS; ?>&nbsp;<a href="<?php echo "$PHP_SELF?listing=status"; ?>"><?php echo tep_image_button('button_icon_up.png', ' Sort ' . TABLE_HEADING_STATUS . ' --> 1-2-3 From Top '); ?></a>&nbsp;<a href="<?php echo "$PHP_SELF?listing=status-desc"; ?>"><?php echo tep_image_button('button_icon_down.png', ' Sort ' . TABLE_HEADING_STATUS . ' --> 3-2-1 From Top '); ?></a></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
   //EOC: Sort Listing
    if (isset($_GET['search']) && tep_not_null($_GET['search'])) {
      $keywords = tep_db_input(tep_db_prepare_input($_GET['search']));
      $notAll = ($showLinkStatus == TEXT_SELECT_ALL) ? '' : " l.links_status = '" . $showLinkStatus . "' and ";
      $where = " where " . $notAll . " ( ld.links_title like '%" . $keywords . "%' or  l.links_contact_email like '%" . $keywords . "%' or l.links_url like '%" . $keywords . "%' )" ;
    }
    else if ($showLinkStatus == TEXT_SELECT_ALL)
      $where = " where ld.links_title like '%" . $keywords . "%' or  l.links_url like '%" . $keywords . "%'" ;
    else
      $where = " where l.links_status = '" . $showLinkStatus . "'" . $search;

    $links_query_raw = "select l.links_id, l.links_url, l.links_image_url, l.links_date_added, l.links_last_modified, l.links_status, l.links_clicked, ld.links_title, ld.links_description, l.links_contact_name, l.links_contact_email, l.links_reciprocal_url, l.links_reciprocal_disable, l.links_status from " . TABLE_LINKS . " l left join " . TABLE_LINKS_DESCRIPTION . " ld on l.links_id = ld.links_id " . $where . " order by " . $order;
    $links_split = new splitPageResults($_GET['page'], MAX_LINKS_DISPLAY, $links_query_raw, $links_query_numrows);

    $links_query = tep_db_query($links_query_raw);
    while ($links = tep_db_fetch_array($links_query)) {
      if ((!isset($_GET['lID']) || (isset($_GET['lID']) && ($_GET['lID'] == $links['links_id']))) && !isset($lInfo)) {
        $categories_query = tep_db_query("select lcd.link_categories_name as links_category from " . TABLE_LINKS_TO_LINK_CATEGORIES . " l2lc left join " . TABLE_LINK_CATEGORIES_DESCRIPTION . " lcd on lcd.link_categories_id = l2lc.link_categories_id where l2lc.links_id = '" . (int)$links['links_id'] . "' and lcd.language_id = '" . (int)$languages_id . "' order by " . $orderCat);
        $category = tep_db_fetch_array($categories_query);

        $lInfo_array = array_merge($links, (array)$category);
        $lInfo = new objectInfo($lInfo_array);
      }

      if (isset($lInfo) && is_object($lInfo) && ($links['links_id'] == $lInfo->links_id)) {
        echo '          <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_LINKS, tep_get_all_get_params(array('lID', 'action')) . 'lID=' . $lInfo->links_id . '&action=edit') . '\'">' . "\n";
      } else {
        echo '          <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_LINKS, tep_get_all_get_params(array('lID')) . 'lID=' . $links['links_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo '<a href="' .  tep_href_link(FILENAME_LINK_CATEGORIES, 'cPath=' . tep_get_category_id(tep_get_link_category_name_from_linksid($links['links_id'], $languages_id))) . '">' .   tep_get_link_category_name_from_linksid($links['links_id'], $languages_id) . '</a>'; ?></td>
                <td class="dataTableContent"><?php echo $links['links_title']; ?></td>
                <td class="dataTableContent"><?php echo $links['links_url']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $links['links_clicked']; ?></td>
                <td class="dataTableContent" align="center"><?php echo tep_date_short($links['links_date_added']); ?></td>
                <td class="dataTableContent" align="center"><?php echo $links_status_array[$links['links_status']]; ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($lInfo) && is_object($lInfo) && ($links['links_id'] == $lInfo->links_id)) { echo tep_image(DIR_WS_IMAGES . 'icons/info_icons/icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_LINKS, tep_get_all_get_params(array('lID')) . 'lID=' . $links['links_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icons/info_icons/icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $links_split->display_count($links_query_numrows, MAX_LINKS_DISPLAY, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_LINKS); ?></td>
                    <td class="smallText" align="right"><?php echo $links_split->display_links($links_query_numrows, MAX_LINKS_DISPLAY, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'info', 'x', 'y', 'lID'))); ?></td>
                  </tr>
                  <tr>
<?php
    if (isset($_GET['search']) && tep_not_null($_GET['search'])) {
?>
                    <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_LINKS) . '">' . tep_image_button('button_reset.png', IMAGE_RESET) . '</a>'; ?></td>
                    <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_LINKS, 'page=' . $_GET['page'] . '&action=new') . '">' . tep_image_button('button_new_link.png', IMAGE_NEW_LINK) . '</a>'; ?></td>
                  </tr>
<?php
    } else {
?>
                   <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                  </tr>
                  <tr>
                   <?php echo tep_draw_form('check_all', FILENAME_LINKS, 'post'); ?>
                   <td align="right"><?php echo (tep_image_submit('button_check_links.png', IMAGE_CHECK_LINKS) ); ?></td>
		               <td class="smallText" align="center">Start at:&nbsp;<?php echo tep_draw_input_field('links_start', '1', 'maxlength="255", size="4"',   false); ?> </td>
                   <td class="smallText" align="center">How many?&nbsp;<?php echo tep_draw_input_field('num_links_to_check', '100', 'maxlength="255", size="4"',   false); ?> </td>
                   </form>
                  </tr>
                  <tr>
                   <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                  </tr>
                  <tr>
                   <td align="right" colspan="4"><?php echo '<a href="' . tep_href_link(FILENAME_LINKS, 'page=' . $_GET['page'] . '&action=new') . '">' . tep_image_button('button_new_link.png', IMAGE_NEW_LINK) . '</a>'; ?></td>
<?php
    }
?>
                  </tr>
                </table></td>
              </tr>

              <!-- BEGIN DUPLICATE COUNT CHECK -->
              <?php
              $dupcheck_query = tep_db_query("SELECT DISTINCT(l.links_contact_email) AS user, COUNT(l.links_contact_email) AS userCount, l.links_url, l.links_contact_name, ld.links_title FROM " . TABLE_LINKS . " l inner join " . TABLE_LINKS_DESCRIPTION . " ld on l.links_id = ld.links_id GROUP BY l.links_contact_email HAVING userCount > 1");
              if (tep_db_num_rows($dupcheck_query) > 0) {
               echo tep_draw_form('search', FILENAME_LINKS, '', 'get') . tep_hide_session_id();
              ?>
              <tr>
               <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
              </tr>
              <tr>
               <td colspan="6" width="100%"><table border="0" cellpadding="0" style="border: 3px ridge; width: 100%">
                <tr style="background: #c9c9c9">
                 <th class="smallText"><?php echo TABLE_HEADING_DUPLICATES; ?></th>
                </tr>
                <?php
                 while ($dupcheck = tep_db_fetch_array($dupcheck_query)) {
                   echo '<tr><td class="smallText">';
                   echo '<a href="' . tep_href_link(FILENAME_LINKS, 'search='.$dupcheck['user']) . '">';
                   echo sprintf(TEXT_DUP_LINK, $dupcheck['links_title'], $dupcheck['links_contact_name'], $dupcheck['userCount']);
                   echo '</a></td></tr>';
                 }
                 ?>
               </table></td>
              </tr>
              <tr>
               <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
              </tr>
              </form>
              <?php } ?>
              <!-- END DUPLICATE COUNT CHECK -->

            </table></td>
<?php
  $heading = array();
  $contents = array();
   switch ($action) {
    case 'confirm':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_LINK . '</b>');

      $contents = array('form' => tep_draw_form('links', FILENAME_LINKS, tep_get_all_get_params(array('lID', 'action')) . 'lID=' . $lInfo->links_id . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_DELETE_INTRO . '<br><br><b>' . $lInfo->links_url . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.png', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_LINKS, tep_get_all_get_params(array('lID', 'action')) . 'lID=' . $lInfo->links_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
      break;
    case 'check':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_CHECK_LINK . '</b>');
      if ($lInfo->links_reciprocal_disable) {
        $contents[] = array('text' => TEXT_INFO_LINK_CHECK_RESULT . ' ' . TEXT_INFO_LINK_RECIPROCAL_DISABLED);
      } else {
        $link_check_status_text = TEXT_INFO_LINK_CHECK_NOT_FOUND;
        $siteFound = GetHeaderStatus($lInfo->links_url);
        if ($siteFound != TEXT_INFO_LINK_LOCATED_NO) {   //the main site was found
            $link_check_status_text = CheckUrl($lInfo->links_reciprocal_url, $lInfo->links_id);
        }

        $contents[] = array('text' => TEXT_INFO_LINK_CHECK_RESULT . ' ' . $link_check_status_text);
        $contents[] = array('text' => '<br><b>' . $lInfo->links_reciprocal_url . '</b>');
      }
      $contents[] = array('align' => 'center', 'text' => '<br><a href="' . tep_href_link(FILENAME_LINKS, tep_get_all_get_params(array('lID', 'action')) . 'lID=' . $lInfo->links_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (isset($lInfo) && is_object($lInfo)) {
        $heading[] = array('text' => '<b>' . $lInfo->links_title . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_LINKS, tep_get_all_get_params(array('lID', 'action')) . 'lID=' . $lInfo->links_id . '&action=edit') . '">' . tep_image_button('button_edit.png', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_LINKS, tep_get_all_get_params(array('lID', 'action')) . 'lID=' . $lInfo->links_id . '&action=confirm') . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a> <a href="' . tep_href_link(FILENAME_LINKS, tep_get_all_get_params(array('lID', 'action')) . 'lID=' . $lInfo->links_id . '&action=check') . '">' . tep_image_button('button_check_link.png', IMAGE_CHECK_LINK) . '</a> <a href="' . tep_href_link(FILENAME_LINKS_CONTACT, 'link_partner=' . $lInfo->links_contact_email) . '">' . tep_image_button('button_email.png', IMAGE_EMAIL) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_INFO_LINK_CATEGORY . ' '  . $lInfo->links_category);
        $contents[] = array('text' => '<br>' . tep_link_info_image($lInfo->links_image_url, $lInfo->links_title, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT) . '<br>' . $lInfo->links_title);
        $contents[] = array('text' => '<br>' . TEXT_INFO_LINK_CONTACT_NAME . ' '  . $lInfo->links_contact_name);
        $contents[] = array('text' => '<br>' . TEXT_INFO_LINK_CONTACT_EMAIL . ' ' . $lInfo->links_contact_email);
        $contents[] = array('text' => '<br>' . TEXT_INFO_LINK_STATUS . ' '  . $links_status_array[$lInfo->links_status]);

        /*************** PRESETS ***************/
        $disableLink = ($lInfo->links_status != 3) ? '<a href="' . tep_href_link(FILENAME_LINKS, tep_get_all_get_params(array('lID', 'action')) . 'lID=' . $lInfo->links_id . '&action=disablelink') . '">' .tep_image_button('button_small_disable.png', IMAGE_DISABLE) . '</a>' : '';
        $linkFound  = TEXT_INFO_LINK_LOCATED_NO;
        $siteFound = TEXT_INFO_LINK_LOCATED_NO;


        /************** BEGIN SEE IF THE MAIN SITE EXISTS ************/
        $siteFound = GetHeaderStatus($lInfo->links_url);
        /************** END SEE IF THE MAIN SITE EXISTS ************/


        /************** BEGIN CHECK IF SUB LINKS EXIST ************/
        if ($siteFound != TEXT_INFO_LINK_LOCATED_NO) {   //the main site was found
            if (CheckURL($lInfo->links_reciprocal_url, $lInfo->links_id) == TEXT_INFO_LINK_CHECK_FOUND) {
                $linkFound = TEXT_INFO_LINK_LOCATED_YES;
                $disableLink = '';
            } else {
                $mainDomain = GetDomainName($lInfo->links_url);
                if (! checkdnsrr($mainDomain, "ANY")) {
                    $disableLink = ($lInfo->links_status != 3) ? '<a href="' . tep_href_link(FILENAME_LINKS, tep_get_all_get_params(array('lID', 'action')) . 'lID=' . $lInfo->links_id . '&action=disablelink') . '">' .tep_image_button('button_link_disable.png', IMAGE_DISABLE) . '</a>' : '';
                }
                $linkFound = TEXT_INFO_LINK_LOCATED_NO;
            }
        }
        /************** END CHECK IF SUB LINKS EXIST ************/

        $contents[] = array('text' => '<br>' . TEXT_INFO_SITE_LOCATED . ' '  . $siteFound);
        $contents[] = array('text' => '<br>' . TEXT_INFO_LINK_LOCATED . ' '  . $linkFound . ' ' . $disableLink);
        $contents[] = array('text' => '<br>' . TEXT_DOMAIN_MISMATCH . ' '  . ( LINKS_RECIPROCAL_DOMAIN_CHECK == 'true' ? DomainMismatch($lInfo) : TEXT_DOMAIN_MISMATCH_DISABLED)) ;
        $contents[] = array('text' => '<br>' . TEXT_PARENT_MISMATCH . ' '  . ( LINKS_RECIPROCAL_PARENT_CHECK == 'true' ? NoParentLink($lInfo) : TEXT_DOMAIN_MISMATCH_DISABLED)) ;

        $contents[] = array('text' => '<br>' . TEXT_INFO_LINK_CLICK_COUNT . ' ' . $lInfo->links_clicked);
        $contents[] = array('text' => '<br>' . TEXT_INFO_LINK_DESCRIPTION . ' ' . $lInfo->links_description);
        $contents[] = array('text' => '<br>' . TEXT_DATE_LINK_CREATED . ' ' . tep_date_short($lInfo->links_date_added));

        if (tep_not_null($lInfo->links_last_modified)) {
          $contents[] = array('text' => '<br>' . TEXT_DATE_LINK_LAST_MODIFIED . ' ' . tep_date_short($lInfo->links_last_modified));
        }
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
