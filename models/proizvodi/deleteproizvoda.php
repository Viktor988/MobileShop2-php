<?php include("../../config/konekcija.php"); 
include("functionsProizvodi.php");
if(isset($_POST['niz'])){
    $id=$_POST['niz'];
$sve=implode(",",$id);

    $query=obrisiProizvode($sve=$sve);
  
    
    try{    
    
    $query->execute();
    echo http_response_code(201);
    
}
    catch(PDOExeption $e){
        echo http_response_code(500);
        echo $e->getMessage();
        upisiGreskuUFajl($e->getMessage());
    }
}
?>