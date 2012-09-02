<?php //$Id: /catalog/admin/quotes.php (6675)
 
  require('includes/application_top.php');
  require('includes/functions/' . FILENAME_QUOTES);
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_QUOTES);
  
  /********************** BEGIN VERSION CHECKER *********************/
  if (file_exists(DIR_WS_FUNCTIONS . 'version_checker.php'))
  {
  require(DIR_WS_LANGUAGES . $language . '/version_checker.php');
  require(DIR_WS_FUNCTIONS . 'version_checker.php');
  $contribPath = 'http://addons.oscommerce.com/info/6675';
  $currentVersion = 'Quotes V 1.2';
  $contribName = 'Quotes V'; 
  $versionStatus = '';
  }
  /********************** END VERSION CHECKER *********************/  

  $action  = (isset($HTTP_POST_VARS['action']) ? $HTTP_POST_VARS['action'] : '');
  $quote_response = '';


  if (tep_not_null($action)) 
  {  
    /********************** CHECK THE VERSION ***********************/
    if (isset($_POST['action']) && $_POST['action'] == 'getversion')
    {
      if (isset($_POST['version_check']) && $_POST['version_check'] == 'on')
        $versionStatus = AnnounceVersion($contribPath, $currentVersion, $contribName);
    }
      
    else if (isset($_POST['delete']) && $_POST['delete'] > 0)
    {
       $products_query = tep_db_query("select products_id from " . TABLE_PRODUCTS . " where quotes_id = '" . (int)$_POST['delete'] . "' LIMIT 1");
       $products = tep_db_fetch_array($products_query);
       
       tep_db_query("delete from " . TABLE_QUOTES . " where quote_id = '" . (int)$_POST['delete'] . "'");
       tep_db_query("delete from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$products['products_id'] . "'");
       tep_db_query("delete from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products['products_id'] . "'");

       $languages = tep_get_languages();
       for ($i = 0; $i < count($languages); ++$i) 
       {
          tep_db_query("delete from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$products['products_id'] . "' and language_id = " . $languages[$i]['id']);
       }
    }
    
    else if (isset($_POST['send_email']) && substr($_POST['send_email'], "quote_") !== FALSE)
    {
       $customer_query = tep_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_email_address LIKE '" . $_POST['email_address'] . "'");
       $customer = tep_db_fetch_array($customer_query);
       $to = $customer['customers_firstname'] . ' ' . $customer['customers_lastname'];
       $to_email_address = $_POST['email_address'];
       $subject = TEXT_QUOTE_READY;
       $body = sprintf(TEXT_GREETING, $to) . "\n\n" . sprintf(TEXT_QUOTE_MESSAGE, HTTP_SERVER . DIR_WS_CATALOG . '/quotes.php') ."\n";
       $from = STORE_OWNER;
       $from_email_address = STORE_OWNER_EMAIL_ADDRESS;
         
       tep_mail($to, $to_email_address, $subject, $body, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

       $quoteID = substr($_POST['send_email'], strlen("quote_"));
       tep_db_query("update " . TABLE_QUOTES . " set quote_notified = 1 where quote_id = " . $quoteID);
    }              
  }
   
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<style type="text/css">
td.HTC_Head {font-family: Verdana, Arial, sans-serif; color: sienna; font-size: 18px; font-weight: bold; } 
</style>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
     <tr>
      <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
       <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
         <tr>
          <td class="HTC_Head" valign="top" style="white-space:nowrap;"><?php echo $currentVersion; ?></td>
         </tr>
         <tr>
          <td class="smallText" valign="top"><?php echo HEADING_TITLE_SUPPORT_THREAD; ?></td>
         </tr>
        </table></td>    
            
        
        <td><table border="0" width="100%">
         <tr>       
          <td class="smallText" align="right"><?php echo HEADING_TITLE_AUTHOR; ?></td>
         </tr>
         <?php  
         if (function_exists('AnnounceVersion')) {
          if (QUOTES_VERSION_CHECKER == 'true') { 
         ?>
         <tr>
          <td class="smallText" align="right" style="font-weight: bold; color: red;"><?php echo AnnounceVersion($contribPath, $currentVersion, $contribName); ?></td>
         </tr>
         <?php } else if (tep_not_null($versionStatus)) { 
           echo '<tr><td class="smallText" align="right" style="font-weight: bold; color: red;">' . $versionStatus . '</td></tr>';
         } else {
           echo tep_draw_form('version_check', FILENAME_QUOTES, '', 'post') . tep_draw_hidden_field('action', 'getversion'); 
         ?>
         <tr>
          <td class="smallText" align="right" style="font-weight: bold; color: red;"><INPUT TYPE="radio" NAME="version_check" onClick="this.form.submit();"><?php echo TEXT_VERSION_CHECK_UPDATES; ?></td>
         </tr>
         </form>
         <?php } } else { ?>
            <tr>
               <td class="smallText" align="right" style="font-weight: bold; color: red;"><?php echo TEXT_MISSING_VERSION_CHECKER; ?></td>
            </tr>
         <?php } ?>
        </table></td>
       </tr>  
      </table></td>  
     </tr>
     <tr>
      <td colspan="5"><?php echo tep_black_line(); ?></td>
     </tr>     
     
     <!-- Begin of Quotes -->
     <tr>
      <td align="right"><?php echo tep_draw_form('quotes', FILENAME_QUOTES, '', 'post') . tep_draw_hidden_field('action', 'process'); ?></td>
       <tr>
        <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
         <tr>
          <td><table border="0" width="100%">
           
           <?php $quotes_query = tep_db_query("select * from " . TABLE_QUOTES); 
           echo tep_draw_hidden_field('ttl_quotes', tep_db_num_rows($quotes_query));
           while ($quotes = tep_db_fetch_array($quotes_query)) {
           ?>
           <tr class="smallText">
            <td><?php echo TEXT_NAME; ?></td>
            <td valign="top"><?php echo $quotes['customers_name']; ?></td>
           </tr> 
           <tr class="smallText">            
            <td><?php echo TEXT_EMAIL; ?></td>
            <td valign="top"><?php echo $quotes['quote_email_address']; ?></td>
           </tr> 
           <tr class="smallText">            
            <td><?php echo TEXT_SUBMITTED_ON; ?></td>
            <td valign="top"><?php echo $quotes['date_submitted']; ?></td>
           <tr> 
           <tr class="smallText">            
            <td><?php echo TEXT_REQUEST; ?></td>
            <td valign="top"><?php echo $quotes['quote_request']; ?></td>
           </tr> 
           
           <tr class="smallText">            
            <td><?php echo TEXT_ADD_PRODUCT_QUOTE; ?></td>
            <?php 
            $languages = tep_get_languages();
            ?>
            <td><table border="0" cellpadding="0">
             <tr class="smallText"> 
            <?php
             $noCat = true;
             $noQuote = true;
             for ($i = 0; $i < count($languages); ++$i) {
               $catID = tep_get_category_id(QUOTES_CATEGORY_NAME, $languages[$i]['id']); 
               if ($catID > 0) {
                 $noCat = false;
                 $products_query = tep_db_query("select p.products_id from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id where p.quotes_id = '" . $quotes['quote_id'] . "' and p.quotes_email_address LIKE '" . $quotes['quote_email_address'] . "' and pd.language_id = '" . $languages[$i]['id'] . "' LIMIT 1");
                 $products = tep_db_fetch_array($products_query);
                 if ($products['products_id'] > 0) { 
                   $noQuote = false;
            ?>
               <td class="smallText" width="80"><a href="<?php echo tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $catID . '&pID=' . $products['products_id'] . '&action=new_product'); ?>"><?php echo TEXT_EDIT .  $languages[$i]['name']; ?></a></td>
            <?php } else { ?>   
               <td class="smallText" width="80"><a href="<?php echo tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $catID . '&action=new_product&quote_email_address=' . $quotes['quote_email_address'] . '&quote_id='.$quotes['quote_id']); ?>"><?php echo TEXT_NEW . $languages[$i]['name']; ?></a></td>
            <?php } } } if ($noCat) { ?>
              <td class="smallText" width="180"><a href="<?php echo tep_href_link(FILENAME_CATEGORIES, 'cPath=&action=new_category'); ?>"><?php echo TEXT_NEW_CAT . $languages[$i]['name']; ?></a></td>
            <?php } ?>
             </tr>
            </table></td> 
           </tr> 
                   
           <?php
           $noProduct = true;
           $product_check_query = tep_db_query("select p.quotes_expire, p.products_quantity as qty from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on pd.products_id = p.products_id where p.quotes_id = '" . $quotes['quote_id'] . "' LIMIT 1");
           if (tep_db_num_rows($product_check_query) > 0)
           {
             $noProduct = false;
             $product_check = tep_db_fetch_array($product_check_query);
             $expired = tep_not_null($product_check['quotes_expire']) ? $product_check['quotes_expire'] < date('Y-m-d') ? true : false : false;
           }
           ?>
           <tr>            
            <td class="smallText"><?php echo TEXT_QUOTE_STATUS; ?></td>
            <td><table border="0" cellpadding="0">
             <tr> 
              <td class="smallText" align="center"><?php echo (! $expired ? ($noProduct ?  TEXT_QUOTES_NEW : ($product_check['qty'] ? TEXT_QUOTES_ACTIVE : TEXT_QUOTES_PAID)) : TEXT_QUOTES_EXPIRED); ?></td>
             </tr>
            </table></td> 
           </tr>           
              
           <tr class="smallText">            
            <td><?php echo TEXT_NOTIFICATION; ?></td>
            <td><table border="0" cellpadding="0" cellspacing="0">
             <tr class="smallText"> 
              <td><?php echo TEXT_NOTIFIED; ?></td>
              <td><input type="checkbox" name="notified" <?php echo ($quotes['quote_notified'] ? 'checked' : ''); ?> disabled></td>
              <td width="90" align="right"><?php echo TEXT_NOTIFY_CUSTOMER . tep_draw_hidden_field('quote_id', $quotes['quote_id']) . tep_draw_hidden_field('email_address', $quotes['quote_email_address']); ?></td>
              <td class="smallText" width="100"><INPUT TYPE="radio" NAME="send_email" value="<?php echo 'quote_' . $quotes['quote_id']; ?>" <?php echo ($noProduct ? 'disabled' : ''); ?> onClick="this.form.submit();"></td>
             </tr>
            </table></td> 
           </tr> 
                                 
           <tr class="smallText">            
            <td><table border="0" cellpadding="0">
             <tr> 
               <td class="smallText" width="40"><?php echo tep_image_submit('button_delete.gif', IMAGE_DELETE, 'name="delete" value="' . $quotes['quote_id'] . '"'); ?></a></td>
             </tr>
            </table></td> 
           </tr>            
           
           <tr>
            <td colspan="4"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
           </tr>           
           <tr>
            <td colspan="5"><?php echo tep_black_line(); ?></td>
           </tr>
           <tr>
            <td colspan="5"><?php echo tep_draw_separator('pixel_black.gif', '100%', '2'); ?></td>
           </tr>                     
           <?php } ?>
          </table></td>
         </tr> 
    
      </form>
      </table></td>
     </tr>
     <!-- end of Quotes -->  
	 
    </table></td>
<!-- body_text_eof //-->
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
