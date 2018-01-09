<?php
	$string_footer = "select * from ms_event where event_name = '".$_SESSION['event_name']."'";
	$query_footer = mysql_query($string_footer);
	
	if($rs_footer = mysql_fetch_array($query_footer)){
?>
	<footer class="footer" style="background-color:<?php echo $rs_footer['color']; ?>;box-shadow:0px 0px 5px #888;border:0px">
<?php 
	}else{
?>
	<footer class="footer" style="background-color:#888;box-shadow:0px 0px 5px #888;border:0px">
<?php } ?>
	  <div class="container " style="padding-top:19px">
		  <small class="pull-right" style="color:white">&copy; Copyright Limadigit 2017 &nbsp;&nbsp;&nbsp;<img class="pull-right" src="<?php echo $path ?>images/SOLVE5D.png" width="110px"/> </small>
	  </div>
	  
		
	
	</footer>