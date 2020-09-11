<?php include("../../config/konekcija.php"); 
session_start();

if(isset($_POST['id'])){

  $proiz=$_POST['id'];
  $kol=$_POST['kolicina'];
  $kor=$_SESSION['korisnik']->idkorisnik;

  $upit=$konekcija->prepare("INSERT INTO korpa (idProizvod,idkorisnik,kolicina) VALUES('$proiz','$kor','$kol')");

  try{
  $rez=$upit->execute();
  http_response_code(204);
  }
  catch(PDOException $e){
    http_response_code(500);
    echo $e->getMessage();
    upisiGreskuUFajl($e->getMessage());
  }

}