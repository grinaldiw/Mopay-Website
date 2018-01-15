<!doctype html>
<html class="no-js">
<head>
        <!-- Meta, title, CSS, favicons, etc. -->
                <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Login &middot; MOPAY </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <!--<link rel="shortcut icon" href="/favicon.ico">-->
        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="stylesheet" href="<?= base_url(); ?>dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>dist/css/veneto-admin.min.css">
        <link rel="stylesheet" href="<?= base_url(); ?>demo/css/demo.css">
        <link rel="stylesheet" href="<?= base_url(); ?>dist/assets/font-awesome/css/font-awesome.css">


        <!--[if lt IE 9]>
        <script src="dist/assets/libs/html5shiv/html5shiv.min.js"></script>
        <script src="dist/assets/libs/respond/respond.min.js"></script>
        <![endif]-->

    </head>
    <body class="body-sign-in">
    <div class="container">
        <div class="panel panel-default form-container">
            <div class="panel-body">
                <form role="form" id="form-login">
                    <center><img src="demo/images/logo.png" alt="Logo" width="250"></center>

                    <hr>
                    <div class="alert alert-danger text-center" id="empty" style="display: none;"><i class="fa fa-times"></i> Failed,
                        There are empty field
                    </div>
                    <div class="alert alert-danger text-center" id="failed" style="display: none;"><i class="fa fa-times"></i> Failed,
                        Wrong Username/Password
                    </div>
                    <div class="alert alert-success text-center" id="success" style="display: none;"><i class="fa fa-check"></i> Success,
                        Waiting for redirect ...
                    </div>
                    <div class="form-group text-center">
                        <label class="sr-only" for="email">Email Address</label>
                        <input type="text" class="form-control input-lg" name="email" placeholder="Email Address">
                    </div>
                    <div class="form-group text-center">
                        <label class="sr-only" for="password">Password</label>
                        <input type="password" class="form-control input-lg" name="password" placeholder="Password">
                    </div>

                    <button type="button" onclick="login();" class="btn btn-primary btn-block btn-lg">SIGN IN</button>
                </form>
            </div>
        </div>
    </div>

    <script src="dist/assets/libs/jquery/jquery.min.js"></script>
    <script>
        function login() {
            var data = $("#form-login").serialize();
            $("#empty").hide('slow');
            $("#failed").hide('slow');
            $("#success").hide('slow');
            $.ajax({
                url: 'login/login',
                type: 'POST',
                dataType: 'json',
                data: data,
                success: function (r) {
                    if (r.message == 'empty') {
                        $("#loader").hide('slow');
                        $("#empty").show('slow');
                    } else if (r.message == 'failed') {
                        $("#loader").hide('slow');
                        $("#failed").show('slow');
                    } else if (r.message == 'success') {
                        $("#loader").hide('slow');
                        $("#success").show('slow');
                        setTimeout(function () {
                            location.reload();
                        }, 2000);
                    } else {
                        alert('wrong');
                    }
                }
            });
        }
    </script>
</body>
</html>
