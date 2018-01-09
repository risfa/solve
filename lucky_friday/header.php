<nav class="navbar navbar-default navbar-fixed-top" style="background-color:#191970;box-shadow:0px 0px 5px #888;border:0px">
<div class="container">  
			<div class="navbar-header">
	  
				 <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" style="border:0px solid transparent" >
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar" style="background-color:#fff"></span>
							<span class="icon-bar" style="background-color:#fff"></span>
							<span class="icon-bar" style="background-color:#fff"></span>
						</button>
						
						<a class="navbar-brand" href="#" style="color:white">PERTAMAX LUCKY FRIDAY</a>						
	</div>
	<?php
		if(!isset($flagIndexLogin)){
	?>
	<div id="navbar" class="navbar-collapse collapse">
	  <ul class="nav navbar-nav navbar-right">
        <li>
            <a href="form-spbu.php" style="background-color:transparent;color:#fff">Ganti SPBU <?=((!empty($spbuActive))? "( SPBU Aktif : ".$spbuActive.")" : "")?></a>
        </li>
		<li class="dropdown active">
		  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="background-color:transparent;color:#fff"><?php echo ucfirst($sesUsername); ?><span class="caret"></span></a>
		  <ul class="dropdown-menu" role="menu">
			<li><a href="process/do-logout.php">Keluar</a></li>
		  </ul>
		</li>
	  </ul>
	</div>
	<?php } ?>
		</div>
</nav>

<div class="container">

  <div class="col-lg-12">

		<center><img src="images/logo_lucky.png" width="200px"/></center>
