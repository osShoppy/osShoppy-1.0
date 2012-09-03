<?php //$Id: /catalog/install/templates/pages/install_4.php

  require('../includes/database_tables.php');

  osc_db_connect(trim($HTTP_POST_VARS['DB_SERVER']), trim($HTTP_POST_VARS['DB_SERVER_USERNAME']), trim($HTTP_POST_VARS['DB_SERVER_PASSWORD']));
  osc_db_select_db(trim($HTTP_POST_VARS['DB_DATABASE']));

  osc_db_query('update ' . TABLE_CONFIGURATION . ' set configuration_value = "' . trim($HTTP_POST_VARS['CFG_STORE_NAME']) . '" where configuration_key = "STORE_NAME"');
  osc_db_query('update ' . TABLE_CONFIGURATION . ' set configuration_value = "' . trim($HTTP_POST_VARS['CFG_STORE_OWNER_NAME']) . '" where configuration_key = "STORE_OWNER"');
  osc_db_query('update ' . TABLE_CONFIGURATION . ' set configuration_value = "' . trim($HTTP_POST_VARS['CFG_STORE_URL']) . '" where configuration_key = "STORE_URL"');
  osc_db_query('update ' . TABLE_CONFIGURATION . ' set configuration_value = "' . trim($HTTP_POST_VARS['CFG_STORE_OWNER_EMAIL_ADDRESS']) . '" where configuration_key = "STORE_OWNER_EMAIL_ADDRESS"');

  if (!empty($HTTP_POST_VARS['CFG_STORE_OWNER_NAME']) && !empty($HTTP_POST_VARS['CFG_STORE_OWNER_EMAIL_ADDRESS'])) {
    osc_db_query('update ' . TABLE_CONFIGURATION . ' set configuration_value = "\"' . trim($HTTP_POST_VARS['CFG_STORE_OWNER_NAME']) . '\" <' . trim($HTTP_POST_VARS['CFG_STORE_OWNER_EMAIL_ADDRESS']) . '>" where configuration_key = "EMAIL_FROM"');
  }

/*
//commented out for admin level accounts 
$check_query = osc_db_query('select user_name from ' . TABLE_ADMINISTRATORS . ' where user_name = "' . trim($HTTP_POST_VARS['CFG_ADMINISTRATOR_USERNAME']) . '"');

  if (osc_db_num_rows($check_query)) {
    osc_db_query('update ' . TABLE_ADMINISTRATORS . ' set user_password = "' . osc_encrypt_string(trim($HTTP_POST_VARS['CFG_ADMINISTRATOR_PASSWORD'])) . '" where user_name = "' . trim($HTTP_POST_VARS['CFG_ADMINISTRATOR_USERNAME']) . '"');
  } else {
    osc_db_query('insert into ' . TABLE_ADMINISTRATORS . ' (user_name, user_password) values ("' . trim($HTTP_POST_VARS['CFG_ADMINISTRATOR_USERNAME']) . '", "' . osc_encrypt_string(trim($HTTP_POST_VARS['CFG_ADMINISTRATOR_PASSWORD'])) . '")');
  }
*/
?>

<div class="mainBlock">
  <h1>Installatie Stap 5</h1>
  <div class="stepsBox">
    <ol>
      <li>Database Server</li>
      <li>Web Server</li>
      <li>Installeer Voorbeeld Data</li>
      <li>Online Winkel Instellingen</li>
      <li style="font-weight: bold; color:#CCC">Einde Installatie!</li>
    </ol>
  </div>


  <p>Deze web gebaseerde wizard installatie zal <?php echo PROJECT_VERSION ?> configuren en op uw webserver installeren.</p>
  <p><font color="#FF6600">Na deze stap dient u van de twee <b>configure.php</b> files de bestandsrechten terug te zetten van <b>777</b> naar <b>644</b>!<br />
  De installatie map dient u te verwijderen uit de root van uw site. <b>Dit is uit veiligheidsredenen vereist!</b> </font></p>
  <b>Wanneer hulp vereist is bij de verschillende stappen raadpleeg dan de documentatie bestanden op <a href="http://www.osshoppy.com" target="_blank"><u>osShoppy</u></a>.</b><br /><br /></p>
</div>

<div class="contentBlock">
  <div class="infoPane">
    <h3>Einde Installatie!</h3>

    <div class="infoPaneContents">
      <p>Van harte gefeliciteerd met de installatie en configuratie van <?php echo PROJECT_VERSION ?>.</p>
      <p>Om in te loggen in het administratie paneel gebruikt u het volgend gebruikersnaam en wachtwoord;</p>
      <p><b>gebruikersnaam: <font color="#33CC66">change@mail.nl</font></b>
      <p><b>wachtwoord: <font color="#33CC66">changeme</font></b></p>
      <p><font color="#FF6600"><center><b>Verander gebruikersnaam en wachtwoord meteen bij de eerste keer inloggen op uw administratie paneel!</b></center></font></p>
      <p><center>Het Hilvy Team wenst uw veel succes met uw eigen online webwinkel!</center></p>
      <p align="right"><b>- hilvy.nl</b></p>
    </div>
  </div>

  <div class="contentPane">
    <h2>Einde Installatie!</h2>

