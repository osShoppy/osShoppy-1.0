<?php //$Id: /catalog/includes/print_header.php (0000) ?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr class="header">
    <td valign="center" align="left"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo.png', STORE_NAME) . '</a>'; ?></td> <td class="main" valign="center" align="right"><B>
<?php echo nl2br(STORE_NAME_ADDRESS); ?></B></td>
<td class="main" valign="center" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
  </tr>
</table>
<table border="0" width="100%" height="27"cellspacing="0" cellpadding="0">
  <tr class="headerNavigation">
    <td class="headerNavigation" align="center"><a href="#" onclick="window.print();return false">
<?php echo PRINT_ORDER_HEADER_TEXT ?></td>
  </tr>
</table>
<?php
  if (isset($HTTP_GET_VARS['error_message']) && tep_not_null($HTTP_GET_VARS['error_message'])) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr class="headerError">
    <td class="headerError"><?php echo htmlspecialchars(urldecode($HTTP_GET_VARS['error_message'])); ?></td>
  </tr>
</table>
<?php
  }

  if (isset($HTTP_GET_VARS['info_message']) && tep_not_null($HTTP_GET_VARS['info_message'])) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr class="headerInfo">
    <td class="headerInfo"><?php echo htmlspecialchars($HTTP_GET_VARS['info_message']); ?></td>
  </tr>
</table>
<?php
  }
?>
