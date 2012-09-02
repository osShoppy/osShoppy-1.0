<?php //$Id: /catalog/admin/categories.php (part_1) (osS)
/*
(01)---> contri: admin acces level account(1359)/steps-16\ 3on.php 13on.tpl
(02)---> contri: product tabs(0716)/steps-19\ 9on.php 13on.tpl
(03)---> contri: activate inactivate category (6462)/steps-9\ 2on.php 7on.tpl
(03)---> contri: header tags seo(1359)/steps-18\ 7 on.php 11 on.tpl
(04)---> contri: tntpost-f(0000)/steps-9\ 3 on.php 6 on.tpl
(05)---> contri: rss feed(0000)/steps-11\
(06)---> contri: related products(0000)/steps-2\
(07)---> contri: dangling carrot(0000)/steps-5\
(08)---> contri: qtpro(0000)/steps-5\
(09)---> contri: attribute on categories page(0000)/steps-3\
(10)---> contri: quotes(0000)/steps-7\ 2 on.php 5 on.tpl
(11)---> contri: ultimate seo url(0000)/steps-1\ 1 on.php
(12)---> contri: additional images(0000)/steps-19\ 9 on.php 10 on.tpl
(13)---> contri: os6tm banner manager(2511)/steps-4\ 1 on.php 3 on.tpl
(14)---> contri: seperate pricing per customer(0716)/steps-5\ 3 on.php 2 on.tpl
(15)---> contri: qpbpp for sppc(3309)/steps-21\ 6 on.php 15 on.tpl
*/

  require('includes/application_top.php');

// bof: Additional Images
  require(DIR_WS_CLASSES . 'alterimage.php');
  require(DIR_WS_FUNCTIONS . 'additional_images.php');
// eof: Additional Images

// attribute on categories page - &action=new_product 
  if (file_exists(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCTS_ATTRIBUTES)) {
    include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_PRODUCTS_ATTRIBUTES);
  }

// bof: qtpro /step-1(5)\
// create the product investigation for this product that are used in this page.
  $product_investigation = qtpro_doctor_investigate_product($HTTP_GET_VARS['pID']);
// eof: qtpro /step-1(5)\
  
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

// bof: qpbpp for sppc /step-1(23)\
// include the admin version of price formatter for the price breaks contribution
  require(DIR_WS_CLASSES . 'PriceFormatterAdmin.php');
  $pf = new PriceFormatter;
// eof: qpbpp for sppc /step-1(23)\

  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');
// bof: admin acces level account /step-1(16)\
  	$admin_access_query = tep_db_query("select admin_groups_id, admin_cat_access, admin_right_access from " . TABLE_ADMIN . " where admin_id=" . $login_id);
	$admin_access_array = tep_db_fetch_array($admin_access_query);
	$admin_groups_id = $admin_access_array['admin_groups_id'];
	$admin_cat_access = $admin_access_array['admin_cat_access'];
	$admin_cat_access_array_cats = explode(",",$admin_cat_access);
	$admin_right_access = $admin_access_array['admin_right_access'];
// eof: admin acces level account /Step-1(16)\
  if (tep_not_null($action)) {
	// Ultimate SEO url's 5 PRO
    // If the action will affect the cache entries
    if ( $action == 'insert' || $action == 'update' || $action == 'setflag' ) {
      tep_reset_cache_data_usu5( 'reset' );
    }
	switch ($action) {
      case 'setflag':
        if ( ($HTTP_GET_VARS['flag'] == '0') || ($HTTP_GET_VARS['flag'] == '1') ) {
          if (isset($HTTP_GET_VARS['pID'])) {
            tep_set_product_status($HTTP_GET_VARS['pID'], $HTTP_GET_VARS['flag']);
          }

          if (USE_CACHE == 'true') {
            tep_reset_cache_block('categories');
            tep_reset_cache_block('also_purchased');
          }
        }

        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $HTTP_GET_VARS['cPath'] . '&pID=' . $HTTP_GET_VARS['pID']));
        break;
		// rss quick set button
		// catching and setting the rss status
 		case 'setrss':
			if($HTTP_GET_VARS['rss'] == '0' || $HTTP_GET_VARS['rss'] == '1'){
				if(isset($HTTP_GET_VARS['pID'])){
					tep_set_product_rss_status($HTTP_GET_VARS['pID'], $HTTP_GET_VARS['rss']);
				}
			}
			break; 
// bof: activate inactivate category /Step-1(9)\
      case 'setflagcateg';
        if ( ($HTTP_GET_VARS['flag'] == '0') || ($HTTP_GET_VARS['flag'] == '1') ) {
          if (isset($HTTP_GET_VARS['cID'])) {
            tep_db_query("update " . TABLE_CATEGORIES . " set status_categ = '" . (int)$HTTP_GET_VARS['flag'] . "', last_modified = now() where categories_id = '" . (int)$HTTP_GET_VARS['cID'] . "'");
          }
          if (USE_CACHE == 'true') {
            tep_reset_cache_block('categories');
            tep_reset_cache_block('also_purchased');
          }
        }
        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $HTTP_GET_VARS['cPath'] . '&cID=' . $HTTP_GET_VARS['cID']));
        break;
// eof: activate inactivate category /Step-1(9)\
      case 'insert_category':
      case 'update_category':
        if (isset($HTTP_POST_VARS['categories_id'])) $categories_id = tep_db_prepare_input($HTTP_POST_VARS['categories_id']);
        $sort_order = tep_db_prepare_input($HTTP_POST_VARS['sort_order']);
// bof: activate inactivate category /Step-2(9)\
        $status_categ = tep_db_prepare_input($HTTP_POST_VARS['status_categ']);

        $sql_data_array = array('sort_order' => (int)$sort_order,
                                'status_categ' => (int)$status_categ);
// eof: activate inactivate category /Step-2(9)\
        if ($action == 'insert_category') {
          $insert_sql_data = array('parent_id' => $current_category_id,
                                   'date_added' => 'now()');

          $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

          tep_db_perform(TABLE_CATEGORIES, $sql_data_array);

          $categories_id = tep_db_insert_id();
// bof: admin acces level account /Step-2(16)\
	if (in_array("ALL",$admin_cat_access_array_cats)== false) {
	  array_push($admin_cat_access_array_cats,$categories_id);
	  $admin_cat_access = implode(",",$admin_cat_access_array_cats);
          $sql_data_array = array('admin_cat_access' => tep_db_prepare_input($admin_cat_access));
          tep_db_perform(TABLE_ADMIN, $sql_data_array, 'update', 'admin_id = \'' . $login_id . '\'');
        }
// eof: admin acces level account /Step-2(16)\
        } elseif ($action == 'update_category') {
          $update_sql_data = array('last_modified' => 'now()');

          $sql_data_array = array_merge($sql_data_array, $update_sql_data);

          tep_db_perform(TABLE_CATEGORIES, $sql_data_array, 'update', "categories_id = '" . (int)$categories_id . "'");
        }

        $languages = tep_get_languages();
// bof: header tags seo /Step-1(18)\
/* original
		  for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          $categories_name_array = $HTTP_POST_VARS['categories_name'];

          $language_id = $languages[$i]['id'];

          $sql_data_array = array('categories_name' => tep_db_prepare_input($categories_name_array[$language_id]));
*/// original_end
for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          $categories_name_array = $HTTP_POST_VARS['categories_name'];

          $categories_htc_title_array = $HTTP_POST_VARS['categories_htc_title_tag'];
          $categories_htc_desc_array = $HTTP_POST_VARS['categories_htc_desc_tag'];
          $categories_htc_keywords_array = $HTTP_POST_VARS['categories_htc_keywords_tag'];
          $categories_htc_description_array = $HTTP_POST_VARS['categories_htc_description'];

          $language_id = $languages[$i]['id'];

          $sql_data_array = array('categories_name' => tep_db_prepare_input($categories_name_array[$language_id]),
           'categories_htc_title_tag' => (tep_not_null($categories_htc_title_array[$language_id]) ? tep_db_prepare_input(strip_tags($categories_htc_title_array[$language_id])) :  tep_db_prepare_input(strip_tags($categories_name_array[$language_id]))),
           'categories_htc_desc_tag' => (tep_not_null($categories_htc_desc_array[$language_id]) ? tep_db_prepare_input($categories_htc_desc_array[$language_id]) :  tep_db_prepare_input($categories_name_array[$language_id])),
           'categories_htc_keywords_tag' => (tep_not_null($categories_htc_keywords_array[$language_id]) ? tep_db_prepare_input(strip_tags($categories_htc_keywords_array[$language_id])) :  tep_db_prepare_input(strip_tags($categories_name_array[$language_id]))),
           'categories_htc_description' => tep_db_prepare_input($categories_htc_description_array[$language_id]));
// eof: header tags seo /Step-1(18)\

          if ($action == 'insert_category') {
            $insert_sql_data = array('categories_id' => $categories_id,
                                     'language_id' => $languages[$i]['id']);

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            tep_db_perform(TABLE_CATEGORIES_DESCRIPTION, $sql_data_array);
          } elseif ($action == 'update_category') {
            tep_db_perform(TABLE_CATEGORIES_DESCRIPTION, $sql_data_array, 'update', "categories_id = '" . (int)$categories_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
          }
        }

        $categories_image = new upload('categories_image');
        $categories_image->set_destination(DIR_FS_CATALOG_IMAGES);

        if ($categories_image->parse() && $categories_image->save()) {
          tep_db_query("update " . TABLE_CATEGORIES . " set categories_image = '" . tep_db_input($categories_image->filename) . "' where categories_id = '" . (int)$categories_id . "'");
        }

        if (USE_CACHE == 'true') {
          tep_reset_cache_block('categories');
          tep_reset_cache_block('also_purchased');
        }
// bof: header tags seo /Step-2(18)\
        if (HEADER_TAGS_ENABLE_CACHE != 'None') {
          require_once(DIR_WS_FUNCTIONS . 'header_tags.php');
          ResetCache_HeaderTags('index.php', 'c_' . $categories_id);
        }
