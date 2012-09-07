<?php // categories_dropdown infobox 

  function tep_show_category($counter) {

    global $tree, $categories_string, $cPath_array, $cat_name;

    for ($i=0; $i<$tree[$counter]['level']; $i++) {
      $categories_string .= "&nbsp;&nbsp;";
    }
    $cPath_new = 'cPath=' . $tree[$counter]['path'];
    if (isset($cPath_array) && in_array($counter, $cPath_array) && $cat_name == $tree[$counter]['name']) { //Link nicht anklickbar, wenn angewählt
             $categories_string .= '<a href="';
             $categories_string .= tep_href_link(FILENAME_DEFAULT, $cPath_new) . '">';																	 	 //Link nicht anklickbar, wenn angewählt
    } else {						 																					 //Link nicht anklickbar, wenn angewählt
    $categories_string .= '<a href="';
    $categories_string .= tep_href_link(FILENAME_DEFAULT, $cPath_new) . '">';
    }									 																						 //Link nicht anklickbar, wenn angewählt
    if (tep_has_category_subcategories($counter)) {
      $categories_string .= tep_image(DIR_WS_IMAGES . 'infobox/categories/pointer_blue_down.gif', '') . '&nbsp;';
    }
    else {
      $categories_string .= tep_image(DIR_WS_IMAGES . 'infobox/categories/pointer_blue_right.gif', '') . '&nbsp;';
    }

    if (isset($cPath_array) && in_array($counter, $cPath_array)) {
      $categories_string .= '<b>';
    }

    if ($cat_name == $tree[$counter]['name']) {
      $categories_string .= '<span class="activeText">';
    }

// display category name
    $categories_string .= $tree[$counter]['name'];

		if ($cat_name == $tree[$counter]['name']) {
			$categories_string .= '</span>';
    }

    if (isset($cPath_array) && in_array($counter, $cPath_array)) {
      $categories_string .= '</b>';
    }

    $categories_string .= '</a>';

    if (SHOW_COUNTS == 'true') {
      $products_in_category = tep_count_products_in_category($counter);
      if ($products_in_category > 0) {
        $categories_string .= '&nbsp;(' . $products_in_category . ')';
      }
    }

    $categories_string .= '<br>';

    if ($tree[$counter]['next_id'] != false) {
      tep_show_category($tree[$counter]['next_id']);
    }
  }
?>
<!-- categories //-->
<?php
  if (isset($cPath_array)) {
		for ($i=0, $n=sizeof($cPath_array); $i<$n; $i++) {
				$categories_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$cPath_array[$i] . "' and language_id = '" . (int)$languages_id . "'");
				if (tep_db_num_rows($categories_query) > 0)
				$categories = tep_db_fetch_array($categories_query);
		}
	$cat_name = $categories['categories_name'];
	}

// display category name
  $boxHeading = BOX_HEADING_CATEGORIES;
  $corner_top_left = 'rounded';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'categories_dropdown'; // for easy unique box template setup (added BTSv1.2)

  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  $categories_string = '';
  $tree = array();

  $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '0' and c.status_categ = '1' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languages_id ."' order by sort_order, cd.categories_name");
  while ($categories = tep_db_fetch_array($categories_query))  {
// hide categories when they are active
	if (strpos($categories['categories_name'], CATEGORY_HIDE_1) !== FALSE)
      continue;
	if (strpos($categories['categories_name'], CATEGORY_HIDE_2) !== FALSE)
      continue;
	if (strpos($categories['categories_name'], CATEGORY_HIDE_3) !== FALSE)
      continue;
	if (strpos($categories['categories_name'], CATEGORY_HIDE_4) !== FALSE)
      continue;
	if (strpos($categories['categories_name'], CATEGORY_HIDE_5) !== FALSE)
      continue;
	if (strpos($categories['categories_name'], CATEGORY_HIDE_6) !== FALSE)
      continue;
	if (strpos($categories['categories_name'], CATEGORY_HIDE_7) !== FALSE)
      continue;
	if (strpos($categories['categories_name'], CATEGORY_HIDE_8) !== FALSE)
      continue;
	if (strpos($categories['categories_name'], CATEGORY_HIDE_9) !== FALSE)
      continue;
	if (strpos($categories['categories_name'], CATEGORY_HIDE_10) !== FALSE)
      continue;

// show tree
	$tree[$categories['categories_id']] = array('name' => $categories['categories_name'],
                                                'parent' => $categories['parent_id'],
                                                'level' => 0,
                                                'path' => $categories['categories_id'],
                                                'next_id' => false);

    if (isset($parent_id)) {
      $tree[$parent_id]['next_id'] = $categories['categories_id'];
    }

    $parent_id = $categories['categories_id'];

    if (!isset($first_element)) {
      $first_element = $categories['categories_id'];
    }
  }

  //------------------------
  if (tep_not_null($cPath)) {
    $new_path = '';
    reset($cPath_array);
    while (list($key, $value) = each($cPath_array)) {
      unset($parent_id);
      unset($first_id);
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$value . "' and c.status_categ = '1' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languages_id ."' order by sort_order, cd.categories_name");
      if (tep_db_num_rows($categories_query)) {
        $new_path .= $value;
        while ($row = tep_db_fetch_array($categories_query)) {
          $tree[$row['categories_id']] = array('name' => $row['categories_name'],
                                               'parent' => $row['parent_id'],
                                               'level' => $key+1,
                                               'path' => $new_path . '_' . $row['categories_id'],
                                               'next_id' => false);

          if (isset($parent_id)) {
            $tree[$parent_id]['next_id'] = $row['categories_id'];
          }

          $parent_id = $row['categories_id'];

          if (!isset($first_id)) {
            $first_id = $row['categories_id'];
          }

          $last_id = $row['categories_id'];
        }
        $tree[$last_id]['next_id'] = $tree[$value]['next_id'];
        $tree[$value]['next_id'] = $first_id;
        $new_path .= '_';
      } else {
        break;
      }
    }
  }
  tep_show_category($first_element);

  $boxContent .= $categories_string;

