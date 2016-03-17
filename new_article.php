<?php
require($_SERVER['DOCUMENT_ROOT'].'/resources/config.php');
//Start Session
//Hold specific user data in a session if the user is logged in if(loggedIn){};
if(isset($_GET['title'])){
    
	$rawRequest = $_GET['title'];
	$request = strtr($_GET['title'], '-', ' '); //Gets current article, replaces dashes with spaces
	$pagetitle = $request;

	include('templates/header.php');
	?>
	<div class="wrap">
	<div class="content">
	<?php

	// Ha twitter-feed under artikeln, ska kunna göras större för att se fler tweets om ämnet etc
	if(articlePublished($con, $request)){
		$article = array();
		$fields = '`summary`, `body`, `pubdate`, `previewImg`, `author`';
		$sth = $con->prepare("SELECT $fields FROM articles WHERE title=\"" . $request . "\"");
		$sth->execute();
		$article = $sth->fetchAll(PDO::FETCH_ASSOC)[0];
		
		$date = date("d M, Y", strtotime(substr($article['pubdate'], 0, -6)));
		$img = $article['previewImg'];

		//Outputs Article title, summary, body and published date
		echo '
		<article class="page">
			<div class="title">
				<h1>'.$request.'</h1>
				<div class="articleInfo">
					<div class="article-date">
			        	<p> By '.$article['author'].' on '.$date.'</p>
			        </div>
				</div>
		   	</div>
		        <div class="body">
		        	<img src="'.$img.'"></img>
		        	<div class="postSummary" style="font-size:90%;font-weight:bold;padding-left:10px;">'.$article['summary'].'</div><div style="clear:both;"></div><br>
		        	<p>'.$article['body'].'</p>
		        </div>
		</article>';

	//Om man söker efter login.php och har skrivit login blir man omdirigerad till login.php
	} elseif(file_exists($rawRequest.'.php')){ //här vill vi ha bindestrecken kvar då det kan finnas en del av sidan som heter change-password eller något liknande i framtiden, 
	                                                //och då ska man kunna navigera till den även om man inte skriver till .php-ändelsen
	    header('Location: '.$rawRequest.'.php');
	} else{
	    echo 'Page not found.'; //erbjuda sökresultat?
	}
	?>
	</div>
	<div class="sidebar">
		<div class="sidebar-box">
	        <p>I shall put some sexy facebook api shit here</p>
	    </div>
	    <div class="sidebar-box">
	        <p>I shall put some sexy twitter api shit here</p>
	    </div>
	</div>
	</div>
	</div>
	</div>
	<?php include('templates/footer.php');?>
	</body>
	</html>
<?php
}
?>