// eof: header tags seo /Step-2(18)\
        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $categories_id));
        break;
      case 'delete_category_confirm':
        if (isset($HTTP_POST_VARS['categories_id'])) {
          $categories_id = tep_db_prepare_input($HTTP_POST_VARS['categories_id']);

// bof: KategorienAdmin / OLI 
        //$categories = tep_get_category_tree($categories_id, '', '0', '',true);
          $categories = tep_get_category_tree($categories_id, '', '0', '', '',true);
// eof: KategorienAdmin / OLI 
          $products = array();
          $products_delete = array();

          for ($i=0, $n=sizeof($categories); $i<$n; $i++) {
            $product_ids_query = tep_db_query("select products_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id = '" . (int)$categories[$i]['id'] . "'");

            while ($product_ids = tep_db_fetch_array($product_ids_query)) {
              $products[$product_ids['products_id']]['categories'][] = $categories[$i]['id'];
            }
          }

          reset($products);
          while (list($key, $value) = each($products)) {
            $category_ids = '';

            for ($i=0, $n=sizeof($value['categories']); $i<$n; $i++) {
              $category_ids .= "'" . (int)$value['categories'][$i] . "', ";
            }
            $category_ids = substr($category_ids, 0, -2);

            $check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$key . "' and categories_id not in (" . $category_ids . ")");
            $check = tep_db_fetch_array($check_query);
            if ($check['total'] < '1') {
              $products_delete[$key] = $key;
            }
          }

// removing categories can be a lengthy process
          tep_set_time_limit(0);
          for ($i=0, $n=sizeof($categories); $i<$n; $i++) {
            tep_remove_category($categories[$i]['id']);
          }

          reset($products_delete);
          while (list($key) = each($products_delete)) {
            tep_remove_product($key);
          }
        }

        if (USE_CACHE == 'true') {
          tep_reset_cache_block('categories');
          tep_reset_cache_block('also_purchased');
        }
// bof: header tags seo /Step-3(18)\
        if (HEADER_TAGS_ENABLE_CACHE != 'None') {
          require_once(DIR_WS_FUNCTIONS . 'header_tags.php');
          ResetCache_HeaderTags('index.php', 'c_' . $categories_id);
        }
