<?php 
 include("../../config/konekcija.php"); 

 include("functionsKorisnici.php"); 
 if(isset($_POST['id'])){
$id=$_POST['id'];
$upit = prikazKorisnikaSaId($id=$id);

try{    
      
 
  echo json_encode($upit);
http_response_code(200);
  
}
  catch(PDOExeption $e){
    http_response_code(500);
    echo $e->getMessage();
    upisiGreskuUFajl($e->getMessage());
  
  
  }
 
 }

 