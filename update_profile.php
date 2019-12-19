<?php
    ob_start();
?>
<?php 
  require_once 'init.php';
  if (!$currentUser){
    header('Loacation: index.php');
    exit();
  }

  // Xử lý logic ở đây
?>
<?php include 'header.php'; ?>
<h1> Cập nhật thông tin cá nhân </h1>
<?php if (isset($_POST['displayName']) && isset($_POST['phoneNumber'])) : ?>
  <?php
      
      $displayName= $_POST['displayName'];
      $phoneNumber= $_POST['phoneNumber'];
      $success =false;
      $displayName = $currentUser['displayName'];
      $avatar = $currentUser['avatar'];
      $success=true;
      

      if (isset($_FILES['avatar']) && $_FILES['avatar']['name']){
        $success =false;
        $file = $_FILES['avatar'];
        $fileName = $file['name'];
        $fileSize = $file['size'];
        $fileTemp = $file['tmp_name'];

        $newImage = resizeImage($fileTemp, 480, 480);
        ob_start();
        imagejpeg($newImage);
        $avatar =ob_get_contents();
        ob_end_clean();
        $success=true;
      }

      updateUserProfile($currentUser['id'], $displayName, $phoneNumber, $avatar);
  ?>
<?php if ($success): ?>
<?php header('Location: index.php'); 
  ob_end_flush();
?>
<?php else: ?>
<div class="alert alert-danger" role="alert">
    Cập nhật thông tin thất bại!!!
</div>
<?php endif; ?>
<?php else: ?>
<form  method="POST" enctype="multipart/form-data">    
    <div class ="form-group">
        <label for="displayName"><strong>Họ tên</strong></label>
        <input type ="text"class = "form-control"id ="displayName" name="displayName" value="<?php echo $currentUser['displayName'] ?>">
    </div>
    <div class ="form-group">
        <label for="phoneNumber"><strong>Số điện thoại</strong></label>
        <input type ="text"class = "form-control"id ="phoneNumber" name="phoneNumber" value="<?php echo $currentUser['phoneNumber'] ?>">
    </div>
    <div class ="form-group">
        <label for="avatar"><strong> Ảnh đại diện</strong></label>
        <input type ="file"class = "file"id ="avatar" name="avatar">
    </div>

    <button type ="submit" class ="btn btn-primary">Cập nhật thông tin cá nhân</button>
</form>
<?php endif; ?>
<?php include 'footer.php'; ?>
  


