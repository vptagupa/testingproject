 function userServices($scope) {
 	this.validate = function() {
 		/* set form validation including rules and excemption */
	    $("#form").validate({
	        //For custom messages
	        errorElement : 'div',
	        errorPlacement: function(error, element) {
	          var placement = $(element).data('error');
	          if (placement) {
	            $(placement).append(error)
	          } else {
	                error.insertAfter(element);
	          }
	        },
	        submitHandler: this.eventHandler
	     });
 	},

    this.loginForm = function(eventHandler) {
        /* set form validation including rules and excemption */
        $(".login-form").validate({
            rules: {
                user_id: {
                    required: true,

                },
                password: {
                    required: true
                }
            },
            //For custom messages
            messages: {
                user_id: {
                    required: "Enter a username"
                } ,
                password: {
                    required: "Enter a password",
                }
            },
            errorElement : 'div',
            errorPlacement: function(error, element) {
              var placement = $(element).data('error');
              if (placement) {
                $(placement).append(error)
              } else {
                    error.insertAfter(element);
              }
            },
            submitHandler: eventHandler
         });
    },

 	this.addRules = function() {
 		return {
            user_id: {
                required: true,
                minlength: 5,
                messages: {
                    required: "Enter a user id",
                    minlength: "Enter at least 6 characters"
                }
            },
            email: {
                required: true,
                email:true
            },
            password: {
                required: true,
                minlength: 6
            },
            cpassword: {
                required: true,
                minlength: 6,
                equalTo: "#password"
            },
            role: {
            	required: true
            },
            sex: {
            	required: true
            },
            first_name: {
            	required: true
            },
            last_name: {
            	required: true
            }
        };
 	},

 	this.updateRules = function() {
 		return {
            user_id: {
                required: true,
                minlength: 5
            },
            email: {
                required: true,
                email:true
            },
            role: {
            	required: true
            },
            sex: {
            	required: true
            },
            first_name: {
            	required: true
            },
            last_name: {
            	required: true
            }
        };
 	},

 	this.eventHandler = function() {
 		if ($scope.status == 'add') {
            $scope.saveUser();
        } else {
        	$scope.updateUser();
        }
 	}
 }