<?php // shop_by_price_drop infobox 

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SHOP_BY_PRICE);

	$price_range_list = '';
	$price_range_list[] = array('id' => '0', 'text' => BOX_HEADING_SHOP_BY_PRICE );
	
	for ($range=0; $range<sizeof($price_ranges); $range++) {
		$price_range_list[] = array('id' => $range, 'text' => $price_ranges[$range] );
	}

  $content = '<form name="shop_price" action="' . tep_href_link(FILENAME_SHOP_BY_PRICE) . '" method="get">' . tep_hide_session_id() .	tep_draw_pull_down_menu('range', $price_range_list, $range, 'onchange="this.form.submit();"  size="' . 1 . '" style="width: 100%"') . tep_hide_session_id();

  $boxHeading = BOX_HEADING_SHOP_BY_PRICE;
  $corner_top_left = 'square';
  $corner_top_right = 'square';
  $corner_bot_left = 'square';
  $corner_bot_right = 'square';
  $box_base_name = 'shop_by_price_drop';

  $box_id = $box_base_name . 'Box'; 
  $boxContent = $content;
  include (bts_select('boxes', $box_base_name));
?>