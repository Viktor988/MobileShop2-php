<?php include("../../config/konekcija.php"); 
include("functionsKorisnici.php"); 


$upit=prikazKorisnika();

try{
echo json_encode($upit);
http_response_code(200);
}
catch(PDOException $e){
    http_response_code(500);
    echo $e->getMessage();
    upisiGreskuUFajl($e->getMessage());
}
?>