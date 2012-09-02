<?php //$Id: /catalog/admin/gallery.php (6181)

  require('includes/application_top.php');

if ($_POST['actie'] =='Save' && isset($_POST['comment'])) {
	$comment=$_POST['comment'];
	$cID=$_POST['cID'];
	$pID=$_POST['pID'];
	mysql_query("UPDATE gallery SET comment='".$comment."' WHERE cID=".$cID." AND pID=".$pID) or die(mysql_error());
	$messageStack->add('comment updated successfully', 'success');
}


if ($_POST['actie'] =='Save' && isset($_POST['description'])) {
	$description=$_POST['description'];
	$cID=$_POST['cID'];
	$pID=$_POST['pID'];
	mysql_query("UPDATE gallery SET description='".$description."' WHERE cID=".$cID." AND pID=".$pID) or die(mysql_error());
	$messageStack->add('description updated successfully', 'success');
}
if ($_POST['actie'] =='Save' && isset($_POST['title'])) {
	$title=$_POST['title'];
	$cID=$_POST['cID'];
	$pID=$_POST['pID'];
	mysql_query("UPDATE gallery SET title='".$title."' WHERE cID=".$cID." AND pID=".$pID) or die(mysql_error());
	$messageStack->add('title updated successfully', 'success');
}


if (isset($_GET['delpic'])) {
	unlink('../gallery/'.$_GET['cID']."_".$_GET['pID'].".jpg");
	$cID = $_GET['cID'];
	$pID = $_GET['pID'];
	mysql_query("DELETE FROM gallery WHERE cID=".$cID." AND pID=".$pID);
	$messageStack->add('The picture has been removed successfully.','success');
}
function empty_folder($folder, $debug = false){    
    if ($debug) { 
        echo "Cleaning folder $folder ... <br>"; 
    } 
    $d = dir($folder); 
    while (false !== ($entry = $d->read())) { 
        $isdir = is_dir($folder."/".$entry); 
        if (!$isdir and $entry!="." and $entry!="..") { 
            unlink($folder."/".$entry); 
        } elseif ($isdir  and $entry!="." and $entry!="..") { 
            empty_folder($folder."/".$entry,$debug); 
            rmdir($folder."/".$entry); 
        } 
    } 
    $d->close(); 
} 
if (isset($_GET['cleanthumbs'])) {
	empty_folder("../gallery/thumbnails",true);
	$messageStack->add('Thumbnail folder has been cleaned.','success');
}

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">

<script language="javascript" src="includes/general.js"></script>
<script language="javascript"><!--

function validate(field) {
  var valid = "0123456789."
  var ok = "yes";
  var temp;
 for (var i=0; i<field.value.length; i++) {
  temp = "" + field.value.substring(i, i+1);
  if (valid.indexOf(temp) == "-1") ok = "no";
  }
  if (ok == "no") {
    alert("<?php echo POINTS_ENTER_JS_ERROR; ?>");
    field.focus();
    field.value = "";
  }
}
//--></script>
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
    <td width="100%" valign="top" class="main">
	<?php
	if (isset($_GET['editcomment'])) {
		$cID=$_GET['cID'];
		$pID=$_GET['pID'];
		$commentaar = mysql_fetch_array(mysql_query("SELECT comment FROM gallery WHERE cID=".$cID." AND pID=".$pID)) or die(mysql_error());
		?>
		<table>
		  <tr>
		    <td class="main">
		      <form action="gallery.php?gID=1&selected_box=configuration" method="post">
		      <textarea name="comment" style="width:500px;height:300px;"><?php echo $commentaar['comment'];?></textarea>
		      <input type="hidden" name="cID" value="<?php echo $cID;?>">
		      <input type="hidden" name="pID" value="<?php echo $pID;?>">
		      <br><input type="submit" name="actie" value="Save">
		</form>
		</td>
		<td class="main" valign="top">
		<u>Instructions:</u>
		<ol>
		<li>The <--> codes should always be kept between 2 comments.</li>
		<li>The /// codes should always be kept between the users name and his comment.</li>
		<li>To remove all comments, simple delete the entire content of the textarea and click save.</li>
		<li>The first comment should not be preceded by the <--> code.</li>
		</ol>
		</td>
		</tr>
		</table>
		<?php
		
		
		
		
		
		
//########################
	}elseif (isset($_GET['edittitle'])) {
		$cID=$_GET['cID'];
		$pID=$_GET['pID'];
		$title = mysql_fetch_array(mysql_query("SELECT title FROM gallery WHERE cID=".$cID." AND pID=".$pID)) or die(mysql_error());
		?>
		<table>
		  <tr>
		    <td class="main">
		      <form action="gallery.php?gID=1&selected_box=configuration" method="post">
		        <textarea name="title" style="width:500px;height:300px;"><?php echo $title['title'];?></textarea>
		        <input type="hidden" name="cID" value="<?php echo $cID;?>">
		        <input type="hidden" name="pID" value="<?php echo $pID;?>">
		        <br><input type="submit" name="actie" value="Save">
		      </form>
		    </td>
		    <td class="main" valign="top">
			    <u><?php echo TEXT_INSTRUCTIONS ?></u>
					<ol>
					  <li><?php echo NOTE_ADD_TITLE ?></li>
					</ol>
		    </td>
		  </tr>
		</table>
		<?php
//########################
	}elseif (isset($_GET['editdescription'])) {
		$cID=$_GET['cID'];
		$pID=$_GET['pID'];
		$description = mysql_fetch_array(mysql_query("SELECT description FROM gallery WHERE cID=".$cID." AND pID=".$pID)) or die(mysql_error());
		?>
		<table>
		  <tr>
		    <td class="main">
		      <form action="gallery.php?gID=1&selected_box=configuration" method="post">
		        <textarea name="description" style="width:500px;height:300px;"><?php echo $description['description'];?></textarea>
		        <input type="hidden" name="cID" value="<?php echo $cID;?>">
		        <input type="hidden" name="pID" value="<?php echo $pID;?>">
		        <br><input type="submit" name="actie" value="Save">
		      </form>
		    </td>
		    <td class="main" valign="top">
			    <u><?php echo TEXT_INSTRUCTIONS ?></u>
					<ol>
					  <li><?php echo NOTE_ADD_DESCRIPTION ?></li>
					</ol>
		    </td>
		  </tr>
		</table>
		<?php

		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
	} else {
	  $qry_query_raw = "select cID, pID from ".TABLE_GALLERY;
    $qry_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_GALLERY_PICS, $qry_query_raw, $qry_query_numrows);
    $qry = tep_db_query($qry_query_raw);
