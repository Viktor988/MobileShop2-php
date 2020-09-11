<?php include("../config/konekcija.php");
var_dump((int)$_POST['skriveno']);
if( isset($_POST['glasaj'])){
    
    if( !isset($_POST['skriveno'])){

        echo "<script>alert('Morate se ulogovati!')</script>";
    }}

if( isset($_POST['glasaj'])){
    
   
    $gr=[];
    if(!isset($_POST['odgovori'])){
        $gr[]="Morate cekirati nesto!";
           
    }
     if($_POST['skriveno']=="0"){
          $gr[]="Greska morate se ulogovati";
        }
        if($_POST['skriveno']!=0){
            $id=$_POST['skriveno'];
        $anketaa=$konekcija->prepare("SELECT count(*) as broj from glasanje WHERE idkorisnik=$id");
        

        $izvrsiii= $anketaa->execute();

        $da=$anketaa->fetch();
      
       if($da->broj=="1"){
          $gr[]="Ne mozete glasati vise od jednom!";
     
        }}

      
     if(count($gr)!=0){
       foreach($gr as $g){
       
     
   
       echo "<script>alert('$g')</script>";
       echo '<script type="text/javascript">;
location="../index.php?page=kontakt";
</script>'
       ;
       }}
     
   else{
   
    
    $glasanje=$_POST['glasaj'];
    
 
  $odgovor=$_POST['odgovori'];
  $korisnik=$_POST['skriveno'];
  $upisi_odgovor=$konekcija->prepare("UPDATE anketarezultati SET rezultat=rezultat+1 WHERE
  idOdgovora=:odgovor");
  $upisi_odgovor->bindParam(":odgovor",$odgovor);
  $izvrsi_upisi_odgovor = $upisi_odgovor->execute();
  if ($izvrsi_upisi_odgovor):
   
  echo "<script>alert('Hvala vam sto ste glasali!')</script>";
  echo '<script type="text/javascript">;
location="../index.php?page=kontakt";
</script>';
  
  else:
  echo 'Greška'.mysql_error();
  endif;  
  $nemoze="INSERT INTO glasanje (idOdgovora,idkorisnik) VALUES(:odg,:kor)";
  $sve=$konekcija->prepare($nemoze);
  $sve->bindParam(":odg",$odgovor);
                $sve->bindParam(":kor",$korisnik);

                try{
$sve->execute();
http_response_code(204);
                }
                catch(PDOException $e){
                  http_response_code(500);
    echo $e->getMessage();
    upisiGreskuUFajl($e->getMessage());
                }


  }
 
}


  
  
