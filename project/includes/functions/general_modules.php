<?php // catalog/includes/functions/general_modules.php (osS)

// BOF: Featured Products
  function tep_array_values_to_string($array, $separator = ',') {
    $get_string = '';
    if (sizeof($array) > 0) {
      while (list($key, $value) = each($array)) {
          $get_string .= $value . $separator;
      }
      $remove_chars = strlen($separator);
      $get_string = substr($get_string, 0, -$remove_chars);
    }
    return $get_string;
  }
// EOF: Featured Products

// BOF: Recentley Viewed
// Limit the size of text blocks to the nearest full word
//    $text is string to be truncated, 
//    $maxchar is number of characters to limit to,
//    $wordlength is maximum length of a single word, to avoid long words breaking linewrap
  function tep_limit_text ($text, $maxchar, $wordlength = 40) {
    $text = str_replace ("\n", ' ', $text);
    $text = str_replace ("\r", ' ', $text);
    $text = str_replace ('<br>', ' ', $text);
    $text = wordwrap ($text, $wordlength, ' ', true);
    $text = ereg_replace ("[ ]+", ' ', $text);
    $text_length = strlen ($text);
    $text_array = explode (" ", $text);

    $newtext = '';
    for ($array_key = 0, $length = 0; $length <= $text_length; $array_key++) {
      $length = strlen ($newtext) + strlen ($text_array[$array_key]) + 1;
      if ($length > $maxchar) break;
      $newtext = $newtext . ' ' . $text_array[$array_key];
    }
    
    return $newtext;
  } // function tep_limit_text

// display split-page-number-links
  function tep_display_links ($max_page_links, $current_page_number, $number_of_pages, $filename, $parameters = '') {
    $display_links_string = '';
    if (tep_not_null ($parameters) && (substr ($parameters, -1) != '&') ) $parameters .= '&';

// previous button - not displayed on first page
    if ($current_page_number > 1) $display_links_string .= '<a href="' . tep_href_link ($filename, $parameters . 'page=' . ($current_page_number - 1) ) . '" class="pageResults" title=" ' . PREVNEXT_TITLE_PREVIOUS_PAGE . ' "><u>' . PREVNEXT_BUTTON_PREV . '</u></a>&nbsp;&nbsp;';

// check if number_of_pages > $max_page_links
    $cur_window_num = intval ($current_page_number / $max_page_links);
    if ($current_page_number % $max_page_links) $cur_window_num++;
    $max_window_num = intval ($number_of_pages / $max_page_links);
    if ($number_of_pages % $max_page_links) $max_window_num++;

// previous window of pages
    if ($cur_window_num > 1) $display_links_string .= '<a href="' . tep_href_link ($filename, $parameters . 'page=' . ( ($cur_window_num - 1) * $max_page_links) ) . '" class="pageResults" title=" ' . sprintf (PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE, $max_page_links) . ' ">...</a>';

// page nn button
    for ($jump_to_page = 1 + (($cur_window_num - 1) * $max_page_links); ($jump_to_page <= ($cur_window_num * $max_page_links) ) && ($jump_to_page <= $number_of_pages); $jump_to_page++) {
      if ($jump_to_page == $current_page_number) {
        $display_links_string .= '&nbsp;<b>' . $jump_to_page . '</b>&nbsp;';
      } else {
        $display_links_string .= '&nbsp;<a href="' . tep_href_link ($filename, $parameters . 'page=' . $jump_to_page) . '" class="pageResults" title=" ' . sprintf (PREVNEXT_TITLE_PAGE_NO, $jump_to_page) . ' "><u>' . $jump_to_page . '</u></a>&nbsp;';
      }
    }

// next window of pages
    if ($cur_window_num < $max_window_num) $display_links_string .= '<a href="' . tep_href_link ($filename, $parameters . 'page=' . (($cur_window_num) * $max_page_links + 1) ) . '" class="pageResults" title=" ' . sprintf (PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE, $max_page_links) . ' ">...</a>&nbsp;';

// next button
    if (($current_page_number < $number_of_pages) && ($number_of_pages != 1)) $display_links_string .= '&nbsp;<a href="' . tep_href_link ($filename, $parameters . 'page=' . ($current_page_number + 1) ) . '" class="pageResults" title=" ' . PREVNEXT_TITLE_NEXT_PAGE . ' "><u>' . PREVNEXT_BUTTON_NEXT . '</u></a>&nbsp;';

    return $display_links_string;
  }
