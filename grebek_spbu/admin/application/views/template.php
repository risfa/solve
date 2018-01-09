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

	
		<link href="<?php echo base_url("/assets/css/metisMenu.min.css");?>" rel="stylesheet">
	
	
    <!-- Timeline CSS -->
    <link href="<?php echo base_url("/assets/css/timeline.css");?>" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url("/assets/css/sb-admin-2.css");?>" rel="stylesheet">
		<link href="<?php echo base_url("/assets/css/AdminLTE.min.css");?>" rel="stylesheet" type="text/css" />
	
		<!-- DataTables CSS -->
    <link href="<?php echo base_url("/assets/css/dataTables.bootstrap.css");?>" rel="stylesheet">
    <link href="/solve/global_assets/datepicker/css/bootstrap-datepicker3.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
		
		
		<script type="text/javascript" src="<?php echo base_url("/assets/js/jquery-1.11.1.min.js") ?>"></script>
		
		<!-- DataTables JavaScript -->
    <script src="<?php echo base_url("/assets/js/plugins/dataTables/jquery.dataTables.js"); ?>"></script>
    <script src="<?php echo base_url("/assets/js/plugins/dataTables/dataTables.bootstrap.js"); ?>"></script>
		
		<script type="text/javascript">
			// google.load("visualization", "1", {packages:["corechart,table"]});

			function numberWithCommas(x) {
				var parts = x.toString().split(".");
				parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
				return parts.join(".");
			}
		</script>
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
								<?php if($this->session->userdata("status") === "admin") { ?>
                <a class="navbar-brand" href="<?php echo base_url("/admin_event_dashboard/"); ?>"><img src="<?php echo base_url("/assets/images/SOLVE.png"); ?>" width="20px"/> SOLVE - PANEL</a>
								<?php } else { ?>
                <a class="navbar-brand" href="<?php echo base_url("/tl_event_dashboard//"); ?>"><img src="<?php echo base_url("/assets/images/SOLVE.png"); ?>" width="20px"/> SOLVE - PANEL</a>
								<?php } ?>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
				<li></li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        Welcome, <?php echo $this->session->userdata("username"); ?>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url("/change_password/"); ?>"><i class="fa fa-lock fa-fw"></i> Change Password</a>
                        </li>                        
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url("/login/logout"); ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
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
											<?php if($this->session->userdata("status") === "admin") { ?>
												<li>
													<a href="#"><i class="fa fa-child fa-fw"></i> Admin Event<span class="fa arrow"></span></a>
													<ul class="nav nav-second-level collapse in" aria-expanded='true'>
                                <li>
                                    <a href="<?php echo base_url("/admin_event_dashboard/"); ?>" class="menu-a" id="1">Dashboard</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("/insert_team_leader/"); ?>" class="menu-a" id="2">Insert & Edit Team Leader</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
											<?php } else { ?>
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> Team Leader<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level collapse in" aria-expanded='true'>
                                <li>
                                    <a href="<?php echo base_url("/tl_event_dashboard/"); ?>" class="menu-a" id="3">Dashboard</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url("/insert_spg/"); ?>" class="menu-a" id="4">Insert  & Edit SPG</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
											<?php } ?>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <?php echo $content; ?>
		
    </div>
		
	<script type="text/javascript">
		function goBack() {
			window.history.back();
		}
	</script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url("/assets/js/bootstrap.min.js"); ?>"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url("/assets/js/plugins/metisMenu/metisMenu.min.js"); ?>"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url("/assets/js/sb-admin-2.js"); ?>"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			$('#dataTables-example').dataTable({
								"processing": true,
                "dom": '<"toolbar">frtip',
                "pageLength": 10,
                "stateSave": true
            });
			$('.menu-a').removeClass('active');
			$('#<?=$this->session->userdata('active')?>').addClass('active');
			$('#dataTables-example2').dataTable({
                "dom": '<"toolbar">frtip',
                "pageLength": 10,
                "stateSave": true
            });
		});
    </script>
  </body>
</html>
