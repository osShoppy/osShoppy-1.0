<!-- banner_top //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'links_top')) { ?>
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
       <?php if (LINKS_SHOW_CATEGORIES == 'true') { ?>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
			<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            	<td class="pageHeading"><h1>             <?php
             if (tep_not_null($parentID)) {
                 $linkcat_query = tep_db_query("select ld.link_categories_name from " . TABLE_LINK_CATEGORIES_DESCRIPTION . " ld left join " . TABLE_LINK_CATEGORIES . " lc on ld.link_categories_id = lc.link_categories_id where  lc.link_categories_id = '" . (int)$parentID . "' and (ld.language_id = '" . (int)$languages_id . "' or ld.language_id = '99') LIMIT 1");
                 $linkcat = tep_db_fetch_array($linkcat_query);
                 echo sprintf(TEXT_MAIN_LINKS, $linkcat['link_categories_name']);
             } else {
                 echo HEADING_TITLE_CATEGORIES;
             }
             ?>
			</h1></td>
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
        <td class="main">
         <?php
          $category_description = tep_get_link_category_description($parentID, $languages_id);
          echo ((tep_not_null($category_description)) ?  $category_description :   TEXT_MAIN_CATEGORIES);
          ?>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <?php if (tep_not_null($link_featured)) { ?>
      <tr>
       <td class="linkFeatured"><table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
         <td class="linkFeaturedHeading"><?php echo TEXT_FEATURED_HEADING; ?></td>
        </tr>
        <tr>
         <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
        </tr>
        <tr>
         <td class="linkFeaturedMain"><?php echo $link_featured; ?></td>
        </tr>
       </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <?php } ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
<?php

    $categories_query = tep_get_child_categories($parentID);
    $number_of_categories = tep_db_num_rows($categories_query);

    if ($number_of_categories > 0) {
      $rows = 0;
      while ($categories = tep_db_fetch_array($categories_query))
      {
        $linkCount = tep_links_in_category_count($categories['link_categories_id']);

        if (LINKS_SHOW_ALL_CATEGORIES == 'true' || $linkCount > 0) //only show categories with links
        {
          $rows++;
          $lPath_new = 'lPath=' . $categories['parent_id'] . '_' .$categories['link_categories_id'];
          $width = (int)(100 / MAX_DISPLAY_CATEGORIES_PER_ROW) . '%';
          echo '<td class="linkListingCats" width="' . $width . '" valign="top"><a class="linkListingCats" href="' . tep_href_link(FILENAME_LINKS, $lPath_new) . '" title="' . $categories['link_categories_name'] . '">';

          if (SHOW_LINKS_CATEGORIES_IMAGE == 'true') {
            if (tep_not_null($categories['link_categories_image'])) {
              echo tep_image(DIR_WS_IMAGES . $categories['link_categories_image'], $categories['link_categories_name'], LINKS_CATEGORY_IMAGE_WIDTH, LINKS_CATEGORY_IMAGE_HEIGHT) . '<br>';
            } else {
              echo tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', $categories['link_categories_name'], LINKS_CATEGORY_IMAGE_WIDTH, LINKS_CATEGORY_IMAGE_HEIGHT, 'style="border: 3px double black"') . '<br>';
            }
          }

          $linkCount = (LINKS_SHOW_CATEGORIES_COUNT == 'true') ? '(' . $linkCount . ')' : '';
          echo '<br><b><u>' . $categories['link_categories_name'] . '</b></u></a>&nbsp;' . $linkCount . '<br>';

          if (LINKS_SHOW_CATEGORIES_DESCIPTION == 'true') { //display part of the category description
              $more = '';
              if (strlen($categories['link_categories_description']) > 100 ) {
                  $length = 100;
                  $more = '<a class="linkListingCats" href="' . tep_href_link(FILENAME_LINKS, $lPath_new) . '" title="' . $categories['link_categories_name'] . '"><span style="font-size:10px; color:red">' . TEXT_LINK_CATEGORY_MORE . '</span></a>';
              } else {
                  $length = strlen($categories['link_categories_description']);
              }
              echo '<span class="linkListingDescription">' . substr($categories['link_categories_description'], 0, $length) . $more . '</span><br><br>';
          }

          //SHOW THE SUB CATEGORIES
          $category_subcats = tep_get_sublink_categories($categories['link_categories_id'], '', $category_subcats);
          $subCtr = 1;

          foreach($category_subcats as $id => $name) {
            $name = str_replace(" ", "&nbsp;", $name);
            echo '<a class="linkListingSubCats" href="' . tep_href_link(FILENAME_LINKS, 'lPath=' . tep_get_parent_category($id) . '_' .$id) . '" title="' . $name . '"><u>' . $name . '</u></a>';

            if ($subCtr >= MAX_LINKS_SUB_CATEGORIES_DISPLAY)
            {
              echo ',...';
              break;
            }
            else if ($subCtr < count($category_subcats))
              echo ', ';

            $subCtr++;
          }

          echo '</td>' . "\n";
          if ((($rows / MAX_DISPLAY_CATEGORIES_PER_ROW) == floor($rows / MAX_DISPLAY_CATEGORIES_PER_ROW)) && ($rows != $number_of_categories)) {
            echo '              </tr>' . "\n";
            echo '              <tr>' . "\n";
          }
        }
      }
    } else if ($parentID < 1) {
?>
        <td><?php new infoBox(array(array('text' => TEXT_NO_CATEGORIES))); ?></td>
<?php
    }
?>

              </tr>
            </table></td>
          </tr>
        </table></td>


<?php
     $useCategories = 'and l2lc.link_categories_id = \'' . (int)$parentID . '\'';
   }
   else // end of LINKS_SHOW_CATEGORIES
   {
     $parentID = 1;
     $useCategories = '';

     ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
			<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            	<td class="pageHeading"><h1><?php echo HEADING_TITLE_LINKS; ?></h1></td>
			<?php } ?>
			<?php if (USE_HEADING_IMAGE_ON_ALL_PAGES == 'true') { ?>
            	<td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_about_us.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
			<?php } ?>
          </tr>
        </table></td>
      </tr>
     <?php
   }


