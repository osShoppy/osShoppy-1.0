<?php //$Id: /catalog/gallery_process.php (6181)

  require('includes/application_top.php');
	if (!tep_session_is_registered('customer_id')) {
	  tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
	}
	require(DIR_WS_LANGUAGES . $language . '/gallery_user.php');

if (isset($_GET['edit']) && $_GET['edit']=='yes') {
	$cID = (int)$_GET['cID'];
	$pID = (int)$_GET['pID'];
	$sql = mysql_fetch_array(mysql_query("SELECT title, description FROM gallery WHERE cID=".$cID." AND pID=".$pID)) or die(mysql_error());
	if ($sql['title']=='') {
		$titel = SET_TITLE;
	} else {
		$titel = tep_db_prepare_input($sql['title']);
	}
	if ($sql['description']=='') {
		$desc = SET_DESCRIPTION;
	} else {
		$desc = tep_db_prepare_input($sql['description']);
	}
?>
	<form name="form" action="gallery_user.php" method="post" target="_parent">
	<input type="text" name="title" value="<?php echo $titel;?>" onClick="this.select()">
	<input type="hidden" name="cID" value="<?php echo (int)$_GET['cID'];?>">
	<input type="hidden" name="pID" value="<?php echo (int)$_GET['pID'];?>">
	<textarea name="description" onClick="this.select()"><?php echo $desc;?></textarea>
	<input type="submit" value="save" name="edittitle">
	</form>

<?php
} else {
	$name = tep_db_input($_POST['comment_naam']);
	$comment_field = tep_db_input($_POST['comment_tekst']);
	$cID =$_POST['cID'];
	$pID = $_POST['pID'];

	$existing_comments = mysql_fetch_array(mysql_query("SELECT comment FROM gallery WHERE cID=".$cID." AND pID=".$pID)) or die(mysql_error());
	if ($existing_comments['comment'] != '') {
	  $spacer="\n".'<-->'."\n";
	}
	$new_comment = $existing_comments['comment'].$spacer.$name."///".$comment_field;
	mysql_query("UPDATE gallery SET comment='".$new_comment."' WHERE cID=".$cID." AND pID=".$pID);
  tep_redirect(tep_href_link(FILENAME_GALLERY));

}
?>