
<?php
echo "Graph";
$htmlDataArray = $wm->htmlData(
    [
      ["blink","55","40","aa",""],
      ["super","35","20","bb",""],
      ["KLKcova","80","80","xcc",""],
      ["super","35","20","dd",""],
      ["cova","75","60","ee",""]
    ],
    ["Xtitle","Xscore","Xpercent","Xanim"],
    "graph/score.html"
);
echo $htmlDataArray;
?>