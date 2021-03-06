var sys = {
	/*
	* confirm alert event
	* @var {string} title 
	* @var {string} text as 
	* @var {function} _callback
	* @return void
	*/
	confirm: function(title,text,_callback) {
		swal({
            title: title,
            text: text,
            type: 'info',
            showCancelButton: true,
            closeOnConfirm: false,
            showLoaderOnConfirm: true,
            closeOnCancel: false
         }, _callback);
	},
	/*
	* show error sweet alert
	* @var {string} message 
	* @return void
	*/
	showError: function(message) {
		swal("Error!", message, "error"); 
	},
	/*
	* show cancelled sweet alert
	* @var {string} message 
	* @return void
	*/
	showCancelled: function(message) {
		swal("Cancelled!", message, "error"); 
	},
	/*
	* show success sweet alert
	* @var {string} message 
	* @return void
	*/
	showSuccess: function(title,message,time) {
		var time = time == undefined ? 2000 : time;
		setTimeout(function(){
            swal(title, message, "success");  
        },time); 
	},
	/*
	* show  sweet alert
	* @var {string} title 
	* @var {string} message 
	* @var {string} type 
	* @return void
	*/
	alert: function(title,message,type) {
		var type = type == undefined ? 'info' : type;
        swal({ 
        	type: type,
        	title: title,   
            text: message,   
            html: true 
        });  
	},
	/*
	* serialize form inputs to array
	* @var {string} data parameters - form inputs  
	* @return array
	*/
	serializeArrayToForm: function(data) {
		var fields = new Array();
		var datas = new Object();

		for(var i in data) {
			fields[i] = data[i].name;
		}

		for(var i in data) {
			datas[data[i].name] = data[i].value;
		}
		
		return datas;
	},
	/*
	* Clear form inputs
	* @var {string} form_name object 
	* @return boolean
	*/
	clearForm: function(form_name) {
		$(form_name+ " input[type=text],"+form_name+ " textarea,"+form_name+ " input[type=hidden],"+form_name+ " input[type=password],"+form_name+ " input[type=email]").each(function(){
	        if ( !$(this).hasClass('do-not-clear') ) $(this).val("");
	    });
	    return false;
	},
	/*
	* show  sweet alert
	* @var {string} title 
	* @var {string} message 
	* @var {string} type 
	* @return void
	*/
	setFormInputActive: function(form_name) {
		$(form_name+ " input[type=text],"+form_name+ " textarea,"+form_name+ " input[type=hidden],"+form_name+ " input[type=password],"+form_name+ " input[type=email]").each(function(){
	        var self = $(this);
	        var type = self.attr('type');

	        self.parent().find('label').addClass('active');
	        
	        // if (sys.inArray(type.toLowerCase(),['text','email','password','hidden'])) {
	        // 	if (!sys.isEmpty(self.val())) {
		       //  	self.parent().find('label').addClass('active');
		       //  }
	        // }
	        // else if (self.is('textarea')) {
	        // 	if (!sys.isEmpty(self.val())) {
		       //  	self.parent().find('label').addClass('active');
		       //  }
	        // }
	        // else if (self.is('select')) {
	        // 	if (!sys.isEmpty(self.find(':option:selected').val())) {
		       //  	self.parent().find('label').addClass('active');
		       //  }
	        // }
	    });   
	},
	/*
	* is Empty value
	* @var {string} value 
	* @return boolean
	*/
	isEmpty: function(value) {
		if (!value || value == '' || value == undefined || value == null) {
			return true;
		}
		return false;
	},
	/*
	* is in array
	* @var {string} value 
	* @var {array} data 
	* @return boolean
	*/
	inArray: function(value, data) {
		var status = false;
	    for(var i=0;i<data.length;i++){
	        if (value == data[i]){
	            status = true;
	            break;
	        }
	    }
	    return status;
	}
}