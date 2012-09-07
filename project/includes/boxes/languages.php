<?php // languages infobox 

  $boxHeading = BOX_HEADING_LANGUAGES;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $boxContent_attributes = ' align="center"';

  $box_base_name = 'languages';

  $box_id = $box_base_name . 'Box';

  if (!isset($lng) || (isset($lng) && !is_object($lng))) {
    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language;
  }

  $boxContent = '';

  reset($lng->catalog_languages);
   while (list($key, $value) = each($lng->catalog_languages)) {

    $boxContent .= ' <a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('language', 'currency')) . 'language=' . $key, $request_type) . '">' . tep_image(DIR_WS_LANGUAGES .  $value['directory'] . '/images/' . $value['image'], $value['name']) . '</a> ';
  }
  include (bts_select('boxes', $box_base_name));
  $boxContent_attributes = '';
?>
