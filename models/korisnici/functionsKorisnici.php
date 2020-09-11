<?php
include("../../config/konekcija.php"); 
function obrisiKorsisnika($sve){
    global $konekcija;
    $query=$konekcija->prepare("DELETE FROM korisnik WHERE idkorisnik in($sve)");
    return $query;

}

function prikazKorisnika(){
    $upit=executeQuery("SELECT * FROM korisnik k inner join uloge u on k.iduloga=u.iduloga");
    return $upit;
}
function prikazKorisnikaSaId($id){
    $upit = executeQuery("SELECT* from korisnik k inner join uloge u on k.iduloga=u.iduloga where k.idkorisnik=$id");
    return $upit;
}