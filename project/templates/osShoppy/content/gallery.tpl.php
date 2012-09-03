    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
<?php } ?>
<?php if (USE_HEADING_IMAGE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_about_us.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php } ?>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_INFORMATION; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
            
<?php
  $gallery_query_raw ="select id, cID, pID, comment, title, description from ". TABLE_GALLERY ." order by pID desc";
  $gallery_split = new splitPageResults($gallery_query_raw, MAX_GALLERY_PICS);

  if (($gallery_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $gallery_split->display_count(TEXT_DISPLAY_NUMBER_OF_PHOTOS); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $gallery_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main">
				<table width="100%">
				<?php
					$aantal_kol = 3;
					$rij = 1;
					$kolom = 1;
					//aantal foto's in elke map bepalen
					$dir = "gallery/";
					//$sql = mysql_query("SELECT * FROM gallery");
					$sql = tep_db_query($gallery_split->sql_query);
					while($fotos = tep_db_fetch_array($sql)){
						$file = $fotos['cID']."_".$fotos['pID'].".jpg";
						$auteur = mysql_fetch_array(mysql_query("SELECT customers_firstname,customers_lastname FROM customers WHERE customers_id=".$fotos['cID']));
						if ($kolom == 1) {echo "\n".'<tr>';}
						echo "\n".'<td align="center" class="main"><a id="autoload'.$fotos['cID'].$fotos['pID'].'" href="' . tep_href_link($dir.$file) . '" class="highslide" onclick="return hs.expand(this,{headingText: \''.htmlentities($fotos['title']).'\'})">'.tep_image($dir . $file, '', 150, 150, 'hspace="5" vspace="5"').'</a><br>'.stripslashes($fotos['title']);					
						echo '<div class="highslide-caption"><div style="text-align:center;margin-top:-2px;">'.AUTEUR.' '.$auteur['customers_firstname']." ".$auteur['customers_lastname']."</div><p>";
						
						if ($fotos['description'] != '') {
							echo '<div style="font-style:italic;border:1px solid #666666;background:#ffffcc">'.stripslashes($fotos['description']).'</div><p>';
						}
						
						//bestaande commentaar uitlezen
						$comment = explode('<-->',$fotos['comment']);
						if ($fotos['comment'] != '') {
							foreach ($comment as $val) {
								$commentaar = explode ('///',$val);
								echo '<b>'.stripslashes($commentaar[0]) . "</b>: ".stripslashes($commentaar[1]).'<hr style="border:0;height:1px;color:#666666;background:#666666;">';
							}
						} else {
							echo TEXT_NO_COMMENTS.'<hr style="border:0px;border-top:1px solid #666666;">';
						}
						
						//leave a comment
						if (tep_session_is_registered('customer_id')) {
							echo '<b>'.TEXT_PLACE_COMMENT.'</b><br>';
						  echo '<form name="form'.$fotos['cID'].$fotos['pID'].'" action="gallery_process.php" method="POST">';
						  echo '<input type="text" name="comment_naam" value="'.TEXT_NAME.'" onClick="this.value=\'\'">';
						  echo '<input type="hidden" name="cID" value="'.$fotos['cID'].'">';
						  echo '<input type="hidden" name="pID" value="'.$fotos['pID'].'">';
						  echo '<textarea name="comment_tekst" onClick="this.value=\'\'">'.TEXT_COMMENT.'</textarea>';
						  echo '<input type="submit" name="action" value="ok"></form>';
						}else{
							echo '<b>'.TEXT_PLACE_COMMENT_NOT_LOGIN.'</b><br>';
						}
						
						echo '</div></td>';
						if ($kolom == $aantal_kol) {
							echo '</tr>';
							$kolom = 0;
						}
						$rij ++;
						$kolom ++;
					}
					if ($kolom <= $aantal_kol) {echo '</tr>';}
				?>
				<div id="closebutton" class="highslide-overlay closebutton" onClick="return hs.close(this)" title="Close"></div>

				</table>
				<p><?php echo TEXT_LINK; ?></p>
			</td>
          </tr>
        </table></td>
      </tr>
<?php
  if (($gallery_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td><br><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $gallery_split->display_count(TEXT_DISPLAY_NUMBER_OF_PHOTOS); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $gallery_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>
