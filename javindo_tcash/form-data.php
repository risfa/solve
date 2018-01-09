<?php
	include "config.php";
	
	$sesUsername = $user_sessions->get('username');
    if(!isset($_GET['action'])){
        $user_sessions->set('error_insert','');
        $user_sessions->set('success_insert','');
        $user_sessions->set('user_input',array());
    }else{
        $errors = $user_sessions->get('error_insert');
        $success = $user_sessions->get('success_insert');
    }
    $input = $user_sessions->get('user_input');
    if($sesUsername == "")
	{
		header("location:login.php");
	}else{
        $statusHTML="";
	    if($success!=""){			
			$user_sessions->set('user_input',array());
            $statusHTML='								  				  
				
               <div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Success!</strong><br/><small>'.$success.'</small></div>
            ';
            $user_sessions->get('user_input',array());
            $input = $user_sessions->get('user_input');
        }else{
            if($errors!=""){
                $statusHTML='					
                    <div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Error!</strong><br/>
                ';
                foreach ($errors as $k=>$v){
                    $statusHTML.='<small>- '.$v.'</small><br/>';
                }
                $statusHTML.='</div>';
            }
			else{
				$statusHTML="";
			}
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    
		<?php include "header-title.php"; ?>
		<style>
			.alert-message
			{
				margin: 20px 0;
				padding: 20px;
				border-left: 3px solid #eee;
			}
			.alert-message h4
			{
				margin-top: 0;
				margin-bottom: 5px;
			}
			.alert-message p:last-child
			{
				margin-bottom: 0;
			}
			.alert-message code
			{
				background-color: #fff;
				border-radius: 3px;
			}
			.alert-message-success
			{
				background-color: #F4FDF0;
				border-color: #3C763D;
			}
			.alert-message-success h4
			{
				color: #3C763D;
			}
			.alert-message-danger
			{
				background-color: #fdf7f7;
				border-color: #d9534f;
			}
			.alert-message-danger h4
			{
				color: #d9534f;
			}
			.alert-message-warning
			{
				background-color: #fcf8f2;
				border-color: #f0ad4e;
			}
			.alert-message-warning h4
			{
				color: #f0ad4e;
			}
			.alert-message-info
			{
				background-color: #f4f8fa;
				border-color: #5bc0de;
			}
			.alert-message-info h4
			{
				color: #5bc0de;
			}
			.alert-message-default
			{
				background-color: #EEE;
				border-color: #B4B4B4;
			}
			.alert-message-default h4
			{
				color: #000;
			}
			.alert-message-notice
			{
				background-color: #FCFCDD;
				border-color: #BDBD89;
			}
			.alert-message-notice h4
			{
				color: #444;
			}
		</style>
  </head>

  <body>

    <!-- Fixed navbar -->
	
        <?php include "header.php"; ?>
        <br/>
		<br/>
		<div class="col-md-6 col-md-offset-3">
			<center>
				<div class="form-inline">				  
				  <div class="form-group">
					<label>Pilih Form : </label>
					<select id="pilihForm" onchange="pilihForm()"  class="form-control">
						<option value="choose" disabled selected>-Pilih-</option>
						<option value="insert_user">User</option>
						<option value="insert_merchant">Merchant</option>
					</select>
				  </div>				 
				</div>
			</center>
			<br/>
			<div id="user-form" class="well">
				  <legend>USER FORM</legend>
				<form class="form" accept-charset="UTF-8" action="process/insert-data.php?action=insert_user" method="post">
                    <?php
                    if(isset($_GET['action']) && $_GET['action']=="insert_user"){
                        echo $statusHTML;
                    }
                    ?>
					<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-phone"></i></span>
						  <input class="form-control" value="<?=((isset($_GET['action']) && $_GET['action']=="insert_user" && isset($input['hp']))? $input['hp'] : "")?>" name="noHP" placeholder="Nomor Handphone" type="text">
						</div>						
					</div>					
					<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-money" aria-hidden="true"></i></span>
						  <select class="form-control" name="topUp">
							<option value="choose" disabled selected>-Pilih Top Up-</option>
							<option value="25000" <?=((isset($_GET['action']) && $_GET['action']=="insert_user" && isset($input['top_up']) && $input['top_up']==25000)? "selected" : "")?>>Rp 25,000</option>
							<option value="50000" <?=((isset($_GET['action']) && $_GET['action']=="insert_user" && isset($input['top_up']) && $input['top_up']==50000)? "selected" : "")?>>Rp 50,000</option>
							<option value="100000" <?=((isset($_GET['action']) && $_GET['action']=="insert_user" && isset($input['top_up']) && $input['top_up']==100000)? "selected" : "")?>>Rp 100,000</option>
							<option value="150000" <?=((isset($_GET['action']) && $_GET['action']=="insert_user" && isset($input['top_up']) && $input['top_up']==150000)? "selected" : "")?>>Rp 150,000</option>
						  </select>
						</div>						
					</div>
					<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-cd"></i></span>
						  <input class="form-control" value="<?=((isset($_GET['action']) && $_GET['action']=="insert_user" && isset($input['no_serial']))? $input['no_serial'] : "")?>" name="serialSticker" placeholder="Nomor Serial Sticker" type="text">
						</div>						
					</div>
					<!--<div class="form-group">
						<label for="exampleInputName2">Gimmick : </label>
						<label class="checkbox-inline">
						  <input type="radio" name="gimmick" id="inlineCheckbox1" <?//=((isset($_GET['action']) && $_GET['action']=="insert_user" && isset($input['gimmick']) && $input['gimmick']=='Y')? "checked" : "")?>  value="Y"> Yes
						</label>
						<label class="checkbox-inline">
						  <input type="radio" <?//=((isset($_GET['action']) && $_GET['action']=="insert_user" && isset($input['gimmick']) && $input['gimmick']=='N')? "checked" : "")?> name="gimmick" id="inlineCheckbox2" value="N"> No
						</label>
					</div>-->
					<button class="btn btn-lg btn-danger btn-block" id="submitUser" data-loading-text="Processing..." type="submit">Submit</button>
				</form>
			</div>
			
			<div id="merchant-form" class="well">
				  <legend>MERCHANT FORM</legend>
				<form class="form" accept-charset="UTF-8" action="process/insert-data.php?action=insert_merchant" method="post">
                    <?php
                    if(isset($_GET['action']) && $_GET['action']=="insert_merchant"){
                        echo $statusHTML;
                    }
                    ?>
					<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-home"></i></span>
						  <input class="form-control" value="<?=((isset($_GET['action']) && $_GET['action']=="insert_merchant" && isset($input['nama_toko']))? $input['nama_toko'] : "")?>" name="namaToko" placeholder="Nama Toko" type="text">
						</div>						
					</div>
					<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-bullhorn" aria-hidden="true"></i></span>
						  <select class="form-control" name="kategori">
							<option value="choose" disabled selected>-Kategori Toko-</option>
							<option value="F&B" <?=((isset($_GET['action']) && $_GET['action']=="insert_merchant" && isset($input['kategori']) && $input['kategori']=="F&B")? "selected" : "")?>>F&B</option>
							<option value="Fashion" <?=((isset($_GET['action']) && $_GET['action']=="insert_merchant" && isset($input['kategori']) && $input['kategori']=="Fashion")? "selected" : "")?>>Fashion</option>
							<option value="Cosmetic" <?=((isset($_GET['action']) && $_GET['action']=="insert_merchant" && isset($input['kategori']) && $input['kategori']=="Cosmetic")? "selected" : "")?>>Cosmetic</option>
							<option value="Electronic" <?=((isset($_GET['action']) && $_GET['action']=="insert_merchant" && isset($input['kategori']) && $input['kategori']=="Electronic")? "selected" : "")?>>Electronic</option>
							<option value="Toys" <?=((isset($_GET['action']) && $_GET['action']=="insert_merchant" && isset($input['kategori']) && $input['kategori']=="Toys")? "selected" : "")?>>Toys</option>
							<option value="Pasar Basah" <?=((isset($_GET['action']) && $_GET['action']=="insert_merchant" && isset($input['kategori']) && $input['kategori']=="Pasar Basah")? "selected" : "")?>>Pasar Basah</option>
							<option value="Others" <?=((isset($_GET['action']) && $_GET['action']=="insert_merchant" && isset($input['kategori']) && $input['kategori']=="Others")? "selected" : "")?>>Others</option>
						  </select>
						</div>						
					</div>
					<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-user"></i></span>
						  <input class="form-control" name="namaPemilik" value="<?=((isset($_GET['action']) && $_GET['action']=="insert_merchant" && isset($input['nama_pemilik']))? $input['nama_pemilik'] : "")?>" placeholder="Nama Pemilik Toko" type="text">
						</div>						
					</div>
					<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-phone"></i></span>
						  <input class="form-control" name="noHP" value="<?=((isset($_GET['action']) && $_GET['action']=="insert_merchant" && isset($input['hp']))? $input['hp'] : "")?>" placeholder="Nomor Handphone" type="text">
						</div>						
					</div>
					<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-address-card" aria-hidden="true"></i></span>
						  <input class="form-control" name="ktp" value="<?=((isset($_GET['action']) && $_GET['action']=="insert_merchant" && isset($input['ktp']))? $input['ktp'] : "")?>" placeholder="Nomor KTP" type="text">
						</div>						
					</div>
					<div class="form-group">
						<label for="exampleInputName2">Tertarik : </label>
						<label class="checkbox-inline">
						  <input type="radio" name="tertarik" id="inlineCheckbox1" value="Y" <?=((isset($_GET['action']) && $_GET['action']=="insert_merchant" && isset($input['tertarik']) && $input['tertarik']=='Y')? "checked" : "")?>> Yes
						</label>
						<label class="checkbox-inline">
						  <input type="radio" name="tertarik"  id="inlineCheckbox2" value="N" <?=((isset($_GET['action']) && $_GET['action']=="insert_merchant" && isset($input['tertarik']) && $input['tertarik']=='N')? "checked" : "")?>> No
						</label>
					</div>
					<button class="btn btn-lg btn-danger btn-block" id="submitMerchant" data-loading-text="Processing..." type="submit">Submit</button>
				</form>
			</div>
		</div>

    </div> <!-- /container -->
	<br><br>
	</div>
	
	<?php include "footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	
	<script type="text/javascript">
		
		$( document ).ready(function() {			
			$("#user-form").hide();
			$("#merchant-form").hide();
            <?php
                if(isset($_GET['action'])){
                    echo "$('#pilihForm').val('".$_GET['action']."');pilihForm();";
                }
            ?>
		});
		
		function pilihForm(){
			
			var pilihForm = document.getElementById("pilihForm").value;
			
			if(pilihForm == "insert_user")
			{
				$("#user-form").show();
				$("#merchant-form").hide();
			}
			else if(pilihForm == "insert_merchant")
			{
				$("#merchant-form").show();
				$("#user-form").hide();
			}
			else
			{
				$("#user-form").hide();
				$("#merchant-form").hide();
			}
						
				
		}
		
		$('#submitUser').on('click', function () {
			var $btn = $(this).submit('loading')
			$('#submitUser').html('Processing...');
			$('#submitUser').addClass('disabled');
			$('#submitUser').attr('disabled');			
		});
		
		$('#submitMerchant').on('click', function () {
			var $btn = $(this).submit('loading')
			$('#submitMerchant').html('Processing...');
			$('#submitMerchant').addClass('disabled');
			$('#submitMerchant').attr('disabled');			
		});
		
		
		
	</script>
	
	<?php
		$user_sessions->set('error_insert','');
        $user_sessions->set('success_insert','');
        $user_sessions->get('user_input',array());
	?>
	
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>    
    <script src="../bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>					
  </body>
</html>
