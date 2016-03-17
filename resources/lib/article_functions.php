<?php 
// Admin add article functions

function add_article($con, $article_data) { //omgjord till pdo
	//array_walk($register_data, 'array_sanitize');

	$fields = '`' . implode('`, `', array_keys($article_data)) . '`';
	$data = '\'' . implode('\', \'', $article_data) . '\'';

	$query = "INSERT INTO `articles` ($fields) VALUES ($data)";
	$result = $con->prepare($query);
	$result->execute();
	return ($result->fetchColumn() == 1) ? true : false;
}

function title_exists($con, $title)	{
	
	$query = "SELECT COUNT(`articleid`) FROM `articles` WHERE `title` = :title";
	$result = $con->prepare($query);
	$result->bindParam("title" , $title);
	$result->execute();
	
	return ($result->fetchColumn() == 1) ? true : false;
}

function frontpageArticles($con){
    $query = "SELECT * FROM `articles` WHERE published='1' ORDER BY `pubdate` DESC LIMIT 4";
    foreach($con->query($query) as $article){
    	if ($article) {

    		$article_link = strtr($article['title'], ' ', '-');
    		$article_title = $article['title'];
    		$article_date = date("d M", strtotime(substr($article['pubdate'], 0, -6)));
    		$article_summary = substr($article['summary'], 0, 150) . "..."; //preview swag
    		$previewImg = $article['previewImg'];
    		$author = $article['author'];

    		$article_html = "
    		<div class='index-article'>
    			<div class='prevImg'>
    				<a href='/$article_link'><img title='$article_title' src='$previewImg'></img></a>
    			</div>
    			
    			<div class='prevContent'>
	    			<div class='prevSummary'>
	    				<h1><a href='/$article_link'>$article_title</a></h1>
	    				<div class='postInfo'>
	    					<p style='color:#0088FF;'>Posted $article_date by $author</p>
	    				</div>
	    				<div class='postSummary'>
	    					<p>$article_summary</p>
	    				</div>
	    			</div>
	    			
	    		</div>
    		</div>
    		";
	        echo $article_html;
	    	}
    }
}

function articlePublished($con, $title){
    $query = "SELECT COUNT(`articleid`) FROM `articles` WHERE `title` = :title AND `published` = 1";
	$result = $con->prepare($query);
	$result->bindParam("title" , $title);
	$result->execute();
	return $result->fetchColumn();
}


?>