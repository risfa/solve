
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>CMS - Panel</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../bootstrap/docs/examples/blog/blog.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	<link href="../bootstrap/AdminLTE.min.css" rel="stylesheet" type="text/css" />
    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../bootstrap/assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="blog-masthead">
      <div class="container">
        <nav class="blog-nav">
          <a class="blog-nav-item active" href="#">Home</a>
          <a class="blog-nav-item" href="#">Team Leader</a>
		  <a class="blog-nav-item" href="#">Harga</a>
          
        </nav>
      </div>
    </div>

    <div class="container">

      <div class="blog-header" style="padding-bottom:0px">
        <h1 class="blog-title">Event Title</h1>
        <p class="lead blog-description">Event Moto</p>
      </div>

      <div class="row">

        <div class="col-sm-12 blog-main">
		
		
			<h2 class="page-header">Title 1</h2>
			
			<form class="form-inline">
			  <div class="form-group">
				<label>From</label>
				<input type="text" class="form-control">
			  </div>
			  <div class="form-group">
				<label>To</label>
				<input type="text" class="form-control">
			  </div>
			  <button type="submit" class="btn btn-default">Submit</button>
			</form>
			
			<br>
			<div class="col-lg-12" style="margin-bottom:30px">
				<div id="chart_div" style="width: 100%; height: 400px;"></div>
			</div>
			<br><br>
			<div class="col-lg-4">
				<div id="piechart" style="width: 100%; height: 210px;"></div>
			</div>
			
			<div class="col-lg-8">
				<div class="col-md-12 col-sm-6 col-xs-12" style="padding:0px">
				  <div class="info-box bg-aqua">
					<span class="info-box-icon"><i class="fa fa-cart-plus"></i></span>
					<div class="info-box-content">
					  <span class="info-box-text">Total Paket</span>
					  <span class="info-box-number">41,410</span>
					  <div class="progress">
						<div class="progress-bar" style="width: 70%"></div>
					  </div>
					  <span class="progress-description">
						From Date - To Date
					  </span>
					</div><!-- /.info-box-content -->
				  </div><!-- /.info-box -->
				</div>
				
				<div class="col-md-12 col-sm-6 col-xs-12" style="padding:0px">
				  <div class="info-box bg-green">
					<span class="info-box-icon"><i class="fa fa-money"></i></span>
					<div class="info-box-content">
					  <span class="info-box-text">Total Harga</span>
					  <span class="info-box-number">41,410,120</span>
					  <div class="progress">
						<div class="progress-bar" style="width: 70%"></div>
					  </div>
					  <span class="progress-description">
						From Date - To Date
					  </span>
					</div><!-- /.info-box-content -->
				  </div><!-- /.info-box -->
				</div>
			</div>
			
			<div class="col-lg-4">
			</div>

        </div><!-- /.blog-main -->

        <!--<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
          <div class="sidebar-module sidebar-module-inset">
            <h4>About Event</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div>
          <div class="sidebar-module">
            <h4>ArcEvent Name</h4>
            <ol class="list-unstyled">
              <li><a href="#">Event 1</a></li>
              <li><a href="#">Event 2</a></li>
              <li><a href="#">Event 3</a></li>
              <li><a href="#">Event 4</a></li>
              <li><a href="#">Event 5</a></li>
              <li><a href="#">Event 6</a></li>
              <li><a href="#">Event 7</a></li>
              <li><a href="#">Event 8</a></li>
              <li><a href="#">Event 9</a></li>
              <li><a href="#">Event 10</a></li>
              <li><a href="#">Event 11</a></li>
              <li><a href="#">Event 12</a></li>
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Elsewhere</h4>
            <ol class="list-unstyled">
              <li><a href="#">GitHub</a></li>
              <li><a href="#">Twitter</a></li>
              <li><a href="#">Facebook</a></li>
            </ol>
          </div>
        </div><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </div><!-- /.container -->
	<br><br><br>
    <footer class="blog-footer">
      <p>CMS for Solve by <a href="http://limadigit.com">Limadigit</a>.</p>
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
		google.load("visualization", "1", {packages:["corechart"]});
		google.setOnLoadCallback(drawVisualization);

		function drawVisualization() {
		  // Some raw data (not necessarily accurate)
		  var data = google.visualization.arrayToDataTable([
			['Month', 'Leader 1', 'Leader 2', 'Leader 3', 'Leader 4', 'Leader 5', 'Rata-rata'],
			['2004/05',  165,      938,         522,             998,           450,      614.6],
			['2005/06',  135,      1120,        599,             1268,          288,      682],
			['2006/07',  157,      1167,        587,             807,           397,      623],
			['2007/08',  139,      1110,        615,             968,           215,      609.4],
			['2008/09',  136,      691,         629,             1026,          366,      569.6]
		  ]);

		  var options = {
			title : 'Daily Sales',
			vAxis: {title: "Package"},
			hAxis: {title: "Daily"},
			seriesType: "bars",
			series: {5: {type: "line"}}
		  };

		  var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
		  chart.draw(data, options);
		}
		
		google.load("visualization", "1", {packages:["corechart"]});
		google.setOnLoadCallback(drawChart);
		function drawChart() {

		var data = google.visualization.arrayToDataTable([
		  ['Task', 'Hours per Day'],
		  ['Male',     11],
		  ['Female',      15]
		]);

		var options = {
		  title: 'Gender'
		};

		var chart = new google.visualization.PieChart(document.getElementById('piechart'));

		chart.draw(data, options);
		}
    </script>
	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="../bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
