<?php
require_once '../config.php';
$nomerSPBU=((isset($_GET['nomer']))? $_GET['nomer'] : "");
if(isset($nomerSPBU)){
    $spbu=$db->get('ms_spbu','*',[
       'nomer'=>$nomerSPBU
    ]);
    if($spbu){
        echo $spbu['nama'];
    }
}