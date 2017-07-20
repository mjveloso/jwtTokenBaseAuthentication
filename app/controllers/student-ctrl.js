(function() {

	angular.module('StudentController', ['StudentService', 'AuthenticationService'])
		.controller('StudentController', ['$scope', 'StudentService', 'AuthenticationService',
		function($scope,StudentService,AuthenticationService) {

			console.debug('StudentController');

			function decodeJwtToken(token) {
				var base64Url = token.split(".")[1];
				var base64 = base64Url.replace('-', '+').replace('_', '/');
				return JSON.parse(window.atob(base64));
			}

		}]);

}) ();