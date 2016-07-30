var app = angular.module("mainApp", []);
app.controller("mainCtrl", function($scope, $http, $window) {
	$scope.rootUrl = "http://skrypcik.c0.pl/test/";
	$scope.share_window = false;
	$scope.iframeSrc = $scope.rootUrl + "view.php";
	$scope.uid = get_uid;
	$scope.currentLocation = $scope.rootUrl + "?u_id=" + $scope.uid;
	$scope.loaded = false;
	$scope.run = function() {
		var html = encodeURIComponent(editors[0].element.getValue());
		var css = encodeURIComponent(editors[1].element.getValue());
		var js = encodeURIComponent(editors[2].element.getValue());
		$scope.values = "html=" + html + "&css=" + css + "&js=" + js;
		$scope.iframeSrc = $scope.rootUrl + "view.php?" + $scope.values;
	}
	$scope.save = function() {
		$scope.run();
		var html = encodeURIComponent(editors[0].element.getValue());
		var css = encodeURIComponent(editors[1].element.getValue());
		var js = encodeURIComponent(editors[2].element.getValue());
		var data = {
			html: html,
			css: css,
			js: js,
			ip: ip,
			u_id: $scope.uid
		};
		data = encodeURIComponent([JSON.stringify(data)]);
		$http.get("save.php?json=" + data)
		.then(function(response) {
			var status = response.data.status;
			if(status == "OK") {
				$scope.uid = response.data.uid;
				if($scope.saved == false) {
					$scope.saved = true;
					$window.location.href = $scope.rootUrl + "?u_id=" + $scope.uid;
				}
			} else if (status == "Error") {
				$scope.saved = false;
			}
		});
	}
	$scope.share = function() {
		$scope.share_window = true;
	}
	$scope.get = function() {
		$http.get("open.php?u_id=" + $scope.uid)
		.then(function(response) {
			var html = response.data.html;
			var css = response.data.css;
			var js = response.data.js;
			$scope.iframeSrc = $scope.rootUrl + "view.php?html=" + html + "&css=" + css + "&js=" + js;
			editors[0].element.setValue(decodeURIComponent(html), 0);
			editors[0].element.gotoPageDown();
			editors[1].element.setValue(decodeURIComponent(css), 0);
			editors[1].element.gotoPageDown();
			editors[2].element.setValue(decodeURIComponent(js), 0);
			editors[2].element.gotoPageDown();
			if(ip == response.data.ip) {
				$scope.authorised = true;
			} else {
				$scope.authorised = false;
			}
		});
	}
	if($scope.uid != "none") {
		$scope.saved = true;
		$scope.get();
	} else {
		$scope.saved = false;
		$scope.authorised = true;
	}
	$scope.new = function() {
		$window.location.href = $scope.rootUrl;
	}
	document.querySelector("#loader").style.display = "none";
	document.querySelector("#app").style.display = "initial";
});
app.directive('selectOnClick', ['$window', function ($window) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            element.on('click', function () {
                if (!$window.getSelection().toString()) {
                    // Required for mobile Safari
                    this.setSelectionRange(0, this.value.length)
                }
            });
        }
    };
}]);
