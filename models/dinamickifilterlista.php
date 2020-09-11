<?php 
 include("../config/konekcija.php");
?>
 <?php
$upit = executeQuery("SELECT* from marka");
try{
   http_response_code(200);

   echo json_encode($upit);}
catch(PDOException $e){
   echo http_response_code(500);
   echo $e->getMessage();
   upisiGreskuUFajl($e->getMessage());
}
?>