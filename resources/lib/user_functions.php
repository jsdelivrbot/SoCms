<?php

/*User functions*/
function logged_in() {
	return (isset($_SESSION['user_id'])) ? true : false; //qt
}

function user_exists($con, $username)	{
	
	$query = "SELECT COUNT(`user_id`) FROM `users` WHERE `username` = :username";
	$result = $con->prepare($query);
	$result->bindParam("username" , $username);
	$result->execute();
	
	return ($result->fetchColumn() == 1) ? true : false;
}

function user_active($con, $username)	{
	
	$query = "SELECT COUNT(`user_id`) FROM `users` WHERE `username`= :username AND `active` = 1";
	$result = $con->prepare($query);
	$result->bindParam("username" , $username);
	$result->execute();
	
	return ($result->fetchColumn() == 1) ? true : false;
}

function change_password($con, $user_id, $password) {
	$user_id = (int)$user_id;
	$password = md5($password);

	$query = "UPDATE `users` SET `password` = :password WHERE `user_id` = :user_id";
	$result = $con->prepare($query);
	$result->bindParam("password" , $password);
	$result->bindParam("user_id" , $user_id);
	$result->execute();
	
	return ($result->fetchColumn() == 1) ? true : false;
	
}

function register_user($con, $register_data) {
	$register_data['password'] = md5($register_data['password']);

	$fields = '`' . implode('`, `', array_keys($register_data)) . '`';
	$data = '\'' . implode('\', \'', $register_data) . '\'';

	$query = "INSERT INTO `users` ($fields) VALUES ($data)";
	$result = $con->prepare($query);
	$result->execute();
	email($register_data['email'], 'Activate your account', "Hello " . $register_data['first_name'] . ",
	\n\n To activate your account click the link below:\n\n http://https://gyarb-c9-theswolegeek.c9.io/activate.php?email=" . 
	$register_data['email'] . "&email_code=" . $register_data['email_code'] . "\n\n- Gyarbete");
	return ($result->fetchColumn() == 1) ? true : false;
}

function login($con, $username, $password) {
	
	$user_id = user_id_from_username($con, $username);
	$username = $username;
	$password = md5($password);
	
	$query = "SELECT COUNT(`user_id`) FROM `users` WHERE `username` = :username AND `password` = :password AND `active` = 1";
	
	$result = $con->prepare($query);
	$result->bindParam("username" , $username);
	$result->bindParam("password" , $password);
	$result->execute();
	
	return ($result->fetchColumn() == 1) ? $user_id : false;
	
}

function user_id_from_username($con, $username) {
	$query = "SELECT `user_id` FROM `users` WHERE `username` = :username";
	$result = $con->prepare($query);
	$result->bindParam("username" , $username);
	$result->execute();
	return $result->fetchColumn();
}

function user_data($con, $user_id) {
	$user_id = (int)$user_id;
	$fields = '`user_id`, `username`, `password`, `email`, `access`';
	$query = "SELECT $fields FROM `users` WHERE `user_id` = :user_id";

	$querydata = $con->prepare($query);
	$querydata->bindParam("user_id" , $user_id);
	$querydata->execute();
	$data = $querydata->fetchAll(PDO::FETCH_ASSOC);

	return $data[0];
}

?>