<?php
	include "config.php";
		
	$error = $user_sessions->get('error');		
	
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
		<?php require_once "header-title.php"; ?>
		<style>
			.form-signin {
			  max-width: 400px; 
			  display:block;
			  background-color: #f7f7f7;
			  -moz-box-shadow: 0 0 2px #888;
				-webkit-box-shadow: 0 0 2px #888;
				box-shadow: 0 0 2px #888;
			  border-radius:2px;
			}
			.main{
				padding: 38px;
			}
			.social-box{
			  margin: 0 auto;
			  padding: 38px;
			  border-bottom:1px #ccc solid;
			}
			.social-box a{
			  font-weight:bold;
			  font-size:18px;
			  padding:8px;
			}
			.social-box a i{
			  font-weight:bold;
			  font-size:20px;
			}
			.heading-desc{
				font-size:20px;
				font-weight:bold;
				padding:38px 38px 0px 38px;
				
			}
			.form-signin .form-signin-heading,
			.form-signin .checkbox {
			  margin-bottom: 10px;
			}
			.form-signin .checkbox {
			  font-weight: normal;
			}
			.form-signin .form-control {
			  position: relative;
			  font-size: 16px;
			  height: 20px;
			  padding: 20px;
			  -webkit-box-sizing: border-box;
				 -moz-box-sizing: border-box;
					  box-sizing: border-box;
			}
			.form-signin .form-control:focus {
			  z-index: 2;
			}
			.form-signin input[type="text"] {
			  margin-bottom: 10px;
			  border-radius: 5px;
			  
			}
			.form-signin input[type="password"] {
			  margin-bottom: 10px;
			  border-radius: 5px;
			}
			.login-footer{
				background:#f0f0f0;
				margin: 0 auto;
				border-top: 1px solid #dadada;
				padding:20px;
			}
			.login-footer .left-section a{
				font-weight:bold;
				color:#8a8a8a;
				line-height:19px;
			}
			.mg-btm{
				margin-bottom:20px;
			}
		</style>
  </head>

  <body>

    <!-- Fixed navbar -->
	
        
        <br/>
		<br/>
		<div class="col-md-6 col-md-offset-3" align="center">					
			
			<form class="form-signin mg-btm" method="post" action="process/do-login.php">
			<br/>
			<br/>
			<img src="../images/SOLVE5D.png" width="250px"/>			
			<div class="main">
			<?php 
				if($error != "" || NULL)
				{
			?>
					<div class="alert alert-danger" role="alert"><small><b>!</b> <?php echo $error; ?></small></div>
			<?php
				}
			?>
						
			<input type="text" class="form-control" name="username" placeholder="Username" required  autofocus>
			<input type="password" class="form-control" name="password" placeholder="Password" required>
			 
			<button type="submit" class="btn btn-lg btn-info btn-block">Login</button>
			<span class="clearfix"></span>	
			</div>
			<div class="login-footer">
			<div class="row">
				<div class="col-xs-12" align="center">
					
					<small>Copyright &copy; 2017 by <a href="http://limadigit.com/" target="_blank">Limadigit</a>. All right reserved.</small>
					
				</div>
			</div>
			
			</div>
		  </form>	
			
		</div>

    </div> <!-- /container -->
	<br><br>
	</div>		

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
		

	<?php $user_sessions->set('error',''); ?>
	
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>    
    <script src="../bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>					
  </body>
</html>
