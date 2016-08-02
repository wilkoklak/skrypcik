var app = angular.module("mainApp", []);
app.controller("mainCtrl", function($scope, $http, $window, $timeout) {
	$scope.rootUrl = "http://skrypcik.c0.pl/";
	$scope.share_window = false;
	$scope.iframeSrc = $scope.rootUrl + "view.php";
	$scope.uid = get_uid;
	$scope.currentLocation = $scope.rootUrl + "?u_id=" + $scope.uid;
	$scope.loaded = false;
	$scope.title = "Bez tytułu";
	function lsTest() {
		var test = "test";
		try {
			window.localStorage.setItem(test, test);
			window.localStorage.removeItem(test);
			$scope.wsSupported = true;
			return window.localStorage;
		} catch(e) {
			$scope.wsSupported = false;
			return false;
		}
	}
	$scope.storage = lsTest();
	$scope.run = function() {
		var html = encodeURIComponent(editors[0].element.getValue());
		var css = encodeURIComponent(editors[1].element.getValue());
		var js = encodeURIComponent(editors[2].element.getValue());
		$scope.values = "html=" + html + "&css=" + css + "&js=" + js;
		$scope.iframeSrc = $scope.rootUrl + "view.php?" + $scope.values;
	}
	$scope.save = function() {
		$scope.run();
		var html = editors[0].element.getValue();
		var css = editors[1].element.getValue();
		var js = editors[2].element.getValue();
		var _data = {
			html: html,
			css: css,
			js: js,
			ip: ip,
			u_id: $scope.uid
		};
		var config = {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded"
			},
			data: "message=" + JSON.stringify(_data),
			url: "save.php"
		};
		$http(config)
		.then(function(response) {
			var status = response.data.status;
			if(status == "OK") {
				$scope.uid = response.data.uid;
				if($scope.saved == false) {
					$scope.saved = true;
					$window.location.href = $scope.rootUrl + "?u_id=" + $scope.uid;
					if($scope.storage) {
						var temp = JSON.parse($scope.storage.list);
						temp.push(ip);
						$scope.storage.list = JSON.stringify(temp);
					} else {
						var list = [ip];
						$scope.storage.list = JSON.stringify(list);
					}
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
			if(response.data.status == "ok") {
				var html = response.data.html;
				var css = response.data.css;
				var js = response.data.js;
				$scope.privacy = response.data.privacy_flag;
				$scope.title = response.data.title;
				console.log($scope.privacy);
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
					if($scope.storage) {
						var ip_list = JSON.parse($scope.storage.list);
						for(i = 0; i < ip_list.length; i++) {
							if(ip_list[i] == response.data.ip) {
								$scope.authorised = true;
							}
						}
					} else {
						$scope.authorised = false;
					}
				}
			} else {
				$window.location.href = $scope.rootUrl;
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
	$scope.changePrivacy = function() {
		var privacy_data = {
			u_id: $scope.uid,
			value: $scope.privacy,
			title: $scope.title
		}
		var config = {
			method: "POST",
			headers: {
				"Content-Type": "application/x-www-form-urlencoded"
			},
			data: "message=" + JSON.stringify(privacy_data),
			url: "update_privacy.php"
		}
		$http(config);
	}
	document.querySelector("#loader").style.display = "none";
	document.querySelector("#app").style.display = "initial";
	$scope.tips = [
		"Kliknij Ctrl+F w danym polu, aby wyszukać",
		"Wciśnij Ctrl+D, aby skopiować linijkę",
		"Wciśnij Shift+Tab, aby usunąć jedno wcięcie",
		"Odwiedź <a href=\"feed/\">feed</a>, aby zobaczyć udostępnione skrypciki",
		"W menu udostępniania, możesz zmienić ustawienia widoczności na feedzie",
		"Aplikacja hula na AngularJS+PHP"
	];
	$scope.changeTip = function(i) {
		if(i <= $scope.tips.length) {
			$scope.currentTip = $scope.tips[i];
			$timeout(function() { $scope.changeTip(i+1)}, 10000);
		} else {
			i = 0;
			$timeout(function() { $scope.changeTip(i+1)}, 10000);
			$scope.currentTip = $scope.tips[i];
		}
	}
	$scope.currentTip = $scope.tips[0];
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
