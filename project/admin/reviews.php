<?php //$Id: /catalog/admin/reviews.php (4397)

  require('includes/application_top.php');

	$action = (isset($_GET['action']) ? $_GET['action'] : '');
  $select = (isset($_GET['show']) ? $_GET['show'] : false);

	$preview_x = $_POST['preview_x'];
	$preview_y = $_POST['preview_y'];
	$back_x = $_POST['back_x'];
	$back_y = $_POST['back_y'];
  if ($action == 'new' && ($preview_x || $preview_y)) {
	$action = 'newpreview';
  unset($_POST['preview_x']);
	unset($_POST['preview_y']);
	}
	if ($action == 'new' && ($back_x || $back_y)) {
	$action = 'newreview';
  unset($_POST['back_x']);
	unset($_POST['back_y']);
	}
	if ($action == 'update' && ($preview_x || $preview_y)) {
	$action = 'preview';
  unset($_POST['preview_x']);
	unset($_POST['preview_y']);
	}
	if ($action == 'update' && ($back_x || $back_y)) {
	$action = 'edit';
  unset($_POST['back_x']);
	unset($_POST['back_y']);
	}
  if (tep_not_null($action)) {
    switch ($action) {
//*** <Reviews Mod>
	  case 'new':
        $products_id = tep_db_prepare_input($_POST['products_id']);
		$customers_id = 0; 
		$_POST['date_added'] = $_POST['select_day'].'/'.$_POST['select_month'].'/'.$_POST['select_year'];
		$date_added = tep_store_date(tep_db_prepare_input($_POST['date_added']));
		$customer_name = tep_db_prepare_input($_POST['customer_name']);
    $reviews_rating = tep_db_prepare_input($_POST['reviews_rating']);
		$language_id = tep_db_prepare_input($_POST['language_id']);
		$products_name = tep_db_prepare_input($_POST['language_id']);
		$reviews_text = tep_db_prepare_input($_POST['reviews_text']);
        tep_db_query("insert into " . TABLE_REVIEWS . " (products_id, customers_id, customers_name, reviews_rating, date_added) values ('" . $products_id . "', '" . (int)$customer_id . "', '" . $customer_name . "', '" . $reviews_rating . "', '" . $date_added . "')");
		$insert_id = tep_db_insert_id();    
        tep_db_query("insert into " . TABLE_REVIEWS_DESCRIPTION . " (reviews_id, languages_id, reviews_text) values ('" . (int)$insert_id . "', '" . (int)$language_id . "', '" . tep_db_input($reviews_text) . "')");
        tep_redirect(tep_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&rID=' . $insert_id));
          break;
//*** </Reviews Mod end> 
      case 'update':
			  $products_id = tep_db_prepare_input($_POST['products_id']);
        $reviews_id = tep_db_prepare_input($_GET['rID']);
        $reviews_rating = tep_db_prepare_input($_POST['reviews_rating']);
        $reviews_text = tep_db_prepare_input($_POST['reviews_text']);
//*** <Reviews Mod>
        $_POST['date_added'] = $_POST['select_day'].'/'.$_POST['select_month'].'/'.$_POST['select_year'];
				$date_added = tep_store_date(tep_db_prepare_input($_POST['date_added']));
        $last_modified = tep_db_prepare_input($_POST['last_modified']);
        $customers_name = tep_db_prepare_input($_POST['customers_name']);
        tep_db_query("update " . TABLE_REVIEWS . " set products_id = '" . tep_db_input($products_id) . "', reviews_rating = '" . tep_db_input($reviews_rating) . "', last_modified = now(), customers_name = '" . $customers_name . "', date_added = '" . $date_added . "' where reviews_id = '" . (int)$reviews_id . "'");
//*** </Reviews Mod end>
        tep_db_query("update " . TABLE_REVIEWS_DESCRIPTION . " set reviews_text = '" . tep_db_input($reviews_text) . "' where reviews_id = '" . (int)$reviews_id . "'");
				tep_redirect(tep_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&rID=' . $reviews_id));
        break;
      case 'deleteconfirm':
        $reviews_id = tep_db_prepare_input($_GET['rID']);

        tep_db_query("delete from " . TABLE_REVIEWS . " where reviews_id = '" . (int)$reviews_id . "'");
        tep_db_query("delete from " . TABLE_REVIEWS_DESCRIPTION . " where reviews_id = '" . (int)$reviews_id . "'");

        tep_redirect(tep_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' )));
        break;
//*** <Reviews Mod>
      case 'approve_review':
        $reviews_id = tep_db_prepare_input($_GET['rID']);
        tep_db_query("update " . TABLE_REVIEWS . " set approved=1 where reviews_id = " . $reviews_id);
        tep_redirect(tep_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&rID=' . $reviews_id));
        break;
      case 'disapprove_review':
        $reviews_id = tep_db_prepare_input($_GET['rID']);
        tep_db_query("update " . TABLE_REVIEWS . " set approved=0 where reviews_id = " . $reviews_id);
        tep_redirect(tep_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&rID=' . $reviews_id));
        break;
//*** </Reviews Mod end>
			
    }
  }
	  $products_array = array();
		$select_array[0] = array('id' => '', 'text' => 'All');
    $products_query = tep_db_query("select p.products_id, pd.products_name, p.products_price from " . TABLE_PRODUCTS . " p, " .  TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and  pd.language_id = '" . (int)$languages_id . "' order by products_name");
	while ($products = tep_db_fetch_array($products_query)) {
			$products_array[] = array('id' => $products['products_id'], 'text' => $products['products_name']);
    }
    $select_array = array_merge($select_array, $products_array);	
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="SetFocus();">
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
						<td class="main" align="right"><?php 
						if (!$action) 
						echo tep_draw_form('sel', FILENAME_REVIEWS, 'page=' . $_GET['page'], 'get').'Show Product: ' . tep_draw_pull_down_menu('show', $select_array, $select, 'onChange="this.form.submit();" style="font-size:10px"');
?><noscript><input  title="View" name="" type="submit" value="Go"></noscript></form></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 200, 1); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
//*** <Reviews Mod>
  if ($action == 'newreview') {
  
	require(DIR_WS_CLASSES . 'currencies.php');
    $currencies = new currencies();
   
	$languages = tep_get_languages();
	$language_array = array();
	for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
      $language_array[] = array('id' => (int)$languages[$i]['id'],
		                     'text' => $languages[$i]['name']);
	}


?>
      <script language="javascript"><!--
function checkForm() {
  var error = 0;
  var error_message = "<?php echo JS_ERROR; ?>";

  if (document.forms["review"].reviews_text.value.length < <?php echo REVIEW_TEXT_MIN_LENGTH; ?>) {
    error_message = error_message + "<?php echo JS_REVIEW_TEXT; ?>";
    error = 1;
  }

  if ((document.forms["review"].reviews_rating[0].checked) || (document.forms["review"].reviews_rating[1].checked) || (document.forms["review"].reviews_rating[2].checked) || (document.forms["review"].reviews_rating[3].checked) || (document.forms["review"].reviews_rating[4].checked)) {
  } else {
    // error_message = error_message + "<?php echo JS_REVIEW_RATING; ?>";
    error = 0;
  }

  if (document.forms["review"].customer_name.value.length < 2) {
    error_message = error_message + "<?php echo JS_REVIEW_ERROR_TEXT; ?>";
    error = 1;
  }

  if (error == 1) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}
//--></script>
      <!-- -------------NEW REVIEW----------- -->
      <?php echo tep_draw_form('review', FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&action=new', 'post', 'onSubmit="return checkForm();"  enctype="multipart/form-data"'); ?>
	  <tr>
        <td><table border="0" cellspacing="2" cellpadding="2"><!-- FILENAME_CUSTOMERS, tep_get_all_get_params(array('action')) -->
          <tr>
            <td class="main" valign="top"><?php echo ENTRY_PRODUCT; ?></td>
			<td class="main" valign="top" align="left"><?php echo tep_draw_pull_down_menu('products_id', $products_array,$_POST['products_id'], 'style="font-size:10px"' );?></td>
          </tr>
		  <tr>
            <td class="main" valign="top"><?php echo ENTRY_NAME; ?></td>
			<td class="main" valign="top" align="left"><?php echo tep_draw_input_field('customer_name', (isset($_POST['customer_name']) ? $_POST['customer_name'] : ''), 'size="40"'); ?></td>
          </tr>
					<tr>
            <td class="main" valign="top"><?php echo ENTRY_DATE; ?></td>
			<td class="main" valign="top" align="left"><?php 
								$year='';if (isset($_POST['select_year'])){$year=$_POST['select_year'];}
								$month='';if (isset($_POST['select_month'])){$month=$_POST['select_month'];}
								$day='';if (isset($_POST['select_day'])){$day=$_POST['select_day'];}
								tep_draw_pull_down_date($day, $month, $year, true, 2002); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table witdh="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="main" valign="top"><b>
			   <?php echo ENTRY_REVIEW; ?></b>
				 
				
			   <br><br>
			   <?php
		       echo ENTRY_LANGUAGE . " " . tep_draw_pull_down_menu('language_id', $language_array, '', 'style="font-size:10px"');?>
			   <br><br>
			   <?php echo tep_draw_textarea_field('reviews_text', 'soft', '60', '15', tep_db_output(tep_break_string(tep_noslash_string($_POST['reviews_text']), 15)),'', false); ?></td>
          </tr>
          <tr>
            <td class="smallText" align="right"><?php echo ENTRY_REVIEW_TEXT; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td align="left"><table border="0" width="200px" cellspacing="0" cellpadding="0">
				<tr>
       <td class="main" valign="top"><b><?php echo ENTRY_RATING; ?>&nbsp;</b></td><td align="left"><?php for ($i=1; $i<=5; $i++) echo tep_draw_radio_field('reviews_rating', $i, '', $rInfo->reviews_rating) . tep_image(DIR_WS_IMAGES . 'icons/stars/stars_' . $i . '.gif') . '<br>'; ?></td>
				</tr>
												</table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td align="right" class="main"><?php 
				echo '<a href="' . tep_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' )) . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a> ';
				echo tep_image_submit('button_preview.png', IMAGE_PREVIEW, 'name="preview"');
				echo '&nbsp;' . tep_image_submit('button_insert.png', IMAGE_INSERT); ?></td>
	  </tr> </form>  <!-- -----------NEW REVIEW PREVIEW------------- -->
      <?

  } else if ($action == 'newpreview') {
	$languages = tep_get_languages();
    $language_id = $_POST['language_id'];
    $products_query = tep_db_query("select p.products_id, pd.products_name, p.products_image from " . TABLE_PRODUCTS . " p, " .  TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = '" . $language_id . "' and p.products_id = '" . $_POST['products_id'] . "'");
    $products = tep_db_fetch_array($products_query);
		$_POST['date_added'] = $_POST['select_year'].'/'.$_POST['select_month'].'/'.$_POST['select_day'];
?>
      <?php echo tep_draw_form('new', FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&action=new', 'post', 'enctype="multipart/form-data"'); ?>
      <tr>
		<td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="main" valign="top"><b><?php echo ENTRY_PRODUCT; ?></b> <?php echo $products['products_name']; ?><br /><br /><b><?php echo ENTRY_FROM; ?></b> <?php echo $_POST['customer_name']; ?><br /><br /><b><?php echo ENTRY_DATE; ?></b> <?php echo tep_date_long($_POST['date_added']); ?><br /></td>
            <td class="main" align="right" valign="top"><?php echo tep_image(HTTP_CATALOG_SERVER . DIR_WS_CATALOG_IMAGES . $products['products_image'], $products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'hspace="5" vspace="5"'); ?></td>
          </tr>
        </table>
      </tr>
      <tr>
        <td><table witdh="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top" class="main"><b>
			   <?php echo ENTRY_REVIEW; ?></b>
			   <br><br>
			   <?php
		       echo ENTRY_LANGUAGE . " " . $languages[$language_id - 1]['name'];?>
			   <br><br>
			   <?php echo nl2br(tep_db_output(tep_break_string(tep_noslash_string($_POST['reviews_text']), 15))); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo ENTRY_RATING; ?></b>&nbsp;<?php echo ($_POST['reviews_rating'] ? tep_image(DIR_WS_CATALOG_IMAGES . 'icons/stars/stars_' . $_POST['reviews_rating'] . '.gif', sprintf(TEXT_OF_5_STARS, $_POST['reviews_rating'])) : '' ); ?>&nbsp;<small>[<?php echo sprintf(TEXT_OF_5_STARS,$_POST['reviews_rating']); ?>]</small></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
<?php
    if (tep_not_null($_POST)) {
/* Re-Post all POST'ed variables */
      reset($_POST);
      while(list($key, $value) = each($_POST)) echo tep_draw_hidden_field($key, $value);
?>
      <tr>
        <td align="right" class="smallText"><?php echo tep_image_submit('button_back.png', IMAGE_BACK, 'name="back"') . '&nbsp;' . tep_image_submit('button_update.png', IMAGE_UPDATE) . ' <a href="' . tep_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' )) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>'; ?></td>
      </tr>
	  </form>
<?php
    }
  } else if ($action == 'edit') {    // ------EDIT=-------- 
//*** </Reviews Mod end>
    $rID = tep_db_prepare_input($_GET['rID']);

    $reviews_query = tep_db_query("select r.reviews_id, r.products_id, r.customers_name, r.date_added, r.last_modified, r.reviews_read, rd.reviews_text, r.reviews_rating from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd where r.reviews_id = '" . (int)$rID . "' and r.reviews_id = rd.reviews_id");
    $reviews = tep_db_fetch_array($reviews_query);

    $products_query = tep_db_query("select products_image from " . TABLE_PRODUCTS . " where products_id = '" . (int)$reviews['products_id'] . "'");
    $products = tep_db_fetch_array($products_query);


	  $rInfo_array = array_merge($reviews, $products);
    $rInfo = new objectInfo($rInfo_array);
?>
      <tr><?php echo tep_draw_form('review', FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&rID=' . $_GET['rID'] . '&action=update', 'post', 'enctype="multipart/form-data"'); ?>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
<?php //*** <Reviews Mod> ?>  <!-- EDIT DATA -->
            <td class="main" valign="top"><b><?php echo ENTRY_PRODUCT; ?></b> <?php echo $rInfo->products_name; ?>
						<?php echo tep_draw_pull_down_menu('products_id', $products_array,(isset($_POST['products_id']) ? $_POST['products_id'] : $reviews['products_id']), 'style="font-size:10px"' );?>
						<br><b><?php echo ENTRY_FROM; ?></b> <?php echo tep_draw_input_field('customers_name', $rInfo->customers_name, 'size="40"'); ?><br><br>
<b><?php echo ENTRY_DATE; ?></b> 
<?php  list($year,$month,$day) = explode("-",$rInfo->date_added);
$day = substr($rInfo->date_added, 8, 2);
if (isset($_POST['select_day'])){$day=$_POST['select_day'];}
if (isset($_POST['select_month'])){$month=$_POST['select_month'];}
if (isset($_POST['select_year'])){$year=$_POST['select_year'];}
	tep_draw_pull_down_date($day, $month, $year, true, 2002); ?></td>
<?php //*** </Reviews Mod end> $tesdat= tep_date_short(customers_name)?>
            <td class="main" align="right" valign="top"><?php echo tep_image(HTTP_CATALOG_SERVER . DIR_WS_CATALOG_IMAGES . $rInfo->products_image, $rInfo->products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'hspace="5" vspace="5"'); ?></td>
          </tr>
        </table></td>
      </tr>
			<?php $review_text = (isset($_POST['reviews_text']) ? tep_db_output(tep_break_string(tep_noslash_string($_POST['reviews_text']), 15)) : $rInfo->reviews_text); ?>
      <tr>
        <td><table witdh="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="main" valign="top"><b><?php echo ENTRY_REVIEW; ?></b><br><br><?php echo tep_draw_textarea_field('reviews_text', 'soft', '60', '15', $review_text,'', false); ?></td>
          </tr>
          <tr>
            <td class="smallText" align="right"><?php echo ENTRY_REVIEW_TEXT; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table summary=""><tr><td class="main" valign="top"><b><?php echo ENTRY_RATING; ?>&nbsp;</b></td><td align="left"><?php for ($i=1; $i<=5; $i++) echo tep_draw_radio_field('reviews_rating', $i, '', $rInfo->reviews_rating) . tep_image(DIR_WS_IMAGES . 'icons/stars/stars_' . $i . '.gif') . '<br>'; ?></td></tr>
</table></td>
      </tr>
      <tr>
        <td><?php 
							
   
				
				
				echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
<?php //*** <Reviews Mod> /*tep_draw_hidden_field('customers_name', $rInfo->customers_name) . *//*tep_draw_hidden_field('date_added', tep_store_date($date_store)) . tep_draw_hidden_field('products_id', $rInfo->products_id) .tep_draw_hidden_field('products_name', $rInfo->products_name) . tep_draw_hidden_field('products_image', $rInfo->products_image) . */?>
        <td align="right" class="main"><?php  echo tep_draw_hidden_field('reviews_id', $rInfo->reviews_id) .  
tep_image_submit('button_preview.png', IMAGE_PREVIEW, 'name="preview"') . '&nbsp;' . tep_image_submit('button_update.png', IMAGE_UPDATE);

echo ' <a href="' . tep_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&rID=' . $_GET['rID']) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>'; ?></td>
<?php //*** </Reviews Mod end> ?>
      </form></tr>
<?php
  } elseif ($action == 'preview') {    //--------preview-------
    if (tep_not_null($_POST)) {
		  
		  $_POST['date_added'] = $_POST['select_year'].'/'.$_POST['select_month'].'/'.$_POST['select_day'];
      $rInfo = new objectInfo($_POST);
    	$products_query = tep_db_query("select p.products_id, pd.products_name, p.products_image from " . TABLE_PRODUCTS . " p, " .  TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = '" . $_POST['products_id'] . "'");
    	$products = tep_db_fetch_array($products_query);
    } else {
      $rID = tep_db_prepare_input($_GET['rID']);

      $reviews_query = tep_db_query("select r.reviews_id, r.products_id, r.customers_name, r.date_added, r.last_modified, r.reviews_read, rd.reviews_text, r.reviews_rating from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd where r.reviews_id = '" . (int)$rID . "' and r.reviews_id = rd.reviews_id");
      $reviews = tep_db_fetch_array($reviews_query);

      $products_name_query = tep_db_query("select p.products_id, pd.products_name, p.products_image from " . TABLE_PRODUCTS . " p, " .  TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and p.products_id = '" . (int)$reviews['products_id'] . "' and pd.language_id = '" . (int)$languages_id . "'");
      $products = tep_db_fetch_array($products_name_query);

      $rInfo_array = array_merge($reviews, $products);
      $rInfo = new objectInfo($rInfo_array);
    }
?>     <!-- OUTPUT PREVIEW -->
      <tr><?php $date_store = $_POST['date_added']; echo tep_draw_form('update', FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&rID=' . $_GET['rID'] . '&action=update', 'post', 'enctype="multipart/form-data"'); ?>
        <td><?php  //echo ' id=' . $_POST['products_id']; ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="main" valign="top"><b><?php echo ENTRY_PRODUCT; ?></b> <?php echo $products['products_name']; ?><br><b><?php echo ENTRY_FROM; ?></b> <?php echo $rInfo->customers_name; ?><br><br><b><?php echo ENTRY_DATE; ?></b> <?php $date_store = tep_store_date($rInfo->date_added); echo tep_date_long($rInfo->date_added); ?><br /><br /><br /></td>
            <td class="main" align="right" valign="top"><?php echo tep_image(HTTP_CATALOG_SERVER . DIR_WS_CATALOG_IMAGES . $products['products_image'], $products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'hspace="5" vspace="5"'); ?></td>
          </tr>
        </table>
      </tr>
      <tr>
        <td><table witdh="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top" class="main"><b><?php echo ENTRY_REVIEW; ?></b><br><br>
						<?php echo nl2br(tep_db_output(tep_break_string(tep_noslash_string($rInfo->reviews_text), 15))); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo ENTRY_RATING; ?></b>&nbsp;<?php echo ($rInfo->reviews_rating ? tep_image(DIR_WS_CATALOG_IMAGES . 'icons/stars/stars_' . $rInfo->reviews_rating . '.gif', sprintf(TEXT_OF_5_STARS, $rInfo->reviews_rating)) : '') ; ?>&nbsp;<small>[<?php echo sprintf(TEXT_OF_5_STARS, $rInfo->reviews_rating); ?>]</small></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
<?php
    if (tep_not_null($_POST)) {
/* Re-Post all POST'ed variables */
      reset($_POST);
      while(list($key, $value) = each($_POST)) echo tep_draw_hidden_field($key, $value);?>
      <tr>
        <td align="right" class="smallText"><?php echo tep_image_submit('button_back.png', IMAGE_BACK,'name="back"') . tep_image_submit('button_update.png', IMAGE_UPDATE) . ' <a href="' . tep_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&rID=' . $rInfo->reviews_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>'; ?></td>
      </form></tr>
<?php
    } else {
      if (isset($_GET['origin'])) {
        $back_url = $_GET['origin'];
        $back_url_params = '';
      } else {
        $back_url = FILENAME_REVIEWS;
        $back_url_params = 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&rID=' . $rInfo->reviews_id;
      }
?>
      <tr>
        <td align="right"><?php echo '<a href="' . tep_href_link($back_url, $back_url_params, 'NONSSL') . '">' . tep_image_button('button_back.png', IMAGE_BACK) . '</a>'; ?></td>
      </tr>
<?php
    }
  } else {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_RATING; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_DATE_ADDED; ?></td>
<?php //*** <Reviews Mod> ?>
                <td class="dataTableHeadingContent" align="center"><?php echo TEXT_APPROVED; ?></td>
<?php //*** </Reviews Mod end> ?>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
//*** <Reviews Mod> Review LIST ----------------------
    if ($select) 
				$reviews_query_raw = "select reviews_id, products_id, last_modified, reviews_rating, approved, date_added from " . TABLE_REVIEWS . " where products_id = '" . (int)$select . "' order by date_added DESC";
		     else
				$reviews_query_raw = "select reviews_id, products_id, last_modified, reviews_rating, approved, date_added from " . TABLE_REVIEWS . " order by date_added DESC";
//*** </Reviews Mod end>
    $reviews_split = new splitPageResults($_GET['page'], MAX_SEARCH_RESULTS_ADMIN, $reviews_query_raw, $reviews_query_numrows);
    $reviews_query = tep_db_query($reviews_query_raw);
    while ($reviews = tep_db_fetch_array($reviews_query)) {
      if ((!isset($_GET['rID']) || (isset($_GET['rID']) && ($_GET['rID'] == $reviews['reviews_id']))) && !isset($rInfo)) {
        $reviews_text_query = tep_db_query("select r.reviews_read, r.customers_name, rd.reviews_text as review_text, length(rd.reviews_text) as reviews_text_size from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd where r.reviews_id = '" . (int)$reviews['reviews_id'] . "' and r.reviews_id = rd.reviews_id");
        $reviews_text = tep_db_fetch_array($reviews_text_query);

        $products_image_query = tep_db_query("select products_image from " . TABLE_PRODUCTS . " where products_id = '" . (int)$reviews['products_id'] . "'");
        $products_image = tep_db_fetch_array($products_image_query);

        $products_name_query = tep_db_query("select products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$reviews['products_id'] . "' and language_id = '" . (int)$languages_id . "'");
        $products_name = tep_db_fetch_array($products_name_query);

        $reviews_average_query = tep_db_query("select (avg(reviews_rating) / 5 * 100) as average_rating from " . TABLE_REVIEWS . " where products_id = '" . (int)$reviews['products_id'] . "'");
        $reviews_average = tep_db_fetch_array($reviews_average_query);

        $review_info = array_merge($reviews_text, $reviews_average, $products_name);
        $rInfo_array = array_merge($reviews, $review_info, $products_image);
        $rInfo = new objectInfo($rInfo_array);
      }

      if (isset($rInfo) && is_object($rInfo) && ($reviews['reviews_id'] == $rInfo->reviews_id) ) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&rID=' . $rInfo->reviews_id . '&action=preview') . '\'">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&rID=' . $reviews['reviews_id']) . '\'">' . "\n";
      }
			
			$products_name_query = tep_db_query("select products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$reviews['products_id'] . "' and language_id = '" . (int)$languages_id . "'");
    $products_name = tep_db_fetch_array($products_name_query);
			
?>
                <td class="dataTableContent"><?php 
								echo '<a href="' . tep_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&rID=' . $reviews['reviews_id'] . '&action=preview') . '">' . tep_image(DIR_WS_ICONS . 'file_icons/preview.gif', ICON_PREVIEW) . '</a>&nbsp;' . $products_name['products_name']; ?></td>
                <td class="dataTableContent" align="right"><?php echo ($reviews['reviews_rating'] ? tep_image(HTTP_CATALOG_SERVER . DIR_WS_CATALOG_IMAGES . 'icons/stars/stars_' . $reviews['reviews_rating'] . '.gif') : ''); ?></td>
                <td class="dataTableContent" align="right"><?php echo tep_date_short($reviews['date_added']); ?></td>
<?php //*** <Reviews Mod> ?>
<td class="dataTableContent" align="center"><?php echo $reviews['approved']==1? '<a href="' . tep_href_link(FILENAME_REVIEWS, tep_get_all_get_params(array('action', 'info')) . 'action=disapprove_review&rID=' . $reviews['reviews_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '</a>&nbsp;<a href="' . tep_href_link(FILENAME_REVIEWS, tep_get_all_get_params(array('action', 'info')) . 'action=disapprove_review&rID=' . $reviews['reviews_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_red_light.gif', IMAGE_ICON_STATUS_RED, 10, 10) . '</a>':'<a href="' . tep_href_link(FILENAME_REVIEWS, tep_get_all_get_params(array('action', 'info')) . 'action=approve_review&rID=' . $reviews['reviews_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '</a>&nbsp;<a href="' . tep_href_link(FILENAME_REVIEWS, tep_get_all_get_params(array('action', 'info')) . 'action=approve_review&rID=' . $reviews['reviews_id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . 'icons/status_icons/icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10) . '</a>' ?></td>
<td class="dataTableContent" align="right"><?php if ( (is_object($rInfo)) && ($reviews['reviews_id'] == $rInfo->reviews_id) ) { echo tep_image(DIR_WS_IMAGES . 'icons/info_icons/icon_arrow_right.gif'); } else { echo '<a href="' . tep_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&rID=' . $reviews['reviews_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icons/info_icons/icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
<?php //*** </Reviews Mod end> ?>
              </tr>
<?php
    }
?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $reviews_split->display_count($reviews_query_numrows, MAX_SEARCH_RESULTS_ADMIN, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></td>
                    <td class="smallText" align="right"><?php echo $reviews_split->display_links($reviews_query_numrows, MAX_SEARCH_RESULTS_ADMIN, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
                </table></td>
<?php //*** <Reviews Mod> ?>
			  </tr>
              <tr>
                <td align="right" colspan="4" class="smallText"><?php echo '<a href="' . tep_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&action=newreview') . '">' . tep_image_button('button_insert.png', IMAGE_INSERT) . '</a>'; ?></td>
               </tr>
			</table></td>
<?php //*** </Reviews Mod end> ?>
<?php
    $heading = array();
    $contents = array();

    switch ($action) {
      case 'delete':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_REVIEW . '</b>');

        $contents = array('form' => tep_draw_form('reviews', FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&rID=' . $rInfo->reviews_id . '&action=deleteconfirm'));
        $contents[] = array('text' => TEXT_INFO_DELETE_REVIEW_INTRO);
        $contents[] = array('text' => 'Review On:<br><b>' . $rInfo->products_name . '</b>');
				$contents[] = array('text' => '<br>' . TEXT_INFO_REVIEW_AUTHOR . ' ' . $rInfo->customers_name);
				$contents[] = array('text' => TEXT_INFO_DATE_ADDED . ' ' . tep_date_short($rInfo->date_added));
				$contents[] = array('text' => '<b>' . TEXT_INFO_REVIEW_TEXT . '</b> ' . substr(tep_noslash_string($rInfo->review_text), 0, 200) . '...');
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.png', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&rID=' . $rInfo->reviews_id) . '">' . tep_image_button('button_cancel.png', IMAGE_CANCEL) . '</a>');
        break;
      default:
      if (isset($rInfo) && is_object($rInfo)) {
        $heading[] = array('text' => '<b>' . $rInfo->products_name . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&rID=' . $rInfo->reviews_id . '&action=edit') . '">' . tep_image_button('button_edit.png', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_REVIEWS, 'page=' . $_GET['page'] . ($select ? '&show=' . $select : '' ) . '&rID=' . $rInfo->reviews_id . '&action=delete') . '">' . tep_image_button('button_delete.png', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_INFO_DATE_ADDED . ' ' . tep_date_short($rInfo->date_added));
        if (tep_not_null($rInfo->last_modified)) $contents[] = array('text' => TEXT_INFO_LAST_MODIFIED . ' ' . tep_date_short($rInfo->last_modified));
        $contents[] = array('text' => '<br>' . tep_info_image($rInfo->products_image, $rInfo->products_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT));
        $contents[] = array('text' => '<br>' . TEXT_INFO_REVIEW_AUTHOR . ' ' . $rInfo->customers_name);
        $contents[] = array('text' => TEXT_INFO_REVIEW_RATING . ' ' . ($rInfo->reviews_rating  ? tep_image(HTTP_CATALOG_SERVER . DIR_WS_CATALOG_IMAGES . 'icons/stars/stars_' . $rInfo->reviews_rating . '.gif') : '') );
        $contents[] = array('text' => TEXT_INFO_REVIEW_READ . ' ' . $rInfo->reviews_read);
				//if (length($rInfo->review_text) > 10) {$short-review-text = substr(review_text, 0, 10)} else {$short-review-text = review_text}
				$contents[] = array('text' => TEXT_INFO_REVIEW_TEXT . ' ' . substr(tep_noslash_string($rInfo->review_text), 0, 200) . '...');
        $contents[] = array('text' => '<br>' . TEXT_INFO_REVIEW_SIZE . ' ' . $rInfo->reviews_text_size . ' bytes');
        $contents[] = array('text' => '<br>' . TEXT_INFO_PRODUCTS_AVERAGE_RATING . ' ' . number_format($rInfo->average_rating, 2) . '%');
//*** <Reviews Mod>
        if($rInfo->approved==0){
          $contents[] = array('align' => 'left', 'text' => '<br>&nbsp;' . TEXT_APPROVED . ': ' . TEXT_NO );        
          $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_REVIEWS, tep_get_all_get_params(array('action', 'info')) . 'action=approve_review&rID=' . $rInfo->reviews_id, 'NONSSL') . '">' . tep_image_button('button_approve.png', IMAGE_APPROVE) . '</a>');
          }
        elseif($rInfo->approved==1) {
          $contents[] = array('align' => 'left', 'text' => '<br>&nbsp;' . TEXT_APPROVED . ': ' . TEXT_YES );        
          $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_REVIEWS, tep_get_all_get_params(array('action', 'info')) . 'action=disapprove_review&rID=' . $rInfo->reviews_id, 'NONSSL') . '">' . tep_image_button('button_disapprove.png', IMAGE_DISAPPROVE) . '</a>');
          }
        else{  
          $contents[] = array('align' => 'left', 'text' => '<br>&nbsp;' . TEXT_APPROVED . ': ' . "Unknown" );        
          }
//*** </Reviews Mod end>
      }
        break;
    }

    if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
      echo '            <td width="25%" valign="top">' . "\n";

      $box = new box;
      echo $box->infoBox($heading, $contents);

      echo '            </td>' . "\n";
    }
?>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table></td>
<!-- body_text_eof //-->
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
