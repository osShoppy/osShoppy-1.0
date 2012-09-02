<?php //$Id: /catalog/admin/products_attributes.php (osC)

  require('includes/application_top.php');
  $languages = tep_get_languages();

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');

  $option_page = (isset($HTTP_GET_VARS['option_page']) && is_numeric($HTTP_GET_VARS['option_page'])) ? $HTTP_GET_VARS['option_page'] : 1;
  $value_page = (isset($HTTP_GET_VARS['value_page']) && is_numeric($HTTP_GET_VARS['value_page'])) ? $HTTP_GET_VARS['value_page'] : 1;
  $attribute_page = (isset($HTTP_GET_VARS['attribute_page']) && is_numeric($HTTP_GET_VARS['attribute_page'])) ? $HTTP_GET_VARS['attribute_page'] : 1;

  $page_info = 'option_page=' . $option_page . '&value_page=' . $value_page . '&attribute_page=' . $attribute_page;

  if (tep_not_null($action)) {
    switch ($action) {
// BOF: Attribute Sort with Clone Tool
	  case 'clone_attributes':
	if (ATTRIBUTES_CLONE_OPTION == 'single') {
		$clone_product_id_from = $HTTP_POST_VARS['clone_products_id_from'];
		$clone_product_id_to = $HTTP_POST_VARS['clone_products_id_to'];
		tep_db_query("delete from ".TABLE_PRODUCTS_ATTRIBUTES." WHERE products_id='".$clone_product_id_to."'");
		$attributes = tep_db_query("select products_id, options_id, options_values_id, options_values_price, price_prefix, attribute_sort from " . TABLE_PRODUCTS_ATTRIBUTES ." where products_id='".$clone_product_id_from."'");
		while($attributes_values = tep_db_fetch_array($attributes)) {
          tep_db_query("INSERT INTO " . TABLE_PRODUCTS_ATTRIBUTES . " ( products_id, options_id, options_values_id, options_values_price, price_prefix, attribute_sort) VALUES (".$clone_product_id_to.", ".$attributes_values['options_id'].", ".$attributes_values['options_values_id'].", ".$attributes_values['options_values_price'].", '".$attributes_values['price_prefix']."' , ".$attributes_values['attribute_sort'].")");
		}	
        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
		
	} else {
		
	    $multi_clone_products_id_to=$HTTP_POST_VARS['clone_products_id_to'];
	    for ($i=0;$i<sizeof($multi_clone_products_id_to);$i++) {
		  $clone_product_id_from = $HTTP_POST_VARS['clone_products_id_from'];
		  $clone_product_id_to = $multi_clone_products_id_to[$i];
		  tep_db_query("delete from ".TABLE_PRODUCTS_ATTRIBUTES." WHERE products_id='".$clone_product_id_to."'");
		  $attributes = tep_db_query("select products_id, options_id, options_values_id, options_values_price, price_prefix, attribute_sort from " . TABLE_PRODUCTS_ATTRIBUTES ." where products_id='".$clone_product_id_from."'");
		  while($attributes_values = tep_db_fetch_array($attributes)) {
            tep_db_query("INSERT INTO " . TABLE_PRODUCTS_ATTRIBUTES . " ( products_id, options_id, options_values_id, options_values_price, price_prefix, attribute_sort) VALUES (".$clone_product_id_to.", ".$attributes_values['options_id'].", ".$attributes_values['options_values_id'].", ".$attributes_values['options_values_price'].", '".$attributes_values['price_prefix']."' , ".$attributes_values['attribute_sort'].")");
		  }
	    }
	    tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
	    break;
	}
// EOF: Attribute Sort with Clone Tool
      case 'add_product_options':
        $products_options_id = tep_db_prepare_input($HTTP_POST_VARS['products_options_id']);
        $option_name_array = $HTTP_POST_VARS['option_name'];

        for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
          $option_name = tep_db_prepare_input($option_name_array[$languages[$i]['id']]);

        //tep_db_query("insert into " . TABLE_PRODUCTS_OPTIONS . " (products_options_id, products_options_name, language_id) values ('" . (int)$products_options_id . "', '" . tep_db_input($option_name) . "', '" . (int)$languages[$i]['id'] . "')");
//++++ QT Pro: Begin Changed code
          $track_stock=isset($HTTP_POST_VARS['track_stock'])?1:0;
          tep_db_query("insert into " . TABLE_PRODUCTS_OPTIONS . " (products_options_id, products_options_name, language_id,products_options_track_stock) values ('" . (int)$products_options_id . "', '" . tep_db_input($option_name) . "', '" . (int)$languages[$i]['id'] . "', '" . (int)$track_stock . "')");
//++++ QT Pro: End Changed Code
          }
        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'add_product_option_values':
        $value_name_array = $HTTP_POST_VARS['value_name'];
        $value_id = tep_db_prepare_input($HTTP_POST_VARS['value_id']);
        $option_id = tep_db_prepare_input($HTTP_POST_VARS['option_id']);

        for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
          $value_name = tep_db_prepare_input($value_name_array[$languages[$i]['id']]);

          tep_db_query("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES . " (products_options_values_id, language_id, products_options_values_name) values ('" . (int)$value_id . "', '" . (int)$languages[$i]['id'] . "', '" . tep_db_input($value_name) . "')");
        }

        tep_db_query("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " (products_options_id, products_options_values_id) values ('" . (int)$option_id . "', '" . (int)$value_id . "')");

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'add_product_attributes':
        $products_id = tep_db_prepare_input($HTTP_POST_VARS['products_id']);
        $options_id = tep_db_prepare_input($HTTP_POST_VARS['options_id']);
        $values_id = tep_db_prepare_input($HTTP_POST_VARS['values_id']);
        $value_price = tep_db_prepare_input($HTTP_POST_VARS['value_price']);
        $price_prefix = tep_db_prepare_input($HTTP_POST_VARS['price_prefix']);
        $attributes_sort = tep_db_prepare_input($HTTP_POST_VARS['attributes_sort']); // clone attributes products

		// change for SPPC attributes hide attributes from groups (added @ as value)
		//clone attributes products added: , '" . (int)$attributes_sort . "')");
        tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES . " values (null, '" . (int)$products_id . "', '" . (int)$options_id . "', '" . (int)$values_id . "', '" . (float)tep_db_input($value_price) . "', '" . tep_db_input($price_prefix) . "', '" . (int)$attributes_sort . "', '@')");

        if (DOWNLOAD_ENABLED == 'true') {
          $products_attributes_id = tep_db_insert_id();

          $products_attributes_filename = tep_db_prepare_input($HTTP_POST_VARS['products_attributes_filename']);
          $products_attributes_maxdays = tep_db_prepare_input($HTTP_POST_VARS['products_attributes_maxdays']);
          $products_attributes_maxcount = tep_db_prepare_input($HTTP_POST_VARS['products_attributes_maxcount']);

// BOF Super Download Shop v1.0 mod
          if (DOWNLOADS_CONTROLLER_FILEGROUP_STATUS == 'Yes') {
            $product_attribute_filegroup_id = tep_db_prepare_input($HTTP_POST_VARS['filegroup_id']);
            if ($product_attribute_filegroup_id > 0) {
              $products_attributes_filename = 'Group_Files-' . $product_attribute_filegroup_id;
            } else {
              if (strstr($products_attributes_filename, 'Group_Files-')) $products_attributes_filename = 'File_Not_Assigned';
            }
            if (tep_not_null($products_attributes_filename)) tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " values (" . (int)$products_attributes_id . ", '" . tep_db_input($products_attributes_filename) . "', '" . tep_db_input($product_attribute_filegroup_id) . "', '" . tep_db_input($products_attributes_maxdays) . "', '" . tep_db_input($products_attributes_maxcount) . "')");
          } else if (tep_not_null($products_attributes_filename)) {
            tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " values (" . (int)$products_attributes_id . ", '" . tep_db_input($products_attributes_filename) . "', '', '" . tep_db_input($products_attributes_maxdays) . "', '" . tep_db_input($products_attributes_maxcount) . "')");
          }
