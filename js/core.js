var app = angular.module("mainApp", []);
app.controller("mainCtrl", function($scope, $http) {
	$scope.iframeSrc = "http://skrypcik.c0.pl/test/view.php";
	$scope.run = function() {
		var html = encodeURIComponent(editors[0].element.getValue());
		var css = encodeURIComponent(editors[1].element.getValue());
		var js = encodeURIComponent(editors[2].element.getValue());
		$scope.values = "html=" + html + "&css=" + css + "&js=" + js;
		$scope.iframeSrc = "http://skrypcik.c0.pl/test/view.php?" + $scope.values;
	}
	$scope.save = function() {
		var html = encodeURIComponent(editors[0].element.getValue());
		var css = encodeURIComponent(editors[1].element.getValue());
		var js = encodeURIComponent(editors[2].element.getValue());
		var data = {
			html: html,
			css: css,
			js: js,
			ip: ip
		};
		data = encodeURIComponent([JSON.stringify(data)]);
		console.log(data);
		$http.get("save.php?json=" + data)
		.then(function(response) {
			console.log(response.data);
		});
	}
})
