<?php
switch($page){
 case "contacts":
  $fle= "contacts/login.php"; 
  break;
 case "contacts/logincode":
  $fle= "contacts/login-code.php"; 
  break;
 default: 
  $fle= "Welcome.php"; 
 break;
}
?>