<?php // affiliate infobox

  $boxHeading = BOX_HEADING_AFFILIATE;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'affiliate';

  if (tep_session_is_registered('affiliate_id')) {

    $affiliatebox = '<b><a href="' . tep_href_link(FILENAME_AFFILIATE_SUMMARY, '', 'SSL') . '">' . BOX_AFFILIATE_SUMMARY . '</a></b><br>' .
                                            '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_ACCOUNT, '', 'SSL') . '">' . BOX_AFFILIATE_ACCOUNT . '</a><br>' .
                                            '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_PASSWORD, '', 'SSL') . '">' . BOX_AFFILIATE_PASSWORD . '</a><br>' .
                                            '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_NEWSLETTER, '', 'SSL') . '">' . BOX_AFFILIATE_NEWSLETTER . '</a><br>' .
                                            '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_NEWS, '', 'SSL') . '">' . BOX_AFFILIATE_NEWS . '</a><br>' .
											'<b><a href="' . tep_href_link(FILENAME_AFFILIATE_BANNERS, '', 'SSL') . '">' . BOX_AFFILIATE_BANNERS . '</a></b><br>' .
											'&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_BANNERS_BANNERS, '', 'SSL') . '">' . BOX_AFFILIATE_BANNERS_BANNERS . '</a><br>' .
                                            '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_BANNERS_BUILD, '', 'SSL') . '">' . BOX_AFFILIATE_BANNERS_BUILD . '</a><br>' .
                                            '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_BANNERS_PRODUCT, '', 'SSL') . '">' . BOX_AFFILIATE_BANNERS_PRODUCT . '</a><br>' .
											'&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_BANNERS_BUILD_CAT, '', 'SSL') . '">' . BOX_AFFILIATE_BANNERS_BUILD_CAT . '</a><br>' .
											'&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_BANNERS_CATEGORY, '', 'SSL') . '">' . BOX_AFFILIATE_BANNERS_CATEGORY . '</a><br>' .
                                            '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_BANNERS_TEXT, '', 'SSL') . '">' . BOX_AFFILIATE_BANNERS_TEXT . '</a><br>' .
                                            '<b><a href="' . tep_href_link(FILENAME_AFFILIATE_REPORTS, '', 'SSL') . '">' . BOX_AFFILIATE_REPORTS . '</a></b><br>' .
                                  		    '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_CLICKS, '', 'SSL'). '">' . BOX_AFFILIATE_CLICKRATE . '</a><br>' .
                                            '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_SALES, '', 'SSL'). '">' . BOX_AFFILIATE_SALES . '</a><br>' .
                                            '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_PAYMENT, '', 'SSL'). '">' . BOX_AFFILIATE_PAYMENT . '</a><br>' .
                                            '<a href="' . tep_href_link(FILENAME_CONTACT_US, '', 'SSL') . '">' . BOX_AFFILIATE_CONTACT . '</a><br>' .
                                            '<a href="' . tep_href_link(FILENAME_AFFILIATE_FAQ, '', 'SSL') . '">' . BOX_AFFILIATE_FAQ . '</a><br>' .
                                            '<a href="' . tep_href_link(FILENAME_AFFILIATE_LOGOUT). '">' . BOX_AFFILIATE_LOGOUT . '</a>';

  $box_id = $box_base_name . 'Box';
  $boxContent = $affiliatebox;
  include (bts_select('boxes', $box_base_name));

	} else {

  $boxHeading = BOX_HEADING_AFFILIATE;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'affiliate';
  
  $affiliatebox = '<a href="' . tep_href_link(FILENAME_AFFILIATE, '', 'SSL') . '">' . BOX_AFFILIATE_LOGIN . '</a><br>'.
				  '<a href="' . tep_href_link(FILENAME_AFFILIATE_INFO, '', 'NONSSL'). '">' . BOX_AFFILIATE_INFO . '</a><br>' .
                  '<a href="' . tep_href_link(FILENAME_AFFILIATE_FAQ, '', 'NONSSL') . '">' . BOX_AFFILIATE_FAQ . '</a>';

  $box_id = $box_base_name . 'Box';
  $boxContent = $affiliatebox;
  include (bts_select('boxes', $box_base_name));
  }
?>
            </td>
          </tr>