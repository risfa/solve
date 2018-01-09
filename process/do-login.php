<?php
	include "db/db.php";
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	if($username == "" || $username == NULL)
	{
		$_SESSION['error'] = "Username tidak boleh kosong";
		header("location:../login.php");
	}
	else if($password == "" || $password == NULL)
	{
		$_SESSION['error'] = "Password tidak boleh kosong";
		header("location:../login.php");
	}
	else
	{
		$string = "select * from ms_spg where spg_name = '".$username."' and password = '".md5($password)."' ";
		$query = mysql_query($string) or die(mysql_error());
		
		if($rs = mysql_fetch_array($query))
		{
			$_SESSION['spg_id'] = $rs['spg_id'];
			$_SESSION['leader_name'] = $rs['leader_name'];
			$_SESSION['spg_name'] = $rs['spg_name'];
			$_SESSION['event_name'] = $rs['event_name'];
			$_SESSION['poin'] = $rs['poin'];
			$_SESSION['flag'] = 'login';

			$string_event = "select * from ms_event where event_name = '".$rs['event_name']."'";
			$query_event = mysql_query($string_event);
			
			if($rs_event = mysql_fetch_array($query_event))
			{
				$_SESSION['flag_location'] = $rs_event['location'];
			}
			
			if($rs['spg_name'] == "spgsamsung")
			{
				header("location:../preindex.php");
			}
			else
			{
				header("location:../index.php");
			}
		}
		else
		{
			$_SESSION['error'] = "Username atau Password belum terdaftar";
			header("location:../login.php");
		}
	}
?>