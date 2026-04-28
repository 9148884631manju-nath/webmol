<?php

$xinnerpage=(isset($_REQUEST['view']))? $_REQUEST['view'] : "intro";



$nor="text-sm font-medium text-slate-500 hover:text-orchid-500 pl-4 block transition-colors";
$intro=$nor;$installation=$nor;$coreconcepts=$nor;$firstpage=$nor;
$$xinnerpage="text-sm font-bold text-orchid-600 border-l-2 border-orchid-600 pl-4 block";

$xlinks = $wm->htmlData(
 [
  ["?page=getstart&view=intro","Introduction",$intro],
  ["?page=getstart&view=installation","Installation",$installation],
  ["?page=getstart&view=coreconcepts","Core Concepts",$coreconcepts]
 ],
 ["Xlink","Xtitle","Xcss"],
 "templates/link.html"
);

$Ylinks = $wm->htmlData(
 [
  ["?page=getstart&view=firstpage","First Page",$firstpage]
 ],
 ["Xlink","Xtitle","Xcss"],
 "templates/link.html"
);

$codeFile="tutorial/".$xinnerpage.".html";

if(file_exists($codeFile)){
 $xpage=$wm->html(
  [[]],
  $codeFile
 );
}else{
 $xpage= $wm->getUrl(SERVER."tutorial/".$xinnerpage.".php",null);
}

echo $wm->html(
 [
  ["txt",$xlinks,"Xlinks","",""],
  ["txt",$Ylinks,"XYmorelinks","",""],
  ["txt",$xpage,"XinnerPage","",""]
 ],
 "tutorial/main.html"
);
?>