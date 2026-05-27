<?php
$gallery=array(
"table"=>"gallery",
"coloums"=>array(
"title"=>"varchar(200) null",
"images"=>"text null"
)
);
$galleryTable = $wm->table_module($gallery);
$galleryTableFields=array(
"title"=>array(
"title"=>"Image Title",
"type"=>"text",
"name"=>"image_title",
"class"=>"image_title border border-slate-200 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 outline-none transition",
"placeholder"=>"Image Title",
"default"=>"Untitled",
"value"=>"post_image_title",
"xrequired"=>"required",
"validation"=>"alpha",
"error"=>"Invalid Title",
"parentcss"=>"flex flex-col gap-2 [&>*]:w-full max-w-sm",
"titlecss"=>"text-slate-800 text-sm tracking-wide",
"errorcss"=>"text-xs text-slate-400"
),
"images"=>array(
"title"=>"Upload Images",
"type"=>"file",
"name"=>"images[]",
"id"=>"image-input",
"multiple"=>"multiple",
"onchange"=>"handleFiles(this.files)",
"class"=>"images border border-slate-200 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 outline-none transition",
"placeholder"=>"Upload Image",
"default"=>"def.png",
"value"=>"post_images",
"required"=>"required",
"validation"=>"image",
"formats"=>["png","jpg","jpeg","tiff"],
"error"=>"Invalid Images",
"parentcss"=>"flex flex-col gap-2 [&>*]:w-full max-w-sm",
"titlecss"=>"text-slate-800 text-sm tracking-wide",
"errorcss"=>"text-xs text-slate-400"
),
);
?>
<?php
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
    $gres = $wm->uploadImages("images","upload/files/",", ");
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