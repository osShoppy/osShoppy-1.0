<?php // qr_code infobox 

  $boxHeading = BOX_HEADING_QRCODE;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'qr_code_column';
  
  $boxContent = '<center><img src="https://chart.googleapis.com/chart?chs=100x100&cht=qr&chl=http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"] . '" width="100" height="100"><br>';

  $box_id = $box_base_name . 'Box';
  include (bts_select('boxes', $box_base_name));
?>