<!-- banner_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'quotes_top')) { ?>
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
        <td class="main"><?php echo TEXT_INFORMATION; ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>      
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
         <tr>
          <td class="main" align="center"><?php echo TEXT_REQUEST_A_QUOTE; ?></td>
         </tr>
        </table></td>  
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>        
      <tr>
        <td class="main"><table border="1" width="100%" cellspacing="0" cellpadding="2" align="center">
        <?php if (tep_db_num_rows($product_check_query) > 0) { ?>
        <tr>
         <th class="quotesBoxHeading" align="left"><?php echo TEXT_QUOTES_CUSTOMER; ?></th>
         <th class="quotesBoxHeading"><?php echo TEXT_QUOTES_RESPONSE; ?></th>
         <th class="quotesBoxHeading"><?php echo TEXT_QUOTES_DATE_ADDED; ?></th>
         <th class="quotesBoxHeading"><?php echo TEXT_QUOTES_STATUS; ?></th>
        </tr> 
        <?php while ($product_check = tep_db_fetch_array($product_check_query)) {
         $expired = tep_not_null($product_check['quotes_expire']) ? $product_check['quotes_expire'] < date('Y-m-d') ? true : false : false; 
        ?>
         <tr>
          <td class="quotesLink" align="left" width="10"><?php echo (! $expired && $product_check['qty'] > 0 ? '<a class="quotesLink" href="' . tep_href_link('product_info.php', 'products_id='.$product_check['products_id'], 'NONSSL') . '">' .$product_check['products_name'] . '</a>' : $product_check['products_name']); ?></td>
          <td class="quotesLink" align="left" width="65%"><?php echo stripslashes($product_check['products_description']); ?>  </td>
          <td class="quotesLink" align="center"><?php echo tep_date_only($product_check['products_date_added']); ?>  </td>
          <td class="quotesLink" align="center"><?php echo (! $expired ? ($product_check['qty'] ? TEXT_QUOTES_ACTIVE : TEXT_QUOTES_PAID) : TEXT_QUOTES_EXPIRED); ?></td>
         </tr>
        <?php } } else {?>
         <tr>
          <td class="main">
          <?php 
           if (tep_session_is_registered('customer_id'))
             echo TEXT_QUOTES_NONE_FOUND;
           else 
           {
             $navigation->set_snapshot();
             echo TEXT_QUOTES_NEED_LOGIN;
           }   
          ?>
          </td>
         </tr>
        <?php } ?> 
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
<!-- banner_bot //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'quotes_bot')) { ?>
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
