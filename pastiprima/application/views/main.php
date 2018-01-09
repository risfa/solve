
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

    <title>Solve 5D</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url("/assets/theme/css/bootstrap.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("/assets/theme/css/signin.css");?>" rel="stylesheet">
    <script src="<?php echo base_url("/assets/theme/js/jquery.min.js"); ?>" ></script>
    <style>
        html,
        body {
            height: 100%;
            background: #ffffff;
        }
        .main{
            min-height: 600px;
            padding-bottom: 30px;
        }
        .footer{
            background: #cbc6c1;
            padding: 10px;
            width: 100%;
            bottom: 0;
            position: fixed;
        }
        .navbar-inverse{
            background: #2e28c4;
        }
        .navbar-inverse .navbar-nav>li>a{
            color: #ffffff !important;
        }
    </style>
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=site_url('admin')?>">
                <img src="<?php echo base_url("/assets/images/SOLVE.png") ?>" height="40" style="top:-5px; position: relative" />
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?=site_url('/admin')?>">Dashboard</a></li>
                <?php
                if($status=="admin"){
                ?>
                <li><a href="<?=site_url('/manage_tl')?>">Manage TL</a></li>
                <?php }else{ ?>
                    <li><a href="<?=site_url('/manage_spg')?>">Manage SPG</a></li>
                <?php } ?>
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="background-color:transparent;color:#fff"><?php echo ucfirst($username); ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?=site_url('/login/logout')?>">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container-fluid" style="min-height: 100% !important;background: #ffffff;">
    <div class="row">
        <div class="col-sm-12 main">
            <?=$content?>
        </div>
    </div>
    <div class="row footer">
        <div class="col-sm-12">
            Copyright &copy; <?=date('Y')?> Solve 5D
        </div>
    </div>
</div>

<script src="<?php echo base_url("/assets/theme/js/bootstrap.min.js"); ?>" ></script>
</body>
</html>