<?php
  $dir_fs_document_root = $HTTP_POST_VARS['DIR_FS_DOCUMENT_ROOT'];
  if ((substr($dir_fs_document_root, -1) != '\\') && (substr($dir_fs_document_root, -1) != '/')) {
    if (strrpos($dir_fs_document_root, '\\') !== false) {
      $dir_fs_document_root .= '\\';
    } else {
      $dir_fs_document_root .= '/';
    }
  }

  $http_url = parse_url($HTTP_POST_VARS['HTTP_WWW_ADDRESS']);
  $http_server = $http_url['scheme'] . '://' . $http_url['host'];
  $http_catalog = $http_url['path'];
  if (isset($http_url['port']) && !empty($http_url['port'])) {
    $http_server .= ':' . $http_url['port'];
  }

  if (substr($http_catalog, -1) != '/') {
    $http_catalog .= '/';
  }

  $file_contents = '<?php' . "\n" .
                   '  define(\'HTTP_SERVER\', \'' . $http_server . '\');' . "\n" .
                   '  define(\'HTTPS_SERVER\', \'' . $http_server . '\');' . "\n" .
                   '  define(\'ENABLE_SSL\', false);' . "\n" .
                   '  define(\'HTTP_COOKIE_DOMAIN\', \'' . $http_url['host'] . '\');' . "\n" .
                   '  define(\'HTTPS_COOKIE_DOMAIN\', \'' . $http_url['host'] . '\');' . "\n" .
                   '  define(\'HTTP_COOKIE_PATH\', \'' . $http_catalog . '\');' . "\n" .
                   '  define(\'HTTPS_COOKIE_PATH\', \'' . $http_catalog . '\');' . "\n" .
                   '  define(\'DIR_WS_HTTP_CATALOG\', \'' . $http_catalog . '\');' . "\n" .
                   '  define(\'DIR_WS_HTTPS_CATALOG\', \'' . $http_catalog . '\');' . "\n" .
                   '  define(\'DIR_WS_IMAGES\', \'images/\');' . "\n" .
                   '  define(\'DIR_WS_ICONS\', DIR_WS_IMAGES . \'icons/\');' . "\n" .
                   '  define(\'DIR_WS_INCLUDES\', \'includes/\');' . "\n" .
                   '  define(\'DIR_WS_BOXES\', DIR_WS_INCLUDES . \'boxes/\');' . "\n" .
                   '  define(\'DIR_WS_COLUMNS_BOXES\', DIR_WS_INCLUDES . \'columns_boxes/\');' . "\n" .
                   '  define(\'DIR_WS_FUNCTIONS\', DIR_WS_INCLUDES . \'functions/\');' . "\n" .
                   '  define(\'DIR_WS_CLASSES\', DIR_WS_INCLUDES . \'classes/\');' . "\n" .
                   '  define(\'DIR_WS_MODULES\', DIR_WS_INCLUDES . \'modules/\');' . "\n" .
                   '  define(\'DIR_WS_LANGUAGES\', DIR_WS_INCLUDES . \'languages/\');' . "\n\n" .
                   '  define(\'DIR_WS_DOCUMENTS\', \'documents/\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG_DOCUMENTS\', DIR_FS_CATALOG . \'documents/\');' . "\n" .
                   '  define(\'DIR_WS_DOWNLOAD_PUBLIC\', \'pub/\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG\', \'' . $dir_fs_document_root . '\');' . "\n" .
                   '  define(\'DIR_FS_DOWNLOAD\', DIR_FS_CATALOG . \'download/\');' . "\n" .
                   '  define(\'DIR_FS_DOWNLOAD_PUBLIC\', DIR_FS_CATALOG . \'pub/\');' . "\n\n" .
                   '  define(\'DB_SERVER\', \'' . trim($HTTP_POST_VARS['DB_SERVER']) . '\');' . "\n" .
                   '  define(\'DB_SERVER_USERNAME\', \'' . trim($HTTP_POST_VARS['DB_SERVER_USERNAME']) . '\');' . "\n" .
                   '  define(\'DB_SERVER_PASSWORD\', \'' . trim($HTTP_POST_VARS['DB_SERVER_PASSWORD']) . '\');' . "\n" .
                   '  define(\'DB_DATABASE\', \'' . trim($HTTP_POST_VARS['DB_DATABASE']) . '\');' . "\n" .
                   '  define(\'USE_PCONNECT\', \'false\');' . "\n" .
                   '  define(\'STORE_SESSIONS\', \'mysql\');' . "\n" .
                   '?>';

  $fp = fopen($dir_fs_document_root . 'includes/configure.php', 'w');
  fputs($fp, $file_contents);
  fclose($fp);

  $file_contents = '<?php' . "\n" .
                   '  define(\'HTTP_SERVER\', \'' . $http_server . '\');' . "\n" .
                   '  define(\'HTTP_CATALOG_SERVER\', \'' . $http_server . '\');' . "\n" .
                   '  define(\'HTTPS_CATALOG_SERVER\', \'' . $http_server . '\');' . "\n" .
                   '  define(\'ENABLE_SSL_CATALOG\', \'false\');' . "\n" .
                   '  define(\'DIR_FS_DOCUMENT_ROOT\', \'' . $dir_fs_document_root . '\');' . "\n" .
                   '  define(\'DIR_WS_ADMIN\', \'' . $http_catalog . 'admin/\');' . "\n" .
                   '  define(\'DIR_FS_ADMIN\', \'' . $dir_fs_document_root . 'admin/\');' . "\n" .
                   '  define(\'DIR_WS_CATALOG\', \'' . $http_catalog . '\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG\', \'' . $dir_fs_document_root . '\');' . "\n" .
                   '  define(\'DIR_WS_IMAGES\', \'images/\');' . "\n" .
                   '  define(\'DIR_WS_ICONS\', DIR_WS_IMAGES . \'icons/\');' . "\n" .
                   '  define(\'DIR_WS_CATALOG_IMAGES\', DIR_WS_CATALOG . \'images/\');' . "\n" .
                   '  define(\'DIR_WS_INCLUDES\', \'includes/\');' . "\n" .
                   '  define(\'DIR_WS_BOXES\', DIR_WS_INCLUDES . \'boxes/\');' . "\n" .
                   '  define(\'DIR_WS_MANUAL_BOXES\', DIR_WS_INCLUDES . \'manual_boxes/\');' . "\n" .
                   '  define(\'DIR_WS_FUNCTIONS\', DIR_WS_INCLUDES . \'functions/\');' . "\n" .
                   '  define(\'DIR_WS_CLASSES\', DIR_WS_INCLUDES . \'classes/\');' . "\n" .
                   '  define(\'DIR_WS_MODULES\', DIR_WS_INCLUDES . \'modules/\');' . "\n" .
                   '  define(\'DIR_WS_LANGUAGES\', DIR_WS_INCLUDES . \'languages/\');' . "\n" .
                   '  define(\'DIR_WS_CATALOG_LANGUAGES\', DIR_WS_CATALOG . \'includes/languages/\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG_LANGUAGES\', DIR_FS_CATALOG . \'includes/languages/\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG_IMAGES\', DIR_FS_CATALOG . \'images/\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG_MODULES\', DIR_FS_CATALOG . \'includes/modules/\');' . "\n" .
                   '  define(\'DIR_FS_BACKUP\', DIR_FS_ADMIN . \'backups/\');' . "\n" .
                   '  define(\'DIR_WS_DOCUMENTS\', \'documents/\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG_DOCUMENTS\', DIR_FS_CATALOG . \'documents/\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG_DOWNLOAD\', DIR_FS_CATALOG . \'download/\');' . "\n" .
                   '  define(\'DB_SERVER\', \'' . trim($HTTP_POST_VARS['DB_SERVER']) . '\');' . "\n" .
                   '  define(\'DB_SERVER_USERNAME\', \'' . trim($HTTP_POST_VARS['DB_SERVER_USERNAME']) . '\');' . "\n" .
                   '  define(\'DB_SERVER_PASSWORD\', \'' . trim($HTTP_POST_VARS['DB_SERVER_PASSWORD']) . '\');' . "\n" .
                   '  define(\'DB_DATABASE\', \'' . trim($HTTP_POST_VARS['DB_DATABASE']) . '\');' . "\n" .
                   '  define(\'USE_PCONNECT\', \'false\');' . "\n" .
                   '  define(\'STORE_SESSIONS\', \'mysql\');' . "\n" .
                   '?>';

  $fp = fopen($dir_fs_document_root . 'admin/includes/configure.php', 'w');
  fputs($fp, $file_contents);
  fclose($fp);
?>

    <p><b><center><font color="#33CC66">De installatie en configuratie van <?php echo PROJECT_VERSION ?> is succesvol ge&iuml;nstalleerd!</b></p></font></center>

    <br />

    <table border="0" width="99%" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" width="50%"><a href="<?php echo $http_server . $http_catalog . 'index.php'; ?>" target="_blank"><img src="images/button_catalog.png" border="0" alt="Catalog" style="padding-bottom:20px" /></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $http_server . $http_catalog . 'admin/index.php'; ?>" target="_blank"><img src="images/button_administration.png" border="0" alt="Administration Tool" style="padding-bottom:20px" /></a></td>
      </tr>
    </table>
  </div>
</div>
