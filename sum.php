<?php
    require_once 'init.php';
    if(!$currentUser){
        header('Location: index.php');
        exit();
    }
?>
<?php include 'header.php'; ?>
<h1>Bài tập tính tổng 2 số nhập từ bàn phím!</h1>
<?php if (isset($_POST['number1'])&& isset($_POST['number2'])):?>
<?php
    $number1=$_POST['number1'];
    $number2=$_POST['number2'];
    $sum=sum($number1,$number2);
?>
<div class="container alter alter-primary" roler="alert"> 
<span style="color: red">Kết quả tổng của hai số <?php echo $number1; ?> và <?php echo $number2;?> là <?php echo $sum; ?></span>

</div>
<?php else: ?>
<form action="sum.php" method="POST">
    <div class="form-group">
        <label for="number1">Số thứ nhất</label>
        <input type="number1" class="form-control" id="number1" name="number1" placeholder="Số thứ nhất">
    </div>
    <div class="form-group">
        <label for="number2">Số thứ hai</label>
        <input type="number2" class="form-control" id="number2" name="number2" placeholder="Số thứ hai">
    </div>
    <button type="sumit" class="btn btn-primary">Tính tổng</button>
</form>
<?php endif; ?>
<?php include 'footer.php'?>