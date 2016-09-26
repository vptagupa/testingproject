var formValidator = {
	insert: function(rules) {
		for(var i in rules) {
			$('#'+i).rules('add',rules[i]);
		}
	},
	remove: function(rules) {
		for(var i in rules) {
			$('#'+i).rules('remove');
		}
	}
}