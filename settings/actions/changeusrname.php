<?php
include_once($_SERVER['DOCUMENT_ROOT']."/wow.php");
if($logged_in == 0){
	header("Location: ".$_SERVER['DOCUMENT_ROOT']."/index.php");
	exit;
}
if(isset($_POST['submit'])){
	$expire=time()+60*60*24*30;
	if($row['oldusrname'] != ""){
		// switch into old username
		foreach($banned_words as $banned_word){
		  if (strpos(strtolower($row['oldusrname']), $banned_word) !== false) {
			$switchusrname = mysqli_query(db(), "UPDATE users SET 
											username='".$username."',
											oldusrname=NULL
											WHERE id = '".$row['id']."'");
			if(!$switchusrname){
				die("<h3>Unexpected database error.</h3><br>".mysqli_error(db()));
			}else{
					header('Location: /');
					exit;
				}
			}
		}
		$switchusrname = mysqli_query(db(), "UPDATE users SET 
											username='".$row['oldusrname']."',
											oldusrname='".$username."'
											WHERE id = '".$row['id']."'");
		if(!$switchusrname){
			die("<h3>Unexpected database error.</h3><br>".mysqli_error(db()));
		}else{
			setcookie("username", $row['oldusrname'], $expire, "/");
			header('Location: /');
			exit;
		}
	}else{
		// switch into new username
		$usrname = safe($_POST['usrname']);
		if(preg_match('/[^\w-]+/i', $usrname)) 
		{ 
			die("Your username contains invalid characters.<br/>We only allow alphanumeric characters, hyphens and underscores."); 
		} 
		if (strlen($usrname) < 3){
			die("Your username is too small. 3 characters minimum.");
		}
		if (strlen($usrname) > 20){
			die("Your username is too long. 20 characters maximum.");
		}
		foreach($banned_words as $banned_word){
		  if (strpos(strtolower($usrname), $banned_word) !== false) {
			die("Your username contains the word \"$banned_word\", which is banned.".$ajax_linebreak."Please pick another username.");
		  }
		}
		$name_check = mysqli_query(db(), "SELECT * FROM users WHERE username = '".$usrname."' OR oldusrname = '".$usrname."'" ); 
		$name_checkk = mysqli_num_rows($name_check); 
		if ($name_checkk != 0) { 
			die("It seems like this username is already taken!"); 
		} 
		// username looks ok, let's change it
		$changeusrname = mysqli_query(db(), "UPDATE users SET 
											username='".$usrname."',
											oldusrname='".$username."'
											WHERE id = '".$row['id']."'");
			if(!$changeusrname){
				die("<h3>Unexpected database error.</h3><br>".mysqli_error(db()));
			}else{
				setcookie("username", $usrname, $expire, "/");
				header('Location: /');
				exit;
			}
	}
}
include_once($_SERVER['DOCUMENT_ROOT']."/header.php");
//$row['oldusrname'] = "aaaaaaaaaaaaaaaaaaaa";
?>
<div class="box small" style="width: 85%;">	
	<div class="title">Change username</div>
	<form action method="POST">
	<?php if($row['oldusrname'] != ""){ ?>
	<h6>You can't change your username since<br>you've already changed it once.<br><br>
	However, you can still switch back into<br>your old username.</h6>
	<button type="submit" class="button cosmo ico-save" name="submit" id="submit">Switch back to <?=$row['oldusrname'];?></button>
	<a href="/" class="button blue ico-left">Go back</a>
	<?php }else{?>
	<h6>You can change your username only <strong>ONCE</strong>, unless your old username contains banned words.<br><br>
	You can switch back into your old username anytime you wish. Your old codes will still work.</h6>
			<input type="text" class="form-control" placeholder="Your new username" name="usrname">
			<button type="submit" class="button cosmo ico-save" name="submit" id="submit">Change my username</button>
			<a href="/" class="button blue ico-left">Go back</a>
	<?php }?>
	</form>
</div>
<?php
$noprofile_n_shit = 1;
include_once($_SERVER['DOCUMENT_ROOT']."/main.php");
?>