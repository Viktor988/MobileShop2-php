<?php

require_once "config.php";

try {
    $konekcija = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $konekcija->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    echo $ex->getMessage();
}
if ( ! function_exists('executeQuery') ) {
  
function executeQuery($query){
    global $konekcija;
    return $konekcija->query($query)->fetchAll();}}
    if ( ! function_exists('upisiGreskuUFajl') ) {
    function upisiGreskuUFajl($greska){
        $formazaupis=$greska."\t".date("d-m-y H:i:s")."\n";
        @$open=fopen("../../data/greske.txt",'a');
        @fwrite($open,$formazaupis);
       @fclose($open);
    }}
 
  