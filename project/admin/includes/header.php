<?php //$Id: /catalog/admin/includes/header.php (osC)

define('ADMIN_TEMPLATE', 'osShoppy');
define('ADMIN_BUTTON', 'true');
define('ADMIN_WIDTH', '99%');

if ($messageStack->size > 0) {
    echo $messageStack->output();
  }
?><head>
<script language="javascript"><!--
function phpOnlinePopupWindowAdmin() {
var url = 'http://<?php echo STORE_URL ?>/live_support/staff.php';
  window.open(url,'popupWindowAdmin','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=575,height=390,screenX=150,screenY=150,top=150,left=150')
}
//--></script>
</head>
<?php
  $languages = tep_get_languages();
  $languages_array = array();
  $languages_selected = DEFAULT_LANGUAGE;
  for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    $languages_array[] = array('id' => $languages[$i]['code'],
                               'text' => $languages[$i]['name']);
    if ($languages[$i]['directory'] == $language) {
      $languages_selected = $languages[$i]['code'];
    }
  }
?>
<link rel="stylesheet" type="text/css" href="templates/<?php echo ADMIN_TEMPLATE?>/tabs.css"/>
<link rel="stylesheet" type="text/css" href="templates/<?php echo ADMIN_TEMPLATE?>/stylesheet.css"/>
<link rel="stylesheet" type="text/css" href="templates/<?php echo ADMIN_TEMPLATE?>/ddsmoothmenu.css" />
<link rel="shortcut icon" href="templates/<?php echo ADMIN_TEMPLATE?>/favicon.ico">
<!--[if lte IE 7]>
<style type="text/css">
html .ddsmoothmenu{height: 1%;} /*Holly Hack for IE7 and below*/
</style>
<![endif]-->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script type="text/javascript" src="templates/<?php echo ADMIN_TEMPLATE?>/js/jquery-1.2.6.js"></script>
<script type="text/javascript" src="templates/<?php echo ADMIN_TEMPLATE?>/js/ui.core.js"></script>
<script type="text/javascript" src="templates/<?php echo ADMIN_TEMPLATE?>/js/ui.tabs.js"></script>
<script type="text/javascript" src="templates/<?php echo ADMIN_TEMPLATE?>/js/ddsmoothmenu.js">
/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/
</script>

