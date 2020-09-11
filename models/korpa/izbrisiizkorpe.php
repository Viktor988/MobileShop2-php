<?php include("../../config/konekcija.php"); 
if(isset($_POST['niz'])){
    $id=$_POST['niz'];
$sve=implode(",",$id);

    $query=$konekcija->prepare("DELETE  from korpa where idkorpa in($sve)");
  
    
    try{    
    
    $query->execute();
    echo http_response_code(201);
    
}
    catch(PDOExeption $e){
        http_response_code(500);
       echo $e->getMessage();
       upisiGreskuUFajl($e->getMessage());
    }
}
?>