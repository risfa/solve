<?php
include "config.php";
$sesUsername = $user_sessions->get('username');
if($sesUsername == "")
{
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
		<?php include "header-title.php"; ?>
    
  </head>

  <body>

    <!-- Fixed navbar -->
	
        <?php include "header.php"; ?>
        <br/>
		<br/>
		<div class="col-md-6 col-md-offset-3" align="center">
			<div class="panel panel-default">
			  <div class="panel-body">
				<form class="form-inline">
				  <div class="form-group">
					<label for="jenisPaket">Jenis Paket</label>
					<select id="jenisPaket" class="form-control">
						<option>Pertamax min Rp 200,000</option>
						<option>Pertamax Turbo min Rp 200,000</option>
					</select>
				  </div>				  
				  <button type="submit" class="btn btn-default btn-danger">Submit</button>
				</form>
			  </div>
			</div>
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