// EOF Super Download Shop v1.0 mod
        }

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
// BOF Super Download Shop v1.0 mod
      case 'add_filegroups':
        $filegroup_id = tep_db_prepare_input($HTTP_POST_VARS['filegroup_id']);
        $file_group_array = $HTTP_POST_VARS['file_group_name'];
        // check if any name given
        $name_check = 0;
        for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
          if (!empty($file_group_array[$languages[$i]['id']])) $name_check = 1;
        }

        if (is_numeric($filegroup_id) && $name_check == 1) {
          for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
            $file_group_name = tep_db_prepare_input($file_group_array[$languages[$i]['id']]);

            tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS . " (download_group_id, download_group_name, language_id) values ('" . (int)$filegroup_id . "', '" . tep_db_input($file_group_name) . "', '" . (int)$languages[$i]['id'] . "')");
          }
        }
        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'add_group_file':
        $filegroup_id = tep_db_prepare_input($HTTP_POST_VARS['filegroup_id']);
        $file_desc_array = $HTTP_POST_VARS['file_desc'];
        $file_name = '';
        if (isset($HTTP_POST_VARS['input_filename']) && !empty($HTTP_POST_VARS['input_filename'])) {
          $file_name = tep_db_prepare_input($HTTP_POST_VARS['input_filename']);
        }
        if (tep_not_null($file_name) && file_exists(DIR_FS_CATALOG_DOWNLOAD . $file_name)) {
          // check existing file and descriptions
          $file_query = tep_db_query("select download_groups_file_id from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_FILES . " where download_group_filename = '" . $file_name . "'");
          if (tep_db_num_rows($file_query) > 0) {
            $file_array = tep_db_fetch_array($file_query);
            tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_FILES . " (download_groups_file_id, download_group_id, download_group_filename) values ('" . (int)$file_array['download_groups_file_id'] . "', '" . (int)$filegroup_id . "', '" . tep_db_input($file_name) . "')");
          } else {
            tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_FILES . " (download_group_id, download_group_filename) values ('" . (int)$filegroup_id . "', '" . tep_db_input($file_name) . "')");
            $download_groups_file_id = tep_db_insert_id();

            for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
              $file_desc = tep_db_prepare_input($file_desc_array[$languages[$i]['id']]);
              if (empty($file_desc)) $file_desc = tep_db_prepare_input(TEXT_TEMP_DESC . ' ' . $download_groups_file_id);

              tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_TO_FILES . " (download_groups_file_id, language_id, download_group_file_description) values ('" . (int)$download_groups_file_id . "', '" . (int)$languages[$i]['id'] . "', '" . tep_db_input($file_desc) . "')");
            }
          }
        } else {
          if (!tep_not_null($file_name)) $messageStack->add_session(ERROR_NO_FILENAME, 'error');
          else $messageStack->add_session(sprintf(ERROR_FILE_DOES_NOT_EXIST, $file_name), 'error');
        }
        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'add_mass_files':
        $filegroup_id = tep_db_prepare_input($HTTP_POST_VARS['filegroup_id']);
        $file_selected = $HTTP_POST_VARS['file_selected'];
        foreach($file_selected as $k => $file_name) {
          if (tep_not_null($file_name)) {
            $file_name = tep_db_prepare_input($file_name);
            // check if file already in group
            $file_check_query = tep_db_query("select * from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_FILES . " where download_group_id = '" . (int)$filegroup_id . "' and download_group_filename = '" . $file_name . "'");
            if (tep_db_num_rows($file_check_query) == 0) {
              // check existing file and descriptions
              $file_query = tep_db_query("select download_groups_file_id from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_FILES . " where download_group_filename = '" . $file_name . "'");
              if (tep_db_num_rows($file_query) > 0) {
                $file_array = tep_db_fetch_array($file_query);
                tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_FILES . " (download_groups_file_id, download_group_id, download_group_filename) values ('" . (int)$file_array['download_groups_file_id'] . "', '" . (int)$filegroup_id . "', '" . tep_db_input($file_name) . "')");
              } else {
                tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_FILES . " (download_group_id, download_group_filename) values ('" . (int)$filegroup_id . "', '" . tep_db_input($file_name) . "')");
                $download_groups_file_id = tep_db_insert_id();

                for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
                  $file_desc = tep_db_prepare_input(TEXT_TEMP_DESC . ' ' . $download_groups_file_id);

                  tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_TO_FILES . " (download_groups_file_id, language_id, download_group_file_description) values ('" . (int)$download_groups_file_id . "', '" . (int)$languages[$i]['id'] . "', '" . tep_db_input($file_desc) . "')");
                }
              }
            }
          }
        }
        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'update_filegroup_name':
        $file_group_name_array = $HTTP_POST_VARS['file_group_name'];
        $filegroup_id = tep_db_prepare_input($HTTP_POST_VARS['filegroup_id']);

        for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
          $file_group_name = tep_db_prepare_input($file_group_name_array[$languages[$i]['id']]);

          tep_db_query("update " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS . " set download_group_name = '" . tep_db_input($file_group_name) . "' where download_group_id = '" . (int)$filegroup_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
        }

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'update_file_desc':
        $file_desc_array = $HTTP_POST_VARS['file_desc'];
        $file_id = tep_db_prepare_input($HTTP_POST_VARS['file_id']);

        for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
          $file_desc = tep_db_prepare_input($file_desc_array[$languages[$i]['id']]);

          tep_db_query("update " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_TO_FILES . " set download_group_file_description = '" . tep_db_input($file_desc) . "' where download_groups_file_id = '" . (int)$file_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
        }

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'delete_download_group':
        $filegroup_id = tep_db_prepare_input($HTTP_GET_VARS['filegroup_id']);

        tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS . " where download_group_id = '" . (int)$filegroup_id . "'");
        // check files in other group
        $files_query = tep_db_query("select download_groups_file_id from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_FILES . " where download_group_id = '" . (int)$filegroup_id . "'");
        while ($file_array = tep_db_fetch_array($files_query)) {
          $file_check = tep_db_query("select download_groups_file_id from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_FILES . " where download_group_id != '" . (int)$filegroup_id . "' and download_groups_file_id = '" . $file_array['download_groups_file_id'] . "'");
          if (tep_db_num_rows($file_check) === 0) {
            tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_TO_FILES . " where download_groups_file_id = '" . $file_array['download_groups_file_id'] . "'");
          }
        }
        tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_FILES . " where download_group_id = '" . (int)$filegroup_id . "'");

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'delete_file_from_group':
        $filegroup_id = tep_db_prepare_input($HTTP_GET_VARS['filegroup_id']);
        $file_id = tep_db_prepare_input($HTTP_GET_VARS['group_file_id']);

        tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_FILES . "
                      where download_group_id = '" . (int)$filegroup_id . "'
                      and download_groups_file_id = '" . (int)$file_id . "'");
        // check files in other group
        $file_check = tep_db_query("select download_groups_file_id from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_FILES . "
                                    where download_group_id != '" . (int)$filegroup_id . "'
                                    and download_groups_file_id = '" . (int)$file_id . "'");
        if (tep_db_num_rows($file_check) === 0) {
          tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_TO_FILES . " where download_groups_file_id = '" . (int)$file_id . "'");
        }

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'delete_file_all_groups':
        $file_id = tep_db_prepare_input($HTTP_GET_VARS['group_file_id']);

        tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_FILES . "
                      where download_groups_file_id = '" . (int)$file_id . "'");
        tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS_TO_FILES . " where download_groups_file_id = '" . (int)$file_id . "'");

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
// EOF Super Download Shop v1.0 mod
      case 'update_option_name':
        $option_name_array = $HTTP_POST_VARS['option_name'];
        $option_id = tep_db_prepare_input($HTTP_POST_VARS['option_id']);

        for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
          $option_name = tep_db_prepare_input($option_name_array[$languages[$i]['id']]);

          //tep_db_query("update " . TABLE_PRODUCTS_OPTIONS . " set products_options_name = '" . tep_db_input($option_name) . "' where products_options_id = '" . (int)$option_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
