<?php
require_once "upload/gallerytable.php";
$err="Upload Images";

$viewform = $galleryTable->viewForm(
 "upload/uploadimage.html",# HTML Theme for Form
 $galleryTableFields, # Form settings of array Variable with validations
  array(
  "XformTitle"=>"Upload New Image", # Title of the Form
  "XformDescprtion"=>"Add Images to Gallery", # Description the Form
  "XformUrl"=>"?page=upload_image&for=upl", # Form Action URL
  "XformName"=>"uploadimageform", # Form Name
  "XformClass"=>"uploadimageform",# FOrm Class Name
  "XbtnText"=>"Upload Image", # Form Submit Button Text
  "XformFields"=>"title,images", # Table Fields to Display 
  "XformError"=>$err
 ),
 ["additional Information"], # Custom Data to the Theme
 ["XInfo"] # Variable to Replace the Custom Data to the Theme
);
$for = isset($_REQUEST["for"])?$_REQUEST["for"]:"";
switch($for){
 case "upl":
  if(isset($_POST["image_title"])){
    $gres = $wm->uploadImages(
      "images", # post files from form 
      "upload/files/", # Destination Folder
      ", " # Deliminator to Seperate the Files
    );
      $res= $galleryTable->checkAndInsert(
        array(
        "fields"=>"title",# Table Fields
        "title"=>"'".$_POST["image_title"]."'" # SQL Query to Check
        ),
        "Gallery Title exists with submitted data",# Error Report to Display
        "Inserted",# Success Report to Display
        [
          ["txt","title",$_POST["image_title"],"",""],
          ["txt","images",$gres,"",""]
        ],# Posted Values to Enter the Data to DB
        $galleryTableFields, # Posted Data Validation Settings in PHP Array
        "yes"
        );
      if($res=="Inserted"){
        unset($_POST);
        echo "Inserted";
      }else{
       echo $res;
      }
  }
  break;
 default:
  echo $viewform;
 break;
}
?>