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
|				   http://www.septron.eu
|				   http://www.septron.net
|				   http://www.septron.org
|				   http://www.septron.info
|				   http://phpfusion-deutschland.de
|				   http://harlekinpower.de
|				   https://www.planetteamspeak.com
|				   http://ts3admin.info
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
require("includes/ts3admin.class.php");

if (file_exists(INFUSIONS."ts3_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."ts3_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."ts3_panel/locale/English.php";
}

opentable($locale['ts3over022']);
echo '<style type="text/css">
	#blocker{
		clear:both;
	}
	#links{
		background: transparent;
		width: 55%;
		margin: 0 auto;
		overflow: hidden;
		padding: 0;
	}
	#rechts{
		float: right;
		width: 45%;
		background: transparent;
		margin: 0 auto;
		overflow: hidden;
		padding: 0;
	}
	<!--
    table.ts3_viewer {
      width: 100%;
      border: 0px;
      border-collapse: collapse;
    }

    table.ts3_viewer td {
      white-space: nowrap;
      padding: 0px 0px 1px 0px;
      border: 0px;
    }

    table.ts3_viewer td.corpus {
      width: 100%;
    }
	
    table.ts3_viewer td.suffix {
      vertical-align: top;
    }

    table.ts3_viewer td.suffix img {
      padding-left: 2px;
      vertical-align: top;
    }
	table.ts3_viewer td.spacer {
      overflow: hidden;
    }
	table.ts3_viewer td.spacer.solidline {
      background: url("'.INFUSIONS.'ts3_panel/images/viewer/spacer_solidline.gif");
		background-repeat: repeat-x;
    }
    table.ts3_viewer td.spacer.dashline {
      background: url("'.INFUSIONS.'ts3_panel/images/viewer/spacer_dashline.gif");
		background-repeat: repeat-x;
    }
    table.ts3_viewer td.spacer.dashdotline {
      background: url("'.INFUSIONS.'ts3_panel/images/viewer/spacer_dashdotline.gif");
		background-repeat: repeat-x;
    }
    table.ts3_viewer td.spacer.dashdotdotline {
      background: url("'.INFUSIONS.'ts3_panel/images/viewer/spacer_dashdotdotline.gif");
		background-repeat: repeat-x;
    }
    table.ts3_viewer td.spacer.dotline {
      background: url("'.INFUSIONS.'ts3_panel/images/viewer/spacer_dotline.gif");
		background-repeat: repeat-x;
    }
  -->
 .btn-default {
  color: #333;
  background-color: #fff;
  border-color: #ccc;
}
.btn-default:focus,
.btn-default.focus {
  color: #333;
  background-color: #e6e6e6;
  border-color: #8c8c8c;
}
.btn-default:hover {
  color: #333;
  background-color: #e6e6e6;
  border-color: #adadad;
}
.btn-default:active,
.btn-default.active,
.open > .dropdown-toggle.btn-default {
  color: #333;
  background-color: #e6e6e6;
  border-color: #adadad;
}
.btn-default:active:hover,
.btn-default.active:hover,
.open > .dropdown-toggle.btn-default:hover,
.btn-default:active:focus,
.btn-default.active:focus,
.open > .dropdown-toggle.btn-default:focus,
.btn-default:active.focus,
.btn-default.active.focus,
.open > .dropdown-toggle.btn-default.focus {
  color: #333;
  background-color: #d4d4d4;
  border-color: #8c8c8c;
}
.btn-default:active,
.btn-default.active,
.open > .dropdown-toggle.btn-default {
  background-image: none;
}
.btn-default.disabled:hover,
.btn-default[disabled]:hover,
fieldset[disabled] .btn-default:hover,
.btn-default.disabled:focus,
.btn-default[disabled]:focus,
fieldset[disabled] .btn-default:focus,
.btn-default.disabled.focus,
.btn-default[disabled].focus,
fieldset[disabled] .btn-default.focus {
  background-color: #fff;
  border-color: #ccc;
}
.btn-default .badge {
  color: #fff;
  background-color: #333;
}
  .btn-lg,
.btn-group-lg > .btn {
  padding: 10px 16px;
  font-size: 18px;
  line-height: 1.3333333;
  border-radius: 6px;
}
.btn-sm,
.btn-group-sm > .btn {
  padding: 5px 10px;
  font-size: 12px;
  line-height: 1.5;
  border-radius: 3px;
}
.btn-xs,
.btn-group-xs > .btn {
  padding: 1px 5px;
  font-size: 12px;
  line-height: 1.5;
  border-radius: 3px;
}
</style>';

