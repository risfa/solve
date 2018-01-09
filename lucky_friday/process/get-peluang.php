<?php
require_once '../config.php';
$week=$user_sessions->get('week');
$group=$user_sessions->get('group');
$peserta=$user_sessions->get('currentPeserta');
$produk=$peserta['produk'];
if($produk=="Pertamax Turbo"){
    $dataHadiah=$db->select('hadiah_turbo','*',[
        'AND'=>array(
            'minggu_ke'=>$week,
            'spbu'=>$peserta['spbu'],
            'group'=>$group
        )
    ]);
    $total=0;
    $hadiahList=array();
    $hadiah=array();
    foreach ($dataHadiah as $d){
        $total+=$d['total'];
        $n=$d['nama'];
        $hadiah[$n]=$d['total'];
    }
    if(isset($hadiah['Samsung S7'])){
        if($hadiah['Samsung S7']>0){
            for($i=1;$i<=100;$i++){
                $hadiahList[]='Samsung S7';
            }
        }else{
            foreach ($hadiah as $k => $v) {
                $hadiah[$k] = round(($v / $total) * 100);
                if ($hadiah[$k] < 1 and $v != 0) {
                    $hadiahList[] = $k;
                } else {
                    while ($hadiah[$k] > 0) {
                        $hadiahList[] = $k;
                        $hadiah[$k] -= 1;
                    }
                }
            }
         }
    }else {
        foreach ($hadiah as $k => $v) {
            $hadiah[$k] = round(($v / $total) * 100);
            if ($hadiah[$k] < 1 and $v != 0) {
                $hadiahList[] = $k;
            } else {
                while ($hadiah[$k] > 0) {
                    $hadiahList[] = $k;
                    $hadiah[$k] -= 1;
                }
            }
        }
    }
    echo json_encode($hadiahList);
}else{
    $dataHadiah=$db->select('hadiah_non_turbo','*',[
        'AND'=>array(
            'minggu_ke'=>$week,
            'spbu'=>$peserta['spbu'],
            'group'=>$group
        )
    ]);
    $total=0;
    $hadiahList=array();
    $hadiah=array();
    foreach ($dataHadiah as $d){
        $total+=$d['total'];
        $n=$d['nama'];
        $hadiah[$n]=$d['total'];
    }
    foreach ($hadiah as $k=>$v){
        $hadiah[$k]=round(($v/$total)*100);
        if($hadiah[$k]<1 and $v!=0){
            $hadiahList[]=$k;
        }else{
            while ($hadiah[$k]>0){
                $hadiahList[]=$k;
                $hadiah[$k]-=1;
            }
        }
    }
    echo json_encode($hadiahList);
}