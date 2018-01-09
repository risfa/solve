<?php
/**
 * Created by PhpStorm.
 * User: arahman
 * Date: 2/6/17
 * Time: 10:08 AM
 */
require_once '../config.php';
$errors=array();
$week=$user_sessions->get('week');
$group=$user_sessions->get('group');
//$namaSPBU=(isset($_POST['namaSPBU'])? $_POST['namaSPBU'] : FALSE );
$nomerSPBU=(isset($_POST['nomerSPBU'])? $_POST['nomerSPBU'] : FALSE );
if(!$nomerSPBU){
    $errors[]="Isi Data Dengan Lengkap.";
}
$spbu=$db->get('ms_spbu','*',[
    'nomer'=>$nomerSPBU
]);
if(!preg_match("/^[0-9]{7}/",$nomerSPBU) || substr($nomerSPBU,0,1) !="3"){
    $errors[]="Format Nomer SPBU Tidak Valid";
}
if(count($errors)==0) {
    $gp=$db->get('ms_gp','*',[ "AND" =>
			[
        'nomer_spbu'=>$nomerSPBU,
				'group'=>$group
			]
		]);
    if($week<3){
        if(!$gp){
            if($nomerSPBU=='0000000'){
                $db->insert('ms_gp',array(
                    'nama'=>'Samsung S7',
                    'nomer_spbu'=>$nomerSPBU,
                    'minggu_ke'=>$week,
                    'group'=>$group,
                    'total'=>1
                ));
            }
            $db->insert('ms_gp',array(
                'nama'=>'Kemeja Turbo',
                'nomer_spbu'=>$nomerSPBU,
                'minggu_ke'=>$week,
                'group'=>$group,
                'total'=>10
            ));
            $db->insert('ms_gp',array(
                'nama'=>'Polo Shirt Turbo',
                'nomer_spbu'=>$nomerSPBU,
                'minggu_ke'=>$week,
                'group'=>$group,
                'total'=>30
            ));
            $db->insert('ms_gp',array(
                'nama'=>'Voucher Belanja 50K',
                'nomer_spbu'=>$nomerSPBU,
                'minggu_ke'=>$week,
                'group'=>$group,
                'total'=>30
            ));
            $db->insert('ms_gp',array(
                'nama'=>'Voucher BBK 100K',
                'nomer_spbu'=>$nomerSPBU,
                'minggu_ke'=>$week,
                'group'=>$group,
                'total'=>3
            ));
            $db->insert('ms_gp',array(
                'nama'=>'Voucher BBK 10K',
                'nomer_spbu'=>$nomerSPBU,
                'minggu_ke'=>$week,
                'group'=>$group,
                'total'=>90
            ));
            $db->insert('ms_gp',array(
                'nama'=>'Pouch',
                'nomer_spbu'=>$nomerSPBU,
                'minggu_ke'=>$week,
                'group'=>$group,
                'total'=>100
            ));
        }
    }else{
        if(!$gp){
            if($nomerSPBU=='0000000'){
                $db->insert('ms_gp',array(
                    'nama'=>'Samsung S7',
                    'nomer_spbu'=>$nomerSPBU,
                    'minggu_ke'=>$week,
                    'group'=>$group,
                    'total'=>1
                ));
            }
            $db->insert('ms_gp',array(
                'nama'=>'Kemeja Turbo',
                'nomer_spbu'=>$nomerSPBU,
                'minggu_ke'=>$week,
                'group'=>$group,
                'total'=>1
            ));
            $db->insert('ms_gp',array(
                'nama'=>'Polo Shirt Turbo',
                'nomer_spbu'=>$nomerSPBU,
                'minggu_ke'=>$week,
                'group'=>$group,
                'total'=>3
            ));
            $db->insert('ms_gp',array(
                'nama'=>'Voucher Belanja 50K',
                'nomer_spbu'=>$nomerSPBU,
                'minggu_ke'=>$week,
                'group'=>$group,
                'total'=>3
            ));
            $db->insert('ms_gp',array(
                'nama'=>'Voucher BBK 100K',
                'nomer_spbu'=>$nomerSPBU,
                'minggu_ke'=>$week,
                'group'=>$group,
                'total'=>3
            ));
            $db->insert('ms_gp',array(
                'nama'=>'Voucher BBK 10K',
                'nomer_spbu'=>$nomerSPBU,
                'minggu_ke'=>$week,
                'group'=>$group,
                'total'=>18
            ));
            $db->insert('ms_gp',array(
                'nama'=>'Pouch',
                'nomer_spbu'=>$nomerSPBU,
                'minggu_ke'=>$week,
                'group'=>$group,
                'total'=>20
            ));
        }
    }
    if (!$spbu) {
//        $dataSPBU = array(
//            'nama' => $namaSPBU,
//            'nomer' => $nomerSPBU
//        );
//        $insert = $db->insert('ms_spbu', $dataSPBU);
//        if ($insert) {
//            $user_sessions->set('errors', array());
//            $user_sessions->set('nomerSPBU', $nomerSPBU);
//            header('location:../form-data.php');
//        } else {
//            $errors[] = "DB Error Contact (ADMIN). (".extractError($db->error()).")";
//            $user_sessions->set('errors', $errors);
//            $user_sessions->set('input', $_POST);
//            header('location:../form-spbu.php');
//        }
        $errors[] = "SPBU Tidak Terdaftar Kontak Admin";
        $user_sessions->set('errors', $errors);
        $user_sessions->set('input', $_POST);
        header('location:../form-spbu.php');
    } else {
        $user_sessions->set('nomerSPBU', $nomerSPBU);
        header('location:../form-data.php');
    }
}else{
    $user_sessions->set('errors', $errors);
    $user_sessions->set('input', $_POST);
    header('location:../form-spbu.php');
}