if (USE_RECENTLY_VIEWED_LINK == 'true') { 
 if ( (basename($PHP_SELF) != FILENAME_RECENTLY_VIEWED)) {
							$boxContent .= '<br><left>';
                            $boxContent .= '<font size=-2><b><a href="' . tep_href_link(FILENAME_RECENTLY_VIEWED, '', 'NONSSL') . '">' . BOX_HEADING_RECENTLY_VIEWED . '</a></b></font>';
 }else{
							$boxContent .= '<br><left>';
                            $boxContent .= '<font size=-2><b><a href="' . tep_href_link(FILENAME_RECENTLY_VIEWED, '', 'NONSSL') . '"><span class="activeText">' . BOX_HEADING_RECENTLY_VIEWED . '</a></b></font></span>';
  }
}
if (USE_BEST_SELLERS_LINK == 'true') { 
 if ( (basename($PHP_SELF) != FILENAME_BEST_SELLERS)) {
							$boxContent .= '<br><left>';
                            $boxContent .= '<font size=-2><b><a href="' . tep_href_link(FILENAME_BEST_SELLERS, '', 'NONSSL') . '">' . BOX_HEADING_BESTSELLERS . '</a></b></font>';
 }else{
							$boxContent .= '<br><left>';
                            $boxContent .= '<font size=-2><b><a href="' . tep_href_link(FILENAME_BEST_SELLERS, '', 'NONSSL') . '"><span class="activeText">' . BOX_HEADING_BESTSELLERS . '</a></b></font></span>';
  }
}
if (USE_FEATURED_PRODUCTS_LINK == 'true') { 
 if ( (basename($PHP_SELF) != FILENAME_FEATURED_PRODUCTS)) {
							$boxContent .= '<br><left>';
                            $boxContent .= '<font size=-2><b><a href="' . tep_href_link(FILENAME_FEATURED_PRODUCTS, '', 'NONSSL') . '">' . BOX_CATALOG_FEATURED_PRODUCTS . '</a></b></font>';
 }else{
							$boxContent .= '<br><left>';
                            $boxContent .= '<font size=-2><b><a href="' . tep_href_link(FILENAME_FEATURED_PRODUCTS, '', 'NONSSL') . '"><span class="activeText">' . BOX_CATALOG_FEATURED_PRODUCTS . '</a></b></font></span>';
  }
}
if (USE_SPECIALS_LINK == 'true') { 
 if ( (basename($PHP_SELF) != FILENAME_SPECIALS)) {
							$boxContent .= '<br><left>';
                            $boxContent .= '<font size=-2><b><a href="' . tep_href_link(FILENAME_SPECIALS, '', 'NONSSL') . '">' . BOX_HEADING_SPECIALS . '</a></b></font>';
 }else{
							$boxContent .= '<br><left>';
                            $boxContent .= '<font size=-2><b><a href="' . tep_href_link(FILENAME_SPECIALS, '', 'NONSSL') . '"><span class="activeText">' . BOX_HEADING_SPECIALS . '</a></b></font></span>';
  }
}
if (USE_WHATS_NEW_LINK == 'true') { 
 if ( (basename($PHP_SELF) != FILENAME_PRODUCTS_NEW)) {
							$boxContent .= '<br><left>';
                            $boxContent .= '<font size=-2><b><a href="' . tep_href_link(FILENAME_PRODUCTS_NEW, '', 'NONSSL') . '">' . BOX_HEADING_WHATS_NEW . '</a></b></font>';
 }else{
							$boxContent .= '<br><left>';
                            $boxContent .= '<font size=-2><b><a href="' . tep_href_link(FILENAME_PRODUCTS_NEW, '', 'NONSSL') . '"><span class="activeText">' . BOX_HEADING_WHATS_NEW . '</a></b></font></span>';
  }
}
  function tep_get_paths($categories_array = '', $parent_id = '0', $indent = '', $path='') {
    global $languages_id;

    if (!is_array($categories_array)) $categories_array = array();

    $categories_query = tep_db_query("select c.categories_id, cd.categories_name from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where parent_id = '" . (int)$parent_id . "' and c.status_categ = '1' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by sort_order, cd.categories_name");
    while ($categories = tep_db_fetch_array($categories_query)) {
      if ($parent_id=='0'){
	$categories_array[] = array('id' => $categories['categories_id'],
                                      'text' => $indent . $categories['categories_name']);
      }
      else{
	$categories_array[] = array('id' => $path . $parent_id . '_' .$categories['categories_id'],
        	                          'text' => $indent . $categories['categories_name']);
      }

      if ($categories['categories_id'] != $parent_id) {
	$this_path=$path;
	if ($parent_id != '0')
	  $this_path = $path . $parent_id . '_';
        $categories_array = tep_get_paths($categories_array, $categories['categories_id'], $indent . '&nbsp;', $this_path);
      }
    }

    return $categories_array;
  }
  $info_box_contents[] = array('form' => '<form action="' . tep_href_link(FILENAME_DEFAULT) . '" method="get">' . tep_hide_session_id(),
                               'align' => 'left',
                               'text'  => '<b>' . BOX_DROPDOWN_MENU . '<br>' . tep_draw_pull_down_menu('cPath', tep_get_paths(array(array('id' => '', 'text' => PULL_DOWN_DEFAULT))), $cPath, 'onchange="this.form.submit();" style="width: 100%"')
                              );
include (bts_select('boxes', $box_base_name));

?>
<!-- categories_eof //-->