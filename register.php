<?php 
  require_once 'init.php';

  // Xử lý logic ở đây
?>
<?php include 'header.php'; ?>
<?php if (isset($_POST['displayName']) &&isset($_POST['email']) && isset($_POST['password'])) : ?>
<?php
    $displayName= $_POST['displayName'];
    $email = $_POST['email'];
    $password= $_POST['password'];
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);

    $success =false;

    $user = findUserByEmail($email);

    if(!$user){
      $newUserId = createUser($displayName, $email,$password);
    //   $_SESSION['userId'] = $newUserId;
    $success=true;
    }
?>
<?php if ($success): ?>
<div class="alert alert-success" role="alert">
    Vui lòng kiểm tra email để kích hoạt tài khoản!!
</div>
<?php else: ?>
<div class="alert alert-success" role="alert">
    Đăng kí thất bại!!
</div>
<?php endif; ?>
<?php else: ?>
<form action = "register.php" method="POST">
    <div class="col-md-4">
        <h1 class="text-center">Register</h1>
        <input type="text" class="form-control" id ="displayName" name="displayName" placeholder="Your name">
        <input type="email" class="form-control" id ="email" name="email" placeholder="Email">
        <input type="password" class="form-control" id ="password" name="password" placeholder="Password">
        <button type ="submit" class ="btn btn-primary">Đăng ký</button>
    </div>
    <style>
            .form-control{
                background: #222A0A;
                border-radius: 0px;
                color: while;
                font-size: 24px;
                padding: 23px;
                margin-top: 10px;
                border: 0px;
                border-bottom: 2px solid gray;
            }
        </style>
</form>
<?php endif; ?>
<?php include 'footer.php'; ?>
  


