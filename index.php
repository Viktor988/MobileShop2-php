<?php 
    session_start();
include("config/konekcija.php");
include("models/functions.php");
include("views/fixed/head.php");
include("views/fixed/nav.php"); 
 include("views/fixed/header.php") ;

if(isset($_GET['page'])){
 
  
    $page=$_GET['page'];
  switch($page){
    case 'pocetna':
    include("views/pages/home.php");
    break;
    case 'kontakt':
    include("views/pages/kontakt.php");
    break;
    case 'autor':
    include("views/pages/autor.php");
    break;
    case 'registracija':
    include("views/pages/Registracija.php");
    break;
    case 'prijava':
    include("views/pages/login.php");
    break;
    case 'odjava':
    include("models/odjava.php");
    break;
    case 'admin':
    include("views/pages/admin.php");
    break;
    case 'korpaprikaz':
    include("views/pages/korpaprikaz.php");
    break;
  }
}else{
  include("views/pages/home.php");
}

if ( ! function_exists('zabeleziPristupStranici') ) {
     
  function zabeleziPristupStranici(){
      $open = fopen(LOG_FAJL, "a");
      if($open){
          $date = date('d-m-Y H:i:s');
       
          fwrite($open, "{$_SERVER['REQUEST_URI']}\t{$date}\t{$_SERVER['REMOTE_ADDR']}\n");
          fclose($open);
      }
  }}
  zabeleziPristupStranici();
 include("views/fixed/futer.php"); ?>
 