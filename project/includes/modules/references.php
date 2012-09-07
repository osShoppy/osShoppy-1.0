<?php // catalog/includes/modules/references.php (5477) ?>

<table border="0" cellspacing="0" cellpadding="2" width="100%">
<?php
  if (sizeof($references_array) == '0') {
?>
  <tr>
    <td class="main"><?php echo TEXT_NO_REFERENCES; ?></td>
  </tr>
<?php
  } else {
    for($i=0; $i<sizeof($references_array); $i++) {
?>
  <tr>
    <td valign="top">
    <?php

    if ($references_id != '') {
      $references_list = '<br><br><a href="'. tep_href_link(FILENAME_REFERENCES, '', 'NONSSL'). '">'. '<b>' . TEXT_LINK_REFERENCES. '</b>' . '</a>';
    }
    else {
      $references_list = '';
    }
	
	if($references_array[$i]['image']){
		$displayimage = tep_image(DIR_WS_IMAGES . 'uploads_reference_manager/' . $references_array[$i]['image'], $references_array[$i]['title'], C_REFER_W, '');
	}else{
		$displayimage = '';
	}

if (REFERENCES_EMAIL_AUTHOR == 'All Users') {  // Yes, the user may email author
    $info_box_contents = array();
    $email_prefix = TEXT_MAILTO;
	if (empty($references_array[$i]['location'])) {
      $info_box_contents[][] = array('align' => 'left',
                                     'params' => 'class="smallText" width="100%" valign="top"',
                                     'text' => '
										 <table border="0" cellspacing="2" cellpadding="2" width="100%">
										  <tr>
											<td class="smallText">
											<b>' . TEXT_REFERENCES_BY . '</b>' . $references_array[$i]['author'] . '<b>' . '<br><br>' . TEXT_REFERENCES_DATE_ADDED . '</b>' . tep_date_short($references_array[$i]['date_added']) . '<br><br>' . '<b>' . TEXT_REFERENCES_TITLE . '</b>' . $references_array[$i]['title'] . '<br><br>' . $references_array[$i]['references'] . '<br><br>' . '<a target="_blank" href="'. $email_prefix . $references_array[$i]['email'] . '">' . TEXT_EMAIL_AUTHOR . '</a>'. $referencess_list . '</td>
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
											<b>' . TEXT_REFERENCES_BY . '</b>' . $references_array[$i]['author']. TEXT_REFERENCES_OF . $references_array[$i]['location'] . '<br><br>' . '<b>' . TEXT_REFERENCES_DATE_ADDED . '</b>' . tep_date_short($references_array[$i]['date_added']) . '<br><br>' . '<b>' . TEXT_REFERENCES_TITLE . '</b>' . $references_array[$i]['title'] . '<br><br>' . $references_array[$i]['references'] . '<br><br>' . '<a target="_blank" href="'. $email_prefix . $references_array[$i]['email'] . '">' . TEXT_EMAIL_AUTHOR . '</a>'. $referencess_list . '
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
	if (empty($references_array[$i]['location'])) {
      $info_box_contents[][] = array('align' => 'left',
                                     'params' => 'class="smallText" width="100%" valign="top"',
                                     'text' => '
										 <table border="0" cellspacing="2" cellpadding="2" width="100%">
										  <tr>
											<td class="smallText">
											<b>' . TEXT_REFERENCES_BY . '</b>' . $references_array[$i]['author'] . '<b>' . '<br><br>' . TEXT_REFERENCES_DATE_ADDED . '</b>' . tep_date_short($references_array[$i]['date_added']) . '<br><br>' . '<b>' . TEXT_REFERENCES_TITLE . '</b>' . $references_array[$i]['title'] . '<br><br>' . $references_array[$i]['references'] . '<br><br>' . $referencess_list . '</td>
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
											<b>' . TEXT_REFERENCES_BY . '</b>' . $references_array[$i]['author']. TEXT_REFERENCES_OF . $references_array[$i]['location'] . '<br><br>' . '<b>' . TEXT_REFERENCES_DATE_ADDED . '</b>' . tep_date_short($references_array[$i]['date_added']) . '<br><br>' . '<b>' . TEXT_REFERENCES_TITLE . '</b>' . $references_array[$i]['title'] . '<br><br>' . $references_array[$i]['references'] . '<br><br>' . $referencess_list . '
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
      if (($i+1) != sizeof($references_array)) {
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
