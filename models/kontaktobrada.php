<?php if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
  include("./config/konekcija.php");
?>
<?php 
if(isset($_POST['email'])){
    $reemail="/^[\w]+[\.\_\-\w]*[0-9]{0,3}\@[\w]+([\.][\w]+)+$/";
    $renaslov="/^[A-z]+(\s[A-z]*)*$/";
    $repitanje="/^[A-z]+(\s[A-z]*)*$/";

  $email=$_POST['email'];
  $naslov=$_POST['naslov'];
  $pitanja=$_POST['pitanja'];
  $greske=[];
  
 if(!preg_match($reemail,$email)){
   $greske[]="Email nije u dobrom formatu!";
 
 
 }
 if(!preg_match($renaslov,$naslov)){
  $greske[]="Promenite naslov!";
}
if(!preg_match($repitanje,$pitanja)){
  $greske[]="Pitanje sadrzi nepozeljne karaktere!";
}
if(count($greske)!=0){
  $ispis="";
  foreach($greske as $gr){
   $ispis.="<p>$gr</p>";
  }
  echo $ispis;
}
else{
  $adresaprimaoca="viktorciric31@gmail.com";
  $subject=$naslov;
  $sadrzajmaila='E mail pošiljalaca: '.$email. "\n".
  "Komentar: \n".$pitanja. "\n";
  $dolaznisajt='From:Telefoniciric.com';
  mail($adresaprimaoca, $subject, $sadrzajmaila, $dolaznisajt);

  echo "Administrator ce odgovoriti u sto kracem roku.";}
}

