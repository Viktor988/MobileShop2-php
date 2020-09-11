<?php include("../../config/konekcija.php"); 
 include("../functions.php");  
 if(isset($_POST['vrednost'])){
     $sve=$_POST['vrednost'];
$upit= $upit=executeQuery("SELECT * from korisnik k INNER JOIN korpa ko on k.idkorisnik=ko.idkorisnik inner join proizvodi p on p.idProizvod=ko.idProizvod inner join marka m on m.idMarka=p.idMarka where k.ime_i_prezime like '%$sve%' or m.Naziv like '%$sve%' or p.Model like '%$sve%' or ko.Vreme like '%$sve%'");
try{
    echo json_encode($upit);
    http_response_code(200);
}
catch(PDOException $e){

    http_response_code(500);
    echo $e->getMessage();
    upisiGreskuUFajl($e->getMessage());
  
}}