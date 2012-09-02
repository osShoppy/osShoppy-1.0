<?php //$Id: /catalog/admin/categories_tpl.php (part_2) (osS) ?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<script language="javascript" src="includes/general.js"></script>
<!-- bof: qpbpp for sppc /step-7(23)\ - Javascript for Tabs //-->
<script src="includes/javascript/jquery-1.2.6.js" type="text/javascript"></script>
<script src="includes/javascript/ui.core.js" type="text/javascript"></script>
<script src="includes/javascript/ui.tabs.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
/* tabs for languages */
    $("#langtabs > ul").tabs();
/* tabs for customer groups */
    $("#qpbpp > ul").tabs();
  });
  </script>
<!-- eof: qpbpp for sppc /step-7(23)\ - Javascript for Tabs //-->
<script language="javascript" src="includes/javascript/additional_images.js"></script>
<?php
// bof: header tags seo /Step-8(18)\
switch (HEADER_TAGS_ENABLE_HTML_EDITOR)
{
   case 'CKEditor':
     echo '<script type="text/javascript" src="./ckeditor/ckeditor.js"></script>';
   break;

   case 'FCKEditor':
   break;

   case 'TinyMCE':
     if (HEADER_TAGS_ENABLE_HTML_EDITOR != 'No Editor' && (HEADER_TAGS_ENABLE_EDITOR_META_DESC == 'true' || HEADER_TAGS_ENABLE_EDITOR_CATEGORIES == 'true' || HEADER_TAGS_ENABLE_EDITOR_PRODUCTS == 'true'))
     {
       if ($action == 'new_product' || $action == 'new_category' || $action == 'edit_category') { // No need to put JS on all pages.
         $languages = tep_get_languages(); // Get all languages
       // Build list of textareas to convert
         $str = '';
         for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
           if (HEADER_TAGS_ENABLE_EDITOR_META_DESC  == 'true') $str .= "products_head_desc_tag[".$languages[$i]['id']."],";
           if (HEADER_TAGS_ENABLE_EDITOR_CATEGORIES == 'true') $str .= "categories_htc_description[".$languages[$i]['id']."],";
           if (HEADER_TAGS_ENABLE_EDITOR_PRODUCTS == 'true') $str .= "products_description[".$languages[$i]['id']."],";
         }  //end for each language
         $mce_str = rtrim ($str,","); // Removed the last comma from the string.
       // You can add more textareas to convert in the $str, be careful that they are all separated by a comma.
         echo '<script language="javascript" type="text/javascript" src="includes/javascript/tiny_mce/tiny_mce.js"></script>';
         include "includes/javascript/tiny_mce/general.php";
       }
     }
   break;

   default: break;
}
// eof: header tags seo /Step-8(18)\
?>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="SetFocus();">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="100%" valign="top">
<?php
  if ($action == 'new_product') {
    $parameters = array('products_name' => '',
                       'products_description' => '',
// Product Tabs 2.0 Start-10
                       'products_spec' => '',
                       'products_musthave' => '',
                       'products_extraimage' => '',
                       'products_manual' => '',
                       'products_extra1' => '',
                       'products_moreinfo' => '',
// Product Tabs 2.0 End-10
                       'products_url' => '',
                       'products_id' => '',
                       /*** Begin Quotes ***/
                       'quotes_email_address' => (isset($_GET['quote_email_address']) ? $_GET['quote_email_address'] : ''),
                       'quotes_status' => '',
                       'quotes_expire' => '',
                       'quotes_id' => (isset($_GET['quote_id']) ? $_GET['quote_id'] : ''),
                       /*** End Quotes ***/
                       'products_quantity' => '',
                       'products_model' => '',
                       'products_image' => '',
// Product Tabs 2.0 Start-10
// bof: Additional Images
                       'products_image_med' => '',
                       'products_image_pop' => '',
                       'products_image_description' => '',
// eof: Additional Images
                       'products_image_lrg' => '',
                       'products_image_sm_1' => '',
                       'products_image_xl_1' => '',
                       'products_image_sm_2' => '',
                       'products_image_xl_2' => '',
                       'products_image_sm_3' => '',
                       'products_image_xl_3' => '',
                       'products_image_sm_4' => '',
                       'products_image_xl_4' => '',
                       'products_image_sm_5' => '',
                       'products_image_xl_5' => '',
                       'products_image_sm_6' => '',
                       'products_image_xl_6' => '',
// Product Tabs 2.0 End-10
                       'products_price' => '',
// bof: qpbpp for sppc /step-8(23)\
                       'products_qty_blocks' => '',
                       'products_min_order_qty' => '',
// eof: qpbpp for sppc /step-8(23)\
                       'products_weight' => '',
                       'products_date_added' => '',
                       'products_last_modified' => '',
                       'products_date_available' => '',
                       'products_status' => '',
                       'products_tax_class_id' => '',
                       'manufacturers_id' => '',
					   'products_to_rss' => '',
					   'products_carrot' => '',
// bof: tntpost-f /step-4(9)\
		               'tnt_f_tr' => '',                       
		               'tnt_f_sb' => '',                       
		               'tnt_f_cs' => '');
// eof: tntpost-f /step-4(9)\

    $pInfo = new objectInfo($parameters);

// attribute on categories page 
// original ->    if (isset($HTTP_GET_VARS['pID']) && empty($HTTP_POST_VARS)) {
    			  if (isset($HTTP_GET_VARS['pID']) && empty($HTTP_POST_VARS) || $HTTP_GET_VARS['action_att']) {

// beof: header tags seo /Step-9(18)\ added:
// beof: tntpost-f /step-5(9)\ added: 
// Product Tabs 2.0 added queries Start-11 added queries
// beof: qpbpp for sppc /step-9(23)\ added: , p.products_qty_blocks, p.products_min_order_qty
      $product_query = tep_db_query("select pd.products_name, pd.products_description, pd.products_spec, pd.products_musthave, pd.products_extraimage, pd.products_manual, pd.products_extra1, pd.products_moreinfo, pd.products_head_title_tag, pd.products_head_desc_tag, pd.products_head_keywords_tag, pd.products_url, p.products_id, p.products_quantity, p.products_model, p.products_image, p.products_image_med, p.products_image_pop, p.products_image_description, p.products_image_lrg, p.products_image_sm_1, p.products_image_xl_1, p.products_image_sm_2, p.products_image_xl_2, p.products_image_sm_3, p.products_image_xl_3, p.products_image_sm_4, p.products_image_xl_4, p.products_image_sm_5, p.products_image_xl_5, p.products_image_sm_6, p.products_image_xl_6, p.products_price, p.products_qty_blocks, p.products_min_order_qty, p.products_weight, p.products_date_added, p.products_last_modified, date_format(p.products_date_available, '%Y-%m-%d') as products_date_available, p.products_status, p.products_tax_class_id, p.manufacturers_id, p.quotes_email_address, p.quotes_status, p.quotes_expire, p.quotes_id, p.tnt_f_tr, p.tnt_f_sb, p.tnt_f_cs, p.products_to_rss, p.products_carrot from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . (int)$HTTP_GET_VARS['pID'] . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");
      $product = tep_db_fetch_array($product_query);

      $pInfo->objectInfo($product);
	  
// bof: qpbpp for sppc /step-10(23)\
// move retail settings for quantity blocks and min order qty to an array indexed
// by customer_group_id, as we will get back in $_POST values
      unset($pInfo->products_qty_blocks);
      $pInfo->products_qty_blocks[0] = $product['products_qty_blocks'];
      unset($pInfo->products_min_order_qty);
      $pInfo->products_min_order_qty[0] = $product['products_min_order_qty'];
// next is getting the group prices, products_qty_blocks, and products_min_order_qty for groups
      $cg_prices_query = tep_db_query("select customers_group_id, customers_group_price, products_qty_blocks, products_min_order_qty from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . $pInfo->products_id . "' order by customers_group_id");
      while ($cg_prices = tep_db_fetch_array($cg_prices_query)) {
// and adding them to $pInfo for later use
        if (tep_not_null($cg_prices['customers_group_price'])) {
        $pInfo->sppcprice[$cg_prices['customers_group_id']] = $cg_prices['customers_group_price'];
        }
        $pInfo->products_qty_blocks[$cg_prices['customers_group_id']] = $cg_prices['products_qty_blocks'];
        $pInfo->products_min_order_qty[$cg_prices['customers_group_id']] = $cg_prices['products_min_order_qty'];
      } // end while ($cg_prices = tep_db_fetch_array($cg_prices_query))
      
      $price_breaks_array = array();
      $price_breaks_query = tep_db_query("select products_price_break_id, products_price, products_qty, customers_group_id from " . TABLE_PRODUCTS_PRICE_BREAK . " where products_id = '" . tep_db_input($pInfo->products_id) . "' order by customers_group_id, products_qty");
      while ($price_break = tep_db_fetch_array($price_breaks_query)) {
        $pInfo->products_price_break[$price_break['customers_group_id']][] = $price_break['products_price'];
        $pInfo->products_qty[$price_break['customers_group_id']][] = $price_break['products_qty'];
        $pInfo->products_price_break_id[$price_break['customers_group_id']][] = $price_break['products_price_break_id'];
      }
      $product_discount_categories = array();
      $products_discount_query = tep_db_query("select customers_group_id, discount_categories_id from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " where products_id = '" . tep_db_input($pInfo->products_id) . "' order by customers_group_id");
      while ($products_discount_results = tep_db_fetch_array($products_discount_query)) {
        $pInfo->discount_categories_id[$products_discount_results['customers_group_id']] = $products_discount_results['discount_categories_id'];
      }
// eof: qpbpp for sppc /step-10(23)\

    } elseif (tep_not_null($HTTP_POST_VARS)) {
      $pInfo->objectInfo($HTTP_POST_VARS);
      $products_name = $HTTP_POST_VARS['products_name'];
      $products_description = $HTTP_POST_VARS['products_description'];
// Product Tabs Start-12
   	  $products_spec = $HTTP_POST_VARS['products_spec'];
      $products_musthave = $HTTP_POST_VARS['products_musthave'];
      $products_extraimage = $HTTP_POST_VARS['products_extraimage'];
      $products_manual = $HTTP_POST_VARS['products_manual'];
      $products_extra1 = $HTTP_POST_VARS['products_extra1'];
      $products_moreinfo = $HTTP_POST_VARS['products_moreinfo'];
// Product Tabs End-12
      $products_url = $HTTP_POST_VARS['products_url'];
    }

    $manufacturers_array = array(array('id' => '', 'text' => TEXT_NONE));
    $manufacturers_query = tep_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS . " order by manufacturers_name");
    while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
      $manufacturers_array[] = array('id' => $manufacturers['manufacturers_id'],
                                     'text' => $manufacturers['manufacturers_name']);
    }

    $tax_class_array = array(array('id' => '0', 'text' => TEXT_NONE));
    $tax_class_query = tep_db_query("select tax_class_id, tax_class_title from " . TABLE_TAX_CLASS . " order by tax_class_title");
    while ($tax_class = tep_db_fetch_array($tax_class_query)) {
      $tax_class_array[] = array('id' => $tax_class['tax_class_id'],
                                 'text' => $tax_class['tax_class_title']);
    }

// bof: qpbpp for sppc /step-11(23)\
    $discount_categories_array = array(array('id' => '0', 'text' => TEXT_NONE));
    $discount_categories_query = tep_db_query("select discount_categories_id, discount_categories_name from " . TABLE_DISCOUNT_CATEGORIES . " order by discount_categories_name");
    while ($discount_categories = tep_db_fetch_array($discount_categories_query)) {
      $discount_categories_array[] = array('id' => $discount_categories['discount_categories_id'],
                                           'text' => $discount_categories['discount_categories_name']);
    }
// eof: qpbpp for sppc /step-11(23)\

    $languages = tep_get_languages();

    if (!isset($pInfo->products_status)) $pInfo->products_status = '1';
    switch ($pInfo->products_status) {
      case '0': $in_status = false; $out_status = true; break;
      case '1':
      default: $in_status = true; $out_status = false;
    }

    /*** Begin Quotes ***/
    if (!isset($pInfo->quotes_status)) $pInfo->quotes_status = '1';
    switch ($pInfo->quotes_status) {
      case '0': $quote_in_status = false; $quote_out_status = true; break;
      case '1':
      default: $quote_in_status = true; $quote_out_status = false;
    }
    /*** End Quotes ***/

// bof: tntpost-f /step-6(9)\
    if (!isset($pInfo->tnt_f_sb)) $pInfo->tnt_f_sb = '0';
    switch ($pInfo->tnt_f_sb) {
      case '0': $in_status_tnt_f_sb = false; $out_status_tnt_f_sb = true; break;
      case '1':
      default: $in_status_tnt_f_sb = true; $out_status_tnt_f_sb = false;
    }  
      
    if (!isset($pInfo->tnt_f_cs)) $pInfo->tnt_f_cs = '0';
    switch ($pInfo->tnt_f_cs) {
      case '0': $in_status_tnt_f_cs = false; $out_status_tnt_f_cs = true; break;
      case '1':
      default: $in_status_tnt_f_cs = true; $out_status_tnt_f_cs = false;
    }        	
// eof: tntpost-f /step-6(9)\
?>
<!---------------------------->
<!--- JAVASCRIPT ::START:: --->
<!---------------------------->
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
<script language="javascript"><!--
  var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "new_product", "products_date_available","btnDate1","<?php echo $pInfo->products_date_available; ?>",scBTNMODE_CUSTOMBLUE);
  var quoteExpire = new ctlSpiffyCalendarBox("quoteExpire", "new_product", "quotes_expire","btnDate1","<?php echo $pInfo->quotes_expire; ?>",scBTNMODE_CUSTOMBLUE);
//--></script>
<script language="javascript"><!--
var tax_rates = new Array();
<?php
    for ($i=0, $n=sizeof($tax_class_array); $i<$n; $i++) {
      if ($tax_class_array[$i]['id'] > 0) {
        echo 'tax_rates["' . $tax_class_array[$i]['id'] . '"] = ' . tep_get_tax_rate_value($tax_class_array[$i]['id']) . ';' . "\n";
      }
    }
?>

function doRound(x, places) {
  return Math.round(x * Math.pow(10, places)) / Math.pow(10, places);
}

function getTaxRate() {
  var selected_value = document.forms["new_product"].products_tax_class_id.selectedIndex;
  var parameterVal = document.forms["new_product"].products_tax_class_id[selected_value].value;

  if ( (parameterVal > 0) && (tax_rates[parameterVal] > 0) ) {
    return tax_rates[parameterVal];
  } else {
    return 0;
  }
}

function updateGross() {
  var taxRate = getTaxRate();
  var grossValue = document.forms["new_product"].products_price.value;

/* bof: qpbpp for sppc /step-12(23)\ - auto-update Retail readonly price field */
  document.forms["new_product"].products_price_retail_net.value = document.forms["new_product"].products_price.value;
/* eof: qpbpp for sppc /step-12(23)\ - auto-update Retail readonly price field */

  if (taxRate > 0) {
    grossValue = grossValue * ((taxRate / 100) + 1);
  }

  document.forms["new_product"].products_price_gross.value = doRound(grossValue, 4);
}

function updateNet() {
  var taxRate = getTaxRate();
  var netValue = document.forms["new_product"].products_price_gross.value;

  if (taxRate > 0) {
    netValue = netValue / ((taxRate / 100) + 1);
  }

  document.forms["new_product"].products_price.value = doRound(netValue, 4);
/* bof: qpbpp for sppc /step-13(23)\ - auto-update Retail readonly price field */
  document.forms["new_product"].products_price_retail_net.value = document.forms["new_product"].products_price.value;
/* eof: qpbpp for sppc /step-13(23)\ - auto-update Retail readonly price field */

}
//--></script>
<!------------------------------>
<!--- JAVASCRIPT ::END::     --->
<!--- PRODUCT FILL ::START:: --->
<!------------------------------>
<?php // bof: Additional Images: added:  onSubmit="return check_form(new_product);"  ?>
    <?php echo tep_draw_form('new_product', FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($HTTP_GET_VARS['pID']) ? '&pID=' . $HTTP_GET_VARS['pID'] : '') . '&action=new_product_preview', 'post', 'enctype="multipart/form-data" onSubmit="return check_form(this);"') . tep_hide_session_id(); ?>
<?php // eof: Additional Images  ?>
<!-- body_text //-->
    <table border="0" width="90%" cellspacing="0" cellpadding="2" align="center">
<!-- heading_text //-->
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo sprintf(TEXT_NEW_PRODUCT, tep_output_generated_category_path($current_category_id)); ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
        	<td class="main" align="right"><?php echo tep_draw_hidden_field('products_date_added', (tep_not_null($pInfo->products_date_added) ? $pInfo->products_date_added : date('Y-m-d'))) . tep_image_submit('button_preview.png', IMAGE_PREVIEW) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($HTTP_GET_VARS['pID']) ? '&pID=' . $HTTP_GET_VARS['pID'] : '')) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>'; ?></td>
      	  </tr>
        </table></td>
      </tr>
