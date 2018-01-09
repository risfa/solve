<?php
	include "process/db/db.php";

	if($_SESSION['spg_name'] == "")
	{
		header("location:login.php");
	}
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
		<script>
			function goBack() {
					window.history.back();
			}
		</script>
  </head>

  <body>

    <!-- Fixed navbar -->
        <?php include "header.php"; ?>
			
			<div class="col-lg-8 col-lg-offset-2" style="border-radius:10px;padding:20px 50px 50px 50px;">
				<form action="process/do-cek-email.php" method="post" autocomplete="off">
					<center><h3 class="page-header" style="border-color:#00468c">Cek nomor telepon</h3></center>
								
								<div class="input-group">
								   <input type="text" name="phone" class="form-control" placeholder="Enter Your Phone...">
								   <span class="input-group-addon"><i class="fa fa-user-plus"></i></span>
							    </div>
								<?php
									if(isset($_GET['error']))
									{
										echo "<br><center><small style='color:red'>".$_GET['error']."</small></center>";
									}
								?>
								<!--<input class="btn btn-md btn-info" style="margin-top:10px" type="submit" value="Submit">-->
							
						
					<br>
					
					<p align="center">
						Masukkan nomor telepon Anda di kolom di atas, sistem akan secara auto mendeteksi apakah Anda sudah terdaftar atau belum. Kemudian klik tombol Check dibawah. Ikuti instruksi selanjutnya. Terimakasih.
					</p>
					
					<center>
						<small><button type="submit" class="btn btn-md btn-danger" href="index.php">Check!</button></small>
						<br>
						<br>
						<small><a href="index.php">&#8592; Back to Register</a></small>
					</center>
				</form>
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
