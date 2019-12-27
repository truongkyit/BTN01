<?php
require_once 'init.php';
$friends = getFriends($currentUser['id']);
// var_dump($friends);
?>
<?php include 'header.php' ?>
<div class="container">
  <h1>Danh sách bạn bè</h1>
  <ul>
    <?php foreach ($friends as $friend) : ?>
  <li>
    <a href="profile.php?id=<?php echo $friend['id']; ?>"><?php echo $friend['displayName'] ?></a>
  </li>
  <?php endforeach; ?>
  </ul><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<?php include 'footer.php' ?>
