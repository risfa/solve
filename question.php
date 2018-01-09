<?php
	
	include "process/db/db.php";
	
	if($_SESSION['spg_name'] == "")
	{
		header("location:login.php");
	}
	
	if($_SESSION['user_fbid'] != 0){
			$graph_url= "https://graph.facebook.com/".$_SESSION['user_fbid']."/photos?";
			$photo = "foto/".$_SESSION["foto"];
			$postData = array("method" => "POST",
																	"access_token" => $_SESSION["tokenaccess"],
																	// "message"=> $message,
																	// "description"=> $desc
												);
			$postData[basename($photo)] = '@'.realpath($photo);
			
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, $graph_url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

			$output = curl_exec($ch);
			
			curl_close($ch);
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
			$(document).ready(function(){
				$("input[name='optradio1']").change(function() {
					$("input[name='optradio1']").attr('disabled', 'disabled');
					var val1 = $("input[name='optradio1']:checked").val();
					var soal_id1 = $("#soal_id1").val();
					$.ajax({
						url: "get_knowledge.php?id="+soal_id1+"&jawab="+val1+"&flag=1",
						success: function(resp){
							$("#knowledge1").append(resp)
						}
					});
				})
				$("input[name='optradio2']").change(function() {
					$("input[name='optradio2']").attr('disabled', 'disabled');
					var val2 = $("input[name='optradio2']:checked").val();	
					var soal_id2 = $("#soal_id2").val();
					$.ajax({
						url: "get_knowledge.php?id="+soal_id2+"&jawab="+val2+"&flag=2",
						success: function(resp){
							$("#knowledge2").append(resp);
						}
					});
				})
			});
		</script>
  </head>

  <body>

    <!-- Fixed navbar -->
   
        <?php include "header.php"; ?>
        
	  
		<?php if(isset($_GET['error'])){ ?>
			
				<div class="col-sm-10 col-sm-offset-2 alert alert-warning alert-dismissible" role="alert">
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  <strong>* <?php echo $_GET['error']; ?></strong>
				</div>
			
		<?php } ?>
		<form class="form-horizontal" autocomplete="off" action="process/do-insert-question.php" method="post">
			<!--Question-->
			<?php 
				$_SESSION['score'] = 0;
				for($i=1;$i<=2;$i++){		
				$soal = mysql_query("SELECT * FROM ms_soal WHERE event_name LIKE 'Samsung%' AND TYPE = '".$i."' ORDER BY RAND() LIMIT 1;");
				while($Rsoal = mysql_fetch_array($soal)) {
					$jawaban = mysql_query("SELECT * FROM ms_jawaban where soal_id = '".$Rsoal['soal_id']."' and event_name like 'Samsung%'");
					while($Rjawaban = mysql_fetch_array($jawaban)) {
						$option = json_decode($Rjawaban['jawaban'],true);
						shuffle($option);
			?>
			<input type="hidden" value="<?php echo $Rsoal['soal_id']; ?>" id="soal_id<?php echo $i; ?>"/>
			<div class="form-group">
			<label class="col-sm-2 control-label" style="font-size:20px"><?php echo $i; ?> :</label>
			<div class="col-sm-10 input-group">
			  <label class="control-label" style="font-size:20px"><?php echo $Rsoal['pertanyaan']; ?></label><br>
				<?php $a = 0;foreach($option as $value) { ?>
				<div class="radio">
					<label style="font-size:20px"><input type="radio" name="optradio<?php echo $i; ?>" value="<?php echo $value; ?>" id="optradio<?php echo $i."_".$a; ?>"><?php echo $value; ?></label>
				</div>
				<?php $a++;} ?>
				<br>
				<div id="knowledge<?php echo $i; ?>"></div>
			</div>
		  </div>
			
			
				<?php
								}
							}
						}
				?>
		 <?php if(strtolower($_SESSION['event_name']) == strtolower("limadigit")) { ?>
		 <div class="col-sm-10 col-sm-offset-2" role="alert">
			<small>
				<i>* Must be fill!</i>
			</small>
		 </div>
		 <br><br>
		 
		 <div class="col-sm-10 col-sm-offset-2" role="alert">
				<button class="btn btn-lg btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
				<a class="btn btn-lg btn-info" href="cek-email.php">Terdaftar?</a>
				
		 </div>
		 <?php }else{ ?>
			 
			 <!--<div class="col-sm-10 col-sm-offset-2" role="alert">
					<button class="btn btn-lg btn-primary" type="submit"><i class="fa fa-paper-plane"></i> Submit</button>
					<a class="btn btn-lg btn-info" href="cek-email.php">Terdaftar?</a>
			 </div>-->
		 <?php } ?>
		 
		</form>
	  </div>

    </div> <!-- /container -->
	<br><br>
	
	<?php include "footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->


    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
