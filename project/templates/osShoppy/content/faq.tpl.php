<!-- banner_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'faq_top')) { ?>
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
      <tr>
        <td><br><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main">
<ol>
<?php 

function href ($link, $text) {
	return "<a href=\"$link\">$text</a>";
}

function faq_toc () {
	global $PHP_SELF, $language;
	static $old_faq_id;
	if ($old_faq_id) {
		$exclude=explode("&", $old_faq_id);
		while (list($dummy,$old_id)=each($exclude)) {
			if ($old_id) {$query.="faq_id != $old_id AND ";unset($old_id);}
			}
		}
	$result_query= tep_db_query( "SELECT faq_id, question FROM " . TABLE_FAQ . " WHERE $query visible='1'  and $query language='$language' ORDER BY v_order");
      $result = tep_db_fetch_array($result_query);

	if ($result[faq_id]) {$old_faq_id.="$result[faq_id]&";	
	$result[toc]="<b><a href=$PHP_SELF#$result[faq_id]>$result[question]</a></b>";}
return $result;
}

function read_faq () {
global $language;
	static $old_faq_id;
	if ($old_faq_id) {
		$exclude=explode("&", $old_faq_id);
		while (list($dummy,$old_id)=each($exclude)) {
			if ($old_id) {$query.="faq_id != $old_id AND ";unset($old_id);}
		}
	}

	$result_query=tep_db_query("SELECT faq_id, question, answer FROM " . TABLE_FAQ . " WHERE $query visible='1' and $query language='$language' ORDER BY v_order");
      $result = tep_db_fetch_array($result_query);
	if ($result[faq_id]) {
		$old_faq_id.="$result[faq_id]&";
		$result[faq]="<b><a name=$result[faq_id]>$result[question]</a></b><br>$result[answer]";
	}
return $result;
}



while ($faq=faq_toc()) {
?>
<li><?php echo $faq[toc];?>
<?php }
?>
</ol>
<hr size="1" color="#808080">
                  <ol>
                    <?php while ($faq=read_faq()) {
?>
                    <li><b><a name=<?php echo $faq[faq_id]?>><?php echo $faq[question];?></a></b><br>
                      <?php echo $faq[answer];?><br><br><a target="_self" href="./faq.php#top">[<b><i><?php echo FAQ_BACK_TO_TOP; ?></i></b>]</a><p>
                      <?php }
?>
                  </ol>

</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td align="right" class="main"><br><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
      </tr>
    </table>
<!-- banner_bot //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'faq_bot')) { ?>
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
</td>
