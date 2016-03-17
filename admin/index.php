<?php 
require('../resources/config.php');
if(!logged_in()||$user_data['access'] != "admin")header('Location: ../login.php');
$pagetitle = "Admin Panel";
include("../templates/header.php");
include("../templates/sidebar.php");
?>
<div class="container">
	<?php //frontPageArticles($con) ?>
	<h1>Quick links</h1>
	<ul>
	    <li><a href="post.php">Post/Edit articles</a></li>
	    <li><a href="settings.php">Website settings</a></li>
	</ul>
</div>
</div>
<?php include("../templates/footer.php") ?>

