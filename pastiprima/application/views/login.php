<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>SOLVE - LOGIN</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo base_url("/assets/theme/css/bootstrap.min.css"); ?>" rel="stylesheet">
    <link href="<?php echo base_url("/assets/theme/css/signin.css");?>" rel="stylesheet">
</head>

<body>

<div class="container">

    <form method="post"  class="form-signin"  id="login-form">
        <center><img src="<?php echo base_url("/assets/images/SOLVE.png") ?>" width="150px"/> </center>
        <br/>
        <div class='message' id="message"></div>
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" id="inputEmail" class="form-control" placeholder="Username" name="username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" name="password" required>
        <button class="btn btn-lg btn-primary btn-block" type="button" id="signin">Sign in</button>
    </form>

</div> <!-- /container -->


<script src="<?php echo base_url("/assets/theme/js/jquery.min.js"); ?>" ></script>
<script src="<?php echo base_url("/assets/theme/js/bootstrap.min.js"); ?>" ></script>
<script>
    $(document).ready(function () {
        $("#signin").click(function () {
           $.ajax({
              url : '<?=site_url('/login/process')?>',
              method : 'post',
              data : $('#login-form').serialize(),
               success : function (resp) {
                    var json=JSON.parse(resp);
                    if(json.status){
                        location.href='<?=site_url('/admin')?>';
                    }else{
                        $('#message').html(json.message);
                    }
               },
               failure : function (error) {

               }
           });
        });
    });
</script>
</body>
</html>
