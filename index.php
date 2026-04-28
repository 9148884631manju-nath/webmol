<?php require_once "lib/webmodule.php"; $wm=new WebMol("","lib/dbcon.json","newdb");

//define("APP","mediapp");
define("SERVER","http://localhost/WEBMOLv01/");

if(isset($_REQUEST['page'])){$page=$_REQUEST['page'];}else{$page="";}

switch($page){

case "getstart": $fle= "tutorial/Welcome.php"; break;
default: $fle= "home/Welcome.php"; break;
}

$wm->page($fle);
?>