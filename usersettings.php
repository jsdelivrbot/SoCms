<?php
require('resources/config.php');
if(!logged_in())header('Location: login.php');
$pagetitle = 'User Settings';
include('templates/header.php');
?>
<div class="container">
	<h1>User settings</h1>
	<ul>
	    <li><a href="change_password.php">Change password</a></li>
	</ul>
</div>
</div>
<?php include("templates/footer.php") ?>

