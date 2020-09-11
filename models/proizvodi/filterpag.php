<?php 
include("../../config/konekcija.php");
if(isset($_POST['id'])){
    $id=$_POST['id'];
    if($id=="0"){
        $sql = $konekcija->prepare("SELECT COUNT(idProizvod) as brojproizvoda FROM proizvodi"); 
    }
    else{
$sql = $konekcija->prepare("SELECT COUNT(idProizvod) as brojproizvoda FROM proizvodi where idMarka=$id");  }
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