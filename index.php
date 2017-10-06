<?php
  include "gp.php";

  if($_GET['id']){
    $id = $_GET['id'];
    $gpURL = getURLbyID($id);
    $getGP = getPhotoGoogle($gpURL);
  }

  if($_POST['submit'] != ""){
    $url = $_POST['url'];
    $getGP = getPhotoGoogle($url);
  }
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="robots" content="noindex">
	<title>Get link Google Photos</title>
</head>
<body>

  <!-- Docs styles -->
  <link rel="stylesheet" href="https://cdn.plyr.io/2.0.13/demo.css">
	<style>
		.container {
		  max-width: 800px;
		  margin: 0 auto;
		}
	</style>

	<div class="container">
    <br />
		<form action="" method="POST">
			<input type="text" size="80" name="url" value="https://photos.google.com/share/AF1QipMTEPAiVF8t0YqLukflnOSQjwfd8ARIoT2h37AXvYO1uaWodbeiFoBUDuD_19tEbg/photo/AF1QipPA2Bq0JlAR9LoGD3mogsxSb9OZWEG4XqBDD4Rv?key=cjhUT0xrZjM5NGN2SVRLOVptZU5SMUlKV0lQYWpB"/>
			<input type="submit" value="GET" name="submit" />
		</form>
		<br/>

		<div id="myElement">Paste the url and click the get button.</div>

		<!-- <br/><br/>
		<div id="myElement">Loading...</div> -->
	</div>

	<script src="https://content.jwplatform.com/libraries/DbXZPMBQ.js"></script>
	<script type="text/javascript">
		jwplayer("myElement").setup({
			playlist: [{
				"sources":<?php echo $getGP?>
			}],
			allowfullscreen: true,
			width: '100%',
			aspectratio: '16:9',
		});
	</script>

</body>
</html>