// EOF: Recentley Viewed

////
// rmh referral
// Returns an array with sources
// TABLES: sources
  function tep_get_sources($sources_id = '') {
    $sources_array = array();
    if (tep_not_null($sources_id)) {
        $sources = tep_db_query("select sources_name from " . TABLE_SOURCES . " where sources_id = '" . (int)$sources_id . "'");
        $sources_values = tep_db_fetch_array($sources);
        $sources_array = array('sources_name' => $sources_values['sources_name']);
    } else {
      $sources = tep_db_query("select sources_id, sources_name from " . TABLE_SOURCES . " order by sources_name");
      while ($sources_values = tep_db_fetch_array($sources)) {
        $sources_array[] = array('sources_id' => $sources_values['sources_id'],
                                 'sources_name' => $sources_values['sources_name']);
      }
    }

    return $sources_array;
  }

////
// Start Documents Manager
// Build an array of downloadable document types
//   Table: document_types
  function document_types () {
    $type_array = array ();
    $documents_query_raw = "
      select 
        document_types_id,
        type_description
      from 
        " . TABLE_DOCUMENT_TYPES . "
      where
        type_visible = 'True'
      order by 
        sort_order
    ";
    
    $documents_query = tep_db_query ($documents_query_raw);
    while ($documents = tep_db_fetch_array ($documents_query) ) {
      $type_array[] = array ('id' => $documents['document_types_id'],
                             'text' => $documents['type_description']
                            );
    } // while ($documents
    
    return $type_array;
  } // function document_types

////
  function tep_build_columns_array (&$columns_array, $type, $heading) {
    $add_to_array = true;
    foreach ($columns_array as $column) {
      if ($column['type'] == $type) {
        $add_to_array = false;
        break;
      }
    }
    if ($add_to_array == true) {
      $columns_array[] = array ('type' => $type,
                                'heading' => $heading
                               );
    }
  } // function tep_build_columns_array

////
  function tep_get_column_number ($documents_heading, $documents_type) {
    $column_number = 1;
    if (is_array ($documents_heading) ) {
      foreach ($documents_heading as $heading_data) {
        if ($heading_data['type'] == $documents_type) {
          break;
        } else {
          $column_number++;
        }
      }
    }
    return $column_number;
  } //   function tep_get_column_number

