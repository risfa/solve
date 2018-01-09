<?php
	ob_start();
	error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT );
	include "db/db.php";
	
	date_default_timezone_set("Asia/Jakarta");
		
	$jawab = $_POST['jawaban1'];
	$jawab1 = $_POST['jawaban2'];
	
	if($_SESSION['score'] == 0)
	{
			$data_jawaban = array();
			$data_jawaban[] = $jawab;
			$data_jawaban[] = $jawab1;
			
			$jawaban = json_encode($data_jawaban);

			$string_insert = "insert into ms_member(name, email, gender, phone, paket, twitter, event_name, jawaban, spg_name) values('".$name."', '".$email."', '".$gender."', '".$phone."', '".$paket."', '".$twitter."', '".$_SESSION['event_name']."', '".$jawaban."', '".$_SESSION['spg_name']."')";
			$query_insert = mysql_query($string_insert) or die(mysql_error());
			
			$string_insert = "insert into tr_penjualan(spg_name, leader_name, harga, cust_name, gender, event_name, paket, date) values('".$_SESSION['spg_name']."', '".$_SESSION['leader_name']."', '".$_SESSION['harga']."', '".$name."', '".$gender."', '".$_SESSION['event_name']."', '".$paket."', now())";
			$query_insert = mysql_query($string_insert) or die(mysql_error());
			
			header("location:../thanks.php");

	}
	else
	{
			$data_jawaban = array();
			$data_jawaban[] = $jawab;
			$data_jawaban[] = $jawab1;
			
			$jawaban = json_encode($data_jawaban);
			$_SESSION['jawaban'] = $jawaban;
			
			header('location:../attention.php');
	}
	
	
?>