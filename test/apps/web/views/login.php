<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>SOLVE - LOGIN</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url("/assets/css/bootstrap.min.css"); ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo base_url("/assets/css/signin.css");?>" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="<?php echo base_url("/assets/js/jquery-1.11.1.min.js");?>"></script>
    <script src="<?php echo base_url("/assets/js/ie-emulation-modes-warning.js");?>"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .form-signin{
            background: rgba(255,255,255,0.8);
        }
    </style>
</head>

<body>

<div class="container">

    <form class="form-signin" role="form" method="post">
        <center><img src="<?php echo base_url("/assets/images/SOLVE.png") ?>" width="150px"/> </center>
        <br/>
        <div class="text-danger text-center" id="error"></div>
        <br/>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
        <br/>
        <button class="btn btn-lg btn-primary btn-block" type="button" id="login">Sign in</button>
    </form>

</div> <!-- /container -->
<script>
    $(document).ready(function () {
        $('#login').click(function(){
            $.ajax({
               url : '<?php echo site_url().'/login/process'; ?>',
               data : {
                    username : $('[name="username"]').val(),
                    password : $('[name="password"]').val()
               },
               method : 'POST',
               beforeSend : function () {

               },
               success : function (obj) {
                    var result=JSON.parse(obj);
                    if(result.status==true){
                        location.href="<?php echo base_url(); ?>";
                    }else{
                        $('#error').html(result.message);
                    }
                    console.log(result);
               }
            });
            return false;
        });
    });
</script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="<?php echo base_url("/assets/js/ie10-viewport-bug-workaround.js"); ?>" ></script>
</body>
</html>
