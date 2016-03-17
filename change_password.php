<?php
require('resources/config.php');

if(!logged_in())header('Location: login.php');
$pagetitle = 'Change Password';
include('templates/header.php');
?>
<div class="container">
    <?php

if (empty($_POST) === false) {
	$required_fields = array('current_password', 'password', 'password_again');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'You need to fill in all the required fields.';
			break 1;
		}
	}


	if (md5($_POST['current_password']) === $user_data['password']) {
		if (trim($_POST['password']) !== trim($_POST['password_again'])) {
			$errors[] = 'Your new passwords do not match.';
		} else if (strlen($_POST['password']) < 6) {
			$errors[] = 'Your password must be at least 6 characters long.';
		}
	} else {
		$errors[] = 'Your current password is incorrect.';
	}
}

?>
          <h1>Change Password</h1>
<?php
if (isset($_GET['success']) && empty($errors)) {
?>
    <div class="success">
		<strong><?php echo '<ul><li>You have been successfully changed your password!</li></ul>';?></strong>
	</div>
<?php
} else {
if (empty($_POST) === false && empty($errors) === true) {
	change_password($con, $session_user_id, $_POST['password']);?>
	<div class="success">
		<strong><?php echo output_errors($errors);?></strong>
	</div>
	<?php
} else if (empty($errors) === false) {
?>
    <div class="error">
		<strong><?php echo output_errors($errors);?></strong>
	</div>
<?php
}
?>
<div class="login-form">
		
		<form action="" method="post">

			<div class="input-field">
				<label for="current_password">Current password</label>
				<input type="password" name="current_password" placeholder="Password">
			</div>
			<div class="input-field">
				<label for="password">New password</label>
				<input type="password" name="password" placeholder="Password">
			</div>
			<div class="input-field">
				<label for="password_again">New password again</label>
				<input type="password" name="password_again" placeholder="Password">
			</div>
			
			<div class="input-field-check">
				<input class="submit-button" value="Change Password" type="submit">
			</div>
		</form>
<?php 
}
?>
</div>
</div>
</div>
<?php include('templates/footer.php');?>
</body>
</html>