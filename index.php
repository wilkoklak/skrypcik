<!doctype html>
<html lang="pl" ng-app="mainApp" ng-controller="mainCtrl">
<head>
	<meta charset="utf-8">
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Skrypcik</title>
</head>
<body>
	<div id="top_bar">
		<button ng-click="run()">uruchom</button>
		<button ng-click="save()">Zapisz</button>
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
	// new ResizeSensor(document.querySelector("#editor_html"), function() {
	// 	editor.resize(true);
	// });
</script>
<?php echo "<script>
var ip = \"".$_SERVER['REMOTE_ADDR']."\";
</script>"; ?>
<script src="js/core.js"></script>
