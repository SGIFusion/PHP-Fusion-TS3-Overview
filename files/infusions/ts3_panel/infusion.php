<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2016 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Name: SGI Fusion TS3 Viewer (für v7.02.xx)
| Filename: infusion.php
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

include INFUSIONS."ts3_panel/infusion_db.php";

$inf_title = "Teamspeak 3 Panel";
$inf_description = "Teamspeak 3 Panel";
$inf_version = "1.5";
$inf_developer = "Septron &amp; Harlekin";
$inf_email = "support@septron.de";
$inf_weburl = "http://www.septron.de";
$inf_folder = "ts3_panel";

$inf_newtable[1] = DB_TS3_SET." (
id INT(10) NOT NULL AUTO_INCREMENT,
host VARCHAR(255) NOT NULL DEFAULT '',
query_port VARCHAR(255) NOT NULL DEFAULT '',
port VARCHAR(255) NOT NULL DEFAULT '',
panel_button VARCHAR(10) NOT NULL DEFAULT '',
button_site VARCHAR(10) NOT NULL DEFAULT '',
admin_login VARCHAR(25) NOT NULL DEFAULT '',
admin_passw VARCHAR(10) NOT NULL DEFAULT '',
tssitelist VARCHAR(10) NOT NULL DEFAULT '',
banner_site VARCHAR(10) NOT NULL DEFAULT '',
welcome_site VARCHAR(10) NOT NULL DEFAULT '',
name_site VARCHAR(10) NOT NULL DEFAULT '',
ip_site VARCHAR(100) NOT NULL DEFAULT '',
port_site VARCHAR(10) NOT NULL DEFAULT '',
security_site VARCHAR(10) NOT NULL DEFAULT '',
version_site VARCHAR(10) NOT NULL DEFAULT '',
plattform_site VARCHAR(10) NOT NULL DEFAULT '',
status_site VARCHAR(10) NOT NULL DEFAULT '',
created_site VARCHAR(10) NOT NULL DEFAULT '',
online_site VARCHAR(10) NOT NULL DEFAULT '',
started_site VARCHAR(10) NOT NULL DEFAULT '',
ping_site VARCHAR(10) NOT NULL DEFAULT '',
clients_site VARCHAR(10) NOT NULL DEFAULT '',
channels_site VARCHAR(10) NOT NULL DEFAULT '',
packets_site VARCHAR(10) NOT NULL DEFAULT '',
month_site VARCHAR(10) NOT NULL DEFAULT '',
voice_site VARCHAR(10) NOT NULL DEFAULT '',
file_site VARCHAR(10) NOT NULL DEFAULT '',
total_site VARCHAR(10) NOT NULL DEFAULT '',
pass_site VARCHAR(100) NOT NULL DEFAULT '',
pass_hide_site VARCHAR(10) NOT NULL DEFAULT '',
android_site VARCHAR(10) NOT NULL DEFAULT '',
PRIMARY KEY (id)
) ENGINE=MyISAM;";

$inf_insertdbrow[1] = DB_TS3_SET." (host, query_port, port, admin_login, admin_passw, pass_site) VALUES('127.0.0.1', '10011', '9987', 'serveradmin', '', '')";
$inf_droptable[1] = DB_TS3_SET;

// I do not wish to have the following translated for personal reasons.
$message = "Hallo ".$userdata['user_name'].",

toll das du dich für die Teamspeak3 Infusion von SGI Fusion entschieden hast.
Damit du immer auf den laufenden bist ob es änderungen dieser Infusion gibt Besuche doch einach die unten genannten Seiten.
Dort bieten wir den Support so wie Vorschläge und änderungen zu dieser Infusion an.

[b]Website:[/b] [url=http://www.septron.de]SGI Fusion[/url]
[b]Support Thread:[/b] [url=http://phpfusion-deutschland.de/forum/viewthread.php?thread_id=955]Support/Feedback[/url]

[b]Credits:[/b] [url=http://harlekinpower.de]HarlekinPower[/url]
[url=https://www.planetteamspeak.com]PlanetTeamspeak[/url]
[url=http://ts3admin.info]ts3admin[/url]

Danke,
SGI Fusion, PHPFusion Deutschland, HelekinPower, PlanetTeamspeak und ts3admin";
// End Comment

$inf_insertdbrow[2] = DB_MESSAGES . " (message_to, message_from, message_subject, message_message, message_smileys, message_read, message_datestamp, message_folder) VALUES('" .
    $userdata['user_id'] . "','" . $userdata['user_id'] . "','SGI Fusion TS3 Overview','" . stripinput($message) .
    "','0','0','" . time() . "','0')";

$inf_adminpanel[1] = array(
	"title" => "Teamspeak 3",
	"image" => "sgif_ts3.png",
	"panel" => "ts3_admin.php",
	"rights" => "TS3A"
);

$inf_sitelink[1] = array(
	"title" => "Teamspeak 3",
	"url" => "ts3_view.php",
	"visibility" => "0" // 0 - Guest / 101 - Member / 102 - Admin / 103 - Super Admin.
);
?>

