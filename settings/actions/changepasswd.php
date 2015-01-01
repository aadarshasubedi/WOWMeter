<?php
include_once($_SERVER['DOCUMENT_ROOT']."/wow.php");
if($logged_in == 0){
	header("Location: ".$_SERVER['DOCUMENT_ROOT']."/index.php");
	exit;
}
if(isset($_POST['submit'])){
		$expire=time()+60*60*24*30;
		$oldpasswd = safe($_POST['oldpasswd']);
		$newpasswd = safe($_POST['newpasswd']);
		$newpasswdagain = safe($_POST['newpasswdagain']);
		if($newpasswd != $newpasswdagain){
			die("The passwords doesn't match.");
		}
		if (strlen($newpasswd) > 50){
			die("Your password is too long. 50 characters maximum.");
		}
		if ($newpasswd == 123456) { 
			die("Your password is too easy!"); 
		} 
		$passwd_check = mysqli_query(db(), "SELECT * FROM users WHERE password = '".hash('sha256', $salt.$oldpasswd)."'" ); 
		$passwd_checkk = mysqli_num_rows($passwd_check); 
		if ($passwd_checkk == 0) { 
			die("Your old password is incorrect!"); 
		} 
		// password looks ok, let's change it
		$changepasswd = mysqli_query(db(), "UPDATE users SET 
											password='".hash('sha256', $salt.$newpasswd)."'
											WHERE id = '".$row['id']."'");
			if(!$changepasswd){
				die("<h3>Unexpected database error.</h3>");
			}else{
				setcookie("password", hash('sha256', $salt.$newpasswd), $expire, "/");
				header('Location: /');
				exit;
			}
}
include_once($_SERVER['DOCUMENT_ROOT']."/header.php");
?>
<div class="box small" style="width: 85%;">	
	<div class="title">Change password</div>
	<form action method="POST">
	<h6>Please enter your password and your new password in the form below.</h6>
			<input type="password" class="form-control" placeholder="Old password" name="oldpasswd">
			<input type="password" class="form-control" placeholder="New password" name="newpasswd">
			<input type="password" class="form-control" placeholder="New password again" name="newpasswdagain">
			<button type="submit" class="button cosmo ico-save right" name="submit" id="submit">Change my password</button>
			<a href="/" class="button blue ico-left left">Go back</a>
	</form>
</div>
<?php
$noprofile_n_shit = 1;
include_once($_SERVER['DOCUMENT_ROOT']."/main.php");
?>