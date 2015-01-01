<?php
include_once($_SERVER['DOCUMENT_ROOT']."/header.php");
?>
	<div class="box small no-title headline">
		<?php
		if($logged_in == 0){
		echo "<h2>Welcome to WOWMeter!</h2><h6>Create an account to get your very own WOWMeter.</h6>";
		}else{
		echo "<h2>Hi there, $username!</h2>";
		}?>
	</div>
<?php include_once($_SERVER['DOCUMENT_ROOT']."/main.php"); ?>