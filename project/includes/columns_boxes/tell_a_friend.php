<?php // tell_a_friend_column infobox 

  $boxHeading = BOX_HEADING_TELL_A_FRIEND;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $boxContent_attributes = ' align="center"';

  $box_base_name = 'tell_a_friend_column'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  $boxContent = tep_draw_form('tell_a_friend', tep_href_link(FILENAME_TELL_A_FRIEND, '', 'NONSSL', false), 'get');
  $boxContent .= tep_draw_input_field('to_email_address', '', 'size="10"') . '&nbsp;' . tep_image_submit('button_tell_a_friend.gif', BOX_HEADING_TELL_A_FRIEND) . tep_draw_hidden_field('products_id', $HTTP_GET_VARS['products_id']) . tep_hide_session_id() . '<br>' . BOX_TELL_A_FRIEND_TEXT;
  $boxContent .= '</form>';

include (bts_select('boxes', $box_base_name)); // BTS 1.5

  $boxContent_attributes = '';
?>
