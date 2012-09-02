<?php //$Id: /catalog/admin/links_check.php (5272)

function GetLinksFileArray($url)
{
  $lines = array();

  if (function_exists('curl_init'))  //use curl if possible to read in site information
  {
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_exec($ch);

      // Check if any error occured
      if(curl_errno($ch))
          return ''; //echo 'Curl error: ' . curl_error($ch);


      $ch = curl_init();
      $timeout = 5; // set to zero for no timeout
      curl_setopt ($ch, CURLOPT_URL, $url);
      curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
      $file_contents = curl_exec($ch);
      curl_close($ch);

      $lines = explode("\n", $file_contents);
  }
  else
  {
      if (($fd = fopen ($url, "r"))) {
          while (!feof ($fd))
          {
              $buffer = fgets($fd, 4096);
              $lines[] = $buffer;
          }
          fclose ($fd);
      }
      else
          return '';
  }

  return $lines;
}

function CheckSiteData($lines)
{
  global $check_phase;
  $found = 0;

  $phases = explode(",", $check_phase);

  foreach ($lines as $line)
  {
    $page_line = trim($line);

    for ($i = 0; $i < count($phases); ++$i)
    {
      if (@preg_match('/' . $phases[$i] . '/i', $page_line))
      {
        $found = 1;
        break;
      }
    }
    if ($found)
      break;
  }
  return $found;
}

// Search the given page for the given phase(s)
function CheckURL($url, $links_id) {
    $found = false;
    $lines = array();
    $lines = GetLinksFileArray($url);
    $link_check_status_text = '';

    if (! empty($lines)) {
        $found = CheckSiteData($lines);
    }

    $links_check_query = mysql_query("select date_last_checked, link_found from links_check where links_id = " . (int)$links_id . " limit 1") or die(mysql_error());
    if (mysql_num_rows($links_check_query) > 0) {
        mysql_query("UPDATE links_check SET link_found = '" . (int)$found  . "', date_last_checked = now() where links_id = '" . (int)$links_id  . "'")  or die(mysql_error());
    } else {
        mysql_query("INSERT INTO links_check (links_id, link_found, date_last_checked) VALUES ('" . (int)$links_id . "', '" . (int)$found . "',  now()) ") or die(mysql_error());
    }

    return $found;
}

/***************************************************************************
             Get the domain name part of a given url
***************************************************************************/
function GetDomainName($url)
{
    $url_data = parse_url ( $url );
    return $url_data['host'];
}

/***************************************************************************
 Get the status of the other site
***************************************************************************/
function GetHeaderStatus($url) {

    $headerStatus = '';
    $header = @get_headers($url);

    for ($h = 0; $h < count($header); ++$h) {
        if (strpos($header[$h], 'HTTP/') !== FALSE) {
            $headerStatus = substr($header[$h], 9, 3);
        }
    }

    $siteFound = false;

    switch ($headerStatus[0]) {
       case 2:
       case 3: $siteFound = true; break;
       case 4:
       case 5:
       default: $siteFound = false;
    }

    return $siteFound;
}

