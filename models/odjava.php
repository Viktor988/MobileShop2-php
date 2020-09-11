<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }

 
  if(isset($_SESSION['korisnik'])){
    brisanjeAktikvnosti();
  

    unset($_SESSION['korisnik']);
    session_destroy();
    header("Location: index.php?page=pocetna");
}
?>