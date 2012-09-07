<?php // information infobox 

  $boxHeading = BOX_HEADING_INFORMATION;
  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
  $corner_bot_left = 'rounded';
  $corner_bot_right = 'rounded';
  $box_base_name = 'information';
  
  $box_id = $box_base_name . 'Box';

  $info_box_contents = array();

  /********************* BUILD ABOUT US LINK ********************/  
  if (USE_INFORMATION_LINK_ABOUT_US == 'true') {
      $sortArray['about_us_link']['sort_order'] = ABOUT_US_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_ABOUT_US);
      $sortArray['about_us_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_ABOUT_US, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_ABOUT_US . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD SHIPPING LINK ********************/
  if (USE_INFORMATION_LINK_SHIPPING == 'true') {    
      $sortArray['shipping_link']['sort_order'] = SHIPPING_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_SHIPPING);
      $sortArray['shipping_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_SHIPPING, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_SHIPPING . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD PRIVACY LINK ********************/
  if (USE_INFORMATION_LINK_PRIVACY == 'true') {    
      $sortArray['privacy_link']['sort_order'] = PRIVACY_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_PRIVACY);
      $sortArray['privacy_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_PRIVACY, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_PRIVACY . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD CONDITONS LINK ********************/
  if (USE_INFORMATION_LINK_CONDITIONS == 'true') {    
      $sortArray['conditions_link']['sort_order'] = CONDITIONS_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_CONDITIONS);
      $sortArray['conditions_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_CONDITIONS, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_CONDITIONS . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD CONTACT US LINK ********************/
  if (USE_INFORMATION_LINK_CONTACT_US == 'true') {    
      $sortArray['contact_us_link']['sort_order'] = CONTACT_US_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_CONTACT_US);
      $sortArray['contact_us_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_CONTACT_US, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_CONTACT . $boldTags['stop'] . '</a><br>'; 
  }
  /********************* BUILD FAQ LINK ********************/  
  if (USE_INFORMATION_LINK_FAQ == 'true') {
    if (USE_FAQ_SINGLE_MULTIPLE == 'single') {
      $sortArray['faq_articles_link']['sort_order'] = FAQ_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_FAQ);
      $sortArray['faq_articles_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_FAQ, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_FAQ . $boldTags['stop'] . '</a><br>'; 
  } else {
      $sortArray['faq_articles_link']['sort_order'] = FAQ_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_FAQS);
      $sortArray['faq_articles_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_FAQS, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_FAQ . $boldTags['stop'] . '</a><br>'; 
    }
  }
    /********************* BUILD ARTICLES LINK ********************/
  if (USE_INFORMATION_LINK_ARTICLES == 'true') {    
      $sortArray['articles_link']['sort_order'] = ARTICLES_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_ARTICLES);
      $sortArray['articles_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_ARTICLES, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_ARTICLES . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD GENERAL INFO LINK ********************/
  if (USE_INFORMATION_LINK_GENERAL_INFO == 'true') {    
      $sortArray['info_articles_link']['sort_order'] = GENERAL_INFO_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_GENERAL_INFORMATION);
      $sortArray['info_articles_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_GENERAL_INFORMATION, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_GENERAL_INFO . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD TESTIMONIALS LINK ********************/
  if (USE_INFORMATION_LINK_TESTIMONIALS == 'true') {    
      $sortArray['testimonial_link']['sort_order'] = TESTIMONIALS_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_CUSTOMER_TESTIMONIALS);
      $sortArray['testimonial_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_CUSTOMER_TESTIMONIALS, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_TESTIMONIALS . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD GALLERY LINK ********************/
  if (USE_INFORMATION_LINK_GALLERY == 'true') {    
      $sortArray['gallery_link']['sort_order'] = GALLERY_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_GALLERY);
      $sortArray['gallery_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_GALLERY, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_GALLERY . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD REFERENCES LINK ********************/
  if (USE_INFORMATION_LINK_REFERENCES == 'true') {    
      $sortArray['reference_link']['sort_order'] = REFERENCES_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_REFERENCES);
      $sortArray['reference_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_REFERENCES, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_REFERENCES . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD POLLS LINK ********************/
  if (USE_INFORMATION_LINK_POLLS == 'true') {    
      $sortArray['polls_link']['sort_order'] = POLLS_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_POLLBOOTH);
      $sortArray['polls_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_POLLBOOTH, '?op=list', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_POLLS . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD LINKS LINK ********************/
  if (USE_INFORMATION_LINK_LINKS == 'true') {    
      $sortArray['links_link']['sort_order'] = LINKS_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_LINKS);
      $sortArray['links_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_LINKS, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_LINKS . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD ALL PRODS LINK ********************/
  if (USE_INFORMATION_LINK_ALL_PRODS == 'true') {    
      $sortArray['all_prods_link']['sort_order'] = ALL_PRODS_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_ALLPRODS);
      $sortArray['all_prods_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_ALLPRODS, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_ALL_PRODS . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD PAYMENT LINK ********************/
  if (USE_INFORMATION_LINK_PAYMENT == 'true') {    
      $sortArray['payment_link']['sort_order'] = PAYMENT_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_PAYMENT);
      $sortArray['payment_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_PAYMENT, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_PAYMENT . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD DOCUMENTS LINK ********************/
  if (USE_INFORMATION_LINK_DOCUMENTS == 'true') {    
      $sortArray['documents_link']['sort_order'] = DOCUMENTS_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_DOCUMENTS);
      $sortArray['documents_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_DOCUMENTS, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_DOCUMENTS . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD RETURN TRACK LINK ********************/
  if (USE_INFORMATION_LINK_RETURNS_TRACK == 'true') {    
      $sortArray['returns_track_link']['sort_order'] = RETURNS_TRACK_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_RETURNS_TRACK);
      $sortArray['returns_track_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_RETURNS_TRACK, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_RETURNS_TRACK . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD FREE DOWNLOADS LINK ********************/
  if (USE_INFORMATION_LINK_FREE_DOWNLOADS == 'true') {    
      $sortArray['free_downloads_link']['sort_order'] = FREE_DOWNLOADS_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_FREE_DOWNLOADS);
      $sortArray['free_downloads_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_FREE_DOWNLOADS, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_FREE_DOWNLOADS . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD QUOTES LINK ********************/
  if (USE_INFORMATION_LINK_QUOTES == 'true') {    
      $sortArray['quotes_link']['sort_order'] = QUOTES_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_QUOTES);
      $sortArray['quotes_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_QUOTES, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_QUOTES . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD TICKET CREATE LINK ********************/
  if (USE_INFORMATION_LINK_TICKETS_CREATE == 'true') {    
      $sortArray['tickets_create_link']['sort_order'] = TICKETS_CREATE_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_ACCOUNT_TICKETS_CREATE);
      $sortArray['tickets_create_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_ACCOUNT_TICKETS_CREATE, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_TICKETS_CREATE . $boldTags['stop'] . '</a><br>'; 
  }
    /********************* BUILD TICKET VIEW LINK ********************/
  if (USE_INFORMATION_LINK_TICKETS_VIEW == 'true') {    
      $sortArray['tickets_view_link']['sort_order'] = TICKETS_VIEW_INFORMATION_LINK_SORT_ORDER;
      $boldTags = GetBoldTags(FILENAME_ACCOUNT_TICKETS_VIEW);
      $sortArray['tickets_view_link']['string'] = tep_image(DIR_WS_IMAGES . 'icons/arrows/ico_arrow.gif') . '&nbsp;' . '<a href="' . tep_href_link(FILENAME_ACCOUNT_TICKETS_VIEW, '', 'NONSSL') . '">' . $boldTags['start'] . BOX_INFORMATION_TICKETS_VIEW . $boldTags['stop'] . '</a><br>'; 
  }

  usort($sortArray, "SortBySetting"); 
    
  /********************* DISPLAY IT ALL ********************/  
  $final = '';
  foreach ($sortArray as $item)
  {
     $final .= $item['string'] .'';
  }
  $final = substr($final, 0, -4);
  $boxContent = $final;
  $box_id = $box_base_name . 'Box';
  include (bts_select('boxes', $box_base_name));
?>