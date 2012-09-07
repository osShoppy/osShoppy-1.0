<?php // youtube infobox 

  $youtube = '<div align="center">
   <iframe src="http://'. STORE_URL . '/utube.html" height="165" width="100%" frameborder="0" scrolling="no">
   Browser ondersteunt geen inline frames.
   </iframe></div>';

  $boxHeading = BOX_HEADING_YOUTUBE;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'youtube';

  $box_id = $box_base_name . 'Box';
  $boxContent = $youtube;

  include (bts_select('boxes', $box_base_name));
?>