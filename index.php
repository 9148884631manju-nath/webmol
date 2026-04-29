<?php require_once "lib/webmodule.php"; $wm=new WebMol("","lib/dbcon.json","newdb");

if(isset($_REQUEST['page'])){$page=$_REQUEST['page'];}else{$page="";}

switch($page){
default: $fle= "web/Welcome.html"; break;
}

$wm->page($fle);
?>