// eof: header tags seo /Step-3(18)\
        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath));
        break;
      case 'delete_product_confirm':
        if (isset($HTTP_POST_VARS['products_id']) && isset($HTTP_POST_VARS['product_categories']) && is_array($HTTP_POST_VARS['product_categories'])) {
          $product_id = tep_db_prepare_input($HTTP_POST_VARS['products_id']);
          $product_categories = $HTTP_POST_VARS['product_categories'];

          for ($i=0, $n=sizeof($product_categories); $i<$n; $i++) {
            // bof: Additional Images
            // get image names from database
            $delimg_query = tep_db_query("select popup_images, medium_images, thumb_images from " . TABLE_ADDITIONAL_IMAGES . " where products_id = '" . (int)$product_id . "'");
            // delete image names from database
            tep_db_query("delete from " . TABLE_ADDITIONAL_IMAGES . " where products_id = '" . (int)$product_id . "'");
            // remove images from server if no other product requires then
            while ($delimg = tep_db_fetch_array($delimg_query)){
                if (tep_not_null($delimg['popup_images']) && file_exists(DIR_FS_CATALOG_IMAGES.$delimg['popup_images']) )
                  if ( !tep_is_image_still_used($delimg['popup_images']) )
                    if (!unlink (DIR_FS_CATALOG_IMAGES.$delimg['popup_images']))
                      $messageStack->add_session(ERROR_DEL_IMG_XTRA.$delimg['popup_images'], 'error');
                    else
                      $messageStack->add_session(SUCCESS_DEL_IMG_XTRA.$delimg['popup_images'], 'success');
                if (tep_not_null($delimg['medium_images']) && file_exists(DIR_FS_CATALOG_IMAGES.$delimg['medium_images']) )
                  if ( !tep_is_image_still_used($delimg['medium_images']) )
                    if (!unlink (DIR_FS_CATALOG_IMAGES.$delimg['medium_images']))
                      $messageStack->add_session(ERROR_DEL_IMG_XTRA.$delimg['medium_images'], 'error');
                    else
                      $messageStack->add_session(SUCCESS_DEL_IMG_XTRA.$delimg['medium_images'], 'success');
                if (tep_not_null($delimg['thumb_images']) && file_exists(DIR_FS_CATALOG_IMAGES.$delimg['thumb_images']) )
                  if ( !tep_is_image_still_used($delimg['thumb_images']) )
                    if (!unlink (DIR_FS_CATALOG_IMAGES.$delimg['thumb_images']))
                      $messageStack->add_session(ERROR_DEL_IMG_XTRA.$delimg['thumb_images'], 'error');
                    else
                      $messageStack->add_session(SUCCESS_DEL_IMG_XTRA.$delimg['thumb_images'], 'success');
				// delete original image	  
                if (tep_not_null($delimg['medium_images']) && file_exists(DIR_FS_CATALOG_IMAGES.substr($delimg['medium_images'],0,-5).substr($delimg['medium_images'],-4,4)) )
                  if ( !tep_is_image_still_used(substr($delimg['medium_images'],0,-5).substr($delimg['medium_images'],-4,4)) )
                    if (!unlink (DIR_FS_CATALOG_IMAGES.substr($delimg['medium_images'],0,-5).substr($delimg['medium_images'],-4,4)))
                      $messageStack->add_session(ERROR_DEL_IMG_XTRA.substr($delimg['medium_images'],0,-5).substr($delimg['medium_images'],-4,4), 'error');
                    else
                      $messageStack->add_session(SUCCESS_DEL_IMG_XTRA.substr($delimg['medium_images'],0,-5).substr($delimg['medium_images'],-4,4), 'success');
            }
            // eof: Additional Images
            tep_db_query("delete from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$product_id . "' and categories_id = '" . (int)$product_categories[$i] . "'");
            // bof Separate Pricing Per Customer
            tep_db_query("delete from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . tep_db_input($product_id) . "' ");
            // EOF Separate Pricing Per Customer
          }
// bof: qpbpp for sppc /step-2(23)\
            tep_db_query("delete from " . TABLE_PRODUCTS_PRICE_BREAK . " where products_id = '" . (int)$product_id . "'");
// eof: qpbpp for sppc /step-2(23)\

          $product_categories_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$product_id . "'");
          $product_categories = tep_db_fetch_array($product_categories_query);

          if ($product_categories['total'] == '0') {
            tep_remove_product($product_id);
          }
        /* Optional Related Products (ORP) */
          tep_db_query("delete from " . TABLE_PRODUCTS_RELATED_PRODUCTS . " where pop_products_id_master = '" . (int)$product_id . "'");
          tep_db_query("delete from " . TABLE_PRODUCTS_RELATED_PRODUCTS . " where pop_products_id_slave = '" . (int)$product_id . "'");
        //ORP: end
        }

        if (USE_CACHE == 'true') {
          tep_reset_cache_block('categories');
          tep_reset_cache_block('also_purchased');
        }
// bof: header tags seo /Step-4(18)\
        if (HEADER_TAGS_ENABLE_CACHE != 'None') {
          require_once(DIR_WS_FUNCTIONS . 'header_tags.php');
          ResetCache_HeaderTags('product_info.php', 'p_' . $product_id);
        }
// eof: header tags seo /Step-4(18)\
        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath));
        break;
      case 'move_category_confirm':
        if (isset($HTTP_POST_VARS['categories_id']) && ($HTTP_POST_VARS['categories_id'] != $HTTP_POST_VARS['move_to_category_id'])) {
          $categories_id = tep_db_prepare_input($HTTP_POST_VARS['categories_id']);
          $new_parent_id = tep_db_prepare_input($HTTP_POST_VARS['move_to_category_id']);

          $path = explode('_', tep_get_generated_category_path_ids($new_parent_id));

          if (in_array($categories_id, $path)) {
            $messageStack->add_session(ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT, 'error');

            tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $categories_id));
          } else {
            tep_db_query("update " . TABLE_CATEGORIES . " set parent_id = '" . (int)$new_parent_id . "', last_modified = now() where categories_id = '" . (int)$categories_id . "'");

            if (USE_CACHE == 'true') {
              tep_reset_cache_block('categories');
              tep_reset_cache_block('also_purchased');
            }

            tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $new_parent_id . '&cID=' . $categories_id));
          }
        }

        break;
      case 'move_product_confirm':
        $products_id = tep_db_prepare_input($HTTP_POST_VARS['products_id']);
        $new_parent_id = tep_db_prepare_input($HTTP_POST_VARS['move_to_category_id']);

        $duplicate_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$products_id . "' and categories_id = '" . (int)$new_parent_id . "'");
        $duplicate_check = tep_db_fetch_array($duplicate_check_query);
        if ($duplicate_check['total'] < 1) tep_db_query("update " . TABLE_PRODUCTS_TO_CATEGORIES . " set categories_id = '" . (int)$new_parent_id . "' where products_id = '" . (int)$products_id . "' and categories_id = '" . (int)$current_category_id . "'");

        if (USE_CACHE == 'true') {
          tep_reset_cache_block('categories');
          tep_reset_cache_block('also_purchased');
        }

        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $new_parent_id . '&pID=' . $products_id));
        break;
      case 'insert_product':
      case 'update_product':
        if (isset($HTTP_POST_VARS['edit_x']) || isset($HTTP_POST_VARS['edit_y'])) {
          $action = 'new_product';
        } else {
//Product Tabs 2.0 Start-1
//bof UltraPics
// bof: MaxiDVD Added ULTRA IMAGES
            $image_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image='" . $HTTP_POST_VARS['products_previous_image'] . "'");
            $image_count = tep_db_fetch_array($image_count_query);
            if (($HTTP_POST_VARS['delete_image'] == 'yes') && ($image_count['total']<= '1')) {
                unlink(DIR_FS_CATALOG_IMAGES . $HTTP_POST_VARS['products_previous_image']);
            }
            $image_med_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image_med='" . $HTTP_POST_VARS['products_previous_image_med'] . "'");
            $image_med_count = tep_db_fetch_array($image_med_count_query);
            if (($HTTP_POST_VARS['delete_image_med'] == 'yes') && ($image_med_count['total']<= '1')) {
                unlink(DIR_FS_CATALOG_IMAGES . $HTTP_POST_VARS['products_previous_image_med']);
            }
            $image_lrg_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image_lrg='" . $HTTP_POST_VARS['products_previous_image_lrg'] . "'");
            $image_lrg_count = tep_db_fetch_array($image_lrg_count_query);
            if (($HTTP_POST_VARS['delete_image_lrg'] == 'yes') && ($image_lrg_count['total']<= '1')) {
                unlink(DIR_FS_CATALOG_IMAGES . $HTTP_POST_VARS['products_previous_image_lrg']);
            }
// MaxiDVD Added ULTRA Image SM - LG 1
            $image_sm_1_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image_sm_1='" . $HTTP_POST_VARS['products_previous_image_sm_1'] . "'");
            $image_sm_1_count = tep_db_fetch_array($image_sm_1_count_query);
            if (($HTTP_POST_VARS['delete_image_sm_1'] == 'yes') && ($image_sm_1_count['total']<= '1')) {
                unlink(DIR_FS_CATALOG_IMAGES . $HTTP_POST_VARS['products_previous_image_sm_1']);
            }
            $image_xl_1_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image_xl_1='" . $HTTP_POST_VARS['products_previous_image_xl_1'] . "'");
            $image_xl_1_count = tep_db_fetch_array($image_xl_1_count_query);
            if (($HTTP_POST_VARS['delete_image_xl_1'] == 'yes') && ($image_xl_1_count['total']<= '1')) {
                unlink(DIR_FS_CATALOG_IMAGES . $HTTP_POST_VARS['products_previous_image_xl_1']);
            }
// MaxiDVD Added ULTRA Image SM - LG 2
            $image_sm_2_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image_sm_2='" . $HTTP_POST_VARS['products_previous_image_sm_2'] . "'");
            $image_sm_2_count = tep_db_fetch_array($image_sm_2_count_query);
            if (($HTTP_POST_VARS['delete_image_sm_2'] == 'yes') && ($image_sm_1_count['total']<= '1')) {
                unlink(DIR_FS_CATALOG_IMAGES . $HTTP_POST_VARS['products_previous_image_sm_2']);
            }
            $image_xl_2_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image_xl_2='" . $HTTP_POST_VARS['products_previous_image_xl_2'] . "'");
            $image_xl_2_count = tep_db_fetch_array($image_xl_2_count_query);
            if (($HTTP_POST_VARS['delete_image_xl_2'] == 'yes') && ($image_xl_1_count['total']<= '1')) {
                unlink(DIR_FS_CATALOG_IMAGES . $HTTP_POST_VARS['products_previous_image_xl_2']);
            }
// MaxiDVD Added ULTRA Image SM - LG 3
            $image_sm_3_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image_sm_3='" . $HTTP_POST_VARS['products_previous_image_sm_3'] . "'");
            $image_sm_3_count = tep_db_fetch_array($image_sm_3_count_query);
            if (($HTTP_POST_VARS['delete_image_sm_3'] == 'yes') && ($image_sm_1_count['total']<= '1')) {
                unlink(DIR_FS_CATALOG_IMAGES . $HTTP_POST_VARS['products_previous_image_sm_3']);
            }
            $image_xl_3_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image_xl_3='" . $HTTP_POST_VARS['products_previous_image_xl_3'] . "'");
            $image_xl_3_count = tep_db_fetch_array($image_xl_3_count_query);
            if (($HTTP_POST_VARS['delete_image_xl_3'] == 'yes') && ($image_xl_1_count['total']<= '1')) {
                unlink(DIR_FS_CATALOG_IMAGES . $HTTP_POST_VARS['products_previous_image_xl_3']);
            }
// MaxiDVD Added ULTRA Image SM - LG 4
            $image_sm_4_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image_sm_4='" . $HTTP_POST_VARS['products_previous_image_sm_4'] . "'");
            $image_sm_4_count = tep_db_fetch_array($image_sm_4_count_query);
            if (($HTTP_POST_VARS['delete_image_sm_4'] == 'yes') && ($image_sm_1_count['total']<= '1')) {
                unlink(DIR_FS_CATALOG_IMAGES . $HTTP_POST_VARS['products_previous_image_sm_4']);
            }
            $image_xl_4_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image_xl_4='" . $HTTP_POST_VARS['products_previous_image_xl_4'] . "'");
            $image_xl_4_count = tep_db_fetch_array($image_xl_4_count_query);
            if (($HTTP_POST_VARS['delete_image_xl_4'] == 'yes') && ($image_xl_1_count['total']<= '1')) {
                unlink(DIR_FS_CATALOG_IMAGES . $HTTP_POST_VARS['products_previous_image_xl_4']);
            }
// MaxiDVD Added ULTRA Image SM - LG 5
            $image_sm_5_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image_sm_5='" . $HTTP_POST_VARS['products_previous_image_sm_5'] . "'");
            $image_sm_5_count = tep_db_fetch_array($image_sm_5_count_query);
            if (($HTTP_POST_VARS['delete_image_sm_5'] == 'yes') && ($image_sm_1_count['total']<= '1')) {
                unlink(DIR_FS_CATALOG_IMAGES . $HTTP_POST_VARS['products_previous_image_sm_5']);
            }
            $image_xl_5_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image_xl_5='" . $HTTP_POST_VARS['products_previous_image_xl_5'] . "'");
            $image_xl_5_count = tep_db_fetch_array($image_xl_5_count_query);
            if (($HTTP_POST_VARS['delete_image_xl_5'] == 'yes') && ($image_xl_1_count['total']<= '1')) {
                unlink(DIR_FS_CATALOG_IMAGES . $HTTP_POST_VARS['products_previous_image_xl_5']);
            }
// MaxiDVD Added ULTRA Image SM - LG 6
            $image_sm_6_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image_sm_6='" . $HTTP_POST_VARS['products_previous_image_sm_6'] . "'");
            $image_sm_6_count = tep_db_fetch_array($image_sm_6_count_query);
            if (($HTTP_POST_VARS['delete_image_sm_6'] == 'yes') && ($image_sm_1_count['total']<= '1')) {
                unlink(DIR_FS_CATALOG_IMAGES . $HTTP_POST_VARS['products_previous_image_sm_6']);
            }
            $image_xl_6_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image_xl_6='" . $HTTP_POST_VARS['products_previous_image_xl_6'] . "'");
            $image_xl_6_count = tep_db_fetch_array($image_xl_6_count_query);
            if (($HTTP_POST_VARS['delete_image_xl_6'] == 'yes') && ($image_xl_1_count['total']<= '1')) {
                unlink(DIR_FS_CATALOG_IMAGES . $HTTP_POST_VARS['products_previous_image_xl_6']);
            }
// eof: MaxiDVD Added ULTRA IMAGES
// eof UltraPics
// Product Tabs 2.0 End-1
          if (isset($HTTP_GET_VARS['pID'])) $products_id = tep_db_prepare_input($HTTP_GET_VARS['pID']);
          $products_date_available = tep_db_prepare_input($HTTP_POST_VARS['products_date_available']);

          $products_date_available = (date('Y-m-d') < $products_date_available) ? $products_date_available : 'null';

// bof: quotes /step-1(7)\
          $quotes_expire = tep_db_prepare_input($HTTP_POST_VARS['quotes_expire']);
          $quotes_expire = (date('Y-m-d') < $quotes_expire) ? $quotes_expire : 'null';
// eof: quotes /step-1(7)\
          $sql_data_array = array('products_quantity' => (int)tep_db_prepare_input($HTTP_POST_VARS['products_quantity']),
// bof: quotes /step-2(7)\
                                  'quotes_email_address' => tep_db_prepare_input($HTTP_POST_VARS['quotes_email_address']),
                                  'quotes_status' => tep_db_prepare_input($HTTP_POST_VARS['quotes_status']),
                                  'quotes_expire' => $quotes_expire,
                                  'quotes_id' => $quotes_id,
// eof: quotes /step-2(7)\
                                  'products_model' => tep_db_prepare_input($HTTP_POST_VARS['products_model']),
                                  'products_price' => tep_db_prepare_input($HTTP_POST_VARS['products_price']),
// bof: qpbpp for sppc /step-3(23)\
                                  'products_qty_blocks' => (($i = (int)tep_db_prepare_input($_POST['products_qty_blocks'][0])) < 1) ? 1 : $i,
                                  'products_min_order_qty' => (($min_i = (int)tep_db_prepare_input($_POST['products_min_order_qty'][0])) < 1) ? 1 : $min_i,
// eof: qpbpp for sppc /step-3(23)\
                                  'products_date_available' => $products_date_available,
                                  'products_weight' => (float)tep_db_prepare_input($HTTP_POST_VARS['products_weight']),
                                  'products_status' => tep_db_prepare_input($HTTP_POST_VARS['products_status']),
                                  'products_tax_class_id' => tep_db_prepare_input($HTTP_POST_VARS['products_tax_class_id']),
                                  'manufacturers_id' => tep_db_prepare_input($HTTP_POST_VARS['manufacturers_id']),
							      'products_to_rss' => tep_db_prepare_input($HTTP_POST_VARS['products_to_rss']),
							      'products_carrot' => ($HTTP_POST_VARS['products_carrot'] == 'on') ? 1 : 0,
// bof: tntpost-f /step-1(9)\
                                  'tnt_f_tr' => tep_db_prepare_input($HTTP_POST_VARS['tnt_f_tr']),
                                  'tnt_f_sb' => tep_db_prepare_input($HTTP_POST_VARS['tnt_f_sb']),
                                  'tnt_f_cs' => tep_db_prepare_input($HTTP_POST_VARS['tnt_f_cs']));
// eof: tntpost-f /step-1(9)\
// bof: qtpro /step-2(5)\
			if($product_investigation['has_tracked_options'] or $product_investigation['stock_entries_count'] > 0){
				//Do not modify the stock from this page if the product has database entries or has tracked options
				unset($sql_data_array['products_quantity']);
			}
// eof: qtpro /step-2(5)\

// Product Tabs 2.0 Start-2
//bof UltraPics
     if (($HTTP_POST_VARS['unlink_image'] == 'yes') or ($HTTP_POST_VARS['delete_image'] == 'yes')) {
      $sql_data_array['products_image'] = '';
     } else {
// eof UltraPics
// Product Tabs 2.0 End-2

          // bof: Additional Images
          /* old code:
          if (isset($HTTP_POST_VARS['products_image']) && tep_not_null($HTTP_POST_VARS['products_image']) && ($HTTP_POST_VARS['products_image'] != 'none')) {
            $sql_data_array['products_image'] = tep_db_prepare_input($HTTP_POST_VARS['products_image']);
          } */
          $sql_data_array['products_image_description'] = tep_db_prepare_input($HTTP_POST_VARS['products_image_description']);
          // get old image names to handle image maintenance
          $del_products_query = tep_db_query("select products_image, products_image_med, products_image_pop from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
          $del_products = tep_db_fetch_array($del_products_query);

          // set image names for SQL query
          if (isset($HTTP_POST_VARS['products_image']) && tep_not_null($HTTP_POST_VARS['products_image']) && ($HTTP_POST_VARS['products_image'] != 'none')) {
            if ($HTTP_POST_VARS['products_image'] != $del_products['products_image']) {
              $sql_data_array['products_image'] = tep_db_prepare_input($HTTP_POST_VARS['products_image']);
            } elseif (isset($HTTP_POST_VARS['delete_image_def']) && tep_not_null($HTTP_POST_VARS['delete_image_def']))  {
              tep_db_query("update " . TABLE_PRODUCTS . " set products_image = NULL where products_id = '" . (int)$products_id . "' limit 1");
            }
          }
          if (isset($HTTP_POST_VARS['products_image_med']) && tep_not_null($HTTP_POST_VARS['products_image_med']) && ($HTTP_POST_VARS['products_image_med'] != 'none')) {
            if ($HTTP_POST_VARS['products_image_med'] != $del_products['products_image_med']) {
              $sql_data_array['products_image_med'] = tep_db_prepare_input($HTTP_POST_VARS['products_image_med']);
            } elseif (isset($HTTP_POST_VARS['delete_image_med']) && tep_not_null($HTTP_POST_VARS['delete_image_med'])) {
              tep_db_query("update " . TABLE_PRODUCTS . " set products_image_med = NULL where products_id = '" . (int)$products_id . "' limit 1");
            }
          }
          if (isset($HTTP_POST_VARS['products_image_pop']) && tep_not_null($HTTP_POST_VARS['products_image_pop']) && ($HTTP_POST_VARS['products_image_pop'] != 'none')) {
            if ($HTTP_POST_VARS['products_image_pop'] != $del_products['products_image_pop']) {
              $sql_data_array['products_image_pop'] = tep_db_prepare_input($HTTP_POST_VARS['products_image_pop']);
            } elseif (isset($HTTP_POST_VARS['delete_image_pop']) && tep_not_null($HTTP_POST_VARS['delete_image_pop'])) {
              tep_db_query("update " . TABLE_PRODUCTS . " set products_image_pop = NULL where products_id = '" . (int)$products_id . "' limit 1");
            }
          }
          // eof: Additional Images

// Product Tabs 2.0 Start-3
//bof UltraPics
          }
       if (($HTTP_POST_VARS['unlink_image_med'] == 'yes') or ($HTTP_POST_VARS['delete_image_med'] == 'yes')) {
            $sql_data_array['products_image_med'] = '';
           } else {
          if (isset($HTTP_POST_VARS['products_image_med']) && tep_not_null($HTTP_POST_VARS['products_image_med']) && ($HTTP_POST_VARS['products_image_med'] != 'none')) {
            $sql_data_array['products_image_med'] = tep_db_prepare_input($HTTP_POST_VARS['products_image_med']);
          }
          }
       if (($HTTP_POST_VARS['unlink_image_lrg'] == 'yes') or ($HTTP_POST_VARS['delete_image_lrg'] == 'yes')) {
            $sql_data_array['products_image_lrg'] = '';
           } else {
          if (isset($HTTP_POST_VARS['products_image_lrg']) && tep_not_null($HTTP_POST_VARS['products_image_lrg']) && ($HTTP_POST_VARS['products_image_lrg'] != 'none')) {
            $sql_data_array['products_image_lrg'] = tep_db_prepare_input($HTTP_POST_VARS['products_image_lrg']);
          }
          }
       if (($HTTP_POST_VARS['unlink_image_sm_1'] == 'yes') or ($HTTP_POST_VARS['delete_image_sm_1'] == 'yes')) {
            $sql_data_array['products_image_sm_1'] = '';
           } else {
          if (isset($HTTP_POST_VARS['products_image_sm_1']) && tep_not_null($HTTP_POST_VARS['products_image_sm_1']) && ($HTTP_POST_VARS['products_image_sm_1'] != 'none')) {
            $sql_data_array['products_image_sm_1'] = tep_db_prepare_input($HTTP_POST_VARS['products_image_sm_1']);
          }
          }
       if (($HTTP_POST_VARS['unlink_image_xl_1'] == 'yes') or ($HTTP_POST_VARS['delete_image_xl_1'] == 'yes')) {
            $sql_data_array['products_image_xl_1'] = '';
           } else {
          if (isset($HTTP_POST_VARS['products_image_xl_1']) && tep_not_null($HTTP_POST_VARS['products_image_xl_1']) && ($HTTP_POST_VARS['products_image_xl_1'] != 'none')) {
            $sql_data_array['products_image_xl_1'] = tep_db_prepare_input($HTTP_POST_VARS['products_image_xl_1']);
          }
          }
       if (($HTTP_POST_VARS['unlink_image_sm_2'] == 'yes') or ($HTTP_POST_VARS['delete_image_sm_2'] == 'yes')) {
            $sql_data_array['products_image_sm_2'] = '';
           } else {
          if (isset($HTTP_POST_VARS['products_image_sm_2']) && tep_not_null($HTTP_POST_VARS['products_image_sm_2']) && ($HTTP_POST_VARS['products_image_sm_2'] != 'none')) {
            $sql_data_array['products_image_sm_2'] = tep_db_prepare_input($HTTP_POST_VARS['products_image_sm_2']);
          }
          }
       if (($HTTP_POST_VARS['unlink_image_xl_2'] == 'yes') or ($HTTP_POST_VARS['delete_image_xl_2'] == 'yes')) {
            $sql_data_array['products_image_xl_2'] = '';
           } else {
          if (isset($HTTP_POST_VARS['products_image_xl_2']) && tep_not_null($HTTP_POST_VARS['products_image_xl_2']) && ($HTTP_POST_VARS['products_image_xl_2'] != 'none')) {
            $sql_data_array['products_image_xl_2'] = tep_db_prepare_input($HTTP_POST_VARS['products_image_xl_2']);
          }
          }
       if (($HTTP_POST_VARS['unlink_image_sm_3'] == 'yes') or ($HTTP_POST_VARS['delete_image_sm_3'] == 'yes')) {
            $sql_data_array['products_image_sm_3'] = '';
           } else {
          if (isset($HTTP_POST_VARS['products_image_sm_3']) && tep_not_null($HTTP_POST_VARS['products_image_sm_3']) && ($HTTP_POST_VARS['products_image_sm_3'] != 'none')) {
            $sql_data_array['products_image_sm_3'] = tep_db_prepare_input($HTTP_POST_VARS['products_image_sm_3']);
          }
          }
       if (($HTTP_POST_VARS['unlink_image_xl_3'] == 'yes') or ($HTTP_POST_VARS['delete_image_xl_3'] == 'yes')) {
            $sql_data_array['products_image_xl_3'] = '';
           } else {
          if (isset($HTTP_POST_VARS['products_image_xl_3']) && tep_not_null($HTTP_POST_VARS['products_image_xl_3']) && ($HTTP_POST_VARS['products_image_xl_3'] != 'none')) {
            $sql_data_array['products_image_xl_3'] = tep_db_prepare_input($HTTP_POST_VARS['products_image_xl_3']);
          }
          }
       if (($HTTP_POST_VARS['unlink_image_sm_4'] == 'yes') or ($HTTP_POST_VARS['delete_image_sm_4'] == 'yes')) {
            $sql_data_array['products_image_sm_4'] = '';
           } else {
          if (isset($HTTP_POST_VARS['products_image_sm_4']) && tep_not_null($HTTP_POST_VARS['products_image_sm_4']) && ($HTTP_POST_VARS['products_image_sm_4'] != 'none')) {
            $sql_data_array['products_image_sm_4'] = tep_db_prepare_input($HTTP_POST_VARS['products_image_sm_4']);
          }
          }
       if (($HTTP_POST_VARS['unlink_image_xl_4'] == 'yes') or ($HTTP_POST_VARS['delete_image_xl_4'] == 'yes')) {
            $sql_data_array['products_image_xl_4'] = '';
           } else {
          if (isset($HTTP_POST_VARS['products_image_xl_4']) && tep_not_null($HTTP_POST_VARS['products_image_xl_4']) && ($HTTP_POST_VARS['products_image_xl_4'] != 'none')) {
            $sql_data_array['products_image_xl_4'] = tep_db_prepare_input($HTTP_POST_VARS['products_image_xl_4']);
          }
          }
       if (($HTTP_POST_VARS['unlink_image_sm_5'] == 'yes') or ($HTTP_POST_VARS['delete_image_sm_5'] == 'yes')) {
            $sql_data_array['products_image_sm_5'] = '';
           } else {
          if (isset($HTTP_POST_VARS['products_image_sm_5']) && tep_not_null($HTTP_POST_VARS['products_image_sm_5']) && ($HTTP_POST_VARS['products_image_sm_5'] != 'none')) {
            $sql_data_array['products_image_sm_5'] = tep_db_prepare_input($HTTP_POST_VARS['products_image_sm_5']);
          }
          }
       if (($HTTP_POST_VARS['unlink_image_xl_5'] == 'yes') or ($HTTP_POST_VARS['delete_image_xl_5'] == 'yes')) {
            $sql_data_array['products_image_xl_5'] = '';
           } else {
          if (isset($HTTP_POST_VARS['products_image_xl_5']) && tep_not_null($HTTP_POST_VARS['products_image_xl_5']) && ($HTTP_POST_VARS['products_image_xl_5'] != 'none')) {
            $sql_data_array['products_image_xl_5'] = tep_db_prepare_input($HTTP_POST_VARS['products_image_xl_5']);
          }
          }
       if (($HTTP_POST_VARS['unlink_image_sm_6'] == 'yes') or ($HTTP_POST_VARS['delete_image_sm_6'] == 'yes')) {
            $sql_data_array['products_image_sm_6'] = '';
           } else {
          if (isset($HTTP_POST_VARS['products_image_sm_6']) && tep_not_null($HTTP_POST_VARS['products_image_sm_6']) && ($HTTP_POST_VARS['products_image_sm_6'] != 'none')) {
            $sql_data_array['products_image_sm_6'] = tep_db_prepare_input($HTTP_POST_VARS['products_image_sm_6']);
          }
          }
       if (($HTTP_POST_VARS['unlink_image_xl_6'] == 'yes') or ($HTTP_POST_VARS['delete_image_xl_6'] == 'yes')) {
            $sql_data_array['products_image_xl_6'] = '';
           } else {
          if (isset($HTTP_POST_VARS['products_image_xl_6']) && tep_not_null($HTTP_POST_VARS['products_image_xl_6']) && ($HTTP_POST_VARS['products_image_xl_6'] != 'none')) {
            $sql_data_array['products_image_xl_6'] = tep_db_prepare_input($HTTP_POST_VARS['products_image_xl_6']);
          }
          }
// eof UltraPics
// Product Tabs 2.0 End-3
          if ($action == 'insert_product') {
            $insert_sql_data = array('products_date_added' => 'now()');

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            tep_db_perform(TABLE_PRODUCTS, $sql_data_array);
            $products_id = tep_db_insert_id();

            tep_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id) values ('" . (int)$products_id . "', '" . (int)$current_category_id . "')");
          } elseif ($action == 'update_product') {
            $update_sql_data = array('products_last_modified' => 'now()');

            $sql_data_array = array_merge($sql_data_array, $update_sql_data);

            tep_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', "products_id = '" . (int)$products_id . "'");
          }
// bof: qpbpp for sppc /step-4(23)\
// BOF entries in products_groups
 $customers_group_query = tep_db_query("select customers_group_id, customers_group_name from " . TABLE_CUSTOMERS_GROUPS . " where customers_group_id != '0' order by customers_group_id");
while ($customers_group = tep_db_fetch_array($customers_group_query)) // Gets all of the customers groups
  {
  $attributes_query = tep_db_query("select customers_group_id, customers_group_price, products_qty_blocks, products_min_order_qty from " . TABLE_PRODUCTS_GROUPS . " where ((products_id = '" . $products_id . "') && (customers_group_id = " . $customers_group['customers_group_id'] . ")) order by customers_group_id");
  $attributes = tep_db_fetch_array($attributes_query);
// set default values for quantity blocks and min order quantity  
  $pg_products_qty_blocks = 1;
  $pg_products_min_order_qty = 1;
  $delete_row_from_pg = false;

  if (isset($_POST['products_qty_blocks'][$customers_group['customers_group_id']]) && (int)$_POST['products_qty_blocks'][$customers_group['customers_group_id']] > 1) {
     $pg_products_qty_blocks = (int)$_POST['products_qty_blocks'][$customers_group['customers_group_id']];
  }
  if (isset($_POST['products_min_order_qty'][$customers_group['customers_group_id']]) && (int)$_POST['products_min_order_qty'][$customers_group['customers_group_id']] > 1) {
     $pg_products_min_order_qty = (int)$_POST['products_min_order_qty'][$customers_group['customers_group_id']];
  }
  if ($_POST['sppcprice'][$customers_group['customers_group_id']] == '' && $pg_products_qty_blocks == 1 && $pg_products_min_order_qty == 1) {
    $delete_row_from_pg = true; // no need to have default values for qty blocks and min order qty in the table
  }
  if ($_POST['sppcprice'][$customers_group['customers_group_id']] == '') {
    $pg_cg_group_price = 'null';
  } else {
    $pg_cg_group_price = "'" . (float)$_POST['sppcprice'][$customers_group['customers_group_id']] . "'";
  }

  if (tep_db_num_rows($attributes_query) > 0 && $delete_row_from_pg == false) {
// there is already a row inserted in products_groups, update instead of insert  
    if ($_POST['sppcoption'][$customers_group['customers_group_id']]) { // this is checking if the check box is checked
        tep_db_query("update " . TABLE_PRODUCTS_GROUPS . " set customers_group_price = " . $pg_cg_group_price . ", products_qty_blocks = " . $pg_products_qty_blocks . ", products_min_order_qty = " . $pg_products_min_order_qty . " where customers_group_id = '" . $attributes['customers_group_id'] . "' and products_id = '" . $products_id . "'");
    }
    else {
      tep_db_query("delete from " . TABLE_PRODUCTS_GROUPS . " where customers_group_id = '" . $customers_group['customers_group_id'] . "' and products_id = '" . $products_id . "'");
    }
  } elseif (tep_db_num_rows($attributes_query) > 0 && $delete_row_from_pg == true) {
      tep_db_query("delete from " . TABLE_PRODUCTS_GROUPS . " where customers_group_id = '" . $customers_group['customers_group_id'] . "' and products_id = '" . $products_id . "'");
  } elseif (($_POST['sppcoption'][$customers_group['customers_group_id']]) && $delete_row_from_pg == false) {
    tep_db_query("insert into " . TABLE_PRODUCTS_GROUPS . " (products_id, customers_group_id, customers_group_price, products_qty_blocks, products_min_order_qty) values ('" . $products_id . "', '" . $customers_group['customers_group_id'] . "', " . $pg_cg_group_price . ", " . $pg_products_qty_blocks . ", " . $pg_products_min_order_qty . ")");
  }
} // end while ($customers_group = tep_db_fetch_array($customers_group_query))
// eof: qpbpp for sppc /step-4(23)\

// bof: entries in products_to_discount_categories
  foreach ($_POST['discount_categories_id'] as $dc_cg_id => $dc_id) {
    $current_discount_category = (int)$_POST['current_discount_cat_id'][$dc_cg_id];
    $new_discount_category = (int)$dc_id;
    $discount_category_result = qpbpp_insert_update_discount_cats($products_id, $current_discount_category, $new_discount_category, $dc_cg_id);
      if ($discount_category_result == false) {
          $messageStack->add_session(ERROR_UPDATE_INSERT_DISCOUNT_CATEGORY, 'error');
       }
  } // end foreach ($_POST['discount_categories_id'] as $dc_cg_id => $dc_id
// eof: entries in products_to_discount_categories

// bof: entries in products_price_break
  foreach ($_POST['products_price_break'] as $pbb_cg_id => $price_break_array) {
    foreach ($price_break_array as $key1 => $products_price) {
      $pb_action = 'insert'; // re-set default to insert
      $where_clause = '';
      if (isset($_POST['products_delete'][$pbb_cg_id][$key1]) && $_POST['products_delete'][$pbb_cg_id][$key1] == 'y' && isset($_POST['products_price_break_id'][$pbb_cg_id][$key1])) {
        $delete_from_ppb_array[] = (int)$_POST['products_price_break_id'][$pbb_cg_id][$key1];
        continue;
      }
      if (!tep_not_null($products_price)) {
        continue; // if price is empty this price break is unused
      } elseif (!tep_not_null($_POST['products_qty'][$pbb_cg_id][$key1])) {
        continue; // if qty is not entered we will not update or insert this in the table
      } else {
        $sql_price_break_data_array = array(
           'products_id' => (int)$products_id,
           'products_price' => (float)$products_price,
           'products_qty' => (int)$_POST['products_qty'][$pbb_cg_id][$key1],
           'customers_group_id' => $pbb_cg_id
           );
               
        if (isset($_POST['products_price_break_id'][$pbb_cg_id][$key1]) && (int)$_POST['products_price_break_id'][$pbb_cg_id][$key1] > 0) {
          $pb_action = 'update';
          $where_clause = " products_price_break_id = '" . (int)$_POST['products_price_break_id'][$pbb_cg_id][$key1] . "'";
        }
        tep_db_perform(TABLE_PRODUCTS_PRICE_BREAK, $sql_price_break_data_array, $pb_action, $where_clause);
      } // end if/else (!tep_not_null($products_price))
    } // end foreach ($price_break_array as $key1 => $products_price)
  } // end foreach ($_POST['products_price_break'] as $pbb_cg_id => $price_break_array)
  
// delete the unwanted price breaks using their products_price_break_id's
    if (isset($delete_from_ppb_array) && sizeof($delete_from_ppb_array > 0) && tep_not_null($delete_from_ppb_array[0])) {
      tep_db_query("delete from " . TABLE_PRODUCTS_PRICE_BREAK . " where products_price_break_id in (" . implode(',', $delete_from_ppb_array) . ")");
    }
// eof: entries in products_price_break
// eof: QPBPP for SPPC

          $languages = tep_get_languages();
          for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
            $language_id = $languages[$i]['id'];

            $sql_data_array = array('products_name' => tep_db_prepare_input($HTTP_POST_VARS['products_name'][$language_id]),
                                    'products_description' => tep_db_prepare_input($HTTP_POST_VARS['products_description'][$language_id]),
// Product Tabs 2.0 Start-4
         'products_spec' => tep_db_prepare_input($HTTP_POST_VARS['products_spec'][$language_id]),
         'products_musthave' => tep_db_prepare_input($HTTP_POST_VARS['products_musthave'][$language_id]),
         'products_extraimage' => tep_db_prepare_input($HTTP_POST_VARS['products_extraimage'][$language_id]),
         'products_manual' => tep_db_prepare_input($HTTP_POST_VARS['products_manual'][$language_id]),
         'products_extra1' => tep_db_prepare_input($HTTP_POST_VARS['products_extra1'][$language_id]),
         'products_moreinfo' => tep_db_prepare_input($HTTP_POST_VARS['products_moreinfo'][$language_id]),
// Product Tabs 2.0 End-4
// bof: header tags seo /Step-5(18)\
         'products_head_title_tag' => ((tep_not_null($HTTP_POST_VARS['products_head_title_tag'][$language_id])) ? tep_db_prepare_input(strip_tags($HTTP_POST_VARS['products_head_title_tag'][$language_id])) : tep_db_prepare_input(strip_tags($HTTP_POST_VARS['products_name'][$language_id]))),
         'products_head_desc_tag' => ((tep_not_null($HTTP_POST_VARS['products_head_desc_tag'][$language_id])) ? tep_db_prepare_input($HTTP_POST_VARS['products_head_desc_tag'][$language_id]) : tep_db_prepare_input($HTTP_POST_VARS['products_name'][$language_id])),
         'products_head_keywords_tag' => ((tep_not_null($HTTP_POST_VARS['products_head_keywords_tag'][$language_id])) ? tep_db_prepare_input(strip_tags($HTTP_POST_VARS['products_head_keywords_tag'][$language_id])) : tep_db_prepare_input(strip_tags($HTTP_POST_VARS['products_name'][$language_id]))),
// eof: header tags seo /Step-5(18)\
         'products_url' => tep_db_prepare_input($HTTP_POST_VARS['products_url'][$language_id]));

            if ($action == 'insert_product') {
              $insert_sql_data = array('products_id' => $products_id,
                                       'language_id' => $language_id);

              $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

              tep_db_perform(TABLE_PRODUCTS_DESCRIPTION, $sql_data_array);
            } elseif ($action == 'update_product') {
              tep_db_perform(TABLE_PRODUCTS_DESCRIPTION, $sql_data_array, 'update', "products_id = '" . (int)$products_id . "' and language_id = '" . (int)$language_id . "'");
            }
          }

          if (USE_CACHE == 'true') {
            tep_reset_cache_block('categories');
            tep_reset_cache_block('also_purchased');
          }
