<?php
include '/home/dapps/public_html/solve/javindo_tcash/config.php';
$action=$_GET['action'];
switch ($action){
    case 'insert_user' :
        insert_user();
        header('location:../form-data.php?action='.$action);
        break;
    case 'insert_merchant' :
        insert_merchant();
        header('location:../form-data.php?action='.$action);
        break;
}
function insert_user(){
    $noHp=($_POST['noHP']!="" ? $_POST['noHP'] : FALSE);
    $topUp=($_POST['topUp']!="" ? $_POST['topUp'] : FALSE);
    $serialSticker=($_POST['serialSticker']!="" ? $_POST['serialSticker'] : FALSE);
    $gimmick=($_POST['gimmik']!="" ? $_POST['gimmik'] : 'N');    
	$error=array();
	// echo $noHP;
	// echo strlen($noHP);die;
    if($noHp==FALSE){
        $error['error_noHP']="Nomer Hp Harus Diisi";
    }
	else if(!is_numeric($noHp)){
		$error['error_noHP']="Nomer Hp Harus Angka";
	}
	else if(substr($noHp,0,2) !="08"){
		$error['error_noHP']="Nomor hp harus diawali (08)xxxx";
	}
	else if(strlen($noHp) < 10) {
		$error['error_noHP']="Nomor hp minimal 10 digit";
	}	
    if($topUp==FALSE){
        $error['topUp']="Pilih Jumlah Top Up";
    }
    if($serialSticker==FALSE){
        $error['serialSticker']="Serial Sticker Harus Diisi";
    }
	else if(preg_match("/[-!$%^&*()_+|~=`{}\[\]:;'<>?,.\/]/", $serialSticker))
	{
		$error['serialSticker']="Serial Sticker Tidak Boleh Memiliki Simbol";
	}
    $GLOBALS['user_sessions']->set("error_insert",$error);
    if(count($error)==0){
		if($topUp >= 50000){
			$gimmick=1;
		}
		else{
			$gimmick=0;
		}        
        $data=array(
          'hp'=>$noHp,
          'top_up'=>$topUp,
          'no_serial'=>$serialSticker,
          'gimmick'=>$gimmick,
          'spg_id'=>$GLOBALS['user_sessions']->get('spg_id'),
          'admin_id'=>$GLOBALS['user_sessions']->get('admin_id'),
          'admin_name'=>$GLOBALS['user_sessions']->get('admin_name'),
          'created'=>date('Y-m-d H:i:s'),
          'created_by'=>$GLOBALS['user_sessions']->get('username')
        );
        $GLOBALS['db']->insert('ms_user',$data);
        $GLOBALS['user_sessions']->set("success_insert","Data Telah Tersimpan");
    }else{
        $GLOBALS['user_sessions']->set("success_insert","");
        $input=array(
            'hp'=>$noHp,
            'top_up'=>$topUp,
            'no_serial'=>$serialSticker,
            'gimmick'=>$gimmick);
        $GLOBALS['user_sessions']->set("user_input",$input);
    }
}
function insert_merchant(){
    $nama_toko=($_POST['namaToko']!="" ? $_POST['namaToko'] : FALSE);
    $kategori=($_POST['kategori']!="" ? $_POST['kategori'] : FALSE);
    $namaPemilik=($_POST['namaPemilik']!="" ? $_POST['namaPemilik'] : FALSE);
    $tertarik=($_POST['tertarik']!="" ? $_POST['tertarik'] : '');
    $noHp=($_POST['noHP']!="" ? $_POST['noHP'] : FALSE);
    $ktp=($_POST['ktp']!="" ? $_POST['ktp'] : FALSE);
    $error=array();
    if($nama_toko==FALSE){
        $error['error_namaToko']="Nama Toko Harus Diisi";
    }
    if($kategori==FALSE){
        $error['error_kategori']="Pilih Kategori";
    }
    if($namaPemilik==FALSE){
        $error['error_namaPemilik']="Nama Pemilik Harus Diisi";
    }
	else if(!preg_match("/^[a-zA-Z\s]+$/", $namaPemilik))
	{
		$error['error_namaPemilik']="Nama Pemilik Harus Huruf";
	}
    if($noHp==FALSE){
        $error['error_noHP']="Nomor HP Harus Diisi";
    }
	else if(!is_numeric($noHp)){
		$error['error_noHP']="Nomer Hp Harus Angka";
	}
	else if(substr($noHp,0,2) !="08"){
		$error['error_noHP']="Nomor hp harus diawali (08)xxxx";
	}
	else if(strlen($noHp) < 10) {
		$error['error_noHP']="Nomor hp minimal 10 digit";
	}
	if($ktp==FALSE){
        $error['error_ktp']="Nomor KTP Harus Diisi";
    }
	else if(!is_numeric($ktp)){
        $error['error_ktp']="Nomor KTP Harus Angka";
    }
	if($tertarik==""){
        $error['error_tertarik']="Tertarik harus dipilih";
    }
    $GLOBALS['user_sessions']->set("error_insert",$error);
    if(count($error)==0){
        $tertarik=($tertarik=="Y" ? 1 : 0);
        $data=array(
            'nama_toko'=>$nama_toko,
            'kategori'=>$kategori,
            'nama_pemilik'=>$namaPemilik,
            'hp'=>$noHp,
            'ktp'=>$ktp,
            'tertarik'=>$tertarik,
            'spg_id'=>$GLOBALS['user_sessions']->get('spg_id'),
            'admin_id'=>$GLOBALS['user_sessions']->get('admin_id'),
            'admin_name'=>$GLOBALS['user_sessions']->get('admin_name'),
            'created'=>date('Y-m-d H:i:s'),
            'created_by'=>$GLOBALS['user_sessions']->get('username')
        );
        $GLOBALS['db']->insert('ms_merchant',$data);
        $GLOBALS['user_sessions']->set("success_insert","Data Telah Tersimpan");
    }else{
        $input=array(
            'nama_toko'=>$nama_toko,
            'kategori'=>$kategori,
            'nama_pemilik'=>$namaPemilik,
            'hp'=>$noHp,
            'ktp'=>$ktp,
            'tertarik'=>$tertarik);
        $GLOBALS['user_sessions']->set("user_input",$input);
        $GLOBALS['user_sessions']->set("success_insert","");
    }

}