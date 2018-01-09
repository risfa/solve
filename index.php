<?php
	
	include "process/db/db.php";
	
	if($_SESSION['spg_name'] == "" || $_SESSION['flag'] != "login")
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
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
		<script>
			// var idleTime = 0;
			
			// function timerIncrement() {
				// idleTime = idleTime + 1;
				// console.log(idleTime);
				
				// if (idleTime >= 60) { // 60 second
					
					
						// window.location.href = "preindex.php";
				// }
			// }
			
			// $(document).ready(function(){	
		
				//Increment the idle time counter every minute.
				// var idleInterval = setInterval(timerIncrement, 60000);
				// var idleInterval = setInterval(timerIncrement, 1000);
				//Zero the idle timer on mouse movement.
				// $(this).mousemove(function (e) {
					// idleTime = 0;
				// });
				// $(this).keypress(function (e) {
					// idleTime = 0;
				// });
			// });
		</script>
  </head>

  <body>

    <!-- Fixed navbar -->
   
        <?php include "header.php"; ?>
        
	  	<!--<div class="row">
	  	<div class="col-sm-12 text-center">
			<br/>
			<div class="btn-group" role="group" aria-label="Basic example">
				<button type="button" class="btn btn-danger" id="paket_form">JF Sulfur</button>
				<button type="button" class="btn btn-danger" id="voucher_form">Ketupat Enduro</button>
			</div>
			<br/>
			<br>
		</div>
		</div>-->
		<?php if(isset($_SESSION['error'])){ ?>
				<br>
				<div class="col-sm-10 col-sm-offset-2 alert alert-warning alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong>* <?php echo $_SESSION['error']; ?></strong>
				</div>
			
		<?php } ?>
		<div class="row" id="voucher_user">
			<div class="col-sm-12">
				
				<hr>
				<input type="text" name="kode_voucher" id="kode_voucher" class="form-control" placeholder="Masukan Kode Voucher ...."/>
				<hr>
			</div>
			<div class="col-sm-12 text-center">
				<button class="btn btn-danger" id="check">Check Voucher</button>
			</div>
		</div>
		<form class="form-horizontal" autocomplete="off" action="process/do-insert-member.php" method="post">
			<?php if(strtolower($_SESSION['event_name']) == strtolower("Lesehan Enduro") || strtolower($_SESSION['event_name']) == strtolower("Lesehan Enduro 2016") || strtolower($_SESSION['event_name']) == strtolower("Ardency Adprom")) { ?>
			<input type="hidden" name="voucher_id" id="voucher_id"/>
			<div class="form-group" id="select_paket">				
				
				<!--<label class="col-sm-5 control-label">Paket</label>-->
				<div class="col-sm-12" style="padding-left:0px" align="center">
				<hr>
				<!--<input type="text" name="ktp" class="form-control" placeholder="Enter Card Number...">-->
					<div class="col-sm-4 input-group" >
					
						<select name="produk1" class="form-control">
							<option value="choose" selected>-Pilih Paket-</option>
							<?php
								$string_paket = "select * from ms_paket where event_name = '".$_SESSION['event_name']."'";
								$query_paket = mysql_query($string_paket);
								
								while($rs_paket = mysql_fetch_array($query_paket)){
							?>
							<option <?php if($_SESSION['produk1'] == $rs_paket['paket']){ echo "selected"; } ?> value="<?php echo $rs_paket['paket']; ?>"><?php echo $rs_paket['paket']; ?></option>
							<?php
								}
							?>
						</select>
						<span class="input-group-addon" id="basic-addon2">*</span>
						
					</div>
					<hr>
				</div>
		  </div>
<!--			<div class="form-group">-->
<!--				<label class="col-sm-2 control-label">Product 2</label>-->
<!--				<div class="col-sm-10" style="padding-left:0px">-->
				<!--<input type="text" name="ktp" class="form-control" placeholder="Enter Card Number...">-->
<!--					<div class="col-sm-2 input-group">-->
<!--						<select name="produk2" class="form-control">-->
<!--							<option value="choose">-Choose-</option>-->
<!--							--><?php
//								$string_paket = "select * from ms_paket where event_name = '".$_SESSION['event_name']."'";
//								$query_paket = mysql_query($string_paket);
//
//								while($rs_paket = mysql_fetch_array($query_paket)){
//							?>
<!--							<option --><?php //if($_SESSION['produk2'] == $rs_paket['paket']){ echo "selected"; } ?><!-- value="--><?php //echo $rs_paket['paket']; ?><!--">--><?php //echo $rs_paket['paket']; ?><!--</option>-->
<!--							--><?php
//								}
//							?>
<!--						</select>-->
<!--						<span class="input-group-addon" id="basic-addon2">*</span>-->
<!--					</div>-->
<!--				</div>-->
<!--		  </div>-->
		  <div id="form_user">
		  <div class="form-group">
			<label class="col-sm-2 control-label">Name</label>
			<div class="col-sm-10 input-group">
			  <input type="text" name="name" class="form-control" value="<?php echo $_SESSION['name']; ?>" placeholder="Enter Name...">
			  <span class="input-group-addon" id="basic-addon2">*</span>
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label">Email</label>
			<div class="col-sm-10 input-group">
			  <input type="text" name="email" class="form-control" value="<?php echo $_SESSION['email']; ?>" placeholder="Enter Email...">
			  <!--<span class="input-group-addon" id="basic-addon2">*</span>-->
			</div>
		  </div>
		  <!--<div class="form-group">
			<label class="col-sm-2 control-label">No. KTP</label>
			<div class="col-sm-10">
			  <input type="text" name="ktp" class="form-control" placeholder="Enter Card Number...">
			</div>
		  </div>-->
		  <div class="form-group">
			<label class="col-sm-2 control-label">Gender</label>
			<div class="col-sm-10">
				<label class="radio-inline"><input checked type="radio" <?php if($_SESSION['gender'] == "Laki-laki"){ echo "checked='checked'"; } ?> name="gender" value="Laki-laki">Laki-laki</label>
				<label class="radio-inline"><input type="radio" <?php if($_SESSION['gender'] == "Perempuan"){ echo "checked='checked'"; } ?> name="gender" value="Perempuan">Perempuan</label>
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label">Phone</label>
			<div class="col-sm-10 input-group">
			  <input type="text" name="phone" value="<?php echo $_SESSION['phone']; ?>" class="form-control" placeholder="Enter Your Active Mobile Phone...">
			  <span class="input-group-addon" id="basic-addon2">*</span>
			</div>
		  </div>
			  <div class="form-group"  id="nomor_nota">
				  <label class="col-sm-2 control-label">Nomor Nota</label>
				  <div class="col-sm-10 input-group">
					  <input type="text" name="nomor_nota" class="form-control" value="<?php echo $_SESSION['nomor_nota']; ?>" placeholder="Nomor Nota...">
					  <span class="input-group-addon" id="basic-addon2">*</span>
				  </div>
			  </div>
			<?php } else if(strtolower($_SESSION['event_name']) == strtolower("samsung store")) { ?>
		  <div class="form-group">
			<label class="col-sm-2 control-label">Name :</label>
			<div class="col-sm-10 input-group">
			  <input type="text" name="name" class="form-control" placeholder="Enter Name...">
			  <span class="input-group-addon" id="basic-addon2">*</span>
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label">Email :</label>
			<div class="col-sm-10 input-group">
			  <input type="text" name="email" class="form-control" placeholder="Enter Email...">
			  <span class="input-group-addon" id="basic-addon2">*</span>
			</div>
		  </div>
		  <!--<div class="form-group">
			<label class="col-sm-2 control-label">No. KTP</label>
			<div class="col-sm-10">
			  <input type="text" name="ktp" class="form-control" placeholder="Enter Card Number...">
			</div>
		  </div>-->
		  <div class="form-group">
			<label class="col-sm-2 control-label">Gender :</label>
			<div class="col-sm-10">
				<label class="radio-inline"><input type="radio" name="gender" value="Laki-laki">Laki-laki</label>
				<label class="radio-inline"><input type="radio" name="gender" value="Perempuan">Perempuan</label>
			</div>
		  </div>
		  <div class="form-group">
			<label class="col-sm-2 control-label">Phone :</label>
			<div class="col-sm-10 input-group">
			  <input type="text" name="phone" class="form-control" placeholder="Enter Mobile Phone...">
			  <span class="input-group-addon" id="basic-addon2">*</span>
			</div>
		  </div>
			<div class="form-group">
			<label class="col-sm-2 control-label">Address :</label>
			<div class="col-sm-10 input-group">
			  <!--<input type="text" name="phone" class="form-control" placeholder="Enter Mobile Phone...">-->
				<textarea name="address" class="form-control" placeholder="Enter Address..."></textarea>
			  <span class="input-group-addon" id="basic-addon2">*</span>
			</div>
		  </div>
			<!--Question-->
			
				<?php
					} 
				?>
		 <?php if(strtolower($_SESSION['event_name']) == strtolower("Lesehan Enduro")) { ?>
		 
		 
		 <br>
		 <div class="form-group">
			<label class="col-sm-2 control-label"></label>
			<div class="col-sm-10 input-group">
			  <button class="btn btn-lg btn-danger" type="submit"><i class="fa fa-paper-plane"></i> Submit</button> &nbsp;
				<a class="btn btn-lg btn-success" href="cek-phone.php">Terdaftar?</a>
			</div>
		 </div>
		 </div>
		 <?php }else{ ?>
			 
			<div class="col-sm-10 col-sm-offset-2" role="alert">
			<small>
				<i>* Must be fill!</i>
			</small>
		 </div>
		 <br><br>
			<div class="form-group">
			<label class="col-sm-2"></label>
			<div class="col-sm-10" style="padding-left:0px">
			  <button class="btn btn-lg btn-primary"  type="submit"><i class="fa fa-paper-plane"></i> Next</button>
				<!--<a class="btn btn-lg btn-info" href="cek-email.php">Terdaftar?</a>-->
			</div>
		  </div>

		 <?php } ?>
		 
		</form>
	  </div>

    </div> <!-- /container -->
	<br><br>
	</div>
	
	<?php include "footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->


    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
		
		
	<?php
		unset($_SESSION['error']);
	?>
  	<script>
		$(document).ready(function(){
			$('#voucher_user').hide();
			$('#select_paket').show();
			$('#form_user').hide();
			$('#paket_form').click(function(){
				$('#select_paket').show();
				$('#select_paket').val('');
				$('#voucher_user').hide();
				var isi=$('#select_paket option:selected').text();
				if(isi!="-Pilih Paket-"){
					$('#form_user').show();
					$('#nomor_nota').show();
				}
			});
			$('#select_paket').change(function(){
				var isi=$('#select_paket option:selected').text();
				if(isi!="-Pilih Paket-"){
					$('#form_user').show();
					$('#nomor_nota').show();
				}else {
					$('#form_user').hide();
				}
			});
			$('#voucher_form').click(function(){
				$('#form_user').hide();
				$('#select_paket').hide();
				$('#nomor_nota').hide();
				$('#voucher_user').show();
			});
			$('#check').click(function(){
				$.ajax({
					url : "process/check_voucher.php?kode="+$('#kode_voucher').val(),
					method : 'GET',
					beforeSend: function(){

					},
					success : function(resp){
						$('#kode_voucher').val('');
						var obj = JSON.parse(resp);
						if(obj.status==true){
							$('#voucher_id').val(obj.voucher_id);
							$('#form_user').show();
							$('#select_paket').hide();
							$('#voucher_user').hide();
						}else{
							alert("Kode Voucher sudah pernah digunakan!");
						}
					}
				});
				return false;
			});
		});
	</script>
  </body>
</html>
