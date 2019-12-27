<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="shortcut icon" href="https://i.ibb.co/vQNmtFp/logotrongsuot.png"/>

    <title>Sunshine chào mừng bạn đến với sunshine</title>
  </head>
  <body>
    <div class="container">
        <header>
            <img src="https://i.ibb.co/QmGD2NZ/testheader.png">
        </header>

        <nav>
            <div>
                <a href="index.php">Trang chủ</a>
            </div>
            <?php if (!$currentUser):?>  
            <div>
                <button type="button" name="btndangky" data-toggle="modal" data-target="#registerModal">Đăng ký</button>
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
                        <input type="text" class="form-control" style="display: unset; width:auto" id="displayName" name="displayName" placeholder="Your name">       
                        <input type="email" class="form-control" style="display: unset; width:auto" id="email" name="email" placeholder="Email">
                        <input type="password" class="form-control" style="display: unset; width:auto" id="password" name="password" placeholder="Password">
                    </div> 
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                    </div>      
                </form>
                </div>
                </div>
            </div>
            </div>
        
            
            <div>
                <button type="button" class="btn" data-toggle="modal" data-target="#loginModal">Đăng nhập</button>
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
                            <input type="email" class="form-control" style="display: unset; width:auto" id="email" name="email" placeholder="Email">
                            <input type="password" class="form-control" style="display: unset; width:auto" id="password" name="password" placeholder="Password">
        
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
                <a href='update_profile.php'>Cá nhân</a>
                <a href="friend.php">Bạn bè</a>
                <a href='message.php'>Tin nhắn</a>
                <a href='change_password.php' name="size">Đổi mật khẩu</a>
                <a href='logout.php';>Đăng Xuất</a>

                
            <?php endif; ?>

        </nav><br>
        <?php if (!$currentUser):?>  
        <article>
            <img style="height: 400px;width: 600px;" class="d-none d-md-block" src="https://demo.sngine.com/content/themes/default/images/home/drawkit-nature-man-colour.svg">
        </article>
        <aside style="background: aliceblue;height: 405px; width: 250px;">
        <marquee><h1 style="color: cadetblue;text-align: center;">Chào mừng <br>đến với <br>website <br>mạng xã<br> hội Sunshine</h1></marquee>
        </aside>
        <div class="clear"></div><br>
        <?php include 'footer.php' ?>
        <?php else: ?>
        <?php endif; ?>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
</html>