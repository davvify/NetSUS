<?php

session_start();

$noAuthURL="index.php";

if (!($_SESSION['isAuthUser'])) {

	echo "Not authorized - please log in";

} else {

	include "inc/config.php";
	include "inc/functions.php";
	
	function ldapExec($cmd) {
		return shell_exec("sudo /bin/sh scripts/ldapHelper.sh ".escapeshellcmd($cmd)." 2>&1");
	}

	if (isset($_POST['ldapproxy'])) {
		if ($_POST['ldapproxy'] == "enable") {
			$conf->setSetting("ldapproxy", "enabled");
			ldapExec("enableproxy");
		} else {
			$conf->setSetting("ldapproxy", "disabled");
			ldapExec("disableproxy");
		}
	}

	if (isset($_POST['showproxy'])) {
		if ($_POST['showproxy'] == "true") {
			$conf->setSetting("showproxy", "true");
		} else {
			$conf->setSetting("showproxy", "false");
		}
	}

}
?>