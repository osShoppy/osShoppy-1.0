<?php // catalog/includes/modules/documents.php (7005)

// Generate a set of links to documents linked to this product
    $products_documents_query_raw = "
      select 
        count(*) as total
      from 
        " . TABLE_PRODUCTS_TO_DOCUMENTS . "
      where 
        products_id = '" . (int) $_GET['products_id'] . "'
    ";
    $products_documents_query = tep_db_query ($products_documents_query_raw);
    $products_documents = tep_db_fetch_array ($products_documents_query);
    if ($products_documents['total'] > 0) {
      
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
<?php

      $buttons_array = array();
      $products_documents_query_raw = "
        select 
          d.documents_id,
          d.documents_name,
          d.documents_size,
          d.documents_title,
          dt.type_name,
          dt.type_description
        from " . TABLE_DOCUMENTS . " d,
             " . TABLE_DOCUMENT_TYPES . " dt,
             " . TABLE_PRODUCTS_TO_DOCUMENTS . " p2d
        where p2d.products_id = '" . (int) $_GET['products_id'] . "'
          and d.documents_id = p2d.documents_id
          and dt.document_types_id = d.document_types_id
          and d.documents_visible = 'True'
          and dt.type_visible = 'True'
        order by 
          dt.sort_order,
          d.sort_order
      ";
      
      $products_documents_query = tep_db_query ($products_documents_query_raw);
      while ($products_documents = tep_db_fetch_array ($products_documents_query) ) {
        // Separate the document name and the extension from the filename
        $documents_name = $products_documents['documents_name'];
        $filename_parts = pathinfo ($documents_name);
        $documents_name = $filename_parts['filename'];
        $documents_extension = $filename_parts['extension'];
        
        // Get the document information from the extension
        $document_type_array = tep_get_document_type ($documents_extension);

        echo '<span class="document_type">' . $products_documents['type_description'] . ':</span> ';
        echo '<span class="document"><a href="' . tep_href_link (DIR_WS_DOCUMENTS . $products_documents['type_name'] . '/' . $products_documents['documents_name']) . '" target="_new">';
        echo $products_documents['documents_title'];
        echo ' [' . number_format ($products_documents['documents_size']) . ' k]';
        echo '&nbsp;' . $document_type_array['icon'];
        echo '</a></span><br>';

      } // while ($products_documents
    } // if ($products_documents

?>
        </td>
      </tr>