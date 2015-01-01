<?php
$start = microtime(true);
$maintenance = "";
$allowed_ip = "YOUR IP HERE";
header('content-type: text/html; charset=utf-8');
mb_internal_encoding("UTF-8");
date_default_timezone_set('Europe/Berlin'); //set time to CEST
error_reporting (E_ALL ^ E_NOTICE);
@session_start();

function get_ip_address() {
$mysql = mysqli_query(db(), "SELECT * FROM users WHERE username='".safe($_COOKIE['username'])."' AND id='".safe($_COOKIE['id'])."' AND password='".safe($_COOKIE['password'])."'");
$row = mysqli_fetch_array($mysql);
foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
if (array_key_exists($key, $_SERVER) === true) {
foreach (explode(',', $_SERVER[$key]) as $ip) {
if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
return $ip;
}}}}}

$contact = "example@gmail.com";
if($maintenance != ""){
    if(get_ip_address() != $allowed_ip){
        if($_SERVER['PHP_SELF'] == "/image_generate.php"){
        header('Content-Type: image/png');
        $data = "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";
        $data = base64_decode($data);
        $im = imagecreatefromstring($data);
        imagepng($im);
        exit;
        }else{
            die('WOWMeter is at maintenance mode.<br>Reason: <code>'.$maintenance.'.</code><br>Please try again later.<br><br><img src="https://i.chzbgr.com/maxW500/3641435136/hB184B257/"/><br>');
        }
    }
}
###########################
# Connect to the database #
###########################
include($_SERVER['DOCUMENT_ROOT']."/wowdb.php");
$db = new mysqli($host, $db_username, $db_pass, $db_name);
if(mysqli_connect_errno()){
    die ("<center>Oh no! It's looks like we can't connect to the server!<br>Refresh the page to retry.<br/><input type='button' value='Refresh' onClick='document.location.reload(true)'><br/><br/>Problem: [" . db()->connect_error . "]</center>"); 
    //die('Unable to connect to database [' . db()->connect_error . ']');
}
mysqli_query (db(),'SET NAMES UTF8;');
mysqli_query (db(),'SET COLLATION_CONNECTION=utf8_general_ci;');
$salt = "4[M5H)z)lFuP2Ax1,C,TH4IT1{MqfyxrTQ]kFWT.O/"; // creates a salt value to better encrypt the users password
$mysql = mysqli_query(db(), "SELECT * FROM users WHERE username='".safe($_COOKIE['username'])."' AND id='".safe($_COOKIE['id'])."' AND password='".safe($_COOKIE['password'])."'");
$row = mysqli_fetch_array($mysql);
$rowuser = $row;
$rows = mysqli_num_rows($mysql);
if($rows != 1) {
$logged_in = 0;
setcookie("username", "", time()-3600);
setcookie("id", "", time()-3600);
setcookie("password", "", time()-3600);
unset($_SESSION['username']);
unset($_SESSION['id']);
unset($_SESSION['password']);
} else {
$logged_in = 1;
mysqli_query(db(), "UPDATE users SET ip = '".get_ip_address()."' WHERE username='".safe($_COOKIE['username'])."' AND id='".safe($_COOKIE['id'])."' AND password='".safe($_COOKIE['password'])."'") or die("Can't update database!");
}
if($username == '')
{
    $username = safe($_COOKIE['username']);
}
GLOBAL $username;
if($row['isbanned'] == 1){
    die("Sorry, you're banned from WOWMeter.");
}
###########################
#        Functions        #
###########################
function db()
{
    global $db;
    global $host;
    global $db_username;
    global $db_pass;
    global $db_name;
    if (!$db) {
        $db = new mysqli($host, $db_username, $db_pass, $db_name);
    }

    return $db;
}
function nicetime($date)
{
    if(empty($date)) {
        return "No date provided";
    }
    
    $periods         = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
    $lengths         = array("60","60","24","7","4.35","12","10");
    
    $now             = time();
    $unix_date       = strtotime($date);
    
       // check validity of date
    if(empty($unix_date)) {    
        return "some time ago";
    }

    // is it future date or past date
    if($now > $unix_date) {    
        $difference     = $now - $unix_date;
        $tense         = "ago";
        
    } else {
        $difference     = $unix_date - $now;
        $tense         = "from now";
    }
    
    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
        $difference /= $lengths[$j];
    }
    
    $difference = round($difference);
    
    if($difference != 1) {
        $periods[$j].= "s";
    }
    if (substr( $periods[$j], 0, 6 ) === "second" && $difference <= 59){
    return "few seconds ago";
    }else{
    return "$difference $periods[$j] {$tense}";
    }
}
/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 50px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source http://gravatar.com/site/implement/images/php/
 */
function get_gravatar( $email, $s = 50, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
    $url = 'http://www.gravatar.com/avatar/';
    $url .= md5( strtolower( trim( $email ) ) );
    $url .= "?s=$s&d=$d&r=$r";
    if ( $img ) {
        $url = '<img src="' . $url . '"';
        foreach ( $atts as $key => $val )
            $url .= ' ' . $key . '="' . $val . '"';
        $url .= ' />';
    }
    return $url;
}
function safe($input) {
	$valid_input = mysqli_real_escape_string(db(), trim(stripcslashes(htmlspecialchars($input ,ENT_QUOTES, "UTF-8"))));
	return $valid_input;
}

function lb2br($input){
    return preg_replace('/\v+|\\\[rn]/','<br/>',$input);
}
function is_ajax() {
if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    return true;
}
else {
    return false;
}}
function readableColour($bg){
    $r = hexdec(substr($bg,0,2));
    $g = hexdec(substr($bg,2,2));
    $b = hexdec(substr($bg,4,2));

    $contrast = sqrt(
        $r * $r * .241 +
        $g * $g * .691 +
        $b * $b * .068
    );

    if($contrast > 160){
        return true;
    }else{
        return false;
    }
}
function no_ajax_support(){
if(strpos($_SERVER['HTTP_USER_AGENT'], 'Nintendo DSi') !== false || strpos($_SERVER['HTTP_USER_AGENT'], 'Nintendo 3DS') !== false){
    return true;
}else{
    return false;
}
}
$banned_words = array(
    "nazi",
    "hitler",
    "sterlin",
    "jong",
    "jongun",
    "nigg",
    "fuck",
    "bitch",
    "dick",
    "ass",
    "fap"
);
if(is_ajax()){
    $ajax_linebreak = "\n";
}else{
    $ajax_linebreak = "</br>";
}
?>