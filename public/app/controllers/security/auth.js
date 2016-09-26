var Auth = angular.module('AuthModule',["oc.lazyLoad"], function($interpolateProvider) {
    $interpolateProvider.startSymbol('{%').endSymbol('%}');
}).run(function() {
    Auth.service('services',userServices);
});

Auth.controller('AuthController', function($scope,$http) {

	//create instance for the services
    $scope.services = new userServices($scope);
    $scope.message = '';
    $scope.show = false;
    $scope.error = false;

    /*authenticate user account*/
    $scope.services.loginForm(function() {
    	$http.post('', sys.serializeArrayToForm($('.login-form').serializeArray())).then( function(response) {
            $scope.show = true;
            $scope.error = true;
            var res = response.data;
            
            if (res.error != undefined) {
                $scope.error = res.error;
                $scope.message = res.message;

                if ($scope.error == false) {
                    setTimeout(function() {
                        window.location.href = base_url;
                    },2000);
                }
            }
    	});
    });

    /*trigger submit form when login button is click*/
	$scope.login = function() {
		$('.login-form').submit();
	}

    /* trigger submit form when enter key is press */
    $(document).keydown(function(e) {
        if (e.keyCode == 13) {
            $scope.login();
        }
    });
});