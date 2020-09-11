 <?php 
include("../../config/konekcija.php");
?>
 <?php

  if(isset($_POST['send'])){
      $strana=($_POST["idpag"]-1)*6;
     $vrednost=$_POST['vrednost'];
     $idfilter=$_POST['id'];
$limit = 6;  

$upit ="SELECT * from proizvodi p inner join marka m on p.idMarka=m.idMarka inner join slike s on s.idslika=p.idslika ";
if($idfilter!='0'){
    $upit.="WHERE p.idMarka=$idfilter ORDER BY ";}
    else{
        $upit.="ORDER BY ";
    }

    if($vrednost=='1'){
        $upit.="p.cena DESC,";
    }
    else if($vrednost=='2'){
        $upit.="p.cena,";
    }
    $upit.="p.datumPostavljanja DESC LIMIT 6 OFFSET $strana";

 $da=$konekcija->prepare($upit);
  $sve=$da->execute();
    $svee=$da->fetchAll();
try{    
   
 
    echo json_encode($svee);
   http_response_code(200);
    
  }
    catch(PDOExeption $e){
        echo http_response_code(500);
    echo $e->getMessage();
    upisiGreskuUFajl($e->getMessage()); 
    
}}

?> 