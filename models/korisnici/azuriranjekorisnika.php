<?php include("../../config/konekcija.php"); 
?>
 <?php

if(isset($_POST['skriveno'])){
$skriveno=$_POST['skriveno'];
$ime=$_POST['ime'];
$email=$_POST['email'];
$lozinka=$_POST['lozinka'];
$ponovo=$_POST['ponovo'];
$sve=$_POST['sve'];
$cekirani=$_POST['cekirani'];

$upitizmena=$konekcija->prepare("UPDATE korisnik SET ime_i_prezime=:ime,email=:email,lozinka=:loz,lozinkaponovo=:lozponovo,pol=:pol,iduloga=:uloga WHERE idkorisnik=:id" );
                $upitizmena->bindParam(":id",$skriveno);
                $upitizmena->bindParam(":ime",$ime);
                $upitizmena->bindParam(":email",$email);
                $upitizmena->bindParam(":loz",$lozinka);
                $upitizmena->bindParam(":lozponovo",$ponovo);
                $upitizmena->bindParam(":pol",$cekirani);
                $upitizmena->bindParam(":uloga",$sve);
            
                try{    
      
 
                    $rezultat=$upitizmena->execute();
                   http_response_code(204);
                    
                  }
                    catch(PDOExeption $e){
                        http_response_code(500);
                        echo $e->getMessage();
                        upisiGreskuUFajl($e->getMessage());
                    
                    
                    }
               
}