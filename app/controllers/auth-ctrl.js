(function() {

	angular.module('AuthController', ['AuthenticationService'])
		.controller('AuthController', ['$scope', 'AuthenticationService',
		function($scope,AuthenticationService) {

			console.debug('AuthController');

			$scope.userData = [];

			$scope.login = function() {
				var data = {
					username : $scope.userData.username,
					password : $scope.userData.password
				};

				AuthenticationService.verifyUser(data)
				.then(function(response) {					
					
					console.debug('response: ', response);

				}).catch(function(error) {

					console.error('error: ', error);
					
				});
			}

		}]);

}) ();