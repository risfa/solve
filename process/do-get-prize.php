<?php
	include "db/db.php";
	date_default_timezone_set("Asia/Jakarta");
	$date = date('Y-m-d H:i:s');
	// require_once '../includes/functions.php';
	// require_once '../fb/facebook.php';
	require_once '../twitter/src/codebird.php';
	\Codebird\Codebird::setConsumerKey('Vu36hAFuwKNQrBIfmuZrQ','JjrBajTX1ml77JxbFuuUa2dloPvileO4rasPsX4rlYA');
	$cb = \Codebird\Codebird::getInstance();
	$rand = rand(0,4);
	// $message = $config['wording'][$rand];
	$message = "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod.";
	$username = $_SESSION['spg_name'];
	// function search($arr,$field,$value) {
		// foreach($arr as $key => $value) {
			// if($arr[$field] === $value){
				// return $key;
			// }
		// }
		// return false;
	// }
	
	function searchArray($id, $data)
	{
		foreach( $data as $hadiah => $value ) 
		{
			foreach($value as $index => $value2 )
			{
				if($index != "redeem" && $index == ucfirst($id))
				{
						return $hadiah;
				}
			}
		}
	}
	
	$prize = $_POST['prize'];
	//echo $prize;die;
	
	$string_prize = "select * from ms_prize where event_name = '".$_SESSION['event_name']."'";
	$query_prize = mysql_query($string_prize);
	
	if($rs_prize = mysql_fetch_array($query_prize))
	{
		$a = json_decode($rs_prize['prize'], TRUE);
		$data = array();
		if($_SESSION['flag_location'] > 1)
		{
			foreach($a as $hadiah => $value)
			{
				$test = searchArray(ucfirst($username),$value);
				$a[$prize][$test]['redeem'] += 1;
				$a[$prize][$test][ucfirst($username)] -= 1;
				break;
			}
			$data = $a;
			
		}
		else
		{
			$flag = false;
			foreach( $a as $hadiah => $value ) 
			{
				foreach($value as $index => $value2 )
				{
					 if($index == $prize)
					 {
							$flag = true;
					 }
					 else
					 {
						$data[$hadiah][$index] = $value2;
					 }
					 
					 if($flag) {
							$data[$hadiah][$index] = $value[$index] - 1;
							$data[$hadiah]['redeem'] = $value['redeem'] + 1;
					 }
				}
			}
		}
		
		// print_r($data);die;
		$prize_redeem = json_encode($data);
		
		
		$update_prize_redeem = "update ms_prize set prize = '".$prize_redeem."' where event_name = '".$_SESSION['event_name']."'";
		$query_update_redeem = mysql_query($update_prize_redeem);
		
	}
	
	if(strtolower($_SESSION["event_name"]) == "samsung store" || strtolower($_SESSION['event_name']) == strtolower("Lesehan Enduro 2016"))
	{
		if(strtolower($_SESSION['event_name']) == strtolower("limadigit")) {
			$string = "insert into ms_member(name, email, gender, phone, prize, paket, event_name, spg_name, leader_name, created) values('".$_SESSION['name']."', '".$_SESSION['email']."', '".$_SESSION['gender']."', '".$_SESSION['phone']."', '".$prize."', '".$_SESSION['paket']."', '".$_SESSION['event_name']."', '".$_SESSION['spg_name']."', '".$_SESSION['leader_name']."', '".$date."')";
			$query = mysql_query($string) or die(mysql_error());
		}else{
			$poin = $_SESSION['poin'] + 1;
			
			$string = "insert into ms_member(name, email, gender, phone, prize, product1, event_name, jawaban, spg_name, leader_name, created,poin,fb_id,fbemail, fbpicture, fbtoken, twitter_id, twitter_name, twitteroauth_key, twitteroauth_secret,image,voucher_id,nomor_nota) values('".$_SESSION['name']."', '".$_SESSION['email']."', '".$_SESSION['gender']."', '".$_SESSION['phone']."', '".$prize."', '".$_SESSION['produk1']."', '".$_SESSION['event_name']."', '".$_SESSION['jawaban']."', '".$_SESSION['spg_name']."', '".$_SESSION['leader_name']."', '".$date."','".$poin."', '".$_SESSION["user_fbid"]."','".$_SESSION["user_email"]."','".$_SESSION["user_image"]."','".$_SESSION["tokenaccess"]."','".$_SESSION["twitter_id"]."','".$_SESSION["twitter_name"]."','".$_SESSION['oauth_token']."','".$_SESSION['oauth_token_secret']."','".$_SESSION['foto']."','".$_SESSION['kode']."','".$_SESSION['nomor_nota']."')";
			$query = mysql_query($string) or die(mysql_error());
			
			if($query) {
				if($_SESSION['user_fbid'] && $_SESSION['user_fbid'] != "") {
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
				}
				
				if($_SESSION['twitter_id'] && $_SESSION['twitter_id'] != ""){
					// echo $_SESSION['twitteroauth_key']."  ===  ".$_SESSION['twitteroauth_secret'];die;
					$cb->setToken($_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
					// $cek=	$cb->statuses_update('status='.$message);
					$params = array(
							'status' => $message,
							'media[]' => "../foto/".$_SESSION['foto']
					);
					$reply = $cb->statuses_updateWithMedia($params);
					// print_r($reply);die;
					/*echo "<br/><br/>";
					echo $rowmembernew->twitteroauth_key;
					echo "<br/><br/>";
					echo $rowmembernew->twitteroauth_secret;
					echo "<br/><br/>";
					print_r($reply);
					exit;*/
				}
			}
		}
		
		$totalHarga = $_SESSION['harga'] * $_SESSION['paket'];
		
		$string = "insert into tr_penjualan(spg_name, leader_name, harga, cust_name, gender, event_name, paket, date) values('".$_SESSION['spg_name']."', '".$_SESSION['leader_name']."', '".$totalHarga."', '".$_SESSION['name']."', '".$_SESSION['gender']."', '".$_SESSION['event_name']."', '".$_SESSION['paket']."', '".$date."')";
		$query = mysql_query($string) or die(mysql_error());
		
		header("location:../thanks.php");
		
	}
	else
	{
		$_SESSION['prize'] = $prize;
		$_SESSION['flag'] = "prize";

		$rand = rand(0,9);
		
		$message = preg_replace('/\[mention\]/',$_SESSION['twitter'],$config['wording_hadiah'][$rand]);
		$message = preg_replace('/\[hadiah\]/',$prize,$message);
		if($_SESSION['twitter'] != "@"){
			autopost($config['twitter_key'],$config['twitter_secret'],$message);
		}
		
		
		if(isset($_SESSION['ktp']))
		{
			header("location:do-insert-ktp.php");
		}
		else
		{
			header("location:../ktp.php");
		}
		
		
		// $string = "insert into ms_member(name, email, gender, phone, prize, paket, twitter) values('".$_SESSION['name']."', '".$_SESSION['email']."', '".$_SESSION['gender']."', '".$_SESSION['phone']."', '".$prize."', '".$_SESSION['paket']."', '".$_SESSION['twitter']."')";
		// $query = mysql_query($string) or die(mysql_error());
		
		// session_destroy();
		// header("location:../thanks.php");
	}
	
	function autopost($key,$secret,$message){
		global $cb;
		// echo $key."<br/>";
		// echo $secret."<br/>";
		// echo $message;die;
		$cb->setToken($key, $secret);
		$cek = $cb->statuses_update('status='.$message);
		// print_r($cek);die;
	}	
?>