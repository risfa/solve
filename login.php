<?php
	include "process/db/db.php";
	session_destroy();
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
		<link rel="icon" href="../solve.ico" type="image/x-icon">
		<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

    <title>SOLVE-5D</title>

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
	
    <nav class="navbar navbar-default navbar-fixed-top" style="background-color:#888;box-shadow:0px 0px 5px #888;border:0px">
      <div class="container">
        <div class="navbar-header">
          
          <a class="navbar-brand" href="#" style="color:white">Registration & Get Your Luck!</a>
        </div>
        
      </div>
    </nav>

    <div class="container">

		<div class="col-lg-12">
			<center><img src="images/SOLVE5D.png" width="200px"/></center>
			
			<div class="col-md-4 col-md-offset-4" style="border-radius:10px;padding:20px 50px 50px 50px;">
				
					<?php
						if(isset($_SESSION['error']))
						{
							echo "<center><small style='color:red'>".$_SESSION['error']."</small></center><br>";
						}
					?>
					<form class="form-signin" action="process/do-login.php" method="post">
						<label class="sr-only">Username</label>
						<input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off" required autofocus>
						<label class="sr-only">Password</label>
						<input type="password" name="password" class="form-control" placeholder="Password" required><br/>
<!--						<div class="checkbox">-->
<!--						  <label>-->
<!--							<input type="checkbox" value="remember-me">-->
<!--							  Remember me-->
<!--						  </label>-->
<!--						</div>-->
						
						<button class="btn btn-lg btn-info btn-block" style="box-shadow:0px 0px 5px #888" type="submit">Sign in</button>
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
		
		<?php 
			unset($_SESSION['error']);
		?>
  </body>
</html>
