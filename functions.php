<?php
require_once './vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function detectPage(){
	$uri = $_SERVER['REQUEST_URI'];
	$parts = explode('/', $uri);
	$fileName = $parts[2];
	$parts=explode('.', $fileName);
	$page = $parts[0];
	return $page;
}
function findUserByEmail($email)
{
	global $db;
	$stmt = $db->prepare ("SELECT * FROM users WHERE email = ?");
	$stmt->execute(array($email));
	return $stmt->fetch(PDO::FETCH_ASSOC);
}
function findUserById($id)
{
	global $db;
	$stmt = $db->prepare ("SELECT * FROM users WHERE id = ?");
	$stmt->execute(array($id));
	return $stmt->fetch(PDO::FETCH_ASSOC);
}
function updateUserPassword($id, $password){
	global $db;
	$hashPassword = password_hash($password, PASSWORD_DEFAULT);
	$stmt = $db->prepare("UPDATE users SET password =? WHERE id = ?");
    return $stmt->execute (array($hashPassword, $id));
}
function createUser($displayName, $email,$password){
	global $db, $BASE_URL;
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    $code = generateRandomString(16);
	$stmt = $db->prepare("INSERT INTO users (displayName, email, password, status, code) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute (array($displayName, $email, $hashPassword, 0, $code));
    $id = $db->lastInsertId();
    sendEmail($email, $displayName, 'Kích hoạt tài khoản', "Mã kích hoạt tài khoản của bạn là <a href=\"$BASE_URL/activate.php?code=$code\">$BASE_URL/activate.php?code=$code</a>");
    return $id;
}

function updateUserProfile($id, $displayName , $phoneNumber, $avatar){
	global $db;
	$stmt = $db->prepare("UPDATE users SET displayName = ?, phoneNumber = ?, avatar = ? WHERE id = ?");
    return $stmt->execute (array($displayName, $phoneNumber, $avatar, $id));
}


function resizeImage($filename, $max_width, $max_height)
{
  list($orig_width, $orig_height) = getimagesize($filename);

  $width = $orig_width;
  $height = $orig_height;

  # taller
  if ($height > $max_height) {
      $width = ($max_height / $height) * $width;
      $height = $max_height;
  }

  # wider
  if ($width > $max_width) {
      $height = ($max_width / $width) * $height;
      $width = $max_width;
  }

  $image_p = imagecreatetruecolor($width, $height);

  $image = imagecreatefromjpeg($filename);

  imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);

  return $image_p;
}

function getNewfeeds(){
    global $db;
    $stmt=$db->query("SELECT u.displayName,p.* FROM users AS u JOIN posts as p WHERE u.id= p.userId ORDER BY p.createAT DESC");
    $stmt->execute();
    return $stmt -> fetchAll(PDO::FETCH_ASSOC);
}
// function getNewcomments(){
//     global $db;
//     $stmt=$db->query("SELECT u.displayName,p.* FROM users AS u JOIN comments as cmt WHERE u.id= cmt.userId ORDER BY cmt.createAT DESC");
//     $stmt->execute(); 
//     return $stmt -> fetchAll(PDO::FETCH_ASSOC);
// }
function getcomment($id){
    global $db;
	$stmt = $db->prepare ("SELECT * FROM comments WHERE postId = ?");
    $stmt->execute(array($id));
    $posts = $stmt -> fetchAll(PDO::FETCH_ASSOC);
    return  $posts;
}

