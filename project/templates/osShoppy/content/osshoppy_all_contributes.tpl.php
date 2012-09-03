<?php
  $corner_top_left = 'square';
  $corner_top_right = 'square';
?>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
<?php if (USE_HEADING_TITLE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
<?php } ?>
<?php if (USE_HEADING_IMAGE_ON_ALL_PAGES == 'true') { ?>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'filepics/filepic_oss.png', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
<?php } ?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
	<tr>
     <td>
      <table width="97%" border="0" align="center">
	<td valign="top">
<!-- features contributes //-->
     <table border="0" width="97%" cellspacing="0" cellpadding="0" align="center">
	  <tr>
        <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
		<td width="100%" height="14" class="infoBoxHeading"><?php echo HEADING_INSTALLED_FEATURES ?></td>
        <td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
</tr>
     </table>
       <table border="0" width="97%" cellspacing="0" cellpadding="1" class="infoBox" align="center">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
      <tr>
        <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
      <tr>
        <td class="boxText"><?php echo TEXT_INSTALLED_FEATURES; ?></td>
      </tr>
      <tr>
         <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
     </table>
    </td>
   </tr>
     </table>
<!-- features contributes_eof //-->
	</td>
    <td valign="top">
<!-- credit contributes //-->
     <table border="0" width="97%" cellspacing="0" cellpadding="0" align="center">
	  <tr>
        <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
        <td width="100%" height="14" class="infoBoxHeading"><?php echo HEADING_INSTALLED_CREDIT_MODULES ?></td>
        <td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
      </tr>
     </table>
       <table border="0" width="97%" cellspacing="0" cellpadding="1" class="infoBox" align="center">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
      <tr>
        <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
      <tr>
        <td class="boxText"><?php echo TEXT_INSTALLED_CREDIT_MODULES; ?></td>
      </tr>
      <tr>
         <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
     </table>
    </td>
   </tr>
     </table>
<!-- credit contributes_eof //-->
<?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
<!-- payment contributes //-->
     <table border="0" width="97%" cellspacing="0" cellpadding="0" align="center">
	  <tr>        
        <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
		<td width="100%" height="14" class="infoBoxHeading"><?php echo HEADING_INSTALLED_PAYMENT ?></td>        
        <td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
</tr>
     </table>
       <table border="0" width="97%" cellspacing="0" cellpadding="1" class="infoBox" align="center">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
      <tr>
        <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
      <tr>
        <td class="boxText"><?php echo TEXT_INSTALLED_PAYMENT; ?></td>
      </tr>
      <tr>
         <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
     </table>
    </td>
   </tr>
     </table>
<!-- payment contributes_eof //-->
<?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
<!-- reports contributes //-->
     <table border="0" width="97%" cellspacing="0" cellpadding="0" align="center">
	  <tr>        
        <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
		<td width="100%" height="14" class="infoBoxHeading"><?php echo HEADING_INSTALLED_REPORTS ?></td>        
        <td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
</tr>
     </table>
       <table border="0" width="97%" cellspacing="0" cellpadding="1" class="infoBox" align="center">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
      <tr>
        <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
      <tr>
        <td class="boxText"><?php echo TEXT_INSTALLED_REPORTS; ?></td>
      </tr>
      <tr>
         <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
     </table>
    </td>
   </tr>
     </table>
<!-- reports contributes_eof //-->
<?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
<!-- shipping contributes //-->
     <table border="0" width="97%" cellspacing="0" cellpadding="0" align="center">
	  <tr>        
        <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
		<td width="100%" height="14" class="infoBoxHeading"><?php echo HEADING_INSTALLED_SHIPPING ?></td>        
        <td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
</tr>
     </table>
       <table border="0" width="97%" cellspacing="0" cellpadding="1" class="infoBox" align="center">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
      <tr>
        <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
      <tr>
        <td class="boxText"><?php echo TEXT_INSTALLED_SHIPPING; ?></td>
      </tr>
      <tr>
         <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
     </table>
    </td>
   </tr>
     </table>
<!-- shipping contributes_eof //-->
<?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
<!-- templates contributes //-->
     <table border="0" width="97%" cellspacing="0" cellpadding="0" align="center">
	  <tr>        
        <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
		<td width="100%" height="14" class="infoBoxHeading"><?php echo HEADING_INSTALLED_TEMPLATES ?></td>        
        <td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
</tr>
     </table>
       <table border="0" width="97%" cellspacing="0" cellpadding="1" class="infoBox" align="center">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
      <tr>
        <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
      <tr>
        <td class="boxText"><?php echo TEXT_INSTALLED_TEMPLATES; ?></td>
      </tr>
      <tr>
         <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
     </table>
    </td>
   </tr>
     </table>
<!-- templates contributes_eof //-->
<?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
<!-- zones contributes //-->
     <table border="0" width="97%" cellspacing="0" cellpadding="0" align="center">
	  <tr>        
        <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
		<td width="100%" height="14" class="infoBoxHeading"><?php echo HEADING_INSTALLED_ZONES ?></td>        
		<td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
</tr>
     </table>
       <table border="0" width="97%" cellspacing="0" cellpadding="1" class="infoBox" align="center">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
      <tr>
        <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
      <tr>
        <td class="boxText"><?php echo TEXT_INSTALLED_ZONES; ?></td>
      </tr>
      <tr>
         <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
     </table>
    </td>
   </tr>
     </table>
