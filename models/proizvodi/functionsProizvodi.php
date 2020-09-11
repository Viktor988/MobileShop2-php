<?php 
include("../../config/konekcija.php"); 
function prikaziProizvodeSaOgranicenjem($limit){
  
$upit = executeQuery("SELECT* from proizvodi p inner join marka m on p.idMarka=m.idMarka inner join slike s on s.idslika=p.idslika order by datumPostavljanja DESC  LIMIT  $limit");
return $upit;}

function prikaziProizvodeBezOgranicenja(){
    $upit=executeQuery("SELECT* from proizvodi p inner join marka m on p.idMarka=m.idMarka inner join slike s on s.idslika=p.idslika");
    return $upit;
}
function prikaziProizvodeSaId($idpro){
    $upit=executeQuery("SELECT* from proizvodi p inner join slike s on p.idslika=s.idslika inner join marka m on m.idMarka=p.idMarka where idProizvod=$idpro");
    return $upit;}

    function dohvatiMarke(){
        $upit=executeQuery("SELECT* FROM marka") ;
        return $upit;}
        function prikaziProizvodeSaIdiOgranicenjem($id,$limit){
            $upit =executeQuery("SELECT* from proizvodi p inner join marka m on p.idMarka=m.idMarka inner join slike s on s.idslika=p.idslika where p.idMarka=$id limit $limit");
            return $upit;}
            function prikazPorudzbina(){
                $upit=executeQuery("SELECT * from korisnik k INNER JOIN korpa ko on k.idkorisnik=ko.idkorisnik inner join proizvodi p on p.idProizvod=ko.idProizvod inner join marka m on m.idMarka=p.idMarka");
                return $upit;
    
            }
            function obrisiProizvode($sve){
global $konekcija;
$query=$konekcija->prepare("DELETE  from proizvodi where idProizvod in($sve)");
return $query;
            }