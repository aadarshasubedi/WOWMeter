<div id="fb-root"></div>
<div class="social">
	<span>Show your love for WOWMeter!</span>
	<div class="fb-like" data-href="https://facebook.com/WOWMeter" data-width="5" data-layout="button" data-action="like" data-show-faces="false" data-share="true"></div>
</div>
<?php if($noprofile_n_shit != 1){
		require_once($_SERVER['DOCUMENT_ROOT']."/geoip/geoipregionvars.php");
		require_once($_SERVER['DOCUMENT_ROOT']."/geoip/geoipcity.inc");
		require_once($_SERVER['DOCUMENT_ROOT']."/geoip/geoip.inc");
		$gi = geoip_open($_SERVER['DOCUMENT_ROOT']."/geoip/GeoLiteCity.dat", GEOIP_STANDARD);
?><script type="text/javascript">
	function changelang(lang){
		var laang = lang;
		if(lang == "us"){
			lang = "";
		}else{
			lang = "?lang="+lang;
		}
		$("#bbcode-code").html("[url=http://wowmeter.net/@<?=$username?>"+lang+"][img]http://wowmeter.net/$<?=$username?>"+lang+"[/img][/url]");
		$("#html-code").html("&lt;a href=\"http://wowmeter.net/@<?=$username?>"+lang+"\" target=\"_blank\"&gt;&lt;img src=\"http://wowmeter.net/$<?=$username?>"+lang+"\" alt=\"Give <?=$username?> a wow\"/&gt;&lt;/a&gt;");
		$("#direct-code").attr("value", "http://wowmeter.net/@<?=$username?>"+lang);
		$("#sn-code").attr("value", "[wow=<?=$username?>"+lang+"]");
		var lang2;
		switch(laang){
			case "us":
			lang2 = "English";
			break;
			case "fr":
			lang2 = "Français";
			break;
			case "gr":
			lang2 = "ελληνική";
			break;
			case "tr":
			lang2 = "Türkçe";
			break;
			case "nl":
			lang2 = "Nederlands";
			break;
			case "es":
			lang2 = "Español";
			break;
			case "de":
			lang2 = "Deutsch";
			break;
			case "jp":
			lang2 = "日本語";
			break;
		}
		$("#lang-btn").html("<img src=\"/images/flags/"+laang+".gif\"/> "+lang2+" <span class=\"caret\"></span>");
		$("#sig").attr("src", "/$<?=$username?>?lang="+laang);
		return false;
	}
	var logintype = "login";
$(document).ready(function() {
	$("#loginbutton").click(function() {
		if(logintype == "register"){
			$("input[type=email], .register-alert").toggle();
			$("input[type=text]").attr("placeholder", "Username or email");
			document.getElementById("form").setAttribute("action", "/doLogin.php"); 
			logintype = "login";
			return false;
		}else{<?php if(!no_ajax_support()){?>
				var form_data = {
					username: $("input[name=username]").val(),
					password: $("input[name=password]").val()
				};
					$.ajax({
					type: "POST",
					url: "/doLogin.php",
					data: form_data,
					beforeSend:function(){
						$(".box.login").prepend("<i class='fa fa-spinner fa-spin fa-2x'></i>");
						$(".box.login > .fa-spinner").css({
						'color' : 'cyan',
						'position' : 'absolute',
						'top' : '5px',
						'right' : '6px',
						'z-index' : '1'
						});
					},
					success: function(response)
					{
						if(response == 'success'){
							$(".box.login > .fa-spinner").remove();
							$(".box.login").prepend("<i class='fa fa-ok fa-2x' style='color: #fff;position: absolute;top: 5px;right: 6px;z-index: 1;'></i>");
							document.location.href="/index.php";
						}else{
						if(response == ''){
							$(".box.login > .fa-spinner").remove();
							alert("No response from server. Please try again later.");
						}else{
							$(".box.login > .fa-spinner").remove();
							alert(response);
						}}
					},
					error:function(){
						$(".box.login > .fa-spinner").remove();
						alert("Oops, we can't connect to the server,\nplease try again in a few moments.");
					}
				});
				return false;
	<?php } ?>}});
	$("#registerbutton1").click(function() {
		if(logintype == "register"){<?php if(!no_ajax_support()){?>
				var form_data = {
					username: $("input[name=username]").val(),
					password: $("input[name=password]").val(),
					email: $("input[name=email]").val(),
				};
					$.ajax({
					type: "POST",
					url: "/doRegister.php",
					data: form_data,
					beforeSend:function(){
						$(".box.login").prepend("<i class='fa fa-spinner fa-spin fa-2x'></i>");
						$(".box.login > .fa-spinner").css({
						'color' : 'cyan',
						'position' : 'absolute',
						'top' : '5px',
						'right' : '6px',
						'z-index' : '1'
						});
					},
					success: function(response)
					{
						if(response == 'success'){
							$(".box.login > .fa-spinner").remove();
							$(".box.login").prepend("<i class='fa fa-ok fa-2x' style='color: #fff;position: absolute;top: 5px;right: 6px;z-index: 1;'></i>");
							document.location.href="/index.php";
						}else{
						if(response == ''){
							$(".box.login > .fa-spinner").remove();
							alert("No response from server. Please try again later.");
						}else{
							$(".box.login > .fa-spinner").remove();
							alert(response);
						}}
					},
					error:function(){
						$(".box.login > .fa-spinner").remove();
						alert("Oops, we can't connect to the server,\nplease try again in a few moments.");
					}
				});
				return false;
				<?php } ?>}else{
					$("input[type=email], .register-alert").toggle();
					$("input[type=text]").attr("placeholder", "Username");
					document.getElementById("form").setAttribute("action", "/doRegister.php"); 
					logintype = "register";
					return false;
				}
	});
	if(window.outerWidth > 765)$(".login, .col-md-offset-4").css('min-height', Math.max($(".login").outerHeight(), $(".col-md-offset-4").outerHeight()));
	$("textarea, input[type='text']").each(function(){ $(this).css("width", $(this).outerWidth() + "px !important"); });
	$("#bbcode-code, #html-code, #direct-code, #sn-code").click(function(){
		//$(this).select();
	});
});
$(window).load(function(){
	if(window.outerWidth > 765)$(".login, .col-md-offset-4").css('min-height', Math.max($(".login").outerHeight(), $(".col-md-offset-4").outerHeight()));
});
</script>
	<div class="row">
			<div class="box col-md-4 login">
		<?php
		if($logged_in == 0){
		?>
		<div class="title">Login</div>
		<form action="/doLogin.php" method="POST" id="form">
			<input type="email" class="form-control" placeholder="Email" name="email" style="display:none">
			<input type="text" class="form-control" placeholder="Username or email" name="username">
			<input type="password" class="form-control" placeholder="Password" name="password">
			<button type="submit" class="button blue ico-right right" name="loginbutton" id="loginbutton">Log in</button>
			<button type="submit" class="button cosmo ico-left left" name="register" id="registerbutton1">Register</button>
			<!--<a href="/forgotpasswd.php" style="display: inline-block;">Forgot password</a>-->
			<div class="clearfix"></div>
			<p class="register-alert" style="display:none;color:#424854">By clicking register,<br>you agree to the <a href="http://wowmeter.net/tos.php">Terms of Service</a>.<br></p>
		<div class="clearfix"></div></form>
		<div><strong>Register now</strong> to get<br>your own <strong>WOWMeter</strong> like these!<br>
		<?php
		$randomuser_sql = mysqli_query(db(), "SELECT  a.*,  totalCount AS wow_count
											FROM	users a 
											LEFT JOIN 
											(
			 									SELECT  wow_to, COUNT(*) totalCount
												FROM	wow
												GROUP   BY wow_to
											) b ON  a.id = b.wow_to
											WHERE b.TotalCount > 49 AND a.usrname_color != 'ffffff'
											ORDER BY RAND(), b.TotalCount LIMIT 6");
		while($randomuser = mysqli_fetch_assoc($randomuser_sql)){
			echo '<img src="/$'.$randomuser['username'].'" alt="'.$randomuser['username'].'\'s WOWMeter" title="'.$randomuser['username'].'\'s WOWMeter"/><br>';
		}
		?></div>
		<?php }else{ 
			$getwows_sql = mysqli_query(db(), "SELECT * FROM wow WHERE wow_to = ".$row['id']." ORDER BY wow_id DESC");
			$getwows_number = mysqli_num_rows($getwows_sql);
			$getwows = mysqli_fetch_array($getwows_sql);
			/* last wow location */
			$ipaddress = $getwows['wow_from'];
			$rsGeoData = geoip_record_by_addr($gi, $ipaddress);
			$city = utf8_encode($rsGeoData->city);
			$state = utf8_encode($GEOIP_REGION_NAME[$rsGeoData->country_code][$rsGeoData->region]);
			$country = htmlentities($rsGeoData->country_name);
			$getwowfrom_sql  = mysqli_query(db(), "SELECT * FROM users WHERE ip = '".$getwows['wow_from']."' ORDER BY regdate DESC") or die(mysqli_error(db()));
			$getwowfrom_number = mysqli_num_rows($getwowfrom_sql);
			$getwowfrom = mysqli_fetch_array($getwowfrom_sql);
			if($getwowfrom_number && $getwows['wow_from'] != "127.0.0.1"){
				$hex = $getwowfrom['usrname_color'];
				$wow_from = " by&nbsp;&nbsp;<span style='color:#$hex' class=\"table-color ". $getwowfrom["bg_color"] ." font-". $getwowfrom["sig_font"] ."\"";
				$wow_from .= "><img src='/images/flags/".strtolower($rsGeoData->country_code).".gif' title='".htmlentities($rsGeoData->country_name)."' alt='".htmlentities($rsGeoData->country_name)."'/> ".$getwowfrom['username']."</span>";
			}
			if ($city == $state)$city == '';
			if($city != ""){$city .= ", ";}else{$city == "";}
			if($state != ""){$state .= ", <br>";}else{$state == "";}
			if ($country_name == "")$country_name = "Unknown";
		?>
		<div class="title">Your WOWMeter</div>
		<p>You have <strong><?=$getwows_number?></strong> wows.<br>
		Your last wow <?php if($getwows_number == 0){echo "was <strong title=':('>never given</strong>";}else{echo "was given <br><strong title='".$getwows['wow_date']."'>".nicetime($getwows['wow_date'])."</strong>";
		if(!isset($wow_from)){echo " from <strong>".$city.$state.$country." <img src='/images/flags/".strtolower($rsGeoData->country_code).".gif' title='".htmlentities($rsGeoData->country_name)."' alt='".htmlentities($rsGeoData->country_name)."'/></strong>";}else{echo $wow_from;}} ?>.</p>
		<p><h5>Share to collect much wows</h5>
		<img src="/$<?=$username?>" id="sig"/>
		<div class="share"><!--
		--><a class="fb" href="javascript:void(0)" onclick="window.open('https://www.facebook.com/sharer.php?u=<?=urlencode("http://wowmeter.net/@".$username)?>&t=<?=urlencode("WOWMeter - Giving a wow to ".$username)?>', 'sharer', 'toolbar=0, status=0, width=480, height=370')" title="Share through Facebook"></a><!--
		--><a class="tw" href="javascript:void(0)" onclick="window.open('https://twitter.com/intent/tweet?hashtags=wowmeter&text=Click%20here%20to%20give%20<?=urlencode($username)?>%20a%20wow!&url=<?=urlencode("http://wowmeter.net/@".$username)?>&via=MarioErmando', 'sharer', 'toolbar=0, status=0, width=480, height=260')" title="Share through Twitter"></a><!--
		--><a class="gp" href="javascript:void(0)" onclick="window.open('https://plus.google.com/share?url=<?=urlencode("http://wowmeter.net/@".$username)?>', 'sharer', 'toolbar=0, status=0, width=490, height=470')" title="Share through Google+"></a><!--
		--><a class="tu" href="javascript:void(0)" onclick="window.open('http://www.tumblr.com/share/link?url=<?=urlencode("http://wowmeter.net/@".$username)?>&name=<?=urlencode("WOWMeter - Giving a wow to ".$username)?>&description=Click%20here%20to%20give%20<?=urlencode($username)?>%20a%20wow!', 'sharer', 'toolbar=0, status=0, width=480, height=500')" title="Share through Tumblr"></a><!--
		--></div>
		<div class="btn-group" style="float:left">
		<button type="button" class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown" id="lang-btn">
		<img src="/images/flags/us.gif"/> English <span class="caret"></span>
		</button>
		<ul class="dropdown-menu" role="menu" style="text-align:left">
		<li><a href="javascript:changelang('us');void(0)"><img src="/images/flags/us.gif"/> English</a></li>
		<li><a href="javascript:changelang('es');void(0)"><img src="/images/flags/es.gif"/> Español</a></li>
		<li><a href="javascript:changelang('de');void(0)"><img src="/images/flags/de.gif"/> Deutsch</a></li>
		<li><a href="javascript:changelang('fr');void(0)"><img src="/images/flags/fr.gif"/> Français</a></li>
		<li><a href="javascript:changelang('gr');void(0)"><img src="/images/flags/gr.gif"/> ελληνική</a></li>
		<li><a href="javascript:changelang('jp');void(0)"><img src="/images/flags/jp.gif"/> 日本語</a></li>
		<li><a href="javascript:changelang('nl');void(0)"><img src="/images/flags/nl.gif"/> Nederlands</a></li>
		<li><a href="javascript:changelang('tr');void(0)"><img src="/images/flags/tr.gif"/> Türkçe</a></li>
		</ul>
		</div>
		<a href="javascript:window.open('/whichone.php','windowNew','width=320, height=400');void(0)" style="float:right">Which one do I use?</a>
		<table style="width:100%">
			<tr><td>BBCode </td><td><textarea id="bbcode-code" readonly>[url=http://wowmeter.net/@<?=$username?>][img]http://wowmeter.net/$<?=$username?>[/img][/url]</textarea></td></tr>
			<tr><td>HTML </td><td><textarea id="html-code" readonly>&lt;a href="http://wowmeter.net/@<?=$username?>" target="_blank"&gt;&lt;img src="http://wowmeter.net/$<?=$username?>" alt="Give <?=$username?> a wow"/&gt;&lt;/a&gt;</textarea></td></tr>
			<tr><td>Supporting &nbsp;<br>websites <a href="javascript:window.open('/supporting.php','windowNew','width=320, height=400');void(0)">(?)</a></td><td><input type="text" value="[wow=<?=$username?>]" id="sn-code" readonly/></td></tr><br>
			<tr><td>Direct link</td><td style="padding-bottom:4px"><input type="text" value="http://wowmeter.net/@<?=$username?>" id="direct-code" readonly/></td></tr>
		</table>
		</p>
		<p><a href="/settings" class="button red ico-cog left">Settings</a><a href="/logout.php" class="button blue ico-right right">Logout</a></p><!--
		<div class="clearfix"></div><br>
		<a href="/statistics">WOWMeter statistics</a>
		--><?php } ?>
	</div>
	<div class="box col-md-4 col-md-offset-4">
		<div class="title">About</div>
		<p><strong>WOWMeter</strong> is a website where you can get your own WOWMeter to recieve <strong>wows</strong> to show how <strong>cool</strong> and <strong>awesome</strong> you are.</p>
		<?php
		$getusers_sql = mysqli_query(db(), "SELECT * FROM users");
		$getusers_number = mysqli_num_rows($getusers_sql);
		$getwows_sql_all = mysqli_query(db(), "SELECT * FROM wow");
		$getwows_number_all = mysqli_num_rows($getwows_sql_all);
		$getwows_sql_today = mysqli_query(db(), "SELECT DATE_FORMAT(wow_date, '%Y-%m-%d') FROM wow WHERE DATE(wow_date) = CURDATE()");
		$getwows_number_today = mysqli_num_rows($getwows_sql_today);
		$getwows_sql_last = mysqli_query(db(), "SELECT * FROM wow ORDER BY wow_id DESC");
		$getwows_last = mysqli_fetch_array($getwows_sql_last);
		$lastwowuser_sql = mysqli_query(db(), "SELECT * FROM users WHERE id = '".$getwows_last['wow_to']."'");
		$lastwowuser = mysqli_fetch_array($lastwowuser_sql);
		/* last wow location */
		$ipaddress = $getwows_last['wow_from'];
		$rsGeoData = geoip_record_by_addr($gi, $ipaddress);
		$city = utf8_encode($rsGeoData->city);
		$state = utf8_encode($GEOIP_REGION_NAME[$rsGeoData->country_code][$rsGeoData->region]);
		$country = htmlentities($rsGeoData->country_name);
		$getwowfrom_sql = mysqli_query(db(), "SELECT * FROM users WHERE ip = '".$getwows_last['wow_from']."' ORDER BY regdate DESC") or die(mysqli_error(db()));
		$getwowfrom_number = mysqli_num_rows($getwowfrom_sql);
		$getwowfrom = mysqli_fetch_array($getwowfrom_sql);
		unset($wow_from);
		if($getwowfrom_number && $getwows_last['wow_from'] != "127.0.0.1"){
			$hex = $getwowfrom['usrname_color'];
			$wow_from = " by&nbsp;&nbsp;<span style='color:#$hex' class=\"table-color ". $getwowfrom["bg_color"] ." font-". $getwowfrom["sig_font"] ."\"";
			$wow_from .= "><img src='/images/flags/".strtolower($rsGeoData->country_code).".gif' title='".htmlentities($rsGeoData->country_name)."' alt='".htmlentities($rsGeoData->country_name)."'/> ".$getwowfrom['username']."</span>";
		}
		if ($city == $state)$city == '';
		if($city != ""){$city .= ", ";}else{$city == "";}
		if($state != ""){$state .= ",<br>";}else{$state == "";}
		if ($country_name == "")$country_name = "Unknown";
		//leaderboard sht
		$leaderboard_sql = mysqli_query(db(), "SELECT  a.*,  totalCount AS wow_count
											FROM	users a
											LEFT JOIN 
											(
												SELECT  wow_to, COUNT(*) totalCount
												FROM	wow
												GROUP   BY wow_to
											) b ON  a.id = b.wow_to
											ORDER   BY b.TotalCount DESC, a.id ASC LIMIT 0,20");
		?>
		<strong><?=$getusers_number?></strong> users registered,<br>
		<strong><?=$getwows_number_all?></strong> wows given,<br>
		<strong><?=$getwows_number_today?></strong> given today.

		<p>Last wow was given to <?php
			$hex = $lastwowuser['usrname_color'];
			echo "<span style='color:#$hex' class=\"table-color ". $lastwowuser["bg_color"] ." font-". $lastwowuser["sig_font"] ."\"";
			$rsGeoData_lastusr = geoip_record_by_addr($gi, $lastwowuser['ip']);
			geoip_close($gi);
			echo "><img src='/images/flags/".strtolower($rsGeoData_lastusr->country_code).".gif' title='".htmlentities($rsGeoData_lastusr->country_name)."' alt='".htmlentities($rsGeoData_lastusr->country_name)."'/> ".$lastwowuser['username']."</span><br><strong title='".$getwows_last['wow_date']."'>".nicetime($getwows_last['wow_date'])."</strong>";
			if(!isset($wow_from)){echo " from <strong>".$city.$state.$country." <img src='/images/flags/".strtolower($rsGeoData->country_code).".gif' title='".htmlentities($rsGeoData->country_name)."' alt='".htmlentities($rsGeoData->country_name)."'/></strong>";}else{echo $wow_from;} ?>.</p>

		<h3>Leaderboard</h3>
		<table style="min-width:220px;margin:0 auto;text-align:left">
		<?php
		while($leaderboard = mysqli_fetch_assoc($leaderboard_sql))
		{
			$gi = geoip_open($_SERVER['DOCUMENT_ROOT']."/geoip/GeoLiteCity.dat", GEOIP_STANDARD);
			$rsGeoData = geoip_record_by_addr($gi, $leaderboard['ip']);
		$hex = $leaderboard['usrname_color'];
			echo "<tr><td style='color:#$hex'>";
			echo "<span class=\"table-color ". $leaderboard["bg_color"] ." font-". $leaderboard["sig_font"] ."\">";
			if($leaderboard['isbanned'] == 1)
				echo "<s title='Banned'>";
			echo "<img src='/images/flags/".strtolower($rsGeoData->country_code).".gif' title='".htmlentities($rsGeoData->country_name)."' alt='".htmlentities($rsGeoData->country_name)."'/> ".$leaderboard["username"];
			if($leaderboard['isbanned'] == 1)
				echo "</s>";
			echo "</span></td><td style='text-align:right'>".$leaderboard["wow_count"]." wows</td></tr>";

		}
		?>
	</table><!--
		<a href="/map.php">Map statistics</a>
	--></div>
		</div>
		<?php } ?>
<!-- edit wow.php too if u edit the ad box code ok -->
<div id="noadblock">Please turn off your adblocker to help us pay the hosting costs for WOWMeter.</div>
<!-- Project Wonderful Ad Box Code -->
<div style="text-align:center;"><div style="display:inline-block;" id="pw_adbox_72910_6_0"></div></div>
<script type="text/javascript"></script>
<noscript><div style="text-align:center;"><div style="display:inline-block;"><map name="admap72910" id="admap72910"><area href="http://www.projectwonderful.com/out_nojs.php?r=0&c=0&id=72910&type=6" shape="rect" coords="0,0,234,60" title="" alt="" target="_blank" rel="nofollow" /></map>
<table cellpadding="0" cellspacing="0" style="width:234px;border-style:none;background-color:;"><tr><td><img src="http://www.projectwonderful.com/nojs.php?id=72910&type=6" style="width:234px;height:60px;border-style:none;" usemap="#admap72910" alt="" /></td></tr><tr><td colspan="1"><center><a style="font-size:10px;color:#000000;text-decoration:none;line-height:1.2;font-weight:bold;font-family:Tahoma, verdana,arial,helvetica,sans-serif;text-transform: none;letter-spacing:normal;text-shadow:none;white-space:normal;word-spacing:normal;" href="http://www.projectwonderful.com/advertisehere.php?id=72910&type=6" target="_blank">Your ad here, right now: $0.02</a></center></td></tr></table></div></div>
</noscript>
<!-- End Project Wonderful Ad Box Code -->
		<h6 style="margin-bottom:30px;color:#424854">
			<a href="/tos.php">Terms of Service</a><br>
			WOWMeter is &copy; by 
			<a href="http://marioermando.tk">MarioErmando</a>, <?=date("Y")?>.<br>
			<a href="mailto:<?=$contact?>">Contact us</a><br>
			<span style="font-size:8px;font-family:'Small Fonts', sans-serif">
			All times are in <?php echo date("T") ?>.<br>
			<?php echo "Last modified: " . date ("jS F Y, h:i A T.", getlastmod());
			$end = microtime(true);
			$creationtime = ($end - $start);
			printf("<br>Render time: %.6fs.", $creationtime);
			?>
			</span>
		</h6>
</body>
<!-- Project Wonderful Ad Box Loader -->
<script type="text/javascript">
   (function(){function pw_load(){
      if(arguments.callee.z)return;else arguments.callee.z=true;
      var d=document;var s=d.createElement('script');
      var x=d.getElementsByTagName('script')[0];
      s.type='text/javascript';s.async=true;
      s.src='//www.projectwonderful.com/pwa.js';
      x.parentNode.insertBefore(s,x);}
   if (window.attachEvent){
    window.attachEvent('DOMContentLoaded',pw_load);
    window.attachEvent('onload',pw_load);}
   else{
    window.addEventListener('DOMContentLoaded',pw_load,false);
    window.addEventListener('load',pw_load,false);}})();
</script>
<!-- End Project Wonderful Ad Box Loader -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-52622833-1', 'auto');
  ga('require', 'linkid', 'linkid.js');
  ga('require', 'displayfeatures');
  ga('send', 'pageview');

</script>
</html>