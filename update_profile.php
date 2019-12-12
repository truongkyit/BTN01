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
    $phoneNumber = $_POST['phoneNumber'];
    $success =false;
    if($displayName !=''){
      $displayName= $currentUser['displayName'];
      updateUserProfile($currentUser['id'],$displayName, $phoneNumber);
      $success=true;
    }

   if (isset($_FILES['avatar']) && $_FILES['avatar']['name']){
      $success =false;
      $file = $_FILES['avatar'];
      $fileName = $file['name'];
      $fileSize = $file['size'];
      $fileTemp = $file['tmp_name'];

      $filePath = './avatars/' . $currentUser['id'] . '.jpg';
      $success = move_uploaded_file($fileTemp, $filePath);
      $newImage = resizeImage($filePath, 400, 400);
      ob_start();
      imagejpeg($newImage);
      $data= ob_get_contents();
      ob_end_clean();
      $success =true;
    }
?>
<?php if ($success): ?>
<?php header('Location: index.php'); ?>
<?php else: ?>
<div class="alert alert-danger" role="alert">
    Cập nhật thông tin thất bại!!!
</div>
<?php endif; ?>
<?php else: ?>
<form  method="POST" enctype="multipart/form-data">    
    <div class ="form-group">
        <label for="displayName"><strong> Họ tên</strong></label>
        <input type ="text"class = "form-control"id ="displayName" name="displayName" aria-describedby="numHelp" value="Họ tên " value="<?php echo $currentUser['displayName']; ?>">
        <small id="numHelp" class ="form-text text-muted"> Hãy nhập họ tên cần thay đổi !!<
    </div>
    <div class="alert alert-danger" role="alert">
        <label for="phoneNumber">Số Điện Thoại</strong></label>
        <input type ="text"class = "form-control"id ="phoneNumber" name="phoneNumber"aria-describedby="numHelp" placeholder="<?php echo $currentUser['phoneNumber']; ?>">
        <small id="numHelp" class ="form-text text-muted"> Hãy nhập số điện thoại cần thay đổi !!<
    </div>
    <div class="alert alert-danger" role="alert">
    <div class ="form-group">
        <label for="avatar"><strong> Đổi Ảnh Avatar</strong></label>
        <input type ="file"class = "file"id ="avatar" name="avatar">
    </div>

    <button type ="submit" class ="btn btn-primary">Cập nhật thông tin cá nhân</button>
</form>
<?php endif; ?>
<?php include 'footer.php'; ?>
  


