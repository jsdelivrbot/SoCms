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
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/sv_SE/sdk.js#xfbml=1&version=v2.0";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
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
		   	<div class="postSummary"></div>
		        <div class="body">
		        	<img src="'.$img.'"></img>
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
		<div class="space"></div>
	    <div class="sidebar-box">
	        <div class="fb-like-box" data-href="https://www.facebook.com/randomwowkey" data-width="230" data-height="290" data-colorscheme="light" data-show-faces="false" data-header="true" data-stream="true" data-show-border="true"></div>
	    </div>
	    <div class="space"></div>
	    <div class="sidebar-box">
	        <a class="twitter-timeline"  href="https://twitter.com/search?q=swag" data-widget-id="579062270434623488">Tweets om swag</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
          
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