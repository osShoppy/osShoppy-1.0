<?php // latest_news info infobox 

  $page_query = tep_db_query("select p.pages_id, p.sort_order, p.status, s.pages_title, s.pages_html_text, s.intorext, s.externallink, s.link_target from " . TABLE_PAGES . " p LEFT JOIN " .TABLE_PAGES_DESCRIPTION . " s on p.pages_id = s.pages_id where p.status = 1 and p.page_type != 1 and s.language_id = '" . (int)$languages_id . "'order by p.sort_order, s.pages_title");

  $boxHeading = BOX_HEADING_LATEST_NEWS;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'latest_news';

  $rows = 0;
  $page_list = '<table border="0" width="100%" cellspacing="0" cellpadding="1">';
    while ($page = tep_db_fetch_array($page_query)) {
      $rows++;
		$target="";
			if($page['link_target']== 1)  {
			$target="_blank";
			}
		if($page['pages_title'] != 'Contact Us'){
			$link = FILENAME_PAGES . '?pages_id=' . $page['pages_id'];
		}else{
		$link = FILENAME_CONTACT_US;
		}
		if($page['intorext'] == 1)  {
		$page_list .= '<tr><td class="infoBoxContents"><a target="'.$target.'" href="' . $page['externallink'] . '">' . $page['pages_title'] . '</a></td></tr>';
		} else {
		$page_list .= '<tr><td class="infoBoxContents"><a target="'.$target.'" href="' . tep_href_link(FILENAME_PAGES, 'pages_id=' .$page['pages_id'], 'NONSSL') . '">' . $page['pages_title'] . '</a></td></tr>';
		}
    }
  $page_list .= '</table>';
  $box_id = $box_base_name . 'Box';
  $boxContent = $page_list;
  include (bts_select('boxes', $box_base_name));
?>