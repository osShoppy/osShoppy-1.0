<?php //$Id: /catalog/gallery_user.php (6181)

  require('includes/application_top.php');
  header('Content-type: text/html; charset=' . CHARSET . '');

// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/gallery_user.php');

//edit form voor titel en beschrijving processen
if (isset($_POST['edittitle']) && $_POST['edittitle']=='save') {
	$cID = $_POST['cID'];
	$pID = $_POST['pID'];
	mysql_query("UPDATE gallery SET title='".addslashes($_POST['title'])."', description='".addslashes($_POST['description'])."' WHERE cID=".$cID." AND pID=".$pID) or die(mysql_error());
}

if (isset($_GET['delete'])) {
	unlink('gallery/'.$_GET['pid']);
	$cID = explode("_",$_GET['pid']);
	$pID = explode(".",$cID[1]);
	mysql_query("DELETE FROM gallery WHERE cID=".$cID[0]." AND pID=".$pID[0]);
	$messageStack->add('The file has been removed successfully.','success');
}

$superuser=false;
$superuser_check_query = tep_db_query("select count(*) as total from " . TABLE_GALLERY_SUPERUSERS . " where cID = '" . (int)$customer_id . "'");
$superuser_check_value = tep_db_fetch_array($superuser_check_query);
if ($superuser_check_value['total'] > 0) $superuser=true;

if (isset($_POST['fotouploaden']) && $_POST['fotouploaden']='Upload') {						
	foreach ($_FILES["uploadedfile"]["error"] as $key => $error) {
		if ($error == UPLOAD_ERR_OK) {
			//nagaan hoeveel fotos deze klant reeds staan heeft
			$sql = mysql_query("SELECT * FROM gallery WHERE cID=".$customer_id);
			$i = mysql_num_rows($sql)+1;
			if ($i > 6 && $superuser==false) {
			  $messageStack->add('gallery_user',ERROR_TOO_MANY,'error');
			}

			if ($i < 6 || $superuser==true) { // begin superuser
			//voorwaarden nagaan: afmetingen (800x600), soort file (jpg,jpeg), bestandsgrootte (100k)
				//------------------------uitwerken en de errors wat mooier weergeven in de messagestack--------------------------------------------
				$allowed_extensions = array('jpg','JPG');
				$file = $_FILES['uploadedfile'];
				if (! preg_match('#\.(.+)$#', $file['name'][$key], $matches)) {die('File has no extension');}
				if (! in_array($matches[1], $allowed_extensions)) {die("Extension {$matches[1]} is not allowed");}
				if ($file['size'][$key]>100000) {die("file size too large");}
				if (!$file['type'][$key] == 'image/jpg') {die("wrong file type");}
				if (!is_uploaded_file($file['tmp_name'][$key])) {die("not a http upload");}
				if (!getimagesize($file['tmp_name'][$key])) {die("not an image file type");}//geeft false terug voor niet-images
				$size=getimagesize($file['tmp_name'][$key]);
				$width=$size[0];
				$height=$size[1];
				if ($width>800){die("width is too large");}
				if ($height>600){die("height is too large");}
				
				$target_path = "gallery/";						
				
				//bepalen welke de eerste vrije fotonummer is voor deze klant
				//identify the first free photo number for this customer
				$gebruikte_nummers = array();
				while($fotos = mysql_fetch_array($sql)){
						$gebruikte_nummers[] = $fotos['pID'];
				}
				
				$n = 1;
        if ($superuser==false){
					while ($n <= 5 ) {
						if (!in_array($n,$gebruikte_nummers)) {
							break;
						}
						$n ++;
					}
				}else{
					while ($n <= $i-1 ) {
						if (!in_array($n,$gebruikte_nummers)) {
							break;
						}
						$n ++;
					}
				}
				
				//$target_path = $target_path . basename( $_FILES['uploadedfile']['name']); 
				$target_path = $target_path . $customer_id."_".$n.".jpg"; 		
				if(copy($file['tmp_name'][$key], $target_path)) {
					//$messageStack->add('gallery_user','success');
					$messageStack->add('header',TEXT_FILE. ' '. basename($file['name'][$key]). ' '.TEXT_UPLOADED,'success');
					mysql_query("INSERT INTO gallery (cID,pID) VALUES (".$customer_id.",".$n.")");
					tep_redirect(tep_href_link(FILENAME_GALLERY));
				} else{
					//$messageStack->add('There was an error uploading the file '.  basename($file['name'][$key]). ', please try again!','error');
					$messageStack->add('header','There was an error uploading the file '.  basename($file['name'][$key]). ', please try again!','error');
				}
			
			}//end superuser
		}
	}
}


  $breadcrumb->add(NAVBAR_TITLE, tep_href_link('gallery_user.php'));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<script type="text/javascript" src="highslide/highslide.js"></script>

