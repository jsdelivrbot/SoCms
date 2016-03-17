<?php
require('resources/config.php');
$pagetitle = $title;
include('templates/header.php');
if(logged_in())header('Location: index.php');
//redirect if logged in


// Validate information
if (empty($_POST) === false) {
	$required_fields = array('username', 'password', 'password_again', 'name', 'email');
	foreach($_POST as $key=>$value) {
		if (empty($value) && in_array($key, $required_fields) === true) {
			$errors[] = 'You need to fill in all the required fields.';
			break 1;
		}
	}
	
	if (empty($errors) === true) {
		if (user_exists($con, $_POST['username']) === true) {
			$errors[] = 'Sorry, the username ' . $_POST['username'] . ' is already in use.';
		}
		if (preg_match("/\\s/", $_POST['username']) == true) {
			$errors[] = 'Your username cannot contain spaces.';
		}
		if (strlen($_POST['password']) < 6) {
			$errors[] = 'Your password must be at least 6 characters long.';
		}
		if (strlen($_POST['password']) > 32) {
			$errors[] = 'Your password cannot be more than 32 characters long.';
		}
		if ($_POST['password'] !== $_POST['password_again']) {
			$errors[] = 'Your passwords didn\'t match.';
		}
		if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) === false) {
			$error[] = 'Enter a valid email adress.';
		}
		if (email_exists($con, $_POST['email']) === true) {
			$errors[] = 'Sorry, the email adress ' . $_POST['email'] . ' is already in use.';
		}
	}
}
?>
<div class="container">
<h1>Register</h1>
<?php
if (isset($_GET['success']) && empty($errors)) {
	?>
	<div class="success">
	    <strong>You have been successfully registered. An activation email has been sent to your email adress.</strong>
	</div>
	<?php
} else {
	if (empty($_POST) === false && empty($errors) === true) {
		$register_data = array(
			'username' 		=> $_POST['username'],
			'password' 		=> $_POST['password'],
			'email' 		=> $_POST['email'],
			//'email_code' 	=> md5($_POST['username'] + microtime()),
			'access'		=> 'user'
			);
	
			register_user($con, $register_data);
			header('Location: register.php?success');
			exit();
	
		} else if (empty($errors) === false) {
			?>
			<div class="error">
				<strong>
					<?php echo output_errors($errors);?>
				</strong>
			</div>
			<?php
		}
			
}
?>
	<div class="login-form">
		<form action="" method="post">

			<div class="input-field">
				<label>Username</label>
				<input type="text" class="form-control" id="username" name="username" placeholder="Username" autofocus="autofocus">
			</div>
			
			<div class="input-field">
				<label>Password</label>
				<input type="password" name="password" placeholder="Password">
			</div>

			<div class="input-field">
				<label>Password Again</label>
				<input type="password" name="password_again" placeholder="Password Again">
			</div>

			<div class="input-field">
				<label for="email">Email</label>
				<input type="email" name="email" placeholder="Email">
			</div>

			<div class="input-field-check">
				<label for="email">Remember me</label>
				<input type="checkbox">
				<input type="submit" value="Submit">
			</div>
		</form>
	</div>
</div>
</div>
<?php include('templates/footer.php');?>
</body>
</html>