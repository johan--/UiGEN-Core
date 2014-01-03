jQuery(document).ready(function() {
	 // back
	jQuery(".back1btn").click(function() {		
	    event.preventDefault();
	    history.back(1);
	});
	jQuery(".back2btn").click(function() {
	    event.preventDefault();
	   window.history.go(-2);
	});
	jQuery(".goto").click(function(event) {
	    event.preventDefault();
	    window.location = jQuery(this).attr('value');
	});
});

