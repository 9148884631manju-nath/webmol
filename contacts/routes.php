<?php
switch($page){
 case "contacts":
  $fle= "contacts/login.php"; 
  break;
 case "contacts/viewcontact":
  $fle= "contacts/viewcontact.php"; 
  break;
 case "contacts/editcontact":
  $fle= "contacts/editcontact.php"; 
  break;
 case "contacts/deletecontact":
  $fle= "contacts/deletecontact.php"; 
  break;
 case "contacts/logincode":
  $fle= "contacts/login-code.php"; 
  break;
 default: 
  $fle= "Welcome.php"; 
 break;
}
?>