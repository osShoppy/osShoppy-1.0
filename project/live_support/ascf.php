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

$CCode = FilterString($HTTP_POST_VARS['ccode'],'NUMBER');
$FirstCall = FilterString($HTTP_POST_VARS['firstcall'],'WORD');


$dbh=mysql_connect($DBHost, $DBUsername, $DBPassword,true) or die ('res=0');
mysql_select_db($DBDatabase,$dbh);
$res = mysql_query("SELECT * from cs WHERE ccode=\"$CCode\"",$dbh);
$UINFO = array();
while($row = mysql_fetch_array($res))
{
	$UINFO = $row;
}
mysql_close($dbh);

$uptext="";
$UInitText = "";
if($FirstCall)
{
	if($CONF['conf_Right2Left']==1)
		$uptext = "<font color=\"#0000BB\">".$UINFO['ip']."</font><font color=\"#000000\">".$CONF['conf_Msg76']." ,</font><font color=\"#0000FF\"> ".$UINFO['name']." </font><font color=\"#000000\">".$CONF['conf_Msg78']."</font>";
	else		
		$uptext = "<font color=\"#000000\">".$CONF['conf_Msg78']." </font><font color=\"#0000FF\">".$UINFO['name']."</font><font color=\"#000000\">, ".$CONF['conf_Msg76']." </font><font color=\"#0000BB\">".$UINFO['ip']."</font>";
	if($CONF['conf_UseLanguageTranslator']==1)
	{
		if($CONF['conf_Right2Left']==1)
			$uptext = "[<font color=\"#008000\">".ucfirst($TransLangs[$UINFO['code1']][1])."] ".$uptext;
		else
			$uptext .= " [<font color=\"#008000\">".ucfirst($TransLangs[$UINFO['code1']][1])."]";
	}

	if($CONF['conf_Right2Left']==1)
	{
		$UInitText  = "<p align=\"right\"><b><font color=\"#990000\">".$CONF['conf_Msg86']." &lt;phpOnline</font></b></p>";
		$UInitText .= "<p align=\"right\"><b><font color=\"#333333\">".$UINFO['name']."</font><font color=\"#990000\"> :".$CONF['conf_Msg49']."   </font></b></p>";
		$UInitText .= "<p align=\"right\"><b><font color=\"#333333\">".$UINFO['ip']."</font><font color=\"#990000\"> :".$CONF['conf_Msg76']."   </font></b></p>";
		if($CONF['conf_GetClientEmail']==1 && trim($UINFO['email'])!='')
		{
			$UInitText .= "<p align=\"right\"><b><font color=\"#333333\">".$UINFO['email']."</font><font color=\"#990000\"> :".$CONF['conf_Msg77']."   </font></b></p>";
		}
		if($CONF['conf_UseLanguageTranslator']==1)
		{
			$UInitText .= "<p align=\"right\"><b><font color=\"#333333\">".ucfirst($TransLangs[$UINFO['code1']][1])."</font><font color=\"#990000\"> :".$CONF['conf_Msg11']."   </font></b></p>";
		}
	}
	else
	{
		$UInitText  = "<p><b><font color=\"#990000\">phpOnline&gt; ".$CONF['conf_Msg86'].":</font></b></p>";
		$UInitText .= "<p><b><font color=\"#990000\">   ".$CONF['conf_Msg49'].": </font><font color=\"#333333\">".$UINFO['name']."</font></b></p>";
		$UInitText .= "<p><b><font color=\"#990000\">   ".$CONF['conf_Msg76'].": </font><font color=\"#333333\">".$UINFO['ip']."</font></b></p>";
		if($CONF['conf_GetClientEmail']==1 && trim($UINFO['email'])!='')
		{
			$UInitText .= "<p><b><font color=\"#990000\">   ".$CONF['conf_Msg77'].": </font><font color=\"#333333\">".$UINFO['email']."</font></b></p>";
		}
		if($CONF['conf_UseLanguageTranslator']==1)
		{
			$UInitText .= "<p><b><font color=\"#990000\">   ".$CONF['conf_Msg11'].": </font><font color=\"#333333\">".ucfirst($TransLangs[$UINFO['code1']][1])."</font></b></p>";
		}
	}
}

$UInitText = GetEQString($UInitText);
$uptext = GetEQString($uptext);

echo "pr_s=s&ascinit_sema=1&client_name=".$UINFO['name']."&client_email=".$UINFO['email']."&client_ip=".$UINFO['ip']."&conf_GEmailAddress=".$CONF['conf_GEmailAddress']."&init_text=".$UInitText."&uptext=".$uptext."&pr_e=e";


?>