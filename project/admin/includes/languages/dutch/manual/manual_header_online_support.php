<?php //$Id: /catalog/admin/includes/languages/dutch/manual/manual_header_online_support.php

define('TEXT_TITLE', 'Live Online Support!');

define('TEXT_MAIN_HEADER', 'Hier de instellingen voor het gebruik van Online Support!');

define('TEXT_MAIN_CONTENT', '
	   Open up the catalog/live_support/config.php file in your favourite text editor.<br><br><br>
       There are some tags which need modification here:<br><br>
	   $DBHost is the host name of MySQL database, normally it will be localhost.<br>
       Example: $DBHost = \'localhost\';<br><br>
	   $DBUsername is the username to access to database. If you use cpanel, you may find it in sample connection instructions.<br>
       Example: $DBUsername = \'youraccountusername_yourdefinedusername\';<br><br>
  	   $DBPassword is the password of the above username.<br>
       Example: $DBPassword = \'yourpassword\';<br><br>
  	   $DBDatabase is the name of the database you created using MySQL. If you use cpanel, you may find it in sample connection instructions.<br>
       Example: $DBDatabase = \'youraccountname_livesupport\';<br><br><br>
       Save these changes and exit the file<br><br><br>');

define('TEXT_RIGHT_CONTENT', 'Makkelijk contact houden met je online klanten!');

define('TEXT_INFO_CONTENT', 'Maak gebruik van het forum om nog meer bezoekers te bereiken!');

define('TEXT_NOTICE_CONTENT', 'Vergeet niet het config.php bestand aan te passen voor gebruik!<br><br>');

define('TEXT_RELATED_CONTENT', 'BBoard<br><br>');

?>
