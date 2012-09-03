<?php //$Id: /catalog/install/templates/pages/index.php

  $compat_register_globals = true;

  if (function_exists('ini_get') && (PHP_VERSION < 4.3) && ((int)ini_get('register_globals') == 0)) {
    $compat_register_globals = false;
  }
?>

<div class="mainBlock">
  <h1>Welkom bij de installatie van <?php echo PROJECT_VERSION ?></h1>
<div class="mainBlockcontents">
<p>Met <?php echo PROJECT_VERSION ?> kunt u producten verkopen in uw eigen online webwinkel.</p>
  <p>Het overzichtelijke administratie paneel zorgt voor makkelijk en snel artikelen toevoegen, aanpassen of verwijderen.<br />
   Ook het bijhouden van klanten, bestellingen, nieuwsbrieven, enquetes, downloads, klantengroepen en nog veel meer zijn makkelijk te configureren.<br />
   Met de aanwezige handleiding in het administratie paneel kunt u snel van alle functies en mogelijkheden hun werking bekijken.
   </p>
  <p><b>Het <?php echo PROJECT_VERSION ?> E-commerce Systeem draait het beste met een osShoppy Webhosting pakket van <a href="http://www.hilvy.nl" target="_blank"><u>Hilvy</u></a>. </b></p>
</div>
</div>

<div class="contentBlock">
  <div class="infoPane">
    <h3>Server Capaciteiten Info</h3>

    <div class="infoPaneContents">
      <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td><b>PHP Versie</b></td>
          <td align="right"><?php echo PHP_VERSION; ?></td>
          <td align="right" width="25"><img src="images/<?php echo ((PHP_VERSION >= 4) ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
      </table>

<?php
  if (function_exists('ini_get')) {
?>

      <br />

      <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td><b>PHP Instellingen</td>
          <td align="right"></td>
          <td align="right" width="25"></td>
        </tr>
        <tr>
          <td>register_globals</td>
          <td align="right"><?php echo (((int)ini_get('register_globals') == 0) ? 'Off' : 'On'); ?></td>
          <td align="right"><img src="images/<?php echo (($compat_register_globals == true) ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
        <tr>
          <td>magic_quotes</td>
          <td align="right"><?php echo (((int)ini_get('magic_quotes') == 0) ? 'Off' : 'On'); ?></td>
          <td align="right"><img src="images/<?php echo (((int)ini_get('magic_quotes') == 0) ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
        <tr>
          <td>file_uploads</td>
          <td align="right"><?php echo (((int)ini_get('file_uploads') == 0) ? 'Off' : 'On'); ?></td>
          <td align="right"><img src="images/<?php echo (((int)ini_get('file_uploads') == 1) ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
        <tr>
          <td>session.auto_start</td>
          <td align="right"><?php echo (((int)ini_get('session.auto_start') == 0) ? 'Off' : 'On'); ?></td>
          <td align="right"><img src="images/<?php echo (((int)ini_get('session.auto_start') == 0) ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
        <tr>
          <td>session.use_trans_sid</td>
          <td align="right"><?php echo (((int)ini_get('session.use_trans_sid') == 0) ? 'Off' : 'On'); ?></td>
          <td align="right"><img src="images/<?php echo (((int)ini_get('session.use_trans_sid') == 0) ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
      </table>

      <br />

      <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td><b>PHP Uitbreidingen</b></td>
          <td align="right" width="25"></td>
        </tr>
        <tr>
          <td>MySQL</td>
          <td align="right"><img src="images/<?php echo (extension_loaded('mysql') ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
        <tr>
          <td>GD</td>
          <td align="right"><img src="images/<?php echo (extension_loaded('gd') ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
        <tr>
          <td>cURL</td>
          <td align="right"><img src="images/<?php echo (extension_loaded('curl') ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
        <tr>
          <td>OpenSSL</td>
          <td align="right"><img src="images/<?php echo (extension_loaded('openssl') ? 'tick.gif' : 'cross.gif'); ?>" border="0" width="16" height="16"></td>
        </tr>
      </table>

<?php
  }
?>

    </div>
  </div>

  <div class="contentPane">
    <h2>Server Capaciteiten</h2>

  <div class="contentPanecontents">
<?php
  $configfile_array = array();

  if (file_exists(osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php') && !is_writeable(osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php')) {
    @chmod(osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php', 0777);
  }

  if (file_exists(osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php') && !is_writeable(osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php')) {
    @chmod(osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php', 0777);
  }

  if (file_exists(osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php') && !is_writeable(osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php')) {
    $configfile_array[] = osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php';
  }

  if (file_exists(osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php') && !is_writeable(osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php')) {
    $configfile_array[] = osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php';
  }

  $warning_array = array();

  if (function_exists('ini_get')) {
    if ($compat_register_globals == false) {
      $warning_array['register_globals'] = 'Compatibility with register_globals is supported from PHP 4.3+. This setting <u>must be enabled</u> due to an older PHP version being used.';
    }
  }

  if ((sizeof($configfile_array) > 0) || (sizeof($warning_array) > 0)) {
?>

    <div class="noticeBox">

<?php
    if (sizeof($warning_array) > 0) {
?>

      <table border="0" width="100%" cellspacing="0" cellpadding="2" style="background: #fffbdf; border: 1px solid #ffc20b; padding: 2px;">

<?php
      reset($warning_array);
      while (list($key, $value) = each($warning_array)) {
        echo '        <tr>' . "\n" .
             '          <td valign="top"><b>' . $key . '</b></td>' . "\n" .
             '          <td valign="top">' . $value . '</td>' . "\n" .
             '        </tr>' . "\n";
      }
?>

      </table>
<?php
    }

    if (sizeof($configfile_array) > 0) {
?>

      <p>Het lukt de webserver niet om de installatie parameters naar de configure.php files te schrijven.</p>
      <p>Zet van de volgende configure.php file(s) de bestandsrechten naar "schrijfbaar" (<b>chmod 777</b>):<b></p>
      <p>

<?php
      for ($i=0, $n=sizeof($configfile_array); $i<$n; $i++) {
        echo $configfile_array[$i];

        if (isset($configfile_array[$i+1])) {
          echo '<br />';
        }
      }
?>

      </p>

<?php
    }
?>
    </div>

<?php
  }

  if ((sizeof($configfile_array) > 0) || (sizeof($warning_array) > 0)) {
?>

    <p><b><center>Los bovenstaande ERRORS op en probeer de installatie procedure opnieuw te starten<br />door op PROBEER OPNIEUW te klikken.</b></center></p>

<?php
    if (sizeof($warning_array) > 0) {
      echo '    <p><i>Changing webserver configuration parameters may require the webserver service to be restarted before the changes take affect.</i></p>' . "\n";
    }
?>

    <p align="right"><a href="index.php"><img src="images/button_retry.png" border="0" alt="Retry" /></a></p>

<?php
  } else {
?>

    <br /><p><center><b>De webserver omgeving is geverifieerd en is klaar om met een nieuwe installatie en configuratie van <?php echo PROJECT_VERSION ?> te beginnen.</b></center><br />
    In vijf stappen wordt u door de installatie procedure geleid. Deze procedure zal niet langer dan tien minuten van uw tijd in beslag nemen.
    Na installatie kunt u meteen aan de slag met het configureren en toevoegen van artikelen en bestanden in uw eigen online webwinkel!<br /></p>
    <p><br /><b>Druk op Start om de installatie procedure te beginnen.</b></p>
    <p align="right"><a href="install.php"><img src="images/button_start.png" border="0" alt="Start Installatie" /></a></p><BR />

<?php
  }
?>
</div>
  </div>
</div>
