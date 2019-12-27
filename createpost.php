<?php
require_once 'init.php';
if (!$currentUser){
	header('Location: index.php');
	exit();
}
$content = $_POST['content'];


if(isset($_POST['index_post'])){
     $check = getimagesize($_FILES["picturepost"]["tmp_name"]);
     if($check !== false) {
        $FILES =$_FILES['picturepost'];
        $fileName = $FILES['name'];
        $fileSize = $FILES['size'];
        $fileTemp = $FILES['tmp_name'];
          $newImage = resizeImage($fileTemp, 480, 480);
          ob_start();
          imagejpeg($newImage);
          $postImage=ob_get_contents();
          ob_end_clean();

          createPost($currentUser['id'],$content,$postImage);
        }else {
             $postImage=null;
        
            createPost($currentUser['id'],$content,$postImage);
        }
}


	// $FILES =$_FILES['picture_post_icon'];
	// var_dump($$FILES);
	// $fileName = $_FILES['name'];
	// $fileSize = $_FILES['size'];
	// $fileTemp = $_FILES['tmp_name'];
	// $newImage = resizeImage($fileTemp, 480, 480);
	// ob_start();
	// imagejpeg($newImage);
	// $postImage =ob_get_contents();
	// ob_end_clean();
	// createPost($currentUser['id'], $content,$postImage);

//createPost($currentUser['id'], $content);
//header('Location: index.php');