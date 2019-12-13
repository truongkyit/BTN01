<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>1760090</title>

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
                    <button type="button" class="btn btn-success" style="margin-top:30px" data-toggle="modal" data-target="#registerModal">Đăng ký</button>
                </div>
                <div class="modal fade" role="dialog" id="registerModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Đăng ký</h3>
                                <button type="button" class="close" data-dismiss="modal" >&times;</button>
                            </div> 

                            <div class="modal-body">
                            <form action="register.php" method="POST">
                                <div class="col-md-4">
                                    <input type="text" class="form-control" id ="displayName" name="displayName" placeholder="Your name">       
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                </div> 
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Đăng ký</button>
                                </div>      
                            </form>
                            </div>

                        </div>
                    </div>
                </div>

                <?php if (!$currentUser):?>
                <div class="col-xs-12 col-sm-12 col-md-2">
                    <button type="button" class="btn btn-success" style="margin-top:30px" data-toggle="modal" data-target="#loginModal">Đăng nhập</button>
                </div>
                <div class="modal fade" role="dialog" id="loginModal">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h3 class="modal-title">Đăng nhập</h3>
                                <button type="button" class="close" data-dismiss="modal" >&times;</button>
                            </div> 

                            <div class="modal-body">
                            <form action="login.php" method="POST">
                                <div class="col-md-4">
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                
                                </div> 
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Đăng nhập</button>
                                </div>      
                            </form>
                            </div>

                        </div>
                    </div>
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
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>