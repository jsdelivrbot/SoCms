<?php
require('../resources/config.php');
$pagetitle = "Settings";
include('../templates/header.php');

if (empty($_POST) === false) {
	if(isset($_POST['logo']) == true) {
		$logo = $_POST["logo"];
		edit_settings("logo", $logo);
	}
}
?>

<div class="container">
	<div class="admin-settings-bar">
		<ul>
			<li><a href="#">General</a></li>

		</ul>
	</div>
	<div class="admin-settings">
		<form action="" method="post">
			<div class="settings-field">
				<label for="">Header title</label>
				<input type="text" name="logo">
				<input type="submit" value="Submit">
			</div>
		</form>
	</div>
</div>
</div>
<?php include('../templates/footer.php');?>
</body>
</html>