function createPost($userid, $content,$img){
	global $db;
	$stmt = $db->prepare("INSERT INTO posts ( content, userid,img) VALUES (?, ?,?)");
    $stmt->execute (array($content, $userid,$img));
    return $db->lastInsertId();
}
function upComments($postId, $userId,$content){
	global $db;
	$hashPassword = password_hash($password, PASSWORD_DEFAULT);
	$stmt = $db->prepare("INSERT INTO comments (postId,userId,content) VALUES (? , ?,?)");
    $stmt->execute (array($postId, $userId,$content));
    return $db->lastInsertId();
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function sendEmail($to, $name, $subject, $content){
    global $EMAIL_FROM, $EMAIL_NAME, $EMAIL_PASSWORD;

    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    //Server settings           // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->CharSet    = 'UTF-8';  
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = $EMAIL_FROM;                     // SMTP username
    $mail->Password   = $EMAIL_PASSWORD;                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to
    
    //Recipients
    $mail->setFrom($EMAIL_FROM, $EMAIL_NAME);
    $mail->addAddress($to, $name);     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $content;
    // $mail->AltBody = $content;

    $mail->send();
}

function activateUser($code){
    global $db;
	$stmt = $db->prepare ("SELECT * FROM users WHERE code = ? AND status = ?");
	$stmt->execute(array($code, 0));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if($user && $user['code'] == $code )
    {
        $stmt = $db->prepare("UPDATE users SET code = ?, status = ? WHERE id = ?");
        $stmt->execute(array(' ', 1, $user['id']));
        return true;
    }
    return false;
}

function sendFriendRequest($userId1, $userId2){
    global $db;
    $stmt = $db->prepare("INSERT INTO friendship (userId1, userId2) VALUE(?, ?)");
    $stmt->execute (array($userId1, $userId2));
}

function removeFriendRequest($userId1, $userId2){
    global $db;
    $stmt = $db->prepare("DELETE FROM friendship WHERE (userId1 = ? AND userId2 = ?) OR (userId2 = ? AND userId1 = ?)");
    $stmt->execute (array($userId1, $userId2, $userId1, $userId2));
}

function getFriends($userId) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM friendship WHERE userId1 = ? OR userId2 = ?");
    $stmt->execute(array($userId, $userId));
    $followings = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $friends = array();
    for ($i = 0; $i < count($followings); $i++) {
      $row1 = $followings[$i];
      if ($userId == $row1['userId1']) {
        $userId2 = $row1['userId2'];
        for ($j = 0; $j < count($followings); $j++) {
          $row2 = $followings[$j];
          if ($userId == $row2['userId2'] && $userId2 == $row2['userId1']) {
            $friends[] = findUserById($userId2);
          }
        }
      }
    }
    return $friends;
  }
  
  function isFollow($userId1, $userId2) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM friendship WHERE userId1 = ? AND userId2 = ?");
    $stmt->execute(array($userId1, $userId2));
    $user1ToUser2 = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$user1ToUser2) {
      return false;
    }
    $stmt = $db->prepare("SELECT * FROM friendship WHERE userId1 = ? AND userId2 = ?");
    $stmt->execute(array($userId2, $userId1));
    $user2ToUser1 = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user2ToUser1) {
      return false;
    }
    return true;
  } 
  
  function unfriend($userId1, $userId2) {
    global $db;
    $stmt = $db->prepare("DELETE FROM friendship WHERE userId1 = ? AND userId2 = ?");
    $stmt->execute(array($userId1, $userId2));
    $stmt = $db->prepare("DELETE FROM friendship WHERE userId1 = ? AND userId2 = ?");
    $stmt->execute(array($userId2, $userId1));
  }
  

  
  function acceptFriendRequest($userId1, $userId2) {
    global $db;
    $stmt = $db->prepare("INSERT INTO friendship(userId1, userId2) VALUES(?, ?)");
    $stmt->execute(array($userId1, $userId2));
  }
  
  function rejectFriendRequest($userId1, $userId2) {
    global $db;
    $stmt = $db->prepare("DELETE FROM friendship WHERE userId1 = ? AND userId2 = ?");
    $stmt->execute(array($userId2, $userId1));
  }
  
  function cancelFriendRequest($userId1, $userId2) {
    global $db;
    $stmt = $db->prepare("DELETE FROM friendship WHERE userId1 = ? AND userId2 = ?");
    $stmt->execute(array($userId1, $userId2));
  }
  
  function getLatestConversations($userId) {
    global $db;
    $stmt = $db->prepare("SELECT userId2 AS id, u.displayName, u.hasAvatar FROM messages AS m LEFT JOIN users AS u ON u.id = m.userId2 WHERE userId1 = ? GROUP BY userId2 ORDER BY createdAt DESC");
    $stmt->execute(array($userId));
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    for ($i = 0; $i < count($result); $i++) {
      $stmt = $db->prepare("SELECT * FROM messages WHERE userId1 = ? AND userId2 = ? ORDER BY createdAt DESC LIMIT 1");
      $stmt->execute(array($userId, $result[$i]['id']));
      $lastMessage = $stmt->fetch(PDO::FETCH_ASSOC);
      $result[$i]['lastMessage'] = $lastMessage;
    }
    return $result;
  }
  
  function getMessagesWithUserId($userId1, $userId2) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM messages WHERE userId1 = ? AND userId2 = ? ORDER BY createdAt");
    $stmt->execute(array($userId1, $userId2));
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
  
  function sendMessage($userId1, $userId2, $content) {
    global $db;
    $stmt = $db->prepare("INSERT INTO messages (userId1, userId2, content, type, createdAt) VALUE (?, ?, ?, ?, CURRENT_TIMESTAMP())");
    $stmt->execute(array($userId1, $userId2, $content, 0));
    $id = $db->lastInsertId();
    $stmt = $db->prepare("SELECT * FROM messages WHERE id = ?");
    $stmt->execute(array($id));
    $newMessage = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = $db->prepare("INSERT INTO messages (userId2, userId1, content, type, createdAt) VALUE (?, ?, ?, ?, ?)");
    $stmt->execute(array($userId1, $userId2, $content, 1, $newMessage['createdAt']));
  }
