<?php // onliners_column infobox 

require_once(DIR_WS_FUNCTIONS . 'onliners.php');
require_once(DIR_WS_INCLUDES . 'counter.php');
require_once(DIR_WS_INCLUDES . 'counts.php');
require_once(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DEFAULT);

  $boxHeading = BOX_HEADING_ONLINECOUNTER;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'onliners_column'; // for easy unique box template setup (added BTSv1.2)

  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  $boxContent =  GUESTSONLINE_FIELD.' <b>'.$nowonline.'</b><br />'.
                                          TOTAL_ONLINE.' <b>'.$productsonline.'</b><br />'.
										  MOSTEVER_FIELD.' <b>'.$mostonline.'</b><br />'.
										  '<center><b>'.$totalonline.'</b> '.ONLINESINDS_FIELD.' <b><br>'.$sinds.'</b><br /><br />'.
										  PAGEVIEWS_FIELD. '<b>'.$counter_now. '</b><br />';                                         
                                         
include (bts_select('boxes', $box_base_name)); // BTS 1.5
?>
