<?php
	ob_start();
	error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT );
	include "db/db.php";
	require_once '../twitter/src/codebird.php';
	require_once '../includes/functions.php';
	\Codebird\Codebird::setConsumerKey('8RYrkVF9EaHHqRcCmdHvoh6yH','lUk9iXmEVDG9PoTxPokZRbg4E63XeBE2r9iqtX4MJKwFqVqNON');
	$cb = \Codebird\Codebird::getInstance();
	date_default_timezone_set("Asia/Jakarta");
	
	//echo "asd";die;
	$name = $_POST["name"];
	$_SESSION['name'] = $_POST["name"];
	$email = $_POST["email"];
	$_SESSION['email'] = $_POST["email"];
	$produk1 = $_POST["produk1"];
	$kode = $_POST["voucher_id"];
	$_SESSION['produk1'] = $_POST["produk1"];
	$produk2 = $_POST["produk2"];
	$nomor_nota = $_POST["nomor_nota"];
	$_SESSION['produk2'] = $_POST["produk2"];
	$gender = $_POST["gender"];
	$_SESSION['gender'] = $_POST["gender"];
	$phone = $_POST["phone"];
	$_SESSION['phone'] = $_POST["phone"];
	$twitter = (preg_match("/^@/",$_POST["twitter"])) ? $_POST['twitter'] : "@posko".$_SESSION['spg_name'];
	$rand = rand(0,4);
	$date = date('Y-m-d H:i:s');
	//samsung
	$jawab = $_POST['jawaban1'];
	$jawab1 = $_POST['jawaban2'];
	$add = $_POST['address'];
	//end samsung
	

	

	if($produk1 == "choose" && $produk2 == "choose")
	{
		if($kode=="") {
			$_SESSION['error'] = "Maaf, produk harus dipilih.";
			header("location:../index.php");
		}
	}
	else if($produk1 == "Enduro Matic" && $produk2 == "Enduro Racing")
	{
		$_SESSION['error'] = "Maaf, cukup 1 paket Enduro saja untuk bisa mengikuti ruffle.";
		header("location:../index.php");
	}
	else if($produk1 == "Enduro Racing" && $produk2 == "Enduro Matic")
	{
		$_SESSION['error'] = "Maaf, cukup 1 paket Enduro saja untuk bisa mengikuti ruffle.";
		header("location:../index.php");
	}
	else if($produk1 == "choose" && $produk2 == "JF Sulfur-Buy 1 get 1")
	{
		$_SESSION['error'] = "Maaf, paket tidak sesuai dengan ketentuan.";
		header("location:../index.php");
	}
	else if($produk1 == "choose" && $produk2 == "JF Sulfur-Paket Mudik")
	{
		$_SESSION['error'] = "Maaf, paket tidak sesuai dengan ketentuan.";
		header("location:../index.php");
	}
	else if($produk1 == "choose" && $produk2 == "Paket Aromatic")
	{
		$_SESSION['error'] = "Maaf, paket tidak sesuai dengan ketentuan.";
		header("location:../index.php");
	}
	else if($produk1 == "choose" && $produk2 == "Paket Fitoxy")
	{
		$_SESSION['error'] = "Maaf, paket tidak sesuai dengan ketentuan.";
		header("location:../index.php");
	}
	else if($produk1 == "JF Sulfur-Buy 1 get 1" && $produk2 == "choose")
	{
		$_SESSION['error'] = "Maaf, paket tidak sesuai dengan ketentuan.";
		header("location:../index.php");
	}
	else if($produk1 == "JF Sulfur-Paket Mudik" && $produk2 == "choose")
	{
		$_SESSION['error'] = "Maaf, paket tidak sesuai dengan ketentuan.";
		header("location:../index.php");
	}
	else if($produk1 == "Paket Aromatic" && $produk2 == "choose")
	{
		$_SESSION['error'] = "Maaf, paket tidak sesuai dengan ketentuan.";
		header("location:../index.php");
	}
	else if($produk1 == "Paket Fitoxy" && $produk2 == "choose")
	{
		$_SESSION['error'] = "Maaf, paket tidak sesuai dengan ketentuan.";
		header("location:../index.php");
	}
	else if($name == "" || $name== NULL)
	{
		$_SESSION['error'] = "Nama harus diisi.";
		header("location:../index.php");
	}
	/*else if($email == "" || $email == NULL)
	{
		$_SESSION['error'] = "Email must be fill.";
		header("location:../index.php");
	}*/
	else if($gender == "" || $gender == NULL)
	{
		$_SESSION['error'] = "Gender harus diisi.";
		header("location:../index.php");
	}
	else if($phone == "" || $phone == NULL)
	{
		$_SESSION['error'] = "Telepon harus diisi.";
		header("location:../index.php");
	}
	else if(!preg_match('/^08/', $phone))
	{
		$_SESSION['error'] = "Telepon harus diawali dengan '08xx'.";
		header("location:../index.php");
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
		
		$message = preg_replace('/\[mention\]/',$twitter,$config['wording'][$rand]);
		if($twitter != "@"){
			autopost($config['twitter_key'],$config['twitter_secret'],$message);
		}
		
		$to      = $email;
		$subject = 'LESEHAN ENDURO 2016';
		$message = '
								Halo Pelanggan Pertamina Lubricants,<br>
								Terimakasih telah menjadi bagian dari kegiatan Lesehan Enduro 2016.<br> 
								Dalam menyemarakkan bulan Ramadhan dan Hari Raya Idul Fitri 1437 H, Pertamina Lubricants selama 11 tahun secara rutin kembali menyelenggarakan kegiatan sbb:<br><br>
								
								<h2>PAKET KETUPAT ENDURO</h2>
								
								Pertamina Lubricants kembali menyediakan paket eksklusif mewah dengan harga murah selama bulan Ramadhan. Paket yang hadir berkat kerja sama dengan beberapa co-sponsor ini dijual dengan harga murah namun dengan isi beraneka ragam yang bermanfaat bagi para pelanggan setianya yang akan melakukan perjalanan mudik.<br><br>
								
								Hanya dengan <b>Rp 50.000,- untuk Paket Eksklusif Enduro Racing dan Rp 45.000,- untuk Paket Eksklusif Enduro Matic</b>, pelanggan bisa mendapatkan 14 item yang harga aslinya senilai Rp 138.000, berupa: 1 botol Pelumas Enduro Racing/Matic, Sabun JF Sulfur, Sabun Oilum, Minyak Angin Aromatherapy Aromatic, Hansaplast koyo, Air mineral Bright, Kacang Bright, Snack Taro, Biskuit Duoz, Mie Kremezz, Permen Gulas, Masker, Peta mudik, dan Voucher yang dapat ditukar dengan hadiah menarik dan kupon hadiah langsung untuk menikmati fasilitas yang ada di Posko Lesehan Enduro.<br><br>
								
								Paket ini bisa dibeli di bengkel Enduro Pertamina wilayah Jabodetabek, jaringan Bright Store area Jabodetabek dan Posko Lesehan Enduro sejak tanggal 22 Juni hingga 5 Juli 2016.<br><br>
								
								<h2>POSKO LESEHAN ENDURO</h2>
								
								Budaya mudik sudah menjadi bagian yang tidak dapat dipisahkan dari perayaan Lebaran di Indonesia. Dari tahun ke tahun pemudik motor terus mengalami peningkatan, padahal resikonya tinggi jika melakukan perjalanan panjang dengan kendaraan bermotor roda dua.<br><br>
								
								Menyadari hal ini dan menyadari pentingnya waktu beristirahat bagi pemudik kendaraan bermotor roda dua, Pertamina Lubricants kembali menyediakan Posko Lesehan Enduro sebagai posko tempat beristirahat yang memiliki berbagai manfaat. Posko Lesehan Enduro ini akan siaga selama 24 Jam mulai tanggal 1 Juli hingga 5 Juli 2016 di 4 titik strategis arus mudik di sepanjang jalur Pantura dan Selatan, yaitu:<br>
								<ul>
									<li>Masjid Jami Shirothol Mustaqim Karang Layung, Sukra, Indramayu, Jawa Barat</li>
									<li>Masjid Jami At Tuqo, Ds. Citemu, Mundu, Cirebon, Jawa Barat</li>
									<li>SPBU 44 .524 01 Prupuk, Jl. Raya Kaligayem, Kab. Tegal, Jawa Tengah</li>
									<li>RM Pananjung 1 , Jl. Raya Jamanis Km. 17, Tasikmalaya, Jawa Barat</li>
								</ul>
								<br><br>
								
								Ada berbagai fasilitas gratis yang tersedia di posko ini, yaitu: tempat istirahat, ta’jil, service motor ringan, pijat radisional, medis ringan, ruang bermain anak, games serta hadiah langsung. Beberapa fasilitas beroperasi pada jam-jam tertentu. Dengan mengusung tagline “Motor Sehat, Badan Sehat”, Posko Lesehan Enduro diberikan secara cuma-cuma bagi para pemudik agar dapat beristirahat dengan baik dan melakukan pengecekan kondisi motor sehingga dapat melanjutkan perjalanannya dengan nyaman dan aman.<br><br>
								
								Terimakasih.<br>
								Semoga perjalanan mudik Anda berjalan sesuai dengan harapan Anda.<br>
								Salam hangat untuk keluarga Anda.<br><br>
								
								Salam,<br>
								Pertamina Lubricants.<br>
								Twitter: @pertaminalub<br>
								Facebook: https://www.facebook.com/Pertamina-Lubricants-1760702180870862/?ref=br_rs<br>
								Website: http://pertaminalubricants.com/id<br>
		';
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		$headers .= 'From: lesehanenduro@gmail.com' . "\r\n" .
			'Reply-To: lesehanenduro@gmail.com' . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		if($email != "") $a = mail($to, $subject, $message, $headers);
		
		//$send = sendmail($email,$subject,$message);
		$string_update = "update ms_vouchers set enabled='N' where voucher_id='".$kode."'";
		$query_update= mysql_query($string_update) or die(mysql_error());

//		if(isset($produk1) || isset($produk2))
		if(isset($produk1))
		{
			if(strtolower($_SESSION['event_name']) == strtolower("Lesehan Enduro") || strtolower($_SESSION['event_name']) == strtolower("Lesehan Enduro 2016")) {

				$string_cek_phone = "select * from ms_member where phone = '".$phone."'";
				$query_cek_phone = mysql_query($string_cek_phone);
				
				if($rs_cek_phone = mysql_fetch_array($query_cek_phone))
				{
					$_SESSION['error'] = "Nomor telepon sudah pernah digunakan. Silahkan gunakan nomor lain.";
					header("location:../index.php");
				}
				else
				{
					$_SESSION['name'] = $name;
					$_SESSION['email'] = $email;
					$_SESSION['produk1'] = $produk1;
					$_SESSION['produk2'] = $produk2;
					$_SESSION['gender'] = $gender;
					$_SESSION['phone'] = $phone;
					$_SESSION['twitter'] = $twitter;
					$_SESSION['flag'] = "index";
					$_SESSION['kode'] = $kode;
					$_SESSION['nomor_nota'] = $nomor_nota;

					header('location:../attention.php');
				}
				
				
				
				
			}else{
				$string_insert = "insert into ms_member(name, email, gender, phone, paket, twitter, event_name, jawaban, spg_name, leader_name, created,voucher_id) values('".$name."', '".$email."', '".$gender."', '".$phone."', '".$paket."', '".$twitter."', '".$_SESSION['event_name']."', '".$_SESSION['jawaban']."', '".$_SESSION['spg_name']."', '".$_SESSION['leader_name']."', '".$date."',''".$kode."'')";
				$query_insert = mysql_query($string_insert) or die(mysql_error());

				$string_insert = "insert into tr_penjualan(spg_name, leader_name, harga, cust_name, gender, event_name, paket, date) values('".$_SESSION['spg_name']."', '".$_SESSION['leader_name']."', '".$_SESSION['harga']."', '".$name."', '".$gender."', '".$_SESSION['event_name']."', '".$paket."', '".$date."')";
				$query_insert = mysql_query($string_insert) or die(mysql_error());
				
				header("location:../thanks.php");
			}
			
			
		}
		//samsung
		// else if($_SESSION['score'] == 1)
		// {
			// $data_jawaban = array();
			// $data_jawaban[] = $jawab;
			// $data_jawaban[] = $jawab1;
			
			// $jawaban = json_encode($data_jawaban);

			// $string_insert = "insert into ms_member(name, email, gender, phone, paket, twitter, event_name, jawaban, spg_name) values('".$name."', '".$email."', '".$gender."', '".$phone."', '".$paket."', '".$twitter."', '".$_SESSION['event_name']."', '".$jawaban."', '".$_SESSION['spg_name']."')";
			// $query_insert = mysql_query($string_insert) or die(mysql_error());
			
			// $string_insert = "insert into tr_penjualan(spg_name, leader_name, harga, cust_name, gender, event_name, paket, date) values('".$_SESSION['spg_name']."', '".$_SESSION['leader_name']."', '".$_SESSION['harga']."', '".$name."', '".$gender."', '".$_SESSION['event_name']."', '".$paket."', now())";
			// $query_insert = mysql_query($string_insert) or die(mysql_error());
			
			// header("location:../thanks.php");
		// }
		// else if($_SESSION['score'] >= 1)
		// {
			// $data_jawaban = array();
			// $data_jawaban[] = $jawab;
			// $data_jawaban[] = $jawab1;
			
			// $jawaban = json_encode($data_jawaban);
			// $_SESSION['jawaban'] = $jawaban;
			// $_SESSION['name'] = $name;
			// $_SESSION['email'] = $email;
			// $_SESSION['paket'] = $paket;
			// $_SESSION['gender'] = $gender;
			// $_SESSION['phone'] = $phone;
			// $_SESSION['twitter'] = $twitter;
			// $_SESSION['jawab1'] = $jawab;
			// $_SESSION['jawab2'] = $jawab1;
			
			// header('location:../attention.php');
		// }
		//endsamsung
		else if(isset($add))
		{
			$_SESSION['name'] = $name;
			$_SESSION['email'] = $email;
			$_SESSION['paket'] = $paket;
			$_SESSION['gender'] = $gender;
			$_SESSION['phone'] = $phone;
			$_SESSION['twitter'] = $twitter;
			$_SESSION['add'] = $add;
			header('location:../permission.php');
		}
		else
		{
			$_SESSION['name'] = $name;
			$_SESSION['email'] = $email;
			$_SESSION['paket'] = $paket;
			$_SESSION['gender'] = $gender;
			$_SESSION['phone'] = $phone;
			$_SESSION['twitter'] = $twitter;
			
			header('location:../permission.php');
		}
		
		
		/*$string_insert = "insert into ms_member(name, email, ktp, gender, phone) values('".$name."', '".$email."', '".$ktp."', '".$gender."', '".$phone."')";
		$query_insert = mysql_query($string_insert) or die(mysql_error());
		
		$string = "select * from ms_member order by member_id DESC limit 0,1";
		$query = mysql_query($string) or die(mysql_error());
		
		if($rs = mysql_fetch_array($query))
		{
			echo $rs['name'];
		}*/
	}
	
	function autopost($key,$secret,$message){
		global $cb;
		$cb->setToken($key, $secret);
		$cek = $cb->statuses_update('status='.$message);
		// echo $key."<br/>";
		// echo $secret;
		// print_r($cek);die;
		// $cek2 = $cb->friendships_create(array("follow" => true, "screen_name" => "limadigitID", "user_id" => "1428145356"));
		//$cek2 = $cb->friendships_create(array("follow" => true, "screen_name" => "tommybatman", "user_id" => "57088022"));
		//print_r($cek2);die;
	}
?>