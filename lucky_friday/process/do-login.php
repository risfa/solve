<?php
	require_once "../config.php";
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	$week = $_POST["week"];
	$datas = $db->select("ms_spg", "*", [
		"AND" => [
		"username" => $username,
		"password" => md5($password)
		]
	]);
	if(!empty($datas))
	{
		if((isset($week) and $week!="")) {
            foreach ($datas as $data) {

                $db->update("ms_spg", [
                    "last_login" => date('Y-m-d H:i:s')
                ], [
                    "username" => $username
                ]);

                $user_sessions->set('admin_id', $data['admin_id']);
                $user_sessions->set('spg_id', $data['spg_id']);
                $user_sessions->set('admin_name', $data['created_by']);
                $user_sessions->set('username', $data['username']);
                $user_sessions->set('group', $data['created_by']);
                $user_sessions->set('week', $week);

                header("location:../form-spbu.php");

            }
		}else{
				$user_sessions->set('error','Hari Ini Tidak Ada Jadwal SPBU');
				header("location:../login.php");
		}
	}
	else{		
		$user_sessions->set('error','Username dan Password belum terdaftar / Terblokir');
		header("location:../login.php");
		
	}
	
	
?>