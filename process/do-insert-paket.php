<?php
	include "db/db.php";
	
	$temp = array();
	$produk1 = $_POST['produk1'];
	$produk2 = $_POST['produk2'];
	
	if($produk1 == "choose" && $produk2 == "choose")
	{
		$_SESSION['error'] = "Maaf, produk harus dipilih.";
		header("location:../paket.php");
	}
	else if($produk1 == "Enduro Matic" && $produk2 == "Enduro Racing")
	{
		$_SESSION['error'] = "Maaf, cukup 1 paket Enduro saja untuk bisa mengikuti ruffle.";
		header("location:../paket.php");
	}
	else if($produk1 == "Enduro Racing" && $produk2 == "Enduro Matic")
	{
		$_SESSION['error'] = "Maaf, cukup 1 paket Enduro saja untuk bisa mengikuti ruffle.";
		header("location:../paket.php");
	}
	else if($produk1 == "choose" && $produk2 == "JF Sulfur-Buy 1 get 1")
	{
		$_SESSION['error'] = "Maaf, paket tidak sesuai dengan ketentuan.";
		header("location:../paket.php");
	}
	else if($produk1 == "choose" && $produk2 == "JF Sulfur-Paket Mudik")
	{
		$_SESSION['error'] = "Maaf, paket tidak sesuai dengan ketentuan.";
		header("location:../paket.php");
	}
	else if($produk1 == "choose" && $produk2 == "Paket Aromatic")
	{
		$_SESSION['error'] = "Maaf, paket tidak sesuai dengan ketentuan.";
		header("location:../paket.php");
	}
	else if($produk1 == "choose" && $produk2 == "Paket Fitoxy")
	{
		$_SESSION['error'] = "Maaf, paket tidak sesuai dengan ketentuan.";
		header("location:../paket.php");
	}
	else if($produk1 == "JF Sulfur-Buy 1 get 1" && $produk2 == "choose")
	{
		$_SESSION['error'] = "Maaf, paket tidak sesuai dengan ketentuan.";
		header("location:../paket.php");
	}
	else if($produk1 == "JF Sulfur-Paket Mudik" && $produk2 == "choose")
	{
		$_SESSION['error'] = "Maaf, paket tidak sesuai dengan ketentuan.";
		header("location:../paket.php");
	}
	else if($produk1 == "Paket Aromatic" && $produk2 == "choose")
	{
		$_SESSION['error'] = "Maaf, paket tidak sesuai dengan ketentuan.";
		header("location:../paket.php");
	}
	else if($produk1 == "Paket Fitoxy" && $produk2 == "choose")
	{
		$_SESSION['error'] = "Maaf, paket tidak sesuai dengan ketentuan.";
		header("location:../paket.php");
	}
	else
	{
	
		//Hitung harga
		$harga = "";
	
		$string_paket = "select * from ms_paket where event_name = '".$_SESSION['event_name']."'";
		$query_paket = mysql_query($string_paket) or die(mysql_error());
		
		while($rs_paket = mysql_fetch_array($query_paket))
		{
			if($rs_paket['paket'] == $_POST['produk1'])
			{
				$harga = $rs_paket['harga'];
			}
			
			if($rs_paket['paket'] == $_POST['produk2'])
			{
				$harga = $harga + $rs_paket['harga'];
			}
		}
		
		$_SESSION['totalHargaPaket'] = $harga;
		
		//endHitung harga
		
		$temp[] = $produk1;
		$temp[] = $produk2;
		
		$_SESSION['paket'] = json_encode($temp);
		
		$_SESSION['produk1'] = $produk1;
		$_SESSION['produk2'] = $produk2;
		$_SESSION['flag'] = "index";
		header("location:../attention.php");
	}		
	
?>