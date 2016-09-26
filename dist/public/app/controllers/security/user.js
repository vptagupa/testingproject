var User = angular.module("UserModule", [
    "datatables"
], function($interpolateProvider) {
    $interpolateProvider.startSymbol('{%').endSymbol('%}');
});

User.service('services',userServices);

/*Set User Controller*/
User.controller('UserController', function($scope, $http, services) {

    $scope.status = 'add';
    
    var base_url = 'security/users/';

    /* auto load content */
	$scope.$on('$viewContentLoaded', function() {

        $scope.masterlist = [];
    
        // get user masterlist
        $http.get(base_url+'getData').then( function(response) {
            angular.forEach(response.data.masterlist, function(item) {
                $scope.masterlist.push(item);
            });
        });
          
    });

	/*this will show form of the user*/
    $scope.showForm = function() {
    	$('#modal2').openModal();

    	$('select').material_select();
    };

    /*save user account and informaton*/
    $scope.saveUser = function() {
    	//confirm transaction save!
    	sys.confirm(
    		'New Account!',
    		'Are you sure you want to save this?',
    		function(isConfirm){
            	if (isConfirm) {  
            		$http.put(base_url+'create',sys.serializeArrayToForm($('#form').serializeArray())).then(function(response) {
                        if (response.data.error == false) {
                            sys.showSuccess('Save!',response.data.message);
                            sys.clearForm('#form');
                        } else {
                            sys.alert('Error!',response.data.message,'error');
                        }
            		}, function() {
                        sys.showError("Something went wrong.");
            		});
                } 
                else {
                    sys.showCancelled("New Account Cancelled!");
                } 
	        }
    	);
    }

    /* trigge validator when user submit */
    $scope.submit = function() {
        //trigger form submit to validate
        $("#form").submit();
    }

    /* handle user delete */
    $scope.delete = function(key) {
        //confirm transaction delete!
        sys.confirm(
            'Delete Account!',
            'Are you sure you want to delete this?',
            function(isConfirm){
                if (isConfirm) {  
                    $http.delete(base_url+'delete/'+key).then(function(response) {
                        if (response.data.error == false) {
                            sys.showSuccess('Deleted!',response.data.message);
                        } else {
                            sys.alert('Error!',response.data.message,'error');
                        }
                    }, function() {
                        sys.showError("Something went wrong.");
                    });
                } 
                else {
                    sys.showCancelled("Delete Cancelled!");
                } 
            }
        );
    }

    /* handle user edit, show modal form */
    $scope.edit = function(key) {
        $http.get(base_url+'edit/'+key).then( function(response) {
            var fields = new Array();

            $scope.status = 'edit';

            for(var item in response.data) {
                $scope[item] = response.data[item];
            }
            $('#modal2').openModal();
            $('select').material_select();
            sys.setFormInputActive('#form');
        });
    }
});