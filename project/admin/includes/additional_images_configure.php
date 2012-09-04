<?php //$Id: /catalog/admin/includes/additional_images_configure.php (1032) 

  require_once(str_replace(DIR_WS_INCLUDES, '', DIR_WS_LANGUAGES) . $language . '/' . basename(__FILE__));

  // this array is used for maintaining osCommerce configuration values
  $sort_order = 1;
  $configuration_array = array ();
  $configuration_array[] = 
    array ( 
      'group' => array ( 'configuration_group_title' => 'Additional Images',
                         'configuration_group_description' => 'Configuration Options for Additional Images',
                         'sort_order' => NULL,
                         'visible' => 1 ),
      'data'  => array (
           'ADDITIONAL_IMAGES_AUTO_CREATE'        => array ( 'configuration_title' => '<font color=green>Automatically create 3 image set</font>',
                                                             'configuration_value' => 'false',
                                                             'configuration_description' => 'When this is true, image thumbnails and medium images will be created when uploading product images in the osCommerce admin. When set to false, you may upload 3 image sets you created.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''true'', ''false'')," ),
           'ADDITIONAL_IMAGES_BACKGROUND_COLOR'   => array ( 'configuration_title' => '<font color=green>Background color</font>',
                                                             'configuration_value' => '',
                                                             'configuration_description' => 'When this is set, processed images will be proportionally sized and any space between the resulting size and the size set in the images configuration will be filled with this color ex: FFFFFF is white. Both width and height must be set in images config.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => NULL ),
           'ADDIMAGES_PREFILL_UPLOAD_DIRECTORY'   => array ( 'configuration_title' => '<font color=green>Pre-fill upload dir w/ Category names</font>',
                                                             'configuration_value' => 'true',
                                                             'configuration_description' => 'This option will fill the upload directory field when adding or editing products.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''true'', ''false'')," ),
           'ADDIMAGES_PREFILL_INITIAL'            => array ( 'configuration_title' => '<font color=green>Pre-fill starting with this sub-dir</font>',
                                                             'configuration_value' => 'products',
                                                             'configuration_description' => 'Use this sub-directory to start with when pre-filling the upload directory field in the product edit page.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => NULL ),
           'ADDIMAGES_RESTRICT_IMAGE_SIZE'        => array ( 'configuration_title' => '<font color=green>Use image size restrictions</font>',
                                                             'configuration_value' => 'false',
                                                             'configuration_description' => 'Restrict all product images to values in Configuration -> Images settings.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''true'', ''false'')," ),
           'ADDIMAGES_SHOW_ON_PRODUCT_INFO'       => array ( 'configuration_title' => 'Product Info: Show Additional Images',
                                                             'configuration_value' => 'true',
                                                             'configuration_description' => 'Show additional images on Product Info page.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''true'', ''false'')," ),
           'ADDIMAGES_MENU_LOCATION'              => array ( 'configuration_title' => 'Product Info: Product Image Behavior',
                                                             'configuration_value' => 'popup',
                                                             'configuration_description' => 'If set to popup, links on images will launch popup window. If set to product_info, the main parent image will display full size on the Product Info page with a thumbnail menu of additional images.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''popup'', ''product_info'')," ),
           'ENABLE_LIGHTBOX'                      => array ( 'configuration_title' => 'Product Info: Lightbox effect',
                                                             'configuration_value' => 'false',
                                                             'configuration_description' => 'Enable the lightbox effect support for the Fancy lightbox popup contribution. http://addons.oscommerce.com/info/5532  This setting should be false if Image Behavior is product_info',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''true'', ''false'')," ),
           'ADDIMAGES_GROUP_WITH_PARENT'          => array ( 'configuration_title' => 'Product Info: Group parent with sub-images',
                                                             'configuration_value' => 'false',
                                                             'configuration_description' => 'Set to true to group all images with together in one block of images. If false, the main parent image is displayed in the normal osCommerce way and any additional images are shown in their own group.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''true'', ''false'')," ),
           'ADDIMAGES_RESTRICT_PARENT'            => array ( 'configuration_title' => 'Product Info: Restrict parent image size',
                                                             'configuration_value' => 'true',
                                                             'configuration_description' => 'Restrict parent image size to values in Configuration -> Images settings.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''true'', ''false'')," ),
           'ADDIMAGES_PARENT_IMAGE_ALIGNMENT'     => array ( 'configuration_title' => 'Product Info: Parent product image alignment',
                                                             'configuration_value' => 'right',
                                                             'configuration_description' => 'Align the main (parent) product image about the description. Only applies when the Group parent with sub-images is false.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''left'', ''right'', ''center'')," ),
           'ADDIMAGES_TABLE_ALIGNMENT'            => array ( 'configuration_title' => 'Product Info: Table alignment',
                                                             'configuration_value' => 'center',
                                                             'configuration_description' => 'Align Pics table to the left or to the right of the products description.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''left'', ''right'', ''center'')," ),
           'ADDIMAGES_TABLE_LOCATION'             => array ( 'configuration_title' => 'Product Info: Table location',
                                                             'configuration_value' => 'below',
                                                             'configuration_description' => 'Align Pics table to the sides, above or below description.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''sides'', ''above'', ''below'')," ),
           'ADDIMAGES_NUMBER_OF_COLS'             => array ( 'configuration_title' => 'Product Info: Number of columns',
                                                             'configuration_value' => '3',
                                                             'configuration_description' => 'Number of columns to display.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => NULL ),
           'ADDIMAGES_NUMBER_OF_ROWS'             => array ( 'configuration_title' => 'Product Info: Number of rows',
                                                             'configuration_value' => '2',
                                                             'configuration_description' => 'Number of rows to display.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => NULL ),


           'ADDIMAGES_POPUP_SHOW_ON_POPUP'        => array ( 'configuration_title' => 'Popup: Show Thumbnail Menu',
                                                             'configuration_value' => 'true',
                                                             'configuration_description' => 'Show thumbnail menu on popup or product info page depending on Show on Product Info page option above.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''true'', ''false'')," ),
           'ADDIMAGES_POPUP_GROUP_WITH_PARENT'    => array ( 'configuration_title' => '<font color=blue>Thumb Menu:</font> Show parent image',
                                                             'configuration_value' => 'true',
                                                             'configuration_description' => 'Set to true to group all images with parent (original) image and display all images together.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''true'', ''false'')," ),
           'ADDIMAGES_POPUP_RESTRICT_IMAGE_SIZE'  => array ( 'configuration_title' => '<font color=blue>Thumb Menu:</font> Use image size restrictions',
                                                             'configuration_value' => 'false',
                                                             'configuration_description' => 'Restrict all product images to values in Configuration -> Images settings.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''true'', ''false'')," ),
           'ADDIMAGES_POPUP_TABLE_ALIGNMENT'      => array ( 'configuration_title' => '<font color=blue>Thumb Menu:</font> Table alignment',
                                                             'configuration_value' => 'center',
                                                             'configuration_description' => 'Align Pics menu to the left or to the right of the products description on popup menu.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''left'', ''right'', ''center'')," ),
           'ADDIMAGES_POPUP_TABLE_LOCATION'       => array ( 'configuration_title' => '<font color=blue>Thumb Menu:</font> Table location',
                                                             'configuration_value' => 'below',
                                                             'configuration_description' => 'Align Pics menu to the sides, above or below popup image on popup menu.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''sides'', ''above'', ''below'')," ),
           'ADDIMAGES_POPUP_NUMBER_OF_COLS'       => array ( 'configuration_title' => '<font color=blue>Thumb Menu:</font> Number of columns',
                                                             'configuration_value' => '3',
                                                             'configuration_description' => 'Number of columns to display on popup menu.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => NULL ),
           'ADDIMAGES_POPUP_NUMBER_OF_ROWS'       => array ( 'configuration_title' => '<font color=blue>Thumb Menu:</font> Number of rows',
                                                             'configuration_value' => '2',
                                                             'configuration_description' => 'Number of rows to display on popup menu.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => NULL ),
           'ADDIMAGES_ADD_WATERMARK'              => array ( 'configuration_title' => '<font color=green>Watermark:</font> Add watermark to images',
                                                             'configuration_value' => 'false',
                                                             'configuration_description' => 'Add watermark to your product images?',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''true'', ''false'')," ),
           'ADDIMAGES_WATERMARK_IMAGE'            => array ( 'configuration_title' => '<font color=green>Watermark:</font> Watermark image file',
                                                             'configuration_value' => '',
                                                             'configuration_description' => 'Watermark image file. Should be placed in your /catalog/admin/images/ folder as defined in your configure.php.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => NULL ),
           'ADDIMAGES_WATERMARK_TRANSPARENCY'     => array ( 'configuration_title' => '<font color=green>Watermark:</font> Opacity',
                                                             'configuration_value' => '100',
                                                             'configuration_description' => 'Opacity for the watermark.  0 = no opacity (transparent). 100 = opaque (completely visible).',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => NULL ),
           'ADDIMAGES_WATERMARK_SKIP_THUMB'       => array ( 'configuration_title' => '<font color=green>Watermark:</font> Skip thumbnail',
                                                             'configuration_value' => 'true',
                                                             'configuration_description' => 'Set to true if you wish to avoid adding watermark to thumb image. Watermark will be added to display and popup image sizes only.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''true'', ''false'')," ),
           'ADDIMAGES_WATERMARK_HORIZONTAL_ALIGN' => array ( 'configuration_title' => '<font color=green>Watermark:</font> Horizontal alignment',
                                                             'configuration_value' => 'left',
                                                             'configuration_description' => 'Please select the horizontal alignment you desire.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''left'', ''center'', ''right'')," ),
           'ADDIMAGES_WATERMARK_VERTICAL_ALIGN'   => array ( 'configuration_title' => '<font color=green>Watermark:</font> Vertical alignment',
                                                             'configuration_value' => 'bottom',
                                                             'configuration_description' => 'Please select the vertical alignment you desire.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "tep_cfg_select_option(array(''top'', ''middle'', ''bottom'')," ),
           'ADDIMAGES_WATERMARK_OFFSET'           => array ( 'configuration_title' => '<font color=green>Watermark:</font> Watermark image offset (as a percent)',
                                                             'configuration_value' => '10',
                                                             'configuration_description' => 'Place the watermark this percentage distance from the edge of the product image. Do Not enter a % sign. Enter 10 here, the watermark will be placed 10px from the edge of an average 100px dimensioned image and 40px from the edge of a 400px image.',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => NULL ) /*  ,
           '' => array ( 'configuration_title' => '',
                                                             'configuration_value' => '',
                                                             'configuration_description' => '',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => "" )    */
                       )
          );


  $sort_order = 1;
  $configuration_array[] = 
    array ( 
      'group' => array ( 'configuration_group_title' => 'Images',
                         'configuration_group_description' => 'The pixel width of small images',
                        /* 'sort_order' => 4, */
                         'visible' => 1 ),
      'data'  => array (
           'DISPLAY_IMAGE_WIDTH'                  => array ( 'configuration_title' => 'Display Image Width',
                                                             'configuration_value' => '200',
                                                             'configuration_description' => 'The pixel width of <b>product info</b> images. To show the original width image, leave blank the field!',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => NULL ),
           'DISPLAY_IMAGE_HEIGHT'                 => array ( 'configuration_title' => 'Display Image Height',
                                                             'configuration_value' => '',
                                                             'configuration_description' => 'The pixel height of <b>product info</b> images. To show the original width image, leave blank the field!',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => NULL ),
           'POPUP_IMAGE_WIDTH'                    => array ( 'configuration_title' => 'Popup Image Width',
                                                             'configuration_value' => '',
                                                             'configuration_description' => 'The pixel width of popup images. To show the original width image, leave blank the field!',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => NULL ),
           'POPUP_IMAGE_HEIGHT'                   => array ( 'configuration_title' => 'Popup Image Height',
                                                             'configuration_value' => '',
                                                             'configuration_description' => 'The pixel height of popup images. To show the original height image, leave blank the field!',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => NULL ) /*  ,
           '' => array ( 'configuration_title' => '',
                                                             'configuration_value' => '',
                                                             'configuration_description' => '',
                                                             'sort_order' => strval($sort_order++),
                                                             'use_function' => NULL,
                                                             'set_function' => '' )    */
                       )
          );

  // this array is used for creating new tables
  $tables_array = array();
  $tables_array [] = array ( 'tablename' => 'additional_images',
                             'create' => "CREATE TABLE additional_images (
                                            additional_images_id int(11) NOT NULL auto_increment,
                                            products_id int(11) NOT NULL default '0',
                                            images_description varchar(64) default NULL,
                                            thumb_images varchar(255) default NULL,
                                            medium_images varchar(255) default NULL,
                                            popup_images varchar(255) default NULL,
                                            PRIMARY KEY  (additional_images_id),
                                            KEY products_id (products_id)
                                           );",
                             'remove' => "DROP TABLE IF EXISTS additional_images;" );


  // this array is used for altering table that already exist in the default osC shop
  $table_mods_array = array();
  $table_mods_array [] = array ( 'tablename' => 'products',
                                 'columnname' => 'products_image_med',
                                 'create' => "ALTER TABLE products ADD products_image_med VARCHAR(255) default NULL AFTER products_image;",
                                 'remove' => "ALTER TABLE products DROP products_image_med" );
  $table_mods_array [] = array ( 'tablename' => 'products',
                                 'columnname' => 'products_image_pop',
                                 'create' => "ALTER TABLE products ADD products_image_pop VARCHAR(255) default NULL AFTER products_image_med;",
                                 'remove' => "ALTER TABLE products DROP products_image_pop" );
  $table_mods_array [] = array ( 'tablename' => 'products',
                                 'columnname' => 'products_image_description',
                                 'create' => "ALTER TABLE products ADD products_image_description VARCHAR(64) default NULL AFTER products_image_pop;",
                                 'remove' => "ALTER TABLE products DROP products_image_description" );
  // table mod added to catch earlier versions of Additional Images
  $table_mods_array [] = array ( 'tablename' => 'additional_images',
                                 'columnname' => 'thumb_images',
                                 'create' => "ALTER TABLE additional_images ADD thumb_images VARCHAR(255) default NULL AFTER images_description;",
                                 'remove' => "ALTER TABLE additional_images DROP thumb_images" );




//
//
// function that checks the status of each item.
//
if (!function_exists('db_update_status')) {
  function db_update_status($configuration_array = array(), $tables_array = array(), $table_mods_array = array()) {

	$needs_update = false;
	$found_one = false;
	$status_messages = '';

	foreach ($configuration_array as $tkey => $configuration) {
	  $configuration_group_query = tep_db_query('select configuration_group_id from ' . TABLE_CONFIGURATION_GROUP . " where configuration_group_title = '" . $configuration['group']['configuration_group_title'] . "' limit 1");
	  if (tep_db_num_rows($configuration_group_query) > 0) {
		$status_messages .= '<br><font color=green>'.sprintf(TEXT_CONFIG_GROUP_EXIST, $configuration['group']['configuration_group_title']).'</font><br>&nbsp;&nbsp;<font color=gray>' . TEXT_CHECKING_FOR_ITEMS . '</font><br>'."\n";
		foreach ($configuration['data'] as $configuration_key => $configuration_data) {
		  $configuration_query = tep_db_query('select configuration_id, configuration_title, configuration_value, configuration_description, use_function, set_function from ' . TABLE_CONFIGURATION . " where configuration_key = '" . $configuration_key . "' limit 1");
		  if (tep_db_num_rows($configuration_query) > 0) {
			$status_messages .= '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_CONFIG_KEY_EXIST, $configuration_key).'</font><br>'."\n";
			$found_one = true;
		  } else {
			$status_messages .= '&nbsp;&nbsp;<font color=red>'.sprintf(TEXT_CONFIG_KEY_NOT_EXIST, $configuration_key).'</font><br>'."\n";
			$needs_update = true;
		  }
		  tep_db_free_result($configuration_query);
		}
	  } else {
		$status_messages .= '<font color=red>'.sprintf(TEXT_CONFIG_GROUP_NOT_EXIST, $configuration['group']['configuration_group_title']).'</font><br>'."\n";
		$needs_update = true;
	  }
	  tep_db_free_result($configuration_group_query);
	}

	$status_messages .= '<br><font color=gray>'.TEXT_CHECKING_FOR_TABLES.'</font><br>'."\n";
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
			$status_messages .= '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_TABLE_FOUND, $tables['tablename']).'</font><br>'."\n";
			$found_one = true;
		  } else {
			$status_messages .= '&nbsp;&nbsp;<font color=red>'.sprintf(TEXT_TABLE_NOT_FOUND, $tables['tablename']).'</font><br>'."\n";
			$needs_update = true;
		  }
		}
		tep_db_free_result($table_query);
	  }
	} else {
	  $status_messages .= '&nbsp;&nbsp;<font color=gray>'.TEXT_NO_TABLES.'</font><br>'."\n";
	}

	$status_messages .= '<br><font color=gray>'.TEXT_CHECKING_FOR_COLUMNS.'</font><br>'."\n";
	if (sizeof($table_mods_array) > 0) {
	  foreach ($table_mods_array as $tkey => $table_mods) {

		// check for table before checking for column
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
			
			// table found, check for the column
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
				$status_messages .= '&nbsp;&nbsp;<font color=green>'.sprintf(TEXT_COLUMN_FOUND, $table_mods['columnname'], $table_mods['tablename']).'</font><br>'."\n";
				$found_one = true;
			  } else {
				$status_messages .= '&nbsp;&nbsp;<font color=red>'.sprintf(TEXT_COLUMN_NOT_FOUND, $table_mods['columnname'], $table_mods['tablename']).'</font><br>'."\n";
				$needs_update = true;
			  }
			}
			tep_db_free_result($columns_query);
			
		  } else {
			$status_messages .= '&nbsp;&nbsp;<font color=red>'.sprintf(TEXT_TABLE_NOT_FOUND_FOR_COLUMN, $table_mods['tablename']).'</font><br>'."\n";
			$needs_update = true;
		  }
		}
		tep_db_free_result($table_query);
	  }
	} else {
	  $status_messages .= '&nbsp;&nbsp;<font color=gray>'.TEXT_NO_COLUMNS.'</font><br>'."\n";
	}

	return array ($needs_update, $found_one, $status_messages);

  }
}

?>