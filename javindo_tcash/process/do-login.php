<?php
	require_once "../config.php";
	
	$username = $_POST["username"];
	$password = $_POST["password"];
	
	$datas = $db->select("ms_spg", "*", [
		"AND" => [
		"username" => $username,
		"password" => md5($password)
		]
	]);
		
	
	if(!empty($datas))
	{
		
		foreach($datas as $data){
						
			$db->update("ms_spg",[
				"last_login"=>date('Y-m-d H:i:s')
			],[
				"username" => $username
			]);
			
			$user_sessions->set('admin_id',$data['admin_id']);
			$user_sessions->set('spg_id',$data['spg_id']);
			$user_sessions->set('admin_name',$data['created_by']);
			$user_sessions->set('username',$data['username']);

			header("location:../form-data.php");
						
		}
		
	}
	else{		
		$user_sessions->set('error','Username dan Password belum terdaftar');
		header("location:../login.php");
		
	}
	
	
?>