//++++ QT Pro: Begin Changed code
          $track_stock=isset($HTTP_POST_VARS['track_stock'])?1:0;
          tep_db_query("update " . TABLE_PRODUCTS_OPTIONS . " set products_options_track_stock='" . (int)$track_stock . "',products_options_name = '" . tep_db_input($option_name) . "' where products_options_id = '" . (int)$option_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
//++++ QT Pro: End Changed Code
		}

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'update_value':
        $value_name_array = $HTTP_POST_VARS['value_name'];
        $value_id = tep_db_prepare_input($HTTP_POST_VARS['value_id']);
        $option_id = tep_db_prepare_input($HTTP_POST_VARS['option_id']);

        for ($i=0, $n=sizeof($languages); $i<$n; $i ++) {
          $value_name = tep_db_prepare_input($value_name_array[$languages[$i]['id']]);

          tep_db_query("update " . TABLE_PRODUCTS_OPTIONS_VALUES . " set products_options_values_name = '" . tep_db_input($value_name) . "' where products_options_values_id = '" . tep_db_input($value_id) . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
        }

        tep_db_query("update " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " set products_options_id = '" . (int)$option_id . "'  where products_options_values_id = '" . (int)$value_id . "'");

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'update_product_attribute':
        $products_id = tep_db_prepare_input($HTTP_POST_VARS['products_id']);
        $options_id = tep_db_prepare_input($HTTP_POST_VARS['options_id']);
        $values_id = tep_db_prepare_input($HTTP_POST_VARS['values_id']);
        $value_price = tep_db_prepare_input($HTTP_POST_VARS['value_price']);
        $price_prefix = tep_db_prepare_input($HTTP_POST_VARS['price_prefix']);
        $attribute_id = tep_db_prepare_input($HTTP_POST_VARS['attribute_id']);
        $attributes_sort = tep_db_prepare_input($HTTP_POST_VARS['attributes_sort']); // clone attributes products
		//clone attributes products added: , attribute_sort = '" . (int)$attributes_sort . "'
        tep_db_query("update " . TABLE_PRODUCTS_ATTRIBUTES . " set products_id = '" . (int)$products_id . "', options_id = '" . (int)$options_id . "', options_values_id = '" . (int)$values_id . "', options_values_price = '" . (float)tep_db_input($value_price) . "', price_prefix = '" . tep_db_input($price_prefix) . "', attribute_sort = '" . (int)$attributes_sort . "' where products_attributes_id = '" . (int)$attribute_id . "'");

        if (DOWNLOAD_ENABLED == 'true') {
          $products_attributes_filename = tep_db_prepare_input($HTTP_POST_VARS['products_attributes_filename']);
          $products_attributes_maxdays = tep_db_prepare_input($HTTP_POST_VARS['products_attributes_maxdays']);
          $products_attributes_maxcount = tep_db_prepare_input($HTTP_POST_VARS['products_attributes_maxcount']);

// BOF Super Download Shop v1.0 mod
          if (DOWNLOADS_CONTROLLER_FILEGROUP_STATUS == 'Yes') {
            $product_attribute_filegroup_id = tep_db_prepare_input($HTTP_POST_VARS['filegroup_id']);
            if ($product_attribute_filegroup_id > 0) {
              $products_attributes_filename = 'Group_Files-' . $product_attribute_filegroup_id;
            } else {
              if (strstr($products_attributes_filename, 'Group_Files-')) $products_attributes_filename = 'File_Not_Assigned';
            }
            tep_db_query("replace into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " set products_attributes_id = '" . (int)$attribute_id . "', products_attributes_filename = '" . tep_db_input($products_attributes_filename) . "', products_attributes_filegroup_id = '" . tep_db_input($product_attribute_filegroup_id) . "', products_attributes_maxdays = '" . tep_db_input($products_attributes_maxdays) . "', products_attributes_maxcount = '" . tep_db_input($products_attributes_maxcount) . "'");
          } else if (tep_not_null($products_attributes_filename)) {
            tep_db_query("replace into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " set products_attributes_id = '" . (int)$attribute_id . "', products_attributes_filename = '" . tep_db_input($products_attributes_filename) . "', products_attributes_maxdays = '" . tep_db_input($products_attributes_maxdays) . "', products_attributes_maxcount = '" . tep_db_input($products_attributes_maxcount) . "'");
          }
// EOF Super Download Shop v1.0 mod
        }

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'delete_option':
        $option_id = tep_db_prepare_input($HTTP_GET_VARS['option_id']);

        tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$option_id . "'");

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'delete_value':
        $value_id = tep_db_prepare_input($HTTP_GET_VARS['value_id']);

        tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$value_id . "'");
        tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$value_id . "'");
        tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " where products_options_values_id = '" . (int)$value_id . "'");

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
        break;
      case 'delete_attribute':
        $attribute_id = tep_db_prepare_input($HTTP_GET_VARS['attribute_id']);

        tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_attributes_id = '" . (int)$attribute_id . "'");
		// SPPC attributes for groups
		tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES_GROUPS . " where products_attributes_id = '" . (int)$attribute_id . "'");
		// added for DOWNLOAD_ENABLED. Always try to remove attributes, even if downloads are no longer enabled
        tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " where products_attributes_id = '" . (int)$attribute_id . "'");

        tep_redirect(tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info));
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
<!-- options and values//-->
      <tr>
        <td width="100%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top" width="50%"><table width="100%" border="0" cellspacing="0" cellpadding="2">
