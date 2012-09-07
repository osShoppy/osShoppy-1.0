<?php // search infobox 

  $boxHeading = BOX_HEADING_SEARCH;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $boxContent_attributes = ' align="center"';

  $box_base_name = 'search';

  $boxContent = tep_draw_form('quick_find', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get');
  $boxContent .= tep_draw_hidden_field('search_in_description','1') . tep_draw_input_field('keywords', '', 'size="10" maxlength="30" ') . '&nbsp;' . tep_hide_session_id() . tep_image_submit('button_quick_find.gif', BOX_HEADING_SEARCH) . '<br>' . BOX_SEARCH_TEXT . '<br><a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH) . '"><b>' . BOX_SEARCH_ADVANCED_SEARCH . '</b></a>';
  $boxContent .= '</form>';

  $box_id = $box_base_name . 'Box';
  include (bts_select('boxes', $box_base_name));
  $boxContent_attributes = '';
?>
