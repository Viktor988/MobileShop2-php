<?php 
 include("../../config/konekcija.php");
 include("functionsProizvodi.php");
?>
 <?php
if(isset($_POST['naziv'])){
$limit=6;
$naziv=$_POST['naziv'];
if($naziv==''){
  $upit = prikaziProizvodeSaOgranicenjem($limit=6);

}
else{
$upit =executeQuery("SELECT* from proizvodi p inner join marka m on p.idMarka=m.idMarka inner join slike s on s.idslika=p.idslika where p.Model like '%$naziv%' or m.Naziv like '%$naziv%' LIMIT $limit");
}
try{    
      
    http_response_code(200);
   echo json_encode($upit);
  
   
 }
   catch(PDOExeption $e){
        http_response_code(500);
        echo $e->getMessage();
        upisiGreskuUFajl($e->getMessage());
   }
}
?>