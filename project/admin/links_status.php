<?php //$Id: /catalog/admin/link_status.php (5272)

  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LINKS);
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LINKS_STATUS);
  require(DIR_WS_FUNCTIONS . 'links.php');

  $checkState = '1';

  if (isset($_GET['action']) && $_GET['action'] == 'process') {
      if (isset($_POST['update_x']) && isset($_POST['ids']))  {
           $links_check_query = tep_db_query("SELECT l.links_id, links_contact_name, links_contact_email, links_url from " . TABLE_LINKS . " l left join " . TABLE_LINKS_DESCRIPTION . " ld on l.links_id = ld.links_id where ld.language_id = '" . (int)$languages_id . "' or ld.language_id = '99'");
           while ($links = tep_db_fetch_array($links_check_query)) {
               $box = sprintf("links_status_checkbox%d",$links['links_id']);
               if (in_array($box, $_POST['ids'])) {
                   if (isset($_POST['group1']) && $_POST['group1'] == 'delete_links') {
                       tep_remove_link($links['links_id']);
                       $links_statuses_query = tep_db_query("select count(*) as total from " . TABLE_LINKS_STATUS . " where language_id = '" . (int)$languages_id . "'");
                       $links = tep_db_fetch_array($links_statuses_query);
                       $checkState = $links['total'];
                   } else {
                       tep_db_query("update " . TABLE_LINKS . " SET links_status = '" . $_POST['group1'] . "' where links_id = '" . (int)$links['links_id'] . "'");
                       $checkState = $_POST['group1'];

                       if ($_POST['notify_link_partner'] == 'on') { //let the link partner know about the change
                           $links_statuses_query = tep_db_query("select links_status_name from " . TABLE_LINKS_STATUS . " where links_status_id = '" . tep_db_input($_POST['group1']) . "' and language_id = '" . (int)$languages_id . "'");
                           $links_status = tep_db_fetch_array($links_statuses_query);
                           $email = sprintf(EMAIL_TEXT_STATUS_UPDATE, $links['links_contact_name'], $links_status['links_status_name'], $links['links_url']) . "\n\n" . STORE_OWNER . "\n" . STORE_NAME;
                           tep_mail($links['links_contact_name'], $links['links_contact_email'], EMAIL_TEXT_SUBJECT, $email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
                       }
                   }

                   $page = (isset($_POST['page']) ? $_POST['page'] : '1');
               }
           }
       }
  }

  $linkShow = array();
  $links_status_query = tep_db_query("select links_status_id, links_status_name from " . TABLE_LINKS_STATUS . " where language_id = '" . (int)$languages_id . "'");
  $linkShow[] = array('id' => 'All', 'text' => 'All');
  while ($links_status = tep_db_fetch_array($links_status_query)) {
      $linkShow[] = array('id' => $links_status['links_status_id'],
                          'text' => $links_status['links_status_name']);
  }
  $showLinkStatus = 'All';
  if (isset($_GET['links_status_list']))
    $showLinkStatus = $_GET['links_status_list'];
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/linksmanager_stylesheet.css">
<style type="text/css">
input { vertical-align: middle; margin-top: -1px;}
</style>
<script language="JavaScript" type="text/javascript">
<!--

function CheckAll(form)
{
	for(var j = 0; j < document.links_status.length; j++)
  {
		if(document.links_status.elements[j].name == "ids[]")
    {
      if (document.links_status.elements[j].checked)
			document.links_status.elements[j].checked = false;
      else
			document.links_status.elements[j].checked = true;
		}
	}
}
//-->
</script>
</head>
<body>
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
   <td width="100%" valign="top">
    <table border="3" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2" class="linksBordered">
              <tr><?php echo tep_draw_form('search', FILENAME_LINKS_STATUS, '', 'get') . tep_hide_session_id(); ?>
                <td class="pageHeading"><?php echo HEADING_TITLE_LINKS_STATUS; ?></td>
                <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
                <td class="pageHeading" align="right"><?php echo tep_draw_pull_down_menu('links_status_list', $linkShow, '',  'onChange="this.form.submit();"'); ?></td>
                <td class="smallText" align="right"><?php echo HEADING_TITLE_SEARCH . ' ' . tep_draw_input_field('search'); ?></td>
              </form></tr>
            </table></td>
          </tr>
          <tr>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_HEADING_SUB_TEXT; ?></td>
          </tr>
        </table></td>
      </tr>
      <?php echo tep_draw_form('links_status', FILENAME_LINKS_STATUS, tep_get_all_get_params(array('action')) . 'action=process', 'post', 'onSubmit="true;"') . tep_hide_session_id(); ?>
      <?php
      switch ($listing) {
          case "status":
          $order = "l.links_status";
          break;
          case "status-desc":
          $order = "l.links_status DESC";
          break;
          case "title":
          $order = "ld.links_title";
          break;
          case "title-desc":
          $order = "ld.links_title DESC";
          break;
          case "url":
          $order = "l.links_reciprocal_url";
          break;
          case "url-desc":
          $order = "l.links_reciprocal_url DESC";
          break;
          case "last_date":
          $order = "lc.date_last_checked";
          break;
          case "last_date-desc":
          $order = "lc.date_last_checked DESC";
          break;
          default:
          $order = "l.links_id DESC";
      }
      ?>
      <tr>
       <td width="100%" valign="top"><table border="2" width="100%" cellspacing="0" cellpadding="1">
        <tr bgcolor="#c9c9c9">
         <th class="main" width="20"  align="left"><input type="checkbox" name="links_check_all" onClick="CheckAll(this.form);"></th>
         <th class="main" width="20"><?php echo TEXT_SITE_FOUND; ?></th>
         <th class="main" width="20"><?php echo TEXT_LINK_FOUND; ?></th>
         <th class="main" width="80">
          <?php echo (($listing=='status' or $listing=='status-desc') ? '<font color="FF0000"><b>' . TEXT_LINK_STATUS . '</b></font>' : '<b>'. TEXT_LINK_STATUS . '</b>'); ?><br>
          <a href="<?php echo tep_href_link(FILENAME_LINKS_STATUS, 'listing=status'); ?>"><?php echo ($listing=='status' ? '<font color="FF0000"><b>Asc</b></font>' : '<b>Asc</b>'); ?></a>&nbsp; <?php echo tep_hide_session_id(); ?>
          <a href="<?php echo tep_href_link(FILENAME_LINKS_STATUS, 'listing=status-desc'); ?>"><?php echo ($listing=='status-desc' ? '<font color="FF0000"><b>Desc</b></font>' : '<b>Desc</b>'); ?></a>&nbsp; <?php echo tep_hide_session_id(); ?>
         </th>

         <th class="main">
          <?php echo (($listing=='title' or $listing=='title-desc') ? '<font color="FF0000"><b>' . TEXT_LINK_TITLE . '</b></font>' : '<b>'. TEXT_LINK_TITLE . '</b>'); ?><br>
          <a href="<?php echo tep_href_link(FILENAME_LINKS_STATUS, 'listing=title'); ?>"><?php echo ($listing=='title' ? '<font color="FF0000"><b>Asc</b></font>' : '<b>Asc</b>'); ?></a>&nbsp; <?php echo tep_hide_session_id(); ?>
          <a href="<?php echo tep_href_link(FILENAME_LINKS_STATUS, 'listing=title-desc'); ?>"><?php echo ($listing=='title-desc' ? '<font color="FF0000"><b>Desc</b></font>' : '<b>Desc</b>'); ?></a>&nbsp; <?php echo tep_hide_session_id(); ?>
         </th>

         <th class="main">
          <?php echo (($listing=='url' or $listing=='url-desc') ? '<font color="FF0000"><b>' . TEXT_LINK_URL . '</b></font>' : '<b>'. TEXT_LINK_URL . '</b>'); ?><br>
          <a href="<?php echo tep_href_link(FILENAME_LINKS_STATUS, 'listing=url'); ?>"><?php echo ($listing=='url' ? '<font color="FF0000"><b>Asc</b></font>' : '<b>Asc</b>'); ?></a>&nbsp; <?php echo tep_hide_session_id(); ?>
          <a href="<?php echo tep_href_link(FILENAME_LINKS_STATUS, 'listing=url-desc'); ?>"><?php echo ($listing=='url-desc' ? '<font color="FF0000"><b>Desc</b></font>' : '<b>Desc</b>'); ?></a>&nbsp; <?php echo tep_hide_session_id(); ?>
         </th>

         <th class="main" width="90">
          <?php echo TEXT_LINK_DOMAIN_MATCH ; ?><br>
         </th>

         <th class="main" width="90">
          <?php echo (($listing=='last_date' or $listing=='last_date-desc') ? '<font color="FF0000"><b>' . TEXT_LINK_LAST_DATE_CHECKED . '</b></font>' : '<b>'. TEXT_LINK_LAST_DATE_CHECKED . '</b>'); ?><br>
          <a href="<?php echo tep_href_link(FILENAME_LINKS_STATUS, 'listing=last_date'); ?>"><?php echo ($listing=='last_date' ? '<font color="FF0000"><b>Asc</b></font>' : '<b>Asc</b>'); ?></a>&nbsp; <?php echo tep_hide_session_id(); ?>
          <a href="<?php echo tep_href_link(FILENAME_LINKS_STATUS, 'listing=last_date-desc'); ?>"><?php echo ($listing=='last_date-desc' ? '<font color="FF0000"><b>Desc</b></font>' : '<b>Desc</b>'); ?></a>&nbsp; <?php echo tep_hide_session_id(); ?>
         </th>
        <tr>
        <?php
        if (isset($_GET['search']) && tep_not_null($_GET['search'])) {
          $keywords = tep_db_input(tep_db_prepare_input($_GET['search']));
          $where = " where l.links_status = '" . tep_db_input($showLinkStatus) . "' and ld.links_title like '%" . $keywords . "%' or  l.links_url like '%" . $keywords . "%'" ;
        }
        else if ($showLinkStatus == 'All')
          $where = '';
        else
          $where = " where l.links_status = '" . tep_db_input($showLinkStatus) . "'";

        $links_check_query_raw = "SELECT l.links_id, l.links_url, l.links_reciprocal_url, l.links_image_url, l.links_reciprocal_disable, l.links_status, ld.links_title, lc.date_last_checked, lc.link_found, ls.links_status_name from " . TABLE_LINKS . " l LEFT JOIN " . TABLE_LINKS_DESCRIPTION . " ld on l.links_id = ld.links_id left join " . TABLE_LINKS_CHECK . " lc on l.links_id = lc.links_id left join " . TABLE_LINKS_STATUS . " ls on l.links_status = ls.links_status_id $where and ls.language_id = '" . (int)$languages_id . "' order by " . $order;
        $links_split = new splitPageResults($_GET['page'], MAX_LINKS_DISPLAY, $links_check_query_raw, $links_query_numrows);
        $links_check_query = tep_db_query($links_check_query_raw);

        while ($links = tep_db_fetch_array($links_check_query)) {
            $domain = GetDomainName($links['links_url']);
            $domainsMatch = false;
            $siteFound =  checkdnsrr($domain, "ANY");
            $imgSite = $imgRecip = ($siteFound ? 'images/icons/links_icons/mark_check.jpg' : 'images/icons/links_icons/mark_x.jpg');

            if ($siteFound) {
                $imgRecip = ((CheckURL($links['links_reciprocal_url'], $links['links_id']) == TEXT_INFO_LINK_CHECK_FOUND) ? 'images/icons/links_icons/mark_check.jpg' : 'images/icons/links_icons/mark_x.jpg');
                $date = explode(" ",$links['date_last_checked']);
                $lInfo = new objectInfo($links); //convert to pointer for function
                $domainsMatch = DomainMismatch($lInfo, true);
                $bkgndColor = ((! $domainsMatch && $links['links_status'] == 2) ? 'yellow' : ''); //highlight links that are approved but don't match
            }

            tep_db_query("update " . TABLE_LINKS_CHECK . " set link_found = '" . (int)$domainsMatch  . "', date_last_checked = now() where links_id = '" . (int)$links_id  . "'");
        ?>
        <tr class="smallText" style="background-color:<?php echo $bkgndColor; ?>">
         <td width="20" align="center" valign="middle"><input name="ids[]" type="checkbox" id="ids[]" value="links_status_checkbox<?php echo $links['links_id']; ?>" ></td>
         <td align="center"><img src="<?php echo $imgSite; ?>" alt="" width="12" height="12"></td>
         <td align="center"><img src="<?php echo $imgRecip; ?>" alt="" width="12" height="12"></td>
         <td align="left"><?php echo  ' ' . $links['links_status_name']; ?></td>
         <td><?php echo $links['links_title']; ?></td>
         <td><?php echo '<a href="' . $links['links_reciprocal_url'] . '" target="_blank">' . $links['links_reciprocal_url'] . '</a>'; ?></td>
         <td align="center"><img src="<?php echo ($domainsMatch ? 'images/icons/links_icons/mark_check.jpg' : 'images/icons/links_icons/mark_x.jpg'); ?>" width="12" height="12"></td>
         <td align="center"><?php echo (tep_not_null($date[0]) ? $date[0] : '&nbsp;'); ?></td>
        </tr>
        <?php } ?>
       <table><td>
      </tr>

      <tr><table border="0" width="100%" cellspacing="0" cellpadding="0">

      <!-- ***************** Add the function buttons beneath the links *************** //-->
      <?php if (tep_db_num_rows($links_check_query) > 0) {
       $links_statuses_query = tep_db_query("select links_status_name, links_status_id from " . TABLE_LINKS_STATUS . " where language_id = '" . (int)$languages_id . "'");
      ?>
      <tr>
        <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">

          <tr>
            <td valign="top"><table border="0" width="40%" cellspacing="0" cellpadding="0">
              <tr class="smallText">
                <td width="50" style="font-weight:bold;"><?php echo TEXT_SET_TO; ?></td>
                <?php  while ($links_statuses = tep_db_fetch_array($links_statuses_query)) {
                  $checked = ($checkState == $links_statuses['links_status_id']) ? 'checked' : '';
                ?>
                  <td valign="top" width="5"><INPUT TYPE="radio" NAME="group1" VALUE="<?php echo $links_statuses['links_status_id']; ?>" <?php echo $checked; ?> ></td>
                  <td valign="middle" width="60"><?php echo $links_statuses['links_status_name']; ?></td>
                <?php } ?>
                <td valign="top" width="5"><INPUT TYPE="radio" NAME="group1" VALUE="delete_links" <?php echo $checked; ?> ></td>
                <td valign="middle" class="smallText" width="50"><?php echo TEXT_LINK_DELETE; ?></td>
              </tr>
            </table></td>
          </tr>

          <tr><td height="10"></td></tr>

          <tr>
            <td valign="top" colspan="2"><table border="0" width="40%" cellspacing="0" cellpadding="0">
              <tr class="smallText" >
                 <td width="50" style="font-weight:bold;"><?php echo TEXT_NOTIFY; ?></td>
                 <td><?php echo tep_draw_checkbox_field('notify_link_partner', '', false); ?> </td>
              </tr>
            </table></td>
          </tr>

       </table></td>
      </tr>
        <?php } ?>

      <tr>
       <td width="100%"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '20'); ?></td>
      </tr>

      <tr class="infoBoxContents">
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
              <td align="center" align="center"><?php echo tep_image_submit('button_update.png', IMAGE_BUTTON_UPDATE, 'name="update"'); ?></td>
          </tr>
        </table></td>
      </tr></form>
        <tr>
         <td aligh="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
           <td class="smallText"><?php echo $links_split->display_count($links_query_numrows, MAX_LINKS_DISPLAY, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_LINKS); ?></td>
           <td class="smallText" align="right"><?php echo $links_split->display_links($links_query_numrows, MAX_LINKS_DISPLAY, MAX_DISPLAY_PAGE_LINKS, $page, tep_get_all_get_params(array('page', 'info', 'x', 'y', 'lID'))); ?></td>
          </tr>
         </table></td>
        </tr>

      </table>
      </tr>

  <!-- body_text_eof //-->
    </table>
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
