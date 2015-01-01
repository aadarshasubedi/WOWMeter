<?php
include_once($_SERVER['DOCUMENT_ROOT']."/wow.php");
if($logged_in == 0){
	header("Location: index.php");
	exit;
}
$_GET['action'] = safe($_GET['action']);
switch($_GET['action']){
	case "deleteacc":
	case "update":
	case "changeusrname":
	case "changepasswd":
		include_once("actions/".$_GET['action'].".php");
		exit;
		break;
	default:
		die("Unknown action. :(");
		break;
}
?>