<?php // catalog/includes/modules/customer_testimonials.php (5477) ?>
<table border="0" cellspacing="0" cellpadding="2" width="100%">
<?php
  if (sizeof($testimonial_array) == '0') {
?>
  <tr>
    <td class="main"><?php echo TEXT_NO_TESTIMONIALS; ?></td>
  </tr>
<?php
  } else {
    for($i=0; $i<sizeof($testimonial_array); $i++) {
?>
  <tr>
    <td valign="top">
    <?php

    if ($testimonial_id != '') {
      $testimonials_list = '<br><br><a href="'. tep_href_link(FILENAME_CUSTOMER_TESTIMONIALS, '', 'NONSSL'). '">'. '<b>' . TEXT_LINK_TESTIMONIALS. '</b>' . '</a>';
    }
    else {
      $testimonials_list = '';
    }
	
	if($testimonial_array[$i]['image']){
		$displayimage = tep_image(DIR_WS_IMAGES . 'uploads_testimonial_manager/' . $testimonial_array[$i]['image'], $testimonial_array[$i]['title'], C_TESTI_W, '');
	}else{
		$displayimage = '';
	}

if (TESTIMONIAL_EMAIL_AUTHOR == 'All Users') {  // Yes, the user may email author
    $info_box_contents = array();
    $email_prefix = TEXT_MAILTO;
	if (empty($testimonial_array[$i]['location'])) {
      $info_box_contents[][] = array('align' => 'left',
                                     'params' => 'class="smallText" width="100%" valign="top"',
                                     'text' => '
										 <table border="0" cellspacing="2" cellpadding="2" width="100%">
										  <tr>
											<td class="smallText">
											<b>' . TEXT_TESTIMONY_BY . '</b>' . $testimonial_array[$i]['author'] . '<b>' . '<br><br>' . TEXT_TESTIMONY_DATE_ADDED . '</b>' . tep_date_short($testimonial_array[$i]['date_added']) . '<br><br>' . '<b>' . TEXT_TESTIMONY_TITLE . '</b>' . $testimonial_array[$i]['title'] . '<br><br>' . $testimonial_array[$i]['testimonial'] . '<br><br>' . '<a target="_blank" href="'. $email_prefix . $testimonial_array[$i]['email'] . '">' . TEXT_EMAIL_AUTHOR . '</a>'. $testimonials_list . '</td>
											<td class="smallText">
											' . $displayimage . '
											</td>
										  </tr>
										</table>');
	} else {
      $info_box_contents[][] = array('align' => 'left',
                                     'params' => 'class="smallText" width="100%" valign="top"',
                                     'text' => '
									 	<table border="0" cellspacing="2" cellpadding="2" width="100%">
										  <tr>
											<td class="smallText">
											<b>' . TEXT_TESTIMONY_BY . '</b>' . $testimonial_array[$i]['author']. TEXT_TESTIMONY_OF . $testimonial_array[$i]['location'] . '<br><br>' . '<b>' . TEXT_TESTIMONY_DATE_ADDED . '</b>' . tep_date_short($testimonial_array[$i]['date_added']) . '<br><br>' . '<b>' . TEXT_TESTIMONY_TITLE . '</b>' . $testimonial_array[$i]['title'] . '<br><br>' . $testimonial_array[$i]['testimonial'] . '<br><br>' . '<a target="_blank" href="'. $email_prefix . $testimonial_array[$i]['email'] . '">' . TEXT_EMAIL_AUTHOR . '</a>'. $testimonials_list . '
											</td>
											<td class="smallText">
											' . $displayimage . '
											</td>
										  </tr>
										</table>');
    }
} else {
	    $info_box_contents = array();
    $email_prefix = TEXT_MAILTO;
	if (empty($testimonial_array[$i]['location'])) {
      $info_box_contents[][] = array('align' => 'left',
                                     'params' => 'class="smallText" width="100%" valign="top"',
                                     'text' => '
										 <table border="0" cellspacing="2" cellpadding="2" width="100%">
										  <tr>
											<td class="smallText">
											<b>' . TEXT_TESTIMONY_BY . '</b>' . $testimonial_array[$i]['author'] . '<b>' . '<br><br>' . TEXT_TESTIMONY_DATE_ADDED . '</b>' . tep_date_short($testimonial_array[$i]['date_added']) . '<br><br>' . '<b>' . TEXT_TESTIMONY_TITLE . '</b>' . $testimonial_array[$i]['title'] . '<br><br>' . $testimonial_array[$i]['testimonial'] . '<br><br>' . $testimonials_list . '</td>
											<td class="smallText">
											' . $displayimage . '
											</td>
										  </tr>
										</table>');
	} else {
      $info_box_contents[][] = array('align' => 'left',
                                     'params' => 'class="smallText" width="100%" valign="top"',
                                     'text' => '
									 	<table border="0" cellspacing="2" cellpadding="2" width="100%">
										  <tr>
											<td class="smallText">
											<b>' . TEXT_TESTIMONY_BY . '</b>' . $testimonial_array[$i]['author']. TEXT_TESTIMONY_OF . $testimonial_array[$i]['location'] . '<br><br>' . '<b>' . TEXT_TESTIMONY_DATE_ADDED . '</b>' . tep_date_short($testimonial_array[$i]['date_added']) . '<br><br>' . '<b>' . TEXT_TESTIMONY_TITLE . '</b>' . $testimonial_array[$i]['title'] . '<br><br>' . $testimonial_array[$i]['testimonial'] . '<br><br>' . $testimonials_list . '
											</td>
											<td class="smallText">
											' . $displayimage . '
											</td>
										  </tr>
										</table>');
    }
}
    new contentBox($info_box_contents);
    ?>
    </td>
  </tr>
<?php
      if (($i+1) != sizeof($testimonial_array)) {
?>
  <tr>
    <td colspan="2" class="main">&nbsp;</td>
  </tr>
<?php
      }
    }
  }
?>
</table>
