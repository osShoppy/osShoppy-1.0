<!-- banner_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'documents_top')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
			</table>
		  <?php } ?>
<!-- banner_top_eof //-->
    <table border="0" width="100%" cellspacing="0" cellpadding="0"><tbody>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0"><tbody>
          <tr>
			<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            	<td class="pageHeading"><h1><?php echo $title; ?></h1></td>
			<?php } ?>
			<?php if (USE_HEADING_IMAGE_ON_ALL_PAGES == 'true') { ?>
            	<td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_about_us.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
			<?php } ?>
          </tr>
        </tbody></table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border=0 width="100%" cellspacing="0" cellpadding="2"><tbody>
<?php
  //Show documents if there ary any in this directory
  if ($type != '') {
?>
          <tr>
            <td class=documents_heading><?php echo HEADING_DOCUMENT_TITLE; ?></td>
<?php
    //There is a title for each column/document type
    if (is_array ($documents_heading) ) {           
      foreach ($documents_heading as $heading) {
        echo '            <td class=documents_heading>' . $heading['heading'] . '</td>';
      }
    }
?>            
          
<?php
    if (count ($documents_array) > 0) {
      $row_counter = 0;
      $prev_category = '';
      $prev_name = '';
      foreach ($documents_array as $document) {
        $category = $document['category'];
          
        if ($category != $prev_category) {
          // New category, so output the heading and reset the row counter
          echo '      </tr>' . "\n";
          echo '      <tr>' . "\n";
          echo '        <td colspan=4>' . "\n";
          echo '          <h2 class=documents_category>' . "\n";
          echo '            ' . (($category == 'Documents') ? '' : $category) . "\n";
          echo '          </h2>' . "\n";
          echo '        </td>' . "\n";
          $prev_category = $category;
          $row_counter = 0;
          $column_counter = 0;
        }
        
        //If starting a new row, close the previous row, open a new one, and output the title
        if ($document['name'] != $prev_name || $row_counter == 0) {
          $column_counter = 1;
          $prev_name = $document['name'];
          echo '      </tr>' . "\n";
     
          if ($row_counter % 2) {
            echo '      <tr class="productListing-even">';
          } else {
            echo '      <tr class="productListing-odd">';
          }
          echo '        <td class=main>' . $document['title'] . '&nbsp;&nbsp;' . '</td>' . "\n";
          
          $row_counter++;
        } else {
          $column_counter++;
        }
        
        $column_position = tep_get_column_number ($documents_heading, $document['type']);
        if ($column_counter < $column_position) {
          $add_columns = $column_position - $column_counter;
          $lc_text = '        <td>&nbsp;</td>' . "\n";
          echo str_repeat ($lc_text, $add_columns);
        }
        
        echo '        <td class=main><a href="' . DIR_WS_DOCUMENTS . $document['type_name'] . '/' . $document['name'] . '.' . $document['extension'] . '">';
        echo $document['name'] . '.' . $document['extension'] . ' (' . number_format ($document['size']) . ' k)';
        echo '&nbsp;&nbsp;' . $document['icon'] . "\n";
        echo '        </a></td>' . "\n";
      } //while

      echo '      </tr>' . "\n";

    } else { // If no documents, display an error message
?>
          <tr>
            <td><b><?php echo TEXT_NO_DOCUMENTS; ?></td>
          </tr>
<?php
    } //if (tep_db_num_rows
  } //if ($type != ''
?>
        </tbody></table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '20'); ?></td>
      </tr>
    </tbody></table>
<!-- banner_bot //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'documents_bot')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
			</table>
		  <?php } ?>
<!-- banner_bot_eof //-->
