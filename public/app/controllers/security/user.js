var User = angular.module("UserModule", [
    "datatables",
    "oc.lazyLoad"
], function($interpolateProvider) {
    $interpolateProvider.startSymbol('{%').endSymbol('%}');
}).run(function() {
    User.service('services',userServices);
});

/*Set User Controller*/
User.controller('UserController', function($scope, $http) {

    var base_url = 'security/users/';

    //initialize status to add
    $scope.status = 'add';

   

    //initialize key to empty string
    $scope.key = '';
    
    //create instance for the services
    $scope.services = new userServices($scope);

    /* auto load content */
	$scope.$on('$viewContentLoaded', function() {
        //initialize data

        //masterlist
        $scope.getData();

        //form sub data
        $scope.getSubData();
          
    });

     /* trigge validator when user submit */
    $scope.submit = function() {
        //trigger form submit to validate
        $("#form").submit();
    }

	/*this will show form of the user*/
    $scope.showForm = function() {
        $scope.status = 'add';
    	$('#modal2').openModal();
    	$('select').material_select();
        $scope.services.validate($scope.saveUser);
        formValidator.remove();
        formValidator.insert($scope.services.addRules());
    };

    /*get all users*/
    $scope.getData = function() {
        $scope.masterlist = [];
        // get user masterlist
        $http.get(base_url+'getData').then( function(response) {
            angular.forEach(response.data.masterlist, function(item) {
                $scope.masterlist.push(item);
            });
        });
    }

    /*get form sub data*/
    $scope.getSubData = function() {
        $scope.roles = [];
        // get roles
        $http.get(base_url+'getRoles').then( function(response) {
            angular.forEach(response.data.data, function(item) {
                $scope.roles.push(item);
            });
        });

        $scope.levels = [];
        // get levels
        $http.get(base_url+'getLevels').then( function(response) {
            angular.forEach(response.data.data, function(item) {
                $scope.levels.push(item);
            });
        });

        $scope.positions = [];
        // get positions
        $http.get(base_url+'getPositions').then( function(response) {
            angular.forEach(response.data.data, function(item) {
                $scope.positions.push(item);
            });
        });

        $scope.departments = [];
        // get departments
        $http.get(base_url+'getDepartments').then( function(response) {
            angular.forEach(response.data.data, function(item) {
                $scope.departments.push(item);
            });
        });
    }

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
                            //show success message
                            sys.showSuccess('Save!',response.data.message);
                            //clear form
                            sys.clearForm('#form');
                            //refresh data
                            $scope.getData();
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

    /*update user account and informaton*/
    $scope.updateUser = function() {
        //confirm transaction save!
        sys.confirm(
            'Update Account!',
            'Are you sure you want to update this?',
            function(isConfirm){
                if (isConfirm) {  
                    $http.patch(base_url+'update/'+$scope.key,sys.serializeArrayToForm($('#form').serializeArray())).then(function(response) {
                        if (response.data.error == false) {
                            //show success message
                            sys.showSuccess('Save!',response.data.message);
                            //refresh data
                            $scope.getData();
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
                            //show success message
                            sys.showSuccess('Deleted!',response.data.message,1000);
                            //refresh data
                            $scope.getData();
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
        $scope.key = key;
        $http.get(base_url+'edit/'+$scope.key).then( function(response) {
            var fields = new Array();

            $scope.status = 'edit';

            for(var item in response.data) {
                $scope[item] = response.data[item];
            }
            $('#modal2').openModal();
            $('select').material_select();
            sys.setFormInputActive('#form');
            $scope.services.validate($scope.updateUser);
            formValidator.remove();
            formValidator.insert($scope.services.updateRules());
        });
    }
});