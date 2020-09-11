<?php include("../../config/konekcija.php"); 

   if(isset($_POST['skriveno'])){
   $id=$_POST['skriveno'];
   $model=$_POST['model'];
   $opis=$_POST['area'];
   $slika=$_FILES['userfile'];
   $cena=$_POST['cenaa'];
   $marka=$_POST['marka'];
  
   $greske=[];

   if($_FILES['userfile']['name']==""){
 
       $upitazuriranje=$konekcija->prepare("UPDATE proizvodi SET Model=:model,Opis=:opis,cena=:cena,idMarka=:marka WHERE idProizvod=:id" );
       $upitazuriranje->bindParam(":id",$id);
       $upitazuriranje->bindParam(":model",$model);
       $upitazuriranje->bindParam(":opis",$opis);
       $upitazuriranje->bindParam(":cena",$cena);
       $upitazuriranje->bindParam(":marka",$marka);
      $rezultat=$upitazuriranje->execute();
   if($rezultat){
    echo "<script>alert('Proizvod izmenjen!')</script>";
    echo '<script type="text/javascript">;
  location="../../index.php?page=admin";
  </script>';
   }
   else{
       echo "<script>alert('Greska')</script>";
   }}
   else{
       $fileName = $_FILES['userfile']['name'];
       $tmpName = $_FILES['userfile']['tmp_name'];
       $fileSize = $_FILES['userfile']['size'];
       $fileType = $_FILES['userfile']['type'];
       $fileError = $_FILES['userfile']['error']; 
    
       $uploadDir1 = '../../assets/slike/'.time()."mala".$fileName;
       $uploadDir2 = '../../assets/slike/'.time()."velika".$fileName;
       $uploadDir11 = 'assets/slike/'.time()."mala".$fileName;
       $uploadDir22 = 'assets/slike/'.time()."velika".$fileName;
       $id=$_POST['skriveno']; 
       $query1 = "SELECT * FROM slike WHERE idslika=(SELECT idslika FROM proizvodi WHERE idProizvod=$id)";
       $stmt1 = $konekcija->prepare($query1);
       $stmt1->execute(); 
       $pictureObj=$stmt1->fetch();
       $idPicture=$pictureObj->idslika; 
       $oldPicPath=$pictureObj->name; 
       $oldThumbPath=$pictureObj->mala_slika;
       $oldThumbPath2=$pictureObj->velika_slika;
       unlink("../../".$oldThumbPath);
       unlink("../../".$oldThumbPath2);
       $tmpName = $_FILES['userfile']['tmp_name'];
       list($sirina, $visina) = getimagesize($tmpName);


// Kreiranje nove slike (resource) od fajla ili URL-a
if( $fileType == "image/jpeg" ) { $postojecaSlika = imagecreatefromjpeg($tmpName); }
elseif( $fileType == "image/gif" ) { $postojecaSlika = imagecreatefromgif($tmpName); }
elseif( $fileType == "image/png" ) { $postojecaSlika = imagecreatefrompng($tmpName); }
$novaVisina=200;
$novaSirina=$sirina*$novaVisina/$visina;

//Kreiranje nove slike u koloru
$prazna_image = imagecreatetruecolor($novaSirina, $novaVisina);
imagecopyresampled($prazna_image, $postojecaSlika, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);
$white = imagecolorallocate($prazna_image, 255, 255, 255);
    imagefill($prazna_image, 0, 0, $white);
    $novaSlika = $prazna_image;
$novaSlika = $prazna_image;

//Snimanje
$compression=75;
if( $fileType == "image/jpeg" ) { imagejpeg($novaSlika,$uploadDir1,$compression); }
elseif( $fileType == "image/gif" ) { imagegif($novaSlika,$uploadDir1); }
elseif( $fileType == "image/png" ) { imagepng($novaSlika,$uploadDir1); }



//velika slika
list($sirina2, $visina2) = getimagesize($tmpName);


// Kreiranje nove slike (resource) od fajla ili URL-a
if( $fileType == "image/jpeg" ) { $postojecaSlika2 = imagecreatefromjpeg($tmpName); }
elseif( $fileType == "image/gif" ) { $postojecaSlika2 = imagecreatefromgif($tmpName); }
elseif( $fileType == "image/png" ) { $postojecaSlika2 = imagecreatefrompng($tmpName); }
$novaVisina2=350;
   $novaSirina2=$sirina2*$novaVisina2/$visina2;

//Kreiranje nove slike u koloru
$prazna_image2 = imagecreatetruecolor($novaSirina2, $novaVisina2);
imagecopyresampled($prazna_image2, $postojecaSlika2, 0, 0, 0, 0, $novaSirina2, $novaVisina2, $sirina2, $visina2);
$white = imagecolorallocate($prazna_image2, 255, 255, 255);
    imagefill($prazna_image2, 0, 0, $white);
    $novaSlika = $prazna_image2; 
$novaSlika2 = $prazna_image2;

//Snimanje
$compression=75;
if( $fileType == "image/jpeg" ) { imagejpeg($novaSlika2,$uploadDir2,$compression); }
elseif( $fileType == "image/gif" ) { imagegif($novaSlika2,$uploadDir2); }
elseif( $fileType == "image/png" ) { imagepng($novaSlika2,$uploadDir2); }


    
           $picQuery = "UPDATE slike SET name='$tmpName', mala_slika='$uploadDir11',velika_slika='$uploadDir22' WHERE idslika= $idPicture"; 
           $picStmt = $konekcija->prepare($picQuery);
   
          
            $sve= $konekcija->query($picQuery);
 
      $rezultat=$picStmt->execute();
   if($rezultat){
    echo "<script>alert('Proizvod izmenjen!')</script>";
    echo '<script type="text/javascript">;
  location="../../index.php?page=admin";
  </script>';
   }
   else{
       echo "<script>alert('Greska')</script>";
       echo '<script type="text/javascript">;
       location="../../index.php?page=admin";
       </script>';
    }
   }}


