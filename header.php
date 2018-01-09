<?php
	$string_header = "select * from ms_event where event_name = '".$_SESSION['event_name']."'";
	$query_header = mysql_query($string_header);
	
	if($rs_header = mysql_fetch_array($query_header)){
			$_SESSION['harga'] = $rs_header['harga'];
?>
	<nav class="navbar navbar-default navbar-fixed-top" style="background-color:<?php echo $rs_header['color']; ?>;box-shadow:0px 0px 5px #888;border:0px">
      <div class="container">
				<div class="navbar-header">
          
					 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<?php if(strtolower($_SESSION['event_name']) == strtolower("limadigit") || strtolower("Samsung Store")) { ?>
							<a class="navbar-brand" href="#" style="color:white">Registration & Get Your Luck!</a>
							<?php }else if(strtolower($_SESSION['event_name']) == strtolower("Lesehan Enduro")){ ?>
							<a class="navbar-brand" href="#" style="color:white">Lesehan Enduro</a>
							<?php }else{ ?>
							<a class="navbar-brand" href="#" style="color:white">Ardency Adprom</a>
							<?php } ?>
        </div>
				
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown active" style="background-color:#f5f5f5">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Welcome, <?php echo $_SESSION['spg_name']; ?> <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="process/do-logout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
			</div>
	</nav>
	
	<div class="container">

      <div class="col-lg-12">

			<center><img src="admin/files/<?php echo $_SESSION['event_name']; ?>/<?php $temp = json_decode($rs_header['image'], TRUE); echo $temp['banner_image']; ?>" width="200px"/></center>
<?php
	}
?>