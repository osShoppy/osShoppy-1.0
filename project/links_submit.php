<?php //$Id: /catalog/links_submit.php (5272)

  require('includes/application_top.php');

// needs to be included earlier to set the success message in the messageStack
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LINKS_SUBMIT);
  require(DIR_WS_FUNCTIONS . 'links.php');

  $process = false;
  $editmode = false;

  if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
      $process = true;
      $editmode = $_POST['editmode'];
      $links_image = '';

      $links_title = tep_db_prepare_input($_POST['links_title']);
      $links_url = tep_sanitize_url_string(tep_db_prepare_input($_POST['links_url']));
      $link_categories_id = tep_db_prepare_input($_POST['links_category']);
      $links_category_suggest = tep_db_prepare_input($_POST['links_cat_suggest']);
      $links_description = tep_db_prepare_input($_POST['links_description']);
      $links_contact_name = tep_db_prepare_input($_POST['links_contact_name']);
      $links_contact_email = tep_db_prepare_input($_POST['links_contact_email']);
      if (LINKS_RECIPROCAL_REQUIRED == 'true') $links_reciprocal_url = tep_sanitize_url_string(tep_db_prepare_input($_POST['links_reciprocal_url']));
      $links_username = tep_db_prepare_input($_POST['links_username']);
      $links_password = tep_db_prepare_input($_POST['links_password']);

      $error = false;

      if (isset($_FILES['link_image_upload']) && tep_not_null($_FILES['link_image_upload']['tmp_name'])) {
          $validImgTypes = array('image/gif', 'image/jpg', 'image/jpeg', 'image/png');

          if (! in_array($_FILES['link_image_upload']['type'], $validImgTypes)) {
              $error = true;
              $messageStack->add('submit_link', ERROR_FAILED_IMAGE_TYPE . ': ' . $_FILES['link_image_upload']['type']);
          } else {
              if (!is_dir(DIR_WS_IMAGES . 'uploads_links_manager')) {
                  mkdir(DIR_WS_IMAGES . 'uploads_links_manager');
              }

              //Sanitize the filename (See note below)
              $remove_these = array(' ','`','"','\'','\\','/');
              $links_image = str_replace($remove_these,'',$_FILES['link_image_upload']['name']);
              $links_image = time().'-'.$links_image;       //Make the filename unique
              $imageDir = DIR_WS_IMAGES . 'uploads_links_manager/' . $links_image;     //Save the uploaded the file to another location
              $imgTmpName = str_replace("'", '', $_FILES['link_image_upload']['tmp_name']);

              if(! move_uploaded_file($imgTmpName, $imageDir)) {
                  $error = true;
                  $messageStack->add('submit_link', ERROR_FAILED_IMAGE_UPLOAD);
              }
          }
      }

      if (strlen($links_title) < ENTRY_LINKS_TITLE_MIN_LENGTH) {
          $error = true;
          $messageStack->add('submit_link', ENTRY_LINKS_TITLE_ERROR);
      }

      if (strlen($links_url) < ENTRY_LINKS_URL_MIN_LENGTH) {
          $error = true;
          $messageStack->add('submit_link', ENTRY_LINKS_URL_ERROR);
      } else if (NotValidURL($links_url)) {
          $error = true;
          $messageStack->add('submit_link', sprintf(ENTRY_LINKS_URL_NOT_FOUND_ERROR, $links_url));
      }

      if (strlen($links_description) < ENTRY_LINKS_DESCRIPTION_MIN_LENGTH) {
          $error = true;
          $messageStack->add('submit_link', ENTRY_LINKS_DESCRIPTION_ERROR);
      }

      if (strlen($links_description) > ENTRY_LINKS_DESCRIPTION_MAX_LENGTH) {
          $error = true;
          $messageStack->add('submit_link', ENTRY_LINKS_MAX_DESCRIPTION_ERROR);
      }

      if (strlen($links_contact_name) < ENTRY_LINKS_CONTACT_NAME_MIN_LENGTH) {
          $error = true;
          $messageStack->add('submit_link', ENTRY_LINKS_CONTACT_NAME_ERROR);
      }

      if (strlen($links_contact_email) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
          $error = true;
          $messageStack->add('submit_link', ENTRY_EMAIL_ADDRESS_ERROR);
      } elseif (tep_validate_email($links_contact_email) == false) {
          $error = true;
          $messageStack->add('submit_link', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
      }

      if (LINKS_RECIPROCAL_REQUIRED == 'true') {
          if (strlen($links_reciprocal_url) < ENTRY_LINKS_URL_MIN_LENGTH) {
              $error = true;
              $messageStack->add('submit_link', ENTRY_LINKS_RECIPROCAL_URL_ERROR);
          }
          else if (CheckURL($links_reciprocal_url) == 0) {
              $error = true;
              $messageStack->add('submit_link', sprintf(ENTRY_LINKS_RECIPROCAL_URL_MISSING_ERROR, $links_reciprocal_url));
          }
          else if (LINKS_RECIPROCAL_DOMAIN_CHECK == 'true') {
              if (GetDomainName($links_reciprocal_url) !== GetDomainName($links_url)) {
                  $error = true;
                  $messageStack->add('submit_link', sprintf(ENTRY_LINKS_URL_MISMATCH_MAIN_RECIPROCAL_ERROR, $links_reciprocal_url, $links_url));
              }
          }
          else if (LINKS_RECIPROCAL_PARENT_CHECK == 'true') {
              if (NoParentLink($links_url, $links_reciprocal_url)) {
                  $error = true;
                  $messageStack->add('submit_link', sprintf(ENTRY_LINKS_URL_MISMATCH_MAIN_PARENT_ERROR, $links_reciprocal_url, $links_url));
              }
          }
      } else {
          $links_reciprocal_url = '';
      }

      // CHECK FOR DUPLICAE ENTRIES
      if (LINKS_CHECK_DUPLICATE == 'true' && ! $editmode) {
          if (LINKS_RECIPROCAL_REQUIRED == 'true')
               $condition = "ld.links_title = '" . tep_db_input($links_title) . "' OR l.links_url = '" . tep_db_input($links_url) . "' OR l.links_reciprocal_url = '" . tep_db_input($links_reciprocal_url) . "'";
           else
               $condition = "ld.links_title = '" . tep_db_input($links_title) . "' OR l.links_url = '" . tep_db_input($links_url) . "'";

           $duplink_query = tep_db_query("select l.links_id, l.links_url, l.links_reciprocal_url,  ld.links_id, ld.links_title from " . TABLE_LINKS . " l left join " . TABLE_LINKS_DESCRIPTION . " ld on l.links_id = ld.links_id where ($condition) AND language_id = '" . (int)$languages_id . "'");

           if (tep_db_num_rows($duplink_query) > 0) {
               $error = true;
               $messageStack->add('submit_link', ENTRY_LINKS_DUPLICATE_ERROR);
           }
      }

      //CHECK FOR BLACKLISTED WORDS AS DEFINED IN admin->configuration->Links
      if ( tep_not_null(LINKS_CHECK_BLACKLIST)) {
          $parts = explode(",", trim(LINKS_CHECK_BLACKLIST, ","));

          for ($i = 0; $i < count($parts); ++$i) {
              if ((strpos($links_title, $parts[$i]) !== FALSE) ||
                  (strpos($links_url, $parts[$i]) !== FALSE)   ||
                  (strpos($links_category_suggest, $parts[$i]) !== FALSE) ||
                  (strpos($links_description, $parts[$i]) !== FALSE) ||
                  (strpos($links_image, $parts[$i]) !== FALSE) ||
                  (strpos($links_contact_name, $parts[$i]) !== FALSE) ||
                  (strpos($links_contact_email, $parts[$i]) !== FALSE))
              {
                  $error = true;
                  $messageStack->add('submit_link', ENTRY_LINKS_BLACKLISTED);
              }
          }
      }

      if ($editmode && (! tep_not_null($links_username) || ! tep_not_null($links_password))) {
          $error = true;
          $messageStack->add('submit_link', ERROR_INVALID_LOGIN);
      }

      if ($error == false) {

          // default values
          $links_date_added = 'now()';
          $links_status = '1'; // Pending approval

          $sql_data_array = array('links_url' => $links_url,
                                  'links_image_url' => $links_image,
                                  'links_contact_name' => $links_contact_name,
                                  'links_contact_email' => $links_contact_email,
                                  'links_reciprocal_url' => $links_reciprocal_url,
                                  'links_category_suggest' => $links_category_suggest,
                                  'links_status' => $links_status,
                                  'links_partner_username' => $links_username,
                                  'links_partner_password' => $links_password);

          if ($editmode) {
              $sql_data_array['links_last_modified'] = 'now()';
          } else {
              $sql_data_array['links_date_added'] = $links_date_added;
          }

          tep_db_perform(TABLE_LINKS, $sql_data_array, (($editmode) ? 'update' : 'insert'), (($editmode) ? "links_id = '" . (int)$_POST['edit_links_id'] . "'" : ''));

          $links_id = ((! $editmode) ? tep_db_insert_id() : (int)$_POST['edit_links_id']);

          if ($editmode)
              tep_db_query("update " . TABLE_LINKS_TO_LINK_CATEGORIES . " set link_categories_id = '" . (int)$_POST['edit_link_categories_id'] . "' where links_id = '" . (int)$_POST['edit_links_id'] . "'");
          else
              tep_db_query("insert into " . TABLE_LINKS_TO_LINK_CATEGORIES . " (links_id, link_categories_id) values ('" . (int)$links_id . "', '" . (int)$link_categories_id . "')");

          $sql_data_array = array('links_title' => $links_title,
                                  'links_description' => $links_description,
                                  'language_id' => $languages_id);

          $descriptionText = '';   //only used for editmode and if the description changed
          if ($editmode) {
              $categories_query = tep_db_query("select links_description from " . TABLE_LINKS_DESCRIPTION . " where links_id = '" . (int)$_POST['edit_links_id'] . "' LIMIT 1");
              $categories = tep_db_fetch_array($categories_query);
              if ($categories['links_description'] !== $links_description)
                $descriptionText = "The description for this link was altered." . "\n\n" . "Previous Description: " . $categories['links_description'] . "\n\n" . "New Description: " . $links_description . "\n\n";
              tep_db_perform(TABLE_LINKS_DESCRIPTION, $sql_data_array, 'update', "links_id = '" . (int)$_POST['edit_links_id'] . "'");
          } else {
              $insert_sql_data = array('links_id' => $links_id);
              $sql_data_array = array_merge($sql_data_array, $insert_sql_data);
              tep_db_perform(TABLE_LINKS_DESCRIPTION, $sql_data_array);
          }

          // build the message content
          $name = $links_contact_name;

          //send message to link partner
          $email_text = sprintf(EMAIL_GREET_NONE, $links_contact_name);

          if ($editmode)
              $email_text .= EMAIL_TEXT_EDIT . EMAIL_CONTACT . EMAIL_WARNING;
          else
              $email_text .= EMAIL_WELCOME . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;

          tep_mail($name, $links_contact_email, (($editmode) ? EMAIL_SUBJECT_EDIT : EMAIL_SUBJECT), $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

          //send message to store owner
          $reciprocal = (LINKS_RECIPROCAL_REQUIRED == 'true') ? $links_reciprocal_url : 'Not Required';

          if ($editmode)
              $newlink_subject = sprintf(EMAIL_OWNER_TEXT_EDIT, $name, $links_url, $descriptionText, $reciprocal);
          else
              $newlink_subject = sprintf(EMAIL_OWNER_TEXT, $name, $links_url, $reciprocal);

          tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_OWNER_SUBJECT, $newlink_subject, $name, $links_contact_email);
          tep_redirect(tep_href_link(FILENAME_LINKS_SUBMIT_SUCCESS, '', 'SSL'));
      }
  }

  else if (isset($_POST['action']) && ($_POST['action'] == 'customer_edit')) {
      $editmode = true;

      if (tep_not_null($_POST['links_customer_edit_username']) && tep_not_null($_POST['links_customer_edit_password'])) {
          $links_edit_query = tep_db_query("select l.links_id, ld.links_title, l.links_url, ld.links_description, l.links_contact_name, l.links_contact_email, l.links_image_url, l.links_reciprocal_url, l.links_partner_username, l.links_partner_password, lcd.link_categories_id, lcd.link_categories_name from " . TABLE_LINKS . " l left join " . TABLE_LINKS_DESCRIPTION . " ld on l.links_id = ld.links_id left join " . TABLE_LINKS_TO_LINK_CATEGORIES . " l2c on ld.links_id = l2c.links_id left join " . TABLE_LINK_CATEGORIES_DESCRIPTION . " lcd on l2c.link_categories_id = lcd.link_categories_id where l.links_partner_username LIKE '" . tep_db_input($_POST['links_customer_edit_username']) . "' and l.links_partner_password LIKE '" . tep_db_input($_POST['links_customer_edit_password']) . "'");
          $links_edit = tep_db_fetch_array($links_edit_query);
          $default_category = $links_edit['link_categories_name'];
      }
  }

  // links breadcrumb
  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_LINKS));

  if (isset($_GET['lPath'])) {
      $link_categories_query = tep_db_query("select link_categories_name from " . TABLE_LINK_CATEGORIES_DESCRIPTION . " where link_categories_id = '" . (int)$_GET['lPath'] . "' and language_id = '" . (int)$languages_id . "'");
      $link_categories_value = tep_db_fetch_array($link_categories_query);

      $breadcrumb->add($link_categories_value['link_categories_name'], tep_href_link(FILENAME_LINKS, 'lPath=' . $lPath));
  }

  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_LINKS));
  ?><head><title><?php echo TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script language="javascript"><!--
