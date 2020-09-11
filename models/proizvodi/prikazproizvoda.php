<?php
 include("functionsProizvodi.php");
 include("../../config/konekcija.php"); 
if(isset($_POST['idpro'])){
    $idpro=$_POST['idpro'];
 
$rezultat=prikaziProizvodeSaId($idpro);

try{    
      
 
    echo json_encode($rezultat);

    
  }
    catch(PDOExeption $e){
         http_response_code(500);
        echo $e->getMessage();
        upisiGreskuUFajl($e->getMessage());
    
    }

}
?>