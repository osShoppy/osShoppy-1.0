<link rel="stylesheet" href="css/lightbox.css" type="text/css" media="screen" />
<script src="js/prototype.js" type="text/javascript"></script>
<script src="js/scriptaculous.js?load=effects,builder" type="text/javascript"></script>
<script src="js/lightbox.js" type="text/javascript"></script>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading" valign="top"><h1><?php echo $products_name; ?></h1></td>
            <td class="pageHeading" align="right" valign="top"><?php echo $products_price; ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  if ((USE_POINTS_SYSTEM == 'true') && (tep_not_null(USE_POINTS_FOR_REVIEWS))) {
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><?php echo sprintf(REVIEW_HELP_LINK, $currencies->format(tep_calc_shopping_pvalue(USE_POINTS_FOR_REVIEWS)), '<a href="' . tep_href_link(FILENAME_MY_POINTS_HELP,'faq_item=13', 'NONSSL') . '" title="' . BOX_INFORMATION_MY_POINTS_HELP . '">' . BOX_INFORMATION_MY_POINTS_HELP . '</a>'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><?php echo '<b>' . sprintf(TEXT_REVIEW_BY, tep_output_string_protected($review['customers_name'])) . '</b>'; ?></td>
                    <td class="smallText" align="right"><?php echo sprintf(TEXT_REVIEW_DATE_ADDED, tep_date_long($review['date_added'])); ?></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
                  <tr class="infoBoxContents">
                    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                      <tr>
                        <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                        <td valign="top" class="main"><?php echo tep_break_string(nl2br(tep_output_string_protected($review['reviews_text'])), 60, '-<br>') . '<br><br><i>' . sprintf(TEXT_REVIEW_RATING, tep_image(DIR_WS_IMAGES . 'icons/stars/stars_' . $review['reviews_rating'] . '.gif', sprintf(TEXT_OF_5_STARS, $review['reviews_rating'])), sprintf(TEXT_OF_5_STARS, $review['reviews_rating'])) . '</i>'; ?></td>
                        <td width="10" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                      </tr>
                    </table></td>
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
                        <td class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params(array('reviews_id'))) . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                        <td class="main" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, tep_get_all_get_params(array('reviews_id'))) . '">' . tep_image_button('button_write_review.png', IMAGE_BUTTON_WRITE_REVIEW) . '</a>'; ?></td>
                        <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                      </tr>
                    </table></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
            <td width="<?php echo SMALL_IMAGE_WIDTH + 10; ?>" align="right" valign="top"><table border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td align="center" class="smallText">
<?php
  if (tep_not_null($review['products_image'])) {
?>
<?php  if (USE_PRODUCT_INFO_LIGHTBOX == 'true') { ?>
<script language="javascript" type="text/javascript"><!--
document.write('<?php echo '<a href="images/' . $review['products_image'] . '" rel="lightbox" title="' . $review['products_name'] . '">' . tep_image(DIR_WS_IMAGES . $review['products_image'], addslashes($review['products_name']), PRODUCT_INFO_IMAGE_WIDTH, PRODUCT_INFO_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>');
//--></script>
<?php } else { ?>
<script language="javascript" type="text/javascript"><!--
document.write('<?php echo '<a href="javascript:popupWindow(\\\'' . tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $review['products_id']) . '\\\')">' . tep_image(DIR_WS_IMAGES . $review['products_image'], addslashes($review['products_name']), PRODUCT_INFO_IMAGE_WIDTH, PRODUCT_INFO_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>');
//--></script>
<?php } ?>
<noscript>
<?php echo '<a href="' . tep_href_link(DIR_WS_IMAGES . $review['products_image']) . '" target="_blank">' . tep_image(DIR_WS_IMAGES . $review['products_image'], $review['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>
</noscript>
<?php
  }

  echo '<p><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now') . '">' . tep_image_button('button_in_cart.png', IMAGE_BUTTON_IN_CART) . '</a></p>';
?>
                </td>
              </tr>
            </table>
          </td>
        </table></td>
      </tr>
    </table>

