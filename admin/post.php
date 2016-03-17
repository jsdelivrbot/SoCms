<?php
require('../resources/config.php');

if(!logged_in()||$user_data['access'] != "admin")header('Location: ../login.php');
$pagetitle = 'Post Articles';
include('../templates/header.php');
?>
<div class="container">
<?php
if(empty($_POST) === false) {
    $required_fields = array('title', 'body');
    foreach($_POST as $key=>$value) {
        if (empty($value) && in_array($key, $required_fields) === true) {
            $errors[] = 'Fill in the fields dawg';
            break 1;
        }
    }
    if (empty($errors) === true) {
        if (title_exists($con, $_POST['title']) === true){
                $errors[] = "An article with that title already exist! ";
            }
    }
	if (empty($_POST) === false && empty($errors) === true) {
	            $currentDate = date("Ymdhhmmss");
	            //$summary = substr($_POST['body'], 0, 500) . "...";
				$summary = $_POST['summary'];
				$prevImg = $_POST['prev-img'];
	            if($_POST['published'] != 1) {
	                $published = 0;
	            } else {
	                $published = 1;
	            }
	            $article_data = array(
	                'title' => $_POST['title'],
	                'author' => $user_data['username'],
	                'published' => $published,
	                'summary' => $summary,
	                'body' => $_POST['body'],
	                'pubdate' => $currentDate,
	                'previewImg' => $prevImg);
	            add_article($con, $article_data);
	            ?>
	                    <div class="success">
	                        <strong>
	                        	<?php echo '<ul><li>You have been successfully posted an article!</li></ul>';?>
	                        </strong>
	                    </div>
	            <?php include('../templates/footer.php');?>
				</body>
				</html>
				<?php
	            exit();
	        } else if (empty($errors) === false){
	            ?>
				<div class="error">
					<strong><?php echo output_errors($errors);?></strong>
				</div>	
				<?php
	        }
}
?>
    <form action="" method="post">
        <h5>Title</h5>
        <input type="text" id="title" name="title"/>
        <h5>Summary</h5>
        <textarea style="width:100%; height:100px;" name="summary"></textarea>
        <h5>Preview image url</h5>
        <input type="text" name="prev-img"/>
        <h5>Body</h5>
        <textarea style="width:100%; height:200px;" name="body"></textarea>
        <h5>Public?</h5>
        <input type="hidden" value="0" name="published">
        <input type="checkbox" value="1" name="published" id="published"/>
        <input type="submit" value="Submit"/>
    </form>
</div>
</div>
<?php include('../templates/footer.php');?>
</body>
</html>