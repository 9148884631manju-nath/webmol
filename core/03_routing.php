<?php

// App or Page Routing for the entire Application
switch($page){

 case "welcome":
  $fle= "core/Welcome.php"; 
  break;
 default: 
   $fle= "home/Welcome.php";
  break;

}

?>