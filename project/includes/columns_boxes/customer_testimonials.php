<?php //faq_articles infobox

// Display the column infobox only if admin has turned on the mod
// Also check to see if viewing is restricted to registered users only 
// or if admin settings indicate all users may view testimonials
  if ((TESTIMONIAL_ACTIVE == 'Yes') && ( ((TESTIMONIAL_REGISTERED_VIEW == "Registered Users Only") && (tep_session_is_registered('customer_id'))) || (TESTIMONIAL_REGISTERED_VIEW == "All Users") ) ) {

// create Write Testimonial link, if applicable
		$testimonial_write_link = '';
		if (((TESTIMONIAL_REGISTERED_WRITE == "Registered Users Only") && (tep_session_is_registered('customer_id'))) || (TESTIMONIAL_REGISTERED_WRITE == "All Users")) {
			$testimonial_write_link = tep_draw_separator('h_gray_middle.gif', '100%', '2') . '<center><a href="' . tep_href_link(FILENAME_CUSTOMER_TESTIMONIALS_WRITE, tep_get_all_get_params(array('language', 'currency'))) . '">' . IMAGE_BUTTON_WRITE_TESTIMONIAL . '</a></center>';
		}

// Count how many testimonials in database that match user's language
// Also check for minimum number of records if Scrolling feature active
	if (TESTIMONIAL_SCROLL == "Scrolling") {
		$testimonials_limit = TESTIMONIALS_SCROLL_TRIGGER; 		
	} else {
		$testimonials_limit = 1;
	}

// Count how many testimonials in database that match user's language
	$testimonials_new_query = tep_db_query("select * FROM " . TABLE_CUSTOMER_TESTIMONIALS . " WHERE status = 1 AND language_id = $languages_id ORDER BY rand() LIMIT " . $testimonials_limit); 
	$testimonial_count = tep_db_num_rows($testimonials_new_query); 

// Begin infobox heading
  $boxHeading = BOX_HEADING_CUSTOMER_TESTIMONIALS;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
// End infobox heading

// Begin infobox content
  $info_box_contents = array();

// Check to see if any testimonials exist
	if ($testimonial_count == 0) {
// if not then just show Write Testimonial link, if appliable
    $info_box_contents[] = array('text' => $testimonial_write_link);
	new infoBox($info_box_contents);
	} else {

// Now figure out how many Testimonials to get from the database
// If Scrolling is turned on but we don't have enough testimonials to trigger scrolling, default to Static display 
// and just pull 1 random testimonial
	  	if (($testimonial_count < TESTIMONIALS_SCROLL_TRIGGER) || (TESTIMONIAL_SCROLL != "Scrolling")) {

// ***
// Start Static display
// ***
			$random_testimonial = tep_random_select("select * FROM " . TABLE_CUSTOMER_TESTIMONIALS . " WHERE status = 1 AND language_id = $languages_id ORDER BY rand() LIMIT 1");
	    	$testimonial = strip_tags($random_testimonial['testimonials_html_text']);
	    	$testimonial_titulo = $random_testimonial['testimonials_title'];

            $testimonials_contents = '<b><center>' . $testimonial_titulo . '</center></b><br>' . (strlen($testimonial) > 100 ? substr($testimonial,0,100) . ' ...': $testimonial) . '<br /><br /><a href="' . tep_href_link(FILENAME_CUSTOMER_TESTIMONIALS, tep_get_all_get_params(array('language', 'currency')) .'testimonial_id=' . $random_testimonial['testimonials_id']) . '"><span><center>' . TEXT_READ_MORE . '</center></span></a><br><span><center><b> By '.$random_testimonial['testimonials_name'].'</b></center></span><br>' . $testimonial_write_link;

// ***
// End Static display
// ***
	    } else {

// *** 
// *** Scrolling subroutine ***
// *** 
    $rows = 0;
// limit number of testimonials we pull from database
    if ($testimonial_count > TESTIMONIALS_LIMIT) $testimonial_count = TESTIMONIALS_LIMIT;
    $testimonials_list = '<table border="0" width="100%" cellspacing="0" cellpadding="1">';
    while ($rows != $testimonial_count) {
		$rows++;
// pick one randomly
		$random_testimonial = tep_random_select("select * FROM " . TABLE_CUSTOMER_TESTIMONIALS . " WHERE status = 1 AND language_id = $languages_id ORDER BY rand() LIMIT 1");

// draw the text
      	$testimonial_list .= '<tr><td class="infoBoxContents" valign="top" align="left">';  
		$testimonial = strip_tags($random_testimonial['testimonials_html_text']);
	    $testimonial_titulo = $random_testimonial['testimonials_title'];
	    $testimonials_list .= '<center><b>' . $testimonial_titulo . '</center></b><br>' . (strlen($testimonial) > 100 ? substr($testimonial,0,100) . ' ...': $testimonial) . '<br /><br /><a href="' . tep_href_link(FILENAME_CUSTOMER_TESTIMONIALS, tep_get_all_get_params(array('language', 'currency')) .'testimonial_id=' . $random_testimonial['testimonials_id']) . '"><span><center>' . TEXT_READ_MORE . '</center></span></a><br><span><center><b> By '.$random_testimonial['testimonials_name'].'</b></center></span><br><br>';
        $testimonials_list .= '</td></tr>';
    	}
       $testimonials_list .= '</table>';
       $info_box_contents = array();
  	   $testimonials_contents = '<div id="marquee" class="marquee_hide"><MARQUEE behavior= "scroll" align= "center" direction= "'.TESTIMONIAL_SCROLL_DIR.'" height="'.TESTIMONIAL_SCROLL_HEIGHT.'" scrollamount= "2" scrolldelay= "'.TESTIMONIAL_SCROLL_DELAY.'" onmouseover=\'this.stop()\' onmouseout=\'this.start()\'>'.$testimonials_list.'</MARQUEE></div>'.$testimonial_write_link;

?>

<!-- Make sure we don't interrupt any other onLoad event -->
<!-- Load event handler by Peter-Paul Koch -->
<script type="text/javascript">
function addLoadEvent(func) {
  var oldonload = window.onload;
  if (typeof window.onload != 'function') {
    window.onload = func;
  } else {
    window.onload = function() {
      if (oldonload) {
        oldonload();
      }
      func();
    }
  }
}

addLoadEvent(function() {
     document.getElementById('marquee').className='marquee_show'; 
});
</script>

<?php
    	
  } 
// *** 
// *** End scrolling
// *** 
  
} // jump here if there were no testimonials

  $box_base_name = 'customer_testimonials';
  $box_id = $box_base_name . 'Box';
  $boxContent = $testimonials_contents;
  include (bts_select('boxes', $box_base_name));
	}
?>

<!-- customer testimonials_eof //-->
