<?php
include_once($_SERVER['DOCUMENT_ROOT']."/wow.php");
function check_email_address($email) { 
  // First, we check that there's one @ symbol,  
  // and that the lengths are right. 
  if (!preg_match("<^[^@]{1,64}@[^@]{1,255}$>i", $email)) { 
    // Email invalid because wrong number of characters  
    // in one section or wrong number of @ symbols. 
    return false; 
  } 
  // Split it into sections to make life easier 
  $email_array = explode("@", $email); 
  $local_array = explode(".", $email_array[0]); 
  for ($i = 0; $i < sizeof($local_array); $i++) { 
    if 
(!preg_match("<^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%& 
â†ª'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$>i", 
$local_array[$i])) { 
      return false; 
    } 
  } 
  // Check if domain is IP. If not,  
  // it should be valid domain name 
  if (!preg_match("<^\[?[0-9\.]+\]?$>i", $email_array[1])) { 
    $domain_array = explode(".", $email_array[1]); 
    if (sizeof($domain_array) < 2) { 
        return false; // Not enough parts to domain 
    } 
    for ($i = 0; $i < sizeof($domain_array); $i++) { 
      if 
(!preg_match("<^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])| 
â†ª([A-Za-z0-9]+))$>i", 
$domain_array[$i])) { 
        return false; 
      } 
    } 
  } 
  return true; 
} 
        $ajax_username = safe($_POST['username']); 
        $ajax_password = safe($_POST['password']); 
        $ajax_email = safe($_POST['email']); 
        if (!$ajax_username || !$ajax_password  || !$ajax_email) { 
            die("Fill the form first!"); 
        }
        if (strlen($ajax_username) < 3){
          die("Your username is too small. 3 characters minimum.");
        }
        if (strlen($ajax_username) > 20){
          die("Your username is too long. 20 characters maximum.");
        }
        if (strlen($ajax_password) > 50){
          die("Your password is too long. 50 characters maximum.");
        }
        foreach($banned_words as $banned_word){
          if (strpos(strtolower($ajax_username), $banned_word) !== false) {
            die("Your username contains the word \"$banned_word\", which is banned.".$ajax_linebreak."Please pick another username.");
          }
        }
        if ($ajax_password == 123456) { 
            die("Your password is too easy!"); 
        } 
        if(preg_match('/[^\w-]+/i', $ajax_username)) 
        { 
            die("Your username contains invalid characters.<br/>We only allow alphanumeric characters, hyphens and underscores."); 
        } 
        $qry = "SELECT username FROM users WHERE username = '".$ajax_username."' OR oldusrname = '".$ajax_username."'"; 
        $sqlmembers = mysqli_query(db(), $qry); 
        $name_check = mysqli_fetch_array($sqlmembers); 
        $name_checkk = mysqli_num_rows($sqlmembers); 
        if ($name_checkk != 0) { 
            die("It seems like this username is already taken!"); 
        } 
        $qry_all = "SELECT username FROM users WHERE ip = '".get_ip_address()."'"; 
        $sqlmembers_all = mysqli_query(db(), $qry_all); 
        $ip_check = mysqli_num_rows($sqlmembers_all); 
        if ($ip_check != 0) { 
            die("You already have an account with the same IP!"); 
        } 
        $qry_email = "SELECT username FROM users WHERE email = '".$ajax_email."'"; 
        $sqlmembers_email = mysqli_query(db(), $qry_email); 
        $email_check = mysqli_num_rows($sqlmembers_email); 
        if ($email_check != 0) { 
            die("You already have an account with the same email!"); 
        } 
            // check e-mail format 
        if (!check_email_address($ajax_email)){ 
            die("Your email seems invalid!"); 
        } 
        $ajax_password = hash('sha256', $salt.$ajax_password); 
        $insert = "INSERT INTO users ( 
                username, 
                password, 
                email, 
                ip,
                sig_font) 
                VALUES ( 
                '".$ajax_username."', 
                '".$ajax_password."', 
                '".$ajax_email."', 
                '".get_ip_address()."', 
                '2'
                )"; 
        $sqlmembers = mysqli_query(db(), $insert); 
        $usr = mysqli_query(db(), "SELECT * FROM users WHERE username = '".$ajax_username."'"); 
    $msga = mysqli_fetch_array($usr); 
    $ida = $msga['id']; 
    $expire=time()+60*60*24*30;
    setcookie("username", $msga['username'], $expire, "/");
    setcookie("id", $ida, $expire, "/");
    setcookie("password", $ajax_password, $expire, "/");
    if(is_ajax()){
        die('success');
    }else{
        header("Location: /");
    }
?>