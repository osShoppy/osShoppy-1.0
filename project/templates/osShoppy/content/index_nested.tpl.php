<!-- banner_index_nested_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'index_cat_top')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
			</table>
		  <?php } ?>
<!-- banner_index_nested_top_eof //-->
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
    <?php /*** Begin Header Tags SEO ***/ ?>
<?php if (USE_HEADING_TITLE_ON_INDEX_NESTED == 'true') { ?>
           <td><h1><?php echo $category['categories_htc_title_tag']; ?></h1></td>
<?php } ?>
<?php if (USE_HEADING_IMAGE_ON_INDEX_NESTED == 'true') { ?>
           <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . $category['categories_image'], $category['categories_name'], HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php } ?>
          </tr>
           <?php if (tep_not_null($category['categories_htc_description'])) { ?>
          <tr>
           <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
           <td colspan="2"><h2><?php echo $category['categories_htc_description']; ?></h2></td>
          </tr>
          <?php } 
          /*** End Header Tags SEO ***/ 
          ?>
                  </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php if (USE_BUTTON_BACK_TOP_ON_INDEX_NESTED == 'true') { ?>
      <tr>
    	<td><table border="0" width="98%" cellspacing="0" cellpadding="0" align="center">
      <td><a href="javascript:history.go(-1)"><?php echo tep_image_button('button_back.png', IMAGE_BUTTON_BACK); ?></a></td>
    	</td></table>
      </tr>
<?php } ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
<?php
    if (isset($cPath) && strpos('_', $cPath)) {
// check to see if there are deeper categories within the current category
      $category_links = array_reverse($cPath_array);
      for($i=0, $n=sizeof($category_links); $i<$n; $i++) {
        $categories_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "'and status_categ = 1 and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "'");
        $categories = tep_db_fetch_array($categories_query);
        if ($categories['total'] < 1) {
          // do nothing, go through the loop
        } else {
          $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "'and status_categ = 1 and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by sort_order, cd.categories_name");
          break; // we've found the deepest category the customer is in
        }
      }
    } else {
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "'and status_categ = 1 and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by sort_order, cd.categories_name");
    }

    $number_of_categories = tep_db_num_rows($categories_query);

    $rows = 0;
    while ($categories = tep_db_fetch_array($categories_query)) {
      $rows++;
      $cPath_new = tep_get_path($categories['categories_id']);
      $width = (int)(100 / MAX_DISPLAY_CATEGORIES_PER_ROW) . '%';
      echo '                <td align="center" class="smallText" width="' . $width . '" valign="top"><a href="' . tep_href_link(FILENAME_DEFAULT, $cPath_new) . '">' . tep_image(DIR_WS_IMAGES . $categories['categories_image'], $categories['categories_name'], CATEGORY_LIST_IMAGE_WIDTH, CATEGORY_LIST_IMAGE_HEIGHT) . '<br>' . $categories['categories_name'] . '</a></td>' . "\n";
      if ((($rows / MAX_DISPLAY_CATEGORIES_PER_ROW) == floor($rows / MAX_DISPLAY_CATEGORIES_PER_ROW)) && ($rows != $number_of_categories)) {
        echo '              </tr>' . "\n";
        echo '              <tr>' . "\n";
      }
    }

// needed for the new products module shown below
    $new_products_category_id = $current_category_id;
?>
              </tr>
            </table></td>
          </tr>
<?php
// BOF: Store Mode
  if (STORE_MODE == 'Closed') {
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="stockWarning" align="center"><?php echo CLOSED_MESSAGE . ONLINE_DATE_TIME ?></td>
      </tr>
<?php
  }
// EOF: Store Mode
?>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
      <tr>
        <td><table border="0" width="60%" cellspacing="1" cellpadding="2" align="center">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><?php if (HEADER_TAGS_DISPLAY_SOCIAL_BOOKMARKS_NESTED == 'true') 
           									include(DIR_WS_MODULES . 'header_tags_social_bookmarks.php'); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
        </table></td>
      </tr>
<?php if (USE_BUTTON_BACK_BOTTOM_ON_INDEX_NESTED == 'true') { ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
    	<td><table border="0" width="98%" cellspacing="0" cellpadding="0" align="center">
      <td><a href="javascript:history.go(-1)"><?php echo tep_image_button('button_back.png', IMAGE_BUTTON_BACK); ?></a></td>
    	</td></table>
      </tr>
<?php } ?>
          <tr>
            <td><?php include(DIR_WS_MODULES . FILENAME_NEW_PRODUCTS); ?></td>
          </tr>
        </table></td>
      </tr>
    </table>
<!-- banner_index_nested_bottom //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'index_cat_bot')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
			</table>
		  <?php } ?>
<!-- banner_index_nested_bottom_eof //-->
