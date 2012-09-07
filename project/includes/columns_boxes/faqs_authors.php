<?php //faq_authors_column infobox

  $authors_query = tep_db_query("select faq_authors_id, faq_authors_name from " . TABLE_FAQ_AUTHORS . " order by faq_authors_name");
  if ($number_of_author_rows = tep_db_num_rows($authors_query)) {
?>
<!-- authors //-->
<?php
  $boxHeading = BOX_HEADING_FAQ_AUTHOR;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'faqs_authors_column'; // for easy unique box template setup (added BTSv1.2)

  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

    if ($number_of_author_rows <= MAX_DISPLAY_FAQ_AUTHORS_IN_A_LIST) {
// Display a list
      $authors_list = '';
      while ($authors = tep_db_fetch_array($authors_query)) {
        $authors_name = ((strlen($authors['faq_authors_name']) > MAX_DISPLAY_FAQ_AUTHOR_NAME_LEN) ? substr($authors['faq_authors_name'], 0, MAX_DISPLAY_FAQ_AUTHOR_NAME_LEN) . '..' : $authors['faq_authors_name']);
        if (isset($_GET['faq_authors_id']) && ($_GET['faq_authors_id'] == $authors['faq_authors_id'])) $authors_name = '<b>' . $authors_name .'</b>';
        $authors_list .= '<a href="' . tep_href_link(FILENAME_FAQS, 'faq_authors_id=' . $authors['faq_authors_id']) . '">' . $authors_name . '</a><br>';
      }

      $authors_list = substr($authors_list, 0, -4);

      $boxContent = $authors_list;
    } else {
// Display a drop-down
      $authors_array = array();
      if (MAX_FAQ_AUTHORS_LIST < 2) {
        $authors_array[] = array('id' => '', 'text' => PULL_DOWN_DEFAULT);
      }

      while ($authors = tep_db_fetch_array($authors_query)) {
        $authors_name = ((strlen($authors['faq_authors_name']) > MAX_DISPLAY_FAQ_AUTHOR_NAME_LEN) ? substr($authors['faq_authors_name'], 0, MAX_DISPLAY_FAQ_AUTHOR_NAME_LEN) . '..' : $authors['faq_authors_name']);
        $authors_array[] = array('id' => $authors['faq_authors_id'],
                                       'text' => $authors_name);
      }

      $boxHeading = BOX_HEADING_FAQ_AUTHORS;
      $boxContent = tep_draw_form('faq_authors', tep_href_link(FILENAME_FAQS, '', 'NONSSL', false), 'get');
                                   $boxContent = tep_draw_pull_down_menu('faq_authors_id', $authors_array, (isset($_GET['faq_authors_id']) ? $_GET['faq_authors_id'] : ''), 'onChange="this.form.submit();" size="' . MAX_FAQ_AUTHORS_LIST . '" style="width: 100%"') . tep_hide_session_id();
    }


include (bts_select('boxes', $box_base_name)); // BTS 1.5
?>
<!-- authors_eof //-->
<?php
  }
?>
