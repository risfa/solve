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
		<div class="col-md-6 col-md-offset-3">			
			<div class="panel panel-default">
			  <div class="panel-body">								
				<form>
				  <div class="form-group">
					<label for="nama">Nama</label>
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-user" aria-hidden="true"></i></span>
					  <input type="text" class="form-control" id="nama" placeholder="Nama Anda..">
					</div>					
				  </div>
				  <div class="form-group">
					<label for="exampleInputEmail1">Alamat Email</label>
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i></span>
					  <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Email Anda..">
					</div>						
				  </div>
				  <div class="form-group">
					<label for="phone">Handphone</label>
					<div class="input-group">
					  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-phone" aria-hidden="true"></i></span>
					  <input type="text" class="form-control" id="phone" placeholder="Hanphone Anda..">
					</div>						
				  </div>
				  <div class="form-group">
					<label for="phone">Kendaraan</label>
					<br/>
					<label class="radio-inline">
					  <input type="radio" name="kendaraan" id="mobil" value="Mobil"> Mobil
					</label>
					<label class="radio-inline">
					  <input type="radio" name="kendaraan" id="motor" value="Motor"> Motor
					</label>						
				  </div>
				  <br/>
				  <button type="submit" class="btn btn-default btn-danger pull-right"><i class="glyphicon glyphicon-send"></i> Submit</button>
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
