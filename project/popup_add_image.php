<?php //$Id: /catalog/popup_add_image.php (1032)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_POPUP_ADD_IMAGE);

  $navigation->remove_current_page();

  if (!empty($_GET['imagesID'])) {
    $products_query = tep_db_query( "SELECT ai.products_id, ai.images_description, ai.thumb_images, ai.medium_images, ai.popup_images, p.products_image, p.products_image_med, p.products_image_pop, p.products_image_description FROM " . TABLE_ADDITIONAL_IMAGES . " ai, " . TABLE_PRODUCTS . " p WHERE ai.products_id=p.products_id and ai.additional_images_id = '".(int)$_GET['imagesID']."'");
    $selected_image = tep_db_fetch_array($products_query);
  } elseif (!empty($_GET['pID'])) {
    $products_query = tep_db_query( "SELECT products_id, products_image, products_image_med, products_image_pop, products_image_description FROM " . TABLE_PRODUCTS . " WHERE products_id = '".(int)$_GET['pID']."'");
    $selected_image = tep_db_fetch_array($products_query);
  }

  $imagemenu = new displaypopupimagemenu ( $selected_image['products_id'] );

  // calculate menu size in pixels
  $extra_window_width = 50;  // space for web browser
  $extra_window_height = 150;  // space for web browser

  if (ADDIMAGES_POPUP_SHOW_ON_POPUP == 'true' && ($imagemenu->addimages_count > 1)) {
    list ($menu_width, $menu_height) = $imagemenu->boxsize();
    if (ADDIMAGES_POPUP_TABLE_LOCATION == 'sides') { 
      $extra_window_width += $menu_width; 
      if ($imagemenu->maximageheight < $menu_height) { $imagemenu->maximageheight = $menu_height; }
    }
    if (ADDIMAGES_POPUP_TABLE_LOCATION == 'above' || ADDIMAGES_POPUP_TABLE_LOCATION == 'below') { 
      $extra_window_height += $menu_height; 
      if ($imagemenu->maximagewidth < $menu_width) { $imagemenu->maximagewidth = $menu_width; }
    }
  }
  $imagemenu->maximageheight += 22; // add space for large image description text height
  

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<title><?php echo $selected_image['images_description']; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="stylesheet.css">
<script language="javascript"><!--
var i=0;
function resize() {
  if (window.navigator.userAgent.indexOf('MSIE 6.0') != -1 && window.navigator.userAgent.indexOf('SV1') != -1) { 
           i=23; //IE 6.x on Windows XP SP2
  } else if (window.navigator.userAgent.indexOf('MSIE 6.0') != -1) { 
           i=50; //IE 6.x somewhere else
  } else if (window.navigator.userAgent.indexOf('MSIE 7.0') != -1) { 
           i=-20;  //IE 7.x 
  } else if (window.navigator.userAgent.indexOf('Firefox') != -1 && window.navigator.userAgent.indexOf("Windows") != -1) { 
           i=-20; //Firefox on Windows
  } else if (window.navigator.userAgent.indexOf('Mozilla') != -1 && window.navigator.userAgent.indexOf("Windows") != -1 && window.navigator.userAgent.indexOf("MSIE") == -1) { 
           i=45; //Mozilla on Windows, but not IE7    
  } else if (window.opera && document.childNodes) {
           i=50; //Opera 7+
  } else if (navigator.vendor == 'KDE' && window.navigator.userAgent.indexOf("Konqueror") != -1) {
             i=-4; //Konqueror- this works ok with small images but not so great with large ones
           //if you tweak it make sure i remains negative
  } else { 
           i=0; //All other browsers
  }

  imgWidth = <?php echo $imagemenu->maximagewidth; ?>+<?php echo $extra_window_width; ?>;
  imgHeight = <?php echo $imagemenu->maximageheight; ?>+<?php echo $extra_window_height; ?>-i;
  var width = screen.width;
  var height = screen.height;
  var leftpos = width / 2 - imgWidth / 2;
  var toppos = height / 2 - imgHeight / 2;
  window.moveTo(leftpos, toppos);
  
  if (document.getElementById("mainimage")) window.resizeTo(<?php echo (!empty($imagemenu->maximagewidth)?$imagemenu->maximagewidth:'document.getElementById("mainimage").width'); ?>+<?php echo $extra_window_width; ?>, <?php echo (!empty($imagemenu->maximageheight)?$imagemenu->maximageheight:'document.getElementById("mainimage").height'); ?>+<?php echo $extra_window_height; ?>-i);
  self.focus();
}
function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=100,height=100,screenX=150,screenY=150,top=150,left=150');
}
function showImage(img,width,height,reptext) {
  if (document.getElementById("mainimage")) {
    document.getElementById("mainimage").src = img;
    document.getElementById("mainimage").height = height;
    document.getElementById("mainimage").width = width;
    document.getElementById("mainimage").title = reptext;
    document.getElementById("mainimage").alt = reptext;
    document.getElementById("mainimagedesc").innerHTML = reptext;
  }
}
//--></script>
</head>
<body onLoad="resize();"><center>
<?php 
    if (ADDIMAGES_POPUP_TABLE_LOCATION=='above' && ADDIMAGES_POPUP_SHOW_ON_POPUP=='true' && ($imagemenu->addimages_count > 1)) {
      echo '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td valign="middle" align="center" class="pageHeading">' . TEXT_MENU_TITLE . '</td></tr><tr><td valign="middle" align="center">' . $imagemenu->altgroupoutput() . '</td></tr></table>';
    }

    echo '<table border="0" cellspacing="0" cellpadding="0"><tr>';
    if (ADDIMAGES_POPUP_TABLE_LOCATION=='sides' && (ADDIMAGES_POPUP_TABLE_ALIGNMENT=='left' || ADDIMAGES_POPUP_TABLE_ALIGNMENT=='center') && ADDIMAGES_POPUP_SHOW_ON_POPUP=='true' && ($imagemenu->addimages_count > 1)) {
      echo '<td valign="middle" align="center" class="pageHeading"><!-- groupout -->' . TEXT_MENU_TITLE . '<br>' . $imagemenu->groupoutput() . '<!-- end: groupout --></td>';
    }

    if (ADDIMAGES_POPUP_TABLE_LOCATION=='sides') { $table_width = ''.$imagemenu->maximagewidth; } else { $table_width = '100%'; }
	echo '<td valign="middle" align="center" style="width:'.$table_width.';">';
    if (!empty($_GET['imagesID'])) {
      echo tep_image(DIR_WS_IMAGES . (!empty($selected_image['popup_images'])?$selected_image['popup_images']:(!empty($selected_image['medium_images'])?$selected_image['medium_images']:(!empty($selected_image['thumb_images'])?$selected_image['thumb_images']:''))), $selected_image['images_description'], (ADDIMAGES_POPUP_RESTRICT_IMAGE_SIZE=='true'?POPUP_IMAGE_WIDTH:''), (ADDIMAGES_POPUP_RESTRICT_IMAGE_SIZE=='true'?POPUP_IMAGE_HEIGHT:''), 'id="mainimage"') . (!empty($selected_image['images_description'])?'<br><span id="mainimagedesc">'.$selected_image['images_description'].'</span>':'');
    } elseif (!empty($_GET['pID'])) {
      echo tep_image(DIR_WS_IMAGES . (!empty($selected_image['products_image_pop'])?$selected_image['products_image_pop']:(!empty($selected_image['products_image_med'])?$selected_image['products_image_med']:(!empty($selected_image['products_image'])?$selected_image['products_image']:''))), $selected_image['products_image_description'], (ADDIMAGES_POPUP_RESTRICT_IMAGE_SIZE=='true'?POPUP_IMAGE_WIDTH:''), (ADDIMAGES_POPUP_RESTRICT_IMAGE_SIZE=='true'?POPUP_IMAGE_HEIGHT:''), 'id="mainimage"') . (!empty($selected_image['products_image_description'])?'<br><span id="mainimagedesc">'.$selected_image['products_image_description'].'</span>':'');
    }
    echo '</td>';

    if (ADDIMAGES_POPUP_TABLE_LOCATION=='sides' && ADDIMAGES_POPUP_TABLE_ALIGNMENT=='right' && ADDIMAGES_POPUP_SHOW_ON_POPUP=='true' && ($imagemenu->addimages_count > 1)) {
      echo '<td valign="middle" align="center" class="pageHeading">' . TEXT_MENU_TITLE . '<br>' . $imagemenu->groupoutput() . '</td>';
    }
    if (!empty($imagemenu->maximagewidth) && !empty($imagemenu->maximageheight)) { echo '<td>' . tep_draw_separator('pixel_trans.gif', '4', $imagemenu->maximageheight) . '</td>'; }
    echo '</tr></table>';

    if (ADDIMAGES_POPUP_TABLE_LOCATION=='below' && ADDIMAGES_POPUP_SHOW_ON_POPUP=='true' && ($imagemenu->addimages_count > 1)) {
      echo '<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td valign="middle" align="center" class="pageHeading">' . TEXT_MENU_TITLE . '</td></tr><tr><td valign="middle" align="center">' . $imagemenu->altgroupoutput() . '</td></tr></table>';
    }
?></center>
&nbsp;<br style="line-height:8px;" />
<center><a href="javascript:window.close();"><?php echo TEXT_CLOSE_WINDOW; ?></a></center>
</body>
</html>
<?php require('includes/application_bottom.php'); ?>
