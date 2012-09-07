<?php // empty_box infobox 

  $boxHeading = BOX_HEADING_EMPTY_BOX;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  //$boxLink = '<a href="' . tep_href_link(FILENAME_DEFAULT) . '"><img src="images/infobox/arrow_right_3.gif" border="0" alt="more" title="more" width="12" height="10"></a>';
  //$boxContent_attributes = ' align="center"';
  $box_base_name = 'empty_box';
  
  $box_id = $box_base_name . 'Box';
  $boxContent = '<center>';
  include (bts_select('boxes', $box_base_name));
  //$boxContent_attributes = '';
  //$boxLink = '';
?>
