<?php include("../config/konekcija.php");
$odgovori = executeQuery("SELECT o.odgovori, r.rezultat FROM anketaodgovori o, anketarezultati r WHERE
  o.idOdgovora = r.idOdgovora");
  try{
  echo json_encode($odgovori);
  }
  catch(PDOException $e){
    http_response_code(500);
    echo $e->getMessage();
    upisiGreskuUFajl($e->getMessage());
  }