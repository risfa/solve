<?php
	$flagIndexLogin = "indexLogin";
?>
<!DOCTYPE html>
<html lang="en">
  <head>

		<?php include "header-title.php"; ?>
		<style>
			.ds-btn li{ list-style:none; float:left; padding:10px; }
			.ds-btn li a span{padding-left:15px;padding-right:5px;width:100%;display:inline-block; text-align:left;}
			.ds-btn li a span small{width:100%; display:inline-block; text-align:left;}
		</style>
  </head>

  <body>

    <!-- Fixed navbar -->

        <?php include "header.php"; ?>
        <br/>
		<br/>
		<div class="col-md-6 col-md-offset-3" align="center">
				<ul class="ds-btn">					
					<li>
						<a class="btn btn-lg btn-danger" href="login.php">
						<i class="glyphicon glyphicon-user pull-left"></i><span>Login FO<br><small style="font-size:10px">Login yang digunakan <br/>FO untuk mengambil data.</small></span></a>
					</li>
					<li>
						<a class="btn btn-lg btn-success " style="padding-right:30px" href="admin/">
						<i class="glyphicon glyphicon-dashboard pull-left"></i><span>Login Admin<br><small style="font-size:10px">Login yang digunakan <br/>Team Leader dan Admin.</small></span></a> 						
					</li>					
				</ul>
		</div>

    </div> <!-- /container -->
	<br><br>
	</div>

	<?php include "footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->


    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
