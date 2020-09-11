<?php include("../../config/konekcija.php");  
if(isset($_POST['marka'])){
    $opis=$_POST['area'];
    $cena=$_POST['cena'];
    $model=$_POST['model'];
    $marka=$_POST['marka'];
  $slika=$_FILES['userfile'];


    $fileName = $slika['name'];
    $tmpName = $slika['tmp_name'];
    $fileSize = $slika['size'];
    $fileType = $slika['type'];
    $fileError = $slika['error']; 
    $upload1 = '../../assets/slike/'.time()."mala".$fileName;
    $uploadDir2 = '../../assets/slike/'.time()."velika".$fileName;
    $upload11 = 'assets/slike/'.time()."mala".$fileName;
    $uploadDir22 = 'assets/slike/'.time()."velika".$fileName;


 
    list($sirina, $visina) = getimagesize($tmpName);
    $x = 300;
    $y = 200;
    
    // Kreiranje nove slike (resource) od fajla ili URL-a
    if( $fileType == "image/jpeg" ) { $postojecaSlika = imagecreatefromjpeg($tmpName); }
    elseif( $fileType == "image/gif" ) { $postojecaSlika = imagecreatefromgif($tmpName); }
    elseif( $fileType == "image/png" ) { $postojecaSlika = imagecreatefrompng($tmpName); }
    $novaVisina=$y;
    $novaSirina=$sirina*$y/$visina;
   
    //Kreiranje nove slike u koloru
    $prazna_image = imagecreatetruecolor($novaSirina, $novaVisina);
    imagecopyresampled($prazna_image, $postojecaSlika, 0, 0, 0, 0, $novaSirina, $novaVisina, $sirina, $visina);
    $white = imagecolorallocate($prazna_image, 255, 255, 255);
    imagefill($prazna_image, 0, 0, $white);
    $novaSlika = $prazna_image;
  
    
    //Snimanje
    $compression=75;
    if( $fileType == "image/jpeg" ) { imagejpeg($novaSlika,$upload1,$compression); }
    elseif( $fileType == "image/gif" ) { imagegif($novaSlika,$upload1); }
    elseif( $fileType == "image/png" ) { imagepng($novaSlika,$upload1); }



   // velika slika
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
    $novaSlika2 = $prazna_image2;
    
    //Snimanje
    $compression=75;
    if( $fileType == "image/jpeg" ) { imagejpeg($novaSlika2,$uploadDir2,$compression); }
    elseif( $fileType == "image/gif" ) { imagegif($novaSlika2,$uploadDir2); }
    elseif( $fileType == "image/png" ) { imagepng($novaSlika2,$uploadDir2); }
    
  
   
        $query = "INSERT INTO slike (name, size, type, mala_slika, velika_slika )
        VALUES ('$fileName', '$fileSize', '$fileType', '$upload11','$uploadDir22')";

        try{
         $sve= $konekcija->query($query);
    if($sve){
 
    $model=$_POST['model'];
    $opis=$_POST['area'];
    $cena=$_POST['cena'];
    $marka=$_POST['marka'];
    
        $slika=$konekcija->lastInsertId();
    
   
    $query2 = "INSERT INTO proizvodi (Model, Opis, cena, idMarka,idslika ) VALUES('$model','$opis','$cena','$marka','$slika')";
try{

    $konekcija->query($query2);
    echo "<script>alert('Proizvod ubacen!')</script>";
    echo '<script type="text/javascript">;
    location="../../index.php?page=admin";
  </script>';
   http_response_code(201);
    
}
catch(PDOException $ex){"Greska".$ex.getMessage();
    upisiGreskuUFajl($e->getMessage());
}
        }}

        catch(PDOException $ex){
            echo http_response_code(500);
            echo $e->getMessage();
            upisiGreskuUFajl($e->getMessage());
        
        }}
