<?php /* shipping_info infobox template  */ 
if ((!strstr($_SERVER['PHP_SELF'],EX_SHI_1))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_2))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_3))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_4))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_5))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_6))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_7))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_8))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_9))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_10))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_11))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_12))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_13))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_14))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_15))
and(!strstr($_SERVER['PHP_SELF'],EX_SHI_16))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_17))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_18))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_19))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_20))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_21))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_22))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_23))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_24))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_25))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_26))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_27))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_28))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_29))and(!strstr($_SERVER['PHP_SELF'],EX_SHI_30))
){ ?>
          <tr>
            <td>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td height="14" class="infoBoxHeadingShipping"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                  <td width="100%" height="14" class="infoBoxHeadingShipping"><?php echo $boxHeading; ?></td>
                  <td height="14" class="infoBoxHeadingShipping" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
                </tr>
              </table>
              <table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBoxShipping">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContentsShipping">
              <tr>
                <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
              </tr>
              <tr>
                <td class="boxText"<?php echo $boxContent_attributes; ?>>
                		<tr><td align="center" class="footerText">
                        <?php if (USE_TNT_IN_SHIPPING_INFO == 'true') { ?>
						<?php echo tep_image(DIR_WS_IMAGES . 'infobox/shipping_info/tntinfo.jpg'); ?>
						</td></tr>
        				<?php } ?>
						<tr><td align="center" class="footerText">
                        <?php if (USE_DPD_IN_SHIPPING_INFO == 'true') { ?>
						<?php echo tep_image(DIR_WS_IMAGES . 'infobox/shipping_info/dpdinfo.png'); ?>
						</td></tr>
        				<?php } ?>
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