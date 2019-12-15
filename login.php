<?php
    ob_start();
?>
<?php
    require_once 'init.php';
?>

<?php if (isset($_POST['email'])&& isset($_POST['password'])):?>
<?php
    $email=$_POST['email'];
    $password=$_POST['password'];
    $success=false;

    $user = findUserByEmail($email);


    if($user && $user['status'] ==1 && password_verify($password, $user['password']))
    {
        $_SESSION['userId']=$user ['id'];
        $success=true;
    }
?>
<?php if($success): ?>

<?php header('Location: index.php');
    ob_end_flush();
?> 

<?php else: ?>
<div class="alter alter-danger" roler="alert"> 
    Đăng nhập thất bại
</div>
<?php endif;?>
<?php else: ?>
<form action="login.php" method="POST">
        <div class="col-md-4">
            <h1 class="text-center">Login</h1>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email">
            <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            <button type="sumit" class="btn btn-primary">Đăng nhập</button>
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
<?php include 'footer.php'?>