<?php
include 'spg_login.php';
$spbus=$db->select('ms_spbu','*');
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
		<div class="col-md-6 col-md-offset-3">			
			<br/>
            <?=((!empty($errorHTML))? $errorHTML : "")?>
			<form action="process/do-spbu.php" method="post">
              <div class="form-group">
                <label for="noSPBU">Nomor SPBU</label>
                  <select class="form-control" name="nomerSPBU" id="nomerSPBU" data-live-search="true">
                  <?php
                    foreach ($spbus as $s){
                        echo '<option value="'.$s['nomer'].'">'.$s['nomer'].' -'.$s['nama'].'</option>';
                    }
                  ?>
                  </select>
<!--                <input type="number" required maxlength="7" value="--><?//=((isset($input['nomerSPBU']))? $input['nomerSPBU'] : "")?><!--" name="nomerSPBU" type="text" class="form-control" id="noSPBU" placeholder="Nomor SPBU , contoh : xxxxxxx">-->
              </div>
<!--			  <div class="form-group">-->
<!--				<label for="nama">Nama / Alamat SPBU</label>-->
<!--				<input required maxlength="100" value="--><?//=((isset($input['namaSPBU']))? $input['namaSPBU'] : "")?><!--" name="namaSPBU" type="text" class="form-control" id="nama" placeholder="Nama / Alamat">-->
<!--			  </div>-->
			  <button type="submit" class="btn btn-primary btn-block btn-lg">Set Lokasi SPBU</button>
			</form>		
		</div>

    </div> <!-- /container -->
	<br><br>
	</div>
	
	<?php include "footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.js"></script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
    <script>
        $(document).ready(function () {
            $('select').selectpicker();
//            $('#noSPBU').on('change',function () {
//                    $.get('process/spbu-name.php?nomer='+$(this).val(),function (resp) {
//                        $('#nama').val(resp);
//                    });
//            });
        });
    </script>
  </body>
</html>
