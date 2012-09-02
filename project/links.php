<?php //$Id: /catalog/links.php (5272)

  require('includes/application_top.php');
// define our link functions
  require(DIR_WS_FUNCTIONS . 'links.php');

  $linkSearch = '';
  $linkFound = false;
  $action_search = (isset($_POST['action_search']) ? $_POST['action_search'] : '');

  if (tep_not_null($action_search))
  {
     $linkSearch = tep_db_input(tep_db_prepare_input(preg_replace('/[^A-Za-z0-9_-]/', '', $_POST['links_search'])));
     $link_query = tep_db_query("select l.links_id, l.links_status, ld.links_title, lc.links_id, lc.link_categories_id from " . TABLE_LINKS . " l inner join " . TABLE_LINKS_DESCRIPTION . " ld on l.links_id = ld.links_id left join " . TABLE_LINKS_TO_LINK_CATEGORIES . " lc on l.links_id = lc.links_id where ( ld.links_title LIKE '%" . $linkSearch . "%' or ld.links_description LIKE '%" . $linkSearch . "%' or l.links_url LIKE '%" . $linkSearch . "%' or l.links_contact_name LIKE '%" . $linkSearch . "%' or l.links_contact_email LIKE '%" . $linkSearch . "%' ) and (ld.language_id = '" . (int)$languages_id . "' or ld.language_id = '99')");
     if (tep_db_num_rows($link_query) > 0)
       $linkFound = true;
  }

// calculate link category path
  if (isset($_GET['lPath'])) {
    $lPath = preg_replace('/[^A-Za-z0-9_]/', '', $_GET['lPath']);
  } elseif (isset($_GET['links_id'])) {
    $lPath = preg_replace('/[^A-Za-z0-9_]/', '', tep_get_link_path($_GET['links_id']));
  } else {
    $lPath = '';
  }

  if (strpos($lPath, "_") !== FALSE) {
    $pathPart = explode("_", $lPath);
    $lPath = $pathPart[1];
  }

  $parentID = $lPath;

  /****** DIsplay Feature Links ******/
  if (LINKS_FEATURED_LINK == 'true')
  {
    /****** Find the Featured links for all link pages ******/
    $openMode = (LINKS_OPEN_NEW_PAGE == 'true') ? 'blank' : 'self';
    $link_featured = '';
    $lf = '';
    $link_featured_query = tep_db_query("select l.links_id, l.links_url, l.links_image_url, ld.links_title, ld.links_description  from " . TABLE_LINKS . " l left join " . TABLE_LINKS_DESCRIPTION . " ld on l.links_id = ld.links_id left join " . TABLE_LINKS_FEATURED . " lf on l.links_id = lf.links_id where l.links_status = 2 and lf.links_all_pages = '1' and (ld.language_id = '" . (int)$languages_id . "' or ld.language_id = 99) and lf.expires_date >= now() order by RAND()" );

    if (tep_db_num_rows($link_featured_query) > 0) {
      $lf = tep_db_fetch_array($link_featured_query);

      if (LINKS_TITLES_AS_LINKS == 'false')
        $link_featured = $lf['links_title'];
      else
        $link_featured = '<a class="linkListingMain" href="' . tep_get_links_url($lf['links_id']) . '" target="_' . $openMode . '" title="' . $lf['links_title'] . '">' . $lf['links_title'] . '</a>';

      if (LINK_LIST_IMAGE > 0)
      {
        if (tep_not_null($lf['links_image_url'])) {
          $link_featured .= '<br><a class="linkListingMain" href="' . tep_get_links_url($lf['links_id']) .  '" target="_' . $openMode . '">' . tep_links_image($lf['links_image_url'], $lf['links_title'], LINKS_IMAGE_WIDTH, LINKS_IMAGE_HEIGHT) . '</a>';
        } else {
          $link_featured .= '<br><a class="linkListingMain" href="' . tep_get_links_url($lf['links_id']) .  '" target="_' . $openMode . '">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', $lf['links_title'], LINKS_IMAGE_WIDTH, LINKS_IMAGE_HEIGHT, 'style="border: 3px double black"') . '</a>';
        }
      }
      if (LINK_LIST_DESCRIPTION > 0)
       $link_featured .= '<br>' . $lf['links_description'];
    }



    /****** Find the Featured Links for the category page ******/
    $link_featured_cat = '';
    $link_featured_cat_query = tep_db_query("select l.links_id, l.links_url, l.links_image_url, ld.links_title, ld.links_description, lf.expires_date from " . TABLE_LINKS . " l left join " . TABLE_LINKS_DESCRIPTION . " ld on l.links_id = ld.links_id left join " . TABLE_LINKS_FEATURED . " lf on ld.links_id = lf.links_id left join " . TABLE_LINKS_TO_LINK_CATEGORIES . " l2lc on lf.links_id = l2lc.links_id where l.links_status = '2' and lf.expires_date >= now() AND ld.links_title != '" . tep_db_input($lf['links_title']) . "' and l2lc.link_categories_id = '" . (int)$parentID . "' order by RAND()" );

    if (tep_db_num_rows($link_featured_cat_query) > 0) {
      $lf = tep_db_fetch_array($link_featured_cat_query);

      if (LINKS_TITLES_AS_LINKS == 'false')
        $link_featured_cat = $lf['links_title'];
      else
        $link_featured_cat = '<a class="linkListingMain" href="' . tep_get_links_url($lf['links_id']) . '" target="_' . $openMode . '" title="' . $lf['links_title'] . '">' . $lf['links_title'] . '</a>';

      if (LINK_LIST_IMAGE > 0)
      {
        if (tep_not_null($lf['links_image_url'])) {
          $link_featured_cat .= '<br><a class="linkListingMain" href="' . tep_get_links_url($lf['links_id']) .  '" target="_' . $openMode . '">' . tep_links_image($lf['links_image_url'], $lf['links_title'], LINKS_IMAGE_WIDTH, LINKS_IMAGE_HEIGHT) . '</a>';
        } else {
          $link_featured_cat .= '<br><a class="linkListingMain" href="' . tep_get_links_url($lf['links_id']) .  '" target="_' . $openMode . '">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', $lf['links_title'], LINKS_IMAGE_WIDTH, LINKS_IMAGE_HEIGHT, 'style="border: 3px double black"') . '</a>';
        }
      }
      if (LINK_LIST_DESCRIPTION > 0)
       $link_featured_cat .= '<br>' . $lf['links_description'];
    }
  }


  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LINKS);

  // links breadcrumb
  $pathIDS = array();
  $pathStr = array();
  if ($parentID > 0) {
      $pathStr = explode("&nbsp;&gt;&nbsp;", tep_output_generated_link_category_path($parentID));
      $pathStr = array_reverse($pathStr);
      $pathIDS = (array_flip($pathStr));
      for ($i = 0; $i < count($pathStr); ++$i) {
          $breadcrumb->add($pathStr[$i], tep_href_link(FILENAME_LINKS, 'lPath=' .  ($pathIDS[$pathStr[$i]]) . '_' . tep_get_category_id($pathStr[$i])));
      }
  } else {
      $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_LINKS, '', 'NONSSL'));
  }
?>
  <head><title><?php echo TITLE; ?></title>
  <base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
  </head><?php

  $content = CONTENT_LINKS;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
