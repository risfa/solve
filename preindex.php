<?php
	
	include "process/db/db.php";
	
	if($_SESSION['spg_name'] == "")
	{
		header("location:login.php");
	}
	
	unset($_SESSION['name'], $_SESSION['email'], $_SESSION['paket'], $_SESSION['gender'], $_SESSION['phone'], $_SESSION['twitter'], $_SESSION['prize'], $_SESSION['jawab1'], $_SESSION['jawab2'], $_SESSION['score'], $_SESSION['produk1'], $_SESSION['produk2'], $_SESSION['ktp'], $_SESSION['error']);
	

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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body style="margin-bottom:30px">

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
										<?php }else if(strtolower($_SESSION['event_name']) == strtolower("Lesehan Enduro")){ ?>
										<a class="navbar-brand" href="#" style="color:white">Lesehan Enduro</a>
										<?php }else{ ?>
										<a class="navbar-brand" href="#" style="color:white">Ardency Adprom</a>
										<?php } ?>
							</div>
							
							<div id="navbar" class="navbar-collapse collapse">
								<ul class="nav navbar-nav navbar-right">
									<li class="dropdown active" style="background-color:#f5f5f5">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome, <?php echo $_SESSION['spg_name']; ?> <span class="caret"></span></a>
										<ul class="dropdown-menu" role="menu">
											<li><a href="process/do-logout.php">Logout</a></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
				</nav>
				
			<?php
				}
			?>
        
	  
			<a href="index.php"><img src="images/BG-Solve-Lesehan.gif" width="100%" height="100%"/></a>
		
   
	<br><br>
	
	<?php include "footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->


    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
