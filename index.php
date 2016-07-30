<!doctype html>
<html lang="pl" ng-app="mainApp" ng-controller="mainCtrl">
<head>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css?r_=<?=mt_rand()?>">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<title>Skrypcik</title>
</head>
<body>
	<div id="loader">
		<div class="loader"></div>
	</div>
	<div id="app">
		<div id="top_bar">
			<button ng-click="new()" title="Nowy"><span class="fa fa-file-o"></span></button>
			<button ng-click="run()" title="Uruchom"><span class="fa fa-play"></span></button>
			<button ng-click="save()" title="Zapisz" ng-show="authorised"><span class="fa fa-save"></span></button>
			<button ng-show="saved" ng-click="share()" title="Udostępnij"><span class="fa fa-share-alt"></span></button>
		</div>
		<div id="container">
			<div id="right">
				<div class="editor_name">
					H<br>
					T<br>
					M<br>
					L
				</div>
				<div id="editor_html" class="editor"></div>
				<div class="editor_name">
					C<br>
					S<br>
					S<br>
				</div>
				<div id="editor_css" class="editor"></div>
				<div class="editor_name">
					J<br>
					S
				</div>
				<div id="editor_js" class="editor"></div>
			</div>
			<div id="left">
				<iframe src="{{ iframeSrc }}"></iframe>
			</div>
		</div>
		<div class="share_window" ng-show="share_window">
			<div id="black" ng-click="share_window = !share_window"></div>
			<div id="window">
				<span class="fa fa-remove" ng-click="share_window = !share_window"></span>
				<header>
					<h1>Udostępnij</h1>
				</header>
				<main>
					<p>Każdy kto posiada ten link, będzie mógł zobaczyć Twojego skrypcika:</p>
					<input type="text" ng-model="currentLocation" select-on-click readonly>
					<p ng-show="authorised">
						<b>Uwaga!</b> Będziesz mógł edytować i zapisywać tego skrypcika, dopóki wchodzisz z tego samego adresu IP
					</p>
				</main>
			</div>
		</div>
	</div>
</body>
<!-- <script src="js/ResizeSensor.js"></script>
<script src="js/ElementQueries.js"></script> -->
<script src="js/ace/ace.js"></script>
<script>
	var editors = [ { element: ace.edit("editor_html"), lang: "html" }, { element: ace.edit("editor_css"), lang: "css" }, { element: ace.edit("editor_js"), lang: "javascript" }];
	for(i = 0; i < editors.length; i++) {
		editors[i].element.setTheme("ace/theme/chaos");
		editors[i].element.getSession().setMode("ace/mode/" + editors[i].lang)
	}
</script>
<?php echo "<script>
var ip = \"".$_SERVER['REMOTE_ADDR']."\";";
if(isset($_GET['u_id'])) {
	echo "var get_uid = \"".$_GET['u_id']."\";";
} else {
	echo "var get_uid = \"none\"";
}
echo "</script>"; ?>
<script src="js/core.js?r_=<?=mt_rand()?>"></script>
