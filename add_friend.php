<?php 
  require_once 'init.php';
  if (!$currentUser){
    header('Loacation: index.php');
    exit();
  }

  $userId = $_POST['id'];
  $profile = findUserById($userId);
  sendFriendRequest($currentUser['id'], $profile['id']);
  header('Loacation: profile.php?id=' . $_POST['id']);



