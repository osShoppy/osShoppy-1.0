<?php //$Id: /catalog/documents.php (7005)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DOCUMENTS);

  $type = '1';
  if (isset($_GET['type']) && tep_not_null ($_GET['type']) ) {
    $type = (int) $_GET['type'];
  }

  $type_array = document_types();
  $title = TITLE_DOCUMENTS;
  foreach ($type_array as $types) {
    if ($types['id'] == $type) {
      $title = $types['text'];
      break;
    }
  }

  // Document display page so get the data
  if ($type != '0') {
    if (DOCUMENTS_SHOW_CATEGORIES == 'True') {
      $documents_query_raw = "select distinct d.documents_name,
                                              d.documents_size,
                                              d.documents_title,
                                              cd.categories_name,
                                              dt.type_name
                              from " . TABLE_DOCUMENTS . " d,
                                   " . TABLE_DOCUMENT_TYPES . " dt,
                                   " . TABLE_PRODUCTS_TO_DOCUMENTS . " p2d,
                                   " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c,
                                   " . TABLE_CATEGORIES_DESCRIPTION . " cd
                              where d.document_types_id = '" . $type . "'
                                and dt.document_types_id = d.document_types_id
                                and d.documents_visible = 'True'
                                and d.documents_id = p2d.documents_id
                                and p2d.products_id = p2c.products_id
                                and p2c.categories_id = cd.categories_id
                                and cd.language_id = '" . $languages_id . "'
                              order by cd.categories_name,
                                       d.documents_title,
                                       d.documents_name
                            ";
    } else {
      $documents_query_raw = "select distinct d.documents_name,
                                              d.documents_size,
                                              d.documents_title,
                                              dt.type_name
                                       from " . TABLE_DOCUMENTS . " d,
                                            " . TABLE_DOCUMENT_TYPES . " dt
                                       where d.document_types_id = '" . $type . "'
                                         and dt.document_types_id = d.document_types_id
                                         and d.documents_visible = 'True'
                                       order by d.documents_title,
                                                d.documents_name"
                                     ;
    }
    // print 'Documents Query: ' . $documents_query_raw . "<br>\n";
    $documents_query = tep_db_query ($documents_query_raw);
    
    if (tep_db_num_rows ($documents_query) > 0) {
      $documents_heading = array();
      $documents_array = array();
      $documents_index = 0;
      
      while ($documents = tep_db_fetch_array ($documents_query)) {
        $documents_name = $documents['documents_name'];
        
        // Separate the document name and the extension from the filename
        $filename_parts = pathinfo ($documents_name);
        $documents_name = $filename_parts['filename'];
        $documents_extension = $filename_parts['extension'];
        
        // Get the document typs information from the extension
        $document_type_array = tep_get_document_type ($documents_extension);
        
        // Build an array of data for the column headings
        tep_build_columns_array ($documents_heading, $document_type_array['type'], $document_type_array['title']);
        
        // Build an array of data for each document
        $documents_array[$documents_index] = array ('name' => $documents_name,
                                                    'extension' => $documents_extension,
                                                    'size' => $documents['documents_size'],
                                                    'title' => $documents['documents_title'],
                                                    'type_name' => $documents['type_name'],
                                                    'category' => $documents['categories_name'],
                                                    'type' => $document_type_array['type'],
                                                    'icon' => $document_type_array['icon']
                                                   );
        
        $documents_index++;
      } //while ($documents =
    } // if (tep_db_num_rows
  } //if ($type != ''

  $breadcrumb->add ($title, tep_href_link (FILENAME_DOCUMENTS) );

  ?><head><title><?php echo TITLE; ?></title>
  <base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
  </head><?php

  $content = CONTENT_DOCUMENTS;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
