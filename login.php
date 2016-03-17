<?php
require('resources/config.php');
$pagetitle = $title;
include('templates/header.php');

if(logged_in())header('Location: index.php');
//redirect if logged in / deny login somehow
?>

<div class="container">
	<div class="login-form">
		
		<form action="" method="post">
			<div class="input-field">
				
				<label for="username">Username</label>
				<input type="text" name="username" placeholder="Username">
			</div>
			
			<div class="input-field">
				<label for="password">Password</label>
				<input type="password" name="password" placeholder="Password">
			</div>
			
			<div class="input-field-check">
				<label for="checkbox"> Remember me</label>
				<input type="checkbox" name="checkbox">
				<input class="submit-button" value="Log in" type="submit">
			</div>
		</form>
	</div>

<?php 
if (empty($_POST) === false) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	$login = login($con, $username, $password);

	if (empty($username) === true || empty($password) === true) {
		$errors[] = 'You need to enter both username and password.';
	} else if (user_exists($con, $username) === false) {
		$errors[] = 'We couldn\'t find that username in our database.';
	} else if (user_active($con, $username) === false)	{
		$errors[] = 'You need to activate your account before logging in.';
	} else {
		if (strlen($password) > 32)	{
			$errors[] =  'Your password is too long.';
		}
		if ($login === false) {
			$errors[] = 'The username and password did not match.';
		} else {
			$_SESSION['user_id'] = $login;
			header('Location: index.php');
			exit();
		}
	}	
}
?>
<?php if (empty($errors) === false): ?>
		<div class="error">
				<strong>
					<?php echo output_errors($errors);?>
				</strong>
			</div>
			<?php endif; ?>
</div>
</div>
<?php include('templates/footer.php');?>
</body>
</html>