<?php
require_once './vendor/autoload.php';
require_once ('config.php');
require_once ('functions.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();


$page = detectPage();


$db = new PDO($DNS, $DB_USER, $DB_PASSWORD);

$currentUser =null;
if (isset($_SESSION['userId'])){
	$currentUser = findUserById($_SESSION['userId']);
}