// create column list
    $define_list = array('LINK_LIST_TITLE' => LINK_LIST_TITLE,
                         'LINK_LIST_URL' => LINK_LIST_URL,
                         'LINK_LIST_IMAGE' => LINK_LIST_IMAGE,
                         'LINK_LIST_DESCRIPTION' => LINK_LIST_DESCRIPTION,
                         'LINK_LIST_COUNT' => LINK_LIST_COUNT);

    asort($define_list);

    $column_list = array();
    reset($define_list);
    while (list($key, $value) = each($define_list)) {
      if ($value > 0) $column_list[] = $key;
    }

    $select_column_list = '';

    for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
      switch ($column_list[$i]) {
        case 'LINK_LIST_TITLE':
          $select_column_list .= 'ld.links_title, ';
          break;
        case 'LINK_LIST_URL':
          $select_column_list .= 'l.links_url, ';
          break;
        case 'LINK_LIST_IMAGE':
          $select_column_list .= 'l.links_image_url, ';
          break;
        case 'LINK_LIST_DESCRIPTION':
          $select_column_list .= 'ld.links_description, ';
          break;
        case 'LINK_LIST_COUNT':
          $select_column_list .= 'l.links_clicked, ';
          break;
      }
    }

// show the links in a given category
// We show them all

  $listing_sql = "select " . $select_column_list . " l.links_id from " . TABLE_LINKS_DESCRIPTION . " ld left join " . TABLE_LINKS . " l on ld.links_id = l.links_id left join " . TABLE_LINKS_TO_LINK_CATEGORIES . " l2lc on l.links_id = l2lc.links_id where l.links_status = '2' and CHAR_LENGTH(ld.links_title) > '0'" . $useCategories . " and ( ld.language_id = '" . (int)$languages_id . "' or ld.language_id = 99 )";

  if ( (!isset($_GET['sort'])) || (! preg_match('/[1-8][ad]/', $_GET['sort'])) || (substr($_GET['sort'], 0, 1) > sizeof($column_list)) ) {
    for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
      if ($column_list[$i] == 'LINK_LIST_TITLE') {
        $_GET['sort'] = $i+1 . 'a';
        $listing_sql .= " order by ld.links_title";
        break;
      }
    }
  } else {
    $sortValue = preg_replace('/[^A-Za-z0-9_]/', '', $_GET['sort']);
    $sort_col = substr($sortValue, 0 , 1);
    $sort_order = substr($sortValue, 1);
    $listing_sql .= ' order by ';
    switch ($column_list[$sort_col-1]) {
      case 'LINK_LIST_TITLE':
        $listing_sql .= "ld.links_title " . ($sort_order == 'd' ? 'desc' : '');
        break;
      case 'LINK_LIST_URL':
        $listing_sql .= "l.links_url " . ($sort_order == 'd' ? 'desc' : '') . ", ld.links_title";
        break;
      case 'LINK_LIST_IMAGE':
        $listing_sql .= "ld.links_title";
        break;
      case 'LINK_LIST_DESCRIPTION':
        $listing_sql .= "ld.links_description " . ($sort_order == 'd' ? 'desc' : '') . ", ld.links_title";
        break;
      case 'LINK_LIST_COUNT':
        $listing_sql .= "l.links_clicked " . ($sort_order == 'd' ? 'desc' : '') . ", ld.links_title";
        break;
    }
  }

    $showCat = (LINKS_SHOW_CATEGORIES == 'true' ? ' and lc.link_categories_id = \'' . (int)$parentID . '\'' : '');
    $count_links_query = tep_db_query("select l.links_status from " . TABLE_LINKS . " l left join  " . TABLE_LINKS_DESCRIPTION . " ld on l.links_id = ld.links_id left join " . TABLE_LINKS_TO_LINK_CATEGORIES . " l2c on l2c.links_id = ld.links_id left join  " . TABLE_LINK_CATEGORIES . " lc on l2c.link_categories_id = lc.link_categories_id  where (l.links_status = 2 and ( ld.language_id = 99 or ld.language_id = '" . (int)$languages_id . "') " . $showCat . ")");

    if ($parentID && tep_db_num_rows($count_links_query) > 0)
    {
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <?php if (tep_not_null($link_featured_cat)) { ?>
      <tr>
       <td class="linkFeatured"><table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
         <td class="linkFeaturedHeading"><?php echo TEXT_FEATURED_HEADING; ?></td>
        </tr>
        <tr>
         <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
        </tr>
        <tr>
         <td class="linkFeaturedMain"><?php echo $link_featured_cat; ?></td>
        </tr>
       </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <?php } ?>
      <tr>
        <td class="main"><?php
         if (LINKS_SHOW_CATEGORIES == 'false') {
             echo TEXT_MAIN_LINKS_ONLY;
         }
         ?>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
        <?php if (LINKS_DISPLAY_FORMAT_STANDARD == 'true')
          include(DIR_WS_MODULES . FILENAME_LINK_LISTING);
         else
          include(DIR_WS_MODULES . 'link_listing_vertical.php');
        ?>
        </td>
      </tr>
    <?php
     }
    ?>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
              <tr class="infoBoxContents">
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <?php
                      $prev_query = tep_db_query("select parent_id from " . TABLE_LINK_CATEGORIES . " where link_categories_id = '" . (int)$lPath . "'");
                      if (tep_db_num_rows($prev_query)) {
                       $prev = tep_db_fetch_array($prev_query);

                       if ((int)$prev['parent_id'] > 0) {
                            $i = count($pathStr)-2;
                            $prevPath = $pathIDS[$pathStr[$i]] . '_' . tep_get_category_id($pathStr[$i]);
                       }
                    ?>
                       <td class="main"><?php echo '<a href="' . tep_href_link(FILENAME_LINKS, ($prev['parent_id'] > 0) ? 'lPath='.$prevPath : '') . '">' . tep_image_button('button_back.png', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                    <?php
                      }
                    ?>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td align="left" class="main"><?php echo tep_draw_form('check_links', tep_href_link(FILENAME_LINKS, tep_get_all_get_params(), 'NONSSL'), 'post', 'onSubmit="return true;" onReset="return true"') . tep_draw_hidden_field('action_search', 'process'); ?>
                    <?php echo TEXT_SEARCH_LINK . tep_draw_input_field('links_search', '', 'maxlength="255", size="30"', false) . '&nbsp;' .tep_image_submit('button_search.png', SEARCH) ; ?>
    	     	 	     </form></td>
                    <td class="main" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_LINKS_SUBMIT) . '">' . tep_image_button('button_submit_link.png', IMAGE_BUTTON_SUBMIT_LINK) . '</a>'; ?></td>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
           <td><?php include(DIR_WS_MODULES . FILENAME_LINK_SEARCH); ?></td>
          </tr>
        </table>
<!-- banner_bot //-->
          <?php if ($banner = tep_banner_exists('dynamic', 'links_bot')) { ?>
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