?>
		        <table>
              <tr>
                <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $qry_split->display_count($qry_query_numrows, MAX_GALLERY_PICS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_PHOTOS); ?></td>
                    <td class="smallText" align="right"><?php echo $qry_split->display_links($qry_query_numrows, MAX_GALLERY_PICS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page']); ?></td>
                  </tr>
                </table></td>
              </tr>
		        </table>
	
	<?php
		
		//$qry = mysql_query("SELECT cID,pID FROM gallery") or die(mysql_error());
		$kolom = 1;
		$aantal_kol = 2; //number of pictures per row
		echo '  <table width="100%">';
		while ($fotos = mysql_fetch_array($qry)) {
		  if ($kolom == 1) {
		    echo '<tr>';
		  }
      $dir= DIR_WS_CATALOG."gallery/";
			$file = $fotos['cID'].'_'.$fotos['pID'].".jpg";
			
			
			
			
			
			

			?>
			          <td class="main" valign="middle">
			            <?php echo tep_image($dir . $file, '', 75, 75, 'hspace="5" vspace="5"').'<br>'.$fotos['cID']. '_' .$fotos['pID']; ?>
			          </td>
			          <td width="50%">
								  <?php echo '<a href="'.tep_href_link('gallery.php', 'gID=1&selected_box=configuration&edittitle&cID='.$fotos['cID'].'&pID='.$fotos['pID']).'">'.EDIT_TITLE.'</a><br>'; ?>
									<?php echo '<a href="'.tep_href_link('gallery.php', 'gID=1&selected_box=configuration&editdescription&cID='.$fotos['cID'].'&pID='.$fotos['pID']).'">'.EDIT_DESCRIPTION.'</a><br>'; ?>
									<?php echo '<a href="'.tep_href_link('gallery.php', 'gID=1&selected_box=configuration&editcomment&cID='.$fotos['cID'].'&pID='.$fotos['pID']).'">'.EDIT_COMMENT.'</a><br>'; ?>
									<?php echo '<a href="'.tep_href_link('gallery.php', 'gID=1&selected_box=configuration&delpic&cID='.$fotos['cID'].'&pID='.$fotos['pID']).'" onclick="return confirm(\'Are you sure you want to delete?\')">'.EDIT_DELETE_PIC.'</a>'; ?>
			          </td>

                
<?php
      if ($kolom == $aantal_kol) {
				echo '</tr>';
        echo '<tr><td colspan="'. $aantal_kol*2 .'">';
        echo tep_draw_separator('pixel_black.gif', '100%', '1');
        echo '</td></tr>';
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
				$kolom = 0;
			}
			$kolom ++;
		}
		echo '<tr><a href="'.tep_href_link('gallery.php', 'gID=1&selected_box=configuration&cleanthumbs').'">'.TEXT_CLEAN_THUMBS.'</a></tr>';
    ?>
    </table>
    
<?php
	}
	?>
	</td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br></body></html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>










