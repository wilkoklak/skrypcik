<?php
$html = $css = $js = "";
if(isset($_GET['html'])) {
	$html = $_GET['html'];
	$css = $_GET['css'];
	$js = $_GET['js'];
	$modified = true;
} else {
	$modified = false;
}
echo "<!doctype html>
	<head>
		<style>
		body {
			background: #fff;
		}
		$css
		.cbalink {
			display: none;
		}
		</style>
	</head>
	<body>";
	if(!$modified) {
		echo "<p>Tutaj pojawi się podgląd strony</p>";
	}
	echo "
	$html
	</body>
	<script>
	$js
	</script>
	<script>
	document.getElementById(\"bmone2n-1276.1.1.1\").style.display = \"none\";
	</script>
</html>";
 ?>
