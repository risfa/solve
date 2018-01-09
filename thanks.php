<?php
	include "process/db/db.php";
	unset($_SESSION['name'], $_SESSION['email'], $_SESSION['paket'], $_SESSION['gender'], $_SESSION['phone'], $_SESSION['twitter'], $_SESSION['prize'], $_SESSION['jawab1'], $_SESSION['jawab2'], $_SESSION['score'], $_SESSION['produk1'], $_SESSION['produk2'], $_SESSION['ktp'], $_SESSION['error']);
	
	$_SESSION['flag'] = "login";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include "headerTitle.php"; ?>
		<meta http-equiv="refresh" content="20;URL='http://5dapps.com/solve/index.php'" />
		
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
				
					<center><h3 class="page-header" style="border-color:#00468c">Terima kasih atas partisipasi anda</h3></center>
					
					<br>
                    <p align="center">
                        Semoga selamat sampai tujuan dan nantikan kejutan lesehan enduro selanjutnya.
                    </p>
					
					<center>
						<small><a href="index.php">&#8592; Kembali</a></small>
					</center>
					<br>
					<br>
					
				
			</div>
		</div>

    </div> <!-- /container -->
	<br><br>
	
	<?php include "footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