<!-- options //-->
<?php
  if ($action == 'delete_product_option') { // delete product option
    $options = tep_db_query("select products_options_id, products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$HTTP_GET_VARS['option_id'] . "' and language_id = '" . (int)$languages_id . "'");
    $options_values = tep_db_fetch_array($options);
?>
              <tr>
                <td class="pageHeading"> <?php echo $options_values['products_options_name']; ?> </td>
              </tr>
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="3"><?php echo tep_black_line(); ?></td>
                  </tr>
<?php
    $products = tep_db_query("select p.products_id, pd.products_name, pov.products_options_values_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov, " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pov.language_id = '" . (int)$languages_id . "' and pd.language_id = '" . (int)$languages_id . "' and pa.products_id = p.products_id and pa.options_id='" . (int)$HTTP_GET_VARS['option_id'] . "' and pov.products_options_values_id = pa.options_values_id order by pd.products_name");
    if (tep_db_num_rows($products)) {
?>
                  <tr class="dataTableHeadingRow">
                    <td class="dataTableHeadingContent" align="center"> <?php echo TABLE_HEADING_ID; ?> </td>
                    <td class="dataTableHeadingContent"> <?php echo TABLE_HEADING_PRODUCT; ?> </td>
                    <td class="dataTableHeadingContent"> <?php echo TABLE_HEADING_OPT_VALUE; ?> </td>
                  </tr>
                  <tr>
                    <td colspan="3"><?php echo tep_black_line(); ?></td>
                  </tr>
<?php
      $rows = 0;
      while ($products_values = tep_db_fetch_array($products)) {
        $rows++;
?>
                  <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
                    <td align="center" class="smallText"> <?php echo $products_values['products_id']; ?> </td>
                    <td class="smallText"> <?php echo $products_values['products_name']; ?> </td>
                    <td class="smallText"> <?php echo $products_values['products_options_values_name']; ?> </td>
                  </tr>
<?php
      }
?>
                  <tr>
                    <td colspan="3"><?php echo tep_black_line(); ?></td>
                  </tr>
                  <tr>
                    <td colspan="3" class="main"><br><?php echo TEXT_WARNING_OF_DELETE; ?></td>
                  </tr>
                  <tr>
                    <td align="right" colspan="3" class="main"><br><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.png', ' cancel '); ?></a> </td>
                  </tr>
<?php
    } else {
?>
                  <tr>
                    <td class="main" colspan="3"><br><?php echo TEXT_OK_TO_DELETE; ?></td>
                  </tr>
                  <tr>
                    <td class="main" align="right" colspan="3"><br><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_option&option_id=' . $HTTP_GET_VARS['option_id'] . '&' . $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_delete.png', IMAGE_DELETE); ?></a>   <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.png', IMAGE_CANCEL); ?></a> </td>
                  </tr>
<?php
    }
?>
                </table></td>
              </tr>
<?php
  } else {
?>
              <tr>
                <td colspan="3" class="pageHeading"> <?php echo HEADING_TITLE_OPT; ?> </td>
              </tr>
              <tr>
                <td colspan="3" class="smallText" align="right">
<?php
    $options = "select * from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$languages_id . "' order by products_options_id";
    $options_split = new splitPageResults($option_page, MAX_ROW_LISTS_OPTIONS, $options, $options_query_numrows);

    echo $options_split->display_links($options_query_numrows, MAX_ROW_LISTS_OPTIONS, MAX_DISPLAY_PAGE_LINKS, $option_page, 'value_page=' . $value_page . '&attribute_page=' . $attribute_page, 'option_page');
?>
                </td>
              </tr>
              <tr>
                <td colspan="4"><?php echo tep_black_line(); ?></td>
              </tr>
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"> <?php echo TABLE_HEADING_ID; ?> </td>
                <td class="dataTableHeadingContent"> <?php echo TABLE_HEADING_OPT_NAME; ?> </td>
                <td class="dataTableHeadingContent"> <?php echo TABLE_HEADING_TRACK_STOCK; ?> </td>
                <td class="dataTableHeadingContent" align="center"> <?php echo TABLE_HEADING_ACTION; ?> </td>
              </tr>
              <tr>
                <td colspan="4"><?php echo tep_black_line(); ?></td>
              </tr>
<?php
    $next_id = 1;
    $rows = 0;
    $options = tep_db_query($options);
    while ($options_values = tep_db_fetch_array($options)) {
      $rows++;
?>
              <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php
      if (($action == 'update_option') && ($HTTP_GET_VARS['option_id'] == $options_values['products_options_id'])) {
        echo '<form name="option" action="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_option_name&' . $page_info, 'NONSSL') . '" method="post">';
        $inputs = '';
        for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
          $option_name = tep_db_query("select products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . $options_values['products_options_id'] . "' and language_id = '" . $languages[$i]['id'] . "'");
          $option_name = tep_db_fetch_array($option_name);
          $inputs .= $languages[$i]['code'] . ': <input type="text" name="option_name[' . $languages[$i]['id'] . ']" size="20" value="' . $option_name['products_options_name'] . '"> <br>';
        }
?>
                <td align="center" class="smallText"> <?php echo $options_values['products_options_id']; ?><input type="hidden" name="option_id" value="<?php echo $options_values['products_options_id']; ?>"> </td>
                <td class="smallText"><?php echo $inputs; ?></td>
                <td align="center" class="smallText"><input type=checkbox name=track_stock <?php echo $options_values['products_options_track_stock']?"checked":""; ?>></td>
                <td align="center" class="smallText"> <?php echo tep_image_submit('button_update.png', IMAGE_UPDATE); ?> <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.png', IMAGE_CANCEL); ?></a> </td>
<?php
        echo '</form>' . "\n";
      } else {
?>
                <td align="center" class="smallText"> <?php echo $options_values["products_options_id"]; ?> </td>
                <td class="smallText"> <?php echo $options_values["products_options_name"]; ?> </td>
                <td align="center" class="smallText"> <?php echo $options_values['products_options_track_stock']?TEXT_YES:TEXT_NO; ?></td>
                <td align="center" class="smallText"> <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_option&option_id=' . $options_values['products_options_id'] . '&' . $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_edit.png', IMAGE_UPDATE); ?></a>  <?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_product_option&option_id=' . $options_values['products_options_id'] . '&' . $page_info, 'NONSSL') , '">'; ?><?php echo tep_image_button('button_delete.png', IMAGE_DELETE); ?></a> </td>
<?php
      }
?>
              </tr>
<?php
      $max_options_id_query = tep_db_query("select max(products_options_id) + 1 as next_id from " . TABLE_PRODUCTS_OPTIONS);
      $max_options_id_values = tep_db_fetch_array($max_options_id_query);
      $next_id = $max_options_id_values['next_id'];
    }
?>
              <tr>
                <td colspan="4"><?php echo tep_black_line(); ?></td>
              </tr>
<?php
    if ($action != 'update_option') {
?>
              <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php
      echo '<form name="options" action="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=add_product_options&' . $page_info, 'NONSSL') . '" method="post"><input type="hidden" name="products_options_id" value="' . $next_id . '">';
      $inputs = '';
      for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
        $inputs .= $languages[$i]['code'] . ': <input type="text" name="option_name[' . $languages[$i]['id'] . ']" size="20"> <br>';
      }
?>
                <td align="center" class="smallText"> <?php echo $next_id; ?> </td>
                <td class="smallText"><?php echo $inputs; ?></td>
                <td align="center" ><input type=checkbox name=track_stock></td>
                <td align="left" class="smallText"> <?php echo tep_image_submit('button_insert.png', IMAGE_INSERT); ?> </td>
<?php echo '</form>'; ?>
              </tr>
              <tr>
                <td colspan="4"><?php echo tep_black_line(); ?></td>
              </tr>
<?php
    }
  }
?>
            </table></td>
<!-- options eof //-->
			<td width="1%"></td>
            <td valign="top" width="50%"><table width="100%" border="0" cellspacing="0" cellpadding="2">
