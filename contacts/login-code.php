<?php
$datainsert = $wm->jsoninsert(
 "folder", # for data save to folder
 "contacts/data/allcontacts/", # Destination to save the Data
 "contacts/data/contactmodel.json", # Data Model settings file 
 $_POST['mobile'], # File name to save and check the duplicate filename
 "email,name", # Check posted duplicated data
 "name,mobile,email,address", # Json Data keys 
 [$_POST["name"],$_POST["mobile"],$_POST["email"],$_POST["address"]], # Data to save 
 "Data Inserted", # Success Print
 "Data Insertion Error", # Error Print
 "no" # Show the Json Data 
);
echo $datainsert;
?>