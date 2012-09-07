<?php // catalog/includes/modules/link_search.php (5272)
      
if (tep_not_null($linkSearch)) { 
if ($linkFound == true) {
    while ($link_result = tep_db_fetch_array($link_query))
    {
        echo '<tr>';
        if ($link_result['links_status'] != 2) {
            echo '<td class="main">' . sprintf(TEXT_LINK_NOT_APPROVED, $link_result['links_title']) . '</td>';         
        } else {
            echo '<td class="main"><a title="' . $link_result['links_title'] . '" href="' . tep_href_link(FILENAME_LINKS, 'lPath=' .$link_result['link_categories_id'] , 'NONSSL') . '">' .  $link_result['links_title'] . '</a></td>';
        }    
        echo '</tr>'; 
    } 
} else { ?>
    <tr>
     <td class="main">No Matches Found</td>
    </tr>  
<?php }
	}
?>        