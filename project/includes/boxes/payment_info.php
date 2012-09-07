<?php // payment info infobox 

  $boxHeading = BOX_HEADING_PAYMENT_INFO;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'payment_info';

  $box_id = $box_base_name . 'Box';
  $boxContent = '<center>';
  include (bts_select('boxes', $box_base_name));
?>