<!-- zones contributes_eof //-->
<?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
<!-- infoboxes contributes //-->
     <table border="0" width="97%" cellspacing="0" cellpadding="0" align="center">
	  <tr>
        <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
		<td width="100%" height="14" class="infoBoxHeading"><?php echo HEADING_INSTALLED_INFOBOXES ?></td>        
        <td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
</tr>
     </table>
       <table border="0" width="97%" cellspacing="0" cellpadding="1" class="infoBox" align="center">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
      <tr>
        <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
      <tr>
        <td class="boxText"><?php echo TEXT_INSTALLED_INFOBOXES; ?></td>
      </tr>
      <tr>
         <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
     </table>
    </td>
   </tr>
     </table>
<!-- infoboxes contributes_eof //-->
<?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
<!-- languages contributes //-->
     <table border="0" width="97%" cellspacing="0" cellpadding="0" align="center">
	  <tr>        
        <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
		<td width="100%" height="14" class="infoBoxHeading"><?php echo HEADING_INSTALLED_LANGUAGES ?></td>        
        <td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
</tr>
     </table>
       <table border="0" width="97%" cellspacing="0" cellpadding="1" class="infoBox" align="center">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
      <tr>
        <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
      <tr>
        <td class="boxText"><?php echo TEXT_INSTALLED_LANGUAGES; ?></td>
      </tr>
      <tr>
         <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
     </table>
    </td>
   </tr>
     </table>
<!-- languages contributes_eof //-->
<?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
<!-- order total contributes //-->
     <table border="0" width="97%" cellspacing="0" cellpadding="0" align="center">
	  <tr>        
        <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
		<td width="100%" height="14" class="infoBoxHeading"><?php echo HEADING_INSTALLED_ORDER_TOTAL ?></td>        
        <td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
</tr>
     </table>
       <table border="0" width="97%" cellspacing="0" cellpadding="1" class="infoBox" align="center">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
      <tr>
        <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
      <tr>
        <td class="boxText"><?php echo TEXT_INSTALLED_ORDER_TOTAL; ?></td>
      </tr>
      <tr>
         <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
     </table>
    </td>
   </tr>
     </table>
<!-- order total contributes_eof //-->
<?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
<!-- other contributes //-->
     <table border="0" width="97%" cellspacing="0" cellpadding="0" align="center">
	  <tr>        
        <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
		<td width="100%" height="14" class="infoBoxHeading"><?php echo HEADING_INSTALLED_OTHER ?></td>        
        <td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
</tr>
     </table>
       <table border="0" width="97%" cellspacing="0" cellpadding="1" class="infoBox" align="center">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
      <tr>
        <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
      <tr>
        <td class="boxText"><?php echo TEXT_INSTALLED_OTHER; ?></td>
      </tr>
      <tr>
         <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
     </table>
    </td>
   </tr>
     </table>
<!-- other contributes_eof //-->
<?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
<!-- images contributes //-->
     <table border="0" width="97%" cellspacing="0" cellpadding="0" align="center">
	  <tr>
        <td height="14" class="infoBoxHeading"><img src="images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'corner_right_left.gif';	break; case 'square_1': echo 'corner_right_left_1.gif';	break; case 'square_2': echo 'corner_right_left_2.gif';	break; case 'square_3': echo 'corner_right_left_3.gif';	break; case 'square_4': echo 'corner_right_left_4.gif';	break; case 'rounded': echo 'corner_top_left.gif'; break; case 'rounded_1': echo 'corner_top_left_1.gif'; break; case 'rounded_2': echo 'corner_top_left_2.gif'; break; case 'rounded_3': echo 'corner_top_left_3.gif'; break; case 'rounded_4': echo 'corner_top_left_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
		<td width="100%" height="14" class="infoBoxHeading"><?php echo HEADING_INSTALLED_IMAGES ?></td>
        <td height="14" class="infoBoxHeading" nowrap><?php echo $boxLink; ?><img src="images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'corner_right_left.gif'; break; case 'square_1': echo 'corner_right_left_1.gif'; break; case 'square_2': echo 'corner_right_left_2.gif'; break; case 'square_3': echo 'corner_right_left_3.gif'; break; case 'square_4': echo 'corner_right_left_4.gif'; break; case 'rounded': echo 'corner_top_right.gif'; break; case 'rounded_1': echo 'corner_top_right_1.gif'; break; case 'rounded_2': echo 'corner_top_right_2.gif'; break; case 'rounded_3': echo 'corner_top_right_3.gif'; break; case 'rounded_4': echo 'corner_top_right_4.gif'; break; } ?>" border="0" alt="" width="11" height="14"></td>
</tr>
     </table>
       <table border="0" width="97%" cellspacing="0" cellpadding="1" class="infoBox" align="center">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
      <tr>
        <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
      <tr>
        <td class="boxText"><?php echo TEXT_INSTALLED_IMAGES; ?></td>
      </tr>
      <tr>
         <td><img src="templates/osShoppy/boxes/images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
      </tr>
     </table>
    </td>
   </tr>
     </table>
<!-- images contributes_eof //-->
</td>
  </tr>
	  </table>
     </td>
    </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '20'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
		        <td><a href="javascript:history.go(-1)"><?php echo tep_image_button('button_back.png', IMAGE_BUTTON_BACK); ?></a></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.png', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table>

