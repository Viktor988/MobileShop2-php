<?php 
include("../../config/konekcija.php");
include("functionsProizvodi.php");
if(isset($_POST['naziv'])){
    $naziv=$_POST['naziv'];
    if($naziv==''){
        $sql=$konekcija->prepare("SELECT COUNT(idProizvod) as brojproizvoda FROM proizvodi");
    }
    else{
$sql = $konekcija->prepare("SELECT COUNT(idProizvod) as brojproizvoda FROM proizvodi p inner join marka m on p.idMarka=m.idMarka inner join slike s on s.idslika=p.idslika where p.Model like '%$naziv%' or m.Naziv like '%$naziv%'");}
$sql->execute();

try{    
    $da=$sql->fetch();
    http_response_code(200);
   echo json_encode($da);
  
   
 }
   catch(PDOExeption $e){
        http_response_code(500);
   echo $e->getMessage();
   upisiGreskuUFajl($e->getMessage());
   }



}