$sdata = dbquery("SELECT * FROM ".DB_TS3_SET);
while($data = dbarray($sdata)) {
	$host = $data['host'];
	$query_port = $data['query_port'];
	$port = $data['port'];
	$panel_button = $data['panel_button'];
	$button_site = $data['button_site'];
	$admin_login = $data['admin_login'];
	$admin_passw = $data['admin_passw'];
	$tssitelist = $data['tssitelist'];
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
echo '<div id="rechts">';
			echo $ts3_VirtualServer->getViewer(new TeamSpeak3_Viewer_Html("".INFUSIONS."ts3_panel/images/viewer/", "".INFUSIONS."ts3_panel/images/flags/", "data:image"));
			echo "<br />";
			if ($panel_button == "1") {
			if (iMEMBER) {
			echo "<center><a href='ts3server://".$host."?port=".$port."&nickname=".$userdata['user_name']."&password=".$pass_site."' class='btn btn-default btn-xs button'>Verbinden</a></center>";
			} else {
			echo "<center><a href='ts3server://".$host."?port=".$port."&nickname=Gast&password=".$pass_site."' class='btn btn-default btn-xs button'>Verbinden</a></center>";
		}
	}
echo '</div>
	<div id="links" style="text-align:center">';
	//Serverbanner
	if ($banner_site == "1") {
		echo "<img src='".$ts3_VirtualServer['virtualserver_hostbanner_gfx_url']."' width='345'><br /><br />";
	}
	//Welcome message
	if ($welcome_site == "1") {
	$find = array("[b]", "[/b]", "[i]", "[/i]", "[u]", "[/u]", "[center]", "[/center]");
	$rplace = array("<b>", "</b>", "<i>", "</i>"," <u>", "</u>", "<center>", "</center>");
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
echo '</div>';
echo '<div id="blocker"></div>';
echo '<br />';
if ($tssitelist == "1") {
#build a new ts3admin object
$tsAdmin = new ts3admin($host, $query_port);

if($tsAdmin->getElement('success', $tsAdmin->connect())) {
	#login as serveradmin
	$tsAdmin->login($admin_login, $admin_passw);
	
	#get serverlist
	$servers = $tsAdmin->serverList();
	
	#set output var
	$output = '';
	
	#generate table codes for all servers
	foreach($servers['data'] as $server) {
		$output .= '<tr>';
		$output .= '<td width="50px" align="center">#'.$server['virtualserver_id'].'</td>';
		$output .= '<td width="300px">&nbsp;&nbsp;'.htmlspecialchars($server['virtualserver_name']).'</td>';
		$output .= '<td width="100px" align="center">'.$server['virtualserver_port'].'</td>';
		if(isset($server['virtualserver_clientsonline'])) {
			$clients = $server['virtualserver_clientsonline'] . '/' . $server['virtualserver_maxclients'];
		}else{
			$clients = '-';
		}
		$output .= '<td width="200px" align="center">'.$clients.'</td>';
		$output .= '<td width="100px" align="center">'.$server['virtualserver_status'].'</td>';
		if(isset($server['virtualserver_uptime'])) {
			$uptime = $tsAdmin->convertSecondsToStrTime(($server['virtualserver_uptime']));
		}else{
			$uptime = '-';
		}
		$output .= '<td width="150px" align="center">'.$uptime.'</td>';
	}
}else{
	echo 'Connection could not be established.';
}

if(count($tsAdmin->getDebugLog()) > 0) {
	foreach($tsAdmin->getDebugLog() as $logEntry) {
		echo '<script>alert("'.$logEntry.'");</script>';
	}
}
echo '<style>
.table-bordered {
    border: 1px solid #ddd;
}
.table {
    width: 100%;
    max-width: 100%;
    margin-bottom: 20px;
}
table {
    background-color: transparent;
}
table {
    border-spacing: 0;
    border-collapse: collapse;
}
.table > caption + thead > tr:first-child > td, .table > caption + thead > tr:first-child > th, .table > colgroup + thead > tr:first-child > td, .table > colgroup + thead > tr:first-child > th, .table > thead:first-child > tr:first-child > td, .table > thead:first-child > tr:first-child > th {
    border-top: 0;
}
.table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
    border-bottom-width: 2px;
}
.table-bordered > tbody > tr > td, .table-bordered > tbody > tr > th, .table-bordered > tfoot > tr > td, .table-bordered > tfoot > tr > th, .table-bordered > thead > tr > td, .table-bordered > thead > tr > th {
    border: 1px solid #ddd;
}
.table > thead > tr > th {
    vertical-align: bottom;
    border-bottom: 2px solid #ddd;
}
.table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
    padding: 8px;
    line-height: 1.42857143;
    vertical-align: top;
    border-top: 1px solid #ddd;
}
th {
    text-align: left;
}
td, th {
    padding: 0;
}
</style>';
echo '<table class="table table-bordered" align="center">
		<thead> 
			<tr>
				<th>'.$locale['ts3over016'].'</th>
				<th>'.$locale['ts3over017'].'</th>
				<th>'.$locale['ts3over018'].'</th>
				<th>'.$locale['ts3over019'].'</th>
				<th>'.$locale['ts3over020'].'</th>
				<th>'.$locale['ts3over021'].'</th>
			</tr>
		</thead>
		<tbody>';
			echo $output;
		echo '</tbody>
	</table>';
}
}
catch(Exception $e)
{
	echo "<strong>".$locale['ts3over015']."</strong>";
}

#echo '<br />';
	echo '<hr />';
	echo '<br />';
	$aktualisierung = filemtime(basename($_SERVER['PHP_SELF']));
echo "<table width='100%'>";
echo "<div align='center'>".$locale['copyover_001']." <a href='".$locale['copyover_009']."' target='_blank'>".$locale['copyover_002']."</a>".$locale['copyover_zusatz']."<a href='".$locale['copyover_010']."' target='_blank'>".$locale['copyover_003']."</a>".$locale['copyover_zusatz']."<a href='".$locale['copyover_011']."' target='_blank'>".$locale['copyover_004']."</a>".$locale['copyover_zusatz']."<a href='".$locale['copyover_012']."' target='_blank'>".$locale['copyover_005']."</a>".$locale['copyover_zusatz']."<a href='".$locale['copyover_013']."' target='_blank'>".$locale['copyover_006']."</a></div>";
echo "</table>";
closetable();

require_once THEMES."templates/footer.php";
?>