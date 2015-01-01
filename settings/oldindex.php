<?php
$needlogin = 1;
$title = "WOWMeter - Settings";
include_once($_SERVER['DOCUMENT_ROOT']."/header.php");
	/* 	
		background types
		normal = 1
		8bit = 2
		neko = 3
		flandre = 4
		weed = 5
	*/
switch($row['sig_bg']){
	case "2":
		$bg_name = "bg_8bit";
		break;
	case "3":
		$bg_name = "bg_neko";
		break;
	case "4":
		$bg_name = "bg_flandre";
		break;
	case "5":
		$bg_name = "bg_weed";
		break;
	default:
		$bg_name = "bg";
		break;
}
?>
<link rel="stylesheet" href="/css/colpick.css" type="text/css" />
<script src="/js/colpick.js"></script>
	<script type="text/javascript">
	var bg;
	var font;
	function change_bg(name){
		bg = name;
		$('#'+bg).prop('checked', true);
		$('#selected_bg').attr('src', '/sig/<?=$username?>?mask=1&bg='+bg);
	}
	function change_font(name, warning){
		font = name;
		$('#font_'+name).prop('checked', true);
		$('#selected_font').css('background-position', '0px '+ ((24 * name) - 24) + 'px');
		$('#selected_bg').attr('src', '/sig/<?=$username?>?mask=1&bg='+bg+'&font='+font);
		if(warning){
			$('.font-warning code').html(warning);
			$('.font-warning').show();
		}else{
			$('.font-warning').hide();
		}
	}
	$(document).ready(function (){
		$('#picker').colpick({
			layout:'hex',
			submit:0,
			color: "<?=$row['usrname_color']?>",
			colorScheme:'light',
			onChange:function(hsb,hex,rgb,el,bySetColor) {
				if(hex == "ffffff"){
					$(el).css({'border-width' : '1px', 'border-color' : 'inherit'});
				}else{
					$(el).css({'border-color' : '#'+hex, 'border-width' : ''});
				}
				$("#usrname_color").css('background','#'+hex);
				if(!bySetColor) $(el).val(hex);
			}
		}).keyup(function(){
			$(this).colpickSetColor(this.value);
		});
<?php 
			switch($row['sig_font']){
			case 2:
				echo "$('.font-warning code').html('Greek, Turkish');$('.font-warning').show();";
				break;
			} 
		?>
	});
	</script>
	<div id="preload">
	<img src="http://wowmeter.net/sig/MarioErmando?mask=1&bg=bg"/>
	<img src="http://wowmeter.net/sig/MarioErmando?mask=1&bg=bg_8bit"/>
	<img src="http://wowmeter.net/sig/MarioErmando?mask=1&bg=bg_neko"/>
	<img src="http://wowmeter.net/sig/MarioErmando?mask=1&bg=bg_flandre"/>
	<img src="http://wowmeter.net/sig/MarioErmando?mask=1&bg=bg_weed"/>
	</div>
	<div class="box small no-title headline">
		<h2>Settings</h2>
	</div>
	<?php
	switch($_GET['alert']){
		case "error":
		echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> An error occurred while updating your settings. :(</div>';
		break;
		case "success":
		echo '<div class="alert alert-success"><a href="#" class="close" data-dismiss="alert">&times;</a><strong>Success!</strong> Your settings are successfully saved. :)</div>';
		break;
		case "no":
		echo '<div class="alert alert-info"><a href="#" class="close" data-dismiss="alert">&times;</a>no</div>';
		break;
	}

	?>
	<div class="box small no-title" style="width: 80%;">
	<form action="process.php?action=update" method="POST">
	<h3>Account</h3>
	<table style="min-width:200px;margin:0 auto">
		<tr><td>Username</td>
		<td>:</td>
		<td style="color:#424854"><?=$username?></td>
		<td><a href="process.php?action=changeusrname">Change</a></td></tr>
		<tr><td>Password</td>
		<td>:</td>
		<td style="color:#424854">●●●●●●●●●</td>
		<td><a href="process.php?action=changepasswd">Change</a></td></tr></tr>
	</table>
	<h3>Signature</h3>
<div class="btn-group">
	<div style="position: absolute;top: 0;left: 5px;width: 96%;height: 20px;background: #<?=$row['usrname_color'];?>" id="usrname_color"></div>
    <img src="/sig/<?=$username?>?mask=1&bg=<?=$bg_name?>" class="dropdown-toggle" style="position: relative;cursor:pointer;width:240px;height:66px" data-toggle="dropdown" alt="Your selected background" title="Your selected background" id="selected_bg"/>
    <div style="position:absolute;left:0">
    	<div class="dropdown-toggle" style="position: relative;cursor:pointer;width:75px;height:24px;background:url(/images/fonts.png);background-position:0 <?php echo $row['sig_font'] * 24 - 24; ?>px" data-toggle="dropdown" title="Your selected font" id="selected_font"></div>
        <ul class="dropdown-menu dropdown-menu-form" id="dropdown-font" role="menu">
  	<li><a href="javascript:change_font(1, false);void(0)" title="Comic Sans"><div style="width:145px;height:24px;background:url(/images/fonts.png);background-position:-75px 0"></div></a></li>
    <li><a href="javascript:change_font(2, 'Greek, Turkish');void(0)" title="Hand of Sean"><div style="width:145px;height:24px;background:url(/images/fonts.png);background-position:-75px 24px"></div></a></li>
  </ul>
    </div>
    <div style="position:absolute;right:0">#<input type="text" id="picker" name="usrname_color" value="<?=$row['usrname_color'];?>" style="<?php if($row['usrname_color'] != "ffffff"){ echo "border-color: #".$row['usrname_color']; } else { echo "border-color: inherit;border-width:1px"; } ?>"></input></div>
  <ul class="dropdown-menu dropdown-menu-form" role="menu">
  	<li><a href="javascript:change_bg('bg');void(0)" title="Normal doge"><img src="/images/bg.png" alt="Normal doge"/></a></li>
    <li><a href="javascript:change_bg('bg_8bit');void(0)" title="8-bit doge"><img src="/images/bg_8bit.png" alt="8-bit doge"/></a></li>
    <li><a href="javascript:change_bg('bg_neko');void(0)" title="Neko doge"><img src="/images/bg_neko.png" alt="Neko doge"/></a></li>
    <li><a href="javascript:change_bg('bg_flandre');void(0)" title="Flandre Scarlet doge"><img src="/images/bg_flandre.png" alt="Flandre Scarlet doge"/></a></li>
    <li><a href="javascript:change_bg('bg_weed');void(0)" title="Snoop Dogge"><img src="/images/bg_weed.png" alt="Snoop Dogge"/></a></li>
  </ul>
</div><br>
<div style="display:none">
<input type="radio" name="bg" id="bg_normal" value="normal"<?php if($row['sig_bg'] == 1)echo" checked";?>>
<input type="radio" name="bg" id="bg_8bit" value="8bit"<?php if($row['sig_bg'] == 2)echo" checked";?>>
<input type="radio" name="bg" id="bg_neko" value="neko"<?php if($row['sig_bg'] == 3)echo" checked";?>>
<input type="radio" name="bg" id="bg_flandre" value="flandre"<?php if($row['sig_bg'] == 4)echo" checked";?>>
<input type="radio" name="bg" id="bg_weed" value="weed"<?php if($row['sig_bg'] == 5)echo" checked";?>>

<input type="radio" name="font" id="font_1" value="1"<?php if($row['sig_font'] == 1)echo" checked";?>>
<input type="radio" name="font" id="font_2" value="2"<?php if($row['sig_font'] == 2)echo" checked";?>>
</div>
	<button type="submit" name="submit" class="button cosmo ico-save">Save</button>
	<div class="alert alert-danger font-warning" style="display:none;padding: 5px;margin: 10px 0 0"><strong>Warning!</strong> The font you have selected<br>is not available on these languages:<br><code></code></div>
	</form>
	<hr>
	<!--<a href="process.php?action=deleteacc" class="button red ico-cross">Delete my account</a>-->
	<a href="/" class="button blue ico-right">Go back</a>
	</div>
<?php $noprofile_n_shit = 1; include_once($_SERVER['DOCUMENT_ROOT']."/main.php"); ?>