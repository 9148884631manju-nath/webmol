// Calling Webmole Library
require_once "lib/webmodule.php";

 // Intailze the database and connect
$wm=new WebMol("","lib/dbcon.json","db");

// Define Application URL and others
define("SERVER","http://localhost/WEBMOLv01/");

// Requesting the App or Module Can customize page / content / app etc...
if(isset($_REQUEST['page'])){$page=$_REQUEST['page'];}else{$page="";}

