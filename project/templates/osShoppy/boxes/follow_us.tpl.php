<?php /* infobox template  */ 
if ((!strstr($_SERVER['PHP_SELF'],EX_FO_1))and(!strstr($_SERVER['PHP_SELF'],EX_FO_2))and(!strstr($_SERVER['PHP_SELF'],EX_FO_3))and(!strstr($_SERVER['PHP_SELF'],EX_FO_4))and(!strstr($_SERVER['PHP_SELF'],EX_FO_5))and(!strstr($_SERVER['PHP_SELF'],EX_FO_6))and(!strstr($_SERVER['PHP_SELF'],EX_FO_7))and(!strstr($_SERVER['PHP_SELF'],EX_FO_8))and(!strstr($_SERVER['PHP_SELF'],EX_FO_9))and(!strstr($_SERVER['PHP_SELF'],EX_FO_10))and(!strstr($_SERVER['PHP_SELF'],EX_FO_11))and(!strstr($_SERVER['PHP_SELF'],EX_FO_12))and(!strstr($_SERVER['PHP_SELF'],EX_FO_13))and(!strstr($_SERVER['PHP_SELF'],EX_FO_14))and(!strstr($_SERVER['PHP_SELF'],EX_FO_15))
and(!strstr($_SERVER['PHP_SELF'],EX_FO_16))and(!strstr($_SERVER['PHP_SELF'],EX_FO_17))and(!strstr($_SERVER['PHP_SELF'],EX_FO_18))and(!strstr($_SERVER['PHP_SELF'],EX_FO_19))and(!strstr($_SERVER['PHP_SELF'],EX_FO_20))and(!strstr($_SERVER['PHP_SELF'],EX_FO_21))and(!strstr($_SERVER['PHP_SELF'],EX_FO_22))and(!strstr($_SERVER['PHP_SELF'],EX_FO_23))and(!strstr($_SERVER['PHP_SELF'],EX_FO_24))and(!strstr($_SERVER['PHP_SELF'],EX_FO_25))and(!strstr($_SERVER['PHP_SELF'],EX_FO_26))and(!strstr($_SERVER['PHP_SELF'],EX_FO_27))and(!strstr($_SERVER['PHP_SELF'],EX_FO_28))and(!strstr($_SERVER['PHP_SELF'],EX_FO_29))and(!strstr($_SERVER['PHP_SELF'],EX_FO_30))
){ ?>
          <tr>
            <td>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="14" class="infoBoxHeadingFollowus"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                  <td width="100%" height="14" class="infoBoxHeadingFollowus"><?php echo $boxHeading; ?></td>
                  <td height="14" class="infoBoxHeadingFollowus" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                </tr>
              </table>
              <table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBoxFollowus">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContentsFollowus">
              <tr>
                <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
              </tr>
              <tr>
                <td class="boxText"<?php echo $boxContent_attributes; ?>>
							<?php if (USE_FACEBOOK_IN_FOLLOW_US == 'true') { ?><a href="http://<?php echo FACEBOOK_URL ?>" target="_blank"><?php echo tep_image(DIR_WS_IMAGES . 'infobox/follow_us/Facebook.png'); ?></a><?php } ?>
                        	<?php if (USE_TWITTER_IN_FOLLOW_US == 'true') { ?><a href="http://<?php echo TWITTER_URL ?>" target="_blank"><?php echo tep_image(DIR_WS_IMAGES . 'infobox/follow_us/Twitter.png'); ?></a><?php } ?>
                        	<?php if (USE_YOUTUBE_IN_FOLLOW_US == 'true') { ?><a href="http://<?php echo YOUTUBE_URL ?>" target="_blank"><?php echo tep_image(DIR_WS_IMAGES . 'infobox/follow_us/Youtube.png'); ?></a><?php } ?>
                        	<?php if (USE_HYVES_IN_FOLLOW_US == 'true') { ?><a href="http://<?php echo HYVES_URL ?>" target="_blank"><?php echo tep_image(DIR_WS_IMAGES . 'infobox/follow_us/Hyves.png'); ?></a><?php } ?>
                        	<?php if (USE_FLICKR_IN_FOLLOW_US == 'true') { ?><a href="http://<?php echo FLICKR_URL ?>" target="_blank"><?php echo tep_image(DIR_WS_IMAGES . 'infobox/follow_us/Flickr.png'); ?></a><?php } ?>
              </tr>
              <tr>
                <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
              </tr>
            </table>
            </td>
              </tr>
            </table>
            </td>
          </tr>
<?php } ?>