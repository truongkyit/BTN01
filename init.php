<?php
require_once './vendor/autoload.php';
require_once 'config.php';
require_once 'functions.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$page = detectPage();
$currentUser =null;

$db = new PDO("mysql:host=$DB_HOST;dbname=$DB_NAME;charset=utf8", $DB_USER, $DB_PASSWORD);

if (isset($_SESSION['userId'])){
	$currentUser = findUserById($_SESSION['userId']);
}
