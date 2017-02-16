<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2016 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Name: SGI Fusion TS3 Viewer (für v7.02.xx)
| Filename: ts3_refresh_panel.php
| Authors: Septron, Harlekin, PlanetTeamspeak
| Support Website: http://www.septron.de
|		   http://www.septron.eu
|		   http://www.septron.net
|		   http://www.septron.org
|		   http://www.septron.info
|		   http://www.phpfusion-deutschland.de
|		   http://www.phpfusion-supportclub.de
|		   http://www.harlekinpower.de
|		   https://www.planetteamspeak.com
+--------------------------------------------------------+
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
require_once "../../maincore.php";
include INFUSIONS."ts3_panel/infusion_db.php";
require_once INFUSIONS."ts3_panel/framework/libraries/TeamSpeak3/TeamSpeak3.php";

if (file_exists(INFUSIONS."ts3_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."ts3_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."ts3_panel/locale/English.php";
}

header("Expires: Sat, 05 Nov 2005 00:00:00 GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s")." GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

echo '<link rel="stylesheet" href="'.INFUSIONS.'ts3_panel/style.css">';

echo '<div id="ts3_panel">';
//DATABASE START
$sdata_panel = dbquery("SELECT * FROM ".DB_TS3_SET);
while($data = dbarray($sdata_panel)) {
	$host = $data['host'];
	$query_port = $data['query_port'];
	$port = $data['port'];
	$panel_button = $data['panel_button'];
	$pass_site = $data['pass_site'];
	$pass_hide_site = $data['pass_hide_site'];
}
//DATABASE END
try
{
	$ts3_VirtualServer = TeamSpeak3::factory("serverquery://".$host.":".$query_port."/?server_port=".$port."#no_query_clients");
	echo "<span style='font-size: 9px;>".$ts3_VirtualServer->getViewer(new TeamSpeak3_Viewer_Html("".INFUSIONS."ts3_panel/framework/images/viewer/", "".INFUSIONS."ts3_panel/framework/images/flags/", "data:image"))."</span>";
	echo "<br />";
	if ($panel_button == "1") {
		if (iMEMBER) {
			echo "<center><a href='ts3server://".$host."?port=".$port."&nickname=".$userdata['user_name']."&password=".$pass_site."' class='btn btn-default btn-xs button'>Verbinden</a></center>";
			} else {
			echo "<center><a href='ts3server://".$host."?port=".$port."&nickname=Gast&password=".$pass_site."' class='btn btn-default btn-xs button'>Verbinden</a></center>";
		}
	}
}
catch(Exception $e)
{
  echo '<center><b>'.$locale['ts3over015'].'</b></center>';
}
echo '</div>';
?>
