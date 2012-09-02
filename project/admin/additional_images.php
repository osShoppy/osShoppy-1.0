<?php //$Id: /catalog/admin/additional_images.php (1032)

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'alterimage.php');
  require(DIR_WS_FUNCTIONS . 'additional_images.php');

  require(DIR_WS_INCLUDES . FILENAME_ADDITIONAL_IMAGES_CONFIGURE);
  list ($needs_update, $found_one, $status_messages) = db_update_status($configuration_array, $tables_array, $table_mods_array);

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');
  $sub_action = (isset($HTTP_GET_VARS['list']) ? $HTTP_GET_VARS['list'] : '');

  if (!empty($_GET['category_filter'])) { $category_filter = 'ptc.categories_id = '.$_GET['category_filter']; } else { $category_filter = ''; }
  if (!empty($_GET['manufacturer_filter'])) { $manufacturer_filter = 'p.manufacturers_id = '.$_GET['manufacturer_filter']; } else { $manufacturer_filter = ''; }
  $sql_add = (!empty($manufacturer_filter) ? $manufacturer_filter : '' ) . (!empty($manufacturer_filter)&&!empty($category_filter)? ' and ' : '') . (!empty($category_filter) ? $category_filter : '' );

  if (!empty($_GET['products_id']))  {
    $listing_sql = "select p.products_id, 0 as additional_images_id, p.products_model, pd.products_name, p.products_image, p.products_image_med, p.products_image_pop, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "'" . " where p.products_id = '" . $_GET['products_id'] . "'";
  } elseif (!empty($_GET['additional_images_id']))  {
    $listing_sql = "select p.products_id, ai.additional_images_id, p.products_model, pd.products_name, ai.thumb_images as products_image, ai.medium_images as products_image_med, ai.popup_images as products_image_pop, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "'" . " join " . TABLE_ADDITIONAL_IMAGES . " ai on p.products_id = ai.products_id where ai.additional_images_id = '" . $_GET['additional_images_id'] . "'";
  } elseif ($sub_action == 'all') {
    $listing_sql = "(select p.products_id, 0 as additional_images_id, p.products_model, pd.products_name, p.products_image, p.products_image_med, p.products_image_pop, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "'" . (!empty($category_filter) ? ' left join ' . TABLE_PRODUCTS_TO_CATEGORIES . ' ptc on p.products_id = ptc.products_id' : '' ) . (!empty($sql_add) ? ' where '.$sql_add : '') . ")
                     union all
                    (select p.products_id, ai.additional_images_id, p.products_model, pd.products_name, ai.thumb_images as products_image, ai.medium_images as products_image_med, ai.popup_images as products_image_pop, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "'" . (!empty($category_filter) ? ' left join ' . TABLE_PRODUCTS_TO_CATEGORIES . ' ptc on p.products_id = ptc.products_id' : '' ) . " join " . TABLE_ADDITIONAL_IMAGES . " ai on p.products_id = ai.products_id" . (!empty($sql_add) ? ' where '.$sql_add : '') . ")
                     order by products_name, additional_images_id";
  } elseif ($sub_action == 'unprocessed')  {
    $listing_sql = "(select p.products_id, 0 as additional_images_id, p.products_model, pd.products_name, p.products_image, p.products_image_med, p.products_image_pop, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "'" . (!empty($category_filter) ? ' left join ' . TABLE_PRODUCTS_TO_CATEGORIES . ' ptc on p.products_id = ptc.products_id' : '' ) . " where (p.products_image_med IS NULL or p.products_image_pop IS NULL) and (p.products_image IS not NULL and not (p.products_image = ''))" . (!empty($sql_add) ? ' and '.$sql_add : '') . ")
                     union all
                    (select p.products_id, ai.additional_images_id, p.products_model, pd.products_name, ai.thumb_images as products_image, ai.medium_images as products_image_med, ai.popup_images as products_image_pop, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "'" . (!empty($category_filter) ? ' left join ' . TABLE_PRODUCTS_TO_CATEGORIES . ' ptc on p.products_id = ptc.products_id' : '' ) . " join " . TABLE_ADDITIONAL_IMAGES . " ai on p.products_id = ai.products_id where (ai.thumb_images IS NULL or ai.medium_images IS NULL or ai.popup_images IS NULL) and not (ai.thumb_images IS NULL and ai.medium_images IS NULL or ai.popup_images IS NULL)" . (!empty($sql_add) ? ' and '.$sql_add : '') . ")
                     order by products_name, products_image, additional_images_id";
  }

  $product_per_page_drop = (!empty($_GET['product_per_page_drop']) ? tep_db_prepare_input($_GET['product_per_page_drop']) : '20' );
  $current_page_number = (!empty($_GET['page']) ? tep_db_prepare_input($_GET['page']) : '1' );

  if (tep_not_null($action)) {
    switch ($action) {
      case 'generate':

        $php_version_ok = (bool) version_compare_replacement(phpversion(), '4.3.2', '>=');
        if ($php_version_ok == true) {
        
          $query_num_rows = 0;

          $listing_split = new splitUnionPageResults( $current_page_number, $product_per_page_drop, $listing_sql, $query_num_rows );
          $ai_query = tep_db_query($listing_sql);

          $product_images = array();
          while ($product_images_tmp = tep_db_fetch_array($ai_query)) {
            $product_images[] = $product_images_tmp;
          }
          tep_db_free_result($ai_query);
          $messageStack->add_session('Image processing using this base directory: '.DIR_FS_CATALOG.DIR_WS_IMAGES, 'success');

          foreach ($product_images as $pkey => $product_image) {
        
            if (empty($product_image['additional_images_id'])) {
              // process Products table image
              $large_image = (!empty($product_image['products_image_pop'])?$product_image['products_image_pop']:$product_image['products_image']);
              
              if (file_exists(DIR_FS_CATALOG_IMAGES.substr($large_image,0,-5).substr($large_image,-4,4))) {
			    $large_image = substr($large_image,0,-5).substr($large_image,-4,4);
			  }
			  
              // process small image
              if ((int)THUMBNAIL_IMAGE_WIDTH > 0 || (int)THUMBNAIL_IMAGE_HEIGHT > 0) {
                $dest_small_image_name = substr($large_image,0,-4).'s'.substr($large_image,-4,4);
                $create_small_image = new alterimage($large_image,$dest_small_image_name,THUMBNAIL_IMAGE_WIDTH,THUMBNAIL_IMAGE_HEIGHT,ADDITIONAL_IMAGES_BACKGROUND_COLOR, (ADDIMAGES_WATERMARK_SKIP_THUMB=='true'?true:false));
if ($create_small_image->debug) { $messageStack->add_session($create_small_image->messagesOutput(), 'error'); }
                // check to make sure image was created
                if (file_exists(DIR_FS_CATALOG_IMAGES.$dest_small_image_name)) {
                  $messageStack->add_session($dest_small_image_name . ' created!', 'success');
                  $sql_data_array = array ( 'products_image' => $dest_small_image_name );
                  tep_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', "products_id = '" . (int)$product_image['products_id'] . "'");
                } else {
                  $messageStack->add_session('Small image ' . $dest_small_image_name . ' create failed!', 'error');
                }
                unset($create_small_image);
              } else {
                $messageStack->add_session('Small image not processed. You cannot resize an image without setting a width or height in your Configuration -> Images settings group. Look for the "Small Image Width" and "Small Image Height" settings.', 'error');
              }

              // process medium image
              if ((int)DISPLAY_IMAGE_WIDTH > 0 || (int)DISPLAY_IMAGE_HEIGHT > 0) {
                $dest_med_image_name = substr($large_image,0,-4).'m'.substr($large_image,-4,4);
                $create_med_image = new alterimage($large_image,$dest_med_image_name,DISPLAY_IMAGE_WIDTH,DISPLAY_IMAGE_HEIGHT,ADDITIONAL_IMAGES_BACKGROUND_COLOR);
if ($create_med_image->debug) { $messageStack->add_session($create_med_image->messagesOutput(), 'error'); }
                // check to make sure image was created
                if (file_exists(DIR_FS_CATALOG_IMAGES.$dest_med_image_name)) {
                  $messageStack->add_session($dest_med_image_name . ' created!', 'success');
                  $sql_data_array = array ( 'products_image_med' => $dest_med_image_name );
                  tep_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', "products_id = '" . (int)$product_image['products_id'] . "'");
                } else {
                  $messageStack->add_session('Medium image ' . $dest_med_image_name . ' create failed!', 'error');
                }
                unset($create_med_image);
              } else {
                $messageStack->add_session('Medium image not processed. You cannot resize an image without setting a width or height in your Configuration -> Images settings group. Look for the "Display Image Width" and "Display Image Height" settings.', 'error');
              }

              // process large image
              $dest_large_image_name = substr($large_image,0,-4).'l'.substr($large_image,-4,4);
              if ((int)POPUP_IMAGE_WIDTH > 0 || (int)POPUP_IMAGE_HEIGHT > 0) {
                $create_large_image = new alterimage($large_image,$dest_large_image_name,POPUP_IMAGE_WIDTH,POPUP_IMAGE_HEIGHT,ADDITIONAL_IMAGES_BACKGROUND_COLOR);
if ($create_large_image->debug) { $messageStack->add_session($create_large_image->messagesOutput(), 'error'); }
                // if large image was created, remove original
                if ( file_exists(DIR_FS_CATALOG_IMAGES.$dest_large_image_name) ) { 
                  $messageStack->add_session($dest_large_image_name . ' created!', 'success');
                  $sql_data_array = array ( 'products_image_pop' => $dest_large_image_name );
                  tep_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', "products_id = '" . (int)$product_image['products_id'] . "'");
                } else {
                  $messageStack->add_session('Large image ' . $dest_large_image_name . ' create failed!', 'error');
                }
                unset($create_large_image);
              } else {
                @copy( DIR_FS_CATALOG_IMAGES.$large_image, DIR_FS_CATALOG_IMAGES.$dest_large_image_name);
                @chmod(DIR_FS_CATALOG_IMAGES.$dest_large_image_name, 0777);
                $sql_data_array = array ( 'products_image_pop' => $dest_large_image_name );
                tep_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', "products_id = '" . (int)$product_image['products_id'] . "'");
                $messageStack->add_session('Large image was not resized. You cannot resize an image without setting a width or height in your Configuration -> Images settings group. Look for the "Popup Image Width" and "Popup Image Height" settings.', 'error');
              }

              unset($sql_data_array);
              unset($dest_small_image_name);
              unset($dest_med_image_name);
              unset($large_image);

            } else {
              // process Additional Images table image
              $large_image = (!empty($product_image['products_image_pop'])?$product_image['products_image_pop']:$product_image['products_image']);

              if (file_exists(DIR_FS_CATALOG_IMAGES.substr($large_image,0,-5).substr($large_image,-4,4))) {
			    $large_image = substr($large_image,0,-5).substr($large_image,-4,4);
			  }

              // process small image
              if ((int)THUMBNAIL_IMAGE_WIDTH > 0 || (int)THUMBNAIL_IMAGE_HEIGHT > 0) {
                $dest_small_image_name = substr($large_image,0,-4).'s'.substr($large_image,-4,4);
                $create_small_image = new alterimage($large_image,$dest_small_image_name,THUMBNAIL_IMAGE_WIDTH,THUMBNAIL_IMAGE_HEIGHT,ADDITIONAL_IMAGES_BACKGROUND_COLOR, (ADDIMAGES_WATERMARK_SKIP_THUMB=='true'?true:false));
if ($create_small_image->debug) { $messageStack->add_session($create_small_image->messagesOutput(), 'error'); }
                // check to make sure image was created
                if (file_exists(DIR_FS_CATALOG_IMAGES.$dest_small_image_name)) {
                  $messageStack->add_session($dest_small_image_name . ' created!', 'success');
                  $sql_data_array = array ( 'thumb_images' => $dest_small_image_name );
                  tep_db_perform(TABLE_ADDITIONAL_IMAGES, $sql_data_array, 'update', "additional_images_id = '" . (int)$product_image['additional_images_id'] . "'");
                } else {
                  $messageStack->add_session('Small image ' . $dest_small_image_name . ' create failed!', 'error');
                }
                  unset($create_small_image);
              } else {
                $messageStack->add_session('Small image was not resized. You cannot resize an image without setting a width or height in your Configuration -> Images settings group. Look for the "Small Image Width" and "Small Image Height" settings.', 'error');
              }

              // process medium image
              if ((int)DISPLAY_IMAGE_WIDTH > 0 || (int)DISPLAY_IMAGE_HEIGHT > 0) {
                $dest_med_image_name = substr($large_image,0,-4).'m'.substr($large_image,-4,4);
                $create_med_image = new alterimage($large_image,$dest_med_image_name,DISPLAY_IMAGE_WIDTH,DISPLAY_IMAGE_HEIGHT,ADDITIONAL_IMAGES_BACKGROUND_COLOR);
if ($create_med_image->debug) { $messageStack->add_session($create_med_image->messagesOutput(), 'error'); }
                // check to make sure image was created
                if (file_exists(DIR_FS_CATALOG_IMAGES.$dest_med_image_name)) {
                  $messageStack->add_session($dest_med_image_name . ' created!', 'success');
                  $sql_data_array = array ( 'medium_images' => $dest_med_image_name );
                  tep_db_perform(TABLE_ADDITIONAL_IMAGES, $sql_data_array, 'update', "additional_images_id = '" . (int)$product_image['additional_images_id'] . "'");
                } else {
                  $messageStack->add_session('Medium image ' . $dest_med_image_name . ' create failed!', 'error');
                }
                unset($create_med_image);
              } else {
                $messageStack->add_session('Medium image was not resized. You cannot resize an image without setting a width or height in your Configuration -> Images settings group. Look for the "Display Image Width" and "Display Image Height" settings.', 'error');
              }

              // process large image
              $dest_large_image_name = substr($large_image,0,-4).'l'.substr($large_image,-4,4);
              if ((int)POPUP_IMAGE_WIDTH > 0 || (int)POPUP_IMAGE_HEIGHT > 0) {
                $create_large_image = new alterimage($large_image,$dest_large_image_name,POPUP_IMAGE_WIDTH,POPUP_IMAGE_HEIGHT,ADDITIONAL_IMAGES_BACKGROUND_COLOR);
if ($create_large_image->debug) { $messageStack->add_session($create_large_image->messagesOutput(), 'error'); }
                // check to make sure image was created
                if (file_exists(DIR_FS_CATALOG_IMAGES.$dest_large_image_name)) {
                  $messageStack->add_session($dest_large_image_name . ' created!', 'success');
                  $sql_data_array = array ( 'popup_images' => $dest_large_image_name );
                  tep_db_perform(TABLE_ADDITIONAL_IMAGES, $sql_data_array, 'update', "additional_images_id = '" . (int)$product_image['additional_images_id'] . "'");
                } else {
                  $messageStack->add_session('Large image ' . $dest_large_image_name . ' create failed!', 'error');
                }
                unset($create_large_image);
              } else {
                @copy( DIR_FS_CATALOG_IMAGES.$large_image, DIR_FS_CATALOG_IMAGES.$dest_large_image_name);
                @chmod(DIR_FS_CATALOG_IMAGES.$dest_large_image_name, 0777);
                $sql_data_array = array ( 'popup_images' => $dest_large_image_name );
                tep_db_perform(TABLE_ADDITIONAL_IMAGES, $sql_data_array, 'update', "additional_images_id = '" . (int)$product_image['additional_images_id'] . "'");
                $messageStack->add_session('Large image was not resized. You cannot resize an image without setting a width or height in your Configuration -> Images settings group. Look for the "Popup Image Width" and "Popup Image Height" settings.', 'error');
              }

              unset($sql_data_array);
              unset($dest_small_image_name);
              unset($dest_med_image_name);
              unset($large_image);
            }

          }
        } else {
          $messageStack->add_session(TEXT_AI_IMAGES_CREATE_FAIL, 'error');
        }
        tep_redirect(tep_href_link(FILENAME_ADDITIONAL_IMAGES, 'action=list&'.tep_get_all_get_params(array('action', 'submit', 'products_id', 'additional_images_id'))));
        break;

      default:
        break;
    }
    
  }

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
  if ($action == 'generate') {
?>

    <?php echo tep_draw_form('new_product', FILENAME_ADDITIONAL_IMAGES, 'cPath=' . $cPath . (isset($HTTP_GET_VARS['pID']) ? '&pID=' . $HTTP_GET_VARS['pID'] : '') . '&action=new_product_preview', 'post', 'enctype="multipart/form-data"') . tep_hide_session_id(); ?>
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo sprintf(TEXT_NEW_PRODUCT, tep_output_generated_category_path($current_category_id)); ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_STATUS; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_radio_field('products_status', '1', $in_status) . '&nbsp;' . TEXT_PRODUCT_AVAILABLE . '&nbsp;' . tep_draw_radio_field('products_status', '0', $out_status) . '&nbsp;' . TEXT_PRODUCT_NOT_AVAILABLE; ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main" align="right"><?php echo tep_draw_hidden_field('products_date_added', (tep_not_null($pInfo->products_date_added) ? $pInfo->products_date_added : date('Y-m-d'))) . tep_image_submit('button_preview.gif', IMAGE_PREVIEW) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($HTTP_GET_VARS['pID']) ? '&pID=' . $HTTP_GET_VARS['pID'] : '')) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
      </tr>
    </table></form>
<?php

  } elseif ($action == 'list') {


     // create column list
     $define_list = array('PRODUCT_LIST_IMAGE' => PRODUCT_LIST_IMAGE,
                          'PRODUCT_LIST_NAME' => PRODUCT_LIST_NAME,
                          'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_MANUFACTURER,
                          'PRODUCT_LIST_PROCESS' => PRODUCT_LIST_PROCESS);

     $column_list = array();
     reset($define_list);
     while (list($column, $value) = each($define_list)) {
       $column_list[] = $column; 
     }

      $query_num_rows = 0;

      $listing_split = new splitUnionPageResults( $current_page_number, $product_per_page_drop, $listing_sql, $query_num_rows );

        ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr style="background-color: #E9E9E9;">
            <td class="smallText"><?php echo $listing_split->display_count($query_num_rows, $product_per_page_drop, $current_page_number, TEXT_DISPLAY_NUMBER_OF_ITEMS); ?></td>
            <td class="smallText" align="right"><?php echo $listing_split->display_links($query_num_rows, $product_per_page_drop, MAX_DISPLAY_PAGE_LINKS, $current_page_number, tep_get_all_get_params(array('submit', 'page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table>
        <?php

          $list_box_contents = '<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr style="background-color: #B3BAC5;">';

          for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
            switch ($column_list[$col]) {
              case 'PRODUCT_LIST_NAME':
                $lc_text = TABLE_HEADING_PRODUCTS;
                $lc_align = '';
                break;
              case 'PRODUCT_LIST_MANUFACTURER':
                $lc_text = TABLE_HEADING_MANUFACTURER;
                $lc_align = '';
                break;
              case 'PRODUCT_LIST_IMAGE':
                $lc_text = TABLE_HEADING_IMAGE;
                $lc_align = 'center';
                break;
              case 'PRODUCT_LIST_PROCESS':
                $lc_text = TABLE_HEADING_PROCESS;
                $lc_align = 'center';
                break;
            }

            $list_box_contents .= '<td'.(!empty($lc_align) ? ' align="'.$lc_align.'"' : '' ).' style="font-size: 11px; color: #FFFFFF;">'.$lc_text.'</td>'; 
          }

          $list_box_contents .= '</tr>';

          if ($query_num_rows > 0) {
            $rows = 0;
            $listing_query = tep_db_query($listing_sql);
            while ($listing = tep_db_fetch_array($listing_query)) {
              $rows++;

              if (($rows/2) == floor($rows/2)) {
                $list_box_contents .= '<tr style="background-color: #E9E9E9;">';
              } else {
                $list_box_contents .= '<tr style="background-color: #F6F6F6;">';
              }

              for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
                $lc_align = '';

                switch ($column_list[$col]) {
                  case 'PRODUCT_LIST_NAME':
                    $lc_align = '';
                    $lc_text = '&nbsp;' . $listing['products_name'] . '&nbsp;<br><font size="2" color="#444444">&nbsp;&nbsp;' . $listing['products_image'] . '</font>';
                    break;
                  case 'PRODUCT_LIST_MANUFACTURER':
                    $lc_align = '';
                    $lc_text = '&nbsp;' . $listing['manufacturers_name'] . '&nbsp;';
                    break;
                  case 'PRODUCT_LIST_IMAGE':
                    $lc_align = 'center';
                    $lc_text = '&nbsp;<a href="javascript:popupWindow(\'additional_images_popup.php?'.(!empty($listing['additional_images_id'])?'additional_images_id='.$listing['additional_images_id']:'products_id='.$listing['products_id']).'\')">' . ($_GET['show_images'] == 'y' ? tep_image(DIR_WS_CATALOG . DIR_WS_IMAGES . (!empty($listing['products_image']) ? $listing['products_image'] : (!empty($listing['products_image_med']) ? $listing['products_image_med'] : (!empty($listing['products_image_pop']) ? $listing['products_image_pop'] : '' ) ) ), $listing['products_name'], (ADDIMAGES_RESTRICT_IMAGE_SIZE=='true'?THUMBNAIL_IMAGE_WIDTH:''), (ADDIMAGES_RESTRICT_IMAGE_SIZE=='true'?THUMBNAIL_IMAGE_HEIGHT:'')) : '') . '</a>&nbsp;';
                    break;
                  case 'PRODUCT_LIST_PROCESS':
                    $lc_align = 'center';
                    $lc_text = tep_draw_form('generate', FILENAME_ADDITIONAL_IMAGES, '', 'get', 'enctype="multipart/form-data"') . tep_hide_session_id() . 
                               tep_draw_hidden_field('action', 'generate') . tep_draw_hidden_field('list', $_GET['list']) . ( (!empty($listing['additional_images_id'])) ? tep_draw_hidden_field('additional_images_id', $listing['additional_images_id']) : tep_draw_hidden_field('products_id', $listing['products_id']) ) . tep_draw_hidden_field('product_per_page_drop', $product_per_page_drop) . tep_draw_hidden_field('page', $current_page_number) . tep_draw_hidden_field('category_filter', $_GET['category_filter']) . tep_draw_hidden_field('manufacturer_filter', $_GET['manufacturer_filter']) . tep_draw_hidden_field('show_images', $_GET['show_images']) . 
                               '&nbsp;' . tep_draw_input_field( /* $name */ 'submit', /* $value */ TEXT_AI_PROCESS, /* $parameters */ '', /* $required */ false, /* $type */ 'submit', /* $reinsert */ false) . 
                               '</form>';
                    break;
                }

                $list_box_contents .= '<td'.(!empty($lc_align) ? ' align="'.$lc_align.'"' : '' ).' class="productListing-data">'.$lc_text.'</td>'."\n"; 
              }
              $list_box_contents .= '</tr>'."\n";
            }
            $list_box_contents .= '</table>'."\n";
            echo $list_box_contents;

          } else {
            $list_box_contents = '<table border="0" cellpadding="0" cellspacing="0"><tr class="productListing-odd"><td'.(!empty($lc_align) ? ' align="'.$lc_align.'"' : '' ).' class="productListing-data"><br>'.TEXT_NO_PRODUCTS.'<br><br></td></tr></table>'."\n";
            echo $list_box_contents;
          }

        ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr style="background-color: #E9E9E9;">
            <td class="smallText"><?php echo $listing_split->display_count($query_num_rows, $product_per_page_drop, $current_page_number, TEXT_DISPLAY_NUMBER_OF_ITEMS); ?></td>
            <td class="smallText" align="right"><?php echo $listing_split->display_links($query_num_rows, $product_per_page_drop, MAX_DISPLAY_PAGE_LINKS, $current_page_number, tep_get_all_get_params(array('submit', 'page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table>
        <?php

  } else {

        
          $product_per_page_drop = array( array('id' => '4', 'text' => '4'), 
                                          array('id' => '10', 'text' => '10'), 
                                          array('id' => '20', 'text' => '20'), 
                                          array('id' => '50', 'text' => '50'), 
                                          array('id' => '100', 'text' => '100'), 
                                          array('id' => '250', 'text' => '250')
                                   );
          $category_tree = tep_get_category_tree();
          unset($category_tree[0]);
          
          $manufacturers_array = array();
          $manufacturers_array[] = array( "id" => '', 'text' => TEXT_AI_MANUFACTURER );
          $manufacturers_query = tep_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS . " order by manufacturers_name");
          while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
            $manufacturers_array[] = array( "id" => $manufacturers['manufacturers_id'], 'text' => $manufacturers['manufacturers_name'] );
          }
          

        ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <?php if ($needs_update) { ?>
          <tr>
            <td><table border="0" cellspacing="0" cellpadding="12" width="100%" bgcolor="#FFD5D5"><tr><td class="smallText"><?php echo '<p>' . TEXT_AI_DATABASE_NEEDS_UPDATES . '</p>'; ?></td></tr></table></td>
          </tr>
          <?php } ?>
          <tr>
            <td class="smallText"><?php echo '<p>' . TEXT_AI_UTILITY_DESCRIPTION . '</p>'; ?></td>
          </tr>
        <?php echo tep_draw_form('all_product', FILENAME_ADDITIONAL_IMAGES, '', 'get', 'enctype="multipart/form-data"') . tep_hide_session_id(); 
              echo tep_draw_hidden_field('action', 'list'); 
              echo tep_draw_hidden_field('list', 'all'); 
              ?>
          <tr>
            <td class="pageHeading"><?php echo '<br><p style="font-size:80%;">' . TEXT_AI_LIST_ALL . '</p>'; ?></td>
          </tr>
          <tr>
            <td class="smallText"><?php echo '<p>' . TEXT_AI_PROCESS_ALL_DESCRIPTION . '</p>'; ?></td>
          </tr>
          <tr>
            <td class="smallText"><?php echo TEXT_AI_LIST . ' ' . tep_draw_pull_down_menu('product_per_page_drop', $product_per_page_drop, '20') . ' ' . TEXT_AI_PRODUCTS . ' ' . tep_draw_checkbox_field(/* $name */ 'show_images', /* $value */ 'y', /* $checked */ true) . ' ' . TEXT_AI_SHOW_IMAGES . '<br />' .
                                             tep_draw_separator('pixel_trans.gif', '1', '8') . '<br>' . 
                                             TEXT_AI_FILTER_BY . ' ' . tep_draw_pull_down_menu('category_filter', array_merge(array( 0 => array( "id" => '', 'text' => TEXT_AI_CATEGORY )), $category_tree)) . ' ' . TEXT_AI_AND_FILTER_BY . ' ' . tep_draw_pull_down_menu('manufacturer_filter', $manufacturers_array) . '<br />' . 
                                             tep_draw_separator('pixel_trans.gif', '1', '8') . '<br>' . 
                                             tep_draw_input_field( /* $name */ 'submit', /* $value */ TEXT_AI_SHOW.' '.TEXT_AI_LIST_ALL, /* $parameters */ '', /* $required*/ false, /* $type */ 'submit', /* $reinsert */ false); ?></td>
          </tr>
        </form>
        <?php echo tep_draw_form('all_product', FILENAME_ADDITIONAL_IMAGES, '', 'get', 'enctype="multipart/form-data"') . tep_hide_session_id(); 
              echo tep_draw_hidden_field('action', 'list'); 
              echo tep_draw_hidden_field('list', 'unprocessed'); 
              ?>
          <tr>
            <td class="pageHeading"><?php echo '<br><p style="font-size:80%;">' . TEXT_AI_LIST_UNPROCESSED . '</p>'; ?></td>
          </tr>
          <tr>
            <td class="smallText"><?php echo '<p>' . TEXT_AI_PROCESS_UNPROCESSED_DESCRIPTION . '</p>'; ?></td>
          </tr>
          <tr>
            <td class="smallText"><?php echo TEXT_AI_LIST . ' ' . tep_draw_pull_down_menu('product_per_page_drop', $product_per_page_drop, '20') . ' ' . TEXT_AI_PRODUCTS . ' ' . tep_draw_checkbox_field(/* $name */ 'show_images', /* $value */ 'y', /* $checked */ true) . ' ' . TEXT_AI_SHOW_IMAGES . '<br />' .
                                             tep_draw_separator('pixel_trans.gif', '1', '8') . '<br>' . 
                                             TEXT_AI_FILTER_BY . ' ' . tep_draw_pull_down_menu('category_filter', array_merge(array( 0 => array( "id" => '', 'text' => TEXT_AI_CATEGORY )), $category_tree)) . ' ' . TEXT_AI_AND_FILTER_BY . ' ' . tep_draw_pull_down_menu('manufacturer_filter', $manufacturers_array) . '<br />' . 
                                             tep_draw_separator('pixel_trans.gif', '1', '8') . '<br>' . 
                                             tep_draw_input_field( /* $name */ 'submit', /* $value */ TEXT_AI_SHOW.' '.TEXT_AI_LIST_UNPROCESSED, /* $parameters */ '', /* $required*/ false, /* $type */ 'submit', /* $reinsert */ false); ?></td>
          </tr>
        </form>
        </table>
        <?php

  } // end if ($action) {

?>

       </td>

<?php

    $heading = array();
    $contents = array();
    switch ($action) {
      case 'generate':

        break;

      default:
        if ($action == 'list') {
            $heading[] = array('text' => '<b>' . TEXT_SELECT_TASK . '</b>');

            $contents[] = array('text' => tep_draw_form('generate', FILENAME_ADDITIONAL_IMAGES, '', 'get', 'enctype="multipart/form-data"') . tep_hide_session_id() . 
                                          tep_draw_hidden_field('action', 'generate') . tep_draw_hidden_field('list', $_GET['list']) . tep_draw_hidden_field('product_per_page_drop', $product_per_page_drop) . tep_draw_hidden_field('page', $current_page_number) . tep_draw_hidden_field('category_filter', $_GET['category_filter']) . tep_draw_hidden_field('manufacturer_filter', $_GET['manufacturer_filter']) . tep_draw_hidden_field('show_images', $_GET['show_images']) . 
                                          '<p>' . TEXT_AI_PROCESS_DESCRIPTION . '</p>' . '<br>' . 
                                          '<font color=red><b>' . TEXT_AI_DATABASE_UPDATE_WARNING . '</b></font><br><br><br>' . 
                                          '&nbsp;' . tep_draw_input_field( /* $name */ 'submit', /* $value */ TEXT_AI_PROCESS_ALL, /* $parameters */ '', /* $required */ false, /* $type */ 'submit', /* $reinsert */ false) . '<br><br>' .
                                          '&nbsp;<a href="' . tep_href_link(FILENAME_ADDITIONAL_IMAGES) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a><br><br>' . 
                                          '</form>');
        } else {
          $heading[] = array('text' => '<b>' . TEXT_NOTHING_SELECTED_TITLE . '</b>');

          $contents[] = array('text' => '<br>&nbsp;' . TEXT_NOTHING_SELECTED . 
                                        '<br><br><br><br>&nbsp;-&nbsp;<a href="' . tep_href_link(FILENAME_ADDITIONAL_IMAGES_CONFIGURE) . '"><u>' . TEXT_AI_CONFIGURE . '</u></a>&nbsp;-<br><br>'
                                        );
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
