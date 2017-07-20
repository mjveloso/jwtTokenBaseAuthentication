(function () {

	angular.module('AuthenticationService', [])
		.factory('AuthenticationService', ['$http', '$q', 
		function($http, $q) {

			return {
				verifyUser:verifyUser
			}

			function verifyUser() {
				return false;
			}


		}]);


}) ();