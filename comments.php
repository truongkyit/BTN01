<?php
require_once 'init.php';
if (!$currentUser){
	header('Location: index.php');
	exit();
}
$content = $_POST['tbbinhluan'];
$postId  = $_GET['id'];

upComments($postId,$currentUser['id'], $content);
header('Location: index.php');