<!-- heading_text_eof //-->
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
<!-- top_values //-->
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_STATUS; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_radio_field('products_status', '1', $in_status) . '&nbsp;' . TEXT_PRODUCT_AVAILABLE . '&nbsp;' . tep_draw_radio_field('products_status', '0', $out_status) . '&nbsp;' . TEXT_PRODUCT_NOT_AVAILABLE; ?></td>
          </tr>
		  <tr>
			<td class="main"><?php echo TEXT_PRODUCTS_CARROT; ?></td>
			<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_checkbox_field('products_carrot', '', $pInfo->products_carrot); ?></td>
		  </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_DATE_AVAILABLE; ?><br><small>(YYYY-MM-DD)</small></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;'; ?><script language="javascript">dateAvailable.writeControl(); dateAvailable.dateFormat="yyyy-MM-dd";</script></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_MANUFACTURER; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_pull_down_menu('manufacturers_id', $manufacturers_array, $pInfo->manufacturers_id); ?></td>
          </tr>
          <?php /*** Begin Quotes ***/ ?>
          <tr>
           <td class="main"><?php echo TEXT_PRODUCTS_QUOTES_EMAIL_ADDRESS; ?></td>
           <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('quotes_email_address', $pInfo->quotes_email_address, '0'); ?></td>
          </tr>
          <tr>
           <td class="main"><?php echo TEXT_PRODUCTS_QUOTES_STATUS; ?></td>
           <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_radio_field('quotes_status', '1', $quote_in_status) . '&nbsp;' . TEXT_QUOTE_STATUS_ACTIVE . '&nbsp;' . tep_draw_radio_field('quotes_status', '0', $quote_out_status) . '&nbsp;' . TEXT_QUOTE_STATUS_INACTIVE; ?></td>
          </tr>
          <tr>
           <td class="main"><?php echo TEXT_PRODUCTS_QUOTES_EXPIRE; ?><br><small>(YYYY-MM-DD)</small></td>
           <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;'; ?><script language="javascript">quoteExpire.writeControl(); quoteExpire.dateFormat="yyyy-MM-dd";</script></td>
          </tr>
          <tr>
           <td class="main"><?php echo TEXT_PRODUCTS_QUOTES_ID; ?></td>
           <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('quotes_id', $pInfo->quotes_id, '0'); ?></td>
          </tr>
          <?php /*** End Quotes ***/ ?>
<?php
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
?>
          <tr>
            <td class="main"><?php if ($i == 0) echo TEXT_PRODUCTS_NAME; ?></td>
            <td class="main"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('products_name[' . $languages[$i]['id'] . ']', (isset($products_name[$languages[$i]['id']]) ? stripslashes($products_name[$languages[$i]['id']]) : tep_get_products_name($pInfo->products_id, $languages[$i]['id']))); ?></td>
          </tr>
<?php
    }
?>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_TAX_CLASS; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_pull_down_menu('products_tax_class_id', $tax_class_array, $pInfo->products_tax_class_id, 'onchange="updateGross()"'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_PRICE_NET; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_price', $pInfo->products_price, 'onKeyUp="updateGross()"'); ?></td>
          </tr>
		  <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_PRICE_GROSS; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_price_gross', $pInfo->products_price, 'OnKeyUp="updateNet()"'); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
        </table></td>
      </tr>
<!-- top_values_eof //-->
<!-- bof: qpbpp for sppc /step-15(23)\ - in tabbed menu -->
<?php
// the query is changed to also get the results for group 0 (retail) so that the
// results of the query can be used for others mods (like hide products, QPBPP for SPPC) too
    $customers_group_query = tep_db_query("select customers_group_id, customers_group_name from " . TABLE_CUSTOMERS_GROUPS . " order by customers_group_id");
    $header = false;
    if (!tep_db_num_rows($customers_group_query) > 0) {
      $messageStack->add_session(ERROR_ALL_CUSTOMER_GROUPS_DELETED, 'error');
   } else {
// to avoid confusion and/or duplication of code we re-use some code originally used
// for the "hide products for customers groups for sppc" mod here so both can co-exist
     while ($customers_group = tep_db_fetch_array($customers_group_query)) {
       $_hide_customers_group[] = $customers_group;
     }
   } ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td colspan="2">
              <div id="qpbpp" class="cgtabs">
                <ul class="tabnav"> <?php
                  foreach ($_hide_customers_group as $key => $cust_groups) {
                    echo '  <li><a href="#pricebreak-' . $cust_groups['customers_group_id'] . '">' . $cust_groups['customers_group_name'] . '</a></li>' ."\n";
                  }
                ?>
                </ul>
<?php
 foreach ($_hide_customers_group as $key => $cust_groups) {
   $CustGroupID = $cust_groups['customers_group_id'];
?>
                  <div id="pricebreak-<?php echo $CustGroupID; ?>" class="tabdiv">
                    <table border="0" width="100%">
                      <tr bgcolor="#ebebff">
                        <td class="main"><?php echo ENTRY_CUSTOMERS_GROUP_NAME ?></td>
                        <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . $cust_groups['customers_group_name']; ?></td>
                      </tr>
                      <tr bgcolor="#fffff">
                        <td class="main" colspan="2"><small><i><?php if ($CustGroupID != 0) echo TEXT_CUSTOMERS_GROUPS_NOTE; ?></i></small></td>
                      </tr>
                      <tr bgcolor="#fffff">
                        <td class="main"><?php echo TEXT_PRODUCTS_PRICE_NET ?></td>
                        <td class="main"><?php
                        if ($CustGroupID != 0) {
                          if (isset($pInfo->sppcoption)) {
                            echo tep_draw_checkbox_field('sppcoption[' . $CustGroupID . ']', 'sppcoption[' . $CustGroupID . ']', (isset($pInfo->sppcoption[$CustGroupID])) ? 1: 0);
                          } else {
                            echo tep_draw_checkbox_field('sppcoption[' . $CustGroupID . ']', 'sppcoption[' . $CustGroupID . ']', true);
                          }
                            if (isset($pInfo->sppcprice[$CustGroupID])) { 
                              $sppc_cg_price = $pInfo->sppcprice[$CustGroupID];
                            } else { // nothing in the db, nothing in the post variables
                              $sppc_cg_price = '';
                            }
                            echo '&nbsp;' . tep_draw_input_field('sppcprice[' . $CustGroupID . ']', $sppc_cg_price );
                        } else {
                          echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_price_retail_net', $pInfo->products_price, 'readonly');
                        } // end if/else ($CustGroupID != 0) ?>
                        </td>
                      </tr>
                      <tr bgcolor="#ebebff">
                        <td class="main"><?php echo TEXT_DISCOUNT_CATEGORY ?></td>
                        <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_pull_down_menu('discount_categories_id[' . $CustGroupID . ']', $discount_categories_array, $pInfo->discount_categories_id[$CustGroupID]) . tep_draw_hidden_field('current_discount_cat_id[' . $CustGroupID . ']', (isset($pInfo->current_discount_cat_id[$CustGroupID]) ? (int)$pInfo->current_discount_cat_id[$CustGroupID] : $pInfo->discount_categories_id[$CustGroupID])); ?></td>
                      </tr>
                      <tr bgcolor="#ffffff">
                        <td class="main"><?php echo TEXT_PRODUCTS_QTY_BLOCKS; ?></td>
                        <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_qty_blocks[' . $CustGroupID . ']', $pInfo->products_qty_blocks[$CustGroupID], 'size="10"') . "&nbsp;" . TEXT_PRODUCTS_QTY_BLOCKS_HELP; ?></td>
                      </tr>
                      <tr bgcolor="#ebebff">
                        <td class="main"><?php echo TEXT_PRODUCTS_MIN_ORDER_QTY; ?></td>
                        <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_min_order_qty[' . $CustGroupID . ']', $pInfo->products_min_order_qty[$CustGroupID], 'size="10"') . "&nbsp;" . TEXT_PRODUCTS_MIN_ORDER_QTY_HELP; ?></td>
                      </tr>
<?php 
    $i = 0; // for alternate coloring of rows (zebra striping)
    for ($count = 0; $count <= (PRICE_BREAK_NOF_LEVELS - 1); $count++) {
      $bgcolor = ($i++ & 1) ? '#ebebff' : '#ffffff'; // for zebra striping
?>
                      <tr bgcolor="<?php echo $bgcolor; ?>">
                        <td class="main"><?php echo "<b>" . ($count + 1)  . "</b> " . TEXT_PRODUCTS_PRICE; ?></td>
                        <td class="main" align="left"> <?php
                            if(is_array($pInfo->products_price_break[$CustGroupID]) && array_key_exists($count, $pInfo->products_price_break[$CustGroupID])) {
                              echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_price_break[' . $CustGroupID .'][' . $count . ']', $pInfo->products_price_break[$CustGroupID][$count], 'size="10"');
                              echo tep_draw_separator('pixel_trans.gif', '24', '15') . TEXT_PRODUCTS_QTY;
                              echo tep_draw_separator('pixel_trans.gif', '24', '15') . tep_draw_input_field('products_qty[' . $CustGroupID .'][' . $count . ']', $pInfo->products_qty[$CustGroupID][$count], 'size="10"');
                              echo tep_draw_hidden_field('products_price_break_id[' . $CustGroupID .'][' . $count . ']', $pInfo->products_price_break_id[$CustGroupID][$count]);
// only show a delete box for a price break that has been set (needed for when the
// back button is used after a preview
                              if (isset($pInfo->products_price_break_id[$CustGroupID][$count]) && tep_not_null($pInfo->products_price_break_id[$CustGroupID][$count])) {
                                echo tep_draw_separator('pixel_trans.gif', '24', '15') . tep_draw_checkbox_field('products_delete[' . $CustGroupID .'][' . $count . ']', 'y', (isset($pInfo->products_delete[$CustGroupID][$count]) ? 1 : 0)) . TEXT_PRODUCTS_DELETE;
                              }
                            } else {
                              echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_price_break[' . $CustGroupID .'][' . $count . ']', '', 'size="10"');
                              echo tep_draw_separator('pixel_trans.gif', '24', '15') . TEXT_PRODUCTS_QTY;
                              echo tep_draw_separator('pixel_trans.gif', '24', '15') . tep_draw_input_field('products_qty[' . $CustGroupID .'][' . $count . ']', '', 'size="10"');
                            } ?>
                        </td>
                      </tr>
<?php
   } // end for ($count = 0; $count <= (PRICE_BREAK_NOF_LEVELS - 1); $count++)
?>
                    </table>
                  </div>
<?php
 } // end foreach ($_hide_customers_group as $key => $cust_groups)
?>
              </div>
            </td>
        </table></td>
      </tr>
<!-- eof: qpbpp for sppc /step-15(23)\ - in tabbed menu -->
      <tr>
        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
<script language="javascript"><!--
updateGross();
//--></script>
<!-- product_text //-->
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2" align="center">
          <tr>
            <td colspan="2">
              <div id="langtabs" class="cgtabs">
                <ul class="tabnav"> <?php
                  for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
                    echo '  <li><a href="#lang-' . $i . '">' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . ' ' . $languages[$i]['name'] . '</a></li>' ."\n";
                  } ?>
                </ul>
                <?php
                  for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
                ?>
                <div id="lang-<?php echo $i ; ?>" class="tabdiv">
				  <table>
             		<td class="main" valign="top">
					<?php require(DIR_WS_MODULES ."product_tabs.php"); ?>
                  </table>
                </div>
                <?php
                  } // end for ($i=0, $n=sizeof($languages); $i<$n; $i++)
                ?>
              </div>
            </td>
        </table></td>
      </tr>
<!-- product_text_eof //-->
      <tr>
        <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
<!-- mid_values //-->
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_QUANTITY; ?></td>
             <?php //++++ QT Pro: Begin Changed code
			if($product_investigation['has_tracked_options'] or $product_investigation['stock_entries_count'] > 0)
			{
		  	?>
			<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . ' <a href="' . tep_href_link("stock.php", 'product_id=' . $pInfo->products_id) . ' ">' . tep_image_button('button_stock.png', IMAGE_STOCK) . '</a>' . TEXT_PRODUCTS_QUANTITY_ATTRIB ?></td>
			<?php 
			
			}else{
			?>
			<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . ' ' . tep_draw_input_field('products_quantity', $pInfo->products_quantity); ?></td>
			<?php 
			}
			//++++ QT Pro: End Changed code
		  	?>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_MODEL; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_model', $pInfo->products_model); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
        </table></td>
      </tr>
<!-- mid_values_eof //-->
<!-- images //-->
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
          <?php // bof: Additional Images  ?>
            <td class="dataTableRow"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
            <td class="dataTableRow"><table border="0" cellpadding="0" cellspacing="0" width="560"><tr><td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15'); ?></td><td class="main"><?php 

            if (ADDITIONAL_IMAGES_AUTO_CREATE == 'true') {  
              echo TEXT_NEW_IMAGES_AUTO_ON_STATEMENT;      
            } else {
              echo '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="main" valign="top">' . tep_draw_input_field('manual_thumb_generation', 'on', /* parameters */ 'onclick="if(this.checked==true){this.form.products_image_med.disabled=true;this.form.products_image_pop.disabled=true;}else{this.form.products_image_med.disabled=false;this.form.products_image_pop.disabled=false;}"', false, 'checkbox') . '</td><td class="smallText" valign="top">' . TEXT_NEW_IMAGES_MANUALLY_GENERATE . '</td><td class="main">&nbsp;</td><td class="smallText" valign="top">' . TEXT_NEW_IMAGES_AUTO_OFF_STATEMENT . '</td></tr></table>';
            }

            $upload_path = '';
            if (ADDIMAGES_PREFILL_UPLOAD_DIRECTORY == 'true') {
              $category_path_pieces_tmp = explode('&nbsp;&gt;&nbsp;',tep_output_generated_category_path($current_category_id));
              $category_path_pieces = array();
			  for ($i=sizeof($category_path_pieces_tmp)-1; $i >= 0; $i--) {
			    $category_path_pieces[] = tep_catname_to_dir($category_path_pieces_tmp[$i]);
			  }
              $upload_path = implode('/',$category_path_pieces);
            }
            $tmp = ADDIMAGES_PREFILL_INITIAL;
            if (!empty($tmp)) {
              if (!empty($upload_path)) { $upload_path = trim($tmp,'/').'/'.$upload_path; }
              else { $upload_path = $tmp; }
            }

            ?></td></tr></table></td>
          </tr>
          <tr>
            <td class="dataTableRow" valign="top"><span class="main"><?php echo TEXT_PRODUCTS_IMAGE_UPLOAD_LOCATION; ?></span></td>
            <td class="dataTableRow"><span class="smallText"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('image_subdirectory', $upload_path, 'size="40" onBlur="this.form.image_subdirectory_text.value=this.value" onMouseUp="this.form.image_subdirectory_text.value=this.value" onKeyUp="this.form.image_subdirectory_text.value=this.value"') . '<br>' . tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;<span style="font-size:9px;">' . TEXT_PRODUCTS_IMAGE_UPLOAD_LOCATION_NOTE . '&nbsp;' . DIR_FS_CATALOG_IMAGES . '</span>' . tep_draw_input_field('image_subdirectory_text', $upload_path, 'style="background-color:#ebebff;border-style:none;font-size:9px;" size="50" id="image_subdirectory_text"'); ?></span></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></span></td>
          </tr>
          <tr>
            <td class="dataTableRow" valign="top"><span class="main"><?php echo TEXT_PRODUCTS_IMAGE; ?></span></td>
            <td class="dataTableRow"><span class="smallText"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_file_field('products_image') . '<br>' . tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . $pInfo->products_image . tep_draw_hidden_field('products_previous_image', $pInfo->products_image); ?><?php  if (!empty($pInfo->products_image)) { echo tep_draw_separator('pixel_trans.gif', '24', '15') . tep_draw_checkbox_field('delete_image_def', 'yes', false) . TEXT_DELETE_IMAGE; } ?></span></td>
          </tr>
          <tr>
            <td class="dataTableRow" valign="top"><span class="main"><?php echo TEXT_PRODUCTS_IMAGE_MED; ?></span></td>
            <td class="dataTableRow"><span class="smallText"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_file_field('products_image_med') . '<br>' . tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . $pInfo->products_image_med . tep_draw_hidden_field('products_previous_image_med', $pInfo->products_image_med); ?><?php if (!empty($pInfo->products_image_med)) { echo tep_draw_separator('pixel_trans.gif', '24', '15') . tep_draw_checkbox_field('delete_image_med', 'yes', false) . TEXT_DELETE_IMAGE; } ?></span></td>
          </tr>
          <tr>
            <td class="dataTableRow" valign="top"><span class="main"><?php echo TEXT_PRODUCTS_IMAGE_POP; ?></span></td>
            <td class="dataTableRow"><span class="smallText"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_file_field('products_image_pop') . '<br>' . tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . $pInfo->products_image_pop . tep_draw_hidden_field('products_previous_image_pop', $pInfo->products_image_pop); ?><?php if (!empty($pInfo->products_image_pop)) { echo tep_draw_separator('pixel_trans.gif', '24', '15') . tep_draw_checkbox_field('delete_image_pop', 'yes', false) . TEXT_DELETE_IMAGE; } ?></span></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '3'); ?></td>
          </tr>
          <tr>
            <td class="dataTableRow" valign="top"><span class="main"><?php echo TEXT_PRODUCTS_IMAGES_DESC; ?></span></td>
            <td class="dataTableRow"><span class="smallText"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_image_description', $pInfo->products_image_description, 'size="30"') . '&nbsp;' . TEXT_IMAGE_DESCRIPTION_NOTE; ?></span></td>
          </tr>
          <?php echo ((ADDITIONAL_IMAGES_AUTO_CREATE == 'true')?'<script type="text/javascript"> document.new_product.products_image_med.disabled=true; document.new_product.products_image_pop.disabled=true; </script>':''); ?>
          <?php // eof: Additional Images  ?>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
