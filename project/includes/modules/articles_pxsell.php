<?php // catalog/includes/modules/articles_pxsell.php (1709)

if ($_GET['products_id']) {
$xsell_query = tep_db_query("select distinct ax.articles_id, ad.articles_name, a.articles_last_modified from " . TABLE_ARTICLES_XSELL . " ax LEFT JOIN ".TABLE_ARTICLES." a USING(articles_id) LEFT JOIN " . TABLE_ARTICLES_DESCRIPTION . " ad USING(articles_id) where ax.xsell_id = '" . (int)$_GET['products_id'] . "' and ad.language_id = '" . (int)$languages_id . "' and a.articles_status = '1' order by a.articles_last_modified");
$num_products_xsell = tep_db_num_rows($xsell_query);
if ($num_products_xsell >= MIN_DISPLAY_ARTICLES_XSELL) {
?> 
<!-- xsell_articles //-->
<?php
      $info_box_contents = array();
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_PXSELL_ARTICLES);
  	  new infoBoxHeading($info_box_contents, false, false);

      $row = 0;
      $col = 0;
      $info_box_contents = array();
      while ($xsell = tep_db_fetch_array($xsell_query)) {
        $xsell['products_name'] = tep_get_products_name($xsell['products_id']);
        $info_box_contents[$row][$col] = array('align' => 'center',
                                               'params' => 'class="smallText" width="33%" valign="top"',
                                               'text' => tep_image(DIR_WS_IMAGES.'icons/documents/misc_small.png', $xsell['articles_name']).'&nbsp;<a href="' . tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $xsell['articles_id']) . '">' . $xsell['articles_name'] . '</a><br>');
        $col ++;
        if ($col > 1) {
          $col = 0;
          $row ++;
        }
      }
      new contentBox($info_box_contents);
?>
<!-- xsell_articles_eof //-->
<?php
    }
  }
?>
