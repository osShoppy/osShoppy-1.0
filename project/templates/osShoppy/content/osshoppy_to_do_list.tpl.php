<?php
  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
?>
     <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
<?php } ?>
<?php if (USE_HEADING_IMAGE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_oss.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php } ?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<!-- current to do //-->
         <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <td>
              <table border="0" width="80%" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                  <td width="100%" height="14" class="infoBoxHeading"><?php echo HEADING_DOING_NOW; ?></td>
                  <td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                </tr>
              </table>
              <table border="0" width="80%" cellspacing="0" cellpadding="1" class="infoBox" align="center">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
              <tr>
                <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
              </tr>
              <tr>
                <td class="boxText"><?php echo TEXT_DOING_NOW; ?></td>
              </tr>
              <tr>
                <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
              </tr>
            </table>
            </td>
              </tr>
            </table>
            </td>
<!-- current to do_eof //-->
<!-- did //-->
            <td>
              <table border="0" width="80%" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                  <td width="100%" height="14" class="infoBoxHeading"><?php echo HEADING_DID; ?></td>
                  <td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                </tr>
              </table>
              <table border="0" width="80%" cellspacing="0" cellpadding="1" class="infoBox" align="center">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
              <tr>
                <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
              </tr>
              <tr>
                <td class="boxText"><?php echo TEXT_DID; ?></td>
              </tr>
              <tr>
                <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
              </tr>
            </table>
            </td>
              </tr>
            </table>
            </td>
<!-- did_eof //-->
        </table>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '20'); ?></td>
      </tr>
<!-- to do //-->
          <tr>
            <td>
              <table border="0" width="90%" cellspacing="0" cellpadding="0" align="center">
                <tr>
                  <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                  <td width="100%" height="14" class="infoBoxHeading"><?php echo HEADING_TO_DO; ?></td>
                  <td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                </tr>
              </table>
              <table border="0" width="90%" cellspacing="0" cellpadding="1" class="infoBox" align="center">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
              <tr>
                <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
              </tr>
              <tr>
                <td class="boxText"><?php echo TEXT_TO_DO; ?></td>
              </tr>
             </table>
              <table border="0" width="100%" cellspacing="4" cellpadding="1" align="center" class="infoBoxContents">
                    <tr>
                      <td width="250" class="infoBoxHeading" align="center"><?php echo HEADING_TO_DO_FILE; ?></td>
                      <td class="infoBoxHeading" align="center"><?php echo HEADING_TO_DO_TO_DO; ?></td>
                      <td width="80" class="infoBoxHeading" align="center"><?php echo HEADING_TO_DO_DID; ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_1; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_1; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/checked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_2; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_2; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_3; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_3; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_4; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_4; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_5; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_5; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_6; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_6; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/checked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_7; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_7; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_8; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_8; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_9; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_9; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_10; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_10; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_11; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_11; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_12; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_12; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_13; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_13; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_14; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_14; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_15; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_15; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_16; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_16; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_17; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_17; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_18; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_18; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_19; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_19; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_20; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_20; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_21; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_21; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/checked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_22; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_22; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_23; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_23; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_24; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_24; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_25; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_25; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_26; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_26; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_27; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_27; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_28; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_28; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_29; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_29; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_30; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_30; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_31; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_31; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_32; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_32; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_33; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_33; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_34; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_34; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                    <tr>
                      <td width="250" valign="top"><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo FILE_35; ?></td>
                      <td><? echo tep_image(DIR_WS_IMAGES . 'infobox/arrow_right.gif'); ?>&nbsp;<?php echo TO_DO_35; ?></td>
                      <td width="80" align="center"><? echo tep_image(DIR_WS_IMAGES . 'files/product_info/unchecked.gif'); ?></td>
                    </tr>
                </table></td>
           </tr>
          </table></td>
        </tr>
<!-- to do_eof //-->
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '20'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
		        <td><a href="javascript:history.go(-1)"><?php echo tep_image_button('button_back.png', IMAGE_BUTTON_BACK); ?></a></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>

