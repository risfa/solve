<?php
	include "process/db/db.php";

	if($_SESSION['name'] == "" || $_SESSION['email'] == "" || $_SESSION['phone'] == "" || $_SESSION['gender'] == "" )
	{
		header("location:index.php");
	}
	// echo "<pre>";
	// print_r($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include "headerTitle.php"; ?>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
	
    <link href="bootstrap/docs/examples/navbar-fixed-top/navbar-fixed-top.css" rel="stylesheet">
		<link href="bootstrap/docs/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="bootstrap/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	

	
  </head>

  <body>

    <!-- Fixed navbar -->
    <?php include "header.php"; ?>
		
			<div class="col-lg-8 col-lg-offset-2" style="border-radius:10px;padding:0px 50px 50px 50px;">
				<form>
					  <center><h4 class="page-header" style="border-color:#034ea1">Social Media Connect</h4></center>
						<?php 
							if(isset($_GET['err']))
							{
						?>
						<div class="alert alert-danger" role="alert"><i>*<?php echo $_GET['err']; ?></i></div>
						<?php
							}
						?>
					  <center>
						  <?php
							if(isset($_SESSION['peringatan']))
							{
								echo "<small style='color:red'>".$_SESSION['peringatan']."</small><br><br>";
							}
						  ?>
						  <?php if(isset($_SESSION["fbregis"]) == ""){ ?>
						  <a class="btn btn-social btn-lg btn-facebook" style="margin:10px" onclick="FBLogin()">
							<i class="fa fa-facebook"></i> Facebook Connect
						  </a>
						  <?php } ?>
						  <?php if(isset($_SESSION["twitterregis"]) == ""){ ?>
						  <a class="btn btn-social btn-lg btn-twitter" onclick="newPopup('twitter/index.php');">
							<i class="fa fa-twitter"></i> Twitter Connect
						  </a>
						  <?php } ?>
					  </center>
					  <br>
					  <small>*Note : Pilih salah satu atau keduanya dari sosial media di atas, lalu silahkan menekan tombol "next" untuk melanjutkan (Langsung tekan next apabila anda tidak mempunyai kedua media sosial tersebut)</small>
					  <br>
					  <br>
					  <center>
						<button class="btn btn-md btn-default" onclick="goBack()"><i class="fa fa-long-arrow-left"></i> Previous</button>
						<!--<a href="process/doPermission.php" id="next" data-loading-text="Processing..." class="btn btn-md btn-danger">Next <i class="fa fa-long-arrow-right"></i></a>-->
						<a href="https://5dapps.com/solve/foto/index.php"><button type="button" id="next" data-loading-text="Processing..." style="width:100px;" class="btn btn-md btn-primary">Next <i class="fa fa-long-arrow-right"></i></button></a>
					</center>
				</form>
			</div>
		</div>

    </div> <!-- /container -->
	<br><br>
	<?php include "footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	
	<script>
		
		// Popup window code
		function newPopup(url) {
			var left = (screen.width/2)-(800/2);
			var top = (screen.height/2)-(500/2);
			popupWindow = window.open(url,'popUpWindow','height=570,width=800,scrollbars=yes, top='+top+', left='+left+'')
			/*popupWindow = window.open(url,'popUpWindow','height=500,width=800,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes, top='+top+', left='+left+'')*/
		}
		var debug = false;
		
		var appid = "";
		if(debug) {
			appid = "1035146973171100";
		} else {
			appid = "730214766997657";
		}
		
		window.fbAsyncInit = function() {
			FB.init({
			appId      : appid, // replace your app id here
			channelUrl : '', 
			status     : true, 
			cookie     : true, 
			xfbml      : true,
			version		: 'v2.4'
			});
		};
		
		(function(d, s, id){
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {return;}
			js = d.createElement(s); js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		
		// (function(d){
			// var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
			// if (d.getElementById(id)) {return;}
			// js = d.createElement('script'); js.id = id; js.async = true;
			// js.src = "//connect.facebook.net/en_US/all.js";
			// ref.parentNode.insertBefore(js, ref);
		// }(document));

		function FBLogin(){
			FB.login(function(response){
				if(response.authResponse){
					window.location.href = "../fb/actions.php?action=fblogin&app=solve";
				}
			}, {scope: 'email,user_photos,user_birthday,user_location,user_about_me,user_hometown,publish_actions'});
		}
		// scope error
		// read_stream
		function goBack() {
			window.history.back()
		}
		
		$("#next").click(function() {
			var $btn = $(this);
			$btn.button('loading');
		});
		
		
	</script>
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
