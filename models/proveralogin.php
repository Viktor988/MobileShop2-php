<?php 
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
include("../config/konekcija.php");
require '../PHPMailer/src/PHPMailer.php';
    require '../PHPMailer/src/SMTP.php';
    require '../PHPMailer/src/Exception.php';

  
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);
if(isset($_POST['email2'])){


$greske=[];
$email2=$_POST['email2'];
$sifra2=$_POST['sifra2'];
$resifra="/[A-z]+[0-9]+/";
$reemail="/^[\w]+[\.\_\-\w]*[0-9]{0,3}\@[\w]+([\.][\w]+)+$/";
if(!preg_match($reemail,$email2)){
$greske[]="Email nije u dorom formatu!";
}
if(!preg_match($resifra,$sifra2)){
  $greske[]="Lozinka nije u dobrom formatu";
}
if(count($greske)!=0){
  foreach($greske as $gr){
    echo "<p>".$gr."</p>";
  }
}
 else{


$upit = "SELECT * FROM korisnik WHERE email = :email AND lozinka =:sifra";

		$priprema = $konekcija->prepare($upit);
		$priprema->bindParam(':email', $email2);
		$priprema->bindParam(':sifra',$sifra2);

		$rezultat = $priprema->execute();

		if($rezultat){
			if($priprema->rowCount()==1){
                $korisnik = $priprema->fetch();
                $_SESSION['korisnik'] =$korisnik;
            
                 
              
               
			

       
        $zaupis=$_SESSION['korisnik']->idkorisnik."\n";
        $open=fopen("../data/adresar.txt","a");
        fwrite($open,$zaupis);
        fclose($open);
      
            
            
            }}

         if($priprema->rowCount()==0){

          try {
            $mail->SMTPDebug = 0; 
            
            $mail->isSMTP();         
            $mail->Host = 'smtp.gmail.com';  

            $mail->SMTPAuth = true;         
            $mail->Username = 'auditorne.php@gmail.com'; 
            $mail->Password = 'Sifra123';   
            $mail->SMTPSecure = 'tls';                    
            $mail->Port = 587;  
            
            $mail->setFrom('viktor.ciric.36.17@ict.edu.rs', 'Telefoni.unaux.com');
            $mail->addAddress($email2, '11');

          

            $mail->isHTML(true); 

            $mail->Subject= "Poruka sa sajta telefoni.com";
          

            $mail->Body = "Postovani korisnice neko je pokusao da se prijavi na sajt sa Vasom e-mail adresom!"; 

            $mail->send();
         
            
        }
        catch(Exception $e){
            echo $e->getMessage();
        }
            http_response_code(500);
            echo "<script>alert('Prvo se morate registrovati')</script>"
            
            
            
            
            
            
            
            
            
            ;}
       }
      }
?>
         
         