/***************************************************************************
             Verify if the home page has a link to the links page
             Othewise it is just a one way link
***************************************************************************/
function NoParentLink($links)
{
    $mainDomain = GetDomainName($links['links_url']);
    $linkArray = parse_url($links['links_reciprocal_url']);

    if ($mainDomain == strtolower($linkArray['host'])) {
         $path = trim($linkArray['path'], "/");
         if (empty($path)) {   //marginal since link could be on main page
             return false;     //so assume OK
         }

         $file = file_get_contents($linkArray['scheme'] .'://' . $linkArray['host'] . '/');
         return ((strpos($file, $path) !== FALSE) ? false : true);
    }
    return true;
}


  require('includes/configure.php');

  $link = mysql_connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD) or die("Could not connect");
  mysql_select_db(DB_DATABASE);

  // Get the Site email address
  $configuration_query = mysql_query("select configuration_key, configuration_value from configuration where configuration_key = 'STORE_OWNER_EMAIL_ADDRESS' limit 1 ") or die(mysql_error());
  $configuration = mysql_fetch_array($configuration_query, MYSQL_ASSOC);
  $site_email = $configuration['configuration_value'];

  // Get the Check Phase(s)
  $configuration_query = mysql_query("select configuration_key, configuration_value from configuration where configuration_key = 'LINKS_CHECK_PHRASE' limit 1 ") or die(mysql_error());
  $configuration = mysql_fetch_array($configuration_query, MYSQL_ASSOC);
  $check_phase = $configuration['configuration_value'];

  // Get the Check Count
  $configuration_query = mysql_query("select configuration_key, configuration_value from configuration where configuration_key = 'LINKS_RECIPROCAL_CHECK_COUNT' limit 1 ") or die(mysql_error());
  $configuration = mysql_fetch_array($configuration_query, MYSQL_ASSOC);
  $check_count = explode(",", $configuration['configuration_value']);

  // Get the Domain Check Option
  $configuration_query = mysql_query("select configuration_key, configuration_value from configuration where configuration_key = 'LINKS_RECIPROCAL_DOMAIN_CHECK' limit 1 ") or die(mysql_error());
  $configuration = mysql_fetch_array($configuration_query, MYSQL_ASSOC);
  $domain_check = explode(",", $configuration['configuration_value']);

    // Get the Parent Check Option
  $configuration_query = mysql_query("select configuration_key, configuration_value from configuration where configuration_key = 'LINKS_RECIPROCAL_PARENT_CHECK' limit 1 ") or die(mysql_error());
  $configuration = mysql_fetch_array($configuration_query, MYSQL_ASSOC);
  $parent_check = explode(",", $configuration['configuration_value']);

  // Get the links to check
  $links_query = mysql_query("select links_id, links_url, links_reciprocal_url, links_image_url, links_reciprocal_check_count, links_status from links where links_status <> 3 and links_reciprocal_disable = 0") or die(mysql_error());

  //Set the counters for the loop
  $sleepCnt = 50;        //sleep after this many url's have been checked
  $sleepDuration = 600;  //how long it will sleep in seconds
  $ctr = 1;

  /************** BEGIN GLOBAL EMAIL TEXT **************/
  $subject = 'Link stauts change';
  $headers = 'From: ' . $site_email . "\r\n" .
             'Reply-To: ' . $site_email . "\r\n" .
             'X-Mailer: LinksManager II auto checker';
  $listChanges = '';  //used to report changes to the shop owner
  $linkNewCount  = '';
  /************** END GLOBAL EMAIL TEXT **************/

  while ($links = mysql_fetch_array($links_query, MYSQL_ASSOC)) {
       $allOK = true;
       $sendMessage = false;
       $linkNewCount = $links['links_reciprocal_check_count'];

       /****************** GET THE EMAIL CONTACT ***************************/
       $contact_query = mysql_query("select links_contact_name, links_contact_email from links where links_id = '" . (int)$links['links_id'] . "'") or die(mysql_error());
       $contact = mysql_fetch_array($contact_query, MYSQL_ASSOC);

       /****************** CHECK IF THE SITE CAN BE FOUND ******************/
       $siteFound = GetHeaderStatus($links['links_url']);
       if (! $siteFound) {
           if ($check_count[0] > $links['links_reciprocal_check_count']) { //don't disable link yet
               mysql_query("UPDATE links SET links_reciprocal_check_count = '" . ($links['links_reciprocal_check_count'] + 1) . "' where links_id = '" . (int)$links['links_id']  . "'")  or die(mysql_error());
               $message = 'Hello ' . $contact['links_contact_name'] . ',' . "\r\n\r\n" . 'We cannot find the domain name you provided:' . "\r\n" . $links['links_url'] .
                   "\r\n\r\n" . 'Please verify your domain name is correct and send us an updated link to prevent your link from being deleted from our site. Your link status as been changed to Disabled utill this matter is resolved.' .
                   "\r\n\r\n" . 'Please feel free to contact us at ' . $site_email . ' if you have any questions.' . "\r\n\r\n" . 'Thank you.';
               $sendMessage = true;
           }
       } else {

           /****************** CHECK IF A LINK EXISTS ON THE PARENT PAGE TO THE RECIRPOCAL LINKS PAGE ******************/
           if ($parent_check[0] == 'true' && NoParentLink($links))  {
               $message = 'Hello ' . $contact['links_contact_name'] . ',' . "\r\n\r\n" . 'Our link exchange policy requires the home page of the site to have a link to the page our link is on. We cannot find that link on the site you provided: ' . "\r\n" . $links['links_url'] . '.' .
                   "\r\n\r\n" . 'As a result, we have deactivated your link.' .
                   "\r\n\r\n" . 'Please feel free to contact us at ' . $site_email . ' if you have any questions.' . "\r\n\r\n" . 'Thank you.';
               $allOK = false;
               $sendMessage = true;
           }

           /****************** CHECK IF THE RECIRPOCAL LINK EXISTS ******************/
           else if (! CheckURL( $links['links_reciprocal_url'],  $links['links_id']))
           {
               if ($check_count[0] > $links['links_reciprocal_check_count']) { //don't disable link yet
                   mysql_query("UPDATE links SET links_reciprocal_check_count = '" . ($links['links_reciprocal_check_count'] + 1) . "' where links_id = '" . (int)$links['links_id']  . "'")  or die(mysql_error());

                   $listChanges .= 'Link: ' . $links['links_url'] . "\r\n";
                   $listChanges .= 'Status: '. 'Approved' . "\r\n";
                   $listChanges .= 'Check Count: ' . $links['links_reciprocal_check_count'] + 1 . "\r\n";
                   $listChanges .= 'Email sent to ' . $contact['links_contact_email'] . "\r\n\r\n";
               }

               else {
                   $message = 'Hello ' . $contact['links_contact_name'] . ',' . "\r\n\r\n" . 'We cannot find our link on the page you provided:' . "\r\n" . $links['links_reciprocal_url'] .
                        "\r\n\r\n" . 'Please add our link to that page or send us an updated link to prevent your link from being deleted from our site. Your link status as been changed to Disabled utill this matter is resolved.' .
                        "\r\n\r\n" . 'Please feel free to contact us at ' . $site_email . ' if you have any questions.' . "\r\n\r\n" . 'Thank you.';
                   $allOK = false;
                   $sendMessage = true;
               }
           }

           /****************** CHECK IF THE VARIOUS LINKS MATCH ******************/
           else if ($domain_check[0] == 'true') {
               if ($links['links_reciprocal_url']) {
                   $mainDomain = GetDomainName($links['links_url']);
                   $imageDomain = GetDomainName($links['links_image_url']);
                   if (GetDomainName($links['links_reciprocal_url']) !==  $mainDomain || (! empty($imageDomain) && $imageDomain !==  $mainDomain)) {
                       $message = 'Hello ' . $contact['links_contact_name'] . ',' . "\r\n\r\n" . 'Our policy requires the page we are exchanging links with be part of the site the link is for. Our scan shows that the reciprocal link you submitted, ' .
                           $links['links_reciprocal_url'] . ' is on a different site from the main domain of ' . $mainDomain . '. ' .
                           "\r\n\r\n" . 'As a result, we have deactivated your link.' .
                           "\r\n\r\n" . 'Please feel free to contact us at ' . $site_email . ' if you have any questions.' . "\r\n\r\n" . 'Thank you.';
                       $allOK = false;
                       $sendMessage = true;
                   }
               }
           }

           else if ($allOK) {
               if ($links['links_reciprocal_check_count'] > 0) { //decrease the times not found setting
                   mysql_query("UPDATE links SET links_reciprocal_check_count = '" . ($links['links_reciprocal_check_count'] - 1) . "' where links_id = '" . (int)$links['links_id']  . "'")  or die(mysql_error());
               }

               $links_check_query = mysql_query("select date_last_checked, link_found from links_check where links_id = " . (int)$links['links_id']) or die(mysql_error());
               if (mysql_num_rows($links_check_query) > 0) {
                   mysql_query("UPDATE links_check SET link_found = 1, date_last_checked = now() where links_id = '" . (int)$links['links_id']  . "'")  or die(mysql_error());
               } else {
                   mysql_query("INSERT INTO links_check (links_id, link_found, date_last_checked) VALUES ('" . (int)$links['links_id'] . "', '1',  now()) ") or die(mysql_error());
               }
           }

       }

       /****************** COMMON CODE FOR SENDING THE MESSAGE ******************/
       if ($sendMessage) {
           if (! $allOK) {  //some error occurred so the link is being disabled
               mysql_query("UPDATE links SET links_status = 3 where links_id = '" . (int)$links['links_id']  . "'")  or die(mysql_error());

               $links_check_query = mysql_query("select links_id, date_last_checked, link_found from links_check where links_id = " . (int)$links['links_id']) or die(mysql_error());

               if (mysql_num_rows($links_check_query) > 0) {
                   mysql_query("UPDATE links_check SET link_found = 0, date_last_checked = now() where links_id = '" . (int)$links['links_id']  . "'")  or die(mysql_error());
               } else {
                   mysql_query("INSERT INTO links_check (links_id, link_found, date_last_checked) VALUES ('" . (int)$links['links_id'] . "', '0',  now()) ") or die(mysql_error());
               }

               /*************** STORE THE DATA FOR THE SHOP OWNERS EMAIL ***************/
               $listChanges .= 'Link: ' . $links['links_url'] . "\r\n";
               $listChanges .= 'Status: Disabled' . "\r\n";
               $listChanges .= 'Check Count: ' . $linkNewCount . "\r\n";
               $listChanges .= 'Email sent to ' . $contact['links_contact_email'] . "\r\n\r\n";
           }

           mail($contact['links_contact_email'], $subject, $message, $headers);
       }

       /****************** ADD A DELAY FOR SLOWER SERVERS ******************/
       if (($ctr % $sleepCnt) == 0) {
           sleep($sleepDuration);
       }

       $ctr++;
  }

  if (! empty($listChanges)) {
      mail($site_email, 'Link Check Report', $listChanges, $headers);
  }

  mysql_close($link);
?>
