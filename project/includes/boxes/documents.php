<?php // documents info infobox 

  $documents_string = '';
  if (DOCUMENTS_SHOW_BOX == 'True') {
    $document_type_array = document_types ();
  
    foreach ($document_type_array as $document_type) {
      $documents_query_raw = "select count(*) as total
                             from " . TABLE_DOCUMENTS . "
                             where document_types_id = '" . $document_type['id'] . "'
                               and documents_visible = 'True'
                            ";
      // print 'Documents Query: ' . $documents_query_raw . '<br>';
      $documents_query = tep_db_query ($documents_query_raw);
      $documents = tep_db_fetch_array ($documents_query);
    
      if ($documents['total'] > 0) {
        $documents_string .= '<a href="' . tep_href_link (FILENAME_DOCUMENTS, 'type=' . $document_type['id'], 'NONSSL') . '">' . $document_type['text'] . '</a><br>';
      } // if ($documents['total']
    } // foreach ($document_type_array

  $boxHeading = BOX_HEADING_DOCUMENTS;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'documents';

  $box_id = $box_base_name . 'Box';
  $boxContent = $documents_string;
  include (bts_select('boxes', $box_base_name));
  } // if (DOCUMENTS_SHOW_INFO_BOX
?>