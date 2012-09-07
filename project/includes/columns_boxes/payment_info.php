<?php // payment info_column infobox 

  $boxHeading = BOX_HEADING_PAYMENT_INFO;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'payment_info_column'; // for easy unique box template setup (added BTSv1.2)

  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  $boxContent = '<center>';

include (bts_select('boxes', $box_base_name)); // BTS 1.5

?>