////  
// Get document type information from the extension
  function tep_get_document_type ($documents_extension) {
    $document_type = array();
    switch ($documents_extension) {  // Select the file type based on the document extension
      case 'odp': // Presentations
      case 'ppt':
      case 'photo':
      case 'cbr':
      case 'cbz':
        $document_type['title'] = HEADING_DOCUMENT_FILENAME_PRESENTATION;
        $document_type['type'] = 'presentation';
        $document_type['icon'] = tep_image (DIR_WS_ICONS . 'documents/photobook_small.png');
        break;
            
      case 'doc': // Text documents
      case 'docx':
      case 'odt':
      case 'txt':
        $document_type['title'] = HEADING_DOCUMENT_FILENAME_DOC;
        $document_type['type'] = 'doc';
        $document_type['icon'] = tep_image (DIR_WS_ICONS . 'documents/wordproc_small.png');
        break;
            
      case 'xls': // Spreadsheets
      case 'ods':
        $document_type['title'] = HEADING_DOCUMENT_FILENAME_SPREADSHEET;
        $document_type['type'] = 'spreadsheet';
        $document_type['icon'] = tep_image (DIR_WS_ICONS . 'documents/spreadsheet_small.png');
        break;
            
      case 'pdf': // Portable Document Format
      case 'eps':
        $document_type['title'] = HEADING_DOCUMENT_FILENAME_PDF;
        $document_type['type'] = 'pdf';
        $document_type['icon'] = tep_image (DIR_WS_ICONS . 'documents/pdf_small.png');
        break;
            
      case 'gif': // Image/Graphics formats
      case 'jpg':
      case 'png':
      case 'tif':
      case 'tiff':
      case 'exif':
      case 'raw':
      case 'bmp':
      case 'ppm':
      case 'pbm':
      case 'pnm':
      case 'cgm':
      case 'svg':
      case 'ecw':
      case 'cd5':
      case 'odg':
      case 'wmf':
      case 'emf':
      case 'xps':
        $document_type['title'] = HEADING_DOCUMENT_FILENAME_IMAGE;
        $document_type['type'] = 'image';
        $document_type['icon'] = tep_image (DIR_WS_ICONS . 'documents/movieicon_small.gif');
        break;
            
      case 'mov': // Video formats
      case 'wmv':
      case 'mp3':
      case 'mpg':
      case 'mpeg':
      case 'ogv':
      case 'swf':
        $document_type['title'] = HEADING_DOCUMENT_FILENAME_MOVIE;
        $document_type['type'] = 'movie';
        $document_type['icon'] = tep_image (DIR_WS_ICONS . 'documents/movieicon_small.png');
        break;
            
      case 'txt': // Text files
      case 'rtf':
        $document_type['title'] = HEADING_DOCUMENT_FILENAME_TEXT;
        $document_type['type'] = 'text';
        $document_type['icon'] = tep_image (DIR_WS_ICONS . 'documents/text_small.png');
        break;
            
      case 'iso': // CD or DVD images
        $document_type['title'] = HEADING_DOCUMENT_FILENAME_CD;
        $document_type['type'] = 'cd_image';
        $document_type['icon'] = tep_image (DIR_WS_ICONS . 'documents/cdimage_small.png');
        break;
            
      case 'odb': // Database
        $document_type['title'] = HEADING_DOCUMENT_FILENAME_DATABASE;
        $document_type['type'] = 'database';
        $document_type['icon'] = tep_image (DIR_WS_ICONS . 'documents/spreadsheet_small.png');
        break;
            
      case 'html': // Web page
      case 'xml': 
        $document_type['title'] = HEADING_DOCUMENT_FILENAME_HTML;
        $document_type['type'] = 'html';
        $document_type['icon'] = tep_image (DIR_WS_ICONS . 'documents/html_small.png');
        break;
            
      case 'zip': // Archives
      case 'gz':
      case 'tgz':
      case 'tar.gz':
      case 'tar.gzip':
      case '7z':
      case 'rar':
        $document_type['title'] = HEADING_DOCUMENT_FILENAME_ARCHIVE;
        $document_type['type'] = 'archive';
        $document_type['icon'] = tep_image (DIR_WS_ICONS . 'documents/tgz_small.png');
        break;

      case 'misc': // Everything else
      case '':
      default:
        $document_type['title'] = HEADING_DOCUMENT_FILENAME_MISC;
        $document_type['type'] = 'misc';
        $document_type['icon'] = tep_image (DIR_WS_ICONS . 'documents/misc_small.png');
        break;
    } //switch ($documents_extension
    
    return $document_type;
  }

////
// rma returns
  include('includes/functions/refund_functions.php');

////
// giftwrap
  function tep_count_giftwrap_modules() {
    return tep_count_modules(MODULE_GIFTWRAP_INSTALLED);
  }

////
// quotes 
//Retuns just the date - no time - added for Quotes system by www.oscommerce-solution.com
  function tep_date_only($raw_datetime) {
    if ( ($raw_datetime == '0000-00-00 00:00:00') || ($raw_datetime == '') ) return false;

    $year = (int)substr($raw_datetime, 0, 4);
    $month = (int)substr($raw_datetime, 5, 2);
    $day = (int)substr($raw_datetime, 8, 2);
    $hour = (int)substr($raw_datetime, 11, 2);
    $minute = (int)substr($raw_datetime, 14, 2);
    $second = (int)substr($raw_datetime, 17, 2);

    $s = mktime(0, 0, 0, date($month)  , date($day), date($year));
    return strftime("%m-%d-%y", $s);
  }
  