<!-- value //-->
<?php
  if ($action == 'delete_option_value') { // delete product option value
    $values = tep_db_query("select products_options_values_id, products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$HTTP_GET_VARS['value_id'] . "' and language_id = '" . (int)$languages_id . "'");
    $values_values = tep_db_fetch_array($values);
?>
              <tr>
                <td colspan="3" class="pageHeading">&nbsp;<?php echo $values_values['products_options_values_name']; ?>&nbsp;</td>
              </tr>
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="3"><?php echo tep_black_line(); ?></td>
                  </tr>
<?php
    $products = tep_db_query("select p.products_id, pd.products_name, po.products_options_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS . " po, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "' and po.language_id = '" . (int)$languages_id . "' and pa.products_id = p.products_id and pa.options_values_id='" . (int)$HTTP_GET_VARS['value_id'] . "' and po.products_options_id = pa.options_id order by pd.products_name");
    if (tep_db_num_rows($products)) {
?>
                  <tr class="dataTableHeadingRow">
                    <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_ID; ?>&nbsp;</td>
                    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT; ?>&nbsp;</td>
                    <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_NAME; ?>&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="3"><?php echo tep_black_line(); ?></td>
                  </tr>
<?php
      while ($products_values = tep_db_fetch_array($products)) {
        $rows++;
?>
                  <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
                    <td align="center" class="smallText">&nbsp;<?php echo $products_values['products_id']; ?>&nbsp;</td>
                    <td class="smallText">&nbsp;<?php echo $products_values['products_name']; ?>&nbsp;</td>
                    <td class="smallText">&nbsp;<?php echo $products_values['products_options_name']; ?>&nbsp;</td>
                  </tr>
<?php
      }
?>
                  <tr>
                    <td colspan="3"><?php echo tep_black_line(); ?></td>
                  </tr>
                  <tr>
                    <td class="main" colspan="3"><br><?php echo TEXT_WARNING_OF_DELETE; ?></td>
                  </tr>
                  <tr>
                    <td class="main" align="right" colspan="3"><br><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.png', ' cancel '); ?></a>&nbsp;</td>
                  </tr>
<?php
    } else {
?>
                  <tr>
                    <td class="main" colspan="3"><br><?php echo TEXT_OK_TO_DELETE; ?></td>
                  </tr>
                  <tr>
                    <td class="main" align="right" colspan="3"><br><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_value&value_id=' . $HTTP_GET_VARS['value_id'] . '&' . $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_delete.png', ' delete '); ?></a>&nbsp;&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.png', ' cancel '); ?></a>&nbsp;</td>
                  </tr>
<?php
    }
?>
              	</table></td>
              </tr>
<?php
  } else {
?>
              <tr>
                <td colspan="4" class="pageHeading">&nbsp;<?php echo HEADING_TITLE_VAL; ?>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4" class="smallText" align="right">
<?php
    $values = "select pov.products_options_values_id, pov.products_options_values_name, pov2po.products_options_id from " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov left join " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " pov2po on pov.products_options_values_id = pov2po.products_options_values_id where pov.language_id = '" . (int)$languages_id . "' order by pov.products_options_values_id";
    $values_split = new splitPageResults($value_page, MAX_ROW_LISTS_OPTIONS_VALUES, $values, $values_query_numrows);

    echo $values_split->display_links($values_query_numrows, MAX_ROW_LISTS_OPTIONS_VALUES, MAX_DISPLAY_PAGE_LINKS, $value_page, 'option_page=' . $option_page . '&attribute_page=' . $attribute_page, 'value_page');
?>
                </td>
              </tr>
              <tr>
                <td colspan="4"><?php echo tep_black_line(); ?></td>
              </tr>
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_ID; ?>&nbsp;</td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_NAME; ?>&nbsp;</td>
                <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_VALUE; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
              <tr>
                <td colspan="4"><?php echo tep_black_line(); ?></td>
              </tr>
<?php
    $next_id = 1;
    $rows = 0;
    $values = tep_db_query($values);
    while ($values_values = tep_db_fetch_array($values)) {
      $options_name = tep_options_name($values_values['products_options_id']);
      $values_name = $values_values['products_options_values_name'];
      $rows++;
?>
              <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php
      if (($action == 'update_option_value') && ($HTTP_GET_VARS['value_id'] == $values_values['products_options_values_id'])) {
        echo '<form name="values" action="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_value&' . $page_info, 'NONSSL') . '" method="post">';
        $inputs = '';
        for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
          $value_name = tep_db_query("select products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$values_values['products_options_values_id'] . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
          $value_name = tep_db_fetch_array($value_name);
          $inputs .= $languages[$i]['code'] . ':&nbsp;<input type="text" name="value_name[' . $languages[$i]['id'] . ']" size="15" value="' . $value_name['products_options_values_name'] . '">&nbsp;<br>';
        }
?>
                <td align="center" class="smallText">&nbsp;<?php echo $values_values['products_options_values_id']; ?><input type="hidden" name="value_id" value="<?php echo $values_values['products_options_values_id']; ?>">&nbsp;</td>
                <td align="center" class="smallText">&nbsp;<?php echo "\n"; ?><select name="option_id">
<?php
        $options = tep_db_query("select products_options_id, products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . (int)$languages_id . "' order by products_options_name");
        while ($options_values = tep_db_fetch_array($options)) {
          echo "\n" . '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '"';
          if ($values_values['products_options_id'] == $options_values['products_options_id']) { 
            echo ' selected';
          }
          echo '>' . $options_values['products_options_name'] . '</option>';
        } 
?>
                </select>&nbsp;</td>
                <td class="smallText"><?php echo $inputs; ?></td>
                <td align="center" class="smallText">&nbsp;<?php echo tep_image_submit('button_update.png', IMAGE_UPDATE); ?>&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.png', IMAGE_CANCEL); ?></a>&nbsp;</td>
<?php    echo '</form>';
      } else {
?>
                <td align="center" class="smallText">&nbsp;<?php echo $values_values["products_options_values_id"]; ?>&nbsp;</td>
                <td align="center" class="smallText">&nbsp;<?php echo $options_name; ?>&nbsp;</td>
                <td class="smallText">&nbsp;<?php echo $values_name; ?>&nbsp;</td>
                <td align="center" class="smallText">&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_option_value&value_id=' . $values_values['products_options_values_id'] . '&' . $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_edit.png', IMAGE_UPDATE); ?></a>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_option_value&value_id=' . $values_values['products_options_values_id'] . '&' . $page_info, 'NONSSL') , '">'; ?><?php echo tep_image_button('button_delete.png', IMAGE_DELETE); ?></a>&nbsp;</td>
<?php
      }
      $max_values_id_query = tep_db_query("select max(products_options_values_id) + 1 as next_id from " . TABLE_PRODUCTS_OPTIONS_VALUES);
      $max_values_id_values = tep_db_fetch_array($max_values_id_query);
      $next_id = $max_values_id_values['next_id'];
    }
?>
              </tr>
              <tr>
                <td colspan="4"><?php echo tep_black_line(); ?></td>
              </tr>
<?php
    if ($action != 'update_option_value') {
?>
              <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php
      echo '<form name="values" action="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=add_product_option_values&' . $page_info, 'NONSSL') . '" method="post">';
?>
                <td align="center" class="smallText">&nbsp;<?php echo $next_id; ?>&nbsp;</td>
                <td align="center" class="smallText">&nbsp;<select name="option_id">
<?php
      $options = tep_db_query("select products_options_id, products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . $languages_id . "' order by products_options_name");
      while ($options_values = tep_db_fetch_array($options)) {
        echo '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
      }

      $inputs = '';
      for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
        $inputs .= $languages[$i]['code'] . ':&nbsp;<input type="text" name="value_name[' . $languages[$i]['id'] . ']" size="15">&nbsp;<br>';
      }
?>
                </select>&nbsp;</td>
                <td class="smallText"><input type="hidden" name="value_id" value="<?php echo $next_id; ?>"><?php echo $inputs; ?></td>
                <td align="center" class="smallText">&nbsp;<?php echo tep_image_submit('button_insert.png', IMAGE_INSERT); ?>&nbsp;</td>
<?php
      echo '</form>';
?>
              </tr>
              <tr>
                <td colspan="4"><?php echo tep_black_line(); ?></td>
              </tr>
