var WebEvolution = angular.module("WebEvolution", [
	"ui.router",
	"oc.lazyLoad"
], function($interpolateProvider) {
	$interpolateProvider.startSymbol('{%').endSymbol('%}');
});	


/* Setup App Main Controller */
WebEvolution.controller('AppController', ['$scope', '$rootScope', function($scope, $rootScope) {
    $scope.$on('$viewContentLoaded', function() {
        // Metronic.initComponents(); // init core components
        //Layout.init(); //  Init entire layout(header, footer, sidebar, etc) on page load if the partials included in server side instead of loading with ng-include directive 
    });
}]);

WebEvolution.config(['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {

	// Redirect any unmatched url
    $urlRouterProvider.otherwise("/dashboard");

	$stateProvider
	// Dashboard
	.state('Dashboard1', {
        url: "/",
        templateUrl: "dashboard",            
        data: {PageTitle: 'Dashboard', PageSubTitle: 'statistics & reports'},
        breadCrumb: ['Dashboard']
    })
    .state('Dashboard2', {
        url: "/dashboard",
        templateUrl: "dashboard",            
        data: {PageTitle: 'Dashboard', PageSubTitle: 'statistics & reports'},
        breadCrumb: ['Dashboard']
    })
    .state('security', {
        url: "/security/users",
        templateUrl: "security/users",            
        data: {PageTitle: 'Users', PageSubTitle: 'statistics & reports'},
        breadCrumb: ['Dashboard','Security','Users'],
        controller: "UserController",
        resolve: {
            deps: ['$ocLazyLoad', function($ocLazyLoad) {
                return $ocLazyLoad.load({
                    name: 'UserModule',
                    files: [
                        'public/assets/js/plugins/jquery-validation/additional-methods.min.js',
                        'public/assets/js/plugins/jquery-validation/jquery.validate.min.js',
                        'public/assets/js/angular/datatable/angular-datatables.min.js',
                        'public/assets/js/plugins/data-tables/js/jquery.dataTables.min.js',
                        'public/assets/js/plugins/data-tables/css/jquery.dataTables.min.css',
                        'public/app/controllers/security/user.js'
                    ] 
                });
            }]
        }
    });
}]);

/* Init global settings and run the app */
WebEvolution.run(["$rootScope", "$state", function($rootScope, $state) {
    $rootScope.$state = $state; // state to be accessed from view
}]);