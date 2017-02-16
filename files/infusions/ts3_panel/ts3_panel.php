<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2016 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Name: SGI Fusion TS3 Viewer (für v7.02.xx)
| Filename: ts3_panel.php
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
if (!defined("IN_FUSION")) { die("Access Denied"); }
include INFUSIONS."ts3_panel/infusion_db.php";
require_once INFUSIONS."ts3_panel/framework/libraries/TeamSpeak3/TeamSpeak3.php";

if (file_exists(INFUSIONS."ts3_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."ts3_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."ts3_panel/locale/English.php";
}
openside($locale['ts3over022']);
##################################################################################################
echo '<div id="ts3refreshpanel">';
echo '<center><strong>Wait!</strong> 20 seconds until Teampeak&sup3; is loaded.</center>';
##################################################################################################
echo '</div>';
##################################################################################################
closeside();
?>
<script>
 $(document).ready(function() {

   var auto_refresh = setInterval( function() { $('#ts3refreshpanel').load('/infusions/ts3_panel/ts3_refresh_panel.php'); }, 20000);

});
</script>
