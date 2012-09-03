<!-- banner_index_product_list_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'index_prod_top')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
			</table>
		  <?php } ?>
<!-- banner_index_producy_list_top_eof //-->
<?php /*** Begin Header Tags SEO ***/
    if (isset($HTTP_GET_VARS['manufacturers_id']))
      $db_query = tep_db_query("select manufacturers_htc_title_tag as htc_title, manufacturers_htc_description as htc_description from " . TABLE_MANUFACTURERS_INFO . " where languages_id = '" . (int)$languages_id . "' and manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "'");
    else
      $db_query = tep_db_query("select categories_htc_title_tag as htc_title, categories_htc_description as htc_description from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$current_category_id . "' and language_id = '" . (int)$languages_id . "'");

    $htc = tep_db_fetch_array($db_query);
    ?>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
<?php if (USE_HEADING_TITLE_ON_INDEX_PRODUCTS == 'true') { ?>
            <td><h1><?php echo $htc['htc_title']; ?></h1></td>
<?php } /*** End Header Tags SEO ***/ ?>
<?php
// optional Product List Filter
    if (PRODUCT_LIST_FILTER > 0) {
      if (isset($HTTP_GET_VARS['manufacturers_id'])) {
// BOF-A: activate inactivate category /Step-1(1)\
//orig->$filterlist_sql = "select distinct c.categories_id as id, cd.categories_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where p.products_status = '1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p2c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "' order by cd.categories_name";
        $filterlist_sql = "select distinct c.categories_id as id, cd.categories_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where p.products_status = '1' and c.status_categ = 1" . (!empty($hiddencats) ? " and (not (p2c.categories_id in (" . implode(',', $hiddencats) . ")))" : "") . " and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "' order by cd.categories_name";
      } else {
        $filterlist_sql= "select distinct m.manufacturers_id as id, m.manufacturers_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and p.products_id = p2c.products_id and p2c.categories_id = '" . (int)$current_category_id . "' order by m.manufacturers_name";
      }
      $filterlist_query = tep_db_query($filterlist_sql);
      if (tep_db_num_rows($filterlist_query) > 1) {
//// Ultimate SEO url's 5 PRO
// orginal->echo '            <td align="center" class="main">' . tep_draw_form('filter', FILENAME_DEFAULT, 'get') . TEXT_SHOW . '&nbsp;';
			echo '            <td align="center" class="main">' . tep_draw_form('filter', tep_href_link( FILENAME_DEFAULT ), 'get') . TEXT_SHOW . '&nbsp;';
        if (isset($HTTP_GET_VARS['manufacturers_id'])) {
          echo tep_draw_hidden_field('manufacturers_id', $HTTP_GET_VARS['manufacturers_id']);
          $options = array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES));
        } else {
          echo tep_draw_hidden_field('cPath', $cPath);
          $options = array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS));
        }
        echo tep_draw_hidden_field('sort', $HTTP_GET_VARS['sort']);
        while ($filterlist = tep_db_fetch_array($filterlist_query)) {
          $options[] = array('id' => $filterlist['id'], 'text' => $filterlist['name']);
        }
        echo tep_draw_pull_down_menu('filter_id', $options, (isset($HTTP_GET_VARS['filter_id']) ? $HTTP_GET_VARS['filter_id'] : ''), 'onchange="this.form.submit()"');
        echo tep_hide_session_id() . '</form></td>' . "\n";
      }
    }

// Get the right image for the top-right
    $image = DIR_WS_IMAGES . 'table_background_list.gif';
    if (isset($HTTP_GET_VARS['manufacturers_id'])) {
      $image = tep_db_query("select manufacturers_image from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$HTTP_GET_VARS['manufacturers_id'] . "'");
      $image = tep_db_fetch_array($image);
      $image = $image['manufacturers_image'];
    } elseif ($current_category_id) {
      $image = tep_db_query("select categories_image from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'");
      $image = tep_db_fetch_array($image);
      $image = $image['categories_image'];
    }
?>

          <?php /*** Begin Header Tags SEO ***/ ?>
<?php if (USE_HEADING_IMAGE_ON_INDEX_PRODUCTS == 'true') { ?>
           <td align="right"><?php echo tep_image(DIR_WS_IMAGES . $image, $htc['htc_title'], HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php } ?>
          </tr>
          <?php if (tep_not_null($htc['htc_description'])) { ?>
          <tr>
           <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
           <td colspan="2"><h2><?php echo $htc['htc_description']; ?></h2></td>
          </tr>
          <?php } 
          /*** End Header Tags SEO ***/ 
          ?>
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
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
// EOF: Store Mode
?>
<?php if (USE_BUTTON_BACK_TOP_ON_INDEX_PRODUCTS == 'true') { ?>
      <tr>
    	<td><table border="0" width="90%" cellspacing="0" cellpadding="0" align="center">
      <td><a href="javascript:history.go(-1)"><?php echo tep_image_button('button_back.png', IMAGE_BUTTON_BACK); ?></a></td>
    	</td></table>
      </tr>
<?php } ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '3'); ?></td>
      </tr>
<?php if (USE_INFO_TEXT_ON_INDEX_PRODUCTS == 'true') { ?>
      <tr>
    	<td><table border="0" width="95%" cellspacing="0" cellpadding="0" align="center" class="main">
		  <td><?php echo INFO_TEXT ?></td>
    	</td></table>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td>
      </tr>
<?php } ?>
      <tr>
    	<td><table border="0" width="95%" cellspacing="0" cellpadding="0" align="center">
<?php if (USE_LISTING_STANDARD_OR_ENHANCED == 'standard') { ?>
        	<td><?php include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING); ?></td>
<?php } else{ ?>
        	<td><?php include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_ENHANCED); ?></td>
<?php } ?>
    	</td></table>
      </tr>
      <tr>
        <td><table border="0" width="60%" cellspacing="1" cellpadding="2" align="center">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td><?php if (HEADER_TAGS_DISPLAY_SOCIAL_BOOKMARKS_PRODUCTS_LIST == 'true') 
           									include(DIR_WS_MODULES . 'header_tags_social_bookmarks.php'); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
        </table></td>
      </tr>
<?php if (USE_BUTTON_BACK_BOTTOM_ON_INDEX_PRODUCTS == 'true') { ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
    	<td><table border="0" width="90%" cellspacing="0" cellpadding="0" align="center">
      <td><a href="javascript:history.go(-1)"><?php echo tep_image_button('button_back.png', IMAGE_BUTTON_BACK); ?></a></td>
    	</td></table>
      </tr>
<?php } ?>
    </table>
<!-- banner_index_product_list_bottom //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'index_prod_bot')) { ?>
			<table border="0" width="100%" cellspacing="0" cellpadding="0">
		      <tr>
        		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
      		  </tr>
  			  <tr>
    			<td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  			  </tr>
			</table>
		  <?php } ?>
<!-- banner_index_product_list_bottom_eof //-->
