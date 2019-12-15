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

<?php endif; ?>
<?php include 'footer.php'; ?>
  