////
// article manager
  function GetBoldTags($page, $id = 0)
  {
     $boldTags = array();
     if (basename($_SERVER['PHP_SELF']) === $page) {
         if ($id == 0) {
             $boldTags['start'] = '<b>';
             $boldTags['stop'] = '</b>';
         }
         else if ((int)$_GET['articles_id'] == $id)  {
             $boldTags['start'] = '<b>';
             $boldTags['stop'] = '</b>';
         }
     } else {
          $boldTags['start'] = '';     //fill these in to prevent STRICT errors
          $boldTags['stop'] = '';
     }
     return $boldTags;
  }

  function SortBySetting($a, $b) {
    return strnatcasecmp($a["sort_order"], $b["sort_order"]);
  }

  function tep_show_topic($counter) {
    global $tree, $topics_string, $tPath_array, $topicCtr;

    for ($i=0; $i<$tree[$counter]['level']; $i++) {
      $topics_string .= "&nbsp;&nbsp;";
    }

    $topics_string .= '&nbsp;<a href="';

    if ($tree[$counter]['parent'] == 0) {
      $tPath_new = 'tPath=' . $counter;
    } else {
      $tPath_new = 'tPath=' . $tree[$counter]['path'];
    }

    $topics_string .= tep_href_link(FILENAME_ARTICLES, $tPath_new) . '">';

    if (isset($tPath_array) && in_array($counter, $tPath_array)) {
      $topics_string .= '<b>';
    }

// display topic name
    $topics_string .= $tree[$counter]['name'];

    if (isset($tPath_array) && in_array($counter, $tPath_array)) {
      $topics_string .= '</b>';
    }

    if (tep_has_topic_subtopics($counter)) {
      $topics_string .= ' -&gt;';
    }

    $topics_string .= '</a>';

    if (SHOW_ARTICLE_COUNTS == 'true') {
      $articles_in_topic = tep_count_articles_in_topic($counter);
      if ($articles_in_topic > 0) {
        $topics_string .= '&nbsp;(' . $articles_in_topic . ')';
      }
    }

    $topics_string .= '<br>';

    if (tep_not_null(ARTICLE_BOX_DISPLAY_TOPICS_LINKS_LIMIT) && $topicCtr >= ARTICLE_BOX_DISPLAY_TOPICS_LINKS_LIMIT) {
        $topics_string .= '&nbsp;<a href="' . tep_href_link(FILENAME_ARTICLE_TOPICS, '', 'NONSSL') . '">' . $boldTags['start'] . '<div style="float:right; color:red;">' . TEXT_READ_MORE . '</div>' . $boldTags['stop'] . '</a><br>';
        return;
    }
    $topicCtr++;

    if ($tree[$counter]['next_id'] != false) {
      tep_show_topic($tree[$counter]['next_id']);
    }
  }

////
// credit class gift voucher
////
// Create a Coupon Code. length may be between 1 and 16 Characters
// $salt needs some thought.

  function create_coupon_code($salt="secret", $length = SECURITY_CODE_LENGTH) {
    $ccid = md5(uniqid("","salt"));
    $ccid .= md5(uniqid("","salt"));
    $ccid .= md5(uniqid("","salt"));
    $ccid .= md5(uniqid("","salt"));
    srand((double)microtime()*1000000); // seed the random number generator
    $random_start = @rand(0, (128-$length));
    $good_result = 0;
    while ($good_result == 0) {
      $id1=substr($ccid, $random_start,$length);        
      $query = tep_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_code = '" . $id1 . "'");    
      if (tep_db_num_rows($query) == 0) $good_result = 1;
    }
    return $id1;
  }
////
// Update the Customers GV account
  function tep_gv_account_update($customer_id, $gv_id) {
    $customer_gv_query = tep_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id = '" . $customer_id . "'");
    $coupon_gv_query = tep_db_query("select coupon_amount from " . TABLE_COUPONS . " where coupon_id = '" . $gv_id . "'");
    $coupon_gv = tep_db_fetch_array($coupon_gv_query);
    if (tep_db_num_rows($customer_gv_query) > 0) {
      $customer_gv = tep_db_fetch_array($customer_gv_query);
      $new_gv_amount = $customer_gv['amount'] + $coupon_gv['coupon_amount'];
   // new code bugfix
   $gv_query = tep_db_query("update " . TABLE_COUPON_GV_CUSTOMER . " set amount = '" . $new_gv_amount . "' where customer_id = '" . $customer_id . "'");  
	 // original code $gv_query = tep_db_query("update " . TABLE_COUPON_GV_CUSTOMER . " set amount = '" . $new_gv_amount . "'");
    } else {
      $gv_query = tep_db_query("insert into " . TABLE_COUPON_GV_CUSTOMER . " (customer_id, amount) values ('" . $customer_id . "', '" . $coupon_gv['coupon_amount'] . "')");
    }
  }
////
// Get tax rate from tax description
  function tep_get_tax_rate_from_desc($tax_desc) {
    $tax_query = tep_db_query("select tax_rate from " . TABLE_TAX_RATES . " where tax_description = '" . $tax_desc . "'");
    $tax = tep_db_fetch_array($tax_query);
    return $tax['tax_rate'];
  }
?>
