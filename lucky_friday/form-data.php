<?php
include 'spg_login.php';
$user_sessions->set('currentPeserta',array());
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
            .dropdown-menu{
                max-height: 200px !important;
            }
		</style>
      <link href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css" rel="stylesheet"/>
  </head>

  <body>

    <!-- Fixed navbar -->
	
        <?php include "header.php"; ?>
        <br/>
		<br/>
		<div class="col-md-6 col-md-offset-3">			
			<br/>
            <?=((!empty($errorHTML))? $errorHTML : "")?>
			<div id="user-form" class="well">
				<legend>DATA PESERTA RAFFLE</legend>
				<form class="form" accept-charset="UTF-8" action="process/insert-data.php?action=insert_user" method="post">
                    <?php
                    if(isset($_GET['action']) && $_GET['action']=="insert_user"){
                        echo $statusHTML;
                    }
                    ?>
					<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
						  <input class="form-control" value="<?=((isset($input['nama']))? $input['nama'] : "")?>"  name="nama" placeholder="Nama" type="text">
						</div>						
					</div>
					<!--<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
						  <input class="form-control"  value="<?=((isset($input['email']))? $input['email'] : "")?>" name="email" placeholder="Email" type="text">
						</div>						
					</div>-->
					<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-phone"></i></span>
						  <input class="form-control" id="noHP" type="tel" value="<?=((isset($input['noHP']))? $input['noHP'] : "")?>" name="noHP" placeholder="Nomor Handphone" type="text">
						</div>						
					</div>					
					<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-car" aria-hidden="true"></i></span>
						  <select class="form-control" name="merkKendaraan" id="merkKendaraan" data-live-search="true">
							<option value="choose" disabled selected>-Pilih Merk Kendaraan-</option>
							<option>Acura</option>
							<option>Alfa romeo</option>
							<option>Aston martin</option>
							<option>Audi</option>
							<option>Bentley</option>
							<option>BMW</option>
							<option>Bugatti</option>
							<option>Cadillac</option>
							<option>Cherry</option>
							<option>Chevrolet</option>
							<option>Chrysler</option>
							<option>Citroen</option>
							<option>Corvette</option>
							<option>Custom</option>
							<option>Daewoo</option>
							<option>Daihatsu </option>
							<option>Datsun</option>
							<option>Dodge</option>
							<option>Ferrari</option>
							<option>Fiat</option>
							<option>Ford</option>
							<option>Geely</option>
							<option>GMC</option>
							<option>Hino</option>
							<option>Holden</option>
							<option>Honda</option>
							<option>Hummer</option>
							<option>Hyundai</option>
							<option>Infiniti</option>
							<option>Isuzu</option>
							<option>Jaguar</option>
							<option>Jeep</option>
							<option>KIA</option>
							<option>Lamborghini</option>
							<option>Land rover</option>
							<option>Lexus</option>
							<option>Lotus</option>
							<option>Maseratti</option>
							<option>Maybach</option>
							<option>Mazda</option>
							<option>McLaren</option>
							<option>Mercedes benz</option>
							<option>Mini</option>
							<option>Mitsubishi</option>
							<option>Mustang</option>
							<option>Nissan</option>
							<option>Opel</option>							
							<option>Pagani</option>
							<option>Peugeuot</option>
							<option>Porsche</option>
							<option>Proton</option>
							<option>Range rover</option>
							<option>Renault</option>
							<option>Rolls royce</option>
							<option>Ssangyong</option>
							<option>Subaru</option>
							<option>Suzuki</option>
							<option>Tesla</option>
							<option>Toyota</option>
							<option>Viper</option>
							<option>Volvo</option>
							<option>VW</option>
							<option>Others</option>
						  </select>
						</div>						
					</div>
					<!--<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-cogs" aria-hidden="true"></i></span>
						  <input class="form-control" value="<?=((isset($input['tipeKendaraan']))? $input['tipeKendaraan'] : "")?>" name="tipeKendaraan" placeholder="Tipe Kendaraan" type="text">
						</div>						
					</div>-->
					<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-tint" aria-hidden="true"></i></span>
						  <select class="form-control" name="jenisProduk" id="jenisProduk" data-live-search="true">
							<option value="choose" disabled selected>-Pilih Produk-</option>
							<option>Pertalite</option>
							<option>Pertamax</option>
							<option>Pertamax Turbo</option>
							<option>DEX</option>
							<option>Dexlite</option>
						  </select>
						</div>						
					</div>
					<div class="form-group">
						<div class="input-group">
						  <span class="input-group-addon" id="basic-addon1"><i class="fa fa-money" aria-hidden="true"></i></span>
						  <input class="form-control" id="nominal" value="<?=((isset($input['nominal']))? $input['nominal'] : "")?>" name="nominal" placeholder="Nominal Pembelian" type="text">
						</div>						
					</div>					
					<button class="btn btn-lg btn-primary btn-block" id="submitUser" data-loading-text="Processing..." type="submit">Simpan & Mulai Raffle</button>
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="../js/cleave/cleave.min.js"></script>
    <script src="../js/cleave/addons/cleave-phone.id.js"></script>
    <script>
        $(document).ready(function () {
					<?=((isset($input['jenisProduk']))? "$('#jenisProduk').val('".$input['jenisProduk']."');" : "")?>
					<?=((isset($input['merkKendaraan']))? "$('#merkKendaraan').val('".$input['merkKendaraan']."');" : "")?>
					$('select').selectpicker();
					
					var cleaveNominal = new Cleave("#nominal",{
						numeral: true,
						numeralThousandsGroupStyle: 'thousand'
					});
					
					var cleaveHp = new Cleave("#noHP", {
						phone: true,
						phoneRegionCode: "ID"
					})
        });
    </script>
  </body>
</html>
