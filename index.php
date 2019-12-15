<?php 
  require_once 'init.php';
  
  $posts = getNewFeeds();

  // Xử lý logic ở đây
?>
<?php include 'header.php'; ?>
<?php if($currentUser): ?>
<img style="width: 200px" src="./avatars/<?php echo $currentUser['id']; ?>.jpg">
<?php endif ?> 
<?php if($currentUser): ?>

<div class="container">
	<h1>Chào mừng <?php echo $currentUser['displayName']; ?> đã trở lại </h1>

		<form action = "createpost.php" method="POST">
		<div class ="form-group">
			<label for="content"><strong>Nội dung</strong></label>
			<textarea class="form-control" name="content" id="content" rows="1"></textarea>
		</div>
				
		<button type ="submit" class ="btn btn-primary">Đăng</button>
		</form>


	<div class="row">
	<?php foreach ($posts as $post): ?>
		<div class="col-sm-12">
			<div class="">
			<div class="card">
				<div class="card-body">
					<h5 class="card-title">
					<img style="width: 100px" class="card-img-top" src="avatars/<?php echo $post['userId'];?>.jpg" alt="<?php echo $post['displayName'];?>"> 
						<?php echo $post['displayName']; ?>
					</h5>
					<h6 class="card-subtitle mb-2 text-muted"><?php echo $post['createAT']; ?></h6>
					<p class="card-text">
						<?php echo $post['content']; ?>
					</p>
				</div>
			</div>
		</div>
</div>

<?php endforeach ?>
</div>
<?php else: ?>
<?php endif ?>


