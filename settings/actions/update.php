<?php
include_once($_SERVER['DOCUMENT_ROOT']."/wow.php");
if($logged_in == 0){
	header("Location: ".$_SERVER['DOCUMENT_ROOT']."/index.php");
	exit;
}
if(!isset($_POST['submit'])){
	header("Location: ".$_SERVER['DOCUMENT_ROOT']."/index.php");
	exit;
}
	$bg = safe($_POST['bg']);
	$usrname_color = safe($_POST['usrname_color']);
	$font = safe($_POST['font']);

	$bgcolors = array(
		"orange",
		"red",
		"lime",
		"aqua",
		"blue",
		"fuchsia",
		"purple"
	);
	$bg_color = "orange";
	if(in_array($_POST['bgcolor'], $bgcolors))
		$bg_color = safe($_POST['bgcolor']);
	/* tests */
	if(/*strtolower($usrname_color) == "f5d68f" || */!is_numeric($font) || $font < 1 || $font > 2 || !is_numeric($bg) || $bg < 1 || $bg > 6 || !preg_match('/^[a-f0-9]{6}$/i', $usrname_color)){
		header("Location: ../settings/index.php?alert=no");
		exit;
	}
	/* do queries n' shit */
	/* 	
		background types
		normal = 1
		8bit = 2
		neko = 3
		flandre = 4
		weed = 5
		tt = 6
	*/
	$setbg = mysqli_query(db(), "UPDATE users SET sig_bg = '$bg' WHERE username = '$username'");
	$setusrname_color = mysqli_query(db(), "UPDATE users SET usrname_color = '$usrname_color' WHERE username = '".$username."'");
	$setfont = mysqli_query(db(), "UPDATE users SET sig_font = '$font' WHERE username = '".$username."'");
	$setbg_color = mysqli_query(db(), "UPDATE users SET bg_color = '$bg_color' WHERE username = '$username'");
	/* check if everything is updated */
	if(!$setusrname_color || !$setbg || !$setfont || !$setbg_color){
		header("Location: ../settings/index.php?alert=error");
	}else{
		header("Location: ../settings/index.php?alert=success");
	}
?>