<?php
            $image_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image='" . $pInfo->products_image_lrg . "' or products_image_med='" . $pInfo->products_image_lrg . "' or products_image_lrg='" . $pInfo->products_image_lrg . "'");
            $image_count = tep_db_fetch_array($image_count_query);
?>
          <tr>
           <td class="dataTableRow" valign="top"><span class="main"><?php echo TEXT_PRODUCTS_IMAGE_NOTE; ?></span></td>
           <td class="dataTableRow" valign="top"><span class="smallText"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_file_field('products_image') . '<br>';
           if (($HTTP_GET_VARS['pID']) && ($pInfo->products_image) != '')
               echo tep_draw_separator('pixel_trans.gif', '24', '17" align="left') . tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->products_image, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="left" hspace="0" vspace="5"') .
                    tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;&nbsp;<small>' . TEXT_PRODUCTS_IMAGE_LINKED . ' [' . $image_count['total'] . ']<br>' .
                    tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="unlink_image" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE . '<br>' .
                    tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="delete_image" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE . '<br>' .
                    tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;&nbsp;<b>' . TEXT_PRODUCTS_IMAGE . '</b> ' . $pInfo->products_image . tep_draw_hidden_field('products_previous_image', $pInfo->products_image);?></span></td>
          </tr>

<?php
            $image_med_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image='" . $pInfo->products_image_lrg . "' or products_image_med='" . $pInfo->products_image_lrg . "' or products_image_lrg='" . $pInfo->products_image_lrg . "'");
            $image_med_count = tep_db_fetch_array($image_med_count_query);
?>
          <tr>
           <td class="main" valign="top"><?php echo TEXT_PRODUCTS_IMAGE_MEDIUM; ?></td>
           <td class="main" valign="top"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_file_field('products_image_med') . '<br>';
           if (($HTTP_GET_VARS['pID']) && ($pInfo->products_image_med) != '')
               echo tep_draw_separator('pixel_trans.gif', '24', '17" align="left') . tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->products_image_med, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="left" hspace="0" vspace="5"') .
                    tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;&nbsp;<small>' . TEXT_PRODUCTS_IMAGE_LINKED . ' [' . $image_med_count['total'] . ']<br>' .
                    tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="unlink_image_med" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE . '<br>' .
                    tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="delete_image_med" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE . '<br>' .
                    tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;&nbsp;<b>' . TEXT_PRODUCTS_IMAGE . '</b> ' . $pInfo->products_image_med . tep_draw_hidden_field('products_previous_image_med', $pInfo->products_image_med);?></td>
          </tr>
<?php
            $image_lrg_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image='" . $pInfo->products_image_lrg . "' or products_image_med='" . $pInfo->products_image_lrg . "' or products_image_lrg='" . $pInfo->products_image_lrg . "'");
            $image_lrg_count = tep_db_fetch_array($image_lrg_count_query);
?>
          <tr>
           <td class="dataTableRow" valign="top"><span class="main"><?php echo TEXT_PRODUCTS_IMAGE_LARGE; ?></span></td>
           <td class="dataTableRow" valign="top"><span class="smallText"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_file_field('products_image_lrg') . '<br>';
           if (($HTTP_GET_VARS['pID']) && ($pInfo->products_image_lrg) != '')
               echo tep_draw_separator('pixel_trans.gif', '24', '17" align="left') . tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->products_image_lrg, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="left" hspace="0" vspace="5"') .
                    tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;&nbsp;<small>' . TEXT_PRODUCTS_IMAGE_LINKED . ' [' . $image_lrg_count['total'] . ']<br>' .
                    tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="unlink_image_lrg" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE . '<br>' .
                    tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="delete_image_lrg" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE . '<br>' .
                    tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;&nbsp;<b>' . TEXT_PRODUCTS_IMAGE . '</b> ' . $pInfo->products_image_lrg . tep_draw_hidden_field('products_previous_image_lrg', $pInfo->products_image_lrg);?></span></td>
          </tr>
        </table></td>
      </tr>
<!-- images_eof //-->
      <tr>
         <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '20'); ?></td>
      </tr>
