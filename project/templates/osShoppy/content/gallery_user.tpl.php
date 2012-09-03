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
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  if ($messageStack->size('gallery_user') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('gallery_user'); ?></td>
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
				<?php
					echo REEDS_GEUPLOAD."<br>";
					$aantal_kol = 3; //number of pictures per row
					$rij = 1;
					$kolom = 1;
					$counter = 0; 
					$dir = "gallery/";
					echo '<table width="100%">';
					$sql = mysql_query("SELECT * FROM gallery WHERE cID=".$customer_id);
					while($fotos = mysql_fetch_array($sql)){
								$counter ++;
						    if ($kolom == 1) {echo '<tr>';}
								$file = $customer_id."_".$fotos['pID'].".jpg";
						   	echo "\n\n".'<td class="main" align="center">';
								echo '<a href="' . tep_href_link($dir.$file) . '" class="highslide" onclick="return hs.expand(this)">'.tep_image($dir . $file, '', 150, 150, 'hspace="5" vspace="5"').'</a><br>';
								
								$photos_pid=$fotos['pID'];
								$photos_cid=$fotos['cID'];
								$link = 'gallery_process.php?edit=yes&pID='.$fotos['pID'].'&cID='.$fotos['cID'];
								echo '[<a href="'.tep_href_link($link,'','SSL','',false).'" onclick="return hs.htmlExpand(this, { objectType: \'iframe\',outlineType: \'rounded-white\', outlineWhileAnimating: true } )">' .TEXT_EDIT.'</a>]<br>';
								echo '[<a href="' . tep_href_link('#') . '" onclick="return hs.htmlExpand(this, { contentId: \'comment'.$fotos['cID'].$fotos['pID'].'\', outlineType: \'rounded-white\', outlineWhileAnimating: true } )" class="highslide">' .TEXT_COMMENTS.'</a>]<br>';
								echo '[<a href="gallery_user.php?delete&pid='.$file.'">'.TEXT_DELETE.'</a>]</td>';
								?>
								<div class="highslide-html-content" id="comment<?php echo $fotos['cID'].$fotos['pID'];?>">
									<div style="height:20px; padding: 2px">
										<a href="#" onClick="return hs.close(this)" class="control">Close</a>
										<a href="#" onClick="return false" class="highslide-move control">Move</a>
									</div>
									<div class="highslide-body">
										<?php
										echo '<div style="text-align:left;color:#666666;font-weight:normal;font-style:normal;font-size:7pt;">';
										//bestaande commentaar uitlezen
										if ($fotos['comment'] != '') {
											$comment = explode('<-->',$fotos['comment']);
											foreach ($comment as $val) {
												$commentaar = explode ('///',$val);
												echo '<b>'.stripslashes($commentaar[0]) . "</b>: ".stripslashes($commentaar[1]).'<hr style="border:0;height:1px;color:#666666;background:#666666;">';
											}
										} else {
											echo TEXT_NO_COMMENTS;
										}
										echo '</div>';
										?>
									</div>
								</div>

								<?php
								if ($kolom == $aantal_kol) {
									echo '</tr>';
									$kolom = 0;
								}
								$rij ++;
								$kolom ++;
					}
					if ($kolom <= $aantal_kol && $counter !== 0 ) {echo '</tr>';}
					echo '</table>';
					if ($counter == 0) {echo NO_PICTURES;}
					echo "<p>";
					echo VOORWAARDEN_ONE;
					if ($superuser==false) {
					  echo VOORWAARDEN_TWO;
					}else{
					  //echo VOORWAARDEN_TWO_SU;
					}
					echo VOORWAARDEN_THREE;
				?>
				<form enctype="multipart/form-data" action="gallery_user.php" method="POST">
				<!--<input type="hidden" name="MAX_FILE_SIZE" value="100000" />-->
				<?php
				//nagaan hoeveel fotos deze klant reeds staan heeft
				$i = mysql_num_rows($sql);
				//if ($superuser==true) echo 'YOU ARE A SUPERUSER<br>';
				if ($i < 6 || $superuser==true) {
					echo CHOOSE_FILE.': <br>';
					if ($superuser==false){
						while ($i <6) {
							$i ++;
							echo '<input type="file" name="uploadedfile[]" /><br>';
						}
					}else{
					  $j=0;
						while ($j <6) {
							$j ++;
							echo '<input type="file" name="uploadedfile[]" /><br>';
						}
					}
					?>
					<input type="submit" name="fotouploaden" value="Upload" />
				<?php 
				} else {
					echo MAX_GALLERY_REACHED;
				}
				?>
				</form>
			</td>
          </tr>
        </table></td>
      </tr>
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
