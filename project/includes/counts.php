<?php //$Id: /catalog/includes/counts.php (5287)

$products_count_query = tep_db_query("select count(*) as number from " . TABLE_PRODUCTS . " where products_status = '1'");
$products_count = tep_db_fetch_array($products_count_query);
//echo $products_count['number'];
$productsonline = $products_count['number'];

?>
