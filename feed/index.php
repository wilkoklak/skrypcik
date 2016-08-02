<!doctype html>
<html lang="pl" ng-app="feedApp" ng-controller="feedCtrl">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script>
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/style_alt.css?r_=<?=mt_rand()?>">
	<link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.14.1/locale/pl.js"></script>
	<script>
	moment.locale("pl");
	</script>
	<title>Skrypcik</title>
</head>
<body>
	<div id="top_bar">
		<button ng-click="new()" title="Nowy"><span class="fa fa-file-o"></span></button>
	</div>
	<div class="center">
		<table class="feed">
			<tr>
				<th>Tytuł</th>	<th>Utworzono</th>
			</tr>
			<tr ng-repeat="x in skrypciki">
				<td><a href="http://skrypcik.c0.pl/?u_id={{ x.u_id }}">{{ x.title }}</a></td>
				<td>{{ x.date }}</td>
			</tr>
		</table>
	</div>
</body>
<script>
var app = angular.module("feedApp", []);
app.controller("feedCtrl", function($scope, $http, $window, $interval) {
	$scope.get = function() {
		$http.get("get.php")
		.then(function(result) {
			var skrypciki = result.data;
			for(i = 0; i < skrypciki.length; i++) {
				skrypciki[i].date = moment.unix(skrypciki[i].date).fromNow();
			}
			$scope.skrypciki = skrypciki;
		});
	}
	$scope.get();
	$interval($scope.get, 60000);
	$scope.new = function() {
		$window.location.href = "http://skrypcik.c0.pl/";
	}
});
</script>
</html>
