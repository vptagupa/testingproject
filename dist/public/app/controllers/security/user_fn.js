 function userServices() {
 	this.validator = function() {
 		/* set form validation including rules and excemption */
	    $("#form").validate({
	        rules: {
	            user_id: {
	                required: true,
	                minlength: 5
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
	            role:"required",
	            sex:"required",
	            first_name:"required",
	            last_name:"required",
	        },
	        //For custom messages
	        messages: {
	            user_id:{
	                required: "Enter a user id",
	                minlength: "Enter at least 6 characters"
	            },
	            curl: "Enter your website",
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
	        submitHandler: function (form) {
	            $scope.saveUser();
	        }
	     });
 	}
 }