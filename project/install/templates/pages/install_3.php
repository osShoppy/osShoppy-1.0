<?php //$Id: /catalog/install/templates/pages/install_3.php ?>

<div class="mainBlock">

  <h1>Installatie Stap 3</h1>
  <div class="stepsBox">
    <ol>
      <li>Database Server</li>
      <li>Web Server</li>
      <li style="font-weight: bold; color:#CCC">Installeer Voorbeeld Data</li>
      <li>Winkel Instellingen</li>
      <li>Einde Installatie!</li>
    </ol>
  </div>

  <p>Wanneer u <?php echo PROJECT_VERSION ?> voor het eerst gebruikt dan is het aangeraden om voorbeeld data te installeren.</p>
  <p>Maak een keuze uit de &eacute;&eacute;n van de vijf hier onderstaande voorbeeld data bestanden.<br />
  	 Het is ook mogelijk om alle voorbeeld data te installeren.<br /><br />
  	 Na het installeren van de voorbeeld data druk op volgende voor de laatste twee stappen van de installatie.<br /><br /> 
  <b>Wanneer hulp vereist is bij de verschillende stappen raadpleeg dan de documentatie bestanden op <a href="http://docs.osshoppy.com" target="_blank"><u>osShoppy</u></a>.</b></p>
</div>

<div class="contentBlock">
  <div class="infoPane">
    <h3><center>Voorbeeld Data Info</center></h3>

    <div class="infoPaneContents">
      <p><b><center>Klik op volgende als u bekent bent met osShoppy om deze stap over te slaan.</b></p>
      <p>Tijdens dit proces kan de database gevuld worden met de benodigde voorbeeld data.</p>
      <p>In de database worden gegevens opgeslagen die in de online winkel worden ingevoerd.
      zoals;<br /> artikel informatie, klant gegevens, bestellingen, betaal en verzend gegevens, coupons, downloads enz.</center></p>
    </div>
  </div>

  <div id="mBox">
    <div id="mBoxContents"></div>
  </div>

  <div class="contentPane">
    <h2>Installeer Voorbeeld Data</h2>

    <form name="install" id="installForm" action="install.php?step=4" method="post">

    <table border="0" width="99%" cellspacing="0" cellpadding="4" class="inputForm">
      <tr>
        <td class="inputField" align="center"><a href="sample_data_osshoppy.php"><img src="images/button_install_sample_data.png" border="0" alt="Stop Installatie" /></td>
        <td class="inputDescription">Voorbeeld Data van osShoppy<br />
        							 <small>(10 producten)</small></td>
      </tr>
      <tr>
        <td class="inputField" align="center"><a href="sample_data_computer.php"><img src="images/button_install_sample_data.png" border="0" alt="Stop Installatie" /></td>
        <td class="inputDescription">Voorbeeld Data van Computers<br />
        							 <small>(20 producten)</small></td>
      </tr>
      <tr>
        <td class="inputField" align="center"><a href="sample_data_radio_control.php"><img src="images/button_install_sample_data.png" border="0" alt="Stop Installatie" /></td>
        <td class="inputDescription">Voorbeeld Data van Nitro Helicopters<br />
        							 <small>(30 producten)</small></td>
      </tr>
      <tr>
        <td class="inputField" align="center"><a href="sample_data_fishing.php"><img src="images/button_install_sample_data.png" border="0" alt="Stop Installatie" /></td>
        <td class="inputDescription">Voorbeeld Data van Hengelsport<br />
        							 <small>(40 producten)</small></td>
      </tr>
      <tr>
        <td class="inputField" align="center"><a href="sample_data_lego.php"><img src="images/button_install_sample_data.png" border="0" alt="Stop Installatie" /></td>
        <td class="inputDescription">Voorbeeld Data van Lego<br />
        							 <small>(50 producten)</small></td>
      </tr>
      <tr>
        <td class="inputField" align="center"><a href="sample_data_all.php"><img src="images/button_install_sample_data.png" border="0" alt="Stop Installatie" /></td>
        <td class="inputDescription">Voorbeeld Data van alle Categorie&euml;n<br />
        							 <small>(150 producten)</small></td>
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
