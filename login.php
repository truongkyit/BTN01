<?php
    ob_start();
?>

<?php
    require_once 'init.php';
?>
<?php include 'header.php'; ?>

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
<?php endif; ?>