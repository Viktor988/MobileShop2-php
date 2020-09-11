

<?php include("../../config/konekcija.php"); 
include("functionsKorisnici.php"); 
if(isset($_POST['niz'])){
    $id=$_POST['niz'];
    $sve=implode(",",$id);
    $query=obrisiKorsisnika($sve);
   
    
    try{    
      
    $query->execute();
    echo http_response_code(200);
    
}
    catch(PDOExeption $e){
        http_response_code(500);
        echo $e->getMessage();
        upisiGreskuUFajl($e->getMessage());
    
    }}
?>
