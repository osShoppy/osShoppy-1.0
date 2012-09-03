<script type="text/javascript" src="http://<?php echo STORE_URL ?>/includes/slideshow/js/mootools.js"></script>
<script type="text/javascript" src="http://<?php echo STORE_URL ?>/includes/slideshow/js/slideshow.js"></script>
	
<script type="text/javascript">		
	
//<![CDATA[
	  window.addEvent('domready', function(){
	    var data = {
	      '1.jpg': { caption: 'Vario Helicopter Uli Streich' }, 
	      '2.jpg': { caption: 'Vario Helicopter Uli Streich' }, 
	      '3.jpg': { caption: 'Vario Helicopter Uli Streich' }, 
	      '4.jpg': { caption: 'Vario Helicopter Uli Streich' },
	      '5.jpg': { caption: 'Vario Helicopter Uli Streich' },
	      '6.jpg': { caption: 'Vario Helicopter Uli Streich' },
	      '7.jpg': { caption: 'Vario Helicopter Uli Streich' },
	      '8.jpg': { caption: 'Vario Helicopter Uli Streich' },
	      '9.jpg': { caption: 'Vario Helicopter Uli Streich' },
	      '10.jpg': { caption: 'Vario Helicopter Uli Streich' },
	      '11.jpg': { caption: 'Vario Helicopter Uli Streich' },
	      '12.jpg': { caption: 'Vario Helicopter Uli Streich' },
	      '13.jpg': { caption: 'Vario Helicopter Uli Streich' },
	      '14.jpg': { caption: 'Vario Helicopter Uli Streich' }
	    

};
	    var myShow = new Slideshow('show', data, { captions: true, controller: true, height: 300, hu: 'http://<?php echo STORE_URL ?>/includes/slideshow/images/', delay: 4000, titles: true, captions: true, thumbnails: true });
	  });
	//]]>

</script>
<!-- banner_index_default_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'index_def_top')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
			</table>
		  <?php } ?>
<!-- banner_index_default_top_eof //-->
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
<!-- slideshow -->		
<?php if (USE_SLIDE_SHOW_ON_INDEX_DEFAULT == 'true') { ?>
<tr>
    <td align="center"><div id="show" class="slideshow">
      <div align="center">
	  <a href="index.php?cPath=1"><img src="http://<?php echo STORE_URL ?>/includes/slideshow/images/1.jpg" alt="Fill in your Website URL in your Admin Panel." border="0" width="400" height="300"/></a>
	  
	  </div>
    </div>
     <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '50'); ?></td>
      </tr>
</tr>
<?php } else { ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
<?php if (USE_HEADING_TITLE_ON_INDEX_DEFAULT == 'true') { ?>
            <td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
<?php } ?>
<?php if (USE_HEADING_IMAGE_ON_INDEX_DEFAULT == 'true') { ?>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_oss.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php } ?>
          </tr>
        </table></td>
      </tr>
<?php } ?>
<!-- slideshow end -->	
<?php
// BOF: Store Mode
  if (STORE_MODE == 'Closed') {
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="stockWarning" align="center"><?php echo CLOSED_MESSAGE . ONLINE_DATE_TIME ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
// EOF: Store Mode
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php if (USE_LATEST_NEWS_ON_INDEX_DEFAULT == 'true') { ?>
      <tr>
        <td><?php include(DIR_WS_MODULES . FILENAME_LATEST_NEWS); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php } ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
<?php if (USE_MAIN_CATEGORY_IMAGES_ON_INDEX_DEFAULT == 'true') { ?>
   	 	  <tr>
        	<td><?php include(DIR_WS_MODULES . FILENAME_MAIN_CATS); ?></td>
    	  </tr>
<?php } ?>
<?php if (USE_FEATURED_PRODUCTS_ON_INDEX_DEFAULT == 'true') { ?>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td><?php include(DIR_WS_MODULES . FILENAME_FEATURED); ?></td>
          </tr>
<?php } ?>
<?php if (USE_CUSTOMER_GREETING_ON_INDEX_DEFAULT == 'true') { ?>
          <tr>
            <td class="main"><br /><?php echo tep_customer_greeting() . '&nbsp;'; if (STORE_SHOW_GUESTS_PRICES == 'true') { echo TEXT_GREETING_PRICES; }?></td>
          </tr>
<?php } ?>
<?php if (USE_MAIN_TEXT_ON_INDEX_DEFAULT == 'true') { ?>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DEFINE_MAINPAGE); ?></td>
          </tr>
<?php } ?>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
      <tr>
        <td><table border="0" width="60%" cellspacing="1" cellpadding="2" align="center">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><?php echo $rss_feed_link; ?></td>
                <td><?php if (HEADER_TAGS_DISPLAY_SOCIAL_BOOKMARKS_DEFAULT == 'true') 
           									include(DIR_WS_MODULES . 'header_tags_social_bookmarks.php'); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
        </table></td>
      </tr>
<?php if (USE_NEW_PRODUCTS_SCROLLER_ON_INDEX_DEFAULT == 'true') { ?>
          <tr>
            <td><?php include(DIR_WS_MODULES . FILENAME_NEW_PRODUCTS_SCROLLER); ?></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
<?php } ?>
<?php if (USE_NEW_PRODUCTS_ON_INDEX_DEFAULT == 'true') { ?>
          <tr>
            <td><?php include(DIR_WS_MODULES . FILENAME_NEW_PRODUCTS); ?></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
<?php } ?>
<?php include(DIR_WS_MODULES . FILENAME_UPCOMING_PRODUCTS); ?>
        </table></td>
      </tr>
    </table>
<!-- banner_index_default_bottom //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'index_def_bot')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
			</table>
		  <?php } ?>
<!-- banner_index_default_bottom_eof //-->

