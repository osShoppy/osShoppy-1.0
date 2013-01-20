<?php //$Id: /catalog/install/templates/pages/install.php ?>

<script language="javascript" type="text/javascript" src="ext/xmlhttp/xmlhttp.js"></script>
<script language="javascript" type="text/javascript">
<!--

  var dbServer;
  var dbUsername;
  var dbPassword;
  var dbName;

  var formSubmited = false;

  function handleHttpResponse_DoImport() {
    if (http.readyState == 4) {
      if (http.status == 200) {
        var result = /\[\[([^|]*?)(?:\|([^|]*?)){0,1}\]\]/.exec(http.responseText);
        result.shift();

        if (result[0] == '1') {
          document.getElementById('mBoxContents').innerHTML = '<p><img src="images/success.gif" align="right" hspace="5" vspace="5" border="0" /><center><font color=green>De database is succesvol ge&iuml;mporteerd!</center><br><br></font</p>';

          setTimeout("document.getElementById('installForm').submit();", 2000);
        } else {
          document.getElementById('mBoxContents').innerHTML = '<p><img src="images/failed.gif" align="right" hspace="5" vspace="5" border="0" /><center>Er was een probleem met het importeren <br>van de database.<br><br><font color=red><b>Controleer volgende ERRORS !</font></b></p><p><b>%s</b></p><p>Controleer de connectie parameters <br>en probeer het nogmaals!</center></p>'.replace('%s', result[1]);
        }
      }

      formSubmited = false;
    }
  }

  function handleHttpResponse() {
    if (http.readyState == 4) {
      if (http.status == 200) {
        var result = /\[\[([^|]*?)(?:\|([^|]*?)){0,1}\]\]/.exec(http.responseText);
        result.shift();

        if (result[0] == '1') {
          document.getElementById('mBoxContents').innerHTML = '<p><img src="images/progress.gif" align="right" hspace="5" vspace="5" border="0" /><center>De database structuur van de SQL file word nu ge&iuml;mporteerd.<br><br><font color=green>Even geduld aub, dit kan enkele ogenblikken duren!</font></center></p>';

          loadXMLDoc("rpc.php?action=dbImport&server=" + urlEncode(dbServer) + "&username=" + urlEncode(dbUsername) + "&password=" + urlEncode(dbPassword) + "&name=" + urlEncode(dbName), handleHttpResponse_DoImport);
        } else {
          document.getElementById('mBoxContents').innerHTML = '<p><img src="images/failed.gif" align="right" hspace="5" vspace="5" border="0" /><center>Er was een probleem om met de <br>database te verbinden.<br><br><font color=red><b>Controleer volgende ERRORS!</font></p><p>%s</b></p><p>Controleer de connectie parameters <br>en probeer het nogmaals!</center></p>'.replace('%s', result[1]);
          formSubmited = false;
        }
      } else {
        formSubmited = false;
      }
    }
  }

  function prepareDB() {
    if (formSubmited == true) {
      return false;
    }

    formSubmited = true;

    showDiv(document.getElementById('mBox'));

    document.getElementById('mBoxContents').innerHTML = '<p><img src="images/progress.gif" align="right" hspace="5" vspace="5" border="0" />Testen database connecties...</p>';

    dbServer = document.getElementById("DB_SERVER").value;
    dbUsername = document.getElementById("DB_SERVER_USERNAME").value;
    dbPassword = document.getElementById("DB_SERVER_PASSWORD").value;
    dbName = document.getElementById("DB_DATABASE").value;

    loadXMLDoc("rpc.php?action=dbCheck&server=" + urlEncode(dbServer) + "&username=" + urlEncode(dbUsername) + "&password=" + urlEncode(dbPassword) + "&name=" + urlEncode(dbName), handleHttpResponse);
  }

//-->
</script>

<div class="mainBlock">

  <h1>Installatie Stap 1</h1>
  <div class="stepsBox">
    <ol>
      <li style="font-weight: bold; color:#CCC">Database Server</li>
      <li>Web Server</li>
      <li>Installeer Voorbeeld Data</li>
      <li>Winkel Instellingen</li>
      <li>Einde Installatie!</li>
    </ol>
  </div>

  <p>Deze web gebaseerde wizard installatie zal <?php echo PROJECT_VERSION ?> configuren en op uw webserver installeren.</p>
  <p>In deze eerste stap zal de SQL file in uw aangemaakte database ge&iuml;mporteerd worden.<br />
  Vul hieronder de aangemaakte database gegevens in.<br /><br />
  Volg de instructies op het scherm die u verder zullen helpen met de installatie van database server, <br />installeer voorbeeld data, webserver en winkel instellingen opties.<br /><br /> 
  <b>Wanneer hulp vereist is bij de verschillende stappen raadpleeg dan de documentatie bestanden op <a href="http://docs.osshoppy.com" target="_blank"><u>osShoppy</u></a>.</b></p>
</div>

<div class="contentBlock">
  <div class="infoPane">
    <h3><center>Database Server Info</center></h3>

    <div class="infoPaneContents">
      <p><b><center>Maak een database in uw cPanel aan om de SQL file in te kunnen importeren.</center></b></p>
      <p><font color="#ff6600"><center><b>" Onderbreek dit proces niet! "</b></center></font></p>
      <p>Tijdens dit proces wordt de database gevuld met de benodigde tabellen om de configuraties van de webwinkel in op te slaan.
      <p>In de database worden gegevens opgeslagen die in de webwinkel worden ingevoerd.
      zoals;<br /> product informatie, klant gegevens, bestellingen, betaal en verzend gegevens, coupons, downloads, support tickets, enz.</p>
    </div>
  </div>

  <div id="mBox">
    <div id="mBoxContents"></div>
  </div>

  <div class="contentPane">
    <h2>Database Server</h2>

    <form name="install" id="installForm" action="install.php?step=2" method="post" onsubmit="prepareDB(); return false;">

    <table border="0" width="99%" cellspacing="0" cellpadding="5" class="inputForm">
      <tr>
        <td class="inputField"><?php echo 'Database Server<br />' . osc_draw_input_field('DB_SERVER', null, 'class="text"'); ?></td>
        <td class="inputDescription">Geef hier de hostname of het IP-adres op van de database.<br /><small>(dit is in de meeste gevallen <b>"localhost"</b>)</small></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Gebruikersnaam<br />' . osc_draw_input_field('DB_SERVER_USERNAME', null, 'class="text"'); ?></td>
        <td class="inputDescription">Vul hier de gebruikersnaam in van de database gebruiker.<br /><small>(deze naam is door uzelf aangemaakt)</small></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Wachtwoord<br />' . osc_draw_password_field('DB_SERVER_PASSWORD', 'class="text"'); ?></td>
        <td class="inputDescription">Vul hier het wachtwoord in van de database gebruiker.<br /><small>(dit wachtwoord is door uzelf aangemaakt)</small></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Database Naam<br />' . osc_draw_input_field('DB_DATABASE', null, 'class="text"'); ?></td>
        <td class="inputDescription">Vul hier de naam van de database in.<br /><small>(deze naam is door uzelf aangemaakt)</small></td>
      </tr>
    </table>

    <p align="right"><input type="image" src="images/button_continue.png" border="0" alt="Ga Verder" id="inputButton" />&nbsp;&nbsp;<a href="index.php"><img src="images/button_cancel.png" border="0" alt="Stop Installatie" /></a>&nbsp;&nbsp;</p>

    </form>
  </div>
</div>
