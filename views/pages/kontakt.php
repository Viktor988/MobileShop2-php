<?php if (session_status() !== PHP_SESSION_ACTIVE) {
  session_start();}?>
          <div id="ksredina">
          <h1 id="knaslov">Kontakt</h1>
            <div id="kotntakti">
            <div id="formakontakt">
<form action="#" method="post">
<?php  if(isset($_SESSION['korisnik'])){ ?>
<input type="text" id="emailkk" name="email"placeholder="Email" value="<?=$_SESSION['korisnik']->email;?>"/><br/> <?php }
else{?><input type="text" id="emailkk" name="email"placeholder="Email"/><br/> <?php }?>
<input type="text" id="naslov" name="naslov"placeholder="Naslov"/><br/>
<textarea rows="10" cols="5" id="pitanja" name="pitanja" placeholder="Pitanje"></textarea><br/>
<input type="button" id="sub" name="sub" value="Posaljite poruku"/>
</form>
 <div id="greskee"></div>          
  </div>
<div id="anketa">
<form action="models/Anketa.php" method="post">
            <?php           
            $niz1 = dohvatiPitanjeAnkete();
            foreach($niz1 as $niz){
            ?>
           <table border='1px' id='anketatabela'><tr><td><?=$niz->tekstPitanja;?></td></tr> <?php };?>
            <?php            
$aa=dohvatiOdgovoreAnkete();
foreach($aa as $red){ ?>
<tr><td><input type='radio' name='odgovori' value='<?=$red->idOdgovora;?>'/><?=$red->odgovori;?></td></tr>
<?php };?>
<tr><td><input type='submit' name='glasaj'id='glasaj' value='Glasaj' />
<?php 
if(isset($_SESSION['korisnik'])){?>
<input type="hidden" name="skriveno" value="<?=$_SESSION['korisnik']->idkorisnik;?>"/><?php }
else{?>
  <input type="hidden" name="skriveno" value="0"/>
<?php } ?>
<input type='button' name='rez' value='Rezultati' id='rezultat' /></td></tr>
</table></form>
<div id="rezan"></div>
</div>
</div>
</div>



