<?php 
include("../../config/konekcija.php"); 
 include("functionsProizvodi.php");
 $upit=prikaziProizvodeBezOgranicenja();

 try{    
      

    echo json_encode($upit);
     http_response_code(200);
    
  }
    catch(PDOExeption $e){
        echo http_response_code(500);
        echo $e->getMessage();
        upisiGreskuUFajl($e->getMessage());
    
    }