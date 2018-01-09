<?php
	
	include "../process/db/db.php";
	
	if($_SESSION['name'] == "" || /*$_SESSION['paket'] == "" ||*/ $_SESSION['email'] == "" || $_SESSION['phone'] == "" || $_SESSION['gender'] == "" )
	{
		header("location:../index.php");
	}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../solve.ico" type="image/x-icon">
		<link rel="icon" href="../../solve.ico" type="image/x-icon">
		
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		<link href="../bootstrap/bootstrap-social.css" rel="stylesheet">
    <title>SOLVE-5D</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
	
    <link href="../bootstrap/docs/examples/navbar-fixed-top/navbar-fixed-top.css" rel="stylesheet">
		<link href="../bootstrap/docs/examples/sticky-footer-navbar/sticky-footer-navbar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../bootstrap/assets/js/ie-emulation-modes-warning.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
   
       <?php
					$string_header = "select * from ms_event where event_name = '".$_SESSION['event_name']."'";
					$query_header = mysql_query($string_header);
					
					if($rs_header = mysql_fetch_array($query_header)){
							$_SESSION['harga'] = $rs_header['harga'];
				?>
					<nav class="navbar navbar-default navbar-fixed-top" style="background-color:<?php echo $rs_header['color']; ?>;box-shadow:0px 0px 5px #888;border:0px">
							<div class="container">
								<div class="navbar-header">
									
									 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
												<span class="sr-only">Toggle navigation</span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
												<span class="icon-bar"></span>
											</button>
											<?php if(strtolower($_SESSION['event_name']) == strtolower("limadigit")) { ?>
											<a class="navbar-brand" href="#" style="color:white">Registration & Get Your Luck!</a>
											<?php }else{ ?>
											<a class="navbar-brand" href="#" style="color:white">Ngabuburit bersama SAMSUNG</a>
											<?php } ?>
								</div>
								
								<div id="navbar" class="navbar-collapse collapse">
									<ul class="nav navbar-nav navbar-right">
										<li class="dropdown active" style="background-color:#f5f5f5">
											<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome, <?php echo $_SESSION['spg_name']; ?> <span class="caret"></span></a>
											<ul class="dropdown-menu" role="menu">
												<li><a href="../process/do-logout.php">Logout</a></li>
											</ul>
										</li>
									</ul>
								</div>
							</div>
					</nav>
					
					<div class="container">

							<div class="col-lg-12">
								<!--<center><img src="../admin/files/<?php //echo $_SESSION['event_name']; ?>/<?php //$temp = json_decode($rs_header['image'], TRUE); echo $temp['banner_image']; ?>"/></center>
								<?php
									}
								?>-->
								<div class="col-lg-8">
									<div id="page">
									
										<div id="wrapper">
											<div id="video">
												<video id="live"  width="100%" height="400px" autoplay></video>
												<canvas id="snapshot" style="display:none"></canvas>
											</div>
											<br>
											<center>
												<div id="buttonContainer">
													<a href="#" class="btn btn-primary btn-lg" id="start"><i class="fa fa-camera"></i></a>
												</div>
												<a href="#" id="snap" onClick="snap()"></a>
												<label class="countdown"></label>
												<div id="button_after_snap"></div>												
											</center>
											<div id="preload">
												<audio src="audio/beep.wav" hidden="true"></audio>
												<audio src="audio/camera1.wav" hidden="true"></audio>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4">
										<div id="filmroll-wrapper">
											<div id="slot-wrapper" >
												<div id="slot"></div>
											</div>
											<div id="filmroll"></div>
										</div>
										<hr style="border-color:#000">
										
										<small>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate.</small>
								</div>
							</div>
					</div> <!-- /container -->
	<br><br>
	
	<?php $path = "../";include "../footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->


		<script>
				video = document.getElementById("live")
				var onFailSoHard = function(e) {
					console.log('Reeeejected!', e);
				};
				
				navigator.getUserMedia  = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.msGetUserMedia;
				
				navigator.getUserMedia({video: true}, function(stream) {
					video.src = window.URL.createObjectURL(stream);
				}, onFailSoHard);  
				
				var xPosMoustache, yPosMoustache;
				
				function snap() {
					live = document.getElementById("live")
					snapshot = document.getElementById("snapshot")
					filmroll = document.getElementById("filmroll")

					// Make the canvas the same size as the live video
					snapshot.width = live.clientWidth
					snapshot.height = live.clientHeight
			
					// Draw a frame of the live video onto the canvas
					c = snapshot.getContext("2d");
					c.drawImage(live, 0, 0, snapshot.width, snapshot.height);
					
					
					// Overlay moustache
					moustache = new Image();
					v = $("#live");				
					videoPosition = v.position();
					
					xPosMoustache = 40;
					yPosMoustache = 106;
					
					c.drawImage(moustache, xPosMoustache - videoPosition.left, yPosMoustache - videoPosition.top);
			
					// Create an image element with the canvas image data
					img = document.createElement("img")
					img.src = snapshot.toDataURL("image/png")
					img.style.padding = 5
					img.width = 260
					img.height = 180
					img.style.display = "none";
			
					// Add the new image to the film roll
					filmroll.appendChild(img)
				}
		</script>
		<script src="js/jquery.min.js"></script>
		<script src="js/snapstr.js"></script>
		<script src="libraries/colorbox/colorbox/jquery.colorbox-min.js"></script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>


							
				
					
			