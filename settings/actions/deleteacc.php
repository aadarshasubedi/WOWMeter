<?php
die("<H1>YOU SHALL NOT DELETE YOUR ACCOUNT</H1><br><br>:-)");
include_once($_SERVER['DOCUMENT_ROOT']."/wow.php");
if($logged_in == 0){
	header("Location: ".$_SERVER['DOCUMENT_ROOT']."/index.php");
	exit;
}
if(isset($_POST['submit'])){
	$password = safe($_POST['passwd']);
	if (hash('sha256', $salt.$password) != $rowuser['password']) {
	die("Invalid password.");
	}else{
		$deleteacc = mysqli_query(db(), "DELETE FROM users WHERE username = '".$username."'");
					if(!$deleteacc){
						die("<h3>Unexpected database error.</h3><br>".mysqli_error(db()));
					}else{
						$logged_in = 0;
						setcookie("username", "", time()-3600, "/");
						setcookie("id", "", time()-3600, "/");
						setcookie("password", "", time()-3600, "/");
						unset($_SESSION['username']);
						unset($_SESSION['id']);
						unset($_SESSION['password']);
						header('Location: /');
						exit;
					}
	}
}
$saddoge = 1;
include_once($_SERVER['DOCUMENT_ROOT']."/header.php");
?>
<div class="box small" style="width: 85%;">	
	<div class="title">Delete account</div>
	<!-- yay let's party -->
	<h4>We're sorry to see you go.</h4>
	<h6>Please reenter your password.</h6> 
	<form action method="POST">
			<input type="password" class="form-control" placeholder="Password" name="passwd">
			<button type="submit" class="button red ico-cross right" name="submit" id="submit">Delete my account</button>
			<a href="/" class="button blue ico-left left">Go back</a>
	</form>
</div>
<?php
$noprofile_n_shit = 1;
include_once($_SERVER['DOCUMENT_ROOT']."/main.php");
?>