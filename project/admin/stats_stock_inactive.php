<?php //$Id: /catalog/admin/stats_stock_inactive.php (4122)

  require('includes/application_top.php');
  
  include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_STATS_STOCK_INACTIVE);
?>  
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->
<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
</table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <tr>
       	 <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '20'); ?></td>
     	</tr>
      	<td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>  
          	<td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '20'); ?></td>
      </tr>
      <tr>
        <td><table width="100%" cellspacing="0" cellpadding=0" border="0">
<?php	echo
'          <tr class="dataTableHeadingRow">' .
'           <td width="40%" class="dataTableHeadingContent">' . CATEGORY_TITLE . "</td>" .
'           <td class="dataTableHeadingContent" align="center">' . PRODUCT_TITLE . "</td>" .
'			<td width="5%" class="dataTableHeadingContent" align="right"><b>' . QUANTITY_TITLE . "</b></td>" .
// JBH - 05-01-2009 - start
'			<td width="5%" class="dataTableHeadingContent" align="right"><b>' . UNIT_PRICE_TITLE . "</b></td>" .
'			<td width="5%" class="dataTableHeadingContent" align="right"><b>' . TOTAL_PRICE_TITLE . "</b></td>" .
'			<td width="5%" class="dataTableHeadingContent" align="right"><b>' . TOTAL_PRICE_TTC . "</b></td>" .
// JBH - 05-01-2009 - end
"          </tr>";
 ?>
<?php

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

$products_query = tep_db_query("SELECT p.products_id, p.products_quantity, pd.products_name, pc.categories_id, p.products_price FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " pc WHERE p.products_id = pd.products_id AND p.products_id = pc.products_id AND p.products_status = 0 AND pd.language_id = FLOOR($languages_id) ORDER BY pc.categories_id, pd.products_name");

while($products = tep_db_fetch_array($products_query)) { ?>
  <table border= 1px width="100%" cellpadding="1">
<?php	echo

'          <tr class="dataTableRow">' .
'           <td width="40%" class="dataTableContent">' . (($memory == $products['categories_id'])? '': $cat_info[$products['categories_id']]['link']) . "</td>" .
'           <td class="dataTableContent">' . $products['products_name'] . "</td>" .
'			<td width="5%" class="dataTableContent" align="right"><b>' . $products['products_quantity'] . "</b></td>" .
'			<td width="5%" class="dataTableContent" align="right"><b>' . $products['products_price'] . "</b></td>" .
'			<td width="5%" class="dataTableContent" align="right"><b>' . $products['products_price']*$products['products_quantity'] . "</b></td>" .
'			<td width="5%" class="dataTableContent" align="right"><b>' . round($products['products_price']*$products['products_quantity']*1.196,2) . "</b></td>" .
"          </tr>";
 ?>
</table> 
<?php
  $memory = $products['categories_id'];
  }
?>
         </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
    </table></td>
  </tr>
</table>
<!-- body_eof //-->
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>