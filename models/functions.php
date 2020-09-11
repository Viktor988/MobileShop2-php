<?php 


function dijagramPosecenostiStranicaUprocentima(){
    $datotekaunizu=file("data/log.txt");
// statistike
$ispis="";
$niz=[];
$brojacautor=0;
$brojacadmin=0;
$brojacpocetna=0;
$brojacregistracija=0;
$brojaclogin=0;
$brojackorpa=0;
$brojackontakt=0;
$brojacodjava=0;
    for($i=0;$i<count($datotekaunizu);$i++){
        $novi=explode("\t",$datotekaunizu[$i]);
        
     
switch($novi[0]){
    case "/index.php?page=autor":
    $brojacautor=$brojacautor+1;
    $autor=$brojacautor*100/count($datotekaunizu);
    break;
    case "/index.php?page=odjava":
    $brojacodjava=$brojacodjava+1;
    $odjava=$brojacodjava*100/count($datotekaunizu);
    break;
    case "/index.php?page=admin":
    $brojacadmin=$brojacadmin+1;
    $admin=$brojacadmin*100/count($datotekaunizu);
    break;
    case "/index.php?page=pocetna":
    $brojacpocetna=$brojacpocetna+1;
    $pocetna=$brojacpocetna*100/count($datotekaunizu);
    break;
    case "/index.php":
    $brojacpocetna=$brojacpocetna+1;
    $pocetna=$brojacpocetna*100/count($datotekaunizu);
    break;
    case "/":
    $brojacpocetna=$brojacpocetna+1;
    $pocetna=$brojacpocetna*100/count($datotekaunizu);
    break;
    case "/index.php?page=registracija":
    $brojacregistracija=$brojacregistracija+1;
    $registracija=$brojacregistracija*100/count($datotekaunizu);
    break;
    case "/index.php?page=prijava":
    $brojaclogin=$brojaclogin+1;
    $prijava=$brojaclogin*100/count($datotekaunizu);
    break;
    case "/index.php?page=kontakt":
    $brojackontakt=$brojackontakt+1;
    $kontakt=$brojackontakt*100/count($datotekaunizu);
    break;
    case "/index.php?page=korpaprikaz":
    $brojackorpa=$brojackorpa+1;
    $korpa=$brojackorpa*100/count($datotekaunizu);
    break;
}}
    

   ?>
    <?php
// dijagram
$dataPoints = array(
	@array("label"=> "Autor", "y"=> $autor),
	@array("label"=> "Admin", "y"=> $admin),
	@array("label"=> "Pocetna", "y"=> $pocetna),
	@array("label"=> "Registracija", "y"=> $registracija),
	@array("label"=> "Prijava", "y"=> $prijava),
	@array("label"=> "Korpa", "y"=> $korpa),
    @array("label"=> "Kontakt", "y"=> $kontakt),
    @array("label"=> "Odjava", "y"=> $odjava)
); ?>
    
    <script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	exportEnabled: true,
	title:{
		text: "Statistika posecenosti stranica"
	},
	subtitles: [{
		text: ""
	}],
	data: [{
		type: "pie",
		showInLegend: "true",
		legendText: "{label}",
		indexLabelFontSize: 16,
		indexLabel: "{label} - #percent%",
		yValueFormatString: "฿#,##0",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>
<?php };

function pristupStranicama(){
    $datotekaunizu=file("data/log.txt");
   $brojacadmin2=0;
    $brojacautor2=0;
    $brojacpocetna2=0;
    $brojacregistracija2=0;
    $brojaclogin2=0;
    $brojackorpa2=0;
    $brojackontakt2=0;  
    $brojacodjava2=0; 


for($i=0;$i<count($datotekaunizu);$i++){
    $novi=explode("\t",$datotekaunizu[$i]);
  @$daa=strtotime($novi[1]);
   if($daa>time()-86400){

   
if($novi[0]=="/index.php?page=autor" ){

$brojacautor2=$brojacautor2+1;
}
   
if($novi[0]=="/index.php?page=odjava" ){

    $brojacodjava2=$brojacodjava2+1;
    }

if($novi[0]=="/index.php?page=admin"){
$brojacadmin2=$brojacadmin2+1;

 }
 if($novi[0]=="/index.php?page=pocetna"){
    $brojacpocetna2=$brojacpocetna2+1;
     }
     if($novi[0]=="/index.php"){
        $brojacpocetna2=$brojacpocetna2+1;
         }
 if($novi[0]=="/"){
        $brojacpocetna2=$brojacpocetna2+1;
         }
     if($novi[0]=="/index.php?page=registracija"){
        $brojacregistracija2=$brojacregistracija2+1;
         }
         if($novi[0]=="/index.php?page=prijava"){
            $brojaclogin2=$brojaclogin2+1;
             }
             if($novi[0]=="/index.php?page=korpaprikaz"){
                $brojackorpa2=$brojackorpa2+1;
                 }
                 if($novi[0]=="/index.php?page=kontakt"){
                    $brojackontakt2=$brojackontakt2+1;
                     }}}
             return $niz=array($brojacautor2,$brojacadmin2,$brojacpocetna2,$brojacregistracija2,$brojaclogin2,$brojackorpa2,$brojackontakt2,$brojacodjava2);
               ?>
<?php };


function brojAktivnihKorisnika(){
    $fajl=file("data/adresar.txt");
$ispis3="";
foreach($fajl as $key=>$value){
$ispis3=$key;

}
return $ispis3;
}



   


        function dohvatiPitanjeAnkete(){
            $upit=executeQuery("SELECT idPitanja, tekstPitanja FROM anketapitanja WHERE aktivna=1");
            return $upit;
        }
        function dohvatiOdgovoreAnkete(){
            $upit=executeQuery("SELECT  odgovori, idOdgovora FROM anketaodgovori o, anketapitanja a WHERE a.aktivna=1
            AND a.idPitanja=o.idPitanja");
            return $upit;
        }
            function prikaziFajl(){
                return file("data/log.txt");
            }
        function prikaziRazlicitTitle(){
            if(isset($_GET['page'])){
                switch($_GET['page']){
                
                case 'pocetna':?>
                <title>Telefoni Ciric-Pocetna</title>
                <?php break;
                case 'kontakt':?>
                <title>Telefoni Ciric-Kontakt</title>
                <?php break;
                case 'autor':?>
                <title>Telefoni Ciric-Autor</title>
                <?php break;
                case 'registracija':?>
                <title>Telefoni Ciric-Registracija</title>
                <?php break;
                case 'prijava':?>
                <title>Telefoni Ciric-Prijava</title>
                <?php break;
                case 'admin':?>
                <title>Telefoni Ciric-Admin</title>
                <?php break;
                case 'korpaprikaz':?>
                <title>Telefoni Ciric-Korpa</title>
                <?php break;
                }}
                else{
                  ?>  <title>Telefoni Ciric-Pocetna</title> 
                <?php }} ?>
        <?php function brisanjeAktikvnosti(){
         
              $ispis="";
              $fajl=file("data/adresar.txt");
              foreach($fajl as $key=>$value){
                if($key !=$id){
                $ispis.=$value;
                }
              
                $open=fopen("data/adresar.txt","w");
                fwrite($open,$ispis);
                fclose($open);}
        }

       
        function prikaziIkone(){
            $upit=executeQuery("SELECT * from faikonice");
            return $upit;}