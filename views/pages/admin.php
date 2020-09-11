<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
  }
if(isset($_SESSION['korisnik'])){
    if($_SESSION['korisnik']->iduloga != 2){

        header("Location: index.php?page=pocetna");
    }
} else {
   
    header("Location: index.php?page=pocetna");
}
?>
<div id="dd">
<div id="celi">
<div id="zakorisnika">
<input type="button" id="kprikaz" value="Upravljanje Nalozima"/>
<div id="ispiss">
<form name="lista" action="index.php?page=admin" method="POST"> 
<input type="button" value="Prikazi" name="prikazi" id="posalji"/>
<input type="button" value="Dodaj korisnika" name="ubacik" id="ubacik"/>
</form>
</div>
</div>
<div id="kor"></div>
<div id="forma"></div>
<div id="pr">
 <form name="prikaz" action="index.php?page=admin" method="POST" id="prikaz proizvoda">
 <input type="submit" value="Upravljanje proizvodima" id="dugproizvodi"/>
 <input type="button" id="prikazipr" name="prikazipr" value="Prikazi"/>
 <input type="button" id="dodajpr" name="dodajpr" value="Dodaj"/>
 <input type="button" id="statistika" name="statistika" value="Statistika pristupa stranicama"/>
 <input type="button" id="brojpristupa" name="brojbristupa" value="Statistika o broju pristupa i aktivnim korisnicima"/>
 <input type="button" id="vremep" name="brojbristupa" value="Stranice i Vreme pristupa stranicama"/>
 <input type="button" id="porudzbine" name="porudzbine" value="Porudzbine"/>
 </form>
 <form name="exel" action="models/proizvodi/exportExcel.php">
 <input type="submit" value="Export Excel" id="dugproizvodi"/>
 </form>

 <?php
     dijagramPosecenostiStranicaUprocentima(); 
 ?>
<div id="chartContainer" style="height: 370px; width: 100%;"></div>
 <?php $niz=pristupStranicama()?>                             
<div id="prikazbroj">
<table border="1px solid black" id="tstatistika"><th>Broj pristupa stranicama</th><th>Pocetna</th><th>Kontakt</th><th>Autor</th><th>Registracija</th><th>Prijava</th><th>Admin</th><th>Korpa</th><th>Odjava</th></tr>
<tr><td>Broj pristupa stranicama</td><td><?=$niz[2];?></td><td><?=$niz[6];?></td><td><?=$niz[0];?></td><td><?=$niz[3];;?></td><td><?=$niz[4];?></td><td><?=$niz[1];?></td><td><?=$niz[5];?></td><td><?=$niz[7];?></td>
 </tr></table>
<?php 
$ispis3=brojAktivnihKorisnika();
?>
<!--aktivni korisnici -->
<table border="1px solid black" id="kk"><th>Broj aktivnih korisnika</th></tr>
<tr><td><?=$ispis3+1?></td></tr></table>
</div>
<div id="proizv"></div>
<!--prikaz stranica i vreme pristupa  -->
<div id="prikazfajl">
    <?php 
$fajl=prikaziFajl();
?>
<table border='1px solid black' id='tstatistika'><th>Stranice</th><th>Vreme pristupa</th></tr>
<?php 
foreach($fajl as $key=>$value){
    $da=explode("\t",$value);
?><tr><td><?=$da[0];?></td><td><?=$da[1];?></td></tr>
<?php };?>
</table>;
</div>
<div id="prikazf"></div>
<input type="text" id="trazikorpa" placeholder="Trazi..."/>
<div id="prikazp">



</div>

   </div> </div></div>
   <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

