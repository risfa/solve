<?php
	include "process/db/db.php";

	if($_SESSION['name'] == "" || $_SESSION['paket'] == "" || $_SESSION['email'] == "" || $_SESSION['phone'] == "" || $_SESSION['gender'] == "" )
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
	<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="js/jquery.simple-text-rotator.js"></script>

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
				<form action="process/do-get-prize.php" method="post">
					<?php
							$a=array('Special', 'Maaf, Anda kurang beruntung', 'Dynamic', 'Simple', 'Great', 'Better', 'Stronger', 'Stylish', 'Flawless', 'Envied', 'Strong');
							$random_keys=array_rand($a,3);
					?>
					<center><h3 class="page-header" style="border-color:#00468c">
						
						
								<?php if($a[$random_keys[0]] == "Maaf, Anda kurang beruntung")
										{
											echo "Coba Lagi";
										}
									else
										{
											echo "Anda mendapatkan...?";
										}
								?>
					</h3></center>
					<center>
					
					<h1>
						<?php
								echo $a[$random_keys[0]];
								echo "<input type='hidden' name='prize' value='".$a[$random_keys[0]]."'>";
						?>
					</h1>
					<br>
					<button type="submit" class="btn btn-block btn-lg btn-primary">Selesai</button>
					
					<!--<a href="acak.php" class="btn btn-block btn-lg btn-warning">Coba lagi</a>-->
					</center>
					<br>
										
				</form>
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
