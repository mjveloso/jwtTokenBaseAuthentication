(function() {

	angular.module('app', [
		'StudentController',
		'StudentService',
		'AuthController',
		'AuthenticationService'
	])
	.run(function($rootScope, $location, AuthenticationService) {
		var status = AuthenticationService.verifyUser();
		console.debug('status: ', status);
	})
	.directive('tabss', function() {

		 return {
		      restrict: 'E',
		      scope: {},
		      transclude: true,
		      controller: function () {
		      	this.tabs = [];
		        this.addTab = function addTab(tab) {
		        	this.tabs.push(tab);
		        };
		        this.selectTab = function selectTab(index) {
		          for (var i = 0; i < this.tabs.length; i++) {
		            this.tabs[i].selected = false;
		          }
		        	this.tabs[index].selected = true;
		        };
		      },
		      controllerAs: 'tabs',
		      link: function ($scope, $element, $attrs, $ctrl) {
		      	$ctrl.selectTab($attrs.active || 0);
		      },
		      template: `
		      	<div class="tabs">
		        	<ul class="tabs_list">
		          	<li ng-repeat="tab in tabs.tabs" ng-click="tabs.selectTab($index);">
		            	{{tab.label}}
		            </li>
		          </ul>
		        	<div class="tabs_content" ng-transclude></div>
		        </div>
		      `
		    };

	})
	.directive('tab', function() {

		return {
		  	restrict: 'E',
		    scope: {
		    	label: '@'
		    },
		    require: '^tabss',
		    transclude: true,
		    template: `
		    	<div class="tabs__content" ng-if="tab.selected">
		      		<h2 ng-transclude></h2>
		      	</div>`,
		    link: function ($scope, $element, $attrs, $ctrl) {
		    	$scope.tab = {
		      	label: $scope.label,
		      	selected: false
		      };
		    	$ctrl.addTab($scope.tab);
		    }
		  }
	});

}) ();