// bof: header tags seo /Step-6(18)\
          if (HEADER_TAGS_ENABLE_CACHE != 'None') {
            require_once(DIR_WS_FUNCTIONS . 'header_tags.php');
            ResetCache_HeaderTags('product_info.php', 'p_' . $products_id);
          }
// eof: header tags seo /Step-6(18)\
// bof: Additional Images
          // delete old images if necessary
          if (isset($HTTP_POST_VARS['products_image']) && tep_not_null($HTTP_POST_VARS['products_image']) && ($HTTP_POST_VARS['products_image'] != 'none')) {
            if (tep_not_null($del_products['products_image']) && (($HTTP_POST_VARS['products_image'] != $del_products['products_image']) || (isset($HTTP_POST_VARS['delete_image_def']) && tep_not_null($HTTP_POST_VARS['delete_image_def'])))) {
              if ( !tep_is_image_still_used($del_products['products_image']) )
                @unlink(DIR_FS_CATALOG_IMAGES . $del_products['products_image']);  // delete old image if filename has changed
            }
          }
          if (isset($HTTP_POST_VARS['products_image_med']) && tep_not_null($HTTP_POST_VARS['products_image_med']) && ($HTTP_POST_VARS['products_image_med'] != 'none')) {
            if (tep_not_null($del_products['products_image_med']) && (($HTTP_POST_VARS['products_image_med'] != $del_products['products_image_med']) || (isset($HTTP_POST_VARS['delete_image_med']) && tep_not_null($HTTP_POST_VARS['delete_image_med'])))) {
              if ( !tep_is_image_still_used($del_products['products_image_med']) )
                @unlink(DIR_FS_CATALOG_IMAGES . $del_products['products_image_med']);  // delete old image if filename has changed
            }
          }
          if (isset($HTTP_POST_VARS['products_image_pop']) && tep_not_null($HTTP_POST_VARS['products_image_pop']) && ($HTTP_POST_VARS['products_image_pop'] != 'none')) {
            if (tep_not_null($del_products['products_image_pop']) && (($HTTP_POST_VARS['products_image_pop'] != $del_products['products_image_pop']) || (isset($HTTP_POST_VARS['delete_image_pop']) && tep_not_null($HTTP_POST_VARS['delete_image_pop'])))) {
              if ( !tep_is_image_still_used($del_products['products_image_pop']) )
                @unlink(DIR_FS_CATALOG_IMAGES . $del_products['products_image_pop']);  // delete old image if filename has changed
            }
          }
