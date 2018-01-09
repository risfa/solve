<?php
include "db/db.php";

    $kode = $_GET['kode'];
    $status=array();
    $string = "select * from ms_vouchers where kode_voucher = '".$kode."' and enabled='Y'";
    $query = mysql_query($string) or die(mysql_error($string));

    if($rs = mysql_fetch_array($query))
    {
        $status['status']=true;
        $status['voucher_id']=$rs['voucher_id'];
        $status['kode_voucher']=$rs['kode_voucher'];
    }else{
        $status['status']=false;
    }
    echo json_encode($status);