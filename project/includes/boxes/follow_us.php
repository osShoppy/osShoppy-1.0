<?php // follow_us infobox

  $boxHeading = BOX_HEADING_FOLLOW_US;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $boxContent_attributes = ' align="center"';
  $box_base_name = 'follow_us';

  $box_id = $box_base_name . 'Box';

  $boxContent = '<center>';
  include (bts_select('boxes', $box_base_name));
  $boxContent_attributes = '';
?>