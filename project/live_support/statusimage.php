<?php

/*****************************************************************
phpOnline - Online customer support system
Copyright (C) 2003-2006 
Dayana Networks Ltd. <phponline@dayanahost.com>
Farhad Malekpour <fm@farhad.ca>
All rights reserved.

Official Website	http://phponline.dayanahost.com
Online Forums       http://www.dayanahost.com/forum
Powered by          http://www.dayanahost.com

Translation service provided by Google Inc.

THE USE OF THIS SOFTWARE IS COMPLETELY AT YOUR OWN RISK!

--------------------------- GNU License ---------------------------

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

*****************************************************************/

include_once('noca.php');
include_once('rcq.php');

$CCode = FilterString($HTTP_COOKIE_VARS['ocode'],'NUMBER');

if($CCode == "")
{
	$CCode = time() . rand(111111,999999);
	setcookie("ocode", $CCode, time()+31536000);
}

$TTime = gmdate("U");

$DTime = get_microtime();

$RefAdd = substr($_SERVER['HTTP_REFERER'],0,100);
$RefMethod = $_SERVER["REQUEST_METHOD"];
$RefIP = $_SERVER["REMOTE_ADDR"];

$REFSTR = "^%^".$RefIP."^%^".$RefMethod."^%^".$RefAdd."^%^";

$LastAdmLoginTime = 0;

	$dbh=mysql_connect($DBHost, $DBUsername, $DBPassword,true) or die ('res=0');
	mysql_select_db($DBDatabase,$dbh);
	
	if($RefAdd!='')
	{
		$INSERT_FLAG = false;
		if(mysql_query("UPDATE msgdb SET ttime=\"$DTime\",msg=\"$REFSTR\" WHERE ccode=\"$CCode\" AND code1=3 ",$dbh)===false)
		{
			$INSERT_FLAG = true;
		}
		else
		{
			if(mysql_affected_rows($dbh)==0)
				$INSERT_FLAG = true;
		}
		if($INSERT_FLAG)
			mysql_query("INSERT INTO msgdb VALUES($DTime,\"$CCode\",\"$REFSTR\",3,0)",$dbh);
	}

	$res = mysql_query("SELECT * FROM bvars WHERE bname='adm_login_time'",$dbh);
	while($row = mysql_fetch_array($res))
	{
		$LastAdmLoginTime = $row["bvalue"];
	}
	mysql_close($dbh);

header ("Content-type: image/jpeg");

if($LastAdmLoginTime==0 || $LastAdmLoginTime<($TTime-120))
{
	echo implode('', file('images/offline.jpg'));
	$OnlineStatus = 0;
}
else
{
	echo implode('', file('images/online.jpg'));
}





?>