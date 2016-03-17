<?php 

header('Content-Type: text/html; charset=UTF-8');
session_start();
ini_set('error_reporting', E_ALL);

require('lib/general_functions.php');
require('lib/user_functions.php');
require('lib/article_functions.php');
require('lib/register_functions.php');

$options = array( PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', ); 
$con = new PDO("mysql:host=555555555;dbname=gyarb", "gyarb", "pass", $options);

if (logged_in() === true){
	$session_user_id = $_SESSION['user_id']; //spara privilegier i session också eller user_data
	$user_data = user_data($con, $session_user_id, 'user_id', 'username', 'password', 'email', 'access');
	if (user_active($con, $user_data['username']) === false){ //equal and of the same type ===
		session_destroy();
		header('Location: index.php');
		exit();
	}

}
$path = $_SERVER["SCRIPT_NAME"];
$file = basename($path); //variabel för filnamn om den behövs, kan vara överflödigt
$title = basename($path, '.php'); //variable to hold the title of the webpage, in most cases

?>