var form = "";
var submitted = false;
var error = false;
var error_message = "";

function CheckLogin(form) {
  if (form.elements["links_customer_edit_username"].value == '' ||
      form.elements["links_customer_edit_password"].value == '')
  {
    alert("<?php echo ERROR_INVALID_LOGIN; ?>");
    return false;
  }
  return true;
}

function check_input(field_name, field_size, message, check_min) {
  if (form.elements[field_name] && (form.elements[field_name].type != "hidden")) {
    var field_value = form.elements[field_name].value;

    if (check_min == true) { //check less than
      if (field_value == '' || field_value.length < field_size) {
        error_message = error_message + "* " + message + "\n";
        error = true;
      }
    } else {
      if (field_value == '' || field_value.length > field_size) {
        error_message = error_message + "* " + message + "\n";
        error = true;
      }
    }
  }
}

function check_form(form_name) {
  if (submitted == true) {
    alert("<?php echo JS_ERROR_SUBMITTED; ?>");
    return false;
  }

  error = false;
  form = form_name;
  error_message = "<?php echo JS_ERROR; ?>";

  check_input("links_title", <?php echo ENTRY_LINKS_TITLE_MIN_LENGTH; ?>, "<?php echo ENTRY_LINKS_TITLE_ERROR; ?>", true);
  check_input("links_url", <?php echo ENTRY_LINKS_URL_MIN_LENGTH; ?>, "<?php echo ENTRY_LINKS_URL_ERROR; ?>", true);
  check_input("links_description", <?php echo ENTRY_LINKS_DESCRIPTION_MIN_LENGTH; ?>, "<?php echo ENTRY_LINKS_DESCRIPTION_ERROR; ?>", true);
  check_input("links_description", <?php echo ENTRY_LINKS_DESCRIPTION_MAX_LENGTH; ?>, "<?php echo ENTRY_LINKS_MAX_DESCRIPTION_ERROR; ?>", false);
  check_input("links_contact_name", <?php echo ENTRY_LINKS_CONTACT_NAME_MIN_LENGTH; ?>, "<?php echo ENTRY_LINKS_CONTACT_NAME_ERROR; ?>", true);
  check_input("links_contact_email", <?php echo ENTRY_EMAIL_ADDRESS_MIN_LENGTH; ?>, "<?php echo ENTRY_EMAIL_ADDRESS_ERROR; ?>", true);
  <?php if (LINKS_RECIPROCAL_REQUIRED == 'true') { ?>check_input("links_reciprocal_url", <?php echo ENTRY_LINKS_URL_MIN_LENGTH; ?>, "<?php echo ENTRY_LINKS_RECIPROCAL_URL_ERROR; } ?>", true);

  if (error == true) {
    alert(error_message);
    return false;
  } else {
    submitted = true;
    return true;
  }
}

//--></script>
</head>
<?php
  $content = CONTENT_LINKS_SUBMIT;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
