<?php

$word_app = new COM("Word.Application");
$word_app->Visible = true;

$word_app->Documents->Add();
var_dump($word_app->Selection);
$word_app->Selection->TypeText("Moje ime je Viktor Ćirić,imam 20 godina,student sam Visoke ICT škole,na smeru internet tehnologije,sa brojem indeksa 36/17.");
header("Location:../../index.php?page=autor");
?>