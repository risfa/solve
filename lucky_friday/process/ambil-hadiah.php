<?php
require_once '../config.php';
$week=$user_sessions->get('week');
$group=$user_sessions->get('group');
$peserta=$user_sessions->get('currentPeserta');
$hadiah=$_POST['hadiah'];
$db->update('ms_peserta',array(
   'ruffle'=>'Y',
   'hadiah'=>$hadiah
),[
    'finger_print'=>$peserta['finger_print']
]);
$gp=$db->get('ms_gp','*',[
    'AND'=>[
        'minggu_ke'=>$week,
        'group'=>$group,
        'nama'=>$hadiah,
        'total[!]'=>0
    ]
]);
$result=$db->update('ms_gp',array(
    'total[-]'=>1
),array('location_id'=>$gp['location_id']));
if($result){
    echo "berhasil";
}else{
    echo "gagal ".$db->error()[1];
}