// eof: Additional Images
// attribute on categories page 
// original -> tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products_id));
			   tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products_id . '&action=new_product'));
        }
        break;
      case 'copy_to_confirm':
        if (isset($HTTP_POST_VARS['products_id']) && isset($HTTP_POST_VARS['categories_id'])) {
          $products_id = tep_db_prepare_input($HTTP_POST_VARS['products_id']);
          $categories_id = tep_db_prepare_input($HTTP_POST_VARS['categories_id']);

          if ($HTTP_POST_VARS['copy_as'] == 'link') {
            if ($categories_id != $current_category_id) {
              $check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$products_id . "' and categories_id = '" . (int)$categories_id . "'");
              $check = tep_db_fetch_array($check_query);
              if ($check['total'] < '1') {
                tep_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id) values ('" . (int)$products_id . "', '" . (int)$categories_id . "')");
              }
            } else {
              $messageStack->add_session(ERROR_CANNOT_LINK_TO_SAME_CATEGORY, 'error');
            }
          } elseif ($HTTP_POST_VARS['copy_as'] == 'duplicate') {

// beof: qpbpp for sppc /step-5(23)\ added: , products_qty_blocks, products_min_order_qty
			$product_query = tep_db_query("select products_carrot, products_quantity, products_model, products_image, products_image_med, products_image_pop, products_image_description, products_price, products_date_available, products_weight, products_tax_class_id, manufacturers_id, tnt_f_tr, tnt_f_sb, tnt_f_cs, products_to_rss, products_qty_blocks, products_min_order_qty from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
            $product = tep_db_fetch_array($product_query);


			tep_db_query("insert into " . TABLE_PRODUCTS . " (products_quantity, products_model, products_image, products_image_med, products_image_pop, products_image_description, products_image_lrg, products_image_sm_1, products_image_xl_1, products_image_sm_2, products_image_xl_2, products_image_sm_3, products_image_xl_3, products_image_sm_4, products_image_xl_4, products_image_sm_5, products_image_xl_5, products_image_sm_6, products_image_xl_6, products_price, products_date_added, products_date_available, products_weight, products_status, products_tax_class_id, manufacturers_id, tnt_f_tr, tnt_f_sb, tnt_f_cs, products_to_rss, products_carrot, products_qty_blocks, products_min_order_qty)
						values ('" . tep_db_input($product['products_quantity']) . "',
								'" . tep_db_input($product['products_model']) . "',
								'" . tep_db_input($product['products_image']) . "',
								'" . tep_db_input($product['products_image_med']) . "',
								'" . tep_db_input($product['products_image_pop']) . "',
								'" . tep_db_input($product['products_image_description']) . "'
								'" . tep_db_input($product['products_image_lrg']) . "',
								'" . tep_db_input($product['products_image_sm_1']) . "',
								'" . tep_db_input($product['products_image_xl_1']) . "',
								'" . tep_db_input($product['products_image_sm_2']) . "',
								'" . tep_db_input($product['products_image_xl_2']) . "',
								'" . tep_db_input($product['products_image_sm_3']) . "',
								'" . tep_db_input($product['products_image_xl_3']) . "',
								'" . tep_db_input($product['products_image_sm_4']) . "',
								'" . tep_db_input($product['products_image_xl_4']) . "',
								'" . tep_db_input($product['products_image_sm_5']) . "',
								'" . tep_db_input($product['products_image_xl_5']) . "',
								'" . tep_db_input($product['products_image_sm_6']) . "',
								'" . tep_db_input($product['products_image_xl_6']) . "',
								'" . tep_db_input($product['products_price']) . "',  now(), " . (empty($product['products_date_available']) ? "null" : "'" . tep_db_input($product['products_date_available']) . "'") . ",
								'" . tep_db_input($product['products_weight']) . "', '0',
								'" . (int)$product['products_tax_class_id'] . "', 
								'" . (int)$product['manufacturers_id'] . "', 
								'" . (int)$product['products_to_rss'] . "',
								'" . (int)$product['products_carrot'] . "',
								'" . (int)$product['products_qty_blocks'] . "',
								'" . (int)$product['products_min_order_qty'] . "',
								'" . tep_db_input($product['tnt_f_tr']) . "', 
								'" . tep_db_input($product['tnt_f_sb']). "', 
								'" . tep_db_input($product['tnt_f_cs']) . "')");
            $dup_products_id = tep_db_insert_id();

            // bof: Additional Images
            // get image names from database
            $ai_copyimg_query = tep_db_query("select products_id, images_description, popup_images, medium_images, thumb_images from " . TABLE_ADDITIONAL_IMAGES . " where products_id = '" . (int)$product_id . "'");
            while ($ai_copyimg = tep_db_fetch_array($ai_copyimg_query)) {
              tep_db_query("insert into " . TABLE_ADDITIONAL_IMAGES . " (products_id, images_description, popup_images, medium_images, thumb_images) values ('" . (int)$dup_products_id . "', '" . tep_db_input($ai_copyimg['images_description']) . "', '" . tep_db_input($ai_copyimg['popup_images']) . "', '" . tep_db_input($ai_copyimg['medium_images']) . "', '" . tep_db_input($ai_copyimg['thumb_images']) . "')");
            }
            // eof: Additional Images

// beof: header tags seo /Step-7(18)\ added gueries
// Product Tabs 2.0 added queries Start-6
            $description_query = tep_db_query("select language_id, products_name, products_description, products_spec, products_musthave, products_extraimage, products_manual, products_extra1, products_moreinfo, products_head_title_tag, products_head_desc_tag, products_head_keywords_tag, products_url from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$products_id . "'");
            while ($description = tep_db_fetch_array($description_query)) {
              tep_db_query("insert into " . TABLE_PRODUCTS_DESCRIPTION . " (products_id, language_id, products_name, products_description, products_spec, products_musthave, products_extraimage, products_manual, products_extra1, products_moreinfo, products_head_title_tag, products_head_desc_tag, products_head_keywords_tag, products_url, products_viewed) 
						values ('" . (int)$dup_products_id . "', '" . (int)$description['language_id'] . "',
								'" . tep_db_input($description['products_name']) . "', 
								'" . tep_db_input($description['products_description']) . "',
								'" . tep_db_input($description['products_spec']) . "', 
								'" . tep_db_input($description['products_musthave']) . "', 
								'" . tep_db_input($description['products_extraimage']) . "', 
								'" . tep_db_input($description['products_manual']) . "', 
								'" . tep_db_input($description['products_extra1']) . "', 
								'" . tep_db_input($description['products_moreinfo']) . "',
								'" . tep_db_input($description['products_head_title_tag']) . "',
								'" . tep_db_input($description['products_head_desc_tag']) . "',
								'" . tep_db_input($description['products_head_keywords_tag']) . "',
								'" . tep_db_input($description['products_url']) . "', '0')");
            }

            tep_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id) values ('" . (int)$dup_products_id . "', '" . (int)$categories_id . "')");

// bof: qpbpp for sppc /step-6(23)\
	$cg_price_query = tep_db_query("select customers_group_id, customers_group_price, products_qty_blocks, products_min_order_qty from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . $products_id . "' order by customers_group_id");

// insert customer group prices in table products_groups when there are any for the copied product
// adapted for QPBPP for SPPC
    if (tep_db_num_rows($cg_price_query) > 0) {
      while ( $cg_prices = tep_db_fetch_array($cg_price_query)) {
        tep_db_query("insert into " . TABLE_PRODUCTS_GROUPS . " (customers_group_id, customers_group_price, products_id, products_qty_blocks, products_min_order_qty) values ('" . (int)$cg_prices['customers_group_id'] . "', " . (empty($cg_prices['customers_group_price']) ? "null" : "'" . tep_db_input($cg_prices['customers_group_price']) . "'") . ", '" . (int)$dup_products_id . "', '" . (int)$cg_prices['products_qty_blocks'] . "', '" . (int)$cg_prices['products_min_order_qty'] . "')");
      } // end while ( $cg_prices = tep_db_fetch_array($cg_price_query))
    } // end if (tep_db_num_rows($cg_price_query) > 0)

            $price_breaks_query = tep_db_query("select products_price, products_qty, customers_group_id from " . TABLE_PRODUCTS_PRICE_BREAK . " where products_id = '" . (int)$products_id . "' order by customers_group_id, products_qty");
            while ($price_break = tep_db_fetch_array($price_breaks_query)) {
              $sql_price_break_data_array = array(
                'products_id' => (int)$dup_products_id,
                'products_price' => $price_break['products_price'],
                'products_qty' => $price_break['products_qty'],
                'customers_group_id' => $price_break['customers_group_id']);
              tep_db_perform(TABLE_PRODUCTS_PRICE_BREAK, $sql_price_break_data_array);
            }
            
            $current_dc_query = tep_db_query("select discount_categories_id, customers_group_id from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " where products_id = '" . (int)$products_id . "' order by customers_group_id");
            if (tep_db_num_rows($current_dc_query) > 0) {
              // insert the new products_id in products_to_discount_categories only 
              // if the cloned product was already in it
              while ($current_dc = tep_db_fetch_array($current_dc_query)) {
                $discount_category_result = qpbpp_insert_update_discount_cats($dup_products_id, '0', $current_dc['discount_categories_id'], $current_dc['customers_group_id']);
                if ($discount_category_result == false) {
                  $messageStack->add_session(ERROR_UPDATE_INSERT_DISCOUNT_CATEGORY, 'error');
                }
              } // end while ($current_dc = ....
            } // end if (tep_db_num_rows($current_dc_query)
// eof: qpbpp for sppc /step-6(23)\

            $products_id = $dup_products_id;
          }

          if (USE_CACHE == 'true') {
            tep_reset_cache_block('categories');
            tep_reset_cache_block('also_purchased');
          }
        }

        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $categories_id . '&pID=' . $products_id));
        break;
      case 'new_product_preview':
// copy image only if modified
// Product Tabs 2.0 Start-8
// bof UltraPics
   if (($HTTP_POST_VARS['unlink_image'] == 'yes') or ($HTTP_POST_VARS['delete_image'] == 'yes')) {
        $products_image = '';
        $products_image_name = '';
        } else {
// eof UltraPics
// Product Tabs 2.0 End-8
// bof: Additional Images
/*
        $products_image = new upload('products_image');
        $products_image->set_destination(DIR_FS_CATALOG_IMAGES);
        if ($products_image->parse() && $products_image->save()) {
          $products_image_name = $products_image->filename;
        } else {
          $products_image_name = (isset($HTTP_POST_VARS['products_previous_image']) ? $HTTP_POST_VARS['products_previous_image'] : '');
        }
*/
        $image_subdirectory = (!empty($_POST['image_subdirectory'])?tep_db_prepare_input($_POST['image_subdirectory']):'');
        $sql_data_array = array();        
        $add_images_error = process_uploads($image_subdirectory,'products_image','products_image_med','products_image_pop',$sql_data_array,$messageStack);
        $products_image_name = (!empty($sql_data_array['products_image'])?$sql_data_array['products_image']:(isset($HTTP_POST_VARS['products_previous_image'])?$HTTP_POST_VARS['products_previous_image']:''));
        $products_image_med_name = (!empty($sql_data_array['products_image_med'])?$sql_data_array['products_image_med']:(isset($HTTP_POST_VARS['products_previous_image_med'])?$HTTP_POST_VARS['products_previous_image_med']:''));
        $products_image_pop_name = (!empty($sql_data_array['products_image_pop'])?$sql_data_array['products_image_pop']:(isset($HTTP_POST_VARS['products_previous_image_pop'])?$HTTP_POST_VARS['products_previous_image_pop']:''));
// eof: Additional Images        
// Product Tabs 2.0 Start-9
// bof UltraPics
        }
   if (($HTTP_POST_VARS['unlink_image_med'] == 'yes') or ($HTTP_POST_VARS['delete_image_med'] == 'yes')) {
        $products_image_med = '';
       $products_image_med_name = '';
        } else {
        $products_image_med = new upload('products_image_med');
        $products_image_med->set_destination(DIR_FS_CATALOG_IMAGES);
        if ($products_image_med->parse() && $products_image_med->save()) {
          $products_image_med_name = $products_image_med->filename;
        } else {
          $products_image_med_name = (isset($HTTP_POST_VARS['products_previous_image_med']) ? $HTTP_POST_VARS['products_previous_image_med'] : '');
        }
        }
   if (($HTTP_POST_VARS['unlink_image_lrg'] == 'yes') or ($HTTP_POST_VARS['delete_image_lrg'] == 'yes')) {
        $products_image_lrg = '';
        $products_image_lrg_name = '';
        } else {
        $products_image_lrg = new upload('products_image_lrg');
        $products_image_lrg->set_destination(DIR_FS_CATALOG_IMAGES);
        if ($products_image_lrg->parse() && $products_image_lrg->save()) {
          $products_image_lrg_name = $products_image_lrg->filename;
        } else {
          $products_image_lrg_name = (isset($HTTP_POST_VARS['products_previous_image_lrg']) ? $HTTP_POST_VARS['products_previous_image_lrg'] : '');
        }
        }
   if (($HTTP_POST_VARS['unlink_image_sm_1'] == 'yes') or ($HTTP_POST_VARS['delete_image_sm_1'] == 'yes')) {
        $products_image_sm_1 = '';
        $products_image_sm_1_name = '';
        } else {
        $products_image_sm_1 = new upload('products_image_sm_1');
        $products_image_sm_1->set_destination(DIR_FS_CATALOG_IMAGES);
        if ($products_image_sm_1->parse() && $products_image_sm_1->save()) {
          $products_image_sm_1_name = $products_image_sm_1->filename;
        } else {
          $products_image_sm_1_name = (isset($HTTP_POST_VARS['products_previous_image_sm_1']) ? $HTTP_POST_VARS['products_previous_image_sm_1'] : '');
        }
        }
   if (($HTTP_POST_VARS['unlink_image_xl_1'] == 'yes') or ($HTTP_POST_VARS['delete_image_xl_1'] == 'yes')) {
        $products_image_xl_1 = '';
        $products_image_xl_1_name = '';
        } else {
        $products_image_xl_1 = new upload('products_image_xl_1');
        $products_image_xl_1->set_destination(DIR_FS_CATALOG_IMAGES);
        if ($products_image_xl_1->parse() && $products_image_xl_1->save()) {
          $products_image_xl_1_name = $products_image_xl_1->filename;
        } else {
          $products_image_xl_1_name = (isset($HTTP_POST_VARS['products_previous_image_xl_1']) ? $HTTP_POST_VARS['products_previous_image_xl_1'] : '');
        }
        }
   if (($HTTP_POST_VARS['unlink_image_sm_2'] == 'yes') or ($HTTP_POST_VARS['delete_image_sm_2'] == 'yes')) {
        $products_image_sm_2 = '';
        $products_image_sm_2_name = '';
        } else {
        $products_image_sm_2 = new upload('products_image_sm_2');
        $products_image_sm_2->set_destination(DIR_FS_CATALOG_IMAGES);
        if ($products_image_sm_2->parse() && $products_image_sm_2->save()) {
          $products_image_sm_2_name = $products_image_sm_2->filename;
        } else {
          $products_image_sm_2_name = (isset($HTTP_POST_VARS['products_previous_image_sm_2']) ? $HTTP_POST_VARS['products_previous_image_sm_2'] : '');
        }
        }
   if (($HTTP_POST_VARS['unlink_image_xl_2'] == 'yes') or ($HTTP_POST_VARS['delete_image_xl_2'] == 'yes')) {
        $products_image_xl_2 = '';
        $products_image_xl_2_name = '';
        } else {
        $products_image_xl_2 = new upload('products_image_xl_2');
        $products_image_xl_2->set_destination(DIR_FS_CATALOG_IMAGES);
        if ($products_image_xl_2->parse() && $products_image_xl_2->save()) {
          $products_image_xl_2_name = $products_image_xl_2->filename;
        } else {
          $products_image_xl_2_name = (isset($HTTP_POST_VARS['products_previous_image_xl_2']) ? $HTTP_POST_VARS['products_previous_image_xl_2'] : '');
        }
        }
   if (($HTTP_POST_VARS['unlink_image_sm_3'] == 'yes') or ($HTTP_POST_VARS['delete_image_sm_3'] == 'yes')) {
        $products_image_sm_3 = '';
        $products_image_sm_3_name = '';
        } else {
        $products_image_sm_3 = new upload('products_image_sm_3');
        $products_image_sm_3->set_destination(DIR_FS_CATALOG_IMAGES);
        if ($products_image_sm_3->parse() && $products_image_sm_3->save()) {
          $products_image_sm_3_name = $products_image_sm_3->filename;
        } else {
          $products_image_sm_3_name = (isset($HTTP_POST_VARS['products_previous_image_sm_3']) ? $HTTP_POST_VARS['products_previous_image_sm_3'] : '');
        }
        }
   if (($HTTP_POST_VARS['unlink_image_xl_3'] == 'yes') or ($HTTP_POST_VARS['delete_image_xl_3'] == 'yes')) {
        $products_image_xl_3 = '';
        $products_image_xl_3_name = '';
        } else {
        $products_image_xl_3 = new upload('products_image_xl_3');
        $products_image_xl_3->set_destination(DIR_FS_CATALOG_IMAGES);
        if ($products_image_xl_3->parse() && $products_image_xl_3->save()) {
          $products_image_xl_3_name = $products_image_xl_3->filename;
        } else {
          $products_image_xl_3_name = (isset($HTTP_POST_VARS['products_previous_image_xl_3']) ? $HTTP_POST_VARS['products_previous_image_xl_3'] : '');
        }
        }
   if (($HTTP_POST_VARS['unlink_image_sm_4'] == 'yes') or ($HTTP_POST_VARS['delete_image_sm_4'] == 'yes')) {
        $products_image_sm_4 = '';
        $products_image_sm_4_name = '';
        } else {
        $products_image_sm_4 = new upload('products_image_sm_4');
        $products_image_sm_4->set_destination(DIR_FS_CATALOG_IMAGES);
        if ($products_image_sm_4->parse() && $products_image_sm_4->save()) {
          $products_image_sm_4_name = $products_image_sm_4->filename;
        } else {
          $products_image_sm_4_name = (isset($HTTP_POST_VARS['products_previous_image_sm_4']) ? $HTTP_POST_VARS['products_previous_image_sm_4'] : '');
        }
        }
   if (($HTTP_POST_VARS['unlink_image_xl_4'] == 'yes') or ($HTTP_POST_VARS['delete_image_xl_4'] == 'yes')) {
        $products_image_xl_4 = '';
        $products_image_xl_4_name = '';
        } else {
        $products_image_xl_4 = new upload('products_image_xl_4');
        $products_image_xl_4->set_destination(DIR_FS_CATALOG_IMAGES);
        if ($products_image_xl_4->parse() && $products_image_xl_4->save()) {
          $products_image_xl_4_name = $products_image_xl_4->filename;
        } else {
          $products_image_xl_4_name = (isset($HTTP_POST_VARS['products_previous_image_xl_4']) ? $HTTP_POST_VARS['products_previous_image_xl_4'] : '');
        }
        }
   if (($HTTP_POST_VARS['unlink_image_sm_5'] == 'yes') or ($HTTP_POST_VARS['delete_image_sm_5'] == 'yes')) {
        $products_image_sm_5 = '';
        $products_image_sm_5_name = '';
        } else {
        $products_image_sm_5 = new upload('products_image_sm_5');
        $products_image_sm_5->set_destination(DIR_FS_CATALOG_IMAGES);
        if ($products_image_sm_5->parse() && $products_image_sm_5->save()) {
          $products_image_sm_5_name = $products_image_sm_5->filename;
        } else {
          $products_image_sm_5_name = (isset($HTTP_POST_VARS['products_previous_image_sm_5']) ? $HTTP_POST_VARS['products_previous_image_sm_5'] : '');
        }
        }
   if (($HTTP_POST_VARS['unlink_image_xl_5'] == 'yes') or ($HTTP_POST_VARS['delete_image_xl_5'] == 'yes')) {
        $products_image_xl_5 = '';
        $products_image_xl_5_name = '';
        } else {
        $products_image_xl_5 = new upload('products_image_xl_5');
        $products_image_xl_5->set_destination(DIR_FS_CATALOG_IMAGES);
        if ($products_image_xl_5->parse() && $products_image_xl_5->save()) {
          $products_image_xl_5_name = $products_image_xl_5->filename;
        } else {
          $products_image_xl_5_name = (isset($HTTP_POST_VARS['products_previous_image_xl_5']) ? $HTTP_POST_VARS['products_previous_image_xl_5'] : '');
        }
        }
   if (($HTTP_POST_VARS['unlink_image_sm_6'] == 'yes') or ($HTTP_POST_VARS['delete_image_sm_6'] == 'yes')) {
        $products_image_sm_6 = '';
        $products_image_sm_6_name = '';
        } else {
        $products_image_sm_6 = new upload('products_image_sm_6');
        $products_image_sm_6->set_destination(DIR_FS_CATALOG_IMAGES);
        if ($products_image_sm_6->parse() && $products_image_sm_6->save()) {
          $products_image_sm_6_name = $products_image_sm_6->filename;
        } else {
          $products_image_sm_6_name = (isset($HTTP_POST_VARS['products_previous_image_sm_6']) ? $HTTP_POST_VARS['products_previous_image_sm_6'] : '');
        }
        }
   if (($HTTP_POST_VARS['unlink_image_xl_6'] == 'yes') or ($HTTP_POST_VARS['delete_image_xl_6'] == 'yes')) {
        $products_image_xl_6 = '';
        $products_image_xl_6_name = '';
        } else {
        $products_image_xl_6 = new upload('products_image_xl_6');
        $products_image_xl_6->set_destination(DIR_FS_CATALOG_IMAGES);
        if ($products_image_xl_6->parse() && $products_image_xl_6->save()) {
          $products_image_xl_6_name = $products_image_xl_6->filename;
        } else {
          $products_image_xl_6_name = (isset($HTTP_POST_VARS['products_previous_image_xl_6']) ? $HTTP_POST_VARS['products_previous_image_xl_6'] : '');
        }
        }
// eof UltraPics
// Product Tabs 2.0 End-9
        break;
// bof: Additional Images
      case 'add_images':
        $image_subdirectory = (!empty($_POST['image_subdirectory'])?tep_db_prepare_input($_POST['image_subdirectory']):'');
        $products_id = $HTTP_GET_VARS['pID'];
          $sql_data_array = array('products_id' => tep_db_prepare_input($products_id),
                                  'images_description' => tep_db_prepare_input($HTTP_POST_VARS['images_description']));

          $add_images_error = process_uploads($image_subdirectory,'thumb_images','medium_images','popup_images',$sql_data_array,$messageStack);

        if ($add_images_error == false) {
          tep_db_perform(TABLE_ADDITIONAL_IMAGES, $sql_data_array);
        } else {
          $messageStack->add_session(ERROR_ADDITIONAL_IMAGE_IS_EMPTY, 'error');
        }

        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products_id));
        break;
      case 'del_images':
        $products_id = tep_db_prepare_input($HTTP_GET_VARS['pID']);
        if ( ($HTTP_GET_VARS['pID']) && (is_array($HTTP_POST_VARS['additional_images_id'])) ) {                       
          $additional_images_id = tep_db_prepare_input($HTTP_POST_VARS['additional_images_id']);
          for ($i=0; $i<sizeof($additional_images_id); $i++) {
            // get image names to delete
            $delimg_query = tep_db_query("select popup_images, medium_images, thumb_images from " . TABLE_ADDITIONAL_IMAGES . " where additional_images_id = '" . tep_db_input($additional_images_id[$i]) . "'");
            $delimg = tep_db_fetch_array($delimg_query);
            // remove image record from database
            tep_db_query("delete from " . TABLE_ADDITIONAL_IMAGES . " where additional_images_id = '" . tep_db_input($additional_images_id[$i]) . "'");
            //SECTION DELETE POPUP IMAGES
            if (tep_not_null($delimg['popup_images']) && file_exists(DIR_FS_CATALOG_IMAGES.$delimg['popup_images']) )
              if ( !tep_is_image_still_used($delimg['popup_images']) )
                if (!unlink (DIR_FS_CATALOG_IMAGES.$delimg['popup_images']))
                  $messageStack->add_session(ERROR_DEL_IMG_XTRA.$delimg['popup_images'], 'error');
                else
                  $messageStack->add_session(SUCCESS_DEL_IMG_XTRA.$delimg['popup_images'], 'success');
            if (tep_not_null($delimg['medium_images']) && file_exists(DIR_FS_CATALOG_IMAGES.$delimg['medium_images']) )
              if ( !tep_is_image_still_used($delimg['medium_images']) )
                if (!unlink (DIR_FS_CATALOG_IMAGES.$delimg['medium_images']))
                   $messageStack->add_session(ERROR_DEL_IMG_XTRA.$delimg['medium_images'], 'error');
                else
                   $messageStack->add_session(SUCCESS_DEL_IMG_XTRA.$delimg['medium_images'], 'success');
            if (tep_not_null($delimg['thumb_images']) && file_exists(DIR_FS_CATALOG_IMAGES.$delimg['thumb_images']) )
              if ( !tep_is_image_still_used($delimg['thumb_images']) )
                if (!unlink (DIR_FS_CATALOG_IMAGES.$delimg['thumb_images']))
                   $messageStack->add_session(ERROR_DEL_IMG_XTRA.$delimg['thumb_images'], 'error');
                else
                   $messageStack->add_session(SUCCESS_DEL_IMG_XTRA.$delimg['thumb_images'], 'success');
			// delete original image	  
			if (tep_not_null($delimg['medium_images']) && file_exists(DIR_FS_CATALOG_IMAGES.substr($delimg['medium_images'],0,-5).substr($delimg['medium_images'],-4,4)) )
			  if ( !tep_is_image_still_used(substr($delimg['medium_images'],0,-5).substr($delimg['medium_images'],-4,4)) )
				if (!unlink (DIR_FS_CATALOG_IMAGES.substr($delimg['medium_images'],0,-5).substr($delimg['medium_images'],-4,4)))
				  $messageStack->add_session(ERROR_DEL_IMG_XTRA.substr($delimg['medium_images'],0,-5).substr($delimg['medium_images'],-4,4), 'error');
				else
				  $messageStack->add_session(SUCCESS_DEL_IMG_XTRA.substr($delimg['medium_images'],0,-5).substr($delimg['medium_images'],-4,4), 'success');
            //END OF SECTION DELETE POPUP IMAGES
          }
        }
        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products_id));
        break;
// eof: Additional Images

// os6tm banner manager
        case 'add_banner':
        $banner_query = tep_db_query("insert into " . TABLE_BANNERS_TO_CATEGORIES . " values (" . $banners_id . "," . $cID . ")");
        break;
        case 'delete_banner':
        $banners_query = tep_db_query("delete from " . TABLE_BANNERS_TO_CATEGORIES . " where categories_id = '" . $cID . "' and banners_id = '" . $banners_id . "'");
        break;
// os6tm banner manager_eof
    }
  }

// check if the catalog image directory exists
  if (is_dir(DIR_FS_CATALOG_IMAGES)) {
    if (!is_writeable(DIR_FS_CATALOG_IMAGES)) $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE, 'error');
  } else {
    $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST, 'error');
  }
  
// bof: qtpro /step-3(5)\
  if($product_investigation['any_problems']){
  	$messageStack->add('<b>Warning: </b>'. qtpro_doctor_formulate_product_investigation($product_investigation, 'short_suggestion') ,'warning');
  }
// eof: qtpro /step-3(5)\
  
  require(DIR_FS_ADMIN . 'categories_tpl.php');
?>
