<?php
if(isset($_GET['small'])){
	$im = imagecreatefromgif("images/new_map.gif");
	$offset = 10;
	$maptype = "small";
}else{
	$im = imagecreatefromgif("images/map.gif");
	$offset = 0;
}
if(date('Y-m-d', filemtime('mapcache'.$maptype.'.gif')) != date('Y-m-d') || isset($_GET['refresh'])) {
require_once($_SERVER['DOCUMENT_ROOT']."/wow.php");
require_once($_SERVER['DOCUMENT_ROOT']."/geoip/geoipcity.inc");
require_once($_SERVER['DOCUMENT_ROOT']."/geoip/geoip.inc");

$gi = geoip_open("geoip/GeoLiteCity.dat", GEOIP_STANDARD);
$rsGeoData = geoip_record_by_addr($gi, $ip);

$dot = imagecolorallocate($im, 143, 0, 0);
$normal = imagecolorallocate($im, 0, 0, 0);
$red = imagecolorallocate($im, 255, 0, 0);
$dota = imagecolorallocatealpha($im, 0, 0, 255, 50);

$sql = mysqli_query(db(), "SELECT * FROM wow");
while($wow = mysqli_fetch_assoc($sql)){
	$rsGeoData = geoip_record_by_addr($gi, $wow["wow_from"]);
	$scale_x = imagesx($im);
	$scale_y = imagesy($im);
	$lat = $rsGeoData->latitude;
	$long = $rsGeoData->longitude;
	$pt = getlocationcoords($lat, $long, $scale_x, $scale_y);
	if($lat != 0 && $long != 0)
	ImageRectangle($im, $pt["x"] - $offset, $pt["y"], $pt["x"] - $offset, $pt["y"], $dot);
}
//draw(0, 0, $red);
imagestring($im, 2, 1, 0, "WOWMeter World Map - http://wowmeter.net", $normal);
imagestring($im, 2, 1, 240, "Updated every 24 hours", $normal);
imagestring($im, 2, 450, 0, date('Y/m/d'), $normal);
imagestring($im, 2, 450, 240, mysqli_num_rows($sql)." wows", $normal);

imagegif($im, 'mapcache'.$maptype.'.gif');
imagedestroy($im);
}
header('Content-Type: image/gif');
readfile('mapcache'.$maptype.'.gif');

function getlocationcoords($lat, $lon, $width, $height) 
{ 
   $x = (($lon + 180) * ($width / 360)); 
   $y = ((($lat * -1) + 90) * ($height / 180));
   return array("x"=>$x,"y"=>$y); 
}

function draw($lat, $lon, $color = NULL){
	global $im;
	global $offset;
	global $dot;
	if($color == NULL)
		$color = $dot;
	$pt = getlocationcoords($lat, $long, imagesx($im), imagesy($im));
	ImageRectangle($im, $pt["x"] - $offset, $pt["y"], $pt["x"] + 1 - $offset, $pt["y"] + 1, $dot);
}