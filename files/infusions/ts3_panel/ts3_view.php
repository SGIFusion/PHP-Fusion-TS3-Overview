<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2016 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Name: SGI Fusion TS3 Viewer (für v7.02.xx)
| Filename: ts3_view.php
| Authors: Septron, Harlekin, PlanetTeamspeak, ts3admin
| Support Website: http://www.septron.de
|		   http://www.septron.eu
|		   http://www.septron.net
|		   http://www.septron.org
|		   http://www.septron.info
|		   http://phpfusion-deutschland.de
|		   http://harlekinpower.de
|		   https://www.planetteamspeak.com
|		   http://ts3admin.info
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
require_once THEMES."templates/header.php";

include INFUSIONS."ts3_panel/infusion_db.php";
require_once("framework/libraries/TeamSpeak3/TeamSpeak3.php");

if (file_exists(INFUSIONS."ts3_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."ts3_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."ts3_panel/locale/English.php";
}
echo '<link rel="stylesheet" href="'.INFUSIONS.'ts3_panel/style.css">';
opentable($locale['ts3over022']);

$sdata = dbquery("SELECT * FROM ".DB_TS3_SET);
while($data = dbarray($sdata)) {
	$host = $data['host'];
	$query_port = $data['query_port'];
	$port = $data['port'];
	$panel_button = $data['panel_button'];
	$button_site = $data['button_site'];
	$banner_site = $data['banner_site'];
	$welcome_site = $data['welcome_site'];
	$name_site = $data['name_site'];
	$ip_site = $data['ip_site'];
	$port_site = $data['port_site'];
	$security_site = $data['security_site'];
	$version_site = $data['version_site'];
	$plattform_site = $data['plattform_site'];
	$status_site = $data['status_site'];
	$created_site = $data['created_site'];
	$online_site = $data['online_site'];
	$started_site = $data['started_site'];
	$ping_site = $data['ping_site'];
	$clients_site = $data['clients_site'];
	$channels_site = $data['channels_site'];
	$month_site = $data['month_site'];
	$packets_site = $data['packets_site'];
	$voice_site = $data['voice_site'];
	$file_site = $data['file_site'];
	$total_site = $data['total_site'];
	$pass_site = $data['pass_site'];
	$pass_hide_site = $data['pass_hide_site'];
	$android_site = $data['android_site'];
}

try
{
	$ts3_VirtualServer = TeamSpeak3::factory("serverquery://".$host.":".$query_port."/?server_port=".$port."#no_query_clients");
echo '<div id="rechts" style="text-align:center">';
	//Serverbanner
	if ($banner_site == "1") {
		echo "<img src='".$ts3_VirtualServer['virtualserver_hostbanner_gfx_url']."' width='345'><br /><br />";
	}
	//Welcome message
	if ($welcome_site == "1") {
	$find = array("[b]", "[/b]", "[i]", "[/i]", "[u]", "[/u]", "[URL]", "[/URL]", "[center]", "[/center]");
	$rplace = array("<b>", "</b>", "<i>", "</i>", "<u>", "</u>", "<a>", "</a>", "<center>", "</center>");
		echo "<span style=\"font-size: 11px\">".str_replace($find, $rplace, $ts3_VirtualServer->virtualserver_welcomemessage)."</span><br /><br />";
	}
	//Servername
	if ($name_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over002'].": <em>".$ts3_VirtualServer->virtualserver_name."</em></span><br />";
	}
	//Server Join Password
	if ($pass_hide_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over096']." <em>".$pass_site."</em></span><br />";
	}
	//Server IP
	if ($ip_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over003'].": <em>".$ts3_VirtualServer->getAdapterHost()."</em></span><br />";
	}
	//Server Port
	if ($port_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over103'].": <em>".$ts3_VirtualServer->virtualserver_port."</em></span><br />";
	}
	//Sicherheitsstufe
	if ($security_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over113'].": <em>".$ts3_VirtualServer-> virtualserver_needed_identity_security_level."</em></span><br /><br />";
	}
	//Server Version
	if ($version_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over009'].": <em>".$ts3_VirtualServer->virtualserver_version."</em></span><br />";
	}
	//Server Plattform
	if ($plattform_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over006'].": <em>".$ts3_VirtualServer->virtualserver_platform."</em></span><br />";
	}
	//Server Status
	if ($status_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over050'].": <em>".$ts3_VirtualServer->virtualserver_status."</em></span><br /><br />";
	}
	//Server created
	if ($created_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over104'].": <em>".date('d.m.Y H:i:s', $ts3_VirtualServer->virtualserver_created)."</em></span><br />";
	}
	//Server totaly online
	$today = time();
	$serv_online = $today - $ts3_VirtualServer->virtualserver_created;
	$serv_online = str_replace('D', ' <span style=\"font-size: 11px\">'.$locale['ts3over109'].'</span>', TeamSpeak3_Helper_Convert::seconds($today - $ts3_VirtualServer->virtualserver_created));
	if ($online_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over105'].": <em>".$serv_online."&nbsp;".$locale['ts3over001']."</em></span><br />";
	}
	//Server last started
	$serv_restarted = str_replace('D', ' <span style=\"font-size: 11px\">'.$locale['ts3over109'].'</span>', TeamSpeak3_Helper_Convert::seconds($ts3_VirtualServer->virtualserver_uptime));
	if ($started_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over106'].": <em>".$serv_restarted."</em></span><br />";
	}
	//Server Ping
	if ($ping_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over119'].": <em>".$ts3_VirtualServer->virtualserver_total_ping."ms</em></span><br /><br />";
	}
	//Server Clients
	if ($clients_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over007'].": <em>".$ts3_VirtualServer->virtualserver_maxclients."</em></span><br />";
	}
	//Server Cannels
	if ($channels_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over008'].": <em>".$ts3_VirtualServer->virtualserver_channelsonline."</em></span><br /><br />";
	}
	//Packets Up- Download
	if ($packets_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over116']."</span><br />";
		echo "<span style=\"font-size: 11px\">".$locale['ts3over011'].": <em>".TeamSpeak3_Helper_Convert::bytes($ts3_VirtualServer-> connection_packets_received_total)."</em></span><br />";
		echo "<span style=\"font-size: 11px\">".$locale['ts3over012'].": <em>".TeamSpeak3_Helper_Convert::bytes($ts3_VirtualServer-> connection_packets_sent_total)."</em></span><br /><br />";
	}
	//Month Up- Download
	if ($month_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over112']."</span><br />";
		echo "<span style=\"font-size: 11px\">".$locale['ts3over011'].": <em>".TeamSpeak3_Helper_Convert::bytes($ts3_VirtualServer-> virtualserver_month_bytes_downloaded)."</em></span><br />";
		echo "<span style=\"font-size: 11px\">".$locale['ts3over012'].": <em>".TeamSpeak3_Helper_Convert::bytes($ts3_VirtualServer->virtualserver_month_bytes_uploaded)."</em></span><br /><br />";
	}
	//Voice Up- Download
	if ($voice_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over010']."</span><br />";
		echo "<span style=\"font-size: 11px\">".$locale['ts3over011'].": <em>".TeamSpeak3_Helper_Convert::bytes($ts3_VirtualServer->connection_bytes_received_total)."</em></span><br />";
		echo "<span style=\"font-size: 11px\">".$locale['ts3over012'].": <em>".TeamSpeak3_Helper_Convert::bytes($ts3_VirtualServer->connection_bytes_sent_total)."</em></span><br /><br />";
	}
	//File Up- Download
	if ($file_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over013']."</span><br />";
		echo "<span style=\"font-size: 11px\">".$locale['ts3over011'].": <em>".TeamSpeak3_Helper_Convert::bytes($ts3_VirtualServer->connection_filetransfer_bytes_received_total)."</em></span><br />";
		echo "<span style=\"font-size: 11px\">".$locale['ts3over012'].": <em>".TeamSpeak3_Helper_Convert::bytes($ts3_VirtualServer->connection_filetransfer_bytes_sent_total)."</em></span><br /><br />";
	}
	//TOTAL
	if ($total_site == "1") {
		echo "<span style=\"font-size: 11px\">".$locale['ts3over014']."</span><br />";
		echo "<span style=\"font-size: 11px\">".$locale['ts3over011'].": <em>".TeamSpeak3_Helper_Convert::bytes($ts3_VirtualServer["connection_filetransfer_bytes_received_total"] + $ts3_VirtualServer["connection_bytes_received_total"])."</em></span><br />";
		echo "<span style=\"font-size: 11px\">".$locale['ts3over012'].": <em>".TeamSpeak3_Helper_Convert::bytes($ts3_VirtualServer["connection_filetransfer_bytes_sent_total"] + $ts3_VirtualServer["connection_bytes_sent_total"])."</em></span><br /><br />";
	}


############################################ANDROID VERBINDUNG ANFANG
	if ($android_site == "1") {
// connect to local server, authenticate and spawn an object for the virtual server on port 9987
// query clientlist from virtual server and filter by platform
$arr_ClientList = $ts3_VirtualServer->clientList(array("client_platform" => "Android"));
// walk through list of clients
foreach($arr_ClientList as $ts3_Client)
{
 echo $locale['ts3over019'].$ts3_Client ." <span style=\"font-size: 11px\">".$locale['ts3over024']." <em>".$ts3_Client["client_platform"]."</em></span><br />\n";
}
	}
############################################ANDROID VERBINDUNG ENDE		
echo '</div>
	<div id="links">';
	echo $ts3_VirtualServer->getViewer(new TeamSpeak3_Viewer_Html("".INFUSIONS."ts3_panel/framework/images/viewer/", "".INFUSIONS."ts3_panel/framework/images/flags/", "data:image"));
			echo "<br />";
			if ($panel_button == "1") {
			if (iMEMBER) {
			echo "<center><a href='ts3server://".$host."?port=".$port."&nickname=".$userdata['user_name']."&password=".$pass_site."' class='btn btn-default btn-xs button'>Verbinden</a></center>";
			} else {
			echo "<center><a href='ts3server://".$host."?port=".$port."&nickname=Gast&password=".$pass_site."' class='btn btn-default btn-xs button'>Verbinden</a></center>";
		}
	}
echo '</div>';
echo '<div id="blocker"></div>';
echo '<br />';
}
catch(Exception $e)
{
	echo "<strong>".$locale['ts3over015']."</strong>";
}
	echo '<hr />';
	echo '<br />';
	$aktualisierung = filemtime(basename($_SERVER['PHP_SELF']));
echo "<table width='100%'>";
echo "<div align='center'>".$locale['copyover_001']." <a href='".$locale['copyover_009']."' target='_blank'>".$locale['copyover_002']."</a>".$locale['copyover_zusatz']."<a href='".$locale['copyover_011']."' target='_blank'>".$locale['copyover_004']."</a>".$locale['copyover_zusatz']."<a href='".$locale['copyover_012']."' target='_blank'>".$locale['copyover_005']."</a></div>";
echo "</table>";
closetable();

require_once THEMES."templates/footer.php";
?>
