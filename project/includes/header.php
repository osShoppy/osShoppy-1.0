<?php //$Id: /catalog/includes/header.php (osC)

// check if the 'install' directory exists, and warn of its existence
  if (WARN_INSTALL_EXISTENCE == 'true') {
    if (file_exists(dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install')) {
      $messageStack->add('header', WARNING_INSTALL_DIRECTORY_EXISTS, 'warning');
    }
  }

// check if the configure.php file is writeable
  if (WARN_CONFIG_WRITEABLE == 'true') {
    if ( (file_exists(dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php')) && (is_writeable(dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php')) ) {
      $messageStack->add('header', WARNING_CONFIG_FILE_WRITEABLE, 'warning');
    }
  }

// check if the session folder is writeable
  if (WARN_SESSION_DIRECTORY_NOT_WRITEABLE == 'true') {
    if (STORE_SESSIONS == '') {
      if (!is_dir(tep_session_save_path())) {
        $messageStack->add('header', WARNING_SESSION_DIRECTORY_NON_EXISTENT, 'warning');
      } elseif (!is_writeable(tep_session_save_path())) {
        $messageStack->add('header', WARNING_SESSION_DIRECTORY_NOT_WRITEABLE, 'warning');
      }
    }
  }

// check session.auto_start is disabled
  if ( (function_exists('ini_get')) && (WARN_SESSION_AUTO_START == 'true') ) {
    if (ini_get('session.auto_start') == '1') {
      $messageStack->add('header', WARNING_SESSION_AUTO_START, 'warning');
    }
  }

  if ( (WARN_DOWNLOAD_DIRECTORY_NOT_READABLE == 'true') && (DOWNLOAD_ENABLED == 'true') ) {
    if (!is_dir(DIR_FS_DOWNLOAD)) {
      $messageStack->add('header', WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT, 'warning');
    }
  }

// BOF QPBPP for SPPC
// query names of products for which the min order quantity was not met or 
// didn't match the quantity blocks
  $moq_pids = array();
  $qtb_pids = array();
  if (isset($_SESSION['min_order_qty_not_met']) && count($_SESSION['min_order_qty_not_met']) > 0) {
    foreach ($_SESSION['min_order_qty_not_met'] as $moq_key => $moq_pid) {
      if ((int)$moq_pid > 0) {
        $moq_pids[] = (int)$moq_pid;
      }
    }
  } // end if (isset($_SESSION['min_order_qty_not_met']) && ...

  if (isset($_SESSION['qty_blocks_not_met']) && count($_SESSION['qty_blocks_not_met']) > 0) {
    foreach ($_SESSION['qty_blocks_not_met'] as $qtb_key => $qtb_pid) {
      if ((int)$qtb_pid > 0) {
        $qtb_pids[] = (int)$qtb_pid;
      }
    }
   } // end if (isset($_SESSION['qty_blocks_not_met']) &&
   $moq_qtb_pids = array_merge($moq_pids, $qtb_pids);
   $moq_qtb_pids = array_unique($moq_qtb_pids);

    if (count($moq_qtb_pids) > 0  && tep_not_null($moq_qtb_pids[0])) {
        if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
           $customer_group_id = $_SESSION['sppc_customer_group_id'];
        } else {
           $customer_group_id = '0';
        }
        if ($customer_group_id == '0') {
          $product_names_query = tep_db_query("select p.products_id, pd.products_name, p.products_min_order_qty, p.products_qty_blocks from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id in (" . implode(',', $moq_qtb_pids) . ") and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");
        } else {
          $product_names_query = tep_db_query("select pd.products_id, pd.products_name, pg.products_min_order_qty, pg.products_qty_blocks from " . TABLE_PRODUCTS_DESCRIPTION . " pd left join (select products_id, products_min_order_qty, products_qty_blocks from " . TABLE_PRODUCTS_GROUPS . " where customers_group_id = '" . $customer_group_id . "' and products_id in (" . implode(',', $moq_qtb_pids) . ")) pg on pd.products_id = pg.products_id where pd.products_id in (" . implode(',', $moq_qtb_pids) . ") and pd.language_id = '" . (int)$languages_id . "'");
        }
      while ($_product_names = tep_db_fetch_array($product_names_query)) {
        if (in_array($_product_names['products_id'], $moq_pids)) {
          $messageStack->add('cart_notice', sprintf(MINIMUM_ORDER_NOTICE, $_product_names['products_name'], $_product_names['products_min_order_qty']), 'warning');
        }
        if (in_array($_product_names['products_id'], $qtb_pids)) {
          $messageStack->add('cart_notice', sprintf(QUANTITY_BLOCKS_NOTICE, $_product_names['products_name'], $_product_names['products_qty_blocks']), 'warning');
        }
      }      
    } // end if (count($moq_qtb_pids) > 0))
// EOF QPBPP for SPPC

  if ($messageStack->size('header') > 0) {
    echo $messageStack->output('header');
  }
// BOF QPBPP for SPPC
// show messages in header if the page we are at is not catalog/shopping_cart.php
  if (basename($_SERVER['PHP_SELF']) != FILENAME_SHOPPING_CART && $messageStack->size('cart_notice') > 0) {
    echo $messageStack->output('cart_notice');
  }
// EOF QPBPP for SPPC
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr class="header">
    <td valign="middle"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo.png', STORE_NAME) . '</a>'; ?></td>
    <td align="right" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image(DIR_WS_IMAGES . 'header_account.gif', HEADER_TITLE_MY_ACCOUNT) . '</a>&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'header_cart.gif', HEADER_TITLE_CART_CONTENTS) . '</a>&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . tep_image(DIR_WS_IMAGES . 'header_checkout.gif', HEADER_TITLE_CHECKOUT) . '</a>'; ?>&nbsp;&nbsp;</td>
  </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="1">
  <tr class="headerNavigation">
    <td class="headerNavigation">&nbsp;&nbsp;<?php echo $breadcrumb->trail(' &raquo; '); ?></td>
    <td align="right" class="headerNavigation"><?php if (tep_session_is_registered('customer_id')) { ?><a href="<?php echo tep_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_LOGOFF; ?></a> &nbsp;|&nbsp; <?php } ?><a href="<?php echo tep_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a> &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CART_CONTENTS; ?></a> &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CHECKOUT; ?></a> &nbsp;&nbsp;</td>
  </tr>
</table>
<?php
  if (isset($HTTP_GET_VARS['error_message']) && tep_not_null($HTTP_GET_VARS['error_message'])) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="headerError">
    <td class="headerError"><?php echo htmlspecialchars(stripslashes(urldecode($HTTP_GET_VARS['error_message']))); ?></td>
  </tr>
</table>
<?php
  }

  if (isset($HTTP_GET_VARS['info_message']) && tep_not_null($HTTP_GET_VARS['info_message'])) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="headerInfo">
    <td class="headerInfo"><?php echo htmlspecialchars(stripslashes(urldecode($HTTP_GET_VARS['info_message']))); ?></td>
  </tr>
</table>
<?php
  }
?>
