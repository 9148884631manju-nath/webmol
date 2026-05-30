<?php
$filename=isset($_REQUEST["mobile"]) ? $_REQUEST["mobile"] : "";
$jsonList = $wm->jsonlist(
 "folder_viewdata",
 $filename,
 "contacts/data/allcontacts/",
 [
  ["txt","name","Xname","",""],
  ["txt","mobile","Xmobile","",""]
 ],
 [
  ["txt","?page=contacts/editcontact&mobile=Xmobile","XELink","",""],
  ["txt","?page=contacts/deletecontact&mobile=Xmobile","XDLink","",""]
 ],
 "contacts/html/view_edit_delete_list.html",
 "contacts/html/norecords.html",
[
 ["txt","?page=contacts/addnew","Xlink","",""]
]
);
echo $jsonList;
?>