<?php
    }
  }
?>
            </table></td>
          </tr>
        </table></td>
<!-- option value eof //-->
      </tr> 
<!-- download_attributes //-->
<?php
  if (DOWNLOAD_ENABLED == 'true' && DOWNLOADS_CONTROLLER_FILEGROUP_STATUS == 'Yes') {
    require('includes/group_download.php');
  }
?>
<!-- download_attributes eof //-->
<!-- products_attributes //-->  
      <tr>
        <td class="smallText">&nbsp;</td>
      </tr>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">&nbsp;<?php echo HEADING_TITLE_ATRIB; ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
<?php
  if ($action == 'update_attribute') {
    $form_action = 'update_product_attribute';
  } else {
    $form_action = 'add_product_attributes';
  }
?>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText" align="right">
<?php
// BOF  SPPC, get products name from products_description now instead of doing a query with each attribute
// original->  $attributes = "select pa.* from " . TABLE_PRODUCTS_ATTRIBUTES . " pa left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on pa.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by pd.products_name";
  			   $attributes = "select pa.*, pd.products_name from " . TABLE_PRODUCTS_ATTRIBUTES . " pa left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on pa.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by pd.products_name";
// EOF  SPPC
  $attributes_split = new splitPageResults($attribute_page, MAX_ROW_LISTS_OPTIONS_TO_VALUES, $attributes, $attributes_query_numrows);

  echo $attributes_split->display_links($attributes_query_numrows, MAX_ROW_LISTS_OPTIONS_TO_VALUES, MAX_DISPLAY_PAGE_LINKS, $attribute_page, 'option_page=' . $option_page . '&value_page=' . $value_page, 'attribute_page');
?>
            </td>
          </tr>
        </table>
        <form name="attributes" action="<?php echo tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=' . $form_action . '&' . $page_info); ?>" method="post"><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="9"><?php echo tep_black_line(); ?></td>
          </tr>
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_ID; ?>&nbsp;</td>
            <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT; ?>&nbsp;</td>
            <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_NAME; ?>&nbsp;</td>
            <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_VALUE; ?>&nbsp;</td>
            <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_OPT_SORT_ORDER; ?>&nbsp;</td>
            <td class="dataTableHeadingContent" align="right">&nbsp;<?php echo TABLE_HEADING_OPT_PRICE; ?>&nbsp;</td> 
            <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_OPT_PRICE_PREFIX; ?>&nbsp;</td>
<?php // BOF SPPC, attributes groups modification ?>
			<td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_HIDDEN; ?>&nbsp;</td>
<?php // EOF SPPC, attributes groups modification ?>
            <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="9"><?php echo tep_black_line(); ?></td>
          </tr>
<?php
  $next_id = 1;
// BOF SPPC, attributes groups modification
  $customers_groups_query = tep_db_query("select customers_group_id, customers_group_name from " . TABLE_CUSTOMERS_GROUPS . "  order by customers_group_id");

  while ($_customers_groups = tep_db_fetch_array($customers_groups_query)) {
		$customers_groups[] = $_customers_groups;
	}
