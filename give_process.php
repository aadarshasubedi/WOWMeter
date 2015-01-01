<?php
include_once($_SERVER['DOCUMENT_ROOT']."/wow.php");
function IsTorExitPoint(){
    if (gethostbyname(ReverseIPOctets($_SERVER['REMOTE_ADDR']).".".$_SERVER['SERVER_PORT'].".".ReverseIPOctets($_SERVER['SERVER_ADDR']).".ip-port.exitlist.torproject.org")=="127.0.0.2") {
        return true;
    } else {
       return false;
    } 
}

function ReverseIPOctets($inputip){
    $ipoc = explode(".",$inputip);
    return $ipoc[3].".".$ipoc[2].".".$ipoc[1].".".$ipoc[0];
}

function IsProxy(){
	$proxyAPI = file_get_contents('http://winmxunlimited.net/api/proxydetection/v1/query/?ip='.get_ip_address());
	if($proxyAPI === false){
		return false;
	}
	if($proxyAPI != "0" || @fsockopen($_SERVER['REMOTE_ADDR'], 80, $errstr, $errno, 1)){
		return true;
	} else {
		return false;
	}
}
switch($_POST['lang']){
	case "fr":
		$wrongtoken = "Token invalide. Essayez de actualiser la page.";
		$usernotfound = "Utilisateur inconnu.";
		break;
	case "tr":
		$wrongtoken = "Yanlış belirteç. Sayfayı yenilemeyi dene.";
		$usernotfound = "Kullanıcı bulunamadı.";
		break;
	case "gr":
		$wrongtoken = "Λάθος συμβολική. Δοκιμάστε δροσιστικό.";
		$usernotfound = "Ο χρήστης δεν βρέθηκε.";
		break;
	case "nl":
		$wrongtoken = "Verkeerde token. Probeer verfrissend.";
		$usernotfound = "Gebruiker niet gevonden.";
		break;
	case "es":
		$wrongtoken = "Símbolo equivocado. Trate refrescante..";
		$usernotfound = "Usuario no encontrado.";
		break;
	case "de":
		$wrongtoken = "Falsche zeichen. Versuchen erfrischend.";
		$usernotfound = "Nicht gefunden.";
		break;
	case "jp":
		$wrongtoken = "まちがったトークン。さわやかてみてください。";
		$usernotfound = "ユーザーがみつかりません。";
		break;
	default:
		$wrongtoken = "Wrong token. Try refreshing.";
		$usernotfound = "User not found.";
		break; 
}
	if(isset($_POST['token']) && isset($_POST['wow'])){
		if ($_POST['token'] != hash('sha256', $salt.get_ip_address())){
			die("<h3>$wrongtoken</h3><script>$(\".progress-bar\").toggleClass(\"progress-bar-success progress-bar-danger\")</script><span class='wow one'></span><span class='wow twosad'></span><span class='wow threesad'></span><span class='wow four'></span>");
		}
		# check if user is legit
		if(preg_match('/[^\w-]+/i', $_POST['wow'])){
			echo "<h3>$usernotfound :(</h3><script>$(\".progress-bar\").toggleClass(\"progress-bar-success progress-bar-danger\")</script><span class='wow one'></span><span class='wow twosad'></span><span class='wow threesad'></span><span class='wow four'></span>";
		}else{
		# get user data
		$getuser_sql = mysqli_query(db(), "SELECT * FROM users WHERE username = '".safe($_POST['wow'])."' OR oldusrname = '".safe($_POST['wow'])."'");
		$user = mysqli_fetch_array($getuser_sql); 
		switch($_POST['lang']){
	case "jp":
		$userbanned = "もうしわけありませんが、".$user['username']."はWOWMeterからきんしされている。";
		$alreadygaveawow = "すでにきょう".$user['username']."にワウたしました！<br>あしたもういちどおためしください！";
		$success = "はワウせいこうし".$user['username']."にあたえられた！"; 
		break;
	default:
		$userbanned = "Sorry, ".$user['username']." is banned from WOWMeter.";
		$alreadygaveawow = "You've already gave a wow to ".$user['username']." today!<br>Try again tomorrow!";
		$success = "WOW successfully given to ".$user['username']."!"; 
		break; 
}
		if (mysqli_num_rows($getuser_sql) == 0){
			echo "<h3>$usernotfound :(</h3><script>$(\".progress-bar\").toggleClass(\"progress-bar-success progress-bar-danger\")</script><span class='wow one'></span><span class='wow twosad'></span><span class='wow threesad'></span><span class='wow four'></span><style>body:before{background: url(../images/saddoge.png)</style>";
		}else{
		# check if the user is banned
		if($user['isbanned'] == 1){
			echo "<h3>$userbanned</h3><script>$(\".progress-bar\").toggleClass(\"progress-bar-success progress-bar-danger\")</script><span class='wow one'></span><span class='wow twosad'></span><span class='wow threesad'></span><span class='wow four'></span><style>body:before{background: url(../images/saddoge.png)</style>";
		}else{
		# check if using tor
		if(IsProxy()){
			echo "<h4>Sorry, we have detected that you might be using a proxy,<br>thus we blocked you from<br>giving a wow in order to<br>stop people from cheating.</h4><script>$(\".progress-bar\").toggleClass(\"progress-bar-success progress-bar-danger\")</script><span class='wow one'></span><span class='wow twosad'></span><span class='wow threesad'></span><span class='wow four'></span><style>body:before{background: url(../images/saddoge.png)</style>";
		}else{
		# check if the ip already gave the user a wow
		$getwows_sql = mysqli_query(db(), "SELECT DATE_FORMAT(wow_date, '%Y-%m-%d') FROM wow WHERE wow_to = '".$user['id']."' AND wow_from = '".get_ip_address()."' AND DATE(wow_date) = CURDATE()");
		$getwows_number = mysqli_num_rows($getwows_sql);
		if($getwows_number > 0 || $_COOKIE["wow_expire_".$user['id']] == hash('sha256', "wow".$user['id']."wow")){
			echo "<h3>$alreadygaveawow</h3><script>$(\".progress-bar\").toggleClass(\"progress-bar-success progress-bar-danger\")</script><span class='wow one'></span><span class='wow twosad'></span><span class='wow threesad'></span><span class='wow four'></span><style>body:before{background: url(../images/saddoge.png)</style>";
		}else{
			# the mofo visitor can now give a wow
			$givewow = mysqli_query(db(), "INSERT INTO wow ( 
                wow_to, 
                wow_from, 
                wow_ref) 
                VALUES ( 
                '".$user['id']."', 
                '".get_ip_address()."', 
                '".safe($_POST['ref'])."'
                )");
			if(!$givewow){
				echo "<h3>Unexpected database error. :(</h3><script>$(\".progress-bar\").toggleClass(\"progress-bar-success progress-bar-danger\")</script><span class='wow one'></span><span class='wow twosad'></span><span class='wow threesad'></span><span class='wow four'></span>";
			}else{
				$expire = strtotime('tomorrow');
				$wow_expire = hash('sha256', "wow".$user['id']."wow");
				setcookie("wow_expire_".$user['id'], $wow_expire, $expire, "/");
				echo "<h3>$success</h3><span class='wow one'></span><span class='wow two'></span><span class='wow three'></span><span class='wow four'></span>";
				if($logged_in != 1)
					echo "<h4 style='color:red'>vvv Do you want a WOWMeter too? Join now! vvv</h4>";
			}
		}}}}}}else{die("unknown error");}
?>