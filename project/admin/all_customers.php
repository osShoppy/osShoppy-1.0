<?php
/*
  $Id: all_customers.php, v1.0 March 21, 2005 18:45:00
  adapted by Robert Goth June 24, 2005

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com
  Copyright (c) 2002 - 2004 osCommerce

  written by Jared Call at client' suggestion
  some code nicked and modified from /catalog/admin/customers.php
  Released under the GNU General Public License
*/

// entry for bouncing csv string back as file
// Turn on output buffering

ob_start();
if (isset($_POST['csv'])) {
  if (isset($HTTP_POST_VARS['saveas'])) {  // rebound posted csv as save file
		$savename= $HTTP_POST_VARS['saveas'] . ".csv";
	}
	else $savename='unknown.csv';

  $csv_string = '';
  if ($HTTP_POST_VARS['csv']) $csv_string=$HTTP_POST_VARS['csv']; 
  
  if (strlen($csv_string)>0) {
    header("Expires: Mon, 26 Nov 1962 00:00:00 GMT");
    header("Last-Modified: " . gmdate('D,d M Y H:i:s') . ' GMT');
    header("Cache-Control: no-cache, must-revalidate");
    header("Pragma: no-cache");
    header("Content-Type: text/csv");
    header("Content-Disposition: attachment; filename=$savename");
    echo html_entity_decode(stripslashes($csv_string), ENT_QUOTES);
  }
  else echo "CSV string empty";

  exit;
};


 

require('includes/application_top.php');

