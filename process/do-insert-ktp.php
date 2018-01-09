<?php
	include "db/db.php";
	date_default_timezone_set("Asia/Jakarta");
	$date = date('Y-m-d H:i:s');
	require_once '../twitter/src/codebird.php';
	\Codebird\Codebird::setConsumerKey('Vu36hAFuwKNQrBIfmuZrQ','JjrBajTX1ml77JxbFuuUa2dloPvileO4rasPsX4rlYA');
	$cb = \Codebird\Codebird::getInstance();	
	if(isset($_SESSION['ktp']))
	{
		$ktp = $_SESSION['ktp'];
	}
	else
	{
		$ktp = $_POST['ktp'];
		if(strlen($ktp) < 8)
		{
			$_SESSION['error'] =  "-KTP must be 8 digit-";
			header("location:../ktp.php");
		}
	}
	
		
	$rand = rand(0,4);
	$message = $config['wording'][$rand];
	
	if($ktp == "" || $ktp == NULL)
	{
		$_SESSION['error'] =  "-KTP must be fill-";
		header("location:../ktp.php");
	}
	else
	{
		if(strtolower($_SESSION['event_name']) == strtolower("Lesehan Enduro") or strtolower($_SESSION['event_name']) == strtolower("Lesehan Enduro 2016")) {
		
		
			if($_SESSION['produk1'] != "choose" && $_SESSION['produk2'] != "choose")
			{
				$paket = 2;
			}
			else if($_SESSION['produk1'] != "choose" || $_SESSION['produk2'] != "choose")
			{
				$paket = 1;
			}
			else
			{
				$paket = 0;
			}
		
			$string_insert = "insert into ms_member(name, email, ktp, gender, phone, prize, product1, product2, paket, twitter, event_name, spg_name, leader_name, created) values('".$_SESSION['name']."', '".$_SESSION['email']."', '".$ktp."', '".$_SESSION['gender']."', '".$_SESSION['phone']."', '".$_SESSION['prize']."', '".$_SESSION['produk1']."', '".$_SESSION['produk2']."', '".$paket."', '".$_SESSION['twitter']."', '".$_SESSION['event_name']."', '".$_SESSION['spg_name']."', '".$_SESSION['leader_name']."', '".$date."')";
			$query_insert = mysql_query($string_insert) or die(mysql_error());
			
			$totalHarga = $_SESSION['totalHargaPaket'];
			
			
			$string_insert = "insert into tr_penjualan(spg_name, leader_name, harga, cust_name, gender, event_name, paket, date) values('".$_SESSION['spg_name']."', '".$_SESSION['leader_name']."', '".$totalHarga."', '".$_SESSION['name']."', '".$_SESSION['gender']."', '".$_SESSION['event_name']."', '".$paket."', '".$date."')";
			$query_insert = mysql_query($string_insert) or die(mysql_error());
			
		}else{
		
			$poin = $_SESSION['poin'] + 1;
			
			// echo $_SESSION['twitteroauth_key']."  ===  ".$_SESSION['twitteroauth_secret'];die;
			$string_insert = "insert into ms_member(name, email, ktp, gender, phone, prize, paket, twitter, event_name, jawaban, spg_name, leader_name, created, poin,fb_id, fbemail, fbpicture, fbtoken, twitter_id, twitter_name, twitteroauth_key, twitteroauth_secret,image) values('".$_SESSION['name']."', '".$_SESSION['email']."', '".$ktp."', '".$_SESSION['gender']."', '".$_SESSION['phone']."', '".$_SESSION['prize']."', '".$_SESSION['paket']."', '".$_SESSION['twitter']."', '".$_SESSION['event_name']."', '".$_SESSION['jawaban']."', '".$_SESSION['spg_name']."', '".$_SESSION['leader_name']."', '".$date."', '".$poin."','".$_SESSION["user_fbid"]."','".$_SESSION["user_email"]."','".$_SESSION["user_image"]."','".$_SESSION["tokenaccess"]."','".$_SESSION["twitter_id"]."','".$_SESSION["twitter_name"]."','".$_SESSION['oauth_token']."','".$_SESSION['oauth_token_secret']."','".$_SESSION['foto']."')";
			$query_insert = mysql_query($string_insert) or die(mysql_error());
			
			if($query_insert) {
				// echo 1;
				if($_SESSION['user_fbid'] && $_SESSION['user_fbid'] != "") {
					// echo 2;
					$message = preg_replace("/\[mention\]/",$_SESSION["fb_user_name"],$message);
					$graph_url= "https://graph.facebook.com/".$_SESSION['user_fbid']."/feed?";
					$postData = "method=POST"
					. "&access_token=" .$_SESSION['tokenaccess']
					. "&message=".$message;
					//echo "asdasdasdasdasdasdasdas";die;
					// echo $graph_url.$postData;
					// exit;
					
					$ch = curl_init();

					curl_setopt($ch, CURLOPT_URL, $graph_url);
					curl_setopt($ch, CURLOPT_HEADER, 0);
					curl_setopt($ch, CURLOPT_POST, 1);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
					curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

					$output = curl_exec($ch);
					curl_close($ch);
					echo $output;
				}
				
				if($_SESSION['twitter_id'] && $_SESSION['twitter_id'] != ""){
					// echo $_SESSION['oauth_token']."  ===  ".$_SESSION['oauth_token_secret'];die;
					$cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
					$params = array(
							'status' => $message,
							'media[]' => "../foto/".$_SESSION['foto']
					);
					$reply = $cb->statuses_updateWithMedia($params);
					// print_r($reply);
					// echo "<br/><br/>";
					// echo $_SESSION['oauth_token'];
					// echo "<br/><br/>";
					// echo $_SESSION['oauth_token_secret'];
					// echo "<br/><br/>";
					// print_r($reply);
					// exit;
				}
				// die;
			}
			
			
			$totalHarga = $_SESSION['harga'] * $_SESSION['paket'];
			
		
			$string_insert = "insert into tr_penjualan(spg_name, leader_name, harga, cust_name, gender, event_name, paket, date) values('".$_SESSION['spg_name']."', '".$_SESSION['leader_name']."', '".$totalHarga."', '".$_SESSION['name']."', '".$_SESSION['gender']."', '".$_SESSION['event_name']."', '".$_SESSION['paket']."', '".$date."')";
			$query_insert = mysql_query($string_insert) or die(mysql_error());
			
		}
			
			
		
		header("location:../thanks.php");
		
	}
			
	
?>