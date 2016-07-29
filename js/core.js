var app = angular.module("mainApp", []);
app.controller("mainCtrl", function($scope) {
	$scope.run = function() {
		var values = "";
		for(i = 0; i < editors.length; i++) {
			values += editors[i].element.getValue();
		}
		values = encodeURIComponent(values);
		console.log(values);
	}
})
