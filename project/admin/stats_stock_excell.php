<?php //$Id: /catalog/admin/stats_stock.php (4122)

  require('includes/application_top.php');
  
  include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_STATS_STOCK_ACTIVE);
  
header("Content-Type: application/csv-tab-delimited-table");
header("Content-disposition: filename=inventaire.csv");
echo CATEGORY_TITLE . ";" . PRODUCT_TITLE . ";" . QUANTITY_TITLE . ";" . UNIT_PRICE_TITLE . ";" . TOTAL_PRICE_TITLE . ";" . TOTAL_PRICE_TTC . "\n";


$language_code = (isset($HTTP_GET_VARS['language']) && tep_not_null($HTTP_GET_VARS['language'])) ? $HTTP_GET_VARS['language'] : DEFAULT_LANGUAGE;

$included_categories_query = tep_db_query("SELECT c.categories_id, c.parent_id, cd.categories_name FROM " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd WHERE c.categories_id = cd.categories_id AND cd.language_id = FLOOR($languages_id)");

$inc_cat = array();
while ($included_categories = tep_db_fetch_array($included_categories_query)) {
  $inc_cat[] = array (
     'id' => $included_categories['categories_id'],
     'parent' => $included_categories['parent_id'],
     'name' => $included_categories['categories_name']);
  }
$cat_info = array();
for ($i=0; $i<sizeof($inc_cat); $i++)
  $cat_info[$inc_cat[$i]['id']] = array (
    'parent'=> $inc_cat[$i]['parent'],
    'name'  => $inc_cat[$i]['name'],
    'path'  => $inc_cat[$i]['id'],
    'link'  => '' );

for ($i=0; $i<sizeof($inc_cat); $i++) {
  $cat_id = $inc_cat[$i]['id'];
  while ($cat_info[$cat_id]['parent'] != 0){
    $cat_info[$inc_cat[$i]['id']]['path'] = $cat_info[$cat_id]['parent'] . '_' . $cat_info[$inc_cat[$i]['id']]['path'];
    $cat_id = $cat_info[$cat_id]['parent'];
    }
  $link_array = split('_', $cat_info[$inc_cat[$i]['id']] ['path']);
  for ($j=0; $j<sizeof($link_array); $j++) {
    $cat_info[$inc_cat[$i]['id']]['link'] .= $cat_info[$link_array[$j]]['name'] . ' - ';
    }
  }

$products_query = tep_db_query("SELECT p.products_id, p.products_quantity, pd.products_name, pc.categories_id, p.products_price FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " pc WHERE p.products_id = pd.products_id AND p.products_id = pc.products_id AND pd.language_id = FLOOR($languages_id) ORDER BY pc.categories_id, pd.products_name");

while($products = tep_db_fetch_array($products_query)) { ?>
<?php	echo utf8_decode((($memory == $products['categories_id'])? '': $cat_info[$products['categories_id']]['link'])) . ";" .
             utf8_decode($products['products_name']) . ";" .
             $products['products_quantity'] . ";" .
             str_replace(".",",",$products['products_price']) . ";" .
             str_replace(".",",",$products['products_price']*$products['products_quantity']) . ";" .
             str_replace(".",",",round($products['products_price']*$products['products_quantity']*1.196,2)) . "\n";
 ?>
<?php
  $memory = $products['categories_id'];
  }
?>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>