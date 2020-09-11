<?php include("../../config/konekcija.php");
 include("functionsProizvodi.php");  
$upit=prikazPorudzbina();
try{
    echo json_encode($upit);

}
catch(PDOException $e){
     http_response_code(500);
    echo $e->getMessage();
    upisiGreskuUFajl($e->getMessage());
}