<?php
require_once '../config.php';
$week=$user_sessions->get('week');
$spbuActive=$user_sessions->get('nomerSPBU');
$errors=array();
$nama=((isset($_POST['nama']))? $_POST['nama'] : "");
$email=((isset($_POST['email']))? $_POST['email'] : "");
$noHP=((isset($_POST['noHP']))? str_replace(" ","",$_POST['noHP']) : "");
$merkKendaraan=((isset($_POST['merkKendaraan']))? $_POST['merkKendaraan'] : "");
$tipeKendaraan=((isset($_POST['tipeKendaraan']))? $_POST['tipeKendaraan'] : "");
$jenisProduk=((isset($_POST['jenisProduk']))? $_POST['jenisProduk'] : "");
$nominal=(int)((isset($_POST['nominal']))? str_replace(",","",$_POST['nominal']) : "");
// if(empty($nama) or empty($email) or empty($noHP) or empty($merkKendaraan) or empty($tipeKendaraan) or empty($jenisProduk) or empty($nominal)){
if(empty($nama) or empty($noHP) or empty($merkKendaraan) or empty($jenisProduk) or empty($nominal)){
    $errors[]="Isi Data Dengan Lengkap";
}
if(!preg_match("/^[0-9]{9,13}/",$noHP) || substr($noHP,0,2) !="08"){
    $errors[]="Nomer HP Tidak Valid";
}
// if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
    // $errors[]="Email Tidak Valid";
// }
if (!preg_match("/^[a-zA-Z \.\'\,]*$/",$nama)) {
    $errors[]="Nama Harus Huruf";
}
if($nominal<200000){
    $errors[]="Pembelian Minimal Rp. 200.000 ";
}
if(count($errors)==0){
    $data=array(
        'nama'=>$nama,
        'email'=>$email,
        'noHP'=>$noHP,
        'merkKendaraan'=>$merkKendaraan,
        'typeKendaraan'=>$tipeKendaraan,
        'produk'=>$jenisProduk,
        'nominal'=>$nominal,
        'minggu_ke'=>$week,
        'spbu'=>$spbuActive,
        'spg_id'=>$user_sessions->get('spg_id'),
        'finger_print'=>uniqid()
    );
    $insert=$db->insert('ms_peserta',$data);
    if($insert){
        $user_sessions->set('input', array());
        $user_sessions->set('currentPeserta', $data);
        header('location:../attention.php');
    }else{
        $errors[] = "DB Error Contact (ADMIN). (".extractError($db->error()).")";
        $user_sessions->set('errors', $errors);
        $user_sessions->set('input', $_POST);
        header('location:../form-data.php');
    }
}else{
    $user_sessions->set('errors', $errors);
    $user_sessions->set('input', $_POST);
    header('location:../form-data.php');
}