<table class="tableBody"  align="center"  border="0" width="<?php  echo ADMIN_WIDTH?>" height="800px" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top" >
	  <table class="headerBody" border="0" width="100%" cellspacing="0" cellpadding="0">
  	   <tr>
   		 <td width="400" rowspan="2"><a   href="index.php"><img src="templates/<?php  echo ADMIN_TEMPLATE?>/images/store_logo.png" border="0" /></a></td>
       </tr>
       <tr>
        <td width="400" align="right" valign="bottom"> <div style="padding-right:10px; padding-top:10px;"><table  width="400" height="86" border="0" cellpadding="0" cellspacing="0">
	   <tr>
        <td width="79" height="45" align="center" valign="bottom"><?php echo '<a href="javascript:phpOnlinePopupWindowAdmin()">' . tep_image(DIR_WS_IMAGES . 'icons/header_icons/header_icon_livesupport.png', HEADER_LIVE_SUPPORT) . '</a>'; ?></td>
        <td width="79" height="45" align="center" valign="bottom">			<a href="<?php echo FORUM_URL; ?>" class="headerNavigation" target="_blank"><?php echo tep_image(DIR_WS_IMAGES . 'icons/header_icons/header_icon_forum.png', HEADER_FORUM); ?></a></td>
        <td width="79" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_ORDERS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/header_icons/header_icon_orders.png', HEADER_ORDER) . '</a>'; ?></td>
		<td width="79" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_RETURNS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/header_icons/header_icon_retour.png', HEADER_RETURN_ARTICLE) . '</a>'; ?></td> 
		<td width="79" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CUSTOMERS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/header_icons/header_icon_customers.png', HEADER_CUSTOMERS) . '</a>'; ?></td> 
		<td width="79" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_MAIL) . '">' . tep_image(DIR_WS_IMAGES . 'icons/header_icons/header_icon_mail.png', HEADER_SEND_MAIL) . '</a>'; ?></td> 
		<td width="79" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_CUSTOMERS_POINTS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/header_icons/header_icon_points.png', HEADER_POINTS) . '</a>'; ?></td> 
		<td width="79" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_STATS_CREDITS) . '">' . tep_image(DIR_WS_IMAGES . 'icons/header_icons/header_icon_accountsaldo.png', HEADER_ACCOUNT_SALDO) . '</a>'; ?></td> 
		<td width="79" align="center" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_MANUAL_INDEX) . '">' . tep_image(DIR_WS_IMAGES . 'icons/header_icons/header_icon_manual_index.png', HEADER_MANUAL_INDEX) . '</a>'; ?></td> 
		<td width="79" align="center" valign="bottom"><?php echo '<a href="' . tep_catalog_href_link() . '" target="_blank" >' . tep_image(DIR_WS_IMAGES . 'icons/header_icons/header_icon_toshop.png', HEADER_TO_SHOP) . '</a>'; ?></td> 
	   </tr>
	   <tr>
		<td colspan="7" class="date" align="right"><?php echo strftime(DATE_TIME_FORMAT_LONG); ?>&nbsp;&nbsp;&nbsp;</td>
		<td colspan="3" class="text" align="center"><?php echo tep_draw_form('languages', 'index.php', '', 'get'); ?>
        <?php echo tep_draw_pull_down_menu('language', $languages_array, $languages_selected, 'onChange="this.form.submit();"'); ?>
        </form></td>
	   </tr>
	  </table>
     </div>
    </td>
    <td width="234" align="center" valign="middle" class="text">
    	<?php
