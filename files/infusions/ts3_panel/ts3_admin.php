<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2016 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Name: SGI Fusion TS3 Viewer (für v7.02.xx)
| Filename: ts3_admin.php
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
require_once THEMES."templates/admin_header.php";
include INFUSIONS."ts3_panel/infusion_db.php";

if (file_exists(INFUSIONS."ts3_panel/locale/".$settings['locale'].".php")) {
	include INFUSIONS."ts3_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."ts3_panel/locale/English.php";
}
echo '<link rel="stylesheet" href="'.INFUSIONS.'ts3_panel/style.css">';
if (!checkrights("TS3A") || !defined("iAUTH") || $_GET['aid'] != iAUTH) { redirect("../../index.php"); }

if (isset($_GET['message'])){
	$message = "Einstellungen gespeichert";
	if ($message) {	echo "<div id='close-message'><div class='admin-message'>".$message."</div></div>"; }
}

opentable($locale['ts3over059']);

if(isset($_POST['save_data'])) {
	$host = stripinput($_POST['host']);
	$query_port = stripinput($_POST['query_port']);
	$port = stripinput($_POST['port']);
	$panel_button = stripinput($_POST['panel_button']);
	$button_site = stripinput($_POST['button_site']);
	$banner_site = stripinput($_POST['banner_site']);
	$welcome_site = stripinput($_POST['welcome_site']);
	$name_site = stripinput($_POST['name_site']);
	$ip_site = stripinput($_POST['ip_site']);
	$port_site = stripinput($_POST['port_site']);
	$security_site = stripinput($_POST['security_site']);
	$version_site = stripinput($_POST['version_site']);
	$plattform_site = stripinput($_POST['plattform_site']);
	$status_site = stripinput($_POST['status_site']);
	$created_site = stripinput($_POST['created_site']);
	$online_site = stripinput($_POST['online_site']);
	$started_site = stripinput($_POST['started_site']);
	$ping_site = stripinput($_POST['ping_site']);
	$clients_site = stripinput($_POST['clients_site']);
	$channels_site = stripinput($_POST['channels_site']);
	$month_site = stripinput($_POST['month_site']);
	$packets_site = stripinput($_POST['packets_site']);
	$voice_site = stripinput($_POST['voice_site']);
	$file_site = stripinput($_POST['file_site']);
	$total_site = stripinput($_POST['total_site']);
	$pass_site = stripinput($_POST['pass_site']);
	$pass_hide_site = stripinput($_POST['pass_hide_site']);
	$android_site = stripinput($_POST['android_site']);
	
	$result = dbquery("UPDATE ".DB_TS3_SET." SET host='".$host."', query_port='".$query_port."', port='".$port."', panel_button='".$panel_button."', button_site='".$button_site."', banner_site='".$banner_site."', welcome_site='".$welcome_site."', name_site='".$name_site."', ip_site='".$ip_site."', port_site='".$port_site."', security_site='".$security_site."', version_site='".$version_site."', plattform_site='".$plattform_site."', status_site='".$status_site."', created_site='".$created_site."', online_site='".$online_site."', started_site='".$started_site."', ping_site='".$ping_site."', clients_site='".$clients_site."', channels_site='".$channels_site."', month_site='".$month_site."', packets_site='".$packets_site."', voice_site='".$voice_site."', file_site='".$file_site."', total_site='".$total_site."', pass_site='".$pass_site."', pass_hide_site='".$pass_hide_site."', android_site='".$android_site."'");
	redirect(FUSION_SELF.$aidlink."&message=true");

} else {
	
	echo "<table align='center' cellspacing='1' cellpadding='2' width='100%' class='tbl-border'>\n";
	
	$res_db = dbquery("SELECT * FROM ".DB_TS3_SET."");
	while($data = dbarray($res_db)) {
	
		echo "<form name='ts3server_settings' action='".FUSION_SELF.$aidlink."' method='post'>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over025']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'><input type='text' class='textbox' name='host' style='width:200px;' value='".$data['host']."' placeholder='127.0.0.1'><br />
			<small><em>".$locale['ts3over026']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over027']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'><input type='text' class='textbox' name='query_port' style='width:200px;' value='".$data['query_port']."' placeholder='10011'><br /><small><em>".$locale['ts3over028']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over029']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'><input type='text' class='textbox' name='port' style='width:200px;' value='".$data['port']."' placeholder='9987'><br /><small><em>".$locale['ts3over030']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over060']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='panel_button' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['panel_button'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['panel_button'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['panel_button'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over061']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over062']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='button_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['button_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['button_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['button_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over063']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over066']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='banner_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['banner_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['banner_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['banner_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over067']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over068']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='welcome_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['welcome_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['welcome_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['welcome_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over069']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over070']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='name_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['name_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['name_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['name_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over071']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over072']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='ip_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['ip_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['ip_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['ip_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over073']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over074']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='port_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['port_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['port_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['port_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over075']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over114']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='security_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['security_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['security_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['security_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over115']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over076']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='version_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['version_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['version_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['version_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over077']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over078']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='plattform_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['plattform_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['plattform_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['plattform_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over079']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over080']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='status_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['status_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['status_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['status_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over081']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over082']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='created_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['created_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['created_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['created_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over083']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over084']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='online_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['online_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['online_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['online_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over085']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over086']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='started_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['started_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['started_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['started_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over087']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over120']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='ping_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['ping_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['ping_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['ping_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over121']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over088']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='clients_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['clients_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['clients_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['clients_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over089']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over090']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='channels_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['channels_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['channels_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['channels_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over091']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over110']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='month_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['month_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['month_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['month_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over111']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over117']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='packets_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['packets_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['packets_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['packets_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over118']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over092']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='voice_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['voice_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['voice_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['voice_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over093']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over094']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='file_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['file_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['file_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['file_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over095']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over107']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='total_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['total_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['total_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['total_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over108']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over096']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'><input type='text' class='textbox' name='pass_site' style='width:200px;' value='".$data['pass']."' placeholder='your server join password'><br /><small><em>".$locale['ts3over097']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over098']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='pass_hide_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['pass_hide_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['pass_hide_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['pass_hide_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over099']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n";
			echo "<td align='left' width='30%' class='tbl'><strong>".$locale['ts3over100']."</strong></td>";
			echo "<td align='left' width='50%' class='tbl'>";
				echo "<select name='android_site' style='width:200px;' class='textbox'>";
					echo "<option value=''(".($data['android_site'] == '' ? " selected" : "").">".$locale['ts3over102']."</option>";
					echo "<option value='0'(".($data['android_site'] == '0' ? " selected" : "").">".$locale['ts3over042']."</option>\n";
					echo "<option value='1'(".($data['android_site'] == '1' ? " selected" : "").">".$locale['ts3over043']."</option>\n";
				echo "</select><br /><small><em>".$locale['ts3over101']."</em></small></td>";
		echo "</tr>\n";
		
		echo "<tr>\n<td colspan='3' align='left' class='tbl'><input type='submit' name='save_data' value='Speichern' class='button'></td></tr>\n";

		echo "</form>\n";
		
	}
	
	echo "</table>\n";
	echo '<br />';
	echo '<hr />';
	echo '<br />';
echo '<table class="table table-bordered" width="100%">';
	echo '<thead>
		<tr>
			<th>'.$locale['ts3over049'].'</th>
			<th>'.$locale['ts3over050'].'</th>
		</tr>
	</thead> 
	<tbody>
		<tr>';
			if(ini_get('allow_url_fopen') != false){ 
			if ($ts3_panel_version = file_get_contents("https://www.septron.de/3rdupdates/ts3_overview.txt")) {
			if (preg_match("/^[0-9a-z\.]+$/", $ts3_panel_version)) {
		    $in_version = dbarray(dbquery("SELECT inf_version FROM ".DB_INFUSIONS." WHERE inf_folder = 'ts3_panel'"));	
            $inf_version = $in_version['inf_version'];
		    if (version_compare($ts3_panel_version, $inf_version, ">")) {
			echo '<th scope="row">'.$locale['ts3over047'].' '.$locale['ts3overver_002'].$inf_version.'&nbsp;-&nbsp;'.$locale['ts3over048'].' '.$locale['ts3overver_003'].$ts3_panel_version.'</th>';
			echo '<td>'.$locale['ts3overver_001'].' '.$locale['ts3overver_004'].'</td>';
			} else {
			echo '<th scope="row">'.$locale['ts3over047'].' '.$locale['ts3overver_006'].$inf_version.'&nbsp;-&nbsp;'.$locale['ts3over048'].' '.$locale['ts3overver_006'].$ts3_panel_version.'</th>';
			echo '<td>'.$locale['ts3overver_007'].'</td>';}
			} else {
			echo '<th scope="row">'.$locale['ts3overver_008'].'</th>';
			echo '<td>'.$locale['ts3overver_009'].'</td>';}
			} else {
			echo '<th scope="row">'.$locale['ts3overver_008'].'</th>';
			echo '<td>'.$locale['ts3overver_009'].'</td>';}
			} else {
			echo '<th scope="row">'.$locale['ts3overver_008'].'</th>';
			echo '<td>'.$locale['ts3overver_010'].'</td>';}
		echo '</tr>
	</tbody>
</table>';
	#echo '<br />';
	echo '<hr />';
	echo '<br />';
	$aktualisierung = filemtime(basename($_SERVER['PHP_SELF']));
echo "<table width='100%'>";
echo "<div align='center'>".$locale['copyover_001']." <a href='".$locale['copyover_009']."' target='_blank'>".$locale['copyover_002']."</a>".$locale['copyover_zusatz']."<a href='".$locale['copyover_011']."' target='_blank'>".$locale['copyover_004']."</a>".$locale['copyover_zusatz']."<a href='".$locale['copyover_012']."' target='_blank'>".$locale['copyover_005']."</a></div>";
echo "</table>";
	closetable();
}


require_once THEMES."templates/footer.php";
?>
