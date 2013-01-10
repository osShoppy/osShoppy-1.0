<?php // $Id: /catalog/admin/includes/manual_header_menu.php (osS)

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
<link rel="stylesheet" type="text/css" href="templates/<?php  echo ADMIN_TEMPLATE?>/ddsmoothmenu.css" />

<!--[if lte IE 7]>
<style type="text/css">
html .ddsmoothmenu{height: 1%;} /*Holly Hack for IE7 and below*/
</style>
<![endif]-->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script type="text/javascript" src="templates/<?php  echo ADMIN_TEMPLATE?>/js/ddsmoothmenu.js">
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
  <?php require(DIR_WS_MANUAL_BOXES . 'manual_administrator_top.php'); ?>
  </ul>
</li>

<li><div class="line"><a href="#"><?php echo BOX_HEADING_CATALOG ?></a></div>
  <ul>
  <?php require(DIR_WS_MANUAL_BOXES . 'manual_catalog.php'); ?>
  </ul>
</li>

<li><div class="line"><a  href="#"><?php echo BOX_HEADING_CUSTOMERS ?></a></div>
  <ul>
  <?php require(DIR_WS_MANUAL_BOXES . 'manual_customers.php'); ?>
  </ul>
</li>

<li><div class="line"><a  href="#"><?php echo BOX_HEADING_TOOLS ?></a></div>
  <ul>
  <?php require(DIR_WS_MANUAL_BOXES . 'manual_tools.php'); ?>
  </ul>
</li>

<li><div class="line"><a  href="#" ><?php echo BOX_HEADING_MODULES ?></a></div>
  <ul>
 <?php require(DIR_WS_MANUAL_BOXES . 'manual_modules.php'); ?>
  </ul>
</li>

<li><div class="line"><a  href="#" ><?php echo BOX_HEADING_CHECKOUT ?></a></div>
  <ul>
 <?php require(DIR_WS_MANUAL_BOXES . 'manual_checkout.php'); ?>
  </ul>
</li>

<li><div class="line"><a  href="#" ><?php echo BOX_HEADING_REPORTS ?></a></div>
  <ul>
  <?php require(DIR_WS_MANUAL_BOXES . 'manual_reports.php'); ?>
  </ul>
</li>

<li><div class="line"><a  href="#" ><?php echo BOX_HEADING_LOCATION_AND_TAXES ?></a></div>
  <ul>
  <?php require(DIR_WS_MANUAL_BOXES . 'manual_taxes.php'); ?>
  </ul>
</li>

<li><div class="line"><a  href="#" ><?php echo BOX_HEADING_LOCALIZATION ?></a></div>
  <ul>
  <?php require(DIR_WS_MANUAL_BOXES . 'manual_localization.php'); ?>
  </ul>
</li>

<li><div class="line"><a  href="#" ><?php echo BOX_HEADING_SUPPORT ?></a></div>
  <ul>
 <?php require(DIR_WS_MANUAL_BOXES . 'manual_support.php'); ?>
  </ul>
</li>

</ul>
<br style="clear: left" />
</div>