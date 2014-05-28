window.onload=function(){
jQuery(document).ready(function($) {
	 // back
	$(".back1btn").click(function() {		
	    event.preventDefault();
	    history.back(1);
	});
	$(".back2btn").click(function() {
	    event.preventDefault();
	   window.history.go(-2);
	});
	$(".goto").click(function(event) {
	    event.preventDefault();
	    window.location = $(this).attr('value');
	});


	$('.eHeight').each(function () {
	  var eHeight = $(this).parent().innerHeight();
	  $(this).outerHeight(eHeight);
	});
});
}