<!-- add_images //-->
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
<!--Product Tabs 2.0 Start-14-->
<?php if (ULTIMATE_ADDITIONAL_IMAGES == 'enable') { ?>
         <tr>
            <td class="main" colspan="0" align="center"><?php echo TEXT_PRODUCTS_IMAGE_ADDITIONAL . '<br><br>';?></td>
          </tr>
          <tr>
            <td class="smalltext" colspan="3"><table border="0" cellpadding="2" cellspacing="0" width="100%">
              <tr>
                <td class="smalltext" colspan="2" valign="top"><?php echo TEXT_PRODUCTS_IMAGE_TH_NOTICE; ?></td>
                <td class="smalltext" colspan="2" valign="top"><?php echo TEXT_PRODUCTS_IMAGE_XL_NOTICE; ?></td>
              </tr>
             
              <tr>
                <td class="dataTableRow" valign="top"><span class="smallText"><?php echo TEXT_PRODUCTS_IMAGE_SM_1; ?></span></td>
                <td class="dataTableRow" valign="top"><span class="smallText"><?php echo tep_draw_file_field('products_image_sm_1') . tep_draw_hidden_field('products_previous_image_sm_1', $pInfo->products_image_sm_1); ?></span></td>
                <td class="dataTableRow" valign="top"><span class="smallText"><?php echo TEXT_PRODUCTS_IMAGE_XL_1; ?></span></td>
                <td class="dataTableRow" valign="top"><span class="smallText"><?php echo tep_draw_file_field('products_image_xl_1') . tep_draw_hidden_field('products_previous_image_xl_1', $pInfo->products_image_xl_1); ?></span></td>
              </tr>
  <?php
      if (($HTTP_GET_VARS['pID']) && ($pInfo->products_image_sm_1) != '' or ($pInfo->products_image_xl_1) != '') {
    ?>
              <tr>
                <td class="dataTableRow" colspan="2" valign="top"><?php if (tep_not_null($pInfo->products_image_sm_1)) { ?><span class="smallText"><?php echo $pInfo->products_image_sm_1 . '<br>' . tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->products_image_sm_1, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="left" hspace="0" vspace="5"') . '<br>'. tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="unlink_image_sm_1" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="delete_image_sm_1" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '1', '5'); ?></span><?php } ?></td>
                <td class="dataTableRow" colspan="2" valign="top"><?php if (tep_not_null($pInfo->products_image_xl_1)) { ?><span class="smallText"><?php echo $pInfo->products_image_xl_1 . '<br>' . tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->products_image_xl_1, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="left" hspace="0" vspace="5"') . '<br>'. tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="unlink_image_xl_1" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="delete_image_xl_1" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '1', '5'); ?></span><?php } ?></td>
              </tr>
  <?php
     }
   ?>
              <tr>
                <td class="smallText" valign="top"><?php echo TEXT_PRODUCTS_IMAGE_SM_2; ?></td>
                <td class="smallText" valign="top"><?php echo tep_draw_file_field('products_image_sm_2') . tep_draw_hidden_field('products_previous_image_sm_2', $pInfo->products_image_sm_2); ?></td>
                <td class="smallText" valign="top"><?php echo TEXT_PRODUCTS_IMAGE_XL_2; ?></td>
                <td class="smallText" valign="top"><?php echo tep_draw_file_field('products_image_xl_2') . tep_draw_hidden_field('products_previous_image_xl_2', $pInfo->products_image_xl_2); ?></td>
             </tr>
  <?php
      if (($HTTP_GET_VARS['pID']) && ($pInfo->products_image_sm_2) != '' or ($pInfo->products_image_xl_2) != '') {
    ?>
              <tr>
                <td class="smallText" valign="top" colspan="2"><?php if (tep_not_null($pInfo->products_image_sm_2)) { ?><?php echo $pInfo->products_image_sm_2 . '<br>' . tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->products_image_sm_2, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="left" hspace="0" vspace="5"') . '<br>'. tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="unlink_image_sm_2" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="delete_image_sm_2" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '1', '5'); ?><?php } ?></td>
                <td class="smallText" valign="top" colspan="2"><?php if (tep_not_null($pInfo->products_image_xl_2)) { ?><?php echo $pInfo->products_image_xl_2 . '<br>' . tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->products_image_xl_2, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="left" hspace="0" vspace="5"') . '<br>'. tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="unlink_image_xl_2" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="delete_image_xl_2" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '1', '5'); ?><?php } ?></td>
              </tr>
  <?php
     }
   ?>
              <tr>
                <td class="dataTableRow" valign="top"><span class="smallText"><?php echo TEXT_PRODUCTS_IMAGE_SM_3; ?></span></td>
                <td class="dataTableRow" valign="top"><span class="smallText"><?php echo tep_draw_file_field('products_image_sm_3') . tep_draw_hidden_field('products_previous_image_sm_3', $pInfo->products_image_sm_3); ?></span></td>
                <td class="dataTableRow" valign="top"><span class="smallText"><?php echo TEXT_PRODUCTS_IMAGE_XL_3; ?></span></td>
                <td class="dataTableRow" valign="top"><span class="smallText"><?php echo tep_draw_file_field('products_image_xl_3') . tep_draw_hidden_field('products_previous_image_xl_3', $pInfo->products_image_xl_3); ?></span></td>
              </tr>
  <?php
      if (($HTTP_GET_VARS['pID']) && ($pInfo->products_image_sm_3) != '' or ($pInfo->products_image_xl_3) != '') {
    ?>
              <tr>
                <td class="dataTableRow" colspan="2" valign="top"><?php if (tep_not_null($pInfo->products_image_sm_3)) { ?><span class="smallText"><?php echo $pInfo->products_image_sm_3 . '<br>' . tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->products_image_sm_3, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="left" hspace="0" vspace="5"') . '<br>'. tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="unlink_image_sm_3" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="delete_image_sm_3" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '1', '5'); ?></span><?php } ?></td>
                <td class="dataTableRow" colspan="2" valign="top"><?php if (tep_not_null($pInfo->products_image_xl_3)) { ?><span class="smallText"><?php echo $pInfo->products_image_xl_3 . '<br>' . tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->products_image_xl_3, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="left" hspace="0" vspace="5"') . '<br>'. tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="unlink_image_xl_3" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="delete_image_xl_3" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '1', '5'); ?></span><?php } ?></td>
              </tr>
  <?php
     }
   ?>

              <tr>
                <td class="smallText" valign="top"><?php echo TEXT_PRODUCTS_IMAGE_SM_4; ?></td>
                <td class="smallText" valign="top"><?php echo tep_draw_file_field('products_image_sm_4') . tep_draw_hidden_field('products_previous_image_sm_4', $pInfo->products_image_sm_4); ?></td>
                <td class="smallText" valign="top"><?php echo TEXT_PRODUCTS_IMAGE_XL_4; ?></td>
                <td class="smallText" valign="top"><?php echo tep_draw_file_field('products_image_xl_4') . tep_draw_hidden_field('products_previous_image_xl_4', $pInfo->products_image_xl_4); ?></td>
             </tr>
  <?php
      if (($HTTP_GET_VARS['pID']) && ($pInfo->products_image_sm_4) != '' or ($pInfo->products_image_xl_4) != '') {
    ?>
              <tr>
                <td class="smallText" valign="top" colspan="2"><?php if (tep_not_null($pInfo->products_image_sm_4)) { ?><?php echo $pInfo->products_image_sm_4 . '<br>' . tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->products_image_sm_4, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="left" hspace="0" vspace="5"') . '<br>'. tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="unlink_image_sm_4" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="delete_image_sm_4" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '1', '5'); ?><?php } ?></td>
                <td class="smallText" valign="top" colspan="2"><?php if (tep_not_null($pInfo->products_image_xl_4)) { ?><?php echo $pInfo->products_image_xl_4 . '<br>' . tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->products_image_xl_4, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="left" hspace="0" vspace="5"') . '<br>'. tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="unlink_image_xl_4" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="delete_image_xl_4" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '1', '5'); ?><?php } ?></td>
              </tr>
  <?php
     }
   ?>


              <tr>
                <td class="dataTableRow" valign="top"><span class="smallText"><?php echo TEXT_PRODUCTS_IMAGE_SM_5; ?></span></td>
                <td class="dataTableRow" valign="top"><span class="smallText"><?php echo tep_draw_file_field('products_image_sm_5') . tep_draw_hidden_field('products_previous_image_sm_5', $pInfo->products_image_sm_5); ?></span></td>
                <td class="dataTableRow" valign="top"><span class="smallText"><?php echo TEXT_PRODUCTS_IMAGE_XL_5; ?></span></td>
                <td class="dataTableRow" valign="top"><span class="smallText"><?php echo tep_draw_file_field('products_image_xl_5') . tep_draw_hidden_field('products_previous_image_xl_5', $pInfo->products_image_xl_5); ?></span></td>
              </tr>
  <?php
      if (($HTTP_GET_VARS['pID']) && ($pInfo->products_image_sm_5) != '' or ($pInfo->products_image_xl_5) != '') {
    ?>
              <tr>
                <td class="dataTableRow" colspan="2" valign="top"><?php if (tep_not_null($pInfo->products_image_sm_5)) { ?><span class="smallText"><?php echo $pInfo->products_image_sm_5 . '<br>' . tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->products_image_sm_5, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="left" hspace="0" vspace="5"') . '<br>'. tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="unlink_image_sm_5" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="delete_image_sm_5" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '1', '5'); ?></span><?php } ?></td>
                <td class="dataTableRow" colspan="2" valign="top"><?php if (tep_not_null($pInfo->products_image_xl_5)) { ?><span class="smallText"><?php echo $pInfo->products_image_xl_5 . '<br>' . tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->products_image_xl_5, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="left" hspace="0" vspace="5"') . '<br>'. tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="unlink_image_xl_5" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="delete_image_xl_5" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '1', '5'); ?></span><?php } ?></td>
              </tr>
  <?php
     }
   ?>
              <tr>
                <td class="smallText" valign="top"><?php echo TEXT_PRODUCTS_IMAGE_SM_6; ?></td>
                <td class="smalltext" valign="top"><?php echo tep_draw_file_field('products_image_sm_6') . tep_draw_hidden_field('products_previous_image_sm_6', $pInfo->products_image_sm_6); ?></td>
                <td class="smallText" valign="top"><?php echo TEXT_PRODUCTS_IMAGE_XL_6; ?></td>
                <td class="smalltext" valign="top"><?php echo tep_draw_file_field('products_image_xl_6') . tep_draw_hidden_field('products_previous_image_xl_6', $pInfo->products_image_xl_6); ?></td>
             </tr>
  <?php
      if (($HTTP_GET_VARS['pID']) && ($pInfo->products_image_sm_6) != '' or ($pInfo->products_image_xl_6) != '') {
    ?>
              <tr>
                <td class="smallText" valign="top" colspan="2"><?php if (tep_not_null($pInfo->products_image_sm_6)) { ?><?php echo $pInfo->products_image_sm_6 . '<br>' . tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->products_image_sm_6, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="left" hspace="0" vspace="5"') . '<br>'. tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="unlink_image_sm_6" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="delete_image_sm_6" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '1', '5'); ?><?php } ?></td>
                <td class="smallText" valign="top" colspan="2"><?php if (tep_not_null($pInfo->products_image_xl_6)) { ?><?php echo $pInfo->products_image_xl_6 . '<br>' . tep_image(DIR_WS_CATALOG_IMAGES . $pInfo->products_image_xl_6, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="left" hspace="0" vspace="5"') . '<br>'. tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="unlink_image_xl_6" value="yes">' . TEXT_PRODUCTS_IMAGE_REMOVE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '5', '15') . '&nbsp;<input type="checkbox" name="delete_image_xl_6" value="yes">' . TEXT_PRODUCTS_IMAGE_DELETE_SHORT . '<br>' . tep_draw_separator('pixel_trans.gif', '1', '5'); ?><?php } ?></td>
              </tr>
  <?php
     }
   ?>
            </table></td>
          </tr>
<?php
}
?>
<!--Product Tabs 2.0 End-14-->
        </table></td>
      </tr>
<!-- add_images_eof //-->
<!-- bot_values //-->
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
      	   <tr>
             <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
           </tr>
<?php
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
?>
          <tr>
            <td class="main"><?php if ($i == 0) echo TEXT_PRODUCTS_URL . '<br><small>' . TEXT_PRODUCTS_URL_WITHOUT_HTTP . '</small>'; ?></td>
            <td class="main"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('products_url[' . $languages[$i]['id'] . ']', (isset($products_url[$languages[$i]['id']]) ? stripslashes($products_url[$languages[$i]['id']]) : tep_get_products_url($pInfo->products_id, $languages[$i]['id']))); ?></td>
          </tr>
<?php
    }
?>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_WEIGHT; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_weight', $pInfo->products_weight); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_RSS; ?></td>
	    	<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . tep_draw_checkbox_field('products_to_rss', '1', $pInfo->products_to_rss); ?></td>
          </tr>
<!-- // bof: tntpost-f /step-7(9)\--> 
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_TNT_F_TR; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('tnt_f_tr', $pInfo->tnt_f_tr); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_TNT_F_SB; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_radio_field('tnt_f_sb', '1', $in_status_tnt_f_sb) . '&nbsp;' . TEXT_TNT_F_YES . '&nbsp;' . tep_draw_radio_field('tnt_f_sb', '0', $out_status_tnt_f_sb) . '&nbsp;' . TEXT_TNT_F_NO; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_TNT_F_CS; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_radio_field('tnt_f_cs', '1', $in_status_tnt_f_cs) . '&nbsp;' . TEXT_TNT_F_YES . '&nbsp;' . tep_draw_radio_field('tnt_f_cs', '0', $out_status_tnt_f_cs) . '&nbsp;' . TEXT_TNT_F_NO; ?></td>
          </tr>           
<!-- // eof: tntpost-f /step-7(9)\--> 
        </table></td>
      </tr>
<!-- bot_values_eof //-->
<!-- body_text_eof //-->
<!-- button //-->
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
        	<td class="main" align="right"><?php echo tep_draw_hidden_field('products_date_added', (tep_not_null($pInfo->products_date_added) ? $pInfo->products_date_added : date('Y-m-d'))) . tep_image_submit('button_preview.png', IMAGE_PREVIEW) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($HTTP_GET_VARS['pID']) ? '&pID=' . $HTTP_GET_VARS['pID'] : '')) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>'; ?></td>
      	  </tr>
        </table></td>
      </tr></form>
<!-- button_eof //-->
<!-- products_attributes //-->  
<?php
  #PR Save or update section for products attributes
  if ($HTTP_GET_VARS['action_att']) {
    $page_info = 'option_page=' . $HTTP_GET_VARS['option_page'] . '&value_page=' . $HTTP_GET_VARS['value_page'] . '&attribute_page=' . $HTTP_GET_VARS['attribute_page'];
    switch($HTTP_GET_VARS['action_att']) {
      case 'add_product_options':
        for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
          $option_name = $HTTP_POST_VARS['option_name'];
          tep_db_query("insert into " . TABLE_PRODUCTS_OPTIONS . " (products_options_id, products_options_name, language_id) values ('" . $HTTP_POST_VARS['products_options_id'] . "', '" . $option_name[$languages[$i]['id']] . "', '" . $languages[$i]['id'] . "')");
        }
        break;
      case 'add_product_option_values':
        for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
          $value_name = $HTTP_POST_VARS['value_name'];
          $value_description = $HTTP_POST_VARS['value_description'];
          tep_db_query("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES . " (products_options_values_id, language_id, products_options_values_name, products_options_description) values ('" . $HTTP_POST_VARS['value_id'] . "', '" . $languages[$i]['id'] . "', '" . $value_name[$languages[$i]['id']] . "', '" . $value_description[$languages[$i]['id']] . "')");
        }
        tep_db_query("insert into " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " (products_options_id, products_options_values_id) values ('" . $HTTP_POST_VARS['option_id'] . "', '" . $HTTP_POST_VARS['value_id'] . "')");
        break;
      case 'add_product_attributes':
        tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES . " values ('', '" . $HTTP_POST_VARS['products_id'] . "', '" . $HTTP_POST_VARS['options_id'] . "', '" . $HTTP_POST_VARS['values_id'] . "', '" . $HTTP_POST_VARS['value_price'] . "', '" . $HTTP_POST_VARS['price_prefix'] . "', '" . $HTTP_POST_VARS['attributes_sort'] . "', '" . $HTTP_POST_VARS['attributes_hide_from_groups'] . "')");
        $products_attributes_id = tep_db_insert_id();
        if ((DOWNLOAD_ENABLED == 'true') && $HTTP_POST_VARS['products_attributes_filename'] != '') {
          tep_db_query("insert into " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " values (" . $products_attributes_id . ", '" . $HTTP_POST_VARS['products_attributes_filename'] . "', '" . $HTTP_POST_VARS['products_attributes_maxdays'] . "', '" . $HTTP_POST_VARS['products_attributes_maxcount'] . "')");
        }
        break;
      case 'update_option_name':
        for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
          $option_name = $HTTP_POST_VARS['option_name'];
          tep_db_query("update " . TABLE_PRODUCTS_OPTIONS . " set products_options_name = '" . $option_name[$languages[$i]['id']] . "' where products_options_id = '" . $HTTP_POST_VARS['option_id'] . "' and language_id = '" . $languages[$i]['id'] . "'");
        }
        break;
      case 'update_value':
        for ($i = 0, $n = sizeof($languages); $i < $n; $i ++) {
          $value_name = $HTTP_POST_VARS['value_name'];
          $value_description = $HTTP_POST_VARS['value_description'];
          tep_db_query("update " . TABLE_PRODUCTS_OPTIONS_VALUES . " set products_options_values_name = '" . $value_name[$languages[$i]['id']] . "', products_options_description = '" . $value_description[$languages[$i]['id']] . "' where products_options_values_id = '" . $HTTP_POST_VARS['value_id'] . "' and language_id = '" . $languages[$i]['id'] . "'");
        }
        #PR. NOTE: BUG in original distribution!
        # WAS where products_options_values_to_products_options_id = ...
        # NOW: where products_options_values_id = ...
        tep_db_query("update " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " set products_options_id = '" . $HTTP_POST_VARS['option_id'] . "', products_options_values_id = '" . $HTTP_POST_VARS['value_id'] . "'  where products_options_values_id = '" . $HTTP_POST_VARS['value_id'] . "'");
        break;
      case 'update_product_attribute':
        tep_db_query("update " . TABLE_PRODUCTS_ATTRIBUTES . " set products_id = '" . $HTTP_POST_VARS['products_id'] . "', options_id = '" . $HTTP_POST_VARS['options_id'] . "', options_values_id = '" . $HTTP_POST_VARS['values_id'] . "', options_values_price = '" . $HTTP_POST_VARS['value_price'] . "', price_prefix = '" . $HTTP_POST_VARS['price_prefix'] . "' where products_attributes_id = '" . $HTTP_POST_VARS['attribute_id'] . "'");
        if ((DOWNLOAD_ENABLED == 'true') && $HTTP_POST_VARS['products_attributes_filename'] != '') {
          tep_db_query("update " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " 
                        set products_attributes_filename='" . $HTTP_POST_VARS['products_attributes_filename'] . "', 
                            products_attributes_maxdays='" . $HTTP_POST_VARS['products_attributes_maxdays'] . "', 
                            products_attributes_maxcount='" . $HTTP_POST_VARS['products_attributes_maxcount'] . "'
                        where products_attributes_id = '" . $HTTP_POST_VARS['attribute_id'] . "'");
        }
        break;
      case 'delete_option':
        tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . $HTTP_GET_VARS['option_id'] . "'");
        break;
      case 'delete_value':
        tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . $HTTP_GET_VARS['value_id'] . "'");
        tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . $HTTP_GET_VARS['value_id'] . "'");
        tep_db_query("delete from " . TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS . " where products_options_values_id = '" . $HTTP_GET_VARS['value_id'] . "'");
        break;
      case 'delete_attribute':
        tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_attributes_id = '" . $HTTP_GET_VARS['attribute_id'] . "'");
// Added for DOWNLOAD_ENABLED. Always try to remove attributes, even if downloads are no longer enabled
        tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " where products_attributes_id = '" . $HTTP_GET_VARS['attribute_id'] . "'");
        break;
    }
  }
  #PR End of save attributes section
?>

<?php
if ( ( $HTTP_GET_VARS['action'] == 'insert_product' || $HTTP_GET_VARS['action'] == 'new_product'
	|| $HTTP_GET_VARS['action'] == 'update_product' ) && $pInfo->products_id) {
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">&nbsp;<a name = 'atts'><?php echo HEADING_TITLE_ATRIB; ?></a>&nbsp;</td>
            <td>&nbsp;<?php echo tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5'); ?>&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
<?php
    if ($HTTP_GET_VARS['action_att'] == 'update_attribute') {
      $form_action = 'update_product_attribute';
    } else {
      $form_action = 'add_product_attributes';
    }
?>
        <td><form name="attributes" action="<?php echo tep_href_link(FILENAME_CATEGORIES, 'action_att=' . $form_action . '&action=' . $HTTP_GET_VARS['action'] . '&pID=' . $pInfo->products_id . '&cPath=' .$cPath. '#atts'); ?>" method="post">
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="7" class="smallText">
<?php
	$attributes = "select pa.* from " . TABLE_PRODUCTS_ATTRIBUTES . " pa left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on pa.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' where pd.products_id = " . $pInfo->products_id;
  if (!$attribute_page) 
  {
	$attribute_page = 1;
  }

?>
            </td>
          </tr>
          <tr>
            <td colspan="7"><?php echo tep_black_line(); ?></td>
          </tr>
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_ID; ?>&nbsp;</td>
            <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_PRODUCT; ?>&nbsp;</td>
            <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_NAME; ?>&nbsp;</td>
            <td class="dataTableHeadingContent">&nbsp;<?php echo TABLE_HEADING_OPT_VALUE; ?>&nbsp;</td>
            <td class="dataTableHeadingContent" align="right">&nbsp;<?php echo TABLE_HEADING_OPT_PRICE; ?>&nbsp;</td>
            <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_OPT_PRICE_PREFIX; ?>&nbsp;</td>
            <td class="dataTableHeadingContent" align="center">&nbsp;<?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
          </tr>
          <tr>
            <td colspan="7"><?php echo tep_black_line(); ?></td>
          </tr>
<?php
  $next_id = 1;
  $attributes = tep_db_query($attributes);
  while ($attributes_values = tep_db_fetch_array($attributes)) 
  {
    $products_name_only = tep_get_products_name($attributes_values['products_id']);
    $options_name = tep_options_name($attributes_values['options_id']);
    $values_name = tep_values_name($attributes_values['options_values_id']);
    $rows++;
?>
          <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
<?php
    if (($HTTP_GET_VARS['action_att'] == 'update_attribute') && ($HTTP_GET_VARS['attribute_id'] == $attributes_values['products_attributes_id'])) {
?>
            <td class="smallText">&nbsp;<?php echo $attributes_values['products_attributes_id']; ?><input type="hidden" name="attribute_id" value="<?php echo $attributes_values['products_attributes_id']; ?>">&nbsp;</td>
            <td class="smallText">&nbsp;<select name="products_id">
<?php
      $products = "select p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . $languages_id . "' and pd.products_id = " . $pInfo->products_id;
      $products = tep_db_query($products);
      while($products_values = tep_db_fetch_array($products)) {
        if ($attributes_values['products_id'] == $products_values['products_id']) {
          echo "\n" . '<option name="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '" SELECTED>' . $products_values['products_name'] . '</option>';
        } else {
          echo "\n" . '<option name="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '">' . $products_values['products_name'] . '</option>';
        }
      } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="options_id">
<?php
      $options = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . $languages_id . "' order by products_options_name");
      while($options_values = tep_db_fetch_array($options)) {
        if ($attributes_values['options_id'] == $options_values['products_options_id']) {
          echo "\n" . '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '" SELECTED>' . $options_values['products_options_name'] . '</option>';
        } else {
          echo "\n" . '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
        }
      } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="values_id">
<?php
      $values = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where language_id ='" . $languages_id . "' order by products_options_values_name");
      while($values_values = tep_db_fetch_array($values)) {
        if ($attributes_values['options_values_id'] == $values_values['products_options_values_id']) {
          echo "\n" . '<option name="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '" SELECTED>' . $values_values['products_options_values_name'] . '</option>';
        } else {
          echo "\n" . '<option name="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '">' . $values_values['products_options_values_name'] . '</option>';
        }
      } 
?>        
            </select>&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<input type="text" name="value_price" value="<?php echo $attributes_values['options_values_price']; ?>" size="6">&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<input type="text" name="price_prefix" value="<?php echo $attributes_values['price_prefix']; ?>" size="2">&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<?php echo tep_image_submit('button_update.png', IMAGE_UPDATE); ?>&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, '&attribute_page=' . $attribute_page . '&action=' . $HTTP_GET_VARS['action'] . '&pID=' . $pInfo->products_id . '&cPath=' .$cPath . '#atts', 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.png', IMAGE_CANCEL); ?></a>&nbsp;</td>
<?php
      if (DOWNLOAD_ENABLED == 'true') {
        $download_query_raw ="select products_attributes_filename, products_attributes_maxdays, products_attributes_maxcount 
                              from " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " 
                              where products_attributes_id='" . $attributes_values['products_attributes_id'] . "'";
        $download_query = tep_db_query($download_query_raw);
        if (tep_db_num_rows($download_query) > 0) {
          $download = tep_db_fetch_array($download_query);
          $products_attributes_filename = $download['products_attributes_filename'];
          $products_attributes_maxdays  = $download['products_attributes_maxdays'];
          $products_attributes_maxcount = $download['products_attributes_maxcount'];
        }
?>
          <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
            <td>&nbsp;</td>
            <td colspan="5">
              <table>
                <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
                  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_DOWNLOAD; ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_FILENAME; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_filename', $products_attributes_filename, 'size="15"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_DAYS; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxdays', $products_attributes_maxdays, 'size="5"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_COUNT; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxcount', $products_attributes_maxcount, 'size="5"'); ?>&nbsp;</td>
                </tr>
              </table>
            </td>
            <td>&nbsp;</td>
          </tr>
<?php
      }
?>
<?php
    } elseif (($HTTP_GET_VARS['action_att'] == 'delete_product_attribute') && ($HTTP_GET_VARS['attribute_id'] == $attributes_values['products_attributes_id'])) {
?>
            <td class="smallText">&nbsp;<b><?php echo $attributes_values["products_attributes_id"]; ?></b>&nbsp;</td>
            <td class="smallText">&nbsp;<b><?php echo $products_name_only; ?></b>&nbsp;</td>
            <td class="smallText">&nbsp;<b><?php echo $options_name; ?></b>&nbsp;</td>
            <td class="smallText">&nbsp;<b><?php echo $values_name; ?></b>&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<b><?php echo $attributes_values["options_values_price"]; ?></b>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<b><?php echo $attributes_values["price_prefix"]; ?></b>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<b><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action_att=delete_attribute&attribute_id=' . $HTTP_GET_VARS['attribute_id']. '&action=' . $HTTP_GET_VARS['action'] . '&pID=' . $pInfo->products_id . '&cPath=' .$cPath. '#atts') . '">'; ?><?php echo tep_image_button('button_confirm.png', IMAGE_CONFIRM); ?></a>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, '&attribute_page=' . $attribute_page. '&action=' . $HTTP_GET_VARS['action'] . '&pID=' . $pInfo->products_id . '&cPath=' .$cPath. '#atts', 'NONSSL') . '">'; ?><?php echo tep_image_button('button_cancel.png', IMAGE_CANCEL); ?></a>&nbsp;</b></td>
<?php
    } else {
?>
            <td class="smallText">&nbsp;<?php echo $attributes_values["products_attributes_id"]; ?>&nbsp;</td>
            <td class="smallText">&nbsp;<?php echo $products_name_only; ?>&nbsp;</td>
            <td class="smallText">&nbsp;<?php echo $options_name; ?>&nbsp;</td>
            <td class="smallText">&nbsp;<?php echo $values_name; ?>&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<?php echo $attributes_values["options_values_price"]; ?>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<?php echo $attributes_values["price_prefix"]; ?>&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action_att=update_attribute&attribute_id=' . $attributes_values['products_attributes_id'] . '&attribute_page=' . $attribute_page . '&action=' . $HTTP_GET_VARS['action'] . '&pID=' . $pInfo->products_id . '&cPath=' .$cPath. '#atts', 'NONSSL') . '">'; ?><?php echo tep_image_button('button_edit.png', IMAGE_UPDATE); ?></a>&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action_att=delete_product_attribute&attribute_id=' . $attributes_values['products_attributes_id'] . '&attribute_page=' . $attribute_page . '&action=' . $HTTP_GET_VARS['action'] . '&pID=' . $pInfo->products_id . '&cPath=' .$cPath. '#atts', 'NONSSL') , '">'; ?><?php echo tep_image_button('button_delete.png', IMAGE_DELETE); ?></a>&nbsp;</td>
<?php
    }
    $max_attributes_id_query = tep_db_query("select max(products_attributes_id) + 1 as next_id from " . TABLE_PRODUCTS_ATTRIBUTES);
    $max_attributes_id_values = tep_db_fetch_array($max_attributes_id_query);
    $next_id = $max_attributes_id_values['next_id'];
?>
          </tr>
<?php
  }
  if ($HTTP_GET_VARS['action_att'] != 'update_attribute') {
?>
          <tr>
            <td colspan="7"><?php echo tep_black_line(); ?></td>
          </tr>
          <tr class="<?php echo (floor($rows/2) == ($rows/2) ? 'attributes-even' : 'attributes-odd'); ?>">
            <td class="smallText">&nbsp;<?php echo $next_id; ?>&nbsp;</td>
      	    <td class="smallText">&nbsp;<select name="products_id">
<?php
    $products = "select p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . $languages_id . "' and pd.products_id = " . $pInfo->products_id;
    $products = tep_db_query($products);
    while ($products_values = tep_db_fetch_array($products)) {
      echo '<option name="' . $products_values['products_name'] . '" value="' . $products_values['products_id'] . '">' . $products_values['products_name'] . '</option>';
    } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="options_id">
<?php
    $options = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS . " where language_id = '" . $languages_id . "' order by products_options_name");
    while ($options_values = tep_db_fetch_array($options)) {
      echo '<option name="' . $options_values['products_options_name'] . '" value="' . $options_values['products_options_id'] . '">' . $options_values['products_options_name'] . '</option>';
    } 
?>
            </select>&nbsp;</td>
            <td class="smallText">&nbsp;<select name="values_id">
<?php
    $values = tep_db_query("select * from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where language_id = '" . $languages_id . "' order by products_options_values_name");
    while ($values_values = tep_db_fetch_array($values)) {
      echo '<option name="' . $values_values['products_options_values_name'] . '" value="' . $values_values['products_options_values_id'] . '">' . $values_values['products_options_values_name'] . '</option>';
    } 
?>
            </select>&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<input type="text" name="value_price" size="6">&nbsp;</td>
            <td align="right" class="smallText">&nbsp;<input type="text" name="price_prefix" size="2" value="+">&nbsp;</td>
            <td align="center" class="smallText">&nbsp;<?php echo tep_image_submit('button_insert.png', IMAGE_INSERT); ?>&nbsp;</td>
          </tr>
<?php
      if (DOWNLOAD_ENABLED == 'true') {
        $products_attributes_maxdays  = DOWNLOAD_MAX_DAYS;
        $products_attributes_maxcount = DOWNLOAD_MAX_COUNT;
?>
          <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
            <td>&nbsp;</td>
            <td colspan="5">
              <table>
                <tr class="<?php echo (!($rows % 2)? 'attributes-even' : 'attributes-odd');?>">
                  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_DOWNLOAD; ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_FILENAME; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_filename', $products_attributes_filename, 'size="15"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_DAYS; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxdays', $products_attributes_maxdays, 'size="5"'); ?>&nbsp;</td>
                  <td class="smallText"><?php echo TABLE_TEXT_MAX_COUNT; ?></td>
                  <td class="smallText"><?php echo tep_draw_input_field('products_attributes_maxcount', $products_attributes_maxcount, 'size="5"'); ?>&nbsp;</td>
                </tr>
              </table>
            </td>
            <td>&nbsp;</td>
          </tr>
<?php
      } // end of DOWNLOAD_ENABLED section
?>
<?php
  }
?>
          <tr>
            <td colspan="7"><?php echo tep_black_line(); ?></td>
          </tr>
        </table></form></td>
      </tr>
    </table></td>
</tr>
<?php
}
?>
<!-- products_attributes_eof //-->
</table>
 <!-- body_eof //-->
