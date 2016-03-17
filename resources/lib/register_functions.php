<?php 
function email_exists($con, $email)	{
	
	$query = "SELECT COUNT(`user_id`) FROM `users` WHERE `email` = :email";
	$result = $con->prepare($query);
	$result->bindParam("email" , $email);
	$result->execute();
	
	return ($result->fetchColumn() == 1) ? true : false;
}

function email($to, $subject, $body) {
	ini_set("SMTP","localhost");
	ini_set("smtp_port","25");
	mail($to, $subject, $body, 'From: Gyarbete<verification@domain>', 'Reply-To: vettigemail@random.eu');
}
?>