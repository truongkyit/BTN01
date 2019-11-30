<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.css" rel="stylesheet"> <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <script src="js/jquery-1.11.1.min.js"></script>

    <title> SUNSHINE</title>

    <style>
            *{
                margin: 0px;
                padding: 0px;
            }
            body{
                background-image: url(4.jpg);
                background-size: cover;
                background-attachment: fixed;
                color: black;
                font-family: new time roman;
            }
    </style>

  </head>
  <body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-2">
                <a href="index.php"> Lập trình Web 1 </a>
            </div>
                <div class="col-xs-12 col-sm-12 col-md-2">
                    <button type="button" class="btn btn-danger btn-sm"
                    style="margin-top:30px" onclick="location.href='index.php';">HOME</button>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-2">
                    <button type="button" class="btn btn-danger btn-sm"
                    style="margin-top:30px" onclick="location.href='register.php';">Đăng kí</button>
                </div>

                <?php if (!$currentUser): ?>
                <div class="col-xs-12 col-sm-12 col-md-2">
                    <button type="button" class="btn btn-danger btn-sm"
                    style="margin-top:30px" onclick="location.href='login.php';">Đăng nhập</button>
                </div>
                <?php else: ?>

                <div class="col-xs-12 col-sm-12 col-md-2">
                    <button type="button" class="btn btn-danger btn-sm"
                    style="margin-top:30px" onclick="location.href='update_profile.php';">Cá nhân<?php echo $currentUser ? ' (' . $currentUser['displayName'] . ') ' : ''?></button>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-2">
                    <button type="button" class="btn btn-danger btn-sm"
                    style="margin-top:30px" onclick="location.href='change_password.php';">Đổi mật khẩu<?php echo $currentUser ? ' (' . $currentUser['displayName'] . ') ' : ''?></button>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-2">
                    <button type="button" class="btn btn-danger btn-sm"
                    style="margin-top:30px" onclick="location.href='logout.php';">Đăng Xuất<?php echo $currentUser ? ' (' . $currentUser['displayName'] . ') ' : ''?></button>
                </div>

                <?php endif; ?>
                </div>
        </nav>
