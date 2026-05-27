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