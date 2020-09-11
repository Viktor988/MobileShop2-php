<?php 
include("../../config/konekcija.php");
include("functionsProizvodi.php");

$upit=prikaziProizvodeBezOgranicenja();

$excel = new COM("Excel.Application");
$excel->Visible = 1;
$excel->DisplayAlerts = 1;
$workbook=$excel->Workbooks->Add();
$sheet = $workbook->Worksheets('Sheet1');
$sheet->activate;
$br=1;
foreach($upit as $d){

    $polje = $sheet->Range("A{$br}");
    $polje->activate;
    $polje->value = $d->Model;

    $polje = $sheet->Range("B{$br}");
    $polje->activate;
    $polje->value =  $d->Opis;

    
    $polje = $sheet->Range("C{$br}");
    $polje->activate;
    $polje->value =$d->cena;

  
    $br++;
}
$polje = $sheet->Range("D{$br}");
$polje->activate;
$polje->value = count($upit);
header('Location: ../../index.php');
 $workbook->SaveAs("http://telefoni.epizy.com/models/proizvodi/Proizvodi.xlsx", -4143);
$workbook->Save();


$workbook->Saved=true;
$workbook->Close;

$excel->Workbooks->Close();
$excel->Quit();

unset($sheet);
unset($workbook);
unset($excel);

