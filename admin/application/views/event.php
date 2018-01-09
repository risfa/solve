<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>SOLVE - PANEL</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url("/assets/css/bootstrap.min.css"); ?>" rel="stylesheet">

    

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<link href="<?php echo base_url("/assets/css/metisMenu.min.css");?>" rel="stylesheet">
	
	
    <!-- Timeline CSS -->
    <link href="<?php echo base_url("/assets/css/timeline.css");?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("/assets/css/sb-admin-2.css");?>" rel="stylesheet">
	<link href="<?php echo base_url("/assets/css/AdminLTE.min.css");?>" rel="stylesheet" type="text/css" />

    <!-- Morris Charts CSS -->
    <link href="<?php echo base_url("/assets/css/morris.css");?>" rel="stylesheet">
	
	<!-- DataTables CSS -->
    <link href="<?php echo base_url("/assets/css/dataTables.bootstrap.css");?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
	
  </head>

  <body>

   <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html"><img src="<?php echo base_url("/assets/images/SOLVE.png"); ?>" width="20px"/> SOLVE - PANEL</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li>
                            <a href="<?php echo base_url("/home/"); ?>"><i class="fa fa-home fa-fw"></i> Home</a>
                        </li>
						<li>
                            <a class="active" href="#"><i class="fa fa-flag fa-fw"></i> Event<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Event 1</a>
                                </li>
                                <li>
                                    <a href="#">Event 2</a>
                                </li>
								<li>
									<a href="#">Event 3</a>
								</li>
                            </ul>
                        </li>
						<li>
                            <a href="#"><i class="fa fa-child fa-fw"></i> Admin Event<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url("/admin_event_dashboard/"); ?>">Dashboard</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("/insert_team_leader/"); ?>">Insert Team Leader</a>
                                </li>
								<li>
									<a href="<?php echo base_url("/harga/"); ?>">Harga</a>
								</li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Team Leader<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url("/tl_event_dashboard/"); ?>">Dashboard</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("/insert_spg/"); ?>">Insert SPG</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Event name</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        
            <div class="row">
                <div class="col-lg-12">
					<div class="panel panel-default">
					  <div class="panel-body">
						<div id="chart_div" style="width: 100%; height: 400px;"></div>
					  </div>
					</div>
					
				</div>
				
				<br><br>
				
				<div class="col-lg-4">
					<div class="panel panel-default">
					  <div class="panel-body">
						<div id="piechart" style="width: 100%;"></div>
					  </div>
					</div>
					
				</div>
				
				<div class="col-lg-8">
					<div class="panel panel-default">
					  <div class="panel-body" style="padding-bottom:0px">
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
					</div>
				</div>
			</div>
            <!-- /.row -->
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Team Leaders
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
											<th>#</th>
                                            <th>Username</th>
                                            <th>No. Handphone</th>
                                            <th>Email</th>
                                            <th>Adress</th>
											<th>Gender</th>
											<th>Photo</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
										
                                        <tr class="odd gradeX">
                                            <td>1</td>
                                            <td>herospalada</td>
                                            <td>08975761496</td>
                                            <td>herospalada@gmail.com</td>
                                            <td>Jalan Petamburan Raya</td>
											<td>Laki-laki</td>
											<td></td>
											<td>
												<button type="button" class="btn btn-success btn-xs">Edit</button>
												<button type="button" class="btn btn-danger btn-xs">Delete</button>
											</td>
                                        </tr>
										
										<tr class="odd gradeX">
                                            <td>2</td>
                                            <td>tommybatman</td>
                                            <td>08973744329</td>
                                            <td>tommybatman@gmail.com</td>
                                            <td>Jalan Bintaro Raya</td>
											<td>Laki-laki</td>
											<td></td>
											<td>
												<button type="button" class="btn btn-success btn-xs">Edit</button>
												<button type="button" class="btn btn-danger btn-xs">Delete</button>
											</td>
                                        </tr>
										
										<tr class="odd gradeX">
                                            <td>3</td>
                                            <td>adihart</td>
                                            <td>08477262554</td>
                                            <td>adihart@gmail.com</td>
                                            <td>Jalan Pondok Indah Raya</td>
											<td>Laki-laki</td>
											<td></td>
											<td>
												<a href="<?php echo base_url("/edit_team_leader/"); ?>" class="btn btn-success btn-xs">Edit</a>
												<button type="button" class="btn btn-danger btn-xs">Delete</button>
											</td>
                                        </tr>
										
										<tr class="odd gradeX">
                                            <td>4</td>
                                            <td>Raden Ajeng</td>
                                            <td>08123345346</td>
                                            <td>radenajeng@gmail.com</td>
                                            <td>Jalan Condet Raya</td>
											<td>Laki-laki</td>
											<td></td>
											<td>
												<button type="button" class="btn btn-success btn-xs">Edit</button>
												<button type="button" class="btn btn-danger btn-xs">Delete</button>
											</td>
                                        </tr>
										
										<tr class="odd gradeX">
                                            <td>5</td>
                                            <td>imaniardiah</td>
                                            <td>0878266273773</td>
                                            <td>imaniardiah@gmail.com</td>
                                            <td>Jalan Cucur Raya</td>
											<td>Perempuan</td>
											<td></td>
											<td>
												<button type="button" class="btn btn-success btn-xs">Edit</button>
												<button type="button" class="btn btn-danger btn-xs">Delete</button>
											</td>
                                        </tr>
                                    </tbody>
                                </table>
								<a href="<?php echo base_url("/add_team_leader/"); ?>" class="btn btn-info btn-md"> + Add Team Leader</a>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
			</div>
            <!-- /.row -->
			
			<div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
					  <div class="panel-body">
							<form class="form-horizontal" enctype="multipart/form-data">
							  <div class="form-group">
								<label class="col-sm-2 control-label">Harga per paket</label>
								<div class="col-sm-10">
								  <input type="text" class="form-control" placeholder="example: 30000">
								</div>
							  </div>
							  <div class="form-group">
								<label class="col-sm-2 control-label"></label>
								<div class="col-sm-10">
								  <label style="color:red"><i>Error message here</i></label>
								</div>
							  </div>
							  <div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
								  <button type="submit" class="btn btn-info">Submit</button> 
								  <button onclick="goBack()" type="button" class="btn btn-default">Cancel</button>
								</div>
							  </div>
							</form>
					  </div>
					</div>
                </div>
			</div>
            <!-- /.row -->
			
        </div>
        <!-- /#page-wrapper -->
		
    </div>


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
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    
	<script src="<?php echo base_url("/assets/js/jquery.js"); ?>"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("/assets/js/bootstrap.min.js"); ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url("/assets/js/plugins/metisMenu/metisMenu.min.js"); ?>"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo base_url("/assets/js/plugins/morris/raphael.min.js"); ?>"></script>
    <script src="<?php echo base_url("/assets/js/plugins/morris/morris.min.js"); ?>"></script>
	
	<!-- DataTables JavaScript -->
    <script src="<?php echo base_url("/assets/js/plugins/dataTables/jquery.dataTables.js"); ?>"></script>
    <script src="<?php echo base_url("/assets/js/plugins/dataTables/dataTables.bootstrap.js"); ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url("/assets/js/sb-admin-2.js"); ?>"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#dataTables-example').dataTable();
		});
    </script>
  </body>
</html>
