<?php
$needlogin = 1;
$title = "WOWMeter - Supporting websites";
include_once($_SERVER['DOCUMENT_ROOT']."/header.php");
?>
	<style type="text/css">
	.box{
		min-width: 75%
	} 
	</style>
	<div class="box small no-title headline">
		<h2>Supporting websites</h2>
	</div>
	<div class="box small no-title" style="text-align:left;width: 80%">
	<p>Currently, supporting websites are:
	<table>
	<tr><td><a href="#" onclick="window.opener.location.href='http://socitron.tk';window.close()">SPTron</a></td></tr>
	<tr><td><a href="#" onclick="window.opener.location.href='http://ar7comm.prestoapps.org';window.close()">AR7Comm</a></td></tr>
	<tr><td><a href="#" onclick="window.opener.location.href='http://socialneko.com';window.close()">SocialNeko</a></td></tr>
	</table></p>
	<p>Supporting websites are websites which supports a special BBCode made for WOWMeter.</p>
	<a href="javascript:window.close();window.location='/';void(0)" class="button blue ico-right right">Go back</a>
	</div>
<?php $noprofile_n_shit = 1; include_once($_SERVER['DOCUMENT_ROOT']."/main.php"); ?>