// EOF SPPC, attributes groups modification
  $attributes = tep_db_query($attributes);
  while ($attributes_values = tep_db_fetch_array($attributes)) {
 // $products_name_only = tep_get_products_name($attributes_values['products_id']);
    $products_name_only = $attributes_values['products_name'];
    $options_name = tep_options_name($attributes_values['options_id']);
    $values_name = tep_values_name($attributes_values['options_values_id']);
    $attributes_sort = tep_attributes_sort($attributes_values['products_attributes_id']);
    $rows++;
?>
          <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php
    if (($action == 'update_attribute') && ($HTTP_GET_VARS['attribute_id'] == $attributes_values['products_attributes_id'])) {
?>
            <td class="smallText">&nbsp;<?php echo $attributes_values['products_attributes_id']; ?><input type="hidden" name="attribute_id" value="<?php echo $attributes_values['products_attributes_id']; ?>">&nbsp;</td>
            <td class="smallText">&nbsp;<select name="products_id">
<?php
      $products = tep_db_query("select p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . $languages_id . "' order by pd.products_name");
      while($products_values = tep_db_fetch_array($products)) {
        if ($attributes_values['products_id'] == $products_values['products_id']) {
          echo "\n" . '<option name="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '" SELECTED>' . $products_values['products_name'] . '</option>';
        } else {
          echo "\n" . '<option name="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '">' . $products_values['products_name'] . '</option>';
        }
      } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="options_id">
<?php
      $options = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . $languages_id . "' order by products_options_name");
      while($options_values = tep_db_fetch_array($options)) {
        if ($attributes_values['options_id'] == $options_values['products_options_id']) {
          echo "\n" . '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '" SELECTED>' . $options_values['products_options_name'] . '</option>';
        } else {
          echo "\n" . '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
        }
      } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="values_id">
<?php
      $values = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where language_id ='" . $languages_id . "' order by products_options_values_name");
      while($values_values = tep_db_fetch_array($values)) {
        if ($attributes_values['options_values_id'] == $values_values['products_options_values_id']) {
          echo "\n" . '<option name="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '" SELECTED>' . $values_values['products_options_values_name'] . '</option>';
        } else {
          echo "\n" . '<option name="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '">' . $values_values['products_options_values_name'] . '</option>';
        }
      } 
?>        
            </select>&nbsp;</td>
            <td align"right" class="smallText">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="attributes_sort" value="<?php echo $attributes_sort; ?>" size="3">&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<input type="text" name="value_price" value="<?php echo $attributes_values['options_values_price']; ?>" size="6">&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<input type="text" name="price_prefix" value="<?php echo $attributes_values['price_prefix']; ?>" size="2">&nbsp;</td>
<?php // BOF SPPC attributes hide for groups mod ?>
            <td align="center" class="smallText"><?php echo $hide_info = tep_get_hide_info($customers_groups, $attributes_values['attributes_hide_from_groups']); ?></td>
<?php // EOF SPPC attributes hide for groups mod ?>
            <td align="center" class="smallText">&nbsp;<?php echo tep_image_submit('button_update.png', IMAGE_UPDATE); ?>&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.png', IMAGE_CANCEL); ?></a>&nbsp;</td>
<?php
      if (DOWNLOAD_ENABLED == 'true') {
// BOF Super Download Shop v1.0 mod
        if (DOWNLOADS_CONTROLLER_FILEGROUP_STATUS == 'Yes') {
          $download_query_raw ="select products_attributes_filename, products_attributes_filegroup_id, products_attributes_maxdays, products_attributes_maxcount 
                                from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " 
                                where products_attributes_id='" . $attributes_values['products_attributes_id'] . "'";
          $download_query = tep_db_query($download_query_raw);
          if (tep_db_num_rows($download_query) > 0) {
            $download = tep_db_fetch_array($download_query);
            $products_attributes_filename = $download['products_attributes_filename'];
            $products_attributes_filegroup_id = $download['products_attributes_filegroup_id'];
            $products_attributes_maxdays  = $download['products_attributes_maxdays'];
            $products_attributes_maxcount = $download['products_attributes_maxcount'];
          }
        } else {
// EOF Super Download Shop v1.0 mod
        $download_query_raw ="select products_attributes_filename, products_attributes_maxdays, products_attributes_maxcount 
                              from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " 
                              where products_attributes_id='" . $attributes_values['products_attributes_id'] . "'";
        $download_query = tep_db_query($download_query_raw);
        if (tep_db_num_rows($download_query) > 0) {
          $download = tep_db_fetch_array($download_query);
          $products_attributes_filename = $download['products_attributes_filename'];
          $products_attributes_maxdays  = $download['products_attributes_maxdays'];
          $products_attributes_maxcount = $download['products_attributes_maxcount'];
        }
// BOF Super Download Shop v1.0 mod
        }
// EOF Super Download Shop v1.0 mod
?>
          <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
            <td>&nbsp;</td>
            <td colspan="6">
              <table>
                <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
<?php
// BOF AlexStusio mod
?>
                  <td class="smallText"><b><?php echo TABLE_HEADING_DOWNLOAD; ?>&nbsp;</b></td>
                  <td class="smallText"><?php echo TABLE_TEXT_FILENAME; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_filename', $products_attributes_filename, 'size="15"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_DAYS; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxdays', $products_attributes_maxdays, 'size="5"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_COUNT; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxcount', $products_attributes_maxcount, 'size="5"'); ?>&nbsp;</td>
                </tr>
<?php
        if ( DOWNLOADS_CONTROLLER_FILEGROUP_STATUS == 'Yes' ) {
?>
                <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
                  <td class="smallText"></td>
                  <td class="smallText"><?php echo TABLE_TEXT_FILEGROUP; ?></td>
                  <td class="smallText">&nbsp;<select name="filegroup_id">
<?php
          $file_groups_query = tep_db_query("select * from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS . " where language_id = '" . $languages_id . "' order by download_group_id");
          while ($file_groups = tep_db_fetch_array($file_groups_query)) {
            if ($file_groups['download_group_id'] == $products_attributes_filegroup_id) {
              echo "\n" . '<option name="' . TEXT_OPTION_FILEGROUP . '" value="' . $file_groups['download_group_id'] . '" SELECTED>' . $file_groups['download_group_name'] . '</option>';
            } else {
              echo "\n" . '<option name="' . TEXT_OPTION_FILEGROUP . '" value="' . $file_groups['download_group_id'] . '">' . $file_groups['download_group_name'] . '</option>';
            }
          } 
?>
                  </select>&nbsp;</td>
                </tr>
<?php
        }
// EOF Super Download Shop v1.0 mod
?>
              </table>
            </td>
            <td>&nbsp;</td>
          </tr>
<?php
      }
?>
<?php
    } elseif (($action == 'delete_product_attribute') && ($HTTP_GET_VARS['attribute_id'] == $attributes_values['products_attributes_id'])) {
?>
            <td class="smallText">&nbsp;<b><?php echo $attributes_values["products_attributes_id"]; ?></b>&nbsp;</td>
            <td class="smallText">&nbsp;<b><?php echo $products_name_only; ?></b>&nbsp;</td>
            <td class="smallText">&nbsp;<b><?php echo $options_name; ?></b>&nbsp;</td>
            <td class="smallText">&nbsp;<b><?php echo $values_name; ?></b>&nbsp;</td>
            <td class="smallText">&nbsp;<b><?php echo $attributes_sort; ?></b>&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<b><?php echo $attributes_values["options_values_price"]; ?></b>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<b><?php echo $attributes_values["price_prefix"]; ?></b>&nbsp;</td>
<?php // BOF SPPC attributes hide for groups mod ?>
            <td align="center" class="smallText"><?php echo $hide_info = tep_get_hide_info($customers_groups, $attributes_values['attributes_hide_from_groups']); ?></td>
<?php // EOF SPPC attributes hide for groups mod ?>
            <td align="center" class="smallText">&nbsp;<b><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_attribute&attribute_id=' . $HTTP_GET_VARS['attribute_id'] . '&' . $page_info) . '">'; ?><?php echo tep_image_button('button_confirm.png', IMAGE_CONFIRM); ?></a>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, $page_info, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.png', IMAGE_CANCEL); ?></a>&nbsp;</b></td>
<?php
    } else {
?>
            <td class="smallText">&nbsp;<?php echo $attributes_values["products_attributes_id"]; ?>&nbsp;</td>
            <td class="smallText">&nbsp;<?php echo $products_name_only; ?>&nbsp;</td>
            <td class="smallText">&nbsp;<?php echo $options_name; ?>&nbsp;</td>
            <td class="smallText">&nbsp;<?php echo $values_name; ?>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<?php echo $attributes_sort; ?>&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<?php echo $attributes_values["options_values_price"]; ?>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<?php echo $attributes_values["price_prefix"]; ?>&nbsp;</td>
<?php // BOF SPPC attributes hide for groups mod with button for pop-up window for group prices and hide ?>
            <td align="center" class="smallText"><?php echo $hide_info = tep_get_hide_info($customers_groups, $attributes_values['attributes_hide_from_groups']); ?></td>
            <td align="center" class="smallText">&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=update_attribute&attribute_id=' . $attributes_values['products_attributes_id'] . '&attribute_page=' . $attribute_page, 'NONSSL') . '">'; ?><?php echo tep_image_button('button_edit.png', IMAGE_UPDATE); ?></a>&nbsp;&nbsp;<?php echo '<a href="javascript:void(0)" onmouseover="window.status=\'' . TEXT_MOUSE_OVER_GROUP_PRICES . '\';return true;" onmouseout="window.status=\'\'; return true;" onclick="window.open(\'' . tep_href_link(FILENAME_ATTRIBUTES_GROUPS, 'attribute_id=' . $attributes_values['products_attributes_id'], 'NONSSL') . '\',\'' . NAME_WINDOW_ATTRIBUTES_GROUPS_POPUP . '\',\'menubar=yes,resizable=yes,scrollbars=yes,status=no,location=no,width=500,height=350\');return false">' . tep_image_button('button_group_prices.png', TEXT_GROUP_PRICES); ?></a>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=delete_product_attribute&attribute_id=' . $attributes_values['products_attributes_id'] . '&attribute_page=' . $attribute_page, 'NONSSL') , '">'; ?><?php echo tep_image_button('button_delete.png', IMAGE_DELETE); // EOF SPPC attributes hide for groups mod
						?></a>&nbsp;</td>
<?php
    }
    $max_attributes_id_query = tep_db_query("select max(products_attributes_id) + 1 as next_id from " . TABLE_PRODUCTS_ATTRIBUTES);
    $max_attributes_id_values = tep_db_fetch_array($max_attributes_id_query);
    $next_id = $max_attributes_id_values['next_id'];
?>
          </tr>
<?php
  }
  if ($action != 'update_attribute') {
?>
          <tr>
            <td colspan="9"><?php echo tep_black_line(); ?></td>
          </tr>
          <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
            <td class="smallText">&nbsp;<?php echo $next_id; ?>&nbsp;</td>
      	    <td class="smallText">&nbsp;<select name="products_id">
<?php
    $products = tep_db_query("select p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . $languages_id . "' order by pd.products_name");
    while ($products_values = tep_db_fetch_array($products)) {
      echo '<option name="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '">' . $products_values['products_name'] . '</option>';
    } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="options_id">
<?php
    $options = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . $languages_id . "' order by products_options_name");
    while ($options_values = tep_db_fetch_array($options)) {
      echo '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
    } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="values_id">
<?php
    $values = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where language_id = '" . $languages_id . "' order by products_options_values_name");
    while ($values_values = tep_db_fetch_array($values)) {
      echo '<option name="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '">' . $values_values['products_options_values_name'] . '</option>';
    } 
?>
            </select>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<input type="text" name="attributes_sort" size="3">&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<input type="text" name="value_price" size="6">&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<input type="text" name="price_prefix" size="2" value="+">&nbsp;</td>
<?php // BOF SPPC ?>
						<td>&#160;</td>
<?php // EOF SPPC ?>
            <td align="center" class="smallText">&nbsp;<?php echo tep_image_submit('button_insert.png', IMAGE_INSERT); ?>&nbsp;</td>
          </tr>
<?php
      if (DOWNLOAD_ENABLED == 'true') {
        $products_attributes_maxdays  = DOWNLOAD_MAX_DAYS;
        $products_attributes_maxcount = DOWNLOAD_MAX_COUNT;
?>
          <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
            <td>&nbsp;</td>
            <td colspan="7">
              <table>
                <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
<?php
// BOF AlexStusio mod
?>
                  <td class="smallText"><b><?php echo TABLE_HEADING_DOWNLOAD; ?>&nbsp;</b></td>
                  <td class="smallText"><?php echo TABLE_TEXT_FILENAME; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_filename', $products_attributes_filename, 'size="15"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_DAYS; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxdays', $products_attributes_maxdays, 'size="5"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_COUNT; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxcount', $products_attributes_maxcount, 'size="5"'); ?>&nbsp;</td>
                </tr>
<?php
        if ( DOWNLOADS_CONTROLLER_FILEGROUP_STATUS == 'Yes' ) {
?>
                <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
                  <td class="smallText"></td>
                  <td class="smallText"><?php echo TABLE_TEXT_FILEGROUP; ?></td>
                  <td class="smallText">&nbsp;<select name="filegroup_id">
<?php
          $file_groups_query = tep_db_query("select * from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD_GROUPS . " where language_id = '" . (int)$languages_id . "' order by download_group_id");
          while ($file_groups = tep_db_fetch_array($file_groups_query)) {
            echo '<option name="' . TEXT_OPTION_FILEGROUP . '" value="' . $file_groups['download_group_id'] . '">' . $file_groups['download_group_name'] . '</option>';
          } 
?>
                  </select>&nbsp;</td>
                </tr>
<?php
        }
// EOF Super Download Shop v1.0 mod
?>
              </table>
            </td>
            <td>&nbsp;</td>
          </tr>
<?php
      } // end of DOWNLOAD_ENABLED section
?>
<?php
  }
?>
          <tr>
            <td colspan="9"><?php echo tep_black_line(); ?></td>
          </tr>
        </table></form></td>
      </tr>
<!-- BOE: Attribute Sort with Clone Tool //-->
<?php if (ATTRIBUTES_CLONE_OPTION == 'single') { ?>
    <tr>
      <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '20'); ?></td>
    </tr>
	<tr><td><?php echo '<form name="clone" action="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=clone_attributes', 'NONSSL') . '" method="post">'; ?>
	<table>
	<!-- Data Start -->
        <tr><td class="pageHeading"><?php echo HEADING_TITLE_CLONE ?></td></tr>
	<tr>
	<td class="smallText"><?php echo TABLE_TEXT_FROM ?>
	<select name="clone_products_id_from">
	<?php
	$products = tep_db_query("select p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . $languages_id . "' order by pd.products_name");
	while ($products_values = tep_db_fetch_array($products)) {
	echo '<option name="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '">' . $products_values['products_name'] . '</option>';
	}
	?>
	</select></td>
	<td class="smallText"><?php echo TABLE_TEXT_TO ?>
	<select name="clone_products_id_to">
	<?php
	$products = tep_db_query("select p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . $languages_id . "' order by pd.products_name");
	while ($products_values = tep_db_fetch_array($products)) {
	echo '<option name="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '">' . $products_values['products_name'] . '</option>';
	}
	?>
	</select>
	</td><td><?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE); ?></td></tr>
	<tr><td></table>
	</td></tr>
<!-- EOE: Attribute Sort with Clone Tool //-->

<?php } else { ?>

<!-- BOE: Attribute Sort with Clone Tool //-->
     <tr>
       <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '20'); ?></td>
     </tr>
	<tr><td><?php echo '<form name="clone" action="' . tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'action=clone_attributes', 'NONSSL') . '" method="post">'; ?>
	<table>
	<!-- Data Start -->
        <tr><td class="pageHeading"><?php echo HEADING_TITLE_CLONE ?></td></tr>
	<tr>
	<td class="smallText"><?php echo TABLE_TEXT_FROM ?>
	<select name="clone_products_id_from">
	<?php
	$products = tep_db_query("select p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . $languages_id . "' order by pd.products_name");
	while ($products_values = tep_db_fetch_array($products)) {
	echo '<option name="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '">' . $products_values['products_name'] . '</option>';
	}
	?>
	</select></td>
	<td class="smallText"><?php echo TABLE_TEXT_TO ?>
	<select name="clone_products_id_to[]" multiple size="20">
	<?php
	$products = tep_db_query("select p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . $languages_id . "' order by pd.products_name");
	while ($products_values = tep_db_fetch_array($products)) {
	echo '<option name="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '">' . $products_values['products_name'] . '</option>';
	}
	?>
	</select>
	</td><td><?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE); ?></td></tr>
	<tr><td></table>
	</td></tr>
<?php } ?>
<!-- EOE: Attrubute Sort with Clone Tool //-->
    </table></td>
