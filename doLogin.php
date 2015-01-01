<?php
include_once($_SERVER['DOCUMENT_ROOT']."/wow.php");
$ajax_username = safe($_POST['username']);
$ajax_password = safe($_POST['password']);
$ajax_remember_me = safe($_POST['remember']);
// store session data
//session_register('uname');
/* check they filled in what they were supposed to and authenticate */
if(!$ajax_username || !$ajax_password) {
die("Fill the form first!");
}

// Replace bad characters //
$qry = "SELECT * FROM users WHERE username = '".$ajax_username."' OR oldusrname = '".$ajax_username."'"; 
$sqlmembers = mysqli_query(db(), $qry);
$check = mysqli_num_rows($sqlmembers);

$qry_email = "SELECT * FROM users WHERE email = '".$ajax_username."'";
$sqlmembers_email = mysqli_query(db(), $qry_email);
$check_email = mysqli_num_rows($sqlmembers_email);
$info = mysqli_fetch_array($sqlmembers_email);

if ($check_email == 0) {
$info = mysqli_fetch_array($sqlmembers); 
if ($check == 0) {
die("Invalid username and/or password.");
}}

 // check passwords match

$ajax_password = stripslashes($ajax_password);

$ajax_password = hash('sha256', $salt.$ajax_password);

if ($ajax_password != $info['password']) {
die("Invalid username and/or password.");
}

// if we get here username and password are correct, 

//register cookie variables.

$usr = mysqli_query(db(), "SELECT * FROM users WHERE email = '".$ajax_username."'"); 
if ($check_email == 0) {
$usr = mysqli_query(db(), "SELECT * FROM users WHERE username = '".$ajax_username."' OR oldusrname = '".$ajax_username."'"); 
}
$msga = mysqli_fetch_array($usr); 
$ida = $msga['id']; 
$expire=time()+60*60*24*30;
setcookie("username", $msga['username'], $expire, "/");
setcookie("id", $ida, $expire, "/");
setcookie("password", $ajax_password, $expire, "/");
if(is_ajax()){
	die('success');
}else{
	header("Location: /");
}
?>