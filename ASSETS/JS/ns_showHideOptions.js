jQuery(document).ready(function($) {

	//allow to show or hide badge options in the single product backend
	$('#NS_Option_badge').change(
		function(){

		 	var ns_badge_value = $('#NS_Option_badge').val();

			if(ns_badge_value == '1')
	        	$('#show_option_badge').show();
	        else
	        	$('#show_option_badge').hide();
	    });
	//allow to show or hide badge position in the single product backend
	$('#NS_Option_badge_position').change(
		function(){

		 	var ns_badge_position_value = $('#NS_Option_badge_position').val();

			if(ns_badge_position_value == '1')
	        	$('#show_option_badge_position').show();
	        else
	        	$('#show_option_badge_position').hide();
	    });
});

