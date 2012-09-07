<?php // catalog/includes/modules/main_cats.php (5119)

  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'left',
                               'text'  => '');
  new infoBoxHeading($info_box_contents, false, false);

  $row = 0;
  $col = 0;
  $width = (int)(100 / MAX_DISPLAY_CATEGORIES_INDEX_PER_ROW) . '%';
  $info_box_contents = array();
 	$result = tep_db_query("SELECT * FROM " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd WHERE c.parent_id = '0' and c.status_categ = '1' AND c.categories_id = cd.categories_id AND cd.language_id = '" . (int)$languages_id . "' ORDER BY sort_order ");
	while($data = tep_db_fetch_array($result)){
    $info_box_contents[$row][$col] = array('align' => 'center',
                                           'params' => 'class="smallText" width="' . $width . '" valign="top"',
                                           'text' => '<a href="' . tep_href_link(FILENAME_DEFAULT, tep_get_path($data['categories_id'])) . '">' . tep_image(DIR_WS_IMAGES . $data['categories_image'], $data['categories_name'], CATEGORY_INDEX_IMAGE_WIDTH, CATEGORY_INDEX_IMAGE_HEIGHT) . '<br>' . $data['categories_name']);

    $col ++;
    if ($col == MAX_DISPLAY_CATEGORIES_INDEX_PER_ROW) {
      $col = 0;
      $row ++;
    }
	}
  new contentBox($info_box_contents);
?>