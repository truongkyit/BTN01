<?php
require_once('init.php');
$id = $_GET['id'];

$user = findUserById($id);

//JPEG header
header('content-type: image/jpeg');
echo $user['avatar'];