?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE_ALL_CUSTOMERS; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <?php
      $where = '';
      $nsChecked = array();
      if (isset($_GET['group_newsletter'])) {
        switch ($_GET['group_newsletter'])
        {
          case 'Newsletter_On': $where = ' c.customers_newsletter = 1 ';
                                $nsChecked['on'] = 'checked'; 
                                break;
          case 'Newsletter_Off': $where = ' c.customers_newsletter != 1 '; 
                                $nsChecked['off'] = 'checked'; 
                                break;
          default: $where = '';
                   $nsChecked['both'] = 'checked'; 
        }  
      }
      else
        $nsChecked['both'] = 'checked'; 
        
      if (tep_not_null($where))
       $where = ' where ' . $where;
         
      $datePeriod = '';  
      if (isset($_GET['date_start']) && tep_not_null($_GET['date_start'])) {
        if (isset($_GET['date_stop']) && tep_not_null($_GET['date_stop'])) {
          $start = sprintf("'%s-%s-%s 0:0:0'", substr($_GET['date_start'], 4), substr($_GET['date_start'], 0, 2), substr($_GET['date_start'], 2, 2));
          $stop = sprintf("'%s-%s-%s 0:0:0'", substr($_GET['date_stop'], 4), substr($_GET['date_stop'], 0, 2), substr($_GET['date_stop'], 2, 2));
          $datePeriod = ' ci.customers_info_date_account_created between ' . $start . ' and '.$stop . ' '; 
        }    
      }
      if (tep_not_null($datePeriod))
      {
        if (tep_not_null($where))
          $where .= ' and ' . $datePeriod;
        else
          $where = ' where ' . $datePeriod;
      }
        
      $today = date("mdY");         
      ?>
      <?php echo tep_draw_form('news_date', FILENAME_ALL_CUSTOMERS, '', 'get') . tep_draw_hidden_field('process_form', 'process_form') . tep_hide_session_id(); ?>
      <tr>
        <td><table border="0" width="60%" cellspacing="0" cellpadding="0">
          <tr class="smallText">
            <td><?php echo ENTRY_GROUP_NEWSLETTER; ?></td>
            <td><INPUT TYPE="radio" NAME="group_newsletter" VALUE="Newsletter_On" <?php echo $nsChecked['on']; ?> ><?php echo TEXT_NEWSLETTER_SUBSCRIBED; ?></td>
            <td><INPUT TYPE="radio" NAME="group_newsletter" VALUE="Newsletter_Off" <?php echo $nsChecked['off']; ?> ><?php echo TEXT_NEWSLETTER_UNSUBSCRIBED; ?></td>
            <td><INPUT TYPE="radio" NAME="group_newsletter" VALUE="All" <?php echo $nsChecked['both']; ?> ><?php echo TEXT_NEWSLETTER_BOTH; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>      
      <tr>
        <td><table border="0" width="60%" cellspacing="0" cellpadding="0">
          <tr class="smallText">
            <td width="80"><?php echo ENTRY_DATE_START; ?></td>
            <td><?php echo tep_draw_input_field('date_start', '', 'maxlength="8" size="8"', false); ?> </td>
            <td width="80" align="center"><?php echo ENTRY_DATE_STOP; ?></td>
            <td><?php echo tep_draw_input_field('date_stop', $today, 'maxlength="8" size="8"', false); ?> </td>
            <td><?php echo TEXT_EXPLAIN_DATE; ?></td>
          </tr>
          <tr>
           <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>      
          <tr>
            <td><input type="submit"></td>
          </tr>  
        </table></td>
      </tr>
      </form>      
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
<?php  
// Used to determine sorting order by field
  switch ($orderby) {

   case "email" :
   $db_orderby = "c.customers_email_address";
   break;
   
   case "newsletter" :
   $db_orderby = "c.customers_newsletter";
   break;

   case "address":
 	 $db_orderby = "a.entry_street_address";
 	 break;
 
 	 case "city":
 	 $db_orderby = "a.entry_city";
 	 break;
 
 	 case "state":
 	 $db_orderby = "z.zone_code";
 	 break;
 
 	 case "country":
 	 $db_orderby = "co.countries_name";
 	 break;
 
 	 case "telephone":
 	 $db_orderby = "c.customers_telephone";
 	 break;
 
 	 case "pcode":
 	 $db_orderby = "a.entry_postcode";
 	 break;
 
   default :
   $db_orderby = "a.entry_lastname";;
   break;
  }

  $customers_query_raw = "SELECT c.customers_id , c.customers_default_address_id, c.customers_email_address, c.customers_newsletter, c.customers_fax, c.customers_telephone, c.customers_gender, a.entry_company, a.address_book_id, a.customers_id, a.entry_firstname, a.entry_lastname, a.entry_street_address, a.entry_suburb, a.entry_city, a.entry_state, a.entry_postcode, a.entry_country_id, a.entry_zone_id, z.zone_code, co.countries_name FROM " . TABLE_CUSTOMERS . " c LEFT JOIN " . TABLE_CUSTOMERS_INFO . " ci on c.customers_id = ci.customers_info_id LEFT JOIN " . TABLE_ADDRESS_BOOK . " a ON c.customers_id = a.customers_id  and c.customers_default_address_id = a.address_book_id left join " . TABLE_ZONES . " z ON a.entry_zone_id = z.zone_id left join " . TABLE_COUNTRIES . " co ON a.entry_country_id = co.countries_id $where ORDER BY $db_orderby $sorted" ;

  if ($start)
  {
    $customers_query = tep_db_query($customers_query_raw);
    $num_rows = tep_db_num_rows($customers_query);
   
    if ($num_rows)
    {  
    ?>
      <!-- BOF HEADER -->
      <tr>
       <td width="100%"><table border="0" width="100%">
        <tr class="dataTableHeadingRow">
         <?php /*<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_NUMBER; ?></td> */ ?>
         <td class="dataTableHeadingContent"><?php echo tep_sort_order ($orderby, $sorted, FULL_NAME, 'name');?></td>
         <td class="dataTableHeadingContent"><?php echo tep_sort_order ($orderby, $sorted, EMAIL, 'email');?></td>
         <td class="dataTableHeadingContent"><?php echo tep_sort_order ($orderby, $sorted, ADDRESS, 'address');?></td>
         <td class="dataTableHeadingContent"><?php echo tep_sort_order ($orderby, $sorted, CITY_NAME, 'city');?></td>
         <td class="dataTableHeadingContent"><?php echo tep_sort_order ($orderby, $sorted, STATE, 'state');?></td>
         <td class="dataTableHeadingContent"><?php echo tep_sort_order ($orderby, $sorted, POSTAL_CODE, 'pcode');?></td>
         <td class="dataTableHeadingContent"><?php echo tep_sort_order ($orderby, $sorted, CONTRY_NAME, 'country');?></td>
         <td class="dataTableHeadingContent"><?php echo tep_sort_order ($orderby, $sorted, TELEPHONE_NUMBER, 'telephone');?></td>
         <td class="dataTableHeadingContent"><?php echo tep_sort_order ($orderby, $sorted, 'NewsLetter', 'newsletter');?></td>
         <!-- EOF HEADER -->
        </tr>
       <?php
       while ($customers = tep_db_fetch_array($customers_query)) {
     	  if ( tep_not_null($customers['customers_id']) ) {
     	    $rows++;
     	    if (strlen($rows) < 2) {
            $rows = '0' . $rows;
           }
         
           $firstName = explode(" ", $customers['entry_firstname']);
           $csv_accum .= "\n";
       
       	 $email = '<a href="mailto:' . $customers['customers_email_address'] . '">' . $customers['customers_email_address'] . '</a>';
       	 $full_name = '<a href="customers.php?cID=' . $customers['customers_id'] . '&action=edit">' . ucfirst(strtolower($firstName[0])) . " " . ucfirst(strtolower($customers['entry_lastname'])) . '</a>';
        ?>
  		    <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
 	      	  <?php /*  <td align="left" class="dataTableContent"><?php echo $rows; ?>.</td> */ ?>
 			     <td class="dataTableContent"><?php mirror_out($full_name);?></td>
 	      	  <td class="dataTableContent"><?php  mirror_out($email); ?></td>
 	      	  <td class="dataTableContent"><?php mirror_out($customers['entry_street_address']); ?></td>
           <td class="dataTableContent"><?php mirror_out($customers['entry_city']); ?></td>
 	      	  <td class="dataTableContent"><?php mirror_out($customers['zone_code']); ?></td>
 	      	  <td class="dataTableContent"><?php mirror_out($customers['entry_postcode']); ?></td>
 	      	  <td class="dataTableContent"><?php mirror_out($customers['countries_name']); ?></td>
 			     <td class="dataTableContent"><?php mirror_out($customers['customers_telephone']); ?></td>
 			     <td class="dataTableContent"><?php mirror_out($customers['customers_newsletter']); ?></td>
  		    </tr>
         <?php
         }    
       } //while
       ?>
       </table></td>
      </tr>
      <?php
    } else {
      echo '<tr><td class="main" style="color: red;">'.ERROR_NO_MATCHES. '</td></tr>';
    } //if num rows
  } //end of if start
?>

<!-- body_text_eof //-->
  </tr>
  <?PHP
			 if ($num_rows > 0 && !$print) {
?>


				<td class="smallText" colspan="4"><form action="<?php echo $_SERVER['PHP_SELF']; ?>" method=post>
				<input type='hidden' name='csv' value='<?php echo htmlentities($csv_accum, ENT_QUOTES); ?>'>
				<?php //suggested file name for csv, include year and month ?>
				<input type='hidden' name='saveas' value='Customer_List_<?php echo date("Y" . "_" . "m" . "_" . "d" . "_" . "Hi"); ?>'><input type="submit" value="<?php echo TEXT_BUTTON_REPORT_SAVE ;?>"></form>
				</td>
</tr>
<?php }; // end button for Save CSV ?>
</table>
</table>

<!-- body_eof //-->





<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
<br>
</body>
</html>