<script type="text/javascript">    
hs.registerOverlay({
	overlayId: 'closebutton',
	position: 'top right',
	fade: 2 // fading the semi-transparent overlay looks bad in IE
});

hs.graphicsDir = 'highslide/graphics/';
</script>

<style type="text/css">
.highslide-wrapper div {font-family: Verdana, Helvetica;font-size: 10pt;}
.highslide {cursor: url(highslide/graphics/zoomin.cur), pointer;outline: none;text-decoration: none;}
.highslide-active-anchor img {visibility: hidden;}
.highslide img {/*border: 2px solid gray;*/}
.highslide:hover img {border-color: silver;}
.highslide-wrapper, .drop-shadow {background: white;}
.highslide-image {border: 10px solid white;}
.highslide-image-blur {}
.highslide-html {background-color: white;}
.highslide-html-blur {}
.highslide-html-content {position: absolute;display: none;width: 300px;}
.highslide-body{padding: 0 10px 10px 10px;}
.highslide-caption {
    display: none;
    border: 0px solid #745224;
    font-family: Verdana, Helvetica;
	text-align:right;
	font-style:italic;
	font-weight:bold;
    font-size: 10pt;
	padding:10px;
	background: white;
}
.highslide-loading {
    display: block;
	color: black;
	font-size: 8pt;
	font-family: sans-serif;
	font-weight: bold;
    text-decoration: none;
	padding: 2px;
	border: 1px solid black;
    background-color: white;
    
    padding-left: 22px;
    background-image: url(highslide/graphics/loader.white.gif);
    background-repeat: no-repeat;
    background-position: 3px 1px;
}

a.highslide-credits,
a.highslide-credits i {
    padding: 2px;
    color: silver;
    text-decoration: none;
	font-size: 10px;
}
a.highslide-credits:hover,
a.highslide-credits:hover i {
    color: white;
    background-color: gray;
}
a.highslide-full-expand {
	background: url(highslide/graphics/fullexpand.gif) no-repeat;
	display: block;
	margin: 0 10px 10px 0;
	width: 34px;
	height: 34px;
}
.highslide-overlay {
	display: none;
}
.highslide-wrapper .highslide-header {
	padding-bottom: 5px;
}
.highslide-wrapper .highslide-header ul {
	margin: 0;
	padding: 0;
	text-align: right;
}
.highslide-wrapper .highslide-header ul li {
	display: inline;
	padding-left: 1em;
}
.highslide-wrapper .highslide-header ul li.highslide-previous, .highslide-wrapper .highslide-header ul li.highslide-next {
	display: none;
}
.highslide-wrapper .highslide-header a {
	font-weight: bold;
	text-transform: uppercase;
	text-decoration: none;
}
.highslide-wrapper .highslide-header a:hover {
	color: black;
}
.highslide-wrapper .highslide-header .highslide-move a {
	cursor: move;
}
.control {
	float: right;
    display: block;
    /*position: relative;*/
	margin: 0 5px;
	font-size: 9pt;
    font-weight: bold;
	text-decoration: none;
	text-transform: uppercase;
}
.control:hover {
	color: black !important;
}
.highslide-move {
    cursor: move;
}
</style>

  <title><?php echo TITLE; ?></title></head><?php

  $content = CONTENT_GALLERY_USER;
  include (bts_select('main', $content_template));
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
