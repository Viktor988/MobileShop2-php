<?php include("../../config/konekcija.php"); 
 include("../proizvodi/functionsProizvodi.php");
?>
 <?php


$upit = prikaziProizvodeBezOgranicenja();
try{    
      
 
   echo json_encode($upit);
 
   
 }
   catch(PDOExeption $e){
    http_response_code(500);
    echo $e->getMessage();
    upisiGreskuUFajl($e->getMessage());
   
   }