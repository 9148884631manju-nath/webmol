<?php require_once "lib/webmodule.php"; $wm=new WebMol("","lib/dbcon.json","newdb");

//define("APP","mediapp");
define("SERVER","http://localhost/WEBMOLv01/");

if(isset($_REQUEST['page'])){$page=$_REQUEST['page'];}else{$page="";}

$lib ="";
switch($page){
 case "contacts":
  $fle= "contacts/login.php"; 
  break;
 default: 
  $fle= "Welcome.php"; 
 break;
}
$lib.= $wm->seo("home","lib/seo.json");
$lib.= $wm->library("home","lib/library.json");
$lib.= $wm->library($page,"lib/seo.json");
$lib.= $wm->library($page,"lib/library.json");
$hd=(isset($_REQUEST['code'])=="raw") ? "" : $lib ;
echo $hd;
$wm->page($fle);
?>