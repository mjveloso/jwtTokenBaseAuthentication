(function() {

	angular.module('StudentService', [])
		.factory('StudentService', ['$http', '$q',
		function($http,$q) {

			return {
				addStudent:addStudent,
				fetchAllStudents:fetchAllStudents,
				updateStudent:updateStudent,
				authenthicateUser:authenthicateUser
			}

			function updateStudent(data) {
				var defer = $q.defer();
				$http.post('php/api/student.php', data)
				.then(function(response) {
					defer.resolve(response.data);
				}).catch(function(error) {
					defer.reject(response);
				});

				return defer.promise;
			}

			function addStudent(data) {
				var defer = $q.defer();
				$http.post('php/api/student.php', data)
				.then(function(response) {
					defer.resolve(response.data);
				}).catch(function(error) {
					defer.reject(response);
				});

				return defer.promise;
			}

			function fetchAllStudents() {
				var defer = $q.defer();
				$http.get('php/api/student.php')
				.then(function(response) {
					defer.resolve(response.data);
				}).catch(function(error) {
					defer.reject(error);
				});

				return defer.promise;
			}

			function authenthicateUser(data) {
				var defer = $q.defer();
				$http.post('php/api/userApi.php', data)
				.then(function(response) {
					defer.resolve(response.data);
				}).catch(function(error) {
					defer.reject(error);
				});

				return defer.promise;
			}


		}]);

}) ();