<!-------------------------------->
<!--- PRODUCT FILL    ::END::  --->
<!--- PRODUCT PREVIEW ::START::--->
<!-------------------------------->
<?php
  } elseif ($action == 'new_product_preview') {
    if (tep_not_null($HTTP_POST_VARS)) {
      $pInfo = new objectInfo($HTTP_POST_VARS);
      $products_name = $HTTP_POST_VARS['products_name'];
      $products_description = $HTTP_POST_VARS['products_description'];
// Product Tabs 2.0 Start-15
      $products_spec = $HTTP_POST_VARS['products_spec'];
      $products_musthave = $HTTP_POST_VARS['products_musthave'];
      $products_extraimage = $HTTP_POST_VARS['products_extraimage'];
      $products_manual = $HTTP_POST_VARS['products_manual'];
      $products_extra1 = $HTTP_POST_VARS['products_extra1'];
      $products_moreinfo = $HTTP_POST_VARS['products_moreinfo'];
// Product Tabs 2.0 End-15
// bof: header tags seo /Step-11(18)\
      $products_head_title_tag = $HTTP_POST_VARS['products_head_title_tag'];
      $products_head_desc_tag = $HTTP_POST_VARS['products_head_desc_tag'];
      $products_head_keywords_tag = $HTTP_POST_VARS['products_head_keywords_tag'];
// bof: header tags seo /Step-11(18)\
      $products_url = $HTTP_POST_VARS['products_url'];
      $products_to_rss = $HTTP_POST_VARS['products_to_rss'];

// bof: qpbpp for sppc /step-16a(23)\
      $price_breaks_array = array();
      if (isset($_POST['products_price_break'][0]) && isset($_POST['products_qty'][0])) {
        foreach ($_POST['products_price_break'][0] as $index => $products_price ) {
          if (tep_not_null($products_price) && tep_not_null($_POST['products_qty'][0][$index]) && !isset($_POST['products_delete'][0][$index])) {
            $price_breaks_array[] = array(
              'products_price' => $products_price,
              'products_qty' => $_POST['products_qty'][0][$index]);
          }
        } // end foreach ($_POST['products_price_break'][0] as ...
      usort($price_breaks_array, "sortByQty");  
      } // end if (isset($_POST['products_price_break'][0]) && ...
// eof: qpbpp for sppc /step-16a(23)\
    } else {

// beof: header tags seo /Step-11(18)\
// Product Tabs 2.0 added queries Start-16
// beof: tntpost-f /step-8(9)\--> 
// beof: qpbpp for sppc /step-16b(23)\ added: , p.products_qty_blocks, p.products_min_order_qty
	  $product_query = tep_db_query("select p.products_id, pd.language_id, pd.products_name, pd.products_description, pd.products_url, pd.products_head_title_tag, pd.products_head_desc_tag, pd.products_head_keywords_tag, p.products_quantity, p.products_model, p.products_image, p.products_image_med, p.products_image_pop, p.products_image_description, p.products_image_lrg, p.products_image_sm_1, p.products_image_xl_1, p.products_image_sm_2, p.products_image_xl_2, p.products_image_sm_3, p.products_image_xl_3, p.products_image_sm_4, p.products_image_xl_4, p.products_image_sm_5, p.products_image_xl_5, p.products_image_sm_6, p.products_image_xl_6, p.products_price, p.products_weight, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.manufacturers_id, p.tnt_f_tr, p.tnt_f_sb, p.tnt_f_cs, p.products_to_rss, p.products_qty_blocks, p.products_min_order_qty from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and p.products_id = '" . (int)$HTTP_GET_VARS['pID'] . "'");
      $product = tep_db_fetch_array($product_query);

      $pInfo = new objectInfo($product);
      $products_image_name = $pInfo->products_image;
	  
// bof: qpbpp for sppc /step-16c(23)\
// move retail settings for quantity blocks and min order qty to an array indexed
// by customer_group_id, like we get back in $_POST values
      unset($pInfo->products_qty_blocks);
      $pInfo->products_qty_blocks[0] = $product['products_qty_blocks'];
      unset($pInfo->products_min_order_qty);
      $pInfo->products_min_order_qty[0] = $product['products_min_order_qty'];
// price_breaks_array is taken care of by PriceFormatterAdmin.php
// eof: qpbpp for sppc /step-16c(23)\
// bof: Additional Images
      $products_image_pop_name = $pInfo->products_image_pop;
      $products_image_med_name = $pInfo->products_image_med;
// eof: Additional Images
    }

    $form_action = (isset($HTTP_GET_VARS['pID'])) ? 'update_product' : 'insert_product';

    echo tep_draw_form($form_action, FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($HTTP_GET_VARS['pID']) ? '&pID=' . $HTTP_GET_VARS['pID'] : '') . '&action=' . $form_action, 'post', 'enctype="multipart/form-data"');

    $languages = tep_get_languages();
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
      if (isset($HTTP_GET_VARS['read']) && ($HTTP_GET_VARS['read'] == 'only')) {
        $pInfo->products_name = tep_get_products_name($pInfo->products_id, $languages[$i]['id']);
        $pInfo->products_description = tep_get_products_description($pInfo->products_id, $languages[$i]['id']);
// Product Tabs 2.0 Start-17
        $pInfo->products_spec = tep_get_products_spec($pInfo->products_id, $languages[$i]['id']);
        $pInfo->products_musthave = tep_get_products_musthave($pInfo->products_id, $languages[$i]['id']);
        $pInfo->products_extraimage = tep_get_products_extraimage($pInfo->products_id, $languages[$i]['id']);
        $pInfo->products_manual = tep_get_products_manual($pInfo->products_id, $languages[$i]['id']);
        $pInfo->products_extra1 = tep_get_products_extra1($pInfo->products_id, $languages[$i]['id']);
        $pInfo->products_moreinfo = tep_get_products_moreinfo($pInfo->products_id, $languages[$i]['id']);
// Product Tabs 2.0 End-17
// bof: header tags seo /Step-12(18)\
        $pInfo->products_head_title_tag = tep_db_prepare_input($products_head_title_tag[$languages[$i]['id']]);
        $pInfo->products_head_desc_tag = tep_db_prepare_input($products_head_desc_tag[$languages[$i]['id']]);
        $pInfo->products_head_keywords_tag = tep_db_prepare_input($products_head_keywords_tag[$languages[$i]['id']]);
// eof: header tags seo /Step-12(18)\
        $pInfo->products_url = tep_get_products_url($pInfo->products_id, $languages[$i]['id']);
      } else {
        $pInfo->products_name = tep_db_prepare_input($products_name[$languages[$i]['id']]);
        $pInfo->products_description = tep_db_prepare_input($products_description[$languages[$i]['id']]);
// bof: header tags seo /Step-12(18)\
        $pInfo->products_head_title_tag = tep_db_prepare_input($products_head_title_tag[$languages[$i]['id']]);
        $pInfo->products_head_desc_tag = tep_db_prepare_input($products_head_desc_tag[$languages[$i]['id']]);
        $pInfo->products_head_keywords_tag = tep_db_prepare_input($products_head_keywords_tag[$languages[$i]['id']]);
// eof: header tags seo /Step-12(18)\
        $pInfo->products_url = tep_db_prepare_input($products_url[$languages[$i]['id']]);
      }
?>
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . $pInfo->products_name; ?></td>
            <td class="pageHeading" align="right"><?php
// bof: qpbpp for sppc /step-17(23)\
            $pf->loadProduct((int)$HTTP_GET_VARS['pID'], $pInfo->products_price, $pInfo->products_tax_class_id, (int)$pInfo->products_qty_blocks[0], $price_breaks_array, (int)$pInfo->products_min_order_qty[0]);
            echo $pf->getPriceString();
