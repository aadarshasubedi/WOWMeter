<?php
include_once($_SERVER['DOCUMENT_ROOT']."/wow.php");
if(preg_match('/[^\w-]+/i', $_GET['wow'])){
	$title = "WOWMeter - User not found";
}else{
	$getuser_sql = mysqli_query(db(), "SELECT * FROM users WHERE username = '".safe($_GET['wow'])."' OR oldusrname = '".safe($_GET['wow'])."'");
	$user = mysqli_fetch_array($getuser_sql); 
	if (mysqli_num_rows($getuser_sql) == 0){
		$title = "WOWMeter - User not found";
	}else{
		$title = "WOWMeter - Giving a wow to ".$user["username"];
	}
	if(strtolower($_GET['wow']) != strtolower($user["username"])){
		header("Location: http://wowmeter.net/@".$user["username"]);
		exit;
	}
}
include_once($_SERVER['DOCUMENT_ROOT']."/header.php");
$bgcolors = array(
		"orange" => "F5D68F",
		"red" => "F5928F",
		"lime" => "D0F58F",
		"aqua" => "8FF2F5",
		"blue" => "8FAEF5",
		"fuchsia" => "F58FE1",
		"purple" => "B48FF5"
	);
echo "<style type=\"text/css\">";
if(isset($bgcolors[$user['bg_color']]))
	echo "body{ background-color: #".$bgcolors[$user['bg_color']]."!important }";
switch($_GET['lang']){
	case "fr":
		$givingawow = "Giving a wow...";
		$onlyenglish = "WOWMeter est uniquement disponible en anglais.";
		break;
	case "tr":
		$givingawow = "Giving a wow...";
		$onlyenglish = "WOWMeter'da sadece İngilizce mevcuttur.";
		break;
	case "gr":
		$givingawow = "Giving a wow...";
		$onlyenglish = "WOWMeter είναι διαθέσιμο μόνο στην αγγλική γλώσσα.";
		break;
	case "nl":
		$givingawow = "Giving a wow...";
		$onlyenglish = "WOWMeter is alleen beschikbaar in het Engels.";
		break;
	case "es":
		$givingawow = "Giving a wow...";
		$onlyenglish = "WOWMeter sólo está disponible en Inglés.";
		break;
	case "de":
		$givingawow = "Giving a wow...";
		$onlyenglish = "WOWMeter ist nur in Englisch verfügbar.";
		break;
	case "jp":
		$givingawow = "あたえるワウ...";
		$onlyenglish = "WOWMeterはえいごでのみりようかのうです。";
		break;
	default:
		$givingawow = "Giving a wow...";
		break;
}
?>
/*
#secret
html{
	background-image: url(http://24.media.tumblr.com/tumblr_mbvqf61eNA1r2noroo1_1280.jpg);
	background-size: 100%;
}
body{
	background: none !important;
}
*/
</style>
<script type="text/javascript">
  $(document).ready(function(){
  	$(".wow-give h3").html("<span class='wow-give-text'><h3><?=$givingawow?></h3><span class='wow one'></span><span class='wow two'></span><span class='wow three'></span><span class='wow four'></span></span><div class=\"progress progress-striped active\" style=\"margin:0\"><div class=\"progress-bar progress-bar-success\" role=\"progressbar\" aria-valuenow=\"0\" aria-valuemin=\"0\" aria-valuemax=\"100\" style=\"width: 35%\"></div></div>");
  /*});
  $(window).load(function() {*/
	<?php if(no_ajax_support()){ ?>
	$(".progress").css("display", "none");
	var r = new XMLHttpRequest(); 
	var params = "token=<?=hash('sha256', $salt.get_ip_address())?>&wow=<?=safe($_GET['wow'])?>&ref=<?=safe($_SERVER['HTTP_REFERER'])?>";
	r.open("POST", "/give_process.php", true);
	r.onreadystatechange = function () {
		$(".wow-give").html(r.responseText);
		if (r.readyState != 4 || r.status != 200) $(".wow-give").html("<h3>Oops, we can't connect to the server,<br>please try again in a few moments.</h3>");
	};
	r.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	r.setRequestHeader("Content-length", params.length);
	r.setRequestHeader("Connection", "close");
	r.send(params);
	<?php }else{ ?>
		/* please edit the fallback also */
	var form_data = {
		token: "<?=hash('sha256', $salt.get_ip_address())?>",
		wow: "<?=safe($_GET['wow'])?>",
		ref: "<?=safe($_SERVER['HTTP_REFERER'])?>",
		lang: "<?=safe($_GET['lang'])?>"
	};
	$.ajax({
	type: "POST",
	url: "/give_process.php",
	data: form_data,
	beforeSend: function()
	{
		$(".progress-bar").css("width", "70%");
	},
	success: function(response)
	{
		$(".wow-give-text").html(response);
		$(".progress-bar").css("width", "100%");
	},
	error:function(){
		$(".wow-give-text").html("<h3>Oops, we can't connect to the server,<br>please try again in a few moments.</h3>");
		$(".progress-bar").toggleClass("progress-bar-success progress-bar-danger").css("width", "100%");
	}
	});
	<?php }?>
});
</script>
	<div class="box small no-title headline wow-give">
		<h3>
			<?php if($title != "WOWMeter - User not found"){ ?>
			<form action="give_process.php" method="POST">
				<input type="hidden" name="token" value="<?=hash('sha256', $salt.get_ip_address())?>">
				<input type="hidden" name="wow" value="<?=safe($_GET['wow'])?>">
				<input type="hidden" name="ref" value="<?=safe($_SERVER['HTTP_REFERER'])?>">
				<input type="hidden" name="lang" value="<?=safe($_GET['lang'])?>">
				<input type="submit" value="Click here to give a wow to <?=safe($_GET['wow'])?>">
			</form>
			<?php } else {
					echo "User not found.";
				} 
			?>
		</h3>
	</div>
	<?php if(isset($onlyenglish))echo "<p style='color:#555'>$onlyenglish</p>";?>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/main.php"); ?>