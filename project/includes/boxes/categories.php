<?php // categories infobox 

  $boxHeading = BOX_HEADING_CATEGORIES;
  $corner_top_left = 'rounded';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'categories';
  $box_id = $box_base_name . 'Box';

  function tep_show_category($counter) {
    global $tree, $boxContent, $cPath_array;

    for ($i=0; $i<$tree[$counter]['level']; $i++) {
    $boxContent .= "&nbsp;&nbsp;";
    }
    $boxContent .= '<a href="';

    if ($tree[$counter]['parent'] == 0) {
      $cPath_new = 'cPath=' . $counter;
    } else {
      $cPath_new = 'cPath=' . $tree[$counter]['path'];
    }
    $boxContent .= tep_href_link(FILENAME_DEFAULT, $cPath_new);
    $boxContent .= '">';

    if (isset($cPath_array) && in_array($counter, $cPath_array)) {
      $boxContent .= '<b>';
    }

	// display category name
    $boxContent .= $tree[$counter]['name'];
    if (isset($cPath_array) && in_array($counter, $cPath_array)) {
      $boxContent .= '</b>';
    }

    if (tep_has_category_subcategories($counter)) {
      $boxContent .= '-&gt;';
    }
    $boxContent .= '</a>';

    if (SHOW_COUNTS == 'true') {
      $products_in_category = tep_count_products_in_category($counter);
      if ($products_in_category > 0) {
        $boxContent .= '&nbsp;(' . $products_in_category . ')';
      }
    }

    $boxContent .= '<br>';

    if ($tree[$counter]['next_id'] != false) {
      tep_show_category($tree[$counter]['next_id']);
    }
  }

  $boxContent = '';
  $tree = array();
  $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '0' and c.status_categ = '1' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languages_id ."' order by sort_order, cd.categories_name");
  while ($categories = tep_db_fetch_array($categories_query))  {
// hide categories when they are active
//	if (strpos($categories['categories_name'], 'Quotes') !== FALSE)
//      continue;

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
  include (bts_select('boxes', $box_base_name));
?>