// eof: qpbpp for sppc /step-17(23)\ ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
<!--Product Tabs 2.0 Start-18-->
        <td class="main">
              <?php if (ULTIMATE_ADDITIONAL_IMAGES == 'enable') { ?><?php echo tep_image(DIR_WS_CATALOG_IMAGES . $products_image_lrg_name, TEXT_PRODUCTS_IMAGE . ' ' . $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="right" hspace="5" vspace="5"'); ?><?php } ?>
              <?php if (ULTIMATE_ADDITIONAL_IMAGES == 'enable') { ?><?php echo tep_image(DIR_WS_CATALOG_IMAGES . $products_image_med_name, TEXT_PRODUCTS_IMAGE . ' ' . $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="right" hspace="5" vspace="5"'); ?><?php } ?>
              <?php echo tep_image(DIR_WS_CATALOG_IMAGES . $products_image_name, TEXT_PRODUCTS_IMAGE . ' ' . $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="right" hspace="5" vspace="5"'); ?>
              <?php echo $pInfo->products_description . '<br><br><center>'; ?>
              <?php if (ULTIMATE_ADDITIONAL_IMAGES == 'enable') { ?>
              <?php echo tep_image(DIR_WS_CATALOG_IMAGES . $products_image_sm_1_name, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="center" hspace="5" vspace="5"'); ?>
              <?php echo tep_image(DIR_WS_CATALOG_IMAGES . $products_image_sm_2_name, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="center" hspace="5" vspace="5"'); ?>
              <?php echo tep_image(DIR_WS_CATALOG_IMAGES . $products_image_sm_3_name, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="center" hspace="5" vspace="5"') . '<br>'; ?>
              <?php echo tep_image(DIR_WS_CATALOG_IMAGES . $products_image_sm_4_name, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="center" hspace="5" vspace="5"'); ?>
              <?php echo tep_image(DIR_WS_CATALOG_IMAGES . $products_image_sm_5_name, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="center" hspace="5" vspace="5"'); ?>
              <?php echo tep_image(DIR_WS_CATALOG_IMAGES . $products_image_sm_6_name, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT, 'align="center" hspace="5" vspace="5"') . '<br>'; ?>
              <?php } ?>
        </td>
<!--Product Tabs 2.0 End-18--> 
      </tr>
<?php
      if ($pInfo->products_url) {
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><?php echo sprintf(TEXT_PRODUCT_MORE_INFORMATION, $pInfo->products_url); ?></td>
      </tr>
<?php
      }
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
<?php
      if ($pInfo->products_date_available > date('Y-m-d')) {
?>
      <tr>
        <td align="center" class="smallText"><?php echo sprintf(TEXT_PRODUCT_DATE_AVAILABLE, tep_date_long($pInfo->products_date_available)); ?></td>
      </tr>
<?php
      } else {
?>
      <tr>
        <td align="center" class="smallText"><?php echo sprintf(TEXT_PRODUCT_DATE_ADDED, tep_date_long($pInfo->products_date_added)); ?></td>
      </tr>
<?php
      }
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
<?php
    }

    if (isset($HTTP_GET_VARS['read']) && ($HTTP_GET_VARS['read'] == 'only')) {
      if (isset($HTTP_GET_VARS['origin'])) {
        $pos_params = strpos($HTTP_GET_VARS['origin'], '?', 0);
        if ($pos_params != false) {
          $back_url = substr($HTTP_GET_VARS['origin'], 0, $pos_params);
          $back_url_params = substr($HTTP_GET_VARS['origin'], $pos_params + 1);
        } else {
          $back_url = $HTTP_GET_VARS['origin'];
          $back_url_params = '';
        }
      } else {
        $back_url = FILENAME_CATEGORIES;
        $back_url_params = 'cPath=' . $cPath . '&pID=' . $pInfo->products_id;
      }
?>
      <tr>
        <td align="right"><?php echo '<a href="' . tep_href_link($back_url, $back_url_params, 'NONSSL') . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a>'; ?></td>
      </tr>
<?php
    } else {
?>
      <tr>
        <td align="right" class="smallText">
<?php
/* Re-Post all POST'ed variables */
      reset($HTTP_POST_VARS);
      while (list($key, $value) = each($HTTP_POST_VARS)) {
// bof: qpbpp for sppc /step-18(23)\
        if (is_array($value)) {
          while (list($k, $v) = each($value)) {
            if (is_array($v)) {
              foreach ($v as $subkey => $subvalue) {
                echo tep_draw_hidden_field($key . '[' . $k . '][' . $subkey . ']', htmlspecialchars(stripslashes($subvalue)));
              }
            } else {
              echo tep_draw_hidden_field($key . '[' . $k . ']', htmlspecialchars(stripslashes($v)));
            }
          }
        } else {
// eof: qpbpp for sppc /step-18(23)\
          echo tep_draw_hidden_field($key, htmlspecialchars(stripslashes($value)));
        }
      }
      $languages = tep_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        echo tep_draw_hidden_field('products_name[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_name[$languages[$i]['id']])));
        echo tep_draw_hidden_field('products_description[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_description[$languages[$i]['id']])));
// Product Tabs 2.0 Start-19
        echo tep_draw_hidden_field('products_spec[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_spec[$languages[$i]['id']])));
        echo tep_draw_hidden_field('products_musthave[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_musthave[$languages[$i]['id']])));
        echo tep_draw_hidden_field('products_extraimage[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_extraimage[$languages[$i]['id']])));
        echo tep_draw_hidden_field('products_manual[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_manual[$languages[$i]['id']])));
        echo tep_draw_hidden_field('products_extra1[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_extra1[$languages[$i]['id']])));
        echo tep_draw_hidden_field('products_moreinfo[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_moreinfo[$languages[$i]['id']])));
// Product Tabs 2.0 End-19
// bof: header tags seo /Step-13(18)\
        echo tep_draw_hidden_field('products_head_title_tag[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_head_title_tag[$languages[$i]['id']])));
        echo tep_draw_hidden_field('products_head_desc_tag[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_head_desc_tag[$languages[$i]['id']])));
        echo tep_draw_hidden_field('products_head_keywords_tag[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_head_keywords_tag[$languages[$i]['id']])));
// eof: header tags seo /Step-13(18)\
        echo tep_draw_hidden_field('products_url[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_url[$languages[$i]['id']])));
      }
        echo tep_draw_hidden_field('products_image', stripslashes($products_image_name));
      // bof: Additional Images
        echo tep_draw_hidden_field('products_image_pop', stripslashes($products_image_pop_name));
        echo tep_draw_hidden_field('products_image_med', stripslashes($products_image_med_name));
      // eof: Additional Images
// Product Tabs 2.0 Start-19
//BOF UltraPics
        echo tep_draw_hidden_field('products_image_lrg', stripslashes($products_image_lrg_name));
        echo tep_draw_hidden_field('products_image_sm_1', stripslashes($products_image_sm_1_name));
        echo tep_draw_hidden_field('products_image_xl_1', stripslashes($products_image_xl_1_name));
        echo tep_draw_hidden_field('products_image_sm_2', stripslashes($products_image_sm_2_name));
        echo tep_draw_hidden_field('products_image_xl_2', stripslashes($products_image_xl_2_name));
        echo tep_draw_hidden_field('products_image_sm_3', stripslashes($products_image_sm_3_name));
        echo tep_draw_hidden_field('products_image_xl_3', stripslashes($products_image_xl_3_name));
        echo tep_draw_hidden_field('products_image_sm_4', stripslashes($products_image_sm_4_name));
        echo tep_draw_hidden_field('products_image_xl_4', stripslashes($products_image_xl_4_name));
        echo tep_draw_hidden_field('products_image_sm_5', stripslashes($products_image_sm_5_name));
        echo tep_draw_hidden_field('products_image_xl_5', stripslashes($products_image_xl_5_name));
        echo tep_draw_hidden_field('products_image_sm_6', stripslashes($products_image_sm_6_name));
        echo tep_draw_hidden_field('products_image_xl_6', stripslashes($products_image_xl_6_name));
//EOF UltraPics
// Product Tabs 2.0 End-19

        echo tep_image_submit('button_back.png', IMAGE_BACK, 'name="edit"') . '&nbsp;&nbsp;';

      if (isset($HTTP_GET_VARS['pID'])) {
        echo tep_image_submit('button_update.png', IMAGE_UPDATE);
      } else {
        echo tep_image_submit('button_insert.png', IMAGE_INSERT);
      }
      echo '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($HTTP_GET_VARS['pID']) ? '&pID=' . $HTTP_GET_VARS['pID'] : '')) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>';
?></td>
      </tr>
    </table></form>
<!--------------------------------->
<!--- PRODUCT PREVIEW  ::END::  --->
<!--- CATEGORIES VIEW ::START:: --->
<!--------------------------------->
<?php
    }
  } else {
?>
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
            <td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="smallText" align="right">
<?php
// bof: KategorienAdmin / OLISWISS
  if ($admin_groups_id == 1) {
// eof: KategorienAdmin / OLISWISS
    echo tep_draw_form('search', FILENAME_CATEGORIES, '', 'get');
    echo HEADING_TITLE_SEARCH . ' ' . tep_draw_input_field('search');
    echo tep_hide_session_id() . '</form>';
// bof: KategorienAdmin / OLISWISS
    }
// eof: KategorienAdmin / OLISWISS
?>
                </td>
              </tr>
              <tr>
                <td class="smallText" align="right">
<?php
// bof: KategorienAdmin / OLISWISS
//  echo tep_draw_form('goto', FILENAME_CATEGORIES, '', 'get');
//  echo HEADING_TITLE_GOTO . ' ' . tep_draw_pull_down_menu('cPath', tep_get_category_tree(), $current_category_id, 'onChange="this.form.submit();"');
//  echo tep_hide_session_id() . '</form>';
  if (is_array($admin_cat_access_array_cats) && (in_array("ALL",$admin_cat_access_array_cats)== false) && (pos($admin_cat_access_array_cats)!= "")) {
    //echo tep_draw_form('goto', FILENAME_CATEGORIES, '', 'get');
//    echo HEADING_TITLE_GOTO . ' ' . tep_draw_pull_down_menu('cPath', tep_get_category_tree('','','','',$admin_cat_access_array_cats), $current_category_id, 'onChange="this.form.submit();"');
//  echo tep_hide_session_id() . '</form>';
  } else if (in_array("ALL",$admin_cat_access_array_cats)== true) { //nur Top-ADMIN
    echo tep_draw_form('goto', FILENAME_CATEGORIES, '', 'get');
    echo HEADING_TITLE_GOTO . ' ' . tep_draw_pull_down_menu('cPath', tep_get_category_tree(), $current_category_id, 'onChange="this.form.submit();"');
    echo '</form>';	
  }
// eof: KategorienAdmin / OLISWISS
?>
                </td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_PRODUCT_ID; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CATEGORIES_PRODUCTS; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_PRODUCT_MODEL; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_PRODUCT_VIEWED; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_PRODUCT_ORDERED; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
    $categories_count = 0;
    $rows = 0;
    if (isset($HTTP_GET_VARS['search'])) {
      $search = tep_db_prepare_input($HTTP_GET_VARS['search']);

// beof: activate inactivate category /Step-3+4(9)\ added: , c.status_categ
// beof: header tags seo /Step-14(18)\ added queries
// bof: KategorienAdmin / OLISWISS
/* original
	$categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and cd.categories_name like '%" . tep_db_input($search) . "%' order by c.sort_order, cd.categories_name");
    } else {
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by c.sort_order, cd.categories_name");
*///* original_eof

      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified, c.status_categ, cd.categories_htc_title_tag, cd.categories_htc_desc_tag, cd.categories_htc_keywords_tag, cd.categories_htc_description from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and cd.categories_name like '%" . tep_db_input($search) . "%' order by c.sort_order, cd.categories_name");
    } else {
	
    if ($admin_cat_access == "ALL") {
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified, c.status_categ, cd.categories_htc_title_tag, cd.categories_htc_desc_tag, cd.categories_htc_keywords_tag, cd.categories_htc_description from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by c.sort_order, cd.categories_name");
    } else if ($admin_cat_access == ""){
      $categories_query = tep_db_query("");
    } else {
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified, c.status_categ, cd.categories_htc_title_tag, cd.categories_htc_desc_tag, cd.categories_htc_keywords_tag, cd.categories_htc_description from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and (c.parent_id or c.categories_id in (" . $admin_cat_access . ")) and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by c.sort_order, cd.categories_name");
    }
// eof: KategorienAdmin / OLISWISS
	}

	while ($categories = tep_db_fetch_array($categories_query)) {
      $categories_count++;
      $rows++;

// Get parent_id for subcategories if search
      if (isset($HTTP_GET_VARS['search'])) $cPath= $categories['parent_id'];

      if ((!isset($HTTP_GET_VARS['cID']) && !isset($HTTP_GET_VARS['pID']) || (isset($HTTP_GET_VARS['cID']) && ($HTTP_GET_VARS['cID'] == $categories['categories_id']))) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
        $category_childs = array('childs_count' => tep_childs_in_category_count($categories['categories_id']));
        $category_products = array('products_count' => tep_products_in_category_count($categories['categories_id']));

        $cInfo_array = array_merge($categories, $category_childs, $category_products);
        $cInfo = new objectInfo($cInfo_array);
      }
// bof: KategorienAdmin / OLISWISS
     if ($admin_groups_id == 1 || in_array($categories['categories_id'],$admin_cat_access_array_cats)) {
       if ($admin_groups_id == 1 || in_array($HTTP_GET_VARS['cPath'],$admin_cat_access_array_cats) || in_array($categories['categories_id'],$admin_cat_access_array_cats)) {
// eof: KategorienAdmin / OLISWISS
      if (isset($cInfo) && is_object($cInfo) && ($categories['categories_id'] == $cInfo->categories_id) ) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_CATEGORIES, tep_get_path($categories['categories_id'])) . '\'">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $categories['categories_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent" align="center"><?php echo $categories['categories_id'] . '</b>'; ?></td>
                <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, tep_get_path($categories['categories_id'])) . '">' . tep_image(DIR_WS_ICONS . 'file_icons/folder.gif', ICON_FOLDER) . '</a>&nbsp;<b>' . $categories['categories_name'] . '</b>'; ?></td>
                <td class="dataTableContent" align="center"><?php echo $categories['sort_order']; ?><?php echo ' / -'; ?></td>
                <td class="dataTableContent" align="center"><?php echo '-'; ?></td>
                <td class="dataTableContent" align="center"><?php echo '-'; ?></td>
<td class="dataTableContent" align="center">
    <?php // bof: activate inactivate category /Step-5(9)\
	 $extra_sfc = (isset($HTTP_GET_VARS['cPath']) ? '&cPath='.$HTTP_GET_VARS['cPath'] : '');
        if ( $categories['status_categ'] == 1 ) {
            echo tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) 
            . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflagcateg&flag=0&cID=' . $categories['categories_id']) . $extra_sfc . '">' . tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';

        } else {
            echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflagcateg&flag=1&cID=' . $categories['categories_id']) . $extra_sfc . '">' . tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;'
            . tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
        }
// eof: activate inactivate category /Step-5(9)\
  ?>
</td>
                <td class="dataTableContent" align="right"><?php if (isset($cInfo) && is_object($cInfo) && ($categories['categories_id'] == $cInfo->categories_id) ) { echo tep_image(DIR_WS_IMAGES . 'icons/info_icons/icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $categories['categories_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icons/info_icons/icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
// bof: KategorienAdmin / OLISWISS
       }
     }
// eof: KategorienAdmin / OLISWISS
    }

    $products_count = 0;
    if (isset($HTTP_GET_VARS['search'])) {
// bof: tntpost-f /step-9(9)\--> 
      $products_query = tep_db_query("select p.products_id, p.products_model, pd.products_name, pd.products_viewed, p.products_ordered, p.products_quantity, p.products_image, p.products_price, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.products_qty_blocks, p.products_min_order_qty, p2c.categories_id, p.tnt_f_tr, p.tnt_f_sb, p.tnt_f_cs, p.products_to_rss from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and pd.products_name like '%" . tep_db_input($search) . "%' order by pd.products_name");
    } else {
// eof: tntpost-f /step-9(9)\--> 
      $products_query = tep_db_query("select p.products_id, p.products_model, pd.products_name, pd.products_viewed, p.products_ordered, p.products_quantity, p.products_image, p.products_price, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.products_qty_blocks, p.products_min_order_qty, p.tnt_f_tr, p.tnt_f_sb, p.tnt_f_cs, p.products_to_rss from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = '" . (int)$current_category_id . "' order by pd.products_name");
    }
    while ($products = tep_db_fetch_array($products_query)) {
      $products_count++;
      $rows++;

// Get categories_id for product if search
      if (isset($HTTP_GET_VARS['search'])) $cPath = $products['categories_id'];

      if ( (!isset($HTTP_GET_VARS['pID']) && !isset($HTTP_GET_VARS['cID']) || (isset($HTTP_GET_VARS['pID']) && ($HTTP_GET_VARS['pID'] == $products['products_id']))) && !isset($pInfo) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
// find out the rating average from customer reviews
        $reviews_query = tep_db_query("select (avg(reviews_rating) / 5 * 100) as average_rating from " . TABLE_REVIEWS . " where products_id = '" . (int)$products['products_id'] . "'");
        $reviews = tep_db_fetch_array($reviews_query);
        $pInfo_array = array_merge($products, $reviews);
        $pInfo = new objectInfo($pInfo_array);
      }
// bof: KategorienAdmin / OLISWISS
     if ($admin_groups_id == 1 || in_array($categories['categories_id'],$admin_cat_access_array_cats) || $cPath != 0) {
// eof: KategorienAdmin / OLISWISS
      if (isset($pInfo) && is_object($pInfo) && ($products['products_id'] == $pInfo->products_id) ) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products['products_id'] . '&action=new_product_preview&read=only') . '\'">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products['products_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent" align="center"><?php echo $products['products_id']; ?></td>
                <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products['products_id'] . '&action=new_product_preview&read=only') . '">' . tep_image(DIR_WS_ICONS . 'file_icons/preview.gif', ICON_PREVIEW) . '</a>&nbsp;' . $products['products_name']; ?></td>
                <td class="dataTableContent" align="center"><?php echo '- / '; ?><?php echo $products['products_model']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $products['products_viewed']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $products['products_ordered']; ?></td>
                <td class="dataTableContent" align="center">
<?php    if ($products['products_status'] == '1') { //product available 
		echo tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag&flag=0&pID=' . $products['products_id'] . '&cPath=' . $cPath) . '">' . tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>'; 
		 
		// RSS quick set button 
		if($products['products_to_rss'] == 1){ //if the rss property is set to show 
			//draw the "on" button and hyperlink it to turn it off 
			$hyperlink = tep_href_link(FILENAME_CATEGORIES, 'action=setrss&rss=0&pID='. $products['products_id'] .'&cPath='. $cPath); 
			echo ' <a href="'. $hyperlink .'">'. tep_image(DIR_WS_IMAGES . 'icons/rss_icons/rss_icon.gif', ICON_RSS_ON, 12, 12) .'</a>'; 
		} else { 
			//draw the "off" button and hyperlink it to set it back on 
			$hyperlink = tep_href_link(FILENAME_CATEGORIES, 'action=setrss&rss=1&pID='. $products['products_id'] .'&cPath='. $cPath); 
			echo ' <a href="'. $hyperlink .'">' . tep_image(DIR_WS_IMAGES . 'icons/rss_icons/rss_icon_deact.gif', ICON_RSS_OFF, 12, 12) .'</a>'; 
		} 
		 
    } else { //product unavailable 
		echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag&flag=1&pID=' . $products['products_id'] . '&cPath=' . $cPath) . '">' . tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10); 
		//draw the deactivated RSS icon, just to align with the rest 
		echo ' ' . tep_image(DIR_WS_IMAGES . 'icons/rss_icons/rss_icon_deact.gif', ICON_RSS_OFF, 12, 12); 
    } 
?></td>
                <td class="dataTableContent" align="right"><?php if (isset($pInfo) && is_object($pInfo) && ($products['products_id'] == $pInfo->products_id)) { echo tep_image(DIR_WS_IMAGES . 'icons/info_icons/icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icons/info_icons/icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
// bof: KategorienAdmin / OLISWISS
      }
// eof: KategorienAdmin / OLISWISS
    }

    $cPath_back = '';
    if (sizeof($cPath_array) > 0) {
      for ($i=0, $n=sizeof($cPath_array)-1; $i<$n; $i++) {
        if (empty($cPath_back)) {
          $cPath_back .= $cPath_array[$i];
        } else {
          $cPath_back .= '_' . $cPath_array[$i];
        }
      }
    }

    $cPath_back = (tep_not_null($cPath_back)) ? 'cPath=' . $cPath_back . '&' : '';
?>
              <tr>
                <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
				  <?php // bof: KategorienAdmin / OLISWISS
					if($admin_groups_id == 1){
				  ?>
                    <td class="smallText"><?php echo TEXT_CATEGORIES . '&nbsp;' . $categories_count . '<br>' . TEXT_PRODUCTS . '&nbsp;' . $products_count; ?></td>
                    <td align="right" class="smallText"><?php if (sizeof($cPath_array) > 0) echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, $cPath_back . 'cID=' . $current_category_id) . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a>&nbsp;'; if (!isset($HTTP_GET_VARS['search'])) echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&action=new_category') . '">' . tep_image_button('button_new_category.png', IMAGE_NEW_CATEGORY) . '</a>&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&action=new_product') . '">' . tep_image_button('button_new_product.png', IMAGE_NEW_PRODUCT) . '</a>'; ?>&nbsp;</td>
					<?php
					} else {
					?>
                    <td></td>
                    <td align="right" class="smallText">
                    <?php if (sizeof($cPath_array) > 0) echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, $cPath_back . 'cID=' . $current_category_id) . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a>&nbsp;';
                    if (!isset($HTTP_GET_VARS['search']) && strstr($admin_right_access,"CNEW")) echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&action=new_category') . '">' . tep_image_button('button_new_category.png', IMAGE_NEW_CATEGORY) . '</a>&nbsp;'; 
                    if (!isset($HTTP_GET_VARS['search']) && strstr($admin_right_access,"PNEW") && $cInfo->parent_id !='0') echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&action=new_product') . '">' . tep_image_button('button_new_product.png', IMAGE_NEW_PRODUCT) . '</a>'; ?>&nbsp;</td>
<?php
	}
// eof: KategorienAdmin / OLISWISS
?>
                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php
    $heading = array();
    $contents = array();
    switch ($action) {
      case 'new_category':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_CATEGORY . '</b>');

        $contents = array('form' => tep_draw_form('newcategory', FILENAME_CATEGORIES, 'action=insert_category&cPath=' . $cPath, 'post', 'enctype="multipart/form-data"'));
        $contents[] = array('text' => TEXT_NEW_CATEGORY_INTRO);

        $category_inputs_string = '';
        $languages = tep_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $category_inputs_string .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_name[' . $languages[$i]['id'] . ']');
// bof: header tags seo /Step-15(18)\
          $category_htc_title_string .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_htc_title_tag[' . $languages[$i]['id'] . ']');
          $category_htc_desc_string .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_htc_desc_tag[' . $languages[$i]['id'] . ']');
          $category_htc_keywords_string .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_htc_keywords_tag[' . $languages[$i]['id'] . ']');
          if (HEADER_TAGS_ENABLE_HTML_EDITOR == 'No Editor' || HEADER_TAGS_ENABLE_EDITOR_META_DESC == 'false')
            $headertags_editor_str = tep_draw_textarea_field('categories_htc_description[' . $languages[$i]['id'] . ']', 'soft', 30, 5, '');
          else
          {
            if (HEADER_TAGS_ENABLE_HTML_EDITOR == 'FCKEditor') {
              $headertags_editor_str = tep_draw_fckeditor('categories_htc_description[' . $languages[$i]['id'] . ']', 600, 300, '');
            } else if (HEADER_TAGS_ENABLE_HTML_EDITOR == 'CKEditor') {
              $headertags_editor_str = tep_draw_textarea_field('categories_htc_description[' . $languages[$i]['id'] . ']', 'soft', 30, 5, '', 'id = "categories_htc_description[' . $languages[$i]['id'] . ']" class="ckeditor"');
            } else {
              $headertags_editor_str = tep_draw_textarea_field('categories_htc_description[' . $languages[$i]['id'] . ']', 'soft', 30, 5, '');
            }
          }

          $category_htc_description_string .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . $headertags_editor_str;
// eof: header tags seo /Step-15(18)\
        }

        $contents[] = array('text' => '<br>' . TEXT_CATEGORIES_NAME . $category_inputs_string);
// bof: activate inactivate category /Step-6(9)\
        $contents[] = array('text' => '<br>' . TEXT_DISPLAY . '&nbsp;' . tep_draw_radio_field('status_categ', 1, true) . '&nbsp;' . TEXT_YES . '&nbsp;' . tep_draw_radio_field('status_categ', 0, false) . '&nbsp;' . TEXT_NO);
// eof: activate inactivate category /Step-6(9)\
        $contents[] = array('text' => '<br>' . TEXT_CATEGORIES_IMAGE . '<br>' . tep_draw_file_field('categories_image'));
        $contents[] = array('text' => '<br>' . TEXT_SORT_ORDER . '<br>' . tep_draw_input_field('sort_order', '', 'size="2"'));
// bof: header tags seo /Step-16(18)\
        $contents[] = array('text' => '<br>' . 'Header Tags Category Title' . $category_htc_title_string);
        $contents[] = array('text' => '<br>' . 'Header Tags Category Description' . $category_htc_desc_string);
        $contents[] = array('text' => '<br>' . 'Header Tags Category Keywords' . $category_htc_keywords_string);
        $contents[] = array('text' => '<br>' . 'Header Tags Categories Description' . $category_htc_description_string);
// eof: header tags seo /Step-16(18)\
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_save.png', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
        break;
      case 'edit_category':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_CATEGORY . '</b>');

        $contents = array('form' => tep_draw_form('categories', FILENAME_CATEGORIES, 'action=update_category&cPath=' . $cPath, 'post', 'enctype="multipart/form-data"') . tep_draw_hidden_field('categories_id', $cInfo->categories_id));
        $contents[] = array('text' => TEXT_EDIT_INTRO);

        $category_inputs_string = '';
        $languages = tep_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $category_inputs_string .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_name[' . $languages[$i]['id'] . ']', tep_get_category_name($cInfo->categories_id, $languages[$i]['id']));
// bof: header tags seo /Step-17(18)\
          $category_htc_title_string .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_htc_title_tag[' . $languages[$i]['id'] . ']', tep_get_category_htc_title($cInfo->categories_id, $languages[$i]['id']));
          $category_htc_desc_string .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_htc_desc_tag[' . $languages[$i]['id'] . ']', tep_get_category_htc_desc($cInfo->categories_id, $languages[$i]['id']));
          $category_htc_keywords_string .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_htc_keywords_tag[' . $languages[$i]['id'] . ']', tep_get_category_htc_keywords($cInfo->categories_id, $languages[$i]['id']));
          if (HEADER_TAGS_ENABLE_HTML_EDITOR == 'No Editor' || HEADER_TAGS_ENABLE_EDITOR_META_DESC == 'false')
            $headertags_editor_str = tep_draw_textarea_field('categories_htc_description[' . $languages[$i]['id'] . ']', 'soft', 30, 5, tep_get_category_htc_description($cInfo->categories_id, $languages[$i]['id']));
          else
          {
            if (HEADER_TAGS_ENABLE_HTML_EDITOR == 'FCKEditor') {
              $headertags_editor_str = tep_draw_fckeditor('categories_htc_description[' . $languages[$i]['id'] . ']', 600, 300, tep_get_category_htc_description($cInfo->categories_id, $languages[$i]['id']));
            } else if (HEADER_TAGS_ENABLE_HTML_EDITOR == 'CKEditor') {
              $headertags_editor_str = tep_draw_textarea_field('categories_htc_description[' . $languages[$i]['id'] . ']', 'soft', 30, 5, tep_get_category_htc_description($cInfo->categories_id, $languages[$i]['id']), 'id = "categories_htc_description[' . $languages[$i]['id'] . ']" class="ckeditor"');
            } else {
              $headertags_editor_str = tep_draw_textarea_field('categories_htc_description[' . $languages[$i]['id'] . ']', 'soft', 30, 5, tep_get_category_htc_description($cInfo->categories_id, $languages[$i]['id']));
            }
          }

          $category_htc_description_string .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . $headertags_editor_str;
// eof: header tags seo /Step-17(18)\
        }

        $contents[] = array('text' => '<br>' . TEXT_EDIT_CATEGORIES_NAME . $category_inputs_string);
// bof: activate inactivate category /Step-7(9)\
        switch ($cInfo->status_categ) {
          case '0': $displayed = false; $hidden = true; break;
          case '1':
          default: $displayed = true; $hidden = false;
        }
        $contents[] = array('text' => '<br>' . TEXT_DISPLAY . '&nbsp;' . tep_draw_radio_field('status_categ', 1, $displayed) . '&nbsp;' . TEXT_YES . '&nbsp;' . tep_draw_radio_field('status_categ', 0, $hidden) . '&nbsp;' . TEXT_NO);
// eof: activate inactivate category /Step-7(9)\
        $contents[] = array('text' => '<br>' . tep_image(DIR_WS_CATALOG_IMAGES . $cInfo->categories_image, $cInfo->categories_name) . '<br>' . DIR_WS_CATALOG_IMAGES . '<br><b>' . $cInfo->categories_image . '</b>');
        $contents[] = array('text' => '<br>' . TEXT_EDIT_CATEGORIES_IMAGE . '<br>' . tep_draw_file_field('categories_image'));
        $contents[] = array('text' => '<br>' . TEXT_EDIT_SORT_ORDER . '<br>' . tep_draw_input_field('sort_order', $cInfo->sort_order, 'size="2"'));
// bof: header tags seo /Step-18(18)\
        $contents[] = array('text' => '<br>' . 'Header Tags Category Title' . $category_htc_title_string);
        $contents[] = array('text' => '<br>' . 'Header Tags Category Description' . $category_htc_desc_string);
        $contents[] = array('text' => '<br>' . 'Header Tags Category Keywords' . $category_htc_keywords_string);
        $contents[] = array('text' => '<br>' . 'Header Tags Categories Description' . $category_htc_description_string);
// eof: header tags seo /Step-18(18)\
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_save.png', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
        break;
      case 'delete_category':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_CATEGORY . '</b>');

        $contents = array('form' => tep_draw_form('categories', FILENAME_CATEGORIES, 'action=delete_category_confirm&cPath=' . $cPath) . tep_draw_hidden_field('categories_id', $cInfo->categories_id));
        $contents[] = array('text' => TEXT_DELETE_CATEGORY_INTRO);
        $contents[] = array('text' => '<br><b>' . $cInfo->categories_name . '</b>');
        if ($cInfo->childs_count > 0) $contents[] = array('text' => '<br>' . sprintf(TEXT_DELETE_WARNING_CHILDS, $cInfo->childs_count));
        if ($cInfo->products_count > 0) $contents[] = array('text' => '<br>' . sprintf(TEXT_DELETE_WARNING_PRODUCTS, $cInfo->products_count));
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.png', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
        break;
      case 'move_category':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_MOVE_CATEGORY . '</b>');

        $contents = array('form' => tep_draw_form('categories', FILENAME_CATEGORIES, 'action=move_category_confirm&cPath=' . $cPath) . tep_draw_hidden_field('categories_id', $cInfo->categories_id));
        $contents[] = array('text' => sprintf(TEXT_MOVE_CATEGORIES_INTRO, $cInfo->categories_name));
        $contents[] = array('text' => '<br>' . sprintf(TEXT_MOVE, $cInfo->categories_name) . '<br>' . tep_draw_pull_down_menu('move_to_category_id', tep_get_category_tree(), $current_category_id));
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_move.png', IMAGE_MOVE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
        break;
      case 'delete_product':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_PRODUCT . '</b>');

        $contents = array('form' => tep_draw_form('products', FILENAME_CATEGORIES, 'action=delete_product_confirm&cPath=' . $cPath) . tep_draw_hidden_field('products_id', $pInfo->products_id));
        $contents[] = array('text' => TEXT_DELETE_PRODUCT_INTRO);
        $contents[] = array('text' => '<br><b>' . $pInfo->products_name . '</b>');

        $product_categories_string = '';
        $product_categories = tep_generate_category_path($pInfo->products_id, 'product');
        for ($i = 0, $n = sizeof($product_categories); $i < $n; $i++) {
          $category_path = '';
          for ($j = 0, $k = sizeof($product_categories[$i]); $j < $k; $j++) {
            $category_path .= $product_categories[$i][$j]['text'] . '&nbsp;&gt;&nbsp;';
          }
          $category_path = substr($category_path, 0, -16);
          $product_categories_string .= tep_draw_checkbox_field('product_categories[]', $product_categories[$i][sizeof($product_categories[$i])-1]['id'], true) . '&nbsp;' . $category_path . '<br>';
        }
        $product_categories_string = substr($product_categories_string, 0, -4);

        $contents[] = array('text' => '<br>' . $product_categories_string);
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.png', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
        break;
      case 'move_product':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_MOVE_PRODUCT . '</b>');

        $contents = array('form' => tep_draw_form('products', FILENAME_CATEGORIES, 'action=move_product_confirm&cPath=' . $cPath) . tep_draw_hidden_field('products_id', $pInfo->products_id));
        $contents[] = array('text' => sprintf(TEXT_MOVE_PRODUCTS_INTRO, $pInfo->products_name));
        $contents[] = array('text' => '<br>' . TEXT_INFO_CURRENT_CATEGORIES . '<br><b>' . tep_output_generated_category_path($pInfo->products_id, 'product') . '</b>');
// bof: KategorienAdmin / OLISWISS
  if (is_array($admin_cat_access_array_cats) && (in_array("ALL",$admin_cat_access_array_cats)== false) && (pos($admin_cat_access_array_cats)!= "")) {
    $contents[] = array('text' => '<br>' . sprintf(TEXT_MOVE, $pInfo->products_name) . '<br>' . tep_draw_pull_down_menu('move_to_category_id', tep_get_category_tree('','','0','',$admin_cat_access_array_cats), $current_category_id));
  } else if (in_array("ALL",$admin_cat_access_array_cats)== true) { //nur Top-ADMIN
    $contents[] = array('text' => '<br>' . sprintf(TEXT_MOVE, $pInfo->products_name) . '<br>' . tep_draw_pull_down_menu('move_to_category_id', tep_get_category_tree(), $current_category_id));
  }
// eof: KategorienAdmin / OLISWISS
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_move.png', IMAGE_MOVE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
        break;
      case 'copy_to':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_COPY_TO . '</b>');

        $contents = array('form' => tep_draw_form('copy_to', FILENAME_CATEGORIES, 'action=copy_to_confirm&cPath=' . $cPath) . tep_draw_hidden_field('products_id', $pInfo->products_id));
        $contents[] = array('text' => TEXT_INFO_COPY_TO_INTRO);
        $contents[] = array('text' => '<br>' . TEXT_INFO_CURRENT_CATEGORIES . '<br><b>' . tep_output_generated_category_path($pInfo->products_id, 'product') . '</b>');
// bof: KategorienAdmin / OLISWISS
  if (is_array($admin_cat_access_array_cats) && (in_array("ALL",$admin_cat_access_array_cats)== false) && (pos($admin_cat_access_array_cats)!= "")) {
    $contents[] = array('text' => '<br>' . TEXT_CATEGORIES . '<br>' . tep_draw_pull_down_menu('categories_id', tep_get_category_tree('','','0','',$admin_cat_access_array_cats), $current_category_id));
  } else if (in_array("ALL",$admin_cat_access_array_cats)== true) { //nur Top-ADMIN
    $contents[] = array('text' => '<br>' . TEXT_CATEGORIES . '<br>' . tep_draw_pull_down_menu('categories_id', tep_get_category_tree(), $current_category_id));
  }
// eof: KategorienAdmin / OLISWISS
        $contents[] = array('text' => '<br>' . TEXT_HOW_TO_COPY . '<br>' . tep_draw_radio_field('copy_as', 'link', true) . ' ' . TEXT_COPY_AS_LINK . '<br>' . tep_draw_radio_field('copy_as', 'duplicate') . ' ' . TEXT_COPY_AS_DUPLICATE);
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_copy.png', IMAGE_COPY) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
        break;
// bof: Additional Images
      case 'new_images': 
      case 'update_images': 
      
        $upload_path = '';
        if (ADDIMAGES_PREFILL_UPLOAD_DIRECTORY == 'true') {
          $category_path_pieces_tmp = explode('&nbsp;&gt;&nbsp;',tep_output_generated_category_path($current_category_id));
		  $category_path_pieces = array();
		  for ($i=sizeof($category_path_pieces_tmp)-1; $i >= 0; $i--) {
			$category_path_pieces[] = tep_catname_to_dir($category_path_pieces_tmp[$i]);
		  }
          $upload_path = implode('/',$category_path_pieces);
        }
        $tmp = ADDIMAGES_PREFILL_INITIAL;
        if (!empty($tmp)) {
          if (!empty($upload_path)) { $upload_path = $tmp.'/'.$upload_path; }
          else { $upload_path = $tmp; }
        }
      
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_IMAGES . '</b>');   

        $contents = array('form' => tep_draw_form('new_images', FILENAME_CATEGORIES, 'action=' . ($action=='update_images'?'update_images':'add_images') . '&cPath=' . $cPath . '&pID=' . $HTTP_GET_VARS['pID'], 'post', 'enctype="multipart/form-data" onSubmit="return check_form_add(this);"') . tep_hide_session_id()); 
        $contents[] = array('text' => TEXT_NEW_IMAGES_INTRO);    
        if (ADDITIONAL_IMAGES_AUTO_CREATE == 'true') {  
          $contents[] = array('text' => '<br>' . TEXT_NEW_IMAGES_AUTO_ON_STATEMENT);      
        } else {
          $contents[] = array('text' => '<br>' . TEXT_NEW_IMAGES_AUTO_OFF_STATEMENT);      
          $contents[] = array('text' => '<br>' . '<table border="0" cellpadding="0" cellspacing="0"><tr><td class="infoBoxContent" valign="top">' . tep_draw_input_field('manual_thumb_generation', 'on', /* parameters */ 'onclick="if(this.checked==true){this.form.medium_images.disabled=true;this.form.popup_images.disabled=true;}else{this.form.medium_images.disabled=false;this.form.popup_images.disabled=false;}"', false, 'checkbox') . '</td><td class="infoBoxContent">' . TEXT_NEW_IMAGES_MANUALLY_GENERATE . '</td></tr></table>');      
        }
        $contents[] = array('text' => '<br>' . TEXT_PRODUCTS_IMAGE_UPLOAD_LOCATION . '<br>' . '<span style="font-family:Verdana;font-size:8px;">' . DIR_FS_CATALOG_IMAGES . '</span>' . '<br>' . tep_draw_input_field('image_subdirectory', $upload_path, 'size="30"') );
        
        $contents[] = array('text' => '<br>' . TEXT_PRODUCTS_IMAGES_NEW . '<br>' . tep_draw_file_field('thumb_images'));
        $contents[] = array('text' => '<br>' . TEXT_PRODUCTS_IMAGES_NEWMED . '<br>' . tep_draw_file_field('medium_images'));
        $contents[] = array('text' => '<br>' . TEXT_PRODUCTS_IMAGES_NEWPOP . '<br>' . tep_draw_file_field('popup_images') . 
                                      ((ADDITIONAL_IMAGES_AUTO_CREATE == 'true')?'<script type="text/javascript"> document.new_images.medium_images.disabled=true; document.new_images.popup_images.disabled=true; </script>':''));
        $contents[] = array('text' => '<br>' . TEXT_PRODUCTS_IMAGES_DESC . '<br>' . tep_draw_input_field('images_description')); 
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_save.png', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $HTTP_GET_VARS['pID']) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a><br><br>');    
        $contents[] = array('text' => TEXT_NEW_IMAGES_FOOTER);    
        break;
// eof: Additional Images
// os6tm banner manager
      case 'edit_banners':
      case 'add_banner':
      case 'delete_banner':
      	$heading[] = array('text' => TEXT_BANNERS_TO_CATEGORIES);
            $banners_query = tep_db_query("select b.banners_title, b.banners_image, b.banners_id from " . TABLE_BANNERS . " b, " . TABLE_BANNERS_TO_CATEGORIES . " btc where btc.categories_id = '" . $cInfo->categories_id . "' and btc.banners_id = b.banners_id");
            $string_banners = '';
            $selected_banners = array();
            while ($banner = tep_db_fetch_array($banners_query)) {
            	$string_banners .= $banner['banners_title'] . '<br>' . tep_image('../' . DIR_WS_IMAGES . $banner['banners_image'], $banner['banners_title'], 150, 40) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=delete_banner_confirm&cPath=' . $cPath . '&cID=' . $cID . '&banners_id=' . $banner['banners_id']) . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a><br><br>';
            	$selected_banners[] = $banner['banners_id'];
        	}
            $contents[] = array('text' => TEXT_BANNERS_CATEGORIES . tep_db_num_rows($banners_query) . '<br><br>' . $string_banners);
            $banners_query = tep_db_query("select banners_title as text, banners_id as id from " . TABLE_BANNERS);
            while ($banners = tep_db_fetch_array($banners_query)) {
            	$key = array_search($banners['id'],$selected_banners);
            	if (!is_integer($key)) {
            		$banners_array[] = $banners;
            	}
            }
            $contents[] = array('text' => tep_draw_form('banners_form', FILENAME_CATEGORIES, 'cPath=' . $cPath . '&action=add_banner&cID=' . $cID));
		if (sizeof($banners_array) > 0) {
		    $contents[] = array('text' => tep_draw_pull_down_menu('banners_id',$banners_array) . '<br><br><center>' . tep_image_submit('button_add_banner.png', IMAGE_ADD_BANNER) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a></center>');
		    $contents[] = array('text' => '</form>');
	    } else {
	    	    $contents[] = array('align' => 'center', 'text' => ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
	    	}
      break;
      //added for os6tm banner manager
      case 'delete_banner_confirm':
        $banner_query = tep_db_query("select banners_title, banners_image from " . TABLE_BANNERS . " where banners_id = '" . $banners_id . "'");
        $banner = tep_db_fetch_array($banner_query);
      	$heading[] = array('text' => TEXT_DELETE_BANNER_CONFIRM_HEADING);
      	$contents[] = array('text' => TEXT_DELETE_BANNER_CONFIRM . '<br><br>');
      	$contents[] = array('text' => $banner['banners_title'] . '<br>' . tep_image('../' . DIR_WS_IMAGES . $banner['banners_image'], $banner['banners_title'], 150, 40) . '<br><br>');
      	$contents[] = array('text' => '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=delete_banner&cPath=' . $cPath . '&cID=' . $cID . '&banners_id=' . $banners_id) . '">' . tep_image_button('button_confirm.png', IMAGE_CONFIRM) . '</a> ' . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=edit_banners&cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
      break;
// os6tm banner manager_eof
      default:
        if ($rows > 0) {
          if (isset($cInfo) && is_object($cInfo)) { // category info box contents
            $category_path_string = '';
            $category_path = tep_generate_category_path($cInfo->categories_id);
            for ($i=(sizeof($category_path[0])-1); $i>0; $i--) {
              $category_path_string .= $category_path[0][$i]['id'] . '_';
            }
            $category_path_string = substr($category_path_string, 0, -1);
// bof: activate inactivate category /Step-8(9)\
            $parent_hidden = false;
            if (tep_not_null($category_path_string)) {
              $parents = explode('_', $category_path_string);
              foreach ($parents as $p) {
                $query = tep_db_query("select status_categ from " . TABLE_CATEGORIES . " where categories_id = " . (int)$p);
                $check = tep_db_fetch_array($query);
                if ($check['status_categ'] == 0) $parent_hidden = true;
              }
			}
// eof: activate inactivate category /Step-8(9)\
            $heading[] = array('text' => '<b>' . $cInfo->categories_name . '</b>');

// bof: KategorienAdmin / OLISWISS
            //$contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&cID=' . $cInfo->categories_id . '&action=edit_category') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&cID=' . $cInfo->categories_id . '&action=delete_category') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&cID=' . $cInfo->categories_id . '&action=move_category') . '">' . tep_image_button('button_move.gif', IMAGE_MOVE) . '</a>');
	    if ($admin_groups_id == 1) {
              $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id . '&action=edit_category') . '">' . tep_image_button('button_edit.png', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id . '&action=delete_category') . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id . '&action=move_category') . '">' . tep_image_button('button_move.png', IMAGE_MOVE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id . '&action=edit_banners') . '">' . tep_image_button('button_manage_banners.png', IMAGE_MANAGE_BANNERS) . '</a>');
	    } else {
	      if (strstr($admin_right_access,"CEDIT")) {  
	        $c_right_string .= ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id . '&action=edit_category') . '">' . tep_image_button('button_edit.png', IMAGE_EDIT) . '</a>';
	      }
	      if (strstr($admin_right_access,"CDELETE")) {
	      	$c_right_string .= ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id . '&action=delete_category') . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a>';
	      }
	      if (strstr($admin_right_access,"CMOVE")) {
	        $c_right_string .= ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id . '&action=move_category') . '">' . tep_image_button('button_move.png', IMAGE_MOVE) . '</a>';
	      }
	    $contents[] = array('align' => 'center', 'text' => $c_right_string);
	    }
// eof: KategorienAdmin / OLISWISS 
            $contents[] = array('text' => '<br>' . TEXT_DATE_ADDED . ' ' . tep_date_short($cInfo->date_added));
            if (tep_not_null($cInfo->last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . tep_date_short($cInfo->last_modified));
            $contents[] = array('text' => '<br>' . tep_info_image($cInfo->categories_image, $cInfo->categories_name, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT) . '<br>' . $cInfo->categories_image);
// bof: activate inactivate category /Step-9(9)\
            if ($parent_hidden) {
              $display = TEXT_PARENT_HIDDEN;
            } elseif ($cInfo->status_categ == 0) {
              $display = TEXT_NO;
            } else {
              $display = TEXT_YES;
            }
            $contents[] = array('text' => '<br>' . TEXT_DISPLAY . ' ' . $display);
// eof: activate inactivate category /Step-9(9)\
            $contents[] = array('text' => '<br>' . TEXT_SUBCATEGORIES . ' ' . $cInfo->childs_count . '<br>' . TEXT_PRODUCTS . ' ' . $cInfo->products_count);
// os6tm banner manager
            $banners_query = tep_db_query("select b.banners_title from " . TABLE_BANNERS . " b, " . TABLE_BANNERS_TO_CATEGORIES . " btc where btc.categories_id = '" . $cInfo->categories_id . "' and btc.banners_id = b.banners_id");
            $string_banners = '<ul>';
            while ($banner = tep_db_fetch_array($banners_query)) {
            	$string_banners .= '<li>' . $banner['banners_title'] . '</li>';
        }
            $string_banners .= '</ul>';
            $contents[] = array('text' => TEXT_BANNERS_CATEGORIES . tep_db_num_rows($banners_query) . '<br>' . $string_banners);
// os6tm banner manager
          } elseif (isset($pInfo) && is_object($pInfo)) { // product info box contents
            $heading[] = array('text' => '<b>' . tep_get_products_name($pInfo->products_id, $languages_id) . '</b>');

// bof: KategorienAdmin / OLISWISS
            //$contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=new_product') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=delete_product') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=move_product') . '">' . tep_image_button('button_move.gif', IMAGE_MOVE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=copy_to') . '">' . tep_image_button('button_copy_to.gif', IMAGE_COPY_TO) . '</a>');
	    if ($admin_groups_id == 1) {
              $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=new_product') . '">' . tep_image_button('button_edit.png', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=delete_product') . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=move_product') . '">' . tep_image_button('button_move.png', IMAGE_MOVE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=copy_to') . '">' . tep_image_button('button_copy_to.png', IMAGE_COPY_TO) . '</a> <a href="' . tep_href_link(FILENAME_RELATED_PRODUCTS, 'products_id_view=' . $pInfo->products_id) . '">' . tep_image_button('button_related_products.png', IMAGE_RELATED_PRODUCTS) . ' <a href="' . 				tep_href_link("stock.php", 'product_id=' . $pInfo->products_id) . '">' . tep_image_button('button_stock.png', IMAGE_STOCK) . '<a target="_blank" href="' . HTTP_CATALOG_SERVER . DIR_WS_CATALOG . 'product_info.php?products_id=' . $pInfo->products_id . '">' . tep_image_button('button_preview.png', IMAGE_PREVIEW) . '</a>');
	    } else {
	      if (strstr($admin_right_access,"PEDIT")) {  
	        $p_right_string .= ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=new_product') . '">' . tep_image_button('button_edit.png', IMAGE_EDIT) . '</a>';
	      }
	      if (strstr($admin_right_access,"PDELETE")) {
	      	$p_right_string .= ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=delete_product') . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a>';
	      }
	      if (strstr($admin_right_access,"PMOVE")) {
	        $p_right_string .= ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=move_product') . '">' . tep_image_button('button_move.png', IMAGE_MOVE) . '</a>';
	      }
	      if (strstr($admin_right_access,"PCOPY")) {
	        $p_right_string .= ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=copy_to') . '">' . tep_image_button('button_copy_to.png', IMAGE_COPY_TO) . '</a>';
	      }
	    $contents[] = array('align' => 'center', 'text' => $p_right_string);
	    }
// eof: KategorienAdmin / OLISWISS
            $contents[] = array('text' => '<br>' . TEXT_DATE_ADDED . ' ' . tep_date_short($pInfo->products_date_added));
            if (tep_not_null($pInfo->products_last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . tep_date_short($pInfo->products_last_modified));
            if (date('Y-m-d') < $pInfo->products_date_available) $contents[] = array('text' => TEXT_DATE_AVAILABLE . ' ' . tep_date_short($pInfo->products_date_available));
            $contents[] = array('text' => '<br>' . tep_info_image($pInfo->products_image, $pInfo->products_name, ADMIN_DEFAULT_IMAGE_WIDTH, ADMIN_DEFAULT_IMAGE_HEIGHT) . '<br>' . $pInfo->products_image);
            $contents[] = array('text' => '<br>' . TEXT_PRODUCTS_PRICE_INFO . ' ' . $currencies->format($pInfo->products_price) . '<br>' . TEXT_PRODUCTS_QUANTITY_INFO . ' ' . $pInfo->products_quantity);
            $contents[] = array('text' => '<br>' . TEXT_PRODUCTS_AVERAGE_RATING . ' ' . number_format($pInfo->average_rating, 2) . '%');
// bof: qpbpp for sppc /step-20(23)\
            $retail_price = $pInfo->products_price;
            unset($pInfo->products_price);
            $pInfo->products_price[0] = $retail_price;
            $retail_products_qty_blocks = $pInfo->products_qty_blocks;
            unset($pInfo->products_qty_blocks);
            $pInfo->products_qty_blocks[0] = $retail_products_qty_blocks;
            $retail_products_min_order_qty = $pInfo->products_min_order_qty;
            unset($pInfo->products_min_order_qty);
            $pInfo->products_min_order_qty[0] = $retail_products_min_order_qty;
// query the customer groups together with discount categories first, then products_groups 
// for group prices, quantity blocks and min order quantities and lastly for price breaks.
// the first query needs minimum MySQL version to be 4.1 (release date february 2003...)
            $customer_groups_dc_query = tep_db_query("select cg.customers_group_id, cg.customers_group_name, dc.discount_categories_name from " . TABLE_CUSTOMERS_GROUPS . " cg left join (select customers_group_id, discount_categories_id from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " ptdc where ptdc.products_id = '" . $pInfo->products_id. "') as p2dc on p2dc.customers_group_id = cg.customers_group_id left join " . TABLE_DISCOUNT_CATEGORIES . " dc on p2dc.discount_categories_id = dc.discount_categories_id order by customers_group_id"); 
            while ($customer_groups_dc_results =  tep_db_fetch_array($customer_groups_dc_query)) {
              $customer_groups[$customer_groups_dc_results['customers_group_id']] = $customer_groups_dc_results['customers_group_name'];
              $discount_categories[$customer_groups_dc_results['customers_group_id']] = $customer_groups_dc_results['discount_categories_name'];
            }
            if (count($customer_groups) > 1) {
              $cg_group_price_query = tep_db_query("select customers_group_id, customers_group_price, products_qty_blocks, products_min_order_qty from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . $pInfo->products_id. "'");
              while ($cg_group_price_results = tep_db_fetch_array($cg_group_price_query)) {
                $pInfo->products_price[$cg_group_price_results['customers_group_id']] = $cg_group_price_results['customers_group_price'];
                $pInfo->products_qty_blocks[$cg_group_price_results['customers_group_id']] = $cg_group_price_results['products_qty_blocks'];
                $pInfo->products_min_order_qty[$cg_group_price_results['customers_group_id']] = $cg_group_price_results['products_min_order_qty'];
              }
            } // end if (count($customer_groups) > 1)
            $price_break_query = tep_db_query("select customers_group_id, products_price, products_qty from " . TABLE_PRODUCTS_PRICE_BREAK . " where products_id = '" . $pInfo->products_id. "' order by customers_group_id, products_qty");
            while ($price_break_results = tep_db_fetch_array($price_break_query)) {
              $price_breaks[$price_break_results['customers_group_id']][] = $price_break_results;
            }
            foreach ($customer_groups as $cg_id => $cg_name) {
              $price_break_info = TEXT_PRICE_BREAK_INFO;
              if (isset($price_breaks[$cg_id])) {
                foreach ($price_breaks[$cg_id] as $key => $price_break) {
                  $price_break_info .= $currencies->format($price_break['products_price']) . ' (' . $price_break['products_qty'] . ') <b>::</b> ';
                }
                $price_break_info = substr($price_break_info, 0, -10);
              }
              $contents[] = array('text' => '<p class="infoBoxHeading" style="font-weight:bold;">&nbsp;' . $cg_name . '</p><p>' . TEXT_PRODUCTS_PRICE_INFO . ' ' . (isset($pInfo->products_price[$cg_id]) ? $currencies->format($pInfo->products_price[$cg_id]) : " - ") . '<br>' . TEXT_PRODUCTS_QTY_BLOCKS . ' ' . (isset($pInfo->products_qty_blocks[$cg_id]) ? $pInfo->products_qty_blocks[$cg_id] : "1") . '<br>' . TEXT_PRODUCTS_MIN_ORDER_QTY . ' ' . (isset($pInfo->products_min_order_qty[$cg_id]) ? $pInfo->products_min_order_qty[$cg_id] : "1") . '<br>'. TEXT_DISCOUNT_CATEGORY . ' ' . (isset($discount_categories[$cg_id]) ? $discount_categories[$cg_id] : TEXT_NONE) . '<br>' . $price_break_info . '</p>');            
            }
// eof: qpbpp for sppc /step-20(23)\
// bof: Additional Images
            $contents[] = array('text' => '<br><b>' . TEXT_INFO_HEADING_NEW_IMAGES . '</b>');
            $contents[] = array('text' => '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=new_images') . '">' . tep_image_button('button_images_add.png', IMAGE_ADDITIONAL_NEW) . '</a><br><hr>');

            $images_product = tep_db_query("SELECT additional_images_id, medium_images, popup_images, thumb_images, images_description FROM " . TABLE_ADDITIONAL_IMAGES . " where products_id = '" . $pInfo->products_id . "'");
            if (!tep_db_num_rows($images_product)) {
              $contents[] = array('align' => 'center', 'text' => '<font color="red">'.ERROR_NO_ADDITIONAL_IMAGES.'</font><hr>');
            } else {
              while ($new_images = tep_db_fetch_array($images_product)) {
               $contents[] = array('text' => '&nbsp;' . (!empty($new_images['images_description'])?$new_images['images_description'] . '<br>&nbsp;':'') . tep_image(DIR_WS_CATALOG_IMAGES  . (!empty($new_images['thumb_images'])?$new_images['thumb_images']:($new_images['medium_images']?$new_images['medium_images']:$new_images['popup_images'])), $new_images['images_description'], (ADDIMAGES_RESTRICT_IMAGE_SIZE=='true'?SMALL_IMAGE_WIDTH:''), (ADDIMAGES_RESTRICT_IMAGE_SIZE=='true'?SMALL_IMAGE_HEIGHT:''), 'align="absmiddle"') . '<br>' . 
                                             tep_draw_form('delete_images', FILENAME_CATEGORIES, 'action=del_images&cPath=' . $cPath . '&pID=' . $HTTP_GET_VARS['pID']) .
                                             tep_draw_hidden_field('additional_images_id[]', $new_images['additional_images_id']) .  
                                             '<br>' . '&nbsp;' . tep_image_submit('button_images_del.png', IMAGE_ADDITIONAL_DEL) . '</form><br>&nbsp;<hr>');  
               }
            }
            $contents[] = array('align' => 'center', 'text' => '<br><br>');
// eof: Additional Images
          }
        } else { // create category/product info
          $heading[] = array('text' => '<b>' . EMPTY_CATEGORY . '</b>');

          $contents[] = array('text' => TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS);
        }
        break;
    }

    if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
      echo '            <td width="25%" valign="top">' . "\n";

      $box = new box;
      echo $box->infoBox($heading, $contents);

      echo '            </td>' . "\n";
    }
?>
          </tr>
        </table></td>
      </tr>
    </table>
<?php
  }
?>
<!------------------------------->
<!--- CAREGORIES VIEW ::END:: --->
<!------------------------------->
<!-- body_text_eof //-->
    </td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
