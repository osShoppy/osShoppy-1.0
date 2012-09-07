<?php // follow_us_column infobox ?>
<!-- follow_us_box //-->
<?php
  $boxHeading = BOX_HEADING_FOLLOW_US;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $boxContent_attributes = ' align="center"';
  $box_base_name = 'follow_us_column'; // for easy unique box template setup (added BTSv1.2)

  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  $boxContent = '<center>';

include (bts_select('boxes', $box_base_name)); // BTS 1.5
  $boxContent_attributes = '';

?>
<!-- follow_us_box_eof //-->