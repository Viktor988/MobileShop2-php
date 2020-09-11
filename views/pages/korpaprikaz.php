
<?php 
 if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();}

?><?php 
if(!isset($_SESSION['korisnik'])){

  header("Location: index.php");
}
?>

<div id="sadrzajj">
    <h1 id="knaslov">Korpa</h1>
<div id="sadrzajjj"></div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="assets/js/korpa.js"></script>
