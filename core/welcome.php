<?php
   
   // statict Text to display in page
   $welcomeText="<hr/>Welcome to WebMol App Framework";
   $infoText="Xtext gets the data from the engine";

   // Include HTML Elements to here
   $welcomeText="<hr/><h1>Welcome to WebMol App Framework</h1>";

   // Static Text to the Template 
   $welcomeText="<hr/><h1>Welcome to WebMol App Framework</h1>";
   $XhtmlContent="This Text for HTML tag Content";
   $XhtmlDesc="";// Null Assigned
   
   // arguments passing to the html template, you can pass N number of arguments 
   $welcomeArguments=[
     ["txt",$welcomeText,"Xtext","Default","Extra Arguments"],
     ["txt",$infoText,"Xinfo","Default","Extra Arguments"],
     ["txt",$XhtmlContent,"XhtmlContent","Default","Extra Arguments"],
     ["txt",$XhtmlDesc,"XhtmlDesc","Default Description","Extra Arguments"]// If Null is passed the the Default text will take
   ];

   // html Template
   $welcomeTemplate = "../core/html/welcome.html";

   // Render the static content to HTMl content
   $mypage=$wm->html($welcomeArguments, $welcomeTemplate);
   echo $mypage;
?>