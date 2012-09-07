<?php
/*
  $Id: links.php,v 1.6 2003/02/10 22:31:00 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
 

  if ($link_featured_query = tep_db_query("select l.links_id, l.links_url, l.links_image_url, ld.links_title, lf.expires_date from " . TABLE_LINKS . " l, " . TABLE_LINKS_DESCRIPTION . " ld, " . TABLE_LINKS_FEATURED . " lf where l.links_id = ld.links_id AND ld.links_id = lf.links_id AND lf.expires_date >= now() order by RAND() limit " . MAX_RANDOM_SELECT_NEW))  {
   if ($request_type == NONSSL && tep_db_num_rows($link_featured_query) > 0) {
    $openMode = (LINKS_OPEN_NEW_PAGE == 'True') ? 'blank' : 'self';

  $boxHeading = BOX_HEADING_LINKS;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'links_column';

  $link = tep_db_fetch_array($link_featured_query);
 
	$linkscontent = '<center>';
	$linkscontent .= '<a class="featuredlinksBox" href="' . $link['links_url'] . '" target="_blank' . $openMode . '" title="' . $link['links_title'] . '"><img style="display: inline-block;" src="' . $link['links_image_url'] . '" width="' . BOX_WIDTH . '" alt="' . $link['links_title'] . '"><br>' . $link['links_title'] . '</a>';
	$linkscontent .= '</center>';

  $box_id = $box_base_name . 'Box';

  $boxContent = $linkscontent;

include (bts_select('boxes', $box_base_name));

  	}
  }
?>
