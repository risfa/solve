<!DOCTYPE html>
<html lang="en">
<head>
    <title>Pertamax Lucky Friday</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?=base_url('assets/theme')?>/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn span{padding-left:5px;padding-right:5px;width:100%;display:inline-block; text-align:left;}
        .btn span small{width:100%; display:inline-block; text-align:left;}
        .btn{
            margin-bottom: 10px;
        }
        .container{
            margin-top: 10%;
        }
        .footer{
            margin-top: 10% !important;
        }
    </style>
</head>

<body>

<!-- Fixed navbar -->
<div class="container">
    <div class="row">
        <div class="col-sm-12 text-center">
            <img src="<?=base_url('assets/images/logo.png')?>"  style="margin: auto;width: 200px;display: block"/>
            Pilih role untuk melanjutkan : <br/>
        </div>
    </div>
    <div class="row">
    <div class="col-sm-6 col-sm-offset-3" align="center">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <a class="btn btn-lg btn-danger btn-block" href="<?=base_url('assets/uploads/files/luckyday.apk')?>">
                    <i class="glyphicon glyphicon-user pull-left"></i>
                    <span>FO<br><small style="font-size:10px">App yang digunakan <br/>
                    FO untuk mengambil data.</small></span>
                </a>
            </div>
            <div class="col-md-6 col-sm-12">
                <a class="btn btn-lg btn-success btn-block" style="padding-right:30px" href="<?=site_url('/admin')?>/">
                    <i class="glyphicon glyphicon-dashboard pull-left"></i>
                    <span>Admin/TL<br><small style="font-size:10px">WebCMS yang digunakan <br/>
                    Team Leader dan Admin.</small></span>
                </a>
            </div>
        </div>
    </div>
    <div class="row footer">
        <div class="col-sm-12 text-center">
            <span>Copyright &copy; 2017 Solve 5D</span>
        </div>
    </div>
</div> <!-- /container -->
</div>
<script src="<?=base_url('assets/theme')?>js/bootstrap.min.js"></script>
</body>
</html>
