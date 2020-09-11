<?php 
 include("../../config/konekcija.php"); 
 if(isset($_POST['imei'])){
 
    $ime=$_POST["imei"];
    $email=$_POST['postai'];
    $lozinka=$_POST['lozinkai'];
    $lozinkaponovo=$_POST['lozinkapi'];
    $pol=$_POST['radi'];
    
    @ $uloga=$_POST['lista'];
    $reemail="/^[\w]+[\.\_\-\w]*[0-9]{0,3}\@[\w]+([\.][\w]+)+$/";
    $greske=[];
        if($email==""){
            $greske[]="E-mail je obavezan!";
        }
            
            else if(!preg_match($reemail,$email))
            {
                $greske[]="Greska - E-mail!";
            }
      
                if($lozinkaponovo!=$lozinka){
                    $greske[]="Greska-Lozinke se ne poklapaju!";
                } 
                    if(empty($pol)){
                        $greske[]="Niste izabrali pol!"; 
                    }
                    
                    if($uloga=="0"){
                        $greske[]="Izaberite ulogu!"; 
                    }
                    if(count($greske)!=0){
                     
                        $promgr="<ul>";
                        foreach($greske as $promg){
                            $promgr.="<li>".$promg."</li>";
                        }
                        $promgr.="</ul>";
                        echo $promgr;
           
                }
                
                else{
                    $upit="INSERT INTO korisnik (ime_i_prezime,email,lozinka,lozinkaponovo,pol,iduloga) VALUES(:ime,:email,:lozinka,:lozinkaponovo,:pol,:uloga)";
    $sve=$konekcija->prepare($upit);
    
                    $sve->bindParam(":ime",$ime);
                    $sve->bindParam(":email",$email);
                    $sve->bindParam(":lozinka",$lozinka);
                    $sve->bindParam(":lozinkaponovo",$lozinkaponovo);
                    $sve->bindParam(":pol",$pol);
                    $sve->bindParam(":uloga",$uloga);
                    try{
                        $sve->execute(); 
                         http_response_code(204);  
                    }
              catch(PDOException $e){
                  echo "Greske".$e->getmessage();    
                }}}
?>