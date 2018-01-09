<?php
	include "process/db/db.php";
	
	if($_SESSION['name'] == "" || $_SESSION['phone'] == "" || $_SESSION['gender'] == "" )
	{
		header("location:index.php");
	}
	else if($_SESSION['spg_name'] == "")
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
	
  </head>

  <body>

    <!-- Fixed navbar -->
        <?php include "header.php"; ?>
			
			<div class="col-lg-8 col-lg-offset-2" style="border-radius:10px;padding:20px 50px 50px 50px;">
				<form class="form-inline" action="process/do-insert-paket.php" method="post">
					<center><h3 class="page-header" style="border-color:#00468c">Pilih Paket</h3></center>
								
								<center>
								<div class="form-group">
									<label class="sr-only">Product 1</label>
									<p class="form-control-static"><b>Product 1</b></p>
								</div>
								<div class="form-group">
									<label for="produk1" class="sr-only"></label>
									<select name="produk1" id="produk1" class="form-control">
											<option value="choose">-Choose-</option>
										<?php
											$string_paket = "select * from ms_paket where event_name = '".$_SESSION['event_name']."'";
											$query_paket = mysql_query($string_paket);
											
											while($rs_paket = mysql_fetch_array($query_paket)){
										?>
											<option value="<?php echo $rs_paket['paket']; ?>"><?php echo $rs_paket['paket']; ?></option>
										<?php
											}
										?>
									</select>
								</div>
								<div class="form-group">
									<label class="sr-only">Product 2</label>
									<p class="form-control-static"><b>Product 2</b></p>
								</div>
								<div class="form-group">
									<label for="produk2" class="sr-only"></label>
									<select name="produk2" id="produk2" class="form-control">
										<option value="choose">-Choose-</option>
										<?php
											$string_paket = "select * from ms_paket where event_name = '".$_SESSION['event_name']."'";
											$query_paket = mysql_query($string_paket);
											
											while($rs_paket = mysql_fetch_array($query_paket)){
										?>
											<option value="<?php echo $rs_paket['paket']; ?>"><?php echo $rs_paket['paket']; ?></option>
										<?php
											}
										?>
									</select>
								</div>
								</center>
								
								<?php
									if(isset($_SESSION['error']))
									{
										echo "<br><center><small style='color:red'>".$_SESSION['error']."</small></center>";
									}
								?>
								<!--<input class="btn btn-md btn-info" style="margin-top:10px" type="submit" value="Submit">-->
							
						
					<br>
					
					<p align="center">
						Klik tombol panah diatas dan pilih jumlah paket yang Anda butuhkan. Selanjutnya klik tombol "submit" dibawah dan ikuti instruksi berikutnya. Terimakasih.
					</p>
					
					<center>
						<small><button type="submit" class="btn btn-md btn-danger" href="index.php">Submit</button></small>
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
