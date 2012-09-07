<?php // youtube_column infobox 

  $youtube = '<div align="center">
<iframe src="http://'. STORE_URL . '/utube.html" height="165" width="100%" frameborder="0" scrolling="no">
    Browser ondersteunt geen inline frames.
   </iframe></div>';

  $boxHeading = BOX_HEADING_YOUTUBE;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'youtube_column'; // for easy unique box template setup (added BTSv1.2)

  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
  $boxContent = $youtube;

include (bts_select('boxes', $box_base_name)); // BTS 1.5

?>
