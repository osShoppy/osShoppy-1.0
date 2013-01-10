<?php //$Id: /catalog/install/templates/pages/install_2.php

  $www_location = 'http://' . $HTTP_SERVER_VARS['HTTP_HOST'];

  if (isset($HTTP_SERVER_VARS['REQUEST_URI']) && !empty($HTTP_SERVER_VARS['REQUEST_URI'])) {
    $www_location .= $HTTP_SERVER_VARS['REQUEST_URI'];
  } else {
    $www_location .= $HTTP_SERVER_VARS['SCRIPT_FILENAME'];
  }

  $www_location = substr($www_location, 0, strpos($www_location, 'install'));

  $dir_fs_www_root = osc_realpath(dirname(__FILE__) . '/../../../') . '/';
?>

<div class="mainBlock">

  <h1>Installatie Stap 2</h1>
  <div class="stepsBox">
    <ol>
      <li>Database Server</li>
      <li style="font-weight: bold; color:#CCC">Web Server</li>
      <li>Installeer Voorbeeld Data</li>
      <li>Winkel Instellingen</li>
      <li>Einde Installatie!</li>
    </ol>
  </div>


  <p>Deze web gebaseerde wizard installatie zal <?php echo PROJECT_VERSION ?> configuren en op uw webserver installeren.</p>
  <p>In deze tweede stap wordt de mappen structuur en worden de correcte parameters ge&iuml;nstalleerd.<br />
  Vul hieronder in de invoervelden de URL van de online winkel en het pad naar de mappen op de server in.<br /><br />
  Volg de instructies op het scherm die u verder zullen helpen met de installatie van web server, installeer voorbeeld data en winkel instellingen opties.<br /><br /> 
  <b>Wanneer hulp vereist is bij de verschillende stappen raadpleeg dan de documentatie bestanden op <a href="http://www.docs.osshoppy.com" target="_blank"><u>osShoppy</u></a>.</b></p>
</div>

<div class="contentBlock">
  <div class="infoPane">
    <h3><center>Web Server</center></h3>

    <div class="infoPaneContents">
      <p>De webserver zorgt voor een soepel verloop van de pagina's van uw online winkel.
      Gasten en klanten kunnen door het snel laden van pagina's snel surfen in de webwinkel.
      De web server parameters zorgen dat de links naar pagina's juist verlopen naar de correcte locatie.</p>
    </div>
  </div>

  <div class="contentPane">
    <h2>Web Server</h2>

    <form name="install" id="installForm" action="install.php?step=3" method="post">

    <table border="0" width="99%" cellspacing="0" cellpadding="5" class="inputForm">
      <tr>
        <td class="inputField"><?php echo 'WWW Adres (URL)<br />' . osc_draw_input_field('HTTP_WWW_ADDRESS', $www_location, 'class="text"'); ?></td>
        <td class="inputDescription">Vul hier het web adres in van de online webwinkel.<br />
        							 <small>(http://mijndomeinnaam.nl/mijnonlinewinkel)</small></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Webserver Hoofd(root) Map<br />' . osc_draw_input_field('DIR_FS_DOCUMENT_ROOT', $dir_fs_www_root, 'class="text"'); ?></td>
        <td class="inputDescription">Vul hier het pad in van de locatie waar de online winkel <br />is ge&iuml;nstalleerd op de server.<br />
        							 <small>(usr/home/username/public_html/mijnonlinewinkel/ )</small></td>
      </tr>
    </table>

    <p align="right"><input type="image" src="images/button_continue.png" border="0" alt="Ga Verder" id="inputButton" />&nbsp;&nbsp;<a href="index.php"><img src="images/button_cancel.png" border="0" alt="Stop Installatie" /></a>&nbsp;&nbsp;</p>

<?php
  reset($HTTP_POST_VARS);
  while (list($key, $value) = each($HTTP_POST_VARS)) {
    if (($key != 'x') && ($key != 'y')) {
      if (is_array($value)) {
        for ($i=0, $n=sizeof($value); $i<$n; $i++) {
          echo osc_draw_hidden_field($key . '[]', $value[$i]);
        }
      } else {
        echo osc_draw_hidden_field($key, $value);
      }
    }
  }
?>

    </form>
  </div>
</div>
