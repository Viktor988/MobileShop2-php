
<?php

$sve=prikaziIkone();
$prom="";
    foreach($sve as $sv){
        $prom.="<a href='".$sv->link."'<i class='".$sv->text."'></i></a>";
    }
echo $prom;
