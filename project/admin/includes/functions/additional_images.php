<?php //$Id: /catalog/admin/includes/functions/additional_images.php (1032) 

  function tep_is_image_still_used($image) {
    $image = tep_db_input($image);
    $product_images_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image = '" . $image . "' or products_image_med = '" . $image . "' or products_image_pop = '" . $image . "'");
    $product_total = tep_db_fetch_array($product_images_query);
    tep_db_free_result($product_images_query);
    $product_images_query = tep_db_query("select count(*) as total from " . TABLE_ADDITIONAL_IMAGES . " where thumb_images = '" . $image . "' or medium_images = '" . $image . "' or popup_images = '" . $image . "'");
    $product_total2 = tep_db_fetch_array($product_images_query);
    tep_db_free_result($product_images_query);
    if ($product_total['total'] > 0 || $product_total2['total'] > 0) {
      return true;
    } else {
      return false;
    }
  }
  
if ( !function_exists('tep_get_parent_category') ) {
  function tep_get_parent_category($cat) {
    $category_query = tep_db_query("select parent_id from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$cat . "' limit 1");
    if ( $category = tep_db_fetch_array($category_query) ) {
      if ($category['parent_id'] != 0) {
        return $category['parent_id'];
      } else {
        return false;
      }
    }
    return false;
  }
}

if ( !function_exists('tep_catname_to_dir') ) {
  function tep_catname_to_dir($catname) {
    return strtolower(str_replace(' ','-',preg_replace("/[^a-zA-Z0-9\s]/", "", $catname)));
  }
}

  // version_compare_replacement & version_compare_replacement_sub 
  // based on functions found in phpThumb() by James Heinrich <info(at)silisoftware(dot)com>
  // released under GNU GENERAL PUBLIC LICENSE Version 2, June 1991
if (!function_exists('version_compare_replacement_sub')) {
  function version_compare_replacement_sub($version1, $version2, $operator='') {
    // If you specify the third optional operator argument, you can test for a particular relationship.
    // The possible operators are: <, lt, <=, le, >, gt, >=, ge, ==, =, eq, !=, <>, ne respectively.
    // Using this argument, the function will return 1 if the relationship is the one specified by the operator, 0 otherwise.

    // If a part contains special version strings these are handled in the following order: dev < (alpha = a) < (beta = b) < RC < pl
    static $versiontype_lookup = array();
    if (empty($versiontype_lookup)) {
        $versiontype_lookup['dev']   = 10001;
        $versiontype_lookup['a']     = 10002;
        $versiontype_lookup['alpha'] = 10002;
        $versiontype_lookup['b']     = 10003;
        $versiontype_lookup['beta']  = 10003;
        $versiontype_lookup['RC']    = 10004;
        $versiontype_lookup['pl']    = 10005;
    }
    if (isset($versiontype_lookup[$version1])) {
        $version1 = $versiontype_lookup[$version1];
    }
    if (isset($versiontype_lookup[$version2])) {
        $version2 = $versiontype_lookup[$version2];
    }

    switch ($operator) {
        case '<':
        case 'lt':
            return intval($version1 < $version2);
            break;
        case '<=':
        case 'le':
            return intval($version1 <= $version2);
            break;
        case '>':
        case 'gt':
            return intval($version1 > $version2);
            break;
        case '>=':
        case 'ge':
            return intval($version1 >= $version2);
            break;
        case '==':
        case '=':
        case 'eq':
            return intval($version1 == $version2);
            break;
        case '!=':
        case '<>':
        case 'ne':
            return intval($version1 != $version2);
            break;
    }
    if ($version1 == $version2) {
        return 0;
    } elseif ($version1 < $version2) {
        return -1;
    }
    return 1;
  }
}

if (!function_exists('version_compare_replacement')) {
  function version_compare_replacement($version1, $version2, $operator='') {
    if (function_exists('version_compare')) {
        // built into PHP v4.1.0+
        return version_compare($version1, $version2, $operator);
    }

    // The function first replaces _, - and + with a dot . in the version strings
    $version1 = strtr($version1, '_-+', '...');
    $version2 = strtr($version2, '_-+', '...');

    // and also inserts dots . before and after any non number so that for example '4.3.2RC1' becomes '4.3.2.RC.1'.
    // Then it splits the results like if you were using explode('.',$ver). Then it compares the parts starting from left to right.
    $version1 = eregi_replace('([0-9]+)([A-Z]+)([0-9]+)', '\\1.\\2.\\3', $version1);
    $version2 = eregi_replace('([0-9]+)([A-Z]+)([0-9]+)', '\\1.\\2.\\3', $version2);

    $parts1 = explode('.', $version1);
    $parts2 = explode('.', $version1);
    $parts_count = max(count($parts1), count($parts2));
    for ($i = 0; $i < $parts_count; $i++) {
        $comparison = phpthumb_functions::version_compare_replacement_sub($version1, $version2, $operator);
        if ($comparison != 0) {
            return $comparison;
        }
    }
    return 0;
  }
}

  // process_uploads() Designed for: osCommerce, Open Source E-Commerce Solutions
  // http://www.oscommerce.com
  // Copyright (c) 2006 Todd Holforty - mtholforty(at)surfalot(dot)com
  // released under GNU GENERAL PUBLIC LICENSE Version 2, June 1991
  function process_uploads($image_subdirectory,$thumb,$medium,$large,&$sql_data_array,&$messageStack) {

    $add_images_error = true; // meant to report if single default image is uploaded and that is all.
    
    if ($_GET['action'] == 'new_product_preview') {
      $message_function = 'add';
    } else {
      $message_function = 'add_session';
    }

    $dir_fs_catalog_images_wrk = DIR_FS_CATALOG_IMAGES;

    $is_windows = (bool) (strtoupper(substr(PHP_OS, 0, 3)) == 'WIN');
    $php_version_ok = (bool) version_compare_replacement(phpversion(), '4.3.2', '>=');

    //
    // setup directories if needed
    //
    if ($is_windows) {
      $dir_separator = '\\';
    } else {
      $dir_separator = '/';
    }

    if ($image_subdirectory == '/' || $image_subdirectory == '\\') { $image_subdirectory = ''; }  // in case the user mistakenly entered only a single /
    if ($image_subdirectory != '') {
      $image_subdirectory = preg_replace('/\\\/', '/', $image_subdirectory); // in case back-slashes used, flip them around
      $image_subdirectory = preg_replace('/\/\/+/', '/', $image_subdirectory); // change any multiple slashes to a single /
      if (strpos($image_subdirectory, '/') === 0) { 
        $image_subdirectory = substr($image_subdirectory, 1); // strip any leading slash
      }
      if (substr($image_subdirectory, -1, 1) == '/') { 
        $image_subdirectory = substr($image_subdirectory, 0, -1); // strip any trailing slash
      }
      $dirs =  explode('/',$image_subdirectory);

      foreach ($dirs as $tkey => $dir) {
        if (!empty($dir)) {
          if (!@is_writable($dir_fs_catalog_images_wrk)) {
            $messageStack->$message_function(sprintf(ERROR_CATALOG_IMAGE_DIRECTORY_IS_NOT_WRITABLE, $dir_fs_catalog_images_wrk), 'error');
            if (@chmod($working_directory, 0777)) {
              $messageStack->$message_function(sprintf(ERROR_SETTING_PERMISSIONS, $dir_fs_catalog_images_wrk), 'error');
            } else {
              $messageStack->$message_function(sprintf(SUCCESS_SETTING_PERMISSIONS, $dir_fs_catalog_images_wrk), 'success');
            }
          }
          $dir_fs_catalog_images_wrk .= $dir . $dir_separator;
          if (!@is_dir($dir_fs_catalog_images_wrk)) {
            @mkdir($dir_fs_catalog_images_wrk, 0777);
            if (!@is_dir($dir_fs_catalog_images_wrk)) {
              $messageStack->$message_function(sprintf(ERROR_CATALOG_IMAGE_DIRECTORY_CREATE_FAILED, $dir_fs_catalog_images_wrk), 'error');
            } else {
              $messageStack->$message_function(sprintf(SUCCESS_CATALOG_IMAGE_DIRECTORY_CREATED, $dir_fs_catalog_images_wrk), 'success');
            }
          }
        }
      }
      $image_subdirectory = implode('/',$dirs) . '/';
    }


    //
    // upload images & create thumbs is required
    //
    if ($thumb_images = new upload_quiet($thumb, $dir_fs_catalog_images_wrk)) {
      // generate image set from single upload
      $add_images_error = false;
      if ((ADDITIONAL_IMAGES_AUTO_CREATE == 'true' || $_POST['manual_thumb_generation'] == 'on') && !empty($thumb_images->filename)) {
        if ($php_version_ok == true) {

          // reduce thumb image if required
          $dest_small_image_name = substr($thumb_images->filename,0,-4).'s'.substr($thumb_images->filename,-4,4);
          if ((int)SMALL_IMAGE_WIDTH > 0 || (int)SMALL_IMAGE_HEIGHT > 0) {
            if (file_exists($dir_fs_catalog_images_wrk.$dest_small_image_name) === true) { 
              @unlink($dir_fs_catalog_images_wrk.$dest_small_image_name);
            }
            // create thumb image
            $image = new alterimage($image_subdirectory.$thumb_images->filename,$image_subdirectory.$dest_small_image_name,SMALL_IMAGE_WIDTH,SMALL_IMAGE_HEIGHT,ADDITIONAL_IMAGES_BACKGROUND_COLOR, (ADDIMAGES_WATERMARK_SKIP_THUMB=='true'?true:false));
if ($image->debug) { $messageStack->add_session($image->messagesOutput(), 'error'); }
            if (!empty($image->error)) {
              $messageStack->$message_function('Error returned from alterimage class: '.$image->error, 'error');
            }
            // set messages
            if (file_exists($dir_fs_catalog_images_wrk.$dest_small_image_name)) {
              $messageStack->$message_function(sprintf(TEXT_IMAGES_CREATE_THUMB_SUCCESS, $dir_fs_catalog_images_wrk.$dest_small_image_name), 'success');
              // set thumb filename in perform array
              $add_data_array = array($thumb => $image_subdirectory . tep_db_prepare_input($dest_small_image_name));
              $sql_data_array = array_merge($sql_data_array, $add_data_array);
            } else {
              $messageStack->$message_function(sprintf(TEXT_IMAGES_CREATE_THUMB_FAIL, $dir_fs_catalog_images_wrk.$dest_small_image_name), 'error');
            }
          } else {
            $messageStack->$message_function('Small image was not resized. You cannot resize an image without setting a width or height in your Configuration -> Images settings group. Look for the "Small Image Width" and "Small Image Height" settings.', 'error');
          }

          // reduce medium image if required
          $dest_med_image_name = substr($thumb_images->filename,0,-4).'m'.substr($thumb_images->filename,-4,4);
          if ((int)DISPLAY_IMAGE_WIDTH > 0 || (int)DISPLAY_IMAGE_HEIGHT > 0) {
            if (file_exists($dir_fs_catalog_images_wrk.$dest_med_image_name) === true) { 
              @unlink($dir_fs_catalog_images_wrk.$dest_med_image_name);
            }
            // create products info image
            $image = new alterimage($image_subdirectory.$thumb_images->filename,$image_subdirectory.$dest_med_image_name,DISPLAY_IMAGE_WIDTH,DISPLAY_IMAGE_HEIGHT,ADDITIONAL_IMAGES_BACKGROUND_COLOR);
if ($image->debug) { $messageStack->add_session($image->messagesOutput(), 'error'); }
            if (!empty($image->error)) {
              $messageStack->$message_function('Error returned from alterimage class: '.$image->error, 'error');
            }
            // set messages
            if (file_exists($dir_fs_catalog_images_wrk.$dest_med_image_name)) {
              $messageStack->$message_function(sprintf(TEXT_IMAGES_CREATE_PRODI_SUCCESS,$dir_fs_catalog_images_wrk.$dest_med_image_name), 'success');
              // set products info filename in perform array
              $add_data_array = array($medium => $image_subdirectory . tep_db_prepare_input($dest_med_image_name));
              $sql_data_array = array_merge($sql_data_array, $add_data_array);
            } else {
              $messageStack->$message_function(sprintf(TEXT_IMAGES_CREATE_PRODI_FAIL,$dir_fs_catalog_images_wrk.$dest_med_image_name), 'error');
            }
          } else {
             $messageStack->$message_function('Medium image was not resized. You cannot resize an image without setting a width or height in your Configuration -> Images settings group. Look for the "Display Image Width" and "Display Image Height" settings.', 'error');
          }

          // reduce large image if required
		  $dest_large_image_name = substr($thumb_images->filename,0,-4).'l'.substr($thumb_images->filename,-4,4);
          if ((int)POPUP_IMAGE_WIDTH > 0 || (int)POPUP_IMAGE_HEIGHT > 0) {
            if (file_exists($dir_fs_catalog_images_wrk.$dest_large_image_name) === true) { 
              @unlink($dir_fs_catalog_images_wrk.$dest_large_image_name);
            }
            // create thumb image
            $image = new alterimage($image_subdirectory.$thumb_images->filename,$image_subdirectory.$dest_large_image_name,POPUP_IMAGE_WIDTH,POPUP_IMAGE_HEIGHT,ADDITIONAL_IMAGES_BACKGROUND_COLOR);
if ($image->debug) { $messageStack->add_session($image->messagesOutput(), 'error'); }
            if (!empty($image->error)) {
              $messageStack->$message_function('Error returned from alterimage class: '.$image->error, 'error');
            }
            // set messages
            if (file_exists($dir_fs_catalog_images_wrk.$dest_large_image_name)) {
              $messageStack->$message_function(sprintf(TEXT_IMAGES_CREATE_LARGE_SUCCESS, $dir_fs_catalog_images_wrk.$dest_large_image_name), 'success');
              // set large filename in perform array
              $add_data_array = array($large => $image_subdirectory . tep_db_prepare_input($dest_large_image_name));
              $sql_data_array = array_merge($sql_data_array, $add_data_array);
            } else {
              $messageStack->$message_function(sprintf(TEXT_IMAGES_CREATE_LARGE_FAIL, $dir_fs_catalog_images_wrk.$dest_large_image_name), 'error');
            }
          } else {
             @copy($dir_fs_catalog_images_wrk.$thumb_images->filename, $dir_fs_catalog_images_wrk.$dest_large_image_name);
             @chmod($dir_fs_catalog_images_wrk.$dest_large_image_name, 0777);
             $add_data_array = array($large => $image_subdirectory . tep_db_prepare_input($dest_large_image_name));
             $sql_data_array = array_merge($sql_data_array, $add_data_array);
             $messageStack->$message_function('Large image was not resized. You cannot resize an image without setting a width or height in your Configuration -> Images settings group. Look for the "Popup Image Width" and "Popup Image Height" settings.', 'error');
          }

/*
          if (!empty($dest_small_image_name)) {
            $add_data_array = array($large => $image_subdirectory . tep_db_prepare_input($thumb_images->filename));
            $sql_data_array = array_merge($sql_data_array, $add_data_array);
          } else {
            $add_data_array = array($thumb => $image_subdirectory . tep_db_prepare_input($thumb_images->filename));
            $sql_data_array = array_merge($sql_data_array, $add_data_array);
          }
*/
        } else {
          $messageStack->$message_function(sprintf(TEXT_IMAGES_CREATE_FAIL,$dir_fs_catalog_images_wrk.$dest_med_image_name), 'error');
        }

      } else {

        // upload all three images if available
        if (!empty($thumb_images->filename)) {
          // set thumb filename in perform array
          $upload_name = tep_db_prepare_input(tep_db_input($thumb_images->filename));
          $sql_data_array = array_merge($sql_data_array, array($thumb => $image_subdirectory.$upload_name));
          if (file_exists($dir_fs_catalog_images_wrk.$upload_name)) {
            $messageStack->$message_function(sprintf(SUCCESS_IMAGE_UPLOADED,$dir_fs_catalog_images_wrk.$upload_name), 'success');
          } else {
            $messageStack->$message_function(sprintf(ERROR_IMAGE_UPLOAD_FAILED,$dir_fs_catalog_images_wrk.$upload_name), 'error');
          }
        }
        // upload medium image & set filename in perform array
        if (($medium_images = new upload_quiet($medium, $dir_fs_catalog_images_wrk)) && !empty($medium_images->filename)) {
          $upload_name = tep_db_prepare_input(tep_db_input($medium_images->filename));
          $sql_data_array = array_merge($sql_data_array, array($medium => $image_subdirectory.$upload_name));
          if (file_exists($dir_fs_catalog_images_wrk.$upload_name)) {
            $messageStack->$message_function(sprintf(SUCCESS_IMAGE_UPLOADED,$dir_fs_catalog_images_wrk.$upload_name), 'success');
          } else {
            $messageStack->$message_function(sprintf(ERROR_IMAGE_UPLOAD_FAILED,$dir_fs_catalog_images_wrk.$upload_name), 'error');
          }
        }
        // upload popup image & set filename in perform array
        if (($popup_images = new upload_quiet($large, $dir_fs_catalog_images_wrk)) && !empty($popup_images->filename)) {
          $upload_name = tep_db_prepare_input(tep_db_input($popup_images->filename));
          $sql_data_array = array_merge($sql_data_array, array($large => $image_subdirectory.$upload_name));
          if (file_exists($dir_fs_catalog_images_wrk.$upload_name)) {
            $messageStack->$message_function(sprintf(SUCCESS_IMAGE_UPLOADED,$dir_fs_catalog_images_wrk.$upload_name), 'success');
          } else {
            $messageStack->$message_function(sprintf(ERROR_IMAGE_UPLOAD_FAILED,$dir_fs_catalog_images_wrk.$upload_name), 'error');
          }
        }
      }
    }
        
    return $add_images_error;
  
  }

?>