// BOF-A: Administration Acces Level Accounts /Step-1(1)\
    if ($login_groups_id == 1) {
	?>
	<!--<td class="headerBarContent">&nbsp;&nbsp;<?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '" class="text">' . HEADER_TITLE_TOP . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_LOGOFF, '', 'SSL') . '" class="text">' . HEADER_LOGOFF . '</a>'; ?></td>-->
	<?php
	}else{
	?>
	<?php
	}
	?>
	
	<!-- BOE Access with Level Account (v. 2.2 RC2A) for the Admin Area of osCommerce (MS2) 1 of 1 -->
    &nbsp;&nbsp;<?php
		if (tep_session_is_registered('login_id')) {
    echo '<a href="' . tep_href_link(FILENAME_ADMIN_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_my_account.png', HEADER_TITLE_ACCOUNT) . '</a> | <a href="' . tep_href_link(FILENAME_LOGOFF_ADMIN, '', 'NONSSL') . '">' . tep_image_button('button_logoff.png', HEADER_TITLE_LOGOFF_ADMIN). '</a>';
  } else {
    echo '<a href="' . tep_href_link(FILENAME_DEFAULT, '', 'NONSSL') . '" class="text">' . HEADER_TITLE_TOP . '</a>';
  }
	?>
    <!-- BOE Access with Level Account (v. 2.2 RC2A) for the Admin Area of osCommerce (MS2) 1 of 1 -->
	<?php
    if ($login_groups_id == 1) {
	}else{
	?>
	&nbsp;&nbsp;
	<?php
	}
// EOF-A: Administration Acces Level Accounts /Step-1(1)\
	?>
    <td width="24" align="center" valign="top" class="date"><?php echo PROJECT_VERSION ?><br /><br /><?php echo PROJECT_VERSION_UPDATE ?><br /><?php echo '<a href="http://support.osshoppy.com" target="_new"><img src="http://osshoppy.com/index/images/updates/update_status.png" border="0" alt="" width="110" height="30"></a>'; ?></td>
  </tr> 
</table>
<div id="smoothmenu1" class="ddsmoothmenu">
<ul>
<li><div class="line"><a href="#"><?php echo BOX_HEADING_ADMIN_TOP ?></a></div>
  <ul>
  <?php   if (tep_admin_check_boxes('administrator_top.php') == true) {
   require(DIR_WS_BOXES . 'administrator_top.php');
  }
  ?>
  </ul>
</li>
<li><div class="line"><a  href="#" ><?php echo BOX_HEADING_ADMIN_MID ?></a></div>
  <ul>
  <?php   if (tep_admin_check_boxes('administrator_mid.php') == true) {
    require(DIR_WS_BOXES . 'administrator_mid.php');
  }
  ?>
  </ul>
</li>
<li><div class="line"><a  href="#" ><?php echo BOX_HEADING_ADMIN_LOW ?></a></div>
  <ul>
  <?php   if (tep_admin_check_boxes('administrator_low.php') == true) {
    require(DIR_WS_BOXES . 'administrator_low.php');
  }
  ?>
  </ul>
</li>
<li><div class="line"><a href="#"><?php echo BOX_HEADING_CATALOG ?></a></div>
  <ul>
  <?php if (tep_admin_check_boxes('catalog.php') == true) {
    require(DIR_WS_BOXES . 'catalog.php');
  }
  ?>
  </ul>
</li>
<li><div class="line"><a  href="#"><?php echo BOX_HEADING_CUSTOMERS ?></a></div>
  <ul>
  <?php  if (tep_admin_check_boxes('customers.php') == true) {
    require(DIR_WS_BOXES . 'customers.php');
  }
  ?>
  </ul>
</li>
<li><div class="line"><a  href="#"><?php echo BOX_HEADING_TOOLS ?></a></div>
  <ul>
  <?php  if (tep_admin_check_boxes('tools.php') == true) {
    require(DIR_WS_BOXES . 'tools.php');
  }?>
  </ul>
</li>
<li><div class="line"><a  href="#" ><?php echo BOX_HEADING_MODULES ?></a></div>
  <ul>
 <?php  if (tep_admin_check_boxes('modules.php') == true) {
    require(DIR_WS_BOXES . 'modules.php');
  }
  ?>
  </ul>
</li>
<li><div class="line"><a  href="#" ><?php echo BOX_HEADING_CHECKOUT ?></a></div>
  <ul>
 <?php  if (tep_admin_check_boxes('checkout.php') == true) {
    require(DIR_WS_BOXES . 'checkout.php');
  }
  ?>
  </ul>
</li>
<li><div class="line"><a  href="#" ><?php echo BOX_HEADING_REPORTS ?></a></div>
  <ul>
  <?php if (tep_admin_check_boxes('reports.php') == true) {
    require(DIR_WS_BOXES . 'reports.php');
  }?>
  </ul>
</li>
<li><div class="line"><a  href="#" ><?php echo BOX_HEADING_LOCATION_AND_TAXES ?></a></div>
  <ul>
  <?php if (tep_admin_check_boxes('taxes.php') == true) {
    require(DIR_WS_BOXES . 'taxes.php');
  }
  ?>
  </ul>
</li>
<li><div class="line"><a  href="#" ><?php echo BOX_HEADING_LOCALIZATION ?></a></div>
  <ul>
  <?php if (tep_admin_check_boxes('localization.php') == true) {
    require(DIR_WS_BOXES . 'localization.php');
  }
  ?>
  </ul>
</li>
<li><div class="line"><a  href="#" ><?php echo BOX_HEADING_SUPPORT ?></a></div>
  <ul>
 <?php  if (tep_admin_check_boxes('support.php') == true) {
    require(DIR_WS_BOXES . 'support.php');
  }
  ?>
  </ul>
</li>
</ul>
<br style="clear: left" />
</div>