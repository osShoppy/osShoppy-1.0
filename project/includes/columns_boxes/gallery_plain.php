<?php // shipping info infobox 

  $boxHeading = BOX_HEADING_GALLERY;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'gallery_plain_column';

  $gallery = '<center>';
  $gallery .= '<a href="' . tep_href_link(FILENAME_GALLERY) . '">'.TEXT_GALLERY.'.</a><br>'.'<a href="' . tep_href_link(FILENAME_GALLERY) . '">' . tep_image(DIR_WS_IMAGES .'imagegallery.png',BOX_GALLERY_TOOLTIP, PHOTO_GALLERY_PLAIN_INFOBOX_IMAGE_WIDTH, PHOTO_GALLERY_PLAIN_INFOBOX_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_GALLERY) . '">' . BOX_TEXT_GALLERY_LINK . '</a><br>';

  $box_id = $box_base_name . 'Box';

  $boxContent = $gallery;

include (bts_select('boxes', $box_base_name));
?>
