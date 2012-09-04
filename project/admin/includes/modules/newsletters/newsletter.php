<?php //$Id: /catalog/admin/includes/modules/newsletter/newsletter.php (osC) 

  class newsletter {
    var $show_choose_audience, $title, $header_text, $header_date, $content;

    function newsletter($title, $header_text, $header_date, $content) {
      $this->show_choose_audience = false;
      $this->title = $title;
      $this->header_text = $header_text;
      $this->header_date = $header_date;
      $this->content = $content;
    }

    function choose_audience() {
      return false;
    }

    function confirm() {
      global $HTTP_GET_VARS;

      $mail_query = tep_db_query("select count(*) as count from " . TABLE_CUSTOMERS . " where customers_newsletter = '1'");
      $mail_query_minus = tep_db_query("select count(*) as count from " . TABLE_CUSTOMERS . " where customers_active_status = '0'");
      $mail = tep_db_fetch_array($mail_query);
      $mail_minus = tep_db_fetch_array($mail_query_minus);
      if(ACTIVATION_CODE == 'on') {
        $mail_count = $mail['count'] - $mail_minus['count'];
      } else {
        $mail_count = $mail['count'];
      }

      $confirm_string = '<table border="0" cellspacing="0" cellpadding="2">' . "\n" .
                        '  <tr>' . "\n" .
                        '    <td class="main"><font color="#ff0000"><b>' . sprintf(TEXT_COUNT_CUSTOMERS, $mail_count) . '</b></font></td>' . "\n" .
                        '  </tr>' . "\n" .
                        '  <tr>' . "\n" .
                        '    <td>' . tep_draw_separator('pixel_trans.gif', '1', '10') . '</td>' . "\n" .
                        '  </tr>' . "\n" .
                        '  <tr>' . "\n" .
                        '    <td class="main"><b>' . $this->title . '</b></td>' . "\n" .
                        '  </tr>' . "\n" .
                        '  <tr>' . "\n" .
                        '    <td>' . tep_draw_separator('pixel_trans.gif', '1', '10') . '</td>' . "\n" .
                        '  </tr>' . "\n" .
                        '  <tr>' . "\n" .
                        '    <td class="main">' . $this->header_text . '</td>' . "\n" .
                        '    <td class="main">' . $this->header_date . '</td>' . "\n" .
                        '  </tr>' . "\n" .
                        '  <tr>' . "\n" .
                        '    <td>' . tep_draw_separator('pixel_trans.gif', '1', '10') . '</td>' . "\n" .
                        '  </tr>' . "\n" .
                        '  <tr>' . "\n" .
                        '    <td class="main"><tt>' . nl2br($this->content) . '</tt></td>' . "\n" .
                        '  </tr>' . "\n" .
                        '  <tr>' . "\n" .
                        '    <td>' . tep_draw_separator('pixel_trans.gif', '1', '10') . '</td>' . "\n" .
                        '  </tr>' . "\n" .
                        '  <tr>' . "\n" .
                        '    <td align="right"><a href="' . tep_href_link(FILENAME_NEWSLETTERS, 'page=' . $HTTP_GET_VARS['page'] . '&nID=' . $HTTP_GET_VARS['nID'] . '&action=confirm_send') . '">' . tep_image_button('button_send.png', IMAGE_SEND) . '</a> <a href="' . tep_href_link(FILENAME_NEWSLETTERS, 'page=' . $HTTP_GET_VARS['page'] . '&nID=' . $HTTP_GET_VARS['nID']) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a></td>' . "\n" .
                        '  </tr>' . "\n" .
                        '</table>';

      return $confirm_string;
    }

    function send($newsletter_id) {
//---  Beginning of change: Ultimate HTML Emails  ---//
	  $mail_query = tep_db_query("SELECT customers_active_status, c.customers_id, c.customers_firstname, c.customers_insertion, c.customers_lastname, c.customers_email_address FROM " . TABLE_CUSTOMERS . " c WHERE customers_newsletter = '1' AND NOT EXISTS(SELECT * FROM uhtml_newsletters_sent WHERE customers_id=c.customers_id AND newsletters_id='" . $newsletter_id ."') LIMIT ".HTML_EMAIL_BULKMAIL_NUMBER); //Pick HTML_EMAIL_BULKMAIL_NUMBER people that want the newsletter and have not received it yet.
//---  End of change: Ultimate HTML Emails  ---//
      $mimemessage = new email(array('X-Mailer: osCommerce bulk mailer'));
//---  Beginning of change: Ultimate HTML Emails  ---//      
	  //$mimemessage->add_text($this->content);
      while ($mail = tep_db_fetch_array($mail_query)) {
	  if (EMAIL_USE_HTML == 'true') {//Send html email
           $mimemessage->add_html($this->content . '<center><font face="Tahoma, Times New Roman, Times" style="font-size:10px;"><a href="' . HTTP_CATALOG_SERVER . DIR_WS_CATALOG . FILENAME_UNSUBSCRIBE . "?email=" . $mail['customers_email_address'] . '">' . HTTP_CATALOG_SERVER . DIR_WS_CATALOG . FILENAME_UNSUBSCRIBE . "?email=" . $mail['customers_email_address'] . '</a></font></center>');
	  }else{//Send text email
           $mimemessage->add_html($this->content . '<center><font face="Tahoma, Times New Roman, Times" style="font-size:10px;"><a href="' . HTTP_CATALOG_SERVER . DIR_WS_CATALOG . FILENAME_UNSUBSCRIBE . "?email=" . $mail['customers_email_address'] . '">' . HTTP_CATALOG_SERVER . DIR_WS_CATALOG . FILENAME_UNSUBSCRIBE . "?email=" . $mail['customers_email_address'] . '</a></font></center>');
	  }
//---  End of change: Ultimate HTML Emails  ---//      
      $mimemessage->build_message();
        if ( $mail['customers_active_status'] == '1' ) {
        	$mimemessage->send($mail['customers_firstname'] . ' ' . $mail['customers_insertion'] . ' ' . $mail['customers_lastname'], $mail['customers_email_address'], '', EMAIL_FROM, $this->title);
//---  Beginning of addition: Ultimate HTML Emails  ---//
		tep_db_query("INSERT INTO uhtml_newsletters_sent SET customers_id='". $mail['customers_id'] ."', newsletters_id='" . $newsletter_id . "', date_sent=NOW();"); //Mark this mail as sent
//---  End of addition: Ultimate HTML Emails  ---//
		}
      }
//---  Beginning of change: Ultimate HTML Emails  ---//
      //$newsletter_id = tep_db_prepare_input($newsletter_id);
      //tep_db_query("update " . TABLE_NEWSLETTERS . " set date_sent = now(), status = '1' where newsletters_id = '" . tep_db_input($newsletter_id) . "'");
//---  End of change: Ultimate HTML Emails  ---//
    }
  }
?>
