<?php //$Id: /catalog/admin/is_image_used.php (1032)

require('includes/application_top.php');
require(DIR_WS_FUNCTIONS . 'additional_images.php');

$subdir = '';
if (!empty($_GET['subdir']) && substr($_GET['subdir'],-1,1) == '/') { 
  $subdir = $_GET['subdir']; 
} elseif (!empty($_GET['subdir'])) {
  $subdir = $_GET['subdir'].'/';
}

header('Content-type: text/xml');

// XML Preamble
$xml = '<?xml version="1.0" encoding="utf-8"?>' . "\n";

// Begin XML response
$xml .= '<image_status_list>' . "\n";
if (!empty($_GET['image1'])) {
	$image1 = split('/',str_replace('\\','/',$_GET['image1']));
	$xml .= '<image_status id="1">' . "\n";
	$xml .= '	<name>' . $subdir . $image1[sizeof($image1)-1] . '</name>' . "\n";
	$xml .= '	<is_present>' . intval(tep_is_image_still_used($subdir . $image1[sizeof($image1)-1]) || file_exists(DIR_FS_CATALOG_IMAGES . $subdir . $image1[sizeof($image1)-1])) . '</is_present>' . "\n";
	$xml .= '</image_status>' . "\n";
}
if (!empty($_GET['image2'])) {
	$image2 = split('/',str_replace('\\','/',$_GET['image2']));
	$xml .= '<image_status id="2">' . "\n";
	$xml .= '	<name>' . $subdir . $image2[sizeof($image2)-1] . '</name>' . "\n";
	$xml .= '	<is_present>' . intval(tep_is_image_still_used($subdir . $image2[sizeof($image2)-1]) || file_exists(DIR_FS_CATALOG_IMAGES . $subdir . $image2[sizeof($image2)-1])) . '</is_present>' . "\n";
	$xml .= '</image_status>' . "\n";
}
if (!empty($_GET['image3'])) {
	$image3 = split('/',str_replace('\\','/',$_GET['image3']));
	$xml .= '<image_status id="3">' . "\n";
	$xml .= '	<name>' . $subdir . $image3[sizeof($image3)-1] . '</name>' . "\n";
	$xml .= '	<is_present>' . intval(tep_is_image_still_used($subdir . $image3[sizeof($image3)-1]) || file_exists(DIR_FS_CATALOG_IMAGES . $subdir . $image3[sizeof($image3)-1])) . '</is_present>' . "\n";
	$xml .= '</image_status>' . "\n";
}
$xml .= '</image_status_list>' . "\n";

// Output XML string
echo $xml;

require(DIR_WS_INCLUDES . 'application_bottom.php'); 
 
?>