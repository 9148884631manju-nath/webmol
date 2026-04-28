<?php
// Calling Webmole Library
require_once "../lib/webmodule.php";

 // Intailze the database and connect
$wm=new WebMol("","../lib/dbcon.json","newdb");

// Define Application URL and others
define("SERVER","http://localhost/WEBMOLv01/");

// Requesting the App or Module Can customize page / content / app etc...
if(isset($_REQUEST['page'])){$page=$_REQUEST['page'];}else{$page="";}

// App or Page Routing for the entire Application
switch($page){

 case "welcome":
  $fle= "../core/welcome.php"; 
  break;
 default: 
   $fle= "../home/Welcome.php";
  break;

}
// WebMol Engine Renders the Values into Static HTML Page in Client Side
$wm->page($fle);
?>