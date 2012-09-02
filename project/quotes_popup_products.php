<?php
/*
  $Id: header_tags_seo_popup_help.php,v 1.0 2009/03/13 13:45:11 devosc Exp $
  produced by Jack_mcs
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
 
  require("includes/application_top.php");

  $quotes = (defined('QUOTES_CATEGORY_NAME')) ? " and p.quotes_email_address = '' " : '';
  $products_query = tep_db_query("select pd.products_name, p.products_id from " . TABLE_PRODUCTS . " p inner join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id where language_id = " . (int)$languages_id . $quotes);

  $productsArray = array();
  $ctr = 0;
  $js = 'var products = new Array();';
  while ($products = tep_db_fetch_array($products_query))
  {
      $productsArray[] = array('id' => $ctr, 'text' => $products['products_name']);
      $js .= ' products[' . $ctr . '] = "' . $products['products_name'] . '";' . "\n";
      $ctr++;
  }
  $productCnt = tep_db_num_rows($products_query);
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
<SCRIPT LANGUAGE="JavaScript">
function sendValue(s){
var selvalue = s.options[s.selectedIndex].value;
<?php echo $js; ?>; //creates the products array
 for (var i = 0; i < <?php echo $productCnt; ?>; ++i)
 {
    if (i == selvalue)
    {
       var prev_content = window.opener.document.request_quote.message.value;
       window.opener.document.request_quote.message.value = prev_content + "\n\nProduct: " + products[i] + " ( " + selvalue + " )";
       window.close();
    }
 }
 window.close();
}
</script>
</HEAD>
<BODY>
<center>
<form name=selectform>
<p class="main"><?php echo tep_draw_pull_down_menu('selectmenu', $productsArray); ?></p>
<p><input type=button value="Item Select Item" onClick="sendValue(this.form.selectmenu);"></p>
</form>
</body>