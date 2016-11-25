<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2016 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Name: SGI Fusion TS3 Viewer (für v7.02.xx)
| Filename: ts3_panel.php
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
if (!defined("IN_FUSION")) { die("Access Denied"); }
include INFUSIONS."ts3_panel/infusion_db.php";
require_once INFUSIONS."ts3_panel/framework/libraries/TeamSpeak3/TeamSpeak3.php";

if (file_exists(INFUSIONS."ts3_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."ts3_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."ts3_panel/locale/English.php";
}

echo "<style type='text/css' media='screen'>
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
      background: url('".INFUSIONS."ts3_panel/images/viewer/spacer_solidline.gif');
		background-repeat: repeat-x;
    }
    table.ts3_viewer td.spacer.dashline {
      background: url('".INFUSIONS."ts3_panel/images/viewer/spacer_dashline.gif');
		background-repeat: repeat-x;
    }
    table.ts3_viewer td.spacer.dashdotline {
      background: url('".INFUSIONS."ts3_panel/images/viewer/spacer_dashdotline.gif');
		background-repeat: repeat-x;
    }
    table.ts3_viewer td.spacer.dashdotdotline {
      background: url('".INFUSIONS."ts3_panel/images/viewer/spacer_dashdotdotline.gif');
		background-repeat: repeat-x;
    }
    table.ts3_viewer td.spacer.dotline {
      background: url('".INFUSIONS."ts3_panel/images/viewer/spacer_dotline.gif');
		background-repeat: repeat-x;
    }
  -->
  #ts3_panel {
margin: 0 auto;
overflow: hidden;
padding: 0;
width: 100%;
}
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
  </style>";

openside($locale['ts3over022']);
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
	echo "<span style='font-size: 9px; color: #000000;'>".$ts3_VirtualServer->getViewer(new TeamSpeak3_Viewer_Html("".INFUSIONS."ts3_panel/images/viewer/", "".INFUSIONS."ts3_panel/images/flags/", "data:image"))."</span>";
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
closeside();
?>