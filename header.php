<?php
include_once($_SERVER['DOCUMENT_ROOT']."/wow.php");
if($needlogin == 1 && $logged_in == 0){
	header("Location: index.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php if(isset($title)){echo$title;}else{echo "WOWMeter";} ?></title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="WOWMeter is a website where you can give and recieve wows to show how cool and awesome you are.">
<meta name="keywords" content="cute,dog,doge,dogs,funny,kawaii,net,tk,weird,wow,wowmeter">
<meta name="author" content="MarioErmando">	
<meta property="og:title" content="<?php if(isset($title)){echo$title;}else{echo "WOWMeter";} ?>" />
<meta property="og:description" content="WOWMeter is a website where you can give and recieve wows to show how cool and awesome you are." />
<meta property="og:type" content="website" />
<meta property="og:url" content="<?=htmlspecialchars("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", ENT_QUOTES, 'UTF-8')?>" />
<meta property="og:image" content="http://wowmeter.net/images/og_image.png" />
<link rel="stylesheet" href="/css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="/css/main.css" type="text/css" />
<script src="/js/main.js?v=2"></script>
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php
	$bgcolors = array(
		"orange" => "F5D68F",
		"red" => "F5928F",
		"lime" => "D0F58F",
		"aqua" => "8FF2F5",
		"blue" => "8FAEF5",
		"fuchsia" => "F58FE1",
		"purple" => "B48FF5"
	);
if($logged_in == 1)
	echo "<style type=\"text/css\">body{ background-color: #".$bgcolors[$row['bg_color']]." }</style>\n";
?></head>
<body class="bg center<?php if($saddoge == 1)echo" saddoge";?>">
	<a href="/" class="header">WOWMeter</a>