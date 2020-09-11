<?php 
include("../../config/konekcija.php");
include("functionsProizvodi.php");
if(isset($_POST['id'])){
    $id=$_POST['id'];
$upit =$konekcija->prepare("SELECT* from proizvodi p inner join marka m on p.idMarka=m.idMarka inner join slike s on s.idslika=p.idslika  where idProizvod=$id");
$rez=$upit->execute();
try{    
    $sve=$upit->fetch();
  
   echo json_encode($sve);
   http_response_code(200);
   
 }
   catch(PDOExeption $e){
        http_response_code(500);
       echo $e->getMessage();
       upisiGreskuUFajl($e->getMessage());
   }

      
  
    
    }