<?php
    ob_start();
?>
<?php
    require_once 'init.php';
?>
<?php include 'header.php'; ?>
 
<?php if (isset($_GET['code'])):?>
<?php
    $code=$_GET['code'];
    $success=false;

    $success = activateUser($code);

?>
<?php if($success): ?>

<?php header('Location: index.php');
    ob_end_flush();
?>
<?php else: ?>
<div class="alter alter-danger" roler="alert"> 
    Kích hoạt tài khoản thất bại
</div>
<?php endif;?>
<?php else: ?>
<form method="GET">
        <div class="col-md-4">
            <h1 class="text-center">Kích hoạt tài khoản</h1>
            <input type="text" class="form-control" id="code" name="code" placeholder="Mã kích hoạt">
            <button type="sumit" class="btn btn-primary">Kích hoạt tài khoản</button>
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
