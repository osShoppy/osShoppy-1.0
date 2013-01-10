<?php //$Id: /catalog/admin/includes/header_menu.php

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


<br />
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
<br />