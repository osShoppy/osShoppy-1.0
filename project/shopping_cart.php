<?php //$Id: /catalog/shopping_cart.php (osC)

  require("includes/application_top.php");

  if ($cart->count_contents() > 0) {
    include(DIR_WS_CLASSES . 'payment.php');
    $payment_modules = new payment;
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_SHOPPING_CART);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_SHOPPING_CART));

// dangling_carrot_start
	if ($cart->count_contents() > 0){
	// find any free gifts, and remove invalid ones
	$num_in_cart = $cart->show_total();
	$products = $cart->get_products();
  
	$gift_query = tep_db_query("SELECT fg.*, p.products_id, p.products_model, p.products_price, p.products_image, p.products_status, pd.products_name FROM (" . TABLE_CARROT . " fg, " . TABLE_PRODUCTS . " p)
LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd ON (pd.products_id=fg.products_id)
WHERE pd.language_id = '".$languages_id."' AND p.products_id = fg.products_id AND p.products_status = '1' ORDER BY fg.threshold ASC");

	$threshold = 0;
	$p=0;
	$gift_price=0;
	$gift_exists=0;
	
	while ($gift = tep_db_fetch_array($gift_query)) {   // loop through the current gifts
	if ($gift_exists == 0){
	for ($i=0, $n=sizeof($products); $i<$n; $i++) {
	if ($products[$i]['id'] == $gift['products_id']) { // gift already in cart
	$gift_exists = $products[$i]['id'];
	$gift_price = $gift['products_price'];
	$deficit = $gift['threshold'] - $num_in_cart + $gift_price;
	break;
	} else {
	$deficit = $gift['threshold'] - $num_in_cart;
	}
	}
	} else {
	$deficit = $gift['threshold'] - $num_in_cart + $gift_price;	
	}
		
	if ( $deficit < GIFTS_NEXT_LIMIT && $deficit > 0 ) {
	$near_limit = 1;
	} else {
	$near_limit = 0;
	}
		
	if ($num_in_cart >= $gift['threshold'] && $deficit <= 0) { 
	// cart could qualify for this gift
	// check to see if in cart already
	// add to gift list if not in cart
	if ($gift['products_id'] != $gift_exists && $deficit <= 0) { // this particular gift is not in cart but qualifies
    //$freebie[$p]['message'] .= sprintf(TEXT_QUALIFIED_FOR_GIFT, $currencies->display_price($product_gift['threshold'], $gift['threshold'],tep_get_tax_rate($gift['products_tax_class_id'])));
if(AUTO_GIFT_SHOPPING_CART == 'true') {
	if (!$cart->in_cart($gift['products_id'])) $cart->add_cart($gift['products_id']);
} else {
    $freebie[$p]['message'] .= sprintf(TEXT_QUALIFIED_FOR_GIFT, $currencies->display_price($gift['threshold'],tep_get_tax_rate($gift['products_tax_class_id'])));
	$freebie[$p]['link'] = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $gift['products_id']) . '"><br>' . tep_image_button('button_add_present.png', 'Select ' . $gift['products_id'] ) . '</a>';
	$freebie[$p]['name']    		= $gift['products_name'];
	$freebie[$p]['id']      		= $gift['products_id'];
	$freebie[$p]['image']   		= $gift['products_image'];
	$p++;
}
	}
	} else if ($near_limit) {
	if ($gift['products_id'] != $gift_exists) { // this particular gift is not in cart
	//$freebie[$p]['message'] .= sprintf(TEXT_CLOSE_TO_FREE_GIFT, $currencies->display_price($product_gift['threshold'], $deficit,tep_get_tax_rate($gift['products_tax_class_id'])));
    $freebie[$p]['message'] .= sprintf(TEXT_CLOSE_TO_FREE_GIFT, $currencies->display_price($deficit,tep_get_tax_rate($gift['products_tax_class_id'])));	
	$freebie[$p]['link'] = '';
	$freebie[$p]['name']    		= $gift['products_name'];
	$freebie[$p]['id']      		= $gift['products_id'];
	$freebie[$p]['image']   		= $gift['products_image'];
	$p++;
	} else {
	// cart cannot qualify for this gift
	// remove if in cart
	$cart->remove($gift['products_id']);
	}
	} else {
	// cart cannot qualify for this gift
	// remove if in cart
	$cart->remove($gift['products_id']);
	}
	$threshold = $gift['threshold'];
	}//while
	}
// dangling_carrot_end

?><head><title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_SHOPPING_CART;

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
