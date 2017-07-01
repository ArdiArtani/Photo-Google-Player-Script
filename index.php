<?php
include "gp.php";
$getGP = getPhotoGoogle('https://photos.google.com/share/AF1QipP4SgmZ9Q2FWUKtE4rCwq1bwj-c_yBTPl7K5vZlQfTe5H9IlU4VGiCodMcJ6lDTlA/photo/AF1QipO_SW6Zov_mA-DORS6_eU4C3JdNlRFQTkQ6wlR8?key=Tm51bjVTNGN5c2RLQm1fcmpLWnIwbzRPVTZlTDhn');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8" />
	<title>Get link Google Drive</title>
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
		<br/><br/>
		<div id="myElement">Loading...</div>
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
