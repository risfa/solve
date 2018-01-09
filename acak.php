<?php
	include "process/db/db.php";

	//if($_SESSION['name'] == "" || /*$_SESSION['paket'] == "" || $_SESSION['email'] == "" ||*/ $_SESSION['phone'] == "" || $_SESSION['gender'] == "" || $_SESSION['flag'] != "index")
	/*{
		header("location:index.php");
	}
	else if($_SESSION['spg_name']=="")
	{
		header("location:login.php");
	}*/
	
	function searchArray($id, $data)
	{
		//print_r($data);die;		
		foreach( $data as $hadiah => $value ) 
		{
			foreach($value as $index => $value2 )
			{
				if($index != "redeem" && $index == ucfirst($id))
				{
						return $hadiah;
				}
			}
		}
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
		<script type="text/javascript" src="js/jquery-1.9.1.js"></script>
		<script type="text/javascript" src="js/jquery.simple-text-rotator.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
  </head>

  <body>

			<?php
				$string = "select * from ms_prize where event_name = '".$_SESSION['event_name']."'";
				$query = mysql_query($string) or die(mysql_error());
				
				if(strtolower($_SESSION['event_name']) == strtolower("limadigit")) { 
					
				} else if(strtolower($_SESSION['event_name']) == strtolower("samsung store")) {
					if($rs = mysql_fetch_array($query))
					{
						$tampung = array();
						$tampung2 = array();
						$data = json_decode($rs['prize'], TRUE);
						
						foreach($data as $hadiah => $value) {
							foreach($value as $key=>$val) {
								if($key != "redeem") $tampung2[$key] = $val;
							}
						}
						foreach($tampung2 as $key => $val) {
							for($x = 1; $x <= $val; $x++) {
								$tampung[] = $key;
							}
						}
					}
				} else {	
					if($rs = mysql_fetch_array($query))
					{
						$username = $_SESSION['spg_name'];
						$tampung = array();
						$tampung2 = array();
						$data = json_decode($rs['prize'], TRUE);
						
						foreach($data as $hadiah => $value)
						{
							$test = searchArray(ucfirst($username),$value);
							$tampung2[$hadiah] = $value[$test][ucfirst($username)];
							
						}
						
						foreach($tampung2 as $key => $val)
						{
							for($x = 1; $x <= $val; $x++)
							{
								$tampung[] = $key;
							}
						}
					}
				}
			?>
    <!-- Fixed navbar -->
    
        <?php include "header.php"; ?>
			
			<div class="col-lg-8 col-lg-offset-2" style="border-radius:10px;padding:0px 50px 50px 50px;">
				
					<center><h3 class="page-header" style="border-color:#00468c">
					
						Semoga beruntung!
					
					</h3></center>
					<center>
					<!--
					-->
					<?php if(strtolower($_SESSION['event_name']) == strtolower("limadigit")) { ?>
						<h4><div class="textbox"><div></h4><br>
						<a href="acakk.php" class="btn btn-block btn-lg btn-danger">Stop</a>
						<!--<button class="btn btn-block btn-lg btn-warning" href="">Coba lagi</button>-->
					<?php }else{ ?>
					<form action="process/do-get-prize.php" method="post">
					<h4><div id="output"><div></h4><br>
					<div id="nextPage"><button type="button" class="btn btn-block btn-lg <?php if(strtolower($_SESSION['spg_name']) == strtolower("spgsamsung")){ echo "btn-primary"; }else{ echo "btn-danger"; } ?>" id="stop">Stop</button></div>
					<input type="hidden" id="hidden" name="prize"/>
					<!--<div id="nextPage"></div>-->
					</form>
					<?php } ?>
					</center>
					<br>
					
										
				
			</div>
		</div>

    </div> <!-- /container -->
	<br><br>
	
	<?php include "footer.php"; ?>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	
	<script type="text/javascript">
		<?php if(strtolower($_SESSION['event_name']) == strtolower("limadigit")) { ?>
		var words = [
			'Special',
			'Maaf, Anda kurang beruntung',
			'Dynamic',
			'Simple',
			'Great',
			'Better',
			'Stronger',
			'Stylish',
			'Flawless',
			'Envied',
			'Strong'
			];

			var getRandomWord = function () {
			  return words[Math.floor(Math.random() * words.length)];
			};
		$(function() { // after page load
		  setInterval(function(){
			$('.textbox').fadeOut(10, function(){
			  $(this).html(getRandomWord()).fadeIn(10);
			});
		  //5 seconds
		  }, 100);
		});
		<?php }else{ ?>
		//random 2
		var output, started, duration, desired;


		duration = 5000;
		desired = '50';


		output = $('#output');
		started = new Date().getTime();
		var myShows = <?php echo json_encode($tampung); ?>;
		console.log(myShows);
		var show = myShows[Math.floor(Math.random() * myShows.length)];

		animationTimer = setInterval(function() {

				if (output.text().trim() === desired || new Date().getTime() - started > duration) {

						output.text('' + myShows[Math.floor(Math.random() * myShows.length)] );

				} else {

						output.text('' + myShows[Math.floor(Math.random() * myShows.length)] );
				}
		}, 10);
		
		$("#stop").on("click",function() {
			clearInterval(animationTimer);
			$("#hidden").val($("#output").text());
			document.getElementById("nextPage").innerHTML = "<button type='submit' class='btn btn-block btn-lg <?php if(strtolower($_SESSION['spg_name']) == strtolower("spgsamsung")){ echo "btn-primary"; }else{ echo "btn-danger"; } ?>' id='stop'>Next</button>";

		});
	<?php } ?>
	</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
