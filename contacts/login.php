<?php
$theme = $wm->html([
["txt","contacts/contactslogo.png","Xlogo","",""],
["txt","My Contacts","XTitle","",""],
["txt","View Contacts and manage address","XSubTitle","",""]
],
"contacts/html/mainhead.html"
);
echo $theme;

$xjsonList = $wm->jsonlist(
 "self",
 "",
 "contacts/data/allcontacts.json",
 [
  ["txt","name","Xname","",""],
  ["txt","mobile","Xmobile","",""]
 ],
 [
  []
 ],
 "contacts/html/view_edit_delete_list.html",
 "contacts/html/norecords.html",
[
 ["txt","?page=contacts/addnew","Xlink","",""]
]
);
$jsonList = $wm->jsonlist(
 "folder",
 "",
 "contacts/data/allcontacts/",
 [
  ["txt","name","Xname","",""],
  ["txt","mobile","Xmobile","",""]
 ],
 [
  ["txt","?page=contacts/viewcontact&mobile=Xmobile","XVLink","",""],
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

$form = $wm->jsonform(
 "contacts/data/contactmodel.json",
 "contacts/html/addform.html",
 array(
  "XformTitle"=>"Add New Contact", # Title of the Form
  "XformDescprtion"=>"Add Users to the Json Database", # Description the Form
  "XformUrl"=>"?code=raw&page=contacts/logincode", # Form Action URL
  "XformName"=>"addform", # Form Name
  "XformClass"=>"addform",# FOrm Class Name
  "XbtnText"=>"Save Contact", # Form Submit Button Text
  "XformFields"=>"name,mobile,email,address"# Table Fields to Display 
  )
);
echo $form;

$footer = $wm->html([
["txt","My Theme","Xtitle","",""]
],
"contacts/html/footer.html"
);
echo $footer;
?>