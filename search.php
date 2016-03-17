<?php
require('resources/config.php');
//Start Session
//Hold specific user data in a session if the user is logged in if(loggedIn){};
$pagetitle = $title;
include('templates/header.php');



?>

<div class="container">
	<div class="search-box">
		<form action="search.php" method="post">
			<h2 style="padding:0 0 10px 0; ">Search for an article</h2>
			<input class="search-input" type="text" name="search" placeholder="Search" value=<?php if(isset($_GET['name']))echo substr(strip_tags($_GET['name']),0,50); ?> >
			<input class="search-btn" value="Search" type="submit" name="submit">
		</form>
	</div>


<?php 
if(isset($_POST['submit'])){
	if(isset($_POST['search']) == true){
		if(preg_match("/^[A-Za-z]+/", $_POST['search'])){
			$search_term = $_POST['search'];
			echo "
				<div class='results'>
					<p>Search results for '".$search_term."'</p>
				</div>";
			$query = "SELECT `title`, `summary` FROM `articles` WHERE `title` LIKE concat('%', :search_term, '%') AND `published` = 1";

			$result = $con->prepare($query);
			$result->bindParam("search_term" , $search_term);
			$result->execute();
			$rows = $result->rowCount();
			
			while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
				$title = $row['title'];
				$article_link = strtr($title, ' ', '-');
				$article_summary = $row['summary'];
				$article_html = "
	    		<div style='height:150px;' class='index-article'>
	    			<h1><a href='/$article_link'>$title</a></h1>
	    			<p>$article_summary</p>
	    		</div>
	    		";
		        echo $article_html;
			}

			if($rows == 0) {
				echo "
				<div class='results'>
					<p>No matches!</p>
				</div>";
			}
		} 
	} 
}
?>
</div>
</div>
<?php include('templates/footer.php');?>
</body>
</html>
