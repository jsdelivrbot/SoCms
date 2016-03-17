<?php 
require('resources/config.php');
$pagetitle = "Home";

include("templates/header.php");
include("templates/sidebar.php");
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
	    <?php frontPageArticles($con)?>
	</div>
	<div class="sidebar">
		<div class="space"></div>
	    <div class="sidebar-box">
	        <div class="fb-like-box" data-href="https://www.facebook.com/carolahaggkvist" data-width="230" data-height="290" data-colorscheme="light" data-show-faces="false" data-header="true" data-stream="true" data-show-border="true"></div>
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