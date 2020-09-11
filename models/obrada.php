<?php
include("../config/konekcija.php");
$code=200;

if(isset($_POST['imeiprezime'])){
$ime=$_POST['imeiprezime'];
$email=$_POST['email'];
$lozinka=$_POST['lozinka'];
$lozinkaponovo=$_POST['lozinkaponovo'];
$pol=$_POST['pol'];
$reime="/^[A-ZČĆŠĐŽ][a-zčćšđž]{2,9}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{2,14})+$/";
$reemail="/^[\w]+[\.\_\-\w]*[0-9]{0,3}\@[\w]+([\.][\w]+)+$/";
$relozinka="/[A-z]+[0-9]+/";


$greske=[];
if($ime==""){
    $greske[]="Ime i prezime je obavezno!";
}
	
	else if(!preg_match($reime,$ime))
	{
		$greske[]="Greska - ime i prezime!";
	
		
	}
	

    

    if($email==""){
        $greske[]="E-mail je obavezan!";
    }
        
        else if(!preg_match($reemail,$email))
        {
            $greske[]="Greska - E-mail!";
        
            
        }
  

        if($lozinka==""){
            $greske[]="Lozinka je obavezna!";
        }
            
            else if(!preg_match($relozinka,$lozinka))
            {
                $greske[]="Greska -Lozinka!";
            
                
            }
            
            


            if($lozinkaponovo!=$lozinka){
                $greske[]="Greska-Lozinke se ne poklapaju!";
            }
               
               
                if(empty($pol)){
                    $greske[]="Niste izabrali pol!"; 
                }
               

                if(count($greske)){
                  $code=422;
                    $data=$greske;
               
       
            }
            
            else{
                $upit="INSERT INTO korisnik (ime_i_prezime,email,lozinka,lozinkaponovo,pol,iduloga) VALUES(:ime,:email,:lozinka,:lozinkaponovo,:pol,1)";
$sve=$konekcija->prepare($upit);

                $sve->bindParam(":ime",$ime);
                $sve->bindParam(":email",$email);
                $sve->bindParam(":lozinka",$lozinka);
                $sve->bindParam(":lozinkaponovo",$lozinkaponovo);
                $sve->bindParam(":pol",$pol);
               
               
          
          
          
          
                try{ $code=$sve->execute()?201: 500;
                   
                
                   
                }
          catch(PDOException $e){
          
            echo $e->getMessage();
            upisiGreskuUFajl($e->getMessage());
            $code= 409;
          }
     
            
            }
        
        }
       http_response_code($code);

            ?>