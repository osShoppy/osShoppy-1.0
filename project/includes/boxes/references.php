<?php // references infobox 

  if ((REFERENCES_ACTIVE == 'Yes') && ( ((REFERENCES_REGISTERED_VIEW == "Registered Users Only") && (tep_session_is_registered('customer_id'))) || (REFERENCES_REGISTERED_VIEW == "All Users") ) ) {


// create Write Testimonial link, if applicable
		$references_write_link = '';
		if (((REFERENCES_REGISTERED_WRITE == "Registered Users Only") && (tep_session_is_registered('customer_id'))) || (REFERENCES_REGISTERED_WRITE == "All Users")) {
			$references_write_link = tep_draw_separator('h_gray_middle.gif', '100%', '3') . '<center><a href="' . tep_href_link(FILENAME_REFERENCES_WRITE, tep_get_all_get_params(array('language', 'currency'))) . '">' . IMAGE_BUTTON_WRITE_REFERENCES . '</a></center>';
		}

// Count how many testimonials in database that match user's language
// Also check for minimum number of records if Scrolling feature active
	if (REFERENCES_SCROLL == "Scrolling") {
		$references_limit = REFERENCES_SCROLL_TRIGGER; 		
	} else {
		$references_limit = 1;
	}

/*** Begin Scrolling Customer Testimonials v1.1 ***/
// check language display preference
	if (REFERENCES_LANG_PREF == "User Language Only") {  // display only localized testimonials?
// Count how many testimonials in database that match user's language
	$references_new_query = tep_db_query("select * FROM " . TABLE_SHOP_REFERENCES . " WHERE status = 1 AND language_id = $languages_id ORDER BY rand() LIMIT " . $references_limit); 
	} else {  // else count all testimonials for all languages
	$references_new_query = tep_db_query("select * FROM " . TABLE_SHOP_REFERENCES . " WHERE status = 1 ORDER BY rand() LIMIT " . $references_limit); 
	}
/*** End Scrolling Customer Testimonials v1.1 ***/
	$references_count = tep_db_num_rows($references_new_query);

// Begin infobox heading
  $boxHeading = BOX_HEADING_REFERENCES;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $boxLink = '<a href="' . tep_href_link(FILENAME_REFERENCES) . '"><img src="images/infobox/arrow_right_3.gif" border="0" alt="more" title="more" width="12" height="10"></a>';
// End infobox heading

// Begin infobox content
  $info_box_contents = array();

// Check to see if any testimonials exist
	if ($references_count == 0) {
// if not then just show Write Testimonial link, if appliable
    $info_box_contents[] = array('text' => $references_write_link);
	} else {

// Now figure out how many Testimonials to get from the database
// If Scrolling is turned on but we don't have enough testimonials to trigger scrolling, default to Static display 
// and just pull 1 random testimonial
	  	if (($references_count < REFERENCES_SCROLL_TRIGGER) || (REFERENCES_SCROLL != "Scrolling")) {

// ***
// Start Static display
// ***

/*** Begin Scrolling Customer Testimonials v1.1 ***/
// check language display preference
	if (REFERENCES_LANG_PREF == "User Language Only") {  // pick only a localized testimonial?
			$random_references = tep_random_select("select * FROM " . TABLE_SHOP_REFERENCES . " WHERE status = 1 AND language_id = $languages_id ORDER BY rand() LIMIT 1");
	} else {  // else pick one out of all testimonials for all languages
			$random_references = tep_random_select("select * FROM " . TABLE_SHOP_REFERENCES . " WHERE status = 1 ORDER BY rand() LIMIT 1");
	}
/*** End Scrolling Customer Testimonials v1.1 ***/
	    	$references = strip_tags($random_references['referencess_html_text']);
	    	$references_titulo = $random_references['references_title'];
	    	$referencescontent = '<b><center>' . $references_titulo . '</center></b><br>' . (strlen($references) > 100 ? substr($references,0,100) . ' ...': $references) . '<br /><br /><a href="' . tep_href_link(FILENAME_REFERENCES, tep_get_all_get_params(array('language', 'currency')) .'references_id=' . $random_references['references_id']) . '"><span><center>' . TEXT_READ_MORE . '</center></span></a><br><span><center><b> By '.$random_references['references_name'].'</b></center></span><br>' . $references_write_link;

// ***
// End Static display
// ***
	    } else {

// *** 
// *** Scrolling subroutine ***
// *** 
    $rows = 0;
// limit number of testimonials we pull from database
    if ($references_count > REFERENCES_LIMIT) $references_count = REFERENCES_LIMIT;
    $references_list = '<table border="0" width="100%" cellspacing="0" cellpadding="1">';
    while ($rows != $references_count) {
		$rows++;

/*** Begin Scrolling Customer Testimonials v1.1 ***/
// check language display preference
	if (REFERENCES_LANG_PREF == "User Language Only") {  // pick only a localized testimonial?
// pick one randomly
		$random_references = tep_random_select("select * FROM " . TABLE_SHOP_REFERENCES . " WHERE status = 1 AND language_id = $languages_id ORDER BY rand() LIMIT 1");
	} else {  // else pick one out of all testimonials for all languages
		$random_references = tep_random_select("select * FROM " . TABLE_SHOP_REFERENCES . " WHERE status = 1 ORDER BY rand() LIMIT 1");
	}
/*** End Scrolling Customer Testimonials v1.1 ***/

// draw the text
      	$references_list .= '<tr><td class="infoBoxContents" valign="top" align="left">';  
		$references = strip_tags($random_references['references_html_text']);
	    $references_titulo = $random_references['references_title'];
	    $references_list .= '<center><b>' . $references_titulo . '</center></b><br>' . (strlen($references) > 100 ? substr($references,0,100) . ' ...': $references) . '<br /><br /><a href="' . tep_href_link(FILENAME_REFERENCES, tep_get_all_get_params(array('language', 'currency')) .'references_id=' . $random_references['references_id']) . '"><span><center>' . TEXT_READ_MORE . '</center></span></a><br><span><center><b> By '.$random_references['references_name'].'</b></center></span><br><br>';
      $references_list .= '</td></tr>';
    	}
    $references_list .= '</table>';
    $info_box_contents = array();
  	$referencescontent = '<div id="marquee" class="marquee_hide"><MARQUEE behavior= "scroll" align= "center" direction= "'.REFERENCES_SCROLL_DIR.'" height="'.REFERENCES_SCROLL_HEIGHT.'" scrollamount= "2" scrolldelay= "'.REFERENCES_SCROLL_DELAY.'" onmouseover=\'this.stop()\' onmouseout=\'this.start()\'>'.$references_list.'</MARQUEE></div>'.$references_write_link;

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

  $box_base_name = 'references';
  $box_id = $box_base_name . 'Box';
  $boxContent = $referencescontent;
  include (bts_select('boxes', $box_base_name));
  $boxLink = '';
// if Customer Testimonials disabled, drop out here
	}
?>