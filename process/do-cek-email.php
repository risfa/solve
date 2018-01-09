<?php
	include "db/db.php";
	
	$phone = $_POST['phone'];
	
	if($phone == "" || $phone == NULL)
	{
		header("location:../cek-phone.php?error=-Phone must be fill-");
	}
	else
	{
		$string = "select * from ms_member where phone = '".$phone."'";
		$query = mysql_query($string) or die(mysql_error($string));
		
		if($rs = mysql_fetch_array($query))
		{
			$_SESSION['spg_id'] = $rs['spg_id'];
			$_SESSION['leader_name'] = $rs['leader_name'];
			$_SESSION['spg_name'] = $rs['spg_name'];
			$_SESSION['event_name'] = $rs['event_name'];
			$_SESSION['poin'] = $rs['poin'];
			$_SESSION['name'] = $rs['name'];
			$_SESSION['email'] = $rs['email'];
			$_SESSION['phone'] = $rs['phone'];
			$_SESSION['gender'] = $rs['gender'];
			$_SESSION['twitter'] = $rs['twitter'];
			$_SESSION['ktp'] = $rs['ktp'];
			
			// user masukin hp -> simpen semua session yang dibutuhin -> isi product -> ruffle -> lgsg thx
			
			// echo $rs['poin']."<br>";
			// echo $rs['name']."<br>";
			// echo $rs['email']."<br>";
			// echo $rs['phone']."<br>";
			// echo $rs['gender']."<br>";die;
			
			
			if($rs['spg_name'] == "spgsamsung")
			{
				header("location:../question.php");
			}
			else
			{
				header("location:../paket.php");
			}
			
		}
		else
		{
			header("location:../cek-phone.php?error=*-phone not found-");
		}
	}		
	
?>