<?php include("../../config/konekcija.php"); 
include("functionsProizvodi.php"); 
 $upit=dohvatiMarke();

 try{    
      
 
    echo json_encode($upit);
  
    
  }
    catch(PDOExeption $e){
        echo http_response_code(500);
        echo $e->getMessage();
        upisiGreskuUFajl($e->getMessage());
    }