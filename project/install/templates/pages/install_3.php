<?php //$Id: /catalog/install/templates/pages/install_3.php ?>

<div class="mainBlock">
  <h1>Installatie Stap 4</h1>
  <div class="stepsBox">
    <ol>
      <li>Database Server</li>
      <li>Web Server</li>
      <li>Installeer Voorbeeld Data</li>
      <li style="font-weight: bold;color:#CCC">Winkel Instellingen</li>
      <li>Einde Installatie!</li>
    </ol>
  </div>


  <p>Deze web gebaseerde wizard installatie zal <?php echo PROJECT_VERSION ?> configuren en op uw webserver installeren.</p>
  <p>In deze vierde stap dient er een winkelnaam, winkeleigenaar en winkel emailadres opgegeven worden.<br />
  Vul hieronder in de invoervelden winkelnaam, winkeleigenaar en winkel email adres in.<br /><br />
  Volg de instructies op het scherm die u verder zullen helpen met installatie van de winkel configuratie opties.<br /><br /> 
  <b>Wanneer hulp vereist is bij de verschillende stappen raadpleeg dan de documentatie bestanden op <a href="http://www.osshoppy.com" target="_blank"><u>osShoppy</u></a>.</b></p>
</div>

<div class="contentBlock">
  <div class="infoPane">
    <h3><center>Online Winkel Instellingen</center></h3>

    <div class="infoPaneContents">
      <p>Geef hier uw winkelnaam op en de contactinformatie van de winkel eigenaar. Voer hier ook het 
      algemene emailadres in die u gaat gebruiken in de online winkel.<br /><br />
      <font color="#33CC66"><center><b>Deze instellingen zijn later in het administratie paneel aan te passen</b></center></p></font>
    </div>
  </div>

  <div class="contentPane">
    <h2>Online Winkel Instellingen</h2>

    <form name="install" id="installForm" action="install.php?step=4" method="post">

    <table border="0" width="99%" cellspacing="0" cellpadding="5" class="inputForm">
      <tr>
        <td class="inputField"><?php echo 'Winkel Naam<br />' . osc_draw_input_field('CFG_STORE_NAME', null, 'class="text"'); ?></td>
        <td class="inputDescription">Vul hier de naam van de online winkel in die gasten en <br />klanten kunnen vinden.</td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Winkel Eigenaar Naam<br />' . osc_draw_input_field('CFG_STORE_OWNER_NAME', null, 'class="text"'); ?></td>
        <td class="inputDescription">Vul hier de naam van de winkel eigenaar in die gasten en <br />klanten kunnen vinden.</td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Winkel Eigenaar E-Mail Adres<br />' . osc_draw_input_field('CFG_STORE_OWNER_EMAIL_ADDRESS', null, 'class="text"'); ?></td>
        <td class="inputDescription">Vul hier het email adres in van de online winkel die gasten en <br />klanten kunnen vinden.</td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Winkel URL<br />' . osc_draw_input_field('CFG_STORE_URL', null, 'class="text"'); ?></td>
        <td class="inputDescription">Vul hier de URL in van de locatie van de website <br />
							        <small>(www.mijndomeinnaam.nl/mijnonlinewinkel) zonder http://</small></td>
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
