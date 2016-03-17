<?php
$logo = parse_ini_file($_SERVER['DOCUMENT_ROOT']."/resources/settings.ini")["logo"];
if ($logo == "SOCMS") {
	$so = substr($logo, 0, 2);
	$cms = substr($logo, 2, 4);
	
	$headerTitle = "
	<div class='logo'>
		<div class='so'>
	    	<h1>$so</h1>
		</div>
		<div class='cms'>
	    	<h1>$cms</h1>
		</div>
	</div>
	";
} else { //rank 1
	$headerTitle = "
	<div class='logo'>
		<h1>$logo</h1>
	</div>
	";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SoCMS - <?php echo ucwords($pagetitle);?></title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="../css/style.css" type="text/css" />
    <link rel="stylesheet" href="../css/sweet-alert.css" type="text/css" />
</head>
<body>
	<div class="page-wrap">
    <header>
    	<div class="container">
	    	<div class="logo">
	    		<?php echo $headerTitle; ?>
	    	</div>
        </div>
        <nav>
	        	<div class="navigation">
			        <ul>
			            <li <?php class_active('index'); ?>><a href="../index.php">Home</a></li>
			            <li <?php class_active('about'); ?>><a href="../about.php">About</a></li>
			            <li <?php class_active('search'); ?>><a href="../search.php">Search</a></li>
			            
			        	<?php if(logged_in()): ?> <!-- Check if logged in -->
			        		<li <?php class_active('usersettings');?>><a href="../usersettings.php">Settings</a></li>
			        		<li <?php class_active('logout');?>><a href="../logout.php">Logout</a></li>
			        		<?php if($user_data['access'] === "admin" && $_SERVER['REQUEST_URI'] != "/admin/"): ?> <!-- Check user auth -->
			        			<li><a href="/admin">Admin</a></li>
			        		<?php endif; ?>
			        		
			        		<?php if(substr($_SERVER['REQUEST_URI'],0 , 7) == "/admin/"): ?> <!-- Check request uri | For admin controls -->
			        				<!--<li <?php// class_active('post');?>><a href="post.php">Post/Edit</a></li>
			        				<li><a href="settings.php">Settings</a></li>-->
			        			<?php endif; ?>
			        			
			        	<?php else: ?>
			        		<li <?php class_active('register');?>><a href="../register.php">Register</a></li>
			        		<li <?php class_active('login');?>><a href="../login.php">Log in</a></li>
			            <?php endif; ?>
			        </ul>
	        </div>
	        </nav>
    </header>
    
