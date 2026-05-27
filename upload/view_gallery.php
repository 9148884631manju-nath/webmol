<?php

require_once "upload/gallerytable.php"; # Table Data Module
$viewTableData= $galleryTable->getAllData(
   array(
    "fields"=>"*"
 ),
 "html",# Type of Data Display html: HTML Display | table: Display in Table Format | null: Data in PHP array
 "upload/error.html", # Error Handler Theme to Display
 "upload/viewdata.html", # Display HTML Theme to Browser
 [
  ["txt","title","Xtitle","",""],
  ["bulkimages","images","Ximages",",",""]
 ],
 [
  ["txt","?page=update_user&mobile=Xmobile","XeditUrl","",""],
  ["txt","delete_user&mobile=Xmobile","XdelUrl","",""]
]
);
echo $viewTableData;

?>