<!-- products_attributes_eof //-->
  </tr>
</table>
<!-- body_text_eof //-->
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
<?php function tep_get_hide_info($customers_groups, $attributes_hide_from_groups) {
  $hide_attr_from_groups_array = explode(',', $attributes_hide_from_groups);
  $hide_attr_from_groups_array = array_slice($hide_attr_from_groups_array, 1); // remove "@" from the array
  $attribute_hidden_from_string = '';
	$hide_info = '';
	if (LAYOUT_HIDE_FROM == '1') {
	      for ($i = 0; $i < count($customers_groups); $i++) {
		      if (in_array($customers_groups[$i]['customers_group_id'], $hide_attr_from_groups_array)) {
	        $attribute_hidden_from_string .= $customers_groups[$i]['customers_group_name'] . ', '; 
		      }
              } // end for ($i = 0; $i < count($customers_groups); $i++)
	      $attribute_hidden_from_string = rtrim($attribute_hidden_from_string); // remove space on the right
	      $attribute_hidden_from_string = substr($attribute_hidden_from_string,0,strlen($attribute_hidden_from_string) -1); // remove last comma
	      if (!tep_not_null($attribute_hidden_from_string)) { 
	      $attribute_hidden_from_string = TEXT_GROUPS_NONE; 
	      }
	      $attribute_hidden_from_string = TEXT_HIDDEN_FROM_GROUPS . $attribute_hidden_from_string;
				// if the string in the database field is @, everything will work fine, however tep_not_null
				// will not discover the associative array is empty therefore the second check on the value
	if (tep_not_null($hide_attr_from_groups_array) && tep_not_null($hide_attr_from_groups_array[0])) {
		  $hide_info = tep_image(DIR_WS_ICONS . 'file_icons/tick_black.gif', $attribute_hidden_from_string, 20, 16);
		} else {
		  $hide_info = tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', $attribute_hidden_from_string, 20, 16);
	  }
	} else {
		// default layout: icons for all groups
      for ($i = 0; $i < count($customers_groups); $i++) {
        if (in_array($customers_groups[$i]['customers_group_id'], $hide_attr_from_groups_array)) {
          $hide_info .= tep_image(DIR_WS_ICONS . 'file_icons/icon_tick.gif', $customers_groups[$i]['customers_group_name'], 11, 11) . '&nbsp;&nbsp;';
        } else {
          $hide_info .= tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', 11, 11) . '&nbsp;&#160;';
        }
      }
	}
	return $hide_info;
}
?>
