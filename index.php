<?php 
  require_once 'init.php';
  
  $posts = getNewFeeds();
  // Xử lý logic ở đây
?>
<?php include 'header.php'; ?>
<?php if($currentUser): ?>

	<style>
		.user-info::after {
		content: "";
		clear: both;
		display: table
		}
		.comment::after {
			content: "";
			clear: both;
			display: table
		}
		.cmtavt img {
				margin-left: 30px;
		}
		.avtar img{
			width: 50px;
			height: 50px;
			border-radius: 25px;
			margin-right: 10px;
		}
		.comment .cmtavt img{
			width: 40px;
			height: 40px;
			border-radius: 20px;
			margin-right: 10px;
		}
		.user1 .time, .cmtcontent .cmt-action span {
			font-size: 0.75em;
		}
		.user1 .name,.cmtcontent .cmt-name a {
			font-weight: bold;
		}
		.avtar{
			float:left;
		}
		.cmtavt{
			float:left;
		}
		.action .bl{
			margin-left: 100px;
			margin-right: 100px;
		}
		.action {
			list-style:none;
			margin-bottom: 10px;
		}
		.action li{
			display: inline-block;
		}
		.feed .img img {
			width:500px;
			height: 300px;
			margin-top: 10px;
		}
		.feed{
			width:500px;
		}
		.cmt-action a{
			margin-right: 50px;
			margin-left: 10px;
		}
		.writecmt input{
				margin-bottom: 80px;
				width: 500px;
				border-radius: 7px;
		}
		#like{
			margin-right: 350px;
		}
		.soluotlike{
			margin-left: 40px;
			margin-bottom: -10px;
		}
		.cmtcontent{
			font-size: 0.85em;
		}
		#feed-1 .comment {
			margin-top: 5px;
		}
		#feed-morecmt{
			color:blue;
		}

		#nav-trencung{
			width: 100%;
			position: fixed;
		}
		#icon-user{
			margin-left: 120px;
			margin-right: 30px;
		}
		#icon-user img{
			width:30px;
			height:30px;
			border-radius: 15px;
		}
		#icon-logout{
			margin-left: 225px;
		}
	</style>


<div class="container">
	<h1>Chào mừng <?php echo $currentUser['displayName']; ?> đã trở lại </h1>

		<form action = "createpost.php" method="POST"enctype="multipart/form-data">
		<div class ="form-group">
			<label for="content"><strong>Nội dung</strong></label>
			<textarea  class="form-control" name="content" id="content" style="height: 100px;width: 500px;" rows="1"></textarea>
			<input name="picturepost" id="picturepost" type ="file"class = "form-control-file"id ="avatar1" name="avatar1">
			<button type ="submit" name="index_post" id="index_post"class ="btn btn-primary">Đăng</button>
		</div>		
		
		</form><br><br>

		<div id="BangTin">
		<div class="container" >
			<?php foreach ($posts as $post): ?>
			<div class="page-1">
			<div id="feed-1" class="feed">
						<div class="user-info">
							<div class="avtar">
								<a href="" title="">
									<?php if($currentUser): ?>
										<img src="avatar.php?id=<?php echo $currentUser['id']; ?>">  
									<?php endif; ?>
								</a>
							</div>
							<div class="user1">
								<div class="name">
									<a href="" title="" ><?php echo $post['displayName'];?></a>
								</div> 
								<div class="time">
								<?php echo $post['createAT']; ?>
								</div>
							</div>
						</div>
						<div class="desc">
							<?php echo $post['content']; ?>
						</div>
						 <?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $post['img']).'"/class="rounded mx-auto d-block" style="width:70% ">'?>
						
						<div><br>
							<form action = "comments.php?id=<?php echo $post['id'] ?>" method="POST">
								<div>
									<input type="textbox" style="float: right;width: 440px;height: 40px;border-radius: 11px;" name="tbbinhluan" placeholder="Viết bình luận...">
									<?php if($currentUser): ?>
									<img src="avatar.php?id=<?php echo $currentUser['id']; ?>" style="width: 40px;height: 40px;border-radius: 25px;margin-right: 10px;"> 
									<?php endif; ?>
								</div>
							</form>
						</div><br>

						<?php $comments =getcomment($post['id']); ?>
						<?php foreach ($comments as $comment): ?>
							<div class="card" style="background-color: #e2e1d9;width: 400px;">
							<p style="font-size:15px;"> <?php echo $comment['content']; ?></p>
							</div><br>
							<?php endforeach ?>
					</div>
					<?php endforeach ?>
					<button id="feed-more" onclick="setTime()" class="btn btn-outline-primary"><i class="fas fa-arrow-alt-circle-down "> Xem thêm ...</i> </button><br>
						<i class="fas fa-spinner fa-spin fa-pulse fa-5x" id="feed-9"></i>
						<div id="feed-end" style="display: none;"><strong>Đã hết!</strong></div>
</div>
<?php else: ?>
<?php endif ?>

<?php if($currentUser): ?>
<img src="avatar.php?id=<?php echo $currentUser['id']; ?>">
<?php endif; ?>

